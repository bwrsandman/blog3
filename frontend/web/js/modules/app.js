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

angular.module('MainApp', ['ui.router', 'ui.bootstrap', 'monospaced.elastic']);

angular.module('MainApp').config(['msdElasticConfig', function (config) {
    config.append = '\n\n';
}]);

angular.module('MainApp').config(['$routeProvider', '$locationProvider', function ($routeProvider, $locationProvider) {

    var dir = '/js/modules/main/views';

    $routeProvider
        .when('/', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'})
        .when('/active', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'})
        .when('/goal/:id', {templateUrl: dir + '/goals.html', controller: 'GoalCtrl'});

    $locationProvider
        .html5Mode(true)
        .hashPrefix('!');

//    $urlRouterProvider.otherwise({
//        redirectTo: '/list'
//    });
}]);

var showScreen = function () {
    $(document).ready(function () {
        var el = $('.first-load:first');
        el.remove();
    });
};
setTimeout(showScreen, 500);