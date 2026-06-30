<?php

namespace App\Controllers;

use App\Models\PackageModel;
use App\Models\ReviewModel;

/**
 * Controller: Home
 * Menangani halaman publik: homepage
 */
class Home extends BaseController
{
    /**
     * GET /
     * Halaman utama / homepage
     */
    public function index(): string
    {
        $packageModel = new PackageModel();
        // Fetch top 3 active packages for the homepage
        $dbPackages = $packageModel->getActivePackages();
        $featuredPackages = array_slice($dbPackages, 0, 3); // Take top 3

        $packages = [];
        foreach ($featuredPackages as $pkg) {
            $packages[] = [
                'id'          => $pkg['id'],
                'name'        => $pkg['name'],
                'description' => $pkg['description'],
                'price'       => $pkg['price'],
                'duration'    => $pkg['duration'],
                'is_pickup'   => $pkg['is_pickup'],
                'image'       => $pkg['thumbnail'] ?? 'sunrise.jpg',
            ];
        }

        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->getApprovedReviews();

        $data = [
            'title'            => 'Batur Jeep Experience — Wisata Jeep Offroad Kintamani Bali',
            'meta_description' => 'Wisata Jeep Offroad terbaik di Gunung Batur, Kintamani, Bali. Paket Sunrise, Offroad Adventure,. Booking mudah & aman. Pesan sekarang!',
            'packages'         => $packages,
            'reviews'          => $reviews,
        ];

        return view('home/index', $data);
    }

    public function submitReview()
    {
        $reviewModel = new ReviewModel();
        
        $data = [
            'name'         => $this->request->getPost('reviewer_name'),
            'location'     => $this->request->getPost('reviewer_location'),
            'package_name' => $this->request->getPost('reviewer_package'),
            'rating'       => (int) $this->request->getPost('reviewer_rating'),
            'review_text'  => $this->request->getPost('reviewer_text'),
            'status'       => 'pending' // Admin must approve
        ];

        $reviewModel->insert($data);

        return redirect()->to('/#testimonials-section')->with('success', 'Thank you! Your review has been submitted and is pending approval.');
    }
}