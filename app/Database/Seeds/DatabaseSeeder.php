<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * DatabaseSeeder — Master Seeder
 *
 * Entry point untuk menjalankan semua seeder sekaligus.
 * Urutan penting karena ada dependensi antar tabel:
 *
 *   1. UsersSeeder       → tabel users (tidak ada FK)
 *   2. PackagesSeeder    → tabel packages (tidak ada FK)
 *   3. VehiclesSeeder    → tabel vehicles (tidak ada FK)
 *   4. BookingsSeeder    → tabel bookings (FK: users, packages, vehicles)
 *   5. TestimonialsSeeder → tabel testimonials (FK: users, bookings)
 *
 * Cara menjalankan:
 *   php spark db:seed DatabaseSeeder
 *
 * Menjalankan seeder individual:
 *   php spark db:seed UsersSeeder
 *   php spark db:seed PackagesSeeder
 *   php spark db:seed VehiclesSeeder
 *   php spark db:seed BookingsSeeder
 *   php spark db:seed TestimonialsSeeder
 *
 * @version 1.0.0
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        echo "\n🚙  Batur Jeep Experience — Database Seeder\n";
        echo "=" . str_repeat("=", 45) . "\n\n";

        $seeders = [
            UsersSeeder::class,
            PackagesSeeder::class,
            VehiclesSeeder::class,
            BookingsSeeder::class,
            TestimonialsSeeder::class,
        ];

        foreach ($seeders as $seederClass) {
            $name = class_basename($seederClass);
            echo "▶  Running {$name}...\n";

            $this->call($seederClass);
        }

        echo "\n" . str_repeat("=", 46) . "\n";
        echo "✅  Semua seeder berhasil dijalankan!\n\n";
        echo "📌  Login Credentials:\n";
        echo "    Admin : admin@baturjeep.com / Admin@1234\n";
        echo "    User 1: budi@example.com    / Admin@1234\n";
        echo "    User 2: dewi@example.com    / Admin@1234\n";
        echo "    User 3: michael@example.com / Admin@1234\n\n";
        echo "⚠️   Ubah password sebelum deploy ke production!\n\n";
    }
}

// ── Helper ──────────────────────────────────────────────────────────────────
if (!function_exists('class_basename')) {
    /**
     * Mengambil nama class tanpa namespace.
     */
    function class_basename(string $class): string
    {
        $parts = explode('\\', $class);
        return end($parts);
    }
}
