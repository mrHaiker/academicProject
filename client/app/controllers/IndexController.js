'use strict';

app.config(function ($routeProvider) {
    $routeProvider.when('/', {
        controller: 'IndexCtrl',
        templateUrl: 'views/index.html'
    })
})
app.controller('MainCtrl', function ($scope, $window, _authorized, $route) {
})
app.controller('IndexCtrl', function ($scope, $window, Product) {
    Product.query(function (data) {
        $scope.items = data;
    })
})