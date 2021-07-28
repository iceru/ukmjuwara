<div class="col-lg-2 sidebar-admin">
    <a href="/">
        <h5>#UKMJUWARA</h5>
    </a>
    <div class="admin mb-4 mt-4 d-flex">
        <img src="/images/default-user.jpg" class="me-3 circular" width="50" height="50" alt="">
        <div class="admin-text">
            <p>
                {{ Auth::user()->name }}
            </p>
            <small class="text-capitalize">
                @foreach (Auth::user()->roles as $role)
                {{ $role->name }}
                @endforeach
            </small>
        </div>
    </div>
    <ul>
        <a href="{{ route('admin.dashboard') }}">
            <li class="{{ (request()->is('admin')) ? 'active' : '' }}"><i class="fas fa-home fa-fw"></i> &nbsp; Dashboard</li>
        </a>
        <a href="{{ route('admin.catalog') }}">
            <li class="{{ (request()->is('admin/catalog')) ? 'active' : '' }}"><i class="fas fa-list-alt fa-fw"></i> &nbsp; Katalog</li>
        </a>
        <a href="{{ route('admin.ukm') }}">
            <li class="{{ (request()->is('admin/ukm')) ? 'active' : '' }}"><i class="fas fa-store fa-fw"></i> &nbsp; UKM</li>
        </a>
        <a href="{{ route('admin.article') }}">
            <li class="{{ (request()->is('admin/article')) ? 'active' : '' }}"><i class="fas fa-newspaper fa-fw"></i> &nbsp; Artikel</li>
        </a>
        <a href="{{ route('admin.slider') }}">
            <li class="{{ (request()->is('admin/slider')) ? 'active' : '' }}"><i class="fas fa-images fa-fw"></i> &nbsp; Slider Images</li>
        </a>
        <a href="{{ route('admin.sponsor') }}">
            <li class="{{ (request()->is('admin/sponsor')) ? 'active' : '' }}"><i class="fa fa-building fa-fw"></i> &nbsp; Sponsor</li>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
            this.closest('form').submit();">
                <li><i class="fas fa-sign-out-alt fa-fw"></i> &nbsp; Logout</li>
            </a>
        </form>
    </ul>
</div>
