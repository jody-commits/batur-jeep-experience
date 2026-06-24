<?php

namespace App\Controllers;

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
        // Paket wisata — data statis (akan diganti dari DB saat Model tersedia)
        $packages = [
            [
                'id'          => 1,
                'name'        => 'Classic Sunrise & Black Lava',
                'slug'        => 'classic-sunrise-black-lava',
                'description' => 'Witness the majestic sunrise from the rim, followed by an exclusive guided drive across the ancient black lava fields of Mount Batur.',
                'price'       => 1500000,
                'min_persons' => 2,
                'max_persons' => 6,
                'duration'    => '6 Hours',
                'is_pickup'   => 1,
                'badge'       => 'sunrise',
                'badge_text'  => 'Sunrise Guaranteed',
                'image'       => 'batur-sunrise-hero.png',
                'highlights'  => ['Sunrise from crater rim', 'Black lava field drive', 'Hotel pickup available'],
                'category'    => ['hotel-pickup', 'sunrise-tours'],
                'is_featured' => true,
            ],
            [
                'id'          => 2,
                'name'        => 'Black Lava Express',
                'slug'        => 'black-lava-express',
                'description' => 'A focused off-road experience exploring the ancient lava flows of the 1963 eruption with panoramic caldera views.',
                'price'       => 850000,
                'min_persons' => 2,
                'max_persons' => 6,
                'duration'    => '3 Hours',
                'is_pickup'   => 0,
                'badge'       => null,
                'badge_text'  => null,
                'image'       => 'kintamani-green-hero.png',
                'highlights'  => ['Lava field exploration', 'Caldera panorama', 'Meeting point'],
                'category'    => ['meeting-point', 'black-lava-only'],
                'is_featured' => false,
            ],
            [
                'id'          => 3,
                'name'        => 'Sunrise, Lava & Hot Springs',
                'slug'        => 'sunrise-lava-hot-springs',
                'description' => 'The ultimate Batur experience. After the sunrise jeep, soak in natural hot springs at the foot of the volcano.',
                'price'       => 2200000,
                'min_persons' => 2,
                'max_persons' => 4,
                'duration'    => '8 Hours',
                'is_pickup'   => 1,
                'badge'       => 'bestseller',
                'badge_text'  => 'Best Seller',
                'image'       => 'batur-hero.jpg',
                'highlights'  => ['Sunrise guaranteed', 'Lava field offroad', 'Natural hot springs'],
                'category'    => ['hotel-pickup', 'sunrise-tours'],
                'is_featured' => true,
            ],
            [
                'id'          => 4,
                'name'        => 'Batur Full-Day Expedition',
                'slug'        => 'batur-full-day-expedition',
                'description' => 'Complete immersion. Includes sunrise jeep, lava trek, lakeside lunch, and caldera sunset views. The definitive Batur experience.',
                'price'       => 2750000,
                'min_persons' => 2,
                'max_persons' => 4,
                'duration'    => '10 Hours',
                'is_pickup'   => 1,
                'badge'       => 'private',
                'badge_text'  => 'Full Day',
                'image'       => 'jeep-hero.jpg',
                'highlights'  => ['Sunrise + sunset', 'Lakeside lunch', 'Multiple attractions'],
                'category'    => ['hotel-pickup', 'sunrise-tours', 'black-lava-only'],
                'is_featured' => false,
            ],
            [
                'id'          => 5,
                'name'        => 'Private Trip Kintamani',
                'slug'        => 'private-trip-kintamani',
                'description' => 'Exclusive private tour for families and couples. Choose your own route and schedule for ultimate flexibility.',
                'price'       => 3500000,
                'min_persons' => 1,
                'max_persons' => 6,
                'duration'    => '6 Hours',
                'is_pickup'   => 0,
                'badge'       => 'private',
                'badge_text'  => 'Private Exclusive',
                'image'       => 'kintamani-green-hero.png',
                'highlights'  => ['Custom route', 'Flexible schedule', 'Private guide'],
                'category'    => ['meeting-point'],
                'is_featured' => false,
            ],
            [
                'id'          => 6,
                'name'        => 'Sunset & Caldera View',
                'slug'        => 'sunset-caldera-view',
                'description' => 'Enjoy the breathtaking Batur caldera at golden hour, accessed via exclusive Jeep trails only our guides know.',
                'price'       => 1800000,
                'min_persons' => 2,
                'max_persons' => 6,
                'duration'    => '3 Hours',
                'is_pickup'   => 0,
                'badge'       => 'sunset',
                'badge_text'  => 'Sunset View',
                'image'       => 'batur-hero.jpg',
                'highlights'  => ['Golden hour views', 'Caldera panorama', 'Expert guide'],
                'category'    => ['meeting-point', 'black-lava-only'],
                'is_featured' => false,
            ],
        ];

        $data = [
            'title'            => 'Tour Packages — Batur Jeep Experience',
            'meta_description' => 'Pilih paket wisata Jeep offroad terbaik di Gunung Batur, Kintamani Bali. Sunrise, Offroad, Private Trip, Full Day. Harga terjangkau, guide berpengalaman.',
            'packages'         => $packages,
        ];

        return view('packages/index', $data);
    }
}
