<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

/**
 * UserModel
 *
 * Model untuk tabel `users`.
 * Mengelola data akun pelanggan dan administrator.
 *
 * Fitur:
 *   - Soft delete via $useSoftDeletes = true
 *   - Bcrypt hash password otomatis via beforeInsert/beforeUpdate
 *   - Kolom protected: password tidak dikembalikan secara default saat findAll
 *
 * @version 1.0.0
 */
class UserModel extends Model
{
    /** @var string Nama tabel */
    protected $table = 'users';

    /** @var string Primary key */
    protected $primaryKey = 'id';

    /** @var string Tipe return: array atau object */
    protected $returnType = 'array';

    /** @var bool Aktifkan soft delete */
    protected $useSoftDeletes = true;

    /** @var bool Timestamp otomatis */
    protected $useTimestamps = true;

    // ── Columns ────────────────────────────────────────────
    /** @var array Kolom yang boleh diisi secara massal */
    protected $allowedFields = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
    ];

    // ── Timestamps ─────────────────────────────────────────
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // ── Validation Rules ───────────────────────────────────
    /** @var array Aturan validasi untuk insert/register */
    protected $validationRules = [
        'name'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|max_length[150]|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[8]',
        'phone'    => 'required|min_length[9]|max_length[15]',
        'role'     => 'in_list[user,admin]',
    ];

    /** @var array Pesan validasi custom */
    protected $validationMessages = [
        'name' => [
            'required'   => 'Nama lengkap wajib diisi.',
            'min_length' => 'Nama minimal 3 karakter.',
            'max_length' => 'Nama maksimal 100 karakter.',
        ],
        'email' => [
            'required'    => 'Email wajib diisi.',
            'valid_email' => 'Format email tidak valid.',
            'is_unique'   => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',
        ],
        'password' => [
            'required'   => 'Password wajib diisi.',
            'min_length' => 'Password minimal 8 karakter.',
        ],
        'phone' => [
            'required'   => 'Nomor WhatsApp wajib diisi.',
            'min_length' => 'Nomor telepon terlalu pendek (min 9 digit).',
            'max_length' => 'Nomor telepon terlalu panjang (max 15 digit).',
        ],
    ];

    /** @var bool Skip validasi saat update (bisa override per-method) */
    protected $skipValidation = false;

    // ── Callbacks ──────────────────────────────────────────
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPasswordOnUpdate'];

    // ═══════════════════════════════════════════════════════
    // CALLBACK METHODS
    // ═══════════════════════════════════════════════════════

    /**
     * Hash password sebelum INSERT.
     * Dipanggil otomatis oleh CI4 Model callbacks.
     */
    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash(
                $data['data']['password'],
                PASSWORD_BCRYPT,
                ['cost' => 12]
            );
        }
        return $data;
    }

    /**
     * Hash password sebelum UPDATE — hanya jika field password ada.
     * Dipanggil otomatis oleh CI4 Model callbacks.
     */
    protected function hashPasswordOnUpdate(array $data): array
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash(
                $data['data']['password'],
                PASSWORD_BCRYPT,
                ['cost' => 12]
            );
        } elseif (isset($data['data']['password'])) {
            // Jika password kosong saat update, hapus dari data agar tidak di-update
            unset($data['data']['password']);
        }
        return $data;
    }

    // ═══════════════════════════════════════════════════════
    // QUERY METHODS
    // ═══════════════════════════════════════════════════════

    /**
     * Cari user aktif berdasarkan email.
     * Digunakan saat proses login.
     *
     * @param  string     $email
     * @return array|null Row user atau null jika tidak ditemukan
     */
    public function findByEmail(string $email): ?array
    {
        return $this->where('email', $email)
                    ->where('is_active', 1)
                    ->first();
    }

    /**
     * Verifikasi password user.
     *
     * @param  string $plainPassword Password mentah dari form
     * @param  string $hashedPassword Hash dari database
     * @return bool
     */
    public function verifyPassword(string $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }

    /**
     * Cek apakah email sudah terdaftar (untuk validasi di controller).
     *
     * @param  string $email
     * @return bool
     */
    public function emailExists(string $email): bool
    {
        return $this->where('email', $email)->countAllResults() > 0;
    }

    /**
     * Ambil semua user dengan role tertentu.
     *
     * @param  string $role 'user' | 'admin'
     * @return array
     */
    public function findByRole(string $role): array
    {
        return $this->where('role', $role)
                    ->where('is_active', 1)
                    ->orderBy('name', 'ASC')
                    ->findAll();
    }

    /**
     * Deaktifkan user (tanpa hard delete).
     *
     * @param  int  $id
     * @return bool
     */
    public function deactivate(int $id): bool
    {
        return $this->update($id, ['is_active' => 0]);
    }

    /**
     * Aktifkan kembali user yang dinonaktifkan.
     *
     * @param  int  $id
     * @return bool
     */
    public function activate(int $id): bool
    {
        return $this->update($id, ['is_active' => 1]);
    }
}
