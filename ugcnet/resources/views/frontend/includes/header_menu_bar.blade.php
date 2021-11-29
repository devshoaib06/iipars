@push('page_meta')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
<section class="mainheader">
    <div class="container">
        <div class="d-flex align-item p-rel">
        <a href="#"  class="menu-btn"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <div class="logo"><a href="{{route('home')}}"><img src="{{ asset('public/frontend/images/logo.png') }}" title="Teachinns"  alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF"/></a>
        </div>
        
        @if( isset($exams) )
            
            
            <div class="course">
                <a href="#"><i class="fa fa-th" aria-hidden="true"></i>&nbsp;Courses</a>

                <div class="menulist">

                    <ul>
                        @foreach ($exams as $exam )
                            
                            <li>
                                <a href="#">{{$exam->exam_name}}</a>
                                @if($exam->id==1)
                                    <?php 
                                        $myLibrary=new \App\library\myFunctions;
                                        $allSubjects=$myLibrary->getExamSubject($exam->id);
                                    
                                    ?>
                                    <ul>
                                        @if($exam->id==1)
                                        <!-- <li>
                                            <h4>All Pack</h4></li> -->
                                        
                                        <li><a href="#">Combo Pack</a>
                                           @if( isset($combo_pack_products) && count($combo_pack_products) > 0)
                                            <ul class="o-flow-y h-350 w-350">
                                                <!-- <li>
                                                    <h4>All Combo Courses</h4></li> -->
                                                    
                                                @foreach ($combo_pack_products as $combo_pack_product)
                                                    <li>
                                                        <a href="{{route('front.corsCont',['exam'=>Str::slug( $exam->exam_name, '-'),'slug'=>$combo_pack_product->slug])}}">
                                                            {{$combo_pack_product->name}}
                                                        </a>
                                                    </li>
                                                @endforeach
                                               
                                                
                                            </ul>
                                            @endif 
                                        </li>
                                        <li><a href="#">Individual Pack</a>
                                        @endif 
                                          @if( isset($allSubjects) && count($allSubjects) > 0)
                                            <ul>
                                                <!-- <li>
                                                    <h4>Subjects</h4></li> -->
                                                @foreach ($allSubjects as $subject)
                                                    <?php 
                                                        $allCourses=[];
                                                        $allCourses=$myLibrary->getCourseExamSubject($exam->id,$subject->id);
                                                    ?>
                                                    <li>
                                                        <a href="#">{{$subject->subject_name}}</a>
                                                        @if(count($allCourses)>0)
                                                        <ul>
                                                            @foreach ($allCourses as $allCourse)
                                                        <li><a href="{{route('front.corsCont',['exam'=>Str::slug( $exam->exam_name, '-'),'slug'=>$allCourse->slug])}}">{{$allCourse->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                        @endif
                                                    </li>
                                                    
                                                @endforeach
                                               
                                            </ul>
                                           @endif
                                        </li>
                                        
                                       
                                    </ul>
                                @else
                                <?php 
                                    $myLibrary=new \App\library\myFunctions;
                                    $allSubjects=[];
                                    $allSubjects=$myLibrary->getExamSubject($exam->id);
                                    
                                ?>
                                        <!-- <li>
                                            <h4>Subjects</h4></li> -->
                                        @if(count($allSubjects)>0)       
                                        <ul>
                                        @foreach ($allSubjects as $subject)
                                        <?php 
                                            $allCourses=$myLibrary->getCourseExamSubject($exam->id,$subject->id);
                                        ?>
                                        <li>
                                            <a href="#">{{$subject->subject_name}}</a>
                                            @if(isset($allCourses) && count($allCourses)>0)
                                            <ul>
                                                @foreach ($allCourses as $allCourse)
                                                 <li><a href="{{route('front.corsCont',['exam'=>Str::slug( $exam->exam_name, '-'),'slug'=>$allCourse->slug])}}">{{$allCourse->name}}</a></li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                            
                                        @endforeach
                                        
                                        </ul>
                                        @endif
                                    
                                @endif
                            </li>
                        @endforeach
                        <li>
                            <a href="{{url('/ugc-net-syllabus-pdf-free-download')}}">UGC-NET Syllabus PDF Free Download</a>
                        </li>
                        <li>
                            <a href="{{url('/csir-net-syllabus-free-download')}}">CSIR-NET Syllabus Free Download</a>
                        </li>
                    </ul>

                </div>

            </div>
        @endif
            @php 
                $segment1 =  Request::segment(1);  
                $segment2 =  Request::segment(2);  
            @endphp 
            <div class="rightmenu">
                <ul>
                    <li @if($segment1 == 'about-us') @endif><a href="{{ url('/about-us') }}">About Us</a></li>
                    <li @if($segment1 == 'why-us') @endif><a href="{{ url('/why-us') }}">Why Us</a></li>
                    {{-- <li><a href="#">E-Book</a></li> --}}
                    <li @if($segment1 == 'articles') @endif>
                        <a href="{{route('articles',['category'=>'current-affairs'])}}">Current Affairs</a>
                        {{-- <a href="javascript::void(0)">Articles</a> --}}
                        {{-- <ul>
                        <li><a href="{{route('showArticleForm')}}">Submit Your Article</a></li>
                        <li><a href="{{route('all-articles')}}">All Articles</a></li>
                        @forelse ($articlecats as $articlecat)
                        <li><a href="{{route('articles',['category'=>$articlecat->slug])}}">{{$articlecat->name}}</a></li>
                            
                        @empty
                            
                        @endforelse        
                            
                        </ul> --}}
                    </li>
                    <li><a href="{{route('contributorlogin')}}">Contributor</a></li>
                    <li><a href="{{route('resellerlogin')}}">Reseller</a></li>
                    {{-- <li>
                        @auth
                            <a href="{{route('showInstruction')}}">Mock Test</a>
                            
                        @endauth
                        @guest
                            <a href="#" class="mock-test-login" data-toggle="modal" data-target=".login-modal">Mock Test</a>
                        @endguest
                    </li> --}}
                    <li class="{{$segment1 == 'contact-us'?'active':''}}"><a href="{{ url('/contact-us') }}">Contact Us</a></li>
                </ul>

            </div>

            <div class="rightbutton log-btn">
                
                @auth
                <div class="dropdown">
                    <a href="#" class="login dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" style="text-transform:capitalize;">
                        {{Auth::user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" style="margin-top:27px;">
                        @if(Auth::user()->user_type_id==2)
                        <li>
                        <a href="{{route('dashboard')}}" class="page-unload-prevent">
                                <i class="fa fa-user"></i> My Dashboard </a>
                        </li>
                        @elseif(Auth::user()->user_type_id==3)
                        <li>
                        <a href="{{route('contributordashboard')}}" class="page-unload-prevent">
                                <i class="fa fa-user"></i> My Dashboard </a>
                        </li>
                        @elseif(Auth::user()->user_type_id==4)
                        <li>
                        <a href="{{route('resellerdashboard')}}" class="page-unload-prevent">
                                <i class="fa fa-user"></i> My Dashboard </a>
                        </li>
                        @endif
                        <li class="divider"> </li>
                        <li>
                            <a href="{{route('frontendlogout')}}" class="page-unload-prevent">
                                <i class="fa fa-lock"></i> Log Out </a>
                        </li>
                    </ul>
                </div>
                @endauth
               @guest
               <?php 
                   $restricted_url=array('contributor','reset-password'); 
               ?>
               @if(!in_array($segment1,$restricted_url))            
                <a href="#" class="login" data-toggle="modal" data-target=".login-modal">login</a>
                
               @endif 
               @endguest 
                
                <div class="clearfix"></div>
            </div>
            
            
    
            <div class="clearfix"></div>
            </div>
    </div>
    @if(count($newsfeed)>0)
    <div class="container">
        <div class="row">    
            <div class="col-sm-12 col-md-12">
                <div class="announceCont">
                    <div class="announceHead">
                        <h4>News Feed:</h4>
                    </div>
                    <div id="newsTicker" class="accounceBox ticker">
                        <ul>
                            @foreach ($newsfeed as $new)
                                
                            <li>{!!html_entity_decode($new->newsfeed)!!}</li>
                            @endforeach
                            
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
 </section>


 <div class="site-overlay"><span class="crossmenu"><img src="{{ asset('public/frontend/images/crossicon.png') }}"  alt="Cross"/></span></div>




 <!-- Modal -->




  