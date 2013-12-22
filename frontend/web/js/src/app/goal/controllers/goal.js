'use strict';

angular.module('eg.goal').controller('GoalCtrl', function ($q, $http, $scope, $resource, $routeParams, $location, $modal, User, Category, Goal, Conclusion) {

    var tplBase = '/js/src/app/goal/';
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
    $scope.conclusions = [];

    User.get(function () {
        $scope.categories = Category.getAll();
        $scope.conclusions = Conclusion.getAll();
        $scope.goals = Goal.getAll();
    });

    $scope.focusGoal = false;
    $scope.setFocus = function (goal) {
        $scope.focusGoal = goal;
    };
    $scope.defaultPlaceholder = 'Сделано';

    $scope.save = function (model) {
        model.$save();
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
                            html: {
                                modalClass: 'goal-add-modal'
                            }
                        }
                    }
                }
            }
        ).result.then(function (newGoal) {
                Goal.add(newGoal);
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
                            html: {
                                modalClass: 'goal-back-log-modal'
                            }
                        }
                    }
                }
            }
        );
    };

    $scope.complete = function (goal) {
        goal.completed = 1;
        goal.$save();
    };

    showScreen();
});

angular.module('eg.goal').controller('GoalEditModalCtrl', function ($scope, $modalInstance, params, Category) {

    $scope.goal = params.goal;
    $scope.categories = Category.getAll();
    $scope.html = params.html;

    $scope.ok = function () {
        $modalInstance.close(params.goal);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});


angular.module('eg.goal').controller('BacklogModalCtrl', function ($scope, $modalInstance, params, Goal) {

    $scope.goals = Goal.getAll();
    $scope.category = params.category;
    $scope.html = params.html;

    $scope.openModal = function (goal) {
        console.log(goal)
    }
    $scope.ok = function () {
        $modalInstance.close(params.goal);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});
