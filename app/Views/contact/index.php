<?= $this->extend('layouts/main') ?>

<?= $this->section('head') ?>
    <link rel="stylesheet" href="<?= base_url('assets/css/contact.css') ?>">
    <meta name="robots" content="index, follow">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!--
 * View: contact/index.php
 * URL  : /contact
 * Desc : Halaman Contact Us
 *        - Hero banner (jeep background)
 *        - 2-kolom: kiri form "Send a Message", kanan 3 info cards
 *        - Google Maps embed (area Kintamani/Batur)
-->

<!-- ════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════ -->
<section class="contact-hero" aria-labelledby="contact-page-title">
    <div class="contact-hero__bg"
         style="background-image: url('<?= base_url('assets/images/jeep-merah.jpg') ?>');">
    </div>
    <div class="contact-hero__overlay"></div>
    <div class="contact-hero__content" data-aos="fade-up">
        <h1 class="contact-hero__title" id="contact-page-title">Contact Us</h1>
        <p class="contact-hero__subtitle">Have a question? We are happy to help.</p>
    </div>
</section>


<!-- ════════════════════════════════════════════════════════
     CONTACT BODY  (form + info cards + map)
════════════════════════════════════════════════════════ -->
<section class="contact-body" id="contact-body">
<div class="container">

    <!-- 2-Column Layout -->
    <div class="contact-layout">

        <!-- ══ LEFT: Send a Message Form ══ -->
        <div class="contact-form-card" data-aos="fade-right">

            <h2 class="contact-form-title">Send a Message</h2>

            <form id="contact-form" novalidate>

                <!-- Row 1: Name + Email -->
                <div class="contact-form-row">
                    <div class="contact-form-group">
                        <label for="full_name" class="contact-form-label">Full Name</label>
                        <input
                            type="text"
                            name="full_name"
                            id="full_name"
                            class="contact-form-input"
                            placeholder="Enter your name"
                            value="<?= old('full_name') ?>"
                            autocomplete="name"
                            required>
                    </div>

                </div>

                <!-- Row 2: WhatsApp + Subject -->
                <div class="contact-form-row">
                    <div class="contact-form-group">
                        <label for="whatsapp" class="contact-form-label">WhatsApp Number</label>
                        <div class="contact-wa-wrap">
                            <span class="contact-wa-prefix">+62 821...</span>
                            <input
                                type="tel"
                                name="whatsapp"
                                id="whatsapp"
                                class="contact-form-input contact-form-input--wa"
                                placeholder=""
                                value="<?= old('whatsapp') ?>">
                        </div>
                    </div>
                    <div class="contact-form-group">
                        <label for="subject" class="contact-form-label">Subject</label>
                        <div class="contact-form-select-wrap">
                            <select name="subject" id="subject" class="contact-form-select" required>
                                <option value="" disabled <?= !old('subject') ? 'selected' : '' ?>>Select a topic</option>
                                <?php foreach ($subjects as $val => $label): ?>
                                <option value="<?= esc($val) ?>" <?= old('subject') === $val ? 'selected' : '' ?>>
                                    <?= esc($label) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Row 3: Message (full width) -->
                <div class="contact-form-row contact-form-row--single" style="margin-bottom:1.75rem;">
                    <div class="contact-form-group">
                        <label for="message" class="contact-form-label">Your Message</label>
                        <textarea
                            name="message"
                            id="message"
                            class="contact-form-textarea"
                            placeholder="How can we help you today?"
                            required><?= old('message') ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn-send-message" id="btn-send-message" style="background-color: #25D366;">
                    <i class="fa-brands fa-whatsapp"></i>
                    Send via WhatsApp
                </button>

            </form>
        </div><!-- /.contact-form-card -->


        <!-- ══ RIGHT: Info Cards ══ -->
        <div class="contact-info-col" data-aos="fade-left">

            <!-- Card 1: Our Basecamp (with location photo) -->
            <div class="contact-info-card">
                <img
                    src="<?= base_url('assets/images/basecamm.jpeg') ?>"
                    alt="Kintamani Basecamp"
                    class="contact-info-map-img">
                <div class="contact-info-card-body">
                    <div class="contact-info-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <div class="contact-info-content">
                        <h3 class="contact-info-title">Our Basecamp</h3>
                        <p class="contact-info-value">
                            Jl. Bukit Selat, Songan A, Kec. Kintamani,<br>
                            Kabupaten Bangli, Bali 80652
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Phone & WhatsApp -->
            <div class="contact-info-card">
                <div class="contact-info-card-body">
                    <div class="contact-info-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div class="contact-info-content">
                        <div class="contact-info-header-row">
                            <h3 class="contact-info-title" style="margin-bottom:0;">Phone &amp; WhatsApp</h3>
                            <a href="https://wa.me/6282147051381?text=Hi%2C%20I%27m%20interested%20in%20a%20Batur%20Jeep%20Experience%20tour!"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="contact-chat-badge"
                               id="btn-chat-now"
                               aria-label="Chat on WhatsApp">
                                <i class="fa-brands fa-whatsapp"></i>
                                Chat Now
                            </a>
                        </div>
                        <p class="contact-info-value">
                            <a href="tel:+6282147051381">0821-4705-1381</a>
                        </p>
                    </div>
                </div>
            </div>



        </div><!-- /.contact-info-col -->
    </div><!-- /.contact-layout -->


    <!-- Google Maps Embed (area Kintamani/Batur) -->
    <div class="contact-map" id="contact-map" data-aos="fade-up">
        <iframe
            src="https://maps.google.com/maps?q=Jl.%20Bukit%20Selat,%20Songan%20A,%20Kec.%20Kintamani,%20Kabupaten%20Bangli,%20Bali%2080652&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%"
            height="400"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
            title="Batur Jeep Experience Location — Kintamani, Bali"
            aria-label="Google Maps showing Kintamani location">
        </iframe>
    </div>

</div><!-- /.container -->
</section><!-- /.contact-body -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    
    var name = document.getElementById('full_name').value || '';

    var wa = document.getElementById('whatsapp').value || '';
    var subject = document.getElementById('subject').value || '';
    var msg = document.getElementById('message').value || '';
    
    if(!name || !subject || !msg) {
        alert('Please fill out Name, Subject, and Message.');
        return;
    }
    
    var text = "Hi Batur Jeep Experience,\n\n";
    text += "My name is " + name + ".\n";
    text += "Subject: " + subject + "\n\n";
    text += msg + "\n\n";
    text += "Contact Info:\n- WA: " + wa;
    
    var waUrl = "https://wa.me/6282147051381?text=" + encodeURIComponent(text);
    window.open(waUrl, '_blank');
});
</script>
<?= $this->endSection() ?>
