<!-- resources/views/header.blade.php -->
 <!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<style>
    /* Header Styles */
    .header {
        display: flex;
        justify-content: space-between;
        padding: 20px;
        background-color: #f8f9fa;
        align-items: center;
        border-bottom: 3px solid #28B446;
    }

    .header img {
        height: 50px;
    }

    .header .nav-buttons {
        display: flex;
        gap: 10px;
    }

    /* Uniform styling for all links */
    .header a {
        text-decoration: none;
        padding: 10px 20px;
        background-color: #f8f9fa;
        color: #000000;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px; /* Same font size for all links */
    }

    /* Optional: Add hover effect */
    .header a:hover {
        background-color: #e2e6ea;
    }

     /* Dropdown styling */
     .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-button {
        background-color: #f8f9fa;
        color: #000000;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f8f9fa;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: #000000;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #e2e6ea;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropdown-button {
        background-color: #e2e6ea;
    }

    .logout-button {
        background-color: #f8f9fa;
        color: #000000;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        text-decoration: none;
    }

    .logout-button:hover {
        background-color: #e2e6ea;
    }

    .logout-button:focus {
        outline: none;
    }
</style>

<header class="header">
    <img src="{{ asset('logo.png') }}" alt="Logo">
    <div class="nav-buttons">
        @if (Route::has('login'))
            <div class="dropdown">
                <button class="dropdown-button">Category</button>
                <div class="dropdown-content">
                    <a href="{{ route('home.maidservice') }}">Maid</a>
                    <a href="{{ route('home.deepcleaningservice') }}">Deep Cleaning</a>
                </div>
            </div>

            @auth
                <a href="{{ route('home.order') }}">My Order</a>

                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-button">Logout</button>
                </form>
            @else
                <a href="{{ url('/login') }}">Login</a>
                <a href="{{ url('/register') }}">Register</a>
            @endauth
        @endif
    </div>
</header>

<style>

</style>


