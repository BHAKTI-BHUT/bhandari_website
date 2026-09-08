<?php
// Resolve relative asset paths dynamically (removes all relative dots/slashes like ../ or / before assets/images/)
$description = $service->description;
$description = preg_replace('/(\.\.\/|\.\/|\/)*assets\/images\//', base_url('assets/images/'), $description);
?>

<!-- Load Remixicon for dynamic icons -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

<!-- ── Breadcrumb Section ── -->
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <span class="text-uppercase small fw-bold tracking-wider opacity-75">Service Details</span>
    <h1 class="mt-2 fw-extrabold text-center animate-up text-white"><?= htmlspecialchars($service->service_name) ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none opacity-75 hover-white">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?= site_url('services') ?>" class="text-white text-decoration-none opacity-75 hover-white">Services</a>
        </li>
        <li class="breadcrumb-item active text-white fw-bold" aria-current="page"><?= htmlspecialchars($service->service_name) ?></li>
      </ol>
    </nav>
  </div>
</section>

<!-- ── Dynamic Content Section (Full-Width to render internal columns) ── -->
<section class="py-5 bg-white service-detail-body">
  <div class="container">
    <!-- Render Raw HTML Content from Database with resolved image sources -->
    <div class="service-html-content" data-aos="fade-up">
      <?= $description ?>
    </div>
  </div>
</section>

<!-- ── Conditional Badges Section ── -->
<?php
$show_badges_section = $service->show_iba_badge || $service->show_reviews_badge || $service->show_satisfaction_badge || $service->show_trusted_badge;
?>
<?php if ($show_badges_section): ?>
  <section class="py-5 bg-light border-top border-bottom border-light">
    <div class="container">
      <div class="text-center mb-5" data-aos="fade-up">
        <h3 class="fw-bold text-dark mb-2">Why Move With Us?</h3>
        <p class="text-muted small">We prioritize security, efficiency, and customer satisfaction for every move.</p>
      </div>

      <div class="row text-center justify-content-center g-4">
        
        <!-- IBA Badge -->
        <?php if ($service->show_iba_badge): ?>
          <div class="col-lg-3 col-sm-6 col-12 flip_box" data-aos="zoom-in">
            <div class="badge-card bg-white p-4 shadow-sm h-100 rounded-3 border border-light">
              <img class="flip_img mb-3 img-fluid" src="<?= base_url('assets/images/gallery/first.webp') ?>" alt="IBA Approved Bills" loading="lazy" />
              <div class="reason">
                <span class="fw-bold text-dark d-block mb-2">IBA Recognized</span>
                <p class="text-muted small mb-0">Choose reliable, IBA-certified movers for hassle-free relocation services throughout India.</p>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Google Reviews Badge -->
        <?php if ($service->show_reviews_badge): ?>
          <div class="col-lg-3 col-sm-6 col-12 flip_box" data-aos="zoom-in">
            <div class="badge-card bg-white p-4 shadow-sm h-100 rounded-3 border border-light">
              <img class="flip_img mb-3 img-fluid" src="<?= base_url('assets/images/gallery/second.webp') ?>" alt="Google Reviews" loading="lazy" />
              <div class="reason">
                <span class="fw-bold text-dark d-block mb-2">Top Rated</span>
                <p class="text-muted small mb-0">Highly rated movers offering secure, prompt, and professional shifting services.</p>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Customer Satisfaction Badge -->
        <?php if ($service->show_satisfaction_badge): ?>
          <div class="col-lg-3 col-sm-6 col-12 flip_box" data-aos="zoom-in">
            <div class="badge-card bg-white p-4 shadow-sm h-100 rounded-3 border border-light">
              <img class="flip_img mb-3 img-fluid" src="<?= base_url('assets/images/gallery/third.webp') ?>" alt="Certified Quality" loading="lazy" />
              <div class="reason">
                <span class="fw-bold text-dark d-block mb-2">100% Satisfaction</span>
                <p class="text-muted small mb-0">We are committed to delivering trusted relocation services with 100% customer satisfaction.</p>
              </div>
            </div>
          </div>
        <?php endif; ?>

        <!-- Reliable Services Badge -->
        <?php if ($service->show_trusted_badge): ?>
          <div class="col-lg-3 col-sm-6 col-12 flip_box" data-aos="zoom-in">
            <div class="badge-card bg-white p-4 shadow-sm h-100 rounded-3 border border-light">
              <img class="flip_img mb-3 img-fluid" src="<?= base_url('assets/images/gallery/fourth.webp') ?>" alt="Reliable Services" loading="lazy" />
              <div class="reason">
                <span class="fw-bold text-dark d-block mb-2">Trusted Solutions</span>
                <p class="text-muted small mb-0">Dependable movers ensuring secure, on-time, and affordable relocation solutions.</p>
              </div>
            </div>
          </div>
        <?php endif; ?>

      </div>
    </div>
  </section>
<?php endif; ?>

<!-- ── Conditional Shifting Process Timeline ── -->
<?php if ($service->show_shifting_process): ?>
  <?php $this->load->view('template/shifting.php') ?>
<?php endif; ?>

<style>
/* Header banner styling */
.breadcrumb-section {
  background: linear-gradient(135deg, #FC5D09 0%, #DD3802 100%);
  position: relative;
  box-shadow: inset 0 -10px 20px rgba(0,0,0,0.05);
}
.tracking-wider {
  letter-spacing: 2px;
}
.fw-extrabold {
  font-weight: 800;
}
.hover-white:hover {
  color: #fff !important;
  opacity: 1 !important;
}

/* Service Detail HTML custom styling overrides */
.service-html-content p {
  line-height: 1.8;
  margin-bottom: 1.5rem;
  font-size: 15px;
  color: #4b5563;
}
.service-html-content img {
  max-width: 100% !important;
  height: auto !important;
  border-radius: 12px;
  margin: 1.5rem 0;
  box-shadow: 0 4px 15px rgba(0,0,0,0.04);
}
.service-html-content hr {
  margin: 2rem 0;
  opacity: 0.15;
}
.service-html-content .color {
  color: #FC5D09;
}

/* Flip boxes style */
.badge-card {
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  border-radius: 16px;
}
.badge-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 30px rgba(0,0,0,0.06) !important;
  border-color: rgba(252, 93, 9, 0.15) !important;
}
.flip_img {
  width: 140px; 
  height: auto; 
  object-fit: cover; 
  transition: transform 0.6s ease-in-out;
}
.badge-card:hover .flip_img {
  transform: rotateY(360deg);
}
.reason span {
  font-size: 15px;
  font-weight: 700;
}
.reason p {
  font-size: 12.5px;
  line-height: 1.6;
}
</style>
