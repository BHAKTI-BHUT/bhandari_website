<?php
/**
 * Dynamic City Page Template — Phase 5 Rebuild
 */
$this->load->database();
$this->load->helper('text');

$city_clean = !empty($city) ? htmlspecialchars($city) : 'City';
$st = strtolower(str_replace(" ", "-", $state));
$ctlink = strtolower(str_replace(" ", "-", $city_clean));

// Fallback image logic
$city_slug = $this->uri->segment(1);
$branch_img = 'branch_' . str_replace('-packers-movers', '', $city_slug) . '.webp';
$img_path = 'assets/images/gallery/' . $branch_img;
// If no specific city image exists, default to home relocation image
$img = file_exists(FCPATH . $img_path) ? base_url($img_path) : base_url('assets/images/gallery/homerelocation.jpg'); 

// Generate dynamic fallback content if custom_content from DB is empty
if (empty($custom_content)) {
    $htmlcontent = "
    <h2 class='section-h2 mt-2 mb-3'>Top Packers and Movers in <span class='text-danger'>{$city_clean}</span></h2>
    <p class='section-para-text'>
        Are you planning to relocate to or from <strong>{$city_clean}</strong>? Moving can be a stressful experience without the right professional help. 
        <strong>Bhandari Packers and Movers</strong> offers seamless, secure, and affordable relocation services tailored to your needs in {$city_clean}.
    </p>
    <p class='section-para-text'>
        As a trusted and experienced moving company, we specialize in local home shifting within {$city_clean}, intercity relocation, office shifting, and safe vehicle transportation. Our trained professionals use premium packing materials to ensure your belongings remain 100% safe during transit.
    </p>
    <ul class='list-unstyled mt-3'>
        <li class='mb-2'><i class='bi bi-check-circle-fill text-danger me-2'></i> <strong>Door-to-Door Service:</strong> Hassle-free pickup and delivery anywhere in {$city_clean}.</li>
        <li class='mb-2'><i class='bi bi-check-circle-fill text-danger me-2'></i> <strong>Expert Packing:</strong> We use high-quality bubble wrap and corrugated boxes.</li>
        <li class='mb-2'><i class='bi bi-check-circle-fill text-danger me-2'></i> <strong>Transparent Pricing:</strong> No hidden costs for your move in {$city_clean}.</li>
    </ul>
    <p class='mt-3'>Get in touch with us today for the best packing and moving experience in {$city_clean}!</p>
    ";
} else {
    $htmlcontent = $custom_content;
}

?>

<?php /* ===================================================
   SECTION 1 — HERO & QUOTE FORM (HOMEPAGE STYLE)
   ===================================================== */ ?>
<style>
  @media (max-width: 768px) {
    .city-page-hero {
      padding-top: 20px !important;
      padding-bottom: 50px !important;
    }
    .city-page-hero h1 {
      font-size: 1.6rem !important;
    }
    /* Override the 155px padding forced by serviceform.php on mobile */
    .city-form-wrapper .service-form-section {
      padding-top: 10px !important;
    }
    .city-form-wrapper {
      margin-top: -60px !important;
    }
  }
</style>

<section class="city-page-hero position-relative" style="background-image: url('<?= $img ?>'); background-size: cover; background-position: center; padding-top: 40px; padding-bottom: 70px;">
  <div style="background: linear-gradient(rgba(11, 37, 98, 0.8), rgba(0,0,0,0.6)); position: absolute; top:0; left:0; width:100%; height:100%;"></div>
  <div class="container position-relative" style="z-index: 2;">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-2">
      <ol class="breadcrumb mb-0 justify-content-center small">
        <li class="breadcrumb-item">
          <a href="<?= site_url('') ?>" class="text-light text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white fw-bold" aria-current="page">
          <?= $city_clean ?>
        </li>
      </ol>
    </nav>
    <h1 class="fw-bold fs-2 text-white text-center mb-2">Best Packers and Movers in <span style="color: #FC5D09;"><?= $city_clean ?></span></h1>
    <p class="text-white fs-6 text-center mb-0 d-none d-md-block" style="opacity: 0.95;">Trusted, reliable, and affordable packing and moving services in <?= $city_clean ?>.</p>
  </div>
</section>

<!-- FORM IN HERO (FULL WIDTH LIKE HOMEPAGE) -->
<div class="container-fluid cards-slid city-form-wrapper" style="margin-top: -60px; position: relative; z-index: 10;">
  <?php $this->view('contacts/serviceform.php'); ?>
</div>

<!-- Spacer for the negative margin to prevent overlap with the next section -->
<div style="height: 30px;"></div>

<section class="trust-strip py-2 mb-4 border-bottom" aria-label="Trust and Credentials">
  <div class="container">
    <div class="row g-2 justify-content-center align-items-center text-center">
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-patch-check-fill trust-badge-icon text-danger fs-4" aria-hidden="true"></i>
          <span class="trust-badge-label d-block mt-1 fw-bold small" style="font-size: 0.75rem;">ISO 9001:2015<br>Certified</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-shield-check trust-badge-icon text-danger fs-4" aria-hidden="true"></i>
          <span class="trust-badge-label d-block mt-1 fw-bold small" style="font-size: 0.75rem;">100% Safe<br>Moving</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-clock-history trust-badge-icon text-danger fs-4" aria-hidden="true"></i>
          <span class="trust-badge-label d-block mt-1 fw-bold small" style="font-size: 0.75rem;">On-Time<br>Delivery</span>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="trust-badge-item">
          <i class="bi bi-geo-alt-fill trust-badge-icon text-danger fs-4" aria-hidden="true"></i>
          <span class="trust-badge-label d-block mt-1 fw-bold small" style="font-size: 0.75rem;">Serving<br><?= $city_clean ?></span>
        </div>
      </div>
    </div>
  </div>
</section>

<?php /* ===================================================
   SECTION 3 — ABOUT / CONTENT
   ===================================================== */ ?>
<section class="container py-5" id="about">
  <div class="row align-items-center g-5">
    <div class="city-content <?= (!isset($show_hero_image) || $show_hero_image) ? 'col-lg-6' : 'col-lg-12' ?>">
      <span class="section-label-tag" style="color: #FC5D09; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px; background: rgba(252,93,9,0.1); padding: 4px 12px; border-radius: 20px;">Relocate with Ease</span>
      <div class="mt-3">
        <?= $htmlcontent ?>
      </div>
      <div class="mt-4">
        <a href="#contact-cta" class="btn btn-danger px-4 me-2">Get a Quote</a>
        <a href="<?= site_url('about') ?>" class="btn btn-outline-danger px-4">About Us</a>
      </div>
    </div>
    <?php if (!isset($show_hero_image) || $show_hero_image): ?>
    <div class="col-lg-6">
      <img src="<?= !empty($hero_image) ? $hero_image : $img ?>"
        alt="Best Packers and Movers in <?= $city_clean ?>"
        class="img-fluid rounded shadow-lg" loading="lazy" style="width: 100%; height: auto; object-fit: cover; aspect-ratio: 4/3;">
    </div>
    <?php endif; ?>
  </div>
</section>

<?php /* ===================================================
   SECTION 4 — SERVICES
   ===================================================== */ ?>
<?php if (!isset($show_services) || $show_services): ?>
<section class="section-services py-5 bg-light" id="services">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-md-10 col-lg-8">
        <span class="section-label-tag" style="color: #FC5D09; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 1.5px; background: rgba(252,93,9,0.1); padding: 4px 12px; border-radius: 20px;">Our Services</span>
        <h2 class="section-h2 mt-2 mb-3 text-dark fw-bold">
          Moving Services in <?= $city_clean ?>
        </h2>
        <p class="text-muted">
          We provide comprehensive packing and moving solutions for residential and commercial needs in <?= $city_clean ?>.
        </p>
      </div>
    </div>

    <div class="row g-4">
      <?php
      $city_services = [];
      try {
          $admin_db = $this->load->database('admin_hub', TRUE);
          if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('our_services')) {
              $city_services = $admin_db->where('status', 1)->order_by('sort_order', 'asc')->get('our_services')->result();
          }
      } catch (\Exception $e) {
          log_message('error', 'City view_service services load error: ' . $e->getMessage());
      }
      ?>

      <?php if (!empty($city_services)): ?>
        <?php foreach ($city_services as $srv): ?>
          <div class="col-md-6 col-lg-3">
            <a href="<?= site_url('services/' . $srv->slug) ?>" class="text-decoration-none text-dark">
              <div class="card h-100 border-0 shadow-sm text-center p-4 service-card-hover">
                <i class="<?= !empty($srv->icon_class) ? htmlspecialchars($srv->icon_class) : 'bi bi-house-door' ?> text-danger fs-1 mb-3"></i>
                <h3 class="fs-5 fw-bold mb-2"><?= htmlspecialchars($srv->service_name) ?></h3>
                <p class="text-muted small mb-0"><?= htmlspecialchars(mb_strimwidth($srv->short_description, 0, 90, "...")) ?></p>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm text-center p-4 service-card-hover">
            <i class="bi bi-house-door text-danger fs-1 mb-3"></i>
            <h3 class="fs-5 fw-bold mb-2">Home Shifting</h3>
            <p class="text-muted small mb-0">Safe and careful household relocation in <?= $city_clean ?>.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm text-center p-4 service-card-hover">
            <i class="bi bi-building text-danger fs-1 mb-3"></i>
            <h3 class="fs-5 fw-bold mb-2">Office Relocation</h3>
            <p class="text-muted small mb-0">Fast, secure corporate moving with zero downtime.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm text-center p-4 service-card-hover">
            <i class="bi bi-car-front text-danger fs-1 mb-3"></i>
            <h3 class="fs-5 fw-bold mb-2">Vehicle Transport</h3>
            <p class="text-muted small mb-0">Reliable car and bike transportation from <?= $city_clean ?>.</p>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="card h-100 border-0 shadow-sm text-center p-4 service-card-hover">
            <i class="bi bi-box-seam text-danger fs-1 mb-3"></i>
            <h3 class="fs-5 fw-bold mb-2">Packing & Unpacking</h3>
            <p class="text-muted small mb-0">Premium packing materials used for ultimate safety.</p>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 5 — PROCESS & ACHIEVEMENTS
   ===================================================== */ ?>
<?php if (!isset($show_shifting_process) || $show_shifting_process): ?>
  <?php $this->load->view('template/shifting.php') ?>
<?php endif; ?>

<?php if (!isset($show_achievements) || $show_achievements): ?>
  <?php $this->load->view('template/achievements.php') ?>
<?php endif; ?>

<?php /* ===================================================
   SECTION 6 — VIDEOS
   ===================================================== */ ?>
<?php if (!isset($show_videos) || $show_videos): ?>
<section class="py-5 bg-light" id="customer-videos">
  <div class="container">
    <div class="row justify-content-center text-center mb-4">
      <div class="col-12">
        <h2 class="fw-bold mb-3">Customer Success Stories in <?= $city_clean ?></h2>
        <p class="text-muted">Watch how we make moving stress-free for our clients.</p>
      </div>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-12 col-md-6">
        <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
          <iframe src="https://www.youtube.com/embed/UJ0z6WMLlyg" title="Customer Video 1" allowfullscreen loading="lazy" style="border:0;"></iframe>
        </div>
      </div>
      <div class="col-12 col-md-6">
        <div class="ratio ratio-16x9 rounded shadow overflow-hidden">
          <iframe src="https://www.youtube.com/embed/KjkKMzTz_Yg" title="Customer Video 2" allowfullscreen loading="lazy" style="border:0;"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 7 — REVIEWS
   ===================================================== */ ?>
<?php if (!isset($show_reviews) || $show_reviews): ?>
<section class="py-5" id="review">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2">What Our Customers Say</h2>
      <p class="text-muted">Genuine reviews from our recent shifting projects.</p>
    </div>
    <div class="row">
      <?php
      $reviews = null;
      try {
        $reviews = $this->db->order_by('r_id', 'desc')->where(['status' => 1, 'stars' => 5])->get('reviews', 6);
        if (!$reviews || $reviews->num_rows() == 0) {
          $reviews = $this->db->order_by('r_id', 'desc')->where('status', 1)->get('reviews', 6);
        }
      } catch (\Throwable $e) {
        log_message('error', 'City reviews fetch error: ' . $e->getMessage());
      }
      
      if ($reviews && $reviews->num_rows() > 0) {
        foreach ($reviews->result() as $r) {
          $pdate = !empty($r->posted_date) ? explode(" ", $r->posted_date)[0] : date('Y-m-d');
      ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 bg-light" itemprop="review" itemscope itemtype="https://schema.org/Review">
              <div class="card-body d-flex flex-column p-4">
                
                <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
                  <meta itemprop="name" content="Packers and Movers in <?= $city_clean ?>" />
                </div>

                <div class="d-flex align-items-center mb-3">
                  <div class="review-avatar me-3" style="width:40px; height:40px; background:#FC5D09; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                    <?= strtoupper(substr($r->name ?? 'C', 0, 1)) ?>
                  </div>
                  <div>
                    <strong itemprop="author" itemscope itemtype="https://schema.org/Person" class="d-block text-dark">
                      <span itemprop="name"><?= htmlspecialchars(ucfirst($r->name ?? 'Customer')) ?></span>
                    </strong>
                    <div class="text-warning small" itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                      <meta itemprop="ratingValue" content="<?= $r->stars ?? 5 ?>">
                      <?php for($i=0; $i<($r->stars ?? 5); $i++) { echo '<i class="bi bi-star-fill"></i>'; } ?>
                    </div>
                  </div>
                </div>
                
                <h6 class="fw-bold mb-2"><q itemprop="name"><?= htmlspecialchars(ucfirst($r->r_title ?? 'Excellent Service')) ?></q></h6>
                
                <p class="flex-grow-1 text-muted small fst-italic mb-3" itemprop="reviewBody">
                  "<?= htmlspecialchars(mb_strimwidth($r->r_desc ?? 'Great packing and moving experience.', 0, 150, "...")); ?>"
                </p>

                <div class="text-muted small mt-auto pt-3 border-top d-flex justify-content-between">
                  <span itemprop="datePublished" content="<?= $pdate ?>"><i class="bi bi-calendar3 me-1"></i> <?= $pdate ?></span>
                </div>

              </div>
            </div>
          </div>
      <?php 
        }
      } else {
        $default_city_reviews = [
          ['name' => 'Rajesh Sharma', 'title' => "Household Shifting in $city_clean", 'desc' => "Bhandari Packers and Movers handled our complete household shifting in $city_clean with extreme care. All fragile items arrived intact.", 'stars' => 5],
          ['name' => 'Priya Verma', 'title' => 'Punctual & Professional Team', 'desc' => "The packing team in $city_clean arrived right on time and completed loading smoothly. Very satisfied with the service!", 'stars' => 5],
          ['name' => 'Amit Patel', 'title' => 'Great Vehicle Transportation', 'desc' => "Safely transported my vehicle from $city_clean without a single scratch. Smooth communication throughout.", 'stars' => 5]
        ];
        foreach ($default_city_reviews as $r) {
      ?>
          <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0 bg-light">
              <div class="card-body d-flex flex-column p-4">
                <div class="d-flex align-items-center mb-3">
                  <div class="review-avatar me-3" style="width:40px; height:40px; background:#FC5D09; color:#fff; border-radius:50%; display:flex; align-items:center; justify-content:center; font-weight:bold;">
                    <?= strtoupper(substr($r['name'], 0, 1)) ?>
                  </div>
                  <div>
                    <strong class="d-block text-dark"><?= htmlspecialchars($r['name']) ?></strong>
                    <div class="text-warning small">
                      <?php for($i=0; $i<$r['stars']; $i++) { echo '<i class="bi bi-star-fill"></i>'; } ?>
                    </div>
                  </div>
                </div>
                <h6 class="fw-bold mb-2"><q><?= htmlspecialchars($r['title']) ?></q></h6>
                <p class="flex-grow-1 text-muted small fst-italic mb-3">
                  "<?= htmlspecialchars($r['desc']) ?>"
                </p>
                <div class="text-muted small mt-auto pt-3 border-top d-flex justify-content-between">
                  <span><i class="bi bi-patch-check-fill text-primary me-1"></i> Verified Customer</span>
                </div>
              </div>
            </div>
          </div>
      <?php
        }
      } 
      ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php /* ===================================================
   SECTION 8 — FAQ WIDGET
   ===================================================== */ ?>
<?php if (!isset($show_faqs) || $show_faqs): ?>
  <?php $this->load->view('home/faq-widget.php', ['city' => $city_clean, 'faqs' => $faqs ?? null]) ?>
<?php endif; ?>

<?php /* ===================================================
   SECTION 9 — CONTACT CTA
   ===================================================== */ ?>
<section class="contact-cta-section py-5 mt-4" id="contact-cta" style="background: linear-gradient(135deg, #0B2562 0%, #1a3a7a 100%);">
  <div class="container">
    <div class="row align-items-center justify-content-between p-4" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.12); border-radius: 16px;">
      <div class="col-lg-7 text-white mb-4 mb-lg-0">
        <h2 class="fw-bold mb-3">Ready to Relocate from <?= $city_clean ?>?</h2>
        <p class="mb-0 text-white-50">Call us today or get an instant quote online. Our team in <?= $city_clean ?> is ready to assist you.</p>
      </div>
      <div class="col-lg-5 text-lg-end">
        <a href="<?= !empty($phonehtml) ? $phonehtml : 'tel:+917303257332' ?>" class="btn btn-danger px-4 py-3 fw-bold mb-2 w-100 w-sm-auto me-sm-2">
          <i class="bi bi-telephone-fill me-2"></i> Call <?= !empty($phone) ? htmlspecialchars($phone) : '+91 7303257332' ?>
        </a>
        <a href="<?= site_url('contacts') ?>" class="btn btn-outline-light px-4 py-3 fw-bold mb-2 w-100 w-sm-auto">
          Get Instant Quote
        </a>
      </div>
    </div>
  </div>
</section>

<style>
  .service-card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .service-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
  }
</style>