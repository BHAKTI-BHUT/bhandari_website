
 <div class="col-sm-6">
    <div class="table_horizontal">
		<div class="input-group custom_addon">
            <div class="input-group-addon"  style="box-shadow:none; -webkit-box-shadow:none;"><i class="fa fa-search"></i></div>
				<input type="text" ng-model="search_text" placeholder="Search here...">
			</div>
		</div>
		<div class="table-data">
			<table class="table table-hover">
				<thead>
					<tr class="active">
						<th class="text-center">title</th>
						<th class="text-center">Date</th>
						<th class="text-center">Time</th>
                        <th class="text-center">Author</th>
                        <th class="text-center">Image</th>
						<th class="text-center" style="width:85px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 3" >
						<td>{{y.title}}</td>
						<td>{{y.date}}</td>
						<td>{{y.time}}</td>
						<td>{{y.author}}</td>
						
						<div class="col-sm-3" ng-show="x.image">
						<td class="img-responsive">
						<img ng-if="y.image" ng-src="<?=base_url()?>assets/uploads/blog/thumb/{{y.image}}" style="height: 50px">
						<img ng-if="y.url_type=='1'" ng-src="{{y.image}}"style="height: 50px">
						<img ng-if="!y.image" src="<?=base_url()?>assets/images/no-img.png"style="height: 50px">
						</td>
					</div>
						
						<td>
						  <a href="javascript:void(0)" ng-click="update_call(y)" data-toggle="modal" data-target=".bs-example-modal-sm">
    						<span class="fa fa-pencil fa-2x"></span></a>
    						&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" ng-click="delete_data(y.b_id)">
    						<span class="fa fa-trash"></span></a>               
						</td>
					</tr>
				</tbody>
			</table>
        </div>
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>