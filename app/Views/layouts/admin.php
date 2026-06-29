<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Admin Dashboard') ?></title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/admin.css') ?>">

    <?= $this->renderSection('head') ?>
</head>
<body>

<div class="admin-layout">

    <!-- ── SIDEBAR ───────────────────────────────────────────────── -->
    <aside class="admin-sidebar" id="admin-sidebar">
        <!-- Brand -->
        <div class="admin-sidebar__brand">
            <i class="fa-solid fa-car-side"></i>
            <span>Batur Jeep</span>
            <span class="admin-sidebar__badge">ADMIN</span>
        </div>

        <!-- Profile -->
        <div class="admin-sidebar__profile">
            <div class="admin-sidebar__avatar">
                <img src="<?= base_url('assets/images/user-avatar.png') ?>" alt="Admin" onerror="this.style.display='none'">
            </div>
            <div class="admin-sidebar__user-info">
                <span class="admin-sidebar__user-name"><?= esc(session()->get('user_name') ?? 'Administrator') ?></span>
                <span class="admin-sidebar__user-email"><?= esc(session()->get('user_email') ?? 'admin@baturjeep.com') ?></span>
            </div>
        </div>

        <!-- Main Menu -->
        <div class="admin-sidebar__menu-label">MAIN MENU</div>
        <nav class="admin-sidebar__nav">
            <a href="<?= base_url('admin/dashboard') ?>" class="admin-sidebar__link <?= str_contains(current_url(), 'dashboard') ? 'is-active' : '' ?>">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            <a href="<?= base_url('admin/bookings') ?>" class="admin-sidebar__link <?= str_contains(current_url(), 'bookings') ? 'is-active' : '' ?>">
                <i class="fa-regular fa-calendar-check"></i> Manage Bookings
            </a>
            <a href="<?= base_url('admin/packages') ?>" class="admin-sidebar__link <?= str_contains(current_url(), 'packages') ? 'is-active' : '' ?>">
                <i class="fa-solid fa-box-open"></i> Manage Packages
            </a>
            <a href="<?= base_url('admin/users') ?>" class="admin-sidebar__link <?= str_contains(current_url(), 'users') ? 'is-active' : '' ?>">
                <i class="fa-solid fa-users"></i> Manage Users
            </a>
        </nav>

        <a href="<?= base_url('auth/logout') ?>" class="admin-sidebar__logout">
            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
        </a>
        <div class="admin-sidebar__version">v1.0.0</div>
    </aside>

    <!-- ── MAIN CONTENT ──────────────────────────────────────────── -->
    <div class="admin-content">
        <!-- Topbar -->
        <header class="admin-topbar">
            <div class="admin-topbar__left">
                <h1 class="admin-topbar__title"><?= esc($page_title ?? 'Dashboard Overview') ?></h1>
                <div class="admin-topbar__date"><?= strtoupper(date('l, d F Y')) ?></div>
            </div>
            <div class="admin-topbar__right">
                <div class="admin-topbar__notif">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="admin-topbar__user">
                    <div class="admin-topbar__user-info">
                        <span class="admin-topbar__user-role">System Admin</span>
                        <span class="admin-topbar__user-status">ONLINE</span>
                    </div>
                    <div class="admin-topbar__settings">
                        <i class="fa-solid fa-gear"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="admin-main">
            <?= $this->renderSection('content') ?>

            <!-- Footer -->
            <div class="admin-footer">
                <div>&copy; <?= date('Y') ?> BATUR JEEP EXPERIENCE</div>
                <div class="admin-footer-right">
                    <span>SYSTEM STATUS</span>
                    <span>SUPPORT</span>
                </div>
            </div>
        </main>
    </div>

</div>

<!-- Scripts -->
<script>
    // Simple toggle functionality if needed for mobile
</script>
<?= $this->renderSection('scripts') ?>

</body>
</html>