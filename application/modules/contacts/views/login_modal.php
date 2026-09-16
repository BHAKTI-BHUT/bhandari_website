<!-- Razorpay JS SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<!-- ═══════════════════════════════════════════
     SHARED OTP LOGIN MODAL & AUTH JS
     ═══════════════════════════════════════════ -->
<style>
/* ─── Shared OTP Login Modal CSS ─── */
#otpLoginModal { z-index: 10600 !important; }
#otpLoginModal .modal-dialog { max-width: 440px; z-index: 10605 !important; }
#otpLoginModal .modal-content {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.18);
    border-top: 4px solid #FC5D09;
}

/* Modal Header strip */
.otp-modal-header {
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    padding: 20px 24px 16px;
    color: #fff;
    position: relative;
}
.otp-modal-header h5 {
    font-size: 1.25rem;
    font-weight: 800;
    margin: 0 0 4px;
    letter-spacing: -0.3px;
}
.otp-modal-header p { font-size: 0.84rem; margin: 0; opacity: 0.92; }
.otp-modal-close {
    position: absolute;
    top: 16px; right: 18px;
    background: rgba(255,255,255,0.2);
    border: none;
    border-radius: 50%;
    width: 32px; height: 32px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer;
    color: #fff;
    font-size: 15px;
    transition: background 0.2s;
}
.otp-modal-close:hover { background: rgba(255,255,255,0.35); }
.otp-modal-body { padding: 22px 24px 24px; }

/* ─── Auth Switch Tabs ─── */
.auth-tabs {
    background: #f3f4f6;
    border-radius: 8px;
    padding: 4px;
    display: flex;
    gap: 4px;
    margin-bottom: 18px;
}
.auth-tab-btn {
    flex: 1;
    background: transparent;
    border: none;
    padding: 8px 12px;
    font-size: 0.85rem;
    font-weight: 700;
    color: #666;
    border-radius: 6px;
    transition: all 0.2s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
}
.auth-tab-btn.active {
    background: #fff;
    color: #FC5D09;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

/* Login form fields */
.otp-field-group { margin-bottom: 16px; }
.otp-field-group label {
    font-size: 0.78rem;
    font-weight: 700;
    color: #555;
    margin-bottom: 6px;
    display: block;
    letter-spacing: 0.3px;
    text-transform: uppercase;
}
.otp-field-group .inp-wrap { position: relative; }
.otp-field-group .inp-wrap i.field-icon {
    position: absolute;
    left: 14px; top: 50%;
    transform: translateY(-50%);
    color: #FC5D09; font-size: 15px;
    z-index: 2;
}
.otp-field-group .inp-wrap .phone-prefix {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    color: #555;
    font-size: 0.9rem;
    font-weight: 700;
    z-index: 2;
    padding-right: 6px;
    border-right: 1.5px solid #e0e0e0;
    display: flex;
    align-items: center;
    gap: 4px;
}
.otp-field-group input {
    width: 100%;
    height: 46px;
    border: 1.5px solid #e0e0e0;
    border-radius: 6px;
    padding: 0 14px 0 40px;
    font-size: 0.92rem;
    color: #222;
    background: #fafafa;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.otp-field-group input.with-prefix {
    padding-left: 56px;
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
    background: #fff8f3;
    border-left: 3px solid #FC5D09;
    border-radius: 4px;
    padding: 8px 12px;
    font-size: 0.8rem;
    color: #7c3a00;
    margin-bottom: 16px;
    line-height: 1.45;
}
.otp-note-box i { margin-right: 5px; color: #FC5D09; }

/* Action buttons */
.get-otp-btn {
    width: 100%;
    height: 48px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 0.98rem;
    font-weight: 700;
    letter-spacing: 0.4px;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 16px rgba(252, 93, 9,0.28);
    display: flex; align-items: center; justify-content: center; gap: 8px;
}
.get-otp-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 22px rgba(252, 93, 9,0.36);
}
.get-otp-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

/* ─── OTP VERIFY SCREEN ─── */
#otpScreen { display: none; }
.otp-verify-title {
    text-align: center;
    font-size: 1.15rem;
    font-weight: 800;
    color: #1a1a2e;
    line-height: 1.4;
    margin-bottom: 4px;
}
.otp-sent-to {
    text-align: center;
    font-size: 0.86rem;
    color: #666;
    margin-bottom: 22px;
}
.otp-sent-to span { font-weight: 700; color: #222; }

/* 6-box OTP Input */
.otp-boxes {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-bottom: 24px;
}
.otp-boxes input {
    width: 46px;
    height: 52px;
    text-align: center;
    font-size: 1.4rem;
    font-weight: 700;
    color: #222;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
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
    background: #fff5f0;
}

/* Validate button */
.validate-btn {
    width: 100%;
    height: 48px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    border: none;
    border-radius: 6px;
    font-size: 1.02rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s;
    box-shadow: 0 4px 16px rgba(252, 93, 9,0.28);
    letter-spacing: 0.4px;
}
.validate-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 8px 22px rgba(252, 93, 9,0.36);
}
.validate-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}
.resend-row {
    text-align: center;
    margin-top: 16px;
    font-size: 0.83rem;
    color: #777;
}
.resend-row button {
    background: none; border: none;
    color: #FC5D09; font-weight: 700;
    cursor: pointer; padding: 0;
    font-size: 0.83rem;
}
.resend-row button:disabled {
    color: #aaa;
    cursor: not-allowed;
}
.back-to-login {
    display: block;
    text-align: center;
    margin-top: 14px;
    font-size: 0.82rem;
    color: #888;
    cursor: pointer;
    text-decoration: none;
}
.back-to-login:hover { color: #FC5D09; }

/* Switch link below forms */
.auth-footer-switch {
    text-align: center;
    margin-top: 14px;
    font-size: 0.82rem;
    color: #666;
}
.auth-footer-switch a {
    color: #FC5D09;
    font-weight: 700;
    text-decoration: none;
    cursor: pointer;
}
.auth-footer-switch a:hover {
    text-decoration: underline;
}
</style>

<div class="modal fade" id="otpLoginModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Header -->
            <div class="otp-modal-header">
                <h5 id="modalTitleText"><i class="bi bi-shield-lock me-2"></i>Welcome to Bhandari Packers</h5>
                <p id="modalSubText">Login or Register with your mobile number</p>
                <button class="otp-modal-close" data-bs-dismiss="modal" type="button">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <!-- Body -->
            <div class="otp-modal-body">

                <!-- ─── TABS HEADER (Hidden on OTP Screen) ─── -->
                <div class="auth-tabs" id="authTabsContainer">
                    <button type="button" class="auth-tab-btn active" id="tabLoginBtn" onclick="switchAuthTab('login')">
                        <i class="bi bi-box-arrow-in-right"></i> Quick Login
                    </button>
                    <button type="button" class="auth-tab-btn" id="tabRegisterBtn" onclick="switchAuthTab('register')">
                        <i class="bi bi-person-plus"></i> Register
                    </button>
                </div>

                <!-- ─── SCREEN 1: QUICK LOGIN FORM (DEFAULT) ─── -->
                <div id="loginFormScreen">
                    <div class="otp-note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Enter your <strong>10-digit mobile number</strong> to receive a 6-digit verification code.
                    </div>

                    <div class="otp-field-group">
                        <label>Mobile Number</label>
                        <div class="inp-wrap">
                            <span class="phone-prefix">+91</span>
                            <input type="tel" id="loginMobile" class="with-prefix" placeholder="10-digit mobile number" maxlength="10" autocomplete="tel">
                        </div>
                    </div>

                    <div id="loginFormError" class="text-danger mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="get-otp-btn" id="loginOtpBtn" onclick="sendLoginOtp()">
                        <i class="bi bi-send-fill"></i> Get OTP
                    </button>

                    <div class="auth-footer-switch">
                        New user? <a onclick="switchAuthTab('register')">Create an account here</a>
                    </div>
                </div>

                <!-- ─── SCREEN 2: REGISTRATION FORM ─── -->
                <div id="registerFormScreen" style="display:none;">
                    <div class="otp-note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Create your account with your name & mobile number for bookings and quotes.
                    </div>

                    <div class="otp-field-group">
                        <label>Full Name</label>
                        <div class="inp-wrap">
                            <i class="bi bi-person-fill field-icon"></i>
                            <input type="text" id="registerName" placeholder="Enter your full name" autocomplete="name">
                        </div>
                    </div>

                    <div class="otp-field-group">
                        <label>Mobile Number</label>
                        <div class="inp-wrap">
                            <span class="phone-prefix">+91</span>
                            <input type="tel" id="registerMobile" class="with-prefix" placeholder="10-digit mobile number" maxlength="10" autocomplete="tel">
                        </div>
                    </div>

                    <div class="otp-field-group">
                        <label>Email <span class="optional-tag">(Optional)</span></label>
                        <div class="inp-wrap">
                            <i class="bi bi-envelope-fill field-icon"></i>
                            <input type="email" id="registerEmail" placeholder="your@email.com" autocomplete="email">
                        </div>
                    </div>

                    <div id="registerFormError" class="text-danger mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="get-otp-btn" id="registerOtpBtn" onclick="sendRegisterOtp()">
                        <i class="bi bi-person-check-fill"></i> Register & Get OTP
                    </button>

                    <div class="auth-footer-switch">
                        Already have an account? <a onclick="switchAuthTab('login')">Login here</a>
                    </div>
                </div>

                <!-- ─── SCREEN 3: RETURNING USER SCREEN ─── -->
                <div id="returningUserScreen" style="display:none;">
                    <div class="otp-note-box">
                        <i class="bi bi-info-circle-fill"></i>
                        Welcome back! We'll send an OTP to your saved number.
                    </div>
                    
                    <div class="text-center mb-4">
                        <div style="width: 56px; height: 56px; background: #fff5ed; border: 2px solid #FC5D09; border-radius:50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size:24px; color:#FC5D09; font-weight:800;" id="returningUserAvatar">
                            U
                        </div>
                        <h6 class="fw-bold mb-1" id="returningUserName" style="color: #1a1a2e; font-size: 1.05rem;">User Name</h6>
                        <p class="text-muted small mb-0" id="returningUserMobile" style="font-weight: 600; letter-spacing: 0.3px;">+91 ••••••••••</p>
                    </div>

                    <div id="returningUserError" class="text-danger text-center mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="get-otp-btn" id="sendReturningOtpBtn" onclick="sendReturningOtp()">
                        <i class="bi bi-send-fill"></i> Get OTP
                    </button>
                    
                    <a class="back-to-login" onclick="switchAuthTab('login', true)">
                        <i class="bi bi-arrow-left-right"></i> Use a different number
                    </a>
                </div>

                <!-- ─── SCREEN 4: OTP VERIFY SCREEN ─── -->
                <div id="otpScreen">
                    <div class="otp-verify-title">Enter Verification Code</div>
                    <div class="otp-sent-to">A 6-digit code has been sent to <span id="maskedMobile">+91 ••••••9897</span></div>

                    <div class="otp-boxes">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp1">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp2">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp3">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp4">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp5">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" class="otp-digit" maxlength="1" id="otp6">
                    </div>

                    <div id="otpError" class="text-danger text-center mb-3" style="font-size:0.82rem; display:none;"></div>

                    <button class="validate-btn" id="validateBtn" onclick="verifyOtp()">Validate & Login</button>

                    <div class="resend-row" id="resendRow">
                        Didn't receive the OTP? <button id="resendBtn" onclick="resendOtp()">Resend</button>
                        <span id="resendCountdown" class="ms-1 text-muted" style="display:none;"></span>
                    </div>
                    <a class="back-to-login" onclick="backToAuthForm()">
                        <i class="bi bi-arrow-left"></i> Change mobile number
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
// ─── MSG91 Widget Credentials ───────────────────────────────────────────
var MSG91_WIDGET_ID  = '36686266774e343530343138';
var MSG91_TOKEN_AUTH = '556182T8qj8j5D9j6a6f0ae7P1';

// Active reqId and mobile from MSG91
var _otpReqId = '';
var _activeAuthMobile = '';
var _resendTimer = null;

// ─── Shared State ───
if (typeof _isLoggedIn === 'undefined')  { var _isLoggedIn  = false; }
if (typeof _pendingSubmit === 'undefined') { var _pendingSubmit = false; }
if (typeof _pendingWizardSubmit === 'undefined') { var _pendingWizardSubmit = false; }

$(function () {
    // Append modal to body to fix unclickable z-index issues on mobile
    $('#otpLoginModal').appendTo('body');

    // Force backdrop z-index when login modal opens
    $('#otpLoginModal').on('shown.bs.modal', function () {
        setTimeout(function() {
            $('.modal-backdrop').last().css('z-index', '10590');
        }, 10);
    });

    // ─── OTP digit box auto-advance & paste ───
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
    }).on('paste', function (e) {
        e.preventDefault();
        var pasteData = (e.originalEvent.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
        if (pasteData) {
            var digits = pasteData.slice(0, 6).split('');
            $('.otp-digit').each(function(idx) {
                if (digits[idx]) {
                    $(this).val(digits[idx]).addClass('filled');
                }
            });
            var nextIndex = Math.min(digits.length, 5);
            $('.otp-digit').eq(nextIndex).focus();
        }
    });

    // Press Enter to submit on inputs
    $('#loginMobile').on('keypress', function(e) {
        if (e.which === 13) { sendLoginOtp(); }
    });
    $('#registerName, #registerMobile, #registerEmail').on('keypress', function(e) {
        if (e.which === 13) { sendRegisterOtp(); }
    });

    checkLoginStatus();
});

// ─── Check login status on page load ───
function checkLoginStatus() {
    $.getJSON('<?= site_url("user-auth/check-login") ?>', function (r) {
        if (r.logged_in && r.user) {
            setLoggedIn(r.user);
        } else {
            setLoggedOut();
        }
    });
}

function setLoggedIn(userData) {
    _isLoggedIn = true;
    var name   = (typeof userData === 'object' && userData !== null) ? (userData.name || 'Member') : userData;
    var mobile = (typeof userData === 'object' && userData !== null) ? (userData.mobile || '') : '';
    $('#loginNoteBar').addClass('d-none');
    if (mobile) {
        if ($('#phone').length && !$('#phone').val()) $('#phone').val(mobile);
        if ($('#wizardPhone').length && !$('#wizardPhone').val()) $('#wizardPhone').val(mobile);
    }
    if (typeof navSetLoggedIn === 'function') navSetLoggedIn(name, mobile);
}

function setLoggedOut() {
    _isLoggedIn = false;
    $('#loginNoteBar').removeClass('d-none');
    if (typeof navSetLoggedOut === 'function') navSetLoggedOut();
}

// ─── Tab Switching ───
function switchAuthTab(tab, forceClearReturning) {
    if (forceClearReturning) {
        localStorage.removeItem('bhandari_user');
    }
    $('#authTabsContainer').show();
    $('#returningUserScreen, #otpScreen').hide();
    $('#loginFormError, #registerFormError, #returningUserError').hide().text('');

    if (tab === 'register') {
        $('#tabLoginBtn').removeClass('active');
        $('#tabRegisterBtn').addClass('active');
        $('#loginFormScreen').hide();
        $('#registerFormScreen').show();
        $('#modalTitleText').html('<i class="bi bi-person-plus me-2"></i>Create an Account');
        $('#modalSubText').text('Register to manage your bookings and inquiries');
        $('#registerName').focus();
    } else {
        $('#tabRegisterBtn').removeClass('active');
        $('#tabLoginBtn').addClass('active');
        $('#registerFormScreen').hide();
        $('#loginFormScreen').show();
        $('#modalTitleText').html('<i class="bi bi-shield-lock me-2"></i>Welcome Back');
        $('#modalSubText').text('Login with your mobile number to proceed');
        $('#loginMobile').focus();
    }
}

// ─── Open Login Modal (Defaults to LOGIN tab) ───
function openLoginModal(prefillMobile, forceRegister) {
    var mobileToUse = (typeof prefillMobile === 'string' && prefillMobile.trim().length > 0) ? prefillMobile.trim().replace(/\D/g, '').slice(-10) : '';
    if (!mobileToUse && $('#wizardPhone').length && $('#wizardPhone').val()) {
        mobileToUse = $('#wizardPhone').val().trim().replace(/\D/g, '').slice(-10);
    }
    if (!mobileToUse && $('#service_form_phone').length && $('#service_form_phone').val()) {
        mobileToUse = $('#service_form_phone').val().trim().replace(/\D/g, '').slice(-10);
    }

    if (forceRegister) {
        switchAuthTab('register');
        if (mobileToUse) $('#registerMobile').val(mobileToUse);
    } else if (mobileToUse) {
        switchAuthTab('login');
        $('#loginMobile').val(mobileToUse);
    } else {
        // Check for returning user stored locally
        var stored = localStorage.getItem('bhandari_user');
        if (stored) {
            try {
                var user = JSON.parse(stored);
                if (user && user.mobile) {
                    showReturningUserForm(user.name || 'Customer', user.mobile);
                } else {
                    switchAuthTab('login');
                }
            } catch (e) { switchAuthTab('login'); }
        } else {
            switchAuthTab('login');
        }
    }

    var modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('otpLoginModal'));
    modal.show();
}

function showReturningUserForm(name, mobile) {
    var initial = name ? name.charAt(0).toUpperCase() : 'U';
    $('#returningUserAvatar').text(initial);
    $('#returningUserName').text(name);
    $('#returningUserMobile').text('+91 ' + mobile);
    _activeAuthMobile = mobile;

    $('#authTabsContainer, #loginFormScreen, #registerFormScreen, #otpScreen').hide();
    $('#returningUserScreen').show();
    $('#returningUserError').hide().text('');
    $('#modalTitleText').html('<i class="bi bi-shield-lock me-2"></i>Welcome Back');
    $('#modalSubText').text('Login quickly with your saved number');
}

function backToAuthForm() {
    $('#otpScreen').hide();
    _activeAuthMobile = '';
    _otpReqId = '';
    if (_resendTimer) clearInterval(_resendTimer);
    switchAuthTab('login');
}

// ─── Browser-side MSG91 Widget Integration ───────────────────────────
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
            _otpReqId = data.message;
            onSuccess();
        } else {
            onError(data && data.message ? data.message : 'Failed to send OTP. Please try again.');
        }
    })
    .catch(function(err) {
        onError('Network error contacting SMS gateway. Please try again.');
    });
}

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
            onError(data && data.message ? data.message : 'Invalid OTP entered. Please check and try again.');
        }
    })
    .catch(function(err) {
        onError('Network error contacting verification service. Please try again.');
    });
}

// ─── 1. Send Login OTP (Phone Number Only - Seamless) ─────────────────
function sendLoginOtp() {
    var mobile = $.trim($('#loginMobile').val()).replace(/\D/g, '');
    $('#loginFormError').hide().text('');

    if (!mobile || mobile.length !== 10) {
        $('#loginFormError').show().text('Please enter a valid 10-digit mobile number.');
        return;
    }

    var btn = $('#loginOtpBtn');
    var origHtml = btn.html();
    btn.prop('disabled', true).html('<i class="bi bi-arrow-repeat spin"></i> Sending OTP...');

    _activeAuthMobile = mobile;

    // Prepare session on server
    $.ajax({
        type: 'POST',
        url: '<?= site_url("user-auth/prepare-otp") ?>',
        data: { mobile: mobile },
        dataType: 'json',
        success: function(r) {
            if (!r.success) {
                btn.prop('disabled', false).html(origHtml);
                $('#loginFormError').show().text(r.message || 'Error preparing OTP.');
                return;
            }

            // Send OTP via browser
            _browserSendOtp(mobile,
                function() { // success
                    btn.prop('disabled', false).html(origHtml);
                    showOtpVerificationScreen(mobile);
                },
                function(errMsg) { // error
                    btn.prop('disabled', false).html(origHtml);
                    $('#loginFormError').show().text(errMsg);
                }
            );
        },
        error: function() {
            btn.prop('disabled', false).html(origHtml);
            $('#loginFormError').show().text('Network error. Please try again.');
        }
    });
}

// ─── 2. Send Register OTP (Name + Mobile + Email) ─────────────────────
function sendRegisterOtp() {
    var name   = $.trim($('#registerName').val());
    var mobile = $.trim($('#registerMobile').val()).replace(/\D/g, '');
    var email  = $.trim($('#registerEmail').val());
    $('#registerFormError').hide().text('');

    if (!name || name.length < 2) {
        $('#registerFormError').show().text('Please enter your full name.');
        return;
    }
    if (!mobile || mobile.length !== 10) {
        $('#registerFormError').show().text('Please enter a valid 10-digit mobile number.');
        return;
    }

    var btn = $('#registerOtpBtn');
    var origHtml = btn.html();
    btn.prop('disabled', true).html('<i class="bi bi-arrow-repeat spin"></i> Creating account...');

    _activeAuthMobile = mobile;

    $.ajax({
        type: 'POST',
        url: '<?= site_url("user-auth/prepare-otp") ?>',
        data: { name: name, mobile: mobile, email: email, is_register: 1 },
        dataType: 'json',
        success: function(r) {
            if (!r.success) {
                btn.prop('disabled', false).html(origHtml);
                $('#registerFormError').show().text(r.message || 'Error registering.');
                return;
            }

            _browserSendOtp(mobile,
                function() {
                    btn.prop('disabled', false).html(origHtml);
                    showOtpVerificationScreen(mobile);
                },
                function(errMsg) {
                    btn.prop('disabled', false).html(origHtml);
                    $('#registerFormError').show().text(errMsg);
                }
            );
        },
        error: function() {
            btn.prop('disabled', false).html(origHtml);
            $('#registerFormError').show().text('Network error. Please try again.');
        }
    });
}

// ─── 3. Send Returning User OTP ───────────────────────────────────────
function sendReturningOtp() {
    if (!_activeAuthMobile) {
        switchAuthTab('login', true);
        return;
    }
    var btn = $('#sendReturningOtpBtn');
    var origHtml = btn.html();
    btn.prop('disabled', true).html('<i class="bi bi-arrow-repeat spin"></i> Sending OTP...');

    $.ajax({
        type: 'POST',
        url: '<?= site_url("user-auth/prepare-otp") ?>',
        data: { mobile: _activeAuthMobile, returning: 1 },
        dataType: 'json',
        success: function(r) {
            if (!r.success) {
                btn.prop('disabled', false).html(origHtml);
                $('#returningUserError').show().text(r.message || 'Error sending OTP.');
                return;
            }

            _browserSendOtp(_activeAuthMobile,
                function() {
                    btn.prop('disabled', false).html(origHtml);
                    showOtpVerificationScreen(_activeAuthMobile);
                },
                function(errMsg) {
                    btn.prop('disabled', false).html(origHtml);
                    $('#returningUserError').show().text(errMsg);
                }
            );
        },
        error: function() {
            btn.prop('disabled', false).html(origHtml);
            $('#returningUserError').show().text('Network error. Please try again.');
        }
    });
}

// ─── Show OTP Verification Screen ─────────────────────────────────────
function showOtpVerificationScreen(mobile) {
    $('#authTabsContainer, #loginFormScreen, #registerFormScreen, #returningUserScreen').hide();
    $('#maskedMobile').text('+91 ••••••' + mobile.slice(-4));
    clearOtpBoxes();
    $('#otpError').hide().text('');
    $('#otpScreen').show();
    $('#modalTitleText').html('<i class="bi bi-phone me-2"></i>Verify Mobile OTP');
    $('#modalSubText').text('Enter the 6-digit code sent to your mobile');
    $('#otp1').focus();

    startResendCountdown(120);
}

function startResendCountdown(seconds) {
    if (typeof seconds === 'undefined' || !seconds) seconds = 120;
    var btn = $('#resendBtn');
    var countEl = $('#resendCountdown');
    if (_resendTimer) clearInterval(_resendTimer);

    btn.prop('disabled', true);
    countEl.show().text('(' + seconds + 's)');

    _resendTimer = setInterval(function() {
        seconds--;
        if (seconds > 0) {
            countEl.text('(' + seconds + 's)');
        } else {
            clearInterval(_resendTimer);
            countEl.hide();
            btn.prop('disabled', false);
        }
    }, 1000);
}

// ─── 4. Verify OTP ────────────────────────────────────────────────────
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

    // Step 1: Verify OTP with MSG91 browser-side
    _browserVerifyOtp(otp, _otpReqId,
        function() { // success from MSG91
            // Step 2: Establish session & user in database
            $.ajax({
                type: 'POST',
                url: '<?= site_url("user-auth/verify-otp") ?>',
                data: { otp: otp, req_id: _otpReqId, browser_verified: 1, mobile: _activeAuthMobile },
                dataType: 'json',
                success: function (r) {
                    if (r.success) {
                        localStorage.setItem('bhandari_user', JSON.stringify({ name: r.user_name, mobile: r.mobile }));
                        
                        var modalEl = document.getElementById('otpLoginModal');
                        var modalInstance = bootstrap.Modal.getInstance(modalEl);
                        if (modalInstance) modalInstance.hide();

                        setLoggedIn({ name: r.user_name, mobile: r.mobile });
                        _otpReqId = '';
                        if (_resendTimer) clearInterval(_resendTimer);

                        var firstName = r.user_name ? r.user_name.split(' ')[0] : 'there';
                        Swal.fire({
                            html:
                                '<div style="text-align:center;padding:8px 0 4px;">'
                                + '<div style="width:64px;height:64px;background:linear-gradient(135deg,#FC5D09,#ff4b2b);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;box-shadow:0 6px 20px rgba(252, 93, 9,0.35);">'
                                + '<i class="bi bi-person-check-fill" style="color:#fff;font-size:28px;"></i>'
                                + '</div>'
                                + '<div style="font-size:1.35rem;font-weight:800;color:#1a1a2e;margin-bottom:6px;">Welcome, ' + firstName + '! &#128075;</div>'
                                + '<div style="font-size:0.88rem;color:#666;line-height:1.6;margin-bottom:14px;">' + r.message + '</div>'
                                + '<div style="display:inline-flex;align-items:center;gap:6px;background:#fff5ed;border:1px solid #f5c0c0;border-radius:6px;padding:6px 14px;font-size:0.8rem;color:#DD3802;font-weight:600;">'
                                + '<i class="bi bi-shield-check"></i> Verified Member (+91 ' + r.mobile + ')'
                                + '</div>'
                                + '</div>',
                            showConfirmButton: false, timer: 2500, timerProgressBar: true,
                            didOpen: function() {
                                var bar = Swal.getPopup().querySelector('.swal2-timer-progress-bar');
                                if (bar) bar.style.background = '#FC5D09';
                            }
                        }).then(function() {
                            if (typeof _postLoginRedirect !== 'undefined' && _postLoginRedirect) {
                                var target = _postLoginRedirect; _postLoginRedirect = null;
                                window.location.href = target; return;
                            }
                            if (typeof _pendingWizardSubmit !== 'undefined' && _pendingWizardSubmit) {
                                _pendingWizardSubmit = false;
                                if (typeof executeWizardSubmission === 'function') executeWizardSubmission();
                            }
                            if (typeof _pendingSubmit !== 'undefined' && _pendingSubmit) {
                                _pendingSubmit = false;
                                if (typeof submitBooking === 'function') submitBooking();
                            }
                        });
                    } else {
                        $('#otpError').show().text(r.message || 'Verification failed.');
                    }
                },
                error: function() {
                    $('#otpError').show().text('Network error. Please try again.');
                },
                complete: function() {
                    btn.prop('disabled', false).text('Validate & Login');
                }
            });
        },
        function(errMsg) {
            btn.prop('disabled', false).text('Validate & Login');
            $('#otpError').show().text(errMsg);
        }
    );
}

// ─── Resend OTP ───────────────────────────────────────────────────────
function resendOtp() {
    var mobile = _activeAuthMobile;
    if (!mobile) { backToAuthForm(); return; }

    $('#otpError').hide();
    _browserSendOtp(mobile,
        function() {
            Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'New OTP sent to +91 ' + mobile, showConfirmButton: false, timer: 3000 });
            clearOtpBoxes();
            startResendCountdown(120);
        },
        function(errMsg) {
            $('#otpError').show().text(errMsg);
        }
    );
}

function clearOtpBoxes() {
    $('.otp-digit').val('').removeClass('filled');
}

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
