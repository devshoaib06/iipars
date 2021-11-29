@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

@include('frontend.includes.home_banner')
<?php
    $myfunction = new App\library\myFunctions();
?>


<section class="innerbanner">
        <img src="{{ asset('public/frontend/images/shortbanner.jpg') }}" alt="">
    </section>


<section class="bodycont">


    <section class="homeBodyCont">

        @if( isset($home_feature_courses) )
            <div class="container">
                <div class="row d-flex f-wrap">
                    <div class="col-sm-9 col-xs-8">
                        <h1>Last Minute Suggestion</h1>
                        
                    </div>
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
                                    <span>₹{{ number_format(floor($home_feature_course->price)) }}</span>
                                    @endif
                                    ₹{{ number_format(floor($home_feature_course->revised_price!=""?($home_feature_course->revised_price):$home_feature_course->price)) }}
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
    
    

</section>
@endsection
@push('page_js')
<script>
    
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
@endpush