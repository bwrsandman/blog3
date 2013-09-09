var io = require('socket.io').listen(89);
var jayson = require('jayson');
var rpc_server = jayson.server({
    notify: function(type, message, callback) {
        callback(null, {
            status: 'ok'
        });
        io.sockets.emit('notify', {
            type: type,
            message: message
        });
    }
});

rpc_server.http().listen(3000); //server json-rpc api


