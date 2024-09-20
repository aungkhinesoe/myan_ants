<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        /* Background Image */
      .background {
            height: 500px; /* Maintain height */
            background-image: url('{{ asset('clean.jpg') }}'); /* Ensure this path is correct */
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Hero text content */
        .hero-content {
            text-align: center;
            color: white;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .hero-content p {
            font-size: 20px;
            margin-bottom: 20px;
        }

        /* Search bar styling */
        .search-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .search-bar input[type="text"] {
            padding: 12px;
            width: 400px;
            border-radius: 25px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .search-bar button {
            background-color: #28B446;
            color: white;
            border: none;
            border-radius: 25px;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #218838;
        }

        /* Cards Section */
        .cards-section {

            text-align: center;
        }

        .cards-section h2 {
            margin-bottom: 30px;
            color: #000000;
        }

        /* Cards Container and Card Styling */
        .cards-container {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s;
            color: #000000;
        }
        .card:hover {
            transform: scale(1.05);
        }

        /* Square Image inside the card */
        .card img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin: 20px 0;
            border-radius: 8px;
        }

        .card a {
            text-decoration: none;
            display: block;
            padding: 10px 0;
            background-color: #28B446;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <!-- Include Header -->
    @include('home.header')

  <div class="background">
        <div class="hero-content">
            <h1>MyanAnts</h1>
            <p>Your trusted partner for home and office cleaning services in Myanmar!</p>
            <div class="search-bar">
                <input type="text" placeholder="Find your service here.">
                <button>Search</button>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="cards-section">
        <h2>Category</h2>
        <div class="cards-container">

            @foreach ($category_items as $category_item)
                <div class="card">
                    <h3>{{$category_item->category_name}}</h3>
                    <img height="150" src="categories/{{$category_item->image}}" alt="Maid Service">
                    <a href="{{ route('home.maidservice') }}">View Services</a>
                </div>
            @endforeach

        </div>
    </div>

    <!-- Include Footer -->
    @include('home.footer')
</body>
</html>
