<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <div class="logo"></div>
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-left search-form" action="{{ route('search::index') }}" method="get">
                <div class="form-group">
                    <input type="text" name="query" class="search-query" placeholder="Search" value="{{ \Request::get('query') != null ? \Request::get('query') : '' }}">
                </div>
                @if(\Request::get('latitude') != null && \Request::get('longitude') != null)
                    <input type="hidden" name="latitude" value="{{ \Request::get('latitude') }}" />
                    <input type="hidden" name="longitude" value="{{ \Request::get('longitude') }}" />
                @endif
            </form>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="{{ route('auth::login') }}">Login</a></li>
                    <li><a href="{{ route('auth::register') }}">Register</a></li>
                @else
                    <li><a class="search-near-me" href="{{ route('search::near', [':latitude', ':longitude']) }}"><i class="fa fa-map-marker nav-icon"></i> Around Me</a></li>
                    <li><a href="{{ route('dashboard::index') }}"><i class="fa fa-comments nav-icon"></i> Messages</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <i class="fa fa-user nav-icon"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('dashboard::index') }}"><i class="fa fa-tachometer nav-icon"></i> Dashboard</a></li>
                            <li><a href="{{ route('dashboard::index') }}"><i class="fa fa-comments nav-icon"></i> Messages</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('auth::logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>