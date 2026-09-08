<section class="py-5 text-white breadcrumb-section">
  <div class="container d-flex flex-column align-items-center justify-content-center text-center">
    <h1 class="mt-2 fw-bold text-center">About Us</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0">
        <li class="breadcrumb-item">
          <a href="<?= site_url() ?>" class="text-white text-decoration-none">Home</a>
        </li>
        <li class="breadcrumb-item active text-white" aria-current="page">
          About Bhandari Packers
        </li>
      </ol>
    </nav>
  </div>
</section>
<section class="container py-5">
  <div class="row">
    <?php $this->view('contacts/pageform.php'); ?>
    <div class="col-md-6 d-flex flex-column justify-content-center">
      <h2 class="fw-bold mb-3"><?= (!empty($page_setting) && !empty($page_setting->about_title)) ? $page_setting->about_title : 'About Us <span class="text-danger">- Bhandari Packers and Movers</span>' ?></h2>
      <?php if (!empty($page_setting) && !empty($page_setting->about_description)): ?>
        <?= $page_setting->about_description ?>
      <?php else: ?>
        <p>We have immense pride in introducing ourselves as<b> Bhandari Packers and Movers</b> Company, among India's most skilled and trustworthy relocation service providers. We deliver moving & shifting services that are safe, reliable and affordable. We believe that relocating your home, your office, or your vehicle is not just moving your stuff; it is moving your world. We stand as the number one choice for skilled movers throughout India, providing a smooth, safe, and carefree relocation experience for you, our customer, at rates within your budget.</p>

        <p>At our <b>Packers and Movers</b>, there is no end to what our experience can deliver to your moving day. Every move is treated as a priority by us, and we send our professionals who employ all of our abilities to ensure care, planning, and precision in packing, loading, moving, and unpacking once we have reached your destination. From local moves to long distance relocation we handle it all. Our goal is to make the entire experience more manageable and useful; we want you to get your belongings safely, and on time, to the desired location.</p>
        <p>
          Choose Bhandari Packers and Movers for excellence, transparency, and peace of mind in every move.
        </p>
      <?php endif; ?>
    </div>
    <div class="col-12">
      <h3><?= (!empty($page_setting) && !empty($page_setting->who_we_are_title)) ? $page_setting->who_we_are_title : 'Who We Are' ?></h3> 
      <?php if (!empty($page_setting) && !empty($page_setting->who_we_are_description)): ?>
        <?= $page_setting->who_we_are_description ?>
      <?php else: ?>
        <p>Our company  is a top logistics and relocation business that represents quality, trustworthy relocation, and customer satisfaction in the industry. We are a professionally managed business, offering packing and moving service solutions aimed to offer end-to-end packing and moving services across India. Whether it's residential moving, or corporate relocation, or vehicle transportation, we offer moving service solutions that make the move experience as easy as possible with less stress</p>

        <p>We have built a presence throughout major cities over the years, gaining the trust of thousands of families and businesses. Our customer-first approach, expert packing methods, and nationwide network allow us to be your <b>Top Packers and Movers near you</b> - ensuring we can provide moving services that are of quality and value.</p>

        <p>We simplify the process of moving, making it pleasant, secure, and a lack of stress for everyone. We will deliver high-quality moving services that unite technology, skilled laborers, and personal connections. At our <b>Packers and Movers</b>, what we are about is building rapport by being honest about our pricing, on-time delivery, and being consistent every time.</p>

        <p>Every move we make has one purpose — to achieve customer satisfaction, every time, and make sure every move is a positive experience.</p>

        <p>To be the No.1 <b>Packers and Movers Company in India</b>, acknowledged as the most reliable, honest and innovative relocation provider. We see a future where every customer receives an affordable, hassle-free and fully transparent service through technology and human trust.</p>

        <p>When you are working with us, you are recognizing that moving is more than moving. Regardless of the service you are using, you can expect  our attention for every detail along the way, from packaging, to delivery. We want you to feel better throughout your relocation to a home and have a great experience. </p>

        <p>We treat every move like we are in the same position as you and protect that in every step of the process - how we package, handle, and deliver. Our employees, vehicles, and tracking systems are all trained to collaborate as a seamless and efficient move.</p>

        <p>No matter whether you are moving a home, office, or a vehicle, you will have a safe, reliable, and affordable move and the peace of mind that comes with that.</p>
      <?php endif; ?>
    </div>
  </div>
</section>
<section class="container p-0 my-4">
  <div class="ratio ratio-16x9 d-flex align-items-center justify-content-center">
    <iframe
      class="size rounded shadow"
      src="<?= (!empty($page_setting) && !empty($page_setting->map_iframe_url)) ? htmlspecialchars($page_setting->map_iframe_url) : 'https://www.google.com/maps?q=Office+No+504,+5th+floor+baba+Arcade,+Harola+Sector+5,+Noida,+Gautam+Budh+Nagar,+Uttar+Pradesh+201301,+India&output=embed' ?>"
      allowfullscreen
      loading="lazy">
    </iframe>
  </div>
</section>

<style>
    .breadcrumb-section{
        background: linear-gradient(90deg, #FC5D09, #DD3802);
    }
    .color{
      color:#FC5D09;
    }
</style>