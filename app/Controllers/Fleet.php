<?php

namespace App\Controllers;

/**
 * Controller: Fleet
 * Menangani halaman publik Our Fleet
 */
class Fleet extends BaseController
{
    /**
     * GET /fleet
     * Halaman daftar armada Jeep
     */
    public function index(): string
    {
        // Data armada — statis (akan diganti dari DB saat model tersedia)
        $fleet = [
            [
                'id'           => 1,
                'name'         => 'Batur Commander',
                'plate'        => 'DK 1945 AB',
                'color'        => 'Classic White',
                'color_code'   => '#E8E8E8',
                'status'       => 'available',
                'passengers'   => 3,
                'image'        => 'fleet-commander.jpg',
                'year'         => 2019,
                'type'         => 'Jeep Wrangler JL',
                'facilities'   => ['Rollbar', 'Safety Belt', 'First Aid Kit', 'USB Charger'],
                'description'  => 'The original Batur legend. Spacious, reliable, and iconic — this classic white Wrangler has guided hundreds of sunrise seekers safely to the rim.',
                'is_featured'  => true,
            ],
            [
                'id'           => 2,
                'name'         => 'Lava Scout',
                'plate'        => 'DK 2024 XY',
                'color'        => 'Matte Onyx',
                'color_code'   => '#2a2a2a',
                'status'       => 'available',
                'passengers'   => 3,
                'image'        => 'fleet-scout.jpg',
                'year'         => 2021,
                'type'         => 'Jeep Wrangler Rubicon',
                'facilities'   => ['Rollbar', 'Safety Belt', 'First Aid Kit', 'GoPro Mount'],
                'description'  => 'Built for the harshest terrain. With a reinforced rollcage and maximum off-road capability, the Lava Scout dominates every volcanic trail.',
                'is_featured'  => true,
            ],
            [
                'id'           => 3,
                'name'         => 'Summit Raider',
                'plate'        => 'DK 777 ZV',
                'color'        => 'Forest Green',
                'color_code'   => '#2D6A4F',
                'status'       => 'available',
                'passengers'   => 3,
                'image'        => 'fleet-raider.jpg',
                'year'         => 2022,
                'type'         => 'Jeep Wrangler Sport',
                'facilities'   => ['Rollbar', 'Safety Belt', 'Snorkel Kit', 'LED Light Bar'],
                'description'  => 'Our newest addition, finished in forest green with premium upgrades — LED light bar, snorkel kit, and reinforced suspension for the toughest lava fields.',
                'is_featured'  => false,
            ],
            [
                'id'           => 4,
                'name'         => 'Caldera King',
                'plate'        => 'DK 5501 JK',
                'color'        => 'Desert Sand',
                'color_code'   => '#C2955D',
                'status'       => 'available',
                'passengers'   => 3,
                'image'        => 'fleet-king.jpg',
                'year'         => 2020,
                'type'         => 'Jeep Wrangler Sahara',
                'facilities'   => ['Rollbar', 'Safety Belt', 'First Aid Kit', 'Cooler Box'],
                'description'  => 'The Sahara edition — perfect for longer expeditions. Comes with a built-in cooler box and premium sound system for those golden-hour caldera moments.',
                'is_featured'  => false,
            ],
            [
                'id'           => 5,
                'name'         => 'Volcano Rider',
                'plate'        => 'DK 3303 VR',
                'color'        => 'Midnight Black',
                'color_code'   => '#1a1a1a',
                'status'       => 'rented',
                'passengers'   => 3,
                'image'        => 'fleet-commander.jpg',
                'year'         => 2020,
                'type'         => 'Jeep Wrangler Sport',
                'facilities'   => ['Rollbar', 'Safety Belt', 'First Aid Kit'],
                'description'  => 'Sleek in midnight black with a reinforced chassis, the Volcano Rider is a crowd favourite for the classic sunrise offroad route.',
                'is_featured'  => false,
            ],
        ];

        // Safety features (shared) — untuk section "Safety Standards"
        $safety_features = [
            [
                'icon'  => 'fa-shield-halved',
                'title' => 'Certified Rollbars',
                'desc'  => 'All jeeps feature ASTM-certified steel rollbars tested to withstand 3x vehicle weight.',
            ],
            [
                'icon'  => 'fa-wrench',
                'title' => 'Weekly Maintenance',
                'desc'  => 'Every vehicle undergoes full mechanical inspection before each expedition day.',
            ],
            [
                'icon'  => 'fa-kit-medical',
                'title' => 'First Aid Onboard',
                'desc'  => 'Certified first-aid kits and emergency gear are carried in all vehicles.',
            ],
            [
                'icon'  => 'fa-user-shield',
                'title' => 'Licensed Drivers',
                'desc'  => 'All drivers hold valid SIM B1 and have completed advanced off-road training.',
            ],
        ];

        $data = [
            'title'            => 'Our Fleet — Batur Jeep Experience',
            'meta_description'  => 'Armada Jeep offroad premium di Gunung Batur Kintamani Bali. Semua kendaraan terawat, berlisensi, dan dilengkapi fasilitas keselamatan lengkap.',
            'fleet'            => $fleet,
            'safety_features'  => $safety_features,
            'available_count'  => count(array_filter($fleet, fn($v) => $v['status'] === 'available')),
        ];

        return view('fleet/index', $data);
    }
}
