<!-- Breadcrumb Section -->
<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center">Video Gallery</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">Video Gallery</li>
      </ol>
    </nav>
  </div>
</section>

<!-- Magnific Popup CSS CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

<!-- Video Gallery Section -->
<section class="video-gallery-section py-5">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold mb-2">Our Shifting <span class="text-danger">Videos</span></h2>
      <p class="text-muted">A glimpse of our professional packing, loading, and relocation operations across India.</p>
    </div>

    <?php if (!empty($video_gallery)): ?>
    <div class="video-gallery-grid">
      <?php foreach ($video_gallery as $vid): ?>
      <div class="video-item">
        <img src="<?= $vid['thumbnail_url'] ?>" alt="<?= htmlspecialchars($vid['title']) ?>" />
        <div class="video-item-caption">
          <div class="video-text">
            <h3><?= htmlspecialchars($vid['title']) ?></h3>
            <?php if (!empty($vid['caption'])): ?>
              <p><?= htmlspecialchars($vid['caption']) ?></p>
            <?php endif; ?>
          </div>
          <a class="play-popup-btn" href="<?= $vid['embed_url'] ?>"></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php else: ?>
    <div class="text-center py-5 text-muted">
      <div class="mb-3" style="font-size: 3rem; opacity: 0.3;">🎥</div>
      <p class="fs-5">No videos available at the moment. Check back soon!</p>
    </div>
    <?php endif; ?>
  </div>
</section>

<!-- Custom Styles matching reference design and responsive parameters -->
<style>
.breadcrumb-section {
  background: linear-gradient(90deg, #FC5D09, #DD3802);
}

.video-gallery-section {
  background: #f8f9fa;
  min-height: 400px;
}

.video-gallery-grid {
  position: relative;
  margin: 0 auto;
  max-width: 1100px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 24px;
}

.video-gallery-grid .video-item {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
  width: calc(50% - 12px);
  min-width: 300px;
  max-width: 520px;
  height: 300px;
  background: #000;
  cursor: pointer;
  box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.video-gallery-grid .video-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 28px rgba(0,0,0,0.15);
}

.video-gallery-grid .video-item img {
  position: relative;
  display: block;
  opacity: .6;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: opacity 0.35s, transform 0.35s;
  backface-visibility: hidden;
}

.video-gallery-grid .video-item:hover img {
  opacity: .35;
  transform: scale(1.05);
}

.video-gallery-grid .video-item .video-item-caption {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 2em;
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  text-align: left;
}

.video-gallery-grid .video-item .video-item-caption > a {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 2;
}

.video-gallery-grid .video-item h3 {
  font-size: 1.35rem;
  font-weight: 700;
  margin: 0;
  text-transform: uppercase;
  z-index: 10;
  position: relative;
  color: #fff;
}

.video-gallery-grid .video-item h3::after {
  content: "";
  position: absolute;
  bottom: -6px;
  left: 0;
  width: 50px;
  height: 2px;
  background: #FC5D09;
  transition: transform 0.3s;
  transform: scaleX(0);
  transform-origin: left;
}

.video-gallery-grid .video-item:hover h3::after {
  transform: scaleX(1);
}

.video-gallery-grid .video-item p {
  letter-spacing: 1px;
  font-size: 0.82rem;
  margin: 8px 0 0 0;
  opacity: 0;
  transition: opacity 0.35s, transform 0.35s;
  transform: translate3d(20px, 0, 0);
  z-index: 10;
  position: relative;
  color: #ddd;
  text-transform: none;
}

.video-gallery-grid .video-item:hover p {
  opacity: 1;
  transform: translate3d(0, 0, 0);
}

@media screen and (max-width: 768px) {
  .video-gallery-grid .video-item {
    width: 100%;
    max-width: 100%;
    height: 240px;
  }
}
</style>

<!-- Magnific Popup JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<script>
$(document).ready(function() {
  $('.video-gallery-grid').magnificPopup({
    delegate: 'a.play-popup-btn',
    type: 'iframe',
    gallery: {
      enabled: true
    },
    iframe: {
      patterns: {
        youtube: {
          index: 'youtube.com/',
          id: 'v=',
          src: 'https://www.youtube.com/embed/%id%?autoplay=1'
        },
        youtu_be: {
          index: 'youtu.be/',
          id: '/',
          src: 'https://www.youtube.com/embed/%id%?autoplay=1'
        },
        vimeo: {
          index: 'vimeo.com/',
          id: '/',
          src: 'https://player.vimeo.com/video/%id%?autoplay=1'
        }
      }
    }
  });
});
</script>