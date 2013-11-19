'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $resource, $routeParams, $location, filterFilter, alertService, $debounce, $templateCache) {

    var Goal = $resource('/goal/:id', {id: '@id'});

    function clearCache() {
        $templateCache.removeAll();
    }

    var tplBase = '/js/app/main/';
    $scope.tpl = {
        filters: tplBase + 'views/filters.html',
        goals: tplBase + 'views/goals.html'
    };

    $scope.keys = [];

    $scope.goalsCount = function () {
        //TODO: evaluate to much times
        return $scope.keys.length;
    };

    $scope.isReady = false;

    $scope.pageIsReady = function () {
        return $scope.isReady;
    };

    $scope.goals = Goal.query(function (data) {
        angular.forEach($scope.goals, function(val, key) {
            $scope.keys.push(key);
        });
    });

    $scope.$on('goal.change', function (e, goal) {
        if (goal instanceof Goal) {
            goal.$save();
        }
    });

    if ($location.path() === '') {
        $location.path('/');
    }

    if ($location.path() === '/') {
        $scope.reportModelName = 'reportToday';
    } else if ($location.path() === '/yesterday') {
        $scope.reportModelName = 'reportYesterday';
    }

    $scope.location = $location;

    showScreen();
});

angular.module('MainApp').directive('goalDetail', function ($debounce) {
    return {
        restrict: 'E',
        scope: {
            goal: '=',
            submodel: '='
        },
        templateUrl: '/js/app/main/views/goal_detail.html',
        controller: function ($scope, $element) {
            $scope.model = {
                description: ''
            };

            var autoSave = function () {
                $scope.goal[$scope.submodel].description = $scope.model.description;
                $scope.$emit('goal.change', $scope.goal);
            };

            $scope.$watch("model.description", $debounce(autoSave, 1000), true);
        },
        link: function ($scope, element, attrs) {
            if (!$scope.goal) {
                element.remove();
            }

            $scope.model.description = $scope.goal[$scope.submodel].description;
        }
    };
});
