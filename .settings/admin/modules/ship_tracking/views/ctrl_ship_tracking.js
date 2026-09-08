//blank line is required
app.controller('ctrl_ship_tracking',function($scope,$http){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});
	
	$scope.loader=function(){
		$http.get("ship_tracking/view_data").success(function(data){
			
			$scope.datadb=data;
		})
	}
	$http.get("ship_main/view_data").success(function(data) {
		$scope.ship_main = data;
	})
	 $('#DOB1').datepicker();
	
	$scope.loader();
	
	$scope.update_call=function(y){
		$scope.x=y;
	}
	
	$scope.filter_new=function(){
		$scope.x={};
		document.getElementById('image').value='';
	}
	
	$scope.options = {
		    height: 100,
		    toolbar: [
		               ['style', ['style','bold', 'italic', 'underline']],
      		           ['fontname', ['fontname']],
      		           ['fontsize', ['fontsize']],
      		           ['color', ['color']],
      		           ['table',['table']],
      		           [ 'insert', [ 'link' ]],
      	               ["view", ["codeview"]]
		        ]
		  };
	
	
	$scope.save_data=function(y){
		$('#form1').ajaxForm({
			type: "POST",
			url: "ship_tracking/save_data",
			beforeSend: function()
			{
				$('#submitbtn').attr('disabled',true);
				$('#webprogress').css('display','inline');
			},
			success: function(data){
				console.log(data);
				if(data=="1")
				{
					$scope.loader();
					messages("success", "Success!","Shipment tracking details Saved Successfully", 3000);
					$scope.filter_new();
					document.getElementById('image').value='';
				}
				else if(data=="0")
				{
					messages("warning", "Info!","No Data Affected", 3000);
				}
				else
				{
					messages("danger", "Warning!",data, 4000);
				}
				$('#webprogress').css('display','none');
				$('#submitbtn').attr('disabled',false);
			}
		});
	}
	$scope.delete_data=function(id)
	{
		if(confirm("Deleting Shipment tracking details may hamper your data associated with it."))
		{
			if(confirm("Are you Sure to DELETE ??"))
			{
				$http.get("ship_tracking/delete_data?id="+id).success(function(data){
					console.log(data);
					if(data=="1")
					{
						messages("success", "Success!","Shipment tracking details Deleted Successfully", 3000);
					}
					else
					{
						messages("danger", "Warning!","Shipment tracking details not Deleted", 4000);
					}
					$scope.loader();
				})
			}
		}
	}
	
});