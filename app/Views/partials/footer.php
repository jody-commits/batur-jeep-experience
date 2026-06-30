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
                    <a href="<?= base_url('/') ?>" class="footer__brand" aria-label="Batur Jeep Experience" style="display:flex; align-items:center; gap:8px; margin-bottom:1.5rem; text-decoration:none;">
                        <img src="<?= base_url('assets/images/bje-logo.png') ?>" alt="Batur Jeep Experience Logo" style="max-height: 80px; width: auto; background: white; padding: 5px; border-radius: 50%;">
                        <div style="display: flex; flex-direction: column; text-align: left; line-height: 1;">
                            <span style="color: #FF7A00; font-family: 'Permanent Marker', cursive; font-size: 1.3rem; letter-spacing: 1px;">BATUR JEEP</span>
                            <span style="font-family: 'Permanent Marker', cursive; font-size: 1.6rem; background: -webkit-linear-gradient(left, #8b5cf6, #3b82f6, #10b981); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: 1px;">EXPERIENCE</span>
                        </div>
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
                            <span>Jl. Bukit Selat, Songan A, Kec. Kintamani,<br>Kabupaten Bangli, Bali 80652</span>
                        </li>
                        <li>
                            <i class="fa-brands fa-whatsapp"></i>
                            <a href="https://wa.me/6282147051381" target="_blank" rel="noopener">0821-4705-1381</a>
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
