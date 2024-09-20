<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deep Cleaning Services</title>
</head>
<body>
    @include('home.header')

    <div class="container">
        <h1>Deep Cleaning Services</h1>

        @if($services->isEmpty())
            <p>No Deep Cleaning Services available at the moment.</p>
        @else
            <div class="services-list">
                @foreach($services as $service)
                    <div class="service-item">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>
                        <p>Price: ${{ $service->price }}</p>
                        <img src="{{ asset('services/' . $service->image) }}" alt="{{ $service->title }}" width="200">
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('home.footer')
</body>
</html>
