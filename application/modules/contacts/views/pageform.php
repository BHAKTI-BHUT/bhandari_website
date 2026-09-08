<div class="col-md-6 mb-4">
    <h5 class="fw-bold mb-4 text-center">Request a Free Quote Today!</h5>
    <form class="border p-4 rounded shadow-sm bg-light" id="pageform" onsubmit="return false;">
    <div class="row mb-3">
        <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-danger"><i class="bi bi-person-fill text-white"></i></span>
            <input type="text" class="form-control" placeholder="Your Name">
        </div>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
        <div class="input-group">
            <span class="input-group-text bg-danger"><i class="bi bi-telephone-fill text-white"></i></span>
            <input type="text" class="form-control" placeholder="Mobile Number">
        </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="input-group">
        <span class="input-group-text bg-danger"><i class="bi bi-envelope-fill text-white"></i></span>
        <input type="email" class="form-control" placeholder="Your Email">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
        <div class="input-group">
            <span class="input-group-text bg-danger"><i class="bi bi-geo-alt-fill text-white"></i></span>
            <input type="text" class="form-control" placeholder="From">
        </div>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
        <div class="input-group">
            <span class="input-group-text bg-danger"><i class="bi bi-geo-fill text-white"></i></span>
            <input type="text" class="form-control" placeholder="To">
        </div>
        </div>
    </div>
    <div class="mb-3">
        <textarea class="form-control" rows="4" placeholder="Write Your Message"></textarea>
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-danger text-white fw-bold" id="pageformbtn">
        Submit <i class="bi bi-send-fill ms-1"></i>
        </button>
        <button type="reset" onclick="$('#resultpageform').html('');" class="btn btn-outline-dark fw-bold" >
        Clear <i class="bi bi-trash-fill ms-1"></i>
        </button>
    </div>
    <div id="resultpageform"></div>
    </form>
</div>
<script type="text/javascript">
  $(function () {
    $('#pageformbtn').click(function () {
      $.ajax({
        type: "POST",
        url: "<?php echo site_url('contacts/booking') ?>",
        data: $("#pageform").serialize(),
        beforeSend: function () {
          $('#resultpageform').html('<p class="text-center text-muted">Please wait...</p>');
        },
        success: function (data) {
          $('#resultpageform').empty();
          if (data == '1') {
            data = "<div class='alert alert-success'>Thank you! Your quote request has been successfully submitted. We'll respond soon.</div>";
            $("#pageform").trigger('reset');
            gtag('event', 'conversion', {'send_to': 'AW-16643071116/JlJPCPjgvOwZEI3B5cA-'});
          }
          $('#resultpageform').html(data);
        }
      });
    });
  });
</script>