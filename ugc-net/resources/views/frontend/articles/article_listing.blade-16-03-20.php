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
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <div class="articleCont">
                @if(isset($featured_article))
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="articleMonthHead">
                            <h3>Article of the month</h3>
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
                            <h2><a href="{{route('articleDetails',['category'=>$featured_article->cat_slug,'slug'=>$featured_article->slug])}}">{{$featured_article->title}}</a></h2>
                                
                                <p>
                                    {!!Str::limit($featured_article->description, 120, $end='...')!!}
                                </p>
                                <small><i class="fas fa fa-calendar"></i> {{\Carbon\Carbon::parse($featured_article->created_at)->format('d/m/Y')}}</small>
                                <a class="articleLink" href="{{route('articleDetails',['category'=>$featured_article->cat_slug,'slug'=>$featured_article->slug])}}">Read full article</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="articlehead">
                            <h2>Previous articles</h2>
                        </div>
                    </div>
                    
                    @forelse ($allArticles as $article_info)
                        
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="articleWrap">
                                <div class="articleImg">
                                    <img src="{{Storage::disk(config('disk.get_article_image'))->url($article_info->image)}}" />
                                </div>
                                <div class="articleInfo">
                                <a href="{{route('articleDetails',['category'=>$article_info->cat_slug,'slug'=>$article_info->slug])}}"><h2>{{$article_info->title}}</h2></a>
                                    <h4>{!!Str::limit($article_info->description, 120, $end='...')!!}</h4>
                                    <small><i class="fas fa fa-calendar"></i> {{\Carbon\Carbon::parse($article_info->created_at)->format('d/m/Y')}}</small>
                                    <a href="{{route('articles',['category'=>$article_info->cat_slug])}}"><span class="categories-tag">{{$article_info->cat_name}}</span></a>
                                </div>

                            </div>
                        </div>
                    @empty
                        
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('page_js')
@endpush