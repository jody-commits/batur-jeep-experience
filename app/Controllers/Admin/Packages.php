<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Controller: Admin\Packages
 * Admin Area: Manage Packages
 */
class Packages extends BaseController
{
    public function index(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';

        $stats = [
            'total' => 12,
            'active' => 8,
            'pickup' => 6,
        ];

        $packages = [
            [
                'title' => 'Sunrise Batur Expedition',
                'price' => '$85',
                'desc' => 'The ultimate off-road experience witnessing the sunrise over Mount Batur...',
                'duration' => '5 Hours',
                'guests' => 'Max 4 guests',
                'image' => 'sunrise-jeep.jpg',
            ],
            [
                'title' => 'Black Lava Offroad',
                'price' => '$65',
                'desc' => 'A technical drive through the frozen lava flows, exploring the rugged...',
                'duration' => '3 Hours',
                'guests' => 'Max 4 guests',
                'image' => 'black-lava.jpg',
            ],
            [
                'title' => 'Lake Side Camping',
                'price' => '$120',
                'desc' => 'Overnight premium camping experience by the shores of Lake Batur...',
                'duration' => '18 Hours',
                'guests' => 'Max 2 guests',
                'image' => 'camping.jpg',
            ],
            [
                'title' => 'Custom Private Charter',
                'price' => '$150',
                'desc' => 'Tailor-made itinerary for groups up to 4, including any destination within the...',
                'duration' => '8 Hours',
                'guests' => 'Max 4 guests',
                'image' => 'custom-tour.jpg',
            ],
        ];

        return view('admin/packages', [
            'page_title' => 'Manage Packages',
            'admin_name' => $adminName,
            'stats' => $stats,
            'packages' => $packages,
        ]);
    }
}