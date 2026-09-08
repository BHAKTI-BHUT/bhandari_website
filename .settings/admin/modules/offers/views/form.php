<div class="heading">
    <ol class="breadcrumb">
      <li><a href="#/">Dashboard</a></li>
      <li><a href="javascript:void(0)">Offers</a></li>
    </ol>
</div>

<div class="col-sm-12 well">
     <div class="col-sm-7">
         <form name="form1" id="form1" method="post" action="" autocomplete="off">
         	<input name="id" ng-model="x.id" hidden>

       	    <div class="col-sm-2 ">
                <label>Title</label>
            </div>
            <div class="col-sm-10">
            	<input type="text" name="title" ng-model="x.title" class="form-control" >
            </div>
            <div class="clearfix"></div>

            <div class="col-sm-2 ">
                <label id="pdate">Publishing Date</label>
            </div>
            <div class="col-sm-10">
            	<input  name="date" hidden  class="form-control" ng-model="x.date"  >
            </div>
            <div class="clearfix"></div>

            <div class="col-sm-2 ">
                <label id="edate">Offer End Date</label>
            </div>
            <div class="col-sm-10">
            	<input name="end_date" id="DOB2" ng-model="x.end_date" class="form-control" >
            </div>
            <div class="clearfix"></div>
<div class="col-sm-2 ">
                <label>Code</label>
            </div>
            <div class="col-sm-10">
            	<input type="text" name="code" ng-model="x.code" class="form-control" >
            </div>
    		<div class="col-sm-2">
                <label>Description</label>
            </div>
            <div class="col-sm-10">
              	 <summernote config="options" ng-model="x.details"></summernote>
                 <textarea name="details" ng-model="x.details" hidden></textarea>
            </div>
            <div class="clearfix"></div>
            <div class="col-sm-2 ">
                <label>Image</label>
            </div>
			<div class="col-sm-10">
                <input type="file" name="image" class="form-control">
                <input ng-model="x.image" name="old_image" hidden>
				<div class="col-sm-3" ng-show="x.image">
					<img src="<?=base_url("assets/uploads/offers/thumb")?>/{{x.image}}" class="img-responsive" style="width:100px;">
				</div>
            </div>

         	<div class="col-sm-2"></div>
            <div class="col-sm-10">
                <div id="webprogress" style="display: none">
            <img src="<?=base_url()?>/assets/images/progress/load1.gif">
                </div>
               <button type="submit" id="submitbtn" accesskey="s" ng-click="save_data(x)" class="btn btn-info"  ><u><b>S</b></u>ave</button>
               <a class="btn btn-default" accesskey="c" ng-click="filter_new()"><u><b>C</b></u>lear</a>
               <br><br>
            </div>

        </form>
    </div>
  <?php include 'data.php';?>
</div>
<style>
input[type='radio'] {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    outline: none;
    border: 3px solid gray;
}
input[type='radio']:before {
    content: '';
    display: block;
    width: 60%;
    height: 60%;
    margin: 20% auto;
    border-radius: 50%;
}
input[type="radio"]:checked:before {
    background: #5bc0de;

}
input[type="radio"]:checked {
    border-color:#5bc0de;
}
.parent {
    margin-right: 80px;
    margin-left: 20px;
    font-weight: normal;
}
.radio-gap{
    position:relative;
    left:3%!important;
}
</style>