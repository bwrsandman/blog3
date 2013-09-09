var news_socket = io.connect('http://blog3.ru:89');

var news_events = {
    notify: function (data) {
        console.log(data);
        var notify_container = $('<div class="alert"></div>');
        notify_container.addClass('alert-'+ data.type);
        $('.site-index:first').prepend(notify_container.text(data.message))
    }
};

for (var i in news_events) {
    news_socket.on(i,news_events[i]);
}
