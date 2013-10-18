var ParentWebSocketConnection = WebSocketConnection;
var WebSocketConnection = function (params) {
    var socket = new ParentWebSocketConnection(params);
    socket.isOpened = false;
    socket.onopen = function () {
        socket.isOpened = true;
    };

    socket.callbacks = [];
    socket.currentCallbackId = 0;

    // This creates a new callback ID for a request
    socket.getCallbackId = function () {
        socket.currentCallbackId += 1;
        if (socket.currentCallbackId > 10000) {
            socket.currentCallbackId = 0;
        }
        return socket.currentCallbackId;
    };

    socket.pushCallback = function (callback) {
        var callbackId = socket.getCallbackId();
        socket.callbacks[callbackId] = {
            time: new Date(),
            callback: callback
        };
        return callbackId;
    };

    socket.getCallback = function (id) {
        var callback = socket.callbacks[id].callback;
        delete socket.callbacks[id];
        return callback;
    };

    return socket;
};

var JsonWebSocket = function(params) {
    var socket = new WebSocketConnection(params);
    socket._send = socket.send;
    socket.send = function (url, data, callback) {
        var callbackId = socket.pushCallback(callback);
        socket._send(JSON.stringify({
            callbackId: callbackId,
            route: url,
            params: data
        }));
    };

    socket.onmessage = function (e) {
        var data = $.parseJSON(e.data);
        socket.getCallback(data.callbackId)(data.params);
    };

    return socket;
};