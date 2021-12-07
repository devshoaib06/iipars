@if( isset($home_banners) )

@auth
<section class="bannersection top-slider-bar">
@endauth    
@guest
    <section class="bannersection top-slider-bar">
@endguest
    <section id="demos" class="outerslider">
        {{-- <div class="owl-carousel4"> --}}
            <div class="">
            <div class="item">

                <img src="{{ asset('public/frontend/images/Last-Minute-Suggestion.jpg') }}" alt="Last Minute Suggestion for UGC-NTA NET/SET/JRF Exam 2020" />
                <div class="bannermaintext">
                    {{-- <div class="container">
                        <h4><a href="{{route('last-minute-suggestion')}}" class="linktext">Last Minute Suggestion for UGC NTA NET June-2020 Exam</a></h4>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="item">

                <img src="{{ asset('public/frontend/images/banner.jpg') }}" alt="Crack The UGC & CSIR NTA NET/SET/JRF Exam 2020" />
                <div class="bannermaintext">
                    <div class="container">
                    <h4>Join India's Most Innovative online courses</h4>
                    </div>
                </div>
            </div>
            <div class="item">

                <img src="{{ asset('public/frontend/images/banner-4.jpg') }}" alt="Prepare for UGC & CSIR NTA NET/SET/JRF Exam 2020" />
                <div class="bannermaintext">
                    <div class="container">
                        <h4>Transform your Future through Ideas and Technology</h4>
                    </div>
                </div>
            </div>
            <div class="item">

                <img src="{{ asset('public/frontend/images/banner-6.jpg') }}" alt="Study Material for NTA-UGC NET 2020 Cover the Complete Syllabus" />
                <div class="bannermaintext">
                    <div class="container">
                        <h4>Prep Smart, Achieve big</h4>
                    </div>
                </div>
            </div>
            <div class="item">

                <img src="{{ asset('public/frontend/images/banner-5.jpg') }}" alt="In-Demand Study Materials & Sample Question Papers for NET 2020" />
                <div class="bannermaintext">
                    <div class="container">
                        <h4>ace your exam with teachinns.com</h4>
                    </div>
                </div>
            </div> --}}
        </div>

    </section>
    <div class="bannertexst_slider">
    <div class="container">
        
        @if(count($bannersliders)==1)
        <div class="bannerprice_slider">
            <section id="demos" class="outerslider">
                @foreach ($bannersliders as $item)
                <div class="banner-text-new">
                    {!!html_entity_decode($item->title)!!}

                    {{-- <a href="{{$item->link}}" class="buynow buy-now-login" target="_blank">Enroll Now</a> --}}
                </div>
                @endforeach
            </section>    
        </div>    

        @endif
        @if(count($bannersliders)>1)
        <div class="bannerprice_slider">
            <section id="demos" class="outerslider">
                <div class="owl-carousel" id="banner-slider">
                        @foreach ($bannersliders as $item)
                            
                            <div class="item">
                            
                                <div class="banner-text-new">
                                    {!!html_entity_decode($item->title)!!}

                                    {{-- <a href="{{$item->link}}" class="buynow buy-now-login" target="_blank">Know More</a> --}}
                                </div>
                            </div>
                            
                        @endforeach
                        
                </div>
            </section>    
        </div>
        @endif
    </div>
    </div>
</section>
@endif