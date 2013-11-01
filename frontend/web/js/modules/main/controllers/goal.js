'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $routeParams, $location, goalStorage, filterFilter, alertService) {

    var tplBase = '/js/modules/main/';
    $scope.tpl = {
      filters: tplBase + 'views/filters.html'
    };

    $scope.descriptionsToday = [];

    $scope.goals = [];
    $scope.goalDetail = {};

    if ($routeParams.id) {
        goalStorage.getDetail($routeParams.id, function (data) {
            $scope.goalDetail = data;
        });
    }

    goalStorage.get(function (data) {
        $scope.goals = data;
    });

    $scope.$watch('goals', function (newValue, oldValue) {
        $scope.remainingCount = filterFilter($scope.goals, { completed: false }).length;
        $scope.completedCount = $scope.goals.length - $scope.remainingCount;
        $scope.allChecked = !$scope.remainingCount;
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

    showScreen();
});

angular.module('MainApp').directive('goalList', function () {
    return {
        restrict: 'E',
        scope: true,
        templateUrl: '/js/modules/main/views/goal_list.html'
    };
});
