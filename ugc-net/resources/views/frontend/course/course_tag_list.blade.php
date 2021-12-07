@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

@include('frontend.includes.home_banner')
<?php
    $myfunction = new App\library\myFunctions();
?>
{{-- <section class="iconsection">
    <div class="container">
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="{{ asset('public/frontend/images/courses_icon.png') }}" class="lefticon"  alt=""/>
                <span>10,000 Online Courses</span>
                Explore a variety of fresh topics
            </div>
        </div>
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="{{ asset('public/frontend/images/instruction.png') }}" class="lefticon"  alt=""/>
                <span>Expert Instruction</span>
                Find the right instructor for you
            </div>
        </div>
        <div class="col-sm-4">
            <div class="iconinner">
                <img src="{{ asset('public/frontend/images/access.png') }}" class="lefticon"  alt=""/>
                <span>Lifetime Access</span>
                Learn on your schedule
            </div>
        </div>
    </div>
</section> --}}

<section class="innerbanner">
        <img src="{{ asset('public/frontend/images/shortbanner.jpg') }}" alt="">
    </section>


<section class="bodycont">


    <section class="videosection">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-xs-8">
                    <h2>Search tag: {{$slug}}</h2>
                    
                </div>
                <div class="col-sm-3 col-xs-4">
                    {{-- <a href="#" class="seeall">See All</a> --}}
                    <div class="clearfix"></div>
                </div>
            </div>
        
            <div class="videoinner">
                <div class="row d-flex f-wrap">
                    <?php 
                    $myfunction = new App\library\myFunctions();  
                    ?>
                     @forelse($courses as $course)
                    <?php $exam_slug = $myfunction->getProductExam($course->product_id);?>

                    <?php
                        $image=asset('storage/uploads/courses/No-Image.jpg');
                        if($course->image!=""){
                            $image=asset('storage/uploads/courses/'.$course->image);
                        }
					?>
                    <div class="col-sm-3">
                        <div class="tabdiv listdiv">
                        <a href="{{route('front.corsCont',['exam'=>$exam_slug,'slug'=>$course->slug])}}">    
                            <div class="tabtop listtop">
                                    <img src="{{$image}}" alt="">
                            </div>
                            <h3>{{$course->name}}</h3>
                        </a>
                        
                            @if(floor($course->price)=="0")
                            <div class="rightprice">Free</div>
                            @else
                                <div class="rightprice">
                                        @if( isset($course->revised_price) )
                                <span>₹{{ number_format(floor($course->price)) }}</span>
                                @endif
                                ₹{{ number_format(floor($course->revised_price!=""?$course->revised_price:$course->price)) }}
                                </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    
                        <div class="col-sm-9 col-xs-8">
                            <p>No Course found.</p>
                            
                        </div>
                        <div class="col-sm-3 col-xs-4">
                            {{-- <a href="#" class="seeall">See All</a> --}}
                            <div class="clearfix"></div>
                        </div>
                    
                   @endforelse
                </div>
            </div>
        </div>
    </section>
   
   
    
    

</section>
@endsection