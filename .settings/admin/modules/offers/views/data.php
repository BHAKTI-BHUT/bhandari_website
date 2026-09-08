 <div class="col-sm-5">
    <div class="table_horizontal">
		<div class="input-group custom_addon">
            <div class="input-group-addon"  style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
				<input type="text" ng-model="search_text" placeholder="Search here...">
			</div>
		</div>
		<div class="table-data">
			<div class="table table-responsive">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th>Title</th>
						<th>End Date</th>
                        <th>Image</th>
						<th style="width:85px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 6" >
						<td>{{y.title}}</td>
						<td>{{y.end_date}}</td>
						<div class="col-sm-3" ng-show="x.image" >
							<td class="img-responsive"class="text-center">
        						<img ng-if="y.image" ng-src="<?=base_url()?>assets/uploads/offers/thumb/{{y.image}}" style="height: 50px" >
        						<img ng-if="!y.image"  style="height: 50px" ng-src="<?=base_url()?>assets/uploads/images.jpg">
    						</td>
						</div>
<!--<td>{{y.status}}</td> -->
						<td>
						  <a href="javascript:void(0)" ng-click="update_call(y)" data-toggle="modal" data-target=".bs-example-modal-sm">
    						<span class="fa fa-pencil fa-2x"></span>
    						</a>
    						&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" ng-click="delete_data(y.id)">
    						<span class="fa fa-trash"></span></a>
						</td>
					</tr>
				</tbody>
			</table>
			</div>
        </div>
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>