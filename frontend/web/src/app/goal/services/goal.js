'use strict';

angular.module('eg.goal').factory('Goal', ['$socketResource', function ($resource) {
    var Goal = $resource('goal');

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
            goal.$save(function(response) {
                goals.push(new Goal(response));
            });
        }
    };
    return service;
}]);

'use strict';

angular.module('eg.goal').factory('Conclusion', ['$socketResource', function ($resource) {
    var Conclusion = $resource('conclusion');

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

