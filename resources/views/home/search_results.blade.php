<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    @include('home.header')

    <div class="container">
         <!-- Back Button aligned under the logo -->
         <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/') }}" class="btn" style="background-color: #28B446; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Back</a>
        </div>

        <h1>Search Results</h1>

        @if($services->isEmpty())
            <p>No services found for your query.</p>
        @else
            <ul class="list-group">
                @foreach($services as $service)
                    <li class="list-group-item">
                        <h5>{{ $service->title }}</h5>
                        <img height="150" src="{{ asset('services/' . $service->image) }}" alt="{{ $service->title }}">
                        <p>{{ $service->description }}</p>
                        <p><strong>Price:</strong> ${{ $service->price }}</p>
                    </li>
                @endforeach
            </ul>
        @endif

    </div>

    @include('home.footer')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
