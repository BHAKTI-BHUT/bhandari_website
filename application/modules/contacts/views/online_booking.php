<style>
/* SweetAlert top z-index override to ensure modals appear above fixed footer */
.swal2-container.swal2-top-zindex {
    z-index: 20000 !important;
}
.sleek-booking-confirmed-modal {
    border-radius: 18px !important;
    padding: 24px 28px !important;
    max-width: 92vw !important;
    max-height: 86vh !important;
    overflow-y: auto !important;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25) !important;
}
@media (max-width: 576px) {
    .sleek-booking-confirmed-modal {
        padding: 18px 16px !important;
    }
}

/* CSS Wizard design enhancements */
.wizard-tabs-list .nav-link {
    background: #f8f9fa;
    color: #495057;
    border-radius: 0 !important;
    font-weight: 700;
    border: 1px solid #e9ecef;
    padding: 12px;
    cursor: pointer;
    transition: background 0.2s, color 0.2s, border-color 0.2s;
}
.wizard-tabs-list .nav-link:hover:not(.active) {
    background: #fde8e8;
    border-color: #FC5D09;
    color: #FC5D09;
}
.wizard-tabs-list .nav-link.active {
    background: #FC5D09 !important;
    color: #fff !important;
    border-color: #FC5D09 !important;
}
.qty-wiz-btn {
    font-weight: 700;
}
.addon-selection-box:hover {
    border-color: #FC5D09 !important;
}
.item-row-box:hover {
    border-color: #FC5D09 !important;
    box-shadow: 0 2px 8px rgba(252, 93, 9, 0.12);
}

/* Flipkart-style Category Navigation & Search UI */
.category-nav-pills .cat-pill-btn,
.category-nav-pills .addon-cat-pill-btn {
    background: #f1f3f6;
    color: #212529;
    border: 1px solid #dcdcdc;
    font-size: 0.85rem;
    transition: all 0.2s ease-in-out;
}
.category-nav-pills .cat-pill-btn:hover,
.category-nav-pills .addon-cat-pill-btn:hover {
    background: #fde8e8;
    color: #FC5D09;
    border-color: #FC5D09;
}
.category-nav-pills .cat-pill-btn.active,
.category-nav-pills .addon-cat-pill-btn.active {
    background: #FC5D09 !important;
    color: #ffffff !important;
    border-color: #FC5D09 !important;
    box-shadow: 0 4px 10px rgba(252, 93, 9, 0.22);
}
.category-nav-pills .cat-pill-btn.active .badge.bg-light,
.category-nav-pills .addon-cat-pill-btn.active .badge.bg-light {
    background: rgba(255, 255, 255, 0.25) !important;
    color: #ffffff !important;
}
.item-chip {
    font-size: 0.78rem;
    padding: 4px 10px;
    border-radius: 16px;
    background: #ffffff;
    border: 1px solid #FC5D09;
    color: #FC5D09;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}
.item-chip .chip-remove {
    cursor: pointer;
    font-size: 0.85rem;
    opacity: 0.8;
}
.item-chip .chip-remove:hover {
    opacity: 1;
}

/* Step 4 Please Note Cards Design */
.note-card {
    border-radius: 12px;
    padding: 16px 18px;
    transition: all 0.2s ease-in-out;
    background: #ffffff;
}
.note-card-token {
    border: 1.5px solid #fecdd3;
}
.note-card-token:hover {
    border-color: #FC5D09;
    box-shadow: 0 4px 14px rgba(252, 93, 9, 0.08);
}
.note-card-timing {
    border: 1.5px solid #dbeafe;
}
.note-card-timing:hover {
    border-color: #2563eb;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.08);
}
.note-card-relax {
    border: 1.5px solid #dcfce7;
}
.note-card-relax:hover {
    border-color: #16a34a;
    box-shadow: 0 4px 14px rgba(22, 163, 74, 0.08);
}

.note-icon-circle {
    width: 50px;
    height: 50px;
    min-width: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
}
.note-icon-token {
    background: #ffe4e6;
    color: #FC5D09;
}
.note-icon-timing {
    background: #eff6ff;
    color: #2563eb;
}
.note-icon-relax {
    background: #f0fdf4;
    color: #16a34a;
}

/* Tabular Segmented control styling for mobile tabs */
.wizard-steps-progress {
    position: relative;
    margin: 10px 0;
}
.wizard-steps-progress .progress-line {
    top: 18px !important;
}
.step-progress-item .step-icon-circle {
    font-size: 0.95rem;
    border-width: 2px !important;
    font-weight: 700;
}
.step-progress-item.active .step-icon-circle {
    border-color: #FC5D09 !important;
    background: #FC5D09 !important;
    color: #fff !important;
    box-shadow: 0 4px 12px rgba(252, 93, 9, 0.25);
}
.step-progress-item.completed .step-icon-circle {
    border-color: #2e7d32 !important;
    background: #2e7d32 !important;
    color: #fff !important;
}
.step-progress-item.completed .step-label-text {
    color: #2e7d32 !important;
    font-weight: 700;
}
.step-progress-item.active .step-label-text {
    color: #FC5D09 !important;
    font-weight: 700;
}
.step-progress-item .step-label-text {
    font-size: 0.8rem;
    font-weight: 600;
}

/* Sticky Bottom Calculator for Mobile */
.sticky-action-footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(15px);
    border-top: 1.5px solid #edf2f7;
    box-shadow: 0 -8px 30px rgba(0, 0, 0, 0.08);
    z-index: 10000 !important;
    padding: 10px 0;
    transition: all 0.3s ease;
}
.sticky-action-footer .footer-label {
    font-size: 0.65rem;
    color: #718096;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 2px;
}
.sticky-action-footer .footer-price {
    font-size: 1.25rem;
    font-weight: 850;
    color: #FC5D09;
    line-height: 1;
}
.sticky-action-footer .footer-label-secondary {
    font-size: 0.8rem;
    font-weight: 700;
    color: #2d3748;
    line-height: 1.2;
}
.sticky-action-footer .footer-val-secondary {
    font-size: 0.68rem;
    color: #718096;
    font-weight: 600;
}
.sticky-action-footer .btn {
    min-height: auto !important;
    height: 36px !important;
    padding: 6px 14px !important;
    font-size: 0.82rem !important;
    border-radius: 6px !important;
}

@media (max-width: 767px) {
    .sticky-action-footer.is-step-4 #footerPriceSummary {
        display: none !important;
    }
}

/* Price Breakdown Slide-up Panel Styles */
.price-breakdown-panel {
    position: absolute;
    bottom: 100%;
    left: 24px;
    width: 320px;
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.12);
    z-index: 9999;
    font-size: 0.8rem;
    color: #4a5568;
    overflow: hidden;
}
@media (max-width: 768px) {
    .price-breakdown-panel {
        left: 16px;
        right: 16px;
        width: auto;
    }
}

body {
    padding-bottom: 100px !important; /* Add space at the bottom to prevent content blocking */
}
/* Hide floating contact buttons on the wizard page to prevent overlap with sticky footer */
.floating-call, .whats-btn-simple, .floating-whats-btn, .whats-btn-simple-wrap {
    display: none !important;
}

/* Custom CSS for Booking Confirmed & Alert Modals */
.swal2-container.swal2-top-zindex {
    z-index: 20000 !important;
}
.sleek-booking-confirmed-modal {
    border-radius: 18px !important;
    padding: 24px 28px !important;
    max-width: 92vw !important;
    max-height: 86vh !important;
    overflow-y: auto !important;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25) !important;
}
@media (max-width: 576px) {
    .sleek-booking-confirmed-modal {
        padding: 18px 16px !important;
        border-radius: 14px !important;
    }
}
</style>

<!-- Breadcrumb Banner -->
<section class="py-3 text-white breadcrumb-section" style="background: linear-gradient(135deg, #FC5D09, #ff4b2b);">
  <div class="container d-flex align-items-center justify-content-between flex-wrap gap-2">
    <h3 class="fw-bold text-white mb-0 fs-4">Online Shifting Wizard</h3>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 small">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none opacity-75">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
          Calculate & Book Relocation
        </li>
      </ol>
    </nav>
  </div>
</section>

<!-- Main Form Container -->
<div class="content py-3 bg-light">
    <div class="container">
        <form id="onlineBookingWizardForm" onsubmit="return false;" novalidate>
            <div class="row g-4">
                
                <!-- Full Width Step Inputs Column -->
                <div class="col-12">
                    
                    <!-- Wizard Tabs Navigation Header -->
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px;">
                        <div class="card-body p-3">
                            <div class="wizard-steps-progress d-flex justify-content-between align-items-center position-relative">
                                <!-- Progress Bar Line -->
                                <div class="progress-line position-absolute top-50 start-0 translate-y-50 w-100 bg-light" style="height: 2px; z-index: 1; margin-top: -10px;">
                                    <div class="progress-line-fill bg-danger" style="width: 0%; height: 100%; transition: width 0.3s;"></div>
                                </div>
                                
                                <div class="step-progress-item text-center active" data-step="1" id="step-dot-1" style="z-index: 2; cursor: pointer; flex: 1;">
                                    <div class="step-icon-circle mx-auto rounded-circle d-flex align-items-center justify-content-center bg-white border border-danger fw-bold" style="width: 36px; height: 36px; transition: all 0.3s; line-height: 36px;">1</div>
                                    <div class="step-label-text mt-1 fw-bold text-danger">Locations</div>
                                </div>
                                <div class="step-progress-item text-center" data-step="2" id="step-dot-2" style="z-index: 2; cursor: pointer; flex: 1;">
                                    <div class="step-icon-circle mx-auto rounded-circle d-flex align-items-center justify-content-center bg-white border text-muted" style="width: 36px; height: 36px; transition: all 0.3s; line-height: 36px;">2</div>
                                    <div class="step-label-text mt-1 fw-semibold text-muted">Items</div>
                                </div>
                                <div class="step-progress-item text-center" data-step="3" id="step-dot-3" style="z-index: 2; cursor: pointer; flex: 1;">
                                    <div class="step-icon-circle mx-auto rounded-circle d-flex align-items-center justify-content-center bg-white border text-muted" style="width: 36px; height: 36px; transition: all 0.3s; line-height: 36px;">3</div>
                                    <div class="step-label-text mt-1 fw-semibold text-muted">Add-ons</div>
                                </div>
                                <div class="step-progress-item text-center" data-step="4" id="step-dot-4" style="z-index: 2; cursor: pointer; flex: 1;">
                                    <div class="step-icon-circle mx-auto rounded-circle d-flex align-items-center justify-content-center bg-white border text-muted" style="width: 36px; height: 36px; transition: all 0.3s; line-height: 36px;">4</div>
                                    <div class="step-label-text mt-1 fw-semibold text-muted">Confirm</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 1: Locations & Details -->
                    <?php 
                      $eb_pickup = isset($edit_booking->pickup_location) ? htmlspecialchars($edit_booking->pickup_location) : '';
                      $eb_drop   = isset($edit_booking->drop_location) ? htmlspecialchars($edit_booking->drop_location) : '';
                      $eb_dist   = isset($edit_booking->total_distance) ? floatval($edit_booking->total_distance) : 10;
                      $eb_date   = !empty($edit_booking->shifting_date) ? date('Y-m-d', strtotime($edit_booking->shifting_date)) : '';
                      $eb_time   = !empty($edit_booking->shifting_time) ? $edit_booking->shifting_time : '';
                      $eb_time_12 = !empty($edit_booking->shifting_time) ? date('h:i A', strtotime($edit_booking->shifting_time)) : '';
                      $eb_phone  = !empty($edit_booking->phone_number) ? htmlspecialchars($edit_booking->phone_number) : (!empty($edit_booking->phone) ? htmlspecialchars($edit_booking->phone) : '');

                      $time_options_12h = array(
                          "06:00 AM", "06:30 AM", "07:00 AM", "07:30 AM", "08:00 AM", "08:30 AM",
                          "09:00 AM", "09:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "11:30 AM",
                          "12:00 PM", "12:30 PM", "01:00 PM", "01:30 PM", "02:00 PM", "02:30 PM",
                          "03:00 PM", "03:30 PM", "04:00 PM", "04:30 PM", "05:00 PM", "05:30 PM",
                          "06:00 PM", "06:30 PM", "07:00 PM", "07:30 PM", "08:00 PM", "08:30 PM",
                          "09:00 PM", "09:30 PM", "10:00 PM", "10:30 PM", "11:00 PM", "11:30 PM",
                          "12:00 AM", "12:30 AM", "01:00 AM", "01:30 AM", "02:00 AM", "02:30 AM",
                          "03:00 AM", "03:30 AM", "04:00 AM", "04:30 AM", "05:00 AM", "05:30 AM"
                      );
                    ?>
                    <div class="wizard-step-panel card border-0 shadow-sm p-4 mb-4" id="step-panel-1" style="border-radius: 0; border-top: 4px solid #FC5D09;">
                        <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Shifting Locations &amp; Schedule</h5>
                            <!-- Clear / Start Fresh button: clears localStorage draft -->
                            <button type="button" id="btnClearDraft" class="btn btn-sm btn-outline-secondary px-3" style="border-radius:20px; font-size:0.8rem;" onclick="confirmClearBookingDraft()">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Clear Form / Start Fresh
                            </button>
                        </div>
                        <input type="hidden" id="web_pickup_lat">
                        <input type="hidden" id="web_pickup_lon">
                        <input type="hidden" id="web_drop_lat">
                        <input type="hidden" id="web_drop_lon">
                        <?php if (isset($edit_booking) && !empty($edit_booking)): ?>
                        <input type="hidden" id="editing_booking_id" name="editing_booking_id" value="<?= $edit_booking->id ?>">
                        <?php endif; ?>
                        <div class="row g-3">
                            <div class="col-md-6 position-relative">
                                <label class="form-label fw-bold small text-muted">MOVING FROM (PICKUP ADDRESS) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-fill text-danger"></i></span>
                                    <input type="text" class="form-control border-start-0" id="wizardPickup" name="pickup_location" value="<?= $eb_pickup ?>" placeholder="Type city or area for suggestions..." autocomplete="off" required style="border-radius: 0;">
                                </div>
                                <div id="web_pickup_suggestions" class="dropdown-menu shadow-lg w-100 mt-1 p-0" style="display:none; max-height:220px; overflow-y:auto; z-index:1050;"></div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label fw-bold small text-muted">MOVING TO (DROP ADDRESS) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="bi bi-geo-alt-fill text-danger"></i></span>
                                    <input type="text" class="form-control border-start-0" id="wizardDrop" name="drop_location" value="<?= $eb_drop ?>" placeholder="Type city or area for suggestions..." autocomplete="off" required style="border-radius: 0;">
                                </div>
                                <div id="web_drop_suggestions" class="dropdown-menu shadow-lg w-100 mt-1 p-0" style="display:none; max-height:220px; overflow-y:auto; z-index:1050;"></div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label fw-bold small text-muted">SHIFTING DISTANCE (KM) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-pin-map-fill text-danger"></i></span>
                                    <input type="text" class="form-control bg-light border-start-0 fw-bold text-danger fs-6" id="distanceDisplay" value="<?= $eb_dist ?> KM" readonly style="border-radius: 0;">
                                    <input type="hidden" id="distanceRange" name="total_distance" value="<?= $eb_dist ?>">
                                    <span class="input-group-text bg-light text-muted small"><i class="bi bi-lock-fill me-1"></i>Auto Calculated</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label fw-bold small text-muted">SHIFTING DATE <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="wizardShiftingDate" name="shifting_date" value="<?= $eb_date ?>" required style="border-radius: 0;">
                            </div>
                            <div class="col-md-3 col-6">
                                <label class="form-label fw-bold small text-muted">SHIFTING TIME <span class="text-danger">*</span></label>
                                <select class="form-select" id="wizardShiftingTime" name="shifting_time" required style="border-radius: 0;">
                                    <option value="" <?= empty($eb_time_12) ? 'selected' : '' ?>>Select Time Slot (12-Hour)</option>
                                    <?php foreach ($time_options_12h as $t_opt): ?>
                                        <option value="<?= $t_opt ?>" <?= (strtoupper($eb_time_12) === strtoupper($t_opt)) ? 'selected' : '' ?>><?= $t_opt ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="form-text small text-muted">Min. 2 hrs advance booking</div>
                            </div>

                            
                            <!-- Flooring details (Elevator surcharges) -->
                            <div class="col-12"><hr class="text-muted opacity-25"></div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">PICKUP FLOOR NUMBER <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="pickupFloor" min="0" max="50" value="0" placeholder="0 for Ground, 1, 2, 3..." oninput="calculateLiveEstimate()" onchange="calculateLiveEstimate()" style="border-radius: 0;">
                                <div class="form-text small text-muted">Enter 0 for Ground floor</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">DROP FLOOR NUMBER <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="dropFloor" min="0" max="50" value="0" placeholder="0 for Ground, 1, 2, 3..." oninput="calculateLiveEstimate()" onchange="calculateLiveEstimate()" style="border-radius: 0;">
                                <div class="form-text small text-muted">Enter 0 for Ground floor</div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="pickupLift" checked onchange="calculateLiveEstimate()" style="accent-color:#FC5D09;">
                                    <label class="form-check-label fw-bold small text-muted" for="pickupLift">LIFT AVAILABLE AT PICKUP LOCATION</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch mt-2">
                                    <input class="form-check-input" type="checkbox" id="dropLift" checked onchange="calculateLiveEstimate()" style="accent-color:#FC5D09;">
                                    <label class="form-check-label fw-bold small text-muted" for="dropLift">LIFT AVAILABLE AT DROP LOCATION</label>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- STEP 2: Items Shifting Selector (Flipkart-Style Category & Search UI) -->
                    <?php 
                      if (!function_exists('getItemCategoryIcon')) {
                          function getItemCategoryIcon($sizeName) {
                              $name = strtolower(trim((string)$sizeName));
                              if (str_contains($name, 'small')) return 'bi-box-seam';
                              if (str_contains($name, 'medium')) return 'bi-tv';
                              if (str_contains($name, 'large') && !str_contains($name, 'extra')) return 'bi-lamp';
                              if (str_contains($name, 'extra') || str_contains($name, 'xl')) return 'bi-truck';
                              if (str_contains($name, 'furniture')) return 'bi-archive';
                              if (str_contains($name, 'appliance')) return 'bi-plug';
                              return 'bi-tag-fill';
                          }
                      }
                      $total_all_items = 0;
                      if (isset($item_sizes) && is_array($item_sizes)) {
                          foreach ($item_sizes as $s) {
                              $total_all_items += isset($s->items) ? count($s->items) : 0;
                          }
                      }
                    ?>
                    <div class="wizard-step-panel card border-0 shadow-sm p-4 mb-4 d-none" id="step-panel-2" style="border-radius: 0; border-top: 4px solid #FC5D09;">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2 flex-wrap gap-2">
                            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-box-seam-fill text-danger me-2"></i>Select Items to Shift</h5>
                            <span class="badge bg-danger-subtle text-danger px-3 py-2 fw-bold" style="border-radius: 4px; font-size: 0.88rem;">
                                Total Score: <span id="wizardScoreVal">0</span> pts
                            </span>
                        </div>

                        <!-- 1. Search Bar at Top (Flipkart Style) -->
                        <div class="item-search-card p-2 mb-3 bg-light border" style="border-radius: 8px;">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-danger"><i class="bi bi-search fs-6"></i></span>
                                <input type="text" id="itemSearchInput" class="form-control border-start-0 py-2" placeholder="Search items to shift (e.g. Sofa, Bed, AC, Box, TV, Chair, Table)..." autocomplete="off" style="font-size: 0.95rem;">
                                <button class="btn btn-outline-secondary border-start-0 bg-white d-none text-muted" type="button" id="btnClearItemSearch" onclick="resetItemSearch()"><i class="bi bi-x-circle-fill"></i></button>
                            </div>
                        </div>

                        <!-- 2. Flipkart-Style Horizontal Category Navigation Bar -->
                        <div class="category-nav-wrapper mb-3">
                            <div class="category-nav-pills d-flex flex-nowrap gap-2 overflow-auto pb-2 pe-1" id="itemCategoryPills" style="scrollbar-width: thin;">
                                <button type="button" class="btn cat-pill-btn active flex-shrink-0 text-nowrap px-3 py-2 fw-bold" data-cat-id="all" style="border-radius: 20px;">
                                    <i class="bi bi-grid-fill me-1"></i> All Items
                                    <span class="badge bg-light text-dark ms-1"><?= $total_all_items ?></span>
                                    <span class="badge bg-danger text-white ms-1 pill-selected-badge d-none" id="cat-badge-all">0</span>
                                </button>
                                
                                <?php if (isset($item_sizes) && is_array($item_sizes)): ?>
                                <?php foreach ($item_sizes as $index => $size): ?>
                                <?php $icon = getItemCategoryIcon($size->size_name); ?>
                                <button type="button" class="btn cat-pill-btn flex-shrink-0 text-nowrap px-3 py-2 fw-bold" data-cat-id="<?= $size->id ?>" style="border-radius: 20px;">
                                    <i class="bi <?= $icon ?> me-1"></i> <?= htmlspecialchars($size->size_name) ?>
                                    <span class="badge bg-light text-secondary ms-1"><?= isset($size->items) ? count($size->items) : 0 ?></span>
                                    <span class="badge bg-danger text-white ms-1 pill-selected-badge d-none" id="cat-badge-<?= $size->id ?>">0</span>
                                </button>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 3. Selected Items Summary Bar / Chips Strip -->
                        <div class="selected-items-chip-bar p-2 mb-3 bg-light border border-danger-subtle d-none" id="selectedItemsChipBar" style="border-radius: 8px;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small fw-bold text-danger"><i class="bi bi-check-square-fill me-1"></i>Selected Items (<span id="selectedItemsTotalQty">0</span>)</span>
                                <button type="button" class="btn btn-sm text-danger p-0 small text-decoration-none fw-bold" onclick="clearAllSelectedItems()"><i class="bi bi-trash me-1"></i>Clear All</button>
                            </div>
                            <div class="d-flex flex-wrap gap-1" id="selectedItemsChipsContainer">
                                <!-- Chips rendered dynamically -->
                            </div>
                        </div>

                        <!-- 4. No Items Found Container (Search query no match) -->
                        <div class="text-center py-5 d-none bg-light border rounded" id="noItemsFoundMsg">
                            <i class="bi bi-search text-muted fs-1 mb-2 d-block"></i>
                            <h6 class="fw-bold text-secondary">No items found matching "<span id="searchQueryText"></span>"</h6>
                            <p class="small text-muted mb-3">Try searching with another item name (e.g. Sofa, Bed, AC, Box, Table)</p>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3" onclick="resetItemSearch()"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset Search</button>
                        </div>

                        <!-- 5. Category Item Lists Grid -->
                        <div id="itemsCategoryContainer">
                            <?php if (isset($item_sizes) && is_array($item_sizes)): ?>
                            <?php foreach ($item_sizes as $index => $size): ?>
                            <div class="category-panel-block mb-4" id="cat-panel-<?= $size->id ?>" data-cat-id="<?= $size->id ?>">
                                <div class="category-header-title d-flex align-items-center justify-content-between bg-light p-2 px-3 mb-2 border-start border-danger border-4" style="border-radius: 4px;">
                                    <h6 class="fw-bold mb-0 text-dark">
                                        <i class="bi <?= getItemCategoryIcon($size->size_name) ?> text-danger me-2"></i><?= htmlspecialchars($size->size_name) ?> Items
                                        <small class="text-muted fw-normal ms-1">(<?= count($size->items) ?> available)</small>
                                    </h6>
                                </div>
                                <div class="row g-2">
                                    <?php foreach ($size->items as $item): ?>
                                    <?php 
                                      $scoreVal = isset($item->score_point) ? floatval($item->score_point) : floatval($size->volume_score);
                                      $pre_qty = 0;
                                      if (isset($edit_booking->items) && is_array($edit_booking->items)) {
                                          foreach ($edit_booking->items as $bi) {
                                              if ($bi->item_id == $item->id) {
                                                  $pre_qty = intval($bi->quantity);
                                                  break;
                                              }
                                          }
                                      }
                                      $item_box_style = ($pre_qty > 0) ? 'border-color: #FC5D09 !important; background-color: #fff0f0 !important;' : '';
                                      $item_box_class = ($pre_qty > 0) ? 'has-qty' : '';
                                    ?>
                                    <div class="col-md-6 col-12 item-card-wrapper" data-item-name="<?= strtolower(htmlspecialchars($item->item_name)) ?>" data-cat-id="<?= $size->id ?>" data-id="<?= $item->id ?>">
                                        <div class="p-2 border d-flex justify-content-between align-items-center item-row-box <?= $item_box_class ?>" id="item-box-<?= $item->id ?>" style="border-radius: 6px; <?= $item_box_style ?>">
                                            <span class="text-dark small fw-semibold item-title-text">
                                                <i class="bi bi-box me-1 text-muted"></i>
                                                <?= htmlspecialchars($item->item_name) ?>
                                            </span>
                                            <div class="d-flex align-items-center gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 qty-wiz-btn" data-action="minus" data-id="<?= $item->id ?>" data-weight="<?= $scoreVal ?>" data-name="<?= htmlspecialchars($item->item_name) ?>" data-cat-id="<?= $size->id ?>" style="border-radius: 4px;">-</button>
                                                <span class="fw-bold text-dark qty-wiz-display" id="item-qty-<?= $item->id ?>" style="min-width: 22px; text-align: center;"><?= $pre_qty ?></span>
                                                <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 qty-wiz-btn" data-action="plus" data-id="<?= $item->id ?>" data-weight="<?= $scoreVal ?>" data-name="<?= htmlspecialchars($item->item_name) ?>" data-cat-id="<?= $size->id ?>" style="border-radius: 4px;">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- STEP 3: Add-on Services (Flipkart-Style Category & Search UI) -->
                    <?php 
                      if (!function_exists('getAddonCategoryIcon')) {
                          function getAddonCategoryIcon($catName) {
                              $name = strtolower(trim((string)$catName));
                              if (str_contains($name, 'pack') || str_contains($name, 'labor') || str_contains($name, 'handling')) return 'bi-box-seam';
                              if (str_contains($name, 'appliance') || str_contains($name, 'ac') || str_contains($name, 'electronics')) return 'bi-tools';
                              if (str_contains($name, 'clean') || str_contains($name, 'sanit')) return 'bi-stars';
                              if (str_contains($name, 'insur') || str_contains($name, 'safe') || str_contains($name, 'protect')) return 'bi-shield-check';
                              if (str_contains($name, 'unpack') || str_contains($name, 'rearrange')) return 'bi-arrow-counterclockwise';
                              return 'bi-gear-fill';
                          }
                      }
                      $total_all_addons = 0;
                      if (isset($addon_categories) && is_array($addon_categories)) {
                          foreach ($addon_categories as $c) {
                              if (!empty($c->addons)) {
                                  $total_all_addons += count($c->addons);
                              }
                          }
                      }
                    ?>
                    <div class="wizard-step-panel card border-0 shadow-sm p-4 mb-4 d-none" id="step-panel-3" style="border-radius: 0; border-top: 4px solid #FC5D09;">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2 flex-wrap gap-2">
                            <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-plus-circle-fill text-danger me-2"></i>Select Add-on Services</h5>
                            <span class="badge bg-success-subtle text-success px-3 py-2 fw-bold" style="border-radius: 4px; font-size: 0.88rem;">
                                Total Add-ons: <span id="wizAddonsFareDisplay">₹0.00</span>
                            </span>
                        </div>

                        <!-- 1. Search Bar at Top for Add-ons (Flipkart Style) -->
                        <div class="addon-search-card p-2 mb-3 bg-light border" style="border-radius: 8px;">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 text-danger"><i class="bi bi-search fs-6"></i></span>
                                <input type="text" id="addonSearchInput" class="form-control border-start-0 py-2" placeholder="Search add-on services (e.g. Packing, AC Installation, Dismantling, Unpacking)..." autocomplete="off" style="font-size: 0.95rem;">
                                <button class="btn btn-outline-secondary border-start-0 bg-white d-none text-muted" type="button" id="btnClearAddonSearch" onclick="resetAddonSearch()"><i class="bi bi-x-circle-fill"></i></button>
                            </div>
                        </div>

                        <!-- 2. Flipkart-Style Category Navigation Bar for Add-ons -->
                        <div class="category-nav-wrapper mb-3">
                            <div class="category-nav-pills d-flex flex-nowrap gap-2 overflow-auto pb-2 pe-1" id="addonCategoryPills" style="scrollbar-width: thin;">
                                <button type="button" class="btn addon-cat-pill-btn active flex-shrink-0 text-nowrap px-3 py-2 fw-bold" data-cat-id="all" style="border-radius: 20px;">
                                    <i class="bi bi-grid-fill me-1"></i> All Add-ons
                                    <span class="badge bg-light text-dark ms-1"><?= $total_all_addons ?></span>
                                    <span class="badge bg-danger text-white ms-1 addon-pill-selected-badge d-none" id="addon-cat-badge-all">0</span>
                                </button>
                                
                                <?php if (isset($addon_categories) && is_array($addon_categories)): ?>
                                <?php foreach ($addon_categories as $index => $cat): ?>
                                <?php if (!empty($cat->addons)): ?>
                                <?php $icon = getAddonCategoryIcon($cat->name); ?>
                                <button type="button" class="btn addon-cat-pill-btn flex-shrink-0 text-nowrap px-3 py-2 fw-bold" data-cat-id="<?= $cat->id ?>" style="border-radius: 20px;">
                                    <i class="bi <?= $icon ?> me-1"></i> <?= htmlspecialchars($cat->name) ?>
                                    <span class="badge bg-light text-secondary ms-1"><?= count($cat->addons) ?></span>
                                    <span class="badge bg-danger text-white ms-1 addon-pill-selected-badge d-none" id="addon-cat-badge-<?= $cat->id ?>">0</span>
                                </button>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 3. Selected Add-ons Summary Bar / Chips Strip -->
                        <div class="selected-addons-chip-bar p-2 mb-3 bg-light border border-danger-subtle d-none" id="selectedAddonsChipBar" style="border-radius: 8px;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small fw-bold text-danger"><i class="bi bi-check-circle-fill me-1"></i>Selected Add-on Services (<span id="selectedAddonsTotalQty">0</span>)</span>
                                <button type="button" class="btn btn-sm text-danger p-0 small text-decoration-none fw-bold" onclick="clearAllSelectedAddons()"><i class="bi bi-trash me-1"></i>Clear All</button>
                            </div>
                            <div class="d-flex flex-wrap gap-1" id="selectedAddonsChipsContainer">
                                <!-- Chips rendered dynamically -->
                            </div>
                        </div>

                        <!-- 4. No Add-ons Found Container (Search query no match) -->
                        <div class="text-center py-5 d-none bg-light border rounded" id="noAddonsFoundMsg">
                            <i class="bi bi-search text-muted fs-1 mb-2 d-block"></i>
                            <h6 class="fw-bold text-secondary">No add-on services found matching "<span id="addonSearchQueryText"></span>"</h6>
                            <p class="small text-muted mb-3">Try searching with another service term (e.g. Packing, AC, Installation, Dismantling)</p>
                            <button type="button" class="btn btn-sm btn-outline-danger px-3" onclick="resetAddonSearch()"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset Search</button>
                        </div>

                        <!-- 5. Category Addon Lists Grid -->
                        <div id="addonsCategoryContainer">
                            <?php if (isset($addon_categories) && is_array($addon_categories)): ?>
                            <?php foreach ($addon_categories as $index => $cat): ?>
                            <?php if (!empty($cat->addons)): ?>
                            <div class="addon-category-panel-block mb-4" id="addon-cat-panel-<?= $cat->id ?>" data-cat-id="<?= $cat->id ?>">
                                <div class="category-header-title d-flex align-items-center justify-content-between bg-light p-2 px-3 mb-2 border-start border-danger border-4" style="border-radius: 4px;">
                                    <h6 class="fw-bold mb-0 text-dark">
                                        <i class="bi <?= getAddonCategoryIcon($cat->name) ?> text-danger me-2"></i><?= htmlspecialchars($cat->name) ?>
                                        <small class="text-muted fw-normal ms-1">(<?= count($cat->addons) ?> available)</small>
                                    </h6>
                                </div>
                                <div class="row g-3">
                                    <?php foreach ($cat->addons as $addon): ?>
                                    <?php 
                                      $pre_addon_checked = false;
                                      $pre_addon_qty = 1;
                                      if (isset($edit_booking->addons) && is_array($edit_booking->addons)) {
                                          foreach ($edit_booking->addons as $ba) {
                                              if ($ba->add_on_id == $addon->id) {
                                                  $pre_addon_checked = true;
                                                  $pre_addon_qty = (isset($ba->quantity) && intval($ba->quantity) > 0) ? intval($ba->quantity) : 1;
                                                  break;
                                              }
                                          }
                                      }
                                      $addon_box_style = $pre_addon_checked ? 'border-color: #FC5D09 !important; background-color: #fffafa !important;' : '';
                                      $is_rope_pulling = (strpos(strtolower($addon->addon_name), 'rope') !== false);
                                    ?>
                                    <div class="col-md-6 col-12 addon-card-wrapper" data-addon-name="<?= strtolower(htmlspecialchars($addon->addon_name)) ?>" data-cat-id="<?= $cat->id ?>" data-id="<?= $addon->id ?>">
                                        <div class="p-3 border d-flex align-items-center justify-content-between addon-selection-box cursor-pointer" id="addon-box-<?= $addon->id ?>" onclick="toggleAddonChecked('addon-check-<?= $addon->id ?>')" style="border-radius: 6px; transition: all 0.2s; <?= $addon_box_style ?>">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input addon-wizard-chk" type="checkbox" id="addon-check-<?= $addon->id ?>" <?= $pre_addon_checked ? 'checked' : '' ?> data-addon-id="<?= $addon->id ?>" data-addon-name="<?= htmlspecialchars($addon->addon_name) ?>" data-cat-id="<?= $cat->id ?>" data-price="<?= $addon->price ?>" data-price-type="<?= isset($addon->price_type) ? $addon->price_type : 'fixed' ?>" data-category-name="<?= htmlspecialchars(strtolower(trim($cat->name))) ?>" onclick="event.stopPropagation(); handlePackagingMutualExclusion(this); calculateLiveEstimate(); updateSelectedAddonsUI();" style="accent-color:#FC5D09;">
                                                <label class="form-check-label fw-semibold text-dark small addon-title-text" for="addon-check-<?= $addon->id ?>" onclick="event.stopPropagation();">
                                                    <?= htmlspecialchars($addon->addon_name) ?>
                                                </label>
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <?php if ($is_rope_pulling): ?>
                                                <div class="addon-qty-container d-flex align-items-center gap-1 me-2 <?= $pre_addon_checked ? '' : 'd-none' ?>">
                                                    <button type="button" class="btn btn-xs btn-outline-secondary py-0 px-1 qty-addon-btn" data-action="minus" data-id="<?= $addon->id ?>" style="border-radius: 4px; font-size: 0.75rem; line-height: 1;">-</button>
                                                    <span class="fw-bold text-dark addon-qty-display" id="addon-qty-<?= $addon->id ?>" style="min-width: 15px; text-align: center; font-size: 0.85rem;"><?= $pre_addon_qty ?></span>
                                                    <button type="button" class="btn btn-xs btn-outline-danger py-0 px-1 qty-addon-btn" data-action="plus" data-id="<?= $addon->id ?>" style="border-radius: 4px; font-size: 0.75rem; line-height: 1;">+</button>
                                                </div>
                                                <?php else: ?>
                                                <span class="addon-qty-display d-none" id="addon-qty-<?= $addon->id ?>">1</span>
                                                <?php endif; ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2 font-monospace addon-badge-<?= $addon->id ?>" style="border-radius: 4px;">+₹<?= number_format($addon->price * ($is_rope_pulling ? $pre_addon_qty : 1), 0) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <!-- Additional Comment / Special Instructions (Optional) -->
                        <div class="mt-4 pt-3 border-top">
                            <label for="additional_comment" class="form-label fw-bold text-dark small mb-1">
                                <i class="bi bi-chat-left-text-fill text-danger me-2"></i>Additional Comment / Special Remarks <span class="text-muted fw-normal">(Optional)</span>
                            </label>
                            <textarea id="additional_comment" name="additional_comment" class="form-control shadow-none" rows="3" placeholder="Describe any specific instructions, delicate items, or special remarks for your shifting..." style="border-radius: 0; font-size: 13px;"></textarea>
                            <div class="form-text small text-muted">You can provide any additional details or specific requests for the shifting team.</div>
                        </div>

                    </div>

                    <!-- STEP 4: Confirmation & Secure Checkout (Please Note Cards Layout) -->
                    <?php 
                        $token_amount_val = isset($default_reg_fee) && floatval($default_reg_fee) > 0 ? intval($default_reg_fee) : 100;
                    ?>
                    <div class="wizard-step-panel card border-0 shadow-sm p-3 p-md-4 mb-4 d-none" id="step-panel-4" style="border-radius: 12px; border-top: 4px solid #FC5D09 !important;">
                        
                        <!-- Header -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-danger text-white rounded p-1 px-2 me-2 d-inline-flex align-items-center justify-content-center" style="font-size: 0.9rem;">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                            <h5 class="fw-bold mb-0 text-danger" style="font-size: 1.2rem;">Please Note</h5>
                        </div>
                        
                        <!-- Cards List -->
                        <div class="d-flex flex-column gap-3 mb-4">
                            
                            <!-- Card 1: Token Payment -->
                            <div class="note-card note-card-token shadow-sm">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="note-icon-circle note-icon-token">
                                        <span class="fw-bold">₹</span>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-danger" style="font-size: 1rem;">1. Token Payment</h6>
                                        <p class="text-secondary small mb-0" style="line-height: 1.5; font-size: 0.88rem;">
                                            Great! You will pay a token amount of <strong>₹<?= $token_amount_val ?></strong> to confirm your booking. Your booking will be confirmed once the <strong>₹<?= $token_amount_val ?></strong> token is paid. The remaining balance is payable when your shifting is completed.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2: Timing Reconfirmation -->
                            <div class="note-card note-card-timing shadow-sm">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="note-icon-circle note-icon-timing">
                                        <i class="bi bi-calendar-event"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1" style="color: #1d4ed8; font-size: 1rem;">2. Timing Reconfirmation</h6>
                                        <p class="text-secondary small mb-0" style="line-height: 1.5; font-size: 0.88rem;">
                                            Due to the restrictions of no entry by the government, our partner (department) will call you to reconfirm the timing, and accordingly the time will be rescheduled if required.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3: Sit Back & Relax -->
                            <div class="note-card note-card-relax shadow-sm">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="note-icon-circle note-icon-relax position-relative">
                                        <i class="bi bi-whatsapp"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold mb-1 text-success" style="font-size: 1rem;">3. Sit Back &amp; Relax</h6>
                                        <p class="text-secondary small mb-0" style="line-height: 1.5; font-size: 0.88rem;">
                                            Now and then, you just have to sit back and relax. We will keep you updated on every step on your WhatsApp.
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Phone Number Input Section -->
                        <div class="p-3 bg-light border border-secondary-subtle rounded-3">
                            <label class="form-label fw-bold small text-muted mb-2">
                                <i class="bi bi-shield-lock-fill text-danger me-1"></i>CONFIRM SHIFTING OWNER'S CONTACT MOBILE <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-lg shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                <span class="input-group-text bg-white border-end-0 text-danger"><i class="bi bi-phone"></i></span>
                                <?php 
                                    $web_user_session = $this->session->userdata('web_user');
                                    $prefilled_phone = ($web_user_session && !empty($web_user_session['mobile'])) ? htmlspecialchars($web_user_session['mobile']) : '';
                                ?>
                                <input type="tel" class="form-control border-start-0 fw-bold fs-6" id="wizardPhone" name="phone_number" value="<?= $prefilled_phone ?>" placeholder="Enter 10-digit owner's mobile number" maxlength="10" required>
                            </div>
                            <div class="form-text small text-muted mt-1">Shifting request and live WhatsApp tracking updates will be sent to this number.</div>
                        </div>

                    </div>

                </div>

                </div> <!-- End of col-12 -->

            </div> <!-- End of row -->
        </form>
    </div>
</div>

<!-- Sticky Bottom Action Footer (Desktop & Mobile) -->
<div class="sticky-action-footer">
    <!-- Slide-up Price Breakdown Panel -->
    <div class="price-breakdown-panel d-none" id="priceBreakdownPanel">
        <div class="p-3 bg-light border-bottom fw-bold d-flex justify-content-between align-items-center">
            <span class="text-dark"><i class="bi bi-calculator-fill text-danger me-2"></i>Live Pricing Breakdown</span>
            <button type="button" class="btn-close" id="btnCloseBreakdown" style="font-size: 0.75rem;" aria-label="Close"></button>
        </div>
        <div class="p-3">
            <div class="d-flex justify-content-between mb-2"><span>Base Fare</span><span class="fw-bold" id="breakdownBaseFare">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2"><span>Volume Charge</span><span class="fw-bold" id="breakdownVolumeCharge">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2"><span>Distance Charges</span><span class="fw-bold" id="breakdownDistanceFare">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2"><span>Add-on Services</span><span class="fw-bold" id="breakdownAddonsFare">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2"><span>Floor & Carry Surcharge</span><span class="fw-bold" id="breakdownFloorFare">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2 text-warning d-none" id="breakdownWeekendRow"><span>Weekend Surge (10%)</span><span class="fw-bold" id="breakdownWeekendFare">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2 text-danger d-none" id="breakdownMonthEndRow"><span>Month-End Surge (15%)</span><span class="fw-bold" id="breakdownMonthEndFare">₹0.00</span></div>
            <div class="d-flex justify-content-between mb-2 d-none" id="breakdownPeakRow"><span id="breakdownPeakLabel">Peak Time Surcharge</span><span class="fw-bold" id="breakdownPeakFare">₹0.00</span></div>
            <hr class="my-2">
            <div class="d-flex justify-content-between fw-bold text-dark fs-6"><span>Estimated Total</span><span id="breakdownTotalAmount">₹1,000.00</span></div>
        </div>
    </div>

    <div class="container-fluid px-md-5 px-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <!-- Left Side: Live Price & Summary Details -->
            <div class="d-flex align-items-center gap-3">
                <div class="d-flex flex-column" id="footerPriceSummary">
                    <span class="footer-label">Est. Shifting Total</span>
                    <div class="d-flex align-items-center gap-2">
                        <span class="footer-price" id="stickyTotalAmount">₹1,000.00</span>
                        <a href="#" class="text-primary fw-bold text-decoration-none" id="btnToggleBreakdown" style="font-size: 0.72rem; cursor: pointer; border-bottom: 1px dashed;">View Details</a>
                    </div>
                </div>
                <div class="d-none d-md-flex flex-column border-start ps-3 border-secondary border-opacity-25">
                    <span class="footer-label-secondary" id="stickyVehicleText">Tata Ace</span>
                    <span class="footer-val-secondary" id="stickyCategoryText">Micro Shifting</span>
                </div>
                <!-- Horizontal Breakdown List for Large Screens -->
                <div class="d-none d-lg-flex align-items-center gap-3 border-start ps-3 border-secondary border-opacity-25" id="stickyBreakdownList" style="font-size: 0.72rem;">
                    <div><span class="text-muted">Base:</span> <span class="fw-bold text-dark" id="lblBase">₹1,000</span></div>
                    <div><span class="text-muted">Vol:</span> <span class="fw-bold text-dark" id="lblVol">₹0</span></div>
                    <div><span class="text-muted">Dist:</span> <span class="fw-bold text-dark" id="lblDist">₹0</span></div>
                    <div><span class="text-muted">Addon:</span> <span class="fw-bold text-dark" id="lblAddon">₹0</span></div>
                    <div><span class="text-muted">Floor:</span> <span class="fw-bold text-dark" id="lblFloor">₹0</span></div>
                    <div class="d-none" id="lblSurgeRow"><span class="text-danger fw-semibold">Surge:</span> <span class="fw-bold text-danger" id="lblSurge">₹0</span></div>
                    <div class="d-none" id="lblPeakRow"><span class="fw-semibold" id="lblPeakLabel">Peak:</span> <span class="fw-bold" id="lblPeak">₹0</span></div>
                </div>
            </div>
            
            <!-- Right Side: Wizard Navigation Buttons -->
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-outline-secondary px-3 py-1 fw-bold d-none" id="btnStickyPrev">
                    <i class="bi bi-arrow-left"></i> Back
                </button>
                <button type="button" class="btn btn-danger px-4 py-1 fw-bold" id="btnStickyNext" style="background: #FC5D09; border: none; box-shadow: 0 4px 12px rgba(252, 93, 9, 0.25);">
                    Next Step: Items <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden original pricing elements to prevent JS errors -->
<div class="d-none">
    <span id="wizTotalAmount">₹1,000.00</span>
    <span id="wizCategoryText">Micro Shifting</span>
    <span id="wizVehicleText">Tata Ace</span>
    <span id="wizBaseFare">₹1,000.00</span>
    <span id="wizPointFare">₹0.00</span>
    <span id="wizPointFareExpl"></span>
    <span id="wizDistanceFare">₹0.00</span>
    <span id="wizAddonsFare">₹0.00</span>
    <span id="wizFloorFare">₹0.00</span>
    <div id="wizWeekendRow">
        <span id="wizWeekendFare">₹0.00</span>
    </div>
    <div id="wizMonthEndRow">
        <span id="wizMonthEndFare">₹0.00</span>
    </div>
    <div id="wizPeakRow">
        <span id="wizPeakFare">₹0.00</span>
    </div>
    <div id="wizSurveyWarning"></div>
    <input type="hidden" name="estimated_amount" id="wizTotalInput" value="1000">
</div>

<!-- OTP Login Modal is loaded globally via footer -->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBkG4TBQoURnRXy7szzEQP2LqvlEEVfYDM&libraries=places"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
<?php
$CI =& get_instance();
$CI->load->model('contacts/contacts_mdl');
$loc_settings_ob = isset($loc_settings) ? $loc_settings : $CI->contacts_mdl->get_location_service_settings();
$allowed_cities_str_ob = isset($loc_settings_ob['allowed_pickup_cities']) ? $loc_settings_ob['allowed_pickup_cities'] : 'Delhi, Noida, Greater Noida, Gurugram, Gurgaon, Ghaziabad, Faridabad';
$max_distance_km_ob = isset($loc_settings_ob['max_relocation_distance_km']) ? floatval($loc_settings_ob['max_relocation_distance_km']) : 300;
?>
window.allowedPickupCitiesStr = <?php echo json_encode($allowed_cities_str_ob); ?>;
window.maxRelocationDistanceKm = <?php echo floatval($max_distance_km_ob); ?>;

// Global dynamic data loaded from controller
const shiftingCategories = <?= json_encode($categories ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
const addonCategoryPrices = <?= json_encode($addon_category_prices ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
const editBookingData = <?= json_encode($edit_booking ?? null, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
const defaultRegFee = <?= isset($default_reg_fee) ? floatval($default_reg_fee) : 500.00 ?>;
const editBookingRegFee = <?= isset($edit_booking->registration_charge) ? floatval($edit_booking->registration_charge) : 0 ?>;

// Pricing settings from admin DB (same as PricingEngine defaults)
const pricingSettings = <?= json_encode($pricing_settings ?? ['per_km_rate' => 20, 'base_distance_km' => 5, 'per_floor_charge' => 150]) ?>;
const BOOKING_DRAFT_KEY = 'bhandari_booking_draft_v1';

// ─── Google Places Autocomplete flags for Wizard ──────────────────────────
var _isPickupValidWizard = false;
var _isDropValidWizard   = false;

// Selected items tracking mapping
const selectedItems = {};

function saveBookingDraft() {
    try {
        const draft = {
            pickup_location: $('#wizardPickup').val() || '',
            drop_location: $('#wizardDrop').val() || '',
            shifting_date: $('#wizardShiftingDate').val() || '',
            shifting_time: $('#wizardShiftingTime').val() || '',
            phone_number: $('#wizardPhone').val() || '',
            distance_km: $('#distanceRange').val() || '',
            pickup_floor: $('#pickupFloor').val() || 0,
            drop_floor: $('#dropFloor').val() || 0,
            pickup_lift: $('#pickupLift').is(':checked') ? 1 : 0,
            drop_lift: $('#dropLift').is(':checked') ? 1 : 0,
            remarks: $('#additional_comment').val() || '',
            selectedItems: JSON.parse(JSON.stringify(selectedItems)),
            addonSelections: $('.addon-wizard-chk').map(function() {
                return { id: this.id.replace('addon-check-', ''), checked: this.checked, qty: parseInt($('#addon-qty-' + this.id.replace('addon-check-', '')).text()) || 1 };
            }).get()
        };
        localStorage.setItem(BOOKING_DRAFT_KEY, JSON.stringify(draft));
    } catch (e) {
        console.warn('Draft save failed:', e);
    }
}

function clearBookingDraft() {
    try {
        localStorage.removeItem(BOOKING_DRAFT_KEY);
        localStorage.removeItem('bhandari_booking_draft_v1');
        localStorage.removeItem('bhandari_quote_data');
        sessionStorage.removeItem(BOOKING_DRAFT_KEY);
        sessionStorage.removeItem('bhandari_booking_draft_v1');
        sessionStorage.removeItem('bhandari_quote_data');
        
        // Clear server session quote data
        $.post('<?= site_url("contacts/clear-quote-session") ?>', {});
    } catch (e) {
        console.warn('Draft clear failed:', e);
    }
}

// Called by "Clear Form / Start Fresh" button
function confirmClearBookingDraft() {
    Swal.fire({
        icon: 'warning',
        title: 'Clear All Form Data?',
        text: 'This will reset all entered locations, items, add-ons and saved draft. Are you sure?',
        showCancelButton: true,
        confirmButtonColor: '#FC5D09',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="bi bi-arrow-counterclockwise me-1"></i> Yes, Clear It',
        cancelButtonText: 'Cancel'
    }).then(function(result) {
        if (result.isConfirmed) {
            clearBookingDraft();
            // Reset input values
            $('#wizardPickup').val('');
            $('#wizardDrop').val('');
            $('#wizardShiftingDate').val('');
            $('#wizardShiftingTime').val('');
            $('#pickupFloor').val('0');
            $('#dropFloor').val('0');
            $('#pickupLift').prop('checked', false);
            $('#dropLift').prop('checked', false);
            $('#additional_comment').val('');
            $('#distanceRange').val('');
            Object.keys(selectedItems).forEach(key => delete selectedItems[key]);
            $('.addon-wizard-chk').prop('checked', false);
            $('.item-qty-input').text('0');
            
            setTimeout(function() {
                window.location.href = window.location.pathname; // reload without params
            }, 100);
        }
    });
}


function restoreBookingDraft() {
    try {
        const raw = localStorage.getItem(BOOKING_DRAFT_KEY);
        if (!raw) return false;
        const draft = JSON.parse(raw);
        if (!draft) return false;

        if (draft.pickup_location) $('#wizardPickup').val(draft.pickup_location);
        if (draft.drop_location) $('#wizardDrop').val(draft.drop_location);
        if (draft.shifting_date) $('#wizardShiftingDate').val(draft.shifting_date);
        if (draft.shifting_time) $('#wizardShiftingTime').val(draft.shifting_time);
        if (draft.phone_number) $('#wizardPhone').val(draft.phone_number);
        if (draft.distance_km) $('#distanceRange').val(draft.distance_km);
        if (draft.pickup_floor) $('#pickupFloor').val(draft.pickup_floor);
        if (draft.drop_floor) $('#dropFloor').val(draft.drop_floor);
        $('#pickupLift').prop('checked', !!draft.pickup_lift);
        $('#dropLift').prop('checked', !!draft.drop_lift);
        if (draft.remarks) $('#additional_comment').val(draft.remarks);

        const savedItems = draft.selectedItems || {};
        Object.keys(selectedItems).forEach(function(key) { delete selectedItems[key]; });
        Object.keys(savedItems).forEach(function(key) {
            const value = savedItems[key] || {};
            selectedItems[key] = { qty: parseInt(value.qty || 0), weight: parseFloat(value.weight || 1) };
            const qtyEl = $('#item-qty-' + key);
            if (qtyEl.length) {
                qtyEl.text(selectedItems[key].qty || 0);
            }
        });

        if (Array.isArray(draft.addonSelections)) {
            draft.addonSelections.forEach(function(item) {
                const checkbox = $('#addon-check-' + item.id);
                const qtyEl = $('#addon-qty-' + item.id);
                if (checkbox.length) {
                    checkbox.prop('checked', !!item.checked);
                    if (qtyEl.length && item.qty) {
                        qtyEl.text(item.qty);
                    }
                    const box = checkbox.closest('.addon-selection-box');
                    if (box.length) {
                        box.css({
                            'border-color': item.checked ? '#FC5D09' : '#dee2e6',
                            'background-color': item.checked ? '#fffafa' : '#fff'
                        });
                    }
                }
            });
        }

        return true;
    } catch (e) {
        console.warn('Draft restore failed:', e);
        return false;
    }
}

$(function() {
    // Initialize progress tracker line width
    updateProgressTracker(1);

    // Set min date for shifting date input if not editing
    const today = (function() { var d = new Date(); return d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0'); })();
    const di = document.getElementById('wizardShiftingDate');
    if (di && !editBookingData) { 
        di.setAttribute('min', today); 
        // Do NOT auto-fill today — let user pick a date so surcharges only apply when explicitly chosen
    }

    // If editing an existing booking or restoring a draft, mark locations as pre-validated
    // (we trust previously-saved locations — validation only applies to NEW manual entries)
    setTimeout(function() {
        if ($('#wizardPickup').val() && $('#wizardPickup').val().trim().length > 1) {
            _isPickupValidWizard = true;
        }
        if ($('#wizardDrop').val() && $('#wizardDrop').val().trim().length > 1) {
            _isDropValidWizard = true;
        }
    }, 700); // Slight delay to allow draft restore to complete first
    // ─────────────────────────────────────────────────────────────────────────



    // Initialize selectedItems from pre-rendered PHP DOM values (only if not editing an existing booking to prevent double-initialization)
    if (!editBookingData) {
        $('.qty-wiz-display').each(function() {
            let qty = parseInt($(this).text()) || 0;
            if (qty > 0) {
                let itemId = $(this).attr('id').replace('item-qty-', '');
                // Find the matching plus button in the parent row
                let plusBtn = $(this).closest('.item-row-box').find('.qty-wiz-btn[data-action="plus"]');
                let weight = 1.0;
                if (plusBtn.length) {
                    weight = parseFloat(plusBtn.attr('data-weight')) || parseFloat(plusBtn.data('weight')) || 1.0;
                }
                selectedItems[itemId] = { qty: qty, weight: weight };
            }
        });
    }

    restoreBookingDraft();

    // Pre-fill Edit Booking Mode if present
    if (editBookingData) {
        if (editBookingData.pickup_location) $('#wizardPickup').val(editBookingData.pickup_location);
        if (editBookingData.drop_location) $('#wizardDrop').val(editBookingData.drop_location);
        
        // Ensure date is formatted YYYY-MM-DD for date input
        if (editBookingData.shifting_date) {
            let cleanDate = editBookingData.shifting_date.split(' ')[0].trim();
            if (cleanDate.length === 10) {
                $('#wizardShiftingDate').val(cleanDate);
            }
        }
        
        // Ensure time is formatted HH:MM for time input
        if (editBookingData.shifting_time) {
            let cleanTime = editBookingData.shifting_time.trim();
            if (cleanTime.length >= 5) {
                cleanTime = cleanTime.substring(0, 5);
                $('#wizardShiftingTime').val(cleanTime);
            }
        }

        // Phone number
        if (editBookingData.phone_number || editBookingData.phone) {
            $('#wizardPhone').val(editBookingData.phone_number || editBookingData.phone);
        }

        // Distance
        if (editBookingData.total_distance) {
            let distVal = parseFloat(editBookingData.total_distance) || 10;
            $('#distanceRange').val(distVal);
            $('#distanceDisplay').val(distVal + ' KM');
        }

        // Floors & Lifts prefill
        if (editBookingData.pickup_floor !== undefined && editBookingData.pickup_floor !== null) {
            $('#pickupFloor').val(editBookingData.pickup_floor);
        } else if (editBookingData.floors !== undefined && editBookingData.floors !== null) {
            $('#pickupFloor').val(editBookingData.floors);
        }
        if (editBookingData.drop_floor !== undefined && editBookingData.drop_floor !== null) {
            $('#dropFloor').val(editBookingData.drop_floor);
        }
        if (editBookingData.pickup_lift !== undefined && editBookingData.pickup_lift !== null) {
            $('#pickupLift').prop('checked', parseInt(editBookingData.pickup_lift) === 1 || editBookingData.pickup_lift === true);
        }
        if (editBookingData.drop_lift !== undefined && editBookingData.drop_lift !== null) {
            $('#dropLift').prop('checked', parseInt(editBookingData.drop_lift) === 1 || editBookingData.drop_lift === true);
        }

        // Hide Step 4 (Confirm) in Edit Mode
        $('#step-dot-4').addClass('d-none');

        // Add hidden input for editing_booking_id
        if ($('#editing_booking_id').length === 0) {
            $('body').append('<input type="hidden" id="editing_booking_id" name="editing_booking_id" value="' + editBookingData.id + '">');
        }

        // Pre-fill items
        if (editBookingData.items && editBookingData.items.length > 0) {
            $.each(editBookingData.items, function(i, item) {
                let itemId = parseInt(item.item_id) || item.item_id;
                let qty = parseInt(item.quantity) || 0;
                if (qty > 0) {
                    let qtySpan = $('#item-qty-' + itemId);
                    let plusBtn = $('.qty-wiz-btn[data-action="plus"][data-id="' + itemId + '"]');
                    if (plusBtn.length === 0 && qtySpan.length) {
                        plusBtn = qtySpan.closest('.item-row-box').find('.qty-wiz-btn[data-action="plus"]');
                    }
                    let score = 1.0;
                    if (plusBtn.length) {
                        score = parseFloat(plusBtn.attr('data-weight')) || parseFloat(plusBtn.data('weight')) || 1.0;
                    } else if (item.calculated_volume_score && qty > 0) {
                        score = parseFloat(item.calculated_volume_score) / qty;
                    }

                    selectedItems[itemId] = { qty: qty, weight: score };

                    if (qtySpan.length) {
                        qtySpan.text(qty);
                        let card = qtySpan.closest('.item-row-box');
                        card.addClass('has-qty').css({'border-color': '#FC5D09', 'background-color': '#fff0f0'});
                        // Automatically expand parent accordion container so user sees selected item!
                        let accCollapse = card.closest('.accordion-collapse');
                        if (accCollapse.length) {
                            accCollapse.addClass('show');
                            accCollapse.prev('.accordion-header').find('.accordion-button').removeClass('collapsed').attr('aria-expanded', 'true');
                        }
                    }
                }
            });
        }

        // Pre-fill addons
        if (editBookingData.addons && editBookingData.addons.length > 0) {
            $.each(editBookingData.addons, function(i, addon) {
                let addonId = parseInt(addon.add_on_id) || addon.add_on_id;
                let chk = $('#addon-check-' + addonId);
                if (chk.length) {
                    chk.prop('checked', true);
                    chk.closest('.addon-selection-box').css({'border-color': '#FC5D09', 'background-color': '#fffafa'});
                }
            });
            handlePackagingMutualExclusion();
        }

        // Update titles and submit button for Edit Mode
        $('.breadcrumb-item.active').text('Edit Booking #' + editBookingData.booking_number);
        $('.btn-wizard-submit').html('<i class="bi bi-check-circle-fill me-1"></i> Update Shifting Booking');

        // Recalculate estimate with prefilled values
        calculateLiveEstimate();
    } else {
        // Auto-prefill quote details from Session / LocalStorage / URL params
        try {
            const lastQuote = <?= json_encode($last_quote_data ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
            const storedQuote = JSON.parse(localStorage.getItem('bhandari_quote_data') || '{}');
            const urlParams = new URLSearchParams(window.location.search);

            const pickup = urlParams.get('mfrom') || urlParams.get('pickup') || lastQuote.mfrom || storedQuote.mfrom;
            const drop   = urlParams.get('mto') || urlParams.get('drop') || lastQuote.mto || storedQuote.mto;
            const date   = urlParams.get('date') || urlParams.get('shifting_date') || lastQuote.date || storedQuote.date;
            const time   = urlParams.get('shifting_time') || lastQuote.shifting_time || storedQuote.shifting_time;
            const phone  = urlParams.get('phone') || lastQuote.phone || storedQuote.phone;

            if (pickup) {
                $('#wizardPickup').val(pickup);
                _isPickupValidWizard = true;
            }
            if (drop) {
                $('#wizardDrop').val(drop);
                _isDropValidWizard = true;
            }
            if (date) $('#wizardShiftingDate').val(date);
            if (time) $('#wizardShiftingTime').val(time);
            if (phone && !$('#wizardPhone').val()) $('#wizardPhone').val(phone);

            if (pickup && drop) {
                // Clear old stale lat/lon to force fresh geocoding & distance calculation for quote locations
                $('#web_pickup_lat').val('');
                $('#web_pickup_lon').val('');
                $('#web_drop_lat').val('');
                $('#web_drop_lon').val('');

                resolveAddressToCoordinates(pickup, null, function(latP, lonP) {
                    $('#web_pickup_lat').val(latP);
                    $('#web_pickup_lon').val(lonP);
                    
                    resolveAddressToCoordinates(drop, null, function(latD, lonD) {
                        $('#web_drop_lat').val(latD);
                        $('#web_drop_lon').val(lonD);
                        calculateWebRealDistanceKM();
                    });
                });
            }
        } catch(e) {}
    }

    // Prefill phone if user is already logged in
    $.getJSON('<?= site_url("user-auth/check-login") ?>', function(r) {
        if (r.logged_in && r.user && r.user.mobile) {
            $('#wizardPhone').val(r.user.mobile);
        } else {
            try {
                const stored = JSON.parse(localStorage.getItem('bhandari_user'));
                if (stored && stored.mobile) {
                    $('#wizardPhone').val(stored.mobile);
                }
            } catch(e) {}
        }
        calculateLiveEstimate();
        updateSelectedItemsUI();
        updateSelectedAddonsUI();
    });

    // Clean '?status=success' query parameter from URL history bar without page refresh
    const queryParams = new URLSearchParams(window.location.search);
    if (queryParams.get('status') === 'success') {
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: cleanUrl }, '', cleanUrl);
    }
    // Toggle Live Pricing Breakdown slide-up panel
    $(document).on('click', '#btnToggleBreakdown', function (e) {
        e.preventDefault();
        $('#priceBreakdownPanel').toggleClass('d-none');
    });

    $(document).on('click', '#btnCloseBreakdown', function (e) {
        e.preventDefault();
        $('#priceBreakdownPanel').addClass('d-none');
    });

    // Run initial check for packaging section exclusion
    handlePackagingMutualExclusion();

    // ─── Auto-save wizard inputs to localStorage on change ─────────────────────
    // Ensures form state persists even if user navigates away before payment
    $('#wizardPickup, #wizardDrop, #wizardShiftingDate, #wizardShiftingTime, #wizardPhone, #additional_comment')
        .on('change input blur', function() {
            saveBookingDraft();
        });
    $('#pickupFloor, #dropFloor').on('change input', function() {
        saveBookingDraft();
    });
    $('#pickupLift, #dropLift').on('change', function() {
        saveBookingDraft();
    });
    // ───────────────────────────────────────────────────────────────────────────

    // ─── Auto-navigate to a specific step ─────────────
    // Passed securely from PHP to avoid URL rewrite stripping issues
    <?php
        $target_step = $this->input->get('step');
        $target_step = is_numeric($target_step) ? intval($target_step) : 0;
    ?>
    const targetStepFromPHP = <?= $target_step ?>;
    if (targetStepFromPHP >= 2 && targetStepFromPHP <= 4) {
        setTimeout(function() { 
            switchStepTo(targetStepFromPHP); 
        }, 600); // 600ms delay ensures DOM items/addons are fully rendered
    }
    // ──────────────────────────────────────────────────
});

// Progress line updates helper
function updateProgressTracker(stepNum) {
    stepNum = parseInt(stepNum);
    
    // Update line fill
    let percent = ((stepNum - 1) / 3) * 100;
    $('.progress-line-fill').css('width', percent + '%');
    
    // Update steps
    $('.step-progress-item').each(function() {
        let s = parseInt($(this).data('step'));
        $(this).removeClass('active completed');
        let circle = $(this).find('.step-icon-circle');
        let label = $(this).find('.step-label-text');
        
        if (s === stepNum) {
            $(this).addClass('active');
            circle.html(s).removeClass('text-muted').addClass('fw-bold');
            label.removeClass('text-muted').addClass('fw-bold');
        } else if (s < stepNum) {
            $(this).addClass('completed');
            circle.html('<i class="bi bi-check-lg"></i>').removeClass('text-muted');
            label.removeClass('text-muted').addClass('fw-bold');
        } else {
            circle.html(s).addClass('text-muted').removeClass('fw-bold');
            label.addClass('text-muted').removeClass('fw-bold');
        }
    });
}

// Handle Wizard Step indicator click
$(document).on('click', '.step-progress-item', function (e) {
    e.preventDefault();
    const targetStep = parseInt($(this).data('step'));
    const currentStep = getCurrentStep();
    const isEditing = $('#editing_booking_id').val() || '';
    
    if (targetStep === currentStep) return;
    if (isEditing && targetStep === 4) return; // Block step 4 in edit mode
    
    // If moving forward, validate all intermediate steps
    if (targetStep > currentStep) {
        for (let s = currentStep + 1; s <= targetStep; s++) {
            if (!validateBeforeStep(s)) return;
        }
    }
    
    switchStepTo(targetStep);
});

// Sticky Prev button click handler
$(document).on('click', '#btnStickyPrev', function (e) {
    e.preventDefault();
    const currentStep = getCurrentStep();
    if (currentStep > 1) {
        switchStepTo(currentStep - 1);
    }
});

// Sticky Next button click handler
$(document).on('click', '#btnStickyNext', function (e) {
    e.preventDefault();
    const currentStep = getCurrentStep();
    const isEditing = $('#editing_booking_id').val() || '';

    // In edit mode, Step 3 (Add-ons) is the final step
    if (isEditing && currentStep === 3) {
        executeWizardSubmission();
        return;
    }

    if (currentStep < 4) {
        if (!validateBeforeStep(currentStep + 1)) return;

        if (currentStep === 3 && !isEditing) {
            saveBookingOnlyAndAdvance();
            return;
        }

        switchStepTo(currentStep + 1);
    } else {
        handleWizardSubmit();
    }
});

// Get current active step number
function getCurrentStep() {
    const activeStep = $('.step-progress-item.active');
    return parseInt(activeStep.data('step')) || 1;
}

// Validation check before moving to a step
function validateBeforeStep(stepNum) {
    stepNum = parseInt(stepNum);
    // Step 1 must be completed before going to step 2+
    if (stepNum >= 2) {
        const isEditing = ($('#editing_booking_id').length > 0) || (typeof editBookingData !== 'undefined' && editBookingData);

        // In edit mode: always allow tab 1 to 2, locations already set
        if (!isEditing) {
            let pVal = $('#wizardPickup').val() ? $('#wizardPickup').val().trim() : '';
            let dVal = $('#wizardDrop').val() ? $('#wizardDrop').val().trim() : '';

            if (!pVal || !dVal) {
                showSleekNoticeModal(
                    'Incomplete Locations',
                    'Please enter both <b>Pickup</b> and <b>Drop</b> locations to proceed.',
                    'Enter Locations',
                    'location'
                );
                if (!pVal) $('#wizardPickup').focus(); else $('#wizardDrop').focus();
                return false;
            }

            // ─── Must select location from suggestion dropdown list ───
            if (!_isPickupValidWizard) {
                showSleekNoticeModal(
                    'Select Pickup from Suggestions',
                    'Please select your pickup location from the <b>suggestions dropdown list</b>, rather than typing manually.',
                    'Select Suggestion',
                    'location'
                );
                $('#wizardPickup').focus();
                return false;
            }
            if (!_isDropValidWizard) {
                showSleekNoticeModal(
                    'Select Drop from Suggestions',
                    'Please select your drop location from the <b>suggestions dropdown list</b>, rather than typing manually.',
                    'Select Suggestion',
                    'location'
                );
                $('#wizardDrop').focus();
                return false;
            }

            // ─── Validate Delhi NCR Pickup & 300 KM Distance Limits ───
            if (typeof checkLocationAndDistanceRestrictions === 'function') {
                if (!checkLocationAndDistanceRestrictions()) {
                    return false;
                }
            }
            // ────────────────────────────────────────────────────────
        }

        // Ensure shifting date is set (auto-fill today if blank)
        let dtVal = $('#wizardShiftingDate').val() ? $('#wizardShiftingDate').val().trim() : '';
        const todayStr = (function() { var d = new Date(); return d.getFullYear() + '-' + String(d.getMonth()+1).padStart(2,'0') + '-' + String(d.getDate()).padStart(2,'0'); })();
        if (!dtVal) {
            dtVal = todayStr;
            $('#wizardShiftingDate').val(todayStr);
        }

        // Ensure shifting time is set
        let tmVal = $('#wizardShiftingTime').val() ? $('#wizardShiftingTime').val().trim() : '';
        if (!tmVal) {
            Swal.fire({
                icon: 'warning',
                title: 'Shifting Time Required!',
                text: 'Please select shifting time to proceed.',
                confirmButtonColor: '#FC5D09'
            });
            $('#wizardShiftingTime').focus();
            return false;
        }

        // Strict 2-hour minimum advance booking check for today
        if (dtVal === todayStr) {
            let selMin = parseTimeToMinutes(tmVal);
            let now = new Date();
            let nowMin = now.getHours() * 60 + now.getMinutes();
            let minAllowedMin = nowMin + 120; // +2 hours

            if (selMin >= 0 && selMin < minAllowedMin) {
                let currentStr = formatMinutesTo12Hour(nowMin);
                let earliestStr = minAllowedMin >= 1440 
                    ? 'No time slots left today. Please select tomorrow\'s date.' 
                    : formatMinutesTo12Hour(minAllowedMin);

                showSleekNoticeModal(
                    'Advance Booking (2 Hrs Minimum)',
                    'Orders must be scheduled at least <b>2 hours</b> in advance.<br><br>' +
                    '• Current Time: <b>' + currentStr + '</b><br>' +
                    '• Earliest Allowed Today: <b>' + earliestStr + '</b>',
                    'Select Valid Time',
                    'time'
                );
                $('#wizardShiftingTime').val('');
                if (typeof filterSelectTimeOptions === 'function') {
                    filterSelectTimeOptions('wizardShiftingDate', 'wizardShiftingTime');
                }
                $('#wizardShiftingTime').focus();
                return false;
            }
        }
    }
    // Step 2 (Items) must have at least 1 item selected before going to step 3+
    if (stepNum >= 3) {
        let totalQty = 0;
        for (let key in selectedItems) {
            totalQty += parseInt(selectedItems[key].qty || 0);
        }
        if (totalQty < 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Items Required!',
                text: 'Please select at least 1 item to shift before proceeding.',
                confirmButtonColor: '#FC5D09'
            });
            return false;
        }
    }
    return true;
}

function switchStepTo(stepNum) {
    stepNum = parseInt(stepNum);
    // Hide all step panels
    $('.wizard-step-panel').addClass('d-none');
    // Show target step panel
    $('#step-panel-' + stepNum).removeClass('d-none');
    
    // Update progress tracker dots/lines
    updateProgressTracker(stepNum);

    // Update sticky action footer buttons state
    if (stepNum === 1) {
        $('#btnStickyPrev').addClass('d-none');
        $('#btnStickyNext').html('Next Step: Items <i class="bi bi-arrow-right"></i>').removeClass('btn-success').addClass('btn-danger').css('background', '#FC5D09');
    } else if (stepNum === 2) {
        $('#btnStickyPrev').removeClass('d-none');
        $('#btnStickyNext').html('Next Step: Add-ons <i class="bi bi-arrow-right"></i>').removeClass('btn-success').addClass('btn-danger').css('background', '#FC5D09');
    } else if (stepNum === 3) {
        $('#btnStickyPrev').removeClass('d-none');
        const isEditing = $('#editing_booking_id').val() || '';
        if (isEditing) {
            $('#btnStickyNext').html('<i class="bi bi-check-circle-fill me-1"></i> Update Booking').removeClass('btn-danger').addClass('btn-success').css('background', '#2e7d32');
        } else {
            $('#btnStickyNext').html('Next Step: Confirm <i class="bi bi-arrow-right"></i>').removeClass('btn-danger').addClass('btn-success').css('background', '#2e7d32');
        }
    } else if (stepNum === 4) {
        $('#btnStickyPrev').removeClass('d-none');
        $('#btnStickyNext').html('<i class="bi bi-check-circle-fill me-1"></i> Confirm & Pay').removeClass('btn-danger').addClass('btn-success').css('background', '#2e7d32');
    }

    if (stepNum === 4) {
        $('.sticky-action-footer').addClass('is-step-4');
    } else {
        $('.sticky-action-footer').removeClass('is-step-4');
    }

    // Smooth scroll to wizard tabs top
    let wizardTop = $('#step-dot-1').length ? $('#step-dot-1').offset().top - 80 : 0;
    if (wizardTop > 0) {
        window.scrollTo({ top: wizardTop, behavior: 'smooth' });
    }
}

// Robust geocoding helper function
function resolveAddressToCoordinates(address, placeId, callback) {
    let placesService = null;
    if (placeId && typeof google !== 'undefined' && google.maps && google.maps.places) {
        placesService = new google.maps.places.PlacesService(document.createElement('div'));
    }

    if (placesService) {
        placesService.getDetails({
            placeId: placeId,
            fields: ['geometry']
        }, function (place, status) {
            if (status === google.maps.places.PlacesServiceStatus.OK && place && place.geometry && place.geometry.location) {
                const lat = place.geometry.location.lat();
                const lon = place.geometry.location.lng();
                callback(lat, lon);
            } else {
                tryGeocoder();
            }
        });
    } else {
        tryGeocoder();
    }

    function tryGeocoder() {
        if (typeof google !== 'undefined' && google.maps && google.maps.Geocoder) {
            const geocoder = new google.maps.Geocoder();
            const query = placeId ? { placeId: placeId } : { address: address };
            geocoder.geocode(query, function (results, status) {
                if (status === 'OK' && results[0] && results[0].geometry && results[0].geometry.location) {
                    const lat = results[0].geometry.location.lat();
                    const lon = results[0].geometry.location.lng();
                    callback(lat, lon);
                } else {
                    tryNominatim();
                }
            });
        } else {
            tryNominatim();
        }
    }

    function tryNominatim() {
        const nominatimUrl = 'https://nominatim.openstreetmap.org/search?q=' + encodeURIComponent(address) + '&format=json&limit=1';
        $.ajax({
            url: nominatimUrl,
            type: 'GET',
            headers: {
                'Accept-Language': 'en'
            },
            success: function(data) {
                if (data && data[0]) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);
                    callback(lat, lon);
                } else {
                    console.error('All coordinate resolution options failed.');
                }
            },
            error: function() {
                console.error('All coordinate resolution options failed.');
            }
        });
    }
}

// ── Website Location Autocomplete & Real-Time Driving KM Calculation ───────
function setupWebLocationAutocomplete(inputId, suggestionsId, latInputId, lonInputId, onSelectCallback) {
    let timer = null;
    const $input = $('#' + inputId);
    const $suggestions = $('#' + suggestionsId);

    // Google Maps services lazy loaded variables
    let autocompleteService = null;
    let geocoder = null;

    $input.on('keyup input focus', function () {
        clearTimeout(timer);
        if ($input.data('just-selected')) {
            $input.data('just-selected', false);
            $suggestions.hide();
            return;
        }
        const query = $(this).val().trim();
        if (query.length < 2) {
            $suggestions.hide().empty();
            return;
        }

        // Reset validation flag when user types manually
        if (inputId === 'wizardPickup') _isPickupValidWizard = false;
        if (inputId === 'wizardDrop')   _isDropValidWizard   = false;

        // Lazy initialize Google Maps services to ensure script is loaded first
        if (typeof google !== 'undefined' && google.maps && google.maps.places) {
            if (!autocompleteService) autocompleteService = new google.maps.places.AutocompleteService();
            if (!geocoder) geocoder = new google.maps.Geocoder();
        }

        if (!autocompleteService || !geocoder) {
            console.error('Google Maps API or Places library not loaded.');
            return;
        }

        timer = setTimeout(function () {
            autocompleteService.getPlacePredictions({
                input: query,
                componentRestrictions: { country: 'in' } // restrict to India
            }, function (predictions, status) {
                $suggestions.empty();
                if (status !== google.maps.places.PlacesServiceStatus.OK || !predictions || predictions.length === 0) {
                    $suggestions.hide();
                    return;
                }

                $.each(predictions, function (i, prediction) {
                    const mainTitle = prediction.structured_formatting.main_text || '';
                    const subTitle = prediction.structured_formatting.secondary_text || '';
                    const fullName = prediction.description;
                    const placeId = prediction.place_id;

                    const $item = $(
                        '<a href="#" class="dropdown-item py-2 px-3 border-bottom d-flex align-items-center gap-2" style="white-space:normal;">' +
                            '<div class="flex-shrink-0 bg-danger-subtle text-danger rounded-circle p-2 d-flex align-items-center justify-content-center" style="width:32px;height:32px;">' +
                                '<i class="bi bi-geo-alt-fill text-danger"></i>' +
                            '</div>' +
                            '<div class="flex-grow-1 overflow-hidden">' +
                                '<div class="fw-bold text-dark small text-truncate">' + mainTitle + '</div>' +
                                (subTitle ? '<div class="text-muted extra-small text-truncate" style="font-size:0.75rem;">' + subTitle + '</div>' : '') +
                            '</div>' +
                        '</a>'
                    );

                    $item.on('click', function (e) {
                        e.preventDefault();
                        $input.data('just-selected', true);
                        $input.val(fullName);
                        $input.data('last-resolved', fullName);
                        $suggestions.hide().empty();

                        // Mark location as valid when user selects from suggestions
                        if (typeof onSelectCallback === 'function') onSelectCallback();

                        resolveAddressToCoordinates(fullName, placeId, function(lat, lon) {
                            $('#' + latInputId).val(lat);
                            $('#' + lonInputId).val(lon);
                            calculateWebRealDistanceKM();
                        });
                    });

                    $suggestions.append($item);
                });
                $suggestions.show();
            });
        }, 250);
    });

    $input.on('blur', function() {
        setTimeout(function() {
            const val = $input.val().trim();
            const lastResolved = $input.data('last-resolved') || '';
            if (val && val !== lastResolved) {
                $input.data('last-resolved', val);
                resolveAddressToCoordinates(val, null, function(lat, lon) {
                    $('#' + latInputId).val(lat);
                    $('#' + lonInputId).val(lon);
                    calculateWebRealDistanceKM();
                });
            }
        }, 300);
    });

    $(document).on('click', function (e) {
        if (!$(e.target).closest('#' + inputId + ', #' + suggestionsId).length) {
            $suggestions.hide();
        }
    });
}

function isAllowedPickupLocation(addressStr) {
    if (!addressStr) return false;
    var str = addressStr.toLowerCase();
    var rawCities = window.allowedPickupCitiesStr || 'Delhi, Noida, Greater Noida, Gurugram, Gurgaon, Ghaziabad, Faridabad';
    var allowedKeywords = rawCities.split(',').map(function(c) { return c.trim().toLowerCase(); }).filter(function(c) { return c.length > 0; });
    
    var extraKeywords = [];
    allowedKeywords.forEach(function(kw) {
        if (kw === 'gurugram' || kw === 'gurgaon') {
            extraKeywords.push('gurugram', 'gurgaon');
        } else if (kw === 'delhi' || kw === 'new delhi') {
            extraKeywords.push('delhi', 'new delhi', 'ncr');
        } else if (kw === 'noida' || kw === 'greater noida') {
            extraKeywords.push('noida', 'greater noida', 'gautam buddh', 'gautam budh');
        }
    });
    allowedKeywords = allowedKeywords.concat(extraKeywords);

    for (var i = 0; i < allowedKeywords.length; i++) {
        if (allowedKeywords[i] !== '' && str.indexOf(allowedKeywords[i]) !== -1) {
            return true;
        }
    }
    return false;
}

function showSleekNoticeModal(title, htmlMessage, btnLabel, iconType) {
    var iconClass = 'bi-geo-alt-fill';
    var iconBg = '#fff1f0';
    var iconBorder = '#ffa39e';
    var iconColor = '#e02424';

    if (iconType === 'distance') {
        iconClass = 'bi-pin-map-fill';
        iconBg = '#fff7ed';
        iconBorder = '#ffedd5';
        iconColor = '#ea580c';
    } else if (iconType === 'time') {
        iconClass = 'bi-clock-history';
        iconBg = '#eff6ff';
        iconBorder = '#dbeafe';
        iconColor = '#2563eb';
    }

    Swal.fire({
        width: '380px',
        padding: '1.25rem 1rem',
        html:
            '<div style="text-align:center;">' +
            '  <div style="width:46px;height:46px;background:' + iconBg + ';border:1.5px solid ' + iconBorder + ';border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin:0 auto 10px;">' +
            '    <i class="bi ' + iconClass + '" style="color:' + iconColor + ';font-size:22px;"></i>' +
            '  </div>' +
            '  <h5 style="font-weight:700;color:#1e293b;font-size:1.02rem;margin-bottom:8px;line-height:1.3;">' + title + '</h5>' +
            '  <div style="font-size:0.84rem;color:#475569;line-height:1.45;margin-bottom:14px;text-align:left;background:#f8fafc;padding:10px 12px;border-radius:10px;border:1px solid #f1f5f9;">' + htmlMessage + '</div>' +
            '  <button id="sleekSwalBtn" style="background:linear-gradient(135deg,#FC5D09,#ff4b2b);color:#fff;border:none;border-radius:8px;padding:9px 20px;font-weight:700;font-size:0.86rem;cursor:pointer;width:100%;box-shadow:0 4px 12px rgba(252,93,9,0.25);">' +
            (btnLabel || 'OK, Got It') +
            '  </button>' +
            '</div>',
        showConfirmButton: false,
        allowOutsideClick: true,
        customClass: {
            container: 'swal2-top-zindex',
            popup: 'sleek-swal-compact'
        },
        didOpen: function() {
            var btn = document.getElementById('sleekSwalBtn');
            if (btn) {
                btn.addEventListener('click', function() {
                    Swal.close();
                });
            }
        }
    });
}

function checkLocationAndDistanceRestrictions() {
    var pVal = $('#wizardPickup').val() ? $('#wizardPickup').val().trim() : '';
    var dVal = $('#wizardDrop').val() ? $('#wizardDrop').val().trim() : '';
    var distVal = parseFloat($('#distanceRange').val()) || 0;
    var maxKm = window.maxRelocationDistanceKm || 300;
    var noticeCities = window.allowedPickupCitiesStr || 'Delhi, Noida, Greater Noida, Gurugram, Ghaziabad, Faridabad';

    // 1. Check Pickup Location
    if (pVal && !isAllowedPickupLocation(pVal)) {
        showSleekNoticeModal(
            'Pickup Service Unavailable',
            'Currently, our pickup relocation services operate exclusively from <b>' + noticeCities + '</b>.<br><br>We do not offer pickup services from your selected location.',
            'Change Pickup Location',
            'location'
        );
        $('#wizardPickup').val('');
        _isPickupValidWizard = false;
        $('#wizardPickup').focus();
        return false;
    }

    // 2. Check Distance
    if (pVal && dVal && distVal > maxKm) {
        showSleekNoticeModal(
            'Distance Exceeds Limit (Max ' + maxKm + ' KM)',
            'We currently provide relocation services up to <b>' + maxKm + ' KM</b> from pickup location.<br><br>Your route is <b>' + distVal + ' KM</b>, which exceeds our ' + maxKm + ' KM limit.',
            'Change Drop Location',
            'distance'
        );
        $('#wizardDrop').focus();
        return false;
    }

    return true;
}

setupWebLocationAutocomplete('wizardPickup', 'web_pickup_suggestions', 'web_pickup_lat', 'web_pickup_lon', function() { 
    _isPickupValidWizard = true; 
    checkLocationAndDistanceRestrictions();
});
setupWebLocationAutocomplete('wizardDrop', 'web_drop_suggestions', 'web_drop_lat', 'web_drop_lon', function() { 
    _isDropValidWizard = true; 
    calculateWebRealDistanceKM();
});

function calculateWebRealDistanceKM() {
    const pLat = parseFloat($('#web_pickup_lat').val());
    const pLon = parseFloat($('#web_pickup_lon').val());
    const dLat = parseFloat($('#web_drop_lat').val());
    const dLon = parseFloat($('#web_drop_lon').val());

    if (pLat && pLon && dLat && dLon) {
        const osrmUrl = `https://router.project-osrm.org/route/v1/driving/${pLon},${pLat};${dLon},${dLat}?overview=false`;
        $.getJSON(osrmUrl, function(data) {
            if (data && data.routes && data.routes[0]) {
                const km = (data.routes[0].distance / 1000).toFixed(1);
                $('#distanceRange').val(km);
                $('#distanceDisplay').val(km + ' KM');
                calculateLiveEstimate();
                checkLocationAndDistanceRestrictions();
            } else {
                fallbackWebHaversine(pLat, pLon, dLat, dLon);
            }
        }).fail(function() {
            fallbackWebHaversine(pLat, pLon, dLat, dLon);
        });
    } else {
        calculateLiveEstimate();
    }
}

function fallbackWebHaversine(lat1, lon1, lat2, lon2) {
    const R = 6371;
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
            Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    const d = R * c * 1.25;
    const km = Math.max(2, parseFloat(d.toFixed(1)));
    $('#distanceRange').val(km);
    $('#distanceDisplay').val(km + ' KM');
    calculateLiveEstimate();
    checkLocationAndDistanceRestrictions();
}

$('#distanceRange').on('input change', function() {
    const val = $(this).val();
    $('#distanceText').text(val);
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedAddonsUI();
});

// Shifting date listener for surges
$('#wizardShiftingDate').change(function() {
    saveBookingDraft();
    calculateLiveEstimate();
});

$('#wizardPickup, #wizardDrop, #wizardShiftingTime, #wizardPhone, #additional_comment, #pickupFloor, #dropFloor, #pickupLift, #dropLift').on('input change', function() {
    saveBookingDraft();
});

// Quantity controls
$(document).on('click', '.qty-wiz-btn', function () {
    const action = $(this).data('action');
    const itemId = $(this).data('id');
    const weight = parseFloat($(this).data('weight')) || 1;
    
    let currentQty = selectedItems[itemId] ? selectedItems[itemId].qty : 0;
    
    if (action === 'plus') {
        currentQty++;
    } else if (action === 'minus' && currentQty > 0) {
        currentQty--;
    }
    
    selectedItems[itemId] = { qty: currentQty, weight: weight };
    
    // Update display qty text
    $('#item-qty-' + itemId).text(currentQty);
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedItemsUI();
});

// Category Pill Navigation Click
$(document).on('click', '.cat-pill-btn', function () {
    $('.cat-pill-btn').removeClass('active');
    $(this).addClass('active');
    
    const catId = $(this).data('cat-id');
    const query = $('#itemSearchInput').val().trim();
    filterItemsView(catId, query);
});

// Search Input Listener
$(document).on('keyup input', '#itemSearchInput', function () {
    const query = $(this).val().trim();
    if (query.length > 0) {
        $('#btnClearItemSearch').removeClass('d-none');
    } else {
        $('#btnClearItemSearch').addClass('d-none');
    }
    const activeCatId = $('.cat-pill-btn.active').data('cat-id') || 'all';
    filterItemsView(activeCatId, query);
});

function resetItemSearch() {
    $('#itemSearchInput').val('');
    $('#btnClearItemSearch').addClass('d-none');
    const activeCatId = $('.cat-pill-btn.active').data('cat-id') || 'all';
    filterItemsView(activeCatId, '');
}

function filterItemsView(catId, searchQuery) {
    searchQuery = searchQuery.toLowerCase();
    let totalVisible = 0;
    
    $('.category-panel-block').each(function () {
        const panelCatId = $(this).data('cat-id');
        let panelMatchCount = 0;
        
        if (catId === 'all' || catId == panelCatId) {
            $(this).find('.item-card-wrapper').each(function () {
                const itemName = ($(this).data('item-name') || '').toString();
                if (searchQuery === '' || itemName.includes(searchQuery)) {
                    $(this).removeClass('d-none');
                    panelMatchCount++;
                    totalVisible++;
                } else {
                    $(this).addClass('d-none');
                }
            });
            
            if (panelMatchCount > 0) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        } else {
            $(this).addClass('d-none');
        }
    });
    
    if (totalVisible === 0) {
        $('#searchQueryText').text(searchQuery);
        $('#noItemsFoundMsg').removeClass('d-none');
        $('#itemsCategoryContainer').addClass('d-none');
    } else {
        $('#noItemsFoundMsg').addClass('d-none');
        $('#itemsCategoryContainer').removeClass('d-none');
    }
}

function updateSelectedItemsUI() {
    let totalQty = 0;
    const catQtyMap = {};
    const chipsHtml = [];

    $('.qty-wiz-btn[data-action="plus"]').each(function () {
        const itemId = $(this).data('id');
        const itemName = $(this).data('name') || $('#item-box-' + itemId + ' .item-title-text').text().trim() || ('Item #' + itemId);
        const catId = $(this).data('cat-id');
        const qty = parseInt($('#item-qty-' + itemId).text()) || 0;
        const box = $('#item-box-' + itemId);

        if (qty > 0) {
            totalQty += qty;
            catQtyMap[catId] = (catQtyMap[catId] || 0) + qty;
            
            if (box.length) {
                box.css({'border-color': '#FC5D09', 'background-color': '#fff0f0'}).addClass('has-qty');
            }

            chipsHtml.push(`
                <span class="item-chip shadow-sm">
                    ${escapeHtml(itemName)} 
                    <span class="badge bg-danger ms-1">${qty}</span>
                    <i class="bi bi-x-circle-fill chip-remove ms-1" onclick="removeItemQty(${itemId})"></i>
                </span>
            `);
        } else {
            if (box.length) {
                box.css({'border-color': '#dee2e6', 'background-color': '#ffffff'}).removeClass('has-qty');
            }
        }
    });

    // Update Pills Badges
    $('.pill-selected-badge').addClass('d-none').text('0');
    if (totalQty > 0) {
        $('#cat-badge-all').removeClass('d-none').text(totalQty);
        for (let cId in catQtyMap) {
            $('#cat-badge-' + cId).removeClass('d-none').text(catQtyMap[cId]);
        }
        $('#selectedItemsTotalQty').text(totalQty);
        $('#selectedItemsChipsContainer').html(chipsHtml.join(''));
        $('#selectedItemsChipBar').removeClass('d-none');
    } else {
        $('#selectedItemsChipBar').addClass('d-none');
    }
}

function escapeHtml(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function removeItemQty(itemId) {
    $('#item-qty-' + itemId).text('0');
    const plusBtn = $('.qty-wiz-btn[data-action="plus"][data-id="' + itemId + '"]');
    const weight = parseFloat(plusBtn.data('weight')) || 1;
    selectedItems[itemId] = { qty: 0, weight: weight };
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedItemsUI();
}

function clearAllSelectedItems() {
    for (let key in selectedItems) {
        selectedItems[key].qty = 0;
        $('#item-qty-' + key).text('0');
    }
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedItemsUI();
}

// Addon Category Pill Navigation Click
$(document).on('click', '.addon-cat-pill-btn', function () {
    $('.addon-cat-pill-btn').removeClass('active');
    $(this).addClass('active');
    
    const catId = $(this).data('cat-id');
    const query = $('#addonSearchInput').val().trim();
    filterAddonsView(catId, query);
});

// Addon Search Input Listener
$(document).on('keyup input', '#addonSearchInput', function () {
    const query = $(this).val().trim();
    if (query.length > 0) {
        $('#btnClearAddonSearch').removeClass('d-none');
    } else {
        $('#btnClearAddonSearch').addClass('d-none');
    }
    const activeCatId = $('.addon-cat-pill-btn.active').data('cat-id') || 'all';
    filterAddonsView(activeCatId, query);
});

function resetAddonSearch() {
    $('#addonSearchInput').val('');
    $('#btnClearAddonSearch').addClass('d-none');
    const activeCatId = $('.addon-cat-pill-btn.active').data('cat-id') || 'all';
    filterAddonsView(activeCatId, '');
}

function filterAddonsView(catId, searchQuery) {
    searchQuery = searchQuery.toLowerCase();
    let totalVisible = 0;
    
    $('.addon-category-panel-block').each(function () {
        const panelCatId = $(this).data('cat-id');
        let panelMatchCount = 0;
        
        if (catId === 'all' || catId == panelCatId) {
            $(this).find('.addon-card-wrapper').each(function () {
                const addonName = ($(this).data('addon-name') || '').toString();
                if (searchQuery === '' || addonName.includes(searchQuery)) {
                    $(this).removeClass('d-none');
                    panelMatchCount++;
                    totalVisible++;
                } else {
                    $(this).addClass('d-none');
                }
            });
            
            if (panelMatchCount > 0) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        } else {
            $(this).addClass('d-none');
        }
    });
    
    if (totalVisible === 0) {
        $('#addonSearchQueryText').text(searchQuery);
        $('#noAddonsFoundMsg').removeClass('d-none');
        $('#addonsCategoryContainer').addClass('d-none');
    } else {
        $('#noAddonsFoundMsg').addClass('d-none');
        $('#addonsCategoryContainer').removeClass('d-none');
    }
}

function updateSelectedAddonsUI() {
    let totalCount = 0;
    const catQtyMap = {};
    const chipsHtml = [];

    $('.addon-wizard-chk:checked').each(function () {
        const addonId = $(this).data('addon-id');
        const addonName = $(this).data('addon-name') || $('#addon-box-' + addonId + ' .addon-title-text').text().trim() || ('Addon #' + addonId);
        const catId = $(this).data('cat-id');

        totalCount++;
        catQtyMap[catId] = (catQtyMap[catId] || 0) + 1;

        chipsHtml.push(`
            <span class="item-chip shadow-sm">
                ${escapeHtml(addonName)} 
                <i class="bi bi-x-circle-fill chip-remove ms-1" onclick="removeAddonCheck(${addonId})"></i>
            </span>
        `);
    });

    // Update Pill Badges
    $('.addon-pill-selected-badge').addClass('d-none').text('0');
    if (totalCount > 0) {
        $('#addon-cat-badge-all').removeClass('d-none').text(totalCount);
        for (let cId in catQtyMap) {
            $('#addon-cat-badge-' + cId).removeClass('d-none').text(catQtyMap[cId]);
        }
        $('#selectedAddonsTotalQty').text(totalCount);
        $('#selectedAddonsChipsContainer').html(chipsHtml.join(''));
        $('#selectedAddonsChipBar').removeClass('d-none');
    } else {
        $('#selectedAddonsChipBar').addClass('d-none');
    }
}

function removeAddonCheck(addonId) {
    const chk = document.getElementById('addon-check-' + addonId);
    if (chk) {
        chk.checked = false;
        const box = chk.closest('.addon-selection-box');
        if (box) {
            box.style.borderColor = '#dee2e6';
            box.style.backgroundColor = '#ffffff';
        }
    }
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedAddonsUI();
}

function clearAllSelectedAddons() {
    $('.addon-wizard-chk').prop('checked', false);
    $('.addon-selection-box').css({'border-color': '#dee2e6', 'background-color': '#ffffff'});
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedAddonsUI();
}

// Toggle Addon check manually
function toggleAddonChecked(checkboxId) {
    if (window.event && (window.event.target.classList.contains('qty-addon-btn') || window.event.target.closest('.addon-qty-container'))) {
        return;
    }
    const chk = document.getElementById(checkboxId);
    if (!chk || chk.disabled) return;
    chk.checked = !chk.checked;
    
    // Style toggle
    const box = chk.closest('.addon-selection-box');
    if (chk.checked) {
        box.style.borderColor = '#FC5D09';
        box.style.backgroundColor = '#fffafa';
        $(box).find('.addon-qty-container').removeClass('d-none');
    } else {
        box.style.borderColor = '#dee2e6';
        box.style.backgroundColor = '#fff';
        $(box).find('.addon-qty-container').addClass('d-none');
        $(box).find('.addon-qty-display').text('1');
    }
    
    handlePackagingMutualExclusion(chk);
    calculateLiveEstimate();
    updateSelectedAddonsUI();
}

$(document).on('change', '.addon-wizard-chk', function() {
    const box = this.closest('.addon-selection-box');
    if (this.checked) {
        $(box).find('.addon-qty-container').removeClass('d-none');
    } else {
        $(box).find('.addon-qty-container').addClass('d-none');
        $(box).find('.addon-qty-display').text('1');
    }
    saveBookingDraft();
    calculateLiveEstimate();
    updateSelectedAddonsUI();
});

$(document).on('click', '.qty-addon-btn', function(e) {
    e.preventDefault();
    e.stopPropagation();
    const action = $(this).attr('data-action') || $(this).data('action');
    const addonId = $(this).attr('data-id') || $(this).data('id');
    
    let currentQty = parseInt($('#addon-qty-' + addonId).text()) || 1;
    
    if (action === 'plus') {
        currentQty++;
    } else if (action === 'minus' && currentQty > 1) {
        currentQty--;
    }
    
    $('#addon-qty-' + addonId).text(currentQty);
    saveBookingDraft();
    calculateLiveEstimate();
});

function handlePackagingMutualExclusion(changedInput) {
    if (!changedInput) {
        // Called without parameter (e.g. on page load).
        // For each packing category, keep only the first checked option
        const checkedCategories = {};
        $('.addon-wizard-chk').filter(function() {
            const cName = $(this).attr('data-category-name') || '';
            return cName.includes('pack') || cName.includes('paking');
        }).each(function() {
            if (this.checked) {
                const catName = $(this).attr('data-category-name');
                if (checkedCategories[catName]) {
                    this.checked = false;
                    const $box = $(this).closest('.addon-selection-box');
                    $box.css({
                        'border-color': '#dee2e6',
                        'background-color': '#fff'
                    });
                } else {
                    checkedCategories[catName] = true;
                }
            }
        });
        return;
    }

    // If the changed input is not checked, do nothing
    if (!changedInput.checked) return;
    
    const catName = $(changedInput).attr('data-category-name') || '';
    const isPackingCategory = catName.includes('pack') || catName.includes('paking');
                      
    if (isPackingCategory) {
        // Find all other checkboxes in the SAME category
        const $otherChks = $('.addon-wizard-chk').filter(function() {
            const cName = $(this).attr('data-category-name') || '';
            return cName === catName && this.id !== changedInput.id;
        });
        
        // Uncheck them and reset their styles
        $otherChks.each(function() {
            if (this.checked) {
                this.checked = false;
                const $box = $(this).closest('.addon-selection-box');
                $box.css({
                    'border-color': '#dee2e6',
                    'background-color': '#fff'
                });
            }
        });
    }
}

// Live pricing calculator logic
function isTimeInRange(time, start, end) {
    if (!time || !start || !end) return true;
    const t = time.substring(0, 5);
    const s = start.substring(0, 5);
    const e = end.substring(0, 5);
    if (s <= e) {
        return (t >= s && t <= e);
    }
    return (t >= s || t <= e);
}

function calculateLiveEstimate() {
    let totalScore = 0;
    
    // Calculate total score of selected items
    for (let key in selectedItems) {
        totalScore += (selectedItems[key].qty * selectedItems[key].weight);
    }
    
    $('#wizardScoreVal').text(parseFloat(totalScore).toFixed(2));
    
    // Check if score exceeds threshold
    if (totalScore > 310) {
        $('#wizSurveyWarning').removeClass('d-none');
        $('#wizTotalAmount').text('Survey Req.');
        $('#wizTotalInput').val(0);
        
        // Update sticky action footer elements
        $('#stickyTotalAmount').text('Survey Req.');
        $('#stickyVehicleText').text('Exceeds Limit');
        $('#stickyCategoryText').text('Survey Required');
        
        // Reset horizontal breakdown details
        $('#lblBase, #lblVol, #lblDist, #lblAddon, #lblFloor').text('—');
        $('#lblSurgeRow').addClass('d-none');
        return;
    } else {
        $('#wizSurveyWarning').addClass('d-none');
    }
    
    // Match shifting category based on total score
    let category = null;
    let targetScore = parseFloat(totalScore);
    for (let i = 0; i < shiftingCategories.length; i++) {
        let cat = shiftingCategories[i];
        let minS = parseFloat(cat.min_score);
        let maxS = parseFloat(cat.max_score);
        // Since database max_score is integer (e.g., 22), any score > 22 (like 22.25) belongs to the next category.
        // We match if targetScore is less than or equal to the category's max score, since categories are sorted.
        if (targetScore <= maxS) {
            category = cat;
            break;
        }
    }
    
    if (!category && shiftingCategories.length > 0) {
        console.log("No category matched. Falling back to index 0:", shiftingCategories[0].category_name);
        category = shiftingCategories[0]; // fallback
    }
    
    if (!category) return;
    
    $('#wizCategoryText').text(category.category_name);
    
    // Vehicles: dynamically sourced from the category linked vehicle
    let vehicleName = category.vehicle_name ? category.vehicle_name : '';
    $('#wizVehicleText').text(vehicleName);


    // Calculate Base Fare and Point-Based Fare separately
    let baseFare = parseFloat(category.base_fare) || 0;
    let pricePerPoint = parseFloat(category.price_per_point) || 0;
    let pointBasedFare = 0;
    
    $('#wizBaseFare').text('₹' + baseFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    if (pricePerPoint > 0) {
        pointBasedFare = (totalScore * pricePerPoint);
        $('#wizPointFareExpl').text('');
        $('#wizPointFare').text('₹' + pointBasedFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
        $('#wizPointFareRow').show();
    } else {
        $('#wizPointFareExpl').text('');
        $('#wizPointFare').text('₹0.00');
        $('#wizPointFareRow').hide();
    }

    // Distance charges using admin-configured per_km_rate and base_distance_km
    const distanceVal = parseFloat($('#distanceRange').val()) || 10;
    const perKmRate = pricingSettings.per_km_rate || 20;
    const baseDistanceKm = pricingSettings.base_distance_km || 5;
    let distanceCharges = 0;
    if (distanceVal > baseDistanceKm) {
        distanceCharges = (distanceVal - baseDistanceKm) * perKmRate;
    }
    $('#wizDistanceFare').text('₹' + distanceCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    // Total quantity of all selected items
    let totalItemsQty = 0;
    for (let key in selectedItems) {
        totalItemsQty += selectedItems[key].qty;
    }

    // Addons charges
    let addonCharges = 0;
    $('.addon-wizard-chk').each(function () {
        let addonId = $(this).data('addon-id');
        let priceType = $(this).data('price-type');
        let defaultPrice = parseFloat($(this).data('price')) || 0;
        let unitPrice = defaultPrice;

        if (category && category.id && typeof addonCategoryPrices !== 'undefined') {
            let catOverride = addonCategoryPrices.find(cp => cp.add_on_id == addonId && cp.category_id == category.id);
            if (catOverride && catOverride.price !== null && catOverride.price !== '') {
                unitPrice = parseFloat(catOverride.price);
            }
        }

        // Update badge text dynamically
        let badge = $('.addon-badge-' + addonId);
        let qty = parseInt($('#addon-qty-' + addonId).text()) || 1;

        if (badge.length) {
            badge.text('+₹' + Math.round(unitPrice * qty));
        }

        if ($(this).is(':checked')) {
            addonCharges += (unitPrice * qty);
        }
    });
    $('#wizAddonsFare').text('₹' + addonCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    if ($('#wizAddonsFareDisplay').length) {
        $('#wizAddonsFareDisplay').text('₹' + addonCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    }

    // Floors charges using admin-configured per_floor_charge
    const pickupFlr = parseInt($('#pickupFloor').val()) || 0;
    const dropFlr = parseInt($('#dropFloor').val()) || 0;
    const hasPickupLift = $('#pickupLift').is(':checked');
    const hasDropLift = $('#dropLift').is(':checked');
    const perFloorCharge = pricingSettings.per_floor_charge || 150;
    
    let floorCharges = 0;
    if (!hasPickupLift && pickupFlr > 0) {
        floorCharges += (pickupFlr * perFloorCharge);
    }
    if (!hasDropLift && dropFlr > 0) {
        floorCharges += (dropFlr * perFloorCharge);
    }
    $('#wizFloorFare').text('₹' + floorCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    // Surges & Peak Time Surcharge / Discount
    let weekendSurge = 0;
    let monthEndSurge = 0;
    let peakTimeSurge = 0;
    const dateStr = $('#wizardShiftingDate').val();
    const timeStr = $('#wizardShiftingTime').val();
    
    // Get surcharge percentages: category-level first, then global setting, then hardcoded default
    const weekendSurchargePct = (parseFloat(category.weekend_surcharge_percent) > 0)
        ? parseFloat(category.weekend_surcharge_percent) / 100
        : (pricingSettings.weekend_surge_percentage || 10) / 100;
    const monthEndSurchargePct = (parseFloat(category.month_end_surcharge_percent) > 0)
        ? parseFloat(category.month_end_surcharge_percent) / 100
        : (pricingSettings.month_end_surge_percentage || 15) / 100;

    const catPeakPercent = parseFloat(category.peak_time_surcharge_percent) || 0;
    const globalPeakPercent = parseFloat(pricingSettings.peak_time_surge_percentage) || 0;
    const peakEnabled = (catPeakPercent !== 0) || (pricingSettings.peak_time_enabled && globalPeakPercent !== 0);
    const peakPercentVal = (catPeakPercent !== 0) ? catPeakPercent : globalPeakPercent;

    const peakStart = category.peak_time_start || pricingSettings.peak_time_start || '';
    const peakEnd = category.peak_time_end || pricingSettings.peak_time_end || '';
    const peakStartDate = pricingSettings.peak_time_start_date || '';
    const peakEndDate = pricingSettings.peak_time_end_date || '';

    const surchargeBase = baseFare + distanceCharges;

    if (dateStr) {
        const parts = dateStr.split('-');
        const dateObj = new Date(parseInt(parts[0]), parseInt(parts[1]) - 1, parseInt(parts[2]));

        // Weekend Surcharge
        const day = dateObj.getDay();
        if (day === 0 || day === 6) { // Sunday or Saturday
            weekendSurge = surchargeBase * weekendSurchargePct;
            $('#wizWeekendRow span:first-child').text('Weekend Surge (' + Math.round(weekendSurchargePct * 100) + '%)');
            $('#wizWeekendFare').text('₹' + weekendSurge.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#wizWeekendRow').show();
        } else {
            $('#wizWeekendRow').hide();
        }
        
        // Month End Surcharge
        const dayOfMonth = dateObj.getDate();
        const lastDayOfMonth = new Date(dateObj.getFullYear(), dateObj.getMonth() + 1, 0).getDate();
        if (dayOfMonth >= (lastDayOfMonth - 2) || dayOfMonth <= 2) {
            monthEndSurge = surchargeBase * monthEndSurchargePct;
            $('#wizMonthEndRow span:first-child').text('Month-End Surge (' + Math.round(monthEndSurchargePct * 100) + '%)');
            $('#wizMonthEndFare').text('₹' + monthEndSurge.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#wizMonthEndRow').show();
        } else {
            $('#wizMonthEndRow').hide();
        }
    } else {
        $('#wizWeekendRow').hide();
        $('#wizMonthEndRow').hide();
    }

    // Peak Time Surcharge / Discount Calculation
    if (peakEnabled) {
        let isDateMatch = true;
        if (peakStartDate && peakEndDate && dateStr) {
            isDateMatch = (dateStr >= peakStartDate && dateStr <= peakEndDate);
        }

        let isTimeMatch = true;
        if (peakStart && peakEnd && timeStr) {
            isTimeMatch = isTimeInRange(timeStr, peakStart, peakEnd);
        }

        if (isDateMatch && isTimeMatch) {
            peakTimeSurge = surchargeBase * (peakPercentVal / 100);
            
            const isDiscount = peakPercentVal < 0;
            const labelText = isDiscount 
                ? 'Peak Time Discount (' + peakPercentVal + '%)' 
                : 'Peak Time Surcharge (' + peakPercentVal + '%)';
            const textClass = isDiscount ? 'text-success' : 'text-danger';
            const farePrefix = isDiscount ? '-₹' : '+₹';
            const absFare = Math.abs(peakTimeSurge);

            $('#wizPeakRow span:first-child').text(labelText);
            $('#wizPeakFare').text(farePrefix + absFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#wizPeakRow').show();

            $('#breakdownPeakLabel').text(labelText);
            $('#breakdownPeakFare').text(farePrefix + absFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#breakdownPeakRow').removeClass('d-none text-danger text-success').addClass(textClass);

            $('#lblPeakLabel').text(isDiscount ? 'Discount:' : 'Peak:');
            $('#lblPeak').text(farePrefix + Math.round(absFare));
            $('#lblPeakRow').removeClass('d-none text-danger text-success').addClass(textClass);
        } else {
            $('#wizPeakRow').hide();
            $('#breakdownPeakRow').addClass('d-none');
            $('#lblPeakRow').addClass('d-none');
        }
    } else {
        $('#wizPeakRow').hide();
        $('#breakdownPeakRow').addClass('d-none');
        $('#lblPeakRow').addClass('d-none');
    }

    // Round all individual charge components to 2 decimal places
    baseFare = Math.round(baseFare * 100) / 100;
    pointBasedFare = Math.round(pointBasedFare * 100) / 100;
    distanceCharges = Math.round(distanceCharges * 100) / 100;
    addonCharges = Math.round(addonCharges * 100) / 100;
    floorCharges = Math.round(floorCharges * 100) / 100;
    weekendSurge = Math.round(weekendSurge * 100) / 100;
    monthEndSurge = Math.round(monthEndSurge * 100) / 100;
    peakTimeSurge = Math.round(peakTimeSurge * 100) / 100;

    const grandTotal = Math.max(0, baseFare + pointBasedFare + distanceCharges + addonCharges + floorCharges + weekendSurge + monthEndSurge + peakTimeSurge);
    $('#wizTotalAmount').text('₹' + grandTotal.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    $('#wizTotalInput').val(grandTotal.toFixed(2));

    // Update sticky action footer elements
    $('#stickyTotalAmount').text($('#wizTotalAmount').text());
    $('#stickyVehicleText').text(vehicleName || '');
    $('#stickyCategoryText').text(category ? category.category_name : '');

    // Update horizontal breakdown list
    $('#lblBase').text('₹' + baseFare.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
    $('#lblVol').text('₹' + pointBasedFare.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
    $('#lblDist').text('₹' + distanceCharges.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
    $('#lblAddon').text('₹' + addonCharges.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
    $('#lblFloor').text('₹' + floorCharges.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));

    let totalSurge = weekendSurge + monthEndSurge;
    if (totalSurge > 0) {
        $('#lblSurgeRow').removeClass('d-none');
        $('#lblSurge').text('₹' + totalSurge.toLocaleString('en-IN', { minimumFractionDigits: 0, maximumFractionDigits: 0 }));
    } else {
        $('#lblSurgeRow').addClass('d-none');
    }

    // Synchronize price breakdown panel details
    $('#breakdownBaseFare').text('₹' + baseFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    $('#breakdownVolumeCharge').text('₹' + pointBasedFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    $('#breakdownDistanceFare').text('₹' + distanceCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    $('#breakdownAddonsFare').text('₹' + addonCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    $('#breakdownFloorFare').text('₹' + floorCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    if (weekendSurge > 0) {
        $('#breakdownWeekendRow').removeClass('d-none');
        $('#breakdownWeekendFare').text('₹' + weekendSurge.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    } else {
        $('#breakdownWeekendRow').addClass('d-none');
    }
    if (monthEndSurge > 0) {
        $('#breakdownMonthEndRow').removeClass('d-none');
        $('#breakdownMonthEndFare').text('₹' + monthEndSurge.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    } else {
        $('#breakdownMonthEndRow').addClass('d-none');
    }
    $('#breakdownTotalAmount').text($('#wizTotalAmount').text());
}

// Submission trigger handling
function handleWizardSubmit() {
    // 1. Validation
    let totalQty = 0;
    for (let key in selectedItems) {
        totalQty += (selectedItems[key].qty || 0);
    }
    if (totalQty < 1) {
        Swal.fire({
            icon: 'warning',
            title: 'At Least 1 Item Required!',
            text: 'You must select at least 1 item to shift before confirming your booking.',
            confirmButtonColor: '#FC5D09'
        });
        return;
    }

    let phone = $('#wizardPhone').val() ? $('#wizardPhone').val().trim() : '';
    let loggedMobile = '<?= ($web_user_session && !empty($web_user_session['mobile'])) ? htmlspecialchars($web_user_session['mobile']) : '' ?>';
    if (!phone && loggedMobile) {
        phone = loggedMobile;
        $('#wizardPhone').val(phone);
    }

    // 2. Check if user is logged in
    $.getJSON('<?= site_url("user-auth/check-login") ?>', function(r) {
        if (r.logged_in) {
            if (r.user && r.user.mobile) {
                $('#wizardPhone').val(r.user.mobile);
            }
            executeWizardSubmission();
        } else {
            // Not logged in. Queue wizard submission
            window._pendingWizardSubmit = true;
            openLoginModal();
        }
    });
}

// Execute AJAX backend submission
// Execute AJAX backend submission
function executeWizardSubmission(paymentId, orderId) {
    const editingId = $('#editing_booking_id').val() || '';
    
    // If it's editing mode, we submit immediately as before because editing is a direct update
    if (editingId) {
        saveBookingDetails(editingId, paymentId, orderId);
        return;
    }
    
    // For a new booking, we save to the database FIRST
    saveNewBookingAndPay();
}

function showToast(message, type = 'success') {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: type,
        title: message,
        showConfirmButton: false,
        timer: 2600,
        timerProgressBar: true,
        background: '#fff',
        customClass: {
            popup: 'swal2-toast-custom'
        }
    });
}

function openRegistrationPayment(bookingId, fee) {
    if (typeof Razorpay === 'undefined') {
        showToast('Loading Razorpay payment gateway...', 'info');
        var script = document.createElement('script');
        script.src = 'https://checkout.razorpay.com/v1/checkout.js';
        script.onload = function() {
            openRegistrationPayment(bookingId, fee);
        };
        script.onerror = function() {
            showToast('Failed to load Razorpay payment gateway. Please check your internet connection.', 'error');
        };
        document.head.appendChild(script);
        return;
    }
    const options = {
        "key": "<?= defined('RAZORPAY_KEY_ID') ? RAZORPAY_KEY_ID : 'rzp_live_TFidvL3276AhNp' ?>",
        "amount": Math.round(fee * 100), // in paise
        "currency": "INR",
        "name": "Bhandari Packers and Movers",
        "description": "Booking Fees",
        "image": "<?= base_url('assets/images/logo/logo.jpg') ?>",
        "handler": function (response) {
            updateRegistrationPaymentStatus(bookingId, 'paid', response.razorpay_payment_id, response.razorpay_order_id || 'order_' + new Date().getTime());
        },
        "prefill": {
            "contact": $('#wizardPhone').val()
        },
        "theme": {
            "color": "#FC5D09"
        }
    };
    const rzp = new Razorpay(options);
    rzp.on('payment.failed', function (response){
        updateRegistrationPaymentStatus(bookingId, 'failed');
        showToast(response.error.description || 'Booking Fees payment failed. Please try again.', 'error');
    });
    rzp.open();
}

function saveBookingOnlyAndAdvance() {
    showToast('Saving shifting details...', 'info');

    const addonsData = [];
    $('.addon-wizard-chk:checked').each(function () {
        const addonId = $(this).attr('id').replace('addon-check-', '');
        let qty = parseInt($('#addon-qty-' + addonId).text()) || 1;
        addonsData.push({ id: addonId, qty: qty });
    });

    const formData = {
        editing_booking_id: '',
        pickup_location: $('#wizardPickup').val(),
        drop_location: $('#wizardDrop').val(),
        shifting_date: $('#wizardShiftingDate').val(),
        shifting_time: $('#wizardShiftingTime').val(),
        phone_number: $('#wizardPhone').val(),
        estimated_amount: $('#wizTotalInput').val(),
        razorpay_payment_id: '',
        razorpay_order_id: '',
        distance_km: $('#distanceRange').val(),
        pickup_floor: $('#pickupFloor').val() || 0,
        drop_floor: $('#dropFloor').val() || 0,
        pickup_lift: $('#pickupLift').is(':checked') ? 1 : 0,
        drop_lift: $('#dropLift').is(':checked') ? 1 : 0,
        items_json: JSON.stringify(selectedItems),
        addons_json: JSON.stringify(addonsData),
        remarks: $('#additional_comment').val() || ''
    };

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/submit-online-booking") ?>',
        data: formData,
        success: function (r) {
            try {
                let res = (typeof r === 'string') ? JSON.parse(r) : r;
                if (res && res.status === true && res.booking_id) {
                    const bookingId = res.booking_id;
                    const fee = res.registration_fee || defaultRegFee;
                    window.lastSavedBookingId = bookingId;
                    window.lastPaidRegFee = fee;
                    window.bookingSavedForPayment = true;
                    // Do NOT clear draft here — draft persists until actual payment is completed
                    showToast('Booking saved. Proceed to final payment.', 'success');
                    switchStepTo(4);
                    return;
                }
                showToast((res && res.message) || 'Could not save booking details.', 'error');
            } catch(e) {
                showToast(typeof r === 'string' ? r : 'Could not save booking details.', 'error');
            }
        },
        error: function () {
            showToast('Booking save failed. Please try again.', 'error');
        }
    });
}

function saveNewBookingAndPay() {
    if (window.bookingSavedForPayment && window.lastSavedBookingId) {
        const fee = window.lastPaidRegFee || defaultRegFee;
        openRegistrationPayment(window.lastSavedBookingId, fee);
        return;
    }

    showToast('Saving shifting details...', 'info');

    const addonsData = [];
    $('.addon-wizard-chk:checked').each(function () {
        const addonId = $(this).attr('id').replace('addon-check-', '');
        let qty = parseInt($('#addon-qty-' + addonId).text()) || 1;
        addonsData.push({ id: addonId, qty: qty });
    });

    const formData = {
        editing_booking_id: '',
        pickup_location: $('#wizardPickup').val(),
        drop_location: $('#wizardDrop').val(),
        shifting_date: $('#wizardShiftingDate').val(),
        shifting_time: $('#wizardShiftingTime').val(),
        phone_number: $('#wizardPhone').val(),
        estimated_amount: $('#wizTotalInput').val(),
        razorpay_payment_id: '',
        razorpay_order_id: '',
        distance_km: $('#distanceRange').val(),
        pickup_floor: $('#pickupFloor').val() || 0,
        drop_floor: $('#dropFloor').val() || 0,
        pickup_lift: $('#pickupLift').is(':checked') ? 1 : 0,
        drop_lift: $('#dropLift').is(':checked') ? 1 : 0,
        items_json: JSON.stringify(selectedItems),
        addons_json: JSON.stringify(addonsData),
        remarks: $('#additional_comment').val() || ''
    };

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/submit-online-booking") ?>',
        data: formData,
        success: function (r) {
            try {
                let res = (typeof r === 'string') ? JSON.parse(r) : r;
                if (res && res.status === true && res.booking_id) {
                    const bookingId = res.booking_id;
                    const fee = res.registration_fee || defaultRegFee;
                    window.lastSavedBookingId = bookingId;
                    window.lastPaidRegFee = fee;
                    window.bookingSavedForPayment = true;
                    clearBookingDraft();
                    showToast(res.message || 'Shifting request saved successfully.', 'success');
                    openRegistrationPayment(bookingId, fee);
                } else {
                    showToast((res && res.message) || 'Could not save booking details.', 'error');
                }
            } catch(e) {
                showToast(typeof r === 'string' ? r : 'Could not save booking details.', 'error');
            }
        },
        error: function () {
            showToast('Relocation checkout failed. Please try again.', 'error');
        }
    });
}

function updateRegistrationPaymentStatus(bookingId, status, paymentId, orderId) {
    Swal.fire({
        title: 'Verifying Payment...',
        text: 'Confirming Booking Fees payment. Please wait.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/update-registration-payment") ?>',
        data: {
            booking_id: bookingId,
            status: status,
            razorpay_payment_id: paymentId || '',
            razorpay_order_id: orderId || ''
        },
        success: function(r) {
            Swal.close();
            let result = r;
            if (typeof r === 'string') {
                try { result = JSON.parse(r); } catch (e) { result = { success: false }; }
            }

            if (!result || !result.success) {
                showToast((result && result.message) || 'Payment could not be verified. Please contact support.', 'error');
                return;
            }

            if (status === 'paid') {
                clearBookingDraft();
                var pAddress = $('#wizardPickup').val() || '—';
                var dAddress = $('#wizardDrop').val() || '—';
                var mDate    = $('#wizardShiftingDate').val() || '—';
                var pAmount  = parseFloat(window.lastPaidRegFee || 500).toFixed(2);

                Swal.fire({
                    width: '540px',
                    customClass: {
                        container: 'swal2-top-zindex',
                        popup: 'sleek-booking-confirmed-modal'
                    },
                    html:
                        '<div style="text-align:center;">'
                        + '<div style="position:relative; width:56px; height:56px; margin:0 auto 12px;">'
                        + '<svg style="position:absolute; top:-10px; left:-10px; width:76px; height:76px; pointer-events:none;" viewBox="0 0 100 100">'
                        + '<circle cx="20" cy="18" r="3" fill="#e53e3e" opacity="0.6"/><circle cx="82" cy="22" r="3" fill="#dd6b20" opacity="0.6"/><circle cx="15" cy="78" r="3.5" fill="#319795" opacity="0.6"/><circle cx="85" cy="80" r="3.5" fill="#38a169" opacity="0.6"/><polygon points="50,4 53,10 47,10" fill="#38a169" opacity="0.7"/><polygon points="8,50 14,53 14,47" fill="#dd6b20" opacity="0.7"/><polygon points="92,48 98,51 98,45" fill="#319795" opacity="0.7"/>'
                        + '</svg>'
                        + '<div style="width:56px; height:56px; background:linear-gradient(135deg,#38ef7d,#11998e); border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 8px 20px rgba(56,239,125,0.35); position:relative; z-index:1;"><div style="width:32px; height:32px; border:2.5px solid #ffffff; border-radius:50%; display:flex; align-items:center; justify-content:center;"><i class="bi bi-check-lg" style="color:#ffffff; font-size:20px; font-weight:800;"></i></div></div>'
                        + '</div>'
                        + '<h3 style="font-weight:800; color:#1a1a2e; margin:0 0 4px; font-size:1.3rem; letter-spacing:-0.4px;">Booking Confirmed!</h3>'
                        + '<div style="width:36px; height:3px; background:#FC5D09; border-radius:3px; margin:0 auto 10px;"></div>'
                        + '<p style="font-size:0.85rem; color:#4a5568; line-height:1.45; margin-bottom:14px; padding:0 10px;">We have successfully received your token amount and your booking is confirmed.</p>'
                        + '<div style="background:linear-gradient(135deg,#f0fff4,#e6fffa); border:1px solid #c6f6d5; border-radius:12px; padding:10px 14px; margin-bottom:16px; display:flex; align-items:center; gap:10px; text-align:left;"><div style="width:34px; height:34px; background:#ffffff; border:1.5px solid #38a169; border-radius:10px; display:flex; align-items:center; justify-content:center; flex-shrink:0;"><i class="bi bi-calendar-check" style="color:#38a169; font-size:17px;"></i></div><div style="font-size:0.82rem; color:#2d3748; line-height:1.4; font-weight:600;">We are preparing for your order and will keep you updated at every step.</div></div>'
                        + '<div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:14px; padding:14px 16px; margin-bottom:18px; text-align:left;">'
                        + '<div style="display:flex; align-items:flex-start; gap:10px; margin-bottom:10px; padding-bottom:10px; border-bottom:1px dashed #e2e8f0;"><div style="width:28px; height:28px; background:#fff5ed; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;"><i class="bi bi-geo-alt-fill" style="color:#FC5D09; font-size:14px;"></i></div><div style="flex-grow:1;"><div style="font-size:0.7rem; color:#718096; text-transform:uppercase; font-weight:700; letter-spacing:0.4px;">Pickup Location</div><div style="font-size:0.84rem; color:#1a202c; font-weight:700; word-break:break-word; margin-top:1px;">' + pAddress + '</div></div></div>'
                        + '<div style="display:flex; align-items:flex-start; gap:10px; margin-bottom:12px; padding-bottom:10px; border-bottom:1px dashed #e2e8f0;"><div style="width:28px; height:28px; background:#fff5ed; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0; margin-top:2px;"><i class="bi bi-geo-alt-fill" style="color:#FC5D09; font-size:14px;"></i></div><div style="flex-grow:1;"><div style="font-size:0.7rem; color:#718096; text-transform:uppercase; font-weight:700; letter-spacing:0.4px;">Drop Location</div><div style="font-size:0.84rem; color:#1a202c; font-weight:700; word-break:break-word; margin-top:1px;">' + dAddress + '</div></div></div>'
                        + '<div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:12px;">'
                        + '<div style="flex:1; min-width:140px; background:#ffffff; border:1px solid #edf2f7; border-radius:10px; padding:8px 10px; display:flex; align-items:center; gap:8px;"><i class="bi bi-calendar-event-fill" style="color:#FC5D09; font-size:16px;"></i><div><div style="font-size:0.68rem; color:#718096; font-weight:700; text-transform:uppercase;">Moving Date</div><div style="font-size:0.82rem; color:#1a202c; font-weight:700;">' + mDate + '</div></div></div>'
                        + '<div style="flex:1; min-width:140px; background:#ffffff; border:1px solid #edf2f7; border-radius:10px; padding:8px 10px; display:flex; align-items:center; gap:8px;"><i class="bi bi-shield-check" style="color:#38a169; font-size:18px;"></i><div><div style="font-size:0.68rem; color:#718096; font-weight:700; text-transform:uppercase;">Token Paid</div><div style="font-size:0.82rem; color:#276749; font-weight:800;">₹' + pAmount + ' <span style="font-size:0.68rem; font-weight:600; color:#38a169;">(Verified)</span></div></div></div>'
                        + '</div>'
                        + '<div style="background:linear-gradient(135deg, #fff5ed, #ffede0); border:1.5px solid #ffcca8; border-radius:10px; padding:10px 14px; display:flex; align-items:center; justify-content:space-between;"><div style="display:flex; align-items:center; gap:8px;"><div style="width:28px; height:28px; background:#FC5D09; border-radius:6px; display:flex; align-items:center; justify-content:center;"><i class="bi bi-wallet2" style="color:#ffffff; font-size:13px;"></i></div><span style="font-weight:700; color:#2d3748; font-size:0.88rem;">Total Paid</span></div><div style="color:#FC5D09; font-weight:850; font-size:1.1rem;">₹' + pAmount + '</div></div>'
                        + '</div>'
                        + '<button id="swalConfirmOkBtn" style="background:linear-gradient(135deg,#FC5D09,#ff4b2b); color:#ffffff; border:none; border-radius:10px; padding:12px 0; font-weight:700; font-size:0.92rem; cursor:pointer; box-shadow:0 6px 18px rgba(252, 93, 9,0.35); width:100%; display:flex; align-items:center; justify-content:center; gap:8px;">Go to Homepage <i class="bi bi-arrow-right" style="font-size:1rem;"></i></button>'
                        + '</div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: () => {
                        document.getElementById('swalConfirmOkBtn').addEventListener('click', () => {
                            Swal.close();
                            window.location.href = '<?= site_url() ?>';
                        });
                    }
                });

                if (!result.whatsapp_sent) {
                    showToast(result.message || 'Payment successful, but WhatsApp confirmation could not be delivered.', 'warning');
                }
            }
        },
        error: function() {
            Swal.close();
            console.error('Failed to update registration payment status.');
        }
    });
}

function saveBookingDetails(editingId, paymentId, orderId) {
    Swal.fire({
        title: 'Updating Booking...',
        text: 'Saving shifting details. Please wait.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    // Extract addon IDs and quantities checked
    const addonsData = [];
    $('.addon-wizard-chk:checked').each(function () {
        const addonId = $(this).attr('id').replace('addon-check-', '');
        let qty = 1;
        if ($(this).attr('data-is-rope-pulling') === 'true') {
            qty = parseInt($('#addon-qty-' + addonId).text()) || 1;
        }
        addonsData.push({ id: addonId, qty: qty });
    });

    const formData = {
        editing_booking_id: editingId,
        pickup_location: $('#wizardPickup').val(),
        drop_location: $('#wizardDrop').val(),
        shifting_date: $('#wizardShiftingDate').val(),
        shifting_time: $('#wizardShiftingTime').val(),
        phone_number: $('#wizardPhone').val(),
        estimated_amount: $('#wizTotalInput').val(),
        razorpay_payment_id: paymentId || '',
        razorpay_order_id: orderId || '',
        distance_km: $('#distanceRange').val(),
        items_json: JSON.stringify(selectedItems),
        addons_json: JSON.stringify(addonsData)
    };

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/submit-online-booking") ?>',
        data: formData,
        success: function (r) {
            Swal.close();
            try {
                let res = (typeof r === 'string') ? JSON.parse(r) : r;
                if (res && (res.is_update || res.status === true)) {
                    // Check if it's a draft booking (registration fee unpaid)
                    const isRegPaid = typeof editBookingData !== 'undefined' && editBookingData && 
                        (editBookingData.registration_payment_status === 'paid' || editBookingData.registration_payment_status === 'advanced_paid');
                    
                    if (typeof editBookingData !== 'undefined' && editBookingData && !isRegPaid) {
                        // Draft mode: update was successful, now trigger Razorpay payment
                        let regFee = <?= isset($default_reg_fee) ? floatval($default_reg_fee) : 500 ?>;
                        openRegistrationPayment(editingId, regFee);
                        return; // Stop here. The payment modal handler will clear the draft and redirect upon success.
                    }

                    // Standard edit mode for a confirmed booking
                    clearBookingDraft();
                    showToast('Booking updated successfully!', 'success');
                    setTimeout(() => {
                        window.location.href = '<?= site_url("my-bookings") ?>';
                    }, 1800);
                    return;
                }
            } catch(e) {
                Swal.fire({
                    title: 'Error!',
                    html: r,
                    icon: 'error',
                    confirmButtonColor: '#FC5D09'
                });
            }
        },
        error: function () {
            Swal.fire({
                title: 'Network Error',
                text: 'Relocation checkout failed. Please try again.',
                icon: 'error',
                confirmButtonColor: '#FC5D09'
            });
        }
    });
}

// Override homepage modal welcome callback for wizard checkout
const originalSetLoggedIn = window.setLoggedIn;
window.setLoggedIn = function (name) {
    if (typeof originalSetLoggedIn === 'function') {
        originalSetLoggedIn(name);
    }
    
    // If checkout was pending, run submit
    if (window._pendingWizardSubmit) {
        window._pendingWizardSubmit = false;
        // Prefill phone value with verified number from storage
        const stored = JSON.parse(localStorage.getItem('bhandari_user'));
        if (stored) {
            $('#wizardPhone').val(stored.mobile);
        }
        executeWizardSubmission();
    }
};
</script>

<script>
// Helper: Parse any time string (12-hr AM/PM or 24-hr) to total minutes from midnight
function parseTimeToMinutes(timeStr) {
    if (!timeStr) return -1;
    timeStr = String(timeStr).trim();
    var ampmMatch = timeStr.match(/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i);
    if (ampmMatch) {
        var h = parseInt(ampmMatch[1], 10);
        var m = parseInt(ampmMatch[2], 10);
        var p = ampmMatch[3].toUpperCase();
        if (p === 'PM' && h < 12) h += 12;
        if (p === 'AM' && h === 12) h = 0;
        return h * 60 + m;
    }
    var hr24Match = timeStr.match(/^(\d{1,2}):(\d{2})(?::\d{2})?$/);
    if (hr24Match) {
        var h24 = parseInt(hr24Match[1], 10);
        var m24 = parseInt(hr24Match[2], 10);
        return h24 * 60 + m24;
    }
    return -1;
}

// Helper: Format total minutes from midnight into 12-hour AM/PM string
function formatMinutesTo12Hour(totalMin) {
    if (totalMin < 0) return '';
    if (totalMin >= 1440) {
        var remMin = totalMin - 1440;
        var h = Math.floor(remMin / 60);
        var m = remMin % 60;
        var period = h >= 12 ? 'PM' : 'AM';
        var h12 = h % 12; if (h12 === 0) h12 = 12;
        return String(h12).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ' ' + period + ' (Tomorrow)';
    } else {
        var h = Math.floor(totalMin / 60);
        var m = totalMin % 60;
        var period = h >= 12 ? 'PM' : 'AM';
        var h12 = h % 12; if (h12 === 0) h12 = 12;
        return String(h12).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ' ' + period;
    }
}

function getLocalTodayDateStr() {
    var d = new Date();
    var y = d.getFullYear();
    var m = String(d.getMonth() + 1).padStart(2, '0');
    var day = String(d.getDate()).padStart(2, '0');
    return y + '-' + m + '-' + day;
}

// Helper: Filter 12-hour time options in dropdown based on date
function filterSelectTimeOptions(dateElemId, timeElemId) {
    var dateVal = $('#' + dateElemId).val();
    var timeSelect = document.getElementById(timeElemId);
    if (!timeSelect) return;

    var todayStr = getLocalTodayDateStr();
    var isToday = (!dateVal || dateVal === todayStr);

    var now = new Date();
    var minAllowedMin = isToday ? (now.getHours() * 60 + now.getMinutes() + 120) : 0;

    var options = timeSelect.options;
    for (var i = 0; i < options.length; i++) {
        var opt = options[i];
        if (!opt.value) continue;
        var optMin = parseTimeToMinutes(opt.value);
        if (isToday && optMin >= 0 && optMin < minAllowedMin) {
            opt.disabled = true;
            var cleanText = opt.value;
            if (!opt.text.includes('(Unavailable)')) {
                opt.text = cleanText + ' (Unavailable - Min 2 hrs)';
            }
        } else {
            opt.disabled = false;
            opt.text = opt.value;
        }
    }

    if (timeSelect.selectedIndex >= 0 && timeSelect.options[timeSelect.selectedIndex].disabled) {
        timeSelect.value = '';
    }
}

$(function () {
    filterSelectTimeOptions('wizardShiftingDate', 'wizardShiftingTime');

    $('#wizardShiftingDate').on('change', function () {
        filterSelectTimeOptions('wizardShiftingDate', 'wizardShiftingTime');
        $('#wizardShiftingTime').trigger('change');
    });

    $('#wizardShiftingTime').on('change', function() {
        var dateVal = $('#wizardShiftingDate').val() ? $('#wizardShiftingDate').val().trim() : '';
        var timeVal = $(this).val() ? $(this).val().trim() : '';
        var todayStr = getLocalTodayDateStr();

        if ((!dateVal || dateVal === todayStr) && timeVal) {
            var selMin = parseTimeToMinutes(timeVal);
            var now = new Date();
            var nowMin = now.getHours() * 60 + now.getMinutes();
            var minAllowedMin = nowMin + 120; // +2 hours

            if (selMin >= 0 && selMin < minAllowedMin) {
                var currentStr = formatMinutesTo12Hour(nowMin);
                var earliestStr = minAllowedMin >= 1440 
                    ? 'No time slots left today. Please select tomorrow\'s date.' 
                    : formatMinutesTo12Hour(minAllowedMin);

                showSleekNoticeModal(
                    'Advance Booking (2 Hrs Minimum)',
                    'Orders must be scheduled at least <b>2 hours</b> in advance.<br><br>' +
                    '• Current Time: <b>' + currentStr + '</b><br>' +
                    '• Earliest Allowed Today: <b>' + earliestStr + '</b>',
                    'Select Valid Time',
                    'time'
                );
                $(this).val('');
                filterSelectTimeOptions('wizardShiftingDate', 'wizardShiftingTime');
            }
        }
    });

    setInterval(function () {
        filterSelectTimeOptions('wizardShiftingDate', 'wizardShiftingTime');
    }, 60000);
});
</script>

