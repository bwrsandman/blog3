'use strict';

angular.module('eg.goal').controller('GoalCtrl', function ($q, $http, $scope, $resource, $routeParams, $location, $modal, $rootScope, $socketResource) {

    var UserSocket = $socketResource('user', {}, {
        getData: {
            url: 'api/v1/user',
            isArray: true,
            params: {
                fullData: true
            }
        }
    });

    var User = $resource('/api/v1/user/', {}, {
        getData: {
            method: 'GET',
            params: {
                fullData: true
            }
        }
    });
    var User = $resource('/api/v1/user/', {}, {
        getData: {
            method: 'GET',
            params: {
                fullData: true
            }
        }
    });
    var Goal = $resource('/api/v1/goal/:id', {id: '@id'});
    var Conclusion = $resource('/api/v1/conclusion/:id', {id: '@id'});

    var tplBase = '/js/app/goal/';
    $scope.tpl = {
        modal: tplBase + 'views/goal_modal.html',
        grid: tplBase + 'views/goal_grid.html',
        goals: tplBase + 'views/goals.html',
        sidebar: tplBase + 'views/sidebar.html'
    };

    $scope.keys = [];
    $scope.goals = [];
    $scope.focusGoal = false;
    $scope.setFocus = function(goal) {
        $scope.focusGoal = $scope.goals.indexOf(goal);
    };
    $scope.conclusions = [];
    $scope.isReady = false;
    $scope.defaultPlaceholder = 'Сделано';

//    User.getData(function (response) {
//        angular.forEach(response.goals, function (val, key) {
//            $scope.goals[key] = new Goal(val);
//            $scope.keys.push(key);
//        });
//
//        angular.forEach(response.conclusions, function (val, key) {
//            $scope.conclusions[key] = new Conclusion(val);
//        });
//    });

    UserSocket.$getData(function (response) {
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
    $scope.openModal = function(goal) {
        $modal.open({
            templateUrl: $scope.tpl.modal,
            controller: 'GoalEditModalCtrl',
            resolve: {
                'goal': function() {
                    return {
                        title: goal.title
                    }
                }
            }
        }).result.then(function(newGoal) {
            goal.title = newGoal.title;
            goal.$save();
        }, function() {
           //just dismiss
        });
    };

    showScreen();
});

angular.module('eg.goal').controller('GoalEditModalCtrl', function ($scope, $modalInstance, goal) {

    $scope.goal = goal;

    $scope.ok = function () {
        $modalInstance.close(goal);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});

