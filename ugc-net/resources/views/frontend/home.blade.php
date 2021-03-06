@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

@include('frontend.includes.home_banner')
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>
<section class="iconsection">
    <div class="container">
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="{{ asset('public/frontend/images/courses_icon.png') }}" class="lefticon"  alt="Best Online Courses for CSIR-UGC NET/SET/JRF exam
                "/>
                <span>Best Online Courses</span>
                Explore a variety of fresh topics
            </div>
        </div>
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="{{ asset('public/frontend/images/instruction.png') }}" class="lefticon"  alt="Expert Instruction for CSIR-UGC NET/SET/JRF exam
                "/>
                <span>Expert Instruction</span>
                Find the right instructor for you
            </div>
        </div>
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="{{ asset('public/frontend/images/access.png') }}" class="lefticon"  alt="Lifetime access of all courses materials
                "/>
                <span>Lifetime Access</span>
                Learn on your schedule
            </div>
        </div>
    </div>
</section>

<section class="course-highlight">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
            <a href="{{url('ugc-nta-set-jrf-new')}}">
                    <div class="ugc-csir-courses">
                        <h4>UGC-NTA NET/SET/JRF</h4>
                    </div>
                </a>
            </div>
            <div class="col-sm-6">
                <a href="{{url('csir-net-set-jrf')}}">
                    <div class="ugc-csir-courses">
                        <h4>CSIR NET/SET/JRF</h4>
                    </div>
                </a>
            </div>
        </div>
    </div>

</section>


<section class="homeBodyCont">

@if( isset($home_feature_courses) )
    <div class="container">
        <div class="row d-flex f-wrap">
        
    @foreach($home_feature_courses as $home_feature_course)
    <?php 
        $exam_slug = $myfunction->getProductExam($home_feature_course->product_id);
        $exam_name = $myfunction->getProductExamName($home_feature_course->product_id);
        $course_image=asset('storage/uploads/courses/noimage.jpeg');
        if($home_feature_course->image){
            $course_image=asset('storage/uploads/courses/thumbs/'.$home_feature_course->image);
        }
        $exists = \Storage::disk(config('disk.get_course'))->exists('thumbs/'.$home_feature_course->image);
        if(!$exists){
            $course_image=asset('storage/uploads/courses/noimage.jpeg');

        }

    ?>
            <div class="col-sm-12 col-md-4 col-lg-4 courseCont">


                <div class=" b-outline">
                    <a href="{{route('front.corsCont', array('exam'=>$exam_slug,'slug' => $home_feature_course->slug))}}">
                        <div class="bodyContHead">
                    <div class="">
                        
                        <div class="course-title"><h2>{{ $home_feature_course->name }}</h2>
                        <h4>{{$exam_name}}</h4></div>
                        <div class="course-img"><img src="{{$course_image}}" alt="{{$home_feature_course->img_alt}}"  /></div>
                        <div class="clear"></div>
                    </div>
                    <!-- <div class="course-img">
                        
                    </div> -->
                    
                        
                        <!-- <a href="#" class="seeall">See All</a>-->
                        </div>


                        <div class="outerleftsection">
                            <h3>What you'll Get</h3>
                            <div class="short-desc">                        
                            {!!html_entity_decode($home_feature_course->short_description)!!}
                            </div>
                        @if((floor($home_feature_course->price)==0))    
                        <div class="price ">
                            Free
                        </div>
                        @else
                        <div class="price ">
                            @if($home_feature_course->revised_price!="")
                            <span>???{{ number_format(floor($home_feature_course->price)) }}</span>
                            @endif
                            ???{{ number_format(floor($home_feature_course->revised_price!=""?($home_feature_course->revised_price):$home_feature_course->price)) }}
                        </div>
                        
                        @endif
                    </a>

                    <div class="row">
                        <div class="col-sm-6">
                             @guest
                            <a href="" class="buynow buy-now-login" data-toggle="modal" data-productid="{{$home_feature_course->product_id}}" data-target=".login-modal">Enroll Now</a>
                        @endguest
                        @auth
                        <form action="{{route('billing')}}" method="post">
                            @csrf
                        <input type="hidden" name="product_id" value="{{$home_feature_course->product_id}}">

                            {{-- <a href="{{route('front.corsCont', array('exam'=>$exam_slug,'slug' => $home_feature_course->slug))}}" class="buynow">Enroll Now</a> --}}
                            <input type="submit" class="buynow" value="Enroll Now">
                        </form>    
                        @endauth
                            
                        </div>
                        @if ($home_feature_course->no_of_students)
                            
                        <div class="col-sm-6 text-right">
                            <i class="fa fa-users"></i> {{$home_feature_course->no_of_students}} Students
                        </div>
                        
                        @endif
                        
                    </div>

                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="dateCont">
                            <h3>Important Dates</h3>
                            {!!html_entity_decode($home_feature_course->important_notice)!!}
                        </div>
                    </div> --}}
                    
                </div>
            </div>
        
@endforeach
        </div>
        
    </div>
</section>
@endif
    @if(count($preview_courses)>0)
    <section class="previewSection" style="display: none;">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="previewHead">
                        <h2>Preview Courses</h2>
                    </div>
                </div>
                @forelse ($preview_courses as $preview_course)
                <?php 
                    $exam_slug = $myfunction->getProductExam($preview_course->product_id);
                    $exam_name = $myfunction->getProductExamName($preview_course->product_id);

                ?>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                        <div class="b-outline previewBox">
                            <a href="{{route('front.corsCont', array('exam'=>$exam_slug,'slug' => $preview_course->slug))}}">
                            <div class="bodyContHead">
                                <h2>{{$preview_course->name}}</h2>
                                <h4>{{$exam_name}}</h4>
                            </div>
                            <div class="outerleftsection">
                                <h3>What you'll Get</h3>
                                <div class="short-desc preview-short-desc">                        
                                    {!!html_entity_decode($preview_course->short_description)!!}
                                </div>
                            </a>    
                            @guest
                            <a href="" class="buynow buy-now-login" data-toggle="modal" data-productid="{{$preview_course->product_id}}" data-target=".login-modal">Preview Now</a>
                            @endguest
                            @auth
                            <form action="{{route('billing')}}" method="post">
                                @csrf
                            <input type="hidden" name="product_id" value="{{$preview_course->product_id}}">

                                {{-- <a href="{{route('front.corsCont', array('exam'=>$exam_slug,'slug' => $home_feature_course->slug))}}" class="buynow">Enroll Now</a> --}}
                                <input type="submit" class="buynow" value="Preview Now">
                            </form>    
                            @endauth
                                {{-- <input type="submit" class="previewnow" value="Preview Now"> --}}
                            </div>
                        </div>
                    </div>
                    
                @empty
                    <p>Preview Course Coming soon.</p>
                @endforelse

                {{-- <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="b-outline">
                        <div class="bodyContHead">
                            <h2>Life Sciences Study Material</h2>
                            <h4>CSIR NET/SET/JRF</h4>
                        </div>
                        <div class="outerleftsection">
                            <h3>What you'll Get</h3>
                            <div class="short-desc">                        
                                <p>
                                This highly innovative course is designed by our expert and well-qualified faculties. It ensures the aspirants to qualify NET/SET covering entire syllabus by minimum effort.
                                </p>
                                <P>
                                    Product Features
                                </p>
                                <ul>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Individualize instructional model&nbsp;</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">The scientific and systematic study material&nbsp;</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Blend of experience with technology</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">in-depth analysis of previous year questions</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Unique study material</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Model question paper</span></span></li>
                                    <li><span style="font-size:14px">Full-time faculty support</span></li>
                                </ul>
                            </div>
                            <input type="submit" class="previewnow" value="Preview Now">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
                    <div class="b-outline">
                        <div class="bodyContHead">
                            <h2>Chemical Sciences Study Material</h2>
                            <h4>CSIR NET/SET/JRF</h4>
                        </div>
                        <div class="outerleftsection">
                            <h3>What you'll Get</h3>
                            <div class="short-desc">                        
                                <p>
                                This highly innovative course is designed by our expert and well-qualified faculties. It ensures the aspirants to qualify NET/SET covering entire syllabus by minimum effort.
                                </p>
                                <P>
                                    Product Features
                                </p>
                                <ul>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Individualize instructional model&nbsp;</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">The scientific and systematic study material&nbsp;</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Blend of experience with technology</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">in-depth analysis of previous year questions</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Unique study material</span></span></li>
                                    <li><span style="font-size:14px"><span style="font-family:times new roman,times,serif">Model question paper</span></span></li>
                                    <li><span style="font-size:14px">Full-time faculty support</span></li>
                                </ul>
                            </div>
                            <input type="submit" class="previewnow" value="Preview Now">
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    @endif
    @if (count($home_videos)>0)
        
        <section class="videosection">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 col-xs-8">
                        <h2>Some Of Our Videos</h2>
                    
                    </div>
                    <div class="col-sm-3 col-xs-4">
                        <a href="#" class="seeall">See All</a>
                        <div class="clearfix"></div>
                    </div>
                </div>
            
                <div class="videoinner">
                    <div class="row">
                        @foreach($home_videos as $video)
                        <?php
                            $video_embed_link = $myfunction->parseYouTubeUrl($video->video_url);
                        ?>
                        <div class="col-sm-6 col-md-3">
                        
                            <div class="tabdiv">
                                <div class="tabtop">
                                    <iframe width="350" height="233" src="{{$protocol}}://www.youtube.com/embed/<?php echo $video_embed_link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                                <h3>{{$video->title}}</h3>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="getupdate">
        <div class="container">
            <form  enctype="multipart/form-data" id="newsletter-form">
                {{ csrf_field() }}
                <h3>Get free Updates from Teachinns</h3>
                <h4>Please enter your email ID and hit the subscribe buttons to receives free updates</h4>
                <span class="p-relative">  
                <input type="text" class="subtext" id="email" name="email">
                <input type="submit" value="Subscribe" class="subbut">
                </span>
            </form>
            <h4 class="notification-msg"></h4>
        </div>
    </section>
    
        
    @if( isset($home_testimonial_text) )
    

    <section class="testimonials">
        <div class="container">

            <h2>Testimonials</h2>

            <section id="demos" class="outerslider">
                <div class="owl-carousel2">
                    @foreach( $home_testimonial_text as $ts_t )
                    <div class="item">

                        <div class="testibox">
                            <img src="{{ asset('public/frontend/images/invited.jpg') }}" class="inviterd" alt="" />
                            <p>{{ $ts_t->testimonial_text }}</p>
                            <span>{{ $ts_t->student_name }}</span>
                            <br>
                            <em>{{ $ts_t->student_course }}</em>
                        </div>

                    </div>
                    @endforeach
                    

                </div>

            </section>

        </div>
    </section>

    @endif
    
    <section class="contribute">
        <div class="container">
            <div class="innerbox">
                <div class="box border">
                    <div class="boxinner">
                        <h3>Become a Contributor</h3>
                        {{-- <p>Cras volutpat tristique risus nec consectetur. Morbi posuere faucibus orci at pulvinar. Nam tempor velit vitae eros hendrerit accumsan. Sed at nisi nulla. Nulla tincidunt mauris nec egestas convallis.</p> --}}
                        <a href="#" class="login">Join as Contributor</a>
                    </div>
                </div>
                <div class="box">
                    <div class="boxinner1">
                        <h3>Become a Reseller</h3>
                        {{-- <p>Cras volutpat tristique risus nec consectetur. Morbi posuere faucibus orci at pulvinar. Nam tempor velit vitae eros hendrerit accumsan. Sed at nisi nulla. Nulla tincidunt mauris nec egestas convallis.</p> --}}
                        <a href="#" class="login">Sign up as Reseller</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="display:none">
    <form action="{{route('billing')}}" method="POST" id="billing-login">
        @csrf
        <input type="hidden" value="" id="redirected_product">
        <input type="submit">
    </form>
    </section>
</section>
@endsection

@push('page_js')
<script>
    $("#newsletter-form").validate({
      errorElement: 'span',
    //   errorPlacement: function (error, element) {
       
    //         error.insertAfter($("#newsletter-form"));
        
    //  },
      rules: {      
          
            email:{
              required: true,
              email: true,
              remote: {
                type: 'post',
                        url: "{{url(route('newsletter-checkEmailExists'))}}",                                            
                        data: {
                              'email': function () { return $('#email').val(); },
                              "_token": "{{ csrf_token() }}"
                              }
              }  
          },
      },
      messages: {        
        email:{
              required: 'Email is required.',
              email: 'Please enter valid email.',
              remote:'You are already subscribe.'
          },
          
      },
      submitHandler: function (form) {
      event.preventDefault();
      //$(".subbut").prop("disabled", true);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let url="{{route('insert-newsletter')}}";
        let data=$('#newsletter-form').serialize();
        $.post(url,data,function(response){
           //$(".subbut").prop("disabled", false);
         
          if(response){
            
              let noti_text="Thanks for subscription."  
              $('.notification-msg').text(noti_text);   
          }else{
              let noti_text="Some thing went wrong."  
              $('.notification-msg').text(noti_text);
          }
        })          
      
      }
        
    });

    $('.buy-now-login').click(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let product_id=$(this).data('productid')
        let url="{{route('visitor-buy-product')}}";
        let data={
            product_id:product_id
        }
        $.post(url,data,function(response){

        })
    })
    $('.login-modal').on('hidden.bs.modal', function () {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let product_id=$(this).data('productid')
        let url="{{route('visitor-remove-buy-product')}}";
        $.post(url,function(response){

        })
    })

</script>
  

@if (isset($banner) && $banner->status==1)
    
<div class="modal fade ad_modal modal-pop">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body ad_image">

            <div class="close_icon">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src="{{ asset('public/frontend/images/cross_icon.png') }}" alt="close"></button>
            </div>
            <div class="outerleftsection">
                @if ($banner->title)
                <div class="modal-title">
                    <h2 >{{$banner->title}}</h2>

                </div>
                @endif
                @if ($banner->description)
                {!!html_entity_decode($banner->description)!!}
                @endif
            </div> 
            <div class="popupImg">
                @if ($banner->image)
                <img src="{{asset('storage/uploads/banner/'.$banner->image)}}" alt="{{$banner->title}}" style="width: 100%">
                @endif
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
</div> 
<script src="{{asset('public/frontend/js/jquery.cookie.js')}}"></script>
<script>
    $(document).ready(function () {
        if ($.cookie('pop') == null) {
         $('.ad_modal').modal('show');
         $.cookie('pop', '1');
        }

        // Check if user saw the modal
        // var key = 'hadModal',
        //     //hadModal = localStorage.getItem(key);
        //     hadModal =Cookies.get(key)
        //     // Show the modal only if new user
        //     if (!hadModal) {
        //         $('.ad_modal').modal('show');
        //     }
            
        //     // If modal is displayed, store that in localStorage
        //     $('.ad_modal').on('shown.bs.modal', function () {
        //         //localStorage.setItem(key, true);
        //         hadModal=$.cookie(key,1);
        // })
        

        setTimeout(function () {
            $('.ad_modal').modal('hide');
        }, 40000);
    });
</script>
@endif
@endpush

