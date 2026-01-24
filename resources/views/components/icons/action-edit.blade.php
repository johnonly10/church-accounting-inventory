@props([
    'icon' => 'fas fa-edit',
    'route' => '#',
    'editClass' => 'btn btn-sm btn-outline-primary border-0',
    'editTitle' => 'Edit',
])



<a href="{{ $route }}" class="{{ $editClass }}" title="{{ $editTitle }}">
    <i class="{{ $icon }}"></i>
</a>
