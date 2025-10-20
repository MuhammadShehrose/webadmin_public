<div class="d-flex justify-content-between align-items-center mt-2">
    <p class="text-muted mb-0">
        Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
    </p>

    @if ($data->hasPages())
        <ul class="pagination float-end mb-0">
            {{-- Previous Page Link --}}
            <li class="page-item page-prev {{ $data->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link"
                    href="{{ $data->previousPageUrl() ? $data->appends(request()->query())->previousPageUrl() : 'javascript:void(0);' }}"
                    tabindex="-1">
                    Prev
                </a>
            </li>

            {{-- Pagination Elements --}}
            @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                @php
                    // Preserve existing query params
                    $urlWithQuery = $data->appends(request()->query())->url($page);
                @endphp
                <li class="page-item {{ $page == $data->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $urlWithQuery }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item page-next {{ !$data->hasMorePages() ? 'disabled' : '' }}">
                <a class="page-link"
                    href="{{ $data->nextPageUrl() ? $data->appends(request()->query())->nextPageUrl() : 'javascript:void(0);' }}">
                    Next
                </a>
            </li>
        </ul>
    @endif

</div>
