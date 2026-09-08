<!-- Load Remixicon for dynamic icons -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

<!-- ── Breadcrumb ── -->
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <span class="text-uppercase small fw-bold tracking-wider opacity-75">What We Offer</span>
    <h1 class="mt-2 fw-extrabold text-center animate-up text-white">Our Premium Shifting Services</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none opacity-75 hover-white">Home</a>
        </li>
        <li class="breadcrumb-item active text-white fw-bold" aria-current="page">Services</li>
      </ol>
    </nav>
  </div>
</section>

<!-- ── Services Catalog Section ── -->
<section class="services-catalog py-5 bg-light">
  <div class="container">
    
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title fw-extrabold text-dark mb-2">Professional Shifting <span>Solutions</span></h2>
      <div class="title-underline mx-auto mt-2"></div>
      <p class="text-muted mt-3 max-width-600 mx-auto">
        Choose from our wide range of certified packing, moving, vehicle transport, and storage solutions tailored to meet your budget and shifting needs.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      <?php if (!empty($services)): ?>
        <?php foreach ($services as $service): ?>
          <div class="col-12 col-sm-6 col-lg-4" data-aos="fade-up">
            <div class="card h-100 border-0 shadow-sm service-catalog-card position-relative">
              <!-- Top Accent Border -->
              <div class="top-border-accent bg-danger"></div>
              
              <div class="card-body p-4 text-center d-flex flex-column justify-content-between">
                <div>
                  <div class="service-icon-circle mx-auto mb-4 bg-danger-subtle text-danger d-flex align-items-center justify-content-center shadow-sm">
                    <i class="<?= $service->icon_class ?> fs-32 text-danger"></i>
                  </div>
                  <h4 class="fw-bold text-dark mb-3 service-title-text"><?= htmlspecialchars($service->service_name) ?></h4>
                  <p class="text-muted small mb-4 line-height-relaxed">
                    <?= htmlspecialchars($service->short_description) ?>
                  </p>
                </div>
                <div>
                  <a href="<?= site_url('services/' . $service->slug) ?>" class="btn btn-danger btn-sm rounded-pill px-4 fw-bold shadow-sm explore-btn">
                    Explore Details <i class="ri-arrow-right-line ms-1 btn-icon-transition"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5 text-muted">
          <i class="ri-article-line fs-1 d-block mb-3 opacity-50"></i>
          No shifting services available at the moment.
        </div>
      <?php endif; ?>
    </div>

  </div>
</section>

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

.section-title span {
  color: #FC5D09;
  background: linear-gradient(135deg, #FC5D09, #ff4b2b);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.title-underline {
  width: 65px;
  height: 4px;
  background-color: #FC5D09;
  border-radius: 2px;
}
.max-width-600 {
  max-width: 600px;
}
.section-title::after {
  display: none !important;
}

/* Service Card Hover Styling */
.service-catalog-card {
  border-radius: 16px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
}
.top-border-accent {
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 4px;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.service-catalog-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(252, 93, 9, 0.08) !important;
}
.service-catalog-card:hover .top-border-accent {
  opacity: 1;
}

.service-icon-circle {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  transition: all 0.4s ease;
}
.fs-32 {
  font-size: 32px;
}
.service-catalog-card:hover .service-icon-circle {
  transform: scale(1.1);
  background-color: #FC5D09 !important;
}
.service-catalog-card:hover .service-icon-circle i {
  color: #fff !important;
}

.service-title-text {
  font-size: 20px;
  transition: color 0.3s ease;
}
.service-catalog-card:hover .service-title-text {
  color: #FC5D09 !important;
}

.line-height-relaxed {
  line-height: 1.6;
}

.bg-danger-subtle {
  background-color: rgba(252, 93, 9, 0.06) !important;
}

/* Explore Button Transitions */
.explore-btn {
  transition: all 0.3s ease;
  border: 1px solid #FC5D09;
}
.explore-btn:hover {
  background-color: #DD3802 !important;
  border-color: #DD3802 !important;
}
.btn-icon-transition {
  transition: transform 0.2s ease;
  display: inline-block;
}
.explore-btn:hover .btn-icon-transition {
  transform: translateX(4px);
}
</style>
