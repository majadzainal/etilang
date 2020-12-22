<nav class="nav flex-column">
  
    @foreach($list as $row)
        <a class="nav-link {{ $IsActive($row['label']) ? 'active' : '' }}" href="{{ $row['label'] == 'dashboard' ? url('/dashboard/') : url('/dashboard/'.$row['label']) }}">
            {{ ucfirst($row['label']) }}
        </a>
    @endforeach
</nav>