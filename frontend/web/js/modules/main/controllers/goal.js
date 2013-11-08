'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $routeParams, $location, goalStorage, filterFilter, alertService, $debounce, $templateCache) {
    function clearCache() {
        $templateCache.removeAll();
    }

    var tplBase = '/js/modules/main/';
    $scope.tpl = {
        filters: tplBase + 'views/filters.html',
        goals: tplBase + 'views/goals.html'
    };

    $scope.goals = {};
    $scope.keys= [];

    $scope.goalsCount = function() {
        //TODO: evaluate to much times
        return Object.keys($scope.goals).length;
    };

    goalStorage.get(function (data) {
        $scope.goals = data;
        $scope.keys = Object.keys(data);
    });

    if ($location.path() === '') {
        $location.path('/');
    }

    if ($location.path() === '/') {
        $scope.submodel = 'reportToday';
    }  else if ($location.path() === '/yesterday') {
        $scope.submodel = 'reportYesterday';
    }


    $scope.location = $location;

    showScreen();
});

angular.module('MainApp').directive('goalDetail', function (goalStorage, $debounce) {
    return {
        restrict: 'A',
        scope: {
            goal: '=',
            submodel: '='
        },
        templateUrl: '/js/modules/main/views/goal_detail.html',
        link: function(scope, element, attrs) {
            if (!scope.goal) {
                element.remove();
            }
            var autoSave = function () {
                goalStorage.edit(scope.goal);
            };
            scope.$watch('goal', $debounce(autoSave, 1000), true);
        }
    };
});
