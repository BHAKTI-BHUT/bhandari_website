<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Shipment Tracking</a></li>
	</ol>
</div>

<div class="col-sm-12 well">
	<div class="col-sm-5">
		<form name="form1" id="form1" method="post" action="" autocomplete="off">
			<input name="id" ng-model="x.id" hidden>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Shipment ID</label>
			</div>
			<div class="col-sm-10">
				<select name="sh_id" class="form-control" ng-model="x.sh_id" required>
					<option value="">--Select Type--</option>
					<option ng-repeat="s in ship_main" value="{{s.id}}">{{s.c_name}} #{{s.id}}</option>
				</select>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-2">
				<label>Shipment Type</label>
			</div>
			<div class="col-sm-10">
				<select name="type" class="form-control" ng-model="x.type" required>
					<option value="">--Select Type--</option>
					<option value="1">Processing</option>
					<option value="2">On Transit</option>
					<option value="3">Shipped</option>
					<option value="4">Completed</option>
				</select>
			</div>

			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Date</label>
			</div>
			<div class="col-sm-10">
				<input name="date" class="form-control" ng-model="x.date" id="DOB1" required>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Time</label>
			</div>
			<div class="col-sm-10">
				<input name="time" class="form-control" ng-model="x.time">
				<!-- <input type="text" data-ng-model="timeInput" time-pick="HH:MM:SS" time-default="'08:00:00'"> -->
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-2 ">
				<label>Place</label>
			</div>
			<div class="col-sm-10">
				<input name="place" class="form-control" ng-model="x.place">
			</div>

			<div class="clearfix"></div>

			<div class="col-sm-2 ">
				<label>Remarks</label>
			</div>
			<div class="col-sm-10">

				<!-- <summernote config="options" ng-model="x.description"></summernote> -->
				<textarea name="remarks" class="form-control" ng-model="x.remarks"></textarea>
			</div>

			<div class="col-sm-12">
				<!-- <div id="webprogress" style="display: none">
					<img src="/assets/images/progress/load1.gif">
				</div> -->
				<button type="submit" id="submitbtn" accesskey="s" ng-click="save_data(x)" class="btn btn-info" ng-disabled="form1.$invalid">
					<u><b>S</b></u>ave
				</button>
				<a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>lear</a>
				<br>
				<br>
			</div>
		</form>
	</div>

	<?php include 'data.php'; ?>

</div>
<style>
	.form-check {
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