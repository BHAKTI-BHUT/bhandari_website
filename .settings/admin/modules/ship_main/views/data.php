
 <div class="col-sm-7">
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
						<th>G.R. No</th>
						<th>Customer Name</th>
						<th>Shipment From</th>
						<th>Shipment To</th>   
						<th>Driver No</th>
						<th>Vendor No</th>       
                        <th>Date</th>
						<th style="width:85px">Action</th>
					</tr>
				</thead>
				<tbody>
					<tr dir-paginate="y in datadb | filter: search_text | itemsPerPage: 10" >
						<th>{{y.gr_no}}</th>
						<td>{{y.c_name}}</td>
						<td>{{y.ship_from}}</td>
						<td>{{y.ship_to}}</td>
						<td>{{y.driver_no}}</td>
						<td>{{y.vendor_no}}</td>
						<td>{{y.date}}</td>
						
						<td>
						  <a href="javascript:void(0)" ng-click="update_call(y)" data-toggle="modal" data-target=".bs-example-modal-sm">
    						<span class="fa fa-pencil fa-2x"></span></a>
    						&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" style="color:red" ng-click="delete_data(y.id)">
    						<span class="fa fa-trash fa-2x"></span></a>               
						</td>
					</tr>
				</tbody>
			</table>
        </div>
        <div class="col-sm-12">
            <dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="app/pagination"></dir-pagination-controls>
        </div>
   </div>