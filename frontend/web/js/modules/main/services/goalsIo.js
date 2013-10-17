'use strict';

// services in angular.js is lazy, but socket must be opened ASAP
// i know about .run() on service, but it's critical time
(function () {
    var socket = new WebSocketConnection({
        url: {
            ws: 'ws://' + document.domain + ':8047/goals'
        },
        root: 'js/websocket/'
    });
    socket.isOpened = false;
    socket.onopen = function() {
        socket.isOpened = true;
    };

    angular.module('MainApp').service('goalsIo', ['$q', '$rootScope', function ($q, $rootScope) {

        var goalsIo = $q.defer();
        angular.extend(goalsIo, {
            send: function (url, data, callback) {
                goalsIo.promise.then(function () {
                    $rootScope.$on('io/' + url, function (e, data) {
                        callback(data);
                    });

                    goalsIo.socket.send(JSON.stringify({
                        route: url,
                        request: data
                    }));
                });
            },
            socket: socket
        });

        if (goalsIo.socket.isOpened) {
            goalsIo.resolve();
        } else {
            goalsIo.socket.onopen = function () {
                $rootScope.$apply(function () {
                    goalsIo.resolve();
                });
            };
        }

        goalsIo.socket.onmessage = function (e) {
            var data = $.parseJSON(e.data);
            $rootScope.$broadcast('io/' + data.route, data.response);
        };

        goalsIo.socket.onclose = function () {
        };

        return goalsIo;

    }]);
})();