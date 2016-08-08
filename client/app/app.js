'use strict';

var serviceBase = 'http://saho.dev:3000/server/web/';

// Declare app level module which depends on views, and components
var app = angular.module('myApp', [
  'ngRoute',
  'ui.router',
  'ngResource',
  'ncy-angular-breadcrumb',
  'angular-loading-bar'
]);
app.config(['$locationProvider', '$routeProvider', '$urlRouterProvider', function($locationProvider, $routeProvider, $urlRouterProvider) {
  $locationProvider.html5Mode(true);

  $urlRouterProvider.otherwise('/')
}]);
