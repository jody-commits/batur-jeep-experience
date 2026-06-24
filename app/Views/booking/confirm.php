<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
    <meta name="robots" content="noindex, nofollow">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--
 * View: booking/confirm.php
 * URL  : /booking/confirm  (GET)
 * Desc : Halaman "Booking Submitted!" — referensi kode + detail booking
 *        Dipanggil setelah POST /booking berhasil (data dari session)
-->

<?php
    $booking  = $booking ?? [];
    $refCode  = esc($booking['ref_code']   ?? 'BJE-' . date('Ymd') . '-0001');
    $pkgName  = esc($booking['package_name'] ?? 'Batur Jeep Experience');
    $tourDate = isset($booking['tour_date'])
                ? date('F j, Y', strtotime($booking['tour_date']))
                : '-';
    $guests   = $booking['num_guests']  ?? 2;
    $numJeeps = $booking['num_jeeps']   ?? (int) ceil($guests / 3);
    $pickup   = $booking['pickup_note'] ?? '04:00 AM (Meeting Point)';
    $total    = 'IDR ' . number_format($booking['total_price'] ?? 0, 0, ',', '.');
    $payStatus= esc($booking['payment_status'] ?? 'Payment Confirmed');
    $email    = esc($booking['email'] ?? '');
?>

<div class="confirm-page" id="confirm-page">
<div class="container">
<div class="confirm-inner">

    <!-- ── Success Icon ── -->
    <div class="confirm-success-icon" aria-hidden="true">
        <i class="fa-solid fa-check"></i>
    </div>

    <h1 class="confirm-title">Booking Submitted!</h1>
    <p class="confirm-subtitle">
        Your off-road adventure at Mount Batur is being prepared.
        We've received your request and will confirm your guide shortly.
    </p>

    <!-- ── Reference Code ── -->
    <div class="confirm-ref-box">
        <span class="confirm-ref-label">Your Booking Reference</span>
        <div class="confirm-ref-code" id="confirm-ref-code"><?= $refCode ?></div>
    </div>

    <!-- ── Booking Details Card ── -->
    <div class="confirm-details-card">

        <div class="confirm-details-header">
            <h2 class="confirm-details-title">Booking Details</h2>
            <span class="confirm-status-badge confirm-status-badge--pending">
                <i class="fa-solid fa-circle"></i>
                Awaiting Admin Confirmation
            </span>
        </div>

        <div class="confirm-details-grid">

            <!-- Experience -->
            <div class="confirm-detail-item">
                <div class="confirm-detail-icon">
                    <i class="fa-regular fa-compass"></i>
                </div>
                <span class="confirm-detail-label">Experience</span>
                <div class="confirm-detail-value"><?= $pkgName ?></div>
            </div>

            <!-- Group Size -->
            <div class="confirm-detail-item">
                <div class="confirm-detail-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <span class="confirm-detail-label">Group Size</span>
                <div class="confirm-detail-value">
                    <?= $guests ?> Adults,
                    <?= $numJeeps ?> Jeep<?= $numJeeps > 1 ? 's' : '' ?>
                </div>
            </div>

            <!-- Date -->
            <div class="confirm-detail-item">
                <div class="confirm-detail-icon">
                    <i class="fa-regular fa-calendar"></i>
                </div>
                <span class="confirm-detail-label">Date</span>
                <div class="confirm-detail-value"><?= $tourDate ?></div>
            </div>

            <!-- Total Amount -->
            <div class="confirm-detail-item">
                <div class="confirm-detail-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <span class="confirm-detail-label">Total Amount</span>
                <div class="confirm-detail-value"><?= $total ?></div>
            </div>

            <!-- Pickup Time -->
            <div class="confirm-detail-item">
                <div class="confirm-detail-icon">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <span class="confirm-detail-label">Pickup Time</span>
                <div class="confirm-detail-value"><?= esc($pickup) ?></div>
            </div>

            <!-- Payment Status -->
            <div class="confirm-detail-item">
                <div class="confirm-detail-icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <span class="confirm-detail-label">Payment Status</span>
                <div class="confirm-detail-value confirm-detail-value--green"><?= $payStatus ?></div>
            </div>

        </div><!-- /.confirm-details-grid -->
    </div><!-- /.confirm-details-card -->

    <!-- ── CTA Buttons ── -->
    <div class="confirm-actions">
        <a href="<?= base_url('customer/bookings') ?>" class="btn-confirm-mybookings" id="btn-view-bookings">
            View My Bookings <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="<?= base_url('/') ?>" class="btn-confirm-home" id="btn-back-home">
            Back to Home
        </a>
    </div>

    <!-- ── Email note ── -->
    <?php if ($email): ?>
    <p class="confirm-email-note">
        A confirmation email has been sent to <a href="mailto:<?= $email ?>"><?= $email ?></a>.
        Please check your spam folder if you don't see it within 5 minutes.
    </p>
    <?php endif; ?>

</div><!-- /.confirm-inner -->
</div><!-- /.container -->
</div><!-- /.confirm-page -->

<?= $this->endSection() ?>
