<?php
// Load dynamic services for menus
$nav_services = [];
try {
    $admin_db = $this->load->database('admin_hub', TRUE);
    if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('our_services')) {
        $nav_services = $admin_db->where('status', 1)->order_by('sort_order', 'asc')->get('our_services')->result();
    }
} catch (Exception $e) {
    log_message('error', 'Nav services load error: ' . $e->getMessage());
}
?>
<div class="top-bar" style="background-color: #FC5D09; margin: 0; margin-top: 0;">
    <div class="container-fluid px-2 px-md-3">
        <div class="top-bar-scroll d-flex justify-content-start justify-content-md-between align-items-center text-white py-1">
            <div class="top-links text-white text-nowrap d-flex align-items-center">
                <a href="<?=site_url('services')?>" class="text-white text-decoration-none me-2"><small class="fw-bold">Our Services</small></a> | 
                <a href="<?=site_url('why-choose-us')?>" class="text-white text-decoration-none mx-2"><small class="fw-bold">Why Choose Us</small></a> | 
                <a href="<?=site_url('branches')?>" class="text-white text-decoration-none mx-2"><small class="fw-bold">Branch Address</small></a> | 
                <a href="tel:<?= $phone ?>" class="text-white text-decoration-none mx-2"><small class="fw-bold">Contact 24x7 <?= $phone ?></small></a> | 
                <a href="<?=site_url('reviews')?>" class="text-white text-decoration-none mx-2"><small class="fw-bold">Complain & Review</small></a> | 
                <small class="fw-bold ms-2 text-nowrap">* Since 2010 at your service *</small>
            </div>
        </div>
    </div>
</div>
<?php
  // Navbar me user login state check (CI session)
  $nav_user = $this->session->userdata('web_user');
  $nav_logged_in = !empty($nav_user);
  $nav_name = $nav_logged_in ? $nav_user['name'] : '';
  // Avatar: first letter of name
  $nav_initial = $nav_logged_in ? strtoupper(substr($nav_name, 0, 1)) : '';
?>
<style>
/* ─── Top Bar Styling & Mobile Smooth Ticker Scroll ─── */
.top-bar {
    background-color: #FC5D09;
    font-size: 0.78rem;
    padding: 3px 0;
    overflow-x: auto;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none; /* Firefox */
}
.top-bar::-webkit-scrollbar {
    display: none; /* Chrome/Safari */
}
.top-bar a:hover {
    text-decoration: underline !important;
}

/* ─── Main Navbar Responsive Container ─── */
.main-navbar {
    background-color: #fff;
    padding: 6px 0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    z-index: 600;
}
.main-navbar .container {
    padding-left: 10px;
    padding-right: 10px;
}

/* ─── Brand Logo & Text Styling ─── */
.brand-logo-img {
    height: 48px;
    width: auto;
    max-width: 58px;
    object-fit: contain;
    transition: transform 0.2s ease;
}
.brand-title-text {
    font-size: 1.45rem;
    font-weight: 700;
    white-space: nowrap;
    color: #FC5D09;
    letter-spacing: -0.2px;
}

/* ─── Action Buttons & Quote / Login Buttons ─── */
.action-buttons {
    display: flex;
    align-items: center;
    gap: 8px;
}
.nav-quote-btn {
    background-color: #FC5D09;
    color: #fff !important;
    border: none;
    padding: 6px 12px;
    font-size: 0.82rem;
    font-weight: 700;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    white-space: nowrap;
    line-height: 1.2;
    box-shadow: 0 2px 6px rgba(252, 93, 9, 0.25);
}
.nav-quote-btn:hover {
    background-color: #DD3802;
    color: #fff !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(252, 93, 9, 0.35);
}

/* ─── Navbar User Profile Dropdown ──────────────────────────── */
.nav-user-wrap {
    position: relative;
}
.nav-user-avatar {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    font-size: 0.95rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 2px 8px rgba(252, 93, 9,0.25);
    transition: all 0.2s ease;
}
.nav-user-avatar:hover { box-shadow: 0 4px 14px rgba(252, 93, 9,0.4); }
.nav-user-name {
    font-size: 0.82rem;
    font-weight: 700;
    color: #222;
    max-width: 90px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    cursor: pointer;
    line-height: 1.2;
}
.nav-user-name small {
    display: block;
    font-weight: 400;
    color: #888;
    font-size: 0.7rem;
}
.nav-user-dropdown {
    position: absolute;
    top: calc(100% + 10px);
    right: 0;
    min-width: 180px;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.13);
    z-index: 2000;
    overflow: hidden;
    display: none;
    border: 1px solid #f0f0f0;
}
.nav-user-dropdown.open { display: block; animation: ddFadeIn 0.18s ease; }
@keyframes ddFadeIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:translateY(0); } }
.nav-user-dropdown .dd-header {
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    padding: 14px 16px 12px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.nav-user-dropdown .dd-header .dd-avatar {
    width: 38px; height: 38px;
    border-radius: 50%;
    background: rgba(255,255,255,0.25);
    color: #fff;
    font-size: 1rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.nav-user-dropdown .dd-header .dd-info { flex: 1; min-width: 0; }
.nav-user-dropdown .dd-header .dd-info strong {
    display: block;
    font-size: 0.88rem;
    color: #fff;
    font-weight: 700;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.nav-user-dropdown .dd-header .dd-info span {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.82);
}
.nav-user-dropdown .dd-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px 16px;
    font-size: 0.88rem;
    color: #333;
    cursor: pointer;
    transition: background 0.15s;
    border: none;
    background: none;
    width: 100%;
    text-align: left;
    text-decoration: none;
}
.nav-user-dropdown .dd-item:hover { background: #fff5ed; color: #FC5D09; }
.nav-user-dropdown .dd-item i { font-size: 14px; color: #FC5D09; width: 16px; text-align: center; }
.nav-user-dropdown .dd-item.logout { color: #FC5D09; font-weight: 600; border-top: 1px solid #f5f5f5; }

/* Login button */
.nav-login-btn {
    background: none;
    border: 2px solid #FC5D09;
    color: #FC5D09;
    border-radius: 8px;
    padding: 5px 14px;
    font-size: 0.82rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}
.nav-login-btn:hover {
    background: #FC5D09;
    color: #fff;
}

.hamburger-btn {
    cursor: pointer;
    z-index: 1001;
    transition: transform 0.2s ease;
    padding: 4px 4px !important;
    margin-left: 2px;
}
.hamburger-btn:hover {
    transform: scale(1.08);
}
.hamburger-btn i {
    font-size: 1.5rem !important;
    color: #FC5D09;
}

/* ─── Mobile Devices Responsive Adjustments (<768px) ─── */
@media (max-width: 768px) {
    .main-navbar .container {
        padding-left: 6px;
        padding-right: 6px;
    }
    .brand-logo-img {
        height: 38px;
        max-width: 42px;
    }
    .brand-title-text {
        font-size: 1.05rem;
    }
    .action-buttons {
        gap: 4px !important;
    }
    .nav-quote-btn {
        padding: 5px 8px;
        font-size: 0.72rem;
        border-radius: 6px;
    }
    .nav-login-btn {
        padding: 4px 8px;
        font-size: 0.72rem;
        border-radius: 6px;
    }
    .nav-user-avatar {
        width: 32px;
        height: 32px;
        font-size: 0.82rem;
    }
    .hamburger-btn {
        padding: 2px 2px !important;
    }
    .hamburger-btn i {
        font-size: 1.35rem !important;
    }
}

/* ─── Ultra Small Phones (<380px e.g. iPhone SE / Galaxy Fold) ─── */
@media (max-width: 380px) {
    .main-navbar .container {
        padding-left: 4px;
        padding-right: 4px;
    }
    .brand-logo-img {
        height: 32px;
        max-width: 35px;
    }
    .brand-title-text {
        font-size: 0.9rem;
    }
    .action-buttons {
        gap: 3px !important;
    }
    .nav-quote-btn {
        padding: 4px 6px;
        font-size: 0.68rem;
    }
    .nav-login-btn {
        padding: 4px 6px;
        font-size: 0.68rem;
    }
}
.hover-red {
    transition: color 0.2s ease;
}
.hover-red:hover {
    color: #FC5D09 !important;
}
</style>
<nav class="main-navbar sticky-top">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a href="<?= site_url() ?>" class="navbar-brand d-flex align-items-center gap-1 gap-sm-2 me-0">
                <img src="<?= !empty($logo_url) ? $logo_url : base_url('assets/images/logo/logo.jpg') ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/logo/logo.jpg') ?>';" alt="Bhandari Packers Logo" width="60" height="60" class="brand-logo-img" loading="eager">
                <h2 class="mb-0 brand-title-text"><?= !empty($brand_short) ? $brand_short : 'Bhandari Packers' ?></h2>
            </a>
            <div class="action-buttons d-flex align-items-center">
                <a href="<?= $phonehtml ?>" class="phone-btn d-none d-md-flex align-items-center gap-2">
                    <i class="fa-solid fa-phone"></i> <?= $phone ?>
                </a>
                <a href="<?= site_url('online-booking') ?>" class="track-btn d-none d-lg-flex align-items-center gap-2" onclick="return handleBookShiftingClick(event, '<?= site_url('online-booking') ?>')">
                    <i class="fas fa-truck"></i> Book Shifting
                </a>

                <!-- Request Site Visit Button (Visible on all screens!) -->
                <a href="#qtemodal" data-bs-toggle="modal" data-bs-target="#qteModal" class="nav-quote-btn">
                    <span class="d-none d-sm-inline">Request </span>Site Visit <i class="fas fa-arrow-right ms-1" style="font-size: 0.8em;"></i>
                </a>

                <!-- ─── User Profile / Login ──────────────────────────── -->
                <div class="nav-user-wrap" id="navUserWrap">
                    <?php if ($nav_logged_in): ?>
                    <!-- Logged In: avatar + dropdown -->
                    <div class="d-flex align-items-center gap-2" onclick="toggleNavDropdown()" style="cursor:pointer;">
                        <div class="nav-user-avatar" id="navUserAvatar"><?= $nav_initial ?></div>
                        <span class="nav-user-name d-none d-md-block" id="navUserNameEl">
                            <?= htmlspecialchars($nav_name) ?>
                            <small>Member</small>
                        </span>
                        <i class="bi bi-chevron-down text-muted" style="font-size:11px;"></i>
                    </div>
                    <?php else: ?>
                    <!-- Logged Out: Login button -->
                    <button class="nav-login-btn" id="navLoginBtn" onclick="openLoginModal()">
                        <i class="bi bi-person-fill"></i> Login
                    </button>
                    <?php endif; ?>

                    <!-- Dropdown (always rendered, shown/hidden via JS) -->
                    <div class="nav-user-dropdown" id="navUserDropdown">
                        <div class="dd-header">
                            <div class="dd-avatar" id="navDdAvatar"><?= $nav_initial ?></div>
                            <div class="dd-info">
                                <strong id="navDdName"><?= htmlspecialchars($nav_name) ?></strong>
                                <span>Member</span>
                            </div>
                        </div>
                        <a href="<?= site_url('my-bookings') ?>" class="dd-item">
                            <i class="bi bi-calendar2-check"></i> My Bookings
                        </a>
                        <button class="dd-item logout" onclick="doNavLogout()">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </div>
                </div>
                <!-- ─────────────────────────────────────────────────── -->

                <button class="hamburger-btn border-0 bg-transparent" id="hamburgerBtn" aria-label="hamburger-button">
                    <i class="fas fa-bars" style="color: #FC5D09;"></i>
                </button>
            </div>
        </div>
    </div>
</nav>
<script>
var _isLoggedIn = <?= $nav_logged_in ? 'true' : 'false' ?>;
var _postLoginRedirect = null;

function handleBookShiftingClick(event, url) {
    if (_isLoggedIn) {
        return true;
    } else {
        event.preventDefault();
        _postLoginRedirect = url;
        if (typeof openLoginModal === 'function') {
            openLoginModal();
        } else {
            console.error('openLoginModal function not found');
        }
        return false;
    }
}

// ─── Navbar dropdown toggle ───────────────────────────────────────────────
function toggleNavDropdown() {
    document.getElementById('navUserDropdown').classList.toggle('open');
}
// Close dropdown when clicking outside
document.addEventListener('click', function(e) {
    var wrap = document.getElementById('navUserWrap');
    if (wrap && !wrap.contains(e.target)) {
        var dd = document.getElementById('navUserDropdown');
        if (dd) dd.classList.remove('open');
    }
});

// ─── Logout from navbar ───────────────────────────────────────────────────
function doNavLogout() {
    fetch('<?= site_url("user-auth/logout") ?>')
        .then(function() {
            // Show logged-out state
            navSetLoggedOut();
            // Hide dropdown
            var dd = document.getElementById('navUserDropdown');
            if (dd) dd.classList.remove('open');
            // Also update booking form note bar if on same page
            if (typeof setLoggedOut === 'function') {
                window._isLoggedIn = false;
                var noteBar = document.getElementById('loginNoteBar');
                if (noteBar) noteBar.classList.remove('d-none');
            }
        });
}

// ─── Update navbar from booking form JS (after OTP login) ─────────────────
function navSetLoggedIn(name) {
    var wrap = document.getElementById('navUserWrap');
    if (!wrap) return;
    var initial = name ? name.charAt(0).toUpperCase() : '?';

    // Replace login button with avatar+name
    var loginBtn = document.getElementById('navLoginBtn');
    if (loginBtn) {
        // Build avatar trigger
        var trigger = document.createElement('div');
        trigger.className = 'd-flex align-items-center gap-2';
        trigger.style.cursor = 'pointer';
        trigger.setAttribute('onclick', 'toggleNavDropdown()');
        trigger.innerHTML =
            '<div class="nav-user-avatar" id="navUserAvatar">' + initial + '</div>' +
            '<span class="nav-user-name d-none d-md-block" id="navUserNameEl">' + name + '<small>Member</small></span>' +
            '<i class="bi bi-chevron-down text-muted" style="font-size:11px;"></i>';
        wrap.insertBefore(trigger, wrap.querySelector('.nav-user-dropdown'));
        loginBtn.remove();
    } else {
        // Already has avatar — just update text
        var av = document.getElementById('navUserAvatar');
        if (av) av.textContent = initial;
        var nm = document.getElementById('navUserNameEl');
        if (nm) nm.firstChild.textContent = name;
    }
    // Update dropdown header
    var ddAv = document.getElementById('navDdAvatar');
    if (ddAv) ddAv.textContent = initial;
    var ddNm = document.getElementById('navDdName');
    if (ddNm) ddNm.textContent = name;
}

function navSetLoggedOut() {
    var wrap = document.getElementById('navUserWrap');
    if (!wrap) return;
    // Remove trigger (avatar row) - keep only dropdown and add login btn
    var trigger = wrap.querySelector('.d-flex.align-items-center.gap-2');
    if (trigger) trigger.remove();
    // Clear avatar initial
    var ddAv = document.getElementById('navDdAvatar');
    if (ddAv) ddAv.textContent = '';
    var ddNm = document.getElementById('navDdName');
    if (ddNm) ddNm.textContent = '';
    // Add login button if not exists
    if (!document.getElementById('navLoginBtn')) {
        var btn = document.createElement('button');
        btn.id = 'navLoginBtn';
        btn.className = 'nav-login-btn';
        btn.setAttribute('onclick', 'openLoginModal()');
        btn.innerHTML = '<i class="bi bi-person-fill"></i> Login';
        wrap.insertBefore(btn, wrap.querySelector('.nav-user-dropdown'));
    }
}
</script>
<div class="fullscreen-menu overflow-y-scroll overflow-md-y-hidden" id="fullscreenMenu">
    <button class="close-menu-btn position-fixed border-0 bg-transparent p-2" id="closeMenuBtn">
        <i class="fas fa-times fs-1" style="color: #FC5D09;"></i>
    </button>
    <div class="menu-content">
        <div>
            <div class="logo-menu mb-2 ms-3">
                <span class="fw-bold display-6"><img src="<?= !empty($logo_url) ? $logo_url : base_url('assets/images/logo/logo2.png') ?>" onerror="this.onerror=null; this.src='<?= base_url('assets/images/logo/logo2.png') ?>';" alt="<?= $company3 ?> Logo" width="120" height="120" style="height: 60px; width: auto; object-fit: contain;" loading="lazy"></span>
            </div>
            <div class="menu-section">
                <span class="menu-title">Contact Info</span>
                <div class="contact-info">
                    <p><i class="fas fa-map-marker-alt"></i> <?= $address ?></p><br>
                    <a href="<?= $mailhtml ?>"><i class="fas fa-envelope"></i> <?= $mail ?></a><br>
                    <a href="<?= $phonehtml ?>"><i class="fas fa-phone"></i> <?= $phone ?></a><br>
                </div>
                <div class="social-icons d-flex gap-3 mt-3">
                    <?php if (!empty($facebookhtml)): ?>
                    <a href="<?= $facebookhtml ?>" target="_blank" aria-label="facebook link" class="d-flex align-items-center justify-content-center rounded-circle">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($youtubehtml)): ?>
                    <a href="<?= $youtubehtml ?>" target="_blank" aria-label="youtube link" class="d-flex align-items-center justify-content-center rounded-circle">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($instagramhtml)): ?>
                    <a href="<?= $instagramhtml ?>" target="_blank" aria-label="instagram link" class="d-flex align-items-center justify-content-center rounded-circle">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <?php endif; ?>
                    <?php if (!empty($whatsapphtml)): ?>
                    <a href="<?= $whatsapphtml ?>" target="_blank" aria-label="whatsapp link" class="d-flex align-items-center justify-content-center rounded-circle">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="menu-section">
            <div class="menu-section mb-4">
                <ul class="list-unstyled">
                    <li class="fw-bold mb-2"><a href="<?= site_url('') ?>">Home</a></li>
                    <li class="fw-bold mb-2"><a href="<?= site_url('contacts') ?>">Contact Us</a></li>
                    <li class="fw-bold mb-2"><a href="<?= site_url('branches') ?>">Branches</a></li>
                    <li class="fw-bold mb-2"><a href="<?= site_url('blogs') ?>">Blogs</a></li>
                    <li class="fw-bold mb-2"><a href="<?= site_url('reviews') ?>">Customer Reviews</a></li>
                </ul>
            </div>
            <span class="menu-title">Company</span>
            <ul class="list-unstyled">
                <li class="mb-2"><a href="<?= site_url('about') ?>">About Us</a></li>
                <li class="mb-2"><a href="<?= site_url('why-choose-us') ?>">Why Choose Us</a></li>
                <li class="mb-2"><a href="<?= site_url('testimonials') ?>">Testimonials</a></li>
                <li class="mb-2"><a href="<?= site_url('faq') ?>">FAQS</a></li>
                <li class="mb-2"><a href="<?= site_url('privacy-policy') ?>">Privacy Policy</a></li>
                <li class="mb-2"><a href="<?= site_url('term-and-condition') ?>">Terms &amp; Conditions</a></li>
                <li class="mb-2"><a href="<?= site_url('cancellation-refund') ?>">Cancellation &amp; Refund Policy</a></li>
            </ul>
        </div>
        <div class="menu-section">
            <span class="menu-title">Services</span>
            <ul class="list-unstyled">
                <?php if (!empty($nav_services)): ?>
                    <?php foreach ($nav_services as $ns): ?>
                        <li class="mb-2"><a href="<?= site_url('services/' . $ns->slug) ?>"><?= htmlspecialchars($ns->service_name) ?></a></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="mb-2"><a href="<?= site_url('home-relocation') ?>">Home Relocation</a></li>
                    <li class="mb-2"><a href="<?= site_url('office-relocation') ?>">Office Moving</a></li>
                    <li class="mb-2"><a href="<?= site_url('packing-unpacking') ?>">Packing and Unpacking</a></li>
                    <li class="mb-2"><a href="<?= site_url('loading-unloading') ?>">Loading and Unloading</a></li>
                    <li class="mb-2"><a href="<?= site_url('car-transportation-service') ?>">Car Transportation</a></li>
                    <li class="mb-2"><a href="<?= site_url('warehousing-services') ?>">Warehousing Services</a></li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="menu-section">
            <span class="menu-title">Activities</span>
            <ul class="list-unstyled">


                <li class="mb-2"><a href="<?= site_url('tips-and-suggestion') ?>">Moving Tips And Suggestion</a></li>
                <li class="mb-2"><a href="<?= site_url('contacts') ?>">Track Shipment</a></li>
                <li class="mb-2"><a href="<?= site_url('photo-gallery') ?>">Photo Gallery</a></li>
                <li class="mb-2"><a href="<?= site_url('video-gallery') ?>">Video Gallery</a></li>
            </ul>
        </div>
    </div>
</div>
<?= $this->load->view('contacts/quotemodal.php'); ?>