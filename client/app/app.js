'use strict';

var serviceBase = 'http://saho.dev:3000/server/web/';

// Declare app level module which depends on views, and components
var app = angular.module('myApp', [
  'ngRoute',
  'ngResource',
  'angular-loading-bar'
]);
app.config(function($httpProvider, $routeProvider, $locationProvider) {
  $locationProvider.html5Mode(true);

  $httpProvider.interceptors.push('AuthInterceptor');
  $routeProvider.otherwise('/');
});
