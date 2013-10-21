var ParentWebSocketConnection = WebSocketConnection;
var WebSocketConnection = function (params) {

    var socket = $.extend(new ParentWebSocketConnection(params), {
        isOpened: false,
        onopen: function () {
            socket.isOpened = true;
        },
        callbacks: [],
        currentCallbackId: 0,
        getCallbackId: function () {
            // This creates a new callback ID for a request
            socket.currentCallbackId += 1;
            if (socket.currentCallbackId > 10000) {
                socket.currentCallbackId = 0;
            }
            return socket.currentCallbackId;
        },
        pushCallback: function (callback) {
            var callbackId = socket.getCallbackId();
            socket.callbacks[callbackId] = {
                time: new Date(),
                callback: callback
            };
            return callbackId;
        },
        getCallback: function (id) {
            var callback = socket.callbacks[id].callback;
            delete socket.callbacks[id];
            return callback;
        }
    });

    return socket;
};

var JsonWebSocket = function (params) {
    var defer = $.Deferred();

    var socket = new WebSocketConnection(params);

    var promise = $.extend(defer.promise(), {
        pushHandler: params.pushHandler,
        errorHandler: params.errorHandler,
        send: function (url, data, callback) {
            defer.then(function () {
                var callbackId = socket.pushCallback(callback);
                socket.send(JSON.stringify({
                    callbackId: callbackId,
                    route: url,
                    params: data
                }));
            });
            return defer;
        }
    });

    socket.onmessage = function (e) {
        var data = $.parseJSON(e.data);
        //run callback if it's client request, or run default handler if it's server push message
        if (data.status == 'success') {
            if (data.callbackId) {
                var callback = socket.getCallback(data.callbackId);
                callback(data.params);
            } else {
                promise.pushHandler(data);
            }
        } else {
            promise.errorHandler(data.status, data.error);
        }
    };

    if (socket.isOpened) {
        defer.resolve();
    } else {
        socket.onopen = function () {
            defer.resolve();
        };
    }

    return promise;
};

var AngularSocketDecorator = function (socket, $rootScope, alertService) {
    socket._send = socket.send;
    socket.send = function(route, params, callback, scope) {
        socket._send(route, params, function(data) {
            (scope ? scope : $rootScope).$apply(function() {
                callback(data);
            });
        });
        return socket;
    };
    socket.errorHandler = function(status, error) {
        $rootScope.$apply(function() {
            alertService.add(status, error);
        });
    };
    return socket;
};

