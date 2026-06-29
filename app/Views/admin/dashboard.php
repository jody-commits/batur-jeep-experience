<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- ── STAT CARDS ────────────────────────────────────────────── -->
<div class="admin-stats-grid">
    <!-- Revenue -->
    <div class="admin-stat-card">
        <div class="admin-stat__header">
            <div class="admin-stat__icon admin-stat__icon--green">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="admin-stat__trend admin-stat__trend--up">
                <i class="fa-solid fa-arrow-trend-up"></i> <?= esc($stats['revenue_trend']) ?>
            </div>
        </div>
        <div class="admin-stat__label">MONTHLY REVENUE</div>
        <div class="admin-stat__value"><?= esc($stats['revenue']) ?></div>
    </div>

    <!-- Total Bookings -->
    <div class="admin-stat-card">
        <div class="admin-stat__header">
            <div class="admin-stat__icon admin-stat__icon--orange">
                <i class="fa-regular fa-calendar"></i>
            </div>
            <div class="admin-stat__trend admin-stat__trend--up">
                <i class="fa-solid fa-arrow-trend-up"></i> <?= esc($stats['bookings_trend']) ?>
            </div>
        </div>
        <div class="admin-stat__label">TOTAL BOOKINGS</div>
        <div class="admin-stat__value"><?= esc($stats['bookings']) ?></div>
    </div>

    <!-- Active Users -->
    <div class="admin-stat-card">
        <div class="admin-stat__header">
            <div class="admin-stat__icon admin-stat__icon--blue">
                <i class="fa-solid fa-user-group"></i>
            </div>
            <div class="admin-stat__trend admin-stat__trend--down">
                <i class="fa-solid fa-arrow-trend-down"></i> <?= esc($stats['users_trend']) ?>
            </div>
        </div>
        <div class="admin-stat__label">ACTIVE USERS</div>
        <div class="admin-stat__value"><?= esc($stats['users']) ?></div>
    </div>

    <!-- Fleet Availability -->
    <div class="admin-stat-card">
        <div class="admin-stat__header">
            <div class="admin-stat__icon admin-stat__icon--gray">
                <i class="fa-solid fa-car"></i>
            </div>
            <div class="admin-stat__trend admin-stat__trend--neutral">
                <?= esc($stats['fleet_trend']) ?>
            </div>
        </div>
        <div class="admin-stat__label">FLEET AVAILABILITY</div>
        <div class="admin-stat__value"><?= esc($stats['fleet']) ?></div>
    </div>
</div>

<!-- ── MAIN CONTENT GRID ─────────────────────────────────────── -->
<div class="admin-dash-grid">
    <!-- Left: Pending Confirmations -->
    <div class="admin-card">
        <div class="admin-card__header">
            <div>
                <h2 class="admin-card__title">Pending Confirmations</h2>
                <div class="admin-card__subtitle">Required immediate operator attention</div>
            </div>
            <a href="#" class="admin-card__action">View All</a>
        </div>
        <div class="admin-card__body" style="padding: 0; overflow-x: auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>CLIENT</th>
                        <th>PACKAGE</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_confirmations as $row): ?>
                    <tr>
                        <!-- Client -->
                        <td>
                            <div class="admin-client">
                                <div class="admin-client__initials" style="background-color: <?= esc($row['client_bg']) ?>;">
                                    <?= esc($row['client_initials']) ?>
                                </div>
                                <div class="admin-client__info">
                                    <span class="admin-client__name"><?= esc($row['client_name']) ?></span>
                                    <span class="admin-client__type"><?= esc($row['client_type']) ?></span>
                                </div>
                            </div>
                        </td>
                        <!-- Package -->
                        <td>
                            <span class="admin-cell-package <?= str_contains($row['package'], 'Sunset') ? 'admin-cell-package--orange' : '' ?>">
                                <?= esc($row['package']) ?>
                            </span>
                        </td>
                        <!-- Date -->
                        <td>
                            <span class="admin-cell-text"><?= esc($row['date']) ?></span>
                        </td>
                        <!-- Status -->
                        <td>
                            <?php if ($row['status'] === 'Pending'): ?>
                                <span class="admin-badge admin-badge--warning">Pending</span>
                            <?php else: ?>
                                <span class="admin-badge admin-badge--success">Confirmed</span>
                            <?php endif; ?>
                        </td>
                        <!-- Actions -->
                        <td>
                            <div class="admin-actions">
                                <button class="admin-btn-icon admin-btn-icon--approve" title="Approve">
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button class="admin-btn-icon admin-btn-icon--reject" title="Reject">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Column: Status & Quick Actions -->
    <div>
        <!-- Booking Status Chart -->
        <div class="admin-card" style="margin-bottom: 1.5rem;">
            <div class="admin-card__header" style="padding-bottom: 0;">
                <h2 class="admin-card__title" style="font-size: 1rem; font-weight: 600;">Booking Status</h2>
            </div>
            <div class="admin-chart-area">
                <div class="admin-chart-doughnut">
                    <div class="admin-chart-center">
                        <div class="admin-chart-val"><?= esc($stats['bookings']) ?></div>
                        <div class="admin-chart-lbl">TOTAL</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="admin-quick-actions">
            <div class="admin-quick-title">QUICK ACTIONS</div>
            <button class="admin-btn-full">
                <div class="admin-btn-full__left">
                    <i class="fa-solid fa-plus"></i>
                    Create New Package
                </div>
                <i class="fa-solid fa-chevron-right" style="color: #cbd5e1;"></i>
            </button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>