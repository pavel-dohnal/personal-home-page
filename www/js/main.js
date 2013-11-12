function LoginCtrl($scope) {
	$scope.signinVisible = true;

	$scope.showSignIn = function () {
		$scope.signinVisible = true;
	}

	$scope.showSignUp = function () {
		$scope.signinVisible = false;
	}
}