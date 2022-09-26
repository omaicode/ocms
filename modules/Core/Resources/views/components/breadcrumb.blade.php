<div class="pt-4 pb-3">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home icon icon-xxs"></i></a></li>
            @foreach($items as $item)
                <li class="breadcrumb-item {{ isset($item['active']) ? 'active' : '' }}"><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
            @endforeach
        </ol>
    </nav>
    {{ $slot }}
</div>
