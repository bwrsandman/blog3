'use strict';

var lang = 'ru';

var app = angular.module('personalmaps', ['ui.router', 'ui.bootstrap', 'pascalprecht.translate']).value('lang', lang);

app.config(['$translateProvider', function($translateProvider) {
    // add translation table
    $translateProvider.translations(translations);
}]);

app.config(['$locationProvider', function($locationProvider) {
    $locationProvider.html5Mode(true);
}]);

app.config(function($stateProvider, $urlRouterProvider){

    var dir = 'js/angular/app/';
    $stateProvider.state('/', {
        templateUrl: dir + 'partials/list.html',
        controller: 'PlacesListController'
    });
    $stateProvider.state('/add', {
        templateUrl: dir + 'partials/form.html',
        controller: 'PlacesFormController'
    });
    $stateProvider.state('/edit/:placeId', {
        templateUrl: dir + 'partials/form.html',
        controller: 'PlacesFormController'
    });
//    $urlRouterProvider.otherwise({
//        redirectTo: '/list'
//    });
});

var translations = [];
//angular.bootstrap(document, ["personalmaps"]);