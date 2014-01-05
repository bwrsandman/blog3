'use strict';

angular.module('eg.goal').factory('User', ['$rootScope', '$socketResource', 'Category', 'Goal', 'Conclusion', function ($rootScope, $resource, Category, Goal, Conclusion) {

    var User = $resource('user');

    var service = {
        get: function (callback) {
            var user = new User;
            var response = storage.init;
//            user.$get(function (response) {
                Category.set(response.categories);
                Goal.set(response.goals);
                Conclusion.set(response.conclusions);
                callback();
            //$rootScope.$apply(callback);
//            });
        },
        getAll: function () {
            return User;
        }
    };
    return service;
}]);

