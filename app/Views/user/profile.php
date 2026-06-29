<?= $this->extend('layouts/user') ?>
<?= $this->section('content') ?>

<!--
 * View: user/profile.php
 * URL  : /user/profile
 * Desc : Account Settings — personal info, security, danger zone
-->

<!-- ════════════════════════════════════════════════════════
     PAGE HEADER
════════════════════════════════════════════════════════ -->
<div class="profile-header">
    <h1 class="profile-header__title" id="profile-page-title">Account Settings</h1>
    <div class="profile-header__actions">
        <a href="<?= base_url('user/dashboard') ?>" class="btn-profile-discard" id="btn-discard-profile">
            DISCARD
        </a>
        <button type="submit" form="profile-form" class="btn-profile-save" id="btn-save-profile">
            SAVE CHANGES
        </button>
    </div>
</div>

<!-- ── Flash messages ──────────────────────────────────────── -->
<?php if (session()->getFlashdata('success')): ?>
<div class="user-flash user-flash--success">
    <i class="fa-solid fa-circle-check"></i>
    <?= esc(session()->getFlashdata('success')) ?>
</div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')): ?>
<div class="user-flash user-flash--error">
    <i class="fa-solid fa-circle-exclamation"></i>
    <?= esc(session()->getFlashdata('error')) ?>
</div>
<?php endif; ?>


<!-- ════════════════════════════════════════════════════════
     2-COLUMN PROFILE LAYOUT
════════════════════════════════════════════════════════ -->
<form id="profile-form" action="<?= base_url('user/profile') ?>" method="POST" novalidate>
    <?= csrf_field() ?>

<div class="profile-layout">

    <!-- ══ LEFT: Avatar + Stats + Badge ══ -->
    <div class="profile-left">

        <!-- Avatar Card -->
        <div class="profile-avatar-card u-card" data-aos="fade-right">
            <div class="profile-avatar-wrap">
                <div class="profile-avatar" id="profile-avatar-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
            <p class="profile-avatar-name" id="profile-display-name"><?= esc($user_name) ?></p>
            <p class="profile-avatar-since">Gold Member since <?= esc($member_since) ?></p>
            <button type="button" class="btn-change-photo" id="btn-change-photo">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                CHANGE PHOTO
            </button>
        </div>

        <!-- Stats -->
        <div class="profile-stats-card u-card" data-aos="fade-right" data-delay="100">
            <div class="profile-stat-item">
                <p class="profile-stat-label">TOTAL TOURS</p>
                <div class="profile-stat-value"><?= esc($total_tours) ?></div>
            </div>
            <div class="profile-stat-item">
                <p class="profile-stat-label">MEMBER SINCE</p>
                <div class="profile-stat-value" style="font-size:1.1rem;"><?= esc($member_since) ?></div>
            </div>
        </div>

        <!-- Elite Explorer -->
        <div class="profile-elite-card" data-aos="fade-right" data-delay="200">
            <h3 class="profile-elite__title">Elite Explorer</h3>
            <p class="profile-elite__desc">You're 2 tours away from unlocking Private Sunrise Lounge access.</p>
            <div class="profile-elite__progress-bar">
                <div class="profile-elite__progress-fill" style="width: 80%;"></div>
            </div>
        </div>

    </div><!-- /.profile-left -->


    <!-- ══ RIGHT: Forms ══ -->
    <div class="profile-right">

        <!-- Personal Information -->
        <div class="profile-section-card" data-aos="fade-left" id="section-personal-info">
            <h2 class="profile-section-card__heading">
                <i class="fa-solid fa-id-card"></i>
                Personal Information
            </h2>

            <div class="profile-form-grid">
                <!-- Full Name -->
                <div class="profile-form-group">
                    <label class="profile-form-label" for="profile-name">FULL NAME</label>
                    <input
                        type="text"
                        id="profile-name"
                        name="name"
                        class="profile-form-input"
                        value="<?= esc($user_name) ?>"
                        placeholder="Your full name"
                        autocomplete="name"
                        required>
                </div>

                <!-- Email (read-only) -->
                <div class="profile-form-group">
                    <label class="profile-form-label" for="profile-email">EMAIL ADDRESS</label>
                    <input
                        type="email"
                        id="profile-email"
                        name="email"
                        class="profile-form-input"
                        value="<?= esc($user_email) ?>"
                        placeholder="your@email.com"
                        autocomplete="email"
                        disabled>
                    <small style="font-size:0.7rem; color:var(--gray-400); margin-top:0.2rem;">
                        Email cannot be changed. Contact support.
                    </small>
                </div>

                <!-- WhatsApp -->
                <div class="profile-form-group">
                    <label class="profile-form-label" for="profile-phone">WHATSAPP NUMBER</label>
                    <div class="profile-wa-wrap">
                        <span class="profile-wa-prefix">+62</span>
                        <input
                            type="tel"
                            id="profile-phone"
                            name="phone"
                            class="profile-wa-input"
                            value="<?= esc(ltrim($user_phone, '0+62')) ?>"
                            placeholder="8123456789"
                            autocomplete="tel">
                    </div>
                </div>

                <!-- Nationality -->
                <div class="profile-form-group">
                    <label class="profile-form-label" for="profile-nationality">NATIONALITY</label>
                    <select id="profile-nationality" name="nationality" class="profile-form-input profile-form-select">
                        <option value="Indonesia" selected>Indonesia</option>
                        <option value="Malaysia">Malaysia</option>
                        <option value="Singapore">Singapore</option>
                        <option value="Australia">Australia</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Germany">Germany</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="France">France</option>
                        <option value="Japan">Japan</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Security & Password -->
        <div class="profile-section-card" data-aos="fade-left" data-delay="100" id="section-security">
            <h2 class="profile-section-card__heading">
                <i class="fa-solid fa-shield-halved"></i>
                Security &amp; Password
            </h2>

            <div class="profile-form-grid">
                <!-- Current Password -->
                <div class="profile-form-group">
                    <label class="profile-form-label" for="current-password">CURRENT PASSWORD</label>
                    <div style="position:relative;">
                        <input
                            type="password"
                            id="current-password"
                            name="current_password"
                            class="profile-form-input"
                            placeholder="••••••••"
                            autocomplete="current-password">
                        <button type="button"
                                class="btn-toggle-pwd"
                                data-target="current-password"
                                style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--gray-400);">
                            <i class="fa-regular fa-eye" id="icon-current-pwd"></i>
                        </button>
                    </div>
                </div>

                <!-- New Password -->
                <div class="profile-form-group">
                    <label class="profile-form-label" for="new-password">NEW PASSWORD</label>
                    <div style="position:relative;">
                        <input
                            type="password"
                            id="new-password"
                            name="new_password"
                            class="profile-form-input"
                            placeholder="Min. 8 characters"
                            autocomplete="new-password"
                            oninput="checkPasswordStrength(this.value)">
                        <button type="button"
                                class="btn-toggle-pwd"
                                data-target="new-password"
                                style="position:absolute;right:0.75rem;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--gray-400);">
                            <i class="fa-regular fa-eye" id="icon-new-pwd"></i>
                        </button>
                    </div>
                    <span class="profile-form-error" id="pwd-min-error" style="display:none;">
                        <i class="fa-solid fa-circle-exclamation fa-xs"></i>
                        Password must be at least 8 characters.
                    </span>
                </div>

                <!-- Strength Meter (full width) -->
                <div class="profile-form-group" style="grid-column: 1 / -1;">
                    <label class="profile-form-label">STRENGTH</label>
                    <div class="profile-strength-bar">
                        <div class="profile-strength-fill profile-strength-fill--weak"
                             id="strength-fill" style="width:0%;"></div>
                    </div>
                    <p class="profile-strength-label profile-strength-label--weak"
                       id="strength-label" style="display:none;"></p>
                </div>
            </div>
        </div>

        <!-- Danger Zone -->
        <div class="profile-danger-card" data-aos="fade-left" data-delay="200" id="section-danger-zone">
            <div>
                <h2 class="profile-danger__title">Danger Zone</h2>
                <p class="profile-danger__desc">
                    Deleting your account is permanent. All your booking history, rewards, and credits
                    will be immediately lost and cannot be recovered.
                </p>
            </div>
            <button type="button" class="btn-delete-account" id="btn-delete-account">
                DELETE ACCOUNT
            </button>
        </div>

    </div><!-- /.profile-right -->

</div><!-- /.profile-layout -->

</form><!-- /#profile-form -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
(function() {
    'use strict';

    // ── Toggle password visibility ──────────────────────────
    document.querySelectorAll('.btn-toggle-pwd').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var targetId = this.dataset.target;
            var input    = document.getElementById(targetId);
            var icon     = this.querySelector('i');
            if (!input) return;
            var isHidden = input.type === 'password';
            input.type   = isHidden ? 'text' : 'password';
            icon.className = isHidden ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    });

    // ── Password strength meter ─────────────────────────────
    window.checkPasswordStrength = function(pwd) {
        var fill   = document.getElementById('strength-fill');
        var label  = document.getElementById('strength-label');
        var errMsg = document.getElementById('pwd-min-error');

        if (!fill || !label) return;

        if (pwd.length === 0) {
            fill.style.width = '0%';
            label.style.display = 'none';
            if (errMsg) errMsg.style.display = 'none';
            return;
        }

        if (pwd.length < 8) {
            if (errMsg) errMsg.style.display = 'flex';
        } else {
            if (errMsg) errMsg.style.display = 'none';
        }

        label.style.display = 'block';
        var score = 0;
        if (pwd.length >= 8)  score++;
        if (/[A-Z]/.test(pwd)) score++;
        if (/[0-9]/.test(pwd)) score++;
        if (/[^A-Za-z0-9]/.test(pwd)) score++;

        var levels = {
            1: { w: '25%', cls: 'weak',   text: 'Weak' },
            2: { w: '55%', cls: 'medium', text: 'Medium' },
            3: { w: '75%', cls: 'medium', text: 'Good' },
            4: { w: '100%',cls: 'strong', text: 'Strong' },
        };
        var level  = levels[score] || levels[1];
        fill.style.width = level.w;
        fill.className   = 'profile-strength-fill profile-strength-fill--' + level.cls;
        label.className  = 'profile-strength-label profile-strength-label--' + level.cls;
        label.textContent = level.text;
    };

    // ── Live name update ────────────────────────────────────
    var nameInput    = document.getElementById('profile-name');
    var displayName  = document.getElementById('profile-display-name');
    if (nameInput && displayName) {
        nameInput.addEventListener('input', function() {
            displayName.textContent = this.value || 'Traveler';
        });
    }

    // ── Delete account confirm ──────────────────────────────
    var deleteBtn = document.getElementById('btn-delete-account');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            if (confirm('Are you absolutely sure? This action CANNOT be undone. All your data will be permanently deleted.')) {
                alert('Account deletion request submitted. Our team will contact you within 24 hours.');
            }
        });
    }

})();
</script>
<?= $this->endSection() ?>