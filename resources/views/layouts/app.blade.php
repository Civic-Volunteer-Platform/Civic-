<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Civic Volunteering Platform')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <style>
        body {
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: #2c3e50;
            color: #fff;
            transition: all 0.3s;
        }
        #sidebar .nav-link {
            color: #ddd;
        }
        #sidebar .nav-link.active,
        #sidebar .nav-link:hover {
            background: #34495e;
            color: #fff;
        }
        #content {
            flex-grow: 1;
            padding: 20px;
            background: #f8f9fa;
        }
        @media (max-width: 768px) {
            #sidebar {
                min-width: 100%;
                max-width: 100%;
                height: auto;
            }
            body {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <nav id="sidebar" class="d-flex flex-column p-3">
        <h3 class="text-white mb-4">Volunteer Org</h3>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item mb-1">
                <a href="{{ route('organization.dashboard') }}" class="nav-link {{ request()->routeIs('organization.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.opportunities.index') }}" class="nav-link {{ request()->routeIs('organization.opportunities.*') ? 'active' : '' }}">
                    Opportunities
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.opportunities.create') }}" class="nav-link {{ request()->routeIs('organization.opportunities.create') ? 'active' : '' }}">
                    Create Opportunity
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.volunteers.index') }}" class="nav-link {{ request()->routeIs('organization.volunteers.*') ? 'active' : '' }}">
                    Volunteers
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.events.index') }}" class="nav-link {{ request()->routeIs('organization.events.*') ? 'active' : '' }}">
                    Events
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.reports.index') }}" class="nav-link {{ request()->routeIs('organization.reports.*') ? 'active' : '' }}">
                    Reports
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.profile.edit') }}" class="nav-link {{ request()->routeIs('organization.profile.*') ? 'active' : '' }}">
                    Profile
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="{{ route('organization.settings') }}" class="nav-link {{ request()->routeIs('organization.settings') ? 'active' : '' }}">
                    Settings
                </a>
            </li>
        </ul>
        <hr />
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100">Logout</button>
        </form>
    </nav>

    <div id="content">
        <nav class="navbar navbar-light bg-white mb-4 shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">@yield('title', 'Dashboard')</span>
                <div>
                    Logged in as: <strong>{{ auth()->user()->name }}</strong>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
