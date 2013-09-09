var io = require('socket.io').listen(89);
var rpc = require('jayson');
var server = rpc.server({
    add: function(a, b, callback) {
        io.sockets.emit('add', {
            a: a,
            b: b
        });
    }
});
server.http().listen(3000); //server api
