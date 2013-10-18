'use strict';

// services in angular.js is lazy, but socket must be opened ASAP
// i know about .run() on service, but it's critical time
(function () {

    var socket = new JsonWebSocket({
        url: {
            ws: 'ws://' + document.domain + ':8047/goals'
        },
        root: 'js/websocket/'
    });

    angular.module('MainApp').service('goalsIo', ['$q', function ($q) {

        var goalsIo = $q.defer();

        goalsIo.send = function (url, data, callback) {
            goalsIo.promise.then(function () {
                goalsIo.socket.send(url, data, callback);
            });
        };

        goalsIo.socket = socket;

        if (goalsIo.socket.isOpened) {
            goalsIo.resolve();
        } else {
            goalsIo.socket.onopen = function () {
                goalsIo.resolve();
            };
        }

        return goalsIo;
    }
    ])
    ;
})();