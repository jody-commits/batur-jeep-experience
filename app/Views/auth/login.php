<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<!--
 * View: auth/login.php
 * URL  : /auth/login
 * Desc : Halaman login — split layout (foto kiri, form kanan)
 *        Design: Batur Jeep Experience
-->

<div class="auth-wrapper" id="auth-login-page">

    <!-- ═══════════════════════════════════════════════
         LEFT PANEL — Foto Gunung Batur Sunrise
    ════════════════════════════════════════════════ -->
    <div class="auth-left">

        <!-- Background image -->
        <div class="auth-left__bg"
             style="background-image: url('<?= base_url('assets/images/jeep-merah.jpg') ?>');">
        </div>

        <!-- Gradient overlay -->
        <div class="auth-left__overlay"></div>

        <!-- Brand logo top-left -->
        <a href="<?= base_url('/') ?>" class="auth-left__brand" aria-label="Batur Jeep Experience — Home" style="display:flex; align-items:center; gap:8px; margin-top:20px; margin-left:20px; text-decoration:none;">
            <img src="<?= base_url('assets/images/bje-logo.png') ?>" alt="Batur Jeep Experience Logo" style="max-height: 80px; width: auto; background: white; padding: 5px; border-radius: 50%;">
            <div style="display: flex; flex-direction: column; text-align: left; line-height: 1;">
                <span style="color: #FF7A00; font-family: 'Permanent Marker', cursive; font-size: 1.3rem; letter-spacing: 1px;">BATUR JEEP</span>
                <span style="font-family: 'Permanent Marker', cursive; font-size: 1.6rem; background: -webkit-linear-gradient(left, #8b5cf6, #3b82f6, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 1px;">EXPERIENCE</span>
            </div>
        </a>

        <!-- Headline + Feature cards at bottom -->
        <div class="auth-left__content">
            <h1 class="auth-left__headline">Conquer<br>Batur</h1>

            <!-- Feature highlights -->
            <div class="auth-features">
                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <div class="auth-feature-text">
                        <strong>Safety First</strong>
                        <span>Certified expert off-road guides</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="fa-solid fa-mountain-sun"></i>
                    </div>
                    <div class="auth-feature-text">
                        <strong>Iconic Views</strong>
                        <span>Exclusive sunrise vantage points</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="auth-feature-text">
                        <strong>Tailored Experience</strong>
                        <span>Private and semi-private tours</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Left footer -->
        <div class="auth-left__footer">
            &copy; <?= date('Y') ?> Batur Jeep Experience. All rights reserved.
        </div>
    </div>

    <!-- ═══════════════════════════════════════════════
         RIGHT PANEL — Form Login
    ════════════════════════════════════════════════ -->
    <div class="auth-right">
        <div class="auth-right__inner">

            <!-- Heading -->
            <h2 class="auth-heading">Welcome Back</h2>
            <p class="auth-subheading">Sign in to manage your upcoming adventure.</p>

            <!-- Flash messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="auth-alert auth-alert--error" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="auth-alert auth-alert--success" role="alert">
                    <i class="fa-solid fa-circle-check"></i>
                    <?= esc(session()->getFlashdata('success')) ?>
                </div>
            <?php endif; ?>

            <!-- Validation errors (CI4 Form Validation) -->
            <?php if (isset($errors) && !empty($errors)): ?>
                <div class="auth-alert auth-alert--error" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <div>
                        <?php foreach ($errors as $error): ?>
                            <div><?= esc($error) ?></div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Login Form -->
            <form id="login-form"
                  class="auth-form"
                  action="<?= base_url('auth/login') ?>"
                  method="POST"
                  novalidate>

                <?= csrf_field() ?>

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="login-email">EMAIL ADDRESS</label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="login-email"
                            name="email"
                            class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                            placeholder="name@example.com"
                            value="<?= esc(old('email')) ?>"
                            autocomplete="email"
                            required
                            autofocus>
                    </div>
                    <?php if (isset($errors['email'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['email']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="form-label-row">
                        <label class="form-label" for="login-password">PASSWORD</label>
                        <a href="<?= base_url('auth/forgot-password') ?>"
                           class="form-label-link"
                           tabindex="-1">FORGOT?</a>
                    </div>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required>
                        <button type="button"
                                class="btn-toggle-password"
                                id="toggle-login-password"
                                aria-label="Toggle password visibility"
                                tabindex="-1">
                            <i class="fa-regular fa-eye" id="toggle-login-icon"></i>
                        </button>
                    </div>
                    <?php if (isset($errors['password'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['password']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Remember me -->
                <div class="form-group">
                    <label class="form-check" for="login-remember">
                        <input type="checkbox"
                               class="form-check__input"
                               id="login-remember"
                               name="remember"
                               value="1"
                               <?= old('remember') ? 'checked' : '' ?>>
                        <span class="form-check__label">Remember me for 30 days</span>
                    </label>
                </div>

                <!-- Submit button -->
                <button type="submit"
                        id="btn-login"
                        class="btn-auth btn-auth--primary">
                    <span class="btn-text">SIGN IN</span>
                </button>

            </form>

            <!-- Divider + Switch -->
            <div class="auth-divider" style="margin-top: 1.75rem;"></div>

            <p class="auth-switch" style="margin-top: 1.25rem;">
                Don't have an account?
                <a href="<?= base_url('auth/register') ?>">Register Now</a>
            </p>

        </div><!-- /.auth-right__inner -->

        <!-- Right footer -->
        <div class="auth-right__footer">
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Service</a>
        </div>
    </div><!-- /.auth-right -->

</div><!-- /.auth-wrapper -->

<!-- ── JavaScript ─────────────────────────────────────────── -->
<script>
(function () {
    'use strict';

    // ── Toggle Password Visibility ──────────────────────────
    const toggleBtn  = document.getElementById('toggle-login-password');
    const pwdInput   = document.getElementById('login-password');
    const toggleIcon = document.getElementById('toggle-login-icon');

    if (toggleBtn && pwdInput) {
        toggleBtn.addEventListener('click', function () {
            const isHidden = pwdInput.type === 'password';
            pwdInput.type  = isHidden ? 'text' : 'password';
            toggleIcon.className = isHidden
                ? 'fa-regular fa-eye-slash'
                : 'fa-regular fa-eye';
        });
    }

    // ── Loading state on submit ─────────────────────────────
    const loginForm = document.getElementById('login-form');
    const loginBtn  = document.getElementById('btn-login');

    if (loginForm && loginBtn) {
        loginForm.addEventListener('submit', function (e) {
            // Basic HTML5 validation
            if (!loginForm.checkValidity()) return;

            // Add loading class
            loginBtn.classList.add('is-loading');
            setTimeout(function() { loginBtn.disabled = true; }, 10);
        });
    }

    // ── Animate alert dismissal ─────────────────────────────
    const alerts = document.querySelectorAll('.auth-alert');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.4s ease, max-height 0.4s ease, margin 0.4s ease';
            alert.style.opacity    = '0';
            alert.style.maxHeight  = '0';
            alert.style.margin     = '0';
            alert.style.padding    = '0';
        }, 5000);
    });

})();
</script>

<?= $this->endSection() ?>
