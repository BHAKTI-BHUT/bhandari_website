<?php
$page_title = (!empty($page_setting) && !empty($page_setting->title)) ? $page_setting->title : 'Why Choose Us';
$grid_title = (!empty($page_setting) && !empty($page_setting->subtitle_title)) ? $page_setting->subtitle_title : 'Why Choose <span class="text-danger">Bhandari Packers and Movers</span>?';
$hero_img = base_url('assets/images/gallery/newabout.png');
if (!empty($page_setting) && !empty($page_setting->image)) {
    $img_raw = trim($page_setting->image);
    if (strpos($img_raw, 'http://') === 0 || strpos($img_raw, 'https://') === 0) {
        $hero_img = $img_raw;
    } else if (file_exists(FCPATH . $img_raw)) {
        $hero_img = base_url($img_raw);
    } else if (file_exists(FCPATH . 'uploads/why_choose_us/' . basename($img_raw))) {
        $hero_img = base_url('uploads/why_choose_us/' . basename($img_raw));
    } else if (file_exists(FCPATH . '../bhandari_admin/public/' . $img_raw)) {
        $hero_img = base_url('../bhandari_admin/public/' . $img_raw);
    } else if (!empty($admin_base_url)) {
        $hero_img = rtrim($admin_base_url, '/') . '/' . ltrim($img_raw, '/');
    }
}
$main_desc = (!empty($page_setting) && !empty($page_setting->description)) ? $page_setting->description : 'With years of hands-on skills in logistics and the relocation industry,<span class="color">Bhandari Packers and Movers</span> have put the hours in and learned how to do every move with excellence. Our professional team is made up of experts in packing and moving your items, - to ensure that each item is packed, loaded, transported and delivered safely and efficiently. Everyone on our team has gone through time consuming advanced packing training and only uses the best materials available to ensure your valuables are secure while in the move.';
$grid_desc = (!empty($page_setting) && !empty($page_setting->grid_description)) ? $page_setting->grid_description : 'Our company has earned the business of over thousands of happy customers across India, because we are honest, professional, and dependable! Our <b>Packers and Movers reviews</b> reflect our great reputation and ongoing commitment to excellence when delivering moving services.';
?>
<style>
    .breadcrumb-section{
        background: linear-gradient(90deg, #FC5D09, #DD3802);
    }
    .color{
      color:#FC5D09;
      font-weight: bold;
    }
</style>
<!-- Breadcrumb Section with Gradient Background -->
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center"><?= htmlspecialchars($page_title) ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
          Best choice Bhandari packers and movers
        </li>
      </ol>
    </nav>
  </div>
</section>
<main class="main">
 <!--about section-->
<section class="py-5" id="about">
    <div class="container py-5 pt-0">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0 animate">
                <img src="<?= $hero_img ?>" alt="<?= htmlspecialchars($page_title) ?>" width="600" height="420" class="img-fluid rounded shadow" loading="lazy" style="max-height: 420px; width: 100%; object-fit: cover;" onerror="this.onerror=null;this.src='<?= base_url('assets/images/gallery/newabout.png') ?>';">
            </div>
            <div class="col-lg-6 animate delay-1">
                <h2 class="section-title text-start text-dark mb-4"><?= htmlspecialchars($page_title) ?></h2>
                <div class="text-dark mb-3">
                    <?= $main_desc ?>
                </div>
                <div class="row mt-4">
                    <?php if (!empty($hero_features)) { ?>
                        <?php foreach ($hero_features as $item) { ?>
                            <div class="col-md-6 mb-3">
                                <div class="d-flex">
                                    <div class="icon-box me-3">
                                        <i class="<?= htmlspecialchars($item->icon_class ?: 'bi bi-check2-circle') ?> text-primary fs-20"></i>
                                    </div>
                                    <div>
                                        <p class="mb-1 text-danger"><strong><?= htmlspecialchars($item->title) ?></strong></p>
                                        <p class="mb-0 text-dark"><?= htmlspecialchars($item->description) ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="container col-12 bg-light py-5">
  <div class="text-center mb-5">
    <h2 class="fw-bold text-dark"><?= (strpos($grid_title, '<') !== false) ? $grid_title : htmlspecialchars($grid_title) ?></h2>
    <p class="text-secondary col-md-8 mx-auto">
      <?= (strpos($grid_desc, '<') !== false) ? $grid_desc : htmlspecialchars($grid_desc) ?>
    </p>
  </div>

  <div class="row g-4">
    <?php if (!empty($value_cards)) { ?>
        <?php foreach ($value_cards as $card) { ?>
            <div class="col-md-4">
              <div class="card border-0 shadow-sm h-100 text-center p-4">
                <div class="display-4 text-danger mb-3"><i class="<?= htmlspecialchars($card->icon_class ?: 'bi bi-shield-check') ?>"></i></div>
                <h5 class="fw-bold text-dark"><?= htmlspecialchars($card->title) ?></h5>
                <p class="text-muted mb-0">
                  <?= htmlspecialchars($card->description) ?>
                </p>
              </div>
            </div>
        <?php } ?>
    <?php } ?>
  </div>
</div>
