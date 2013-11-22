'use strict';

angular.module('eg.goal').controller('GoalCtrl', function ($scope, $resource, $routeParams, $location, filterFilter, alertService, $debounce, $templateCache) {

    var Goal = $resource('/api/goal/:id', {id: '@id'});

    var tplBase = '/js/app/goal/';
    $scope.tpl = {
        grid: tplBase + 'views/goal_grid.html',
        goals: tplBase + 'views/goals.html'
    };

    $scope.keys = [];
    $scope.isReady = false;
    $scope.defaultPlaceholder = 'Сделано';

    $scope.goals = Goal.query(function (data) {
        angular.forEach($scope.goals, function(val, key) {
            $scope.keys.push(key);
        });
    });

    $scope.save = function(goal) {
        if (goal instanceof Goal) {
            goal.$save();
        }
    };

    if ($location.path() === '/') {
        $scope.day = 'today';
    } else if ($location.path() === '/yesterday') {
        $scope.day = 'yesterday';
    }

    $scope.location = $location;

    showScreen();
});

