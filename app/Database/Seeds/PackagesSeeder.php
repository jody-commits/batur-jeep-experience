<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: PackagesSeeder
 *
 * Mengisi data awal untuk tabel `packages`:
 *   - 4 paket wisata Jeep Batur sesuai planning dokumen
 *
 * Harga bersifat flat rate per booking (bukan per orang):
 *   - Sunrise Batur         : Rp 1.500.000 (pickup)
 *   - Offroad Adventure     : Rp 2.500.000 (pickup)
 *   - Private Trip Kintamani: Rp 3.500.000 (self-arrive)
 *   - Sunset & Caldera View : Rp 1.800.000 (self-arrive)
 *
 * @version 1.0.0
 */
class PackagesSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            // ── 1. Sunrise Batur ─────────────────────────────────────
            [
                'name'        => 'Sunrise Batur',
                'description' => 'Saksikan matahari terbit spektakuler di Gunung Batur dengan pemandangan Danau Batur yang memukau. Perjalanan dimulai pukul 04.00 WITA dari hotel Anda. Nikmati udara segar pegunungan dan panorama kaldera yang tiada duanya. Paket sudah termasuk: jemput-antar hotel, sarapan ringan, dan pemandu lokal berpengalaman.',
                'price'       => 1500000.00,
                'min_persons' => 2,
                'max_persons' => 6,
                'duration'    => '4 Jam',
                'is_pickup'   => 1, // pickup dari hotel
                'thumbnail'   => null,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],

            // ── 2. Offroad Adventure Full Day ──────────────────────────
            [
                'name'        => 'Offroad Adventure Full Day',
                'description' => 'Petualangan offroad seharian penuh menyusuri jalur menantang di lereng Gunung Batur. Cocok untuk pecinta adrenalin yang ingin merasakan sensasi berkendara Jeep di medan vulkanik. Rute meliputi: ladang pasir hitam, tepian danau Batur, dan desa tradisional Trunyan. Paket termasuk: jemput-antar hotel, makan siang lokal, dan pemandu ahli.',
                'price'       => 2500000.00,
                'min_persons' => 2,
                'max_persons' => 4,
                'duration'    => '8 Jam',
                'is_pickup'   => 1, // pickup dari hotel
                'thumbnail'   => null,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],

            // ── 3. Private Trip Kintamani ─────────────────────────────
            [
                'name'        => 'Private Trip Kintamani',
                'description' => 'Trip privat eksklusif untuk keluarga atau rombongan kecil. Bebas menentukan rute dan jadwal sesuai keinginan Anda. Jelajahi keindahan Kintamani dari perspektif yang berbeda dengan Jeep offroad kami. Rute rekomendasi: Penelokan → Batur → Desa Pinggan → Pura Ulun Danu. Tamu datang langsung ke meeting point Penelokan.',
                'price'       => 3500000.00,
                'min_persons' => 1,
                'max_persons' => 6,
                'duration'    => '6 Jam',
                'is_pickup'   => 0, // self-arrive (tamu datang ke lokasi)
                'thumbnail'   => null,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],

            // ── 4. Sunset & Caldera View ───────────────────────────────
            [
                'name'        => 'Sunset & Caldera View',
                'description' => 'Nikmati pemandangan kaldera Batur saat matahari terbenam dari titik tertinggi yang bisa dijangkau Jeep. Pemandangan langit jingga di atas danau Batur dan Gunung Abang yang dramatis menjadi latar belakang sempurna untuk foto. Tamu datang langsung ke meeting point Penelokan pukul 15.00 WITA.',
                'price'       => 1800000.00,
                'min_persons' => 2,
                'max_persons' => 6,
                'duration'    => '3 Jam',
                'is_pickup'   => 0, // self-arrive
                'thumbnail'   => null,
                'is_active'   => 1,
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s'),
            ],
        ];

        // Hindari duplikasi saat seeder dijalankan ulang
        foreach ($packages as $package) {
            $exists = $this->db->table('packages')
                ->where('name', $package['name'])
                ->where('deleted_at', null)
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('packages')->insert($package);
            }
        }

        echo "✅  PackagesSeeder: " . count($packages) . " packages seeded.\n";
    }
}
