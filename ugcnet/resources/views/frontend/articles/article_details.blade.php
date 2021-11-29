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
                <li>Article</li>
                <li>{{ $article_info->title }}</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">

        
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="articleDetails">
                        <h1>{{ $article_info->title }}</h1>
                        <div class="caption">
                            <div class="subcource">
                                <ul>
                                    <?php 
                                        $meta_keys=explode(',', $article_info->meta_tags);
                                        $meta_keys=array_filter($meta_keys);
                                        $fileexists=Storage::disk(config('disk.get_article_file'))->has($article_info->file);
                                         $file=Storage::disk(config('disk.get_article_file'))->url($article_info->file);
                                    ?>
                                    @foreach($meta_keys as $info)
                                        <li>{{$info}}</li>
                                        @endforeach                            
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">

                                <small><i class="fas fa fa-calendar"></i> {{\Carbon\Carbon::parse($article_info->created_at)->format('d/m/Y')}}</small></div>
                                @if($fileexists) 
                                    <div class="col-xs-6 text-right">
                                        @auth
                                        <a href="{{route('downloadArticleFile',['article_id'=>\Hasher::encode($article_info->id)])}}" class="buynow ">
                                            <i class="fa fa-download"></i> 
                                            Download
                                        </a>
                                        @endauth
                                        @guest
                                        <a href="#" class="buynow " data-toggle="modal" data-target=".login-modal">
                                            <i class="fa fa-download"></i> 
                                            Download
                                        </a>
                                        @endguest
                                    </div>
                                @endif
                        </div>
                        
                        
                        <div class="courseImg">
                            @php 
                                $imgsrc=Storage::disk(config('disk.get_article_image'))->has($article_info->image)?Storage::disk(config('disk.get_article_image'))->url($article_info->image): Storage::disk(config('disk.get_article_image'))->url('no-image.jpg');
                                
                            @endphp
                            
                            <img src="{{$imgsrc}}" class="img-responsive" />
                        </div>
                        <div class="outerleftsection">
                            {!! $article_info->description !!}
                        </div>
                        
                        <?php 
                        $myFunction= new App\library\myFunctions();
                        $relatedcategories=explode(",",$article_info->category_id);
                        $firstcat=$myFunction->getCategoryName($relatedcategories[0]);
                        // $myFunction->getCategoryName($article_info->category);
                        ?>
                        @forelse ($relatedcategories as $item)
                        <?php 
                            $cat_info=$myFunction->getCategoryName($item);
                        ?>
                            <a href="{{route('articles',['category'=>$cat_info->slug])}}"><span class="categories-tag">{{$cat_info->name}}</span></a>
                            
                        @empty
                            
                        @endforelse
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="otherArticle">
                        <h2>Categories</h2>
                        <ul>
                            <li>
                                <a href="{{route('articles',['category'=>'current-affairs'])}}">Current Affairs</a>
                            </li>
                            {{-- @forelse ($categories as $category)
                            <li><a href="{{route('articles',['category'=>$category->slug])}}"><i class="fas fa-pen-nib"></i> {{$category->name}}</a></li>
                                
                                
                            @empty
                                <p>Coming Soon.</p>
                            @endforelse --}}
                            
                            {{-- <li><a href="#"><i class="fas fa-pen-nib"></i> Bengali</a></li>
                            <li><a href="#">English</a></li> --}}
                        </ul>

                        
                    </div>
                </div>
            </div>
        </div>
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