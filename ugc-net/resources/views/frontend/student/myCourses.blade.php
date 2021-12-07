@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')

<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Dashboard</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            <?php if(Session::has('message')) { ?>
                <div class="alert <?php if(Session::has('messageClass')) echo Session::get('messageClass'); ?>">
                    {{ Session::get('message') }}
                </div>
            <?php } ?>
            <div class="row">
                <div class="col-sm-3">
                    @include('frontend.includes.student_menu')
                </div>
                <div class="col-sm-9">
                    <h1>{{$productinfo->name}}</h1>
                    {{-- <h3>{{$productinfo->name}}</h3> --}}
                <?php 
                    $myLibrary=new \App\library\myFunctions();
                    
                ?>    
                <div class="outerleftsection">
                    
                    @foreach($content_infos as $content_info)
                        <div >
                       <?php 
                           
                               $subject_name=$myLibrary->getSubjectName($content_info['subject_id']);
                               $paper_name=$myLibrary->getPaperName($content_info['paper_id']);
                               $course_data=$myLibrary->getRelatedMaterialContent($content_info);
                               $protocol = $myFunction->getYoutubeProtocol();    

                               
                       ?>
                       <h4>{{$paper_name}} - {{$subject_name}} &nbsp;</h4>
                       <hr>
                       <div class="container">
                           <div class="row">
                               <?php $video_count=0;?>
                               <h3>Videos</h3>
                               @foreach ($course_data as $cdata) 
                                   @if($cdata->media_type=='video')
                                   <?php  $video_embed_link=$myLibrary->parseYouTubeUrl($cdata->value);?>
                                   <div class="col-sm-4">
                                       <iframe width="270" height="180" src="{{$protocol}}://www.youtube.com/embed/{{$video_embed_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                   </div>
                                   @endif
                               @endforeach
                           </div>
                           <div class="row">
                               
                               <h3>Pdf</h3>
                               @foreach ($course_data as $cdata) 
                               @if($cdata->media_type=='pdf')
                               <div class="col-sm-12">
                                   <a href="{{route('downloadContent',['media_id'=>$cdata->media_id])}}">{{$cdata->value}}</a>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div> 
                        <hr>
                       @endforeach       
                    </div>


                </div>
            </div>
        </div>
    </section>
</section>
@endsection