<?php
$web_user = $this->session->userdata('web_user');
$user_name = isset($web_user['name']) ? $web_user['name'] : '';
$user_phone = isset($web_user['mobile']) ? $web_user['mobile'] : (isset($web_user['phone']) ? $web_user['phone'] : '');
$user_email = isset($web_user['email']) ? $web_user['email'] : '';

if ($web_user && empty($user_email) && !empty($web_user['id'])) {
    try {
        $admin_db = $this->load->database('admin_hub', TRUE);
        if ($admin_db) {
            $user_rec = $admin_db->where('id', $web_user['id'])->get('users')->row();
            if ($user_rec && !empty($user_rec->email)) {
                $user_email = $user_rec->email;
            }
        }
    } catch (\Exception $e) {}
}
?>
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center">Contact Us</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
          Connect with us
        </li>
      </ol>
    </nav>
  </div>
</section>
<div class="content py-3">
    <div class="container">
        <div class="row align-items-center row-gap-4">
            <div class="col-xl-7 col-lg-7">
                <div class="mb-4 mb-lg-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mb-3"><span class="dark-red">Reach Out</span> to Our Dedicated Support Team<span class="dark-red">.</span></h2>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="mb-2">Our team is ready to help. Your satisfaction is our priority</span>
                        <p>Let's plan your perfect move together. Contact us for a free quote and discover why thousands of customers trust us for their relocation needs.</p>
                    </div>
                    <div class="border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-envelope fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Email Address</p>
                                <span class="text-black fs-16"><a class="text-decoration-none dark-red" href="<?=$mailhtml?>"><?=$mail?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-phone fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Phone Number</p>
                                <span class="text-black fs-16"><a class="text-decoration-none dark-red" href="<?=$phonehtml?>"><?=$phone?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-clock fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Business Hours</p>
                                <span class="text-black fs-16"><?= !empty($businessHours) ? $businessHours : 'Mon-Sat: 9AM - 6PM' ?></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-location-dot fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Our Address</p>
                                <span class="text-black fs-16"><address class="mb-0"><?=$address?></address></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="card bg-gray shadow-none mb-0">
                    <div class="card-body p-3">
                        <div class="mb-3">
                            <h2 class="mb-1 fw-bold">Get in Touch</h2>
                            <p class="text-black fs-16 mb-1">How we can help you? Please write down your query</p>
                        </div>
                        <form method="post" id="getintouchform" onsubmit="return false" class="row flex-column">
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Full Name</b> <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="<?= htmlspecialchars($user_name) ?>" placeholder="Full Name" class="form-control">
                            </div>
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Email</b> <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?= htmlspecialchars($user_email) ?>" placeholder="Email Address" class="form-control">
                            </div>
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Phone</b> <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" value="<?= htmlspecialchars($user_phone) ?>" placeholder="Phone Number" class="form-control">
                            </div>      
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Message</b> <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" placeholder="Your Message" rows="3"></textarea>
                            </div>
                            <div class="col-12 form_box">
                                <div class="d-flex my-3">
                                    <button type="button" id="submitcontactbtn" class="btn btn-danger text-white">
                                        Send Message &nbsp;<i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12" id="resulttouch"></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php 
  $googlePlaceData = function_exists('get_google_place_details') ? get_google_place_details() : [];
  $gPlaceRating    = isset($googlePlaceData['rating']) ? floatval($googlePlaceData['rating']) : 4.9;
  $gPlaceTotal     = isset($googlePlaceData['user_ratings_total']) ? intval($googlePlaceData['user_ratings_total']) : 18;
  $gPlaceReviews   = function_exists('get_all_approved_reviews') ? get_all_approved_reviews() : (isset($googlePlaceData['reviews']) ? $googlePlaceData['reviews'] : []);
  $gPlaceUrl       = isset($googlePlaceData['url']) ? $googlePlaceData['url'] : 'https://maps.google.com/?cid=11321227447965075053';
  $gAddress        = isset($googlePlaceData['formatted_address']) ? $googlePlaceData['formatted_address'] : 'Office No. 504, Baba Arcade, Harola, Sector 5, Noida, Uttar Pradesh 201301, India';
  $mapEmbedUrl     = (!empty($page_setting) && !empty($page_setting->map_iframe_url)) ? $page_setting->map_iframe_url : 'https://www.google.com/maps?q=Office+No+504,+5th+floor+baba+Arcade,+Harola+Sector+5,+Noida,+Gautam+Budh+Nagar,+Uttar+Pradesh+201301,+India&output=embed';
?>

<!-- ===== GOOGLE BUSINESS PROFILE & MAP SECTION ===== -->
<section class="py-5 bg-light border-top" id="google-business-section">
  <div class="container">
    <!-- Header & Action Buttons -->
    <div class="row align-items-center mb-4">
      <div class="col-lg-8">
        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
          <span class="badge bg-white text-danger border px-3 py-2 fs-6 shadow-sm rounded-pill d-inline-flex align-items-center">
            <i class="bi bi-google me-2 fs-5"></i> Official Google Business Page
          </span>
          <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 fs-6 rounded-pill d-inline-flex align-items-center">
            <i class="bi bi-patch-check-fill me-1"></i> Verified Listing
          </span>
        </div>
        <h2 class="fw-bold mb-2">Find Us on Google Business</h2>
        <p class="text-muted mb-0">
          <i class="bi bi-geo-alt-fill text-danger me-1"></i> <?= htmlspecialchars($gAddress) ?>
        </p>
      </div>
      <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
        <div class="d-flex flex-column flex-sm-row justify-content-lg-end gap-2">
          <a href="<?= htmlspecialchars($gPlaceUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-danger text-white px-4 py-2 shadow-sm fw-bold">
            <i class="bi bi-google me-2"></i> Google Business Page
          </a>
          <a href="https://maps.google.com/?q=<?= urlencode($gAddress) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-dark px-3 py-2 fw-bold">
            <i class="bi bi-compass-fill me-1"></i> Get Directions
          </a>
        </div>
      </div>
    </div>

    <!-- Rating Summary & Interactive Map -->
    <div class="row g-4 mb-4">
      <!-- Google Rating Card -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 h-100 bg-white">
          <div class="card-body p-4 d-flex flex-column justify-content-between">
            <div>
              <div class="d-flex align-items-center mb-3">
                <i class="bi bi-google text-danger display-5 me-3"></i>
                <div>
                  <h4 class="fw-bold mb-0">Bhandari Packers</h4>
                  <small class="text-muted">Packers and Movers in Noida</small>
                </div>
              </div>
              <hr class="my-3">
              <div class="text-center py-3 bg-light rounded-3 mb-3">
                <div class="display-4 fw-bold text-dark mb-0"><?= number_format($gPlaceRating, 1) ?></div>
                <div class="text-warning fs-5 my-1">
                  <?php for ($s = 1; $s <= 5; $s++): ?>
                    <i class="bi bi-star-fill"></i>
                  <?php endfor; ?>
                </div>
                <div class="text-muted small fw-bold">Based on <?= $gPlaceTotal ?>+ Verified Google Reviews</div>
              </div>
              <ul class="list-unstyled mb-0 text-secondary small">
                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> 100% Verified Google Listing</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> ISO 9001:2015 Certified Relocation</li>
                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i> Live Location &amp; Easy Directions</li>
              </ul>
            </div>
            <div class="mt-4 pt-2 border-top">
              <a href="<?= htmlspecialchars($gPlaceUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-danger w-100 fw-bold">
                <i class="bi bi-star-fill text-warning me-1"></i> Write a Google Review
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Google Maps Embedded -->
      <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden h-100">
          <div class="card-header bg-white py-3 border-0 d-flex align-items-center justify-content-between">
            <span class="fw-bold text-dark"><i class="bi bi-map-fill text-danger me-2"></i> Google Maps Location</span>
            <a href="<?= htmlspecialchars($gPlaceUrl) ?>" target="_blank" rel="noopener noreferrer" class="small text-danger text-decoration-none fw-bold">
              Open in Google Maps <i class="bi bi-box-arrow-up-right ms-1"></i>
            </a>
          </div>
          <div class="card-body p-0" style="min-height: 380px;">
            <iframe 
              src="<?= htmlspecialchars($mapEmbedUrl) ?>" 
              width="100%" 
              height="100%" 
              style="border:0; min-height: 380px;" 
              allowfullscreen="" 
              loading="lazy" 
              referrerpolicy="no-referrer-when-downgrade">
            </iframe>
          </div>
        </div>
      </div>
    </div>

    <!-- Google Customer Reviews -->
    <?php if (!empty($gPlaceReviews)): ?>
    <div class="mt-4 pt-3 border-top">
      <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
          <h3 class="fw-bold mb-1"><i class="bi bi-chat-square-quote-fill text-danger me-2"></i> Google Reviews</h3>
          <p class="text-muted small mb-0">Genuine feedback &amp; ratings from our valued customers on Google Maps</p>
        </div>
        <a href="<?= htmlspecialchars($gPlaceUrl) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-outline-danger fw-bold">
          View All on Google <i class="bi bi-arrow-right ms-1"></i>
        </a>
      </div>

      <div class="row g-3">
        <?php foreach (array_slice($gPlaceReviews, 0, 4) as $rev): ?>
          <?php 
            $authorName = isset($rev['author_name']) ? htmlspecialchars($rev['author_name']) : 'Verified Customer';
            $photoUrl   = isset($rev['profile_photo_url']) ? htmlspecialchars($rev['profile_photo_url']) : '';
            $stars      = isset($rev['rating']) ? intval($rev['rating']) : 5;
            $relTime    = isset($rev['relative_time_description']) ? htmlspecialchars($rev['relative_time_description']) : 'Recently';
            $text       = isset($rev['text']) ? htmlspecialchars($rev['text']) : '';

            $nameParts = array_filter(explode(' ', trim($authorName)));
            $initials  = '';
            if (count($nameParts) >= 2) {
                $initials = strtoupper(substr(reset($nameParts), 0, 1) . substr(end($nameParts), 0, 1));
            } else {
                $initials = strtoupper(substr($authorName, 0, 2));
            }
          ?>
          <div class="col-md-6 col-lg-3">
            <div class="card h-100 border-0 shadow-sm rounded-3">
              <div class="card-body p-3 d-flex flex-column">
                <div class="d-flex align-items-center mb-2">
                  <?php if ($photoUrl): ?>
                    <img src="<?= $photoUrl ?>" alt="<?= $authorName ?>" class="rounded-circle me-2" style="width:38px;height:38px;object-fit:cover;" referrerpolicy="no-referrer" loading="lazy" onerror="this.style.display='none'; if (this.nextElementSibling) this.nextElementSibling.style.display='flex';">
                    <div class="review-avatar me-2 rounded-circle bg-danger text-white d-flex align-items-center justify-content-center fw-bold" style="width:38px;height:38px;font-size:14px;display:none;"><?= $initials ?></div>
                  <?php else: ?>
                    <div class="review-avatar me-2 rounded-circle bg-danger text-white d-flex align-items-center justify-content-center fw-bold" style="width:38px;height:38px;font-size:14px;"><?= $initials ?></div>
                  <?php endif; ?>
                  <div class="overflow-hidden">
                    <span class="card-title fw-bold mb-0 d-block text-truncate small"><?= $authorName ?></span>
                    <small class="text-muted d-block" style="font-size: 11px;"><i class="bi bi-google text-danger me-1"></i>Review (<?= $relTime ?>)</small>
                  </div>
                </div>
                <div class="text-warning mb-2 small">
                  <?php for ($s = 1; $s <= 5; $s++): ?>
                    <i class="bi bi-star<?= ($s <= $stars) ? '-fill' : '' ?>"></i>
                  <?php endfor; ?>
                </div>
                <p class="card-text flex-grow-1 fst-italic text-muted small mb-0">
                  "<?= (strlen($text) > 120) ? substr($text, 0, 117) . '...' : $text ?>"
                </p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endif; ?>
  </div>
</section>

<script type="text/javascript">
    $(function () {
        $('#submitcontactbtn').click(function () {
            var name = $.trim($('#getintouchform input[name="name"]').val());
            var email = $.trim($('#getintouchform input[name="email"]').val());
            var phone = $.trim($('#getintouchform input[name="phone"]').val());
            var message = $.trim($('#getintouchform textarea[name="message"]').val());

            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            var phoneRegex = /^[6-9]\d{9}$/;

            $('#getintouchform input, #getintouchform textarea').removeClass('is-invalid');
            $('#resulttouch').empty();

            if (name === "") {
                $('#getintouchform input[name="name"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter your full name.</div>');
                return false;
            }

            if (email === "" || !emailRegex.test(email)) {
                $('#getintouchform input[name="email"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter a valid email address.</div>');
                return false;
            }

            if (phone === "" || !phoneRegex.test(phone)) {
                $('#getintouchform input[name="phone"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter a valid 10-digit phone number.</div>');
                return false;
            }

            if (message === "") {
                $('#getintouchform textarea[name="message"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter your message.</div>');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('contacts/contact'); ?>",
                data: $("#getintouchform").serialize(),
                beforeSend: function () {
                    $('#submitcontactbtn').prop('disabled', true).html('Sending... <i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#resulttouch').html('<p style="color: #FC5D09" class="mb-0">Please wait...</p>');
                },
                success: function (data) {
                    $('#submitcontactbtn').prop('disabled', false).html('Send Message &nbsp;<i class="fa-solid fa-paper-plane"></i>');
                    $('#resulttouch').empty();
                    
                    if ($.trim(data) == '1') {
                        $('#getintouchform textarea[name="message"]').val('');
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your message has been submitted successfully. We will contact you soon.',
                                icon: 'success',
                                confirmButtonColor: '#FC5D09',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            alert('Your message has been submitted successfully. We will contact you soon.');
                        }
                    } else {
                        $('#resulttouch').html(data);
                        setTimeout(function () {
                            $('#resulttouch').fadeOut('slow', function () {
                                $(this).empty().show();
                            });
                        }, 5000);
                    }
                },
                error: function () {
                    $('#submitcontactbtn').prop('disabled', false).html('Send Message &nbsp;<i class="fa-solid fa-paper-plane"></i>');
                    $('#resulttouch').html('<div class="alert alert-danger mb-0">Something went wrong. Please try again.</div>');
                }
            });
        });
    });
</script>