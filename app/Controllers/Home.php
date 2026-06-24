<?php

namespace App\Controllers;

/**
 * Controller: Home
 * Menangani halaman publik: homepage
 */
class Home extends BaseController
{
    /**
     * GET /
     * Halaman utama / homepage
     */
    public function index(): string
    {
        $data = [
            'title'            => 'Batur Jeep Experience — Wisata Jeep Offroad Kintamani Bali',
            'meta_description' => 'Wisata Jeep Offroad terbaik di Gunung Batur, Kintamani, Bali. Paket Sunrise, Offroad Adventure, Private Trip. Booking mudah & aman. Pesan sekarang!',
        ];

        return view('home/index', $data);
    }
}
