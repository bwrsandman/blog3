'use strict';

angular.module('eg.goal').factory('Category', ['$socketResource', function ($resource) {

    var Category = $resource('goalCategory');

    var categories = [];
    var service = {
        set: function(categoriesArray) {
            angular.forEach(categoriesArray, function (val) {
                var cat = new Category(val);
                categories.push(cat);
            });
        },
        getAll: function () {
            return categories;
        }
    };
    return service;
}]);

