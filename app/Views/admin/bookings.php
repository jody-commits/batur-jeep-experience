<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div style="display: flex; gap: 2rem;">

    <div style="flex: 1;">
        <!-- ── STAT CARDS ────────────────────────────────────────────── -->
        <div class="admin-stats-grid">
            <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
                <div class="admin-stat__header">
                    <div class="admin-stat__label">TOTAL</div>
                    <div class="admin-stat__icon admin-stat__icon--blue" style="width: 32px; height: 32px; font-size: 1rem;">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                </div>
                <div class="admin-stat__value"><?= esc($stats['total']) ?></div>
            </div>
            
            <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
                <div class="admin-stat__header">
                    <div class="admin-stat__label">PENDING</div>
                    <div class="admin-stat__icon admin-stat__icon--orange" style="width: 32px; height: 32px; font-size: 1rem;">
                        <i class="fa-solid fa-ellipsis"></i>
                    </div>
                </div>
                <div class="admin-stat__value"><?= esc($stats['pending']) ?></div>
            </div>
            
            <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
                <div class="admin-stat__header">
                    <div class="admin-stat__label">CONFIRMED</div>
                    <div class="admin-stat__icon admin-stat__icon--green" style="width: 32px; height: 32px; font-size: 1rem;">
                        <i class="fa-solid fa-check"></i>
                    </div>
                </div>
                <div class="admin-stat__value"><?= esc($stats['confirmed']) ?></div>
            </div>
            
            <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
                <div class="admin-stat__header">
                    <div class="admin-stat__label">COMPLETED</div>
                    <div class="admin-stat__icon admin-stat__icon--green" style="width: 32px; height: 32px; font-size: 1rem;">
                        <i class="fa-solid fa-check-double"></i>
                    </div>
                </div>
                <div class="admin-stat__value"><?= esc($stats['completed']) ?></div>
            </div>
        </div>

        <!-- ── FILTERS ──────────────────────────────────────────────── -->
        <div class="admin-filters">
            <div class="admin-search-wrapper" style="flex: 1;">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" class="admin-filter-input" placeholder="Search by ID or Name..." style="width: 100%;">
            </div>
            <select class="admin-filter-select">
                <option>All Statuses</option>
                <option>Pending</option>
                <option>Confirmed</option>
                <option>Completed</option>
            </select>
            <input type="date" class="admin-filter-date" placeholder="mm/dd/yyyy">
            <span style="color: var(--admin-text-mut); font-size: 0.85rem;">to</span>
            <input type="date" class="admin-filter-date" placeholder="mm/dd/yyyy">
            <button class="admin-filter-reset">
                <i class="fa-solid fa-rotate-right"></i> Reset Filters
            </button>
        </div>

        <!-- ── DATA TABLE ───────────────────────────────────────────── -->
        <div class="admin-card">
            <div class="admin-card__body" style="padding: 0; overflow-x: auto;">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>BOOKING ID</th>
                            <th>GUEST NAME</th>
                            <th>EXPEDITION</th>
                            <th>TOUR DATE</th>
                            <th>PAX</th>
                            <th>STATUS</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $row): ?>
                        <tr>
                            <td style="font-weight: 600; color: var(--admin-text-main); font-size: 0.85rem;">
                                <?= esc($row['id']) ?>
                            </td>
                            <td>
                                <div class="admin-client__name" style="font-weight: 400;"><?= esc($row['guest']) ?></div>
                            </td>
                            <td>
                                <span style="color: var(--admin-sidebar-bg); font-weight: 600; font-size: 0.85rem;">
                                    <?= esc($row['expedition']) ?>
                                </span>
                            </td>
                            <td>
                                <div class="admin-cell-text"><?= esc($row['date']) ?></div>
                            </td>
                            <td style="text-align: center;">
                                <div class="admin-cell-text"><?= esc($row['pax']) ?></div>
                            </td>
                            <td>
                                <?php if ($row['status'] === 'Pending'): ?>
                                    <span class="admin-badge admin-badge--warning">PENDING</span>
                                <?php elseif ($row['status'] === 'Confirmed'): ?>
                                    <span class="admin-badge admin-badge--success">CONFIRMED</span>
                                <?php elseif ($row['status'] === 'Completed'): ?>
                                    <span class="admin-badge" style="background: #e0f2fe; color: #0284c7;">COMPLETED</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="admin-actions">
                                    <button class="admin-btn-icon" style="background: #f8fafc; border: 1px solid var(--admin-border); color: #10b981;" title="Approve">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                    <button class="admin-btn-icon" style="background: #f8fafc; border: 1px solid var(--admin-border); color: #ef4444;" title="Reject">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div style="padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--admin-border); font-size: 0.8rem; color: var(--admin-text-mut);">
                    <div>Showing 1 to 3 of 17 results</div>
                    <div style="display: flex; gap: 0.25rem;">
                        <button style="border: none; background: none; padding: 0.25rem; color: var(--admin-text-mut);"><i class="fa-solid fa-chevron-left"></i></button>
                        <button style="background: var(--admin-sidebar-bg); color: #fff; border: none; width: 28px; height: 28px; border-radius: 4px;">1</button>
                        <button style="background: none; color: var(--admin-text-main); border: none; width: 28px; height: 28px; border-radius: 4px;">2</button>
                        <button style="background: none; color: var(--admin-text-main); border: none; width: 28px; height: 28px; border-radius: 4px;">3</button>
                        <button style="border: none; background: none; padding: 0.25rem; color: var(--admin-text-main);"><i class="fa-solid fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Sidebar will be pushed outside by default, but let's show it statically for design matching if needed. 
         Wait, the design shows it actively. I will include it inline to match the screenshot -->
    <div style="width: 320px; background: #fff; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm); overflow: hidden; display: flex; flex-direction: column;">
        <div style="background: var(--admin-sidebar-bg); padding: 1.25rem; display: flex; justify-content: space-between; align-items: center;">
            <h3 style="color: #fff; font-size: 1.1rem; font-family: var(--font-heading);">Booking Details</h3>
            <button style="background: none; border: none; color: #fff; cursor: pointer;"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="admin-booking-details__body">
            <div class="admin-bd-top">
                <div class="admin-bd-icon">
                    <i class="fa-solid fa-ticket"></i>
                </div>
                <div style="font-size: 0.7rem; color: var(--admin-text-light); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin-bottom: 0.25rem;">BOOKING ID</div>
                <div class="admin-bd-id">BJE-20260611-0001</div>
                <span class="admin-badge admin-badge--warning" style="font-size: 0.65rem;">PENDING PAYMENT</span>
            </div>
            
            <hr style="border: 0; border-top: 1px solid var(--admin-border); margin-bottom: 1.5rem;">
            
            <div class="admin-bd-grid">
                <div>
                    <div class="admin-bd-label">GUEST NAME</div>
                    <div class="admin-bd-value">Budi Santoso</div>
                </div>
                <div>
                    <div class="admin-bd-label">EXPEDITION</div>
                    <div class="admin-bd-value" style="color: var(--admin-sidebar-bg);">Sunrise Batur</div>
                </div>
                <div>
                    <div class="admin-bd-label">TOUR DATE</div>
                    <div class="admin-bd-value">15 Jun 2026</div>
                </div>
                <div>
                    <div class="admin-bd-label">GUESTS</div>
                    <div class="admin-bd-value">2 People</div>
                </div>
            </div>
            
            <div class="admin-bd-timeline-title">ACTIVITY TIMELINE</div>
            <div class="admin-bd-timeline">
                <div class="admin-bd-timeline-item active">
                    <div class="admin-bd-timeline-title-item">Booking Received</div>
                    <div class="admin-bd-timeline-desc">10 Jun 2026 • 14:32</div>
                </div>
                <div class="admin-bd-timeline-item" style="opacity: 0.5;">
                    <div class="admin-bd-timeline-title-item">Manual Confirmation Required</div>
                    <div class="admin-bd-timeline-desc">Awaiting Admin action</div>
                </div>
            </div>
        </div>
        <div class="admin-booking-details__footer">
            <button class="admin-btn-process">Process Booking</button>
            <button class="admin-btn-delete"><i class="fa-regular fa-trash-can"></i></button>
        </div>
    </div>
</div>

<?= $this->endSection() ?>