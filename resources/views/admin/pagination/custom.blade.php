<style>
    /* Custom pagination styling */
.pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination .page-item {
    margin: 0 5px;
}

.pagination .page-link {
    background-color: #007bff;
    color: white;
    border-radius: 50%;
    padding: 10px 15px;
    transition: background-color 0.3s ease;
}

.pagination .page-link:hover {
    background-color: #0056b3;
}

.pagination .page-item.active .page-link {
    background-color: #28a745;
    color: white;
    border: 1px solid #28a745;
}

.pagination .page-item.disabled .page-link {
    background-color: #e9ecef;
    color: #6c757d;
}
    </style>


<!-- <div class="pagination-info"> -->
    <!-- Show total number of records -->
    <!-- <p>Total Records: {{ $paginator->total() }}</p> -->

    <!-- Show range of records on the current page -->
    <!-- <p>Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} records</p> -->
<!-- </div> -->
<div class="pagination-container">
    @if ($paginator->hasPages())
        <ul class="pagination">
            {{-- Previous Page Link --}}
            <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
            </li>

            {{-- Pagination Links --}}
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="page-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            <li class="page-item {{ $paginator->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next &raquo;</a>
            </li>
        </ul>
    @endif
</div>
