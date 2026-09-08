<section class="py-5 text-white breadcrumb-section">
	<div class="container d-flex flex-column align-items-center justify-content-center text-center">
		<h1 class="mt-2 fw-bold text-center"><?= $title ?></h1>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0">
				<li class="breadcrumb-item">
					<a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
				</li>
				<li class="breadcrumb-item active text-white" aria-current="page">
					Our Blogs
				</li>
			</ol>
		</nav>
	</div>
</section>
<?php $blog_data = []; ?>
<section class="mt-3">
	<div class="container">
		<!-- row Start -->
		<div class="row">
			<?php
			foreach ($blog_details as $blog) {
				$blog_data['b_id'] = $blog['b_id'];
				$blog_data['page'] = "Blog";
				/* if (strtolower($blog['title']) == strtolower($title)) {  */ ?>
				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
					<div class="article_detail_wrapss single_article_wrap format-standard">
						<div class="article_body_wrap" itemscope itemtype="http://schema.org/BlogPosting">
							<div class="article_featured_image">
								<img class="img-fluid" src="<?= base_url('assets') ?>/uploads/blog/<?= $blog['image']; ?>"
									alt="<?= $blog['title']; ?>" itemprop="image">
							</div>
							<div class="article_top_info">
								<ul class="article_middle_info">
									<li>
										<a href="javascript:void(0);" itemprop="author" itemscope
											itemtype="http://schema.org/Person">
											<span class="icons"><i class="ti-user"></i></span>
											By: <span itemprop="name"><?= $blog['author']; ?></span>
										</a>
									</li>
									<li><a href="javascript:void(0);"><span class="icons"><i
													class="ti-eye"></i></span><?= rand(1, 10); ?>k</a></li>
									<li>
										<a href="javascript:void(0);">
											<span class="icons"><i class="fa fa-clock"></i></span>
											<span itemprop="datePublished"><?= $blog['date']; ?></span>
										</a>
									</li>
								</ul>
							</div>
							<!-- <h2 class="post-title" itemprop="headline"><?= $blog['title']; ?></h2>
							<p itemprop="description"><?= $blog['description']; ?></p> -->
							<div itemprop="articleBody">
								<?= $blog['blogDetails']; ?>
							</div>
							<meta itemprop="mainEntityOfPage"
								content="<?= base_url('blog/') . urlencode(strtolower(str_replace(' ', '-', $blog['title']))); ?>" />
						</div>
					</div>
				</div>
			<?php
				/* break;
			} */
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
										<img src="<?= base_url('assets') ?>/uploads/blog/<?= $blog['image']; ?>"
											alt="<?= $blog['title'] ?>" class="">
									</span>
									<span class="right">
										<a class="feed-title" href="<?= $blog['url'] ?>"><?= $blog['title'] ?></a>
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
<style>
	/* --- ARTICLE DETAIL PAGE --- */

	.article_detail_wrapss {
		background: #fff;
		padding: 25px;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
		margin-bottom: 30px;
	}

	/* Featured image */
	.article_featured_image img {
		width: 100%;
		height: 310px;
		object-fit: cover;
		border-radius: 12px;
		margin-bottom: 20px;
	}

	/* Article Info */
	.article_top_info {
		margin-bottom: 20px;
	}

	.article_middle_info {
		display: flex;
		align-items: center;
		gap: 22px;
		padding-left: 0;
	}

	.article_middle_info li {
		list-style: none;
		font-size: 15px;
	}

	.article_middle_info li a {
		display: flex;
		align-items: center;
		gap: 6px;
		color: #444;
		font-weight: 500;
		text-decoration: none;
	}

	.article_middle_info li .icons i {
		font-size: 15px;
		color: #e31e25;
	}

	/* Title */
	.post-title {
		font-size: 32px;
		font-weight: 700;
		margin-bottom: 15px;
		line-height: 1.3;
		color: #222;
	}

	/* Description & body */
	.article_body_wrap p {
		font-size: 17px;
		color: #444;
		line-height: 1.7;
	}

	/* Blog Content Body */
	.article_body_wrap {
		margin-top: 15px;
	}

	.article_body_wrap img {
		max-width: 100%;
		border-radius: 10px;
	}

	/* --- SIDEBAR WIDGET: TRENDING POSTS --- */

	.widget_thumb_post {
		background: #fff;
		padding: 20px;
		border-radius: 12px;
		box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
	}

	.widget_thumb_post .title {
		font-size: 22px;
		font-weight: 700;
		margin-bottom: 20px;
		color: #222;
	}

	/* Trending posts list */
	.widget_thumb_post ul {
		padding: 0;
	}

	.widget_thumb_post ul li {
		display: flex;
		align-items: flex-start;
		gap: 12px;
		margin-bottom: 18px;
		list-style: none;
	}

	.widget_thumb_post ul li:last-child {
		margin-bottom: 0;
	}

	/* Thumbnail */
	.widget_thumb_post ul li img {
		width: 85px;
		height: 65px;
		object-fit: cover;
		border-radius: 8px;
		box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
	}

	/* Trending info */
	.widget_thumb_post .feed-title {
		font-size: 16px;
		color: #222;
		font-weight: 600;
		display: block;
		text-decoration: none;
		line-height: 1.3;
	}

	.widget_thumb_post .feed-title:hover {
		color: #e31e25;
	}

	.widget_thumb_post .post-date {
		display: block;
		margin-top: 4px;
		font-size: 14px;
		color: #777;
	}

	.widget_thumb_post .post-date i {
		margin-right: 5px;
		color: #e31e25;
	}

	.fw-bold{
		font-weight: bold;
	}
</style>