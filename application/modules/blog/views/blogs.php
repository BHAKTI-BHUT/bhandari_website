<?php
// include 'bolg_content.php';
$this->load->database();
$blogs = $this->db
	->select('*')
	->from('blog')
	->order_by('b_id', 'DESC')
	->limit(10)
	->get()
	->result_array();
// print_r($blogs);
?>
<section class="middle">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="sec_title position-relative text-center mb-5">
					<h6 class="theme-cl mb-0">Latest Blogs</h6>
					<h2 class="ft-bold">View Recent Updates</h2>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<?php foreach ($blogs as $blog) { ?>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
					<div class="gup_blg_grid_box">
						<div class="gup_blg_grid_thumb">
							<a href="<?= site_url('blog/' . $blog['url']) ?>"><img
									src="<?= base_url('assets/uploads/blog/') . $blog['image']; ?>" class="img-fluid"
									alt="<?= $blog['title']; ?>" loading="lazy"></a>
						</div>
						<div class="gup_blg_grid_caption">
							<?php if (!empty($blog['author'])) { ?>
								<div class="blg_tag"><span><?= $blog['author']; ?></span></div>
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

								<div class="crs_fl_first">
									<div class="crs_tutor">
										<div class="crs_tutor_thumb"><a href="javascript:void(0);">
												<img src="<?= base_url('assets/img/blog/anant_admin.svg') ?>"
													class="img-fluid circle" width="35" alt="<?= $blog['author']; ?>"
													loading="lazy">
											</a></div>
									</div>
								</div>

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
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="position-relative text-center">
					<a href="<?= site_url('blogs') ?>" class="btn gray rounded ft-medium">Read More Blogs<i
							class="lni lni-arrow-right ms-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<style>
	/* Overall section */
	section.middle {
		background: #f9f9fb;
		padding: 70px 0;
	}

	/* Title area */
	.sec_title h6 {
		font-size: 14px;
		letter-spacing: 1px;
		text-transform: uppercase;
		color: #ff6f3c;
	}

	.sec_title h2 {
		font-size: 32px;
		font-weight: 700;
		color: #222;
	}

	/* Blog Card */
	.gup_blg_grid_box {
		background: #fff;
		border-radius: 12px;
		border: 1px solid #e5e7eb;
		/* BORDER ADDED */
		overflow: hidden;
		margin-bottom: 35px;
		transition: all 0.3s ease;
		box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.05);
	}

	/* Hover effect */
	.gup_blg_grid_box:hover {
		border-color: #d0d4db;
		transform: translateY(-6px);
		box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.10);
	}

	/* Image */
	.gup_blg_grid_thumb img {
		width: 100%;
		height: 220px;
		object-fit: cover;
	}

	/* Content */
	.gup_blg_grid_caption {
		padding: 20px;
	}

	/* Author badge */
	.blg_tag span {
		background: #ff6f3c;
		color: #fff;
		padding: 6px 14px;
		border-radius: 50px;
		font-size: 12px;
		font-weight: 600;
	}

	/* Title */
	.blg_title h4 a {
		font-size: 20px;
		font-weight: 600;
		color: #222;
		margin-top: 10px;
		display: block;
		transition: 0.3s;
	}

	.blg_title h4 a:hover {
		color: #ff6f3c;
	}

	/* Description */
	.blg_desc p {
		font-size: 14px;
		color: #555;
		line-height: 1.6;
		margin-bottom: 0;
	}

	/* Footer area */
	.crs_grid_foot {
		background: #fafafa;
		border-top: 1px solid #eee;
	}

	.crs_flex {
		padding: 10px 18px !important;
	}

	/* Tutor image */
	.crs_tutor_thumb img {
		border-radius: 50%;
		border: 2px solid #eee;
	}

	/* Views + Date */
	.foot_list_info ul {
		display: flex;
		gap: 18px;
	}

	.foot_list_info ul li {
		display: flex;
		align-items: center;
		gap: 6px;
	}

	.elsio_tx {
		font-size: 13px;
		color: #333;
		font-weight: 500;
	}

	/* Read more button */
	.btn.gray {
		background: #222;
		color: #fff;
		padding: 12px 28px;
		border-radius: 6px;
		font-weight: 600;
		transition: 0.3s;
	}

	.btn.gray:hover {
		background: #000;
		transform: translateY(-3px);
	}
</style>