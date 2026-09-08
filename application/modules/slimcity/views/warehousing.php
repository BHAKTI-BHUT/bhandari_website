<div class="breadcumb-area">
    <div class="container">
        <div class="row">
            <div class="breadcumb-content">
                <h1>Warehousing Services in <?= @$city?></h1>
                <ul>
                    <li><a href="<?= site_url("members/view") ?>">Locations</a></li>
                    <li><i class="bi bi-chevron-right"></i></li>
                    <li><a href="<?= site_url("best-packers-movers-in-".strtolower(str_replace(' ','-',$city))) ?>"><?= @$city?> Services</a></li>
                    <li><i class="bi bi-chevron-right"></i></li>
                    <li>Warehousing Services in <?= @$city?></li>
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
    <div class="container" style="padding-top: 70px">
        <div class="row">
            <div class="col-sm-7 pb-20">
                <h2>Warehousing Services in <?= @$city?></h2>
                <p>At <?= @$name?> in <?= @$city?>, we offer state-of-the-art warehousing services to meet the diverse storage needs of <?= @$city?>'s residents. Our <?= @$city?>-based facilities are strategically located to ensure easy access for our valued clients.</p>
                <p><?= @$city?> residents trust us for secure and climate-controlled warehousing solutions. Our expert team in <?= @$city?> ensures that your belongings are stored in pristine condition, whether you're in <?= @$city?> or need long-term storage for items heading outside <?= @$city?>.</p>
                <p>In <?= @$city?>, <?= @$name?> is the top choice for cost-effective and reliable warehousing services. We take pride in offering flexible storage options to suit <?= @$city?>'s ever-changing requirements, ensuring a stress-free experience for our clients.</p>
                <?php $this->load->view('slimcity/details_widget.php', @$city) ?>
            </div>
            <div class="col-sm-5">
                <img src="<?= base_url("assets/img/ipg/13.png") ?>" alt="Warehousing Services <?= $name ?>" class="img-responsive  mx-auto d-block" style="max-width: 380px;">
            </div>
        </div>
        <?php include 'city_links.php';?>
    </div>
</div>