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
            <div class="row">
                <div class="col-sm-12">
                    @include('frontend.includes.student_menu')
                </div>
                <div class="col-sm-12">
                    <div class="tabCont">
                        <h1>Dashboard</h1>
                       
                        <div class="panel-group dashboard" id="accordion" role="tablist" aria-multiselectable="true">
                        @if( isset($purchasedcourses) && count($purchasedcourses) > 0)
                            @php 
                                $count=1;   
                                $myLibrary=new \App\library\myFunctions();
                                $protocol = $myLibrary->getYoutubeProtocol(); 
                            @endphp
                            @foreach ($purchasedcourses as $course)
                                
                                    
                                
                                    @php 
                                        $related_materials=$myLibrary->getRelatedMaterial($course->product_id);
                                        $related_materials_info=$myLibrary->getMaterialInfo($course->product_id);
                                        
                                        
                                    @endphp
                                    <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="heading-{{$course->tech_order_id}}">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$course->tech_order_id}}" aria-expanded="true" aria-controls="collapse-{{$course->tech_order_id}}">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    {{$course->product_name}}
                                                    <span class="text-primary">Enrollment expires on : {{\Carbon\Carbon::parse($course->end_date)->format('d/m/Y')}} </span>
                                                </a>
                                            </h4>
                                        </div>
                                    <div id="collapse-{{$course->tech_order_id}}" class="panel-collapse collapse {{$count==1?'in':''}}" role="tabpanel" aria-labelledby="heading-{{$course->tech_order_id}}">
                                            <div class="panel-body">
                                                <ul class="nav nav-tabs">
                                                    @php $material_count=[];$count_material=0;
                                                    $activecount=1;
                                                  
                                                    @endphp
                                                    
                                                    
                                                    <li class="active">
                                                        <h4 style="padding-bottom: 10px">Study Materials</h4>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    @php $activecount=1;@endphp
                                                    @foreach ($related_materials_info as $related_material)
                                                        @php 
                                                            $subject_name=$myLibrary->getSubjectName($related_material['subject_id']);
                                                            $paper_name=$myLibrary->getPaperName($related_material['paper_id']);
                                                            $material_name=$myLibrary->getMaterialName($related_material['material_id']);
                                                            $course_data=$myLibrary->getRelatedMaterialContent($related_material);
                                                            $countvideo=$countpdf=0;

                                                           
                                                           
                                                            foreach ($course_data as $cdata){
                                                                if($cdata->media_type=='video'){
                                                                    $countvideo=1;
                                                                }
                                                                if($cdata->media_type=='pdf'){
                                                                    $countpdf=1;
                                                                }
                                                            }
                                                            
                                                            
                                                        @endphp
                                                        
                                                        
                                                                    @php 
                                                                    $count_pdf=1;
                                                                    if(count($course_data)>0){

                                                                        echo $material_name;
                                                                    }
                                                                    @endphp
                                                                @foreach ($course_data as $cdata) 
                                                                    @if($count_pdf && $cdata->media_type=='pdf')
                                                                        <div class="">
                                                                            <div class="pdf-section">
                                                                                @if($cdata->media_type=='pdf')
                                                                                <div class="content_exists">
                                                                                    <div class="row">
                                                                                    <div class="col-sm-7">
                        
                                                                                        <a href="{{route('downloadContent',['media_id'=>$cdata->media_id])}}">{{$cdata->value}}</a> 
                                                                                    </div>
                                                                                    <div class="col-sm-5 text-right">
                                                                                    <span class="downloadbut">
                                                                                        <a href="{{route('downloadContent',['media_id'=>$cdata->media_id])}}"><i class="fa fa-file"></i> Download</a>
                                                                                    </span>
                                                                                </div>
                                                                                </div>
                    
                                                                                </div>
                                                                                
                                                                                @php $count_pdf++; @endphp
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="row">
                                                                    @if($countvideo)
                                                                        @if($cdata->media_type=='video')
                                                                        <div class="col-sm-6">
                                                                            <div class="video-section">
                                                                            @php $count_video=0;@endphp
                                                                                @php  
                                                                                    
                                                                                    
                                                                                $video_embed_link=$myLibrary->parseYouTubeUrl($cdata->value);@endphp
                                                                                
                                                                                <div class="video-container">
                                                                                    <iframe width="100%" height="300px" src="{{$protocol}}://www.youtube.com/embed/{{$video_embed_link}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                                
                                                                                </div>
                                                                                @php $count_video++; @endphp
                                                                                <h4 class="video_label">{{$cdata->title}}</h4>

                                                                        </div>
                                                                        </div>
                                                                        @endif
                                                                    
                                                                    @endif
                                                                </div>

                                                                    @php 
                                                                        $activecount++;
                                                                    
                                                                    @endphp
                                                                @endforeach
                                                                     @php
                                                                         
                                                                         $mocktestcount=0;
                                                                     @endphp   
                                                                    @if ($related_material['material_id']==14 && $mocktestcount==0)
                                                                    {{-- <div class="pdf-section stest">

                                                                        <div class="content_exists">
                                                                            <div class="row">
                                                                            <div class="col-sm-7">
                
                                                                                <a href="#">{{$material_name}}</a> 
                                                                            </div>
                                                                            <div class="col-sm-5 text-right">
                                                                            <span class="downloadbut">
                                                                                <a href="{{route('studentMocktest',['course_id'=>Hasher::encode($course->product_id)])}}" style="
                                                                                    width: 20%;
                                                                                    text-align: center;
                                                                                "><i class="fa fa-play"></i> Start</a>
                                                                            </span>
                                                                        </div>
                                                                        </div>
            
                                                                        </div>
                                                                    </div> --}}
                                                                    @php
                                                                        $mocktestcount++;
                                                                    @endphp
                                                                    @endif
                                                                @endforeach
                                                               
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @php 
                                    $count++  
                                    @endphp
                                
                            @endforeach
                        @else
                            <p>No course available.</p>
                        @endif
                        </div><!-- panel-group -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
@endsection

@push('page_js')
<script>
  $(document).ready(function(){

    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.collapse.in').each(function(){
		$(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");
	});
  	
	$('.collapse').on('shown.bs.collapse', function(){
		$(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
	}).on('hidden.bs.collapse', function(){
		$(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
	});  
  })  
</script>
@endpush