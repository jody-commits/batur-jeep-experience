<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'My Account — Batur Jeep Experience') ?></title>
    <meta name="robots" content="noindex, nofollow">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Montserrat:wght@600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- User CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/user.css') ?>">

    <?= $this->renderSection('head') ?>
</head>
<body class="user-layout">

    <!-- ═══════════════════════════════════════════════════
         SIDEBAR
    ════════════════════════════════════════════════════ -->
    <aside class="user-sidebar" id="user-sidebar">

        <!-- Profile block -->
        <div class="user-sidebar__profile">
            <div class="user-sidebar__avatar">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="user-sidebar__info">
                <span class="user-sidebar__name"><?= esc(session()->get('user_name') ?? 'Traveler') ?></span>
                <span class="user-sidebar__email"><?= esc(session()->get('user_email') ?? '') ?></span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="user-sidebar__nav" aria-label="Customer Navigation">
            <a href="<?= base_url('user/dashboard') ?>"
               class="user-sidebar__link <?= str_contains(current_url(), '/user/dashboard') ? 'is-active' : '' ?>"
               id="nav-dashboard">
                <i class="fa-solid fa-grid-2"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?= base_url('user/bookings') ?>"
               class="user-sidebar__link <?= str_contains(current_url(), '/user/bookings') ? 'is-active' : '' ?>"
               id="nav-bookings">
                <i class="fa-regular fa-calendar-check"></i>
                <span>My Bookings</span>
            </a>
            <a href="<?= base_url('user/profile') ?>"
               class="user-sidebar__link <?= str_contains(current_url(), '/user/profile') ? 'is-active' : '' ?>"
               id="nav-profile">
                <i class="fa-regular fa-user"></i>
                <span>My Profile</span>
            </a>
        </nav>

        <!-- Divider -->
        <div class="user-sidebar__divider"></div>

        <!-- Logout -->
        <a href="<?= base_url('auth/logout') ?>" class="user-sidebar__logout" id="nav-logout">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>

        <!-- Version -->
        <div class="user-sidebar__version">v1.0.0</div>

    </aside>

    <!-- ═══════════════════════════════════════════════════
         MAIN CONTENT
    ════════════════════════════════════════════════════ -->
    <div class="user-content" id="user-content">

        <!-- Top Bar -->
        <header class="user-topbar" id="user-topbar">
            <!-- Mobile hamburger -->
            <button class="user-topbar__hamburger" id="sidebar-toggle" aria-label="Toggle sidebar" aria-expanded="false">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Page title (mobile) -->
            <span class="user-topbar__page-title">
                <?= esc($pageTitle ?? $title ?? 'Dashboard') ?>
            </span>

            <!-- Right actions -->
            <div class="user-topbar__actions">
                <a href="<?= base_url('booking') ?>" class="user-topbar__book-btn" id="topbar-book-btn">
                    <i class="fa-solid fa-plus"></i>
                    <span>Book Now</span>
                </a>
            </div>
        </header>

        <!-- Page Content -->
        <main class="user-main" id="user-main">
            <?= $this->renderSection('content') ?>
        </main>

    </div><!-- /.user-content -->

    <!-- Mobile Overlay -->
    <div class="user-sidebar-overlay" id="sidebar-overlay"></div>

    <!-- Main JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <script>
    (function() {
        const sidebar   = document.getElementById('user-sidebar');
        const overlay   = document.getElementById('sidebar-overlay');
        const toggleBtn = document.getElementById('sidebar-toggle');

        function openSidebar() {
            sidebar.classList.add('is-open');
            overlay.classList.add('is-visible');
            toggleBtn.setAttribute('aria-expanded', 'true');
        }
        function closeSidebar() {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-visible');
            toggleBtn.setAttribute('aria-expanded', 'false');
        }

        if (toggleBtn) toggleBtn.addEventListener('click', function() {
            sidebar.classList.contains('is-open') ? closeSidebar() : openSidebar();
        });
        if (overlay) overlay.addEventListener('click', closeSidebar);
    })();
    </script>

    <?= $this->renderSection('scripts') ?>

</body>
</html>