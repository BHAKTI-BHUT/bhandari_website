<h3><b><?=@strtoupper($city)?></b> BHANDARI PACKERS HELPLINE</h3>
<?php
$this->load->database();
if(@$from)
	$ctname=$from;
else $ctname=$city;
$ct_check = $this->db->order_by('rand()')->where('city', @$ctname)->get('branches');
if ($ct_check->num_rows() > 0) {
	$ct = $ct_check->result();
	// print_r($ct);
	foreach($ct as $c){
		if($c->whatsapp){$whatsapp=$c->whatsapp;}
		else $whatsapp=$c->phone;
		?>
	
<div class="col-12">
	<div class="pxp-sp-agent mt-3 mt-md-4">
		<a href="<?= site_url("best-packers-movers-in-".strtolower(str_replace(' ','-',$ctname))) ?>" class="pxp-sp-agent-fig pxp-cover rounded-lg" title="<?= $c->company." ".$city ?> ">
			<img src="<?= base_url("assets/uploads/branches/").$c->image ?>" class="img-fluid" alt="<?= $c->company ?> logo">
		</a>
		<div class="pxp-sp-agent-info">
			<div class="pxp-sp-agent-info-name">
				<a href="<?= site_url("best-packers-movers-in-".strtolower(str_replace(' ','-',$ctname))) ?>"title="<?= $c->company." ".$city ?> ">
					<?= $c->company ?>
				</a>
			</div>
			<address><?=@$c->address?></address>
			<div class="pxp-sp-agent-info-email"><a href="mailto:<?= $c->email ?>"><span class="fa fa-envelope"></span> <?= $c->email ?></a></div>
			<div class="pxp-sp-agent-info-phone"><a href="https://api.whatsapp.com/send?phone=+91<?= @str_replace(" ", "", @$c->phone) ?>&text=Hello+sir,+I+am+interested+in+one+of+your+services" target="_blank" style="color: #333;"><span class="fa fa-phone"></span> <?= @$c->phone ?></a></div>
		</div>
		<div class="clearfix"></div>
		<div class="pxp-sp-agent-btns mt-3 mt-md-4">
			<a href="https://api.whatsapp.com/send?phone=+91<?= @str_replace(" ", "", @$whatsapp) ?>&text=Hello+Bhandari+Packers+and+Movers,I+am+interested+in+one+of+your+services" target="_blank" class="pxp-sp-agent-btn-main btn-success" style='background:#054f00;color:#fff;' data-toggle="modal" data-target="#pxp-contact-agent"><span class="bi bi-whatsapp"></span> Whatsapp Now</a>
			<a href="tel:+91<?= @str_replace(" ", "", @$c->phone) ?>" class="pxp-sp-agent-btn" style='background: #ff3b00;color:#fff;' data-toggle="modal" data-target="#pxp-contact-agent"><span class="bi bi-telephone"></span> Call Us Now</a>
		</div>
	</div> 
	</div><div class="clearfix"></div>
<?php } } ?>
<style>
.pxp-sp-agent-fig{display:block;float:left;width:100px;height:100px;overflow:hidden;margin-right:20px}.pxp-cover{background-size:cover;background-position:center center;background-repeat:no-repeat}.rounded-lg{border-radius:0.3rem!important}.pxp-sp-agent-info-name,.pxp-sp-agent-info-name a{font-weight:900;line-height:1.2;color:#333;text-decoration:none;font-size: 20px;}.pxp-sp-agent-info-rating{padding-bottom:6px}.pxp-sp-agent-info-rating>span{margin:0 1px;font-size:.9rem;color:#000}.pxp-sp-agent-info-email>a,.pxp-sp-agent-info-phone{opacity:1}.pxp-sp-agent-info-email>a{text-decoration:none}.pxp-sp-agent-info-email>a,.pxp-sp-agent-info-phone{color:#333;opacity:.7;font-size:.9rem}@media screen and (max-width:1199px){.pxp-sp-agent-btn-main{width:100%;margin-right:0}}.pxp-sp-agent-btn-main{display:block;float:left;text-align:center;white-space:nowrap;width:49%;min-width:170px;background-color:#333;height:46px;padding:0;border:1px solid #333;margin-right:2%;margin-bottom:10px;border-radius:.25rem;font-size:.9rem;text-transform:uppercase;line-height:46px;font-weight:700;color:#fff;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out}.pxp-sp-agent-btn-main{display:block;float:left;text-align:center;white-space:nowrap;width:49%;min-width:170px;background-color:#333;height:46px;padding:0;border:1px solid #333;margin-right:2%;margin-bottom:10px;border-radius:.25rem;font-size:.9rem;text-transform:uppercase;line-height:46px;font-weight:700;color:#fff;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out}@media screen and (max-width:1199px){.pxp-sp-agent-btn{width:100%}}.pxp-sp-agent-btn-main>span,.pxp-sp-agent-btn>span{margin-right:4px}.pxp-sp-agent-btn{display:block;float:left;text-align:center;white-space:nowrap;width:49%;min-width:170px;background-color:#fff;height:46px;padding:0;border:1px solid #E2E2E2;border-radius:.25rem;font-size:.9rem;text-transform:uppercase;line-height:46px;font-weight:700;color:#333;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out}.btn-success{color:#fff;background-color:#28a745;border-color:#28a745}
h3 b{color: #FC5D09}
.pxp-sp-agent-btn, .pxp-sp-agent-btn-main{font-size:1em}
address {margin-bottom:0px;color: #265900;font-size: 15px;}
</style>