@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>
<section class="innerbanner">
    <img src="{{ asset('public/frontend/images/shortbanner.jpg') }}" alt="Crack the CSIR-UGC NET/SET/JRF exam with our online course material
">
</section>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li>{{ $course_details_page->name }}</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">

        <form action="{{route('billing')}}" method="post">
          <?php $exam_name = $myfunction->getProductExamName($course_details_page->product_id);
            ?>  

            <!-- <section class="title-affix" data-spy="affix" data-offset-top="0">
                <div class="container">
                    <div class="row">
                                <div class="col-sm-8">
                                    <h2>{{ $course_details_page->name }}</h2>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div>
                                        @if((floor($course_details_page->price)==0))    
                                            <span class="rightprice c-white">
                                                Free
                                            </span>
                                            @else
                                            <span class="rightprice c-white">
                                            @if( isset($course_details_page->revised_price) )
                                            <span>₹{{ number_format(floor($course_details_page->price)) }}</span>
                                            @endif
                                            ₹{{ number_format(floor($course_details_page->revised_price!=""?$course_details_page->revised_price:$course_details_page->price)) }}
                                            </span>
                                            @endif

                                            @auth
                                            <input type="submit" class="btn btn-primary" value="Enroll Now">
                                            @endauth
                                            
                                           @guest
                                           <a href="#" class="btn btn-primary" data-toggle="modal" data-productid="{{$course_details_page->product_id}}" data-target=".login-modal">Enroll Now</a>
                                           @endguest
                                           
                                            
                                     </div>
                                </div>
                            </div>
                    
                </div>
                
            </section> -->

                



        <div class="container">
            
            
            
            <div class="row">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$course_details_page->product_id}}">
                    <!-- <section class="title-affix" data-spy="affix" data-offset-top="0">
                <div class="container">
                    <div class="row">
                                <div class="col-sm-8">
                                    <h2>{{ $course_details_page->name }}</h2>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <div>
                                        @if((floor($course_details_page->price)==0))    
                                            <span class="rightprice c-white">
                                                Free
                                            </span>
                                            @else
                                            <span class="rightprice c-white">
                                            @if( isset($course_details_page->revised_price) )
                                            <span>₹{{ number_format(floor($course_details_page->price)) }}</span>
                                            @endif
                                            ₹{{ number_format(floor($course_details_page->revised_price!=""?$course_details_page->revised_price:$course_details_page->price)) }}
                                            </span>
                                            @endif

                                            @auth
                                            <input type="submit" class="btn btn-primary" value="Enroll Now">
                                            @endauth
                                            
                                           @guest
                                           <a href="#" class="btn btn-primary" data-toggle="modal" data-productid="{{$course_details_page->product_id}}" data-target=".login-modal">Enroll Now</a>
                                           @endguest
                                           
                                            
                                     </div>
                                </div>
                            </div>
                    
                </div>
                
            </section> -->
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-8">
                                <h1>{{ $course_details_page->name }}</h1>
                                <h2>{{$exam_name}}</h2>
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
                                <input type="submit" class="buynow enrollbtn" value="{{(floor($course_details_page->price)==0)?'Preview Now':'Enroll Now'}}">
                                    @endauth
                                    {{-- @guest            
                                    <a href="#" class="enrollbtn" data-toggle="modal" data-target=".login-modal">Enroll Now</a>
                                   @endguest  --}}
                                   @guest
                                   <a href="#" class="buynow buy-now-login" data-toggle="modal" data-productid="{{$course_details_page->product_id}}" data-target=".login-modal">{{(floor($course_details_page->price)==0)?'Preview Now':'Enroll Now'}}</a>
                                   @endguest
                                   
                                    {{-- <a href="{{route('billing',['product_id'=>$course_details_page->product_id])}}" class="buynow">Enroll Now</a> --}}
                            </div>
                        </div>





                        {{-- <p><i class="fa fa-users" aria-hidden="true"></i>&nbsp;&nbsp;<strong>5,372,892</strong> students are preparing for Civil Services.</p> --}}
                        <div class="outerleftsection">
                            
                            {!!html_entity_decode($course_details_page->intro_text)!!}
                        </div>
                        <div class="outerleftsection">
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
                        </div>
                        <div class="outerleftsection">
                        <h3>Important Dates</h3>
                        {!!html_entity_decode($course_details_page->important_notice)!!}
                        </div>
                    </div>
                    <div class="col-sm-4"> 
                        <div class="rightvideo">
                            <div class="tabdiv">
                                
                                <?php 
                                    $course_image=asset('storage/uploads/courses/No-Image.jpg');
                                    if($course_details_page->image){
                                        $course_image=asset('storage/uploads/courses/'.$course_details_page->image);
                                    }
                                ?>
                                        <div class="tabtop">
                                            <img src="{{$course_image}}" alt="{{$exam_name}} {{ $course_details_page->name }} 2020 ">
                                        </div>
                                {{-- <h3><a href="#">Vivamus Convallis Ac Urna Id Sollicitudin.</a></h3> --}}
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
                                @auth
                                <input type="submit" class="buynow enrollbtn" value="{{(floor($course_details_page->price)==0)?'Preview Now':'Enroll Now'}}">
                                @endauth
                                {{-- @guest            
                                <a href="#" class="enrollbtn" data-toggle="modal" data-target=".login-modal">Enroll Now</a>
                               @endguest  --}}
                               @guest
                               <a href="#" class="buynow buy-now-login" data-toggle="modal" data-productid="{{$course_details_page->product_id}}" data-target=".login-modal">{{(floor($course_details_page->price)==0)?'Preview Now':'Enroll Now'}}</a>
                               @endguest
                               
                                {{-- <a href="{{route('billing',['product_id'=>$course_details_page->product_id])}}" class="buynow">Enroll Now</a> --}}
                            </div>
                        </div>
                        @if($course_details_page->revised_percent)
                        <div class="discount-offer">
                        <h2>Order now and get a <strong>{{$course_details_page->revised_percent}}%</strong> discount on this course.</h2>
                        </div>
                        @endif
                    </div>
               
            </div>
            <section style="display:none">
                <form action="{{route('billing')}}" method="POST" id="billing-login">
                    @csrf
                    <input type="hidden" value="" id="redirected_product">
                    <input type="submit">
                </form>
                </section>
            
            {{-- <div class="combosection">
                <h2>Combo Product</h2>
                <ul>
                <li>
                    <div class="tabdiv">
                        <div class="tabtop"><img src="images/tabpic1.jpg" alt=""></div>
                        <h3><a href="#">Vivamus Convallis Ac Urna Id Sollicitudin.</a></h3>
                        <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i> 4.7 (7,373)
                        </div>
                        <div class="rightprice">
                        <span>₹749</span> ₹549
                        </div>
                    </div>
                </li>
                <li>
                    <div class="tabdiv">
                        <div class="tabtop"><img src="images/tabpic2.jpg" alt=""></div>
                        <h3><a href="#">Vivamus Convallis Ac Urna Id Sollicitudin.</a></h3>
                        <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i> 4.7 (7,373)
                        </div>
                
                        <div class="rightprice">
                        <span>₹749</span> ₹549
                        </div>
                    </div>
                </li>
                <li>
                <div class="tabdiv">
                        <div class="tabtop"><img src="images/tabpic3.jpg" alt=""></div>
                        <h3><a href="#">Vivamus Convallis Ac Urna Id Sollicitudin.</a></h3>
                        <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i> 4.7 (7,373)
                </div>
                
                <div class="rightprice">
                <span>₹749</span> ₹549
                </div>
                        </div>
                </li>
                </ul>
                <div class="comboprice">Total:<span class="actual">₹1098</span><span>₹1498</span></div>
                <input type="submit" class="buynow enrollbtn" value="Enroll Now">
                
            </div> --}}
        </div>
        </form>
    </section>
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