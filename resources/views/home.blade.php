<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('messages.home') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-0sN4XShF6yFh/M8l5tnm+f0HJrdZV4J/bZzD5kl7oOU+0KMe2ZRYz1MCCF9xu2xY4g0A+mdFSYhxaINbZnshg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .card img {
            max-height: 200px;
            object-fit: cover;
        }
        .filter-container, .search-container {
            margin: 1rem 0;
        }
        .wishlist-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            font-size: 1.5rem;
        }
        .wishlist-btn .fa-thumbs-up {
            color: gray;
        }
        .wishlist-btn.liked .fa-thumbs-up {
            color: blue;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">{{ __('messages.home') }}</h1>

        @auth
        <div class="filter-container">
            <h5>{{ __('messages.filter_gender') }}:</h5>
            <form id="filterForm" method="GET" action="{{ route('home.filter') }}">
                <select id="genderFilter" name="gender" class="form-select" onchange="this.form.submit()">
                    <option value="">{{ __('messages.select_gender') }}</option>
                    <option value="male">{{ __('messages.male') }}</option>
                    <option value="female">{{ __('messages.female') }}</option>
                </select>
            </form>
        </div>

        <div class="search-container">
            <h5>{{ __('messages.search_hobby') }}:</h5>
            <form id="searchForm" method="GET" action="{{ route('home.search') }}">
                <input type="text" id="searchQuery" name="query" class="form-control" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request()->input('query') }}">
                <button type="submit" class="btn btn-primary mt-2">{{ __('messages.search') }}</button>
            </form>
        </div>

        <div class="mb-4">
            <h5>{{ __('messages.photo_feed') }}</h5>
            <div class="row">
                @forelse ($users as $user)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="/images/profile.jpg" class="card-img-top" alt="{{ __('messages.user_photo') }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $user->hobby }}</h6>
                            <button class="btn wishlist-btn" data-user-id="{{ $user->id }}" onclick="toggleWishlist({{ $user->id }})">
                                <i class="fas fa-thumbs-up" id="thumb-icon-{{ $user->id }}"></i>
                            </button>
                            <a href="{{ route('user.profile', $user->id) }}" class="btn btn-primary mt-2">{{ __('messages.view_profile') }}</a>
                        </div>
                    </div>
                </div>
                @empty
                <p>{{ __('messages.no_users') }}</p>
                @endforelse
            </div>
        </div>

        @else
        <div class="alert alert-info">
            {{ __('messages.login_prompt') }} <a href="{{ url('/login') }}">{{ __('messages.login') }}</a>. {{ __('messages.register_prompt') }} <a href="{{ url('/register') }}">{{ __('messages.register') }}</a>.
        </div>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function toggleWishlist(userId) {
            const button = document.querySelector(`button[data-user-id="${userId}"]`);
            const icon = document.querySelector(`#thumb-icon-${userId}`);

            if (button.classList.contains('liked')) {
                button.classList.remove('liked');
                icon.style.color = 'gray';
            } else {
                button.classList.add('liked');
                icon.style.color = 'blue';
            }

            fetch(`/wishlist/toggle/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ user_id: userId })
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    alert('{{ __('messages.failed_to_update') }}');
                }
            });
        }
    </script>
</body>
</html>
