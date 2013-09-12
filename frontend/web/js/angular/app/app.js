'use strict';

var lang = 'ru';

var app = angular.module('personalmaps', ['ui.bootstrap', 'pascalprecht.translate']).value('lang', lang);

app.config(['$translateProvider', function($translateProvider) {
    // add translation table
    $translateProvider.translations(translations);
}]);

app.config(['$routeProvider', function($routeProvider) {
    $routeProvider.when('/list', {
        templateUrl: 'js/angular/app/partials/list.html',
        controller: 'PlacesListController'
    });
    $routeProvider.when('/add', {
        templateUrl: 'js/angular/app/partials/form.html',
        controller: 'PlacesFormController'
    });
    $routeProvider.when('/edit/:placeId', {
        templateUrl: 'js/angular/app/partials/form.html',
        controller: 'PlacesFormController'
    });
    $routeProvider.otherwise({
        redirectTo: '/list'
    });
}]);

var translations = [];
//angular.bootstrap(document, ["personalmaps"]);