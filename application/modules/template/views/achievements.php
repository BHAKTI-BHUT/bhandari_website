<?php
// Default achievements statistics fallback values
$happy_clients = 3236;
$awards = 147;
$total_hours = 11848;
$projects_complete = 2199;

try {
    $admin_db = $this->load->database('admin_hub', TRUE);
    if ($admin_db && $admin_db->conn_id && $admin_db->table_exists('settings')) {
        $q_clients = $admin_db->where('key', 'achievement_happy_clients')->get('settings')->row();
        if ($q_clients) $happy_clients = (int) $q_clients->value;

        $q_awards = $admin_db->where('key', 'achievement_awards')->get('settings')->row();
        if ($q_awards) $awards = (int) $q_awards->value;

        $q_hours = $admin_db->where('key', 'achievement_total_hours')->get('settings')->row();
        if ($q_hours) $total_hours = (int) $q_hours->value;

        $q_projects = $admin_db->where('key', 'achievement_projects_complete')->get('settings')->row();
        if ($q_projects) $projects_complete = (int) $q_projects->value;
    }
} catch (Exception $e) {
    log_message('error', 'Achievements settings fetch error: ' . $e->getMessage());
}
?>

<!-- Achievements Section -->
<section class="bg-danger achievements text-white py-5" id="achievements-section">
  <div class="container text-center">
    <h3 class="mb-5 section-head">Bhandari Packers and Movers Achievements</h3>

    <div class="row g-4">
      <div class="col-6 col-md-3">
        <div id="counter-clients" class="display-4 fw-bolder" data-target="<?= $happy_clients ?>"><?= number_format($happy_clients) ?>+</div>
        <p class="lead">Happy Clients</p>
      </div>

      <div class="col-6 col-md-3">
        <div id="counter-awards" class="display-4 fw-bolder" data-target="<?= $awards ?>"><?= number_format($awards) ?>+</div>
        <p class="lead">Awards</p>
      </div>

      <div class="col-6 col-md-3">
        <div id="counter-hours" class="display-4 fw-bolder" data-target="<?= $total_hours ?>"><?= number_format($total_hours) ?>+</div>
        <p class="lead">Total Hours</p>
      </div>

      <div class="col-6 col-md-3">
        <div id="counter-projects" class="display-4 fw-bolder" data-target="<?= $projects_complete ?>"><?= number_format($projects_complete) ?>+</div>
        <p class="lead">Projects Complete</p>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const section = document.getElementById("achievements-section");
  const counters = section.querySelectorAll(".display-4");
  const speed = 200; // Lower = faster

  // Set initial value to 0 inside this section only
  counters.forEach(counter => {
    const target = +counter.getAttribute("data-target");
    counter.textContent = "0+";
  });

  // Counter animation function
  const animateCounters = () => {
    counters.forEach(counter => {
      const target = +counter.getAttribute("data-target");
      let count = 0;

      const updateCount = () => {
        const increment = Math.ceil(target / speed);
        if (count < target) {
          count += increment;
          counter.textContent = count.toLocaleString() + "+";
          requestAnimationFrame(updateCount);
        } else {
          counter.textContent = target.toLocaleString() + "+";
        }
      };
      updateCount();
    });
  };

  // Intersection Observer to trigger animation on scroll
  const observer = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) {
      animateCounters();
      observer.unobserve(section); // Run once
    }
  }, { threshold: 0.5 });

  observer.observe(section);
});
</script>
