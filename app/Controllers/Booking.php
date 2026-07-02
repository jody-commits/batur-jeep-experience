<?php

namespace App\Controllers;

use App\Models\PackageModel;
use App\Models\BookingModel;
use CodeIgniter\HTTP\RedirectResponse;

/**
 * Controller: Booking
 * Menangani alur pemesanan — form booking dan konfirmasi
 */
class Booking extends BaseController
{
    protected PackageModel $packageModel;
    protected BookingModel $bookingModel;

    public function __construct()
    {
        $this->packageModel = new PackageModel();
        $this->bookingModel = new BookingModel();
    }

    /**
     * GET /booking
     * Tampilkan form booking "Book Your Adventure"
     * Query param: ?package=1 untuk pre-select paket
     */
    public function index(): string
    {
        // Ambil data paket aktif dari database
        $dbPackages = $this->packageModel->getActivePackages();
        
        // Format array agar key-nya adalah ID paket supaya mudah diakses di View
        $packages = [];
        foreach ($dbPackages as $pkg) {
            // Karena di DB tidak ada array included, kita mock untuk UI
            $pkg['included'] = ['Private English Speaking Driver', 'Professional Jeep Equipment'];
            if ($pkg['is_pickup'] == 1) {
                $pkg['included'][] = 'Breakfast & Coffee Included';
                $pkg['pickup_type'] = 'hotel';
            } else {
                $pkg['pickup_type'] = 'meeting';
            }
            // Fallback for image
            $pkg['image'] = $pkg['thumbnail'] ?? 'batur-sunrise-hero.png';
            $packages[$pkg['id']] = $pkg;
        }

        // Ambil paket yang dipilih (query param ?package=ID)
        $packageId = (int) ($this->request->getGet('package') ?? 1);
        if (!isset($packages[$packageId])) {
            $packageId = array_key_first($packages) ?? 1;
        }
        $selectedPackage = $packages[$packageId] ?? null;

        $data = [
            'title'            => 'Book Your Adventure — Batur Jeep Experience',
            'meta_description' => 'Reservasi wisata jeep offroad Gunung Batur Kintamani Bali. Pilih paket, isi data, konfirmasi — mudah dan cepat.',
            'packages'         => $packages,
            'selected'         => $selectedPackage,
            'selectedId'       => $packageId,
        ];

        return view('booking/index', $data);
    }

    /**
     * POST /booking
     * Proses form booking — simpan ke database dan redirect ke confirm
     */
    public function store(): RedirectResponse
    {
        // 1. Validasi input form
        $rules = [
            'full_name'   => 'required|min_length[3]|max_length[100]',
            'whatsapp'    => 'required|min_length[8]|max_length[20]',
            'email'       => 'required|valid_email',
            'tour_date'   => 'required',
            'num_guests'  => 'required|integer|greater_than[0]',
            'package_id'  => 'required|integer',
        ];

        if ($this->request->getPost('need_pickup')) {
            $rules['hotel_name'] = 'required|min_length[3]|max_length[255]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Ambil data input
        $packageId  = (int) $this->request->getPost('package_id');
        $numGuests  = (int) $this->request->getPost('num_guests');
        $needPickup = (bool) $this->request->getPost('need_pickup');
        $tourDate   = $this->request->getPost('tour_date');
        $hotelName  = $this->request->getPost('hotel_name');
        
        // 3. Ambil data paket dari DB untuk hitung harga valid
        $package = $this->packageModel->find($packageId);
        if (!$package) {
            return redirect()->back()->withInput()->with('error', 'Paket wisata tidak valid.');
        }

        // 4. Hitung Harga
        // Sesuai requirement: Harga adalah per booking / flat rate
        $basePrice  = (float) $package['price'];
        
        // Jika kapasitas max adalah 3 per jeep, kita hitung jumlah jeep (opsional, tergantung bisnis)
        // Disini kita asumsi 1 booking = 1 paket = 1 basePrice dikali jumlah jeep (maks kapasitas per jeep dari bisnis rule, misal 3)
        $pricingType = $package['pricing_type'] ?? 'per_jeep';
        $maxPerJeep = (int) ($package['max_persons'] ?? 3);
        if ($maxPerJeep <= 0) $maxPerJeep = 3;
        
        if ($pricingType === 'per_pax') {
            $multiplier = $numGuests;
        } else {
            $multiplier = (int) ceil($numGuests / $maxPerJeep);
        }
        $totalPrice = $basePrice * $multiplier;

        // 5. Generate nomor referensi unik (Booking Code)
        $refDate = date('Ymd');
        $refSeq  = str_pad((string) rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $refCode = 'BJE-' . $refDate . '-' . $refSeq;

        // 6. Dapatkan ID user yang login (jika ada), jika tidak, gunakan ID default pelanggan umum
        $userId = session()->get('user_id');
        if (!$userId) {
            // Fallback: Jika guest booking, pastikan ada mekanisme (misal user id 1 atau disesuaikan schema)
            // Di schema `user_id` is NOT NULL, jadi kita cari user dengan email tersebut atau assign default guest id
            $userModel = new \App\Models\UserModel();
            $email = $this->request->getPost('email');
            $user = $userModel->where('email', $email)->first();
            if ($user) {
                $userId = $user['id'];
            } else {
                // Buat guest user
                $userId = $userModel->insert([
                    'name' => $this->request->getPost('full_name'),
                    'email' => $email,
                    'password' => password_hash('guest123', PASSWORD_BCRYPT), // dummy
                    'phone' => $this->request->getPost('whatsapp'),
                    'role' => 'user',
                    'is_active' => 1
                ]);
            }
        }

        // 7. Simpan ke database
        $bookingData = [
            'booking_code'   => $refCode,
            'user_id'        => $userId,
            'package_id'     => $packageId,
            'customer_name'  => $this->request->getPost('full_name'),
            'customer_phone' => $this->request->getPost('whatsapp'),
            'customer_email' => $this->request->getPost('email'),
            'hotel_name'     => $needPickup ? $hotelName : null,
            'tour_date'      => $tourDate,
            'total_persons'  => $numGuests,
            'total_price'    => $totalPrice,
            'status'         => 'pending',
            'notes'          => ($pricingType === 'per_pax') ? 'Jumlah Pax: ' . $multiplier : 'Jumlah Jeep: ' . $multiplier,
        ];

        $this->bookingModel->insert($bookingData);

        // 8. Redirect ke halaman konfirmasi dengan flashdata
        return redirect()->to("booking/confirm/$refCode");
    }

    /**
     * GET /booking/confirm/(:segment)
     * Halaman konfirmasi / sukses setelah booking
     */
    public function confirm(string $bookingCode = null): string|RedirectResponse
    {
        if (!$bookingCode) {
            return redirect()->to('booking');
        }

        $booking = $this->bookingModel->getBookingWithPackage($bookingCode);

        if (!$booking) {
            return redirect()->to('booking')->with('error', 'Data booking tidak ditemukan.');
        }

        // Format data untuk disesuaikan dengan view konfirmasi yang sudah ada
        $bookingData = [
            'ref_code'       => $booking['booking_code'],
            'package_name'   => $booking['package_name'],
            'full_name'      => $booking['customer_name'],
            'whatsapp'       => $booking['customer_phone'],
            'email'          => $booking['customer_email'],
            'tour_date'      => $booking['tour_date'],
            'num_guests'     => $booking['total_persons'],
            'need_pickup'    => !empty($booking['hotel_name']),
            'total_price'    => $booking['total_price'],
            'pickup_note'    => !empty($booking['hotel_name']) ? '03:30 AM (Hotel: ' . $booking['hotel_name'] . ')' : '04:00 AM (Meeting Point)',
            'status'         => $booking['status'],
            'payment_status' => 'Pending Payment',
            'created_at'     => $booking['created_at'],
        ];

        $data = [
            'title'            => 'Booking Submitted! — Batur Jeep Experience',
            'meta_description' => 'Booking jeep Batur kamu berhasil! Cek detail reservasi dan referensi pemesanan kamu.',
            'booking'          => $bookingData,
        ];

        return view('booking/confirm', $data);
    }
}