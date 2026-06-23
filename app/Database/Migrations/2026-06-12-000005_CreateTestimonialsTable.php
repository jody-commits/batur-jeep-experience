<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Testimonials Table
 *
 * Menyimpan ulasan dan rating dari pelanggan yang sudah selesai wisata.
 * - 1 booking = 1 ulasan (UNIQUE KEY pada booking_id).
 * - Rating 1–5 bintang (CHECK constraint).
 * - Perlu disetujui admin (is_approved) sebelum tayang di website.
 *
 * Foreign Keys:
 *   - user_id    → users.id    (ON DELETE CASCADE)
 *   - booking_id → bookings.id (ON DELETE CASCADE)
 *
 * @version 1.0.0
 */
class CreateTestimonialsTable extends Migration
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
            'user_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'FK ke users.id — pemberi ulasan',
            ],
            'booking_id' => [
                'type'       => 'BIGINT',
                'constraint' => 20,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'FK ke bookings.id — 1 booking = 1 ulasan',
            ],
            'review' => [
                'type'    => 'TEXT',
                'null'    => false,
                'comment' => 'Isi ulasan / testimoni',
            ],
            'rating' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Rating 1–5 bintang',
            ],
            'is_approved' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 0,
                'comment'    => '0=pending review admin, 1=tayang di website',
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
        ]);

        // Primary key
        $this->forge->addPrimaryKey('id');

        // Unique key: booking_id (1 booking = 1 ulasan)
        $this->forge->addUniqueKey('booking_id', 'uq_testimonials_booking');

        // Indexes
        $this->forge->addKey('user_id',     false, false, 'idx_testimonials_user');
        $this->forge->addKey('is_approved', false, false, 'idx_testimonials_approved');

        // Foreign key constraints
        $this->forge->addForeignKey('user_id',    'users',    'id', 'CASCADE', 'CASCADE', 'fk_testimonials_user');
        $this->forge->addForeignKey('booking_id', 'bookings', 'id', 'CASCADE', 'CASCADE', 'fk_testimonials_booking');

        $this->forge->createTable('testimonials', true, [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
            'COMMENT'         => 'Ulasan dan rating pelanggan pasca wisata',
        ]);

        // CHECK constraint: rating harus antara 1–5
        $this->db->query('ALTER TABLE `testimonials` ADD CONSTRAINT `chk_testimonials_rating` CHECK (`rating` BETWEEN 1 AND 5)');
    }

    public function down(): void
    {
        $this->forge->dropTable('testimonials', true);
    }
}
