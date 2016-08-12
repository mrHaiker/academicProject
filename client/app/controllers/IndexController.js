'use strict';

app.config(function ($routeProvider) {
    $routeProvider.when('/:page', {
        controller: 'IndexCtrl',
        templateUrl: 'views/index.html'
    })
})
app.controller('MainCtrl', function ($scope, $window, _authorized, $route) {
})
app.controller('IndexCtrl', function ($scope, $window, Product, $routeParams, $resource) {
    $scope.current = $routeParams.page;
    $scope.totalPage = 5;

    $scope.loadPage = function (page) {
        Product.query({page: page},function (data) {
            $scope.items = data;
        })
    }


    $scope.loadPage($scope.current || 1);

    $scope.getNumber = function(num) {
        return new Array(num);
    }
})