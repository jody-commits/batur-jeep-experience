<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/fleet.css') ?>">
    <meta name="robots" content="index, follow">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--
 * View: fleet/index.php
 * URL  : /fleet
 * Desc : Halaman Our Fleet — card grid 3 kolom dengan availability status,
 *        safety standards section, CTA "Our fleet is ready"
 *        Design: Batur Jeep Experience
-->

<!-- ════════════════════════════════════════════════════════
     HERO BANNER — Jeep lineup photo background
════════════════════════════════════════════════════════ -->
<section class="page-hero fleet-hero" id="fleet-hero" aria-labelledby="fleet-page-title">
    <div class="page-hero__bg" style="background-image: url('<?= base_url('assets/images/jeep-hero.jpg') ?>'); background-position: center 40%;"></div>

    <!-- Layered dark-to-transparent overlay -->
    <div class="fleet-hero__overlay"></div>

    <div class="page-hero__content">
        <nav class="page-hero__breadcrumb" aria-label="Breadcrumb">
            <a href="<?= base_url('/') ?>">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Our Fleet</span>
        </nav>

        <h1 class="page-hero__title" id="fleet-page-title">Our Fleet</h1>
        <p class="page-hero__subtitle">
            <em>Engineered for the rugged terrain of Kintamani. Our custom-outfitted<br>
            vehicles offer safety without compromising on the thrill.</em>
        </p>

        <!-- Quick stats inside hero -->
        <div class="fleet-hero__stats" data-aos="fade-up" data-delay="200">
            <div class="fleet-hero__stat">
                <strong><?= count($fleet) ?></strong>
                <span>Total Jeeps</span>
            </div>
            <div class="fleet-hero__stat-div"></div>
            <div class="fleet-hero__stat">
                <strong><?= $available_count ?></strong>
                <span>Available Now</span>
            </div>
            <div class="fleet-hero__stat-div"></div>
            <div class="fleet-hero__stat">
                <strong>4 Seats</strong>
                <span>Max Capacity</span>
            </div>
            <div class="fleet-hero__stat-div"></div>
            <div class="fleet-hero__stat">
                <strong>2019+</strong>
                <span>Model Year</span>
            </div>
        </div>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     FILTER BAR — Status filter
════════════════════════════════════════════════════════ -->
<div class="fleet-filter-bar" id="fleet-filter-bar" aria-label="Filter fleet">
    <div class="container">
        <div class="fleet-filter-bar__inner">
            <div class="fleet-filter-pills" id="fleet-filter-pills">
                <button class="fleet-filter-pill is-active" data-filter="all" id="flt-all">
                    All Jeeps <span class="fleet-pill-count"><?= count($fleet) ?></span>
                </button>
                <button class="fleet-filter-pill" data-filter="available" id="flt-available">
                    <i class="fa-solid fa-circle" style="color:#52B788; font-size:.55rem;"></i>
                    Available <span class="fleet-pill-count"><?= $available_count ?></span>
                </button>
                <button class="fleet-filter-pill" data-filter="rented" id="flt-rented">
                    <i class="fa-solid fa-circle" style="color:#F4A261; font-size:.55rem;"></i>
                    On Expedition <span class="fleet-pill-count"><?= count($fleet) - $available_count ?></span>
                </button>
            </div>
            <p class="fleet-filter-bar__note">
                <i class="fa-solid fa-rotate"></i> Availability updates daily
            </p>
        </div>
    </div>
</div>


<!-- ════════════════════════════════════════════════════════
     FLEET GRID — Card 3 columns
════════════════════════════════════════════════════════ -->
<section class="fleet-list-section" id="fleet-list" aria-label="Jeep fleet list">
    <div class="container">

        <div class="fleet-card-grid" id="fleet-card-grid">

            <?php foreach ($fleet as $i => $jeep): ?>
            <!-- Jeep Card: <?= esc($jeep['name']) ?> -->
            <article
                class="fleet-jeep-card<?= $jeep['status'] === 'rented' ? ' fleet-jeep-card--rented' : '' ?>"
                id="jeep-card-<?= $jeep['id'] ?>"
                data-status="<?= esc($jeep['status']) ?>"
                data-aos="fade-up"
                data-delay="<?= ($i % 3) * 120 ?>"
            >
                <!-- ── Image Section ── -->
                <div class="fleet-jeep-card__img-wrap">
                    <div class="fleet-jeep-card__img"
                         style="background-image: url('<?= base_url('assets/images/' . $jeep['image']) ?>');"></div>

                    <!-- Status Badge -->
                    <div class="fleet-jeep-card__status fleet-jeep-card__status--<?= $jeep['status'] ?>">
                        <i class="fa-solid fa-circle fleet-status-dot"></i>
                        <?= $jeep['status'] === 'available' ? 'Available' : 'On Expedition' ?>
                    </div>

                    <?php if ($jeep['is_featured']): ?>
                    <div class="fleet-jeep-card__featured-ribbon">
                        <i class="fa-solid fa-star"></i> Featured
                    </div>
                    <?php endif; ?>

                    <!-- Overlay for rented jeeps -->
                    <?php if ($jeep['status'] === 'rented'): ?>
                    <div class="fleet-jeep-card__rented-overlay">
                        <i class="fa-solid fa-route"></i>
                        <span>Currently on expedition</span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- ── Card Body ── -->
                <div class="fleet-jeep-card__body">

                    <!-- Header row: name + plate -->
                    <div class="fleet-jeep-card__header">
                        <div class="fleet-jeep-card__name-wrap">
                            <h2 class="fleet-jeep-card__name"><?= esc($jeep['name']) ?></h2>
                            <span class="fleet-jeep-card__type"><?= esc($jeep['type']) ?> · <?= $jeep['year'] ?></span>
                        </div>
                        <div class="fleet-jeep-card__plate"><?= esc($jeep['plate']) ?></div>
                    </div>

                    <!-- Color + Passengers -->
                    <div class="fleet-jeep-card__meta">
                        <span class="fleet-meta-item">
                            <span class="fleet-color-dot" style="background:<?= esc($jeep['color_code']) ?>;"></span>
                            <?= esc($jeep['color']) ?>
                        </span>
                        <span class="fleet-meta-item">
                            <i class="fa-solid fa-users"></i>
                            <?= $jeep['passengers'] ?> + Driver Passengers
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="fleet-jeep-card__desc"><?= esc($jeep['description']) ?></p>

                    <!-- Facilities / Equipment Tags -->
                    <div class="fleet-jeep-card__facilities">
                        <?php foreach ($jeep['facilities'] as $facility): ?>
                        <span class="fleet-facility-tag">
                            <i class="fa-solid fa-circle-check"></i>
                            <?= esc($facility) ?>
                        </span>
                        <?php endforeach; ?>
                    </div>

                    <!-- CTA -->
                    <div class="fleet-jeep-card__cta">
                        <?php if ($jeep['status'] === 'available'): ?>
                            <a href="<?= base_url('booking') ?>"
                               class="fleet-book-btn"
                               id="fleet-book-<?= $jeep['id'] ?>">
                                <i class="fa-solid fa-calendar-check"></i>
                                Book This Jeep
                            </a>
                        <?php else: ?>
                            <span class="fleet-unavail-msg">
                                <i class="fa-solid fa-hourglass-half"></i>
                                Available Tomorrow
                            </span>
                            <a href="<?= base_url('packages') ?>"
                               class="fleet-alt-btn"
                               id="fleet-other-<?= $jeep['id'] ?>">
                                View Other Options
                            </a>
                        <?php endif; ?>
                    </div>

                </div><!-- /.fleet-jeep-card__body -->
            </article>
            <?php endforeach; ?>

        </div><!-- /#fleet-card-grid -->

    </div><!-- /.container -->
</section>


<!-- ════════════════════════════════════════════════════════
     SAFETY STANDARDS SECTION
════════════════════════════════════════════════════════ -->
<section class="fleet-safety" id="fleet-safety" aria-labelledby="safety-heading">
    <div class="fleet-safety__bg"></div>
    <div class="container">

        <div class="section-header section-header--white" data-aos="fade-up">
            <span class="section-header__eyebrow section-header__eyebrow--light">Our Commitment</span>
            <h2 class="section-header__title" id="safety-heading" style="color:#fff;">
                Safety is Our First Priority
            </h2>
            <p class="section-header__desc" style="color:rgba(255,255,255,0.75);">
                Every vehicle meets and exceeds Indonesian transport safety standards.
                We take no shortcuts when your adventure is at stake.
            </p>
        </div>

        <div class="fleet-safety__grid">
            <?php foreach ($safety_features as $j => $feat): ?>
            <div class="fleet-safety__card" data-aos="fade-up" data-delay="<?= $j * 100 ?>">
                <div class="fleet-safety__icon-wrap">
                    <i class="fa-solid <?= esc($feat['icon']) ?>"></i>
                </div>
                <h3 class="fleet-safety__card-title"><?= esc($feat['title']) ?></h3>
                <p class="fleet-safety__card-desc"><?= esc($feat['desc']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     CTA — "Our fleet is ready"
════════════════════════════════════════════════════════ -->
<section class="fleet-ready-section" id="fleet-ready" aria-labelledby="fleet-ready-heading">
    <div class="container">

        <div class="fleet-ready__inner" data-aos="fade-up">
            <div class="fleet-ready__decoration" aria-hidden="true">
                <i class="fa-solid fa-car-side"></i>
            </div>
            <h2 class="fleet-ready__title" id="fleet-ready-heading">
                Our fleet is ready
            </h2>
            <p class="fleet-ready__desc">
                Every vehicle undergoes daily maintenance to ensure peak performance
                for your sunrise adventure. Book your seat in Batur's finest Jeep lineup today.
            </p>

            <div class="fleet-ready__actions">
                <a href="<?= base_url('booking') ?>" class="btn-fleet-book" id="fleet-ready-book">
                    <i class="fa-solid fa-calendar-check"></i>
                    Book Now
                </a>
                <a href="<?= base_url('packages') ?>" class="btn-fleet-packages" id="fleet-ready-packages">
                    <i class="fa-solid fa-compass"></i>
                    View Packages First
                </a>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
/**
 * Fleet Page — Filter by availability status
 */
(function () {
    'use strict';

    var pills   = document.querySelectorAll('.fleet-filter-pill');
    var cards   = document.querySelectorAll('.fleet-jeep-card');
    var current = 'all';

    function applyFilter(filter) {
        current = filter;
        cards.forEach(function (card) {
            var status = card.getAttribute('data-status') || '';
            var show   = (filter === 'all') || (status === filter);
            card.style.display = show ? '' : 'none';
        });
    }

    pills.forEach(function (pill) {
        pill.addEventListener('click', function () {
            pills.forEach(function (p) { p.classList.remove('is-active'); });
            this.classList.add('is-active');
            applyFilter(this.getAttribute('data-filter'));
        });
    });
}());
</script>
<?= $this->endSection() ?>
