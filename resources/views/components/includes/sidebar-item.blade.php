@props([
    'title' => '',
    'route' => '#',
    'icon' => 'fas fa-circle',
    'hasArrow' => false,
])


<li class="">
    <a href="{{ $route }}" class="{{ $hasArrow ? 'has-arrow' : '' }}" aria-expanded="false">
        <div class="nav_icon_small">
            <i class="{{ $icon }}"></i>
        </div>
        <div class="nav_title">
            <span>{{ $title }}</span>
        </div>
    </a>
    @if ($hasArrow)
        <ul>
            {{ $slot }}
        </ul>
    @endif
</li>
