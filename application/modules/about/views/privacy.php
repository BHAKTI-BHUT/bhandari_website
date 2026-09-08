<style>
/* ===== Privacy Policy Page ===== */
.pv-hero {
    padding: 60px 0 40px;
    position: relative;
    overflow: hidden;
}
.pv-card {
    background: #fff;
    border-radius: 16px;
    border: 1px solid #edf2f7;
    box-shadow: 0 4px 24px rgba(0,0,0,0.05);
    padding: 32px 36px;
    margin-bottom: 20px;
    transition: box-shadow 0.2s;
    scroll-margin-top: 90px;
}
.pv-card:hover { box-shadow: 0 8px 32px rgba(252, 93, 9,0.08); }
.pv-section-num {
    display: inline-flex; align-items: center; justify-content: center;
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #FC5D09, #ff4b2b);
    color: #fff; font-weight: 800; font-size: 0.9rem;
    border-radius: 8px;
    flex-shrink: 0;
}
.pv-section-title {
    font-size: 1.1rem; font-weight: 700; color: #112d62; margin: 0;
}
.pv-section-body {
    font-size: 0.92rem; color: #4a5568; line-height: 1.8; margin: 0;
}
.pv-section-body ul { margin: 10px 0 0; padding-left: 20px; }
.pv-section-body ul li { margin-bottom: 6px; }
.pv-section-body a { color: #FC5D09; font-weight: 600; text-decoration: none; }
.pv-section-body a:hover { text-decoration: underline; }
.pv-contact-box {
    background: linear-gradient(135deg, #fff8f8, #fff);
    border: 1.5px solid #f0d0d0;
    border-radius: 14px;
    padding: 24px 28px;
}
.pv-contact-box .contact-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.9rem; color: #4a5568; margin-bottom: 10px;
}
.pv-contact-box .contact-item:last-child { margin-bottom: 0; }
.pv-contact-box .contact-item i { color: #FC5D09; font-size: 1rem; width: 20px; }
.pv-contact-box .contact-item a { color: #112d62; font-weight: 600; text-decoration: none; }
.pv-contact-box .contact-item a:hover { color: #FC5D09; }
.pv-sidebar-card {
    background: #fff;
    border-radius: 14px;
    border: 1px solid #edf2f7;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
    padding: 20px;
    position: sticky;
    top: 80px;
    max-height: calc(100vh - 100px);
    overflow-y: auto;
}
.pv-sidebar-card h6 {
    font-size: 0.82rem; font-weight: 700; color: #718096;
    text-transform: uppercase; letter-spacing: 0.5px;
    margin-bottom: 14px;
}
.pv-toc-link {
    display: flex; align-items: center; gap: 8px;
    padding: 6px 10px;
    border-radius: 8px;
    font-size: 0.82rem; color: #4a5568;
    text-decoration: none;
    transition: all 0.15s;
    margin-bottom: 2px;
}
.pv-toc-link:hover { background: #fff5ed; color: #FC5D09; }
.pv-toc-link.active { background: #fff5ed; color: #FC5D09; font-weight: 700; }
.pv-toc-link.active i { color: #FC5D09; }
.pv-toc-link i { font-size: 0.7rem; color: #FC5D09; }
.pv-updated {
    display: inline-flex; align-items: center; gap: 6px;
    background: #f0fff4; border: 1px solid #c6f6d5;
    border-radius: 8px; padding: 6px 14px;
    font-size: 0.8rem; color: #276749;
}
@media (max-width: 768px) {
    .pv-card { padding: 20px 16px; }
    .pv-sidebar-card { position: static; max-height: none; margin-bottom: 24px; }
}
</style>

<!-- Hero Section -->
<section class="py-5 text-white breadcrumb-section pv-hero">
    <div class="container d-flex flex-column align-items-center justify-content-center text-center">
        <h1 class="mt-2 fw-bold">Privacy Policy</h1>
        <p class="mb-2" style="font-size:0.95rem;opacity:0.85;">Effective Date: 10 August 2026</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active text-white" aria-current="page">Privacy Policy</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Main Content -->
<main class="container py-5">
    <div class="row g-4">

        <!-- Sidebar TOC -->
        <div class="col-lg-3 order-lg-2">
            <div class="pv-sidebar-card">
                <h6><i class="bi bi-list-ul me-1"></i> Quick Navigation</h6>
                <a href="#about"           class="pv-toc-link"><i class="bi bi-chevron-right"></i>1. About Policy</a>
                <a href="#info-collect"    class="pv-toc-link"><i class="bi bi-chevron-right"></i>2. Info We Collect</a>
                <a href="#info-voluntary"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>3. Voluntary Info</a>
                <a href="#technical-info"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>4. Technical Data</a>
                <a href="#location-info"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>5. Location Info</a>
                <a href="#how-we-use"      class="pv-toc-link"><i class="bi bi-chevron-right"></i>6. How We Use Info</a>
                <a href="#quote-pricing"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>7. Pricing Info</a>
                <a href="#payment-info"    class="pv-toc-link"><i class="bi bi-chevron-right"></i>8. Payment Info</a>
                <a href="#communications"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>9. Communications</a>
                <a href="#call-recording"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>10. Call Records</a>
                <a href="#photos-media"    class="pv-toc-link"><i class="bi bi-chevron-right"></i>11. Photos & Media</a>
                <a href="#goods-info"      class="pv-toc-link"><i class="bi bi-chevron-right"></i>12. Goods Info</a>
                <a href="#other-persons"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>13. Other Persons</a>
                <a href="#cookies"         class="pv-toc-link"><i class="bi bi-chevron-right"></i>14. Cookies & SDKs</a>
                <a href="#third-parties"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>15. Third Parties</a>
                <a href="#vendors-partners" class="pv-toc-link"><i class="bi bi-chevron-right"></i>16. Vendors & Partners</a>
                <a href="#disclosure"      class="pv-toc-link"><i class="bi bi-chevron-right"></i>17. Disclosure</a>
                <a href="#legal-govt"      class="pv-toc-link"><i class="bi bi-chevron-right"></i>18. Legal Disclosures</a>
                <a href="#biz-transfers"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>19. Business Transfers</a>
                <a href="#data-security"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>20. Data Security</a>
                <a href="#account-security" class="pv-toc-link"><i class="bi bi-chevron-right"></i>21. Account Security</a>
                <a href="#data-retention"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>22. Data Retention</a>
                <a href="#data-accuracy"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>23. Data Accuracy</a>
                <a href="#children"        class="pv-toc-link"><i class="bi bi-chevron-right"></i>24. Children's Data</a>
                <a href="#third-websites"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>25. External Links</a>
                <a href="#marketing"       class="pv-toc-link"><i class="bi bi-chevron-right"></i>26. Marketing</a>
                <a href="#analytics"       class="pv-toc-link"><i class="bi bi-chevron-right"></i>27. Analytics</a>
                <a href="#fraud-security"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>28. Fraud Prevention</a>
                <a href="#reviews-feedback" class="pv-toc-link"><i class="bi bi-chevron-right"></i>29. Reviews & Feedback</a>
                <a href="#data-breaches"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>30. Data Breaches</a>
                <a href="#privacy-rights"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>31. Your Rights</a>
                <a href="#consent-withdraw" class="pv-toc-link"><i class="bi bi-chevron-right"></i>32. Consent Withdrawal</a>
                <a href="#deletion-requests" class="pv-toc-link"><i class="bi bi-chevron-right"></i>33. Data Deletion</a>
                <a href="#grievance"       class="pv-toc-link"><i class="bi bi-chevron-right"></i>34. Grievance Redressal</a>
                <a href="#policy-changes"  class="pv-toc-link"><i class="bi bi-chevron-right"></i>35. Policy Changes</a>
                <a href="#governing-law"   class="pv-toc-link"><i class="bi bi-chevron-right"></i>36. Governing Law</a>
                <a href="#severability"    class="pv-toc-link"><i class="bi bi-chevron-right"></i>37. Severability</a>
                <a href="#contact"         class="pv-toc-link"><i class="bi bi-chevron-right"></i>38. Contact Us</a>
                <a href="#acknowledgement" class="pv-toc-link"><i class="bi bi-chevron-right"></i>39. Acknowledgement</a>

                <hr class="my-3">
                <!-- <div class="pv-updated">
                    <i class="bi bi-calendar3"></i> Effective: 10 August 2026
                </div> -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9 order-lg-1">

            <!-- Intro Box -->
            <div class="pv-card mb-4" style="background:linear-gradient(135deg,#fff8f8,#fff);border-color:#f0d0d0;">
                <p class="pv-section-body mb-2">
                    <strong style="color:#112d62;">Bhandari Packers and Movers</strong> ("Bhandari Packers and Movers", "Company", "we", "our", or "us") respects the privacy of individuals who visit our website, use our mobile application, contact us, request quotations, make bookings, or use our packing, moving, transportation, relocation, storage, and related services.
                </p>
                <p class="pv-section-body mb-2">
                    This Privacy Policy explains how we collect, use, process, store, disclose, protect, and otherwise handle personal information in connection with our business operations.
                </p>
                <p class="pv-section-body mb-0">
                    By accessing our Website, using our Mobile Application, submitting information, requesting a quotation, communicating with us, making a booking, making a payment, or using our Services, you acknowledge that you have read and understood this Privacy Policy and consent to the collection and processing of your personal information in accordance with applicable law. This Privacy Policy should be read together with our <a href="<?= site_url('term-and-condition') ?>">Terms & Conditions</a>, Cancellation & Refund Policy, and other applicable policies.
                </p>
            </div>

            <!-- Section 1 -->
            <div class="pv-card" id="about" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">1</span>
                    <h2 class="pv-section-title">About This Privacy Policy</h2>
                </div>
                <p class="pv-section-body mb-2">This Privacy Policy applies to information collected through:</p>
                <ul class="pv-section-body">
                    <li>Our official website</li>
                    <li>Our mobile application</li>
                    <li>Online quotation and booking forms</li>
                    <li>Customer support channels</li>
                    <li>WhatsApp communications</li>
                    <li>Phone calls, SMS, and Email</li>
                    <li>Online payment systems</li>
                    <li>Digital forms and Surveys</li>
                    <li>Service-related communications & customer interactions with representatives</li>
                    <li>Other digital or offline channels used by Bhandari Packers and Movers</li>
                </ul>
                <p class="pv-section-body mt-2">
                    This policy applies to customers, prospective customers, website visitors, application users, and other individuals who interact with our services.
                </p>
            </div>

            <!-- Section 2 -->
            <div class="pv-card" id="info-collect" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">2</span>
                    <h2 class="pv-section-title">Information We Collect</h2>
                </div>
                <p class="pv-section-body fw-bold mb-2">2.1 Personal Information</p>
                <p class="pv-section-body mb-2">We may collect personal information such as:</p>
                <ul class="pv-section-body mb-3">
                    <li>Full name, mobile number, and email address</li>
                    <li>Pickup address and delivery address</li>
                    <li>Alternate contact details and communication preferences</li>
                    <li>Customer identification details where required</li>
                    <li>Other information voluntarily provided by the Customer</li>
                </ul>
                <p class="pv-section-body fw-bold mb-2">2.2 Booking and Relocation Information</p>
                <p class="pv-section-body mb-2">To provide relocation services, we may collect information including:</p>
                <ul class="pv-section-body">
                    <li>Pickup and delivery location details</li>
                    <li>Moving date, property type, floor level, and lift availability</li>
                    <li>Parking and access information</li>
                    <li>Estimated quantity and type of goods</li>
                    <li>Packing, dismantling, reassembly, and special handling requirements</li>
                    <li>Carrying distance and vehicle requirements</li>
                    <li>Customer instructions and other necessary planning information</li>
                </ul>
            </div>

            <!-- Section 3 -->
            <div class="pv-card" id="info-voluntary" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">3</span>
                    <h2 class="pv-section-title">Information Provided Voluntarily By You</h2>
                </div>
                <p class="pv-section-body mb-2">We collect information that you voluntarily provide when you:</p>
                <ul class="pv-section-body">
                    <li>Request a quotation or submit a booking form</li>
                    <li>Contact customer support or communicate via WhatsApp, call, or email</li>
                    <li>Submit a complaint or claim</li>
                    <li>Provide feedback, reviews, or participate in surveys</li>
                    <li>Upload photographs or documents</li>
                    <li>Make payments or communicate with our employees, representatives, vendors, or service partners</li>
                </ul>
                <p class="pv-section-body mt-2">
                    You are responsible for ensuring that the information you provide is accurate and that you have the necessary authority to provide information relating to another individual or property.
                </p>
            </div>

            <!-- Section 4 -->
            <div class="pv-card" id="technical-info" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">4</span>
                    <h2 class="pv-section-title">Device and Technical Information</h2>
                </div>
                <p class="pv-section-body mb-2">When you access our Website or Mobile Application, technical information may be automatically collected, including:</p>
                <ul class="pv-section-body">
                    <li>IP address, browser type, device type, and operating system</li>
                    <li>Application version and device identifiers</li>
                    <li>Approximate location information and language preferences</li>
                    <li>Date and time of access, pages or screens visited, referring website</li>
                    <li>Technical logs, error/diagnostic info, usage and interaction information</li>
                </ul>
                <p class="pv-section-body mt-2">
                    This information is used for security, analytics, troubleshooting, performance improvement, fraud prevention, and service optimisation.
                </p>
            </div>

            <!-- Section 5 -->
            <div class="pv-card" id="location-info" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">5</span>
                    <h2 class="pv-section-title">Location Information</h2>
                </div>
                <p class="pv-section-body mb-2">Where necessary for providing relocation or transportation services, we process location data including:</p>
                <ul class="pv-section-body">
                    <li>Pickup and delivery locations provided by the Customer</li>
                    <li>Vehicle or driver location during service, where applicable</li>
                    <li>GPS or route information associated with Company vehicles/operations</li>
                </ul>
                <p class="pv-section-body mt-2 mb-2">Location information is used for route planning, service coordination, vehicle tracking, delivery updates, customer support, safety, and operational monitoring.</p>
            </div>

            <!-- Section 6 -->
            <div class="pv-card" id="how-we-use" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">6</span>
                    <h2 class="pv-section-title">How We Use Your Information</h2>
                </div>
                <p class="pv-section-body mb-2">We use personal information for legitimate business purposes including:</p>
                <ul class="pv-section-body">
                    <li><strong>Service Delivery:</strong> Processing bookings, providing quotations, planning relocation, coordinating packing/moving, arranging vehicles/manpower, customer support.</li>
                    <li><strong>Communication:</strong> Booking confirmations, payment notifications, service updates, OTP verification, reminders, responding to queries.</li>
                    <li><strong>Payments & Billing:</strong> Processing payments, generating invoices, maintaining financial records, refund processing, fraud prevention.</li>
                    <li><strong>Business Operations:</strong> Workforce planning, vehicle allocation, route planning, vendor coordination, service quality monitoring.</li>
                    <li><strong>Safety & Security:</strong> Preventing fraud, detecting misuse, protecting customers and assets, investigating suspicious activity.</li>
                    <li><strong>Legal Purposes:</strong> Complying with applicable laws, responding to court orders/government requests, defending legal claims.</li>
                </ul>
            </div>

            <!-- Section 7 -->
            <div class="pv-card" id="quote-pricing" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">7</span>
                    <h2 class="pv-section-title">Quotation and Pricing Information</h2>
                </div>
                <p class="pv-section-body">
                    Information submitted by the Customer (locations, property type, floor, lift, quantity of items, distance, packing needs) is used to calculate preliminary service charges. The Company retains quotation and booking information for operational, accounting, customer support, dispute resolution, and legal compliance purposes.
                </p>
            </div>

            <!-- Section 8 -->
            <div class="pv-card" id="payment-info" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">8</span>
                    <h2 class="pv-section-title">Payment Information</h2>
                </div>
                <p class="pv-section-body mb-2">Payments are processed through authorised payment gateways, banks, or financial institutions. The Company receives details such as transaction references, payment status, date, amount, and payment method.</p>
                <p class="pv-section-body text-danger fw-semibold">
                    Note: The Company does NOT store complete card numbers, CVVs, UPI PINs, or banking passwords. Customers should never share OTPs, passwords, or PINs with anyone.
                </p>
            </div>

            <!-- Section 9 -->
            <div class="pv-card" id="communications" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">9</span>
                    <h2 class="pv-section-title">WhatsApp, SMS, Email and Telephone Communication</h2>
                </div>
                <p class="pv-section-body">
                    We use WhatsApp, SMS, email, and phone calls for essential service-related communications including booking confirmations, quotations, payment receipts, pickup/delivery updates, support, and invoices.
                </p>
            </div>

            <!-- Section 10 -->
            <div class="pv-card" id="call-recording" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">10</span>
                    <h2 class="pv-section-title">Call Recording and Communication Records</h2>
                </div>
                <p class="pv-section-body">
                    Where permissible under applicable law, customer calls and communications may be recorded or retained for quality assurance, staff training, customer support, fraud prevention, service verification, and dispute resolution.
                </p>
            </div>

            <!-- Section 11 -->
            <div class="pv-card" id="photos-media" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">11</span>
                    <h2 class="pv-section-title">Photographs, Videos and Service Documentation</h2>
                </div>
                <p class="pv-section-body">
                    During service execution, photographs or videos may be collected for inventory records, condition/damage assessment, packing documentation, delivery verification, safety, quality control, and dispute resolution.
                </p>
            </div>

            <!-- Section 12 -->
            <div class="pv-card" id="goods-info" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">12</span>
                    <h2 class="pv-section-title">Information About Goods</h2>
                </div>
                <p class="pv-section-body">
                    Details provided regarding household goods, furniture, appliances, or belongings are processed solely to plan packing, vehicle sizing, labour allocation, inventory management, handling, and claim processing.
                </p>
            </div>

            <!-- Section 13 -->
            <div class="pv-card" id="other-persons" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">13</span>
                    <h2 class="pv-section-title">Information About Other Persons</h2>
                </div>
                <p class="pv-section-body">
                    If you provide personal information of family members, landlords, managers, or representatives, you confirm that you have the lawful authority to do so. The Customer remains responsible for the accuracy of provided information.
                </p>
            </div>

            <!-- Section 14 -->
            <div class="pv-card" id="cookies" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">14</span>
                    <h2 class="pv-section-title">Cookies and Similar Technologies</h2>
                </div>
                <p class="pv-section-body">
                    Our platform uses cookies, local storage, and analytics tools to maintain site functionality, remember user preferences, measure marketing performance, detect fraud, and improve user experience.
                </p>
            </div>

            <!-- Section 15 -->
            <div class="pv-card" id="third-parties" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">15</span>
                    <h2 class="pv-section-title">Third-Party Service Providers</h2>
                </div>
                <p class="pv-section-body">
                    We engage trusted third-party providers (payment gateways, cloud hosting, IT/CRM software, SMS/WhatsApp gateways, analytics, map services, insurance partners, logistics contractors) strictly to perform business functions on our behalf under confidentiality terms.
                </p>
            </div>

            <!-- Section 16 -->
            <div class="pv-card" id="vendors-partners" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">16</span>
                    <h2 class="pv-section-title">Vendors, Partners and Service Providers</h2>
                </div>
                <p class="pv-section-body">
                    Relevant customer details (pickup/delivery address, contact details, inventory) may be shared with field drivers, labour teams, and packing partners solely for service execution and coordination.
                </p>
            </div>

            <!-- Section 17 -->
            <div class="pv-card" id="disclosure" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">17</span>
                    <h2 class="pv-section-title">Disclosure of Information</h2>
                </div>
                <p class="pv-section-body">
                    We disclose information to fulfill requested services, process payments, comply with legal obligations, prevent fraud, or protect legal rights. <strong>We do not sell personal information to third parties for commercial use.</strong>
                </p>
            </div>

            <!-- Section 18 -->
            <div class="pv-card" id="legal-govt" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">18</span>
                    <h2 class="pv-section-title">Legal and Government Disclosures</h2>
                </div>
                <p class="pv-section-body">
                    We may disclose personal information when required by law, court orders, government notices, regulatory requirements, law-enforcement requests, or tax authorities.
                </p>
            </div>

            <!-- Section 19 -->
            <div class="pv-card" id="biz-transfers" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">19</span>
                    <h2 class="pv-section-title">Business Transfers</h2>
                </div>
                <p class="pv-section-body">
                    In the event of a merger, acquisition, restructuring, or sale of business assets, personal data may be transferred as part of the business transition under privacy protections.
                </p>
            </div>

            <!-- Section 20 -->
            <div class="pv-card" id="data-security" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">20</span>
                    <h2 class="pv-section-title">Data Security</h2>
                </div>
                <p class="pv-section-body">
                    We implement administrative, technical, and physical safeguards (access controls, SSL encryption, secure hosting, monitoring) to protect personal data against unauthorized access, loss, or misuse. However, no electronic storage or internet transmission is 100% secure.
                </p>
            </div>

            <!-- Section 21 -->
            <div class="pv-card" id="account-security" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">21</span>
                    <h2 class="pv-section-title">Customer Account and Password Security</h2>
                </div>
                <p class="pv-section-body">
                    Customers are responsible for keeping login credentials and OTPs confidential. Promptly notify us if you suspect any unauthorized access to your account.
                </p>
            </div>

            <!-- Section 22 -->
            <div class="pv-card" id="data-retention" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">22</span>
                    <h2 class="pv-section-title">Data Retention</h2>
                </div>
                <p class="pv-section-body">
                    Personal information is retained only as long as necessary to provide services, maintain financial/tax records, resolve disputes, prevent fraud, and comply with legal requirements.
                </p>
            </div>

            <!-- Section 23 -->
            <div class="pv-card" id="data-accuracy" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">23</span>
                    <h2 class="pv-section-title">Data Accuracy</h2>
                </div>
                <p class="pv-section-body">
                    Customers must provide accurate and complete information. Inaccurate details may impact service estimation, vehicle allocation, or pickup/delivery execution.
                </p>
            </div>

            <!-- Section 24 -->
            <div class="pv-card" id="children" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">24</span>
                    <h2 class="pv-section-title">Children's Information</h2>
                </div>
                <p class="pv-section-body">
                    Our services are intended for adults capable of entering into binding contracts. We do not knowingly collect personal information from children.
                </p>
            </div>

            <!-- Section 25 -->
            <div class="pv-card" id="third-websites" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">25</span>
                    <h2 class="pv-section-title">Third-Party Websites and Services</h2>
                </div>
                <p class="pv-section-body">
                    Our platform may contain links to external sites or third-party payment interfaces. We are not responsible for the privacy practices or content of third-party websites.
                </p>
            </div>

            <!-- Section 26 -->
            <div class="pv-card" id="marketing" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">26</span>
                    <h2 class="pv-section-title">Advertising and Marketing</h2>
                </div>
                <p class="pv-section-body">
                    We may send promotional offers or updates where permitted. You can opt out of promotional messages at any time. Operational and transactional notices will continue to be sent.
                </p>
            </div>

            <!-- Section 27 -->
            <div class="pv-card" id="analytics" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">27</span>
                    <h2 class="pv-section-title">Analytics and Service Improvement</h2>
                </div>
                <p class="pv-section-body">
                    Aggregated analytics help us understand booking trends, website performance, and demand patterns to enhance customer experience and operational efficiency.
                </p>
            </div>

            <!-- Section 28 -->
            <div class="pv-card" id="fraud-security" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">28</span>
                    <h2 class="pv-section-title">Fraud Prevention and Security Monitoring</h2>
                </div>
                <p class="pv-section-body">
                    We monitor activities to prevent fake enquiries, payment fraud, cybersecurity threats, or unauthorized access, sharing data with law enforcement or insurers when necessary.
                </p>
            </div>

            <!-- Section 29 -->
            <div class="pv-card" id="reviews-feedback" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">29</span>
                    <h2 class="pv-section-title">Customer Reviews and Feedback</h2>
                </div>
                <p class="pv-section-body">
                    Voluntarily submitted reviews, testimonials, or photos may be used for quality improvement, service verification, or marketing purposes as permitted by law.
                </p>
            </div>

            <!-- Section 30 -->
            <div class="pv-card" id="data-breaches" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">30</span>
                    <h2 class="pv-section-title">Data Breaches and Security Incidents</h2>
                </div>
                <p class="pv-section-body">
                    In the event of a security incident or data breach, we will investigate, mitigate, and notify affected users and regulatory bodies as mandated by applicable law.
                </p>
            </div>

            <!-- Section 31 -->
            <div class="pv-card" id="privacy-rights" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">31</span>
                    <h2 class="pv-section-title">Your Privacy Rights</h2>
                </div>
                <p class="pv-section-body mb-2">Subject to applicable laws, you have the right to:</p>
                <ul class="pv-section-body">
                    <li>Request details regarding the processing of your personal data</li>
                    <li>Request correction or updating of inaccurate information</li>
                    <li>Request erasure or deletion of personal data where legally applicable</li>
                    <li>Withdraw consent for data processing</li>
                    <li>Raise grievances regarding data handling</li>
                </ul>
            </div>

            <!-- Section 32 -->
            <div class="pv-card" id="consent-withdraw" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">32</span>
                    <h2 class="pv-section-title">Withdrawal of Consent</h2>
                </div>
                <p class="pv-section-body">
                    You may withdraw consent for data processing by contacting us. Note that withdrawal does not affect prior lawful processing and may impact our ability to deliver certain services.
                </p>
            </div>

            <!-- Section 33 -->
            <div class="pv-card" id="deletion-requests" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">33</span>
                    <h2 class="pv-section-title">Data Deletion Requests</h2>
                </div>
                <p class="pv-section-body">
                    You can request data deletion by contacting us. Certain information may be retained where required for legal compliance, tax records, fraud prevention, or dispute resolution.
                </p>
            </div>

            <!-- Section 34 -->
            <div class="pv-card" id="grievance" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">34</span>
                    <h2 class="pv-section-title">Grievance Redressal</h2>
                </div>
                <p class="pv-section-body mb-2">For any privacy concerns or grievances, please reach out to our privacy officer:</p>
                <div class="pv-contact-box">
                    <div class="contact-item">
                        <i class="bi bi-person-badge-fill"></i>
                        <span><strong>Grievance / Privacy Contact:</strong> <?= $company3 ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="<?= $mailhtml ?>"><?= $mail ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="<?= $phonehtml ?>"><?= $phone ?></a>
                    </div>
                </div>
            </div>

            <!-- Section 35 -->
            <div class="pv-card" id="policy-changes" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">35</span>
                    <h2 class="pv-section-title">Changes to This Privacy Policy</h2>
                </div>
                <p class="pv-section-body">
                    We may update this Privacy Policy from time to time to reflect operational, legal, or technical changes. Revised policies will be published on our platform with an updated effective date.
                </p>
            </div>

            <!-- Section 36 -->
            <div class="pv-card" id="governing-law" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">36</span>
                    <h2 class="pv-section-title">Governing Law</h2>
                </div>
                <p class="pv-section-body">
                    This Privacy Policy is governed by and construed in accordance with the laws of India. Disputes shall be subject to jurisdiction specified under our Terms & Conditions.
                </p>
            </div>

            <!-- Section 37 -->
            <div class="pv-card" id="severability" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">37</span>
                    <h2 class="pv-section-title">Severability</h2>
                </div>
                <p class="pv-section-body">
                    If any provision of this Privacy Policy is held invalid or unenforceable, the remaining provisions shall continue in full force and effect.
                </p>
            </div>

            <!-- Section 38 -->
            <div class="pv-card" id="contact" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">38</span>
                    <h2 class="pv-section-title">Contact Information</h2>
                </div>
                <p class="pv-section-body mb-3">For privacy inquiries or data requests, contact us at:</p>
                <div class="pv-contact-box">
                    <div class="contact-item">
                        <i class="bi bi-building"></i>
                        <span><strong><?= $company3 ?></strong><br>
                        <?= $address ?></span>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone-fill"></i>
                        <a href="<?= $phonehtml ?>"><?= $phone ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <a href="<?= $mailhtml ?>"><?= $mail ?></a>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-globe"></i>
                        <a href="<?= base_url() ?>" target="_blank"><?= $companydomain ?></a>
                    </div>
                </div>
            </div>

            <!-- Section 39 -->
            <div class="pv-card" id="acknowledgement" data-aos="fade-up">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <span class="pv-section-num">39</span>
                    <h2 class="pv-section-title">Acknowledgement</h2>
                </div>
                <p class="pv-section-body mb-0">
                    By using our Website, Mobile Application, requesting a quotation, submitting information, making a booking or payment, or communicating with us, you acknowledge that you have read, understood, and agreed to this Privacy Policy.
                </p>
            </div>

            <!-- Bottom Action -->
            <div class="text-center mt-4 mb-2">
                <p style="font-size:0.82rem;color:#a0aec0;">
                    <i class="bi bi-shield-check me-1 text-success"></i>
                    Bhandari Packers and Movers is committed to protecting your personal data and privacy.
                </p>
                <a href="<?= site_url() ?>" class="btn btn-danger px-4 py-2" style="background:linear-gradient(135deg,#FC5D09,#ff4b2b);border:none;border-radius:50px;font-weight:600;">
                    <i class="bi bi-house-door-fill me-1"></i> Back to Home
                </a>
            </div>

        </div><!-- end col -->
    </div><!-- end row -->
</main>

<script>
// ─── Active TOC highlight via IntersectionObserver ───────────────────────────
(function() {
    var sections = document.querySelectorAll('.pv-card[id]');
    var tocLinks = document.querySelectorAll('.pv-toc-link');

    if (!sections.length || !tocLinks.length) return;

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                tocLinks.forEach(function(l) { l.classList.remove('active'); });
                var active = document.querySelector('.pv-toc-link[href="#' + entry.target.id + '"]');
                if (active) active.classList.add('active');
            }
        });
    }, { rootMargin: '-80px 0px -60% 0px', threshold: 0 });

    sections.forEach(function(s) { observer.observe(s); });

    // Smooth scroll on TOC click
    tocLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            var href = this.getAttribute('href');
            if (href && href.startsWith('#')) {
                e.preventDefault();
                var target = document.querySelector(href);
                if (target) {
                    var offset = target.getBoundingClientRect().top + window.scrollY - 85;
                    window.scrollTo({ top: offset, behavior: 'smooth' });
                    tocLinks.forEach(function(l) { l.classList.remove('active'); });
                    this.classList.add('active');
                }
            }
        });
    });
})();
</script>
