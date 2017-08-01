<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div id='chat'>
    <h1>New Users</h1>
    <ul>
        <li v-for="user in users">@{{ user }}</li>
    </ul>
    <ul>
        <li v-for="message in messages">@{{ OwnUser }} say that: @{{ message }}</li>
    </ul>
    <form method="get" action="/">
        Name: <input v-model="name" placeholder="Your name" name="author"><br>
        Message: <textarea v-model='message' name="message"></textarea><br>
        <button v-on:click="send">Send</button>
        <p>@{{ message }}</p>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.0.3/socket.io.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js"></script>
<script src="/js/vue.js"></script>
<script type="text/javascript">
    var socket = io('http://127.0.0.1:3000');
    var app = new Vue({
        el: '#chat',
        data: {
            messages:[],
            users: [],
            message: '',
            OwnUser: '',
            author: ''
        },
        created: function(){
            socket.on('chat.message',function(message){
                this.messages.push(message);
            }.bind(this));
            socket.on('test-channel:App\\Events\\UserSignedUp', function (data) {
                this.users.push(data.username);
                this.OwnUser = data.username;
            }.bind(this));
        },
        methods: {
            send: function(e){
                socket.emit('chat.message',this.message,this.author);
                this.message = '';
                e.preventDefault();
            }
        }
    });
</script>
</body>
</html>