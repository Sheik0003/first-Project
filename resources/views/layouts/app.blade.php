<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 300px;
            background-color: #343a40;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding-top: 20px;
            overflow-y: auto;
        }

        .sidebar a {
            color: white;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar .submenu a {
            padding-left: 40px;
        }

        .content {
            margin-left: 300px;
            padding: 20px;
            width: calc(100% - 300px);
        }

        .navbar {
            background-color: #343a40;
            color: white;
        }

        .navbar-brand,
        .navbar-nav a {
            color: white !important;
        }

        .logo {
            max-height: 100px;
            width: auto;
        }

        .alert {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            width: auto;
            max-width: 400px;
        }

        .submenu {
            display: none;
            padding-left: 20px;
        }

        .sidebar a.active+.submenu {
            display: block;
        }

        .sidebar a.active {
            background-color: #007bff;
            color: white;
            font-weight: bold;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="text-center mb-4">
            @if(isset($appSetting) && $appSetting->logo)
                <img src="{{ url($appSetting->logo) }}" alt="Logo" class="logo">
            @else
                <img src="{{ url('Downloads/1733375943_675137c7ad063.jpg') }}" alt="Logo" class="logo">
            @endif
        </div>
        <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">Settings</a>
        <a href="{{ route('message') }}" class="{{ request()->routeIs('message') ? 'active' : '' }}">Message</a>
    </div>

    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand">Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); $('#logoutModal').modal('show');">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- <a href="https://wa.me/9360422493?text=Hi%20there!" target="_blank" class="btn btn-success whatsapp-button">
        <i class="fa fa-whatsapp"></i> Contact Us on WhatsApp
    </a> -->

    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logoutModalLabel">Confirm Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to log out?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" onclick="document.getElementById('logout-form').submit();">Yes, Logout</button>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>