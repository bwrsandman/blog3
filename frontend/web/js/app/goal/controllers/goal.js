'use strict';

angular.module('eg.goal').controller('GoalCtrl', function ($q, $http, $scope, $resource, $routeParams, $location, filterFilter, alertService, $debounce, $templateCache) {

    var User = $resource('/api/user/', {}, {
        getData: {
            method: 'GET',
            params: {
                fullData: true
            }
        }
    });
    var Goal = $resource('/api/goal/:id', {id: '@id'});
    var Conclusion = $resource('/api/conclusion/:id', {id: '@id'});

    var tplBase = '/js/app/goal/';
    $scope.tpl = {
        grid: tplBase + 'views/goal_grid.html',
        goals: tplBase + 'views/goals.html'
    };

    $scope.keys = [];
    $scope.goals = [];
    $scope.conclusions = [];
    $scope.isReady = false;
    $scope.defaultPlaceholder = 'Сделано';

    User.getData(function (response) {
        angular.forEach(response.goals, function (val, key) {
            $scope.goals[key] = new Goal(val);
            $scope.keys.push(key);
        });

        angular.forEach(response.conclusions, function (val, key) {
            $scope.conclusions[key] = new Conclusion(val);
        });
    });

    $scope.save = function (model) {
        if (model instanceof Goal) {
            model.$save();
        } else if (model instanceof Conclusion) {
            model.$save();
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

