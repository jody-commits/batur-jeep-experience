<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

/**
 * Controller: Admin\Dashboard
 * Admin Area: Dashboard Overview
 */
class Dashboard extends BaseController
{
    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        // For development/testing, we can comment this out or bypass it
        /*
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth/login')->with('error', 'Silakan login sebagai admin terlebih dahulu.');
        }
        */

        $adminName = session()->get('user_name') ?? 'Administrator';

        // Dummy data corresponding to Admin Dashboard - Standardized.png
        $stats = [
            'revenue' => 'IDR 142.5M',
            'revenue_trend' => '+12%',
            'bookings' => 842,
            'bookings_trend' => '+5%',
            'users' => '1,240',
            'users_trend' => '-2%',
            'fleet' => '18/24',
            'fleet_trend' => 'Stable',
        ];

        $pendingConfirmations = [
            [
                'client_name' => 'John Doe',
                'client_type' => 'US Citizen',
                'client_initials' => 'JD',
                'client_bg' => '#fcd34d', // amber-300
                'package' => 'Sunrise Tour',
                'date' => 'Oct 26, 2024',
                'status' => 'Pending',
            ],
            [
                'client_name' => 'Li Wei',
                'client_type' => 'CN Citizen',
                'client_initials' => 'LW',
                'client_bg' => '#93c5fd', // blue-300
                'package' => 'Sunset Crater',
                'date' => 'Oct 25, 2024',
                'status' => 'Confirmed',
            ],
        ];

        return view('admin/dashboard', [
            'title' => 'Dashboard Overview — Batur Jeep Admin',
            'admin_name' => $adminName,
            'stats' => $stats,
            'pending_confirmations' => $pendingConfirmations,
        ]);
    }
}