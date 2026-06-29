<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;

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

        $bookingModel = new BookingModel();
        $userModel = new UserModel();

        // Calculate Revenue
        $db = \Config\Database::connect();
        $revenueRow = $db->query("SELECT SUM(total_price) as revenue FROM bookings WHERE status IN ('confirmed', 'completed') AND deleted_at IS NULL")->getRowArray();
        $revenue = $revenueRow['revenue'] ?? 0;

        // Calculate Bookings
        $bookingsCount = $bookingModel->where('deleted_at', null)->countAllResults();

        // Calculate Users
        $usersCount = $userModel->where('role', 'user')->where('deleted_at', null)->countAllResults();

        $stats = [
            'revenue' => 'IDR ' . number_format((float) $revenue, 0, ',', '.'),
            'revenue_trend' => '+0%',
            'bookings' => $bookingsCount,
            'bookings_trend' => '+0%',
            'users' => number_format($usersCount),
            'users_trend' => '+0%',
            'fleet' => '-',
            'fleet_trend' => '-',
        ];

        // Fetch recent pending bookings
        $pendingBookings = $bookingModel->select('bookings.*, packages.name as package_name')
            ->join('packages', 'packages.id = bookings.package_id', 'left')
            ->where('bookings.status', 'pending')
            ->orderBy('bookings.created_at', 'DESC')
            ->limit(5)
            ->findAll();

        $pendingConfirmations = [];
        $colors = ['#fcd34d', '#93c5fd', '#fca5a5', '#c4b5fd', '#86efac'];
        foreach ($pendingBookings as $i => $pb) {
            $names = explode(' ', trim($pb['customer_name']));
            $initials = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
            $pendingConfirmations[] = [
                'id' => $pb['id'],
                'client_name' => $pb['customer_name'],
                'client_type' => 'Guest',
                'client_initials' => $initials,
                'client_bg' => $colors[$i % count($colors)],
                'package' => $pb['package_name'] ?? 'Unknown Package',
                'date' => date('M d, Y', strtotime($pb['tour_date'])),
                'status' => 'Pending',
            ];
        }

        return view('admin/dashboard', [
            'title' => 'Dashboard Overview — Batur Jeep Admin',
            'admin_name' => $adminName,
            'stats' => $stats,
            'pending_confirmations' => $pendingConfirmations,
        ]);
    }
}