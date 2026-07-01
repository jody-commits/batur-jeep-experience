<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/booking.css') ?>">
    <meta name="robots" content="index, follow">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--
 * View: booking/index.php
 * URL  : /booking  (GET)
 * Desc : Halaman "Book Your Adventure"
 *        - Left  : selected package card + form personal info + guest counter
 *        - Right : sticky order summary + included items
-->

<div class="booking-page" id="booking-page">
<div class="container">

    <!-- Page Header -->
    <div class="booking-page__header">
        <h1 class="booking-page__title">Book Your Adventure</h1>
        <p class="booking-page__subtitle">Secure your spot for the ultimate Balinese sunrise expedition.</p>
    </div>

    <!-- Validation errors (if any) -->
    <?php if (session()->has('errors')): ?>
    <div class="booking-errors" id="booking-errors">
        <?php foreach (session('errors') as $err): ?>
        <p><i class="fa-solid fa-circle-exclamation"></i> <?= esc($err) ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Main 2-column layout -->
    <div class="booking-layout">

        <!-- ══════════════════════════════
             LEFT: Form Column
        ══════════════════════════════ -->
        <div class="booking-left">

            <!-- Package Summary Card -->
            <div class="booking-package-card" id="booking-pkg-card">
                <span class="booking-pkg-eyebrow">Selected Tour</span>

                <div class="booking-pkg-row">
                    <div>
                        <h2 class="booking-pkg-name" id="pkg-display-name"><?= esc($selected['name']) ?></h2>
                        <div class="booking-pkg-full-desc" id="pkg-display-full-desc">
                            <?= esc($selected['description']) ?>
                        </div>
                    </div>
                    <div class="booking-pkg-price-container">
                        <div class="booking-pkg-price-wrap">
                            <div class="booking-pkg-price-label">Starting From</div>
                            <div class="booking-pkg-price" id="pkg-display-price">Rp <?= number_format($selected['price'], 0, ',', '.') ?></div>
                        </div>
                        <button class="booking-pkg-change" id="btn-change-pkg" type="button" title="Change package" aria-label="Change package">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                    </div>
                </div>

                <!-- Package Selector (hidden by default) -->
                <div class="booking-pkg-selector" id="booking-pkg-selector">
                    <p class="pkg-select-title">Choose a Package</p>
                    <div class="pkg-select-list">
                        <?php foreach ($packages as $pkg): ?>
                        <div class="pkg-select-item<?= $pkg['id'] === $selectedId ? ' is-active' : '' ?>"
                             data-pkg-id="<?= $pkg['id'] ?>"
                             data-pkg-name="<?= esc($pkg['name']) ?>"
                             data-pkg-fulldesc="<?= esc($pkg['description']) ?>"
                             data-pkg-price="<?= $pkg['price'] ?>"
                             data-pkg-price-fmt="Rp <?= number_format($pkg['price'], 0, ',', '.') ?>"
                             data-pkg-image="<?= base_url('assets/images/' . $pkg['image']) ?>"
                             data-pkg-img2="<?= !empty($pkg['image2']) ? base_url('assets/images/' . $pkg['image2']) : '' ?>"
                             data-pkg-img3="<?= !empty($pkg['image3']) ? base_url('assets/images/' . $pkg['image3']) : '' ?>"
                             data-pkg-img4="<?= !empty($pkg['image4']) ? base_url('assets/images/' . $pkg['image4']) : '' ?>"
                             data-pkg-pickup="<?= esc($pkg['pickup_time'] ?? '') ?>"
                             data-pkg-included="<?= esc(implode('||', $pkg['included'])) ?>">
                            <span class="pkg-select-item-name"><?= esc($pkg['name']) ?></span>
                            <span class="pkg-select-item-price">Rp <?= number_format($pkg['price'], 0, ',', '.') ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div><!-- /.booking-package-card -->

            <!-- Personal Info Form -->
            <div class="booking-form-card">
                <h2 class="booking-form-title">Personal Information</h2>

                <form action="<?= base_url('booking') ?>" method="post" id="booking-form" novalidate>
                    <?= csrf_field() ?>
                    <input type="hidden" name="package_id" id="form-pkg-id" value="<?= $selectedId ?>">

                    <!-- Row 1: Name + WhatsApp -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input
                                type="text"
                                name="full_name"
                                id="full_name"
                                class="form-input"
                                placeholder="e.g. Alexander Pierce"
                                value="<?= old('full_name') ?>"
                                autocomplete="name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="whatsapp" class="form-label">WhatsApp Number</label>
                            <div class="form-input-icon-wrap" style="display: block;">
                                <input
                                    type="tel"
                                    name="whatsapp"
                                    id="whatsapp"
                                    class="form-input"
                                    placeholder="+62 812 3456 789"
                                    value="<?= old('whatsapp') ?>"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: Email + Tour Date -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-input"
                                placeholder="alex@adventure.com"
                                value="<?= old('email') ?>"
                                autocomplete="email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="tour_date" class="form-label">Tour Date</label>
                            <div class="form-input-icon-wrap">
                                <input
                                    type="date"
                                    name="tour_date"
                                    id="tour_date"
                                    class="form-input"
                                    min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                                    value="<?= old('tour_date') ?>"
                                    required>
                                <span class="form-input-suffix"><i class="fa-regular fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>

                    <!-- Hotel Pickup Toggle -->
                    <label class="form-toggle-wrap" for="need_pickup" id="pickup-toggle-wrap">
                        <span class="toggle-switch">
                            <input type="checkbox" name="need_pickup" id="need_pickup" value="1"
                                   <?= old('need_pickup') ? 'checked' : '' ?>>
                            <span class="toggle-track"></span>
                        </span>
                        <span class="toggle-label">I need hotel pick-up (Kuta, Seminyak, Ubud area)</span>
                    </label>

                    <!-- Hotel Name / Location (Hidden by default) -->
                    <div class="form-group" id="hotel-input-group" style="display: <?= old('need_pickup') ? 'block' : 'none' ?>; margin-top: 1rem;">
                        <label for="hotel_name" class="form-label">Hotel Name / Pickup Location</label>
                        <input
                            type="text"
                            name="hotel_name"
                            id="hotel_name"
                            class="form-input"
                            placeholder="e.g. Padma Resort Ubud"
                            value="<?= old('hotel_name') ?>"
                            <?= old('need_pickup') ? 'required' : '' ?>>
                    </div>

                    <!-- Number of Guests -->
                    <div class="guest-counter-wrap">
                        <span class="guest-counter-label">Number of Guests</span>
                        <span class="guest-counter-hint">Maximum 3 people per Jeep — more guests = more Jeeps added automatically</span>
                        <div class="guest-counter">
                            <button type="button" class="guest-counter__btn" id="guest-minus" aria-label="Decrease guests">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <input type="number" name="num_guests" id="num_guests"
                                   class="guest-counter__val"
                                   value="<?= old('num_guests', 2) ?>"
                                   min="1" max="18" readonly aria-label="Number of guests">
                            <button type="button" class="guest-counter__btn" id="guest-plus" aria-label="Increase guests">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        <!-- Jeep indicator — shown when >3 guests -->
                        <div class="jeep-indicator" id="jeep-indicator" style="display:none;">
                            <i class="fa-solid fa-truck-monster"></i>
                            <span id="jeep-indicator-text">2 Jeeps needed</span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-confirm-reservation" id="btn-confirm-reservation">
                        Confirm Reservation
                    </button>

                </form><!-- /#booking-form -->
            </div><!-- /.booking-form-card -->

        </div><!-- /.booking-left -->


        <!-- ══════════════════════════════
             RIGHT: Order Summary (sticky)
        ══════════════════════════════ -->
        <div class="booking-right">
            <div class="booking-summary-card">

                <!-- Jeep / Package Image -->
                <div class="booking-gallery-wrapper" id="gallery-wrapper">
                    <div class="booking-summary-img" id="summary-img-wrap">
                        <img src="<?= base_url('assets/images/' . $selected['image']) ?>" id="summary-main-img" alt="<?= esc($selected['name']) ?>">
                    </div>
                    
                    <button type="button" class="btn-view-more-pics" id="btn-view-more" style="display: <?= !empty($selected['image2']) ? 'flex' : 'none' ?>;">
                        <i class="fa-solid fa-images"></i> View more pictures
                    </button>
                    
                    <div class="booking-summary-img-badge" style="z-index: 10;">Expedition Summary</div>
                </div>

                <div class="booking-summary-body">
                    <!-- Price breakdown -->
                    <div class="booking-summary-rows" id="summary-rows">
                        <div class="booking-summary-row">
                            <span>Base Package (per Jeep)</span>
                            <span id="summary-base-price">Rp <?= number_format($selected['price'], 0, ',', '.') ?></span>
                        </div>
                        <div class="booking-summary-row">
                            <span>Guests (<span id="summary-guest-count">2</span> pax)</span>
                            <span>Included</span>
                        </div>
                        <div class="booking-summary-row" id="summary-jeep-row" style="display:none;">
                            <span>Jeeps Required</span>
                            <span id="summary-jeep-count">× 1</span>
                        </div>
                        <div class="booking-summary-row" id="pickup-row" style="display:none;">
                            <span>Hotel Pickup</span>
                            <span class="free-tag">Free</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="booking-summary-total-row">
                        <span class="booking-summary-total-label">Total Price</span>
                        <span class="booking-summary-total-price" id="summary-total">Rp <?= number_format($selected['price'], 0, ',', '.') ?></span>
                    </div>

                    <!-- Instant confirmation badge -->
                    <div class="booking-instant-badge">
                        <i class="fa-solid fa-circle-check"></i>
                        <div class="booking-instant-badge-text">
                            <strong>Instant Confirmation</strong>
                            <p>Book now to lock in this special early bird price for your selected date.</p>
                        </div>
                    </div>

                    <!-- Payment info badge -->
                    <div class="booking-instant-badge" style="background: #f0fdf4; border: 1px solid #bbf7d0; margin-top: 10px;">
                        <i class="fa-solid fa-wallet" style="color: #16a34a;"></i>
                        <div class="booking-instant-badge-text">
                            <strong style="color: #166534;">Payment on the spot</strong>
                            <p style="color: #15803d;">You can pay via Cash or Credit Card when you arrive.</p>
                        </div>
                    </div>

                    <!-- Included items -->
                    <ul class="booking-included-list" id="summary-included">
                        <?php if (!empty($selected['pickup_time'])): ?>
                        <li>
                            <i class="fa-regular fa-clock"></i>
                            Pickup Time: <strong><?= esc($selected['pickup_time']) ?></strong>
                        </li>
                        <?php endif; ?>
                        
                        <?php foreach ($selected['included'] as $item): ?>
                        <li>
                            <i class="fa-regular fa-circle-check"></i>
                            <?= esc($item) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                </div><!-- /.booking-summary-body -->
            </div><!-- /.booking-summary-card -->
        </div><!-- /.booking-right -->

    </div><!-- /.booking-layout -->
</div>

<!-- ── Lightbox Modal ── -->
<div class="lightbox-modal" id="lightbox-modal">
    <button class="lightbox-close" id="lightbox-close"><i class="fa-solid fa-xmark"></i></button>
    <div class="lightbox-content">
        <button class="lightbox-nav prev" id="lightbox-prev"><i class="fa-solid fa-chevron-left"></i></button>
        <div id="lightbox-images-container">
            <img src="<?= base_url('assets/images/' . $selected['image']) ?>" class="lightbox-img is-active">
            <?php if (!empty($selected['image2'])): ?>
            <img src="<?= base_url('assets/images/' . $selected['image2']) ?>" class="lightbox-img">
            <?php endif; ?>
            <?php if (!empty($selected['image3'])): ?>
            <img src="<?= base_url('assets/images/' . $selected['image3']) ?>" class="lightbox-img">
            <?php endif; ?>
            <?php if (!empty($selected['image4'])): ?>
            <img src="<?= base_url('assets/images/' . $selected['image4']) ?>" class="lightbox-img">
            <?php endif; ?>
        </div>
        <button class="lightbox-nav next" id="lightbox-next"><i class="fa-solid fa-chevron-right"></i></button>
    </div>
</div><!-- /.container -->
</div><!-- /.booking-page -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
/**
 * Booking Page — Interactive JS
 * - Package selector toggle & switch
 * - Guest counter (+/-)
 * - Live price update in summary
 * - Toggle pickup row
 */
(function () {
    'use strict';

    /* ── State ── */
    var currentPrice = <?= $selected['price'] ?>;

    /* ── Helper: populate lightbox from a pkg-select-item element ── */
    function initLightboxFromItem(item) {
        if (!item) return;
        var imgSrc = item.getAttribute('data-pkg-image');
        var img2   = item.getAttribute('data-pkg-img2');
        var img3   = item.getAttribute('data-pkg-img3');
        var img4   = item.getAttribute('data-pkg-img4');

        var lbContainer = document.getElementById('lightbox-images-container');
        var lbHtml = '<img src="' + imgSrc + '" class="lightbox-img is-active">';
        var imgCount = 1;
        if (img2 && img2.trim() !== '') { lbHtml += '<img src="' + img2 + '" class="lightbox-img">'; imgCount++; }
        if (img3 && img3.trim() !== '') { lbHtml += '<img src="' + img3 + '" class="lightbox-img">'; imgCount++; }
        if (img4 && img4.trim() !== '') { lbHtml += '<img src="' + img4 + '" class="lightbox-img">'; imgCount++; }
        lbContainer.innerHTML = lbHtml;

        var btnMore = document.getElementById('btn-view-more');
        if (btnMore) {
            btnMore.style.display = imgCount > 1 ? 'flex' : 'none';
        }
    }

    /* ── Package Selector ── */
    var btnChangePkg  = document.getElementById('btn-change-pkg');
    var pkgSelector   = document.getElementById('booking-pkg-selector');
    var pkgItems      = document.querySelectorAll('.pkg-select-item');

    // Initialize lightbox from the ACTIVE package on page load
    var activeItem = document.querySelector('.pkg-select-item.is-active');
    initLightboxFromItem(activeItem);

    if (btnChangePkg) {
        btnChangePkg.addEventListener('click', function () {
            pkgSelector.classList.toggle('is-open');
        });
    }

    pkgItems.forEach(function (item) {
        item.addEventListener('click', function () {
            // Update active state
            pkgItems.forEach(function (i) { i.classList.remove('is-active'); });
            item.classList.add('is-active');

            // Read data
            var id      = item.getAttribute('data-pkg-id');
            var name    = item.getAttribute('data-pkg-name');
            var fullDesc= item.getAttribute('data-pkg-fulldesc');
            var price   = parseInt(item.getAttribute('data-pkg-price'), 10);
            var priceFmt= item.getAttribute('data-pkg-price-fmt');
            var imgSrc  = item.getAttribute('data-pkg-image');
            var img2    = item.getAttribute('data-pkg-img2');
            var img3    = item.getAttribute('data-pkg-img3');
            var img4    = item.getAttribute('data-pkg-img4');
            var pickupT = item.getAttribute('data-pkg-pickup');
            var included= item.getAttribute('data-pkg-included').split('||');

            // Update card header
            document.getElementById('pkg-display-name').textContent = name;
            document.getElementById('pkg-display-full-desc').textContent = fullDesc;
            document.getElementById('pkg-display-price').textContent = priceFmt;
            document.getElementById('form-pkg-id').value = id;

            // Update summary image and lightbox
            var mainImg = document.getElementById('summary-main-img');
            mainImg.src = imgSrc;
            mainImg.alt = name;
            
            // Update lightbox using the shared helper
            initLightboxFromItem(item);

            // Update included list
            var incList = document.getElementById('summary-included');
            incList.innerHTML = '';
            
            if (pickupT && pickupT.trim() !== '') {
                var pickupLi = document.createElement('li');
                pickupLi.innerHTML = '<i class="fa-regular fa-clock"></i> Pickup Time: <strong>' + pickupT + '</strong>';
                incList.appendChild(pickupLi);
            }
            
            included.forEach(function (inc) {
                var li = document.createElement('li');
                li.innerHTML = '<i class="fa-regular fa-circle-check"></i> ' + inc;
                incList.appendChild(li);
            });

            currentPrice = price;
            updateTotal();

            // Close selector
            pkgSelector.classList.remove('is-open');
        });
    });

    /* ── Guest Counter (max 3 per jeep, unlimited jeeps) ── */
    var guestInput   = document.getElementById('num_guests');
    var minusBtn     = document.getElementById('guest-minus');
    var plusBtn      = document.getElementById('guest-plus');
    var summaryGuest = document.getElementById('summary-guest-count');
    var jeepIndicator    = document.getElementById('jeep-indicator');
    var jeepIndicatorTxt = document.getElementById('jeep-indicator-text');
    var summaryJeepRow   = document.getElementById('summary-jeep-row');
    var summaryJeepCount = document.getElementById('summary-jeep-count');

    var MAX_PER_JEEP = 3;

    function calcJeeps(guests) {
        return Math.ceil(guests / MAX_PER_JEEP);
    }

    function updateGuestDisplay() {
        var guests = parseInt(guestInput.value, 10);
        var jeeps  = calcJeeps(guests);

        // Summary guest count
        if (summaryGuest) summaryGuest.textContent = guests;

        // Jeep indicator badge (below counter)
        if (guests > MAX_PER_JEEP) {
            jeepIndicator.style.display = '';
            jeepIndicatorTxt.textContent = jeeps + ' Jeeps needed';
        } else {
            jeepIndicator.style.display = 'none';
        }

        // Summary jeep row (right panel)
        if (jeeps > 1) {
            summaryJeepRow.style.display = '';
            summaryJeepCount.textContent = '× ' + jeeps + ' Jeeps';
        } else {
            summaryJeepRow.style.display = 'none';
        }

        updateTotal();
    }

    if (minusBtn) {
        minusBtn.addEventListener('click', function () {
            var val = parseInt(guestInput.value, 10);
            if (val > 1) { guestInput.value = val - 1; updateGuestDisplay(); }
        });
    }
    if (plusBtn) {
        plusBtn.addEventListener('click', function () {
            var val = parseInt(guestInput.value, 10);
            if (val < 18) { guestInput.value = val + 1; updateGuestDisplay(); }
        });
    }

    /* ── Hotel Pickup Toggle ── */
    var pickupToggle = document.getElementById('need_pickup');
    var pickupRow    = document.getElementById('pickup-row');
    var hotelInputGrp= document.getElementById('hotel-input-group');
    var hotelInput   = document.getElementById('hotel_name');
    if (pickupToggle) {
        pickupToggle.addEventListener('change', function () {
            if (pickupRow) pickupRow.style.display = this.checked ? '' : 'none';
            if (hotelInputGrp) hotelInputGrp.style.display = this.checked ? 'block' : 'none';
            if (hotelInput) hotelInput.required = this.checked;
        });
    }

    /* ── Update Total Price (price × jumlah jeep) ── */
    function formatRupiah(num) {
        return 'Rp ' + num.toLocaleString('id-ID');
    }

    function updateTotal() {
        var guests    = parseInt(guestInput.value, 10);
        var jeeps     = calcJeeps(guests);
        var total     = currentPrice * jeeps;
        var totalEl   = document.getElementById('summary-total');
        var baseEl    = document.getElementById('summary-base-price');
        if (totalEl)  totalEl.textContent = formatRupiah(total);
        if (baseEl)   baseEl.textContent  = formatRupiah(currentPrice);
    }

    /* ── Date min = tomorrow ── */
    var dateInput = document.getElementById('tour_date');
    if (dateInput && !dateInput.value) {
        var tmr = new Date();
        tmr.setDate(tmr.getDate() + 1);
        var yyyy = tmr.getFullYear();
        var mm = String(tmr.getMonth() + 1).padStart(2, '0');
        var dd = String(tmr.getDate()).padStart(2, '0');
        dateInput.value = yyyy + '-' + mm + '-' + dd;
    }

    /* ── Lightbox JS ── */
    var btnViewMore = document.getElementById('btn-view-more');
    var lightbox = document.getElementById('lightbox-modal');
    var lbClose = document.getElementById('lightbox-close');
    var lbPrev = document.getElementById('lightbox-prev');
    var lbNext = document.getElementById('lightbox-next');
    var lbContainer = document.getElementById('lightbox-images-container');
    
    var currentLbIndex = 0;
    
    function showLightboxImg(index) {
        var imgs = lbContainer.querySelectorAll('.lightbox-img');
        if (imgs.length === 0) return;
        imgs.forEach(function(img) { img.classList.remove('is-active'); });
        if (index >= imgs.length) currentLbIndex = 0;
        if (index < 0) currentLbIndex = imgs.length - 1;
        imgs[currentLbIndex].classList.add('is-active');
    }

    if (btnViewMore) {
        btnViewMore.addEventListener('click', function(e) {
            e.preventDefault();
            currentLbIndex = 0;
            showLightboxImg(currentLbIndex);
            lightbox.classList.add('is-active');
            document.body.style.overflow = 'hidden'; // prevent scrolling behind modal
        });
    }
    
    if (lbClose) {
        lbClose.addEventListener('click', function() {
            lightbox.classList.remove('is-active');
            document.body.style.overflow = '';
        });
    }
    
    if (lbPrev) {
        lbPrev.addEventListener('click', function(e) {
            e.stopPropagation();
            currentLbIndex--;
            showLightboxImg(currentLbIndex);
        });
    }
    
    if (lbNext) {
        lbNext.addEventListener('click', function(e) {
            e.stopPropagation();
            currentLbIndex++;
            showLightboxImg(currentLbIndex);
        });
    }
    
    // Close when clicking outside image
    if (lightbox) {
        lightbox.addEventListener('click', function(e) {
            if (e.target === lightbox || e.target.classList.contains('lightbox-content')) {
                lightbox.classList.remove('is-active');
                document.body.style.overflow = '';
            }
        });
    }

}());
</script>
<?= $this->endSection() ?>
