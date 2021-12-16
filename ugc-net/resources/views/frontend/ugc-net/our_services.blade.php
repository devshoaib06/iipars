
@php
    $writing_consultancy_page_detl=$myfunction->writing_consultancy_detl_all();
    $book_publication_page_detl=$myfunction->book_publication_detl_all();
@endphp
@if(!empty($writing_consultancy_page_detl))
    @foreach($writing_consultancy_page_detl as $wcpd)
        <li><a href="{{ config('path.iipars_base_url') }}writing_consultancy/<?php echo $wcpd->slug; ?>"><i class="fa fa-angle-double-right"></i><?php echo $wcpd->title; ?></a></li>
    @endforeach
@endif
@if(!empty($book_publication_page_detl))
    @foreach($book_publication_page_detl as $bppd)
    <li><a href="{{ config('path.iipars_base_url') }}book_publication/<?php echo $bppd->slug; ?>"><i class="fa fa-angle-double-right"></i><?php echo $bppd->title; ?> </a></li>
    @endforeach
@endif