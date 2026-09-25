<?php
/**
 * Homepage View — Bhandari Packers & Movers
 * Phase 4 Rebuild: Noida & Greater Noida Home Shifting Focus
 *
 * Layout note: This partial view is loaded inside template/layout1.php
 * which includes:  template/header.php, template/navigation.php,
 *                  template/slider.php (with H1), then THIS file,
 *                  then template/footer.php
 *
 * Heading hierarchy in THIS file:
 *   H2 → section headings
 *   H3 → sub-section / card headings
 */
?>

<?php /* ===================================================
   SECTION 1 — INSTANT QUOTE GENERATOR
   Existing serviceform.php — DO NOT modify the include
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['quote_form']) || !empty($homepage_sections['quote_form'])): ?>
<div class="container-fluid cards-slid">
  <?php $this->load->view('contacts/serviceform.php') ?>
</div>
<?php endif; ?>

<?php /* ===================================================
   SECTION 2 — TRUST STRIP
   Quick credibility signals right after the quote form
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['trust_strip']) || !empty($homepage_sections['trust_strip'])): ?>
<section class="trust-strip py-3" aria-label="Trust and Credentials">
  <div class="container">
    <div class="row g-2 justify-content-center align-items-center text-center">
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-patch-check-fill trust-badge-icon" aria-hidden="true"></i>
          <span class="trust-badge-label">ISO 9001:2015<br>Certified</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-building-fill-check trust-badge-icon" aria-hidden="true"></i>
          <span class="trust-badge-label">Govt.<br>Registered</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-calendar2-check-fill trust-badge-icon" aria-hidden="true"></i>
          <span class="trust-badge-label">Serving Since<br>2010</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-geo-alt-fill trust-badge-icon" aria-hidden="true"></i>
          <span class="trust-badge-label">Noida &amp;<br>Greater Noida</span>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

<?php /* ===================================================
   SECTION 3 — ABOUT / BUSINESS INTRODUCTION
   ===================================================== */ 
   $about_title = (!empty($why_choose_setting) && !empty($why_choose_setting->title)) 
       ? $why_choose_setting->title 
       : 'Why Choose <br><span class="text-danger">Bhandari Packers?</span>';
   $who_we_are_title = (!empty($why_choose_setting) && !empty($why_choose_setting->subtitle_title))
       ? $why_choose_setting->subtitle_title
       : 'Why Choose Us';
   $about_desc = (!empty($why_choose_setting) && !empty($why_choose_setting->description))
       ? $why_choose_setting->description
       : null;
?>
<?php if (!isset($homepage_sections['about']) || !empty($homepage_sections['about'])): ?>
<section class="py-5" id="about">
  <div class="container py-4 pt-0">
    <div class="row align-items-start justify-content-between g-4 g-lg-5">

      <div class="col-lg-5 mb-4 mb-lg-0 animate about-media-col">
        <div class="about-media-wrapper sticky-lg-top" style="top: 100px; z-index: 1;">
          <div class="about-img-box position-relative overflow-hidden rounded-4 shadow-sm mb-3">
            <img
              src="<?= base_url('assets/images/gallery/newabout.png') ?>"
              alt="Bhandari Packers and Movers team ready for home shifting in Noida"
              width="768" height="512"
              class="img-fluid rounded-4 w-100 object-fit-cover shadow"
              style="max-height: 380px;"
              loading="lazy">
            <div class="about-img-badge position-absolute bottom-0 start-0 m-3 px-3 py-2 rounded-3 text-white bg-dark bg-opacity-75 d-flex align-items-center gap-2">
              <i class="bi bi-patch-check-fill text-warning fs-5"></i>
              <div class="text-start">
                <span class="d-block fw-bold small lh-1">ISO 9001:2015</span>
                <span class="d-block text-white-50" style="font-size: 11px;">Certified Relocation</span>
              </div>
            </div>
          </div>

          <!-- Trust & Stats Strip below Image to fill vertical space -->
          <div class="about-stats-card p-3 rounded-3 bg-white border shadow-sm">
            <div class="row g-2 text-center align-items-center">
              <div class="col-4 border-end">
                <span class="fw-bold fs-4 text-danger d-block mb-0">14+</span>
                <span class="text-muted small" style="font-size: 11px;">Years Trust</span>
              </div>
              <div class="col-4 border-end">
                <span class="fw-bold fs-4 text-danger d-block mb-0">50K+</span>
                <span class="text-muted small" style="font-size: 11px;">Happy Moves</span>
              </div>
              <div class="col-4">
                <span class="fw-bold fs-4 text-warning d-block mb-0">4.9★</span>
                <span class="text-muted small" style="font-size: 11px;">Google Rated</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-7 animate delay-1">
        <span class="section-label-tag"><?= htmlspecialchars(strip_tags($who_we_are_title)) ?></span>
        <h2 class="section-h2 mt-2 mb-3">
          <?= (strpos($about_title, '<') !== false) ? $about_title : htmlspecialchars($about_title) ?>
        </h2>
        <?php if (!empty($about_desc)): ?>
          <div class="section-para-text">
            <?= $about_desc ?>
          </div>
        <?php else: ?>
          <p class="section-para-text">
            Bhandari Packers and Movers is a <strong>Govt. registered, ISO 9001:2015 certified</strong>
            relocation company based in Noida. We have been helping families and businesses in
            Noida, Greater Noida, and the NCR region move safely and smoothly since 2010.
          </p>
          <p class="section-para-text">
            Our team specialises in home shifting — whether it's a local move within Noida sectors,
            a shift to Greater Noida West, or an intercity relocation across India.
            We use quality packing materials and take care of your belongings as our own.
          </p>
        <?php endif; ?>

        <div class="row mt-4 g-3">
          <?php if (!empty($why_choose_items)): ?>
            <?php foreach (array_slice($why_choose_items, 0, 4) as $item): ?>
              <div class="col-md-6">
                <div class="about-feature-item">
                  <i class="<?= htmlspecialchars($item->icon_class ?: 'bi bi-check2-circle') ?> about-feature-icon" aria-hidden="true"></i>
                  <div>
                    <strong><?= htmlspecialchars($item->title) ?></strong>
                    <p class="mb-0 text-muted small"><?= htmlspecialchars($item->description) ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="col-md-6">
              <div class="about-feature-item">
                <i class="bi bi-check2-circle about-feature-icon" aria-hidden="true"></i>
                <div>
                  <strong>Experienced Team</strong>
                  <p class="mb-0 text-muted small">Trained movers with years of hands-on experience</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="about-feature-item">
                <i class="bi bi-shield-check about-feature-icon" aria-hidden="true"></i>
                <div>
                  <strong>Goods Insurance Available</strong>
                  <p class="mb-0 text-muted small">Transit insurance option for added peace of mind</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="about-feature-item">
                <i class="bi bi-truck about-feature-icon" aria-hidden="true"></i>
                <div>
                  <strong>Well-Maintained Vehicles</strong>
                  <p class="mb-0 text-muted small">Closed-body trucks for safe transportation</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="about-feature-item">
                <i class="bi bi-currency-rupee about-feature-icon" aria-hidden="true"></i>
                <div>
                  <strong>Transparent Pricing</strong>
                  <p class="mb-0 text-muted small">Clear quotes with no hidden charges</p>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>

        <div class="mt-4 d-flex flex-wrap gap-2">
          <a href="<?= site_url('about') ?>" class="btn btn-danger px-4">
            <i class="bi bi-info-circle me-2" aria-hidden="true"></i>About Us
          </a>
          <a href="<?= site_url('why-choose-us') ?>" class="btn btn-outline-danger px-4">
            Why Choose Us
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 4 — MAIN SERVICES
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['services']) || !empty($homepage_sections['services'])): ?>
<section class="section-services py-5 bg-light" id="services">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-10 col-lg-8">
        <span class="section-label-tag">What We Do</span>
        <h2 class="section-h2 mt-2 mb-3 text-dark">
          Our Packing &amp; Moving Services in Noida
        </h2>
        <p class="text-muted">
          From local home shifting within Noida sectors to intercity moves across India —
          we provide reliable, professional relocation services tailored to your needs.
        </p>
      </div>
    </div>

    <div class="row g-4 justify-content-center">

      <?php if (!empty($services)): ?>
        <?php foreach ($services as $service): ?>
          <div class="col-md-6 col-lg-4">
            <div class="service-card-v2 text-center p-4 h-100 d-flex flex-column justify-content-between">
              <div>
                <div class="service-card-icon-wrap mb-3">
                  <i class="<?= htmlspecialchars($service->icon_class ?: 'ri-truck-line') ?> fs-2" aria-hidden="true"></i>
                </div>
                <h3 class="fw-semibold fs-5 mb-2"><?= htmlspecialchars($service->service_name) ?></h3>
                <p class="text-muted small mb-3"><?= htmlspecialchars($service->short_description) ?></p>
              </div>
              <div>
                <a href="<?= site_url('services/' . $service->slug) ?>" class="btn-service-link" aria-label="View <?= htmlspecialchars($service->service_name) ?> service details">
                  View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-house-door-fill fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Home Shifting</h3>
            <p class="text-muted small mb-3">Safe and careful home relocation — from packing your belongings to setting them up at your new address.</p>
            <a href="<?= site_url('home-relocation') ?>" class="btn-service-link" aria-label="View Home Shifting service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-building fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Office &amp; Corporate Shifting</h3>
            <p class="text-muted small mb-3">Minimal-downtime office relocation — furniture, IT equipment, and documents handled with care.</p>
            <a href="<?= site_url('office-relocation') ?>" class="btn-service-link" aria-label="View Office Relocation service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-pin-map-fill fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Local Shifting</h3>
            <p class="text-muted small mb-3">Moving within the same city or nearby area — quick, affordable, and hassle-free local relocation.</p>
            <a href="<?= site_url('home-relocation') ?>" class="btn-service-link" aria-label="View Local Shifting service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-truck fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Intercity Shifting</h3>
            <p class="text-muted small mb-3">Long-distance moves from Noida to any city across India — GPS-tracked, timely delivery guaranteed.</p>
            <a href="<?= site_url('home-relocation') ?>" class="btn-service-link" aria-label="View Intercity Shifting service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-box-seam-fill fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Packing &amp; Unpacking</h3>
            <p class="text-muted small mb-3">Quality packing materials including bubble wrap, corrugated boxes, and foam padding for fragile items.</p>
            <a href="<?= site_url('packing-unpacking') ?>" class="btn-service-link" aria-label="View Packing and Unpacking service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-box-arrow-up fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Loading &amp; Unloading</h3>
            <p class="text-muted small mb-3">Careful handling of heavy and fragile items — our trained staff ensures safe loading and unloading.</p>
            <a href="<?= site_url('loading-unloading') ?>" class="btn-service-link" aria-label="View Loading and Unloading service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-car-front-fill fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Vehicle Transportation</h3>
            <p class="text-muted small mb-3">Safe car and bike transport via enclosed carriers — your vehicle protected throughout transit.</p>
            <a href="<?= site_url('car-transportation-service') ?>" class="btn-service-link" aria-label="View Vehicle Transportation service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>

        <div class="col-md-6 col-lg-4">
          <div class="service-card-v2 text-center p-4 h-100">
            <div class="service-card-icon-wrap mb-3">
              <i class="bi bi-archive-fill fs-2" aria-hidden="true"></i>
            </div>
            <h3 class="fw-semibold fs-5 mb-2">Warehouse &amp; Storage</h3>
            <p class="text-muted small mb-3">Short and long-term storage solutions with security monitoring — ideal during transition periods.</p>
            <a href="<?= site_url('warehousing-services') ?>" class="btn-service-link" aria-label="View Warehouse and Storage service details">
              View Details <i class="bi bi-arrow-right ms-1" aria-hidden="true"></i>
            </a>
          </div>
        </div>
      <?php endif; ?>

      <div class="col-12 text-center mt-5 pt-3">
        <a href="<?= site_url('services') ?>" class="btn btn-outline-danger px-5 py-2 fw-semibold rounded-pill shadow-sm">
          <i class="bi bi-grid-3x3-gap me-2" aria-hidden="true"></i>View All Services
        </a>
      </div>

    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 5 — HOW OUR MOVING PROCESS WORKS
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['shifting']) || !empty($homepage_sections['shifting'])): ?>
  <?php $this->load->view('template/shifting.php') ?>
<?php endif; ?>

<?php /* ===================================================
   SECTION 6 — SERVICE AREAS
   Noida & Greater Noida focus
   ===================================================== */ ?>
<!-- <section class="service-areas-section py-5 bg-light" id="service-areas">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-10 col-lg-8">
        <span class="section-label-tag">Where We Operate</span>
        <h2 class="section-h2 mt-2 mb-3 text-dark">
          Areas We Serve in Noida &amp; Greater Noida
        </h2>
        <p class="text-muted">
          We cover Noida, Greater Noida, Greater Noida West, and the wider Delhi-NCR region.
          Our primary focus is <strong>home shifting in Noida and Greater Noida</strong> — including
          all major sectors, townships, and residential societies.
        </p>
      </div>
    </div>

    <div class="row g-4 mb-4">
      <div class="col-md-6 col-lg-4">
        <div class="area-card featured-area">
          <div class="area-card-header">
            <i class="bi bi-geo-alt-fill me-2" aria-hidden="true"></i>
            <span>Noida</span>
            <span class="area-badge ms-auto">Primary Area</span>
          </div>
          <div class="area-card-body">
            <p class="text-muted small mb-3">All sectors of Noida — Sector 12, 18, 50, 62, 70, 93, 100, 104, 110, 119, 120, 121, 122, 126, 128, 132, 135, 137, 143, 144, 150, 168 and more.</p>
            <a href="<?= site_url('contacts') ?>" class="btn btn-danger btn-sm px-3" aria-label="Get a quote for home shifting in Noida">
              Get a Quote
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="area-card featured-area">
          <div class="area-card-header">
            <i class="bi bi-geo-alt-fill me-2" aria-hidden="true"></i>
            <span>Greater Noida</span>
            <span class="area-badge ms-auto">Primary Area</span>
          </div>
          <div class="area-card-body">
            <p class="text-muted small mb-3">Beta 1 &amp; 2, Gamma 1 &amp; 2, Delta 1-4, Omicron 1-3, Zeta 1 &amp; 2, Alpha 1 &amp; 2, Gaur City 1 &amp; 2, Pari Chowk, Knowledge Park.</p>
            <a href="<?= site_url('contacts') ?>" class="btn btn-danger btn-sm px-3" aria-label="Get a quote for home shifting in Greater Noida">
              Get a Quote
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="area-card">
          <div class="area-card-header">
            <i class="bi bi-geo-alt me-2" aria-hidden="true"></i>
            <span>Greater Noida West</span>
          </div>
          <div class="area-card-body">
            <p class="text-muted small mb-3">Gaur City, Crossing Republik, Raj Nagar Extension, Siddharth Vihar — all covered with our home shifting services.</p>
            <a href="<?= site_url('contacts') ?>" class="btn btn-outline-danger btn-sm px-3" aria-label="Contact us for packers and movers in Greater Noida West">
              Contact Us
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="area-card">
          <div class="area-card-header">
            <i class="bi bi-geo-alt me-2" aria-hidden="true"></i>
            <span>Ghaziabad</span>
          </div>
          <div class="area-card-body">
            <p class="text-muted small mb-3">Indirapuram, Vasundhara, Vaishali, Kaushambi, Raj Nagar, Crossing Republik and surrounding areas.</p>
            <a href="<?= site_url('contacts') ?>" class="btn btn-outline-danger btn-sm px-3" aria-label="Contact us for packers and movers in Ghaziabad">
              Contact Us
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="area-card">
          <div class="area-card-header">
            <i class="bi bi-geo-alt me-2" aria-hidden="true"></i>
            <span>Delhi</span>
          </div>
          <div class="area-card-body">
            <p class="text-muted small mb-3">South Delhi, Vasant Kunj, Dwarka, East Delhi, West Delhi, and all major Delhi localities.</p>
            <a href="<?= site_url('contacts') ?>" class="btn btn-outline-danger btn-sm px-3" aria-label="Contact us for packers and movers in Delhi">
              Contact Us
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-6 col-lg-4">
        <div class="area-card area-card-cta text-center">
          <div class="area-card-body py-3">
            <i class="bi bi-map-fill fs-2 text-danger mb-2 d-block" aria-hidden="true"></i>
            <strong class="d-block mb-2">Intercity — All Over India</strong>
            <p class="text-muted small mb-3">Moving from Noida to any city in India? We provide reliable door-to-door intercity shifting.</p>
            <a href="<?= site_url('contacts') ?>" class="btn btn-danger btn-sm px-3" aria-label="Contact us for intercity moving">
              Get a Free Quote
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> -->

<?php /* ===================================================
   SECTION 7 — ACHIEVEMENTS COUNTER STRIP
   ===================================================== */ ?>
<?php if (!empty($homepage_sections['achievements'])): ?>
  <?php $this->load->view('template/achievements.php') ?>
<?php endif; ?>

<?php /* ===================================================
   SECTION 8 — TRUST BADGES (GOOGLE & IBA RECOGNIZED)
   ===================================================== */ ?>
<?php if (!empty($homepage_sections['badges'])): ?>
  <?php $this->load->view('template/badge.php') ?>
<?php endif; ?>

<?php 
  $show_qs = (!isset($homepage_sections['quote_showcase']) || !empty($homepage_sections['quote_showcase'])) ||
             (!isset($homepage_sections['quote_calculator']) || !empty($homepage_sections['quote_calculator'])) ||
             (!isset($homepage_sections['verified_movers']) || !empty($homepage_sections['verified_movers']));
?>
<?php if ($show_qs): ?>
  <?php $this->load->view('home/dynamic_quote_section'); ?>
<?php endif; ?>

<?php /* ===================================================
   SECTION 9 — CUSTOMER VIDEOS / REAL PROJECT PROOF
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['customer_videos']) || !empty($homepage_sections['customer_videos'])): ?>
<section class="py-5 bg-light" id="customer-videos">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-10 col-lg-8">
        <span class="section-label-tag">Real Moving Stories</span>
        <h2 class="section-h2 mt-2 mb-3 text-dark">
          Our Customers Share Their Experience
        </h2>
        <p class="text-muted">
          Watch how Bhandari Packers &amp; Movers handled real home shifting projects
          for our customers in Noida and Greater Noida.
        </p>
      </div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-12 col-md-6">
        <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
          <iframe
            src="https://www.youtube.com/embed/UJ0z6WMLlyg"
            title="Bhandari Packers and Movers — Customer Experience Video 1"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy">
          </iframe>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
          <iframe
            src="https://www.youtube.com/embed/KjkKMzTz_Yg"
            title="Bhandari Packers and Movers — Customer Experience Video 2"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy">
          </iframe>
        </div>
      </div>
    </div>
    <div class="text-center mt-4">
      <p class="text-muted small">
        <i class="bi bi-youtube text-danger me-1" aria-hidden="true"></i>
        Subscribe to our
        <a href="https://www.youtube.com/@BhandariPackersandMovers" target="_blank" rel="noopener noreferrer" class="text-danger">
          YouTube channel
        </a>
        for more moving tips and customer stories.
      </p>
    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 10 — CUSTOMER REVIEWS
   ===================================================== */ ?>
<?php 
  $googlePlaceData = function_exists('get_google_place_details') ? get_google_place_details() : [];
  $gPlaceRating    = isset($googlePlaceData['rating']) ? floatval($googlePlaceData['rating']) : 4.9;
  $gPlaceTotal     = isset($googlePlaceData['user_ratings_total']) ? intval($googlePlaceData['user_ratings_total']) : 18;
  $gPlaceReviews   = function_exists('get_all_approved_reviews') ? get_all_approved_reviews() : (isset($googlePlaceData['reviews']) ? $googlePlaceData['reviews'] : []);
  $gPlaceUrl       = isset($googlePlaceData['url']) ? $googlePlaceData['url'] : 'https://maps.google.com/?cid=11321227447965075053';
?>
<?php if (!isset($homepage_sections['reviews']) || !empty($homepage_sections['reviews'])): ?>
<section class="py-5 bg-white" id="reviews">
  <div class="container">
    <div class="text-center mb-5">
      <span class="section-label-tag"><i class="bi bi-google text-danger me-1"></i> Google &amp; Verified Reviews</span>
      <h2 class="section-h2 mt-2 mb-2 text-dark">What Our Customers Say</h2>
      <p class="text-muted mb-3">
        Genuine feedback &amp; ratings from our valued shifting customers.
      </p>
      <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
        <span class="badge bg-danger-subtle text-danger fs-6 px-3 py-2 fw-bold">
          <i class="bi bi-star-fill text-warning me-1"></i> <?= number_format($gPlaceRating, 1) ?> / 5.0 Rating
        </span>
        <span class="badge bg-secondary-subtle text-dark fs-6 px-3 py-2">
          <?= $gPlaceTotal ?>+ Verified Reviews
        </span>
      </div>
      <a href="<?= htmlspecialchars($gPlaceUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm px-4 mb-4" aria-label="View our Google reviews">
        <i class="bi bi-google me-2" aria-hidden="true"></i>View on Google Maps
      </a>
    </div>

    <div class="position-relative">
      <button class="btn btn-danger position-absolute top-50 start-0 translate-middle-y z-3 d-none d-md-flex rounded-circle shadow"
        type="button" id="scrollLeft" aria-label="Scroll reviews left">
        <i class="bi bi-chevron-left fs-5" aria-hidden="true"></i>
      </button>
      <button class="btn btn-danger position-absolute top-50 end-0 translate-middle-y z-3 d-none d-md-flex rounded-circle shadow"
        type="button" id="scrollRight" aria-label="Scroll reviews right">
        <i class="bi bi-chevron-right fs-5" aria-hidden="true"></i>
      </button>

      <div class="d-flex overflow-auto pb-4 no-scrollbar" id="reviewContainer">
        <?php if (!empty($gPlaceReviews)): ?>
          <?php foreach ($gPlaceReviews as $rev): ?>
            <?php 
              $authorName = isset($rev['author_name']) ? htmlspecialchars($rev['author_name']) : 'Verified Customer';
              $photoUrl   = isset($rev['profile_photo_url']) ? htmlspecialchars($rev['profile_photo_url']) : '';
              $stars      = isset($rev['rating']) ? intval($rev['rating']) : 5;
              $relTime    = isset($rev['relative_time_description']) ? htmlspecialchars($rev['relative_time_description']) : 'Recently';
              $text       = isset($rev['text']) ? htmlspecialchars($rev['text']) : '';
              $source     = isset($rev['source']) ? $rev['source'] : 'Website';

              $nameParts = array_filter(explode(' ', trim($authorName)));
              $initials  = '';
              if (count($nameParts) >= 2) {
                  $initials = strtoupper(substr(reset($nameParts), 0, 1) . substr(end($nameParts), 0, 1));
              } else {
                  $initials = strtoupper(substr($authorName, 0, 2));
              }
            ?>
            <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 flex-shrink-0 me-4">
              <div class="card h-100 shadow-sm border-0 rounded-3">
                <div class="card-body p-4 d-flex flex-column">
                  <div class="d-flex align-items-center mb-3">
                    <?php if ($photoUrl): ?>
                      <img src="<?= $photoUrl ?>" alt="<?= $authorName ?>" class="rounded-circle me-3" style="width:44px;height:44px;object-fit:cover;" referrerpolicy="no-referrer" loading="lazy" onerror="this.style.display='none'; if (this.nextElementSibling) this.nextElementSibling.style.display='flex';">
                      <div class="review-avatar me-3" style="display:none;" aria-hidden="true"><?= $initials ?></div>
                    <?php else: ?>
                      <div class="review-avatar me-3" aria-hidden="true"><?= $initials ?></div>
                    <?php endif; ?>
                    <div>
                      <span class="card-title fw-bold mb-0 d-block"><?= $authorName ?></span>
                      <p class="text-muted small mb-0"><i class="bi bi-patch-check-fill text-primary me-1"></i><?= (strtolower($source) === 'google' ? 'Google Review' : 'Verified Review') ?> (<?= $relTime ?>)</p>
                    </div>
                  </div>
                  <div class="text-warning mb-3">
                    <?php for ($s = 1; $s <= 5; $s++): ?>
                      <i class="bi bi-star<?= ($s <= $stars) ? '-fill' : '' ?>"></i>
                    <?php endfor; ?>
                    <span class="text-muted small ms-1"><?= number_format($stars, 1) ?></span>
                  </div>
                  <p class="card-text flex-grow-1 fst-italic text-muted">
                    "<?= $text ?>"
                  </p>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 11 — FAQ SECTION
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['faq']) || !empty($homepage_sections['faq'])): ?>
  <?php $this->load->view('home/faq-widget.php', ['city' => 'Noida', 'faqs' => $faqs ?? null]) ?>
<?php endif; ?>

<?php /* ===================================================
   SECTION 12 — CONTACT / CTA SECTION
   ===================================================== */ ?>
<?php if (!isset($homepage_sections['contact_cta']) || !empty($homepage_sections['contact_cta'])): ?>
<section class="contact-cta-section py-5" id="contact-cta" aria-labelledby="cta-heading">
  <div class="container">
    <div class="contact-cta-card">
      <div class="row align-items-center g-4">
        <div class="col-lg-7">
          <span class="section-label-tag-light">Ready to Move?</span>
          <h2 class="cta-heading mt-2 mb-3" id="cta-heading">
            Get a Free Moving Quote Today
          </h2>
          <p class="cta-sub mb-0">
            Serving Noida, Greater Noida &amp; Delhi-NCR — call us, WhatsApp us, or fill the quote form.
            Our team responds promptly to help plan your move.
          </p>
          <div class="cta-contact-details mt-3">
            <span class="cta-detail-item">
              <i class="bi bi-clock me-1" aria-hidden="true"></i>
              Mon–Sat: 9 AM – 7 PM
            </span>
            <span class="cta-detail-separator">|</span>
            <span class="cta-detail-item">
              <i class="bi bi-geo-alt me-1" aria-hidden="true"></i>
              <?= !empty($address) ? htmlspecialchars($address) : 'Noida, Uttar Pradesh' ?>
            </span>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="cta-buttons-group">
            <a href="<?= !empty($phonehtml) ? $phonehtml : 'tel:+917303257332' ?>"
               class="btn-cta-call"
               aria-label="Call Bhandari Packers and Movers">
              <i class="bi bi-telephone-fill me-2" aria-hidden="true"></i>
              Call Now: <?= !empty($phone) ? htmlspecialchars($phone) : '+91 7303257332' ?>
            </a>
            <a href="https://wa.me/917303257332?text=Hello%2C%20I%20need%20a%20moving%20quote%20from%20Noida"
               target="_blank"
               rel="noopener noreferrer"
               class="btn-cta-whatsapp"
               aria-label="WhatsApp Bhandari Packers and Movers">
              <i class="bi bi-whatsapp me-2" aria-hidden="true"></i>
              WhatsApp Us
            </a>
            <a href="<?= site_url('contacts') ?>"
               class="btn-cta-quote"
               aria-label="Get an instant moving quote">
              <i class="bi bi-file-earmark-text me-2" aria-hidden="true"></i>
              Contact With Us
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (!isset($homepage_sections['state_widget']) || !empty($homepage_sections['state_widget'])): ?>
  <?php $this->view('packers_movers/state_widget.php'); ?>
<?php endif; ?>


<?php /* ===================================================
   HOMEPAGE CSS — Consolidated, no duplicates
   ===================================================== */ ?>
<style>
/* ================================================================
   HOMEPAGE STYLES — Phase 4 Rebuild
   Primary color: #FC5D09 (orange), Navy: #0B2562
   ================================================================ */

/* ── Mobile margin fix for quote card ── */
.cards-slid {
  margin-top: -80px;
  position: relative;
  z-index: 15;
}
@media (max-width: 768px) {
  .hero-slider {
    height: 380px !important;
  }
  .cards-slid {
    margin-top: -340px !important;
    margin-bottom: 0px !important;
    z-index: 10;
  }
  .hero-slider .row > .col-12 {
    opacity: 0 !important;
    pointer-events: none;
  }
}

/* ── Section Label Tag (eyebrow text above headings) ── */
.section-label-tag {
  display: inline-block;
  background: rgba(252, 93, 9, 0.1);
  color: #FC5D09;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 20px;
}
.section-label-tag-light {
  display: inline-block;
  background: rgba(255,255,255,0.15);
  color: #fff;
  font-size: 12px;
  font-weight: 700;
  letter-spacing: 1.5px;
  text-transform: uppercase;
  padding: 4px 12px;
  border-radius: 20px;
}

/* ── Section H2 ── */
.section-h2 {
  font-size: clamp(22px, 4vw, 30px);
  font-weight: 700;
  line-height: 1.3;
}
.section-para-text {
  font-size: 15.5px;
  line-height: 1.75;
  color: #374151;
}
.section-para-text p {
  margin-bottom: 0.9rem;
}
.section-para-text p:last-child {
  margin-bottom: 0;
}
.about-stats-card {
  border: 1px solid #eef2f6 !important;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.about-stats-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.06) !important;
}

/* ── Trust Strip ── */
.trust-strip {
  background: #fff;
  border-bottom: 1px solid #f0f0f0;
  border-top: 1px solid #f0f0f0;
}
.trust-badge-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 6px;
  padding: 10px 8px;
}
.trust-badge-icon {
  font-size: 22px;
  color: #FC5D09;
}
.trust-badge-label {
  font-size: 12px;
  font-weight: 600;
  color: #374151;
  line-height: 1.4;
}

/* ── About Section Features ── */
.about-feature-item {
  display: flex;
  align-items: flex-start;
  gap: 10px;
}
.about-feature-icon {
  font-size: 20px;
  color: #FC5D09;
  flex-shrink: 0;
  margin-top: 2px;
}

/* ── Service Cards v2 ── */
.service-card-v2 {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0,0,0,0.07);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid #f0f4f8;
  position: relative;
  overflow: hidden;
}
.service-card-v2::before {
  content: "";
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 100%;
  background: #FC5D09;
  transition: top 0.35s ease;
  z-index: 0;
}
.service-card-v2:hover::before { top: 0; }
.service-card-v2 * { position: relative; z-index: 1; transition: color 0.3s; }
.service-card-v2:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(252,93,9,0.18); }
.service-card-v2:hover h3,
.service-card-v2:hover p,
.service-card-v2:hover .service-card-icon-wrap { color: #fff !important; }
.service-card-v2:hover .text-muted { color: rgba(255,255,255,0.85) !important; }

.service-card-icon-wrap {
  width: 64px;
  height: 64px;
  background: rgba(252,93,9,0.08);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
  color: #FC5D09;
  transition: background 0.3s, color 0.3s;
}
.service-card-v2:hover .service-card-icon-wrap {
  background: rgba(255,255,255,0.2);
  color: #fff;
}
.btn-service-link {
  display: inline-flex;
  align-items: center;
  color: #FC5D09;
  font-size: 13px;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.3s;
}
.service-card-v2:hover .btn-service-link { color: #fff; }

/* ── Service Area Cards ── */
.area-card {
  background: #fff;
  border-radius: 12px;
  border: 1px solid #e8edf3;
  overflow: hidden;
  height: 100%;
  transition: box-shadow 0.3s, transform 0.3s;
}
.area-card:hover {
  box-shadow: 0 8px 24px rgba(0,0,0,0.1);
  transform: translateY(-4px);
}
.featured-area {
  border-color: #FC5D09;
  border-width: 2px;
}
.area-card-header {
  background: #f8f9fa;
  padding: 12px 16px;
  font-weight: 700;
  font-size: 15px;
  color: #0B2562;
  display: flex;
  align-items: center;
  border-bottom: 1px solid #e8edf3;
}
.featured-area .area-card-header {
  background: rgba(252,93,9,0.06);
  border-bottom-color: rgba(252,93,9,0.15);
}
.area-card-header i { color: #FC5D09; }
.area-badge {
  font-size: 10px;
  background: #FC5D09;
  color: #fff;
  padding: 2px 8px;
  border-radius: 20px;
  font-weight: 700;
  letter-spacing: 0.5px;
}
.area-card-body { padding: 16px; }
.area-card-cta {
  background: linear-gradient(135deg, #fff5ed 0%, #fff 100%);
  border-color: rgba(252,93,9,0.2);
}

/* ── Reviews ── */
.review-avatar {
  width: 46px;
  height: 46px;
  background: rgba(252,93,9,0.12);
  color: #FC5D09;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 14px;
  flex-shrink: 0;
}
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
#reviewContainer { scroll-behavior: smooth; }

/* ── Contact CTA Section ── */
.contact-cta-section {
  background: linear-gradient(135deg, #0B2562 0%, #1a3a7a 100%);
  color: #fff;
}
.contact-cta-card {
  background: rgba(255,255,255,0.06);
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 16px;
  padding: 40px 36px;
}
@media (max-width: 576px) {
  .contact-cta-card { padding: 24px 18px; }
}
.cta-heading {
  font-size: clamp(22px, 4vw, 30px);
  font-weight: 700;
  color: #fff;
  line-height: 1.3;
}
.cta-sub { color: rgba(255,255,255,0.8); font-size: 15px; line-height: 1.7; }
.cta-contact-details {
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 8px;
  color: rgba(255,255,255,0.65);
  font-size: 13px;
}
.cta-detail-separator { opacity: 0.4; }
.cta-buttons-group {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.btn-cta-call,
.btn-cta-whatsapp,
.btn-cta-quote {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 13px 24px;
  border-radius: 10px;
  font-weight: 700;
  font-size: 15px;
  text-decoration: none;
  transition: transform 0.2s, box-shadow 0.2s, filter 0.2s;
  text-align: center;
}
.btn-cta-call {
  background: #FC5D09;
  color: #fff;
  box-shadow: 0 4px 14px rgba(252,93,9,0.35);
}
.btn-cta-call:hover {
  color: #fff;
  filter: brightness(1.08);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(252,93,9,0.45);
}
.btn-cta-whatsapp {
  background: #25D366;
  color: #fff;
  box-shadow: 0 4px 14px rgba(37,211,102,0.35);
}
.btn-cta-whatsapp:hover {
  color: #fff;
  filter: brightness(1.05);
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(37,211,102,0.45);
}
.btn-cta-quote {
  background: rgba(255,255,255,0.12);
  color: #fff;
  border: 1.5px solid rgba(255,255,255,0.3);
}
.btn-cta-quote:hover {
  background: rgba(255,255,255,0.2);
  color: #fff;
  transform: translateY(-2px);
}
</style>

<script>
/* ── Review Carousel Scroll ── */
(function () {
  var container = document.getElementById('reviewContainer');
  var btnL = document.getElementById('scrollLeft');
  var btnR = document.getElementById('scrollRight');
  if (btnL && container) {
    btnL.addEventListener('click', function () {
      container.scrollBy({ left: -360, behavior: 'smooth' });
    });
  }
  if (btnR && container) {
    btnR.addEventListener('click', function () {
      container.scrollBy({ left: 360, behavior: 'smooth' });
    });
  }
})();
</script>