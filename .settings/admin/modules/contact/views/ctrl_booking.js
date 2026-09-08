//blank line is required
app.controller('ctrl_booking',function($scope,$http){
	$http.get('login/check_valid_session').success (function(data) {if(data!=1){window.location.assign('<?=site_url("login")?>');}});
	
	$scope.loader=function(){
		$http.get("contact/view_booking").success(function(data){
			$scope.datadb=data;
		})
	}
	$scope.loader();
	
	$scope.update_call=function(y){
		$scope.x=y;
	}
	
});