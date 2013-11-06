'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $routeParams, $location, goalStorage, filterFilter, alertService, $debounce) {

    var tplBase = '/js/modules/main/';
    $scope.tpl = {
        filters: tplBase + 'views/filters.html'
    };

    $scope.goals = [];
    $scope.goals.range = function (size) {
        var range = [];
        for (var i = 0; i < $scope.goals.length; i = i + size) {
            range.push(i);
        }
        return range;
    }
    $scope.goalDetail = {};

    if ($routeParams.id) {
        goalStorage.getDetail($routeParams.id, function (data) {
            $scope.goalDetail = data;
        });
    }

    goalStorage.get(function (data) {
        $scope.goals = data;
    });

    function saveList() {

    }

    $scope.$watch('goals', $debounce(saveList, 1000), true);

    if ($location.path() === '') {
        $location.path('/');
    }

    $scope.location = $location;

    $scope.$watch('location.path()', function (path) {
        $scope.statusFilter = (path === '/active') ?
        { completed: false } : (path === '/completed') ?
        { completed: true } : null;
    });

    showScreen();
});

angular.module('MainApp').directive('goalDetail', function () {
    return {
        restrict: 'A',
        scope: {
            goal: '='
        },
        templateUrl: '/js/modules/main/views/goal_detail.html'
    };
});

angular.module('MainApp').directive('goalDetail', function (goalStorage, $debounce) {
    return {
        restrict: 'A',
        scope: {
            goal: '='
        },
        templateUrl: '/js/modules/main/views/goal_detail.html',
        link: function(scope, element, attrs) {
            var autoSave = function () {
                goalStorage.edit(scope.goal);
            };
            scope.$watch('goal', $debounce(autoSave, 1000), true );
        }
    };
});
