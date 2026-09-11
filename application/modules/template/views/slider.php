<?php
$sliders_list = [];
try {
    $admin_db = $this->load->database('admin_hub', TRUE);
    if ($admin_db && $admin_db->conn_id) {
        $sliders_list = $admin_db->where('status', 1)->order_by('sort_order', 'asc')->get('home_sliders')->result();
    }
} catch (\Exception $e) {
    log_message('error', 'Home slider admin_hub DB error: ' . $e->getMessage());
}

// Fallback to default slides if database is empty
if (empty($sliders_list)) {
    $sliders_list = [
        (object)[
            'badge_text' => 'ISO 9001:2015 Certified, Govt Registered',
            'title' => 'Best Packers and Movers',
            'highlight_text' => 'in Noida.',
            'subtitle' => "Noida Packers and Movers offer trusted relocation solutions. \nHire the Best Packers and Movers in Noida for safe, affordable, and timely shifting services.",
            'image' => 'assets/images/slider/slide-1.webp',
            'btn1_text' => 'Get a Quote Now',
            'btn1_link' => '#qteModal',
            'btn2_text' => 'About Us',
            'btn2_link' => 'about',
        ],
        (object)[
            'badge_text' => 'Safe & Secure Relocation',
            'title' => 'Bhandari',
            'highlight_text' => 'Packers and movers.',
            'subtitle' => "Our trained professionals use high-quality \npacking materials and techniques to ensure complete safety of your belongings.",
            'image' => 'assets/images/slider/slide-2.webp',
            'btn1_text' => 'Call Us Now',
            'btn1_link' => 'contacts',
            'btn2_text' => 'Why Choose us',
            'btn2_link' => 'why-choose-us',
        ]
    ];
}

// Resolve image URLs for each slide
foreach ($sliders_list as $sl) {
    $img_url = base_url('assets/images/slider/slide-1.webp');
    if (!empty($sl->image)) {
        if (strpos($sl->image, 'http://') === 0 || strpos($sl->image, 'https://') === 0) {
            $img_url = $sl->image;
        } else if (strpos($sl->image, 'assets/') === 0) {
            $img_url = base_url($sl->image);
        } else if (file_exists(FCPATH . $sl->image)) {
            $img_url = base_url($sl->image);
        } else if (file_exists(FCPATH . 'uploads/sliders/' . basename($sl->image))) {
            $img_url = base_url('uploads/sliders/' . basename($sl->image));
        } else if (file_exists(FCPATH . '../bhandari_admin/public/' . $sl->image)) {
            $img_url = base_url('../bhandari_admin/public/' . $sl->image);
        } else {
            $img_url = $admin_base_url . (strpos($admin_base_url, 'localhost') !== false ? 'public/' : '') . $sl->image;
        }
    }
    $sl->bg_url = $img_url;
}
?>

<section class="hero-slider">
    <?php foreach ($sliders_list as $index => $slide): ?>
        <div class="slide slide-<?= ($index + 1) ?> <?= ($index === 0) ? 'active' : '' ?>">
            <div class="container">
                <div class="row d-flex flex-column justify-content-center align-items-start">
                    <div class="col-12 d-flex flex-column justify-content-center align-items-start mt-5">
                        <?php if (!empty($slide->badge_text)): ?>
                            <div class="certification-badge text-white fst-italic bg-danger">
                                <?= htmlspecialchars($slide->badge_text) ?>
                            </div>
                        <?php endif; ?>

                        <?php if ($index === 0): ?>
                        <h1 class="display-4 fw-bold mb-4 text-light text-center text-md-start">
                            <?= htmlspecialchars($slide->title) ?>
                            <?php if (!empty($slide->highlight_text)): ?>
                                <br><span class="color"><?= htmlspecialchars($slide->highlight_text) ?></span>
                            <?php endif; ?>
                        </h1>
                        <?php else: ?>
                        <h2 class="display-4 fw-bold mb-4 text-light text-center text-md-start">
                            <?= htmlspecialchars($slide->title) ?>
                            <?php if (!empty($slide->highlight_text)): ?>
                                <br><span class="color"><?= htmlspecialchars($slide->highlight_text) ?></span>
                            <?php endif; ?>
                        </h2>
                        <?php endif; ?>

                        <?php if (!empty($slide->subtitle)): ?>
                            <p class="lead mb-5 text-light fst-italic text-center text-md-start">
                                <?= nl2br(htmlspecialchars($slide->subtitle)) ?>
                            </p>
                        <?php endif; ?>

                        <div class="d-none d-md-flex flex-wrap flex-row justify-content-center align-items-start">
                            <?php if (!empty($slide->btn1_text)): ?>
                                <?php if ($slide->btn1_link == '#qteModal' || $slide->btn1_link == '#qtemodal'): ?>
                                    <a href="#qtemodal" data-bs-toggle="modal" data-bs-target="#qteModal" class="btn btn-danger bg-light-hover me-3 mb-3 text-white">
                                        <i class="bi bi-chat-quote me-2"></i><?= htmlspecialchars($slide->btn1_text) ?>
                                    </a>
                                <?php else: ?>
                                    <a href="<?= (strpos($slide->btn1_link, 'http') === 0) ? $slide->btn1_link : site_url($slide->btn1_link) ?>" class="btn btn-danger me-3 mb-3 text-white">
                                        <i class="bi bi-chat-quote me-2"></i><?= htmlspecialchars($slide->btn1_text) ?>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>

                            <?php if (!empty($slide->btn2_text)): ?>
                                <a href="<?= (strpos($slide->btn2_link, 'http') === 0) ? $slide->btn2_link : site_url($slide->btn2_link ?: 'about') ?>" class="btn btn-outline-light mb-3">
                                    <i class="bi bi-arrow-right-circle me-2"></i><?= htmlspecialchars($slide->btn2_text) ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

    <?php if (count($sliders_list) > 1): ?>
        <div class="slider-arrows d-none d-lg-flex">
            <button class="slider-arrow prev-arrow" aria-label="Previous Slide"><i class="bi bi-chevron-left"></i></button>
            <button class="slider-arrow next-arrow" aria-label="Next Slide"><i class="bi bi-chevron-right"></i></button>
        </div>
        <div class="slider-dots">
            <?php foreach ($sliders_list as $i => $s): ?>
                <div class="dot <?= ($i === 0) ? 'active' : '' ?>" data-slide="<?= $i ?>"></div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>

<style>
    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0,0,0,0.4);
        color: #fff;
        border: 2px solid rgba(255,255,255,0.5);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        font-size: 1.2rem;
        cursor: pointer;
        z-index: 20;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .slider-arrow:hover {
        background: #FC5D09;
        border-color: #FC5D09;
    }
    .prev-arrow { left: 20px; }
    .next-arrow { right: 20px; }
    @media (max-width: 991.98px) {
        .slider-arrows,
        .slider-arrow {
            display: none !important;
        }
    }

    <?php foreach ($sliders_list as $idx => $s): ?>
    .slide-<?= ($idx + 1) ?> {
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('<?= $s->bg_url ?>') !important;
        background-size: cover !important;
        background-position: center center !important;
        background-repeat: no-repeat !important;
    }
    <?php endforeach; ?>
</style>