@push('page_meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<?php
$myfunction = new App\library\myFunctions();
$protocol = $myfunction->getYoutubeProtocol();
// $allCourses=$myfunction->getCourses(1,2);

// echo "<pre>";
//     print_r($allCourses[0]->product);
// echo "</pre>";
?>
<div class="header-nav p_cus_mobile_toggol_menu">
    <div class="header-nav-wrapper navbar-scrolltofixed bg-white">
        <div class="container">
            <nav id="menuzord" class="menuzord red">
                <ul class="menuzord-menu">
                    <li><a href="{{ config('path.iipars_base_url') }}">Home</a></li>
                    <li><a href="{{ config('path.iipars_base_url') }}about_us">About Us</a></li>
                    <li class="active"><a href="//">UGC - NET</a>
                        <ul class="dropdown" aria-labelledby="dropdownMenu1">
                            @include('frontend.includes.header_ugc_menu_bar')
                    </li>


                </ul>
                </li>
                <li><a href="economics.html">Economics</a></li>

                <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy_all">Writing Consultancy</a>

                    <ul class="dropdown">







                        <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/writing_consultancy">Research
                                Paper
                                Writing
                                Consultancy</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/paper_publication">Research
                                Paper
                                Publication
                                Consultancy</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/Manage_phd">Ph. D.
                                Thesis writing
                                Consultancy</a></li>



                        <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/mphil_dissertation">M.Phil.
                                Dissertation
                                writing Consultancy</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/project_work">Project
                                Work Writing
                                Consultancy</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/data_analysis">Data
                                Analysis &
                                Research
                                Methodology</a></li>
                    </ul>
                </li>


                <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication_all">Book Publication</a>

                    <ul class="dropdown">

                        <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/book_writing_consultancy">Book
                                Writing
                                Consultancy</a></li>

                        <li><a
                                href="{{ config('path.iipars_base_url') }}cms/book_publication/book_publication_consultacy">Book
                                Publication Consultancy</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/thesis_publication">Thesis
                                to Book
                                Publication</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/dissertation_publication">M.Phil.
                                Dissertation to Book Publication</a></li>

                        <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/project_work_book">Project
                                Work to
                                Book Publication</a></li>

                    </ul>



                </li>

                <!--  <li><a href="Manage_ebook/book_list">Our Books</a></li> -->





                <li><a href="#">Gallery</a>
                    <ul class="dropdown">
                        <li><a href="https://iipars.com/Manage_image">Image</a>
                        <li><a href="https://iipars.com/Manage_video">Video</a>
                        </li>
                    </ul>
                </li>

                <!-- <li><a href="#">Blogs</a></li> -->

                <!--  <li ><a href="https://iipars.com/video-gallery">Video Gallery</a></li> -->



                <li><a href="https://iipars.com/contact-us">Contact Us</a></li>

                </ul>

            </nav>
        </div>
    </div>
</div>
