/*global todomvc */
'use strict';

/**
 * Services that persists and retrieves TODOs from localStorage
 */
angular.module('MainApp').factory('goalStorage', function () {
    var STORAGE_ID = 'todos-angularjs';

    return {
        get: function (callback) {
            var service = this;
            var goals = localStorage.getItem(STORAGE_ID);
            if (goals != undefined) {
                callback(JSON.parse(goals));
            } else {
                io.send('site/goals', {}, function(data) {
                    service.put(data);
                    goals = localStorage.getItem(STORAGE_ID);
                    callback(JSON.parse(goals));
                });
            }
        },

        put: function (todos) {
            localStorage.setItem(STORAGE_ID, JSON.stringify(todos));
        }
    };
});
