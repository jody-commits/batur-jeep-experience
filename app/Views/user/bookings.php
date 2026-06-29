<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>

<!--
 * View: user/bookings.php
 * URL  : /user/bookings
 * Desc : My Bookings — filter tabs + booking cards
-->

<!-- ════════════════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════════════════ -->
<div class="bookings-header">
    <h1 class="bookings-header__title" id="my-bookings-title">My Bookings</h1>
    <span class="bookings-header__meta"><?= count($bookings) ?> booking(s) found</span>
</div>

<!-- ── Flash messages ──────────────────────────────────────── -->
<?php if (session()->getFlashdata('success')): ?>
<div class="user-flash user-flash--success">
    <i class="fa-solid fa-circle-check"></i>
    <?= esc(session()->getFlashdata('success')) ?>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="user-flash user-flash--error">
    <i class="fa-solid fa-circle-exclamation"></i>
    <?= esc(session()->getFlashdata('error')) ?>
</div>
<?php endif; ?>


<!-- ════════════════════════════════════════════════════════
     FILTER TABS
════════════════════════════════════════════════════════ -->
<nav class="bookings-filters" aria-label="Filter Bookings" role="tablist">
    <?php
    $filters = [
        'all'       => 'All Bookings',
        'pending'   => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ];
    foreach ($filters as $key => $label):
    ?>
    <a href="<?= base_url('user/bookings') ?>?status=<?= $key ?>"
       class="bookings-filter-btn <?= $active_filter === $key ? 'is-active' : '' ?>"
       role="tab"
       aria-selected="<?= $active_filter === $key ? 'true' : 'false' ?>"
       id="filter-<?= $key ?>">
        <?= $label ?>
    </a>
    <?php endforeach; ?>
</nav>


<!-- ════════════════════════════════════════════════════════
     BOOKINGS LIST
════════════════════════════════════════════════════════ -->
<?php if (empty($bookings)): ?>
    <div class="bookings-empty">
        <div class="bookings-empty__icon">
            <i class="fa-regular fa-calendar-xmark"></i>
        </div>
        <h2 class="bookings-empty__title">No bookings found</h2>
        <p class="bookings-empty__sub">
            <?= $active_filter !== 'all' ? 'No ' . $active_filter . ' bookings at the moment.' : 'You have not made any bookings yet.' ?>
        </p>
        <a href="<?= base_url('booking') ?>" class="btn-booking btn-booking--primary" id="btn-book-now-empty">
            <i class="fa-solid fa-plus"></i>
            Book Your First Adventure
        </a>
    </div>

<?php else: ?>

    <?php foreach ($bookings as $i => $booking): ?>

    <article class="booking-item"
             id="booking-<?= esc($booking['booking_code']) ?>"
             data-aos="fade-up"
             data-delay="<?= $i * 50 ?>">

        <!-- Header: Code + Status -->
        <div class="booking-item__header">
            <div>
                <p class="booking-item__code-label">BOOKING CODE</p>
                <h2 class="booking-item__code">#<?= esc($booking['booking_code']) ?></h2>
            </div>
            <div class="booking-item__header-right">
                <span class="status-badge status-badge--<?= esc($booking['status']) ?>">
                    <?php
                    $icons = [
                        'confirmed' => 'fa-circle-check',
                        'pending'   => 'fa-clock',
                        'completed' => 'fa-trophy',
                        'cancelled' => 'fa-ban',
                        'rejected'  => 'fa-xmark-circle',
                    ];
                    $icon = $icons[$booking['status']] ?? 'fa-circle';
                    ?>
                    <i class="fa-solid <?= $icon ?>"></i>
                    <?= strtoupper(esc($booking['status'])) ?>
                </span>
                <p class="booking-item__booked-on" style="margin-top:0.3rem;">
                    Booked on <?= esc($booking['booked_on']) ?>
                </p>
            </div>
        </div>

        <!-- Details Row -->
        <div class="booking-item__details">
            <!-- Package -->
            <div class="booking-detail-col">
                <p class="booking-detail-col__label">
                    <i class="fa-solid fa-mountain-sun"></i> PACKAGE
                </p>
                <p class="booking-detail-col__value"><?= esc($booking['package_name']) ?></p>
            </div>
            <!-- Date -->
            <div class="booking-detail-col">
                <p class="booking-detail-col__label">
                    <i class="fa-regular fa-calendar"></i> DATE
                </p>
                <p class="booking-detail-col__value"><?= esc($booking['tour_date']) ?></p>
            </div>
            <!-- Guests -->
            <div class="booking-detail-col">
                <p class="booking-detail-col__label">
                    <i class="fa-solid fa-users"></i> GUESTS
                </p>
                <p class="booking-detail-col__value"><?= esc($booking['total_persons']) ?> Adult(s)</p>
            </div>
            <!-- Price -->
            <div class="booking-detail-col">
                <p class="booking-detail-col__label">
                    <i class="fa-solid fa-wallet"></i> TOTAL PRICE
                </p>
                <p class="booking-detail-col__value booking-detail-col__value--accent">
                    IDR <?= number_format($booking['total_price'], 0, ',', '.') ?>
                </p>
            </div>
        </div>

        <!-- Footer: Note + Actions -->
        <div class="booking-item__footer">

            <?php if ($booking['status'] === 'confirmed' && !empty($booking['hotel_name'])): ?>
                <span class="booking-item__note booking-item__note--success">
                    <i class="fa-regular fa-clock"></i>
                    Pickup at <?= esc($booking['pickup_time']) ?> (<?= esc($booking['hotel_name']) ?>)
                </span>
            <?php elseif ($booking['status'] === 'completed'): ?>
                <span class="booking-item__note booking-item__note--success">
                    <i class="fa-solid fa-star"></i>
                    Experience Completed
                </span>
            <?php elseif ($booking['status'] === 'pending'): ?>
                <span class="booking-item__note booking-item__note--warning">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    Awaiting admin confirmation
                </span>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            <!-- Action Buttons by status -->
            <div class="booking-item__actions">
                <?php if ($booking['status'] === 'confirmed'): ?>
                    <a href="#" class="btn-booking btn-booking--outline btn-cancel-booking"
                       data-code="<?= esc($booking['booking_code']) ?>"
                       id="btn-cancel-<?= esc($booking['booking_code']) ?>">
                        Cancel Booking
                    </a>
                    <a href="<?= base_url('user/bookings') ?>" class="btn-booking btn-booking--primary"
                       id="btn-detail-<?= esc($booking['booking_code']) ?>">
                        View Details
                    </a>

                <?php elseif ($booking['status'] === 'completed'): ?>
                    <a href="<?= base_url('booking') ?>" class="btn-booking btn-booking--outline"
                       id="btn-rebook-<?= esc($booking['booking_code']) ?>">
                        Rebook
                    </a>
                    <a href="#" class="btn-booking btn-booking--accent"
                       id="btn-review-<?= esc($booking['booking_code']) ?>">
                        Write Review
                    </a>

                <?php elseif ($booking['status'] === 'pending'): ?>
                    <a href="#" class="btn-booking btn-booking--danger btn-cancel-booking"
                       data-code="<?= esc($booking['booking_code']) ?>"
                       id="btn-cancelreq-<?= esc($booking['booking_code']) ?>">
                        Cancel Request
                    </a>

                <?php else: ?>
                    <a href="<?= base_url('booking') ?>" class="btn-booking btn-booking--outline"
                       id="btn-rebook2-<?= esc($booking['booking_code']) ?>">
                        Book Again
                    </a>
                <?php endif; ?>
            </div>

        </div><!-- /.booking-item__footer -->

    </article><!-- /.booking-item -->

    <?php endforeach; ?>

<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.querySelectorAll('.btn-cancel-booking').forEach(function(btn) {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        var code = this.dataset.code || 'this booking';
        if (confirm('Are you sure you want to cancel booking ' + code + '? This action cannot be undone.')) {
            // TODO: POST to cancel endpoint
            alert('Cancellation request sent for ' + code + '. Our team will contact you via WhatsApp.');
        }
    });
});
</script>
<?= $this->endSection() ?>