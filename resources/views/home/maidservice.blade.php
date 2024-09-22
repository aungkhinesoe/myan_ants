<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maid Services</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    <!-- Back Button aligned under the logo -->
        <div class="d-flex align-items-center mb-3">
        <a href="{{ url('/') }}" class="btn" style="background-color: #28B446; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Back</a>
        </div>

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
                        <button class="btn-order" data-toggle="modal" data-target="#orderModal"
                                onclick="setModalData('{{ $service->title }}', '{{ $service->id }}')">Order Now</button>
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
    <div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if(Auth::check())
                        <form action="{{ url('confirm-order') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" name="address" required>{{ Auth::user()->address }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="service">Service</label>
                                <input type="text" id="selectedService" class="form-control" name="service" readonly>
                            </div>

                            <input type="hidden" name="service_id">

                            <button type="submit" class="btn-order">Confirm Order</button>
                        </form>
                    @else
                        <p>You must be logged in to place an order.</p>
                        <a href="{{ route('login') }}" class="btn-order">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function setModalData(serviceTitle, serviceId) {
            document.getElementById("selectedService").value = serviceTitle;
            document.querySelector('input[name="service_id"]').value = serviceId;
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
