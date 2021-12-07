@push('page_meta')
    @if( isset($page_metadata) && !empty($page_metadata) )
    @if(@$page_metadata->meta_robots=="Teachinns" || @$page_metadata->meta_robots=="")
    	<?php @$page_metadata->meta_robots="index, follow";?>
    @endif
        <title>{{ $page_metadata->meta_title }}</title>
        {{-- <meta name="description" content="{{ $page_metadata->meta_desc==""?$page_metadata->meta_description:$page_metadata->meta_desc }}"> --}}
        <meta name="description" content="{{ $page_metadata->meta_desc}}">
        <meta name="keywords" content="{{ $page_metadata->meta_keyword }}">
        <meta name="robots" content="{{ @$page_metadata->meta_robots }}"/>
    @endif
@endpush