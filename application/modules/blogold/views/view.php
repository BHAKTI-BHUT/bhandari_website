<?php include 'bolg_content.php' ?>
<section class="space-brd  bg-cover breadcrumb-section">
	<div class="container pt-5">
		<div class="row align-items-center justify-content-center">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
				<div class="sec_title position-relative text-center mb-5 breadcrumbs">
					<h1 class="ft-bold text-light">Our Blogs</h1>
					<ul class="breadcrumb-menu">
						<li><a href="<?= site_url() ?>">Home</a></li> <i class="fa-solid fa-angles-right"></i>
						<li class="active">Our Blogs</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="mt-3">

	<div class="container">

		<!-- row Start -->
		<div class="row">
			<?php
			foreach ($blogs as $blog) {
				if (strtolower($blog['title']) == strtolower($title)) { ?>
					<div class="col-lg-8 col-md-12 col-sm-12 col-12">
						<div class="article_detail_wrapss single_article_wrap format-standard">
							<div class="article_body_wrap" itemscope itemtype="http://schema.org/BlogPosting">
								<div class="article_featured_image">
									<img class="img-fluid" src="<?= base_url('assets') ?>/img/<?= $blog['image']; ?>"
										alt="<?= $blog['title']; ?>" itemprop="image">
								</div>
								<div class="article_top_info">
									<ul class="article_middle_info">
										<li>
											<a href="javascript:void(0);" itemprop="author" itemscope
												itemtype="http://schema.org/Person">
												<span class="icons"><i class="ti-user"></i></span>
												by <span itemprop="name"><?= $blog['category']; ?></span>
											</a>
										</li>
										<li><a href="javascript:void(0);"><span class="icons"><i
														class="ti-eye"></i></span><?= $blog['views']; ?></a></li>
										<li>
											<a href="javascript:void(0);">
												<span class="icons"><i class="fa fa-clock"></i></span>
												<span itemprop="datePublished"><?= $blog['date']; ?></span>
											</a>
										</li>
									</ul>
								</div>
								<h2 class="post-title" itemprop="headline"><?= $blog['title']; ?></h2>
								<p itemprop="description"><?= $blog['description']; ?></p>
								<div itemprop="articleBody">
									<?= $blog['blogDetails']; ?>
								</div>
								<meta itemprop="mainEntityOfPage"
									content="<?= base_url('blog/') . urlencode(strtolower(str_replace(' ', '-', $blog['title']))); ?>" />
							</div>
						</div>
					</div>
					<?php
					break;
				}
			}
			?>
			<!-- Single blog Grid -->
			<div class="col-lg-4 col-md-12 col-sm-12 col-12">
				<!-- Trending Posts -->
				<div class="single_widgets widget_thumb_post">
					<h4 class="title">Trending Posts</h4>
					<ul>
						<?php
						foreach ($blogs as $blog) {
							if (strtolower($blog['title']) == strtolower($title)) {
								continue;
							} else {
								?>
								<li>
									<span class="left">
										<img src="<?= base_url('assets') ?>/img/<?= $blog['image'] ?>" alt="<?= $blog['title'] ?>"
											class="">
									</span>
									<span class="right">
										<a class="feed-title" href="<?=$blog['url'] ?>"><?= $blog['title'] ?></a>
										<span class="post-date"><i class="ti-calendar"></i><?= $blog['date'] ?></span>
									</span>
								</li>
								<?php
							}
						}
						?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>