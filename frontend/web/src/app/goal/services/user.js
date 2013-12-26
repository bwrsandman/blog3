'use strict';

angular.module('eg.goal').factory('User', ['$rootScope', '$socketResource', 'Category', 'Goal', 'Conclusion', function ($rootScope, $resource, Category, Goal, Conclusion) {

//    var UserSocket = $socketResource('user');

    var User = $resource('user');

    var service = {
        get: function (callback) {
            User.get('view', {}, function (response) {
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

