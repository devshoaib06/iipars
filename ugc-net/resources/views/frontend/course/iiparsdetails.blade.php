@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>
<!-- <section class="innerbanner">
    <img src="{{ asset('public/frontend/images/shortbanner.jpg') }}" alt="Crack the CSIR-UGC NET/SET/JRF exam with our online course material
">
</section> -->
<section class="inner-header divider parallax layer-overlay1 overlay-white-8" style="background-image: url({{ asset('public/frontend/images/shortbanner.jpg') }}); background-repeat: no-repeat; background-size: 100%; background-position: 0 0; height:200px">

    <div class="container pt-30 pb-30">

      <!-- Section Content -->

      <div class="section-content">

          

        </div>

      </div>

    </section>

<!-- Section: Breadcrumb  -->
<section class="breadcamp">
    <div class="container">
        <ul>
            <li><a href="{{ config('path.iipars_base_url') }}">Home</a></li>
            <li class="active text-theme-colored">{{ $course_details_page->name }}</li>
        </ul>
    </div>
</section>

<!-- start Section: Content -->
<section class="section-content__innerpage">
    <div class="container ">
        <div class="row d-flex">

            <div class="col-sm-8">

                <div class="row" style="margin-bottom:30px">
                    <div class="col-sm-8">
                        <h1>{{ $course_details_page->name }}</h1>
                        <h2> <?php $exam_name = $myfunction->getProductExamName($course_details_page->product_id);
                            ?>  </h2>
                        <div class="caption">
                            <div class="subcource">
                                <ul>
                                    <?php 
                                    $meta_keys=explode(',', $course_details_page->meta_key);
                                    $meta_keys=array_filter($meta_keys);

                                ?>
                                @foreach($meta_keys as $info)
                                <a href="{{route('front.corstagList',['slug'=>$info])}}"><li>{{$info}}</li></a>
                                 @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-sm-4 text-right">
                        <!-- <h2 style="padding:0 0 0;">Course Fees</h2> -->

                        <div class="rightprice" style="padding:0 0 10px">
                            <span>₹3,499</span>
                            ₹1,399
                        </div>

                        <a href="#" class="buynow btn btn-success" data-toggle="modal" data-productid="102"
                            data-target=".login-modal">Enroll Now</a>


                    </div> --}}
                    <div class="col-sm-4 text-right">
                        <!-- <h2 style="padding:0 0 0;">Course Fees</h2> -->

                            @if((floor($course_details_page->price)==0))    
                            <div class="rightprice " style="padding:0 0 10px">
                                Free
                            </div>
                            @else
                            <div class="rightprice" style="padding:0 0 10px">
                            @if( isset($course_details_page->revised_price) )
                            <span>₹{{ number_format(floor($course_details_page->price)) }}</span>
                            @endif
                            ₹{{ number_format(floor($course_details_page->revised_price!=""?$course_details_page->revised_price:$course_details_page->price)) }}
                            </div>
                            @endif
                            @auth
                        <input type="submit" class="buynow btn btn-success enrollbtn" value="{{(floor($course_details_page->price)==0)?'Preview Now':'Enroll Now'}}">
                            @endauth
                            {{-- @guest            
                            <a href="#" class="enrollbtn" data-toggle="modal" data-target=".login-modal">Enroll Now</a>
                           @endguest  --}}
                           @guest
                           <a href="#" class="buynow btn btn-success buy-now-login" data-toggle="modal" data-productid="{{$course_details_page->product_id}}" data-target=".login-modal">{{(floor($course_details_page->price)==0)?'Preview Now':'Enroll Now'}}</a>
                           @endguest
                           
                            {{-- <a href="{{route('billing',['product_id'=>$course_details_page->product_id])}}" class="buynow">Enroll Now</a> --}}
                    </div>
                </div>

                
                {!!html_entity_decode($course_details_page->intro_text)!!}
                <hr>

                <h3>What you'll Get</h3>
                <div class="highlightsection">
                                
                    @foreach ($related_materials as $paper=>$materials)
                    <?php $myFuntion=new \App\library\myFunctions; 
                        $paper_name= @$myFuntion->getPaperName($paper);
                        // echo "<pre>";
                        //     print_r($materials);
                        // echo "</pre>";
                    ?>
                    <h4>{{$paper_name}}</h4>
                        @if(count($materials)>0)    
                        <ul>
                            @foreach ($materials as $material)
                            <?php 
                                $material_name= @$myFuntion->getMaterialName($material);
                            ?>
                            <li>{{$material_name}}</li>
                            @endforeach
                            
                        </ul>
                        @endif
                    @endforeach
                </div>
                {!!html_entity_decode($course_details_page->description)!!}

                <hr>
                <h3>Important Dates</h3>
                {!!html_entity_decode($course_details_page->important_notice)!!}






            </div>
            <div class="col-sm-4">
                <div class="rightvideo">
                    <div class="tabdiv">

                            <?php 
                                $course_image=asset('storage/uploads/courses/5f2cda75c6c65.jpg');
                                if($course_details_page->image){
                                    $course_image=asset('storage/uploads/courses/'.$course_details_page->image);
                                }
                            ?>
                        <div class="tabtop">
                                <img src="{{$course_image}}" alt="{{$exam_name}} {{ $course_details_page->name }} 2020 ">
                        </div>

                        <div class="rating" style="display:none"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i> 4.7 (7,373)
                        </div>
                        <div class="sublist">
                            <h2>This course includes</h2>
                            {!!html_entity_decode($course_details_page->short_description)!!}
                        </div>
                        @if((floor($course_details_page->price)==0))    
                                <div class="rightprice ">
                                    Free
                        </div>
                        @else
                        <div class="rightprice">
                        @if( isset($course_details_page->revised_price) )
                        <span>₹{{ number_format(floor($course_details_page->price)) }}</span>
                        @endif
                        ₹{{ number_format(floor($course_details_page->revised_price!=""?$course_details_page->revised_price:$course_details_page->price)) }}
                        </div>
                        @endif

                        <a href="#" class="buynow btn btn-success" >Enroll Now</a>


                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>
</section>

@endsection
@push('page_js')
<script>
    $('.buy-now-login').click(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = $(this).data('productid')
        let url = "{{route('visitor-buy-product')}}";
        let data = {
            product_id: product_id
        }
        $.post(url, data, function (response) {

        })
    })
    $('.login-modal').on('hidden.bs.modal', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let product_id = $(this).data('productid')
        let url = "{{route('visitor-remove-buy-product')}}";
        $.post(url, function (response) {

        })
    })

</script>


@endpush