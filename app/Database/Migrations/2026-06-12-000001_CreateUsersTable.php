<?php

declare(strict_types=1);

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Migration: Create Users Table
 *
 * Menyimpan data akun pelanggan dan administrator.
 * Mendukung soft delete via kolom `deleted_at`.
 *
 * @version 1.0.0
 */
class CreateUsersTable extends Migration
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
                'comment'    => 'Nama lengkap pengguna',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false,
                'comment'    => 'Email unik, digunakan untuk login',
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
                'comment'    => 'Bcrypt hash, min cost 10',
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => false,
                'comment'    => 'No HP / WhatsApp aktif',
            ],
            'role' => [
                'type'       => 'ENUM',
                'constraint' => ['user', 'admin'],
                'null'       => false,
                'default'    => 'user',
                'comment'    => 'Hak akses pengguna',
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => false,
                'default'    => 1,
                'comment'    => '1=aktif, 0=dinonaktifkan',
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

        // Unique key: email
        $this->forge->addUniqueKey('email', 'uq_users_email');

        // Index: role (filter by role sering dipakai)
        $this->forge->addKey('role', false, false, 'idx_users_role');

        // Index: is_active
        $this->forge->addKey('is_active', false, false, 'idx_users_is_active');

        $this->forge->createTable('users', true, [
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8mb4',
            'COLLATE'         => 'utf8mb4_unicode_ci',
            'COMMENT'         => 'Data akun pelanggan dan administrator',
        ]);
    }

    public function down(): void
    {
        $this->forge->dropTable('users', true);
    }
}
