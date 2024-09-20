<!DOCTYPE html>
<html>

<head>
    @include('admin.css')

    <style type="text/css">

        input[type='text']
        {
            width: 400px;
            height: 50px;
        }

        .input_deg
        {
            padding: 15px;
        }

        label
        {
            display: inline-block;
            width: 250px;
            font-size: 18px!important;
            color: white!important;
        }

        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

        .table_deg
        {
            text-align: center;
            margin: auto;
            border: 2px solid yellowgreen;
            margin-top: 50px;
            width: 600px;
        }

        th
        {
            background-color: skyblue;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        td
        {
            color: white;
            padding: 10px;
            border: 1px solid skyblue;
        }

    </style>

</head>

<body>
    @include('admin.header')

    @include('admin.sidebar')

    <div class="page-content">
        <div class="page-header">
            <h1 style="color: white">
                Add Category
            </h1>
        </div>

        <div class="container-fluid">
            <div class="div_deg">
                <form action="{{url('add_category')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="input_deg">
                        <label>Title</label>
                        <input type="text" name="category">
                        <div class="input_deg">
                            <label>Image</label>
                            <input type="file" name="image" required>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Add Category">
                    </div>
                </form>
            </div>
            <div>
                <table class="table_deg">
                    <tr>
                        <th>Category Name</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>

                    @foreach ($category_items as $category_item)
                    <tr>
                        <td>{{$category_item->category_name}}</td>
                        <td>
                            <img height="150" src="categories/{{$category_item->image}}">
                        </td>
                        <td><a class="btn btn-success" href="{{url('edit_category',$category_item->id)}}">Edit</a></td>
                        <td><a class="btn btn-danger" onclick="confirmation(event)" href="{{url('delete_category',$category_item->id)}}">Delete</a></td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>
    <!-- JavaScript files-->

    <script type="text/javascript">
        function confirmation(ev)
        {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');

            swal({
                title: "Are You Sure to Delete This?",
                text: "This delete will be parmanent.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willCancel)=>{
                if(willCancel)
                {
                    window.location.href=urlToRedirect;
                }
            });
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
