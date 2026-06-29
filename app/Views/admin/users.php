<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<!-- ── HEADER ACTIONS ────────────────────────────────────────── -->
<div class="admin-header-actions" style="margin-bottom: 2rem;">
    <!-- Title is typically handled in layout, but let's hide it there and show here if needed, or just show button -->
    <div></div> <!-- Spacer -->
    <button class="admin-btn-primary admin-btn-primary--green" style="background: #1e6c53;">
        <i class="fa-solid fa-user-plus"></i> ADD NEW USER
    </button>
</div>

<!-- ── STAT CARDS ────────────────────────────────────────────── -->
<div class="admin-stats-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 2rem;">
    <!-- Total Users -->
    <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
        <div class="admin-stat__header" style="margin-bottom: 0.5rem; align-items: center;">
            <div class="admin-stat__icon" style="background: #e0f2fe; color: #0284c7; width: 40px; height: 40px;">
                <i class="fa-solid fa-users"></i>
            </div>
            <div style="flex: 1; text-align: right;">
                <div class="admin-stat__label">TOTAL USERS</div>
                <div class="admin-stat__value"><?= esc($stats['total']) ?></div>
            </div>
        </div>
    </div>
    
    <!-- Active Now -->
    <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
        <div class="admin-stat__header" style="margin-bottom: 0.5rem; align-items: center;">
            <div class="admin-stat__icon" style="background: #d1fae5; color: #059669; width: 40px; height: 40px;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div style="flex: 1; text-align: right;">
                <div class="admin-stat__label">ACTIVE NOW</div>
                <div class="admin-stat__value"><?= esc($stats['active']) ?></div>
            </div>
        </div>
    </div>
    
    <!-- Admins -->
    <div class="admin-stat-card" style="border: 1px solid var(--admin-border); box-shadow: none;">
        <div class="admin-stat__header" style="margin-bottom: 0.5rem; align-items: center;">
            <div class="admin-stat__icon" style="background: #fef3c7; color: #d97706; width: 40px; height: 40px;">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div style="flex: 1; text-align: right;">
                <div class="admin-stat__label">ADMINS</div>
                <div class="admin-stat__value"><?= esc($stats['admins']) ?></div>
            </div>
        </div>
    </div>
</div>

<!-- ── FILTERS ──────────────────────────────────────────────── -->
<div class="admin-filters" style="background: #fff; padding: 0.5rem; box-shadow: none; border: 1px solid var(--admin-border);">
    <div class="admin-search-wrapper" style="flex: 1;">
        <i class="fa-solid fa-magnifying-glass" style="left: 1.5rem;"></i>
        <input type="text" placeholder="Search by name, email or ID..." style="width: 100%; background: #f8fafc; padding: 0.75rem 1rem 0.75rem 3rem;">
    </div>
    <select class="admin-filter-select" style="background: #f8fafc; border: none; padding: 0.75rem 1rem;">
        <option>Role: All</option>
        <option>Admin</option>
        <option>User</option>
        <option>Guide</option>
    </select>
    <button style="background: #fff; border: 1px solid var(--admin-border); border-radius: var(--radius-sm); padding: 0.75rem 1.5rem; color: var(--admin-text-main); font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
        <i class="fa-solid fa-filter"></i> Filters
    </button>
</div>

<!-- ── DATA TABLE ───────────────────────────────────────────── -->
<div class="admin-card">
    <div class="admin-card__body" style="padding: 0; overflow-x: auto;">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>USER</th>
                    <th>EMAIL</th>
                    <th>ROLE</th>
                    <th>STATUS</th>
                    <th>JOIN DATE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $row): ?>
                <tr>
                    <td>
                        <div class="admin-client">
                            <div class="admin-user-avatar">
                                <img src="<?= base_url('assets/images/' . $row['avatar']) ?>" onerror="this.src='https://ui-avatars.com/api/?name=' + encodeURIComponent('<?= esc($row['name']) ?>') + '&background=random'">
                            </div>
                            <span class="admin-client__name" style="color: var(--admin-sidebar-bg);"><?= esc($row['name']) ?></span>
                        </div>
                    </td>
                    <td>
                        <span class="admin-cell-text" style="font-weight: 400;"><?= esc($row['email']) ?></span>
                    </td>
                    <td>
                        <?php 
                            $roleClass = '';
                            if ($row['role'] === 'ADMIN') $roleClass = 'admin-badge--role-admin';
                            elseif ($row['role'] === 'USER') $roleClass = 'admin-badge--role-user';
                            else $roleClass = 'admin-badge--role-guide';
                        ?>
                        <span class="admin-badge <?= $roleClass ?>"><?= esc($row['role']) ?></span>
                    </td>
                    <td>
                        <span class="admin-badge <?= $row['status'] === 'Active' ? 'admin-badge--status-active' : ($row['status'] === 'Deleted' ? 'admin-badge--role-guide' : 'admin-badge--status-inactive') ?>">
                            <?= esc($row['status']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="admin-cell-text" style="font-weight: 400; color: var(--admin-text-mut);"><?= esc($row['join_date']) ?></span>
                    </td>
                    <td>
                        <div class="admin-actions">
                            <button class="admin-btn-action admin-btn-action--edit" title="Edit">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            <button class="admin-btn-action admin-btn-action--delete" title="Delete">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div style="padding: 1.5rem; display: flex; justify-content: space-between; align-items: center; border-top: 1px solid var(--admin-border); font-size: 0.8rem; color: var(--admin-text-mut);">
            <div>Showing all <?= esc($stats['total']) ?> users</div>
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

<?= $this->endSection() ?>