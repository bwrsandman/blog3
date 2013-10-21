'use strict';

angular.module('MainApp').controller('RootCtl'
    , ['$scope', '$rootScope', '$routeParams', '$location', 'alertService'
        , function ($scope, $rootScope, $routeParams, $location, alertService) {

            $rootScope.changeView = function (view) {
                $location.path(view);
            }

            // root binding for alertService
            $rootScope.closeAlert = alertService.closeAlert;
        }]);