<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<!--
 * View: home/index.php
 * URL  : /
 * Desc : Halaman utama / homepage — Hero, Stats, Packages, Fleet, Testimonials, Maps
 *        Design: Batur Jeep Experience
-->

<!-- ════════════════════════════════════════════════════════
     SECTION 1: HERO — Full Screen dengan overlay & CTA
════════════════════════════════════════════════════════ -->
<section class="hero" id="hero-section">

    <!-- Background Image -->
    <div class="hero__bg" style="background-image: url('<?= base_url('assets/images/home-pagee.jpg') ?>');"></div>

    <!-- Dark Gradient Overlay -->
    <div class="hero__overlay"></div>

    <!-- Animated Particles -->
    <div class="hero__particles" aria-hidden="true">
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <!-- Hero Content -->
    <div class="hero__content">
        <!-- Badge -->
        <div class="hero__badge" data-aos="fade-down" data-delay="0">
            <i class="fa-solid fa-star"></i>
            <span>4.9/5 · 500+ Satisfied Adventurers</span>
        </div>

        <!-- Headline -->
        <h1 class="hero__headline" data-aos="fade-up" data-delay="100">
            Conquer Batur,<br>
            <em>Feel the Adventure</em>
        </h1>

        <!-- Subheadline -->
        <p class="hero__sub" data-aos="fade-up" data-delay="200">
            Premium Jeep offroad expeditions through the volcanic heart of<br>
            Kintamani, Bali — Sunrise, Lava Fields & Highland Trails
        </p>

        <!-- CTA Buttons -->
        <div class="hero__cta" data-aos="fade-up" data-delay="300">
            <a href="<?= base_url('booking') ?>" class="btn btn--primary btn--lg" id="hero-btn-booknow">
                <i class="fa-solid fa-calendar-check"></i>
                Book Your Adventure
            </a>
            <a href="<?= base_url('packages') ?>" class="btn btn--outline-white btn--lg" id="hero-btn-packages">
                <i class="fa-solid fa-binoculars"></i>
                Explore Packages
            </a>
        </div>

        <!-- Scroll Indicator -->
        <div class="hero__scroll-indicator" aria-hidden="true">
            <div class="hero__scroll-line"></div>
            <span>Scroll</span>
        </div>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     SECTION 2: STATS / TRUST BADGES
════════════════════════════════════════════════════════ -->
<section class="stats-bar" id="stats-section" aria-label="Our Achievements">
    <div class="container">
        <div class="stats-bar__grid">

            <div class="stats-item" data-aos="fade-up" data-delay="0">
                <div class="stats-item__icon"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="stats-item__info">
                    <div style="display: flex; align-items: baseline; gap: 2px;">
                        <strong class="stats-item__num" data-count="500">0</strong>
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--primary);">+</span>
                    </div>
                    <span class="stats-item__label">Happy Guests</span>
                </div>
            </div>



            <div class="stats-divider" aria-hidden="true"></div>

            <div class="stats-item" data-aos="fade-up" data-delay="200">
                <div class="stats-item__icon"><i class="fa-solid fa-star"></i></div>
                <div class="stats-item__info">
                    <strong class="stats-item__num" data-count="4.9" data-decimal="1">0</strong>
                    <span class="stats-item__label">Average Rating</span>
                </div>
            </div>

            <div class="stats-divider" aria-hidden="true"></div>

            <div class="stats-item" data-aos="fade-up" data-delay="300">
                <div class="stats-item__icon"><i class="fa-solid fa-calendar-days"></i></div>
                <div class="stats-item__info">
                    <strong class="stats-item__num" data-count="7">0</strong>
                    <span class="stats-item__label">Years Experience</span>
                </div>
            </div>

        </div><!-- /.stats-bar__grid -->
    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     SECTION 3: TOUR PACKAGES
════════════════════════════════════════════════════════ -->
<section class="packages-section" id="packages-section" aria-labelledby="packages-heading">
    <div class="container">

        <!-- Section Header -->
        <div class="section-header" data-aos="fade-up">
            <span class="section-header__eyebrow">What We Offer</span>
            <h2 class="section-header__title" id="packages-heading">Our Signature<br>Tour Packages</h2>
            <p class="section-header__desc">
                Curated off-road expeditions through the volcanic heart of Kintamani.
                Each journey is guided by our expert local drivers.
            </p>
        </div>

        <!-- Package Cards -->
        <div class="packages-grid">
            <?php foreach ($packages as $pkg): ?>
            <article class="package-card" data-aos="fade-up">
                <div class="package-card__img-wrap">
                    <div class="package-card__img" style="background-image: url('<?= base_url('assets/images/' . $pkg['image']) ?>');"></div>
                    <?php if ($pkg['is_pickup'] == 1): ?>
                        <div class="package-card__badge package-card__badge--bestseller">🔥 Best Seller</div>
                    <?php else: ?>
                        <div class="package-card__badge package-card__badge--private">✨ Private</div>
                    <?php endif; ?>
                    <div class="package-card__overlay"></div>
                </div>
                <div class="package-card__body">
                    <div class="package-card__tags">
                        <?php if ($pkg['is_pickup'] == 1): ?>
                            <span class="tag tag--pickup"><i class="fa-solid fa-van-shuttle"></i> Pickup</span>
                        <?php else: ?>
                            <span class="tag tag--meeting"><i class="fa-solid fa-location-dot"></i> Meeting Point</span>
                        <?php endif; ?>
                        <span class="tag tag--duration"><i class="fa-regular fa-clock"></i> <?= esc($pkg['duration']) ?></span>
                    </div>
                    <h3 class="package-card__title"><?= esc($pkg['name']) ?></h3>
                    <p class="package-card__desc">
                        <?= esc(substr($pkg['description'], 0, 100)) ?>...
                    </p>
                    <div class="package-card__footer">
                        <div class="package-card__price">
                            <span class="package-card__price-from">Starting From</span>
                            <strong class="package-card__price-num">Rp&nbsp;<?= number_format($pkg['price'], 0, ',', '.') ?></strong>
                            <span class="package-card__price-unit">/ Jeep</span>
                        </div>
                        <a href="<?= base_url('booking?package=' . $pkg['id']) ?>" class="btn btn--primary btn--sm">
                            Book This Package
                        </a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div><!-- /.packages-grid -->

        <!-- View All CTA -->
        <div class="section-cta" data-aos="fade-up">
            <a href="<?= base_url('packages') ?>" class="btn btn--outline-primary btn--lg" id="home-btn-all-packages">
                <i class="fa-solid fa-compass"></i>
                View All Packages
            </a>
        </div>

    </div><!-- /.container -->
</section>


<!-- ════════════════════════════════════════════════════════
     SECTION 4: WHY CHOOSE US / FEATURES
════════════════════════════════════════════════════════ -->
<section class="features-section" id="features-section" aria-labelledby="features-heading">
    <div class="features-section__bg"></div>
    <div class="container">

        <div class="section-header section-header--white" data-aos="fade-up">
            <span class="section-header__eyebrow section-header__eyebrow--light">The Batur Distinction</span>
            <h2 class="section-header__title" id="features-heading" style="color:#fff;">Why Choose Us?</h2>
            <p class="section-header__desc" style="color:rgba(255,255,255,0.8);">
                Our commitment to excellence ensures your sunrise adventure is as safe as it is spectacular.
            </p>
        </div>

        <div class="features-grid">

            <div class="feature-card" data-aos="fade-up" data-delay="0">
                <div class="feature-card__icon-wrap">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="feature-card__title">Safety First</h3>
                <p class="feature-card__desc">
                    All vehicles undergo weekly maintenance. Drivers are certified in advanced first-aid and off-road safety protocols.
                </p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-delay="100">
                <div class="feature-card__icon-wrap">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <h3 class="feature-card__title">Eco-Friendly</h3>
                <p class="feature-card__desc">
                    We strictly follow Leave No Trace principles and actively participate in caldera reforestation programs.
                </p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-delay="200">
                <div class="feature-card__icon-wrap">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h3 class="feature-card__title">Local Community</h3>
                <p class="feature-card__desc">
                    We directly employ residents of Kintamani, ensuring tourism benefits flow back into our village.
                </p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-delay="300">
                <div class="feature-card__icon-wrap">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h3 class="feature-card__title">4.9/5 Rating</h3>
                <p class="feature-card__desc">
                    Over 500 guests have rated us 5 stars. Our guides are local storytellers and masters of volcanic terrain.
                </p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-delay="400">
                <div class="feature-card__icon-wrap">
                    <i class="fa-solid fa-van-shuttle"></i>
                </div>
                <h3 class="feature-card__title">Hotel Pickup</h3>
                <p class="feature-card__desc">
                    With the hotel pickup service from Kuta, Seminyak, Ubud, Sanur, Nusa Dua. We come to you.
                </p>
            </div>

            <div class="feature-card" data-aos="fade-up" data-delay="500">
                <div class="feature-card__icon-wrap">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="feature-card__title">24/7 Support</h3>
                <p class="feature-card__desc">
                    Our team is always reachable via WhatsApp. Planning, questions, or changes — we've got you covered.
                </p>
            </div>

        </div><!-- /.features-grid -->
    </div>
</section>





<!-- ════════════════════════════════════════════════════════
     SECTION 6: TESTIMONIALS
════════════════════════════════════════════════════════ -->
<section class="testimonials-section" id="testimonials-section" aria-labelledby="testimonials-heading">
    <div class="container">

        <div class="section-header" data-aos="fade-up" style="display: flex; flex-direction: column; align-items: center; text-align: center;">
            <span class="section-header__eyebrow">What Guests Say</span>
            <h2 class="section-header__title" id="testimonials-heading">Real Stories, Real Adventures</h2>
            <p class="section-header__desc">
                Over 500 adventurers have trusted us with their Bali highland experience.
            </p>
            <button class="btn btn--outline-primary btn--sm" id="btn-write-review" style="margin-top: 1rem;">
                <i class="fa-solid fa-pen"></i> Write a Review
            </button>
        </div>

        <!-- Testimonial Slider -->
        <div class="testimonials-slider" id="testimonials-slider" data-aos="fade-up" data-delay="100">
            <div class="testimonials-track" id="testimonials-track">

                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $rev): ?>
                    <!-- Testimonial -->
                    <div class="testimonial-card">
                        <div class="testimonial-card__stars">
                            <?php for ($i=0; $i<$rev['rating']; $i++): ?><i class="fa-solid fa-star"></i><?php endfor; ?>
                        </div>
                        <blockquote class="testimonial-card__text">
                            "<?= esc($rev['review_text']) ?>"
                        </blockquote>
                        <div class="testimonial-card__author">
                            <?php
                            $initials = strtoupper(substr($rev['name'], 0, 1));
                            $words = explode(' ', $rev['name']);
                            if (count($words) > 1) {
                                $initials .= strtoupper(substr($words[1], 0, 1));
                            }
                            // Generate a consistent random color based on name
                            $colors = ['linear-gradient(135deg, #F4A261, #e08040)', 'linear-gradient(135deg, #2D6A4F, #1e4d38)', 'linear-gradient(135deg, #1D3557, #2563a8)', 'linear-gradient(135deg, #E9C46A, #c9a030)', 'linear-gradient(135deg, #e63946, #b02330)'];
                            $color = $colors[strlen($rev['name']) % count($colors)];
                            ?>
                            <div class="testimonial-card__avatar" style="background: <?= $color ?>;">
                                <span><?= $initials ?></span>
                            </div>
                            <div class="testimonial-card__info">
                                <strong><?= esc($rev['name']) ?></strong>
                                <span><?= esc($rev['location']) ?> · <?= esc($rev['package_name']) ?></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; width:100%; color:#6b7280; padding: 2rem;">No reviews yet. Be the first to share your experience!</p>
                <?php endif; ?>

            </div><!-- /.testimonials-track -->
        </div><!-- /.testimonials-slider -->

        <!-- Slider Controls -->
        <div class="testimonials-controls" aria-label="Testimonial navigation">
            <button class="testimonials-btn testimonials-btn--prev" id="testimonials-prev" aria-label="Previous testimonial">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <div class="testimonials-dots" id="testimonials-dots"></div>
            <button class="testimonials-btn testimonials-btn--next" id="testimonials-next" aria-label="Next testimonial">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>

    </div><!-- /.container -->
</section>


<!-- ════════════════════════════════════════════════════════
     SECTION 7: HOW IT WORKS
════════════════════════════════════════════════════════ -->
<section class="how-section" id="how-section" aria-labelledby="how-heading">
    <div class="container">

        <div class="section-header" data-aos="fade-up">
            <span class="section-header__eyebrow">Simple Process</span>
            <h2 class="section-header__title" id="how-heading">How to Book Your Adventure</h2>
        </div>

        <div class="how-grid">

            <div class="how-step" data-aos="fade-up" data-delay="0">
                <div class="how-step__num">01</div>
                <div class="how-step__icon"><i class="fa-solid fa-binoculars"></i></div>
                <h3 class="how-step__title">Choose Your Package</h3>
                <p class="how-step__desc">Browse our curated packages — from sunrise expeditions to full-day volcanic adventures.</p>
            </div>

            <div class="how-step__arrow" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></div>

            <div class="how-step" data-aos="fade-up" data-delay="100">
                <div class="how-step__num">02</div>
                <div class="how-step__icon"><i class="fa-solid fa-calendar-check"></i></div>
                <h3 class="how-step__title">Complete Booking Form</h3>
                <p class="how-step__desc">Fill in your details, select your date, and choose hotel pickup if needed.</p>
            </div>

            <div class="how-step__arrow" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></div>

            <div class="how-step" data-aos="fade-up" data-delay="200">
                <div class="how-step__num">03</div>
                <div class="how-step__icon"><i class="fa-solid fa-bell-concierge"></i></div>
                <h3 class="how-step__title">Receive Confirmation</h3>
                <p class="how-step__desc">Get your unique booking code. We'll confirm within 2 hours via WhatsApp.</p>
            </div>

            <div class="how-step__arrow" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></div>

            <div class="how-step" data-aos="fade-up" data-delay="300">
                <div class="how-step__num">04</div>
                <div class="how-step__icon"><i class="fa-solid fa-mountain-sun"></i></div>
                <h3 class="how-step__title">Enjoy Your Adventure</h3>
                <p class="how-step__desc">Meet your guide at the pickup point or hotel, and let the adventure begin!</p>
            </div>

        </div><!-- /.how-grid -->

    </div><!-- /.container -->
</section>


<!-- ════════════════════════════════════════════════════════
     SECTION 8: LOCATION / MAP CTA
════════════════════════════════════════════════════════ -->
<section class="location-section" id="location-section" aria-labelledby="location-heading">
    <div class="container">

        <div class="location-inner">
            <div class="location-content" data-aos="fade-right">
                <span class="section-header__eyebrow">Find Us</span>
                <h2 class="location-content__title" id="location-heading">
                    Our Basecamp at<br>Songan, Kintamani
                </h2>
                <p class="location-content__desc">
                    Located at songan viewpoint overlooking Mount Batur.
                    The most strategic starting point for your volcanic expedition.
                </p>

                <ul class="location-info">
                    <li>
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Jl. Bukit Selat, Songan A, Kec. Kintamani, Kabupaten Bangli, Bali 80652</span>
                    </li>
                    <li>
                        <i class="fa-brands fa-whatsapp"></i>
                        <a href="https://wa.me/6282147051381" target="_blank" rel="noopener">0821-4705-1381</a>
                    </li>
                </ul>

                <div class="location-actions">
                    <a href="https://maps.app.goo.gl/NJ8bdh6RXh7TfvJr5" target="_blank" rel="noopener"
                       class="btn btn--primary" id="location-btn-maps">
                        <i class="fa-solid fa-map-location-dot"></i>
                        Open in Google Maps
                    </a>
                    <a href="https://wa.me/6282147051381" target="_blank" rel="noopener"
                       class="btn btn--whatsapp" id="location-btn-wa">
                        <i class="fa-brands fa-whatsapp"></i>
                        Chat on WhatsApp
                    </a>
                </div>
            </div><!-- /.location-content -->

            <!-- Map Embed -->
            <div class="location-map" data-aos="fade-left" data-delay="200">
                <div class="location-map__wrap">
                    <iframe
                        title="Lokasi Batur Jeep Experience di Google Maps"
                        src="https://maps.google.com/maps?q=Jl.%20Bukit%20Selat,%20Songan%20A,%20Kec.%20Kintamani,%20Kabupaten%20Bangli,%20Bali%2080652&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%"
                        height="100%"
                        style="border:0; border-radius: 16px;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div><!-- /.location-map -->

        </div><!-- /.location-inner -->
    </div><!-- /.container -->
</section>


<!-- ════════════════════════════════════════════════════════
     SECTION 9: FINAL CTA BANNER
════════════════════════════════════════════════════════ -->
<section class="cta-banner" id="cta-banner" aria-labelledby="cta-banner-heading">
    <div class="cta-banner__bg" style="background-image: url('<?= base_url('assets/images/home-pagee.jpg') ?>');"></div>
    <div class="cta-banner__overlay"></div>
    <div class="container">
        <div class="cta-banner__content" data-aos="fade-up">
            <h2 class="cta-banner__title" id="cta-banner-heading">
                Ready to Conquer Batur?
            </h2>
            <p class="cta-banner__sub">
                Join hundreds of adventurers who've experienced the magic of Kintamani's volcanic highlands.
                Limited slots available — secure your spot today!
            </p>
            <div class="cta-banner__actions">
                <a href="<?= base_url('booking') ?>" class="btn btn--accent btn--xl" id="cta-banner-book">
                    <i class="fa-solid fa-bolt"></i>
                    Book Your Adventure Now
                </a>
                <a href="<?= base_url('packages') ?>" class="btn btn--outline-white btn--xl" id="cta-banner-packages">
                    <i class="fa-solid fa-compass"></i>
                    Explore Packages First
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ── Write Review Modal ── -->
<div class="lightbox-modal" id="review-modal">
    <button class="lightbox-close" id="review-close"><i class="fa-solid fa-xmark"></i></button>
    <div class="lightbox-content" style="background: #fff; padding: 2rem; border-radius: 12px; width: 90%; max-width: 500px; color: #1f2937;">
        <h3 style="margin-bottom: 1rem; color: #2D6A4F;">Write a Review</h3>
        <form action="<?= base_url('reviews') ?>" method="post">
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="reviewer_name" style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">Your Name</label>
                <input type="text" name="reviewer_name" id="reviewer_name" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px;">
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="reviewer_location" style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">Location (e.g. Sydney, Australia)</label>
                <input type="text" name="reviewer_location" id="reviewer_location" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px;">
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="reviewer_package" style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">Tour Package</label>
                <select name="reviewer_package" id="reviewer_package" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; background: #f9fafb;">
                    <?php foreach ($packages as $pkg): ?>
                        <option value="<?= esc($pkg['name']) ?>"><?= esc($pkg['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group" style="margin-bottom: 1rem;">
                <label for="reviewer_rating" style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">Rating (1 to 5)</label>
                <input type="number" name="reviewer_rating" id="reviewer_rating" min="1" max="5" value="5" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px;">
            </div>
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label for="reviewer_text" style="display:block; font-size: 0.85rem; font-weight: 700; margin-bottom: 0.4rem;">Review</label>
                <textarea name="reviewer_text" id="reviewer_text" rows="4" required style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 6px; resize: vertical;"></textarea>
            </div>
            <button type="submit" class="btn btn--primary" style="width: 100%; justify-content: center;">Submit Review</button>
        </form>
    </div>
</div>

<style>
/* Lightbox Modal (reused from booking css if not available here) */
.lightbox-modal {
    position: fixed; top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.9); z-index: 9999;
    display: flex; align-items: center; justify-content: center;
    opacity: 0; pointer-events: none; transition: opacity 0.3s ease;
}
.lightbox-modal.is-active { opacity: 1; pointer-events: auto; }
.lightbox-close {
    position: absolute; top: 20px; right: 30px; background: transparent;
    border: none; color: #fff; font-size: 2rem; cursor: pointer; z-index: 10000;
}
.lightbox-content { position: relative; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var btnWriteReview = document.getElementById('btn-write-review');
    var reviewModal = document.getElementById('review-modal');
    var reviewClose = document.getElementById('review-close');

    if (btnWriteReview && reviewModal) {
        btnWriteReview.addEventListener('click', function() {
            reviewModal.classList.add('is-active');
            document.body.style.overflow = 'hidden';
        });
    }
    
    if (reviewClose && reviewModal) {
        reviewClose.addEventListener('click', function() {
            reviewModal.classList.remove('is-active');
            document.body.style.overflow = '';
        });
    }

    // Close when clicking outside
    if (reviewModal) {
        reviewModal.addEventListener('click', function(e) {
            if (e.target === reviewModal) {
                reviewModal.classList.remove('is-active');
                document.body.style.overflow = '';
            }
        });
    }
});
</script>

<?= $this->endSection() ?>
