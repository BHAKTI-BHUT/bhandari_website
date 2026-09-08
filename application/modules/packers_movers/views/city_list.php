<?php
$st = strtolower(str_replace(" ", "-", $state));
if (!isset($cities) || empty($cities)) {
    if (file_exists(APPPATH . "modules/packers_movers/views/data/$st.php")) {
        include "data/$st.php";
    } else {
        $cities = array();
    }
}
$state_name = ucwords($state);
$total_cities = count($cities);
?>
<main class="main bg-light-subtle">
    <!-- Breadcrumb Header -->
    <section class="py-5 text-white breadcrumb-section position-relative overflow-hidden">
      <div class="breadcrumb-bg-overlay"></div>
      <div class="container d-flex flex-column align-items-center justify-content-center text-center position-relative" style="z-index: 2;">
        <h1 class="mt-1 fw-bold text-center text-white display-6">Packers and Movers in <?= htmlspecialchars($state_name) ?></h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
              <a href="<?= site_url() ?>" class="text-white text-decoration-none opacity-75 hover-opacity-100">Home</a>
            </li>
            <li class="breadcrumb-item text-white opacity-75">
              <span>State Services</span>
            </li>
            <li class="breadcrumb-item active text-white fw-semibold" aria-current="page">
              <?= htmlspecialchars($state_name) ?>
            </li>
          </ol>
        </nav>
      </div>
    </section>

    <!-- Highlights & Trust Strip -->
    <div class="state-trust-strip py-3 bg-white border-bottom shadow-sm">
        <div class="container">
            <div class="row g-2 text-center align-items-center justify-content-center">
                <div class="col-6 col-md-3">
                    <div class="trust-pill d-flex align-items-center justify-content-center gap-2">
                        <span class="trust-icon text-orange"><i class="fa-solid fa-shield-halved"></i></span>
                        <span class="trust-text fs-12 fw-semibold text-dark">100% Safe & Insured</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-pill d-flex align-items-center justify-content-center gap-2">
                        <span class="trust-icon text-orange"><i class="fa-solid fa-truck-fast"></i></span>
                        <span class="trust-text fs-12 fw-semibold text-dark">Same Day Pickup</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-pill d-flex align-items-center justify-content-center gap-2">
                        <span class="trust-icon text-orange"><i class="fa-solid fa-tags"></i></span>
                        <span class="trust-text fs-12 fw-semibold text-dark">Guaranteed Best Rates</span>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="trust-pill d-flex align-items-center justify-content-center gap-2">
                        <span class="trust-icon text-orange"><i class="fa-solid fa-headset"></i></span>
                        <span class="trust-text fs-12 fw-semibold text-dark">24x7 Customer Support</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="container py-5">
        <!-- Section Header with Instant Filter -->
        <div class="row align-items-center justify-content-between mb-4 g-3">
            <div class="col-md-7">
                <div class="section-intro">
                    <span class="text-orange text-uppercase fw-bold fs-12 tracking-wider d-block mb-1">
                        <i class="fa-solid fa-map-location-dot me-1"></i> Available Service Locations
                    </span>
                    <h2 class="fw-bold text-dark fs-24 mb-1">
                        Select Your City in <?= htmlspecialchars($state_name) ?>
                    </h2>
                    <p class="text-muted fs-13 mb-0">
                        Explore our verified packers and movers branch networks across <span id="cityCountText" class="fw-bold text-dark"><?= $total_cities ?></span> locations.
                    </p>
                </div>
            </div>
            
            <?php if (!empty($cities) && $total_cities > 3): ?>
            <div class="col-md-5 col-lg-4">
                <div class="city-search-box position-relative">
                    <i class="fa-solid fa-magnifying-glass search-icon position-absolute"></i>
                    <input type="text" id="citySearchInput" class="form-control city-search-input" placeholder="Search city (e.g. <?= htmlspecialchars(is_array($cities[0]) ? $cities[0]['nm'] : $cities[0]->name) ?>)..." autocomplete="off">
                    <button type="button" id="citySearchClear" class="btn-clear position-absolute d-none" aria-label="Clear Search">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </div>
            <?php endif; ?>
        </div>

        <!-- City Cards Grid -->
        <div class="row g-3 g-md-4" id="cityGridContainer">
            <?php
            $st_param = str_replace(" ", "-", $state_name);
            if (!empty($cities)):
                foreach ($cities as $index => $ct) :
                    $ct_name = is_array($ct) ? $ct['nm'] : $ct->name;
                    $ct_slug = is_array($ct) ? (isset($ct['slug']) ? $ct['slug'] : urlencode(strtolower(str_replace(" ", "-", $ct_name)))) : $ct->slug;
                    $link = $ct_slug;
                    $statename = urlencode(strtolower(str_replace(" ", "-", $st_param)));
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6 city-card-col" data-city-name="<?= strtolower(htmlspecialchars($ct_name)) ?>">
                        <a href="<?= site_url("$link-packers-movers-$statename") ?>" class="city-modern-card d-block h-100 text-decoration-none">
                            <div class="card-inner h-100 position-relative">
                                <!-- Top Accent Glow Line -->
                                <div class="card-accent-bar"></div>

                                <!-- Card Header: Icon Badge & Arrow Action -->
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                    <div class="city-icon-badge">
                                        <i class="fa-solid fa-truck-fast"></i>
                                    </div>
                                    <div class="city-action-pill">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </div>
                                </div>

                                <!-- Card Body Content -->
                                <div class="city-info-block">
                                    <span class="city-service-tag">
                                        <i class="fa-solid fa-boxes-packing me-1"></i> Packers &amp; Movers
                                    </span>
                                    <h3 class="city-main-name" title="<?= htmlspecialchars($ct_name) ?>">
                                        <?= htmlspecialchars($ct_name) ?>
                                    </h3>
                                </div>

                                <!-- Card Bottom Feature Badge -->
                                <div class="card-bottom-strip mt-3 pt-2 border-top d-flex align-items-center justify-content-between">
                                    <span class="verified-badge">
                                        <i class="fa-solid fa-circle-check text-success me-1"></i> Verified Hub
                                    </span>
                                    <span class="quote-link">Get Quote <i class="fa-solid fa-angle-right ms-0.5"></i></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center py-5">
                    <div class="no-city-box p-4 bg-white rounded-4 shadow-sm text-center mx-auto" style="max-width: 450px;">
                        <i class="fa-solid fa-map-location text-muted display-4 mb-3 opacity-50"></i>
                        <h4 class="fw-bold text-dark fs-18">No Cities Listed Yet</h4>
                        <p class="text-muted fs-13 mb-3">We are currently expanding our direct branch network in <?= htmlspecialchars($state_name) ?>.</p>
                        <a href="<?= site_url('contact-us') ?>" class="btn btn-sm btn-orange px-4 py-2 rounded-pill">Contact Us for Booking</a>
                    </div>
                </div>
            <?php endif; ?>

            <!-- No search results fallback box -->
            <div class="col-12 text-center py-4 d-none" id="noSearchResultsBox">
                <div class="p-4 bg-white rounded-4 shadow-sm text-center mx-auto" style="max-width: 420px;">
                    <i class="fa-solid fa-magnifying-glass text-orange fs-28 mb-2"></i>
                    <h5 class="fw-bold text-dark fs-16 mb-1">No matching cities found</h5>
                    <p class="text-muted fs-12 mb-0">Try searching for a different city or browse all available locations above.</p>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    /* ── Color System & Root Variables ─────────────────────── */
    :root {
        --bhandari-primary: #FC5D09;
        --bhandari-secondary: #DD3802;
        --bhandari-gradient: linear-gradient(135deg, #FC5D09 0%, #DD3802 100%);
        --bhandari-light-orange: #FFF4EE;
        --bhandari-border: rgba(252, 93, 9, 0.15);
        --bhandari-text-dark: #1e293b;
    }

    .text-orange {
        color: var(--bhandari-primary) !important;
    }

    .btn-orange {
        background: var(--bhandari-gradient);
        color: #ffffff;
        border: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .btn-orange:hover {
        background: linear-gradient(135deg, #e54d00 0%, #c42f00 100%);
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(252, 93, 9, 0.3);
    }

    /* ── Breadcrumb Section ────────────────────────────────── */
    .breadcrumb-section {
        background: var(--bhandari-gradient);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .breadcrumb-bg-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.15) 0%, transparent 60%);
        pointer-events: none;
    }
    .letter-spacing-1 {
        letter-spacing: 0.8px;
    }

    /* ── Trust Strip ───────────────────────────────────────── */
    .state-trust-strip {
        background-color: #ffffff;
    }
    .trust-pill {
        padding: 4px 8px;
        border-radius: 8px;
        transition: transform 0.2s ease;
    }
    .trust-icon {
        font-size: 16px;
    }

    /* ── Search Input ──────────────────────────────────────── */
    .city-search-box {
        position: relative;
    }
    .city-search-box .search-icon {
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
        pointer-events: none;
    }
    .city-search-input {
        padding: 10px 38px 10px 38px;
        border-radius: 30px;
        border: 1.5px solid #e2e8f0;
        font-size: 13px;
        background-color: #ffffff;
        transition: all 0.3s ease;
    }
    .city-search-input:focus {
        border-color: var(--bhandari-primary);
        box-shadow: 0 0 0 3px rgba(252, 93, 9, 0.15);
        outline: none;
    }
    .btn-clear {
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 2px 6px;
    }
    .btn-clear:hover {
        color: #334155;
    }

    /* ── Modern City Card ──────────────────────────────────── */
    .city-modern-card {
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        position: relative;
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .card-inner {
        padding: 18px 16px 14px 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    /* Top Accent Line on Card */
    .card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: var(--bhandari-gradient);
        opacity: 0;
        transform: scaleX(0);
        transform-origin: left;
        transition: all 0.35s ease;
    }

    /* City Icon Badge */
    .city-icon-badge {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: var(--bhandari-light-orange);
        color: var(--bhandari-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        border: 1px solid var(--bhandari-border);
        transition: all 0.35s ease;
    }

    /* City Action Pill Arrow */
    .city-action-pill {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        transition: all 0.35s ease;
    }

    /* Typography inside Card */
    .city-service-tag {
        font-size: 11px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
        transition: color 0.3s ease;
    }

    .city-main-name {
        font-size: 17px;
        font-weight: 700;
        color: var(--bhandari-text-dark);
        margin: 0;
        line-height: 1.3;
        transition: color 0.3s ease;
        word-break: break-word;
    }

    /* Card Bottom Strip */
    .card-bottom-strip {
        border-color: #f1f5f9 !important;
    }
    .verified-badge {
        font-size: 11px;
        font-weight: 600;
        color: #475569;
        display: flex;
        align-items: center;
    }
    .quote-link {
        font-size: 11px;
        font-weight: 700;
        color: var(--bhandari-primary);
        opacity: 0;
        transform: translateX(-4px);
        transition: all 0.3s ease;
    }

    /* ── Hover Animations & Effects ────────────────────────── */
    .city-modern-card:hover {
        transform: translateY(-6px);
        border-color: var(--bhandari-border);
        box-shadow: 0 16px 32px rgba(252, 93, 9, 0.14), 0 4px 8px rgba(0, 0, 0, 0.04);
        background: linear-gradient(180deg, #ffffff 0%, #fffbf8 100%);
    }

    .city-modern-card:hover .card-accent-bar {
        opacity: 1;
        transform: scaleX(1);
    }

    .city-modern-card:hover .city-icon-badge {
        background: var(--bhandari-gradient);
        color: #ffffff;
        transform: scale(1.05) rotate(-3deg);
        box-shadow: 0 6px 14px rgba(252, 93, 9, 0.28);
    }

    .city-modern-card:hover .city-icon-badge i {
        animation: truckBounce 0.6s ease infinite alternate;
    }

    .city-modern-card:hover .city-action-pill {
        background: var(--bhandari-gradient);
        color: #ffffff;
        transform: translateX(2px);
        box-shadow: 0 4px 10px rgba(252, 93, 9, 0.25);
    }

    .city-modern-card:hover .city-main-name {
        color: var(--bhandari-primary);
    }

    .city-modern-card:hover .quote-link {
        opacity: 1;
        transform: translateX(0);
    }

    @keyframes truckBounce {
        0% { transform: translateX(0); }
        100% { transform: translateX(3px); }
    }

    /* ── Mobile Responsive Refinements ─────────────────────── */
    @media (max-width: 576px) {
        .breadcrumb-section {
            padding-top: 2rem !important;
            padding-bottom: 2rem !important;
        }
        .breadcrumb-section h1 {
            font-size: 1.5rem !important;
        }
        .card-inner {
            padding: 14px 12px 10px 12px;
        }
        .city-icon-badge {
            width: 36px;
            height: 36px;
            font-size: 15px;
            border-radius: 10px;
        }
        .city-action-pill {
            width: 26px;
            height: 26px;
            font-size: 10px;
        }
        .city-service-tag {
            font-size: 9.5px;
        }
        .city-main-name {
            font-size: 14px;
        }
        .verified-badge {
            font-size: 10px;
        }
        .quote-link {
            font-size: 10px;
            opacity: 1;
            transform: translateX(0);
        }
        .trust-text {
            font-size: 10.5px !important;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var searchInput = document.getElementById('citySearchInput');
    var clearBtn = document.getElementById('citySearchClear');
    var cityCols = document.querySelectorAll('.city-card-col');
    var noResultsBox = document.getElementById('noSearchResultsBox');
    var countText = document.getElementById('cityCountText');

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var query = this.value.trim().toLowerCase();
            var visibleCount = 0;

            if (query.length > 0) {
                if (clearBtn) clearBtn.classList.remove('d-none');
            } else {
                if (clearBtn) clearBtn.classList.add('d-none');
            }

            cityCols.forEach(function (col) {
                var cityName = col.getAttribute('data-city-name') || '';
                if (cityName.indexOf(query) !== -1) {
                    col.classList.remove('d-none');
                    visibleCount++;
                } else {
                    col.classList.add('d-none');
                }
            });

            if (countText) {
                countText.textContent = visibleCount;
            }

            if (visibleCount === 0) {
                if (noResultsBox) noResultsBox.classList.remove('d-none');
            } else {
                if (noResultsBox) noResultsBox.classList.add('d-none');
            }
        });

        if (clearBtn) {
            clearBtn.addEventListener('click', function () {
                searchInput.value = '';
                searchInput.dispatchEvent(new Event('input'));
                searchInput.focus();
            });
        }
    }
});
</script>