@if ($paginator->hasPages())
@php
    $myLibrary=new \App\library\myFunctions();
@endphp
    <nav>
        <ul class="pagination result">
           
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @php
                //   echo "<pre>";   
                //        print_r($paginator[0]->mock_test_id);
                //     echo "</pre>";   
                    //dd($elements)
                @endphp
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                    @php
                    //echo "<pre>";  
                        $iscorrect=$myLibrary->checkCorrection($paginator[0]->mock_test_id,$page);  
                       //print_r($iscorrect);
                    //echo "</pre>";   
                   @endphp
                        @if ($page == $paginator->currentPage())
                    <li class="active "  aria-current="page"><span class="{{$iscorrect==1?'correntans':'incorrectans'}}">{{ $page }}</span></li>
                        @else
                            <li ><a href="{{ $url }}" class="{{$iscorrect==1?'correntans':'incorrectans'}}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
