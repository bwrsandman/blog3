var socket = io.connect('http://blog3.ru:89');
socket.on('add', function (data) {
    console.log(data);
});
