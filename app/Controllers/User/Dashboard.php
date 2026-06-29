<?php

declare(strict_types=1);

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use App\Models\UserModel;

/**
 * Controller: User\Dashboard
 * Customer Area: Dashboard, Bookings, Profile
 */
class Dashboard extends BaseController
{
    protected BookingModel $bookingModel;
    protected UserModel $userModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->userModel = new UserModel();
    }

    public function index(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $stats = $this->bookingModel->getUserStats((int)$userId);
        $recentBookings = $this->bookingModel->getUserBookingsWithPackage((int)$userId, 2);

        return view('user/dashboard', [
            'title'           => 'Dashboard — Batur Jeep Experience',
            'user_name'       => session()->get('user_name') ?? 'Traveler',
            'total_bookings'  => $stats['total'],
            'confirmed'       => $stats['confirmed'],
            'pending'         => $stats['pending'],
            'recent_bookings' => $recentBookings,
        ]);
    }

    public function bookings(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $filter = $this->request->getGet('status') ?? 'all';
        $bookings = $this->bookingModel->getUserBookingsWithPackage((int)$userId, 0, $filter);

        return view('user/bookings', [
            'title'         => 'My Bookings — Batur Jeep Experience',
            'user_name'     => session()->get('user_name') ?? 'Traveler',
            'bookings'      => $bookings,
            'active_filter' => $filter,
        ]);
    }

    public function profile(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = $this->userModel->find($userId);
        $stats = $this->bookingModel->getUserStats((int)$userId);
        $memberSince = date('M Y', strtotime($user['created_at']));

        return view('user/profile', [
            'title'        => 'My Profile — Batur Jeep Experience',
            'user_name'    => $user['name'],
            'user_email'   => $user['email'],
            'user_phone'   => $user['phone'],
            'total_tours'  => $stats['total'],
            'member_since' => $memberSince,
        ]);
    }

    public function profileUpdate(): \CodeIgniter\HTTP\RedirectResponse
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/auth/login');
        }

        $rules = [
            'name'  => 'required|min_length[3]|max_length[100]',
            'phone' => 'required|min_length[9]|max_length[20]',
        ];

        // Validate password only if provided
        $password = $this->request->getPost('new_password');
        if (!empty($password)) {
            $rules['new_password'] = 'min_length[8]';
        }

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'  => trim($this->request->getPost('name')),
            'phone' => preg_replace('/[^0-9]/', '', $this->request->getPost('phone')),
        ];

        if (!empty($password)) {
            $data['password'] = $password; // akan dihash otomatis di beforeUpdate UserModel
        }

        if ($this->userModel->update($userId, $data)) {
            session()->set([
                'user_name'  => $data['name'],
                'user_phone' => $data['phone']
            ]);
            return redirect()->to('/user/profile')->with('success', 'Profile updated successfully!');
        }

        return redirect()->to('/user/profile')->with('error', 'Failed to update profile.');
    }
}