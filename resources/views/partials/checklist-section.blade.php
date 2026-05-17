<div class="mb-4 checklist-container" data-disaster="{{ $disaster }}" data-section="{{ Str::slug($title) }}">
    <div class="d-flex align-items-center gap-2 mb-3">
        <span class="badge {{ strpos($title, 'Prabencana') !== false ? 'bg-success' : (strpos($title, 'Saat') !== false ? 'bg-warning text-dark' : 'bg-secondary') }} p-2">
            {{ explode(' ', $title)[0] }}
        </span>
        <span class="small text-muted">{{ str_replace(['✅', '⚠️', '🔄'], '', $title) }}</span>
    </div>
    <ul class="list-unstyled ms-3">
        @foreach($items as $itemKey => $item)
        <li class="mb-3 checklist-item" style="cursor: pointer;">
            <i class="far fa-circle-check text-secondary me-2"></i> 
            {{ $item }}
        </li>
        @endforeach
    </ul>
</div>