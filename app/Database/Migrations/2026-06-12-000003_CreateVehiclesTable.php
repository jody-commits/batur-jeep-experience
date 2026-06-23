<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Vehicles Table
 *
 * Menyimpan data armada kendaraan Jeep yang dimiliki.
 * Status armada: available | rented | maintenance.
 * Mendukung soft delete via kolom `deleted_at`.
 *
 * @version 1.0.0
 */
class CreateVehiclesTable extends Migration
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
                'comment'    => 'Nama/panggilan armada, contoh: Jeep Batur 01',
            ],
            'plate_number' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'comment'    => 'Nomor polisi kendaraan',
            ],
            'capacity' => [
                'type'       => 'TINYINT',
                'constraint' => 3,
                'unsigned'   => true,
                'null'       => false,
                'comment'    => 'Kapasitas penumpang (tidak termasuk driver)',
            ],
            'color' => [
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => true,
                'default'    => null,
                'comment'    => 'Warna kendaraan',
            ],
            'facilities' => [
                'type'    => 'TEXT',
                'null'    => true,
                'default' => null,
                'comment' => 'Fasilitas, contoh: Rollbar, Safety Belt, P3K',
            ],
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
                'comment'    => 'Path foto kendaraan',
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['available', 'rented', 'maintenance'],
                'null'       => false,
                'default'    => 'available',
                'comment'    => 'Status armada saat ini',
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

        // Unique key: plate_number
        $this->forge->addUniqueKey('plate_number', 'uq_vehicles_plate');

        // Index: status (query filter armada tersedia)
        $this->forge->addKey('status', false, false, 'idx_vehicles_status');

        $this->forge->createTable('vehicles', true, [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
            'COMMENT'         => 'Armada kendaraan Jeep yang dimiliki',
        ]);
    }

    public function down(): void
    {
        $this->forge->dropTable('vehicles', true);
    }
}
