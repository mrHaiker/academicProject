'use strict';

app.config(function ($stateProvider) {
    $stateProvider
        .state('index', {
            url: '/',
            templateUrl: 'views/index.html',
            controller: 'IndexCtrl',
            ncyBreadcrumb: {
                label: 'Home'
            }
        })
})

app.controller('IndexCtrl', function ($scope) {

})