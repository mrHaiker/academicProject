'use strict';

app.config(function ($routeProvider) {
    $routeProvider.when('/', {
        controller: 'IndexCtrl',
        templateUrl: 'views/index.html'
    })
})
app.controller('MainCtrl', function ($scope, $window) {
})
app.controller('IndexCtrl', function ($scope, $window) {
})