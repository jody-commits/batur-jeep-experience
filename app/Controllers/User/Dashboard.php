<?php

declare(strict_types=1);

namespace App\Controllers\User;

use App\Controllers\BaseController;

/**
 * Controller: User\Dashboard
 * Customer Area: Dashboard, Bookings, Profile
 */
class Dashboard extends BaseController
{
    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $recentBookings = [
            ['booking_code' => 'BJE-2024-8831', 'package_name' => 'Sunrise Black Lava Tour',    'tour_date' => 'Oct 24, 2024', 'status' => 'confirmed', 'image' => 'sunrise.jpg'],
            ['booking_code' => 'BJE-2024-7102', 'package_name' => 'Kintamani Highland Drive',   'tour_date' => 'Nov 12, 2024', 'status' => 'pending',   'image' => 'offroad.jpg'],
        ];

        return view('user/dashboard', [
            'title'           => 'Dashboard — Batur Jeep Experience',
            'user_name'       => session()->get('user_name') ?? 'Traveler',
            'total_bookings'  => 12,
            'confirmed'       => 2,
            'recent_bookings' => $recentBookings,
        ]);
    }

    public function bookings(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $filter = $this->request->getGet('status') ?? 'all';

        $allBookings = [
            ['booking_code' => 'BJE-2024-8831', 'package_name' => 'Sunrise Expedition',  'tour_date' => 'Oct 24, 2024', 'booked_on' => 'Oct 12, 2024', 'total_persons' => 3, 'total_price' => 1500000, 'status' => 'confirmed', 'hotel_name' => 'Seminyak Area', 'pickup_time' => '03:30 AM', 'image' => 'sunrise.jpg'],
            ['booking_code' => 'BJE-2024-7102', 'package_name' => 'Black Lava Jeep',     'tour_date' => 'Sep 12, 2024', 'booked_on' => 'Sep 05, 2024', 'total_persons' => 2, 'total_price' => 1200000, 'status' => 'completed', 'hotel_name' => null,             'pickup_time' => null,       'image' => 'offroad.jpg'],
            ['booking_code' => 'BJE-2024-9142', 'package_name' => 'Highland Tour',       'tour_date' => 'Nov 02, 2024', 'booked_on' => 'Oct 28, 2024', 'total_persons' => 4, 'total_price' => 3600000, 'status' => 'pending',   'hotel_name' => null,             'pickup_time' => null,       'image' => 'jeep-kuning.jpg'],
        ];

        $bookings = ($filter !== 'all')
            ? array_values(array_filter($allBookings, fn($b) => $b['status'] === $filter))
            : $allBookings;

        return view('user/bookings', [
            'title'         => 'My Bookings — Batur Jeep Experience',
            'user_name'     => session()->get('user_name') ?? 'Traveler',
            'bookings'      => $bookings,
            'active_filter' => $filter,
        ]);
    }

    public function profile(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        return view('user/profile', [
            'title'        => 'My Profile — Batur Jeep Experience',
            'user_name'    => session()->get('user_name') ?? 'Traveler',
            'user_email'   => session()->get('user_email') ?? '',
            'user_phone'   => session()->get('user_phone') ?? '',
            'total_tours'  => 12,
            'member_since' => 'Nov 2023',
        ]);
    }

    public function profileUpdate(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth/login');
        }
        return redirect()->to('/user/profile')->with('success', 'Profile updated successfully!');
    }
}