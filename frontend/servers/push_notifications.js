var io = require('socket.io').listen(8080),
    jayson = require('jayson');

var rpc_client = jayson.client.http('http://blog3.ru/index.php?r=rpc/index');

io.sockets.on('connection', function(socket) {
    var sockets_api = [
        'search'
    ];

    for (var i in sockets_api) {
        var method = sockets_api[i];
        var proxy_response_to_client = function(err, error, response) {
            if(err) throw err;
            socket.emit(method, response);
        };
        var proxy_request_to_server = function(request) {
            rpc_client.request(method, request, proxy_response_to_client);
        };
        socket.on(method, proxy_request_to_server);
    }
});

var rpc_api = [
    'notify'
];

var rpc_push_methods = {};
for (var i in rpc_api) {
    var method = rpc_api[i];
    rpc_push_methods[method] = function(data, callback) {
        callback(null, {
            status: 'ok'
        });

        io.sockets.emit(method, data);
    };
}

jayson.server(rpc_push_methods).http().listen(3000); //server json-rpc api


