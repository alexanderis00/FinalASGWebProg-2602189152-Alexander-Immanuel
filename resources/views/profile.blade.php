<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Profile</h1>

        <h3>Your Friends</h3>
        <ul class="list-group">
            @foreach($friends as $friend)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $friend->name }}
                    <form method="POST" action="{{ route('friend.remove', $friend->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Remove Friend</button>
                    </form>
                </li>
            @endforeach
        </ul>
        
        <h3>Add a Friend</h3>
        <form method="POST" action="{{ route('friend.add', 1) }}"> <!-- replace 1 with the friend ID -->
            @csrf
            <input type="hidden" name="friend_id" value="1">
            <button type="submit" class="btn btn-primary">Add Friend</button>
        </form>
    </div>
</body>
</html>
