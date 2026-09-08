 <section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center">FAQ Section</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
          FAQ
        </li>
      </ol>
    </nav>
  </div>
</section>
<main class="container py-5">

  <!-- Page Header -->
  <section class="text-center mb-5">
    <span class="d-block fs-3 fw-bold text-danger">Frequently Asked Questions</span>
    <p class="text-muted mb-0">Answers to the most common queries about our moving and packing services.</p>
  </section>

  <?php if (!empty($faqs)): ?>
    <section class="mb-5" data-aos="fade-up">
      <div class="accordion" id="faqAccordionPage">
        <?php foreach ($faqs as $index => $faq): 
            $faqId = 'faqPage' . ($index + 1);
            $headingId = 'faqPage' . ($index + 1) . '-heading';
            $q = is_object($faq) ? $faq->question : (is_array($faq) ? ($faq['question'] ?? '') : '');
            $a = is_object($faq) ? $faq->answer : (is_array($faq) ? ($faq['answer'] ?? '') : '');
        ?>
          <div class="accordion-item border-0 shadow-sm mb-3">
            <p class="accordion-header mb-0" id="<?= $headingId ?>">
              <button class="accordion-button collapsed fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $faqId ?>" aria-expanded="false" aria-controls="<?= $faqId ?>">
                <span><?= htmlspecialchars($q) ?></span>
              </button>
            </p>
            <div id="<?= $faqId ?>" class="accordion-collapse collapse" aria-labelledby="<?= $headingId ?>" data-bs-parent="#faqAccordionPage">
              <div class="accordion-body">
                <p class="mb-0"><?= nl2br(htmlspecialchars($a)) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  <?php else: ?>
    <!-- Fallback default categories -->
    <section class="mb-5" data-aos="fade-up">
      <div class="accordion" id="faqGeneral">
        <div class="accordion-item border-0 shadow-sm mb-3">
          <p class="accordion-header mb-0">
            <button class="accordion-button collapsed fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
              <span>What services do Bhandari Packers and Movers offer?</span>
            </button>
          </p>
          <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqGeneral">
            <div class="accordion-body">
              <p>We provide home shifting, office relocation, car and bike transport, storage facilities, and long-distance moving across India.</p>
            </div>
          </div>
        </div>
        <div class="accordion-item border-0 shadow-sm mb-3">
          <p class="accordion-header mb-0">
            <button class="accordion-button collapsed fw-semibold text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
              <span>How can I get a moving quote?</span>
            </button>
          </p>
          <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqGeneral">
            <div class="accordion-body">
              <p>You can contact us via phone or WhatsApp at <strong><a href="<?= $phonehtml ?>">+91-<?= $phone ?></a></strong> or fill out our online booking form to receive a quick, free estimate.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>
</main>
