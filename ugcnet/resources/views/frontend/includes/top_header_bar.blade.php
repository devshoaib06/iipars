@if( isset($exams) )
@php 
$segment1 =  Request::segment(1);  
@endphp
<div class="responsivepusi">
    <nav class="pushy pushy-left" data-focus="#first-link">
        <div class="pushy-content">
            <h3>Our Courses</h3>
            <div id="content" >
                <div class="u-vmenu">
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
            <h3>Main Menu</h3>
            <div id="content" >
                <div class="u-vmenu">
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
                        <li>
                            @auth
                                <a href="{{route('showInstruction')}}">Mock Test</a>
                                
                            @endauth
                            @guest
                                <a href="#" class="mock-test-login" data-toggle="modal" data-target=".login-modal">Mock Test</a>
                            @endguest
                        </li>
                        <li class="{{$segment1 == 'contact-us'?'active':''}}"><a href="{{ url('/contact-us') }}">Contact Us</a></li>

                    </ul>
                </div>
            </div>        
        </div>
    </nav>
</div>
@endif
{{-- @guest
 <section class="topsection"><a href="{{route('sign-up')}}">Sign up Now</a> to enroll in courses, follow best educators, interact with the community and track your progress.
    <a href="#" class="cross crossbar"><i class="fa fa-times" aria-hidden="true"></i></a>
 </section>
 @endguest  --}}
 <section class="topsection"><img alt="New" src="/public/frontend/images/newicon.gif" style="height:14px; width:30px"> Visit <a href="https://iipars.com/">www.iipars.com</a> for Research Activities & Information about 22 Academic and Job-Oriented Services.
    <a href="#" class="cross crossbar"><i class="fa fa-times" aria-hidden="true"></i></a>
 </section>
 <section class="top-contact-mb">
     <ul>
        <li><a href="mailto:{{trim(getSettings('enquiry_email'))}}"><i aria-hidden="true" class="fa fa-lg fa-envelope-o"></i></a></li>
        <li><a href="tel:{{trim(getSettings('phone'))}}"><i aria-hidden="true" class="fa fa-lg fa-mobile"></i></a></li>
        <li><a href="https://web.whatsapp.com/send?phone=7478071704&amp;text=Hi, I am interested in one of your courses. Reply me back to help me with further enquiry." target="_blank" class="whatsapp-blink"><img src="{{ asset('public/frontend/images/whatsapp-M.png') }}" alt="Whatsapp" style="height: 16px"></a></li>
        <li><a href="#" class="link-img"><img src="{{ asset('public/frontend/images/play-store-icon.png') }}" style="height: 16px"></a></li>
    </ul>
</section>
 <section class="top-contact">
    <div class="container">
     <span><i aria-hidden="true" class="fa fa-lg fa-envelope-o"></i>&nbsp;<a href="mailto:{{trim(getSettings('enquiry_email'))}}">{{trim(getSettings('enquiry_email'))}}</a></span>
     &nbsp;&nbsp;&nbsp;
     <span><i aria-hidden="true" class="fa fa-lg fa-mobile"></i>&nbsp;
        <a href="tel:{{trim(getSettings('phone'))}}">{{trim(getSettings('phone'))}}</a> 
        @if(trim(getSettings('phone-2')))
        / 
        <a href="tel:{{trim(getSettings('phone-2'))}}">{{trim(getSettings('phone-2'))}}</a>
        @endif
    </span>
     &nbsp;&nbsp;&nbsp;
     <span><a href="https://web.whatsapp.com/send?phone=7478071704&amp;text=Hi, I am interested in one of your courses. Reply me back to help me with further enquiry." target="_blank" class="whatsapp-blink link-img"><img src="{{ asset('public/frontend/images/whatsapp-M.png') }}" alt="Whatsapp" style="height: 16px">WhatsApp</a></span>&nbsp;&nbsp;&nbsp;
     <span><a href="https://play.google.com/store/apps/details?id=com.edu.teachinns" class="link-img"><img src="{{ asset('public/frontend/images/play-store-icon.png') }}" style="height: 16px"> Download Android App</a></span>
     </div>
 </section>