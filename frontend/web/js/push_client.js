io = $('<div id="io">');
io.queue = [];
io.send = function() {
    io.queue.push(arguments);
};

ws1 = new WebSocketConnection({
    url: {
        ws      : 'ws://' + document.domain + ':8047/myws'
    },
    root : 'js/websocket/'
});

io.init = function() {
    io.send =  function(url, data, callback) {
        $(document).on('io.' + url, function(e, data) {
            callback(data);
        });

        ws1.send(JSON.stringify({
            route:url,
            request: data
        }));
    };

    while(io.queue.length > 0) {
        io.send.apply(io, io.queue.shift());
    }
}

ws1.onopen = function() {
    io.init();
};

ws1.onmessage = function(e) {
    var data = $.parseJSON(e.data);
    $(document).trigger('io.' + data.route, new Array(data.response));
};

ws1.onclose = function() {};

/*
var search_socket = io.connect('http://blog3.ru:8080');

var events = {
    notify: function (type, message) {
        var notify_container =
            $('<div class="alert">')
                .addClass('alert-'+ type)
                .text(message)
                .delay(5000)
                .fadeOut('slow', function() {
                    $(this).remove();
                });

        $('.site-index:first').prepend(notify_container)
    },
    search: function(data) {
        console.log(data);
    }
};

for (var i in events) {
    search_socket.on(i, function(data) {
        events[i].call(null, data)
    });
}
*/