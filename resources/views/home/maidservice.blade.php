<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maid Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .container {
            padding: 20px;
        }

        .services-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .service-item {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 8px;
            width: 300px;
            text-align: center;
            background-color: #f9f9f9;
        }

        .service-item img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            margin: 10px 0;
        }

        .btn-order {
            background-color: #28B446;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-order:hover {
            background-color: #218838;
        }

        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 50%;
            height: 50%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            border-radius: 10px;
            position: relative;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 20px;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        /* Input fields styling */
        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    @include('home.header')

    <div class="container">
        <h1>Maid Services</h1>

        @if($services->isEmpty())
            <p>No Maid Services available at the moment.</p>
        @else
            <div class="services-list">
                @foreach($services as $service)
                    <div class="service-item">
                        <h3>{{ $service->title }}</h3>
                        <img src="{{ asset('services/' . $service->image) }}" alt="{{ $service->title }}">
                        <p>{{ $service->description }}</p>
                        <p>Price: ${{ $service->price }}</p>

                        <!-- Order Now Button -->
                        @if(Auth::check())
                            <button class="btn-order" onclick="openModal('{{ $service->title }}')">Order Now</button>
                        @else
                            <a href="{{ route('login') }}" class="btn-order">Order Now</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    @include('home.footer')

    <!-- Modal Structure -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Order Service</h2>

            @if(Auth::check())
                <form action="{{ url('confirm-order') }}" method="POST">
                    @csrf

                    <div class="div_gap">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="div_gap">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ Auth::user()->email }}" readonly>
                    </div>

                    <div class="div_gap">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" value="{{ Auth::user()->phone }}" required>
                    </div>

                    <div class="div_gap">
                        <label for="address">Address</label>
                        <textarea name="address" required>{{ Auth::user()->address }}</textarea>
                    </div>

                    <div class="div_gap">
                        <label for="service">Service</label>
                        <input type="text" id="selectedService" name="service" readonly>
                    </div>

                    <button type="submit" class="btn-order">Confirm Order</button>
                </form>
            @else
                <p>You must be logged in to place an order.</p>
                <a href="{{ route('login') }}" class="btn-order">Login</a>
            @endif
        </div>
    </div>

    <script>
        function openModal(serviceTitle) {
            document.getElementById("orderModal").style.display = "block";
            document.getElementById("selectedService").value = serviceTitle;
        }

        function closeModal() {
            document.getElementById("orderModal").style.display = "none";
        }

       
        window.onclick = function(event) {
            var modal = document.getElementById("orderModal");
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>

</body>
</html>
