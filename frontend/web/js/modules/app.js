'use strict';

var lang = 'ru';

angular.module('MapApp', ['ui.router', 'ui.bootstrap', 'pascalprecht.translate']).value('lang', lang);

angular.module('MapApp').config(['$translateProvider', function($translateProvider) {
    // add translation table
    $translateProvider.translations(translations);
}]);

angular.module('MapApp').config(['$locationProvider', function($locationProvider) {
    $locationProvider.html5Mode(true);
}]);

angular.module('MapApp').config(function($stateProvider, $urlRouterProvider){

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

angular.module('MainApp', ['ui.router', 'ui.bootstrap', 'MapApp']);
