@if ($paginator->hasPages())
    <nav class="pagination">
        <ul class="pagination-list">
            {{-- @if ($paginator->onFirstPage())
                <li class="pager disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <a href="#" data-page="2"><</a>
                </li>
            @else
                <li class="pager">
                    <a data-page="2" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><</a>
                </li>
            @endif --}}

            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page">
                                <a href="{{ $url }}" data-page="1">{{ $page }}</a>
                            </li>
                        @else
                            <li><a class="active" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li class="pager">
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">></a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <a href="#" data-page="2">></a>
                </li>
            @endif


            {{-- <li class="active">
                <a href="#" data-page="1">1</a>
            </li> --}}
            {{-- <li>
                <a href="#" data-page="2">2</a>
            </li>
            <li>
                <a href="#" data-page="3">3</a>
            </li>
            <li class="pager">
                <a href="#" data-page="2">></a>
            </li> --}}
        </ul>
    </nav>
@endif