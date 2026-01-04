@props([
    'route' => '#',
    'aClass' => 'btn btn-sm btn-outline-warning border-0',
    'title' => 'Archive',
    'icon' => 'fas fa-archive',
    'method' => 'PATCH',
    'name' => 'archive',
])

<form action="{{ $route }}" method="POST" class="d-inline">
    @csrf
    @method($method)

    <button type="submit" class="{{ $aClass }} {{ $name }}" title="{{ $title }}">
        <i class="{{ $icon }}"></i>
    </button>
</form>
