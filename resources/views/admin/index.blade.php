<!DOCTYPE html>
<html>
  <head>
    @include('admin.css')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>

        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('43b5782e5d82b44134e5', {
        cluster: 'ap1'
        });

        var channel = pusher.subscribe('notify-channel');
        channel.bind('form-submit', function(data) {
            var order = data.order;
        alert('New order received!\n\n' +
              'Name: ' + order.name + '\n' +
              'Email: ' + order.email + '\n' +
              'Phone: ' + order.phone + '\n' +
              'Service ID: ' + order.service_id + '\n' +
              'Address: ' + order.address);
        });
    </script> --}}
  </head>
  <body>
    @include('admin.header')

    @include('admin.sidebar')

      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">

            {{-- @include('admin.body') --}}
                <h1>Admin Dashboard</h1>



                <audio id="notification-sound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>
                {{-- <h3>New Orders</h3>
                <ul id="order-list">
                    <!-- Orders will be appended here dynamically -->
                </ul> --}}
          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script>
        $(document).on('click', '.mark-as-read', function(e) {
            e.preventDefault();

            var notificationId = $(this).data('id');
            var notificationElement = $('#notification-' + notificationId);

            $.ajax({
                url: "{{ url('/notifications/read') }}/" + notificationId,
                type: 'GET',
                success: function(response) {
                    notificationElement.remove(); // Remove the notification from the list
                // Display the success message
                var successMessage = '<div id="success-message" class="alert alert-success">' +
                                     'Notification deleted successfully.' +
                                     '</div>';

                // Append the success message to a specific part of the page, e.g., after the notification list
                $('#notification-list').after(successMessage);

                // Automatically remove the success message after 3 seconds
                setTimeout(function() {
                    $('#success-message').fadeOut('slow', function() {
                        $(this).remove(); // Remove the message from the DOM
                    });
                }, 3000); // 3 seconds delay
                },
                error: function(xhr) {
                    alert('An error occurred while marking the notification as read.');
                }
            });
        });

        function playNotificationSound() {
        var audio = document.getElementById('notification-sound');
        audio.play();
    }

        // Function to update the notification list dynamically
        function updateNotificationList(notifications) {
        var notificationList = $('#notification-list');
        notificationList.empty(); // Clear existing notifications

        notifications.forEach(function(notification) {
            notificationList.append(
                '<li id="notification-' + notification.id + '">' +
                notification.data.message +
                ' <a href="#" class="mark-as-read" data-id="' + notification.id + '">Mark as read</a></li>'
            );
        });
    }

     // Function to check for new notifications
        function checkForNewNotifications() {
            $.ajax({
                url: "{{ route('getNotifications') }}",
                type: 'GET',
                success: function(notifications) {
                    if (notifications.length > 0) {
                        playNotificationSound(); // Play sound if new notifications are received
                        updateNotificationList(notifications); // Update notification list
                    }
                },
                error: function(xhr) {
                    console.log('Error fetching notifications:', xhr);
                }
            });
        }

    // Check for new notifications every 10 seconds
    setInterval(checkForNewNotifications, 10000);
    </script>
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
