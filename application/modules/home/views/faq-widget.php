<?php
$city_name = !empty($city) ? $city : 'Noida';
if (!isset($faqs) || empty($faqs)) {
    $ci =& get_instance();
    $ci->load->model('home/home_mdl');
    $faqs = $ci->home_mdl->get_faqs();
}
?>
<div class="container py-5 mb-5 bg-light">
    <div class="text-center mb-5">
      <h3 class="section-head">Frequently Asked Questions About Bhandari Packers & Movers</h3>
      <p class="text-muted section-para">Quick answers to common queries when booking <span class="colour">Packers and Movers in <?= htmlspecialchars($city_name) ?></span></p>
    </div>
    <div class="accordion" id="faqAccordion">
      <?php if (!empty($faqs)): ?>
        <?php foreach ($faqs as $index => $faq): 
            $faqId = 'faq' . ($index + 1);
            $headingId = 'faq' . ($index + 1) . '-heading';
            $q = is_object($faq) ? $faq->question : (is_array($faq) ? ($faq['question'] ?? $faq['q'] ?? '') : '');
            $a = is_object($faq) ? $faq->answer : (is_array($faq) ? ($faq['answer'] ?? $faq['a'] ?? '') : '');
            $q = str_replace(['{city}', '[city]'], $city_name, $q);
            $a = str_replace(['{city}', '[city]'], $city_name, $a);
        ?>
          <div class="accordion-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
            <span class="accordion-header" id="<?= $headingId ?>">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#<?= $faqId ?>" aria-expanded="false" aria-controls="<?= $faqId ?>">
                <span itemprop="name"><?= htmlspecialchars($q) ?></span>
              </button>
            </span>
            <div id="<?= $faqId ?>" class="accordion-collapse collapse" aria-labelledby="<?= $headingId ?>" data-bs-parent="#faqAccordion" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
              <div class="accordion-body" itemprop="text">
                <?= nl2br(htmlspecialchars($a)) ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="text-center text-muted py-3">No FAQs available at the moment.</div>
      <?php endif; ?>
    </div>
</div>