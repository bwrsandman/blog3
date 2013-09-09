var socket = io.connect('http://blog3.ru');
socket.on('add', function (data) {
    console.log(data);
});
