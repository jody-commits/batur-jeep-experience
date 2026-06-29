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
                <input type="text" id="filter-search" class="admin-filter-input" placeholder="Search by ID or Name..." style="width: 100%;">
            </div>
            <select id="filter-status" class="admin-filter-select">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
            </select>
            <input type="date" id="filter-start" class="admin-filter-date" placeholder="mm/dd/yyyy">
            <span style="color: var(--admin-text-mut); font-size: 0.85rem;">to</span>
            <input type="date" id="filter-end" class="admin-filter-date" placeholder="mm/dd/yyyy">
            <button id="filter-reset" class="admin-filter-reset">
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
                        <?php foreach ($bookings as $index => $row): ?>
                        <tr class="booking-row" 
                            data-index="<?= $index ?>" 
                            data-id="<?= strtolower(esc($row['id'])) ?>" 
                            data-name="<?= strtolower(esc($row['guest'])) ?>" 
                            data-status="<?= strtolower($row['status']) ?>" 
                            data-date="<?= esc($row['date_raw']) ?>" 
                            style="cursor: pointer;" onclick="viewBooking(<?= $index ?>)">
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
                                <div class="admin-actions" style="display:flex; gap:0.25rem;">
                                    <?php if ($row['status'] === 'Pending'): ?>
                                    <form action="<?= base_url('admin/bookings/update-status/' . $row['id_raw']) ?>" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="admin-btn-icon" style="background: #f8fafc; border: 1px solid var(--admin-border); color: #10b981;" title="Confirm Booking">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                    </form>
                                    <form action="<?= base_url('admin/bookings/update-status/' . $row['id_raw']) ?>" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="admin-btn-icon" style="background: #f8fafc; border: 1px solid var(--admin-border); color: #ef4444;" title="Reject Booking">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                    <?php elseif ($row['status'] === 'Confirmed'): ?>
                                    <form action="<?= base_url('admin/bookings/update-status/' . $row['id_raw']) ?>" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="admin-btn-icon" style="background: #f8fafc; border: 1px solid var(--admin-border); color: #0284c7;" title="Mark as Completed">
                                            <i class="fa-solid fa-check-double"></i>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div style="padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--admin-border); font-size: 0.8rem; color: var(--admin-text-mut);">
                    <div id="filter-result-count">Showing <?= count($bookings) ?> results</div>
                    <div style="display: flex; gap: 0.25rem; display: none;"><!-- Hidden pagination for now -->
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
        </div>
        <div class="admin-booking-details__body" style="overflow-y: auto; flex: 1;">
            <div id="detail-empty" style="text-align: center; color: var(--admin-text-mut); padding: 2rem 0;">
                Select a booking from the table to view details.
            </div>
            
            <div id="detail-content" style="display: none;">
                <div class="admin-bd-top">
                    <div class="admin-bd-icon">
                        <i class="fa-solid fa-ticket"></i>
                    </div>
                    <div style="font-size: 0.7rem; color: var(--admin-text-light); text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; margin-bottom: 0.25rem;">BOOKING ID</div>
                    <div class="admin-bd-id" id="detail-id">BJE-XXXXX-XXXX</div>
                    <span class="admin-badge" id="detail-status" style="font-size: 0.65rem;">STATUS</span>
                </div>
                
                <hr style="border: 0; border-top: 1px solid var(--admin-border); margin-bottom: 1.5rem;">
                
                <div class="admin-bd-grid">
                    <div>
                        <div class="admin-bd-label">GUEST NAME</div>
                        <div class="admin-bd-value" id="detail-guest">Name</div>
                    </div>
                    <div>
                        <div class="admin-bd-label">EXPEDITION</div>
                        <div class="admin-bd-value" id="detail-package" style="color: var(--admin-sidebar-bg);">Package</div>
                    </div>
                    <div>
                        <div class="admin-bd-label">TOUR DATE</div>
                        <div class="admin-bd-value" id="detail-date">Date</div>
                    </div>
                    <div>
                        <div class="admin-bd-label">GUESTS</div>
                        <div class="admin-bd-value" id="detail-pax">Pax</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <div class="admin-bd-label">TOTAL PRICE</div>
                        <div class="admin-bd-value" id="detail-price" style="font-weight: 700; color: #059669;">Price</div>
                    </div>
                    
                    <div style="grid-column: span 2;">
                        <div class="admin-bd-label">CONTACT</div>
                        <div class="admin-bd-value" style="font-size: 0.8rem;">
                            <div id="detail-phone"><i class="fa-solid fa-phone" style="width: 16px;"></i> Phone</div>
                            <div id="detail-email" style="margin-top: 0.25rem;"><i class="fa-solid fa-envelope" style="width: 16px;"></i> Email</div>
                        </div>
                    </div>
                    <div style="grid-column: span 2;">
                        <div class="admin-bd-label">HOTEL ADDRESS</div>
                        <div class="admin-bd-value" id="detail-hotel" style="font-size: 0.8rem; line-height: 1.4;">Hotel</div>
                    </div>
                    <div style="grid-column: span 2;">
                        <div class="admin-bd-label">NOTES / SPECIAL REQUEST</div>
                        <div class="admin-bd-value" id="detail-notes" style="font-size: 0.8rem; line-height: 1.4; font-style: italic;">Notes</div>
                    </div>
                </div>
                
                <div class="admin-bd-timeline-title" style="margin-top: 1.5rem;">ACTIVITY TIMELINE</div>
                <div class="admin-bd-timeline">
                    <div class="admin-bd-timeline-item active">
                        <div class="admin-bd-timeline-title-item">Booking Received</div>
                        <div class="admin-bd-timeline-desc" id="detail-created">Date</div>
                    </div>
                    <div class="admin-bd-timeline-item" style="opacity: 0.5;">
                        <div class="admin-bd-timeline-title-item">Status Updated</div>
                        <div class="admin-bd-timeline-desc" id="detail-timeline-status">Pending Confirmation</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const bookingsData = <?= json_encode($bookings) ?>;
    
    function viewBooking(index) {
        const b = bookingsData[index];
        
        document.getElementById('detail-empty').style.display = 'none';
        document.getElementById('detail-content').style.display = 'block';
        
        document.getElementById('detail-id').innerText = b.id;
        document.getElementById('detail-guest').innerText = b.guest;
        document.getElementById('detail-package').innerText = b.expedition;
        document.getElementById('detail-date').innerText = b.date;
        document.getElementById('detail-pax').innerText = b.pax + ' People';
        document.getElementById('detail-price').innerText = b.price;
        
        document.getElementById('detail-phone').innerHTML = '<i class="fa-solid fa-phone" style="width: 16px;"></i> ' + b.phone;
        document.getElementById('detail-email').innerHTML = '<i class="fa-solid fa-envelope" style="width: 16px;"></i> ' + b.email;
        document.getElementById('detail-hotel').innerText = b.hotel;
        document.getElementById('detail-notes').innerText = b.notes;
        document.getElementById('detail-created').innerText = b.created_at;
        
        const statusEl = document.getElementById('detail-status');
        statusEl.innerText = b.status.toUpperCase();
        
        // Reset status styling
        statusEl.className = 'admin-badge';
        if (b.status === 'Pending') {
            statusEl.classList.add('admin-badge--warning');
            document.getElementById('detail-timeline-status').innerText = 'Awaiting Admin Action';
        } else if (b.status === 'Confirmed') {
            statusEl.classList.add('admin-badge--success');
            document.getElementById('detail-timeline-status').innerText = 'Booking Confirmed';
        } else if (b.status === 'Completed') {
            statusEl.style.background = '#e0f2fe';
            statusEl.style.color = '#0284c7';
            document.getElementById('detail-timeline-status').innerText = 'Tour Completed';
        } else {
            statusEl.style.background = '#fee2e2';
            statusEl.style.color = '#ef4444';
            document.getElementById('detail-timeline-status').innerText = b.status;
        }
    }
    
    // Filter Logic
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('filter-search');
        const statusSelect = document.getElementById('filter-status');
        const startDate = document.getElementById('filter-start');
        const endDate = document.getElementById('filter-end');
        const resetBtn = document.getElementById('filter-reset');
        const rows = document.querySelectorAll('.booking-row');
        const resultCount = document.getElementById('filter-result-count');
        
        function filterTable() {
            const searchTerm = searchInput.value.toLowerCase();
            const statusTerm = statusSelect.value.toLowerCase();
            const startVal = startDate.value;
            const endVal = endDate.value;
            
            let visibleCount = 0;
            
            rows.forEach(row => {
                const id = row.getAttribute('data-id');
                const name = row.getAttribute('data-name');
                const status = row.getAttribute('data-status');
                const date = row.getAttribute('data-date');
                
                // Text matching
                const matchesSearch = id.includes(searchTerm) || name.includes(searchTerm);
                
                // Status matching
                const matchesStatus = statusTerm === '' || status === statusTerm;
                
                // Date matching
                let matchesDate = true;
                if (startVal && date < startVal) matchesDate = false;
                if (endVal && date > endVal) matchesDate = false;
                
                if (matchesSearch && matchesStatus && matchesDate) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            resultCount.innerText = 'Showing ' + visibleCount + ' results';
        }
        
        searchInput.addEventListener('input', filterTable);
        statusSelect.addEventListener('change', filterTable);
        startDate.addEventListener('change', filterTable);
        endDate.addEventListener('change', filterTable);
        
        resetBtn.addEventListener('click', function() {
            searchInput.value = '';
            statusSelect.value = '';
            startDate.value = '';
            endDate.value = '';
            filterTable();
        });
    });
</script>

<?= $this->endSection() ?>