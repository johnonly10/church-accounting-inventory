@props([
    'cancelTitle' => 'Cancel',
    'cancelRoute' => route('staff.users.index'),
    'cancelIcon' => 'fas fa-times',

    'primaryTitle' => '',
    'primaryIcon' => 'fas fa-user',
    'primaryColor' => 'background:#6f42c1;border-color:#6f42c1;color:#fff;',
    'primaryButton' => 'btn px-4',
    'primaryId' => '#',
    'primaryDisabled' => false,
])


<div class="pt-3 border-top">
    <div class="d-flex gap-2 justify-content-end">
        <a href="{{ $cancelRoute }}" class="btn btn-light px-4">
            <i class="{{ $cancelIcon }}"></i> {{ $cancelTitle }}
        </a>
        <button type="submit" class="{{ $primaryButton }}" id="{{ $primaryId }}" style="{{ $primaryColor }}"
            {{ $primaryDisabled ? 'disabled' : '' }}>
            <i class="{{ $primaryIcon }}"></i> {{ $primaryTitle }}
        </button>
    </div>
</div>
