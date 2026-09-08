<?php if ($this->uri->segment(1) !== 'online-booking'): ?>
    <footer style="background: linear-gradient(180deg, #0B2562 0%, #001C66 100%); color: #ffffff;">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <span class="text-white fs-3"><?= $company3 ?></span>
                    <p class="text-white mt-4">Providing reliable and efficient packing and moving services across India since 2005. Your trust is our priority.</p>
                    <div class="mt-3">
                        <?php if (!empty($facebookhtml)): ?>
                        <a href="<?= $facebookhtml ?>" target="_blank" aria-label="facebook" class="social-icon me-2"><i class="bi bi-facebook"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($instagramhtml)): ?>
                        <a href="<?= $instagramhtml ?>" target="_blank" aria-label="instagram" class="social-icon me-2"><i class="bi bi-instagram"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($youtubehtml)): ?>
                        <a href="<?= $youtubehtml ?>" target="_blank" aria-label="youtube" class="social-icon"><i class="bi bi-youtube"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <span class="text-white fs-2 mb-4">Quick Links</span>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?=site_url('about')?>" class="footer-link baad">About Us</a></li>
                        <li class="mb-2"><a href="<?=site_url()?>" class="footer-link baad">Home</a></li>
                        <li class="mb-2"><a href="<?=site_url('contacts')?>" class="footer-link baad">Contact</a></li>
                        <li class="mb-2"><a href="<?=site_url('branches')?>" class="footer-link baad">Branches</a></li>
                        <li class="mb-2"><a href="<?=site_url('cancellation-refund')?>" class="footer-link baad">Cancellation &amp; Refund Policy</a></li>
                    </ul>
                </div>
<?php
// Load dynamic services for footer
$footer_services = [];
try {
    $admin_db = $this->load->database('admin_hub', TRUE);
    if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('our_services')) {
        $footer_services = $admin_db->where('status', 1)->order_by('sort_order', 'asc')->limit(6)->get('our_services')->result();
    }
} catch (Exception $e) {
    log_message('error', 'Footer services load error: ' . $e->getMessage());
}
?>
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <span class="text-white fs-2 mb-4">Our Services</span>
                    <ul class="list-unstyled">
                        <?php if (!empty($footer_services)): ?>
                            <?php foreach ($footer_services as $fs): ?>
                                <li class="mb-2"><a href="<?= site_url('services/' . $fs->slug) ?>" class="footer-link baad"><?= htmlspecialchars($fs->service_name) ?></a></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li class="mb-2"><a href="<?= site_url('home-relocation') ?>" class="footer-link baad">Home Relocation</a></li>
                            <li class="mb-2"><a href="<?= site_url('office-relocation') ?>" class="footer-link baad">Office Relocation</a></li>
                            <li class="mb-2"><a href="<?= site_url('packing-unpacking') ?>" class="footer-link baad">Packing Services</a></li>
                            <li class="mb-2"><a href="<?= site_url('car-transportation-service') ?>" class="footer-link baad">Car Transportation</a></li>
                            <li class="mb-2"><a href="<?= site_url('warehousing-services') ?>" class="footer-link baad">Warehouse Solutions</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-4 mb-2 mb-md-0">
                    <span class="text-white fs-2 mb-4">Contact Us</span>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="bi bi-geo-alt me-2"></i><?= $address ?></li>
                        <li class="mb-2"><i class="bi bi-telephone me-2"></i><a href="<?=$phonehtml?>" class="text-white text-decoration-none"><?= $phone ?></a></li>
                        <li class="mb-2"><i class="bi bi-envelope me-2"></i><a href="<?=$mailhtml?>" class="text-white text-decoration-none"><?= $mail ?></a></li>
                        <li class="mb-2"><i class="bi bi-clock me-2"></i> <?= !empty($businessHours) ? $businessHours : 'Mon-Sat: 9AM - 6PM' ?></li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-2" style="border-color: rgba(255,255,255,0.1);">
            <div class="d-flex align-items-center justify-content-center">
                <div class="col-md-6 text-center">
                    <p class="mb-0">&copy; <?= date('Y') ?> <?= $company3 ?>. All Rights Reserved.</p>
                </div>
            </div>
        </div>
        <?php $this->load->view('contacts/login_modal'); ?>
    </footer>
<?php endif; ?>
<script>
document.addEventListener('DOMContentLoaded', function(){
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    let slideInterval;
    
    function showSlide(n){
        if(!slides || slides.length === 0) return;
        slides.forEach(slide => slide && slide.classList && slide.classList.remove('active'));
        dots.forEach(dot => dot && dot.classList && dot.classList.remove('active'));
        currentSlide = (n + slides.length) % slides.length;
        if(slides[currentSlide] && slides[currentSlide].classList) slides[currentSlide].classList.add('active');
        if(dots[currentSlide] && dots[currentSlide].classList) dots[currentSlide].classList.add('active');
    }

    function nextSlide(){ showSlide(currentSlide + 1); }
    function prevSlide(){ showSlide(currentSlide - 1); }
    function startSlider(){ if(slides && slides.length > 0) slideInterval = setInterval(nextSlide, 9000); }
    function stopSlider(){ clearInterval(slideInterval); }

    const nextArrow = document.querySelector('.next-arrow');
    const prevArrow = document.querySelector('.prev-arrow');

    if(nextArrow) {
        nextArrow.addEventListener('click', () => {
            stopSlider();
            nextSlide();
            startSlider();
        });
    }

    if(prevArrow) {
        prevArrow.addEventListener('click', () => {
            stopSlider();
            prevSlide();
            startSlider();
        });
    }

    if(dots && dots.length > 0) {
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                stopSlider();
                showSlide(index);
                startSlider();
            });
        });
    }

    if(slides && slides.length > 0) {
        startSlider();
        const slider = document.querySelector('.hero-slider');
        if(slider) {
            slider.addEventListener('mouseenter', stopSlider);
            slider.addEventListener('mouseleave', startSlider);
        }
    }

    if(window.innerWidth > 992){
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.addEventListener('mouseenter', function(){
                this.classList.add('show');
                let toggle = this.querySelector('.dropdown-toggle');
                let menu = this.querySelector('.dropdown-menu');
                if(toggle) toggle.setAttribute('aria-expanded','true');
                if(menu) menu.classList.add('show');
            });
            dropdown.addEventListener('mouseleave', function(){
                this.classList.remove('show');
                let toggle = this.querySelector('.dropdown-toggle');
                let menu = this.querySelector('.dropdown-menu');
                if(toggle) toggle.setAttribute('aria-expanded','false');
                if(menu) menu.classList.remove('show');
            });
        });
    }
});
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?=base_url('assets/admin/js/message.js')?>"></script>
<script src="<?=base_url('assets/js/script.js')?>"></script>
</body>
</html>