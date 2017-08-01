/**
 * Created by abdykapar on 7/2/17.
 */
var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel');

redis.on('message', function (channel, message) {
    message = JSON.parse(message);
    io.emit(channel + ':' + message.event, message.data);
    console.log(channel, message);
});
var count = 0;
io.on('connection', function(socket){
    count++;
    console.log(count+' User connected');
    socket.on('chat.message', function(message,author){
        io.emit('chat.message', message);
    });
    socket.on('disconnect',function(){
        count--;
        console.log('User was disconnected');
        io.emit('chat.message','User was disconnected');
    });

});
server.listen(3000);