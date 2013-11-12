'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $routeParams, $location, goalStorage, filterFilter, alertService, $debounce, $templateCache) {
    function clearCache() {
        $templateCache.removeAll();
    }

    var tplBase = '/js/app/main/';
    $scope.tpl = {
        filters: tplBase + 'views/filters.html',
        goals: tplBase + 'views/goals.html'
    };

    $scope.goals = {};
    $scope.keys = [];

    $scope.goalsCount = function() {
        //TODO: evaluate to much times
        return $scope.keys.length;
    };

    goalStorage.get(function (data) {
        $scope.goals = data;
        $scope.keys = Object.keys(data);

        var autoSave = function (newModel) {
            goalStorage.edit(newModel);
        };

        for (var i in $scope.goals) {
            $scope.$watch('goals['+i+']', $debounce(autoSave, 1000), true);
        }
    });

    if ($location.path() === '') {
        $location.path('/');
    }

    if ($location.path() === '/') {
        $scope.submodel = 'reportToday';
    }  else if ($location.path() === '/yesterday') {
        $scope.submodel = 'reportYesterday';
    }

    $scope.location = $location;

    showScreen();
});

angular.module('MainApp').directive('goalDetail', function (goalStorage, $debounce) {
    return {
        restrict: 'A',
        scope: {
            goal: '=',
            submodel: '='
        },
        templateUrl: '/js/app/main/views/goal_detail.html',
        link: function(scope, element, attrs) {
            if (!scope.goal) {
                element.remove();
            }
        }
    };
});
