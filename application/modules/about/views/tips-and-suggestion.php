<!-- Load Remixicon for dynamic icons -->
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet" />

<!-- ── Breadcrumb ── -->
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center animate-up">Moving Tips & Suggestions</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">Tips & Suggestions</li>
      </ol>
    </nav>
  </div>
</section>

<!-- ── Main Section ── -->
<section class="tips-showcase py-5">
  <div class="container">

    <!-- ── Intro Header ── -->
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title fw-bold">Expert Shifting <span>Guidelines</span></h2>
      <p class="text-muted max-width-600 mx-auto">Follow our verified packing checklists, moving day recommendations, and transit tips to ensure a safe, efficient, and hassle-free relocation experience.</p>
    </div>

    <!-- ── Interactive Filter Navigation ── -->
    <div class="row mb-5" data-aos="fade-up">
      <div class="col-12 d-flex justify-content-center flex-wrap gap-2">
        <button class="btn btn-filter-tab active" onclick="applyTipsFilter('all', this)">All Tips</button>
        <button class="btn btn-filter-tab" onclick="applyTipsFilter('packing', this)"><i class="ri-archive-line me-1"></i> Packing</button>
        <button class="btn btn-filter-tab" onclick="applyTipsFilter('long_distance', this)"><i class="ri-road-map-line me-1"></i> Long Distance</button>
        <button class="btn btn-filter-tab" onclick="applyTipsFilter('moving_day', this)"><i class="ri-calendar-event-line me-1"></i> Shifting Day</button>
        <button class="btn btn-filter-tab" onclick="applyTipsFilter('home_setup', this)"><i class="ri-home-gear-line me-1"></i> Home Setup</button>
        <button class="btn btn-filter-tab" onclick="applyTipsFilter('after_move', this)"><i class="ri-star-line me-1"></i> After Shifting</button>
      </div>
    </div>

    <?php if (!empty($moving_tips)): ?>
      
      <!-- ── Unified Modern Horizontal Layout ── -->
      <div class="row g-4" id="tips-grid-container">
        <?php foreach ($moving_tips as $tip): 
          $category = htmlspecialchars($tip['category']);
          $icon = htmlspecialchars($tip['icon_class'] ?: 'ri-lightbulb-line');
          $type = htmlspecialchars($tip['type']);
          $title = htmlspecialchars($tip['title']);
        ?>
          <div class="col-12 tip-card-wrapper" data-category="<?= $category ?>" data-aos="fade-up">
            <div class="card border-0 shadow-sm horizontal-tip-card p-4">
              <div class="row align-items-center g-4">
                
                <!-- Left Side: Icon & Title Info -->
                <div class="col-lg-4 d-flex align-items-center gap-3">
                  <div class="tip-badge-icon d-flex align-items-center justify-content-center bg-danger-subtle text-danger rounded-circle flex-shrink-0">
                    <i class="<?= $icon ?> fs-24"></i>
                  </div>
                  <div>
                    <span class="category-pill text-uppercase fs-xs fw-bold"><?= str_replace('_', ' ', $category) ?></span>
                    <h4 class="fw-bold mb-0 text-dark fs-5 mt-1"><?= $title ?></h4>
                  </div>
                </div>

                <!-- Right Side: Content (Paragraph or Checklist) -->
                <div class="col-lg-8 content-col">
                  <?php if ($type === 'article'): ?>
                    <!-- Article Type: Plain Paragraph -->
                    <div class="article-content-box p-3 rounded-3">
                      <p class="text-muted small mb-0" style="line-height: 1.6; text-align: justify;">
                        <?= nl2br(htmlspecialchars($tip['content'])) ?>
                      </p>
                    </div>
                  <?php else: ?>
                    <!-- Accordion Checklist Type: Render directly as checkmarks -->
                    <ul class="list-unstyled mb-0 d-flex flex-wrap gap-2">
                      <?php 
                        $points = array_filter(array_map('trim', explode("\n", $tip['content'])));
                        foreach ($points as $point): 
                          if (empty($point)) continue;
                          $cleanPoint = ltrim($point, "•-* \t\n\r\0\x0B");
                      ?>
                        <div class="col-12 col-sm-6 p-1">
                          <li class="d-flex align-items-start gap-2 fs-7 text-dark-muted">
                            <i class="ri-checkbox-circle-fill text-danger mt-1 flex-shrink-0" style="font-size: 16px;"></i>
                            <span class="fw-medium"><?= htmlspecialchars($cleanPoint) ?></span>
                          </li>
                        </div>
                      <?php endforeach; ?>
                    </ul>
                  <?php endif; ?>
                </div>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    <?php else: ?>
      <div class="text-center py-5 text-muted">
        <i class="ri-lightbulb-line fs-1 mb-2"></i>
        <p>No moving tips available right now. Check back soon!</p>
      </div>
    <?php endif; ?>

  </div>
</section>

<style>
/* ───────────────────────────────────────────────────────────────
   UNIFIED HORIZONTAL MOVING TIPS PAGE STYLING
─────────────────────────────────────────────────────────────── */
.tips-showcase {
  background: #f3f4f6;
  min-height: 50vh;
}

.section-title span {
  color: #FC5D09;
  background: linear-gradient(135deg, #FC5D09, #ff4b2b);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.section-title::after {
  display: none !important;
}

.max-width-600 {
  max-width: 600px;
}

/* ── Custom Filter Navigation ── */
.btn-filter-tab {
  background: #fff;
  border: 1px solid #e5e7eb;
  color: #4b5563;
  font-weight: 600;
  padding: 10px 22px;
  border-radius: 30px;
  font-size: 14px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
}
.btn-filter-tab:hover {
  background: #f9fafb;
  color: #111827;
  border-color: #d1d5db;
}
.btn-filter-tab.active {
  background: #FC5D09;
  border-color: #FC5D09;
  color: #fff;
  box-shadow: 0 4px 14px rgba(252, 93, 9, 0.3);
}

/* ── Horizontal Cards Styling ── */
.horizontal-tip-card {
  border-radius: 16px;
  background: #fff;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  border: 1px solid rgba(229, 231, 235, 0.8) !important;
}

.horizontal-tip-card:hover {
  transform: translateY(-3px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06) !important;
}

.tip-badge-icon {
  width: 52px;
  height: 52px;
  flex-shrink: 0;
  transition: transform 0.3s ease;
}
.horizontal-tip-card:hover .tip-badge-icon {
  transform: scale(1.08) rotate(3deg);
}

.category-pill {
  color: #FC5D09;
  letter-spacing: 0.8px;
  font-size: 10px;
  display: inline-block;
  background: #fff5ed;
  padding: 2px 8px;
  border-radius: 4px;
}

.article-content-box {
  background-color: #f9fafb;
  border-left: 3px solid #FC5D09;
}

.text-dark-muted {
  color: #374151;
  line-height: 1.5;
}

.fs-7 {
  font-size: 13.5px;
}

.fs-xs {
  font-size: 10px;
}

/* Divider between left and right column on desktop */
@media (min-width: 992px) {
  .content-col {
    border-left: 1px solid #e5e7eb;
    padding-left: 30px !important;
  }
}

/* ── Filtering transitions ── */
.tip-card-wrapper {
  transition: opacity 0.3s ease, transform 0.3s ease;
}
.tip-card-wrapper.filtered-out {
  display: none !important;
}

/* ── Responsive adjustments ── */
@media (max-width: 576px) {
  .btn-filter-tab {
    padding: 7px 15px;
    font-size: 12px;
  }
}
</style>

<script>
function applyTipsFilter(category, btn) {
    // Set active class on navigation button
    document.querySelectorAll('.btn-filter-tab').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    // Filter items inside grid
    document.querySelectorAll('.tip-card-wrapper').forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        if (category === 'all' || itemCategory === category) {
            item.classList.remove('filtered-out');
        } else {
            item.classList.add('filtered-out');
        }
    });
}
</script>
