<div class="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('pages::index') }}">
            <div class="logo"></div>
        </a>
    </div>
    <ul class="nav nav-sidebar">
        <li id="default" class="active">
            <a href="{{ route('dashboard::index') }}">
                <span class="glyphicon glyphicon-dashboard nav-icon"></span>
                <span class="nav-label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('items::index') }}">
                <span class="glyphicon glyphicon-phone nav-icon"></span>
                <span class="nav-label">Items</span>
            </a>
        </li>
        <li>
            <a href="{{ route('locations::index') }}">
                <span class="glyphicon glyphicon-map-marker nav-icon"></span>
                <span class="nav-label">Locations</span>
            </a>
        </li>
        <li>
            <a href="{{ '#' }}">
                <span class="glyphicon glyphicon-comment nav-icon"></span>
                <span class="nav-label">Message</span>
            </a>
        </li>
        <li>
            <a href="{{ '#' }}">
                <span class="glyphicon glyphicon-user nav-icon"></span>
                <span class="nav-label">Account</span>
            </a>
        </li>
    </ul>
</div>