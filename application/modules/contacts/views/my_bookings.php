<!-- Razorpay JS SDK -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<style>
/* ─── Premium Dashboard Styling ──────────────────────────── */
.bookings-section {
    background: #fdfdfd;
    min-height: 70vh;
}
.dashboard-header {
    background: linear-gradient(135deg, #FC5D09, #231616ff);
    color: #fff;
    padding: 30px 0;
    margin-bottom: 40px;
    border-bottom: 4px solid #FC5D09;
}
.user-card {
    background: rgba(255, 255, 255, 0.07);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 20px 25px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 15px;
}
.user-initial {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: #FC5D09;
    color: #fff;
    font-size: 1.5rem;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
}
.booking-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    border: 1px solid #f0f0f0;
    margin-bottom: 30px;
    transition: transform 0.25s, box-shadow 0.25s;
    overflow: hidden;
}
.booking-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(252, 93, 9, 0.08);
}
.card-top {
    background: #fafafa;
    border-bottom: 1px solid #eee;
    padding: 16px 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}
.booking-no {
    font-weight: 800;
    color: #1a1a2e;
    font-size: 1.1rem;
}
.status-badge {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
.status-confirmed { background: #e8f5e9; color: #2e7d32; }
.status-started { background: #e3f2fd; color: #1565c0; }
.status-completed { background: #efebe9; color: #4e342e; }
.status-cancelled { background: #ffebee; color: #c62828; }
.status-pending { background: #fff8e1; color: #f57f17; }

.route-info {
    padding: 24px;
    position: relative;
}
.route-line {
    position: absolute;
    left: 36px;
    top: 40px;
    bottom: 40px;
    width: 2px;
    border-left: 2px dashed #ddd;
}
.location-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 20px;
    position: relative;
    z-index: 2;
}
.location-item:last-child {
    margin-bottom: 0;
}
.loc-icon {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.85rem;
}
.loc-icon.pickup { border: 2px solid #2e7d32; color: #2e7d32; }
.loc-icon.drop { border: 2px solid #FC5D09; color: #FC5D09; }

.loc-details strong {
    font-size: 0.8rem;
    color: #888;
    text-transform: uppercase;
    display: block;
    margin-bottom: 2px;
}
.loc-details p {
    margin: 0;
    font-weight: 600;
    color: #222;
    font-size: 0.95rem;
}

.price-box {
    background: #fafafa;
    border-radius: 12px;
    padding: 20px;
    height: 100%;
    border: 1px solid #f0f0f0;
}
.price-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    font-size: 0.9rem;
    color: #555;
}
.price-row.grand-total {
    border-top: 1px solid #e0e0e0;
    padding-top: 10px;
    margin-top: 10px;
    font-weight: 800;
    color: #1a1a2e;
    font-size: 1.05rem;
}
.pay-btn-box {
    padding: 24px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
}
.pay-now-btn {
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 10px 24px;
    font-weight: 700;
    font-size: 0.95rem;
    box-shadow: 0 4px 15px rgba(252, 93, 9,0.25);
    transition: transform 0.2s, box-shadow 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.pay-now-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(252, 93, 9,0.35);
    color: #fff;
}
.paid-badge {
    background: #e8f5e9;
    color: #2e7d32;
    border: 1px solid #a5d6a7;
    padding: 8px 18px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.btn-download-booking-pdf {
    border: 1.5px solid #FC5D09 !important;
    color: #FC5D09 !important;
    background: #ffffff !important;
    font-weight: 700 !important;
    border-radius: 50px !important;
    padding: 7px 18px !important;
    font-size: 0.85rem !important;
    transition: all 0.25s ease-in-out !important;
    display: inline-flex !important;
    align-items: center !important;
    text-decoration: none !important;
    box-shadow: 0 2px 6px rgba(252, 93, 9, 0.08) !important;
}
.btn-download-booking-pdf i {
    color: #FC5D09 !important;
    transition: color 0.25s ease-in-out !important;
}
.btn-download-booking-pdf:hover {
    background: linear-gradient(135deg, #FC5D09, #DD3802) !important;
    color: #ffffff !important;
    border-color: #DD3802 !important;
    box-shadow: 0 4px 14px rgba(252, 93, 9, 0.3) !important;
    transform: translateY(-1px) !important;
}
.btn-download-booking-pdf:hover i {
    color: #ffffff !important;
}
.pay-btn-box {
    padding: 16px 24px;
    border-top: 1px solid #f0f0f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    background: #ffffff;
}
.pay-btn-left {
    display: flex;
    align-items: center;
}
.pay-btn-right {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-left: auto;
}
@media (max-width: 991px) {
    .pay-btn-box {
        flex-direction: column;
        align-items: stretch;
        gap: 14px;
    }
    .pay-btn-left, .pay-btn-right {
        width: 100%;
        margin-left: 0;
    }
    .pay-btn-right {
        justify-content: flex-start;
    }
}

/* ─── Stepper Timeline ──────────────────────────── */
.stepper-row {
    padding: 24px;
    background: #fafafa;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
}
.stepper {
    display: flex;
    justify-content: space-between;
    position: relative;
    max-width: 900px;
    margin: 0 auto;
}
.stepper-line {
    position: absolute;
    background: #e0e0e0;
    z-index: 1;
}
.stepper-progress {
    position: absolute;
    background: #FC5D09;
    z-index: 2;
    transition: all 0.4s ease;
}

/* Horizontal (Desktop) styling */
@media (min-width: 768px) {
    .stepper {
        flex-direction: row;
    }
    .stepper-line {
        top: 16px;
        left: 50px;
        right: 50px;
        height: 3px;
    }
    .stepper-progress {
        top: 16px;
        left: 50px;
        height: 3px;
        width: var(--progress-width, 0%);
    }
    .step-item {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
    }
    .step-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .step-label {
        margin-top: 10px;
        font-size: 0.68rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        text-align: center;
        white-space: normal;
        max-width: 120px;
        min-height: 34px;
    }
    .step-desc {
        margin-top: 2px;
        font-size: 0.58rem;
        color: #999;
        text-align: center;
        line-height: 1.25;
        display: block;
        max-width: 120px;
    }
}

/* Vertical (Mobile) styling */
@media (max-width: 767px) {
    .stepper {
        flex-direction: column;
        align-items: flex-start;
        gap: 25px;
        padding-left: 15px;
    }
    .stepper-line {
        left: 31px;
        top: 16px;
        bottom: 16px;
        width: 3px;
    }
    .stepper-progress {
        left: 31px;
        top: 16px;
        width: 3px;
        height: var(--progress-width, 0%);
    }
    .step-item {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 15px;
        width: 100%;
        text-align: left;
    }
    .step-info {
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .step-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: #888;
        text-transform: uppercase;
        text-align: left;
    }
    .step-desc {
        margin-top: 2px;
        font-size: 0.68rem;
        color: #999;
        text-align: left;
        line-height: 1.25;
        display: block;
    }
}

.step-dot {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #fff;
    border: 3px solid #e0e0e0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    color: #888;
    font-weight: 700;
    transition: all 0.3s;
    flex-shrink: 0;
}
.step-item.active .step-dot {
    border-color: #FC5D09;
    color: #FC5D09;
    transform: scale(1.1);
}
.step-item.completed .step-dot {
    background: #FC5D09;
    border-color: #FC5D09;
    color: #fff;
}
.step-item.active .step-label { color: #FC5D09; }
.step-item.completed .step-label { color: #1a1a2e; }
.step-item.active .step-desc { color: #d32f2f; }
.step-item.completed .step-desc { color: #555; }

.empty-state {
    padding: 60px 20px;
    text-align: center;
    background: #fff;
    border-radius: 16px;
    border: 1px dashed #ccc;
}
.empty-icon {
    font-size: 4rem;
    color: #FC5D09;
    margin-bottom: 20px;
    animation: bounce 2s infinite;
}
@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}
.item-row-box-edit {
    border: 1px solid #dee2e6;
    border-radius: 8px;
    padding: 8px 12px;
    transition: all 0.2s ease-in-out;
}
.item-row-box-edit:hover {
    border-color: #FC5D09 !important;
    background-color: #fffafa !important;
}
.item-row-box-edit.active-item {
    border-color: #FC5D09 !important;
    background-color: #fff0f0 !important;
}
</style>

<div class="dashboard-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="fw-bold mb-1"> Booking History</h1>
                <p class="text-white-50 mb-0">Track your consignment status and manage payments online.</p>
            </div>
            <div class="col-md-5 mt-3 mt-md-0 d-flex justify-content-md-end">
                <div class="user-card">
                    <div class="user-initial"><?= strtoupper(substr($this->session->userdata('web_user')['name'], 0, 1)) ?></div>
                    <div>
                        <h5 class="mb-0 fw-bold"><?= htmlspecialchars($this->session->userdata('web_user')['name']) ?></h5>
                        <small class="text-white-50"><?= htmlspecialchars($this->session->userdata('web_user')['mobile']) ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="py-2 bookings-section">
    <div class="container">
        <h3 class="fw-bold text-dark mb-4">My Bookings History</h3>
        
        <?php if (empty($bookings)): ?>
            <div class="empty-state">
                <i class="bi bi-box-seam empty-icon"></i>
                <h4 class="fw-bold">No Bookings Found</h4>
                <p class="text-muted mb-4">You have not requested any shifting services yet. Get a dynamic estimate and book now!</p>
                <a href="<?= site_url('online-booking') ?>" class="btn btn-danger btn-lg text-white px-4 py-2" style="background:#FC5D09; border:none; border-radius:8px;">Book Shifting Now</a>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-12">
                    <?php foreach ($bookings as $b): 
                        // Map status labels
                        $tracking = $b->tracking_status;
                        $is_completed = ($tracking === 'completed' || $tracking === 'shifting_completed' || $b->status === 'completed');
                        
                        $status_class = 'status-pending';
                        $status_label = 'Pending Confirmation';
                        if ($b->status === 'cancelled') {
                            $status_class = 'status-cancelled';
                            $status_label = 'Cancelled';
                        } elseif ($tracking === 'confirmed') {
                            $status_class = 'status-confirmed';
                            $status_label = 'Booking Confirmed';
                        } elseif ($tracking === 'trip_started') {
                            $status_class = 'status-started';
                            $status_label = 'Trip Started';
                        } elseif ($tracking === 'pickup_arrived') {
                            $status_class = 'status-started';
                            $status_label = 'Reached at Pickup';
                        } elseif ($tracking === 'shifting_started' || $b->status === 'in_progress') {
                            $status_class = 'status-started';
                            $status_label = 'Shifting Started';
                        } elseif ($tracking === 'pickup_completed') {
                            $status_class = 'status-confirmed';
                            $status_label = 'Pickup Completed';
                        } elseif ($is_completed) {
                            $status_class = 'status-completed';
                            $status_label = 'Shifting Completed';
                        } elseif ($b->status === 'confirmed') {
                            $status_class = 'status-confirmed';
                            $status_label = 'Booking Confirmed';
                        }

                        // Determine stepper state (6 steps)
                        $step_num = 1;
                        if ($b->status === 'cancelled') {
                            $step_num = 0;
                        } elseif ($tracking === 'confirmed') {
                            $step_num = 2;
                        } elseif ($tracking === 'trip_started') {
                            $step_num = 3;
                        } elseif ($tracking === 'pickup_arrived') {
                            $step_num = 3;
                        } elseif ($tracking === 'shifting_started' || $b->status === 'in_progress') {
                            $step_num = 4;
                        } elseif ($tracking === 'pickup_completed') {
                            $step_num = 5;
                        } elseif ($is_completed) {
                            $step_num = 6;
                        } elseif ($b->status === 'confirmed') {
                            $step_num = 2;
                        }

                        $progress_width = (($step_num > 1) ? ($step_num - 1) * 20 : 0) . '%';

                        $s1_class = ($step_num >= 1) ? (($step_num == 1) ? 'active' : 'completed') : '';
                        $s2_class = ($step_num >= 2) ? (($step_num == 2) ? 'active' : 'completed') : '';
                        $s3_class = ($step_num >= 3) ? (($step_num == 3) ? 'active' : 'completed') : '';
                        $s4_class = ($step_num >= 4) ? (($step_num == 4) ? 'active' : 'completed') : '';
                        $s5_class = ($step_num >= 5) ? (($step_num == 5) ? 'active' : 'completed') : '';
                        $s6_class = ($step_num >= 6) ? (($step_num == 6) ? 'active' : 'completed') : '';

                        // Calculation
                        $amount = floatval($b->amount);
                        $discount_pct = floatval(isset($b->discount_percent) ? $b->discount_percent : 0);
                        $discount_amt = floatval(isset($b->discount_amount) ? $b->discount_amount : 0);
                        if ($discount_pct > 0 && $discount_amt <= 0) {
                            $discount_amt = round($amount * ($discount_pct / 100), 2);
                        }
                        $final_total = ($discount_amt > 0) ? round($amount - $discount_amt, 2) : $amount;

                        $reg_fee = floatval(($b->registration_charge > 0) ? $b->registration_charge : (isset($default_reg_fee) ? $default_reg_fee : 500));
                        $is_reg_paid = ($b->registration_payment_status === 'paid');  // Booking/Registration fee paid?
                        $is_remaining_paid = ($b->remaining_payment_status === 'paid');
                        $remaining = $is_remaining_paid ? 0.00 : (floatval($b->remaining_amount) > 0 ? floatval($b->remaining_amount) : max(0, $final_total - $reg_fee));

                        // Public Booking Details / Summary PDF link
                        $admin_base_url = (isset($_SERVER['HTTP_HOST']) && strpos($_SERVER['HTTP_HOST'], 'localhost') !== false)
                            ? 'http://127.0.0.1:8000'
                            : 'https://bhandaripackersandmovers.in/admin';
                        $pdf_url = $admin_base_url . '/public/booking/' . $b->id . '/booking-details';
                    ?>
                        <div class="booking-card">
                            <div class="card-top d-flex flex-wrap align-items-center justify-content-between gap-2">
                                <div class="d-flex flex-wrap align-items-center gap-2">
                                    <span class="booking-no text-dark fw-bold"><?= htmlspecialchars($b->booking_number) ?></span>
                                    <span class="text-muted small"><i class="bi bi-calendar-event me-1"></i><?= date('d M Y', strtotime($b->shifting_date)) ?></span>
                                    <?php if (!$is_reg_paid && $b->status !== 'cancelled'): ?>
                                        <span class="badge px-2.5 py-1.5 fw-bold" style="background: linear-gradient(135deg, #f59e0b, #d97706); color: #ffffff; font-size: 0.76rem; border-radius: 6px;">
                                            <i class="bi bi-pencil-fill me-1"></i> DRAFT — Booking Fee Pending
                                        </span>
                                    <?php elseif ($b->status !== 'cancelled' && ($b->status === 'confirmed' || $b->status === 'in_progress') && !empty($b->pickup_otp)): ?>
                                        <span class="badge px-2.5 py-1.5 fw-bold" style="background: linear-gradient(135deg, #38a169, #2f855a); color: #ffffff; font-size: 0.76rem; border-radius: 6px;">
                                            <i class="bi bi-phone-vibrate-fill me-1"></i> OTP Sent
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex flex-wrap align-items-center gap-2 ms-auto ms-sm-0">
                                    <?php if ($is_reg_paid && $b->status !== 'cancelled'): ?>
                                        <a href="<?= $pdf_url ?>" target="_blank" class="btn-download-booking-pdf py-1 px-3" style="font-size: 0.8rem;">
                                            <i class="bi bi-file-earmark-pdf-fill me-1"></i> Booking PDF
                                        </a>
                                    <?php endif; ?>
                                    <span class="status-badge <?= $status_class ?>"><?= $status_label ?></span>
                                </div>
                            </div>

                            
                            <div class="row g-0 align-items-center">
                                <div class="col-md-7">
                                    <div class="route-info">
                                        <div class="route-line"></div>
                                        <div class="location-item">
                                            <div class="loc-icon pickup">
                                                <i class="bi bi-geo-alt-fill"></i>
                                            </div>
                                            <div class="loc-details">
                                                <strong>Pickup Address</strong>
                                                <p><?= htmlspecialchars($b->pickup_location) ?></p>
                                            </div>
                                        </div>
                                        <div class="location-item">
                                            <div class="loc-icon drop">
                                                <i class="bi bi-pin-map-fill"></i>
                                            </div>
                                            <div class="loc-details">
                                                <strong>Drop Address</strong>
                                                <p><?= htmlspecialchars($b->drop_location) ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-5">
                                    <div class="p-4 h-100">
                                        <div class="price-box">
                                            <h5 class="fw-bold mb-3 text-dark border-bottom pb-2">Payment Details</h5>
                                            <?php if ($discount_amt > 0): ?>
                                                <div class="price-row">
                                                    <span>Base Shifting Amount</span>
                                                    <strong class="text-muted text-decoration-line-through">₹<?= number_format($amount, 2) ?></strong>
                                                </div>
                                                <div class="price-row">
                                                    <span class="text-success"><i class="bi bi-tag-fill me-1"></i>Discount (<?= $discount_pct ?>%)</span>
                                                    <strong class="text-success">- ₹<?= number_format($discount_amt, 2) ?></strong>
                                                </div>
                                                <div class="price-row" style="border-bottom: 1px dashed #cbd5e1; padding-bottom: 6px; margin-bottom: 6px;">
                                                    <span class="fw-semibold">Total Payable Amount</span>
                                                    <strong class="text-primary fs-15">₹<?= number_format($final_total, 2) ?></strong>
                                                </div>
                                            <?php else: ?>
                                                <div class="price-row">
                                                    <span>Base Shifting Amount</span>
                                                    <strong>₹<?= number_format($amount, 2) ?></strong>
                                                </div>
                                            <?php endif; ?>
                                            <div class="price-row">
                                                <?php if ($is_reg_paid): ?>
                                                    <span>Booking Fees Paid</span>
                                                    <strong class="text-success">- ₹<?= number_format($reg_fee, 2) ?></strong>
                                                <?php else: ?>
                                                    <span>Booking Fee</span>
                                                    <strong class="text-warning"><i class="bi bi-clock-history me-1"></i>₹<?= number_format($reg_fee, 2) ?> (Pending)</strong>
                                                <?php endif; ?>
                                            </div>
                                            <div class="price-row grand-total">
                                                <span>Remaining Balance</span>
                                                <?php if (!$is_reg_paid): ?>
                                                    <strong class="text-muted">Pay Booking Fee First</strong>
                                                <?php else: ?>
                                                    <strong class="<?= $is_remaining_paid ? 'text-success' : 'text-danger' ?>">
                                                        ₹<?= number_format($remaining, 2) ?>
                                                        <?= $is_remaining_paid ? ' (Paid)' : '' ?>
                                                    </strong>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if ($b->status !== 'cancelled'): ?>
                             <!-- Stepper Row -->
                             <div class="stepper-row">
                                 <div class="stepper" style="--progress-width: <?= $progress_width ?>;">
                                     <div class="stepper-line"></div>
                                     <div class="stepper-progress"></div>
                                     
                                     <div class="step-item <?= $s1_class ?>">
                                         <div class="step-dot"><?= ($step_num > 1) ? '<i class="bi bi-check-lg"></i>' : '1' ?></div>
                                         <div class="step-info">
                                             <div class="step-label">Confirmation Pending</div>
                                             <small class="step-desc">Awaiting confirmation</small>
                                         </div>
                                     </div>
                                     <div class="step-item <?= $s2_class ?>">
                                         <div class="step-dot"><?= ($step_num > 2) ? '<i class="bi bi-check-lg"></i>' : '2' ?></div>
                                         <div class="step-info">
                                             <div class="step-label">Booking Confirmed</div>
                                             <small class="step-desc">Booking confirmed</small>
                                         </div>
                                     </div>
                                     <div class="step-item <?= $s3_class ?>">
                                         <div class="step-dot"><?= ($step_num > 3) ? '<i class="bi bi-check-lg"></i>' : '3' ?></div>
                                         <div class="step-info">
                                             <div class="step-label"><?= ($tracking === 'pickup_arrived') ? 'Reached Pickup' : 'Trip Started' ?></div>
                                             <small class="step-desc"><?= ($tracking === 'pickup_arrived') ? 'Awaiting OTP verification' : 'Team has departed' ?></small>
                                         </div>
                                     </div>
                                     <div class="step-item <?= $s4_class ?>">
                                         <div class="step-dot"><?= ($step_num > 4) ? '<i class="bi bi-check-lg"></i>' : '4' ?></div>
                                         <div class="step-info">
                                             <div class="step-label">Shifting Started</div>
                                             <small class="step-desc">Packing in progress</small>
                                         </div>
                                     </div>
                                     <div class="step-item <?= $s5_class ?>">
                                         <div class="step-dot"><?= ($step_num > 5) ? '<i class="bi bi-check-lg"></i>' : '5' ?></div>
                                         <div class="step-info">
                                             <div class="step-label">Pickup Completed</div>
                                             <small class="step-desc">Pending remaining payment</small>
                                         </div>
                                     </div>
                                     <div class="step-item <?= $s6_class ?>">
                                         <div class="step-dot"><?= ($step_num > 6) ? '<i class="bi bi-check-lg"></i>' : '6' ?></div>
                                         <div class="step-info">
                                             <div class="step-label">Shifting Completed</div>
                                             <small class="step-desc">Shifting completed</small>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <?php endif; ?>
                            
                             <?php if (isset($b->refund_request) && !empty($b->refund_request)): 
                                 $rf = $b->refund_request;
                                 $rf_status = $rf->status;
                             ?>
                                 <div class="px-4 py-3 border-top bg-light">
                                     <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                         <div>
                                             <strong><i class="bi bi-arrow-counterclockwise text-danger me-1"></i> Refund Request Status:</strong>
                                             <?php if ($rf_status === 'pending'): ?>
                                                 <span class="badge bg-warning text-dark px-2 py-1"><i class="bi bi-hourglass-split"></i> Under Review</span>
                                             <?php elseif ($rf_status === 'approved'): ?>
                                                 <span class="badge bg-info text-white px-2 py-1"><i class="bi bi-check-circle"></i> Approved</span>
                                             <?php elseif ($rf_status === 'refunded'): ?>
                                                 <span class="badge bg-success text-white px-2 py-1"><i class="bi bi-cash-stack"></i> Refunded</span>
                                             <?php elseif ($rf_status === 'rejected'): ?>
                                                 <span class="badge bg-secondary text-white px-2 py-1"><i class="bi bi-x-circle"></i> Rejected</span>
                                             <?php endif; ?>
                                         </div>
                                         <?php if (!empty($rf->refund_amount)): ?>
                                             <div class="fw-bold text-dark fs-14">
                                                 Approved Refund: <span class="text-success">₹<?= number_format($rf->refund_amount, 2) ?></span>
                                             </div>
                                         <?php endif; ?>
                                     </div>
                                     <?php if (!empty($rf->admin_remarks)): ?>
                                         <div class="mt-2 text-secondary small">
                                             <i class="bi bi-chat-left-dots text-primary me-1"></i> <b>Admin Remarks:</b> <?= htmlspecialchars($rf->admin_remarks) ?>
                                         </div>
                                     <?php endif; ?>
                                 </div>
                             <?php endif; ?>

                             <!-- Pay & Cancel Action Box -->
                              <div class="pay-btn-box">
                                  <?php if ($b->status === 'cancelled'): ?>
                                      <span class="text-muted font-italic"><i class="bi bi-x-circle-fill text-danger me-1"></i> Shifting booking was cancelled.</span>

                                  <?php elseif (!$is_reg_paid): ?>
                                      <!-- Reg fee NOT paid yet: show ONLY Pay Booking Fee btn, hide everything else -->
                                      <span class="text-muted small d-none d-md-inline-block me-auto">
                                          <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                                          Complete your booking by paying the <b>Booking Confirmation Fee (₹<?= number_format($reg_fee, 2) ?>)</b>.
                                      </span>
                                      <a href="<?= site_url('online-booking?edit=' . $b->id . '&step=4') ?>"
                                          class="pay-now-btn rounded-pill px-4 text-decoration-none d-inline-flex align-items-center ms-auto"
                                          style="background:linear-gradient(135deg,#f59e0b,#d97706); border-color:#d97706; color:#fff;"
                                      >
                                          <i class="bi bi-credit-card-fill me-1"></i> Pay Booking Fee (₹<?= number_format($reg_fee, 2) ?>)
                                      </a>

                                  <?php else: ?>
                                      <!-- Left: PDF Download button -->
                                      <div class="pay-btn-left">
                                          <a href="<?= $pdf_url ?>?download=1" target="_blank" class="btn-download-booking-pdf">
                                              <i class="bi bi-file-earmark-arrow-down-fill me-1"></i> Download Booking Details (PDF)
                                          </a>
                                      </div>

                                      <!-- Right: Actions Group (Remaining Pay, Edit, Cancel & Request Refund) -->
                                      <div class="pay-btn-right">
                                          <?php if ($is_remaining_paid): ?>
                                              <span class="paid-badge">
                                                  <i class="bi bi-check-circle-fill me-1"></i> Remaining Payment Completed (Paid)
                                              </span>
                                          <?php else: ?>
                                              <?php if ($remaining > 0): ?>
                                                  <span class="text-muted small d-none d-xl-inline-block me-1">
                                                      <i class="bi bi-info-circle text-danger me-1"></i>
                                                      Remaining balance: <b>₹<?= number_format($remaining, 2) ?></b>
                                                  </span>
                                                  <button type="button" class="pay-now-btn rounded-pill px-3 py-2" onclick="initiateRemainingPayment(<?= $b->id ?>, <?= $remaining ?>, '<?= htmlspecialchars($b->booking_number) ?>')">
                                                      <i class="bi bi-credit-card-2-back-fill me-1"></i> Pay Remaining Amount (₹<?= number_format($remaining, 2) ?>)
                                                  </button>
                                              <?php endif; ?>
                                          <?php endif; ?>

                                          <?php if ($b->vendor_acceptance_status !== 'accepted' && $step_num < 3 && $b->status !== 'cancelled'): ?>
                                              <a href="<?= site_url('online-booking?edit=' . $b->id) ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center">
                                                  <i class="bi bi-pencil-square me-1"></i> Edit Booking
                                              </a>
                                          <?php endif; ?>

                                          <!-- Cancel & Request Refund Button -->
                                          <?php if ($b->vendor_acceptance_status !== 'accepted' && (!isset($b->refund_request) || empty($b->refund_request) || $b->refund_request->status === 'rejected')): ?>
                                              <button type="button" class="btn btn-outline-danger btn-sm rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center" onclick="openCancelRefundModal(<?= $b->id ?>, '<?= htmlspecialchars($b->booking_number) ?>', <?= floatval(($b->registration_charge > 0) ? $b->registration_charge : (isset($default_reg_fee) ? $default_reg_fee : 500)) ?>, <?= floatval($remaining) ?>, '<?= $b->remaining_payment_status ?>')">
                                                  <i class="bi bi-x-circle me-1"></i> Cancel &amp; Request Refund
                                              </button>
                                          <?php endif; ?>
                                      </div>
                                  <?php endif; ?>
                              </div>
                         </div>

                     <?php endforeach; ?>
                 </div>
             </div>
         <?php endif; ?>
     </div>
 </section>

<!-- Cancellation & Refund Modal -->
<div class="modal fade" id="cancelRefundModal" tabindex="-1" aria-labelledby="cancelRefundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="cancelRefundModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i> Cancel Booking & Request Refund</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form id="cancelRefundForm">
                    <input type="hidden" name="booking_id" id="modal_booking_id">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Booking Number</label>
                        <input type="text" id="modal_booking_no" class="form-control bg-light" readonly>
                    </div>

                    <input type="hidden" name="payment_type" id="modal_payment_type" value="advance">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Reason for Cancellation <span class="text-danger">*</span></label>
                        <select name="cancellation_reason" id="modal_reason" class="form-select" required>
                            <option value="">-- Select Cancellation Reason --</option>
                            <option value="Plan Changed / Shifting Cancelled">Plan Changed / Shifting Cancelled</option>
                            <option value="Shifting Date Postponed">Shifting Date Postponed</option>
                            <option value="Found Better Alternative / Price">Found Better Alternative / Price</option>
                            <option value="Delay / Service Quality Issue">Delay / Service Quality Issue</option>
                            <option value="Other">Other Reason</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Additional Details / Remarks</label>
                        <textarea name="reason_details" id="modal_reason_details" class="form-control" rows="2" placeholder="Please describe briefly why you are requesting cancellation..."></textarea>
                    </div>

                    <input type="hidden" name="refund_method" value="original_source">

                    <div class="alert alert-warning small mb-0">
                        <i class="bi bi-info-circle me-1"></i> Refund requests are reviewed by our team as per cancellation policies. Approved refunds are credited within 3-5 working days.
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="submitCancelRefundForm()"><i class="bi bi-send-check me-1"></i> Submit Cancellation & Refund</button>
            </div>
        </div>
    </div>
</div>

<script>
// ─── Pay Booking Confirmation Fee (Registration Fee) from My Bookings ──────
function initiateBookingFeePayment(bookingId, amount, bookingNumber) {
    if (!bookingId || !amount) {
        Swal.fire('Error', 'Invalid booking details.', 'error');
        return;
    }

    Swal.fire({
        title: 'Initializing Payment...',
        text: 'Preparing Booking Fee payment for ' + bookingNumber,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    const options = {
        "key": "<?= defined('RAZORPAY_KEY_ID') ? RAZORPAY_KEY_ID : 'rzp_live_TFidvL3276AhNp' ?>",
        "amount": Math.round(amount * 100),
        "currency": "INR",
        "name": "Bhandari Packers and Movers",
        "description": "Booking Confirmation Fee - " + bookingNumber,
        "image": "<?= base_url('assets/images/logo/logo.jpg') ?>",
        "handler": function (response) {
            // Use existing update-registration-payment route
            Swal.fire({ title: 'Verifying...', allowOutsideClick: false, showConfirmButton: false, didOpen: () => { Swal.showLoading(); } });
            $.ajax({
                type: 'POST',
                url: '<?= site_url("contacts/update-registration-payment") ?>',
                data: {
                    booking_id: bookingId,
                    status: 'paid',
                    razorpay_payment_id: response.razorpay_payment_id,
                    razorpay_order_id: response.razorpay_order_id || 'order_' + new Date().getTime()
                },
                dataType: 'json',
                success: function(r) {
                    Swal.close();
                    if (r.success || r.status === true) {
                        Swal.fire({ icon: 'success', title: 'Booking Confirmed!', text: 'Your booking fee has been paid and booking is confirmed.', confirmButtonColor: '#2e7d32' })
                            .then(() => { location.reload(); });
                    } else {
                        Swal.fire({ icon: 'error', title: 'Verification Failed', text: r.message || 'Payment verification failed. Please contact support.', confirmButtonColor: '#FC5D09' });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({ icon: 'error', title: 'Server Error', text: 'Could not verify payment. Please contact support.', confirmButtonColor: '#FC5D09' });
                }
            });
        },
        "prefill": {
            "name": "<?= htmlspecialchars($this->session->userdata('web_user')['name'] ?? '') ?>",
            "contact": "<?= htmlspecialchars($this->session->userdata('web_user')['mobile'] ?? '') ?>"
        },
        "theme": { "color": "#d97706" },
        "modal": { "ondismiss": function() { Swal.fire({ icon: 'info', title: 'Payment Cancelled', text: 'Booking fee payment was not completed.', confirmButtonColor: '#FC5D09' }); } }
    };

    Swal.close();
    const rzp = new Razorpay(options);
    rzp.on('payment.failed', function(response) {
        Swal.fire({ icon: 'error', title: 'Payment Failed', text: response.error.description || 'Booking fee payment failed. Please try again.', confirmButtonColor: '#FC5D09' });
    });
    rzp.open();
}
// ─────────────────────────────────────────────────────────────────────────────

function initiateRemainingPayment(bookingId, amount, bookingNumber) {
    if (!bookingId || !amount) {
        Swal.fire('Error', 'Invalid booking or remaining amount details.', 'error');
        return;
    }

    Swal.fire({
        title: 'Initializing Payment Gateway...',
        text: 'Preparing transaction for Booking ' + bookingNumber,
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    // Configure Razorpay Checkout
    const options = {
        "key": "<?= defined('RAZORPAY_KEY_ID') ? RAZORPAY_KEY_ID : 'rzp_live_TFidvL3276AhNp' ?>",
        "amount": Math.round(amount * 100), // in paise
        "currency": "INR",
        "name": "Bhandari Packers and Movers",
        "description": "Shifting Remaining Payment - Booking " + bookingNumber,
        "image": "<?= base_url('assets/images/logo/logo.jpg') ?>",
        "handler": function (response) {
            // Verify payment on CI backend
            verifyRemainingPaymentBackend(bookingId, response.razorpay_payment_id, response.razorpay_order_id || 'order_' + new Date().getTime());
        },
        "prefill": {
            "name": "<?= htmlspecialchars($this->session->userdata('web_user')['name']) ?>",
            "contact": "<?= htmlspecialchars($this->session->userdata('web_user')['mobile']) ?>"
        },
        "theme": {
            "color": "#FC5D09"
        }
    };

    Swal.close();
    const rzp = new Razorpay(options);
    rzp.on('payment.failed', function (response){
        Swal.fire({
            icon: 'error',
            title: 'Payment Failed',
            text: response.error.description || 'Remaining amount payment failed. Please try again.',
            confirmButtonColor: '#FC5D09'
        });
    });
    rzp.open();
}

function verifyRemainingPaymentBackend(bookingId, paymentId, orderId) {
    Swal.fire({
        title: 'Verifying Payment...',
        text: 'Checking transaction status. Please wait.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/verify-remaining-payment") ?>',
        data: {
            booking_id: bookingId,
            razorpay_payment_id: paymentId,
            razorpay_order_id: orderId
        },
        dataType: 'json',
        success: function (r) {
            Swal.close();
            if (r.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment Confirmed!',
                    text: r.message || 'Your remaining balance payment was verified successfully.',
                    confirmButtonColor: '#2e7d32'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Verification Failed',
                    text: r.message || 'Payment verification failed. Please contact support.',
                    confirmButtonColor: '#FC5D09'
                });
            }
        },
        error: function () {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'Could not complete verification process. Please contact support.',
                confirmButtonColor: '#FC5D09'
            });
        }
    });
}

function openCancelRefundModal(bookingId, bookingNo, advanceAmt, remainingAmt, remainingPaidStatus) {
    $('#modal_booking_id').val(bookingId);
    $('#modal_booking_no').val(bookingNo);
    $('#modal_reason').val('');
    $('#modal_reason_details').val('');

    // Set payment type dynamically based on remaining shifting amount paid status
    if (remainingPaidStatus === 'paid') {
        $('#modal_payment_type').val('full');
    } else {
        $('#modal_payment_type').val('advance');
    }

    const modal = new bootstrap.Modal(document.getElementById('cancelRefundModal'));
    modal.show();
}

function submitCancelRefundForm() {
    const bookingId = $('#modal_booking_id').val();
    const reason = $('#modal_reason').val();

    if (!reason) {
        Swal.fire('Required Field', 'Please select a reason for cancellation.', 'warning');
        return;
    }

    Swal.fire({
        title: 'Submitting Refund Request...',
        text: 'Please wait while we log your cancellation request.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/request-cancellation-refund") ?>',
        data: $('#cancelRefundForm').serialize(),
        dataType: 'json',
        success: function (r) {
            Swal.close();
            if (r.success) {
                $('#cancelRefundModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Request Submitted!',
                    text: r.message || 'Your refund request has been logged successfully.',
                    confirmButtonColor: '#2e7d32'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Submission Failed',
                    text: r.message || 'Could not submit refund request. Please try again.',
                    confirmButtonColor: '#FC5D09'
                });
            }
        },
        error: function () {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'A network error occurred. Please try again later.',
                confirmButtonColor: '#FC5D09'
            });
        }
    });
}

const editingCategories = <?= json_encode($categories) ?>;
let currentBookingId = null;
let fixedDistanceCharges = 0;
let fixedFloorCharges = 0;
let fixedAddonCharges = 0;
let currentBookingDate = null;
let editingItemsMap = {};

function openEditBookingModal(bookingId, bookingNo, itemsQtyMap, distanceCharges, floorCharges, addonCharges, shiftingDate) {
    currentBookingId = bookingId;
    fixedDistanceCharges = parseFloat(distanceCharges) || 0;
    fixedFloorCharges = parseFloat(floorCharges) || 0;
    fixedAddonCharges = parseFloat(addonCharges) || 0;
    currentBookingDate = shiftingDate;
    editingItemsMap = Object.assign({}, itemsQtyMap); // Clone itemsQtyMap

    $('#edit_booking_no_display').text(bookingNo);

    // Reset all display values in the modal
    $('.qty-edit-display').text('0');
    $('.item-row-box-edit').removeClass('active-item');

    // Load quantities from itemsQtyMap into display inputs
    for (let itemId in editingItemsMap) {
        const qty = parseInt(editingItemsMap[itemId]) || 0;
        const display = $('#edit-item-qty-' + itemId);
        if (display.length) {
            display.text(qty);
            if (qty > 0) {
                display.closest('.item-row-box-edit').addClass('active-item');
            }
        }
    }

    // Run recalculation
    recalculateEditEstimate();

    const editModal = new bootstrap.Modal(document.getElementById('editBookingModal'));
    editModal.show();
}

$(document).on('click', '.qty-edit-btn', function() {
    const action = $(this).data('action');
    const itemId = $(this).data('id');
    
    let currentQty = editingItemsMap[itemId] ? parseInt(editingItemsMap[itemId]) : 0;
    
    if (action === 'plus') {
        currentQty++;
    } else if (action === 'minus' && currentQty > 0) {
        currentQty--;
    }
    
    if (currentQty > 0) {
        editingItemsMap[itemId] = currentQty;
        $('#edit-item-qty-' + itemId).text(currentQty);
        $('#edit-item-qty-' + itemId).closest('.item-row-box-edit').addClass('active-item');
    } else {
        delete editingItemsMap[itemId];
        $('#edit-item-qty-' + itemId).text('0');
        $('#edit-item-qty-' + itemId).closest('.item-row-box-edit').removeClass('active-item');
    }
    
    recalculateEditEstimate();
});

function recalculateEditEstimate() {
    let totalScore = 0;

    $('.qty-edit-display').each(function() {
        const qty = parseInt($(this).text()) || 0;
        const weight = parseFloat($(this).siblings('.qty-edit-btn[data-action="plus"]').data('weight')) || 0;
        if (qty > 0) {
            totalScore += (qty * weight);
        }
    });

    $('#editScoreVal').text(parseFloat(totalScore).toFixed(2) + ' pts');

    if (totalScore > 310) {
        $('#editSurveyWarning').removeClass('d-none');
        $('#editTotalAmount').text('Survey Req.');
        $('#editRemainingAmount').text('Survey Req.');
        $('#btnSaveEditedBooking').prop('disabled', true);
        return;
    } else {
        $('#editSurveyWarning').addClass('d-none');
        $('#btnSaveEditedBooking').prop('disabled', false);
    }

    // Match Category
    let category = null;
    for (let i = 0; i < editingCategories.length; i++) {
        let cat = editingCategories[i];
        if (totalScore >= parseFloat(cat.min_score) && totalScore <= parseFloat(cat.max_score)) {
            category = cat;
            break;
        }
    }

    if (!category && editingCategories.length > 0) {
        category = editingCategories[0]; // fallback
    }

    if (!category) return;

    $('#editCategoryText').text(category.category_name);

    // Vehicle Match
    let vehicleName = "Tata Ace";
    if (totalScore > 40) vehicleName = "Bolito Pickup";
    if (totalScore > 120) vehicleName = "Tata 407 (14 Ft)";
    if (totalScore > 210) vehicleName = "Eicher 17 Ft Truck";
    $('#editVehicleText').text(vehicleName);

    let baseFare = parseFloat(category.base_fare) || 0;
    let pricePerPoint = parseFloat(category.price_per_point) || 0;
    let pointBasedFare = 0;

    $('#editBaseFare').text('₹' + baseFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    if (pricePerPoint > 0) {
        pointBasedFare = (totalScore * pricePerPoint);
        $('#editPointFare').text('₹' + pointBasedFare.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
        $('#editPointFareRow').show();
    } else {
        $('#editPointFare').text('₹0.00');
        $('#editPointFareRow').hide();
    }

    // Distance charges
    $('#editDistanceFare').text('₹' + fixedDistanceCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    // Floor charges
    $('#editFloorFare').text('₹' + fixedFloorCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    // Addons charges
    $('#editAddonsFare').text('₹' + fixedAddonCharges.toLocaleString('en-IN', { minimumFractionDigits: 2 }));

    // Surges
    let weekendSurge = 0;
    let monthEndSurge = 0;

    if (currentBookingDate) {
        const dateObj = new Date(currentBookingDate);
        const day = dateObj.getDay();
        if (day === 0 || day === 6) { // Sunday or Saturday
            weekendSurge = (baseFare + pointBasedFare + fixedDistanceCharges) * 0.10;
            $('#editWeekendFare').text('₹' + weekendSurge.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#editWeekendRow').show();
        } else {
            $('#editWeekendRow').hide();
        }

        const dayOfMonth = dateObj.getDate();
        const lastDayOfMonth = new Date(dateObj.getFullYear(), dateObj.getMonth() + 1, 0).getDate();
        if (dayOfMonth >= (lastDayOfMonth - 2) || dayOfMonth <= 2) {
            monthEndSurge = (baseFare + pointBasedFare + fixedDistanceCharges) * 0.15;
            $('#editMonthEndFare').text('₹' + monthEndSurge.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
            $('#editMonthEndRow').show();
        } else {
            $('#editMonthEndRow').hide();
        }
    } else {
        $('#editWeekendRow').hide();
        $('#editMonthEndRow').hide();
    }

    const grandTotal = baseFare + pointBasedFare + fixedDistanceCharges + fixedAddonCharges + fixedFloorCharges + weekendSurge + monthEndSurge;
    $('#editTotalAmount').text('₹' + grandTotal.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
    
    const remainingVal = Math.max(0, grandTotal - (window.currentRegFee || 500));
    $('#editRemainingAmount').text('₹' + remainingVal.toLocaleString('en-IN', { minimumFractionDigits: 2 }));
}

function submitEditedBookingItems() {
    if (!currentBookingId) return;

    Swal.fire({
        title: 'Updating Booking Items...',
        text: 'Please wait while we recalculate and update your booking.',
        allowOutsideClick: false,
        showConfirmButton: false,
        didOpen: () => { Swal.showLoading(); }
    });

    $.ajax({
        type: 'POST',
        url: '<?= site_url("contacts/save-edited-booking-items") ?>',
        data: {
            booking_id: currentBookingId,
            items_json: JSON.stringify(editingItemsMap)
        },
        dataType: 'json',
        success: function(r) {
            Swal.close();
            if (r.success) {
                $('#editBookingModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Booking Updated!',
                    text: r.message,
                    confirmButtonColor: '#2e7d32'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: r.message,
                    confirmButtonColor: '#FC5D09'
                });
            }
        },
        error: function() {
            Swal.close();
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'A network error occurred. Please try again.',
                confirmButtonColor: '#FC5D09'
            });
        }
    });
}
</script>

<!-- Edit Booking Items Modal -->
<div class="modal fade" id="editBookingModal" tabindex="-1" aria-labelledby="editBookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header bg-dark text-white p-3" style="border-top-left-radius: 16px; border-top-right-radius: 16px; border-bottom: 3px solid #FC5D09;">
                <h5 class="modal-title fw-bold" id="editBookingModalLabel"><i class="bi bi-pencil-square text-danger me-2"></i>Edit Booking Items (<span id="edit_booking_no_display"></span>)</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-light">
                <div class="row g-4">
                    <!-- Left: Item Selector Accordion -->
                    <div class="col-lg-7">
                        <h6 class="fw-bold mb-3 text-dark"><i class="bi bi-box-seam-fill text-danger me-2"></i>Select / Update Shifting Items</h6>
                        <div class="accordion" id="editItemsAccordion">
                            <?php foreach ($item_sizes as $size): ?>
                            <div class="accordion-item border-0 mb-3 shadow-sm" style="border-radius: 8px; overflow: hidden;">
                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold text-dark bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#editCollapseSize-<?= $size->id ?>" aria-expanded="true">
                                        <i class="bi bi-tag-fill text-danger me-2"></i><?= htmlspecialchars($size->size_name) ?> Items
                                    </button>
                                </h2>
                                <div id="editCollapseSize-<?= $size->id ?>" class="accordion-collapse collapse show" data-bs-parent="#editItemsAccordion">
                                    <div class="accordion-body bg-white border-top p-3">
                                        <div class="row g-2">
                                            <?php foreach ($size->items as $item): ?>
                                            <?php $scoreVal = isset($item->score_point) ? floatval($item->score_point) : floatval($size->volume_score); ?>
                                            <div class="col-12">
                                                <div class="p-2 border d-flex justify-content-between align-items-center rounded bg-light item-row-box-edit" style="transition: border-color 0.2s;">
                                                    <span class="text-dark small fw-semibold">
                                                        <?= htmlspecialchars($item->item_name) ?>
                                                    </span>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <button type="button" class="btn btn-sm btn-outline-secondary py-0 px-2 qty-edit-btn" data-action="minus" data-id="<?= $item->id ?>" data-weight="<?= $scoreVal ?>">-</button>
                                                        <span class="fw-bold text-dark qty-edit-display" id="edit-item-qty-<?= $item->id ?>" style="min-width: 24px; text-align: center;">0</span>
                                                        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 qty-edit-btn" data-action="plus" data-id="<?= $item->id ?>" data-weight="<?= $scoreVal ?>">+</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <!-- Right: Cost Recalculation Summary Panel -->
                    <div class="col-lg-5">
                        <div class="card border-0 shadow-sm sticky-top" style="border-radius: 12px; border-top: 4px solid #FC5D09; top: 0;">
                            <div class="card-body p-3">
                                <h6 class="fw-bold text-dark mb-3"><i class="bi bi-calculator-fill text-danger me-2"></i>Recalculated Invoice</h6>
                                
                                <div class="p-2 mb-3 bg-light rounded border">
                                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                                        <span class="text-muted fw-semibold">New Shifting Load:</span>
                                        <span class="fw-bold text-danger" id="editScoreVal">0.00 pts</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-1 small">
                                        <span class="text-muted fw-semibold">Category:</span>
                                        <span class="fw-bold text-dark" id="editCategoryText">Micro Shifting</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center small">
                                        <span class="text-muted fw-semibold">Vehicle:</span>
                                        <span class="fw-bold text-primary" id="editVehicleText">Tata Ace</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between py-2 border-bottom border-light small">
                                    <span class="text-muted">Base Fare</span>
                                    <span class="fw-semibold text-dark" id="editBaseFare">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-light small" id="editPointFareRow">
                                    <span class="text-muted">Volume Charge</span>
                                    <span class="fw-semibold text-dark" id="editPointFare">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-light small">
                                    <span class="text-muted">Distance Charges (Fixed)</span>
                                    <span class="fw-semibold text-muted" id="editDistanceFare">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-light small">
                                    <span class="text-muted">Floor Surcharges (Fixed)</span>
                                    <span class="fw-semibold text-muted" id="editFloorFare">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-light small">
                                    <span class="text-muted">Add-on Services (Fixed)</span>
                                    <span class="fw-semibold text-muted" id="editAddonsFare">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-light text-warning small" id="editWeekendRow" style="display:none;">
                                    <span>Weekend Surge (10%)</span>
                                    <span class="fw-semibold" id="editWeekendFare">₹0.00</span>
                                </div>
                                <div class="d-flex justify-content-between py-2 border-bottom border-light text-danger small" id="editMonthEndRow" style="display:none;">
                                    <span>Month-End Surge (15%)</span>
                                    <span class="fw-semibold" id="editMonthEndFare">₹0.00</span>
                                </div>

                                <div class="alert alert-danger p-2 border-0 mb-3 mt-3 d-none" id="editSurveyWarning" style="border-radius: 8px; font-size: 0.78rem;">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                    Score exceeds limit. Survey Required!
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <span class="fw-bold text-dark small">New Shifting Total</span>
                                    <span class="fw-bold text-danger fs-6" id="editTotalAmount">₹0.00</span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center pt-1 text-success small">
                                    <span>Advance Paid</span>
                                    <span class="fw-bold" id="editAdvancePaidDisplay">-₹<?= number_format(isset($default_reg_fee) ? $default_reg_fee : 500, 2) ?></span>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center pt-1 border-top mt-2">
                                    <span class="fw-bold text-dark small">Remaining Balance</span>
                                    <span class="fw-bold text-danger fs-5" id="editRemainingAmount">₹0.00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light" style="border-bottom-left-radius: 16px; border-bottom-right-radius: 16px;">
                <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger rounded-pill px-4" id="btnSaveEditedBooking" onclick="submitEditedBookingItems()"><i class="bi bi-check-circle-fill me-2"></i>Save Changes</button>
            </div>
        </div>
    </div>
</div>

