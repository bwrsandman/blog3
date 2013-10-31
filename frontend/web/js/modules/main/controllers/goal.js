'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $routeParams, $location, goalStorage, filterFilter, alertService) {

    var tplBase = '/js/modules/main/';
    $scope.tpl = {
      filters: tplBase + 'views/filters.html'
    };

    if ($routeParams.id) {
        goalStorage.getDetail($routeParams.id, function (data) {
            $scope.goalDetail = data;
        });
    }


    goalStorage.get(function (data) {
        showScreen();

        $scope.todos = data;

        $scope.newTodo = '';
        $scope.editedTodo = null;

        $scope.$watch('todos', function (newValue, oldValue) {
            $scope.remainingCount = filterFilter($scope.todos, { completed: false }).length;
            $scope.completedCount = $scope.todos.length - $scope.remainingCount;
            $scope.allChecked = !$scope.remainingCount;
        }, true);


        if ($location.path() === '') {
            $location.path('/');
        }

        $scope.location = $location;

        $scope.searchFilter = function() {}

        $scope.$watch('location.path()', function (path) {
            $scope.statusFilter = (path === '/active') ?
            { completed: false } : (path === '/completed') ?
            { completed: true } : null;
        });

        $scope.editTodo = function (todo) {

            $scope.editedTodo = todo;
            // Clone the original todo to restore it on demand.
            $scope.originalTodo = angular.extend({}, todo);
        };

        $scope.onEditing = function (todo) {
            $scope.editedTodo = null;
            todo.title = todo.title.trim();
            if (!todo.title) {
                $scope.removeTodo(todo);
            } else {
                goalStorage.edit(todo, function (data) {
                    //TODO: what?
                });
            }
        };

        $scope.revertEditing = function (todo) {
            $scope.todos[$scope.todos.indexOf(todo)] = $scope.originalTodo;
            $scope.onEditing($scope.originalTodo);
        };

        $scope.removeTodo = function (todo) {
            goalStorage.delete(todo, function (data) {
                $scope.todos.splice($scope.todos.indexOf(todo), 1);
            });
        };

        $scope.clearCompletedTodos = function () {
            $scope.todos = $scope.todos.filter(function (val) {
                return !val.completed;
            });
        };

    });


});
