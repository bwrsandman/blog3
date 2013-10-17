'use strict';

angular.module('MainApp').factory('goalStorage', ['$q', '$rootScope', 'goalsIo', function($q, $rootScope, goalsIo) {
    var STORAGE_ID = 'todos-angularjs';

    return {
        get: function () {
            var service = this,
                goals = localStorage.getItem(STORAGE_ID),
                defer = $q.defer();

            if (goals != undefined) {
                defer.resolve(JSON.parse(goals));
            } else {
                goalsIo.send('site/goals', {}, function(data) {
                    $rootScope.$apply(function() {
//                        service.put(data);
                        defer.resolve(data);
                    });
                });
            }

            return defer.promise;
        },

        put: function (todos) {
            localStorage.setItem(STORAGE_ID, JSON.stringify(todos));
        }
    };
}]);

