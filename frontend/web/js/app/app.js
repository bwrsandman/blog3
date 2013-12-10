'use strict';

var lang = 'ru';
/*
 angular.module('MapApp', ['ui.router', 'ui.bootstrap', 'pascalprecht.translate']).value('lang', lang);

 angular.module('MapApp').config(['$translateProvider', function($translateProvider) {
 // add translation table
 $translateProvider.translations(translations);
 }]);
 */

var translations = [];

angular.module('eg.goal', ['ngRoute', 'ui.bootstrap',  'monospaced.elastic', 'ngDebounce', 'ngResource', 'textAngular']);

angular.module('eg.goal').config(['msdElasticConfig', function (config) {
    config.append = '\n\n';
}]);

angular.module('eg.goal').config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    var dir = '/js/app/goal/views';

    $routeProvider
        .when('/', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'})
        .when('/yesterday', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'})
        .when('/active', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'})
        .when('/goal/:id', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'});

    $locationProvider
        .html5Mode(true)
        .hashPrefix('!');

//    $urlRouterProvider.otherwise({
//        redirectTo: '/'
//    });
}]);


angular.module('eg.goal').run(function ($rootScope, $templateCache) {
});

var showScreen = function () {
    $(document).ready(function () {
        var el = $('.first-load:first');
        el.remove();
    });
};
setTimeout(showScreen, 500);