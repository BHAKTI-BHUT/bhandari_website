<?php
/**
 * Mobile-First Homepage Quote Modal
 * Auto-opens on mobile when user visits homepage.
 * Inspired by premium app-style moving quote forms.
 */
$logged_web_user = $this->session->userdata('web_user');
$user_name_val   = ($logged_web_user && !empty($logged_web_user['name'])) ? htmlspecialchars($logged_web_user['name']) : '';
$user_mobile_val = ($logged_web_user && !empty($logged_web_user['mobile'])) ? htmlspecialchars($logged_web_user['mobile']) : '';
?>

<style>
/* ═══════════════════════════════════════════════════════════
   MOBILE HOMEPAGE QUOTE MODAL — Premium App-Like Design
   ═══════════════════════════════════════════════════════════ */
#mobileQuoteModal .modal-dialog {
    margin: 1rem;
    max-width: 100%;
}
#mobileQuoteModal .modal-content {
    border: none;
    border-radius: 16px;
    background: linear-gradient(180deg, #fff5f0 0%, #ffffff 35%);
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}
#mobileQuoteModal .mqm-header {
    background: linear-gradient(135deg, #fff5ee 0%, #ffe8dc 100%);
    padding: 30px 20px 20px;
    text-align: center;
    position: relative;
}
#mobileQuoteModal .mqm-logo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    border: 3px solid #FC5D09;
    object-fit: cover;
    margin: 0 auto 10px;
    display: block;
    box-shadow: 0 4px 16px rgba(252, 93, 9,0.2);
}
#mobileQuoteModal .mqm-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: #1a1a2e;
    margin: 0 0 4px;
    letter-spacing: -0.3px;
}
#mobileQuoteModal .mqm-subtitle {
    font-size: 0.85rem;
    color: #888;
    margin: 0;
    line-height: 1.4;
}
#mobileQuoteModal .mqm-close {
    position: absolute;
    top: 12px;
    right: 14px;
    background: rgba(0,0,0,0.06);
    border: none;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #555;
    font-size: 16px;
    transition: background 0.2s;
    z-index: 5;
}
#mobileQuoteModal .mqm-close:hover { background: rgba(0,0,0,0.12); }

/* Form body */
#mobileQuoteModal .mqm-body {
    padding: 24px 20px 30px;
}
#mobileQuoteModal .mqm-field {
    display: flex;
    align-items: center;
    background: #fff;
    border: 1.5px solid #f0f0f0;
    border-radius: 14px;
    padding: 0 16px;
    height: 56px;
    margin-bottom: 14px;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}
#mobileQuoteModal .mqm-field:focus-within {
    border-color: #FC5D09;
    box-shadow: 0 2px 12px rgba(252, 93, 9,0.10);
}
#mobileQuoteModal .mqm-field .mqm-icon {
    width: 28px;
    font-size: 18px;
    color: #FC5D09;
    flex-shrink: 0;
    text-align: center;
}
#mobileQuoteModal .mqm-field input {
    border: none;
    outline: none;
    background: transparent;
    flex: 1;
    font-size: 0.95rem;
    color: #333;
    padding: 0 0 0 10px;
    height: 100%;
}
#mobileQuoteModal .mqm-field input::placeholder {
    color: #bbb;
    font-weight: 500;
}
#mobileQuoteModal .mqm-field .mqm-suffix {
    color: #ccc;
    font-size: 18px;
    flex-shrink: 0;
}

/* Name field */
#mobileQuoteModal .mqm-field .mqm-icon.icon-name { color: #FC5D09; }
#mobileQuoteModal .mqm-field .mqm-icon.icon-pickup { color: #27ae60; }
#mobileQuoteModal .mqm-field .mqm-icon.icon-drop { color: #e74c3c; }
#mobileQuoteModal .mqm-field .mqm-icon.icon-phone { color: #e67e22; }
#mobileQuoteModal .mqm-field .mqm-icon.icon-date { color: #3498db; }
#mobileQuoteModal .mqm-field .mqm-icon.icon-time { color: #9b59b6; }

/* Submit button */
#mobileQuoteModal .mqm-submit {
    width: 100%;
    height: 54px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    border: none;
    border-radius: 14px;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 6px 24px rgba(252, 93, 9,0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 8px;
    letter-spacing: 0.3px;
}
#mobileQuoteModal .mqm-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(252, 93, 9,0.4);
}
#mobileQuoteModal .mqm-submit:active {
    transform: translateY(0);
}

/* Trust badges */
#mobileQuoteModal .mqm-trust {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 18px;
    padding-top: 14px;
    border-top: 1px solid #f3f3f3;
}
#mobileQuoteModal .mqm-trust-item {
    text-align: center;
    font-size: 0.7rem;
    color: #999;
    font-weight: 600;
}
#mobileQuoteModal .mqm-trust-item i {
    display: block;
    font-size: 18px;
    color: #FC5D09;
    margin-bottom: 3px;
}

/* Z-Index Overrides for Mobile Modals */
#mobileQuoteModal { z-index: 9990 !important; }
#mobileOtpModal { z-index: 10050 !important; }
#mobileOtpModal .modal-dialog { z-index: 10055 !important; }

/* Only show on small screens */
@media (min-width: 769px) {
    #mobileQuoteModal { display: none !important; }
}
</style>

<!-- Mobile Homepage Quote Modal -->
<div class="modal fade" id="mobileQuoteModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header with branding -->
            <div class="mqm-header">
                <button type="button" class="mqm-close" id="mqmCloseBtn" aria-label="Close">
                    <i class="bi bi-x-lg"></i>
                </button>
                <img src="<?= base_url('assets/images/logo/logo.jpg') ?>" alt="Bhandari Packers" class="mqm-logo">
                <h5 class="mqm-title">Let's Plan Your Move</h5>
                <p class="mqm-subtitle">Enter your pickup & drop location to get<br>an instant moving estimate.</p>
            </div>

            <!-- Form body -->
            <div class="mqm-body">
                <form id="mobileQuoteForm" onsubmit="return false">
                    <!-- Full Name -->
                    <div class="mqm-field">
                        <span class="mqm-icon icon-name"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="name" id="mqm_name" placeholder="Full Name" value="<?= $user_name_val ?>" autocomplete="off">
                    </div>

                    <!-- Pickup Location -->
                    <div class="mqm-field">
                        <span class="mqm-icon icon-pickup"><i class="bi bi-geo-alt-fill"></i></span>
                        <input type="text" name="mfrom" id="mqm_pickup" placeholder="Pickup Location" autocomplete="off">
                    </div>

                    <!-- Drop Location -->
                    <div class="mqm-field">
                        <span class="mqm-icon icon-drop"><i class="bi bi-geo-alt-fill"></i></span>
                        <input type="text" name="mto" id="mqm_drop" placeholder="Drop Location" autocomplete="off">
                    </div>

                    <!-- Phone Number -->
                    <div class="mqm-field">
                        <span class="mqm-icon icon-phone"><i class="bi bi-telephone-fill"></i></span>
                        <input type="tel" name="phone" id="mqm_phone" placeholder="Phone Number" value="<?= $user_mobile_val ?>" autocomplete="off" maxlength="10">
                    </div>

                    <!-- Shifting Date -->
                    <div class="mqm-field">
                        <span class="mqm-icon icon-date"><i class="bi bi-calendar3"></i></span>
                        <input type="date" name="date" id="mqm_date" style="color:#c70000;">
                    </div>

                    <div id="mqmResult"></div>

                    <!-- Submit -->
                    <button type="button" id="mqmSubmitBtn" class="mqm-submit">
                        Check Price <i class="bi bi-arrow-right"></i>
                    </button>
                </form>

                <!-- Trust badges -->
                <div class="mqm-trust">
                    <div class="mqm-trust-item">
                        <i class="bi bi-shield-check"></i>
                        100% Safe
                    </div>
                    <div class="mqm-trust-item">
                        <i class="bi bi-truck"></i>
                        On-Time
                    </div>
                    <div class="mqm-trust-item">
                        <i class="bi bi-star-fill"></i>
                        4.9 Rated
                    </div>
                    <div class="mqm-trust-item">
                        <i class="bi bi-patch-check-fill"></i>
                        ISO Certified
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mobile Quote OTP Verification Modal -->
<div class="modal fade" id="mobileOtpModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" style="max-width:380px; margin:auto;">
        <div class="modal-content border-0 shadow-lg" style="border-radius:16px; overflow:hidden;">
            <div class="modal-header border-0 pb-0 position-relative text-center d-block pt-4 px-4">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                <div style="width:56px;height:56px;background:#fde8e8;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:8px;">
                    <i class="bi bi-shield-check text-danger" style="font-size:24px;"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1" style="font-size:1.1rem;">Verify Mobile</h5>
                <p class="text-muted small mb-0">OTP sent to <strong id="mqmOtpMasked" class="text-danger">+91 XXXXX XXXXX</strong></p>
            </div>
            <div class="modal-body p-4 text-center">
                <p class="small text-secondary mb-3">Enter the 6-digit OTP sent to your mobile or click Skip.</p>
                <div class="otp-boxes d-flex justify-content-center gap-2 mb-3" id="mqmOtpBoxes">
                    <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control text-center fw-bold mqm-otp-digit" maxlength="1" style="width:38px;height:44px;font-size:1.1rem;border-radius:6px;border:1.5px solid #ced4da;" autofocus>
                    <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control text-center fw-bold mqm-otp-digit" maxlength="1" style="width:38px;height:44px;font-size:1.1rem;border-radius:6px;border:1.5px solid #ced4da;">
                    <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control text-center fw-bold mqm-otp-digit" maxlength="1" style="width:38px;height:44px;font-size:1.1rem;border-radius:6px;border:1.5px solid #ced4da;">
                    <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control text-center fw-bold mqm-otp-digit" maxlength="1" style="width:38px;height:44px;font-size:1.1rem;border-radius:6px;border:1.5px solid #ced4da;">
                    <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control text-center fw-bold mqm-otp-digit" maxlength="1" style="width:38px;height:44px;font-size:1.1rem;border-radius:6px;border:1.5px solid #ced4da;">
                    <input type="tel" inputmode="numeric" pattern="[0-9]*" class="form-control text-center fw-bold mqm-otp-digit" maxlength="1" style="width:38px;height:44px;font-size:1.1rem;border-radius:6px;border:1.5px solid #ced4da;">
                </div>
                <div id="mqmOtpError" class="alert a9lert-danger py-2 small d-none mb-3"></div>
                <button type="button" id="mqmVerifyBtn" class="btn btn-danger w-100 py-2 fw-bold mb-2 shadow-sm" style="background:linear-gradient(135deg,#FC5D09,#ff4b2b);border:none;border-radius:8px;">
                    <i class="bi bi-check-circle-fill me-1"></i> Verify OTP &amp; Submit
                </button>
                <button type="button" id="mqmSkipBtn" class="btn btn-light w-100 py-2 fw-semibold border" style="border-radius:8px;color:#555;">
                    <i class="bi bi-fast-forward-fill me-1 text-secondary"></i> Skip &amp; Submit Lead
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    // ─── Auto-open mobile quote modal on homepage ─────────────────
    if (window.innerWidth <= 768) {
        var dismissed = sessionStorage.getItem('mqm_dismissed');
        if (!dismissed) {
            var checkBootstrap = setInterval(function() {
                if (typeof bootstrap !== 'undefined' && document.getElementById('mobileQuoteModal')) {
                    clearInterval(checkBootstrap);
                    setTimeout(function() {
                        var mqm = new bootstrap.Modal(document.getElementById('mobileQuoteModal'), { backdrop: 'static' });
                        mqm.show();
                    }, 600);
                }
            }, 100);
        }
    }
});

$(function() {
    $('#mobileQuoteModal').appendTo('body');
    $('#mobileOtpModal').appendTo('body');

    // Close button marks as dismissed for this session
    $('#mqmCloseBtn').click(function() {
        sessionStorage.setItem('mqm_dismissed', '1');
        var mqmEl = document.getElementById('mobileQuoteModal');
        var mqm = bootstrap.Modal.getInstance(mqmEl);
        if (mqm) mqm.hide();
    });

    function getLocalTodayDateStrMqm() {
        var d = new Date();
        var y = d.getFullYear();
        var m = String(d.getMonth() + 1).padStart(2, '0');
        var day = String(d.getDate()).padStart(2, '0');
        return y + '-' + m + '-' + day;
    }

    // Set min date & min time (+2 hours for today)
    var today = getLocalTodayDateStrMqm();
    var mqmDate = document.getElementById('mqm_date');
    if (mqmDate) { mqmDate.setAttribute('min', today); if (!mqmDate.value) mqmDate.value = today; }

    function parseMqmTimeToMinutes(timeStr) {
        if (!timeStr) return -1;
        timeStr = String(timeStr).trim();
        var ampmMatch = timeStr.match(/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i);
        if (ampmMatch) {
            var h = parseInt(ampmMatch[1], 10);
            var m = parseInt(ampmMatch[2], 10);
            var p = ampmMatch[3].toUpperCase();
            if (p === 'PM' && h < 12) h += 12;
            if (p === 'AM' && h === 12) h = 0;
            return h * 60 + m;
        }
        var hr24Match = timeStr.match(/^(\d{1,2}):(\d{2})(?::\d{2})?$/);
        if (hr24Match) {
            var h24 = parseInt(hr24Match[1], 10);
            var m24 = parseInt(hr24Match[2], 10);
            return h24 * 60 + m24;
        }
        return -1;
    }

    function formatMqmMinutesTo12Hour(totalMin) {
        if (totalMin < 0) return '';
        if (totalMin >= 1440) {
            var remMin = totalMin - 1440;
            var h = Math.floor(remMin / 60);
            var m = remMin % 60;
            var period = h >= 12 ? 'PM' : 'AM';
            var h12 = h % 12; if (h12 === 0) h12 = 12;
            return String(h12).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ' ' + period + ' (Tomorrow)';
        } else {
            var h = Math.floor(totalMin / 60);
            var m = Math.floor(totalMin % 60);
            var period = h >= 12 ? 'PM' : 'AM';
            var h12 = h % 12; if (h12 === 0) h12 = 12;
            return String(h12).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ' ' + period;
        }
    }

    function applyMqmMinTime() {
        var dateVal = $('#mqm_date').val();
        var timeSelect = document.getElementById('mqm_time');
        if (!timeSelect) return;

        var todayStr = getLocalTodayDateStrMqm();
        var isToday = (!dateVal || dateVal === todayStr);

        var now = new Date();
        var minAllowedMin = isToday ? (now.getHours() * 60 + now.getMinutes() + 120) : 0;

        var options = timeSelect.options;
        for (var i = 0; i < options.length; i++) {
            var opt = options[i];
            if (!opt.value) continue;
            var optMin = parseMqmTimeToMinutes(opt.value);
            if (isToday && optMin >= 0 && optMin < minAllowedMin) {
                opt.disabled = true;
                if (!opt.text.includes('(Unavailable)')) {
                    opt.text = opt.value + ' (Unavailable - Min 2 hrs)';
                }
            } else {
                opt.disabled = false;
                opt.text = opt.value;
            }
        }

        if (timeSelect.selectedIndex >= 0 && timeSelect.options[timeSelect.selectedIndex].disabled) {
            timeSelect.value = '';
        }
    }

    applyMqmMinTime();
    $('#mqm_date').on('change', applyMqmMinTime);
    setInterval(applyMqmMinTime, 60000);

    // OTP digit auto-advance for mobile modal
    $('.mqm-otp-digit').on('input', function() {
        var val = $(this).val();
        if (val.length > 1) $(this).val(val.slice(-1));
        if (val.length === 1) {
            var next = $(this).next('.mqm-otp-digit');
            if (next.length) next.focus();
        }
    }).on('keydown', function(e) {
        if (e.key === 'Backspace' && !$(this).val()) {
            var prev = $(this).prev('.mqm-otp-digit');
            if (prev.length) prev.focus();
        }
    });

    function isAllowedMqmPickup(addressStr) {
        if (!addressStr) return false;
        var str = addressStr.toLowerCase();
        var rawCities = (window.allowedPickupCitiesStr) ? window.allowedPickupCitiesStr : 'Delhi, Noida, Greater Noida, Gurugram, Gurgaon, Ghaziabad, Faridabad';
        var allowedKeywords = rawCities.split(',').map(function(c) { return c.trim().toLowerCase(); }).filter(function(c) { return c.length > 0; });
        var extraKeywords = [];
        allowedKeywords.forEach(function(kw) {
            if (kw === 'gurugram' || kw === 'gurgaon') {
                extraKeywords.push('gurugram', 'gurgaon');
            } else if (kw === 'delhi' || kw === 'new delhi') {
                extraKeywords.push('delhi', 'new delhi', 'ncr');
            } else if (kw === 'noida' || kw === 'greater noida') {
                extraKeywords.push('noida', 'greater noida', 'gautam buddh', 'gautam budh');
            }
        });
        allowedKeywords = allowedKeywords.concat(extraKeywords);

        for (var i = 0; i < allowedKeywords.length; i++) {
            if (allowedKeywords[i] !== '' && str.indexOf(allowedKeywords[i]) !== -1) {
                return true;
            }
        }
        return false;
    }

    // ─── Submit from mobile modal ──────────────────────────────────
    $('#mqmSubmitBtn').click(function(e) {
        e.preventDefault();
        var name  = $('#mqm_name').val().trim();
        var mfrom = $('#mqm_pickup').val().trim();
        var mto   = $('#mqm_drop').val().trim();
        var phone = $('#mqm_phone').val().trim();
        var date  = $('#mqm_date').val().trim();

        if (!name || name.length < 2) { Swal.fire({ title:'Name Required', text:'Please enter your full name.', icon:'warning', confirmButtonColor:'#FC5D09' }); return; }
        if (!mfrom) { Swal.fire({ title:'Pickup Required', text:'Please enter pickup location.', icon:'warning', confirmButtonColor:'#FC5D09' }); return; }
        
        if (!isAllowedMqmPickup(mfrom)) {
            var noticeCities = window.allowedPickupCitiesStr || 'Delhi, Noida, Greater Noida, Gurugram, Ghaziabad, Faridabad';
            showSleekNoticeModal(
                'Pickup Service Unavailable',
                'Currently, our pickup relocation service is available exclusively from <b>' + noticeCities + '</b>.<br><br>We do not offer pickup services from your selected location.',
                'Change Location',
                'location'
            );
            $('#mqm_pickup').focus();
            return;
        }

        if (!mto) { Swal.fire({ title:'Drop Required', text:'Please enter drop location.', icon:'warning', confirmButtonColor:'#FC5D09' }); return; }
        if (!phone || !/^\d{10}$/.test(phone)) { Swal.fire({ title:'Mobile Required', text:'Please enter a valid 10-digit mobile number.', icon:'warning', confirmButtonColor:'#FC5D09' }); return; }
        if (!date) { Swal.fire({ title:'Date Required', text:'Please select shifting date.', icon:'warning', confirmButtonColor:'#FC5D09' }); return; }

        // Close mobile quote modal first
        var mqmEl = document.getElementById('mobileQuoteModal');
        var mqm = bootstrap.Modal.getInstance(mqmEl);
        if (mqm) mqm.hide();
        sessionStorage.setItem('mqm_dismissed', '1');

        // Check if already logged in
        if (typeof _isLoggedIn !== 'undefined' && _isLoggedIn) {
            submitMobileBooking(1);
            return;
        }

        // Send OTP
        Swal.fire({ title:'Sending OTP...', text:'Please wait.', allowOutsideClick:false, showConfirmButton:false, didOpen:function(){ Swal.showLoading(); } });

        // Send OTP using MSG91 dynamic widget
        $.ajax({
            type: 'POST',
            url: '<?= site_url("user-auth/send-otp") ?>',
            data: { name: name, mobile: phone },
            dataType: 'json',
            success: function(r) {
                Swal.close();
                if (r.success) {
                    $('#mqmOtpMasked').text(r.masked || ('+91 ' + phone));
                    $('.mqm-otp-digit').val('');
                    $('#mqmOtpError').addClass('d-none').text('');
                    var otpModal = new bootstrap.Modal(document.getElementById('mobileOtpModal'));
                    otpModal.show();
                } else {
                    Swal.fire({ title:'Error', text: r.message || 'Failed to send OTP.', icon:'error', confirmButtonColor:'#FC5D09' });
                }
            },
            error: function() {
                Swal.close();
                submitMobileBooking(0);
            }
        });
    });

    // Verify OTP
    $('#mqmVerifyBtn').click(function() {
        var otp = '';
        $('.mqm-otp-digit').each(function() { otp += $(this).val(); });
        if (otp.length < 6) { $('#mqmOtpError').removeClass('d-none').text('Please enter all 6 digits of the OTP.'); return; }
        $('#mqmOtpError').addClass('d-none');
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-1"></span> Verifying...');

        $.ajax({
            type: 'POST',
            url: '<?= site_url("user-auth/verify-otp") ?>',
            data: { otp: otp },
            dataType: 'json',
            success: function(r) {
                $('#mqmVerifyBtn').prop('disabled', false).html('<i class="bi bi-check-circle-fill me-1"></i> Verify & Submit');
                if (r.success) {
                    if (typeof _isLoggedIn !== 'undefined') _isLoggedIn = true;
                    var otpEl = document.getElementById('mobileOtpModal');
                    var otpM = bootstrap.Modal.getInstance(otpEl);
                    if (otpM) otpM.hide();
                    submitMobileBooking(1);
                } else {
                    $('#mqmOtpError').removeClass('d-none').text(r.message || 'Invalid OTP.');
                }
            },
            error: function() {
                $('#mqmVerifyBtn').prop('disabled', false).html('<i class="bi bi-check-circle-fill me-1"></i> Verify & Submit');
                $('#mqmOtpError').removeClass('d-none').text('Server error. Click Skip.');
            }
        });
    });

    // Skip OTP
    $('#mqmSkipBtn').click(function() {
        var otpEl = document.getElementById('mobileOtpModal');
        var otpM = bootstrap.Modal.getInstance(otpEl);
        if (otpM) otpM.hide();
        submitMobileBooking(0);
    });
});

// ─── Submit Booking from Mobile Modal ─────────────────────────────────
function submitMobileBooking(isVerified) {
    Swal.fire({ title:'✅ Perfect!', text:"Now, let’s select your items.", allowOutsideClick:false, showConfirmButton:false, didOpen:function(){ Swal.showLoading(); } });

    var formData = $('#mobileQuoteForm').serialize() + '&is_verified=' + (isVerified || 0);

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/booking") ?>',
        data: formData,
        success: function(data) {
            var res = $.trim(data);
            if (res == '1') {
                Swal.fire({
                    html:
                        '<div style="text-align:center;padding:10px 0;">'
                        + '<div style="width:64px;height:64px;background:linear-gradient(135deg,#FC5D09,#ff4b2b);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 6px 20px rgba(252, 93, 9,0.3);">'
                        + '<i class="bi bi-check-lg" style="color:#fff;font-size:28px;"></i>'
                        + '</div>'
                        + '<h4 style="font-weight:800;color:#1a1a2e;margin-bottom:6px;font-size:1.2rem;">Request Submitted!</h4>'
                        + '<p style="font-size:0.85rem;color:#555;line-height:1.5;margin-bottom:16px;">Our team will contact you shortly.</p>'
                        + '<button id="mqmSuccessOk" style="background:linear-gradient(135deg,#FC5D09,#ff4b2b);color:#fff;border:none;border-radius:10px;padding:10px 0;font-weight:700;font-size:0.95rem;cursor:pointer;width:100%;">Go to Homepage</button>'
                        + '</div>',
                    showConfirmButton: false,
                    allowOutsideClick: false,
                    didOpen: function() {
                        document.getElementById('mqmSuccessOk').addEventListener('click', function() {
                            Swal.close();
                            window.location.href = '<?= site_url() ?>';
                        });
                    }
                });
                $('#mobileQuoteForm')[0].reset();
                var today = new Date().toISOString().split('T')[0];
                var d = document.getElementById('mqm_date');
                if (d) d.value = today;
            } else {
                var cleanMsg = $('<div>').html(data).text().trim() || data;
                Swal.fire({ title:'Error!', text: cleanMsg, icon:'error', confirmButtonColor:'#FC5D09' });
            }
        },
        error: function() {
            Swal.fire({ title:'Network Error', text:'Something went wrong.', icon:'error', confirmButtonColor:'#FC5D09' });
        }
    });
}
</script>
