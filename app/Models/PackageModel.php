<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * PackageModel
 *
 * Model untuk mengelola data paket wisata Jeep.
 */
class PackageModel extends Model
{
    protected $table          = 'packages';
    protected $primaryKey     = 'id';
    protected $returnType     = 'array';
    protected $useSoftDeletes = true;
    protected $useTimestamps  = true;

    protected $allowedFields = [
        'name',
        'description',
        'price',
        'pricing_type',
        'min_persons',
        'max_persons',
        'duration',
        'pickup_time',
        'is_pickup',
        'thumbnail',
        'image2',
        'image3',
        'image4',
        'is_active',
    ];

    /**
     * Ambil semua paket yang aktif
     */
    public function getActivePackages(): array
    {
        return $this->where('is_active', 1)
                    ->orderBy('id', 'ASC')
                    ->findAll();
    }
}