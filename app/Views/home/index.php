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

            <!-- Package 1: Sunrise Batur -->
            <article class="package-card" data-aos="fade-up" data-delay="0">
                <div class="package-card__img-wrap">
                    <div class="package-card__img" style="background-image: url('<?= base_url('assets/images/sunrise.jpg') ?>');"></div>
                    <div class="package-card__badge package-card__badge--sunrise">🌅 Sunrise Guaranteed</div>
                    <div class="package-card__overlay"></div>
                </div>
                <div class="package-card__body">
                    <div class="package-card__tags">
                        <span class="tag tag--pickup"><i class="fa-solid fa-van-shuttle"></i> Pickup</span>
                        <span class="tag tag--duration"><i class="fa-regular fa-clock"></i> 4 Hours</span>
                    </div>
                    <h3 class="package-card__title">Classic Sunrise<br>Batur</h3>
                    <p class="package-card__desc">
                        Witness the majestic sunrise from the volcanic rim, overlooking the
                        shimmering Batur Lake.
                    </p>
                    <div class="package-card__footer">
                        <div class="package-card__price">
                            <span class="package-card__price-from">Starting From</span>
                            <strong class="package-card__price-num">Rp&nbsp;1,500,000</strong>
                            <span class="package-card__price-unit">/ Jeep</span>
                        </div>
                        <a href="<?= base_url('booking?package_id=1') ?>" class="btn btn--primary btn--sm" id="pkg-1-book">
                            Book This Package
                        </a>
                    </div>
                </div>
            </article>

            <!-- Package 2: Offroad Adventure -->
            <article class="package-card" data-aos="fade-up" data-delay="100">
                <div class="package-card__img-wrap">
                    <div class="package-card__img" style="background-image: url('<?= base_url('assets/images/offroad.jpg') ?>');"></div>
                    <div class="package-card__badge package-card__badge--bestseller">🔥 Best Seller</div>
                    <div class="package-card__overlay"></div>
                </div>
                <div class="package-card__body">
                    <div class="package-card__tags">
                        <span class="tag tag--pickup"><i class="fa-solid fa-van-shuttle"></i> Pickup</span>
                        <span class="tag tag--duration"><i class="fa-regular fa-clock"></i> 8 Hours</span>
                    </div>
                    <h3 class="package-card__title">Offroad Adventure<br>Full Day</h3>
                    <p class="package-card__desc">
                        A full-day thrilling ride through volcanic lava fields, jungle trails,
                        and Batur's iconic black sand.
                    </p>
                    <div class="package-card__footer">
                        <div class="package-card__price">
                            <span class="package-card__price-from">Starting From</span>
                            <strong class="package-card__price-num">Rp&nbsp;2,500,000</strong>
                            <span class="package-card__price-unit">/ Jeep</span>
                        </div>
                        <a href="<?= base_url('booking?package_id=2') ?>" class="btn btn--primary btn--sm" id="pkg-2-book">
                            Book This Package
                        </a>
                    </div>
                </div>
            </article>

            <!-- Package 3: Private Trip -->
            <article class="package-card" data-aos="fade-up" data-delay="200">
                <div class="package-card__img-wrap">
                    <div class="package-card__img" style="background-image: url('<?= base_url('assets/images/jeep-kuning.jpg') ?>');"></div>
                    <div class="package-card__badge package-card__badge--private">✨ Private</div>
                    <div class="package-card__overlay"></div>
                </div>
                <div class="package-card__body">
                    <div class="package-card__tags">
                        <span class="tag tag--meeting"><i class="fa-solid fa-location-dot"></i> Meeting Point</span>
                        <span class="tag tag--duration"><i class="fa-regular fa-clock"></i> 6 Hours</span>
                    </div>
                    <h3 class="package-card__title">Private Trip<br>Kintamani</h3>
                    <p class="package-card__desc">
                        Exclusive private tour for families and couples. Choose your route,
                        set your schedule, ultimate flexibility.
                    </p>
                    <div class="package-card__footer">
                        <div class="package-card__price">
                            <span class="package-card__price-from">Starting From</span>
                            <strong class="package-card__price-num">Rp&nbsp;3,500,000</strong>
                            <span class="package-card__price-unit">/ Jeep</span>
                        </div>
                        <a href="<?= base_url('booking?package_id=3') ?>" class="btn btn--primary btn--sm" id="pkg-3-book">
                            Book This Package
                        </a>
                    </div>
                </div>
            </article>

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

        <div class="section-header" data-aos="fade-up">
            <span class="section-header__eyebrow">What Guests Say</span>
            <h2 class="section-header__title" id="testimonials-heading">Real Stories, Real Adventures</h2>
            <p class="section-header__desc">
                Over 500 adventurers have trusted us with their Bali highland experience.
            </p>
        </div>

        <!-- Testimonial Slider -->
        <div class="testimonials-slider" id="testimonials-slider" data-aos="fade-up" data-delay="100">
            <div class="testimonials-track" id="testimonials-track">

                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <blockquote class="testimonial-card__text">
                        "Absolutely phenomenal experience! Watching the sunrise over the Batur crater from the Jeep was otherworldly. Our driver Wayan was hilarious and incredibly knowledgeable."
                    </blockquote>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" style="background: linear-gradient(135deg, #F4A261, #e08040);">
                            <span>SA</span>
                        </div>
                        <div class="testimonial-card__info">
                            <strong>Sarah Anderson</strong>
                            <span>Sydney, Australia · Sunrise Batur</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <blockquote class="testimonial-card__text">
                        "Best adventure I've had in Bali! The full-day offroad package was thrilling — driving through lava fields felt like being on another planet. 100% would recommend!"
                    </blockquote>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" style="background: linear-gradient(135deg, #2D6A4F, #1e4d38);">
                            <span>TK</span>
                        </div>
                        <div class="testimonial-card__info">
                            <strong>Tanaka Kenji</strong>
                            <span>Tokyo, Japan · Offroad Full Day</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <blockquote class="testimonial-card__text">
                        "We booked the private trip for our anniversary. The hotel pickup was seamless. The caldera views were stunning. A truly romantic and memorable experience!"
                    </blockquote>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" style="background: linear-gradient(135deg, #1D3557, #2563a8);">
                            <span>ML</span>
                        </div>
                        <div class="testimonial-card__info">
                            <strong>Marie Laurent</strong>
                            <span>Paris, France · Private Trip</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 4 -->
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <blockquote class="testimonial-card__text">
                        "We came as a family of 5. The kids absolutely loved it! Safe, exciting, and the guides were so patient with the children. Will definitely book again next visit!"
                    </blockquote>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" style="background: linear-gradient(135deg, #E9C46A, #c9a030);">
                            <span>RP</span>
                        </div>
                        <div class="testimonial-card__info">
                            <strong>Ravi Patel</strong>
                            <span>Mumbai, India · Family Package</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 5 -->
                <div class="testimonial-card">
                    <div class="testimonial-card__stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                    <blockquote class="testimonial-card__text">
                        "Booking was super easy online, hotel pickup was on time at 3:30 AM, and the sunrise views were breathtaking. Professional service from start to finish!"
                    </blockquote>
                    <div class="testimonial-card__author">
                        <div class="testimonial-card__avatar" style="background: linear-gradient(135deg, #52B788, #2d8b5a);">
                            <span>JW</span>
                        </div>
                        <div class="testimonial-card__info">
                            <strong>Jessica Wong</strong>
                            <span>Singapore · Sunrise Batur</span>
                        </div>
                    </div>
                </div>

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
                    Located at songan viewpoint overlooking Mount Batur and Batur Lake.
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

<?= $this->endSection() ?>
