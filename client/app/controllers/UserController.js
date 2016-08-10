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
    $scope.name = ($window.localStorage.username !== undefined) ? $window.localStorage.username : 'Гость'
});
app.controller('LoginCtrl', function($scope, User, $window, $location) {
    $scope.login = function () {
        User.login($scope.data, function (data, req) {
            $window.localStorage.access_key = data.access_token;
            $window.localStorage.username = $scope.data.username;
            $location.path('/client/').replace();
        })
    }
});
app.controller('RegisterCtrl', function($scope, User) {
    $scope.register = function () {

        if($scope.data.password == $scope.data.cpassword) {
            console.log($scope.data);
            User.register($scope.data, function (data, req) {
                $window.localStorage.username = $scope.data.username;
            })
        }
    }
});
app.controller('ProfileCtrl', function ($scope, User) {
    $scope.avatar = 'http://juicypuzzles.ru/public/puzzles/8/6/86ead7934ae466683a176c2d43eb36ad2.jpg'
    $scope.edit = function () {
        console.log($scope.data);
        User.edit($scope.data, function (data, req) {
            console.log(data);
        })
    }
    $scope.upload = function () {
        console.log($scope.avatarFile);
    }
});