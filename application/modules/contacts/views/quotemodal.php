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
      <form method="post" id="quotemodal" onsubmit="return false;">
        <div class="modal-body bg-light p-4">
          <div class="row g-3">

            <!-- Full Name -->
            <div class="col-md-6 col-12">
              <label for="modal_name" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-user me-1"></i> Full Name <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control shadow-sm" name="name" id="modal_name" value="<?= $user_name_val ?>" placeholder="Enter your full name" required>
            </div>

            <!-- Phone Number -->
            <div class="col-md-6 col-12">
              <label for="modal_phone" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-phone me-1"></i> Phone Number <span class="text-danger">*</span>
              </label>
              <input type="tel" class="form-control shadow-sm" name="phone" id="modal_phone" value="<?= $user_mobile_val ?>" placeholder="10-digit mobile number" maxlength="10" required>
            </div>
  
            <!-- Pick up Location -->
            <div class="col-md-6 col-12">
              <label for="modal_mfrom" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-location-dot me-1"></i> Pick up Location <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control shadow-sm" name="mfrom" id="modal_mfrom" placeholder="Moving from..." required>
            </div>

            <!-- Drop Location -->
            <div class="col-md-6 col-12">
              <label for="modal_mto" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-thumbtack me-1"></i> Drop Location <span class="text-danger">*</span>
              </label>
              <input type="text" class="form-control shadow-sm" name="mto" id="modal_mto" placeholder="Moving to..." required>
            </div>

            <!-- Shifting Date -->
            <div class="col-md-6 col-6">
              <label for="modal_date" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-calendar-days me-1"></i> Shifting Date <span class="text-danger">*</span>
              </label>
              <input type="date" class="form-control shadow-sm" name="date" id="modal_date" min="<?= $today_date ?>" value="<?= $today_date ?>" required>
            </div>

            <!-- Shifting Time -->
            <div class="col-md-6 col-6">
              <label for="modal_shifting_time" class="form-label text-danger fw-semibold small">
                <i class="fa-solid fa-clock me-1"></i> Shifting Time <span class="text-danger">*</span>
              </label>
              <?php
                $time_options_12h = array(
                    "06:00 AM", "06:30 AM", "07:00 AM", "07:30 AM", "08:00 AM", "08:30 AM",
                    "09:00 AM", "09:30 AM", "10:00 AM", "10:30 AM", "11:00 AM", "11:30 AM",
                    "12:00 PM", "12:30 PM", "01:00 PM", "01:30 PM", "02:00 PM", "02:30 PM",
                    "03:00 PM", "03:30 PM", "04:00 PM", "04:30 PM", "05:00 PM", "05:30 PM",
                    "06:00 PM", "06:30 PM", "07:00 PM", "07:30 PM", "08:00 PM", "08:30 PM",
                    "09:00 PM", "09:30 PM", "10:00 PM", "10:30 PM", "11:00 PM", "11:30 PM",
                    "12:00 AM", "12:30 AM", "01:00 AM", "01:30 AM", "02:00 AM", "02:30 AM",
                    "03:00 AM", "03:30 AM", "04:00 AM", "04:30 AM", "05:00 AM", "05:30 AM"
                );
              ?>
              <select class="form-select shadow-sm" name="shifting_time" id="modal_shifting_time" required>
                <option value="" selected>Select Time Slot (12-Hour)</option>
                <?php foreach ($time_options_12h as $t_opt): ?>
                  <option value="<?= $t_opt ?>"><?= $t_opt ?></option>
                <?php endforeach; ?>
              </select>
              <div class="form-text text-muted small"><i class="bi bi-info-circle me-1"></i>Min. 2 hours advance booking</div>
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
          <button type="reset" class="btn btn-outline-secondary px-4" onclick="$('#resultquotemodal').html('');">
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
  function parseModalTimeToMinutes(timeStr) {
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

  function formatModalMinutesTo12Hour(totalMin) {
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
      var m = totalMin % 60;
      var period = h >= 12 ? 'PM' : 'AM';
      var h12 = h % 12; if (h12 === 0) h12 = 12;
      return String(h12).padStart(2,'0') + ':' + String(m).padStart(2,'0') + ' ' + period;
    }
  }

  function getLocalTodayDateStrModal() {
    var d = new Date();
    var y = d.getFullYear();
    var m = String(d.getMonth() + 1).padStart(2, '0');
    var day = String(d.getDate()).padStart(2, '0');
    return y + '-' + m + '-' + day;
  }

  function applyModalMinTime() {
    var dateVal = $('#modal_date').val();
    var timeSelect = document.getElementById('modal_shifting_time');
    if (!timeSelect) return;

    var todayStr = getLocalTodayDateStrModal();
    var isToday = (!dateVal || dateVal === todayStr);

    var now = new Date();
    var minAllowedMin = isToday ? (now.getHours() * 60 + now.getMinutes() + 120) : 0;

    var options = timeSelect.options;
    for (var i = 0; i < options.length; i++) {
      var opt = options[i];
      if (!opt.value) continue;
      var optMin = parseModalTimeToMinutes(opt.value);
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

  $(function () {
    applyModalMinTime();
    $('#modal_date').on('change', applyModalMinTime);
    setInterval(applyModalMinTime, 60000);

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
      var dateVal = $('#modal_date').val();
      var timeVal = $('#modal_shifting_time').val();
      var mfromVal = $('#modal_mfrom').val() ? $('#modal_mfrom').val().trim() : '';
      var todayStr = getLocalTodayDateStrModal();

      if (mfromVal && !isAllowedModalPickup(mfromVal)) {
        var noticeCities = window.allowedPickupCitiesStr || 'Delhi, Noida, Greater Noida, Gurugram, Ghaziabad, Faridabad';
        if (typeof showSleekNoticeModal === 'function') {
          showSleekNoticeModal(
            'Pickup Service Unavailable',
            'Currently, our pickup relocation services operate exclusively from <b>' + noticeCities + '</b>.<br><br>We do not offer pickup services from your selected location.',
            'Change Pickup Location',
            'location'
          );
        } else {
          $('#resultquotemodal').html("<div class='alert alert-danger border-0 shadow-sm'>Pickup service is currently available only from " + noticeCities + ".</div>");
        }
        $('#modal_mfrom').focus();
        return false;
      }

      if (!dateVal) {
        $('#resultquotemodal').html("<div class='alert alert-warning border-0 shadow-sm'>Please select shifting date.</div>");
        return false;
      }
      if (!timeVal) {
        $('#resultquotemodal').html("<div class='alert alert-warning border-0 shadow-sm'>Please select shifting time (minimum 2 hours advance booking).</div>");
        return false;
      }

      if (dateVal === todayStr) {
        var selMin = parseModalTimeToMinutes(timeVal);
        var now = new Date();
        var nowMin = now.getHours() * 60 + now.getMinutes();
        var minAllowedMin = nowMin + 120;

        if (selMin >= 0 && selMin < minAllowedMin) {
          var currentStr = formatModalMinutesTo12Hour(nowMin);
          var earliestStr = minAllowedMin >= 1440 
            ? 'No time slots left today. Please select tomorrow\'s date.' 
            : formatModalMinutesTo12Hour(minAllowedMin);

          if (typeof showSleekNoticeModal === 'function') {
            showSleekNoticeModal(
              'Advance Booking (2 Hrs Minimum)',
              'Orders must be scheduled at least <b>2 hours</b> in advance.<br><br>' +
              '• Current Time: <b>' + currentStr + '</b><br>' +
              '• Earliest Allowed Today: <b>' + earliestStr + '</b>',
              'Select Valid Time',
              'time'
            );
          } else {
            $('#resultquotemodal').html("<div class='alert alert-warning border-0 shadow-sm'>Minimum 2 hours advance booking required. Please select a time slot after " + earliestStr + ".</div>");
          }
          return false;
        }
      }

      const qData = {
        name: $('#modal_name').val(),
        phone: $('#modal_phone').val(),
        mfrom: $('#modal_mfrom').val(),
        mto: $('#modal_mto').val(),
        date: $('#modal_date').val(),
        shifting_time: $('#modal_shifting_time').val()
      };
      localStorage.setItem('bhandari_quote_data', JSON.stringify(qData));
      try {
        var bDraft = JSON.parse(localStorage.getItem('bhandari_booking_draft') || '{}');
        if (qData.mfrom) bDraft.pickup_location = qData.mfrom;
        if (qData.mto) bDraft.drop_location = qData.mto;
        if (qData.date) bDraft.shifting_date = qData.date;
        if (qData.shifting_time) bDraft.shifting_time = qData.shifting_time;
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
          if (data == '1') {
            $('#resultquotemodal').html("<div class='alert alert-success border-0 shadow-sm'><i class='fa-solid fa-check-circle me-1'></i> Thank you! Your quote request has been submitted to Admin. Redirecting to Online Booking...</div>");
            $("#quotemodal").trigger('reset');
            setTimeout(function() {
                window.location.href = "<?php echo site_url('online-booking') ?>";
            }, 1200);
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
