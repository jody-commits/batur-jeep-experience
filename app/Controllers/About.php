<?php

namespace App\Controllers;

/**
 * Controller: About
 * Menangani halaman About Us
 */
class About extends BaseController
{
    /**
     * GET /about
     */
    public function index(): string
    {
        // Data stats
        $stats = [
            ['value' => '500+', 'label' => 'Guests'],
            ['value' => '4.9', 'label' => 'Rating'],
            ['value' => '7 yrs', 'label' => 'Experience'],
        ];

        // Data features / distinction
        $features = [
            [
                'icon' => 'fa-shield-halved',
                'title' => 'Safety First',
                'desc' => 'All vehicles undergo weekly maintenance checks and all drivers are certified in advanced first-aid.'
            ],
            [
                'icon' => 'fa-leaf',
                'title' => 'Eco-Friendly',
                'desc' => 'We strictly follow \'Leave No Trace\' principles and actively participate in caldera reforestation.'
            ],
            [
                'icon' => 'fa-users',
                'title' => 'Local Community',
                'desc' => 'We directly employ residents of Kintamani, ensuring benefits flow back into our village.'
            ],
        ];

        $data = [
            'title'            => 'About Us — Batur Jeep Experience',
            'meta_description' => 'A local family-run adventure company dedicated to showing you the raw beauty of Bali\'s volcanic heart.',
            'stats'            => $stats,
            'features'         => $features,
        ];

        return view('about/index', $data);
    }
}
