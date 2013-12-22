'use strict';

angular.module('eg.goal').factory('Goal', ['$resource', function ($resource) {
    var Goal = $resource('/api/v1/goal/:id', {id: '@id'});

    var goals = [];
    var service = {
        set: function(goalsArray) {
            angular.forEach(goalsArray, function (val) {
                var goal = new Goal(val);
                goals.push(goal);
            });
        },
        getAll: function () {
            return goals;
        },
        add: function(newGoalData) {
            var goal = new Goal(newGoalData);
            goal.$save();
            goals.push(goal);
        }
    };
    return service;
}]);

'use strict';

angular.module('eg.goal').factory('Conclusion', ['$resource', function ($resource) {
    var Conclusion = $resource('/api/v1/conclusion/:id', {id: '@id'});

    var conclusions = [];
    var service = {
        set: function(goalsArray) {
            angular.forEach(goalsArray, function (val, key) {
                conclusions[key] = new Conclusion(val);
            });
        },
        getAll: function () {
            return conclusions;
        }
    };
    return service;
}]);

