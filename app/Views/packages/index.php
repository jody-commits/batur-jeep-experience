<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/packages.css') ?>">
    <meta name="robots" content="index, follow">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--
 * View: packages/index.php
 * URL  : /packages
 * Desc : Halaman daftar paket wisata dengan filter dan card grid
 *        Design: Batur Jeep Experience
-->

<!-- ════════════════════════════════════════════════════════
     PAGE HERO BANNER
════════════════════════════════════════════════════════ -->
<section class="page-hero" id="packages-hero" aria-labelledby="packages-page-title">
    <div class="page-hero__bg" style="background-image: url('<?= base_url('assets/images/kintamani-green-hero.png') ?>');"></div>
    <div class="page-hero__overlay"></div>

    <!-- Decorative Particles -->
    <div class="page-hero__particles" aria-hidden="true">
        <span></span><span></span><span></span>
    </div>

    <div class="page-hero__content">
        <!-- Breadcrumb -->
        <nav class="page-hero__breadcrumb" aria-label="Breadcrumb">
            <a href="<?= base_url('/') ?>">Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <span>Tour Packages</span>
        </nav>

        <h1 class="page-hero__title" id="packages-page-title">Tour Packages</h1>
        <p class="page-hero__subtitle">
            <em>Curated off-road expeditions through the heart of Kintamani</em>
        </p>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     FILTER BAR
════════════════════════════════════════════════════════ -->
<section class="packages-filter-bar" id="packages-filter-bar" aria-label="Filter packages">
    <div class="container">
        <div class="filter-bar__inner">

            <!-- Filter Pills -->
            <div class="filter-pills" id="filter-pills" role="tablist" aria-label="Package filters">
                <button class="filter-pill is-active" data-filter="all" role="tab" aria-selected="true" id="filter-all">
                    All
                </button>
                <button class="filter-pill" data-filter="hotel-pickup" role="tab" aria-selected="false" id="filter-pickup">
                    <i class="fa-solid fa-van-shuttle"></i> Hotel Pickup
                </button>
                <button class="filter-pill" data-filter="meeting-point" role="tab" aria-selected="false" id="filter-meeting">
                    <i class="fa-solid fa-location-dot"></i> Meeting Point
                </button>
                <button class="filter-pill" data-filter="sunrise-tours" role="tab" aria-selected="false" id="filter-sunrise">
                    <i class="fa-solid fa-sun"></i> Sunrise Tours
                </button>
                <button class="filter-pill" data-filter="black-lava-only" role="tab" aria-selected="false" id="filter-lava">
                    <i class="fa-solid fa-volcano"></i> Black Lava Only
                </button>
            </div>

            <!-- Results Count + Sort -->
            <div class="filter-bar__right">
                <span class="filter-count" id="packages-count">
                    Showing <strong id="visible-count"><?= count($packages) ?></strong> packages
                </span>
                <button class="filter-sort-btn" id="sort-toggle" aria-expanded="false" aria-haspopup="listbox">
                    <i class="fa-solid fa-sliders"></i> Refine Search
                </button>
            </div>

        </div><!-- /.filter-bar__inner -->

        <!-- Sort Dropdown (hidden by default) -->
        <div class="filter-sort-dropdown" id="sort-dropdown" aria-hidden="true">
            <button class="sort-option is-active" data-sort="default" id="sort-default">Default Order</button>
            <button class="sort-option" data-sort="price-asc"  id="sort-price-asc">Price: Low to High</button>
            <button class="sort-option" data-sort="price-desc" id="sort-price-desc">Price: High to Low</button>
            <button class="sort-option" data-sort="duration"   id="sort-duration">Shortest Duration</button>
        </div>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     PACKAGES GRID
════════════════════════════════════════════════════════ -->
<section class="packages-list-section" id="packages-list" aria-label="Tour packages list">
    <div class="container">

        <div class="pkg-grid" id="pkg-grid">

            <?php foreach ($packages as $i => $pkg): ?>
            <!-- Package Card: <?= esc($pkg['name']) ?> -->
            <article
                class="pkg-card"
                id="pkg-card-<?= $pkg['id'] ?>"
                data-categories="<?= esc(implode(' ', $pkg['category'])) ?>"
                data-price="<?= $pkg['price'] ?>"
                data-duration="<?= (int) $pkg['duration'] ?>"
                data-aos="fade-up"
                data-delay="<?= ($i % 2) * 100 ?>"
            >
                <!-- Image Side -->
                <div class="pkg-card__img-wrap">
                    <div class="pkg-card__img"
                         style="background-image: url('<?= base_url('assets/images/' . $pkg['image']) ?>');"></div>

                    <!-- Badge -->
                    <?php if ($pkg['badge']): ?>
                    <div class="pkg-card__badge pkg-card__badge--<?= $pkg['badge'] ?>">
                        <?php
                            $badgeIcon = match($pkg['badge']) {
                                'sunrise'    => '🌅',
                                'bestseller' => '🔥',
                                'private'    => '✨',
                                'sunset'     => '🌇',
                                default      => '⭐',
                            };
                        ?>
                        <span class="badge-icon"><?= $badgeIcon ?></span>
                        <?= esc($pkg['badge_text']) ?>
                    </div>
                    <?php endif; ?>

                    <!-- Persons indicator -->
                    <div class="pkg-card__persons">
                        <i class="fa-solid fa-users"></i>
                        <?= $pkg['min_persons'] ?>–<?= $pkg['max_persons'] ?> Persons
                    </div>
                </div>

                <!-- Content Side -->
                <div class="pkg-card__body">

                    <!-- Tags row -->
                    <div class="pkg-card__tags">
                        <?php if ($pkg['is_pickup']): ?>
                            <span class="pkg-tag pkg-tag--pickup">
                                <i class="fa-solid fa-van-shuttle"></i> Pickup
                            </span>
                        <?php else: ?>
                            <span class="pkg-tag pkg-tag--meeting">
                                <i class="fa-solid fa-location-dot"></i> Meeting Point
                            </span>
                        <?php endif; ?>
                        <span class="pkg-tag pkg-tag--duration">
                            <i class="fa-regular fa-clock"></i> <?= esc($pkg['duration']) ?>
                        </span>
                    </div>

                    <!-- Title -->
                    <h2 class="pkg-card__title"><?= esc($pkg['name']) ?></h2>

                    <!-- Description -->
                    <p class="pkg-card__desc"><?= esc($pkg['description']) ?></p>

                    <!-- Highlights -->
                    <ul class="pkg-card__highlights" aria-label="Package highlights">
                        <?php foreach (array_slice($pkg['highlights'], 0, 3) as $highlight): ?>
                        <li>
                            <i class="fa-solid fa-circle-check"></i>
                            <?= esc($highlight) ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- Footer: price + CTA -->
                    <div class="pkg-card__footer">
                        <div class="pkg-card__price-wrap">
                            <span class="pkg-card__price-label">STARTING FROM</span>
                            <div class="pkg-card__price-row">
                                <span class="pkg-card__price-rp">Rp</span>
                                <strong class="pkg-card__price-num">
                                    <?= number_format($pkg['price'], 0, ',', '.') ?>
                                </strong>
                            </div>
                            <span class="pkg-card__price-unit">/ Jeep</span>
                        </div>

                        <a href="<?= base_url('booking?package=' . $pkg['id']) ?>"
                           class="btn-book"
                           id="book-pkg-<?= $pkg['id'] ?>"
                           aria-label="Book <?= esc($pkg['name']) ?>">
                            Book This Package
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>

                </div><!-- /.pkg-card__body -->
            </article>
            <?php endforeach; ?>

        </div><!-- /#pkg-grid -->

        <!-- Empty State (hidden by default, shown via JS when no results) -->
        <div class="packages-empty" id="packages-empty" style="display:none;" role="alert" aria-live="polite">
            <div class="packages-empty__icon"><i class="fa-solid fa-compass"></i></div>
            <h3>No packages found</h3>
            <p>Try a different filter to discover your perfect adventure.</p>
            <button class="btn btn--primary" id="reset-filter">
                <i class="fa-solid fa-rotate-left"></i> Show All Packages
            </button>
        </div>

    </div><!-- /.container -->
</section>


<!-- ════════════════════════════════════════════════════════
     CUSTOM PACKAGE CTA BANNER
════════════════════════════════════════════════════════ -->
<section class="custom-pkg-banner" id="custom-pkg-banner" aria-labelledby="custom-pkg-heading">
    <div class="container">
        <div class="custom-pkg-banner__inner">

            <div class="custom-pkg-banner__content">
                <h2 class="custom-pkg-banner__title" id="custom-pkg-heading">
                    Need a custom package?
                </h2>
                <p class="custom-pkg-banner__desc">
                    Our adventure consultants are ready to tailor your Kintamani journey.
                    Any route, any time, any group size.
                </p>
            </div>

            <div class="custom-pkg-banner__actions">
                <a href="https://wa.me/6282147051381?text=Hi%20Batur%20Jeep%20Experience%2C%20I%20need%20a%20custom%20package"
                   target="_blank"
                   rel="noopener"
                   class="btn btn--accent btn--lg"
                   id="custom-pkg-wa-btn">
                    <i class="fa-brands fa-whatsapp"></i>
                    Chat with us on WhatsApp
                </a>
            </div>

        </div>
    </div>
</section>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
/**
 * Tour Packages — Filter & Sort Logic
 */
(function () {
    'use strict';

    var pills       = document.querySelectorAll('.filter-pill');
    var sortToggle  = document.getElementById('sort-toggle');
    var sortDropdown= document.getElementById('sort-dropdown');
    var sortOptions = document.querySelectorAll('.sort-option');
    var cards       = document.querySelectorAll('.pkg-card');
    var emptyState  = document.getElementById('packages-empty');
    var visibleCount= document.getElementById('visible-count');
    var resetBtn    = document.getElementById('reset-filter');

    var currentFilter = 'all';
    var currentSort   = 'default';

    /* ── Filter ─────────────────────────────────────────── */
    function applyFilter(filter) {
        currentFilter = filter;
        var count = 0;

        cards.forEach(function (card) {
            var cats = card.getAttribute('data-categories') || '';
            var show = (filter === 'all') || cats.split(' ').includes(filter);

            if (show) {
                card.style.display = '';
                card.classList.remove('pkg-card--hidden');
                count++;
            } else {
                card.style.display = 'none';
                card.classList.add('pkg-card--hidden');
            }
        });

        // Update count text
        if (visibleCount) visibleCount.textContent = count;

        // Show/hide empty state
        if (emptyState) {
            emptyState.style.display = (count === 0) ? 'block' : 'none';
        }
    }

    /* ── Sort ───────────────────────────────────────────── */
    function applySort(sort) {
        currentSort = sort;
        var grid = document.getElementById('pkg-grid');
        if (!grid) return;

        var cardArr = Array.from(cards).filter(function (c) {
            return c.style.display !== 'none';
        });

        cardArr.sort(function (a, b) {
            var priceA    = parseInt(a.getAttribute('data-price') || 0);
            var priceB    = parseInt(b.getAttribute('data-price') || 0);
            var durA      = parseInt(a.getAttribute('data-duration') || 0);
            var durB      = parseInt(b.getAttribute('data-duration') || 0);
            var idxA      = parseInt(a.id.split('-').pop());
            var idxB      = parseInt(b.id.split('-').pop());

            if (sort === 'price-asc')  return priceA - priceB;
            if (sort === 'price-desc') return priceB - priceA;
            if (sort === 'duration')   return durA - durB;
            return idxA - idxB; // default order
        });

        // Re-append in sorted order
        cardArr.forEach(function (card) {
            grid.appendChild(card);
        });
    }

    /* ── Pill click ─────────────────────────────────────── */
    pills.forEach(function (pill) {
        pill.addEventListener('click', function () {
            // Update active state
            pills.forEach(function (p) {
                p.classList.remove('is-active');
                p.setAttribute('aria-selected', 'false');
            });
            this.classList.add('is-active');
            this.setAttribute('aria-selected', 'true');

            var filter = this.getAttribute('data-filter');
            applyFilter(filter);
            applySort(currentSort);
        });
    });

    /* ── Sort toggle ────────────────────────────────────── */
    if (sortToggle && sortDropdown) {
        sortToggle.addEventListener('click', function () {
            var isOpen = sortDropdown.classList.contains('is-open');
            if (isOpen) {
                sortDropdown.classList.remove('is-open');
                sortDropdown.setAttribute('aria-hidden', 'true');
                sortToggle.setAttribute('aria-expanded', 'false');
            } else {
                sortDropdown.classList.add('is-open');
                sortDropdown.setAttribute('aria-hidden', 'false');
                sortToggle.setAttribute('aria-expanded', 'true');
            }
        });

        // Close on outside click
        document.addEventListener('click', function (e) {
            if (!sortToggle.contains(e.target) && !sortDropdown.contains(e.target)) {
                sortDropdown.classList.remove('is-open');
                sortDropdown.setAttribute('aria-hidden', 'true');
                sortToggle.setAttribute('aria-expanded', 'false');
            }
        });
    }

    /* ── Sort options ───────────────────────────────────── */
    sortOptions.forEach(function (opt) {
        opt.addEventListener('click', function () {
            sortOptions.forEach(function (o) { o.classList.remove('is-active'); });
            this.classList.add('is-active');

            var sort = this.getAttribute('data-sort');
            applySort(sort);

            // Close dropdown
            if (sortDropdown) {
                sortDropdown.classList.remove('is-open');
                sortDropdown.setAttribute('aria-hidden', 'true');
                sortToggle.setAttribute('aria-expanded', 'false');
            }
        });
    });

    /* ── Reset button ───────────────────────────────────── */
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            pills.forEach(function (p) {
                p.classList.remove('is-active');
                p.setAttribute('aria-selected', 'false');
            });
            var allPill = document.querySelector('[data-filter="all"]');
            if (allPill) {
                allPill.classList.add('is-active');
                allPill.setAttribute('aria-selected', 'true');
            }
            applyFilter('all');
            applySort('default');
        });
    }

    /* ── URL param filter on load ───────────────────────── */
    var urlParams = new URLSearchParams(window.location.search);
    var filterParam = urlParams.get('filter');
    if (filterParam) {
        var targetPill = document.querySelector('[data-filter="' + filterParam + '"]');
        if (targetPill) {
            targetPill.click();
        }
    }

})();
</script>
<?= $this->endSection() ?>
