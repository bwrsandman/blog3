var io = require('socket.io').listen(89),
    jayson = require('jayson');

var rpc_api = {
    notify: function(type, message, callback) {
        callback(null, {
            status: 'ok'
        });

        io.sockets.emit('notify', [type, message]);
    }
};


jayson.server(rpc_api).http().listen(3000); //server json-rpc api

