@push('page_meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

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
                            @php
                                $subjects=$myfunction->getPapers();
                            @endphp
                            
                            @foreach ($subjects as $subject)
                                
                            <li>
                            <a href="#">
                                {!! $subject->paper_name=='PAPER - I'?"<h4 class='m-0'>Paper – I</h4>":$subject->paper_name !!}
                            </a>
                            
                                <ul class="dropdown" aria-labelledby="dropdownSubMenu1">
                                    <li>
                                        <h4 style="padding-left: 22px;">Units</h4>
                                    </li>
                                    <li role="separator" class="divider bg-dark" style="height: 1px; background: #ccc;">
                                    </li>
                                    @php
                                        $units=$myfunction->getPaperUnits(1,$subject->id);
                                        
                                    @endphp
                                    
                                    @foreach ($units as $unit)
                                        <li><a href="#">{{ $unit->subject_name }}</a>

                                            <ul class="dropdown" aria-labelledby="dropdownSubMenu2">
                                                @php
                                                    $courses=$myfunction->getCourseInfo(1,$subject->id,$unit->subject_id);
                                                @endphp
                                                @foreach ($courses as $course)
                                                    @php
                                                        $slug=$course->slug;
                                                    @endphp
                                                    @if ($course->is_preview==1)
                                                        <li><a
                                                            href="<?= url('/')?>/course/<?= $slug.'/'.$unit->subject_slug;?>">Preview</a>
                                                        </li>
                                                    @endif    
                                                    @if($course->is_preview==0)
                                                        <li><a href="<?= url('/')?>/course/<?= $slug.'/'.$unit->subject_slug ;?>">Order
                                                            Now</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                                
                                            </ul>

                                        </li>
                                    @endforeach    
                                   
                                </ul>
                            </li>
                            


                            </li>
                            @endforeach
                           

                        </ul>

                    </li>
                    <li><a href="economics.html">Economics</a></li>

                    <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy_all">Writing Consultancy</a>

                        <ul class="dropdown">
      
      
      
      
      
      
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/writing_consultancy">Research Paper
                              Writing
                              Consultancy</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/paper_publication">Research Paper
                              Publication
                              Consultancy</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/Manage_phd">Ph. D. Thesis writing
                              Consultancy</a></li>
      
      
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/mphil_dissertation">M.Phil.
                              Dissertation
                              writing Consultancy</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/project_work">Project Work Writing
                              Consultancy</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/writing_consultancy/data_analysis">Data Analysis &
                              Research
                              Methodology</a></li>
                        </ul>
                      </li>
      
      
                      <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication_all">Book Publication</a>
      
                        <ul class="dropdown">
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/book_writing_consultancy">Book Writing
                              Consultancy</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/book_publication_consultacy">Book
                              Publication Consultancy</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/thesis_publication">Thesis to Book
                              Publication</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/dissertation_publication">M.Phil.
                              Dissertation to Book Publication</a></li>
      
                          <li><a href="{{ config('path.iipars_base_url') }}cms/book_publication/project_work_book">Project Work to
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





