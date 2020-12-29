<ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    @foreach($list as $row)
    <li class="nav-item {{ $IsActive($row['label']) ? 'active' : '' }}">
        <a class="nav-link" href="{{ $row['label'] == 'dashboard' ? url('/dashboard/') : url('/dashboard/'.$row['label']) }}">{{ ucfirst($row['label']) }}</a>
    </li>
    @endforeach
</ul>