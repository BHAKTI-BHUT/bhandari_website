<div class="breadcumb-area">
    <div class="container">
        <div class="row">
            <div class="breadcumb-content">
                <h1>Bike Transportation in <?= @$city?></h1>
                <ul>
                    <li><a href="<?= site_url("members/view") ?>">Locations</a></li>
                    <li><i class="bi bi-chevron-right"></i></li>
                    <li><a href="<?= site_url("best-packers-movers-in-".strtolower(str_replace(' ','-',$city))) ?>"><?= @$city?> Services</a></li>
                    <li><i class="bi bi-chevron-right"></i></li>
                    <li>Bike Transportation in <?= @$city?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 200">
	<path fill="<?= @$color1 ?>" fill-opacity="1" d="M0,160L40,144C80,128,160,96,240,101.3C320,107,400,149,480,149.3C560,149,640,107,720,74.7C800,43,880,21,960,10.7C1040,0,1120,0,1200,26.7C1280,53,1360,107,1400,133.3L1440,160L1440,0L1400,0C1360,0,1280,0,1200,0C1120,0,1040,0,960,0C880,0,800,0,720,0C640,0,560,0,480,0C400,0,320,0,240,0C160,0,80,0,40,0L0,0Z">
	</path>
</svg>
<div class="our-service-page w100-l fixed-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 pb-20">
                <h2>Bike Shifting Services in <?= @$city?></h2>
                <p>At <?= @$name?> in <?= @$city?>, we specialize in secure and reliable bike-shifting services designed to cater to the specific needs of <?= @$city?>'s residents. Our team in <?= @$city?> understands the importance of your prized possession, ensuring its safe transport within and beyond <?= @$city?>.</p>
                <p>In <?= @$city?>, our professional bike shifting experts utilize state-of-the-art equipment and handling techniques to guarantee the utmost protection for your two-wheeler. We take pride in our reputation as <?= @$city?>'s premier bike shifting service, ensuring a seamless and damage-free experience for our clients.</p>
                <p><?= @$city?> residents trust us for cost-effective bike-shifting solutions that prioritize their convenience and peace of mind. Whether you're moving within <?= @$city?> or relocating elsewhere, <?= @$name?> is your trusted partner for hassle-free bike shifting services in <?= @$city?>.</p>
                <?php $this->load->view('slimcity/details_widget.php', @$city) ?>
            </div>
            <div class="col-sm-5">
                <img src="<?= base_url("assets/img/ipg/11.png") ?>" alt="Bike transportation <?= $name ?>" class="img-responsive  mx-auto d-block" style="max-width: 380px;">
            </div>
        </div>
        <?php include 'city_links.php';?>
    </div>
</div>