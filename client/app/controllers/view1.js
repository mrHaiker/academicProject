'use strict';

app.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/view1', {
    templateUrl: 'views/view1.html',
    controller: 'View1Ctrl'
  });
}]);

app.controller('View1Ctrl', [function() {

}]);