define(['./module'], function (controllers) {
	'use strict';
	controllers.controller('LoginCtrl', ['$scope',
	function (scope) {
		scope.signinVisible = true;

		scope.showSignIn = function () {
			scope.signinVisible = true;
		}

		scope.showSignUp = function () {
			scope.signinVisible = false;
		}
	}]);
});