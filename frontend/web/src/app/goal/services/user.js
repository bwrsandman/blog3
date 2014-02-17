'use strict';

angular.module('eg.goal').factory('User', ['$rootScope', '$socketResource', 'Category', 'Goal', 'Conclusion', function ($rootScope, $socketResource, Category, Goal, Conclusion) {

    var User = $socketResource('user');

    var service = {
        instantiate: function(raw) {
            var user = new User(raw);
            Category.set(raw.categories);
            Goal.set(raw.goals);
            Conclusion.set(raw.conclusions);
            return user;
        } ,
        get: function (callback) {
            var user = service.instantiate(storage.init);
            callback();
        },
        getAll: function () {
            return User;
        }
    };
    return service;
}]);

