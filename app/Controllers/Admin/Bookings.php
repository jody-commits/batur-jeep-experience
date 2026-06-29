<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Controller: Admin\Bookings
 * Admin Area: Manage Bookings
 */
class Bookings extends BaseController
{
    public function index(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';

        // Dummy data
        $stats = [
            'total' => 17,
            'pending' => 5,
            'confirmed' => 12,
            'completed' => 8,
        ];

        $bookings = [
            [
                'id' => 'BJE-20260611-0001',
                'guest' => 'Budi Santoso',
                'expedition' => 'Sunrise Batur',
                'date' => '15 Jun 2026',
                'pax' => 2,
                'status' => 'Pending',
            ],
            [
                'id' => 'BJE-20260610-0002',
                'guest' => 'Sarah Lee',
                'expedition' => 'Offroad Full Day',
                'date' => '20 Jun 2026',
                'pax' => 3,
                'status' => 'Confirmed',
            ],
            [
                'id' => 'BJE-20260609-0003',
                'guest' => 'Made Ari',
                'expedition' => 'Private Trip',
                'date' => '22 Jun 2026',
                'pax' => 4,
                'status' => 'Completed',
            ],
        ];

        return view('admin/bookings', [
            'page_title' => 'Manage Bookings',
            'admin_name' => $adminName,
            'stats' => $stats,
            'bookings' => $bookings,
        ]);
    }
}