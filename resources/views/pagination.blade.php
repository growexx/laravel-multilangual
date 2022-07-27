@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active btn btn-light btn-lg"><span>{{ $page }}</span></li>
                    @else
                        <li><a href="{{ $url }}" class="btn btn-light btn-lg">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
    </ul>
@endif
