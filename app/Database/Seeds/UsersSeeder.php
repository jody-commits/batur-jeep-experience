<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: UsersSeeder
 *
 * Mengisi data awal untuk tabel `users`:
 *   - 1 akun Administrator
 *   - 3 akun pelanggan contoh
 *
 * Password default semua akun: Admin@1234
 * Hash bcrypt cost 12 di-generate via: password_hash('Admin@1234', PASSWORD_BCRYPT, ['cost' => 12])
 *
 * ⚠️  UBAH PASSWORD sebelum deploy ke production!
 *
 * @version 1.0.0
 */
class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Hash bcrypt untuk password 'Admin@1234' (cost 12)
        // Generate ulang: password_hash('Admin@1234', PASSWORD_BCRYPT, ['cost' => 12])
        $passwordHash = password_hash('Admin@1234', PASSWORD_BCRYPT, ['cost' => 12]);

        $users = [
            // ── Administrator ──────────────────────────────────────────
            [
                'name'       => 'Administrator',
                'email'      => 'admin@baturjeep.com',
                'password'   => $passwordHash,
                'phone'      => '08123456789',
                'role'       => 'admin',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            // ── Pelanggan Contoh ────────────────────────────────────────
            [
                'name'       => 'Budi Santoso',
                'email'      => 'budi@example.com',
                'password'   => $passwordHash,
                'phone'      => '08112345678',
                'role'       => 'user',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Dewi Rahayu',
                'email'      => 'dewi@example.com',
                'password'   => $passwordHash,
                'phone'      => '08198765432',
                'role'       => 'user',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name'       => 'Michael Johnson',
                'email'      => 'michael@example.com',
                'password'   => $passwordHash,
                'phone'      => '08211234567',
                'role'       => 'user',
                'is_active'  => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Hindari duplikasi saat seeder dijalankan ulang
        foreach ($users as $user) {
            $exists = $this->db->table('users')
                ->where('email', $user['email'])
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('users')->insert($user);
            }
        }

        echo "✅  UsersSeeder: " . count($users) . " users seeded.\n";
    }
}
