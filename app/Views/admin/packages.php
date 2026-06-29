<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- ── HEADER ACTIONS ────────────────────────────────────────── -->
<div class="admin-header-actions">
    <div class="admin-search-wrapper">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search packages...">
    </div>
    <button class="admin-btn-primary">
        <i class="fa-solid fa-plus"></i> ADD NEW PACKAGE
    </button>
</div>

<!-- ── STAT CARDS ────────────────────────────────────────────── -->
<div class="admin-stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 2rem;">
    <!-- Total Packages -->
    <div class="admin-stat-card" style="border-left: 4px solid var(--admin-sidebar-bg);">
        <div class="admin-stat__header" style="margin-bottom: 0.5rem;">
            <div class="admin-stat__label">TOTAL PACKAGES</div>
            <i class="fa-solid fa-box-open" style="color: #f1f5f9; font-size: 1.5rem;"></i>
        </div>
        <div class="admin-stat__value"><?= esc($stats['total']) ?></div>
    </div>
    
    <!-- Active Listings -->
    <div class="admin-stat-card" style="border-left: 4px solid #10b981;">
        <div class="admin-stat__header" style="margin-bottom: 0.5rem;">
            <div class="admin-stat__label">ACTIVE LISTINGS</div>
            <i class="fa-regular fa-circle-check" style="color: #f1f5f9; font-size: 1.5rem;"></i>
        </div>
        <div class="admin-stat__value"><?= sprintf('%02d', $stats['active']) ?></div>
    </div>
    
    <!-- Pickup Enabled -->
    <div class="admin-stat-card" style="border-left: 4px solid #f59e0b;">
        <div class="admin-stat__header" style="margin-bottom: 0.5rem;">
            <div class="admin-stat__label">PICKUP ENABLED</div>
            <i class="fa-solid fa-car-side" style="color: #f1f5f9; font-size: 1.5rem;"></i>
        </div>
        <div class="admin-stat__value"><?= sprintf('%02d', $stats['pickup']) ?></div>
    </div>
</div>

<!-- ── PACKAGE GRID ──────────────────────────────────────────── -->
<div class="admin-package-grid">
    <?php foreach ($packages as $pkg): ?>
    <div class="admin-package-card">
        <!-- Image Side -->
        <div class="admin-pkg-img">
            <!-- Using a generic placeholder since real images might not exist -->
            <img src="<?= base_url('assets/images/' . $pkg['image']) ?>" alt="Package Image" onerror="this.src='https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?auto=format&fit=crop&w=400&q=80'">
            <div class="admin-pkg-badges">
                <span class="admin-pkg-badge">ACTIVE</span>
                <span class="admin-pkg-badge" style="background: rgba(255,255,255,0.9); color: #059669;">HOTEL PICKUP</span>
            </div>
        </div>
        
        <!-- Info Side -->
        <div class="admin-pkg-info">
            <div class="admin-pkg-title-row">
                <h3 class="admin-pkg-title"><?= esc($pkg['title']) ?></h3>
                <div class="admin-pkg-price"><?= esc($pkg['price']) ?></div>
            </div>
            
            <p class="admin-pkg-desc"><?= esc($pkg['desc']) ?></p>
            
            <div class="admin-pkg-meta">
                <div><i class="fa-regular fa-clock"></i> <?= esc($pkg['duration']) ?></div>
                <div><i class="fa-solid fa-user-group"></i> <?= esc($pkg['guests']) ?></div>
            </div>
            
            <div class="admin-pkg-actions">
                <button class="admin-btn-action admin-btn-action--edit">
                    <i class="fa-solid fa-pen"></i> Edit
                </button>
                <button class="admin-btn-action admin-btn-action--delete">
                    <i class="fa-regular fa-trash-can"></i> Delete
                </button>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>