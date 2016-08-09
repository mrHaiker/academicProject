'use strict';

app.config(function ($routeProvider) {
    $routeProvider.when('/', {
        controller: 'IndexCtrl',
        templateUrl: 'views/index.html'
    })
})
app.controller('IndexCtrl', function ($scope) {

})