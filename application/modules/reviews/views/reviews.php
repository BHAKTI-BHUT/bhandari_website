<main class="main">

<section class="py-5 text-white breadcrumb-section" style="background: linear-gradient(135deg, #FC5D09, #ff4b2b);">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center text-white">Our Customer Reviews</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
           Reviews
        </li>
      </ol>
    </nav>
  </div>
</section>

<div class="our-service-page py-5" style="min-height: 50vh; background-color: #fafafa;">
    <div ng-app="reviewsApp" ng-controller="reviewsctrl">
        <?php $this->load->view('reviews/reviewmodal') ?>
        
        <div class="container">
            <!-- Google Place Rating Banner -->
            <?php 
              $gData = function_exists('get_google_place_details') ? get_google_place_details() : [];
              $gRating = isset($gData['rating']) ? floatval($gData['rating']) : 4.9;
              $gTotal = isset($gData['user_ratings_total']) ? intval($gData['user_ratings_total']) : 18;
              $gUrl = isset($gData['url']) ? $gData['url'] : 'https://maps.google.com/?cid=11321227447965075053';
            ?>
            <div class="row mb-4 justify-content-center">
                <div class="col-md-8 col-12 text-center">
                    <div class="p-3 bg-white shadow-sm rounded-4 border d-flex align-items-center justify-content-around flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-google text-danger fs-2"></i>
                            <div class="text-start">
                                <div class="fw-bold text-dark fs-5">Google Business Rating</div>
                                <div class="text-muted small">Official Verified Location</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-1 text-warning fs-5">
                            <span class="fw-extrabold text-dark me-2 fs-4"><?= number_format($gRating, 1) ?></span>
                            <?php for($i=1; $i<=5; $i++): ?>
                                <i class="bi bi-star-fill"></i>
                            <?php endfor; ?>
                            <span class="text-muted small ms-2">(<?= $gTotal ?>+ Reviews)</span>
                        </div>
                        <a href="<?= htmlspecialchars($gUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i> View Google Listing
                        </a>
                    </div>
                </div>
            </div>

            <!-- Write a Review Button Row -->
            <div class="row mb-5">
                <div class="col-12 text-center">
                    <h3 class="fw-extrabold text-dark mb-2" style="font-size:1.85rem;">What Our Clients Say About Us</h3>
                    <p class="text-muted mb-4 max-w-600 mx-auto">We take pride in delivering professional packers and movers services. Read ratings from our verified shifting customers.</p>
                    <button type="button" class="btn write-review-btn px-5 py-3 fw-bold border-0 text-white shadow" data-bs-toggle="modal" data-bs-target="#rvwmdl" style="background: linear-gradient(135deg, #FC5D09 0%, #ff4b2b 100%); border-radius: 30px;">
                        Write a Review <i class="bi bi-pencil-square ms-2"></i>
                    </button>
                </div>
            </div>
            
            <!-- Reviews Grid -->
            <div class="row g-4">
                <?php
                $approvedReviews = function_exists('get_all_approved_reviews') ? get_all_approved_reviews() : [];
                if (empty($approvedReviews) && (!isset($reviews) || $reviews->num_rows() == 0)) {
                    echo "<div class='col-12'><p class='no-reviews-text text-muted py-5 text-center fs-5'><i class='bi bi-chat-left-quote text-danger fs-1 mb-3 d-block'></i>No reviews yet. Be the first to review!</p></div>";
                } else {
                    foreach ($approvedReviews as $r) {
                        $name     = htmlspecialchars($r['author_name']);
                        $photoUrl = isset($r['profile_photo_url']) ? htmlspecialchars($r['profile_photo_url']) : '';
                        $stars    = isset($r['rating']) ? intval($r['rating']) : 5;
                        $relTime  = isset($r['relative_time_description']) ? htmlspecialchars($r['relative_time_description']) : 'Verified Client';
                        $text     = isset($r['text']) ? htmlspecialchars($r['text']) : '';
                        $source   = isset($r['source']) ? $r['source'] : 'Website';

                        $nameParts = array_filter(explode(' ', trim($name)));
                        $initials  = '';
                        if (count($nameParts) >= 2) {
                            $initials = strtoupper(substr(reset($nameParts), 0, 1) . substr(end($nameParts), 0, 1));
                        } else {
                            $initials = strtoupper(substr($name, 0, 2));
                        }
                ?>
                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="single-review shadow-sm border border-light bg-white p-4 h-100 d-flex flex-column justify-content-between" itemprop="review" itemscope itemtype="https://schema.org/Review" style="border-radius: 12px; transition: transform 0.2s, box-shadow 0.2s;">
                                <meta itemprop="name" content="<?= $name ?> Review" />
                                <div itemprop="itemReviewed" itemscope itemtype="https://schema.org/LocalBusiness">
                                    <meta itemprop="name" content="Bhandari Packers and Movers" />
                                </div>
                                
                                <div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <!-- Author Profile -->
                                        <div class="d-flex align-items-center gap-3">
                                            <?php if ($photoUrl): ?>
                                                <img src="<?= $photoUrl ?>" alt="<?= $name ?>" class="rounded-circle" style="width: 44px; height: 44px; object-fit: cover;" referrerpolicy="no-referrer" loading="lazy" onerror="this.style.display='none'; if (this.nextElementSibling) this.nextElementSibling.style.display='flex';">
                                                <div class="avatar-circle d-none align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #FC5D09, #ff4b2b);">
                                                    <?= $initials ?>
                                                </div>
                                            <?php else: ?>
                                                <div class="avatar-circle d-flex align-items-center justify-content-center text-white fw-bold flex-shrink-0" style="width: 44px; height: 44px; border-radius: 50%; background: linear-gradient(135deg, #FC5D09, #ff4b2b);">
                                                    <?= $initials ?>
                                                </div>
                                            <?php endif; ?>
                                            <div>
                                                <h6 class="author-name mb-0 text-dark fw-bold" itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                    <span itemprop="name"><?= $name ?></span>
                                                </h6>
                                                <small class="review-date text-muted"><i class="bi bi-patch-check-fill text-primary me-1"></i><?= (strtolower($source) === 'google' ? 'Google Review' : 'Verified Review') ?> (<?= $relTime ?>)</small>
                                            </div>
                                        </div>
                                        
                                        <!-- Rating Stars -->
                                        <div class="review-rating text-end">
                                            <div class="stars-row mb-1">
                                                <?php for ($i = 0; $i < 5; $i++) { ?>
                                                    <i class="bi <?= $i < $stars ? 'bi-star-fill text-warning' : 'bi-star text-muted' ?>"></i>
                                                <?php } ?>
                                            </div>
                                            <small class="rating-val-badge badge bg-danger-subtle text-danger" style="border-radius: 4px;"><?= number_format($stars, 1) ?> / 5.0</small>
                                        </div>
                                    </div>

                                    <p class="review-body text-muted small lh-base mb-3" itemprop="reviewBody">"<?= nl2br($text) ?>"</p>
                                </div>

                                <div class="border-top pt-2 mt-2 d-flex justify-content-between align-items-center">
                                    <span class="review-email text-muted small"><i class="bi bi-shield-check text-success me-1"></i>Verified Relocation Client</span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle py-1 px-2" style="font-size: 0.72rem; border-radius: 4px;"><i class="bi bi-patch-check-fill me-1"></i><?= (strtolower($source) === 'google' ? 'Google Verified' : 'Admin Approved') ?></span>
                                </div>
                            </div>
                        </div>
                <?php }
                } ?>
                
                <!-- Pagination Row -->
                <div class="col-lg-12 mt-5">
                    <div class="pagination d-flex justify-content-center">
                        <?php echo $this->pagination->create_links() ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</main>

<style>
    /* Styling overrides for premium clean look */
    .single-review:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
        border-color: #f1a9ab !important;
    }
    .write-review-btn:hover {
        background: linear-gradient(135deg, #DD3802 0%, #FC5D09 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(252, 93, 9,0.35) !important;
    }
    
    /* Pagination style overrides */
    .styled-pagination li a {
        border-radius: 8px !important;
        margin: 0 4px;
        font-weight: 700;
        border: 1px solid #dee2e6;
        padding: 8px 16px;
        color: #495057;
        text-decoration: none;
        transition: all 0.2s;
    }
    .styled-pagination li a.active, .styled-pagination li a:hover {
        background-color: #FC5D09 !important;
        border-color: #FC5D09 !important;
        color: #fff !important;
    }
    
    /* Bootstrap icon size alignment */
    .review-rating .bi-star-fill { color: #fcc93a; font-size: 0.95rem; }
    .review-rating .bi-star { font-size: 0.95rem; }
    
    .bg-danger-subtle { background-color: #fde8e8 !important; }
    .bg-success-subtle { background-color: #e6f9ed !important; }
    .text-success { color: #1f8745 !important; }
    .border-success-subtle { border-color: #a3e6bb !important; }
</style>