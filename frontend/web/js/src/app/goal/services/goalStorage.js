'use strict';

angular.module('eg.goal').factory('goalStorage', ['$q', '$rootScope', 'goalsIo', function ($q, $rootScope, goalsIo) {
    var STORAGE_ID = 'main.goals';

    var service = {
        getCache: function () {
            var goals = localStorage.getItem(STORAGE_ID);
            return undefined;
            return JSON.parse(goals);
        },
        get: function (callback) {
            var service = this;
            var goals = service.getCache(goals);
            if (goals != undefined) {
                callback(goals);
            } else {
                goalsIo.send('goal/all', {}, callback).then(function (data) {
                    service.put(data);
                });
            }
        },
        put: function (todos) {
            localStorage.setItem(STORAGE_ID, JSON.stringify(todos));
        },
        add: function (goal, callback) {
            goalsIo.send('goal/create', goal, callback).then(function (data) {
                service.get(function (goals) {
                    goals.push(data);
                    service.put(goals);
                });

            });
        },
        delete: function (goal, callback) {
            goalsIo.send('goal/delete', goal, callback).then(function (data) {
                service.get(function (goals) {
                    goals.splice(goals.indexOf(goal), 1);
                    service.put(goals);
                });
            });
        },
        edit: function (goal, callback) {
            if (!goal) {
                return;
            }
            goalsIo.send('goal/edit', goal, callback).then(function (data) {
//                service.get(function(goals) {
//                    goals[goal.id] = data;
//                    service.put(goals);
//                });
            });
        }
    };
    return service;
}]);

