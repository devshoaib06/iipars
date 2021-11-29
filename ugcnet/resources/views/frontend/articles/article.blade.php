@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')
<?php $myFunction= new App\library\myFunctions();
      $protocol = $myFunction->getYoutubeProtocol();                                                
?>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Articles</li>
                <li>{{$category}}</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="articleCont">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                    @if(isset($featured_article))
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="articleMonthHead">
                            <h1>Article of the month</h1>
                        </div>
                    </div>
                </div>
                
                <div class="articleMonthWrap">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-6">
                            <div class="articleMonthImg">
                                <img src="{{Storage::disk(config('disk.get_article_image'))->url($featured_article->image)}}" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                            <div class="articleMonthCont">
                            <h2>
                                <a href="{{route('articleDetails',['category'=>$featured_article->cat_slug,'slug'=>$featured_article->slug])}}">{{$featured_article->title}}</a>
                            </h2>
                            <div class="caption">
                                <div class="subcource">
                                    <ul>
                                        <?php 
                                        $meta_keys=explode(',', $featured_article->meta_tags);
                                        $meta_keys=array_filter($meta_keys);

                                    ?>
                                    @foreach($meta_keys as $info)
                                        <li>{{$info}}</li>
                                        @endforeach                 
                                    </ul>
                                </div>
                            </div>
                                <p>
                                    {!!Str::limit($featured_article->description, 120, $end='...')!!}
                                </p>
                                <small><i class="fas fa fa-calendar"></i> {{\Carbon\Carbon::parse($featured_article->created_at)->format('d/m/Y')}}</small>
                                <!--<a class="articleLink" href="{{route('articleDetails',['category'=>$featured_article->cat_slug,'slug'=>$featured_article->slug])}}">Read full article</a>-->
                                <ul class="catList">
                                    <li>
                                        <a href="{{route('articles',['category'=>$featured_article->cat_slug])}}"><span class="categories-tag">{{$featured_article->cat_name}}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if(count($allArticles)>0)
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="articlehead">
                            <h2>Articles</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($allArticles as $article_info)
                        
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="articleWrap">
                                <div class="articleImg">
                                    @php 
                                        $imgsrc=Storage::disk(config('disk.get_article_image'))->has($article_info->image)?Storage::disk(config('disk.get_article_image'))->url($article_info->image): Storage::disk(config('disk.get_article_image'))->url('no-image.jpg');
                                    @endphp
                            
                                    <img src="{{$imgsrc}}" />
                                </div>
                                <div class="articleInfo">
                                <a href="{{route('articleDetails',['category'=>$article_info->cat_slug,'slug'=>$article_info->slug])}}"><h2>{{$article_info->title}}</h2></a>
                                    {!!Str::limit($article_info->description, 120, $end='...')!!}
                                    <small><i class="fas fa fa-calendar"></i> {{\Carbon\Carbon::parse($article_info->created_at)->format('d/m/Y')}}</small>
                                    <a href="{{route('articles',['category'=>$article_info->cat_slug])}}"><span class="categories-tag">{{$article_info->cat_name}}</span></a>
                                </div>
                            </div>
                        </div>
                    @empty
                    @endforelse
                    <div class="col-sm-12 col-md-12">
                        <div class="allArticle">
                            <a href="{{route('all-articles')}}">View All Article</a>
                        </div>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="articlehead">
                        <h2>{{$category}}</h2>
                        </div>
                    </div>
                </div>
                    <p>Coming Soon</p>
                @endif
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
        </div>
    </section>
</section>
@endsection

@push('page_js')
@endpush