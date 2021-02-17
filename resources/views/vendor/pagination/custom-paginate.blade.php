@if ($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="disabled">
                <a href="javascript:void(0)">
                    <i class="mdi-navigation-chevron-left"></i>
                </a>
            </li>
        @else
            <li>
                <a href="{{ $paginator->previousPageUrl() }}">
                    <i class="mdi-navigation-chevron-left"></i>
                </a>
            </li>
        @endif
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a href="javascript:void(0)">{{ $page }}</a></li>
                    @else
                        <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())

            <li class="disabled"><a href="{{ $paginator->nextPageUrl() }}"><i
                        class="mdi-navigation-chevron-right"></i></a></li>
        @else
                <li><a href="javascript:void(0)"><i
                            class="mdi-navigation-chevron-right"></i></a></li>
        @endif
    </ul>
@endif
