<main class="main">
  <div class="site-breadcrumb" style="background: url(<?= base_url() ?>assets/img/breadcrumb/01.jpg)">
    <div class="container">
      <h1 class="breadcrumb-title">404 Error</h1>
      <ul class="breadcrumb-menu">
        <li><a href="<?= site_url() ?>">Home</a></li>
        <li class="active">404 Error</li>
      </ul>
    </div>
  </div>
  <section class="error_section text-center mouse_move mt-3">
    <div class="container">
      <div class="error_image decoration_wrap text-center">
        <img src="<?= base_url("assets/img/error/404.png") ?>" alt="404 Error">
      </div>
      <div class="error_content">
        <h2>Page not found</h2>
        <p>
          The requested URL does not exist on this server;<span class="d-md-block"> Please verify the web address and contact the administrator if you believe it's an error. </span>
        </p>
        <a href="<?= site_url() ?>" class="bd-btn-link btn_primary">
          <span class="bd-button-content-wrapper">
            <span class="bd-button-icon">
              <i class="fa-light fa-arrow-right-long"></i>
            </span>
            <span class="pd-animation-flip">
              <span class="bd-btn-anim-wrapp">
                <a href="<?= site_url('') ?>" class="theme_button color1">Go Back To Home</a>

              </span>
            </span>
          </span>
        </a>
      </div>
    </div>
  </section>
</main>