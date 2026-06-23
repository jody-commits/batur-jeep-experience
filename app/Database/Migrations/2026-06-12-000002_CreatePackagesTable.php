<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Packages Table
 *
 * Menyimpan paket wisata Jeep yang ditawarkan.
 * Harga bersifat flat per booking (bukan per orang).
 * Mendukung soft delete via kolom `deleted_at`.
 *
 * @version 1.0.0
 */
class CreatePackagesTable extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false,
                'comment'    => 'Nama paket, contoh: Sunrise Batur',
            ],
            'description' => [
                'type'    => 'TEXT',
                'null'    => false,
                'comment' => 'Deskripsi lengkap paket wisata',
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '12,2',
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Harga flat per booking (bukan per orang)',
            ],
            'min_persons' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 1,
                'comment'    => 'Minimum jumlah orang per booking',
            ],
            'max_persons' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
                'default'    => 6,
                'comment'    => 'Maksimum kapasitas per booking',
            ],
            'duration' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
                'comment'    => 'Durasi, contoh: 4 Jam, Full Day',
            ],
            'is_pickup' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 0,
                'comment'    => '1=pickup dari hotel, 0=tamu datang ke lokasi',
            ],
            'thumbnail' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
                'comment'    => 'Path foto thumbnail paket',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 1,
                'comment'    => '1=aktif ditampilkan, 0=disembunyikan',
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

        // Index: is_active
        $this->forge->addKey('is_active', false, false, 'idx_packages_is_active');

        // Index: is_pickup
        $this->forge->addKey('is_pickup', false, false, 'idx_packages_is_pickup');

        $this->forge->createTable('packages', true, [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
            'COMMENT'         => 'Daftar paket wisata Jeep — harga flat per booking',
        ]);

        // CHECK constraints (MySQL 8.0.16+)
        $this->db->query('ALTER TABLE `packages` ADD CONSTRAINT `chk_packages_price` CHECK (`price` > 0)');
        $this->db->query('ALTER TABLE `packages` ADD CONSTRAINT `chk_packages_persons` CHECK (`min_persons` <= `max_persons`)');
    }

    public function down(): void
    {
        $this->forge->dropTable('packages', true);
    }
}
