<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: VehiclesSeeder
 *
 * Mengisi data awal untuk tabel `vehicles` (armada Jeep):
 *   - 5 unit Jeep dengan variasi warna dan fasilitas
 *
 * Status default: available (siap beroperasi)
 * Plate number: format Bali (DK XXXX XX)
 *
 * @version 1.0.0
 */
class VehiclesSeeder extends Seeder
{
    public function run(): void
    {
        $vehicles = [
            // ── Unit 1 ─────────────────────────────────────────────────
            [
                'name'         => 'Jeep Batur 01',
                'plate_number' => 'DK 1234 AB',
                'capacity'     => 4,
                'color'        => 'Hijau Army',
                'facilities'   => 'Rollbar, Safety Belt, Kotak P3K, GPS',
                'photo'        => null,
                'status'       => 'available',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],

            // ── Unit 2 ─────────────────────────────────────────────────
            [
                'name'         => 'Jeep Batur 02',
                'plate_number' => 'DK 5678 CD',
                'capacity'     => 4,
                'color'        => 'Hitam Doff',
                'facilities'   => 'Rollbar, Safety Belt, Kotak P3K',
                'photo'        => null,
                'status'       => 'available',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],

            // ── Unit 3 ─────────────────────────────────────────────────
            [
                'name'         => 'Jeep Batur 03',
                'plate_number' => 'DK 9012 EF',
                'capacity'     => 4,
                'color'        => 'Coklat Muda',
                'facilities'   => 'Rollbar, Safety Belt, Kotak P3K, USB Charger',
                'photo'        => null,
                'status'       => 'available',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],

            // ── Unit 4 ─────────────────────────────────────────────────
            [
                'name'         => 'Jeep Batur 04',
                'plate_number' => 'DK 3456 GH',
                'capacity'     => 6,
                'color'        => 'Orange',
                'facilities'   => 'Rollbar, Safety Belt, Kotak P3K, USB Charger, Snorkel',
                'photo'        => null,
                'status'       => 'available',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],

            // ── Unit 5 (Maintenance) ───────────────────────────────────
            [
                'name'         => 'Jeep Batur 05',
                'plate_number' => 'DK 7890 IJ',
                'capacity'     => 4,
                'color'        => 'Putih',
                'facilities'   => 'Rollbar, Safety Belt, Kotak P3K',
                'photo'        => null,
                'status'       => 'maintenance',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        // Hindari duplikasi saat seeder dijalankan ulang
        foreach ($vehicles as $vehicle) {
            $exists = $this->db->table('vehicles')
                ->where('plate_number', $vehicle['plate_number'])
                ->where('deleted_at', null)
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('vehicles')->insert($vehicle);
            }
        }

        echo "✅  VehiclesSeeder: " . count($vehicles) . " vehicles seeded.\n";
    }
}
