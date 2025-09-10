<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="{{route('posts.index')}}">
            <b>{{auth()->user()->name}}</b> Blogs
        </a>

        <!-- Search -->
        <form class="d-flex mx-auto w-50">
            <input class="form-control me-2" type="search" placeholder="Search..." aria-label="Search">
        </form>

        <!-- Right side -->
        <ul class="navbar-nav d-flex align-items-center">

            <!-- Notifications -->
            <li class="nav-item me-3">
                <a class="nav-link position-relative" href="#">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </a>
            </li>

            <!-- Profile Dropdown -->
            <li class="nav-item dropdown">
    <button class="nav-link dropdown-toggle d-flex align-items-center btn border-0 bg-transparent" 
            id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" type="button">
@if(auth()->user()->profile && auth()->user()->profile->profile_image)
    <img src="{{ asset('storage/' . auth()->user()->profile->profile_image) }}" 
         alt="Profile" class="rounded-circle" width="35" height="35">
@else
    <img src="https://via.placeholder.com/35x35.png?text=U" 
         alt="Profile" class="rounded-circle" width="35" height="35">
@endif

    </button>

    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="navbarDropdown">
<li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
<li><a class="dropdown-item" href="{{ route('settings.show') }}">Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="dropdown-item text-danger" type="submit">Logout</button>
            </form>
        </li>
    </ul>
</li>

        </ul>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{route('posts.index')}}"><b>{{auth()->user()->name}}</b> Blogs</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('posts.index')}}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('notifications.index') }}">Notification</a>
                </li>
            </ul>
        </div>

    </div>
</nav>
</div>

<div class="container mt-5">
    @yield('content')
</div>

<!-- Bootstrap Icons + JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>