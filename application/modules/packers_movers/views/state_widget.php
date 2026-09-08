<?php
if (!isset($branch_states) || empty($branch_states)) {
    $states_arr = array(
        array('title' => 'Maharashtra', 'img' => 'assets/images/state/maharastra.webp', 'href' => 'maharashtra'),
        array('title' => 'Delhi', 'img' => 'assets/images/state/delhi.webp', 'href' => 'delhi'),
        array('title' => 'Uttar Pradesh', 'img' => 'assets/images/state/uttar-pradesh.webp', 'href' => 'uttar-pradesh'),
        array('title' => 'Punjab', 'img' => 'assets/images/state/punjab.webp', 'href' => 'punjab'),
        array('title' => 'Noida', 'img' => 'assets/images/state/noida.png', 'href' => 'noida'), 
        array('title' => 'Greater Noida', 'img' => 'assets/images/state/greater-noida.png', 'href' => 'greater-noida'),
        array('title' => 'Haryana', 'img' => 'assets/images/state/haryana.png', 'href' => 'haryana'),
        array('title' => 'Gurgaon', 'img' => 'assets/images/state/gurgaon.png', 'href' => 'gurgaon'),
    );
}
?>
<div class="st-service-area pt-3 pb-5" data-animate="bottom" data-delay="1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="st_section_title mb-50 text-center wow fadeInUp">
                    <span class="section-head mt-3"> All India Services </span>
                    <span class="circle"></span>
                </div>
            </div>
            <?php if (isset($branch_states) && !empty($branch_states)): ?>
                <?php foreach ($branch_states as $b): ?>
                    <?php 
                        $img_url = base_url('assets/images/state/delhi.webp');
                        if (!empty($b->image)) {
                            if (strpos($b->image, 'http://') === 0 || strpos($b->image, 'https://') === 0) {
                                $img_url = $b->image;
                            } else if (strpos($b->image, 'assets/') === 0) {
                                $img_url = base_url($b->image);
                            } else if (file_exists(FCPATH . $b->image)) {
                                $img_url = base_url($b->image);
                            } else if (file_exists(FCPATH . 'uploads/branches/' . basename($b->image))) {
                                $img_url = base_url('uploads/branches/' . basename($b->image));
                            } else if (file_exists(FCPATH . 'admin/' . $b->image)) {
                                $img_url = base_url('admin/' . $b->image);
                            } else if (file_exists(FCPATH . '../bhandari_admin/public/' . $b->image)) {
                                $img_url = base_url('../bhandari_admin/public/' . $b->image);
                            } else {
                                $img_url = $admin_base_url . (strpos($admin_base_url, 'localhost') !== false ? 'public/' : '') . $b->image;
                            }
                        }
                    ?>
                    <div class="col-lg-3 col-md-6 mt-4 wow fadeInUp">
                        <a href="<?= site_url('/') . $b->slug; ?>" alt="<?= htmlspecialchars($b->name); ?>">
                            <div class="st_service_box">
                                <div class="st_service_thumb">
                                    <img src="<?= $img_url; ?>" alt="<?= htmlspecialchars($b->name); ?> image" loading="lazy" style="height: 200px; width: 100%; object-fit: cover;" />
                                </div>
                                <div class="st_service_content">
                                    <span class="state_title"> <?= htmlspecialchars($b->name); ?> </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?php foreach ($states_arr as $city): ?>
                    <div class="col-lg-3 col-md-6 mt-4 wow fadeInUp">
                        <a href="<?= site_url('/') . $city['href']; ?>" alt="<?= $city['title']; ?>">
                            <div class="st_service_box">
                                <div class="st_service_thumb">
                                    <img src="<?= base_url() . $city['img']; ?>" alt="<?= $city['title']; ?> image" loading="lazy" />
                                </div>
                                <div class="st_service_content">
                                    <span class="state_title"> <?= $city['title']; ?> </span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<style>
    .breadcrumb-section{background:linear-gradient(90deg,#FC5D09,#DD3802)}.color{color:#FC5D09}.st_service_box{position:relative;overflow:hidden;border:2px solid #ddd;border-radius:10px;background-color:#fff;text-align:center;transition:transform 0.3s ease,box-shadow 0.3s ease;cursor:pointer}.st_service_box:hover{transform:translateY(-10px);box-shadow:0 10px 20px rgb(0 0 0 / .2);border-color:#FC5D09}.st_service_thumb{position:relative}.st_service_thumb img{width:100%;height:auto;display:block;transition:transform 0.3s ease}.st_servicebox:hover .stservice_thumb img{transform:scale(1.1)}.st_service_thumb::after{content:"";position:absolute;top:0;left:0;width:100%;height:100%;background:rgb(0 0 0 / .6);opacity:0;transition:opacity 0.3s ease;z-index:1}.st_servicebox:hover .stservice_thumb::after{opacity:1}.st_service_content{position:absolute;bottom:15px;left:50%;transform:translateX(-50%);font-family:"Poppins",sans-serif;font-size:16px;font-weight:600;color:#fff;background: linear-gradient(45deg, #FC5D09, #DD3802);padding:10px 20px;border-radius:20px;transition:all 0.3s ease;z-index:2}.st_servicebox:hover .stservice_content{bottom:35%;transform:translateX(-50%);background:#fff0;font-size:18px;color:#fff;font-weight:700;border-radius:0}.state_title{text-wrap-mode:nowrap}.city-card{border:2px solid #ddd;border-radius:10px;overflow:hidden;transition:transform 0.3s ease,box-shadow 0.3s ease;cursor:pointer}.city-card:hover{transform:translateY(-10px);box-shadow:0 10px 20px rgb(0 0 0 / .2);border-color:#df0}.city-content h2,.city-content h3,.city-content h4,.city-content h5,.city-content h6{font-size:32px;font-weight:700}
</style>