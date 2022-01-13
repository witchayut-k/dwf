@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- First Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"  aria-disabled="true">
            <a class="page-link" href="#" aria-label="First">
                <span aria-hidden="true" class="first"></span>
                <span class="sr-only">First</span>
            </a>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->toArray()['first_page_url'] }}" aria-label="First">
                <span aria-hidden="true" class="first"></span>
                <span class="sr-only">First</span>
            </a>
        </li>
        @endif

        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true" class="previous"></span>
            <span class="sr-only">Previous</span>
        </li>
        @else
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true" class="previous"></span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                <span aria-hidden="true" class="next"></span>
                <span class="sr-only">Next</span>
            </a>
        </li>
        @else
        <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true" class="next"></span>
                <span class="sr-only">Next</span>
        </li>
        @endif


         {{-- Last Page Link --}}
         @if ($paginator->currentPage() === $paginator->lastPage())
         <li class="page-item disabled"  aria-disabled="true">
            <span aria-hidden="true" class="last"></span>
            <span class="sr-only">Last</span>
         </li>
         @else
         <li class="page-item">
            <a class="page-link" href="{{ $paginator->toArray()['last_page_url'] }}" aria-label="Last">
                <span aria-hidden="true" class="last"></span>
                <span class="sr-only">Last</span>
            </a>
        </li>
         @endif
    </ul>
</nav>
@endif