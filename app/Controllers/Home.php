<?php

namespace App\Controllers;

use App\Models\PackageModel;

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
        $packageModel = new PackageModel();
        // Fetch top 3 active packages for the homepage
        $dbPackages = $packageModel->getActivePackages();
        $featuredPackages = array_slice($dbPackages, 0, 3); // Take top 3

        $packages = [];
        foreach ($featuredPackages as $pkg) {
            $packages[] = [
                'id'          => $pkg['id'],
                'name'        => $pkg['name'],
                'description' => $pkg['description'],
                'price'       => $pkg['price'],
                'duration'    => $pkg['duration'],
                'is_pickup'   => $pkg['is_pickup'],
                'image'       => $pkg['thumbnail'] ?? 'sunrise.jpg',
            ];
        }

        $data = [
            'title'            => 'Batur Jeep Experience — Wisata Jeep Offroad Kintamani Bali',
            'meta_description' => 'Wisata Jeep Offroad terbaik di Gunung Batur, Kintamani, Bali. Paket Sunrise, Offroad Adventure, Private Trip. Booking mudah & aman. Pesan sekarang!',
            'packages'         => $packages,
        ];

        return view('home/index', $data);
    }
}