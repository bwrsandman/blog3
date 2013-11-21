'use strict';

angular.module('MainApp').controller('GoalCtrl', function ($scope, $resource, $routeParams, $location, filterFilter, alertService, $debounce, $templateCache) {

    var Goal = $resource('/goal/:id', {id: '@id'});

    var tplBase = '/js/app/main/';
    $scope.tpl = {
        filters: tplBase + 'views/filters.html',
        goals: tplBase + 'views/goals.html'
    };

    $scope.keys = [];
    $scope.isReady = false;
    $scope.defaultPlaceholder = 'Сделано';

    $scope.goals = Goal.query(function (data) {
        angular.forEach($scope.goals, function(val, key) {
            $scope.keys.push(key);
        });
    });

    $scope.save = function(goal) {
        if (goal instanceof Goal) {
            goal.$save();
        }
    };

    if ($location.path() === '/') {
        $scope.reportModelName = 'reportToday';
    } else if ($location.path() === '/yesterday') {
        $scope.reportModelName = 'reportYesterday';
    }

    $scope.location = $location;

    showScreen();
});

angular.module('MainApp').directive('egEditor', function ($debounce) {
    return {
        restrict: 'E',
        scope: {
            model: '=ngModel',
            ngChange: '&',
            submodel: '='
        },
        templateUrl: '/js/app/main/views/goal_detail.html',
        link: function ($scope, element, attrs) {
            if (attrs.placeholder) {
                element.find('textarea').attr('placeholder', $scope.$parent.$eval(attrs.placeholder));
            }
            $scope.$watch("model", $debounce($scope.ngChange, 1000), true);
        }
    };
});
