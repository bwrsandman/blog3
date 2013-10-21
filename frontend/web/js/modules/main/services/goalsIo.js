'use strict';

// services in angular.js is lazy, but socket must be opened ASAP
// i know about .run() on service, but it's critical time
(function () {

    var socket = new JsonWebSocket({
        url: {
            ws: 'ws://' + document.domain + ':8047/goals'
        },
        root: 'js/websocket/',
        pushHandler: function () {
        },
        errorHandler: function (status, error) {
        }
    });

    angular.module('MainApp').service('goalsIo', ['$q', '$rootScope', 'alertService', function ($q, $rootScope, alertService) {
        return AngularSocketDecorator(socket, $rootScope, alertService);
    }
    ])
    ;
})();