<style>
/* ===== Terms & Conditions Page ===== */
.tc-hero {
    padding: 60px 0 40px;
    position: relative;
    overflow: hidden;
}
.tc-hero::before {
    content: '';
    position: absolute;
    top: -40px; right: -40px;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.06);
}
.tc-hero::after {
    content: '';
    position: absolute;
    bottom: -60px; left: -30px;
    width: 260px; height: 260px;
    border-radius: 50%;
    background: rgba(255,255,255,0.04);
}
.tc-hero h1 { font-size: 2.2rem; font-weight: 800; color: #fff; margin-bottom: 8px; }
.tc-hero p  { font-size: 0.95rem; color: rgba(255,255,255,0.82); margin: 0; }
.tc-badge {
    display: inline-flex; align-items: center; gap: 6px;
    background: rgba(255,255,255,0.15);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 50px;
    padding: 5px 14px;
    font-size: 0.8rem; color: #fff;
    margin-bottom: 14px;
    backdrop-filter: blur(6px);
}
.tc-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #edf2f7;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    padding: 32px 36px;
    margin-bottom: 20px;
    transition: box-shadow 0.2s;
    scroll-margin-top: 90px;
}
.tc-card:hover { box-shadow: 0 8px 32px rgba(252, 93, 9,0.08); }
.tc-section-num {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff; font-weight: 800; font-size: 0.9rem;
    border-radius: 8px;
    flex-shrink: 0;
}
.tc-section-title {
    font-size: 1.1rem; font-weight: 700; color: #112d62; margin: 0;
}
.tc-section-body {
    font-size: 0.92rem; color: #4a5568; line-height: 1.8; margin: 0;
}
.tc-section-body ul { margin: 10px 0 0; padding-left: 20px; }
.tc-section-body ul li { margin-bottom: 6px; }
.tc-section-body a { color: #FC5D09; font-weight: 600; text-decoration: none; }
.tc-section-body a:hover { text-decoration: underline; }
.tc-contact-box {
    background: linear-gradient(135deg, #fff8f8, #fff);
    border: 1.5px solid #f0d0d0;
    border-radius: 14px;
    padding: 24px 28px;
}
.tc-contact-box .contact-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.9rem; color: #4a5568; margin-bottom: 10px;
}
.tc-contact-box .contact-item:last-child { margin-bottom: 0; }
.tc-contact-box .contact-item i { color: #FC5D09; font-size: 1rem; width: 20px; }
.tc-contact-box .contact-item a { color: #112d62; font-weight: 600; text-decoration: none; }
.tc-contact-box .contact-item a:hover { color: #FC5D09; }
.tc-sidebar-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #edf2f7;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    padding: 20px;
    position: sticky;
    top: 80px;
}
.tc-sidebar-card h6 {
    font-size: 0.82rem; font-weight: 700; color: #718096;
    text-transform: uppercase; letter-spacing: 0.5px;
    margin-bottom: 14px;
}
.tc-toc-link {
    display: flex; align-items: center; gap: 8px;
    padding: 7px 10px;
    border-radius: 8px;
    font-size: 0.84rem; color: #4a5568;
    text-decoration: none;
    transition: all 0.15s;
    margin-bottom: 3px;
}
.tc-toc-link:hover { background: #fff5ed; color: #FC5D09; }
.tc-toc-link.active { background: #fff5ed; color: #FC5D09; font-weight: 700; }
.tc-toc-link.active i { color: #FC5D09; }
.tc-toc-link i { font-size: 0.7rem; color: #FC5D09; }
.tc-updated {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f0fff4; border: 1px solid #c6f6d5;
    border-radius: 8px; padding: 6px 14px;
    font-size: 0.8rem; color: #276749;
}
@media (max-width: 768px) {
    .tc-hero h1 { font-size: 1.55rem; }
    .tc-card { padding: 20px 16px; }
    .tc-sidebar-card { position: static; margin-bottom: 24px; }
}
</style>

<!-- Hero Section -->
<section class="py-5 text-white breadcrumb-section tc-hero">
    <div class="container d-flex flex-column align-items-center justify-content-center text-center">
        <h1 class="mt-2 fw-bold">Terms and Conditions</h1>
        <p class="mb-2" style="font-size:0.95rem;opacity:0.85;">Please read these terms carefully before using our services.</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">Terms and Conditions</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Content -->
<main class="container py-5">
    <div class="row g-4">

        <!-- Sidebar TOC -->
        <div class="col-lg-3 order-lg-2">
            <div class="tc-sidebar-card">
                <h6><i class="bi bi-list-ul me-1"></i> Quick Navigation</h6>
                <a href="#acceptance"      class="tc-toc-link"><i class="bi bi-chevron-right"></i>1. Acceptance of Terms</a>
                <a href="#services"        class="tc-toc-link"><i class="bi bi-chevron-right"></i>2. Our Services</a>
                <a href="#booking"         class="tc-toc-link"><i class="bi bi-chevron-right"></i>3. Booking & Confirmation</a>
                <a href="#payment"         class="tc-toc-link"><i class="bi bi-chevron-right"></i>4. Payment Terms</a>
                <a href="#cancellation"    class="tc-toc-link"><i class="bi bi-chevron-right"></i>5. Cancellation & Refund</a>
                <a href="#liability"       class="tc-toc-link"><i class="bi bi-chevron-right"></i>6. Limitation of Liability</a>
                <a href="#goods"           class="tc-toc-link"><i class="bi bi-chevron-right"></i>7. Goods & Prohibited Items</a>
                <a href="#insurance"       class="tc-toc-link"><i class="bi bi-chevron-right"></i>8. Insurance</a>
                <a href="#privacy"         class="tc-toc-link"><i class="bi bi-chevron-right"></i>9. Privacy & Data</a>
                <a href="#conduct"         class="tc-toc-link"><i class="bi bi-chevron-right"></i>10. User Conduct</a>
                <a href="#changes"         class="tc-toc-link"><i class="bi bi-chevron-right"></i>11. Changes to Terms</a>
                <a href="#governing-law"   class="tc-toc-link"><i class="bi bi-chevron-right"></i>12. Governing Law</a>
                <a href="#contact"         class="tc-toc-link"><i class="bi bi-chevron-right"></i>13. Contact Us</a>

                <hr class="my-3">
                <!-- <div class="tc-updated">
                    <i class="bi bi-calendar3"></i> Last updated: August 2025
                </div> -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 order-lg-1">

            <!-- Intro -->
            <div class="tc-card mb-4" style="background:linear-gradient(135deg,#fff8f8,#fff);border-color:#f0d0d0;">
                <p class="tc-section-body mb-0">
                    Welcome to <strong style="color:#112d62;">Bhandari Packers and Movers</strong>. By accessing our website or using any of our relocation, packing, or transport services, you agree to be bound by the following Terms and Conditions. If you do not agree with any part of these terms, please do not use our services.
                </p>
            </div>

            <!-- Section 1 -->
            <div class="tc-card" id="acceptance" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">1</span>
                    <h2 class="tc-section-title">Acceptance of Terms</h2>
                </div>
                <p class="tc-section-body">
                    By submitting a quote request, making a booking, or engaging with Bhandari Packers and Movers in any capacity, you acknowledge that you have read, understood, and agree to these Terms and Conditions in their entirety. These terms constitute a legally binding agreement between you (the "Customer") and Bhandari Packers and Movers (the "Company").
                </p>
            </div>

            <!-- Section 2 -->
            <div class="tc-card" id="services" data-aos="fade-up" data-aos-delay="50">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">2</span>
                    <h2 class="tc-section-title">Our Services</h2>
                </div>
                <p class="tc-section-body mb-2">We provide the following relocation and logistics services:</p>
                <ul class="tc-section-body">
                    <li>Household / Home Shifting</li>
                    <li>Office / Commercial Relocation</li>
                    <li>Car & Two-Wheeler Transportation</li>
                    <li>Packing & Unpacking of Goods</li>
                    <li>Loading & Unloading Services</li>
                    <li>Warehousing & Storage Solutions</li>
                    <li>Courier & Cargo Services</li>
                    <li>Goods Insurance Assistance</li>
                </ul>
                <p class="tc-section-body mt-2">
                    All services are subject to availability, route feasibility, and prior confirmation by our team.
                </p>
            </div>

            <!-- Section 3 -->
            <div class="tc-card" id="booking" data-aos="fade-up" data-aos-delay="100">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">3</span>
                    <h2 class="tc-section-title">Booking & Confirmation</h2>
                </div>
                <ul class="tc-section-body">
                    <li>A booking is considered confirmed only upon receipt of advance payment and written/WhatsApp confirmation from our team.</li>
                    <li>The Customer must provide accurate pickup and drop addresses, contact details, and inventory list at the time of booking.</li>
                    <li>Any change in the moving date must be intimated at least <strong>48 hours</strong> in advance.</li>
                    <li>Bhandari Packers and Movers reserves the right to reschedule services in case of unforeseen circumstances (natural calamities, vehicle breakdown, etc.).</li>
                </ul>
            </div>

            <!-- Section 4 -->
            <div class="tc-card" id="payment" data-aos="fade-up" data-aos-delay="150">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">4</span>
                    <h2 class="tc-section-title">Payment Terms</h2>
                </div>
                <ul class="tc-section-body">
                    <li>An advance booking fee (as quoted) is required to confirm your shifting slot.</li>
                    <li>The remaining balance is payable at the time of delivery or as agreed upon booking.</li>
                    <li>Payments can be made via cash, UPI, NEFT/IMPS, or other approved payment modes.</li>
                    <li>All prices are inclusive of applicable taxes unless stated otherwise.</li>
                    <li>Quotes provided online are indicative. Final pricing may vary based on actual inventory, distance, and special handling requirements.</li>
                </ul>
            </div>

            <!-- Section 5 -->
            <div class="tc-card" id="cancellation" data-aos="fade-up" data-aos-delay="200">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">5</span>
                    <h2 class="tc-section-title">Cancellation & Refund Policy</h2>
                </div>
                <ul class="tc-section-body">
                    <li><strong>Cancellation 7+ days before shifting:</strong> Full refund of advance payment.</li>
                    <li><strong>Cancellation 3–6 days before shifting:</strong> 50% of advance will be refunded.</li>
                    <li><strong>Cancellation within 48 hours:</strong> No refund of the advance payment.</li>
                    <li>In case of cancellation by the Company, a full refund will be issued within 5–7 working days.</li>
                    <li>Refunds will be processed to the original payment source only.</li>
                </ul>
            </div>

            <!-- Section 6 -->
            <div class="tc-card" id="liability" data-aos="fade-up" data-aos-delay="250">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">6</span>
                    <h2 class="tc-section-title">Limitation of Liability</h2>
                </div>
                <p class="tc-section-body">
                    While we take utmost care during packing, loading, and transportation, Bhandari Packers and Movers shall not be held liable for:
                </p>
                <ul class="tc-section-body">
                    <li>Damage to items that were not packed by our team</li>
                    <li>Damage caused by pre-existing defects, wear & tear, or fragile items without prior declaration</li>
                    <li>Loss or damage due to force majeure events (floods, earthquakes, riots, etc.)</li>
                    <li>Delay in delivery caused by traffic, government restrictions, or road blockages</li>
                </ul>
                <p class="tc-section-body mt-2">
                    Our maximum liability is limited to the invoice value of the service or the declared value of goods, whichever is lower.
                </p>
            </div>

            <!-- Section 7 -->
            <div class="tc-card" id="goods" data-aos="fade-up" data-aos-delay="300">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">7</span>
                    <h2 class="tc-section-title">Goods & Prohibited Items</h2>
                </div>
                <p class="tc-section-body mb-2">The following items are <strong>strictly prohibited</strong> from being transported:</p>
                <ul class="tc-section-body">
                    <li>Explosives, flammable materials, or hazardous chemicals</li>
                    <li>Illegal drugs, narcotics, or contraband</li>
                    <li>Perishable food items, plants, or live animals</li>
                    <li>Currency, jewelry, or valuables (unless declared and insured)</li>
                    <li>Confidential government documents</li>
                </ul>
                <p class="tc-section-body mt-2">
                    The customer is fully responsible for disclosing the nature and value of goods being moved. We reserve the right to refuse transportation of any item deemed unsafe or unlawful.
                </p>
            </div>

            <!-- Section 8 -->
            <div class="tc-card" id="insurance" data-aos="fade-up" data-aos-delay="350">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">8</span>
                    <h2 class="tc-section-title">Insurance</h2>
                </div>
                <p class="tc-section-body">
                    We strongly recommend purchasing goods-in-transit insurance for all shipments. Insurance can be arranged through us at an additional cost based on the declared value of goods. In the absence of insurance, claims for damage or loss will be assessed at our discretion and will be limited to basic liability as outlined in Section 6.
                </p>
            </div>

            <!-- Section 9 -->
            <div class="tc-card" id="privacy" data-aos="fade-up" data-aos-delay="400">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">9</span>
                    <h2 class="tc-section-title">Privacy & Data Usage</h2>
                </div>
                <p class="tc-section-body">
                    We collect personal information (name, phone, address) solely for the purpose of service delivery and communication. Your data will never be sold to third parties. For full details, please review our <a href="<?= site_url('privacy-policy') ?>">Privacy Policy</a>.
                </p>
            </div>

            <!-- Section 10 -->
            <div class="tc-card" id="conduct" data-aos="fade-up" data-aos-delay="450">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">10</span>
                    <h2 class="tc-section-title">User Conduct</h2>
                </div>
                <ul class="tc-section-body">
                    <li>Customers must treat our staff with respect at all times.</li>
                    <li>Providing false information during booking may result in immediate cancellation without refund.</li>
                    <li>Any attempt to misuse our online systems, submit fraudulent claims, or engage in abusive communication will be reported to the appropriate authorities.</li>
                </ul>
            </div>

            <!-- Section 11 -->
            <div class="tc-card" id="changes" data-aos="fade-up" data-aos-delay="500">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">11</span>
                    <h2 class="tc-section-title">Changes to Terms</h2>
                </div>
                <p class="tc-section-body">
                    Bhandari Packers and Movers reserves the right to update or modify these Terms and Conditions at any time without prior notice. Changes will be effective immediately upon publication on our website. Continued use of our services after any changes constitutes your acceptance of the revised terms.
                </p>
            </div>

            <!-- Section 12 -->
            <div class="tc-card" id="governing-law" data-aos="fade-up" data-aos-delay="550">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">12</span>
                    <h2 class="tc-section-title">Governing Law & Jurisdiction</h2>
                </div>
                <p class="tc-section-body">
                    These Terms and Conditions are governed by the laws of India. Any disputes arising from the use of our services shall be subject to the exclusive jurisdiction of the courts of <strong>Gautam Budh Nagar, Uttar Pradesh, India</strong>. We encourage customers to first reach out to us directly to resolve any concerns amicably.
                </p>
            </div>

            <!-- Section 13 – Contact -->
            <div class="tc-card" id="contact" data-aos="fade-up" data-aos-delay="600">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="tc-section-num">13</span>
                    <h2 class="tc-section-title">Contact Us</h2>
                </div>
                <p class="tc-section-body mb-3">
                    If you have any questions or concerns about these Terms and Conditions, please contact us:
                </p>
                <div class="tc-contact-box">
                    <div class="contact-item">
                        <i class="bi bi-building"></i>
                        <span><strong><?= $company3 ?></strong><br>
                        <?= $address ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="<?= $phonehtml ?>"><?= $phone ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="<?= $mailhtml ?>"><?= $mail ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-globe"></i>
                        <a href="<?= base_url() ?>" target="_blank"><?= $companydomain ?></a>
                    </div>
                </div>
            </div>

            <!-- Bottom note -->
            <div class="text-center mt-4 mb-2">
                <p style="font-size:0.82rem;color:#a0aec0;">
                    <i class="bi bi-shield-check me-1 text-success"></i>
                    By using our services, you confirm that you have read and agreed to these Terms and Conditions.
                </p>
                <a href="<?= site_url() ?>" class="btn btn-danger px-4 py-2" style="background:linear-gradient(135deg,#FC5D09,#ff4b2b);border:none;border-radius:50px;font-weight:600;">
                    <i class="bi bi-house-door-fill me-1"></i> Back to Home
                </a>
            </div>

        </div><!-- end col -->
    </div><!-- end row -->
</main>

<script>
// ─── Active TOC highlight via IntersectionObserver ───────────────────────────
(function() {
    var sections = document.querySelectorAll('.tc-card[id]');
    var tocLinks = document.querySelectorAll('.tc-toc-link');

    if (!sections.length || !tocLinks.length) return;

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                tocLinks.forEach(function(l) { l.classList.remove('active'); });
                var active = document.querySelector('.tc-toc-link[href="#' + entry.target.id + '"]');
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-80px 0px -60% 0px', threshold: 0 });

    sections.forEach(function(s) { observer.observe(s); });

    // Smooth scroll on TOC click
    tocLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                var target = document.querySelector(href);
                if (target) {
                    var offset = target.getBoundingClientRect().top + window.scrollY - 85;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                    // update active immediately
                    tocLinks.forEach(function(l) { l.classList.remove('active'); });
                    this.classList.add('active');
                }
            }
        });
    });
})();
</script>
 