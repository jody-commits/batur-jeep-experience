<?php

declare(strict_types=1);

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder: TestimonialsSeeder
 *
 * Mengisi data contoh untuk tabel `testimonials`:
 *   - Ulasan dari booking yang sudah COMPLETED
 *   - Campuran status: approved (tayang) dan pending (belum disetujui admin)
 *
 * ⚠️  Seeder ini bergantung pada BookingsSeeder (status 'completed' harus ada).
 *
 * @version 1.0.0
 */
class TestimonialsSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil booking yang sudah completed untuk diberi testimoni
        $completedBookings = $this->db->table('bookings')
            ->where('status', 'completed')
            ->where('deleted_at', null)
            ->get()
            ->getResultArray();

        if (empty($completedBookings)) {
            echo "⚠️  TestimonialsSeeder: Tidak ada booking completed. Jalankan BookingsSeeder terlebih dahulu.\n";
            return;
        }

        $testimonials = [];

        // Data testimoni untuk setiap booking completed
        $reviewData = [
            [
                'review'      => 'Pengalaman yang luar biasa! Pemandangan sunrise di Gunung Batur benar-benar memukau. Driver sangat profesional dan friendly. Pasti akan booking lagi untuk trip berikutnya!',
                'rating'      => 5,
                'is_approved' => 1,
            ],
            [
                'review'      => 'Seru banget! Rutenya menantang tapi aman. Jeep-nya terawat dan nyaman. Pemandangan kaldera Batur dari atas sungguh indah sekali. Recommended untuk keluarga!',
                'rating'      => 5,
                'is_approved' => 1,
            ],
            [
                'review'      => 'Trip yang sangat berkesan. Awalnya agak ragu karena medan offroad, tapi ternyata aman dan mengasyikkan. Harga juga sangat worth it untuk pengalaman seperti ini.',
                'rating'      => 4,
                'is_approved' => 1,
            ],
        ];

        foreach ($completedBookings as $index => $booking) {
            $reviewIdx = $index % count($reviewData);
            $data      = $reviewData[$reviewIdx];

            // Cek apakah booking ini sudah ada testimoninya
            $exists = $this->db->table('testimonials')
                ->where('booking_id', $booking['id'])
                ->countAllResults();

            if ($exists === 0) {
                $testimonials[] = [
                    'user_id'     => $booking['user_id'],
                    'booking_id'  => $booking['id'],
                    'review'      => $data['review'],
                    'rating'      => $data['rating'],
                    'is_approved' => $data['is_approved'],
                    'created_at'  => date('Y-m-d H:i:s', strtotime('-1 day')),
                    'updated_at'  => date('Y-m-d H:i:s', strtotime('-1 day')),
                ];
            }
        }

        if (!empty($testimonials)) {
            $this->db->table('testimonials')->insertBatch($testimonials);
        }

        echo "✅  TestimonialsSeeder: " . count($testimonials) . " testimonials seeded.\n";
    }
}
