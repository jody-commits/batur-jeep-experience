<?php

namespace App\Controllers;

use App\Models\PackageModel;

/**
 * Controller: Package
 * Menangani halaman publik daftar paket wisata
 */
class Package extends BaseController
{
    /**
     * GET /packages
     * Halaman daftar semua paket wisata
     */
    public function index(): string
    {
        $packageModel = new PackageModel();
        $dbPackages = $packageModel->getActivePackages();

        $packages = [];
        foreach ($dbPackages as $pkg) {
            // Mapping format agar sesuai dengan UI yang sudah ada
            $mapped = [
                'id'          => $pkg['id'],
                'name'        => $pkg['name'],
                'slug'        => strtolower(str_replace(' ', '-', $pkg['name'])),
                'description' => $pkg['description'],
                'price'       => $pkg['price'],
                'min_persons' => $pkg['min_persons'],
                'max_persons' => $pkg['max_persons'],
                'duration'    => $pkg['duration'],
                'is_pickup'   => $pkg['is_pickup'],
                'badge'       => ($pkg['is_pickup'] == 1) ? 'bestseller' : null,
                'badge_text'  => ($pkg['is_pickup'] == 1) ? 'Best Seller' : null,
                'image'       => $pkg['thumbnail'] ?? 'sunrise.jpg',
                'highlights'  => ['Professional Jeep Equipment', 'Private English Speaking Driver', 'Insurance'],
                'category'    => ($pkg['is_pickup'] == 1) ? ['hotel-pickup'] : ['meeting-point'],
                'is_featured' => ($pkg['id'] == 1 || $pkg['id'] == 3),
            ];

            if ($pkg['is_pickup'] == 1) {
                $mapped['highlights'][] = 'Breakfast & Coffee Included';
                $mapped['highlights'][] = 'Hotel Pickup';
            }

            $packages[] = $mapped;
        }

        $data = [
            'title'            => 'Tour Packages — Batur Jeep Experience',
            'meta_description' => 'Eksplorasi pilihan paket wisata Jeep Batur Kintamani terbaik. Tersedia paket sunrise, black lava, hingga custom private trip.',
            'packages'         => $packages,
        ];

        return view('packages/index', $data);
    }
}