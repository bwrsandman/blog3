'use strict';

var lang = 'ru';

var app = angular.module('personalmaps', ['ui.bootstrap', 'pascalprecht.translate']).value('lang', lang);

app.config(['$translateProvider', function($translateProvider) {
    // add translation table
    $translateProvider.translations(translations);
}]);

app.config(['$locationProvider', function($locationProvider) {
    $locationProvider.html5Mode(true);
}]);

app.config(['$routeProvider', function($routeProvider) {

    var dir = 'js/angular/app/';
    $routeProvider.when('/', {
        templateUrl: dir + 'partials/list.html',
        controller: 'PlacesListController'
    });
    $routeProvider.when('/add', {
        templateUrl: dir + 'partials/form.html',
        controller: 'PlacesFormController'
    });
    $routeProvider.when('/edit/:placeId', {
        templateUrl: dir + 'partials/form.html',
        controller: 'PlacesFormController'
    });
    $routeProvider.otherwise({
        redirectTo: '/list'
    });
}]);

var translations = [];
//angular.bootstrap(document, ["personalmaps"]);