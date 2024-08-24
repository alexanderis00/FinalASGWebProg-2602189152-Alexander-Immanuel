<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<button id="start-call" data-user-id="{{ $user->id }}">Start Video Call</button>

<script>
    document.getElementById('start-call').addEventListener('click', function() {
        const receiverId = this.getAttribute('data-user-id');

        fetch('/calls', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ receiver_id: receiverId, type: 'video' })
        })
        .then(response => response.json())
        .then(data => {
        });
    });
</script>

</body>
</html>