@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

    <!-- <div class="hidden sm:flex-1 sm:flex sm:gap-2 sm:items-center sm:justify-between">  this is the default so we are gonna redesign this by using our pagiunation.css-->
    <div class="pagination-container">
        <!-- <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-600">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div> this one is the default too babe-->

        <div class="pagination-info">

            @if ($paginator->firstItem())

            Showing
            <strong>{{ $paginator->firstItem() }}</strong>
            -
            <strong>{{ $paginator->lastItem() }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            results

            @else

            No results found

            @endif

        </div>

        <div class="pagination-links">
          

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span class="page-btn disabled"> <!--we change the default class to our css class-->
                        <svg class="page-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"> <!--we change the default class to our css class-->
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-btn" aria-label="{{ __('pagination.previous') }}"> <!--we change the default class to our css class-->
                    <svg class="page-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"> <!--we change the default class to our css class-->
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <span aria-disabled="true">
                    <span class="page-dots">{{ $element }}</span> <!--we change the default class to our css class-->
                </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span aria-current="page">
                    <span class="page-btn active">{{ $page }}</span> <!--we change the default class to our css class-->
                </span>
                @else
                <a href="{{ $url }}" class="page-btn"> <!--we change the default class to our css class-->
                    {{ $page }}
                </a>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-btn" aria-label="{{ __('pagination.next') }}">
                    <svg class="page-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">  <!--we change the default class to our css class-->
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
                @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span class="page-btn disabled"> <!--we change the default class to our css class-->
                        <svg class="page-icon" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"> <!--we change the default class to our css class-->
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @endif
        
        </div>
    </div>
</nav>
@endif