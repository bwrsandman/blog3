'use strict';

angular.module('MainApp').factory('goalStorage', ['$q', '$rootScope', 'goalsIo', function($q, $rootScope, goalsIo) {
    var STORAGE_ID = 'todos-angularjs';

    var service = {
        get: function (callback) {
            var service = this,
                goals = localStorage.getItem(STORAGE_ID);

            if (goals != undefined) {
                callback(JSON.parse(goals));
            } else {
                goalsIo.send('goal/all', {}, function(data) {
//                        service.put(data);
                        callback(data);
                });
            }
        },
        put: function (todos) {
            localStorage.setItem(STORAGE_ID, JSON.stringify(todos));
        },
        add: function(goal, callback) {
            service.get(function(data) {
                alert(3);
                goalsIo.send('goal/create', goal, callback);
            });
        },
        delete : function(goal, callback) {
            goalsIo.send('goal/delete', goal, function(data) {
                callback(data);
            });
        }
    };
    return service;
}]);

