'use strict';

app.config(['$routeProvider', '$stateProvider', function($routeProvider, $stateProvider) {
  $stateProvider
      .state('user', {
        url: '/user',
        templateUrl: 'views/user/index.html',
        controller: 'UserCtrl',
        ncyBreadcrumb: {
          label: 'User'
        }
      })
}]);

app.controller('UserCtrl', [function() {

}]);