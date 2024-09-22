<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">

        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }

        label
        {
            display: inline-block;
            width: 250px;
            font-size: 18px!important;
            color: white!important;
        }

        input[type='text'],
        select,
        textarea
        {
            width: 350px;
            height: 50px;
        }

        textarea
        {
            height: 80px;
        }

        .input_deg
        {
            padding: 15px;
        }

    </style>

</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <h1 style="color: white">
                Edit Service
            </h1>
        </div>

        <div class="container-fluid">
            <div class="div_deg">
                <form action="{{url('update_service', $service->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input_deg">
                        <label>Title</label>
                        <input type="text" name="title" value="{{ $service->title }}" required>
                    </div>

                    <div class="input_deg">
                        <label>Description</label>
                        <textarea name="description" required>{{ $service->description }}</textarea>
                    </div>

                    <div class="input_deg">
                        <label>Price</label>
                        <input type="text" name="price" value="{{ $service->price }}" required>
                    </div>

                    <div class="input_deg">
                        <label>Category</label>
                        <select name="category" required>
                            <option value="{{ $service->category }}">{{ $service->category }}</option>

                            @foreach ($categories as $category)
                                <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="input_deg">
                        <label>Current Image</label>
                        <img height="100" src="/services/{{ $service->image }}">
                    </div>

                    <div class="input_deg">
                        <label>Change Image</label>
                        <input type="file" name="image">
                    </div>

                    <div class="input_deg">
                        <input class="btn btn-success" type="submit" value="Update Service">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>
</body>

</html>
