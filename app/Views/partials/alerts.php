<!--
 * Partial: partials/alerts.php
 * Desc   : Flash messages & alert notifications (CI4 session flashdata)
-->

<?php if (session()->getFlashdata('success')): ?>
    <div class="flash-alert flash-alert--success" role="alert" id="flash-success">
        <div class="flash-alert__icon"><i class="fa-solid fa-circle-check"></i></div>
        <div class="flash-alert__content">
            <strong>Berhasil!</strong>
            <?= esc(session()->getFlashdata('success')) ?>
        </div>
        <button class="flash-alert__close" onclick="this.parentElement.remove()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="flash-alert flash-alert--error" role="alert" id="flash-error">
        <div class="flash-alert__icon"><i class="fa-solid fa-circle-exclamation"></i></div>
        <div class="flash-alert__content">
            <strong>Terjadi Kesalahan!</strong>
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
        <button class="flash-alert__close" onclick="this.parentElement.remove()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('info')): ?>
    <div class="flash-alert flash-alert--info" role="alert" id="flash-info">
        <div class="flash-alert__icon"><i class="fa-solid fa-circle-info"></i></div>
        <div class="flash-alert__content">
            <?= esc(session()->getFlashdata('info')) ?>
        </div>
        <button class="flash-alert__close" onclick="this.parentElement.remove()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('warning')): ?>
    <div class="flash-alert flash-alert--warning" role="alert" id="flash-warning">
        <div class="flash-alert__icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
        <div class="flash-alert__content">
            <?= esc(session()->getFlashdata('warning')) ?>
        </div>
        <button class="flash-alert__close" onclick="this.parentElement.remove()" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
<?php endif; ?>
