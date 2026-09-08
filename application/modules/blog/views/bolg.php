<section class="py-5 text-white breadcrumb-section">
    <div class="container d-flex flex-column align-items-center justify-content-center text-center">
        <h1 class="mt-2 fw-bold text-center">Our Blogs</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">
                    Bhandari Packers Blogs
                </li>
            </ol>
        </nav>
    </div>
</section>
<section class="middle mt-3">
    <div class="container">
        <div class="row justify-content-center">
            <?php foreach ($blogs as $blog) { ?>
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="gup_blg_grid_box">
                        <div class="gup_blg_grid_thumb">
                            <a href="<?= site_url('blog/' . $blog['url']) ?>"><img
                                    src="<?= base_url("assets/uploads/blog/") . $blog['image']; ?>" class="img-fluid"
                                    alt="<?= $blog['title']; ?>" loading="lazy"></a>
                        </div>
                        <div class="gup_blg_grid_caption">
                            <?php if (!empty($blog['category'])) { ?>
                                <div class="blg_tag"><span><?= $blog['category']; ?></span></div>
                            <?php } ?>
                            <div class="blg_title">
                                <h4><a href="<?= site_url('blog/' . $blog['url']) ?>"><?= $blog['title']; ?></a></h4>
                            </div>
                            <div class="blg_desc">
                                <p><?= $blog['description']; ?></p>
                            </div>
                        </div>
                        <div class="crs_grid_foot">
                            <div class="crs_flex d-flex align-items-center justify-content-between br-top px-3 py-2">
                                <?php if (!empty($blog['author_image'])) { ?>
                                    <div class="crs_fl_first">
                                        <div class="crs_tutor">
                                            <div class="crs_tutor_thumb"><a href="javascript:void(0);">
                                                    <img src="<?= base_url('assets/img/blog/anant_admin.svg') ?>"
                                                        class="img-fluid circle" width="35" alt="<?= $blog['category']; ?>"
                                                        loading="lazy">
                                                </a></div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="crs_fl_last">
                                    <div class="foot_list_info">
                                        <ul>
                                            <li>
                                                <div class="elsio_ic"><i class="fa fa-eye text-success"></i></div>
                                                <div class="elsio_tx"><?= rand(1, 10); ?>k</div>
                                            </li>
                                            <li>
                                                <div class="elsio_ic"><i class="fa fa-clock text-warning"></i></div>
                                                <div class="elsio_tx"><?= $blog['date']; ?></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 position-relative text-center">
                <div class="pagination pt-30 pb-70 pl-10">
                    <?php echo $this->pagination->create_links() ?>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    /* Blog Grid Box */
    .gup_blg_grid_box {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }

    .gup_blg_grid_box:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Smaller Image */
    .gup_blg_grid_thumb img {
        width: 100%;
        height: 180px;
        /* Reduced height */
        object-fit: cover;
        border-bottom: 1px solid #eee;
    }

    /* Caption styling */
    .gup_blg_grid_caption {
        padding: 18px 20px;
    }

    .blg_tag span {
        background: #e31e25;
        color: #fff;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }

    .blg_title h4 {
        font-size: 20px;
        font-weight: 600;
        margin-top: 12px;
        margin-bottom: 10px;
    }

    .blg_title h4 a {
        color: #222;
        text-decoration: none;
    }

    .blg_title h4 a:hover {
        color: #e31e25;
    }

    /* Description */
    .blg_desc p {
        font-size: 15px;
        color: #555;
        line-height: 1.6;
        margin: 0;
    }

    /* Footer */
    .crs_grid_foot {
        background: #f9f9f9;
        border-top: 1px solid #eee;
    }

    .crs_flex {
        padding: 12px 15px !important;
    }

    .foot_list_info ul {
        display: flex;
        gap: 18px;
        padding: 0;
        margin: 0;
    }

    .foot_list_info ul li {
        list-style: none;
        font-size: 14px;
        color: #444;
    }

    /* Pagination Styling */
    .pagination {
        display: inline-block;
        margin-top: 40px;
    }

    .pagination a {
        font-size: 16px;
        font-weight: 500;
        color: #e31e25;
        text-decoration: none;
        margin: 0 4px;
        border-radius: 50%;
        height: 40px;
        width: 40px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
        transition: 0.3s;
    }

    .pagination a:hover {
        background: #e31e25;
        color: #fff;
    }

    /* Active Page */
    .pagination strong {
        background: #e31e25 !important;
        color: #fff !important;
        border-radius: 50%;
        padding: 10px 15px;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
    }

    .foot_list_info ul li {
        display: flex;
        align-items: center;
        gap: 6px;
        /* space between icon & number */
        list-style: none;
    }

    .elsio_ic i {
        font-size: 15px;
    }

    .elsio_tx {
        font-size: 14px;
    }
</style>