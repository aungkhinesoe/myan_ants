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

        .div_deg
        {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 30px;
        }

    </style>
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
            <h1 style="color: white">
                Update Category
            </h1>
        </div>

          <div class="container-fluid">
            <div class="div_deg">
                <form action="{{url('update_category',$category_item->id)}}" method="post">
                    @csrf
                    <div>
                        <input type="text" name="category" value="{{$category_item->category_name}}"">
                        <input class="btn btn-primary" type="submit" value="Update Category">
                    </div>
                </form>
            </div>
          </div>

    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>
