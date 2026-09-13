<?php 
    $logged_web_user = $this->session->userdata('web_user');
    $user_name_val   = ($logged_web_user && !empty($logged_web_user['name'])) ? htmlspecialchars($logged_web_user['name']) : '';
    $user_mobile_val = ($logged_web_user && !empty($logged_web_user['mobile'])) ? htmlspecialchars($logged_web_user['mobile']) : '';
    $today_date      = date('Y-m-d');
?>
<div class="modal fade" id="qteModal" tabindex="-1" aria-labelledby="qteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-3 overflow-hidden w-100">
      <div class="modal-header bg-danger text-white">
        <span class="modal-title fw-bold fs-6">
          <i class="fa-solid fa-clipboard-list me-2"></i> Request Site Visit  
        </span>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="quotemodal" onsubmit="return false;" novalidate>
        <div class="modal-body bg-light p-4">
          <div class="row g-3">

            <!-- Full Name -->
            <div class="col-md-6 col-12">
              <label for="modal_name" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-user me-1"></i> Full Name <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control shadow-sm" name="name" id="modal_name" value="<?= $user_name_val ?>" placeholder="Enter your full name">
            </div>

            <!-- Phone Number -->
            <div class="col-md-6 col-12">
              <label for="modal_phone" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-phone me-1"></i> Phone Number <span class="text-danger">*</span>
              </label>
              <input type="tel" class="form-control shadow-sm" name="phone" id="modal_phone" value="<?= $user_mobile_val ?>" placeholder="10-digit mobile number" maxlength="10">
            </div>
  
            <!-- Pick up Location -->
            <div class="col-md-6 col-12">
              <label for="modal_mfrom" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-location-dot me-1"></i> Pick up Location <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control shadow-sm" name="mfrom" id="modal_mfrom" placeholder="Moving from...">
            </div>

            <!-- Drop Location -->
            <div class="col-md-6 col-12">
              <label for="modal_mto" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-thumbtack me-1"></i> Drop Location <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control shadow-sm" name="mto" id="modal_mto" placeholder="Moving to...">
            </div>

            <!-- Shifting Date -->
            <div class="col-md-6 col-12">
              <label for="modal_date" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-calendar-days me-1"></i> Shifting Date <span class="text-danger">*</span>
              </label>
              <input type="date" class="form-control shadow-sm" name="date" id="modal_date" min="<?= $today_date ?>" value="<?= $today_date ?>">
            </div>

            <!-- Message (Optional) -->
            <!-- <div class="col-12">
              <label for="modal_message" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-comment me-1"></i> Message / Specific Requirements (Optional)
              </label>
              <textarea name="message" id="modal_message" class="form-control shadow-sm" rows="2" placeholder="Write any specific shifting requirements..."></textarea>
            </div> -->

          </div>
          <div id="resultquotemodal" class="mt-3"></div>
        </div>
        <div class="modal-footer d-flex justify-content-between bg-white px-4 py-3">
          <button type="reset" class="btn btn-outline-secondary px-4" onclick="$('#resultquotemodal').html(''); $('#quotemodal .form-control').removeClass('is-invalid');">
            <i class="fa-solid fa-rotate-left me-1"></i> Clear
          </button>
          <button type="submit" id="submitbquotemodal" class="btn btn-danger px-4 fw-bold">
            <i class="fa-solid fa-paper-plane me-1"></i> Request Site Visit 
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  function getLocalTodayDateStrModal() {
    var d = new Date();
    var y = d.getFullYear();
    var m = String(d.getMonth() + 1).padStart(2, '0');
    var day = String(d.getDate()).padStart(2, '0');
    return y + '-' + m + '-' + day;
  }

  $(function () {
    $('#quotemodal .form-control').on('input change', function () {
      $(this).removeClass('is-invalid');
    });

    function isAllowedModalPickup(addressStr) {
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

    $('#submitbquotemodal').click(function (e) {
      $('#quotemodal .form-control').removeClass('is-invalid');
      $('#resultquotemodal').empty();

      var nameVal  = $.trim($('#modal_name').val());
      var phoneVal = $.trim($('#modal_phone').val());
      var mfromVal = $.trim($('#modal_mfrom').val());
      var mtoVal   = $.trim($('#modal_mto').val());
      var dateVal  = $.trim($('#modal_date').val());

      var phoneRegex = /^[6-9]\d{9}$/;

      if (nameVal === "") {
        $('#modal_name').addClass('is-invalid').focus();
        $('#resultquotemodal').html("<div class='alert alert-danger mb-0'>Please enter your full name.</div>");
        return false;
      }

      if (phoneVal === "" || !phoneRegex.test(phoneVal)) {
        $('#modal_phone').addClass('is-invalid').focus();
        $('#resultquotemodal').html("<div class='alert alert-danger mb-0'>Please enter a valid 10-digit phone number.</div>");
        return false;
      }

      if (mfromVal === "") {
        $('#modal_mfrom').addClass('is-invalid').focus();
        $('#resultquotemodal').html("<div class='alert alert-danger mb-0'>Please enter pickup location.</div>");
        return false;
      }

      if (!isAllowedModalPickup(mfromVal)) {
        var noticeCities = window.allowedPickupCitiesStr || 'Delhi, Noida, Greater Noida, Gurugram, Ghaziabad, Faridabad';
        $('#modal_mfrom').addClass('is-invalid').focus();
        if (typeof showSleekNoticeModal === 'function') {
          showSleekNoticeModal(
            'Pickup Service Unavailable',
            'Currently, our pickup relocation services operate exclusively from <b>' + noticeCities + '</b>.<br><br>We do not offer pickup services from your selected location.',
            'Change Pickup Location',
            'location'
          );
        } else {
          $('#resultquotemodal').html("<div class='alert alert-danger mb-0'>Pickup service is currently available only from " + noticeCities + ".</div>");
        }
        return false;
      }

      if (mtoVal === "") {
        $('#modal_mto').addClass('is-invalid').focus();
        $('#resultquotemodal').html("<div class='alert alert-danger mb-0'>Please enter drop location.</div>");
        return false;
      }

      if (dateVal === "") {
        $('#modal_date').addClass('is-invalid').focus();
        $('#resultquotemodal').html("<div class='alert alert-danger mb-0'>Please select shifting date.</div>");
        return false;
      }

      const qData = {
        name: nameVal,
        phone: phoneVal,
        mfrom: mfromVal,
        mto: mtoVal,
        date: dateVal
      };
      localStorage.setItem('bhandari_quote_data', JSON.stringify(qData));
      try {
        var bDraft = JSON.parse(localStorage.getItem('bhandari_booking_draft') || '{}');
        if (qData.mfrom) bDraft.pickup_location = qData.mfrom;
        if (qData.mto) bDraft.drop_location = qData.mto;
        if (qData.date) bDraft.shifting_date = qData.date;
        if (qData.phone) bDraft.phone_number = qData.phone;
        delete bDraft.distance_km;
        localStorage.setItem('bhandari_booking_draft', JSON.stringify(bDraft));
      } catch(e) {}

      $.ajax({
        type: "POST",
        url: "<?php echo site_url('contacts/booking') ?>",
        data: $("#quotemodal").serialize(),
        beforeSend: function () {
          $('#resultquotemodal').html('<p class="text-center text-muted"><i class="fa-solid fa-spinner fa-spin me-1"></i> Submitting quote request...</p>');
        },
        success: function (data) {
          $('#resultquotemodal').empty();
          var res = $.trim(data);
          if (res == '1') {
            $('#resultquotemodal').html("<div class='alert alert-success border-0 shadow-sm'><i class='fa-solid fa-check-circle me-1'></i> Thank you! Your site visit request has been submitted successfully. Our team will contact you shortly.</div>");
            $("#quotemodal").trigger('reset');
          } else {
            $('#resultquotemodal').html(data);
          }
        },
        error: function () {
          $('#resultquotemodal').html("<div class='alert alert-danger border-0 shadow-sm'>Something went wrong. Please try again.</div>");
        }
      });
    });
  });
</script>
