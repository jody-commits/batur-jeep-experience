<?= $this->extend('layouts/auth') ?>
<?= $this->section('content') ?>

<!--
 * View: auth/register.php
 * URL  : /auth/register
 * Desc : Halaman register — split layout (foto kiri hijau, form kanan)
 *        Design: Batur Jeep Experience
-->

<div class="auth-wrapper" id="auth-register-page">

    <!-- ═══════════════════════════════════════════════
         LEFT PANEL — Foto Kintamani Hijau
    ════════════════════════════════════════════════ -->
    <div class="auth-left">

        <!-- Background image -->
        <div class="auth-left__bg"
             style="background-image: url('<?= base_url('assets/images/kintamani-green-hero.png') ?>');">
        </div>

        <!-- Gradient overlay (lebih gelap di bawah untuk teks) -->
        <div class="auth-left__overlay"
             style="background: linear-gradient(to bottom, rgba(0,0,0,0.15) 0%, rgba(10,30,20,0.45) 45%, rgba(10,30,20,0.78) 100%);">
        </div>

        <!-- Brand logo -->
        <a href="<?= base_url('/') ?>" class="auth-left__brand" aria-label="Batur Jeep Experience — Home">
            <div class="auth-left__brand-icon">🚙</div>
            <div class="auth-left__brand-name">Batur Jeep<br>Experience</div>
        </a>

        <!-- Headline + Feature cards -->
        <div class="auth-left__content">
            <h1 class="auth-left__headline" style="font-size: clamp(1.8rem, 3.5vw, 2.6rem);">
                Join the<br>Adventure
            </h1>
            <p class="auth-left__tagline">
                Unlock the secrets of Kintamani with Bali's<br>
                premier off-road specialists.
            </p>

            <!-- Feature highlights (register-specific) -->
            <div class="auth-features">
                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <div class="auth-feature-text">
                        <strong>Priority Booking</strong>
                        <span>Secure your sunrise spot 48 hours before general release.</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                    <div class="auth-feature-text">
                        <strong>Exclusive Media Access</strong>
                        <span>Download professional expedition photos from your private dashboard.</span>
                    </div>
                </div>

                <div class="auth-feature-item">
                    <div class="auth-feature-icon">
                        <i class="fa-solid fa-compass"></i>
                    </div>
                    <div class="auth-feature-text">
                        <strong>Route Customization</strong>
                        <span>Personalize your volcanic trail journey with our master drivers.</span>
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
         RIGHT PANEL — Form Register
    ════════════════════════════════════════════════ -->
    <div class="auth-right">
        <div class="auth-right__inner">

            <!-- Heading -->
            <h2 class="auth-heading">Create account</h2>
            <p class="auth-subheading">Embark on your volcanic journey today.</p>

            <!-- Flash messages -->
            <?php if (session()->getFlashdata('error')): ?>
                <div class="auth-alert auth-alert--error" role="alert">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <!-- Validation errors -->
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

            <!-- Register Form -->
            <form id="register-form"
                  class="auth-form"
                  action="<?= base_url('auth/register') ?>"
                  method="POST"
                  novalidate>

                <?= csrf_field() ?>

                <!-- Full Name -->
                <div class="form-group">
                    <label class="form-label" for="reg-name">Full Name</label>
                    <div class="input-wrapper">
                        <input
                            type="text"
                            id="reg-name"
                            name="name"
                            class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>"
                            placeholder="Wayan Adventure"
                            value="<?= esc(old('name')) ?>"
                            autocomplete="name"
                            required
                            autofocus
                            minlength="3"
                            maxlength="100">
                    </div>
                    <?php if (isset($errors['name'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['name']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="reg-email">Email Address</label>
                    <div class="input-wrapper">
                        <input
                            type="email"
                            id="reg-email"
                            name="email"
                            class="form-control <?= isset($errors['email']) ? 'is-invalid' : '' ?>"
                            placeholder="explorer@bali.com"
                            value="<?= esc(old('email')) ?>"
                            autocomplete="email"
                            required>
                    </div>
                    <?php if (isset($errors['email'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['email']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- WhatsApp / Phone Number -->
                <div class="form-group">
                    <label class="form-label" for="reg-phone">WhatsApp Number</label>
                    <div class="input-wrapper">
                        <!-- Prefix flag (+62) -->
                        <span class="input-prefix">
                            <span class="input-prefix-flag">🇮🇩</span>
                            <span>+62</span>
                        </span>
                        <input
                            type="tel"
                            id="reg-phone"
                            name="phone"
                            class="form-control has-prefix <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                            placeholder="812-3456-7890"
                            value="<?= esc(old('phone')) ?>"
                            autocomplete="tel"
                            required
                            minlength="9"
                            maxlength="15"
                            pattern="[0-9\-\s]+">
                    </div>
                    <?php if (isset($errors['phone'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['phone']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="reg-password">Password</label>
                    <div class="input-wrapper">
                        <input
                            type="password"
                            id="reg-password"
                            name="password"
                            class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                            placeholder="••••••••"
                            autocomplete="new-password"
                            required
                            minlength="8">
                        <button type="button"
                                class="btn-toggle-password"
                                id="toggle-reg-password"
                                aria-label="Toggle password visibility"
                                tabindex="-1">
                            <i class="fa-regular fa-eye" id="toggle-reg-icon"></i>
                        </button>
                    </div>

                    <!-- Password strength indicator -->
                    <div class="password-strength-wrap" id="password-strength" aria-live="polite">
                        <div class="strength-bar-track">
                            <div class="strength-bar-fill" id="strength-fill"></div>
                        </div>
                        <div class="strength-info">
                            <span class="strength-label" id="strength-label">—</span>
                            <span class="strength-hint">Min. 8 characters</span>
                        </div>
                    </div>

                    <?php if (isset($errors['password'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['password']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Terms & Privacy checkbox -->
                <div class="form-group">
                    <label class="form-check" for="reg-terms">
                        <input type="checkbox"
                               class="form-check__input"
                               id="reg-terms"
                               name="agree_terms"
                               value="1"
                               required>
                        <span class="form-check__label">
                            I agree to the
                            <a href="#" target="_blank" rel="noopener">Terms of Service</a>
                            and
                            <a href="#" target="_blank" rel="noopener">Privacy Policy</a>.
                        </span>
                    </label>
                    <?php if (isset($errors['agree_terms'])): ?>
                        <span class="form-error">
                            <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                            <?= esc($errors['agree_terms']) ?>
                        </span>
                    <?php endif; ?>
                </div>

                <!-- Submit button -->
                <button type="submit"
                        id="btn-register"
                        class="btn-auth btn-auth--accent">
                    <span class="btn-text">Create Account</span>
                </button>

            </form>

            <!-- Switch to Login -->
            <div class="auth-divider" style="margin-top: 1.75rem;"></div>
            <p class="auth-switch" style="margin-top: 1.25rem;">
                Already have an account?
                <a href="<?= base_url('auth/login') ?>">Login</a>
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
    const toggleBtn  = document.getElementById('toggle-reg-password');
    const pwdInput   = document.getElementById('reg-password');
    const toggleIcon = document.getElementById('toggle-reg-icon');

    if (toggleBtn && pwdInput) {
        toggleBtn.addEventListener('click', function () {
            const isHidden = pwdInput.type === 'password';
            pwdInput.type  = isHidden ? 'text' : 'password';
            toggleIcon.className = isHidden
                ? 'fa-regular fa-eye-slash'
                : 'fa-regular fa-eye';
        });
    }

    // ── Password Strength Meter ────────────────────────────
    const strengthWrap  = document.getElementById('password-strength');
    const strengthFill  = document.getElementById('strength-fill');
    const strengthLabel = document.getElementById('strength-label');

    const strengthLevels = [
        { min: 0,  cls: '',          label: '—' },
        { min: 1,  cls: 'strength-1', label: 'WEAK PASSWORD' },
        { min: 2,  cls: 'strength-2', label: 'FAIR PASSWORD' },
        { min: 3,  cls: 'strength-3', label: 'GOOD PASSWORD' },
        { min: 4,  cls: 'strength-4', label: 'STRONG PASSWORD' },
    ];

    function calcStrength(value) {
        let score = 0;
        if (!value) return 0;
        if (value.length >= 8)            score++;
        if (/[A-Z]/.test(value))          score++;
        if (/[0-9]/.test(value))          score++;
        if (/[^A-Za-z0-9]/.test(value))   score++;
        return score;
    }

    if (pwdInput && strengthWrap) {
        pwdInput.addEventListener('input', function () {
            const score = calcStrength(this.value);
            const level = strengthLevels[score] || strengthLevels[0];

            // Remove all strength classes
            strengthWrap.classList.remove('strength-1','strength-2','strength-3','strength-4');

            if (score > 0) {
                strengthWrap.classList.add(level.cls);
                strengthLabel.textContent = level.label;
            } else {
                strengthLabel.textContent = '—';
            }
        });
    }

    // ── Phone number — remove non-numeric on paste ─────────
    const phoneInput = document.getElementById('reg-phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9\-\s]/g, '');
        });
    }

    // ── Loading state on submit ─────────────────────────────
    const registerForm = document.getElementById('register-form');
    const registerBtn  = document.getElementById('btn-register');

    if (registerForm && registerBtn) {
        registerForm.addEventListener('submit', function (e) {
            if (!registerForm.checkValidity()) return;
            registerBtn.classList.add('is-loading');
            setTimeout(function() { registerBtn.disabled = true; }, 10);
        });
    }

    // ── Animate alert dismissal ─────────────────────────────
    document.querySelectorAll('.auth-alert').forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = 'opacity 0.4s ease, max-height 0.4s ease, margin 0.4s ease, padding 0.4s ease';
            alert.style.opacity    = '0';
            alert.style.maxHeight  = '0';
            alert.style.margin     = '0';
            alert.style.padding    = '0';
        }, 5000);
    });

})();
</script>

<?= $this->endSection() ?>
