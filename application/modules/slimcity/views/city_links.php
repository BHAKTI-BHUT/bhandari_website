<?php
$link=$this->uri->segment(1);
if(@$from) $cityn=$from;else $cityn=$city;
$ctlink=strtolower(str_replace(' ','-',$cityn));
$keywords=array(
		array("link"=>"home-relocation-in-$ctlink","label"=>"Home Shifting in $cityn"),
		array("link"=>"office-moving-in-$ctlink","label"=>"Office Moving in $cityn"),
		array("link"=>"bike-transportation-in-$ctlink","label"=>"Bike Transportation in $cityn"),
		array("link"=>"car-transportation-in-$ctlink","label"=>"Car Transportation in $cityn"),
		array("link"=>"iba-approved-packers-in-$ctlink","label"=>"IBA Approved Packers in $cityn"),
		array("link"=>"aircargo-in-$ctlink","label"=>"Air Cargo Services in $cityn"),
		array("link"=>"warehousing-in-$ctlink","label"=>"Warehousing Services in $cityn"),
		array("link"=>"packing-moving-in-$ctlink","label"=>"Packing Moving in $cityn"),
		array("link"=>"loading-unloading-in-$ctlink","label"=>"Loading & Unloading in $cityn"),
);
$htmldata="<style>.item{padding:20px 10px;box-shadow:0 3px 20px 0 #ebebeb;margin-bottom:15px;transition:all .5s}.item:hover{box-shadow:none}.item a{color:#000;font-weight:bold}</style>
<div class='row text-center mt-3 mb-2'>";
foreach ($keywords as $i=>$k){
	if($k['link']==$link || $i>4)
		continue;
	else $htmldata.="<div class='col-sm-3'><div class='item'><a href='".$k['link']."'>".$k['label']."</a></div></div>";
}
echo $htmldata."</div>";
?>
<?php $this->load->view('members/city_from_to_links.php') ?>