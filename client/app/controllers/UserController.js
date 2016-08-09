'use strict';

app.config(function($routeProvider) {
    $routeProvider
        .when('/user', {
            controller: 'UserCtrl',
            templateUrl: 'views/user/index.html'
        })
        .when('/user/register', {
            controller: 'RegisterCtrl',
            templateUrl: 'views/user/register.html'
        })
        .when('/user/login', {
            controller: 'LoginCtrl',
            templateUrl: 'views/user/login.html'
        })
});

app.controller('UserCtrl', function($scope, $window) {
    $scope.logined = $window.localStorage.access_key ? true : false;

});
app.controller('LoginCtrl', function($scope, User, $window, $location) {
    $scope.data = {};
    $scope.login = function () {
        User.login($scope.data, function (data, req) {
            console.log(req);
            console.info(data);
            $window.localStorage.access_key = data.access_token;
            $location.path('/client/').replace();
        })
    }
});
app.controller('RegisterCtrl', function($scope, User) {
    $scope.register = function () {

        if($scope.data.password == $scope.data.cpassword) {
            console.log($scope.data);
            User.register($scope.data, function (data, req) {
                console.info(data);
            })
        }
    }
});