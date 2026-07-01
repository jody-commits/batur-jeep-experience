<?php
// ⚠️ HAPUS FILE INI SETELAH MIGRASI SELESAI!
// File ini hanya untuk menjalankan migrasi sekali saja.

// Keamanan: ganti secret ini dengan password pilihan Anda
$secret = 'bje-migrate-2024';

if (!isset($_GET['key']) || $_GET['key'] !== $secret) {
    die('❌ Akses ditolak. Sertakan ?key=bje-migrate-2024 di URL.');
}

// Jalankan migrasi via CLI command
chdir(__DIR__);
$output = shell_exec('php spark migrate 2>&1');

if ($output === null) {
    // Coba cara alternatif
    $output = system('php spark migrate 2>&1');
}

echo '<pre style="background:#111;color:#0f0;padding:20px;font-size:14px;">';
echo "=== Batur Jeep Experience — Database Migration ===\n\n";
echo htmlspecialchars($output ?? 'Tidak ada output. Coba jalankan manual via SSH.');
echo '</pre>';
echo '<p style="color:red;font-weight:bold;">⚠️ PENTING: Hapus file migrate.php ini setelah selesai!</p>';
