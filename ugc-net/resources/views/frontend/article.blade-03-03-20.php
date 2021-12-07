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
        <div class="row ">
            @foreach ($result as $s)
            <?php
                $video_embed_link = $myFunction->parseYouTubeUrl($s->video_url); 
               
            ?>
            
                    <div class="col-sm-6 vediosection">
                    <iframe width="575" height="325" src="{{$protocol}}://www.youtube.com/embed/<?php echo $video_embed_link;?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <h4>{{$s->title}}</h4>
                    </div>
                    
            
            @endforeach
            </div>
        </div>
    </section>
</section>
@endsection