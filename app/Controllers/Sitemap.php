<?php

namespace App\Controllers;

use App\Models\PackageModel;

class Sitemap extends BaseController
{
    public function index()
    {
        $packageModel = new PackageModel();
        $packages = $packageModel->getActivePackages();

        $urls = [
            [
                'loc' => base_url(),
                'priority' => '1.0',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => base_url('packages'),
                'priority' => '0.9',
                'changefreq' => 'weekly'
            ],
            [
                'loc' => base_url('booking'),
                'priority' => '0.8',
                'changefreq' => 'monthly'
            ],
            [
                'loc' => base_url('about'),
                'priority' => '0.7',
                'changefreq' => 'monthly'
            ],
            [
                'loc' => base_url('contact'),
                'priority' => '0.7',
                'changefreq' => 'monthly'
            ]
        ];

        // If we want to index individual package booking links
        foreach ($packages as $pkg) {
            $urls[] = [
                'loc' => base_url('booking?package=' . $pkg['id']),
                'priority' => '0.6',
                'changefreq' => 'monthly'
            ];
        }

        $data = [
            'urls' => $urls
        ];

        return $this->response->setContentType('text/xml')->setBody(view('sitemap/index', $data));
    }
}
