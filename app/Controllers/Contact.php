<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

/**
 * Controller: Contact
 * Menangani halaman Contact Us dan pengiriman pesan
 */
class Contact extends BaseController
{
    /**
     * GET /contact
     */
    public function index(): string
    {
        $subjects = [
            'booking'   => 'Booking Inquiry',
            'packages'  => 'Package Information',
            'fleet'     => 'Fleet Information',
            'safety'    => 'Safety & Guidelines',
            'other'     => 'Other',
        ];

        $data = [
            'title'            => 'Contact Us — Batur Jeep Experience',
            'meta_description' => 'Hubungi Batur Jeep Experience untuk pertanyaan, pemesanan, atau informasi paket wisata offroad Gunung Batur, Kintamani, Bali.',
            'subjects'         => $subjects,
            'success'          => session()->getFlashdata('success'),
            'errors'           => session()->getFlashdata('errors'),
        ];

        return view('contact/index', $data);
    }

    /**
     * POST /contact
     */
    public function send(): RedirectResponse
    {
        $rules = [
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email',
            'whatsapp'  => 'permit_empty|max_length[20]',
            'subject'   => 'required|in_list[booking,packages,fleet,safety,other]',
            'message'   => 'required|min_length[10]|max_length[2000]',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // Nanti: kirim email / simpan ke DB
        // Untuk saat ini: simpan flash success

        return redirect()
            ->to('contact')
            ->with('success', 'Pesan kamu sudah kami terima! Tim Batur Jeep Experience akan membalas dalam 1×24 jam.');
    }
}
