<?php
/**
 * Dynamic Homepage Quote, Relocation Cost Estimator & Local SEO Section
 * Controlled via admin database (service_hub)
 * Fully responsive on mobile, tablet, and desktop
 */

$ci =& get_instance();

// 1. Quote Showcase Data
if (!isset($quote_section) || empty($quote_section)) {
    if (isset($ci->home_mdl)) {
        $quote_section = $ci->home_mdl->get_quote_section();
    }
}

// 2. Calculator Data
if (!isset($calculator_data) || empty($calculator_data)) {
    if (isset($ci->home_mdl)) {
        $calculator_data = $ci->home_mdl->get_calculator_data();
    }
}
$calc_settings = $calculator_data['settings'] ?? null;
$calc_items    = $calculator_data['items'] ?? [];

// 3. Verified Movers & Locality Data
if (!isset($verified_movers_setting) || empty($verified_movers_setting)) {
    if (isset($ci->home_mdl)) {
        $verified_movers_setting = $ci->home_mdl->get_verified_movers_setting();
    }
}

// 4. Section Visibility Flags
if (!isset($homepage_sections) || empty($homepage_sections)) {
    if (isset($ci->home_mdl)) {
        $homepage_sections = $ci->home_mdl->get_homepage_sections();
    } else {
        $homepage_sections = [
            'quote_showcase'   => 1,
            'quote_calculator' => 1,
            'verified_movers'  => 1
        ];
    }
}

$show_showcase_section  = !isset($homepage_sections['quote_showcase']) || !empty($homepage_sections['quote_showcase']);
$show_calculator_section = !isset($homepage_sections['quote_calculator']) || !empty($homepage_sections['quote_calculator']);
$show_verified_section   = !isset($homepage_sections['verified_movers']) || !empty($homepage_sections['verified_movers']);

// Robust Offer & Discount Detection Logic (Hides completely if 0%, 0% OFF, or Disabled)
$qs_is_offer_active  = isset($quote_section->is_offer_active) ? (int)$quote_section->is_offer_active : 1;
$qs_badge_raw        = (!empty($quote_section) && !empty($quote_section->badge_text)) ? trim($quote_section->badge_text) : '';
$qs_offer_tag_raw    = (!empty($quote_section) && !empty($quote_section->offer_tag)) ? trim($quote_section->offer_tag) : '';

$is_badge_zero = empty($qs_badge_raw) || preg_match('/((?<!\d)0\s*%|(?<!\d)0\s*percent|no\s*discount|none\b|^0$)/i', $qs_badge_raw);
$is_tag_zero   = empty($qs_offer_tag_raw) || preg_match('/((?<!\d)0\s*%|(?<!\d)0\s*percent|no\s*discount|none\b|^0$)/i', $qs_offer_tag_raw);

$has_active_offer    = ($qs_is_offer_active === 1) && !empty($qs_badge_raw) && !$is_badge_zero && !$is_tag_zero;
$has_active_discount = ($qs_is_offer_active === 1) && !empty($qs_offer_tag_raw) && !$is_tag_zero;

$qs_badge       = $has_active_offer ? $qs_badge_raw : '';
$qs_headline    = (!empty($quote_section) && !empty($quote_section->headline)) ? $quote_section->headline : 'Get Your Instant Free Moving Quote in 60 Seconds';
$qs_subheadline = (!empty($quote_section) && !empty($quote_section->subheadline)) ? $quote_section->subheadline : 'Guaranteed Best Price & 100% Safe Shifting Across Noida & Greater Noida. Trusted by 15,000+ Happy Families!';
$qs_offer_tag   = $has_active_discount ? $qs_offer_tag_raw : '';

$format_usp_icon = function($icon_class, $default_icon) {
    $icon = trim((string)$icon_class);
    if (empty($icon)) {
        return $default_icon;
    }
    if (preg_match('/^bi-[a-z0-9-]+$/i', $icon)) {
        return 'bi ' . $icon;
    }
    return $icon;
};

$qs_f1_title    = (!empty($quote_section) && !empty($quote_section->feature_1_title)) ? $quote_section->feature_1_title : 'Zero Hidden Charges';
$qs_f1_desc     = (!empty($quote_section) && !empty($quote_section->feature_1_desc)) ? $quote_section->feature_1_desc : 'Transparent all-inclusive pricing with complete breakdown upfront';
$qs_f1_icon     = $format_usp_icon($quote_section->feature_1_icon ?? null, 'bi bi-shield-fill-check');

$qs_f2_title    = (!empty($quote_section) && !empty($quote_section->feature_2_title)) ? $quote_section->feature_2_title : 'Free Pre-Move Survey';
$qs_f2_desc     = (!empty($quote_section) && !empty($quote_section->feature_2_desc)) ? $quote_section->feature_2_desc : 'Doorstep or video survey by relocation expert at zero cost';
$qs_f2_icon     = $format_usp_icon($quote_section->feature_2_icon ?? null, 'bi bi-camera-video-fill');

$qs_f3_title    = (!empty($quote_section) && !empty($quote_section->feature_3_title)) ? $quote_section->feature_3_title : '₹5 Lakh Transit Insurance';
$qs_f3_desc     = (!empty($quote_section) && !empty($quote_section->feature_3_desc)) ? $quote_section->feature_3_desc : 'Complete coverage for household goods against any transit damage';
$qs_f3_icon     = $format_usp_icon($quote_section->feature_3_icon ?? null, 'bi bi-shield-lock-fill');

$qs_f4_title    = (!empty($quote_section) && !empty($quote_section->feature_4_title)) ? $quote_section->feature_4_title : 'GPS Live Tracking';
$qs_f4_desc     = (!empty($quote_section) && !empty($quote_section->feature_4_desc)) ? $quote_section->feature_4_desc : 'Real-time vehicle tracking directly on your mobile device';
$qs_f4_icon     = $format_usp_icon($quote_section->feature_4_icon ?? null, 'bi bi-geo-alt-fill');

$qs_phone       = (!empty($quote_section) && !empty($quote_section->phone_number)) ? $quote_section->phone_number : '+91 7303257332';
$qs_clean_phone = preg_replace('/[^0-9]/', '', $qs_phone);
$qs_wa          = (!empty($quote_section) && !empty($quote_section->whatsapp_number)) ? $quote_section->whatsapp_number : '917303257332';
?>

<!-- =================================================================
     SECTION: DYNAMIC QUOTE SHOWCASE, CALCULATOR & LOCALITY DIRECTORY
     ================================================================= -->
<section class="dynamic-quote-section py-5 position-relative" id="instant-quote-calculator">
  <div class="container">

    <?php /* =========================================================
       SUB-SECTION 1: QUOTE SHOWCASE & 4 VALUE PILLARS
       ============================================================= */ ?>
    <?php if ($show_showcase_section && (!isset($quote_section->is_active) || !empty($quote_section->is_active))): ?>
    <!-- Header Block -->
    <div class="row justify-content-center text-center mb-4 mb-lg-5">
      <div class="col-lg-10 col-xl-9">
        <?php if ($has_active_offer && !empty($qs_badge)): ?>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-pill shadow-sm mb-3" style="background: linear-gradient(180deg, #0B2562 0%, #001C66 100%); color: #ffffff; border: 1px solid rgba(255,255,255,0.2);">
          
          <span class="fw-bold text-white small"><?= htmlspecialchars($qs_badge) ?></span>
        </div>
        <?php endif; ?>
        <h2 class="display-6 fw-bold text-dark mb-3">
          <?= htmlspecialchars($qs_headline) ?>
        </h2>
        <p class="lead text-muted fs-6 mb-0">
          <?= htmlspecialchars($qs_subheadline) ?>
        </p>
      </div>
    </div>

    <!-- 4 Dynamic Value Pillars -->
    <div class="row g-3 g-md-4 mb-5">
      <div class="col-6 col-lg-3">
        <div class="dynamic-usp-card p-3 p-md-4 h-100 rounded-4 text-center">
          <div class="usp-icon-wrap usp-icon-green mx-auto mb-3">
            <i class="<?= htmlspecialchars($qs_f1_icon) ?>"></i>
          </div>
          <h3 class="fs-6 fw-bold text-dark mb-1"><?= htmlspecialchars($qs_f1_title) ?></h3>
          <p class="text-muted small mb-0"><?= htmlspecialchars($qs_f1_desc) ?></p>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="dynamic-usp-card p-3 p-md-4 h-100 rounded-4 text-center">
          <div class="usp-icon-wrap usp-icon-blue mx-auto mb-3">
            <i class="<?= htmlspecialchars($qs_f2_icon) ?>"></i>
          </div>
          <h3 class="fs-6 fw-bold text-dark mb-1"><?= htmlspecialchars($qs_f2_title) ?></h3>
          <p class="text-muted small mb-0"><?= htmlspecialchars($qs_f2_desc) ?></p>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="dynamic-usp-card p-3 p-md-4 h-100 rounded-4 text-center">
          <div class="usp-icon-wrap usp-icon-orange mx-auto mb-3">
            <i class="<?= htmlspecialchars($qs_f3_icon) ?>"></i>
          </div>
          <h3 class="fs-6 fw-bold text-dark mb-1"><?= htmlspecialchars($qs_f3_title) ?></h3>
          <p class="text-muted small mb-0"><?= htmlspecialchars($qs_f3_desc) ?></p>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="dynamic-usp-card p-3 p-md-4 h-100 rounded-4 text-center">
          <div class="usp-icon-wrap usp-icon-yellow mx-auto mb-3">
            <i class="<?= htmlspecialchars($qs_f4_icon) ?>"></i>
          </div>
          <h3 class="fs-6 fw-bold text-dark mb-1"><?= htmlspecialchars($qs_f4_title) ?></h3>
          <p class="text-muted small mb-0"><?= htmlspecialchars($qs_f4_desc) ?></p>
        </div>
      </div>
    </div>

    <!-- CTA Button configured in Admin -->
    <?php $qs_cta_text = (!empty($quote_section) && !empty($quote_section->cta_button_text)) ? $quote_section->cta_button_text : 'Get Free Quote Now'; ?>
    <div class="text-center mb-5">
      <a href="javascript:void(0)" onclick="openInquiryModal('Instant Free Moving Quote')" class="btn btn-danger btn-lg fw-bold px-4 py-3 rounded-pill shadow d-inline-flex align-items-center gap-2">
        <i class="bi bi-lightning-fill"></i>
        <span><?= htmlspecialchars($qs_cta_text) ?></span>
      </a>
    </div>
    <?php endif; ?>

    <?php /* =========================================================
       SUB-SECTION 2: INSTANT SHIFTING CHARGES CALCULATOR
       ============================================================= */ ?>
    <?php if ($show_calculator_section && (!isset($calc_settings->is_active) || !empty($calc_settings->is_active))): ?>
    <?php 
      $calc_badge_tag   = !empty($calc_settings->badge_tag) ? $calc_settings->badge_tag : 'Cost Guide';
      $calc_title       = !empty($calc_settings->title) ? $calc_settings->title : 'Instant Shifting Charges Calculator';
      $calc_disclaimer  = !empty($calc_settings->disclaimer_text) ? $calc_settings->disclaimer_text : '*Approximate charges for local shifting within Noida/Greater Noida. Final quotation based on inventory volume & distance.';
      $calc_phone       = !empty($calc_settings->phone_number) ? $calc_settings->phone_number : $qs_phone;
      $calc_clean_phone = preg_replace('/[^0-9]/', '', $calc_phone);
      $calc_wa          = !empty($calc_settings->whatsapp_number) ? $calc_settings->whatsapp_number : $qs_wa;
    ?>
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden quote-estimator-box mb-5">
      <div class="card-header text-white p-3 p-md-4 border-0" style="background: linear-gradient(180deg, #0B2562 0%, #001C66 100%) !important;">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
          <div>
            <span class="badge bg-warning text-dark fw-bold mb-1"><i class="bi bi-calculator me-1"></i> <?= htmlspecialchars($calc_badge_tag) ?></span>
            <h3 class="h5 fw-bold text-white mb-0"><?= htmlspecialchars($calc_title) ?></h3>
          </div>
          <?php if ($has_active_discount && !empty($qs_offer_tag)): ?>
          <div class="text-end">
            <span class="badge bg-danger text-white px-3 py-2 fw-semibold rounded-pill animate-pulse">
              <i class="bi bi-tag-fill me-1"></i> <?= htmlspecialchars($qs_offer_tag) ?>
            </span>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="card-body p-3 p-md-4 bg-white">
        <!-- Tab Selector Buttons -->
        <ul class="nav nav-pills nav-fill gap-2 mb-4 p-1 bg-light rounded-3 estimator-tabs" id="estimateTab" role="tablist">
          <?php foreach ($calc_items as $idx => $item): ?>
            <li class="nav-item" role="presentation">
              <button class="nav-link fw-bold py-2 rounded-3 <?= $idx === 0 ? 'active' : '' ?>" 
                      id="tab-<?= htmlspecialchars($item->tab_key) ?>" 
                      data-bs-toggle="pill" 
                      data-bs-target="#content-<?= htmlspecialchars($item->tab_key) ?>" 
                      type="button" 
                      role="tab">
                <?= htmlspecialchars($item->tab_title) ?>
              </button>
            </li>
          <?php endforeach; ?>
        </ul>

        <!-- Tab Content Panes -->
        <div class="tab-content" id="estimateTabContent">
          <?php foreach ($calc_items as $idx => $item): ?>
            <div class="tab-pane fade <?= $idx === 0 ? 'show active' : '' ?>" id="content-<?= htmlspecialchars($item->tab_key) ?>" role="tabpanel">
              <div class="row align-items-center g-4">
                <div class="col-lg-7">
                  <div class="d-flex align-items-center gap-2 mb-2 flex-wrap">
                    <?php if (!empty($item->badge_text)): ?>
                      <?php $btype = !empty($item->badge_type) ? $item->badge_type : 'success'; ?>
                      <span class="badge bg-<?= $btype ?>-subtle text-<?= $btype ?> fw-bold px-2 py-1"><?= htmlspecialchars($item->badge_text) ?></span>
                    <?php endif; ?>
                    <?php if (!empty($item->duration_text)): ?>
                      <span class="text-muted small"><i class="bi bi-clock me-1"></i> <?= htmlspecialchars($item->duration_text) ?></span>
                    <?php endif; ?>
                  </div>
                  <h4 class="fw-bold text-dark mb-2"><?= htmlspecialchars($item->title) ?></h4>
                  <?php if (!empty($item->description)): ?>
                    <p class="text-muted small mb-3"><?= htmlspecialchars($item->description) ?></p>
                  <?php endif; ?>
                  <ul class="list-unstyled row g-2 small text-secondary mb-0">
                    <?php if (!empty($item->feature_1)): ?>
                      <li class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($item->feature_1) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($item->feature_2)): ?>
                      <li class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($item->feature_2) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($item->feature_3)): ?>
                      <li class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($item->feature_3) ?></li>
                    <?php endif; ?>
                    <?php if (!empty($item->feature_4)): ?>
                      <li class="col-sm-6"><i class="bi bi-check-circle-fill text-success me-2"></i> <?= htmlspecialchars($item->feature_4) ?></li>
                    <?php endif; ?>
                  </ul>
                </div>
                <div class="col-lg-5 text-center text-lg-end">
                  <div class="price-display-card p-3 p-md-4 rounded-4 bg-light border">
                    <span class="text-muted small text-uppercase fw-semibold d-block"><?= htmlspecialchars($item->price_prefix ?: 'Estimated Starting Rate') ?></span>
                    <div class="d-flex justify-content-center justify-content-lg-end align-items-baseline gap-1 my-2">
                      <span class="h2 fw-bolder calc-price-val mb-0"><?= htmlspecialchars($item->price_from) ?></span>
                      <?php if (!empty($item->price_to)): ?>
                        <span class="text-muted fs-6"><?= htmlspecialchars($item->price_to) ?></span>
                      <?php endif; ?>
                    </div>

                    <!-- Special Offer Badge (Only shown if offer is active and not 0%) -->
                    <?php if ($has_active_discount && !empty($qs_offer_tag)): ?>
                    <span class="badge bg-warning-subtle text-dark small mb-3 d-inline-block"><i class="bi bi-tag-fill text-danger me-1"></i>Special <?= htmlspecialchars($qs_offer_tag) ?> Advance Booking Discount</span>
                    <?php endif; ?>

                    <div class="d-grid gap-2">
                      <a href="javascript:void(0)" onclick="openInquiryModal('<?= htmlspecialchars(addslashes($item->tab_title)) ?>')" class="btn btn-danger fw-bold py-2 rounded-3 shadow-sm btn-quote-action">
                        <i class="bi bi-lightning-fill me-1"></i> <?= htmlspecialchars($item->btn_text ?: 'Book Shifting') ?>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div><!-- /tab-content -->

        <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 border-top mt-3 text-muted small">
          <span><?= htmlspecialchars($calc_disclaimer) ?></span>
          <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
            <a href="tel:+91<?= $calc_clean_phone ?>" class="text-decoration-none text-danger fw-bold">
              <i class="bi bi-telephone-fill me-1"></i> <?= htmlspecialchars($calc_phone) ?>
            </a>
            <span class="text-muted">|</span>
            <a href="https://wa.me/<?= $calc_wa ?>?text=Hello%2C%20I%20need%20a%20moving%20quote%20for%20home%20shifting%20in%20Noida" target="_blank" rel="noopener noreferrer" class="text-decoration-none text-success fw-bold">
              <i class="bi bi-whatsapp me-1"></i> WhatsApp
            </a>
          </div>
        </div>

      </div>
    </div>
    <?php endif; ?>

    <?php /* =========================================================
       SUB-SECTION 3: GOOGLE #1 VERIFIED MOVERS & LOCALITY DIRECTORY
       ============================================================= */ ?>
    <?php if ($show_verified_section && (!isset($verified_movers_setting->is_active) || !empty($verified_movers_setting->is_active))): ?>
    <?php 
      $vm_badge     = !empty($verified_movers_setting->badge_tag) ? $verified_movers_setting->badge_tag : 'Google #1 Verified Movers';
      $vm_heading   = !empty($verified_movers_setting->main_heading) ? $verified_movers_setting->main_heading : 'Local Shifting Coverage Across All Sectors in Noida & Greater Noida';
      $vm_desc      = !empty($verified_movers_setting->description) ? $verified_movers_setting->description : 'Bhandari Packers and Movers is the government registered, ISO 9001:2015 certified relocation service operating across Noida, Greater Noida, Greater Noida West (Noida Extension), and Delhi-NCR.';
      $vm_box_title = !empty($verified_movers_setting->box_title) ? $verified_movers_setting->box_title : 'Why Bhandari Packers is Ranked #1 in Noida:';

      $chips_raw    = !empty($verified_movers_setting->sector_chips) ? $verified_movers_setting->sector_chips : 'Sector 15, Sector 18, Sector 25, Sector 34, Sector 50, Sector 52, Sector 62, Sector 74, Sector 75, Sector 76, Sector 78, Sector 93, Sector 100, Sector 104, Sector 110, Sector 121, Sector 137, Sector 143, Sector 150, Noida Expressway, Gaur City 1 & 2, Pari Chowk, Alpha & Beta, Delta & Gamma, Knowledge Park, Yamuna Expressway';
      $sector_chips = array_filter(array_map('trim', explode(',', $chips_raw)));

      $c1_title    = !empty($verified_movers_setting->card_1_title) ? $verified_movers_setting->card_1_title : '15,000+ Moves';
      $c1_subtitle = !empty($verified_movers_setting->card_1_subtitle) ? $verified_movers_setting->card_1_subtitle : '14+ Years in Noida & NCR';
      $c1_icon     = !empty($verified_movers_setting->card_1_icon) ? $verified_movers_setting->card_1_icon : 'bi bi-truck';

      $c2_title    = !empty($verified_movers_setting->card_2_title) ? $verified_movers_setting->card_2_title : 'Zero Damage Guarantee';
      $c2_subtitle = !empty($verified_movers_setting->card_2_subtitle) ? $verified_movers_setting->card_2_subtitle : 'Multi-layer bubble packing';
      $c2_icon     = !empty($verified_movers_setting->card_2_icon) ? $verified_movers_setting->card_2_icon : 'bi bi-shield-lock-fill';

      $c3_title    = !empty($verified_movers_setting->card_3_title) ? $verified_movers_setting->card_3_title : 'Fixed Price Guarantee';
      $c3_subtitle = !empty($verified_movers_setting->card_3_subtitle) ? $verified_movers_setting->card_3_subtitle : 'No hidden delivery charges';
      $c3_icon     = !empty($verified_movers_setting->card_3_icon) ? $verified_movers_setting->card_3_icon : 'bi bi-cash-coin';

      $c4_title    = !empty($verified_movers_setting->card_4_title) ? $verified_movers_setting->card_4_title : '24x7 Customer Help';
      $c4_subtitle = !empty($verified_movers_setting->card_4_subtitle) ? $verified_movers_setting->card_4_subtitle : 'Live move tracking on call';
      $c4_icon     = !empty($verified_movers_setting->card_4_icon) ? $verified_movers_setting->card_4_icon : 'bi bi-headset';

      $vm_cta_text = !empty($verified_movers_setting->cta_text) ? $verified_movers_setting->cta_text : 'Need an immediate shifting estimate?';
      $vm_cta_btn  = !empty($verified_movers_setting->cta_btn_text) ? $verified_movers_setting->cta_btn_text : 'Fill Form Above';
    ?>
    <div class="seo-locality-block bg-light p-4 p-md-5 rounded-4 border">
      <div class="row g-4 align-items-start">
        <div class="col-lg-6">
          <span class="section-label-tag mb-2"><?= htmlspecialchars($vm_badge) ?></span>
          <h3 class="h4 fw-bold text-dark mb-3">
            <?= htmlspecialchars($vm_heading) ?>
          </h3>
          <p class="text-muted small lh-base mb-3">
            <?= htmlspecialchars($vm_desc) ?>
          </p>
          <div class="locality-chips-wrap d-flex flex-wrap gap-1 mb-3">
            <?php foreach ($sector_chips as $chip): ?>
              <span class="badge bg-white text-dark border"><?= htmlspecialchars($chip) ?></span>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="bg-white p-3 p-md-4 rounded-4 shadow-sm border h-100">
            <h4 class="h6 fw-bold text-dark mb-3 d-flex align-items-center gap-2">
              <i class="bi bi-patch-check-fill text-danger fs-5"></i>
              <?= htmlspecialchars($vm_box_title) ?>
            </h4>
            <div class="row g-2 small">
              <div class="col-sm-6">
                <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light">
                  <i class="<?= htmlspecialchars($c1_icon) ?> text-danger fs-6 mt-1"></i>
                  <div>
                    <strong class="text-dark d-block"><?= htmlspecialchars($c1_title) ?></strong>
                    <span class="text-muted" style="font-size:11px;"><?= htmlspecialchars($c1_subtitle) ?></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light">
                  <i class="<?= htmlspecialchars($c2_icon) ?> text-success fs-6 mt-1"></i>
                  <div>
                    <strong class="text-dark d-block"><?= htmlspecialchars($c2_title) ?></strong>
                    <span class="text-muted" style="font-size:11px;"><?= htmlspecialchars($c2_subtitle) ?></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light">
                  <i class="<?= htmlspecialchars($c3_icon) ?> text-primary fs-6 mt-1"></i>
                  <div>
                    <strong class="text-dark d-block"><?= htmlspecialchars($c3_title) ?></strong>
                    <span class="text-muted" style="font-size:11px;"><?= htmlspecialchars($c3_subtitle) ?></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light">
                  <i class="<?= htmlspecialchars($c4_icon) ?> text-warning fs-6 mt-1"></i>
                  <div>
                    <strong class="text-dark d-block"><?= htmlspecialchars($c4_title) ?></strong>
                    <span class="text-muted" style="font-size:11px;"><?= htmlspecialchars($c4_subtitle) ?></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-3 pt-3 border-top text-center text-sm-start d-flex flex-wrap justify-content-between align-items-center gap-2">
              <span class="text-muted small"><?= htmlspecialchars($vm_cta_text) ?></span>
              <a href="javascript:void(0)" onclick="openInquiryModal('<?= htmlspecialchars(addslashes($vm_cta_btn)) ?>')" class="btn btn-sm btn-outline-danger fw-bold rounded-pill px-3">
                <?= htmlspecialchars($vm_cta_btn) ?> <i class="bi bi-arrow-up-circle ms-1"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php endif; ?>

  </div>
</section>

<!-- Interactive Dual Inquiry Modal -->
<div class="modal fade" id="inquiryChoiceModal" tabindex="-1" aria-labelledby="inquiryChoiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
      <div class="modal-header bg-danger text-white p-3 p-md-4 border-0">
        <div>
          <h5 class="modal-title fw-bold text-white mb-0" id="inquiryChoiceModalLabel">
            <i class="bi bi-lightning-charge-fill text-warning me-2"></i> Get Shifting Estimate
          </h5>
          <small class="text-white-50 d-block mt-1" id="inquiry-service-subtitle">Choose your preferred inquiry method</small>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4 bg-white">
        
        <!-- Option 1: Fast Callback Inquiry -->
        <div class="card border border-success border-opacity-25 rounded-3 mb-3 bg-success bg-opacity-10 p-3">
          <div class="d-flex align-items-start gap-3">
            <div class="bg-success text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; flex-shrink: 0;">
              <i class="bi bi-telephone-inbound-fill fs-5"></i>
            </div>
            <div class="flex-grow-1">
              <h6 class="fw-bold text-dark mb-1">Option 1: Quick Call Back (Fast Lead)</h6>
              <p class="text-muted small mb-2">Enter phone number to get instant callback within 5 minutes.</p>
              
              <form id="quickInquiryForm" class="d-flex flex-column flex-sm-row gap-2">
                <input type="hidden" name="service_type" id="quick_service_type" value="Instant Quote">
                <input type="hidden" name="source_page" value="Homepage Calculator Modal">
                <input type="tel" name="phone" id="quick_phone_input" class="form-control form-control-sm border-success fw-semibold" placeholder="10-digit mobile number" maxlength="10" required>
                <button type="submit" class="btn btn-sm btn-success fw-bold text-nowrap px-3" id="quick_submit_btn">
                  <i class="bi bi-telephone-fill me-1"></i> Call Me Back
                </button>
              </form>
              <div id="quickInquiryAlert" class="mt-2 small d-none"></div>
            </div>
          </div>
        </div>

        <div class="text-center my-3 position-relative">
          <hr class="my-2">
          <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 text-muted small fw-bold">OR</span>
        </div>

        <!-- Option 2: Detailed Survey Form -->
        <div class="card border border-primary border-opacity-25 rounded-3 p-3 bg-primary bg-opacity-10">
          <div class="d-flex align-items-start gap-3">
            <div class="bg-primary text-white rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; flex-shrink: 0;">
              <i class="bi bi-file-earmark-text-fill fs-5"></i>
            </div>
            <div class="flex-grow-1">
              <h6 class="fw-bold text-dark mb-1">Option 2: Detailed Survey Form</h6>
              <p class="text-muted small mb-2">Fill full step-by-step form for itemized quotation & free survey.</p>
              <button type="button" class="btn btn-sm btn-primary fw-bold w-100" id="btn-goto-full-form">
                <i class="bi bi-pencil-square me-1"></i> Fill Complete Form Above
              </button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<script>
var currentSelectedService = 'Instant Shifting Quote';

function openInquiryModal(serviceTitle) {
  currentSelectedService = serviceTitle || 'Instant Shifting Quote';
  $('#inquiry-service-subtitle').text('Service: ' + currentSelectedService);
  $('#quick_service_type').val(currentSelectedService);
  $('#quickInquiryAlert').addClass('d-none').removeClass('alert-success alert-danger').text('');
  
  var modalEl = document.getElementById('inquiryChoiceModal');
  if (modalEl) {
    if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
      var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
      modal.show();
    } else if (typeof $ !== 'undefined' && $.fn.modal) {
      $('#inquiryChoiceModal').modal('show');
    } else {
      scrollToQuoteForm(serviceTitle);
    }
  } else {
    scrollToQuoteForm(serviceTitle);
  }
}

function scrollToQuoteForm(serviceTitle) {
  var target = $('#quote-form-section, #service_form, .service-form-section, .booking-card');
  if (target.length) {
    $('html, body').animate({
      scrollTop: target.first().offset().top - 90
    }, 600, function() {
      var firstInput = $('#form_user_name, #service_movingfrom');
      if (firstInput.length) {
        firstInput.first().focus();
      }
    });
  }
}

if (typeof jQuery !== 'undefined') {
  jQuery(document).ready(function($) {
    if ($('#inquiryChoiceModal').length) {
      $('#inquiryChoiceModal').appendTo('body');
    }

    $('#btn-goto-full-form').on('click', function() {
      var modalEl = document.getElementById('inquiryChoiceModal');
      if (modalEl) {
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
          var modal = bootstrap.Modal.getInstance(modalEl);
          if (modal) modal.hide();
        } else if (typeof $ !== 'undefined' && $.fn.modal) {
          $('#inquiryChoiceModal').modal('hide');
        }
      }
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open').css('overflow', '');
      scrollToQuoteForm(currentSelectedService);
    });

    $('#quickInquiryForm').on('submit', function(e) {
      e.preventDefault();
      var btn = $('#quick_submit_btn');
      var alertBox = $('#quickInquiryAlert');
      var phoneVal = $('#quick_phone_input').val();

      if (!phoneVal || phoneVal.length < 10) {
        alertBox.removeClass('d-none alert-success').addClass('alert alert-danger py-1 px-2 mb-0').text('Please enter a valid 10-digit mobile number.');
        return;
      }

      btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Submitting...');
      alertBox.addClass('d-none');

      $.ajax({
        url: '<?= base_url('contacts/submit-quick-inquiry') ?>',
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(res) {
          btn.prop('disabled', false).html('<i class="bi bi-telephone-fill me-1"></i> Call Me Back');
          if (res.status === 'success') {
            alertBox.removeClass('d-none alert-danger').addClass('alert alert-success py-1 px-2 mb-0').text(res.message);
            $('#quick_phone_input').val('');
          } else {
            alertBox.removeClass('d-none alert-success').addClass('alert alert-danger py-1 px-2 mb-0').text(res.message);
          }
        },
        error: function() {
          btn.prop('disabled', false).html('<i class="bi bi-telephone-fill me-1"></i> Call Me Back');
          alertBox.removeClass('d-none alert-success').addClass('alert alert-danger py-1 px-2 mb-0').text('Submission failed. Please call us directly.');
        }
      });
    });
  });
}
</script>

<style>
#inquiryChoiceModal {
  z-index: 10550 !important;
}
.modal-backdrop {
  z-index: 10500 !important;
}
.usp-icon-wrap {
  width: 56px;
  height: 56px;
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-left: auto;
  margin-right: auto;
  font-size: 1.65rem;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.usp-icon-green  { background-color: rgba(25, 135, 84, 0.12) !important; color: #198754 !important; }
.usp-icon-blue   { background-color: rgba(13, 110, 253, 0.12) !important; color: #0d6efd !important; }
.usp-icon-orange { background-color: rgba(255, 87, 34, 0.12) !important; color: #ff5722 !important; }
.usp-icon-yellow { background-color: rgba(255, 193, 7, 0.18) !important; color: #d39e00 !important; }

.dynamic-usp-card {
  background: #ffffff;
  border: 1px solid rgba(0,0,0,0.06);
  box-shadow: 0 4px 15px rgba(0,0,0,0.03);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.dynamic-usp-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}
.dynamic-usp-card:hover .usp-icon-wrap {
  transform: scale(1.1);
}
.bg-primary-subtle { background-color: rgba(13, 110, 253, 0.12) !important; }
.bg-success-subtle { background-color: rgba(25, 135, 84, 0.12) !important; }
.bg-danger-subtle  { background-color: rgba(220, 53, 69, 0.12) !important; }
.bg-warning-subtle { background-color: rgba(255, 193, 7, 0.18) !important; }
.bg-info-subtle    { background-color: rgba(13, 202, 240, 0.12) !important; }

/* Custom Calculator Tabs & Price styling - matching footer base color #0B2562 */
.estimator-tabs .nav-link {
  color: #0B2562 !important;
  font-weight: 700;
  transition: all 0.25s ease;
}
.estimator-tabs .nav-link:hover:not(.active) {
  background-color: rgba(11, 37, 98, 0.08) !important;
  color: #0B2562 !important;
}
.estimator-tabs .nav-link.active {
  background: linear-gradient(180deg, #0B2562 0%, #001C66 100%) !important;
  color: #ffffff !important;
  box-shadow: 0 4px 14px rgba(11, 37, 98, 0.3) !important;
}
.calc-price-val,
.quote-estimator-box .text-primary {
  color: #0B2562 !important;
}
</style>
