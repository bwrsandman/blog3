// WAMP session object
var sess;
var prefix = 'http://' + document.domain + '/';


function onEvent(topic, event) {
    console.log(topic);
    console.log(event);
}

function onConnect(session) {
    sess = session;
    console.log("Connected to ");

    // subscribe to topic, providing an event handler
    sess.subscribe(prefix + "user", onEvent);
}
function onDisconnect(code, reason) {
    sess = null;
    console.log("Connection lost (" + code + ")");
}

// connect to WAMP server
ab.connect('ws://' + document.domain + ':8047/', onConnect, onDisconnect);

function publishEvent() {
    sess.publish(prefix + "user", {a: "foo", b: "bar", c: 23});
}

function callProcedure() {
    // issue an RPC, returns promise object
    sess.call(callProcedure = "simple/calc#add", 23, 7).then(function (res) {
        console.log("got result: " + res);
    }, function (error, desc) {
        console.log("error: " + desc);
    });
}