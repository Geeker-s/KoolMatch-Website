var socket = new WebSocket("ws://127.0.0.1:8080");

socket.onopen = function () {
    console.log('Connection successful');
};

socket.onclose = function (event) {
    if (event.wasClean) {
        console.log('Connection closed.');
    } else {
        console.log('Connection killed:(');
    }
    console.log(event.code + event.reason);
};

socket.onmessage = function (event) {
    var list = document.getElementById('list');
    var message = document.createElement("div");
    var node = document.createTextNode(event.data);
    message.appendChild(node);
    message.classList.add('card');
    list.appendChild(message);
};

socket.onerror = function (error) {
    console.log(error.message);
};

var button = document.getElementById('send');
var textarea = document.getElementById('message-box');

function sendText() {
    var text = textarea.value;
    if (text.length > 0) {
        socket.send(JSON.stringify(text));
        textarea.value = '';

        return true;
    }

    return false;
}

button.onclick = sendText;

textarea.onkeypress = function (ev) {
    if (ev.charCode === 13 && ev.shiftKey) {
        sendText();
    }
};



