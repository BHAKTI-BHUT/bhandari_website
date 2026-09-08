<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center">Photo Gallery</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">Photo Gallery</li>
      </ol>
    </nav>
  </div>
</section>

<section class="pg-section">
  <div class="pg-container">

    <div class="pg-header">
      <h2 class="pg-heading">Our Work in <span>Pictures</span></h2>
      <p class="pg-subheading">A glimpse into our professional packing, loading and relocation services across India.</p>
    </div>

    <?php if (!empty($gallery_images)): ?>

    <div class="pg-gallery">
      <?php foreach ($gallery_images as $img):
          // Resolve image URL
          $imgPath = $img['image'];
          if (strpos($imgPath, 'assets/') === 0 || strpos($imgPath, 'uploads/') === 0) {
              $imgUrl = base_url($imgPath);
          } else {
              $imgUrl = base_url($imgPath);
          }
          $altText = !empty($img['alt_text']) ? htmlspecialchars($img['alt_text']) : htmlspecialchars($img['title'] ?: 'Gallery Image');
          $title   = htmlspecialchars($img['title'] ?: '');
      ?>
      <div class="pg-item" onclick="pgOpenLightbox('<?= $imgUrl ?>', '<?= addslashes($altText) ?>')">
        <img class="pg-image" src="<?= $imgUrl ?>" alt="<?= $altText ?>" loading="lazy">
        <?php if ($title): ?>
        <div class="pg-caption"><span><?= $title ?></span></div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>

    <?php else: ?>
    <div class="pg-empty">
      <i class="pg-empty-icon">🖼️</i>
      <p>No photos available at the moment. Check back soon!</p>
    </div>
    <?php endif; ?>

  </div>
</section>

<div id="pg-lightbox" class="pg-lightbox" onclick="pgCloseLightbox()">
  <button class="pg-lightbox-close" onclick="pgCloseLightbox()" aria-label="Close">&times;</button>
  <div class="pg-lightbox-content" onclick="event.stopPropagation()">
    <img id="pg-lightbox-img" src="" alt="">
    <p id="pg-lightbox-caption" class="pg-lightbox-caption"></p>
  </div>
  <button class="pg-lightbox-nav pg-lightbox-prev" id="pg-prev" onclick="pgNavigate(-1); event.stopPropagation();">&#8249;</button>
  <button class="pg-lightbox-nav pg-lightbox-next" id="pg-next" onclick="pgNavigate(1); event.stopPropagation();">&#8250;</button>
</div>

<style>
/* ───────────────────────────────────────────────────────────────
   PHOTO GALLERY — Modern CSS Grid + Lightbox
─────────────────────────────────────────────────────────────── */
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap');

.pg-section {
  background: #f4f6f9;
  padding: 60px 0 80px;
}

.pg-container {
  max-width: 1300px;
  margin: 0 auto;
  padding: 0 20px;
}

/* ── Section Header ── */
.pg-header {
  text-align: center;
  margin-bottom: 48px;
}
.pg-heading {
  font-family: 'Montserrat', sans-serif;
  font-size: clamp(1.6rem, 3vw, 2.4rem);
  font-weight: 700;
  color: #1a1a2e;
  margin-bottom: 10px;
}
.pg-heading span {
  background: linear-gradient(135deg, #e63946, #ff6b6b);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.pg-subheading {
  font-size: 1rem;
  color: #6c757d;
  max-width: 520px;
  margin: 0 auto;
}

/* ── Gallery Grid ── */
.pg-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
  gap: 18px;
}

/* ── Gallery Item ── */
.pg-item {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  background: #dde1e7;
  box-shadow: 0 4px 16px rgba(0,0,0,.10);
  cursor: zoom-in;
  aspect-ratio: 4 / 3;
  transition: box-shadow .3s ease, transform .3s ease;
}
.pg-item:hover {
  box-shadow: 0 10px 32px rgba(0,0,0,.20);
  transform: translateY(-4px);
}

.pg-image {
  display: block;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 400ms ease-out;
}
.pg-item:hover .pg-image {
  transform: scale(1.08);
}

/* ── Caption overlay ── */
.pg-caption {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 28px 14px 12px;
  background: linear-gradient(to top, rgba(0,0,0,.65) 0%, transparent 100%);
  color: #fff;
  font-family: 'Montserrat', sans-serif;
  font-size: .82rem;
  font-weight: 600;
  letter-spacing: .3px;
  transform: translateY(100%);
  transition: transform .3s ease;
}
.pg-item:hover .pg-caption {
  transform: translateY(0);
}

/* ── Empty state ── */
.pg-empty {
  text-align: center;
  padding: 80px 20px;
  color: #adb5bd;
}
.pg-empty-icon { font-size: 3.5rem; display: block; margin-bottom: 14px; }

/* ───────────────────────────────────────────────────────────────
   LIGHTBOX
─────────────────────────────────────────────────────────────── */
.pg-lightbox {
  display: none;
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,.92);
  z-index: 99999;
  justify-content: center;
  align-items: center;
  animation: pgFadeIn .25s ease;
}
.pg-lightbox.open { display: flex; }

@keyframes pgFadeIn {
  from { opacity: 0; } to { opacity: 1; }
}

.pg-lightbox-content {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
  text-align: center;
}
#pg-lightbox-img {
  max-width: 88vw;
  max-height: 82vh;
  object-fit: contain;
  border-radius: 10px;
  box-shadow: 0 24px 80px rgba(0,0,0,.6);
  animation: pgZoomIn .25s ease;
}
@keyframes pgZoomIn {
  from { transform: scale(.92); opacity: 0; }
  to   { transform: scale(1);   opacity: 1; }
}

.pg-lightbox-caption {
  color: rgba(255,255,255,.78);
  font-size: .9rem;
  margin-top: 12px;
  font-family: 'Montserrat', sans-serif;
}

.pg-lightbox-close {
  position: fixed;
  top: 18px;
  right: 24px;
  background: rgba(255,255,255,.12);
  border: none;
  color: #fff;
  font-size: 2.2rem;
  width: 44px;
  height: 44px;
  border-radius: 50%;
  cursor: pointer;
  line-height: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background .2s;
  z-index: 10;
}
.pg-lightbox-close:hover { background: rgba(255,255,255,.25); }

.pg-lightbox-nav {
  position: fixed;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(255,255,255,.12);
  border: none;
  color: #fff;
  font-size: 2.5rem;
  width: 52px;
  height: 52px;
  border-radius: 50%;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: background .2s, transform .2s;
  z-index: 10;
}
.pg-lightbox-nav:hover { background: rgba(255,255,255,.28); transform: translateY(-50%) scale(1.08); }
.pg-lightbox-prev { left: 16px; }
.pg-lightbox-next { right: 16px; }

/* ── Mobile Responsive ── */
@media (max-width: 768px) {
  .pg-gallery {
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
    gap: 12px;
  }
  .pg-lightbox-nav { display: none; }
  .pg-section { padding: 40px 0 60px; }
}
@media (max-width: 480px) {
  .pg-gallery {
    grid-template-columns: repeat(2, 1fr);
    gap: 10px;
  }
}
</style>

<script>
(function () {
  // Collect all images from gallery for lightbox navigation
  var pgImages = [];
  var pgCurrentIndex = 0;

  document.querySelectorAll('.pg-item').forEach(function (item, index) {
    var img     = item.querySelector('.pg-image');
    var caption = item.querySelector('.pg-caption span');
    pgImages.push({
      src:     img ? img.src : '',
      caption: caption ? caption.textContent : '',
    });
    item.setAttribute('data-pg-index', index);
  });

  window.pgOpenLightbox = function (src, caption) {
    // Find the index by src
    pgCurrentIndex = pgImages.findIndex(function (i) { return i.src === src; });
    if (pgCurrentIndex === -1) pgCurrentIndex = 0;
    pgShowImage(pgCurrentIndex);
    document.getElementById('pg-lightbox').classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  window.pgCloseLightbox = function () {
    document.getElementById('pg-lightbox').classList.remove('open');
    document.body.style.overflow = '';
  };

  window.pgNavigate = function (dir) {
    pgCurrentIndex = (pgCurrentIndex + dir + pgImages.length) % pgImages.length;
    pgShowImage(pgCurrentIndex);
  };

  function pgShowImage(index) {
    var lb     = document.getElementById('pg-lightbox-img');
    var cap    = document.getElementById('pg-lightbox-caption');
    var data   = pgImages[index];
    if (!data) return;
    lb.src  = data.src;
    lb.alt  = data.caption;
    cap.textContent = data.caption;
  }

  // Keyboard navigation
  document.addEventListener('keydown', function (e) {
    var lb = document.getElementById('pg-lightbox');
    if (!lb.classList.contains('open')) return;
    if (e.key === 'Escape')     pgCloseLightbox();
    if (e.key === 'ArrowRight') pgNavigate(1);
    if (e.key === 'ArrowLeft')  pgNavigate(-1);
  });

  // Touch swipe support
  var touchStartX = 0;
  var lbEl = document.getElementById('pg-lightbox');
  lbEl.addEventListener('touchstart', function(e) { touchStartX = e.changedTouches[0].screenX; }, { passive: true });
  lbEl.addEventListener('touchend', function(e) {
    var diff = touchStartX - e.changedTouches[0].screenX;
    if (Math.abs(diff) > 50) pgNavigate(diff > 0 ? 1 : -1);
  });
})();
</script>
