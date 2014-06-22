var http = require('http'),
	fs = require('fs'),
	sanitize = require('validator');
	
var app = http.createServer(function (request, response) {
	fs.readFile("client.html", 'utf-8', function (error, data) {
		response.writeHead(200, {'Content-Type': 'text/html'});
		response.write(data);
		response.end();
	});
}).listen(2014);

var io = require('socket.io').listen(app);

io.sockets.on('connection', function(socket) { 
	socket.on('message_to_server', function(data) { 
        var escaped_message = sanitize.toString(data["message"]);
        var escaped_user = sanitize.toString(data["user"]);
        var escaped_art = sanitize.toString(data["art"]);
        io.sockets.emit("message_to_client",{ message: escaped_message , user: escaped_user, art:escaped_art});
       	});
});
