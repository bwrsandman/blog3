'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $routeParams, $location, goalStorage, filterFilter, alertService, $debounce) {

    var tplBase = '/js/modules/main/';
    $scope.tpl = {
        filters: tplBase + 'views/filters.html'
    };

    $scope.goals = {};

    $scope.goalsCount = function() {
        //TODO: evaluate to much times
        return Object.keys($scope.goals).length;
    };

    goalStorage.get(function (data) {
        $scope.goals = data;
    });

    if ($location.path() === '') {
        $location.path('/');
    }

    $scope.location = $location;

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
//                goalStorage.edit(scope.goal);
            };
            scope.$watch('goal', $debounce(autoSave, 1000), true );
        }
    };
});
