'use strict';

angular.module('eg.goal').factory('Category', ['$resource', function ($resource) {

    var Category = $resource('/api/v1/goalCategory/:id', {id: '@id'});

    var categories = [];
    var service = {
        set: function(categoriesArray) {
            angular.forEach(categoriesArray, function (val) {
                categories.push(new Category(val));
            });
        },
        getAll: function () {
            return categories;
        }
    };
    return service;
}]);

