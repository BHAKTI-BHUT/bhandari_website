<style>
/* ===== Cancellation & Refund Policy Page ===== */
.pv-hero {
    padding: 60px 0 40px;
    position: relative;
    overflow: hidden;
}
.pv-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #edf2f7;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    padding: 32px 36px;
    margin-bottom: 20px;
    transition: box-shadow 0.2s;
    scroll-margin-top: 90px;
}
.pv-card:hover { box-shadow: 0 8px 32px rgba(252, 93, 9,0.08); }
.pv-section-num {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff; font-weight: 800; font-size: 0.9rem;
    border-radius: 8px;
    flex-shrink: 0;
}
.pv-section-title {
    font-size: 1.1rem; font-weight: 700; color: #112d62; margin: 0;
}
.pv-section-body {
    font-size: 0.92rem; color: #4a5568; line-height: 1.8; margin: 0;
}
.pv-section-body ul { margin: 10px 0 0; padding-left: 20px; }
.pv-section-body ul li { margin-bottom: 6px; }
.pv-section-body a { color: #FC5D09; font-weight: 600; text-decoration: none; }
.pv-section-body a:hover { text-decoration: underline; }
.pv-contact-box {
    background: linear-gradient(135deg, #fff8f8, #fff);
    border: 1.5px solid #f0d0d0;
    border-radius: 14px;
    padding: 24px 28px;
}
.pv-contact-box .contact-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.9rem; color: #4a5568; margin-bottom: 10px;
}
.pv-contact-box .contact-item:last-child { margin-bottom: 0; }
.pv-contact-box .contact-item i { color: #FC5D09; font-size: 1rem; width: 20px; }
.pv-contact-box .contact-item a { color: #112d62; font-weight: 600; text-decoration: none; }
.pv-contact-box .contact-item a:hover { color: #FC5D09; }
.pv-sidebar-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #edf2f7;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    padding: 20px;
    position: sticky;
    top: 80px;
    max-height: calc(100vh - 100px);
    overflow-y: auto;
}
.pv-sidebar-card h6 {
    font-size: 0.82rem; font-weight: 700; color: #718096;
    text-transform: uppercase; letter-spacing: 0.5px;
    margin-bottom: 14px;
}
.pv-toc-link {
    display: flex; align-items: center; gap: 8px;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 0.82rem; color: #4a5568;
    text-decoration: none;
    transition: all 0.15s;
    margin-bottom: 2px;
}
.pv-toc-link:hover { background: #fff5ed; color: #FC5D09; }
.pv-toc-link.active { background: #fff5ed; color: #FC5D09; font-weight: 700; }
.pv-toc-link.active i { color: #FC5D09; }
.pv-toc-link i { font-size: 0.7rem; color: #FC5D09; }
@media (max-width: 768px) {
    .pv-card { padding: 20px 16px; }
    .pv-sidebar-card { position: static; max-height: none; margin-bottom: 24px; }
}
</style>

<!-- Hero Section -->
<section class="py-5 text-white breadcrumb-section pv-hero">
    <div class="container d-flex flex-column align-items-center justify-content-center text-center">
        <h1 class="mt-2 fw-bold">Cancellation & Refund Policy</h1>
        <p class="mb-2" style="font-size:0.95rem;opacity:0.85;">Effective Date: 10 August 2026</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">Cancellation & Refund Policy</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Content -->
<main class="container py-5">
    <div class="row g-4">

        <!-- Sidebar TOC -->
        <div class="col-lg-3 order-lg-2">
            <div class="pv-sidebar-card">
                <h6><i class="bi bi-list-ul me-1"></i> Quick Navigation</h6>
                <a href="#about"           class="pv-toc-link"><i class="bi bi-chevron-right"></i>1. Policy Purpose</a>
                <a href="#scope"           class="pv-toc-link"><i class="bi bi-chevron-right"></i>2. Scope & Applicability</a>
                <a href="#cancellation-req" class="pv-toc-link"><i class="bi bi-chevron-right"></i>3. Cancellation Process</a>
                <a href="#refund-slab"     class="pv-toc-link"><i class="bi bi-chevron-right"></i>4. Refund Eligibility</a>
                <a href="#non-refundable"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>5. Non-Refundable Charges</a>
                <a href="#payment-gateway" class="pv-toc-link"><i class="bi bi-chevron-right"></i>6. Mode of Refund</a>
                <a href="#contact"         class="pv-toc-link"><i class="bi bi-chevron-right"></i>7. Contact Support</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 order-lg-1">

            <!-- Intro Box -->
            <div class="pv-card mb-4" style="background:linear-gradient(135deg,#fff8f8,#fff);border-color:#f0d0d0;">
                <p class="pv-section-body mb-2">
                    <strong style="color:#112d62;">Bhandari Packers and Movers</strong> ("Company", "we", "our", or "us") aims to provide transparent, reliable, and customer-centric packing and moving services.
                </p>
                <p class="pv-section-body mb-0">
                    This Cancellation & Refund Policy outlines the terms and conditions under which a Customer may cancel a service booking and the procedures for processing applicable refunds.
                </p>
            </div>

            <!-- Section 1 -->
            <div class="pv-card" id="about" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">1</span>
                    <h2 class="pv-section-title">Policy Purpose</h2>
                </div>
                <p class="pv-section-body">
                    The purpose of this Cancellation & Refund Policy is to ensure clarity and fairness for both the Customer and Bhandari Packers and Movers when a booking needs to be modified, postponed, or cancelled.
                </p>
            </div>

            <!-- Section 2 -->
            <div class="pv-card" id="scope" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">2</span>
                    <h2 class="pv-section-title">Scope & Applicability</h2>
                </div>
                <p class="pv-section-body mb-2">This policy applies to all relocation, transportation, packing, unpacking, loading, unloading, and warehousing services booked via:</p>
                <ul class="pv-section-body">
                    <li>Our official website (<a href="https://www.bhandaripackersandmovers.in" target="_blank">bhandaripackersandmovers.in</a>)</li>
                    <li>Our Mobile Application</li>
                    <li>Customer Service Call Center or WhatsApp support</li>
                    <li>Authorized representatives of Bhandari Packers and Movers</li>
                </ul>
            </div>

            <!-- Section 3 -->
            <div class="pv-card" id="cancellation-req" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">3</span>
                    <h2 class="pv-section-title">Cancellation Request Process</h2>
                </div>
                <p class="pv-section-body mb-2">To submit a cancellation request, Customers must:</p>
                <ul class="pv-section-body">
                    <li>Log into their account and navigate to <strong>My Bookings</strong> to initiate a request, or</li>
                    <li>Email our support team at <a href="mailto:info@bhandaripackersandmovers.in">info@bhandaripackersandmovers.in</a> with booking ID and reason, or</li>
                    <li>Contact Customer Support at <a href="<?= $phonehtml ?>">+91 <?= $phone ?></a>.</li>
                </ul>
                <p class="pv-section-body mt-2">
                    Cancellation requests will be acknowledged via email/SMS with a unique cancellation tracking reference.
                </p>
            </div>

            <!-- Section 4 -->
            <div class="pv-card" id="refund-slab" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">4</span>
                    <h2 class="pv-section-title">Refund Eligibility & Cancellation Timelines</h2>
                </div>
                <p class="pv-section-body mb-2">Refunds on advance booking tokens or payments are calculated based on notice provided before scheduled pickup time:</p>
                <ul class="pv-section-body">
                    <li><strong>More than 48 hours before pickup:</strong> 100% refund of token/advance amount (minus standard bank/gateway transaction fee).</li>
                    <li><strong>Between 24 to 48 hours before pickup:</strong> 50% refund of advance token amount.</li>
                    <li><strong>Less than 24 hours before pickup:</strong> Advance token amount is non-refundable due to resource & vehicle mobilization costs.</li>
                    <li><strong>Post Vehicle Arrival / On-site Cancellation:</strong> Advance token is non-refundable, plus visiting/transport charges may apply.</li>
                </ul>
            </div>

            <!-- Section 5 -->
            <div class="pv-card" id="non-refundable" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">5</span>
                    <h2 class="pv-section-title">Non-Refundable Items & Charges</h2>
                </div>
                <p class="pv-section-body mb-2">The following charges are non-refundable under any circumstances:</p>
                <ul class="pv-section-body">
                    <li>Transit insurance premium charges once policy is generated</li>
                    <li>Special packaging material purchased specifically for customer request</li>
                    <li>Government taxes, toll taxes, state entry taxes already disbursed</li>
                    <li>Third-party crane/labor costs already dispatched</li>
                </ul>
            </div>

            <!-- Section 6 -->
            <div class="pv-card" id="payment-gateway" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">6</span>
                    <h2 class="pv-section-title">Mode & Processing Timeline of Refund</h2>
                </div>
                <p class="pv-section-body mb-2">
                    All eligible refunds will be credited directly to the original payment source (Bank Account, UPI, Credit/Debit Card) used during booking.
                </p>
                <p class="pv-section-body">
                    Approved refunds are processed within <strong>5 to 7 working days</strong> from the date of cancellation approval.
                </p>
            </div>

            <!-- Section 7 -->
            <div class="pv-card" id="contact" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">7</span>
                    <h2 class="pv-section-title">Contact Support & Helpdesk</h2>
                </div>
                <p class="pv-section-body mb-3">For any refund queries or assistance regarding your cancellation, reach out to us:</p>
                <div class="pv-contact-box">
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
                </div>
            </div>

            <!-- Bottom Action -->
            <div class="text-center mt-4 mb-2">
                <p style="font-size:0.82rem;color:#a0aec0;">
                    <i class="bi bi-shield-check me-1 text-success"></i>
                    Bhandari Packers and Movers is committed to fair and transparent customer service.
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
    var sections = document.querySelectorAll('.pv-card[id]');
    var tocLinks = document.querySelectorAll('.pv-toc-link');

    if (!sections.length || !tocLinks.length) return;

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                tocLinks.forEach(function(l) { l.classList.remove('active'); });
                var active = document.querySelector('.pv-toc-link[href="#' + entry.target.id + '"]');
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
                    tocLinks.forEach(function(l) { l.classList.remove('active'); });
                    this.classList.add('active');
                }
            }
        });
    });
})();
</script>
