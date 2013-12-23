'use strict';

angular.module('eg.goal').factory('User', ['$resource', 'Category', 'Goal', 'Conclusion', function ($resource, Category, Goal, Conclusion) {

//    var UserSocket = $socketResource('user', {}, {
//        getData: {
//            url: 'api/v1/user',
//            isArray: true,
//            params: {
//                fullData: true
//            }
//        }
//    });

//    UserSocket.$getData(function (response) {
//
//        angular.forEach(response.goals, function (val, key) {
//            $scope.goals[key] = new Goal(val);
//            $scope.keys.push(key);
//        });
//
//        angular.forEach(response.conclusions, function (val, key) {
//            $scope.conclusions[key] = new Conclusion(val);
//        });
//    });


    var User = $resource('/api/v1/user/');

    var service = {
        get: function (callback) {
            User.get(function (response) {
                Category.set(response.categories);
                Goal.set(response.goals);
                Conclusion.set(response.conclusions);
                callback();
            });
        },
        getAll: function () {
            return User;
        }
    };
    return service;
}]);

