<!-- Razorpay JS SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- ═══════════════════════════════════════════
     SHARED OTP LOGIN MODAL & AUTH JS
     ═══════════════════════════════════════════ -->
<style>
/* ─── Shared OTP Login Modal CSS ─── */
#otpLoginModal { z-index: 10050 !important; }
#otpLoginModal .modal-dialog { max-width: 440px; z-index: 10055 !important; }
#otpLoginModal .modal-content {
    border: none;
    border-radius: 0;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.18);
    border-top: 4px solid #FC5D09;
}

/* Modal Header strip */
.otp-modal-header {
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    padding: 22px 28px 18px;
    color: #fff;
    position: relative;
}
.otp-modal-header h5 {
    font-size: 1.3rem;
    font-weight: 800;
    margin: 0 0 4px;
    letter-spacing: -0.3px;
}
.otp-modal-header p { font-size: 0.85rem; margin: 0; opacity: 0.9; }
.otp-modal-close {
    position: absolute;
    top: 16px; right: 20px;
    background: rgba(255,255,255,0.2);
    border: none;
    border-radius: 50%;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: #fff;
    font-size: 16px;
    transition: background 0.2s;
}
.otp-modal-close:hover { background: rgba(255,255,255,0.35); }
.otp-modal-body { padding: 28px 28px 24px; }

/* Login form fields */
.otp-field-group { margin-bottom: 16px; }
.otp-field-group label {
    font-size: 0.8rem;
    font-weight: 700;
    color: #555;
    margin-bottom: 6px;
    display: block;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}
.otp-field-group .inp-wrap { position: relative; }
.otp-field-group .inp-wrap i {
    position: absolute;
    left: 13px; top: 50%;
    transform: translateY(-50%);
    color: #FC5D09; font-size: 14px;
}
.otp-field-group input {
    width: 100%;
    height: 46px;
    border: 1.5px solid #e0e0e0;
    border-radius: 0;
    padding: 0 14px 0 40px;
    font-size: 0.92rem;
    color: #222;
    background: #fafafa;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.otp-field-group input:focus {
    border-color: #FC5D09;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(252, 93, 9,0.09);
}
.otp-field-group .optional-tag {
    font-size: 0.72rem; color: #aaa; font-weight: 400; text-transform: none;
}

/* Note box inside modal */
.otp-note-box {
    background: #fff3cd;
    border-left: 3px solid #ffc107;
    border-radius: 0;
    padding: 8px 12px;
    font-size: 0.8rem;
    color: #856404;
    margin-bottom: 18px;
    line-height: 1.5;
}
.otp-note-box i { margin-right: 5px; }

/* Get OTP button */
.get-otp-btn {
    width: 100%;
    height: 48px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 6px 20px rgba(252, 93, 9,0.28);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.get-otp-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(252, 93, 9,0.38);
}

/* ─── OTP VERIFY SCREEN ─── */
#otpScreen { display: none; }
.otp-verify-title {
    text-align: center;
    font-size: 1.15rem;
    font-weight: 800;
    color: #FC5D09;
    line-height: 1.4;
    margin-bottom: 6px;
}
.otp-sent-to {
    text-align: center;
    font-size: 0.88rem;
    color: #666;
    margin-bottom: 24px;
}
.otp-sent-to span { font-weight: 700; color: #222; }

/* 6-box OTP Input */
.otp-boxes {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 28px;
}
.otp-boxes input {
    width: 48px;
    height: 56px;
    text-align: center;
    font-size: 1.5rem;
    font-weight: 700;
    color: #222;
    border: 2px solid #e0e0e0;
    border-radius: 0;
    outline: none;
    background: #fafafa;
    caret-color: #FC5D09;
    transition: border-color 0.18s, box-shadow 0.18s, background 0.18s;
    -moz-appearance: textfield;
}
.otp-boxes input::-webkit-outer-spin-button,
.otp-boxes input::-webkit-inner-spin-button { -webkit-appearance: none; }
.otp-boxes input:focus {
    border-color: #FC5D09;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(252, 93, 9,0.12);
}
.otp-boxes input.filled {
    border-color: #FC5D09;
    background: #fff0f0;
}

/* Validate button */
.validate-btn {
    width: 100%;
    height: 50px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    border: none;
    border-radius: 4px;
    font-size: 1.05rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 6px 20px rgba(252, 93, 9,0.28);
    letter-spacing: 0.5px;
}
.validate-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(252, 93, 9,0.38);
}
.resend-row {
    text-align: center;
    margin-top: 16px;
    font-size: 0.83rem;
    color: #888;
}
.resend-row button {
    background: none; border: none;
    color: #FC5D09; font-weight: 700;
    cursor: pointer; padding: 0;
    font-size: 0.83rem;
}
.back-to-login {
    display: block;
    text-align: center;
    margin-top: 12px;
    font-size: 0.82rem;
    color: #888;
    cursor: pointer;
    text-decoration: none;
}
.back-to-login:hover { color: #FC5D09; }
</style>

<div class="modal fade" id="otpLoginModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header -->
            <div class="otp-modal-header">
                <h5 id="modalTitleText"><i class="bi bi-shield-lock me-2"></i>Secure Login</h5>
                <p id="modalSubText">Login with your mobile number to submit inquiry</p>
                <button class="otp-modal-close" data-bs-dismiss="modal" type="button">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <!-- Body -->
            <div class="otp-modal-body">

                <!-- ─── STEP 1: LOGIN FORM ─── -->
                <div id="loginFormScreen">
                    <div class="otp-note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Please enter a <strong>valid and available mobile number</strong>. An OTP will be sent to this number for verification.
                    </div>

                    <div class="otp-field-group">
                        <label>Full Name</label>
                        <div class="inp-wrap">
                            <i class="bi bi-person-fill"></i>
                            <input type="text" id="loginName" placeholder="Enter your full name" autocomplete="off">
                        </div>
                    </div>
                    <div class="otp-field-group">
                        <label>Email <span class="optional-tag">(Optional)</span></label>
                        <div class="inp-wrap">
                            <i class="bi bi-envelope-fill"></i>
                            <input type="email" id="loginEmail" placeholder="your@email.com" autocomplete="off">
                        </div>
                    </div>
                    <div class="otp-field-group">
                        <label>Mobile Number</label>
                        <div class="inp-wrap">
                            <i class="bi bi-phone-fill"></i>
                            <input type="tel" id="loginMobile" placeholder="10-digit mobile number" maxlength="10" autocomplete="off">
                        </div>
                    </div>

                    <div id="loginFormError" class="text-danger mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="get-otp-btn" id="getOtpBtn" onclick="sendOtp(false)">
                        <i class="bi bi-send-fill"></i> Get OTP
                    </button>

                    <!-- Already Registered Link -->
                    <div style="text-align:center; margin-top:14px;">
                        <span style="font-size:0.8rem; color:#888;">Already registered? </span>
                        <a href="#" id="alreadyRegisteredLink" onclick="showPhoneOnlyLoginScreen(); return false;" style="font-size:0.8rem; color:#FC5D09; font-weight:700; text-decoration:underline;">
                            <i class="bi bi-phone-fill"></i> Login with your number
                        </a>
                    </div>
                </div>

                <!-- ─── STEP 1C: PHONE-ONLY LOGIN SCREEN (Returning User by phone entry) ─── -->
                <div id="phoneOnlyLoginScreen" style="display:none;">
                    <div class="otp-note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Enter your <strong>registered mobile number</strong> to login directly with OTP.
                    </div>
                    <div class="otp-field-group">
                        <label>Registered Mobile Number</label>
                        <div class="inp-wrap">
                            <i class="bi bi-phone-fill"></i>
                            <input type="tel" id="phoneOnlyMobile" placeholder="10-digit registered number" maxlength="10" autocomplete="off">
                        </div>
                    </div>
                    <div id="phoneOnlyError" class="text-danger mb-3" style="font-size:0.82rem; display:none;"></div>
                    <button class="get-otp-btn" id="phoneOnlyOtpBtn" onclick="sendPhoneOnlyOtp()">
                        <i class="bi bi-send-fill"></i> Get OTP
                    </button>
                    <a class="back-to-login" onclick="showLoginForm(false)">
                        <i class="bi bi-arrow-left"></i> New user? Register here
                    </a>
                </div>

                <!-- ─── STEP 1B: RETURNING USER SCREEN ─── -->
                <div id="returningUserScreen" style="display:none;">
                    <div class="otp-note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Available and valid mobile number is registered. OTP will be sent to this number.
                    </div>
                    
                    <div class="text-center mb-4">
                        <div style="width: 54px; height: 54px; background: #fff5ed; border: 1.5px solid #FC5D09; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                            <i class="bi bi-person-fill" style="color:#FC5D09; font-size:24px;"></i>
                        </div>
                        <h6 class="fw-bold mb-1" id="returningUserName" style="color: #1a1a2e;">User Name</h6>
                        <p class="text-muted small mb-0" id="returningUserMobile" style="font-weight: 600; letter-spacing: 0.3px;">Mobile</p>
                    </div>

                    <div id="returningUserError" class="text-danger text-center mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="get-otp-btn" id="sendReturningOtpBtn" onclick="sendOtp(true)">
                        <i class="bi bi-send-fill"></i> Get OTP
                    </button>
                    
                    <a class="back-to-login" onclick="showLoginForm(true)">
                        <i class="bi bi-person-plus-fill"></i> Use a different number
                    </a>
                </div>

                <!-- ─── STEP 2: OTP VERIFY SCREEN ─── -->
                <div id="otpScreen">
                    <div class="otp-verify-title">Please enter the one time password<br>to verify your account</div>
                    <div class="otp-sent-to">A code has been sent to <span id="maskedMobile">••••••9897</span></div>
                    <div id="otpDevHint" class="text-center mt-1" style="font-size:0.78rem; color:#d9534f; display:none;"></div>

                    <div class="otp-boxes">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp1">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp2">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp3">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp4">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp5">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp6">
                    </div>

                    <div id="otpError" class="text-danger text-center mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="validate-btn" id="validateBtn" onclick="verifyOtp()">Validate</button>

                    <div class="resend-row">
                        Didn't receive the OTP? <button onclick="resendOtp()">Resend</button>
                    </div>
                    <a class="back-to-login" onclick="showLoginForm(false)">
                        <i class="bi bi-arrow-left"></i> Back to Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
// ─── MSG91 Widget Credentials (same as mobile app) ───────────────────────────
var MSG91_WIDGET_ID  = '36686266774e343530343138';
var MSG91_TOKEN_AUTH = '556182T8qj8j5D9j6a6f0ae7P1';

// Active reqId from MSG91 (returned when OTP is sent browser-side)
var _otpReqId = '';

// ─── Shared State ───
if (typeof _isLoggedIn === 'undefined')  { var _isLoggedIn  = false; }
if (typeof _pendingSubmit === 'undefined') { var _pendingSubmit = false; }

$(function () {
    // Append modal to body to fix unclickable z-index issues on mobile
    $('#otpLoginModal').appendTo('body');

    // ─── OTP digit box auto-advance ───
    $('.otp-digit').on('input', function () {
        var val = $(this).val();
        if (val.length > 1) $(this).val(val.slice(-1));
        $(this).toggleClass('filled', val.length > 0);
        if (val.length === 1) {
            $(this).closest('.otp-boxes').find('input').eq($(this).index('.otp-digit') + 1).focus();
        }
    }).on('keydown', function (e) {
        if (e.key === 'Backspace' && !$(this).val()) {
            $(this).closest('.otp-boxes').find('input').eq($(this).index('.otp-digit') - 1).focus();
        }
    });

    checkLoginStatus();
});

// ─── Check login ───
function checkLoginStatus() {
    $.getJSON('<?= site_url("user-auth/check-login") ?>', function (r) {
        if (r.logged_in) { setLoggedIn(r.user); } else { setLoggedOut(); }
    });
}

function setLoggedIn(userData) {
    _isLoggedIn = true;
    var name   = (typeof userData === 'object' && userData !== null) ? userData.name   : userData;
    var mobile = (typeof userData === 'object' && userData !== null) ? userData.mobile : '';
    $('#loginNoteBar').addClass('d-none');
    if (mobile) {
        if ($('#phone').length     && !$('#phone').val())       $('#phone').val(mobile);
        if ($('#wizardPhone').length && !$('#wizardPhone').val()) $('#wizardPhone').val(mobile);
    }
    if (typeof navSetLoggedIn === 'function') navSetLoggedIn(name);
}

function setLoggedOut() {
    _isLoggedIn = false;
    $('#loginNoteBar').removeClass('d-none');
    if (typeof navSetLoggedOut === 'function') navSetLoggedOut();
}

// ─── Open Login Modal ───
function openLoginModal() {
    var stored = localStorage.getItem('bhandari_user');
    if (stored) {
        try {
            var user = JSON.parse(stored);
            if (user && user.name && user.mobile) {
                $.ajax({
                    type: 'POST', url: '<?= site_url("user-auth/check-mobile") ?>',
                    data: { mobile: user.mobile }, dataType: 'json',
                    success: function (r) {
                        if (r.exists) {
                            localStorage.setItem('bhandari_user', JSON.stringify({ name: r.name, mobile: r.mobile }));
                            showReturningUserForm(r.name, r.mobile);
                        } else { showLoginForm(true); }
                    },
                    error: function () { showReturningUserForm(user.name, user.mobile); }
                });
            } else { showLoginForm(false); }
        } catch (e) { showLoginForm(false); }
    } else { showLoginForm(false); }

    $('#loginFormError, #returningUserError').hide().text('');
    $('#loginName, #loginEmail, #loginMobile').val('');
    if ($('#form_user_name').length && $('#form_user_name').val()) $('#loginName').val($('#form_user_name').val());
    if ($('#service_form_phone').length && $('#service_form_phone').val()) $('#loginMobile').val($('#service_form_phone').val());
    var modal = new bootstrap.Modal(document.getElementById('otpLoginModal'));
    modal.show();
}

function showLoginForm(forceClear) {
    if (forceClear) localStorage.removeItem('bhandari_user');
    $('#loginFormScreen').show();
    $('#returningUserScreen, #phoneOnlyLoginScreen, #otpScreen').hide();
    $('#modalTitleText').html('<i class="bi bi-shield-lock me-2"></i>Secure Login');
    $('#modalSubText').text('Login with your mobile number to submit inquiry');
}

function showReturningUserForm(name, mobile) {
    $('#returningUserName').text(name);
    $('#returningUserMobile').text(mobile);
    $('#loginFormScreen, #phoneOnlyLoginScreen, #otpScreen').hide();
    $('#returningUserScreen').show();
    $('#modalTitleText').html('<i class="bi bi-shield-lock me-2"></i>Welcome Back');
    $('#modalSubText').text('Log in quickly with your saved number');
}

function showPhoneOnlyLoginScreen() {
    $('#loginFormScreen, #returningUserScreen, #otpScreen').hide();
    $('#phoneOnlyLoginScreen').show();
    $('#phoneOnlyError').hide().text('');
    $('#phoneOnlyMobile').val('').focus();
    $('#modalTitleText').html('<i class="bi bi-phone me-2"></i>Returning User Login');
    $('#modalSubText').text('Enter your registered number to get OTP');
}

// ─── Core: Send OTP from BROWSER directly to MSG91 Widget API ────────────────
// This NEVER causes IPBlocked because it's the user's browser calling MSG91,
// not the server. Works identically on localhost and live.
function _browserSendOtp(mobile10, onSuccess, onError) {
    var mobile91 = '91' + mobile10;
    fetch('https://control.msg91.com/api/v5/widget/sendOtp', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            widgetId:   MSG91_WIDGET_ID,
            tokenAuth:  MSG91_TOKEN_AUTH,
            identifier: mobile91
        })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data && data.type === 'success' && data.message) {
            _otpReqId = data.message; // Store reqId for verification
            onSuccess();
        } else {
            onError(data && data.message ? data.message : 'Failed to send OTP. Please try again.');
        }
    })
    .catch(function(err) {
        onError('Network error contacting MSG91. Please try again.');
    });
}

// ─── Core: Verify OTP from BROWSER directly to MSG91 Widget API ─────────────
// This avoids server-side IPBlocked errors during OTP validation.
function _browserVerifyOtp(otp, reqId, onSuccess, onError) {
    fetch('https://control.msg91.com/api/v5/widget/verifyOtp', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            widgetId:  MSG91_WIDGET_ID,
            tokenAuth: MSG91_TOKEN_AUTH,
            reqId:     reqId,
            otp:       otp
        })
    })
    .then(function(res) { return res.json(); })
    .then(function(data) {
        if (data && data.type === 'success') {
            onSuccess();
        } else {
            onError(data && data.message ? data.message : 'Invalid OTP entered. Please try again.');
        }
    })
    .catch(function(err) {
        onError('Network error contacting MSG91. Please try again.');
    });
}

// ─── Send OTP for Phone-Only Login ───────────────────────────────────────────
function sendPhoneOnlyOtp() {
    var mobile = $.trim($('#phoneOnlyMobile').val());
    $('#phoneOnlyError').hide().text('');

    if (!mobile || !/^\d{10}$/.test(mobile)) {
        $('#phoneOnlyError').show().text('Please enter a valid 10-digit registered mobile number.');
        return;
    }

    var btn = $('#phoneOnlyOtpBtn');
    var origHtml = btn.html();
    btn.prop('disabled', true).html('<i class="bi bi-arrow-repeat"></i> Checking...');

    $.ajax({
        type: 'POST', url: '<?= site_url("user-auth/check-mobile") ?>',
        data: { mobile: mobile }, dataType: 'json',
        success: function(r) {
            if (r.exists) {
                localStorage.setItem('bhandari_user', JSON.stringify({ name: r.name, mobile: mobile }));
                btn.html('<i class="bi bi-arrow-repeat"></i> Sending OTP...');

                // Step 1: Prepare session on server
                $.ajax({
                    type: 'POST', url: '<?= site_url("user-auth/prepare-otp") ?>',
                    data: { name: r.name, mobile: mobile, returning: 1 }, dataType: 'json',
                    success: function(pr) {
                        if (!pr.success) {
                            btn.prop('disabled', false).html(origHtml);
                            $('#phoneOnlyError').show().text(pr.message || 'Preparation failed.');
                            return;
                        }
                        // Step 2: Send OTP from browser (no IPBlocked)
                        _browserSendOtp(mobile,
                            function() { // success
                                btn.prop('disabled', false).html(origHtml);
                                $('#maskedMobile').text('••••••' + mobile.slice(-4));
                                clearOtpBoxes();
                                $('#phoneOnlyLoginScreen').hide();
                                $('#otpScreen').show();
                                $('#modalTitleText').html('<i class="bi bi-phone me-2"></i>Verify OTP');
                                $('#modalSubText').text('Enter the 6-digit code sent to your mobile');
                                $('#otp1').focus();
                            },
                            function(errMsg) { // error
                                btn.prop('disabled', false).html(origHtml);
                                $('#phoneOnlyError').show().text(errMsg);
                            }
                        );
                    },
                    error: function() {
                        btn.prop('disabled', false).html(origHtml);
                        $('#phoneOnlyError').show().text('Network error. Please try again.');
                    }
                });
            } else {
                btn.prop('disabled', false).html(origHtml);
                $('#phoneOnlyError').show().text('This number is not registered. Please use the new user form above.');
            }
        },
        error: function() {
            btn.prop('disabled', false).html(origHtml);
            $('#phoneOnlyError').show().text('Network error. Please try again.');
        }
    });
}

// ─── Send OTP (new user or returning user from localStorage) ─────────────────
function sendOtp(isReturning) {
    var name, email, mobile;
    if (isReturning) {
        try {
            var stored = JSON.parse(localStorage.getItem('bhandari_user'));
            if (!stored) { showLoginForm(true); return; }
            name = stored.name; email = ''; mobile = stored.mobile;
        } catch (e) { showLoginForm(true); return; }
    } else {
        name   = $.trim($('#loginName').val());
        email  = $.trim($('#loginEmail').val());
        mobile = $.trim($('#loginMobile').val());
    }

    if (isReturning) {
        $('#returningUserError').hide().text('');
    } else {
        $('#loginFormError').hide().text('');
        if (!name || name.length < 2)       { showFormError('Please enter your full name.', false); return; }
        if (!mobile || !/^\d{10}$/.test(mobile)) { showFormError('Please enter a valid 10-digit mobile number.', false); return; }
    }

    var btn = isReturning ? $('#sendReturningOtpBtn') : $('#getOtpBtn');
    var origHtml = btn.html();
    btn.prop('disabled', true).html('<i class="bi bi-arrow-repeat"></i> Preparing...');

    // Step 1: Validate on server, store session
    $.ajax({
        type: 'POST', url: '<?= site_url("user-auth/prepare-otp") ?>',
        data: { name: name, email: email, mobile: mobile, returning: isReturning ? 1 : 0 },
        dataType: 'json',
        success: function(r) {
            if (!r.success) {
                btn.prop('disabled', false).html(origHtml);
                showFormError(r.message, isReturning);
                return;
            }

            btn.html('<i class="bi bi-arrow-repeat"></i> Sending OTP...');

            // Step 2: Send OTP directly from BROWSER to MSG91 (no server IP, no IPBlocked)
            _browserSendOtp(mobile,
                function() { // success
                    btn.prop('disabled', false).html(origHtml);
                    $('#maskedMobile').text('••••••' + mobile.slice(-4));
                    clearOtpBoxes();
                    $('#loginFormScreen, #returningUserScreen').hide();
                    $('#otpScreen').show();
                    $('#modalTitleText').html('<i class="bi bi-phone me-2"></i>Verify OTP');
                    $('#modalSubText').text('Enter the 6-digit code sent to your mobile');
                    $('#otp1').focus();
                },
                function(errMsg) { // error
                    btn.prop('disabled', false).html(origHtml);
                    showFormError(errMsg, isReturning);
                }
            );
        },
        error: function() {
            btn.prop('disabled', false).html(origHtml);
            showFormError('Network error. Please try again.', isReturning);
        }
    });
}

function showFormError(msg, isReturning) {
    if (isReturning) { $('#returningUserError').show().text(msg); }
    else             { $('#loginFormError').show().text(msg);      }
}

// ─── Verify OTP (browser-side first, then server-side session setup) ──────────
function verifyOtp() {
    var otp = '';
    $('.otp-digit').each(function() { otp += $(this).val(); });
    $('#otpError').hide().text('');

    if (otp.length !== 6) {
        $('#otpError').show().text('Please enter all 6 digits of the OTP.');
        return;
    }

    if (!_otpReqId) {
        $('#otpError').show().text('Session expired. Please request a new OTP.');
        return;
    }

    var btn = $('#validateBtn');
    btn.prop('disabled', true).text('Verifying...');

    // Step 1: Verify OTP browser-side directly to MSG91 (never IPBlocked)
    _browserVerifyOtp(otp, _otpReqId,
        function() { // success
            // Step 2: Tell server that OTP is verified, setup session and DB records
            $.ajax({
                type: 'POST', url: '<?= site_url("user-auth/verify-otp") ?>',
                data: { otp: otp, req_id: _otpReqId, browser_verified: 1 },
                dataType: 'json',
                success: function (r) {
                    if (r.success) {
                        localStorage.setItem('bhandari_user', JSON.stringify({ name: r.user_name, mobile: r.mobile }));
                        bootstrap.Modal.getInstance(document.getElementById('otpLoginModal')).hide();
                        setLoggedIn({ name: r.user_name, mobile: r.mobile });
                        _otpReqId = ''; // Clear reqId

                        var firstName = r.user_name ? r.user_name.split(' ')[0] : 'there';
                        Swal.fire({
                            html:
                                '<div style="text-align:center;padding:8px 0 4px;">'
                                + '<div style="width:64px;height:64px;background:linear-gradient(135deg,#FC5D09,#ff4b2b);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 6px 20px rgba(252, 93, 9,0.35);">'
                                + '<i class="bi bi-person-check-fill" style="color:#fff;font-size:28px;"></i>'
                                + '</div>'
                                + '<div style="font-size:1.35rem;font-weight:800;color:#1a1a2e;margin-bottom:6px;">Welcome, ' + firstName + '! <span style="font-size:1.2rem;">&#128075;</span></div>'
                                + '<div style="font-size:0.88rem;color:#666;line-height:1.6;margin-bottom:14px;">' + r.message + '</div>'
                                + '<div style="display:inline-flex;align-items:center;gap:6px;background:#fff5ed;border:1px solid #f5c0c0;border-radius:6px;padding:6px 14px;font-size:0.8rem;color:#DD3802;font-weight:600;">'
                                + '<i class="bi bi-shield-check"></i> Verified Member'
                                + '</div>'
                                + '</div>',
                            showConfirmButton: false, timer: 3500, timerProgressBar: true,
                            customClass: { popup: 'swal-bhandari-welcome', timerProgressBar: 'swal-bhandari-bar' },
                            didOpen: function() {
                                var bar = Swal.getPopup().querySelector('.swal2-timer-progress-bar');
                                if (bar) bar.style.background = '#FC5D09';
                            }
                        }).then(function() {
                            if (typeof _postLoginRedirect !== 'undefined' && _postLoginRedirect) {
                                var target = _postLoginRedirect; _postLoginRedirect = null;
                                window.location.href = target; return;
                            }
                            if (_pendingSubmit) { _pendingSubmit = false; if (typeof submitBooking === 'function') submitBooking(); }
                        });
                    } else {
                        $('#otpError').show().text(r.message);
                    }
                },
                error: function() { $('#otpError').show().text('Network error. Please try again.'); },
                complete: function() { btn.prop('disabled', false).text('Validate'); }
            });
        },
        function(errMsg) { // validation failed browser-side
            btn.prop('disabled', false).text('Validate');
            $('#otpError').show().text(errMsg);
        }
    );
}

// ─── Resend OTP ───────────────────────────────────────────────────────────────
function resendOtp() {
    var stored = localStorage.getItem('bhandari_user');
    var mobile = $('#loginMobile').val() || '';
    if (stored) {
        try { var u = JSON.parse(stored); if (u && u.mobile) mobile = u.mobile; } catch(e) {}
    }
    if (!mobile) { showLoginForm(false); return; }

    $('#otpError').hide();
    // Re-send OTP directly from browser
    _browserSendOtp(mobile,
        function() {
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'New OTP sent!', showConfirmButton: false, timer: 3000 });
            clearOtpBoxes();
        },
        function(errMsg) {
            $('#otpError').show().text(errMsg);
        }
    );
}

function clearOtpBoxes() { $('.otp-digit').val('').removeClass('filled'); }

function doLogout() {
    $.getJSON('<?= site_url("user-auth/logout") ?>', function() {
        setLoggedOut();
        Swal.fire({ icon:'info', title:'Logged out', timer:1500, showConfirmButton:false });
    });
}
</script>
<script type="text/javascript">
// Load MSG91 Web Verification SDK dynamically
(function loadOtpScript(urls) {
    let i = 0;
    function attempt() {
        const s = document.createElement('script');
        s.src = urls[i];
        s.async = true;
        s.onload = () => {
            console.log('MSG91 OTP Verification SDK loaded successfully');
        };
        s.onerror = () => {
            i++;
            if (i < urls.length) {
                attempt();
            }
        };
        document.head.appendChild(s);
    }
    attempt();
})([
    'https://verify.msg91.com/otp-provider.js',
    'https://verify.phone91.com/otp-provider.js'
]);
</script>
