@if (isset($breadcrumbs) && count($breadcrumbs))
<div class="breadcrumb">
    <ol class="breadcrumb-section">
        @foreach ($breadcrumbs as $breadcrumb)
            @if ($breadcrumb->url && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                </li>
            @else
                <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ol>
    <div class="page-title">
        <span class="text">{{ $breadcrumb->title }}</span>
    </div>
</div>
@endif
