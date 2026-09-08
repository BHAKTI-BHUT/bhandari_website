<?php include 'bolg_content.php'?>
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
							<a href="<?=site_url('blog/'.$blog['url'])?>"><img src="<?= base_url('assets/img/') . $blog['image']; ?>"
									class="img-fluid" alt="<?= $blog['title']; ?>" loading="lazy"></a>
						</div>
						<div class="gup_blg_grid_caption">
							<?php if (!empty($blog['category'])) { ?>
								<div class="blg_tag"><span><?= $blog['category']; ?></span></div>
							<?php } ?>
							<div class="blg_title">
								<h4><a href="<?=site_url('blog/'.$blog['url'])?>"><?= $blog['title']; ?></a></h4>
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
													<img src="<?= base_url('assets/img/blog/') . $blog['author_image']; ?>"
														class="img-fluid circle" width="35" alt="<?= $blog['category']; ?>" loading="lazy">
												</a></div>
										</div>
									</div>
								<?php } ?>
								<div class="crs_fl_last">
									<div class="foot_list_info">
										<ul>
											<li>
												<div class="elsio_ic"><i class="fa fa-eye text-success"></i></div>
												<div class="elsio_tx"><?= $blog['views']; ?></div>
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
					<a href="javascript:void(0);" class="btn gray rounded ft-medium">Load More Blogs<i
							class="lni lni-arrow-right ms-2"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>