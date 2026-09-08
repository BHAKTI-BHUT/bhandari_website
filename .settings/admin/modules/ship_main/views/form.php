<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Shipment Orders</a></li>
	</ol>
</div>

<div class="col-sm-12 well">
	<div class="col-sm-5">
		<form name="form1" id="form1" method="post" action=""
			autocomplete="off">
			<input name="id" ng-model="x.id" hidden>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>G.R. no</label>
			</div>
			<div class="col-sm-10">
				<input name="gr_no" class="form-control" ng-model="x.gr_no" required>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Customer Name</label>
			</div>
			<div class="col-sm-10">
				<input name="c_name" class="form-control" ng-model="x.c_name" required>
			</div>
			
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Shipment From</label>
			</div>
			<div class="col-sm-10">
				<input name="ship_from" class="form-control" ng-model="x.ship_from" required>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Shipment From</label>
			</div>
			<div class="col-sm-10">
				<input name="ship_to" class="form-control" ng-model="x.ship_to" required>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Driver No.</label>
			</div>
			<div class="col-sm-10">
				<input name="driver_no" class="form-control" ng-model="x.driver_no" required>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Vendor No.</label>
			</div>
			<div class="col-sm-10">
				<input name="vendor_no" class="form-control" ng-model="x.vendor_no" required>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Date</label>
			</div>
			<div class="col-sm-10">
				<input name="date" class="form-control" ng-model="x.date" id="DOB1" >
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-12">
				<!-- <div id="webprogress" style="display: none">
					<img src="<?=base_url()?>/assets/images/progress/load1.gif">
				</div> -->
				<button type="submit" id="submitbtn" accesskey="s"
					ng-click="save_data(x)" class="btn btn-info"
					ng-disabled="form1.$invalid">
					<u><b>S</b></u>ave
				</button>
				<a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>lear</a>
				<br>
				<br>
			</div>
		</form>
	</div>
               
  <?php include 'data.php';?>
   
</div>
<style>
	.form-check{
	display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px double #fff;
    border-radius: 4px;
}

</style>