<!--
 * Partial: partials/footer.php
 * Desc   : Global footer — 3 kolom, brand info, quick links, contact
 *          Design: Batur Jeep Experience
-->

<footer class="footer" id="main-footer">
    <div class="footer__top">
        <div class="container">
            <div class="footer__grid">

                <!-- Column 1: Brand -->
                <div class="footer__col footer__col--brand">
                    <a href="<?= base_url('/') ?>" class="footer__brand" aria-label="Batur Jeep Experience">
                        <span class="footer__brand-icon"><i class="fa-solid fa-mountain-sun"></i></span>
                        <span class="footer__brand-name">Batur Jeep<br><em>Experience</em></span>
                    </a>
                    <p class="footer__brand-desc">
                        Premium off-road expeditions to the heart of Mount Batur.
                        Licensed, safe, and unforgettable adventures since 2018.
                    </p>
                    <div class="footer__social">
                        <a href="#" class="footer__social-link" aria-label="Instagram" title="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="WhatsApp" title="WhatsApp">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="Facebook" title="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="footer__social-link" aria-label="TikTok" title="TikTok">
                            <i class="fa-brands fa-tiktok"></i>
                        </a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer__col">
                    <h3 class="footer__heading">Quick Links</h3>
                    <ul class="footer__links">
                        <li><a href="<?= base_url('/') ?>"><i class="fa-solid fa-chevron-right"></i> Home</a></li>
                        <li><a href="<?= base_url('packages') ?>"><i class="fa-solid fa-chevron-right"></i> Tour Packages</a></li>

                        <li><a href="<?= base_url('about') ?>"><i class="fa-solid fa-chevron-right"></i> About Us</a></li>
                        <li><a href="<?= base_url('contact') ?>"><i class="fa-solid fa-chevron-right"></i> Contact</a></li>
                        <li><a href="<?= base_url('booking') ?>"><i class="fa-solid fa-chevron-right"></i> Book Now</a></li>
                    </ul>
                </div>

                <!-- Column 3: Contact -->
                <div class="footer__col">
                    <h3 class="footer__heading">Connect With Us</h3>
                    <ul class="footer__contact">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            <span>Penelokan Main Rd, Kintamani,<br>Bangli, Bali 80652</span>
                        </li>
                        <li>
                            <i class="fa-brands fa-whatsapp"></i>
                            <a href="https://wa.me/6281234567890" target="_blank" rel="noopener">+62 812-3456-7890</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:explore@baturjeep.com">explore@baturjeep.com</a>
                        </li>
                        <li>
                            <i class="fa-regular fa-clock"></i>
                            <span>03.30 – 18.00 WITA<br><small>(Every Day)</small></span>
                        </li>
                    </ul>
                </div>

            </div><!-- /.footer__grid -->
        </div><!-- /.container -->
    </div><!-- /.footer__top -->

    <!-- Footer Bottom Bar -->
    <div class="footer__bottom">
        <div class="container">
            <div class="footer__bottom-inner">
                <p>© <?= date('Y') ?> Batur Jeep Experience. All rights reserved. Registered travel operator in Bali, Indonesia.</p>
                <div class="footer__bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Safety Guidelines</a>
                </div>
            </div>
        </div>
    </div>
</footer>
