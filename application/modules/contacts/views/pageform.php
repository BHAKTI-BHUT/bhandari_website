<?php
$logged_web_user = $this->session->userdata('web_user');
$user_name_val   = ($logged_web_user && !empty($logged_web_user['name'])) ? htmlspecialchars($logged_web_user['name']) : '';
$user_mobile_val = ($logged_web_user && !empty($logged_web_user['mobile'])) ? htmlspecialchars($logged_web_user['mobile']) : (isset($logged_web_user['phone']) ? htmlspecialchars($logged_web_user['phone']) : '');
$user_email_val  = ($logged_web_user && !empty($logged_web_user['email'])) ? htmlspecialchars($logged_web_user['email']) : '';

if ($logged_web_user && empty($user_email_val) && !empty($logged_web_user['id'])) {
    try {
        $admin_db = $this->load->database('admin_hub', TRUE);
        if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('users')) {
            $user_rec = $admin_db->where('id', $logged_web_user['id'])->get('users')->row();
            if ($user_rec && !empty($user_rec->email) && strpos($user_rec->email, '@bhandari.guest') === false) {
                $user_email_val = htmlspecialchars($user_rec->email);
            }
        }
    } catch (\Exception $e) {}
}
?>
<div class="col-md-6 mb-4">
    <h5 class="fw-bold mb-4 text-center">Request a Free Quote Today!</h5>
    <form class="border p-4 rounded shadow-sm bg-light" id="pageform" onsubmit="return false;" novalidate>

    <div class="row mb-2">
        <!-- Name -->
        <div class="col-md-6 mb-3">
            <div class="input-group" id="pg-name-group">
                <span class="input-group-text bg-danger"><i class="bi bi-person-fill text-white"></i></span>
                <input type="text" id="pg-name" name="name" class="form-control" placeholder="Your Name" value="<?= $user_name_val ?>">
            </div>
            <div class="pgf-error d-none" id="pg-name-err">
                <small class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>Please enter your full name.</small>
            </div>
        </div>
        <!-- Phone -->
        <div class="col-md-6 mb-3">
            <div class="input-group" id="pg-phone-group">
                <span class="input-group-text bg-danger"><i class="bi bi-telephone-fill text-white"></i></span>
                <input type="text" id="pg-phone" name="phone" class="form-control" placeholder="Mobile Number" maxlength="10" inputmode="numeric" value="<?= $user_mobile_val ?>">
            </div>
            <div class="pgf-error d-none" id="pg-phone-err">
                <small class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>Please enter a valid 10-digit mobile number.</small>
            </div>
        </div>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <div class="input-group" id="pg-email-group">
            <span class="input-group-text bg-danger"><i class="bi bi-envelope-fill text-white"></i></span>
            <input type="email" id="pg-email" name="email" class="form-control" placeholder="Your Email" value="<?= $user_email_val ?>">
        </div>
        <div class="pgf-error d-none" id="pg-email-err">
            <small class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>Please enter a valid email address.</small>
        </div>
    </div>

    <!-- Message -->
    <div class="mb-3">
        <textarea id="pg-message" name="message" class="form-control" rows="4" placeholder="Write your message (from city, to city, moving date, requirements...)"></textarea>
        <div class="pgf-error d-none" id="pg-message-err">
            <small class="text-danger"><i class="bi bi-exclamation-circle-fill me-1"></i>Please write your message.</small>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <button type="submit" class="btn btn-danger text-white fw-bold px-4" id="pageformbtn">
            Submit <i class="bi bi-send-fill ms-1"></i>
        </button>
        <button type="reset" onclick="pgfClearErrors(); $('#resultpageform').html('');" class="btn btn-outline-dark fw-bold">
            Clear <i class="bi bi-trash-fill ms-1"></i>
        </button>
    </div>

    <div id="resultpageform" class="mt-3"></div>
    </form>
</div>

<style>
  .pgf-invalid .form-control,
  .pgf-invalid textarea {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220,53,69,.15) !important;
  }
  .pgf-valid .form-control,
  .pgf-valid textarea {
    border-color: #198754 !important;
    box-shadow: 0 0 0 0.2rem rgba(25,135,84,.1) !important;
  }
  .pgf-error {
    margin-top: 4px;
  }
</style>

<script type="text/javascript">
  function pgfClearErrors() {
    ['pg-name-group','pg-phone-group','pg-email-group'].forEach(function(id){
      $('#' + id).removeClass('pgf-invalid pgf-valid');
    });
    $('#pg-message').removeClass('border-danger').css('box-shadow','');
    $('.pgf-error').addClass('d-none');
  }

  function pgfSetError(groupId, errId, show) {
    if (show) {
      $('#' + groupId).addClass('pgf-invalid').removeClass('pgf-valid');
      $('#' + errId).removeClass('d-none');
    } else {
      $('#' + groupId).addClass('pgf-valid').removeClass('pgf-invalid');
      $('#' + errId).addClass('d-none');
    }
  }

  function pgfValidate() {
    var valid = true;

    // Name
    var name = $.trim($('#pg-name').val());
    if (name.length < 2) {
      pgfSetError('pg-name-group', 'pg-name-err', true);
      valid = false;
    } else {
      pgfSetError('pg-name-group', 'pg-name-err', false);
    }

    // Phone — must be exactly 10 digits
    var phone = $.trim($('#pg-phone').val());
    if (!/^[6-9]\d{9}$/.test(phone)) {
      pgfSetError('pg-phone-group', 'pg-phone-err', true);
      valid = false;
    } else {
      pgfSetError('pg-phone-group', 'pg-phone-err', false);
    }

    // Email
    var email = $.trim($('#pg-email').val());
    var emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRe.test(email)) {
      pgfSetError('pg-email-group', 'pg-email-err', true);
      valid = false;
    } else {
      pgfSetError('pg-email-group', 'pg-email-err', false);
    }

    // Message
    var msg = $.trim($('#pg-message').val());
    if (msg.length < 5) {
      $('#pg-message').addClass('is-invalid').css({'border-color':'#dc3545','box-shadow':'0 0 0 0.2rem rgba(220,53,69,.15)'});
      $('#pg-message-err').removeClass('d-none');
      valid = false;
    } else {
      $('#pg-message').removeClass('is-invalid').css({'border-color':'#198754','box-shadow':'0 0 0 0.2rem rgba(25,135,84,.1)'});
      $('#pg-message-err').addClass('d-none');
    }

    return valid;
  }

  // Live validation on blur
  $(function () {
    $('#pg-name').on('blur input', function(){
      var v = $.trim($(this).val());
      pgfSetError('pg-name-group', 'pg-name-err', v.length < 2);
    });
    $('#pg-phone').on('blur input', function(){
      // Allow only digits
      this.value = this.value.replace(/\D/g,'');
      var v = $.trim($(this).val());
      pgfSetError('pg-phone-group', 'pg-phone-err', !/^[6-9]\d{9}$/.test(v));
    });
    $('#pg-email').on('blur input', function(){
      var v = $.trim($(this).val());
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      pgfSetError('pg-email-group', 'pg-email-err', !re.test(v));
    });
    $('#pg-message').on('blur input', function(){
      var v = $.trim($(this).val());
      if (v.length < 5) {
        $(this).css({'border-color':'#dc3545','box-shadow':'0 0 0 0.2rem rgba(220,53,69,.15)'});
        $('#pg-message-err').removeClass('d-none');
      } else {
        $(this).css({'border-color':'#198754','box-shadow':'0 0 0 0.2rem rgba(25,135,84,.1)'});
        $('#pg-message-err').addClass('d-none');
      }
    });

    // On Reset clear green/red states
    $('#pageform')[0].addEventListener('reset', function(){
      setTimeout(pgfClearErrors, 10);
      setTimeout(function(){
        $('#pg-message').css({'border-color':'','box-shadow':''});
      }, 10);
    });

    // Submit with validation
    $('#pageformbtn').click(function () {
      if (!pgfValidate()) return;
      var btn = $(this);
      btn.prop('disabled', true).html('Sending... <i class="bi bi-hourglass-split ms-1"></i>');
      $('#resultpageform').html('');
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('contacts/contact') ?>",
        data: $("#pageform").serialize(),
        beforeSend: function () {
          $('#resultpageform').html('<p class="text-center text-muted"><i class="bi bi-clock me-1"></i>Please wait...</p>');
        },
        success: function (data) {
          $('#resultpageform').empty();
          if ($.trim(data) == '1') {
            data = "<div class='alert alert-success'><i class='bi bi-check-circle-fill me-2'></i>Thank you! Your enquiry has been submitted. We'll get back to you shortly.</div>";
            $("#pageform").trigger('reset');
            if (typeof gtag !== 'undefined') {
              gtag('event', 'conversion', {'send_to': 'AW-16643071116/JlJPCPjgvOwZEI3B5cA-'});
            }
          }
          $('#resultpageform').html(data);
          btn.prop('disabled', false).html('Submit <i class="bi bi-send-fill ms-1"></i>');
        },
        error: function () {
          $('#resultpageform').html("<div class='alert alert-danger'><i class='bi bi-x-circle-fill me-2'></i>Something went wrong. Please try again.</div>");
          btn.prop('disabled', false).html('Submit <i class="bi bi-send-fill ms-1"></i>');
        }
      });
    });
  });
</script>