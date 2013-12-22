'use strict';

angular.module('eg.goal').controller('GoalCtrl', function ($q, $http, $scope, $resource, $routeParams, $location, $modal, $rootScope) {

//    var UserSocket = $socketResource('user', {}, {
//        getData: {
//            url: 'api/v1/user',
//            isArray: true,
//            params: {
//                fullData: true
//            }
//        }
//    });

    var User = $resource('/api/v1/user/', {}, {
        getData: {
            method: 'GET',
            params: {
                fullData: true
            }
        }
    });
    var Goal = $resource('/api/v1/goal/:id', {id: '@id'});
    var Category = $resource('/api/v1/goalCategory/:id', {id: '@id'});
    var Conclusion = $resource('/api/v1/conclusion/:id', {id: '@id'});

    var tplBase = '/js/app/goal/';
    $scope.tpl = {
        modal: {
            edit: tplBase + 'views/modal/edit.html',
            backLog: tplBase + 'views/modal/back_log.html'
        },
        grid: tplBase + 'views/goal_grid.html',
        goals: tplBase + 'views/goals.html',
        sidebar: tplBase + 'views/sidebar.html'
    };

    $scope.keys = [];
    $scope.goals = [];
    $scope.categories = [];
    $scope.goalToCategory = [];
    $scope.focusGoal = false;
    $scope.setFocus = function (goal) {
        $scope.focusGoal = goal;
    };
    $scope.conclusions = [];
    $scope.defaultPlaceholder = 'Сделано';

    User.getData(function (response) {

        angular.forEach(response.categories, function (val) {
            $scope.categories.push(new Category(val));
        });

        angular.forEach(response.goals, function (val) {
            var goal = new Goal(val);
            $scope.goals.push(goal);
            $scope.keys.push(goal.id);
        });

        angular.forEach(response.conclusions, function (val, key) {
            $scope.conclusions[key] = new Conclusion(val);
        });

    });

//    UserSocket.$getData(function (response) {
//
//        angular.forEach(response.goals, function (val, key) {
//            $scope.goals[key] = new Goal(val);
//            $scope.keys.push(key);
//        });
//
//        angular.forEach(response.conclusions, function (val, key) {
//            $scope.conclusions[key] = new Conclusion(val);
//        });
//    });

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
    $scope.openModal = function (goal) {
        $modal.open({
            templateUrl: $scope.tpl.modal.edit,
            controller: 'GoalEditModalCtrl',
            resolve: {
                params: function () {
                    return {
                        goal: {
                            id: goal.id,
                            title: goal.title,
                            fk_goal_category: goal.fk_goal_category
                        },
                        categories: $scope.categories,
                        html: {
                            modalClass: 'goal-edit-modal'
                        }
                    }
                }
            }
        }).result.then(function (newGoal) {
                goal.title = newGoal.title;
                goal.fk_goal_category = newGoal.fk_goal_category;
                goal.$save();
            }, function () {
                //just dismiss
            });
    };

    $scope.addGoal = function (category) {
        $modal.open({
                templateUrl: $scope.tpl.modal.edit,
                controller: 'GoalEditModalCtrl',
                resolve: {
                    'params': function () {
                        return {
                            goal: {
                                fk_goal_category: category.id
                            },
                            categories: $scope.categories,
                            html: {
                                modalClass: 'goal-add-modal'
                            }
                        }
                    }
                }
            }
        ).
            result.then(function (newGoal) {
//                console.log(newGoal)
                var goal = new Goal(newGoal);
                goal.$save();
                $scope.goals.push(goal);
                $scope.keys.push(goal.id);
            }, function () {
                //just dismiss
            });
    };

    $scope.showBackLog = function (category) {
        $modal.open({
                templateUrl: $scope.tpl.modal.backLog,
                controller: 'BacklogModalCtrl',
                resolve: {
                    'params': function () {
                        return {
                            category: category,
                            goals: $scope.goals,
                            html: {
                                modalClass: 'goal-back-log-modal'
                            }
                        }
                    }
                }
            }
        );
    };

    $scope.complete = function(goal) {
        goal.completed = 1;
        goal.$save();
    };
    showScreen();
});

angular.module('eg.goal').controller('GoalEditModalCtrl', function ($scope, $modalInstance, params) {

    $scope.goal = params.goal;
    $scope.categories = params.categories;
    $scope.html = params.html;

    $scope.ok = function () {
        $modalInstance.close(params.goal);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});


angular.module('eg.goal').controller('BacklogModalCtrl', function ($scope, $modalInstance, params) {

    $scope.goals = params.goals;
    $scope.category = params.category;
    $scope.html = params.html;

    $scope.ok = function () {
        $modalInstance.close(params.goal);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
