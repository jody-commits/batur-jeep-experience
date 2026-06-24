<!--
 * Partial: partials/navbar.php
 * Desc   : Global navigation bar — sticky, transparent on hero, solid on scroll
 *          Design: Batur Jeep Experience
-->

<header class="navbar" id="main-navbar">
    <div class="navbar__container">

        <!-- Brand Logo -->
        <a href="<?= base_url('/') ?>" class="navbar__brand" aria-label="Batur Jeep Experience — Home">
            <span class="navbar__brand-icon">
                <i class="fa-solid fa-truck-monster"></i>
            </span>
            <span class="navbar__brand-text">Batur Jeep<br><em>Experience</em></span>
        </a>

        <!-- Desktop Navigation -->
        <nav class="navbar__nav" aria-label="Main Navigation">
            <a href="<?= base_url('/') ?>"
               class="navbar__link <?= (current_url() === base_url('/') || current_url() === base_url()) ? 'is-active' : '' ?>">
                Home
            </a>
            <a href="<?= base_url('packages') ?>"
               class="navbar__link <?= str_contains(current_url(), '/packages') ? 'is-active' : '' ?>">
                Packages
            </a>

            <a href="<?= base_url('about') ?>"
               class="navbar__link <?= str_contains(current_url(), '/about') ? 'is-active' : '' ?>">
                About
            </a>
            <a href="<?= base_url('contact') ?>"
               class="navbar__link <?= str_contains(current_url(), '/contact') ? 'is-active' : '' ?>">
                Contact
            </a>
        </nav>

        <!-- Auth + CTA Buttons -->
        <div class="navbar__actions">
            <?php if (session()->get('user_id')): ?>
                <?php if (session()->get('role') === 'admin'): ?>
                    <a href="<?= base_url('admin') ?>" class="navbar__btn-login" id="navbar-btn-dashboard">
                        <i class="fa-solid fa-gauge-high"></i> Dashboard
                    </a>
                <?php else: ?>
                    <a href="<?= base_url('user/dashboard') ?>" class="navbar__btn-login" id="navbar-btn-dashboard">
                        <i class="fa-solid fa-user"></i> My Account
                    </a>
                <?php endif; ?>
                <a href="<?= base_url('auth/logout') ?>" class="navbar__btn-cta" id="navbar-btn-logout">
                    Logout
                </a>
            <?php else: ?>
                <a href="<?= base_url('auth/login') ?>" class="navbar__btn-login" id="navbar-btn-login">
                    Login
                </a>
                <a href="<?= base_url('booking') ?>" class="navbar__btn-cta" id="navbar-btn-booknow">
                    Book Now
                </a>
            <?php endif; ?>
        </div>

        <!-- Mobile Hamburger -->
        <button class="navbar__hamburger" id="navbar-hamburger" aria-label="Toggle menu" aria-expanded="false">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- Mobile Menu Drawer -->
    <div class="navbar__mobile-menu" id="navbar-mobile-menu" aria-hidden="true">
        <nav class="navbar__mobile-nav">
            <a href="<?= base_url('/') ?>" class="navbar__mobile-link">Home</a>
            <a href="<?= base_url('packages') ?>" class="navbar__mobile-link">Tour Packages</a>

            <a href="<?= base_url('about') ?>" class="navbar__mobile-link">About Us</a>
            <a href="<?= base_url('contact') ?>" class="navbar__mobile-link">Contact</a>
        </nav>
        <div class="navbar__mobile-actions">
            <?php if (session()->get('user_id')): ?>
                <a href="<?= base_url('user/dashboard') ?>" class="btn-mobile-login">My Account</a>
                <a href="<?= base_url('auth/logout') ?>" class="btn-mobile-cta">Logout</a>
            <?php else: ?>
                <a href="<?= base_url('auth/login') ?>" class="btn-mobile-login">Login</a>
                <a href="<?= base_url('booking') ?>" class="btn-mobile-cta">Book Now</a>
            <?php endif; ?>
        </div>
    </div>
</header>
