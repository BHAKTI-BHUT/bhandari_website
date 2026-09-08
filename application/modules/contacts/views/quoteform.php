<?php 
    $logged_web_user = $this->session->userdata('web_user');
    $user_name_val = ($logged_web_user && !empty($logged_web_user['name'])) ? htmlspecialchars($logged_web_user['name']) : '';
    $user_mobile_val = ($logged_web_user && !empty($logged_web_user['mobile'])) ? htmlspecialchars($logged_web_user['mobile']) : '';
?>
<div class="contact-form">
    <div class="contact-form-header">
        <div class="row">
            <div class="col-12">
                <h5><small style="font-weight:400;font-size:13px;">Request a Free Quote Today!</small> <a href="<?= $phonehtml ?>" style='color:white;float:right;'><i class="far fa-phone-volume"></i> <?= $phone ?></a></h5>
            </div>
        </div>
    </div>
    <form method="post" id="quoteform" onsubmit="return false">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-icon">
                        <i class="far fa-user-tie"></i>
                        <input type="text" class="form-control" name="name" value="<?= $user_name_val ?>" placeholder="Your Name" >
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-icon">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?= $user_mobile_val ?>" placeholder="Mobile Number">
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <div class="form-icon">
                    <i class="fa-solid fa-envelope"></i>
                        <input type="text" class="form-control" name="email" placeholder="Your Email">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="form-icon">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" class="form-control" name="mfrom" placeholder="From">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <div class="form-icon">
                        <i class="fa-solid fa-thumbtack"></i>
                        <input type="text" class="form-control" name="mto" placeholder="To">
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="form-icon">
                <i class="far fa-comment-lines"></i>
                <textarea name="message" cols="30" rows="5" class="form-control"
                    placeholder="Write Your Message" ></textarea>
            </div>
        </div>
            <div id="resultquotefrom"></div>
        <button id="submitbquoteform" type="submit" class="theme-btn" style="background-color:#FBA707;">Submit <i class="far fa-paper-plane"></i></button>
        <button onclick="$('#resultquotefrom').html('');"  type="reset" class="theme-btn" style="background-color:white;color:#A0A0A0;">Clear <i class="far fa-trash-alt"></i></button>
    </form>
</div>
<script type="text/javascript">
    $(function() {
        $('#submitbquoteform').click(function() {
            const qData = {
                mfrom: $('#quoteform input[name="mfrom"]').val(),
                mto: $('#quoteform input[name="mto"]').val(),
                phone: $('#quoteform input[name="phone"]').val(),
                name: $('#quoteform input[name="name"]').val(),
                email: $('#quoteform input[name="email"]').val()
            };
            localStorage.setItem('bhandari_quote_data', JSON.stringify(qData));
            try {
                var bDraft = JSON.parse(localStorage.getItem('bhandari_booking_draft') || '{}');
                if (qData.mfrom) bDraft.pickup_location = qData.mfrom;
                if (qData.mto) bDraft.drop_location = qData.mto;
                if (qData.phone) bDraft.phone_number = qData.phone;
                delete bDraft.distance_km;
                localStorage.setItem('bhandari_booking_draft', JSON.stringify(bDraft));
            } catch(e) {}

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('contacts/booking') ?>",
                data: $("#quoteform").serialize(),
                beforeSend: function() {
                    messages('warning','Please wait','Submitting...',1500);
                },
                success: function(data) {
                    if (data == '1') {
                        messages('success','Success','Thank you! Your quote request was submitted. We\'ll respond soon.',3000);
                        $("#quoteform").trigger('reset');
                        gtag('event', 'conversion', {'send_to': 'AW-16643071116/JlJPCPjgvOwZEI3B5cA-'});
                    } else {
                        messages('danger','Error',data,4000);
                    }
                }
            });
        });
    });
</script>