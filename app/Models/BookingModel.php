<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * BookingModel
 *
 * Model untuk mengelola data reservasi/pemesanan.
 */
class BookingModel extends Model
{
    protected $table          = 'bookings';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps  = true;

    protected $allowedFields = [
        'booking_code',
        'user_id',
        'package_id',
        'vehicle_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'hotel_name',
        'tour_date',
        'total_persons',
        'total_price',
        'notes',
        'status',
        'rejection_reason',
        'confirmed_by',
        'confirmed_at',
    ];

    /**
     * Dapatkan detail booking beserta nama paket
     */
    public function getBookingWithPackage(string $bookingCode)
    {
        return $this->select('bookings.*, packages.name as package_name, packages.is_pickup')
                    ->join('packages', 'packages.id = bookings.package_id')
                    ->where('bookings.booking_code', $bookingCode)
                    ->first();
    }

    /**
     * Dapatkan semua booking untuk admin dengan join ke tabel packages
     */
    public function getAllBookingsWithDetails(): array
    {
        return $this->select('bookings.*, packages.name as package_name')
                    ->join('packages', 'packages.id = bookings.package_id')
                    ->orderBy('bookings.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Dapatkan statistik untuk dashboard admin
     */
    public function getAdminStats(): array
    {
        $db = \Config\Database::connect();
        
        // Menghindari count() pada findAll untuk performa lebih baik
        $total = $this->where('deleted_at', null)->countAllResults();
        $pending = $this->where('status', 'pending')->countAllResults();
        $confirmed = $this->where('status', 'confirmed')->countAllResults();
        $completed = $this->where('status', 'completed')->countAllResults();

        return [
            'total'     => $total,
            'pending'   => $pending,
            'confirmed' => $confirmed,
            'completed' => $completed,
        ];
    }

    /**
     * Dapatkan statistik booking untuk customer (user) tertentu
     */
    public function getUserStats(int $userId): array
    {
        $total = $this->where('user_id', $userId)->where('deleted_at', null)->countAllResults();
        $pending = $this->where('user_id', $userId)->where('status', 'pending')->countAllResults();
        $confirmed = $this->where('user_id', $userId)->where('status', 'confirmed')->countAllResults();

        return [
            'total'     => $total,
            'pending'   => $pending,
            'confirmed' => $confirmed,
        ];
    }

    /**
     * Dapatkan daftar booking customer beserta nama paketnya
     */
    public function getUserBookingsWithPackage(int $userId, int $limit = 0, string $status = 'all'): array
    {
        $builder = $this->select('bookings.*, packages.name as package_name, packages.thumbnail as image')
                        ->join('packages', 'packages.id = bookings.package_id')
                        ->where('bookings.user_id', $userId);
        
        if ($status !== 'all') {
            $builder->where('bookings.status', $status);
        }
        
        $builder->orderBy('bookings.created_at', 'DESC');
        
        if ($limit > 0) {
            $builder->limit($limit);
        }
        
        return $builder->findAll();
    }
}