<style>
    /* Align the notification dropdown and logout button */
    .right-menu {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    /* Style the notifications dropdown */
    .notification-wrapper {
        margin-right: 20px; /* Add space between notifications and logout */
    }

    .dropdown-menu {
        width: 300px; /* Set a width for the dropdown */
        max-height: 200px; /* Limit the height */
        overflow-y: auto; /* Scroll if content is too long */
    }

    .dropdown-toggle {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .badge {
        margin-left: 10px; /* Add space between notification text and count badge */
    }

    /* Style for the notification items */
    #notification-list li {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    /* Optional: Style the mark-as-read button */
    .mark-as-read {
        color: #007bff;
        cursor: pointer;
        text-decoration: none;
    }

    .mark-as-read:hover {
        text-decoration: underline;
    }

    /* Style the dropdown item */
    .dropdown-item {
        display: flex;
        justify-content: space-between;
        padding: 8px 15px;
        background-color: #fff;
        border-bottom: 1px solid #ddd;
        color: #333;
    }

    /* Style when no notifications are available */
    .dropdown-item:last-child {
        border-bottom: none;
    }
</style>

<header class="header">
    <nav class="navbar navbar-expand-lg">
      <div class="search-panel">
        <div class="search-inner d-flex align-items-center justify-content-center">
          <div class="close-btn">Close <i class="fa fa-close"></i></div>
          <form id="searchForm" action="#">
            <div class="form-group">
              <input type="search" name="search" placeholder="What are you searching for...">
              <button type="submit" class="submit">Search</button>
            </div>
          </form>
        </div>
      </div>
      <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="navbar-header">
          <!-- Navbar Header--><a href="index.html" class="navbar-brand">
            <div class="brand-text brand-big visible text-uppercase"><strong class="text-primary">MyanAnts</strong></div>
            <div class="brand-text brand-sm"><strong class="text-primary">D</strong><strong>A</strong></div></a>
          <!-- Sidebar Toggle Btn-->
          <button class="sidebar-toggle"><i class="fa fa-long-arrow-left"></i></button>
        </div>

        {{-- <div class="notification-icon">
            <i class="fas fa-bell"></i>
            <span class="badge badge-danger">3</span> <!-- Hardcoded test value -->
        </div> --}}

        <div class="right-menu list-inline no-margin-bottom" style="display: flex; align-items: center; justify-content: flex-end;">

            <!-- Notifications -->
            <div class="notification-wrapper">
                @php
                $notifications = auth()->user()->notifications()->where('read', false)->get();
                $notificationCount = $notifications->count();
                @endphp

                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="notificationDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Notifications <span class="badge badge-light">{{ $notificationCount }}</span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="notificationDropdown">
                        <div class="dropdown-header">Notifications</div>
                        <ul id="notification-list" class="list-unstyled">
                            @forelse ($notifications as $notification)
                                <li id="notification-{{ $notification->id }}" class="dropdown-item d-flex justify-content-between align-items-center">
                                    <span>{{ $notification->data['message'] }}</span>
                                    <a href="#" class="mark-as-read text-primary" data-id="{{ $notification->id }}">Mark as read</a>
                                </li>
                            @empty
                                <li class="dropdown-item text-muted">No new notifications</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Log out -->
            <div class="list-inline-item logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <input type="submit" value="Logout" class="btn btn-light">
                </form>
            </div>

        </div>

      </div>
    </nav>
  </header>

  <script>
    function fetchNotificationCount() {
        $.ajax({
            url: "{{ url('/notifications/count') }}",
            type: 'GET',
            success: function(data) {
                $('#notificationDropdown .badge').text(data.count);
            }
        });
    }

    // Fetch count every 10 seconds
    setInterval(fetchNotificationCount, 10000);
</script>
