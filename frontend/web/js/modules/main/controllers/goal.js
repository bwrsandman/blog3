'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $location, goalStorage, filterFilter, alertService) {
    goalStorage.get(function (data) {
        showScreen();

        var todos = $scope.todos = data;

        $scope.newTodo = '';
        $scope.editedTodo = null;

        $scope.$watch('todos', function (newValue, oldValue) {
            $scope.remainingCount = filterFilter(todos, { completed: false }).length;
            $scope.completedCount = todos.length - $scope.remainingCount;
            $scope.allChecked = !$scope.remainingCount;
            if (newValue !== oldValue) { // This prevents unneeded calls to the local storage
                goalStorage.put(todos);
            }
        }, true);


        if ($location.path() === '') {
            $location.path('/');
        }

        $scope.location = $location;

        $scope.$watch('location.path()', function (path) {
            $scope.statusFilter = (path === '/active') ?
            { completed: false } : (path === '/completed') ?
            { completed: true } : null;
        });

        $scope.addTodo = function () {
            var newTodo = $scope.newTodo.trim();
            if (!newTodo.length) {
                return;
            }

            goalStorage.add({
                title: newTodo,
                completed: false
            }, function(data) {
                todos.push(data);
            });

            $scope.newTodo = '';
        };

        $scope.editTodo = function (todo) {
            $scope.editedTodo = todo;
            // Clone the original todo to restore it on demand.
            $scope.originalTodo = angular.extend({}, todo);
        };

        $scope.doneEditing = function (todo) {
            $scope.editedTodo = null;
            todo.title = todo.title.trim();

            if (!todo.title) {
                $scope.removeTodo(todo);
            }
        };

        $scope.revertEditing = function (todo) {
            todos[todos.indexOf(todo)] = $scope.originalTodo;
            $scope.doneEditing($scope.originalTodo);
        };

        $scope.removeTodo = function (todo) {
            goalStorage.delete(todo, function(data) {
                todos.splice(todos.indexOf(todo), 1);
            });

        };

        $scope.clearCompletedTodos = function () {
            $scope.todos = todos = todos.filter(function (val) {
                return !val.completed;
            });
        };

        $scope.markAll = function (completed) {
            todos.forEach(function (todo) {
                todo.completed = completed;
            });
        };
    });

});
