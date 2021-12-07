@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')
<?php 
    $count=1;   
    $myLibrary=new \App\library\myFunctions();
    $protocol = $myLibrary->getYoutubeProtocol(); 
    $exam= $myLibrary->getExamName($content_info[0]['exam_id']);
?>

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
                    <h1>{{$exam}} <span class="text-secondary">Enrollment expires on : {{\Carbon\Carbon::parse($course->end_date)->format('d/m/Y')}} </span></h1>
                        
                        <div class="panel-group dashboard" id="accordion" role="tablist" aria-multiselectable="true">
                        @if (count($pending_tests)>0)
                            <div class="panel panel-default">

                                <div class="panel-heading" role="tab" id="heading-">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-" aria-expanded="true" aria-controls="collapse-">
                                            <i class="more-less glyphicon glyphicon-plus"></i>
                                            Previous Pending Exam
                                            
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse-" class="panel-collapse collapse {{$count==1?'in':''}}" role="tabpanel" aria-labelledby="heading-">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                    <h4 style="padding-bottom: 10px">Test Name</h4>
                                                
                                            </div>
                                            <div class="col-sm-2">

                                                <h4> Date & Time </h4>
                                            </div>
                                            <div class="col-sm-2">

                                                <h4> Subject</h4>
                                            </div>
                                            
                                            
                                        </div>
                                        @forelse ($pending_tests as $pending_test)
                                        
                                            <div class="row">
                                                <div class="pdf-section">
                                                                        
                                                    <div class="content_exists">
                                                    
                                                    
                                                <div class="col-sm-5">
        
                                                    <span>{{$pending_test->test_name}}</span>
                                                </div>
                                                <div class="col-sm-2">
        
                    
                                                <span>{{\Carbon\Carbon::parse($pending_test->start_datetime)->format('d/m/Y H:i')}}</span>
                                                </div>
                                                <div class="col-sm-2">
        
                                                    <span>{{$pending_test->subject->subject_name}}</span>
                                                </div>
                                                <div class="col-sm-2 text-right">
                                                    <form action="{{route('startPaidExam',['mock_test_id'=>\Hasher::encode($pending_test->id)])}}" method="POST" >
                                                        @csrf
                                                        {{-- <input type="hidden" name="course_id" value="{{$course->product_id}}" >
                                                        <input type="hidden" name="paper_id" value="{{$cinfo['paper_id']}}" >
                                                        <input type="hidden" name="exam_id" value="{{$cinfo['exam_id']}}" >
                                                        <input type="hidden" name="subject_id" value="{{$subject}}" >
                                                        <input type="hidden" name="template_id" value="{{$template->id}}" >
                                                        --}}
                                                    
                                                        <span class="downloadbut">
                                                            <input type="submit" value="Resume Test">
                                                        </span>
                                                    </form>    
                                                </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        @empty
                                            
                                        @endforelse
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        @endif    
                        @if( isset($content_info) && count($content_info) > 0)
                            @php 
                                $count=1;
                            @endphp
                            @foreach ($content_info as $cinfo)
                                    
                                    @php
                                        $related_papers=$cinfo['paper_id'];
                                        $paper_name= $myLibrary->getPaperName($cinfo['paper_id']);
                                        
                                    @endphp
                                    <div class="panel panel-default">
                                        
                                        <div class="panel-heading" role="tab" id="heading-">
                                            <h4 class="panel-title">
                                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$cinfo['paper_id']}}" aria-expanded="true" aria-controls="collapse-{{$cinfo['paper_id']}}">
                                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                                    {{$paper_name}}
                                                    
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse-{{$cinfo['paper_id']}}" class="panel-collapse collapse {{$count==1?'in':''}}" role="tabpanel" aria-labelledby="heading-{{$cinfo['paper_id']}}">
                                            <div class="panel-body">
                                                @forelse ($cinfo['subject_id'] as $subject)
                                                @php
                                                    $subject_name= $myLibrary->getSubjectName($subject);
                                                    $tempcount=0;
                                                @endphp
                                                    <div class="row">
                                                        <div class="col-sm-3">
                                                                <h4 style="padding-bottom: 10px">{{$subject_name}}</h4>
                                                            
                                                        </div>
                                                        <div class="col-sm-3">
    
                                                            <h4> Level</h4>
                                                        </div>
                                                        <div class="col-sm-2">
    
                                                            <h4> Duration</h4>
                                                        </div>
                                                        <div class="col-sm-2">
    
                                                            <h4> No. of Questions</h4>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    @forelse ($templates as $template)
                                                        @php
                                                            $template_details=$template->templateDetails;
                                                            $level=$level_id=[];
                                                            $noofQuestion=0;
                                                            foreach($template_details as $template_detail){
                                                                $level_id[]=$template_detail->level_id;
                                                                $level[]= $template_detail->level->name;
                                                                $noofQuestion=$noofQuestion+$template_detail->number_of_questions;
                                                            }
                                                            $params=[
                                                                'level_id'=>$level_id,
                                                                'subject_id'=>$subject,
                                                                'exam_id'=>$cinfo['exam_id'],
                                                                'paper_id'=>$cinfo['paper_id']
                                                                
                                                            ];
                                                            $hasQuestion=$myLibrary->checkHasQuestion($params);  
                                                            // echo $hasQuestion;
                                                        @endphp
                                                        @if ($hasQuestion>1)
                                                            <div class="">
                                                                    <div class="pdf-section">
                                                                        
                                                                        <div class="content_exists">
                                                                            <div class="row">
                                                                            <div class="col-sm-3">
                
                                                                            <a href="#">{{$template->name}}</a> 
                                                                            </div>
                                                                            <div class="col-sm-3">
                
                                                                            <a href="#">{{implode(', ',$level)}}</a> 
                                                                            </div>
                                                                            <div class="col-sm-2">
    
                                                                            <span> 
                                                                                @php
                                                                                    $duration=$template->duration;
                                                                                    $minutes=($duration % 60).' Min';
                                                                                    $hours= intdiv($duration, 60).' Hrs ';
                                                                                    if($minutes>0){
                                                                                        $hours.=$minutes;
                                                                                    }
                                                                                @endphp    
                                                                                {{$hours}}
                                                                            </span>
                                                                            </div>
                                                                            <div class="col-sm-2">
                
                                                                            <span>{{$noofQuestion}}</span>
                                                                            </div>
                                                                        
                                                                            <div class="col-sm-2 text-right">
                                                                            <form action="{{route('showInstructions')}}" method="POST" >
                                                                                @csrf
                                                                                <input type="hidden" name="course_id" value="{{$course->product_id}}" >
                                                                                <input type="hidden" name="paper_id" value="{{$cinfo['paper_id']}}" >
                                                                                <input type="hidden" name="exam_id" value="{{$cinfo['exam_id']}}" >
                                                                                <input type="hidden" name="subject_id" value="{{$subject}}" >
                                                                                <input type="hidden" name="template_id" value="{{$template->id}}" >
                                                                            
                                                                            
                                                                                <span class="downloadbut">
                                                                                    <input type="submit" value="Start Test">
                                                                                </span>
                                                                            </form>    
                                                                        </div>
                                                                        </div>
            
                                                                        </div>
                                                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            
                                                        @else
                                                            {{-- @if ($tempcount!=1)
                                                                
                                                           
                                                                <div class="pdf-section">
                                                                        
                                                                <div class="content_exists">
                                                                    <div class="row">
                                                                        <strong> Coming soon.</strong>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                
                                                            @endif
                                                            @php
                                                                $tempcount=1;    
                                                            @endphp --}}
                                                        @endif    
                                                        @empty
                                                            
                                                        @endforelse
                                                @empty
                                                    
                                                @endforelse
                                                
                                                
                                            </div>
                                        </div>
                                        
                                    </div>    
                                    @php 
                                    $count++;
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