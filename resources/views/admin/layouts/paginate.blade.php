@if ($paginators->hasPages())
    <div class="card-footer text-right">
        <nav class="d-inline-block">
        <ul class="pagination mb-0">
            <li class="page-item {{($paginators->onFirstPage())?'disabled':''}}">
            <a class="page-link" href="{{ $paginators->url(1) }}"><i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i></a>
            </li>
            <li class="page-item {{($paginators->onFirstPage())?'disabled':''}}">
            <a class="page-link" href="{{ $paginators->previousPageUrl() }}" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
            </li>
            {{-- @foreach ( as )
            
            @endforeach --}}
            @for ($page = 0; $page < $paginators->lastPage(); $page++)
            @if ($page+1 <= ($paginators->currentPage() + 2) && $page+1 >= ($paginators->currentPage() - 2))
            <li class="page-item {{($page+1 == $paginators->currentPage())?'active':''}}"><a class="page-link" href="{{$paginators->url($page+1)}}">{{$page + 1}} <span class="sr-only">(current)</span></a></li>
            @endif
            @endfor
            {{-- <li class="page-item"><a class="page-link" href="#">2</a></li> --}}
            {{-- <li class="page-item"><a class="page-link" href="#">3</a></li> --}}

            <li class="page-item {{(!$paginators->hasMorePages())?'disabled':''}}">
                <a class="page-link" href="{{ $paginators->nextPageUrl() }}"><i class="fas fa-chevron-right"></i></a>
            </li>
            <li class="page-item {{(!$paginators->hasMorePages())?'disabled':''}}">
                <a class="page-link" href="{{ $paginators->url($paginators->lastPage()) }}"><i class="fas fa-chevron-right"></i><i class="fas fa-chevron-right"></i></a>
            </li>
        </ul>
        <br>

        <center>
            <span>{{$paginators->currentPage()}} of {{$paginators->lastPage()}} pages</span>
        </center>
        </nav>
</div>
@endif