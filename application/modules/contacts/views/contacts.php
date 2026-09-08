<?php
$web_user = $this->session->userdata('web_user');
$user_name = isset($web_user['name']) ? $web_user['name'] : '';
$user_phone = isset($web_user['mobile']) ? $web_user['mobile'] : (isset($web_user['phone']) ? $web_user['phone'] : '');
$user_email = isset($web_user['email']) ? $web_user['email'] : '';

if ($web_user && empty($user_email) && !empty($web_user['id'])) {
    try {
        $admin_db = $this->load->database('admin_hub', TRUE);
        if ($admin_db) {
            $user_rec = $admin_db->where('id', $web_user['id'])->get('users')->row();
            if ($user_rec && !empty($user_rec->email)) {
                $user_email = $user_rec->email;
            }
        }
    } catch (\Exception $e) {}
}
?>
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center">Contact Us</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
          Connect with us
        </li>
      </ol>
    </nav>
  </div>
</section>
<div class="content py-3">
    <div class="container">
        <div class="row align-items-center row-gap-4">
            <div class="col-xl-7 col-lg-7">
                <div class="mb-4 mb-lg-0">
                    <div class="row">
                        <div class="col-md-8">
                            <h2 class="mb-3"><span class="dark-red">Reach Out</span> to Our Dedicated Support Team<span class="dark-red">.</span></h2>
                        </div>
                    </div>
                    <div class="mb-4">
                        <span class="mb-2">Our team is ready to help. Your satisfaction is our priority</span>
                        <p>Let's plan your perfect move together. Contact us for a free quote and discover why thousands of customers trust us for their relocation needs.</p>
                    </div>
                    <div class="border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-envelope fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Email Address</p>
                                <span class="text-black fs-16"><a class="text-decoration-none dark-red" href="<?=$mailhtml?>"><?=$mail?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-phone fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Phone Number</p>
                                <span class="text-black fs-16"><a class="text-decoration-none dark-red" href="<?=$phonehtml?>"><?=$phone?></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="border-bottom mb-4">
                        <div class="d-flex align-items-center mb-4">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-clock fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Business Hours</p>
                                <span class="text-black fs-16"><?= !empty($businessHours) ? $businessHours : 'Mon-Sat: 9AM - 6PM' ?></span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-lg rounded-3 bg-danger px-3 py-2 text-black me-2"><i class="fas fa-location-dot fs-24 text-white"></i></span>
                            <div>
                                <p class="fs-14 bold mb-0">Our Address</p>
                                <span class="text-black fs-16"><address class="mb-0"><?=$address?></address></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-5">
                <div class="card bg-gray shadow-none mb-0">
                    <div class="card-body p-3">
                        <div class="mb-3">
                            <h2 class="mb-1 fw-bold">Get in Touch</h2>
                            <p class="text-black fs-16 mb-1">How we can help you? Please write down your query</p>
                        </div>
                        <form method="post" id="getintouchform" onsubmit="return false" class="row flex-column">
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Full Name</b> <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="<?= htmlspecialchars($user_name) ?>" placeholder="Full Name" class="form-control">
                            </div>
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Email</b> <span class="text-danger">*</span></label>
                                <input type="email" name="email" value="<?= htmlspecialchars($user_email) ?>" placeholder="Email Address" class="form-control">
                            </div>
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Phone</b> <span class="text-danger">*</span></label>
                                <input type="tel" name="phone" value="<?= htmlspecialchars($user_phone) ?>" placeholder="Phone Number" class="form-control">
                            </div>      
                            <div class="col-12 form_box mb-3">
                                <label class="form-label"><b>Message</b> <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="message" placeholder="Your Message" rows="3"></textarea>
                            </div>
                            <div class="col-12 form_box">
                                <div class="d-flex my-3">
                                    <button type="button" id="submitcontactbtn" class="btn btn-danger text-white">
                                        Send Message &nbsp;<i class="fa-solid fa-paper-plane"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12" id="resulttouch"></div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
    $(function () {
        $('#submitcontactbtn').click(function () {
            var name = $.trim($('#getintouchform input[name="name"]').val());
            var email = $.trim($('#getintouchform input[name="email"]').val());
            var phone = $.trim($('#getintouchform input[name="phone"]').val());
            var message = $.trim($('#getintouchform textarea[name="message"]').val());

            var emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            var phoneRegex = /^[6-9]\d{9}$/;

            $('#getintouchform input, #getintouchform textarea').removeClass('is-invalid');
            $('#resulttouch').empty();

            if (name === "") {
                $('#getintouchform input[name="name"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter your full name.</div>');
                return false;
            }

            if (email === "" || !emailRegex.test(email)) {
                $('#getintouchform input[name="email"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter a valid email address.</div>');
                return false;
            }

            if (phone === "" || !phoneRegex.test(phone)) {
                $('#getintouchform input[name="phone"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter a valid 10-digit phone number.</div>');
                return false;
            }

            if (message === "") {
                $('#getintouchform textarea[name="message"]').addClass('is-invalid').focus();
                $('#resulttouch').html('<div class="alert alert-danger mb-0">Please enter your message.</div>');
                return false;
            }

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('contacts/contact'); ?>",
                data: $("#getintouchform").serialize(),
                beforeSend: function () {
                    $('#submitcontactbtn').prop('disabled', true).html('Sending... <i class="fa-solid fa-spinner fa-spin"></i>');
                    $('#resulttouch').html('<p style="color: #FC5D09" class="mb-0">Please wait...</p>');
                },
                success: function (data) {
                    $('#submitcontactbtn').prop('disabled', false).html('Send Message &nbsp;<i class="fa-solid fa-paper-plane"></i>');
                    $('#resulttouch').empty();
                    
                    if ($.trim(data) == '1') {
                        $('#getintouchform textarea[name="message"]').val('');
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Your message has been submitted successfully. We will contact you soon.',
                                icon: 'success',
                                confirmButtonColor: '#FC5D09',
                                confirmButtonText: 'OK'
                            });
                        } else {
                            alert('Your message has been submitted successfully. We will contact you soon.');
                        }
                    } else {
                        $('#resulttouch').html(data);
                        setTimeout(function () {
                            $('#resulttouch').fadeOut('slow', function () {
                                $(this).empty().show();
                            });
                        }, 5000);
                    }
                },
                error: function () {
                    $('#submitcontactbtn').prop('disabled', false).html('Send Message &nbsp;<i class="fa-solid fa-paper-plane"></i>');
                    $('#resulttouch').html('<div class="alert alert-danger mb-0">Something went wrong. Please try again.</div>');
                }
            });
        });
    });
</script>