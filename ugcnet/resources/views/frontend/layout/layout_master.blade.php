@include('frontend.includes.header')

<header id="header" class="header">
	
    @include('frontend.includes.top_header_bar')
   

    @include('frontend.includes.header_menu_bar')
</header>

@yield('page_content')
@yield('page_level_plugins')


@include('frontend.includes.footer')

