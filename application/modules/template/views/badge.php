<div class="container">
  <div class="row text-center">
    <div class="col-lg-3 col-12 flip_box">
      <img class="flip_img" src="<?= base_url() ?>assets/images/gallery/first.webp" alt="IBA Approved Bills" loading="lazy" />
      <div class="reason">
        <span>IBA Recognized</span>
        <p class="head1">Choose reliable, IBA-certified movers for hassle-free relocation services throughout India.</p>
      </div>
    </div>
    <div class="col-lg-3 col-12 flip_box">
      <img class="flip_img" src="<?= base_url() ?>assets/images/gallery/second.webp" alt="Google Reviews" loading="lazy" />
      <div class="reason">
        <span>Top Rated</span>
        <p class="head1">Highly rated movers offering secure, prompt, and professional shifting services.</p>
      </div>
    </div>
    <div class="col-lg-3 col-12 flip_box">
    <img class="flip_img" src="<?= base_url() ?>assets/images/gallery/third.webp" alt="Certified Quality" loading="lazy" />
      <div class="reason">
        <span>100% Customer Satisfaction</span>
        <p class="head1">We are committed to delivering trusted relocation services with 100% customer satisfaction.</p>
      </div>
    </div>
    <div class="col-lg-3 col-12 flip_box">
    <img class="flip_img" src="<?= base_url() ?>assets/images/gallery/fourth.webp" alt="Reliable Services" loading="lazy" />
      <div class="reason">
        <span>Trusted</span>
        <p class="head1">Dependable movers ensuring secure, on-time, and affordable relocation solutions.</p>
      </div>
    </div>
  </div>
</div>
<style>
  .flip_box {
    transition: transform 0.6s ease-in-out;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
  }
  .flip_box:hover {
    transform: translateY(-10px);
  }
   .flip_img {
  width: 200px; 
  height: auto; 
  object-fit: cover; 
  margin-bottom: 15px;
  transition: transform 0.6s ease-in-out;
}
  .flip_box:hover .flip_img {
    transform: rotateY(360deg);
  }
  .reason p {
    color: black;
    font-size: 13px;
    line-height: 2;
  }
  .reason span{
    color:black;
    font-weight: 700;
  }
</style>