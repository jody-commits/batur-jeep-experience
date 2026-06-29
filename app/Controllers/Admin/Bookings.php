<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BookingModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Controller: Admin\Bookings
 * Admin Area: Manage Bookings
 */
class Bookings extends BaseController
{
    protected BookingModel $bookingModel;

    public function __construct()
    {
        $this->bookingModel = new BookingModel();
    }

    public function index(): string
    {
        $adminName = session()->get('user_name') ?? 'Administrator';

        // Ambil data statistik riil dari database
        $stats = $this->bookingModel->getAdminStats();

        // Ambil semua booking beserta detail paket
        $dbBookings = $this->bookingModel->getAllBookingsWithDetails();

        // Format data agar sesuai dengan View yang sudah ada
        $bookings = [];
        foreach ($dbBookings as $b) {
            $bookings[] = [
                'id_raw'     => $b['id'], // untuk form update status
                'id'         => $b['booking_code'],
                'guest'      => $b['customer_name'],
                'email'      => $b['customer_email'] ?? '-',
                'phone'      => $b['customer_phone'] ?? '-',
                'hotel'      => !empty($b['hotel_name']) ? $b['hotel_name'] : 'None/Self Transport',
                'notes'      => !empty($b['notes']) ? $b['notes'] : '-',
                'expedition' => $b['package_name'],
                'date'       => date('d M Y', strtotime($b['tour_date'])),
                'date_raw'   => date('Y-m-d', strtotime($b['tour_date'])),
                'created_at' => date('d M Y • H:i', strtotime($b['created_at'])),
                'pax'        => $b['total_persons'],
                'price'      => 'Rp ' . number_format((float) $b['total_price'], 0, ',', '.'),
                'status'     => ucfirst($b['status']), // 'Pending', 'Confirmed', dll.
            ];
        }

        return view('admin/bookings', [
            'page_title' => 'Manage Bookings',
            'admin_name' => $adminName,
            'stats'      => $stats,
            'bookings'   => $bookings,
        ]);
    }

    /**
     * POST /admin/bookings/update-status/(:num)
     * Mengubah status booking
     */
    public function updateStatus(int $id): RedirectResponse
    {
        $status = $this->request->getPost('status');
        
        $validStatuses = ['pending', 'confirmed', 'completed', 'cancelled', 'rejected'];
        if (!in_array($status, $validStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $adminId = session()->get('user_id');

        $dataUpdate = [
            'status' => $status
        ];

        // Jika confirmed, rekam admin yang confirm dan jam nya
        if ($status === 'confirmed') {
            $dataUpdate['confirmed_by'] = $adminId;
            $dataUpdate['confirmed_at'] = date('Y-m-d H:i:s');
        }

        $this->bookingModel->update($id, $dataUpdate);

        return redirect()->back()->with('success', 'Status booking berhasil diubah menjadi ' . ucfirst($status) . '.');
    }
}