<div class="heading">
	<ol class="breadcrumb">
		<li><a href="#/">Dashboard</a></li>
		<li><a href="javascript:void(0)">Bookings</a></li>
	</ol>
</div>
<div class="col-sm-12">
    <div class="table_horizontal">
		<div class="input-group custom_addon">
            <div class="input-group-addon" style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i>
            </div>
			<input type="text" ng-model="search_text" placeholder="Search here...">
		</div>
	</div>
        <div class="col-sm-12 cards" dir-paginate="y in datadb | filter: search_text | orderBy:'-id' | itemsPerPage: 15" pagination-id="booking">
        	<div class="row">
        		<div class="col-sm-4">
        			<h5><b>{{y.mfrom}}</b> - <strong>{{y.mto}}</strong></h5>
        			
        			 <small>{{y.email}}</small>
        		</div>
        		<div class="col-sm-8">
        			<b>{{y.name}}</b> | <a href="tel:{{y.phone}}"><i class="fa fa-phone"></i> {{y.phone}}</a><br>
        			<q>{{y.msg}}</q>
        			<small><i class="fa fa-clock-o"></i> {{y.timestamp}}</small>
        		</div>
        	</div>
        </div>
        
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true"pagination-id="booking" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>
   <style>
   .cards{background-image: linear-gradient(120deg, #fdfbfb 0%, #d2f0ff 100%);margin:5px 0px;padding:5px auto;
    box-shadow: 1px 2px 8px 0px #dbdbdb;}
    .cards h5{line-height: 1px;}
   .cards b{color: #9c7e04}
   .cards h5 b{color: #0082ad}
   .cards q{font-weight:bold}
   .cards h5 strong{color: #00a200}
   #hoeapp-wrapper {background: #ffffff;}
   </style>