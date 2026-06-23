<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: BookingsSeeder
 *
 * Mengisi data contoh untuk tabel `bookings`:
 *   - Berbagai status booking: pending, confirmed, completed, rejected, cancelled
 *   - Berguna untuk testing admin panel dan tampilan riwayat booking user
 *
 * ⚠️  Seeder ini bergantung pada data dari:
 *   - UsersSeeder (minimal 4 user sudah ada)
 *   - PackagesSeeder (minimal 4 paket sudah ada)
 *   - VehiclesSeeder (minimal 4 kendaraan sudah ada)
 *
 * @version 1.0.0
 */
class BookingsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil ID user (pelanggan, bukan admin)
        $users = $this->db->table('users')
            ->where('role', 'user')
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();

        // Ambil ID paket yang aktif
        $packages = $this->db->table('packages')
            ->where('is_active', 1)
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();

        // Ambil ID kendaraan yang tersedia
        $vehicles = $this->db->table('vehicles')
            ->where('status', 'available')
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();

        // Ambil ID admin untuk confirmed_by
        $admin = $this->db->table('users')
            ->where('role', 'admin')
            ->where('deleted_at', null)
            ->get()
            ->getRow();

        // Guard: pastikan data pendukung sudah ada
        if (empty($users) || empty($packages)) {
            echo "⚠️  BookingsSeeder: Jalankan UsersSeeder dan PackagesSeeder terlebih dahulu.\n";
            return;
        }

        $now     = date('Y-m-d H:i:s');
        $today   = date('Y-m-d');
        $adminId = $admin->id ?? null;

        $bookings = [
            // ── 1. Booking PENDING (menunggu konfirmasi admin) ──────────
            [
                'booking_code'   => 'BJE-' . date('Ymd') . '-0001',
                'user_id'        => $users[0]['id'],
                'package_id'     => $packages[0]['id'], // Sunrise Batur
                'vehicle_id'     => null,
                'customer_name'  => $users[0]['name'],
                'customer_phone' => $users[0]['phone'],
                'customer_email' => $users[0]['email'],
                'hotel_name'     => 'The Layar Seminyak',
                'tour_date'      => date('Y-m-d', strtotime('+7 days')),
                'total_persons'  => 3,
                'total_price'    => 1500000.00,
                'notes'          => 'Mohon jemput pukul 03.30 WITA. Kami ada 1 anak kecil.',
                'status'         => 'pending',
                'rejection_reason' => null,
                'confirmed_by'   => null,
                'confirmed_at'   => null,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],

            // ── 2. Booking CONFIRMED (sudah dikonfirmasi admin) ─────────
            [
                'booking_code'   => 'BJE-' . date('Ymd') . '-0002',
                'user_id'        => $users[1]['id'] ?? $users[0]['id'],
                'package_id'     => $packages[1]['id'] ?? $packages[0]['id'], // Offroad Full Day
                'vehicle_id'     => $vehicles[0]['id'] ?? null,
                'customer_name'  => $users[1]['name'] ?? $users[0]['name'],
                'customer_phone' => $users[1]['phone'] ?? $users[0]['phone'],
                'customer_email' => $users[1]['email'] ?? $users[0]['email'],
                'hotel_name'     => 'Komaneka at Bisma Ubud',
                'tour_date'      => date('Y-m-d', strtotime('+3 days')),
                'total_persons'  => 2,
                'total_price'    => 2500000.00,
                'notes'          => 'Kami sudah siap dari pukul 07.00 WITA.',
                'status'         => 'confirmed',
                'rejection_reason' => null,
                'confirmed_by'   => $adminId,
                'confirmed_at'   => date('Y-m-d H:i:s', strtotime('-1 hour')),
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 hours')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-1 hour')),
            ],

            // ── 3. Booking COMPLETED (wisata selesai) ───────────────────
            [
                'booking_code'   => 'BJE-' . date('Ymd', strtotime('-5 days')) . '-0003',
                'user_id'        => $users[2]['id'] ?? $users[0]['id'],
                'package_id'     => $packages[2]['id'] ?? $packages[0]['id'], // Private Trip
                'vehicle_id'     => $vehicles[1]['id'] ?? null,
                'customer_name'  => $users[2]['name'] ?? $users[0]['name'],
                'customer_phone' => $users[2]['phone'] ?? $users[0]['phone'],
                'customer_email' => $users[2]['email'] ?? $users[0]['email'],
                'hotel_name'     => null, // Self-arrive
                'tour_date'      => date('Y-m-d', strtotime('-5 days')),
                'total_persons'  => 4,
                'total_price'    => 3500000.00,
                'notes'          => 'Family trip bersama 4 orang.',
                'status'         => 'completed',
                'rejection_reason' => null,
                'confirmed_by'   => $adminId,
                'confirmed_at'   => date('Y-m-d H:i:s', strtotime('-6 days')),
                'created_at'     => date('Y-m-d H:i:s', strtotime('-7 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],

            // ── 4. Booking REJECTED (ditolak admin) ─────────────────────
            [
                'booking_code'   => 'BJE-' . date('Ymd', strtotime('-3 days')) . '-0004',
                'user_id'        => $users[0]['id'],
                'package_id'     => $packages[3]['id'] ?? $packages[0]['id'], // Sunset View
                'vehicle_id'     => null,
                'customer_name'  => $users[0]['name'],
                'customer_phone' => $users[0]['phone'],
                'customer_email' => $users[0]['email'],
                'hotel_name'     => null,
                'tour_date'      => $today,
                'total_persons'  => 7, // Melebihi kapasitas
                'total_price'    => 1800000.00,
                'notes'          => 'Kami rombongan 7 orang, apakah bisa?',
                'status'         => 'rejected',
                'rejection_reason' => 'Maaf, jumlah peserta melebihi kapasitas maksimum kendaraan (6 orang). Silakan bagi menjadi 2 booking atau pilih paket Private Trip.',
                'confirmed_by'   => $adminId,
                'confirmed_at'   => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at'     => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],

            // ── 5. Booking CANCELLED (dibatalkan user) ──────────────────
            [
                'booking_code'   => 'BJE-' . date('Ymd', strtotime('-2 days')) . '-0005',
                'user_id'        => $users[1]['id'] ?? $users[0]['id'],
                'package_id'     => $packages[0]['id'], // Sunrise Batur
                'vehicle_id'     => null,
                'customer_name'  => $users[1]['name'] ?? $users[0]['name'],
                'customer_phone' => $users[1]['phone'] ?? $users[0]['phone'],
                'customer_email' => $users[1]['email'] ?? $users[0]['email'],
                'hotel_name'     => 'Alaya Resort Ubud',
                'tour_date'      => date('Y-m-d', strtotime('+1 days')),
                'total_persons'  => 2,
                'total_price'    => 1500000.00,
                'notes'          => '',
                'status'         => 'cancelled',
                'rejection_reason' => null,
                'confirmed_by'   => null,
                'confirmed_at'   => null,
                'created_at'     => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at'     => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
        ];

        $inserted = 0;

        foreach ($bookings as $booking) {
            $exists = $this->db->table('bookings')
                ->where('booking_code', $booking['booking_code'])
                ->countAllResults();

            if ($exists === 0) {
                $this->db->table('bookings')->insert($booking);
                $inserted++;
            }
        }

        echo "✅  BookingsSeeder: {$inserted} bookings seeded.\n";
    }
}
