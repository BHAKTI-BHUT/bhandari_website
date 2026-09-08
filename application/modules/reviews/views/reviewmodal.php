<!-- Review Modal -->
<div class="modal fade" id="rvwmdl" tabindex="-1" role="dialog" aria-labelledby="rvwmdlLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px;">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 12px; overflow: hidden; border-top: 4px solid #FC5D09;">
            <div class="modal-header bg-white py-2 px-3 border-bottom border-light">
                <div>
                    <h6 class="modal-title fw-bold text-dark mb-0" id="rvwmdlLabel">
                        <i class="bi bi-chat-heart-fill text-danger me-2"></i>Share Your Feedback
                    </h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="$('#result').html('');" style="font-size: 0.8rem;"></button>
            </div>
            
            <form method="post" id="reviewsform" onsubmit="return false">
                <div class="modal-body p-3 bg-light bg-opacity-40">
                    <div class="row g-2">
                        <!-- Rating and Review Title in one row -->
                        <div class="col-md-5 col-12">
                            <label class="form-label fw-bold text-dark small mb-1"><i class="bi bi-star-fill text-warning me-1"></i>Rate Us <span class="text-danger">*</span></label>
                            <div class="rating-container bg-white border p-1 text-center" style="border-radius: 6px; height: 38px; display: flex; align-items: center; justify-content: center;">
                                <div class="rating-stars-row">
                                    <input type="radio" name="stars" value="5" id="rating-5" class="stars-input"><label for="rating-5" class="stars-label" title="Excellent"></label>
                                    <input type="radio" name="stars" value="4" id="rating-4" class="stars-input"><label for="rating-4" class="stars-label" title="Very Good"></label>
                                    <input type="radio" name="stars" value="3" id="rating-3" class="stars-input"><label for="rating-3" class="stars-label" title="Average"></label>
                                    <input type="radio" name="stars" value="2" id="rating-2" class="stars-input"><label for="rating-2" class="stars-label" title="Below Average"></label>
                                    <input type="radio" name="stars" value="1" id="rating-1" class="stars-input"><label for="rating-1" class="stars-label" title="Poor"></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <label class="form-label fw-bold text-dark small mb-1">Review Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control modern-input" name="title" placeholder="Highly Professional!" style="height: 38px;" required>
                        </div>

                        <!-- Name and Email in one row -->
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-bold text-dark small mb-1">Full Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control modern-input" id="name" name="name" placeholder="John Doe" style="height: 38px;" required>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label fw-bold text-dark small mb-1">Email Address <span class="text-danger">*</span></label>
                            <input type="email" class="form-control modern-input" name="email" placeholder="john@example.com" style="height: 38px;" required>
                        </div>

                        <!-- Experience (Textarea) -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">Write Your Experience <span class="text-danger">*</span></label>
                            <textarea class="form-control modern-input" name="desc" rows="2" placeholder="Tell us about the shifting service..." required></textarea>
                        </div>

                        <!-- Image File Upload (Small inline style) -->
                        <div class="col-12">
                            <label class="form-label fw-bold text-dark small mb-1">Add Shifting Photo <small class="text-muted">(Optional)</small></label>
                            <div class="file-upload-wrapper border border-dashed d-flex align-items-center justify-content-between px-3 py-2 bg-white" style="border-radius: 8px; cursor: pointer; height: 42px;" onclick="document.getElementById('image').click()">
                                <span class="small text-muted" id="file-label"><i class="bi bi-camera-fill text-danger me-2"></i>Upload Photo</span>
                                <span class="badge bg-danger-subtle text-danger small">Browse</span>
                                <input type="file" name="img" class="d-none" id="image" onchange="document.getElementById('file-label').innerHTML = '<i class=\'bi bi-file-earmark-check-fill text-success me-2\'></i>' + (this.files[0] ? this.files[0].name : 'Upload Photo')">
                            </div>
                        </div>
                    </div>
                    
                    <div id="result" class="mt-2 mb-0"></div>
                </div>

                <div class="modal-footer bg-white border-top-0 d-flex justify-content-between py-2 px-3">
                    <button onclick="$('#result').html('');" type="reset" class="btn btn-link text-decoration-none text-muted fw-bold p-0" style="font-size: 0.85rem;">
                        <i class="bi bi-trash me-1"></i>Clear
                    </button>
                    <button id="submitbtn" type="submit" class="btn text-white px-4 py-2 fw-bold" style="background: linear-gradient(135deg, #FC5D09 60%, #ff4b2b 100%); border-radius: 8px; font-size: 0.9rem; box-shadow: 0 4px 10px rgba(252, 93, 9,0.2);">
                        Submit Review <i class="bi bi-send-fill ms-1"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function() {
    $('#submitbtn').click(function(event) {
        event.preventDefault();

        // Simple validation
        let isValid = true;
        $('#reviewsform [required]').each(function() {
            if (!$(this).val().trim()) {
                $(this).addClass('is-invalid');
                isValid = false;
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (!$('input[name="stars"]:checked').val()) {
            $('#result').html("<div class='alert alert-danger p-2 small'><i class='bi bi-exclamation-triangle-fill me-1'></i>Please select a rating star to submit.</div>");
            return;
        }

        if (!isValid) {
            $('#result').html("<div class='alert alert-danger p-2 small'><i class='bi bi-exclamation-triangle-fill me-1'></i>Please fill in all required fields.</div>");
            return;
        }

        var formData = new FormData($('#reviewsform')[0]);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('reviews/review') ?>",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#result').html('<div class="d-flex align-items-center gap-2 text-danger small"><span class="spinner-border spinner-border-sm" role="status"></span> Submitting your review...</div>');
            },
            success: function(data) {
                $('#result').empty();
                if (data.err === 0) {
                    $('#result').html("<div class='alert alert-success p-2 small'><i class='bi bi-check-circle-fill me-1'></i>Success! Thank you for your review!</div>");
                    $("#reviewsform").trigger('reset');
                    document.getElementById('file-label').innerText = 'Click to upload photos of shifting';
                    setTimeout(() => {
                        $('#rvwmdl').modal('hide');
                        window.location.reload();
                    }, 1500);
                } else {
                    $('#result').html("<div class='alert alert-danger p-2 small'><i class='bi bi-exclamation-octagon-fill me-1'></i>" + data.msg + "</div>");
                }
            },
            error: function(xhr, status, error) {
                $('#result').html('<div class="alert alert-danger p-2 small">An error occurred while posting your review. Please try again.</div>');
            }
        });
    });
});
</script>

<style>
/* Modern Star Selector styling */
.rating-stars-row {
    display: inline-flex;
    flex-direction: row-reverse;
    justify-content: center;
}
.stars-input {
    display: none;
}
.stars-label {
    cursor: pointer;
    width: 38px;
    height: 38px;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23e3e3e3' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 80%;
    transition: transform 0.15s, background-image 0.15s;
}
.stars-label:hover,
.stars-label:hover ~ .stars-label,
.stars-input:checked ~ .stars-label {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' width='126.729' height='126.73'%3e%3cpath fill='%23fcd93a' d='M121.215 44.212l-34.899-3.3c-2.2-.2-4.101-1.6-5-3.7l-12.5-30.3c-2-5-9.101-5-11.101 0l-12.4 30.3c-.8 2.1-2.8 3.5-5 3.7l-34.9 3.3c-5.2.5-7.3 7-3.4 10.5l26.3 23.1c1.7 1.5 2.4 3.7 1.9 5.9l-7.9 32.399c-1.2 5.101 4.3 9.3 8.9 6.601l29.1-17.101c1.9-1.1 4.2-1.1 6.1 0l29.101 17.101c4.6 2.699 10.1-1.4 8.899-6.601l-7.8-32.399c-.5-2.2.2-4.4 1.9-5.9l26.3-23.1c3.8-3.5 1.6-10-3.6-10.5z'/%3e%3c/svg%3e");
}
.stars-label:hover {
    transform: scale(1.15);
}

.modern-input {
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    padding: 10px 12px;
    font-size: 0.9rem;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.modern-input:focus {
    border-color: #FC5D09;
    box-shadow: 0 0 0 3px rgba(252, 93, 9, 0.12);
}
.file-upload-wrapper:hover {
    border-color: #FC5D09 !important;
    background-color: #fffafb !important;
}
</style>