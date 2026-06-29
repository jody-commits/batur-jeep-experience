<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>

<!--
 * View: user/dashboard.php
 * URL  : /user/dashboard
 * Desc : Customer Dashboard — welcome hero, stats, recent bookings, recommendation
-->

<!-- ── Flash messages ──────────────────────────────────────── -->
<?php if (session()->getFlashdata('success')): ?>
<div class="user-flash user-flash--success">
    <i class="fa-solid fa-circle-check"></i>
    <?= esc(session()->getFlashdata('success')) ?>
</div>
<?php endif; ?>

<!-- ════════════════════════════════════════════════════════
     WELCOME HERO BANNER
════════════════════════════════════════════════════════ -->
<div class="dash-welcome" aria-label="Welcome Banner">
    <div class="dash-welcome__bg"
         style="background-image: url('<?= base_url('assets/images/sunrise.jpg') ?>');">
    </div>
    <div class="dash-welcome__overlay"></div>
    <div class="dash-welcome__content">
        <h1 class="dash-welcome__greeting" id="dash-greeting">
            Welcome back, <?= esc(explode(' ', $user_name)[0]) ?>.
        </h1>
        <p class="dash-welcome__sub">
            Your next adventure awaits at the heart of Mount Batur. Are you ready for the sunrise?
        </p>
        <span class="dash-welcome__badge">
            <i class="fa-solid fa-star"></i>
            Elite Member
        </span>
    </div>
</div>


<!-- ════════════════════════════════════════════════════════
     STATS CARDS
════════════════════════════════════════════════════════ -->
<div class="dash-stats" role="region" aria-label="Your Stats">

    <!-- Total Expeditions -->
    <div class="dash-stat-card" data-aos="fade-up">
        <div class="dash-stat__top">
            <div class="dash-stat__icon">
                <i class="fa-solid fa-route"></i>
            </div>
            <span class="dash-stat__tag dash-stat__tag--green">+2 this month</span>
        </div>
        <p class="dash-stat__label">Total Expeditions</p>
        <div class="dash-stat__value" id="stat-total"><?= esc($total_bookings) ?></div>
    </div>

    <!-- Confirmed Bookings -->
    <div class="dash-stat-card" data-aos="fade-up" data-delay="100">
        <div class="dash-stat__top">
            <div class="dash-stat__icon" style="background:#fff7ed; color:#F4A261;">
                <i class="fa-regular fa-calendar-check"></i>
            </div>
            <span class="dash-stat__tag dash-stat__tag--orange">Upcoming</span>
        </div>
        <p class="dash-stat__label">Confirmed Bookings</p>
        <div class="dash-stat__value" id="stat-confirmed"><?= str_pad((string)$confirmed, 2, '0', STR_PAD_LEFT) ?></div>
    </div>

    <!-- Pending -->
    <div class="dash-stat-card" data-aos="fade-up" data-delay="200">
        <div class="dash-stat__top">
            <div class="dash-stat__icon" style="background:#f1f5f9; color:#64748b;">
                <i class="fa-solid fa-clock-rotate-left"></i>
            </div>
            <span class="dash-stat__tag dash-stat__tag--gray">Pending Approval</span>
        </div>
        <p class="dash-stat__label">Awaiting Review</p>
        <div class="dash-stat__value" id="stat-pending">01</div>
    </div>

</div>


<!-- ════════════════════════════════════════════════════════
     2-COL: RECENT BOOKINGS + RECOMMENDATION
════════════════════════════════════════════════════════ -->
<div class="dash-grid">

    <!-- Recent Bookings Table -->
    <div class="dash-recent u-card" data-aos="fade-up" id="dash-recent-bookings">
        <div class="dash-recent__header">
            <h2 class="dash-recent__title">Recent Bookings</h2>
            <a href="<?= base_url('user/bookings') ?>" class="dash-recent__view-all" id="btn-view-all-bookings">
                VIEW ALL
            </a>
        </div>

        <?php if (!empty($recent_bookings)): ?>
        <table class="dash-recent__table" aria-label="Recent Bookings">
            <thead>
                <tr>
                    <th>PACKAGE</th>
                    <th>DATE</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recent_bookings as $booking): ?>
                <tr>
                    <td>
                        <div class="dash-pkg-cell">
                            <img
                                src="<?= base_url('assets/images/' . esc($booking['image'])) ?>"
                                alt="<?= esc($booking['package_name']) ?>"
                                class="dash-pkg-img"
                                onerror="this.src='<?= base_url('assets/images/sunrise.jpg') ?>'"
                            >
                            <span class="dash-pkg-name"><?= esc($booking['package_name']) ?></span>
                        </div>
                    </td>
                    <td style="font-size:0.85rem; color:var(--gray-500);">
                        <?= esc($booking['tour_date']) ?>
                    </td>
                    <td>
                        <span class="status-badge status-badge--<?= esc($booking['status']) ?>">
                            <?= ucfirst(esc($booking['status'])) ?>
                        </span>
                    </td>
                    <td>
                        <a href="<?= base_url('user/bookings') ?>"
                           class="btn-booking btn-booking--outline"
                           aria-label="View booking <?= esc($booking['booking_code']) ?>">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div style="padding:2rem; text-align:center; color:var(--gray-400);">
            <i class="fa-regular fa-calendar-xmark" style="font-size:2rem; margin-bottom:0.75rem; display:block;"></i>
            <p>No bookings yet. <a href="<?= base_url('booking') ?>" style="color:var(--primary); font-weight:600;">Book your first adventure!</a></p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Recommended Package Card -->
    <div class="dash-recommend" data-aos="fade-left" id="dash-recommend">
        <div class="dash-recommend__header">
            <h2 class="dash-recommend__title">Recommended</h2>
            <p class="dash-recommend__sub">Based on your previous adventures</p>
        </div>
        <div class="dash-recommend__img-wrap">
            <img
                src="<?= base_url('assets/images/offroad.jpg') ?>"
                alt="Midnight Summit Quest"
                class="dash-recommend__img"
                onerror="this.src='<?= base_url('assets/images/sunrise.jpg') ?>'"
            >
            <span class="dash-recommend__premium-badge">PREMIUM</span>
        </div>
        <div class="dash-recommend__body">
            <h3 class="dash-recommend__pkg-name">Midnight Summit Quest</h3>
            <p class="dash-recommend__pkg-desc">Private guide & luxury breakfast included</p>
            <a href="<?= base_url('packages') ?>" class="dash-recommend__cta" id="btn-explore-catalog">
                EXPLORE CATALOG
            </a>
        </div>
    </div>

</div><!-- /.dash-grid -->

<?= $this->endSection() ?>