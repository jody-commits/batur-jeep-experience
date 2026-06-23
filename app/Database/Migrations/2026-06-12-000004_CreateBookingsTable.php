<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Bookings Table
 *
 * Menyimpan riwayat transaksi pemesanan paket wisata Jeep.
 * - Data pemesan di-denormalize untuk histori tahan perubahan data user.
 * - total_price adalah snapshot harga saat booking dibuat.
 * - Status: pending → confirmed/rejected → completed/cancelled.
 * - Mendukung soft delete via kolom `deleted_at`.
 *
 * Foreign Keys:
 *   - user_id      → users.id       (ON DELETE RESTRICT)
 *   - package_id   → packages.id    (ON DELETE RESTRICT)
 *   - vehicle_id   → vehicles.id    (ON DELETE SET NULL)
 *   - confirmed_by → users.id       (ON DELETE SET NULL)
 *
 * @version 1.0.0
 */
class CreateBookingsTable extends Migration
{
    public function up(): void
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'BIGINT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
                'comment'        => 'Primary key auto increment',
            ],
            'booking_code' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => false,
                'comment'    => 'Kode unik, format: BJE-20250611-0001',
            ],
            'user_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'FK ke users.id — pemesan',
            ],
            'package_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'FK ke packages.id — paket dipilih',
            ],
            'vehicle_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
                'comment'    => 'FK ke vehicles.id — diisi admin saat konfirmasi',
            ],

            // ── Data Pemesan (denormalized) ──────────────────────────
            'customer_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'comment'    => 'Nama lengkap pemesan',
            ],
            'customer_phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'comment'    => 'No HP / WhatsApp pemesan',
            ],
            'customer_email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
                'comment'    => 'Email pemesan',
            ],
            'hotel_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => true,
                'default'    => null,
                'comment'    => 'Nama hotel — diisi jika paket pickup',
            ],

            // ── Detail Wisata ─────────────────────────────────────────
            'tour_date' => [
                'type'    => 'DATE',
                'null'    => false,
                'comment' => 'Tanggal pelaksanaan wisata',
            ],
            'total_persons' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Jumlah orang yang ikut wisata',
            ],
            'total_price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Harga paket saat booking (snapshot dari packages.price)',
            ],
            'notes' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
                'comment' => 'Catatan tambahan dari pelanggan',
            ],

            // ── Status & Audit ────────────────────────────────────────
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'confirmed', 'rejected', 'completed', 'cancelled'],
                'null'       => false,
                'default'    => 'pending',
                'comment'    => 'Status pemrosesan booking',
            ],
            'rejection_reason' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
                'comment' => 'Alasan penolakan jika status = rejected',
            ],
            'confirmed_by' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => true,
                'default'    => null,
                'comment'    => 'FK ke users.id — admin yang konfirmasi/tolak',
            ],
            'confirmed_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
                'comment' => 'Waktu admin melakukan konfirmasi/penolakan',
            ],

            'created_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => false,
                'default' => new \CodeIgniter\Database\RawSql('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
            ],
            'deleted_at' => [
                'type'    => 'TIMESTAMP',
                'null'    => true,
                'default' => null,
                'comment' => 'Soft delete — NULL = tidak dihapus',
            ],
        ]);

        // Primary key
        $this->forge->addPrimaryKey('id');

        // Unique key: booking_code
        $this->forge->addUniqueKey('booking_code', 'uq_bookings_code');

        // Indexes untuk query yang sering dipakai
        $this->forge->addKey('user_id',    false, false, 'idx_bookings_user');
        $this->forge->addKey('package_id', false, false, 'idx_bookings_package');
        $this->forge->addKey('vehicle_id', false, false, 'idx_bookings_vehicle');
        $this->forge->addKey('status',     false, false, 'idx_bookings_status');
        $this->forge->addKey('tour_date',  false, false, 'idx_bookings_tour_date');
        $this->forge->addKey('created_at', false, false, 'idx_bookings_created');

        // Foreign key constraints
        $this->forge->addForeignKey('user_id',      'users',    'id', 'CASCADE', 'RESTRICT', 'fk_bookings_user');
        $this->forge->addForeignKey('package_id',   'packages', 'id', 'CASCADE', 'RESTRICT', 'fk_bookings_package');
        $this->forge->addForeignKey('vehicle_id',   'vehicles', 'id', 'CASCADE', 'SET NULL', 'fk_bookings_vehicle');
        $this->forge->addForeignKey('confirmed_by', 'users',    'id', 'CASCADE', 'SET NULL', 'fk_bookings_confirmed_by');

        $this->forge->createTable('bookings', true, [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
            'COMMENT'         => 'Riwayat transaksi pemesanan paket wisata Jeep',
        ]);

        // CHECK constraints (MySQL 8.0.16+)
        $this->db->query('ALTER TABLE `bookings` ADD CONSTRAINT `chk_bookings_price` CHECK (`total_price` > 0)');
        $this->db->query('ALTER TABLE `bookings` ADD CONSTRAINT `chk_bookings_persons` CHECK (`total_persons` > 0)');
    }

    public function down(): void
    {
        $this->forge->dropTable('bookings', true);
    }
}
