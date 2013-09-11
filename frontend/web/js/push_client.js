var search_socket = io.connect('http://blog3.ru:89');


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
