'use strict';

angular.module('MainApp', []).filter('search', function () {
    return function (items, name) {
        var arrayToReturn = [];
        for (var i = 0; i < items.length; i++) {
            if (items[i].name != name) {
                arrayToReturn.push(items[i]);
            }
        }

        return arrayToReturn;
    };
});