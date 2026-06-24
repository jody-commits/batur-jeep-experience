<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

/**
 * Controller: Booking
 * Menangani alur pemesanan — form booking dan konfirmasi
 */
class Booking extends BaseController
{
    /**
     * GET /booking
     * Tampilkan form booking "Book Your Adventure"
     * Query param: ?package=1 untuk pre-select paket
     */
    public function index(): string
    {
        // Data paket (sama seperti Package controller — nanti dari DB)
        $packages = [
            1 => [
                'id'          => 1,
                'name'        => 'Classic Sunrise & Black Lava',
                'subtitle'    => 'Kintamani Highland Private Expedition',
                'price'       => 1500000,
                'duration'    => '6 Hours',
                'image'       => 'batur-sunrise-hero.png',
                'included'    => ['Breakfast & Coffee Included', 'Private English Speaking Driver', 'Professional Jeep Equipment'],
                'pickup_type' => 'hotel',  // 'hotel' or 'meeting'
            ],
            2 => [
                'id'          => 2,
                'name'        => 'Black Lava Express',
                'subtitle'    => 'Meeting Point, Self Drive Route',
                'price'       => 850000,
                'duration'    => '3 Hours',
                'image'       => 'fleet-commander.jpg',
                'included'    => ['Private English Speaking Driver', 'Professional Jeep Equipment', 'Trail Snack'],
                'pickup_type' => 'meeting',
            ],
            3 => [
                'id'          => 3,
                'name'        => 'Sunrise, Lava & Hot Springs',
                'subtitle'    => 'The Ultimate Batur Experience',
                'price'       => 2200000,
                'duration'    => '8 Hours',
                'image'       => 'fleet-scout.jpg',
                'included'    => ['Breakfast & Coffee Included', 'Hot Springs Entry Fee', 'Private English Speaking Driver', 'Professional Jeep Equipment'],
                'pickup_type' => 'hotel',
            ],
            4 => [
                'id'          => 4,
                'name'        => 'Batur Full-Day Expedition',
                'subtitle'    => 'Complete Immersion — Sunrise to Sunset',
                'price'       => 3500000,
                'duration'    => '10 Hours',
                'image'       => 'fleet-raider.jpg',
                'included'    => ['Breakfast & Lunch Included', 'Hot Springs Entry Fee', 'Private English Speaking Driver', 'Professional Jeep Equipment', 'Sunset Viewpoint Stop'],
                'pickup_type' => 'hotel',
            ],
            5 => [
                'id'          => 5,
                'name'        => 'Caldera & Village Trail',
                'subtitle'    => 'Cultural Off-Road Discovery',
                'price'       => 1200000,
                'duration'    => '5 Hours',
                'image'       => 'kintamani-green-hero.png',
                'included'    => ['Breakfast Included', 'Village Guide', 'Private English Speaking Driver', 'Professional Jeep Equipment'],
                'pickup_type' => 'meeting',
            ],
            6 => [
                'id'          => 6,
                'name'        => 'Caldera Sunset Private',
                'subtitle'    => 'Exclusive Sunset Rim Experience',
                'price'       => 1800000,
                'duration'    => '4 Hours',
                'image'       => 'fleet-king.jpg',
                'included'    => ['Sunset Snack Box', 'Private English Speaking Driver', 'Professional Jeep Equipment', 'Photography Guide'],
                'pickup_type' => 'hotel',
            ],
        ];

        // Ambil paket yang dipilih (query param ?package=ID)
        $packageId = (int) ($this->request->getGet('package') ?? 1);
        if (!isset($packages[$packageId])) {
            $packageId = 1;
        }
        $selectedPackage = $packages[$packageId];

        $data = [
            'title'           => 'Book Your Adventure — Batur Jeep Experience',
            'meta_description' => 'Reservasi wisata jeep offroad Gunung Batur Kintamani Bali. Pilih paket, isi data, konfirmasi — mudah dan cepat.',
            'packages'        => $packages,
            'selected'        => $selectedPackage,
            'selectedId'      => $packageId,
        ];

        return view('booking/index', $data);
    }

    /**
     * POST /booking
     * Proses form booking — simpan sesi dan redirect ke confirm
     */
    public function store(): RedirectResponse
    {
        // Validasi input
        $rules = [
            'full_name'   => 'required|min_length[3]|max_length[100]',
            'whatsapp'    => 'required|min_length[8]|max_length[20]',
            'email'       => 'required|valid_email',
            'tour_date'   => 'required',
            'num_guests'  => 'required|integer|greater_than[0]|less_than[19]',
            'package_id'  => 'required|integer',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Ambil data form
        $packageId = (int) $this->request->getPost('package_id');
        $numGuests = (int) $this->request->getPost('num_guests');
        $needPickup = (bool) $this->request->getPost('need_pickup');
        $tourDate  = $this->request->getPost('tour_date');

        // Harga paket (hardcoded — nanti dari model)
        $prices = [1 => 1500000, 2 => 850000, 3 => 2200000, 4 => 3500000, 5 => 1200000, 6 => 1800000];
        $names  = [
            1 => 'Classic Sunrise & Black Lava',
            2 => 'Black Lava Express',
            3 => 'Sunrise, Lava & Hot Springs',
            4 => 'Batur Full-Day Expedition',
            5 => 'Caldera & Village Trail',
            6 => 'Caldera Sunset Private',
        ];

        $basePrice  = $prices[$packageId] ?? 1500000;
        $numJeeps   = (int) ceil($numGuests / 3);  // maks 3 orang per jeep
        $totalPrice = $basePrice * $numJeeps;

        // Generate nomor referensi unik
        $refDate = date('Ymd');
        $refSeq  = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $refCode = 'BJE-' . $refDate . '-' . $refSeq;

        // Simpan ke session (nanti disimpan ke DB)
        session()->set('booking', [
            'ref_code'       => $refCode,
            'package_id'     => $packageId,
            'package_name'   => $names[$packageId] ?? 'Batur Jeep Experience',
            'full_name'      => $this->request->getPost('full_name'),
            'whatsapp'       => $this->request->getPost('whatsapp'),
            'email'          => $this->request->getPost('email'),
            'tour_date'      => $tourDate,
            'num_guests'     => $numGuests,
            'num_jeeps'      => $numJeeps,
            'need_pickup'    => $needPickup,
            'base_price'     => $basePrice,
            'total_price'    => $totalPrice,
            'pickup_note'    => $needPickup ? '03:30 AM (Hotel Area)' : '04:00 AM (Meeting Point)',
            'status'         => 'pending',
            'payment_status' => 'Payment Confirmed',
            'created_at'     => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('booking/confirm');
    }

    /**
     * GET /booking/confirm
     * Halaman konfirmasi / sukses setelah booking
     */
    public function confirm(): string
    {
        $booking = session()->get('booking');

        // Guard: kalau tidak ada session booking, redirect ke form
        if (empty($booking)) {
            return redirect()->to('booking')->with('error', 'Sesi booking tidak ditemukan. Silakan isi form kembali.');
        }

        $data = [
            'title'            => 'Booking Submitted! — Batur Jeep Experience',
            'meta_description' => 'Booking jeep Batur kamu berhasil! Cek detail reservasi dan referensi pemesanan kamu.',
            'booking'          => $booking,
        ];

        return view('booking/confirm', $data);
    }
}
