<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/about.css') ?>">
    <meta name="robots" content="index, follow">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--
 * View: about/index.php
 * URL  : /about
 * Desc : Halaman About Us — Our story, The Batur Distinction, Meet Our Guides
-->

<!-- ════════════════════════════════════════════════════════
     ABOUT HERO
════════════════════════════════════════════════════════ -->
<section class="about-hero page-hero" aria-labelledby="about-page-title">
    <div class="about-hero__bg" style="background-image: url('<?= base_url('assets/images/mountbatur.jpg') ?>');"></div>
    <div class="about-hero__overlay"></div>

    <div class="about-hero__content" data-aos="fade-up">
        <h1 class="about-hero__title" id="about-page-title">About Us</h1>
        <p class="about-hero__subtitle">
            A local family-run adventure company dedicated to showing you the raw beauty of Bali's volcanic heart.
        </p>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════
     OUR STORY
════════════════════════════════════════════════════════ -->
<section class="about-story" id="our-story">
    <div class="container">
        <div class="about-story__inner">
            
            <div class="about-story__images" data-aos="fade-right">
                <img src="<?= base_url('assets/images/mountbatur.jpg') ?>" alt="Our Driver" class="about-story__img-main">
                <img src="<?= base_url('assets/images/mountbatur.jpg') ?>" alt="Jeep in caldera" class="about-story__img-sub">
            </div>

            <div class="about-story__content" data-aos="fade-left">
                <span class="about-story__eyebrow">Mount Batur History</span>
                <h2 class="about-story__title">The Sacred Volcanic Caldera</h2>
                
                <p class="about-story__text">
                    Mount Batur is an active volcano located at the center of two concentric calderas north west of Mount Agung on the island of Bali. The massive outer caldera, measuring 10 by 13 kilometers, was formed by a cataclysmic eruption approximately 29,300 years ago, leaving behind a breathtaking landscape that defines the Kintamani region today.
                </p>
                <p class="about-story__text">
                    Revered as a sacred site by the Balinese people, the volcano and its crescent-shaped crater lake hold deep spiritual significance. The dramatic expanse of the Black Lava fields, created by more recent eruptions in 1804 and 1968, now serves as the rugged, otherworldly terrain that makes our Jeep expeditions a truly unique adventure.
                </p>

                <div class="about-story__stats">
                    <?php foreach ($stats as $stat): ?>
                    <div class="about-stat">
                        <span class="about-stat__val"><?= esc($stat['value']) ?></span>
                        <span class="about-stat__lbl"><?= esc($stat['label']) ?></span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ════════════════════════════════════════════════════════
     THE BATUR DISTINCTION
════════════════════════════════════════════════════════ -->
<section class="about-distinction" id="distinction">
    <div class="container">
        
        <div class="section-header section-header--center" data-aos="fade-up">
            <h2 class="section-header__title">The Batur Distinction</h2>
            <p class="section-header__desc">
                Our commitment to excellence ensures your sunrise adventure is as safe as it is spectacular.
            </p>
        </div>

        <div class="distinction-grid">
            <?php foreach ($features as $idx => $feat): ?>
            <div class="distinction-card" data-aos="fade-up" data-delay="<?= $idx * 100 ?>">
                <div class="distinction-card__icon">
                    <i class="fa-solid <?= esc($feat['icon']) ?>"></i>
                </div>
                <h3 class="distinction-card__title"><?= esc($feat['title']) ?></h3>
                <p class="distinction-card__desc"><?= esc($feat['desc']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>


<?= $this->endSection() ?>
