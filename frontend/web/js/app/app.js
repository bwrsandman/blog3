'use strict';

var lang = 'ru';
/*
 angular.module('MapApp', ['ui.router', 'ui.bootstrap', 'pascalprecht.translate']).value('lang', lang);

 angular.module('MapApp').config(['$translateProvider', function($translateProvider) {
 // add translation table
 $translateProvider.translations(translations);
 }]);

 angular.module('MapApp').config(['$locationProvider', function($locationProvider) {
 $locationProvider.html5Mode(true);
 }]);
 */

var translations = [];
//angular.bootstrap(document, ["personalmaps"]);

angular.module('MainApp', ['ngRoute', 'ui.bootstrap', 'monospaced.elastic', 'ngDebounce', 'ngResource']);

angular.module('MainApp').config(['msdElasticConfig', function (config) {
    config.append = '\n\n';
}]);

angular.module('MainApp').config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    var dir = '/js/app/main/views';

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

angular.module('MainApp').run(function ($rootScope, $templateCache) {
    $rootScope.$on('$viewContentLoaded', function () {
        $templateCache.removeAll();
    });
});

var showScreen = function () {
    $(document).ready(function () {
        var el = $('.first-load:first');
        el.remove();
    });
};
setTimeout(showScreen, 500);