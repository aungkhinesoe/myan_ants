<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            padding: 20px;
        }

        .order-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .order-item {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .order-item img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            margin: 10px 0;
        }

        .btn-view {
            background-color: #28B446;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-view:hover {
            background-color: #218838;
        }

    </style>
</head>
<body>
    @include('home.header')

    <div class="container">
        <!-- Back Button aligned under the logo -->
        <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/') }}" class="btn" style="background-color: #28B446; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Back</a>
        </div>

        <h1>My Orders</h1>

        @if($orders->isEmpty())
            <p>No orders found.</p>
        @else
            <div class="order-list">
                @foreach($orders as $order)
                    <div class="order-item">
                        <h3>Service: {{ $order->service->title }}</h3>
                        <p><strong>Order ID:</strong> {{ $order->id }}</p>
                        <p><strong>Address:</strong> {{ $order->address }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('home.footer')

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
