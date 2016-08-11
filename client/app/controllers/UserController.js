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

app.controller('UserCtrl', function($scope, $window, _authorized) {
    $scope.login = _authorized.isLogin()
    $scope.name = _authorized.getName()
    $scope.logout = function () {
        $window.localStorage.clear()
        $window.location.reload()
    }
});

app.controller('LoginCtrl', function($scope, User, $window, $location) {
    $scope.login = function () {
        User.login($scope.data, function (data, req) {
            $window.localStorage.access_key = data.access_token
            $window.localStorage.username = $scope.data.username
            $location.path('/client/app/')
            $window.location.reload()
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

app.controller('ProfileCtrl', function ($scope, Profile, $window, $location) {
    $scope.data = {}
    $scope.avatar = ''
    $scope.test = 'test'
    $scope.access_token = `{"Authorization": "Bearer ${$window.localStorage.access_key}"}`

    $scope.getProfile = function () {
        Profile.query(function (data) {
            $scope.data = data[0]
            $scope.avatar = `/server/web/images/avatars/${data[0].avatar}-mid.jpg`
        })
    }
    $scope.getProfile();
    $scope.edit = function () {
        Profile.edit($scope.data, function (data, req) {
        })
    }
    var upload = document.querySelector('vaadin-upload');
    upload.addEventListener('upload-before', function(e) {
        e.detail.file.uploadTarget = serviceBase + 'identity/upload';
    });
    upload.addEventListener('upload-success', function(e) {
        $scope.getProfile();
    });
});

app.controller('ProductCtrl', function ($scope, Product, $location) {
    $scope.addNewElement = function () {
        console.log($scope.item);
        Product.create($scope.item, function (data, req) {
            $location.path('/client/app/')
            // $window.location.reload()
        })
    }
})