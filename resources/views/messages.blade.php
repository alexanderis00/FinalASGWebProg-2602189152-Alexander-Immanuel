<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mesages</title>
</head>
<body>
    <div id="messages-container">
    </div>
    
    <textarea id="message-input" placeholder="Type your message..."></textarea>
    <button id="send-message" data-receiver-id="{{ $user->id }}">Send</button>
    
    <script>
        document.getElementById('send-message').addEventListener('click', function() {
            const receiverId = this.getAttribute('data-receiver-id');
            const message = document.getElementById('message-input').value;
    
            fetch('/messages', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ receiver_id: receiverId, message: message })
            })
            .then(response => response.json())
            .then(data => {
            });
        });
    
        function loadMessages() {
            fetch('/messages')
                .then(response => response.json())
                .then(data => {
                });
        }
    
        loadMessages();
    </script>
    
</body>
</html>