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
                <form>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12">
                            <h1>Submit your article</h1>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label>Your name:</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label>Your email:</label>
                                <input type="email" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4">
                            <div class="form-group">
                                <label>Your phone:</label>
                                <input type="tel" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Article title</label>
                                <input type="text" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Please enter your article title here.</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Article description</label>
                                <textarea class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Please enter short article description here.</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Upload article image (if any)</label>
                                <input type="file" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Upload article image here in (.jpeg), (.jpg), (.png) format (if any).</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Upload file</label>
                                <input type="file" class="form-control" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <label>Upload you article here in (.pdf), (.docx), (.doc) format.</label>
                        </div>
                    </div>
                    <div class="row align-items-center" style="display:flex; flex-wrap:wrap;">
                        <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <input type="submit" value="SUBMIT ARTICLE" />
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="articlehead">
                            <h2>Previous articles</h2>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="articleWrap">
                            <div class="articleImg">
                                <img src="{{ asset('public/frontend/images/articleimg.jpg') }}" />
                            </div>
                            <div class="articleInfo">
                                <h2>Chemical Sciences Study Material</h2>
                                <h4>This article is on NET exam study material with previous 10 years example.</h4>
                                <small><i class="fas fa fa-calendar"></i> 03/03/2020</small>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="articleWrap">
                            <div class="articleImg">
                                <img src="{{ asset('public/frontend/images/articleimg.jpg') }}" />
                            </div>
                            <div class="articleInfo">
                                <h2>Education Study Material</h2>
                                <h4>This article is on NET exam study material with previous 10 years example.</h4>
                                <small><i class="fas fa fa-calendar"></i> 28/02/2020</small>
                            </div>

                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <div class="articleWrap">
                            <div class="articleImg">
                                <img src="{{ asset('public/frontend/images/articleimg.jpg') }}" />
                            </div>
                            <div class="articleInfo">
                                <h2>General Paper I & Geography Study Material</h2>
                                <h4>This article is on NET exam study material with previous 10 years example.</h4>
                                <small><i class="fas fa fa-calendar"></i> 24/02/2020</small>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</section>
@endsection