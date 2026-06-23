<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

/**
 * Controller: Auth
 *
 * Menangani autentikasi pengguna:
 *   - GET  /auth/login    → form login
 *   - POST /auth/login    → proses login
 *   - GET  /auth/register → form register
 *   - POST /auth/register → proses register
 *   - GET  /auth/logout   → logout
 *
 * Keamanan:
 *   - CSRF otomatis via CI4 Security (csrf_field() di view)
 *   - CI4 Form Validation (server-side)
 *   - password_hash() / password_verify() (bcrypt cost 12)
 *   - CI4 Session untuk state login
 *   - Redirect guard: user yang sudah login diarahkan ke dashboard
 *
 * @version 1.0.0
 */
class Auth extends BaseController
{
    /** @var UserModel */
    protected UserModel $userModel;

    // ── Constructor ────────────────────────────────────────
    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // ═══════════════════════════════════════════════════════
    // LOGIN
    // ═══════════════════════════════════════════════════════

    /**
     * GET /auth/login
     * Tampilkan form login.
     */
    public function login(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        // Guard: sudah login → redirect ke dashboard
        if ($this->isLoggedIn()) {
            return $this->redirectToDashboard();
        }

        return view('auth/login', [
            'title'            => 'Login — Batur Jeep Experience',
            'meta_description' => 'Login ke Batur Jeep Experience untuk mengelola booking wisata Jeep offroad Gunung Batur, Kintamani.',
        ]);
    }

    /**
     * POST /auth/login
     * Proses form login, validasi kredensial, set session.
     */
    public function loginPost(): \CodeIgniter\HTTP\RedirectResponse
    {
        // Guard: sudah login
        if ($this->isLoggedIn()) {
            return $this->redirectToDashboard();
        }

        // ── CI4 Form Validation ─────────────────────────────
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[1]',
        ];

        $messages = [
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
            ],
            'password' => [
                'required' => 'Password wajib diisi.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ── Ambil data dari form ────────────────────────────
        $email    = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        $remember = (bool) $this->request->getPost('remember');

        // ── Cek email di database ───────────────────────────
        $user = $this->userModel->findByEmail($email);

        if (! $user) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email tidak terdaftar. Silakan periksa kembali atau daftar akun baru.');
        }

        // ── Verifikasi password ─────────────────────────────
        if (! $this->userModel->verifyPassword($password, $user['password'])) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Password yang Anda masukkan salah. Silakan coba lagi.');
        }

        // ── Cek status akun ─────────────────────────────────
        if (! $user['is_active']) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Akun Anda telah dinonaktifkan. Hubungi admin di info@baturjeep.com.');
        }

        // ── Set session ─────────────────────────────────────
        $this->setUserSession($user);

        // ── Remember me (30 hari) ───────────────────────────
        if ($remember) {
            // Set session expiration ke 30 hari
            session()->set('remember_me', true);
            // Note: untuk implementasi full remember-me, gunakan token DB
            // Di sini kita extend session expiry saja
            ini_set('session.cookie_lifetime', (string)(60 * 60 * 24 * 30));
        }

        // ── Redirect berdasarkan role ───────────────────────
        return $this->redirectToDashboard();
    }

    // ═══════════════════════════════════════════════════════
    // REGISTER
    // ═══════════════════════════════════════════════════════

    /**
     * GET /auth/register
     * Tampilkan form registrasi.
     */
    public function register(): string|\CodeIgniter\HTTP\RedirectResponse
    {
        // Guard: sudah login
        if ($this->isLoggedIn()) {
            return $this->redirectToDashboard();
        }

        return view('auth/register', [
            'title'            => 'Daftar Akun — Batur Jeep Experience',
            'meta_description' => 'Daftar akun Batur Jeep Experience dan mulai booking wisata Jeep offroad terbaik di Kintamani, Bali.',
        ]);
    }

    /**
     * POST /auth/register
     * Proses form register, validasi input, simpan user baru.
     */
    public function registerPost(): \CodeIgniter\HTTP\RedirectResponse
    {
        // Guard: sudah login
        if ($this->isLoggedIn()) {
            return $this->redirectToDashboard();
        }

        // ── CI4 Form Validation ─────────────────────────────
        $rules = [
            'name'        => 'required|min_length[3]|max_length[100]',
            'email'       => 'required|valid_email|max_length[150]|is_unique[users.email]',
            'phone'       => 'required|min_length[9]|max_length[15]',
            'password'    => 'required|min_length[8]|max_length[255]',
            'agree_terms' => 'required',
        ];

        $messages = [
            'name' => [
                'required'   => 'Nama lengkap wajib diisi.',
                'min_length' => 'Nama minimal 3 karakter.',
                'max_length' => 'Nama maksimal 100 karakter.',
            ],
            'email' => [
                'required'    => 'Email wajib diisi.',
                'valid_email' => 'Format email tidak valid.',
                'is_unique'   => 'Email ini sudah terdaftar. Silakan login atau gunakan email lain.',
            ],
            'phone' => [
                'required'   => 'Nomor WhatsApp wajib diisi.',
                'min_length' => 'Nomor telepon minimal 9 digit.',
                'max_length' => 'Nomor telepon maksimal 15 digit.',
            ],
            'password' => [
                'required'   => 'Password wajib diisi.',
                'min_length' => 'Password minimal 8 karakter.',
            ],
            'agree_terms' => [
                'required' => 'Anda harus menyetujui syarat dan ketentuan untuk mendaftar.',
            ],
        ];

        if (! $this->validate($rules, $messages)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        // ── Sanitasi & persiapan data ───────────────────────
        $name     = trim($this->request->getPost('name'));
        $email    = strtolower(trim($this->request->getPost('email')));
        $phone    = preg_replace('/[^0-9]/', '', $this->request->getPost('phone')); // strip non-numeric
        $password = $this->request->getPost('password');

        // ── Simpan user baru (password di-hash via Model callback) ──
        $inserted = $this->userModel->insert([
            'name'      => $name,
            'email'     => $email,
            'password'  => $password, // akan di-hash oleh beforeInsert callback
            'phone'     => $phone,
            'role'      => 'user',
            'is_active' => 1,
        ]);

        if (! $inserted) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
        }

        // ── Login otomatis setelah register ────────────────
        $newUser = $this->userModel->find($inserted);
        $this->setUserSession($newUser);

        // ── Redirect ke dashboard user ──────────────────────
        return redirect()
            ->to(base_url('user/dashboard'))
            ->with('success', 'Selamat datang, ' . esc($name) . '! Akun Anda berhasil dibuat. 🎉');
    }

    // ═══════════════════════════════════════════════════════
    // LOGOUT
    // ═══════════════════════════════════════════════════════

    /**
     * GET /auth/logout
     * Hapus session dan redirect ke halaman login.
     */
    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        // Hapus semua data session user
        session()->remove(['user_id', 'user_name', 'user_email', 'user_role', 'remember_me']);
        session()->destroy();

        return redirect()
            ->to(base_url('auth/login'))
            ->with('success', 'Anda berhasil logout. Sampai jumpa! 👋');
    }

    // ═══════════════════════════════════════════════════════
    // HELPER METHODS (PRIVATE)
    // ═══════════════════════════════════════════════════════

    /**
     * Cek apakah user sedang login.
     *
     * @return bool
     */
    private function isLoggedIn(): bool
    {
        return (bool) session()->get('user_id');
    }

    /**
     * Set data session setelah login/register berhasil.
     *
     * @param array $user Row dari tabel users
     */
    private function setUserSession(array $user): void
    {
        session()->set([
            'user_id'    => $user['id'],
            'user_name'  => $user['name'],
            'user_email' => $user['email'],
            'user_role'  => $user['role'],
            'logged_in'  => true,
        ]);
    }

    /**
     * Redirect ke dashboard berdasarkan role user.
     *
     * @return \CodeIgniter\HTTP\RedirectResponse
     */
    private function redirectToDashboard(): \CodeIgniter\HTTP\RedirectResponse
    {
        $role = session()->get('user_role');

        if ($role === 'admin') {
            return redirect()->to(base_url('admin'));
        }

        return redirect()->to(base_url('user/dashboard'));
    }
}
