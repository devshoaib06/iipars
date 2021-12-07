@extends('frontend.layout.layout_master')
@include('frontend.structure.page_meta')


@section('page_content')
<?php 
    $myLibrary=new \App\library\myFunctions();
?>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Mock Test Result</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-12 col-lg-8 ">
                    <div class="d-flex align-items-center">
                        <div>{{ $allquestions->links('frontend.paid-mock-test.result_pagination') }}</div>
                        <div style="padding-left: 10px">
                            <div class="form-inline">
                                <label ><span>Go to Question </span></label>
                        <select id="pagination" class="selectQuestion form-control">
                            @for ($i = 1; $i <= $total_questions; $i++)
                                
                            <option value="{{$i}}" {{$allquestions[0]->question_no==$i?"selected":''}}   >{{$i}}</option>
                            @endfor
                            
                        </select>
                            </div>
                            
                        </div>
                    </div>
                    <!-- <div class="col-sm-6">
                        {{ $allquestions->links('frontend.paid-mock-test.result_pagination') }}
                    </div>
                    <div class="col-sm-6">

                        <label ><span>Go to Question </span></label>
                        <select id="pagination" class="selectQuestion">
                            @for ($i = 1; $i <= $total_questions; $i++)
                                
                            <option value="{{$i}}" {{$allquestions[0]->question_no==$i?"selected":''}}   >{{$i}}</option>
                            @endfor
                            
                        </select>
                    </div> -->
                    
                </div>
                @php 
                        $q_count=1;
                    @endphp
                <div class="col-sm-12 col-md-12 col-lg-12">
                    
                        

                <form>
                    @forelse ($allquestions as $question)
                   <div class="totalquestion">
                              <div class="questionleft">
                                 <div class="questionWrap">
                                    <div class="marksband">
                                        <span class="correctmarks"></span>
                                        <span class="wrongmarks"></span>
                                    </div>
                                    <div class="questionband">{{$question->questionDetails->level->name}}</div>
                                    <div class="question">
                                        <h1><span>{{$question->question_no}}.</span>{!! $question->questionDetails->questionMaster->question !!}</h1>

                                    </div>
                                    @if ($question->questionDetails->questionMaster->option_type==0)
                                                            
                                    @include('frontend.paid-mock-test.result._none')
                                        
                                    @endif
                                    @if ($question->questionDetails->questionMaster->option_type==1)
                                                                
                                    @include('frontend.paid-mock-test.result._simple')

                                    @endif
                                    @if ($question->questionDetails->questionMaster->option_type==2)
                                    @include('frontend.paid-mock-test.result._conjugate')
                                    
                                    @endif
                            
                                 </div>
                                 @php
                                $correct_opts=$student_ans=[];
                                $correct_explanation ="";
                                $count=0;
                                
                                @endphp
                                @foreach ($question->questionDetails->questionMaster->questionAnswers as $qanswer)
                                
                                @php
                                        if($qanswer->is_correct==1){
                                            $correct_opts=$myLibrary->getCorrectAnswer($question->question_id);
                                            $correct_explanation=$question->questionDetails->questionMaster->correct_explanation;
                                            //dd($correct_explanation);
                                        }
                                @endphp
                                @endforeach
                                @forelse ($question->questionDetails->questionAnswers as $answer)
                                @php

                                    $student_ans[]=$answer->serial_no;
                                @endphp
                                @empty
                                @endforelse
                            
                            <div class="resultWrap">
                                <p>Your answer: {{$question->answer}} </p>
                                    <p>Correct answer: Option <strong>{{$correct_opts}}</strong></p>
                                    <p>Explanation:{!! $correct_explanation !!} </p>
                                    
                                
                                
                             </div>
                              </div>
                              @if ($q_count==1)
                                  
                                <div class="questionright fixme">
                                    <h4><strong>Score</strong></h4>
                                    <br>
                                    <p class="score"><span>{{$mock_test->secured_marks}} </span>/{{$mock_test->full_marks}}</p>
                                    <div class="row">
                                        {{-- <div class="col-xs-6 col-md-4">
                                        <div class="scoreinner">Marks Gained<span>{{$mock_test->secured_marks}}</span><strong>{{$total_correct_answer}} Question</strong></div>
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                        <div class="scoreinner">Marks Lost<span>0</span><strong>{{$total_incorrect_answer}} Question</strong></div>
                                        </div>
                                        <div class="col-xs-6 col-md-4">
                                        <div class="scoreinner">Unanswered Marks<span>300</span><strong>{{$total_questions-$total_attempt_answer}} Question</strong></div>
                                        </div> --}}
                                        <div class="col-xs-6 col-md-4">
                                        <div class="scoreinner">Correct Answer<span>{{$total_correct_answer}}/{{$total_attempt_answer}}</span></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                            <div class="scoreinner">Incorrect Answer<span>{{$total_incorrect_answer}}/{{$total_attempt_answer}}</span></div>
                                            </div>
                                            <div class="col-xs-6 col-md-4">
                                            <div class="scoreinner">Unanswered <span>{{$total_questions-$total_attempt_answer}}/{{$total_questions}}</span></div>
                                            </div>
                                        </div>
                                        <h4><strong>Level Wise</strong></h4>
                                        <br>
                                        @forelse ($templateInfos as $templateInfo)
                                            @php
                                                $noofques=$myLibrary->getNumofQues($mock_test_id,$templateInfo->level_id); 
                                                $noofcorrect=$myLibrary->getNumofCorrectAnswer($mock_test_id,$templateInfo->level_id); 
                                                $markGained=$myLibrary->getMarks($mock_test_id,$templateInfo->level_id); 
                                            @endphp
                                            <p><strong>{{$templateInfo->level->name}}</strong></p>
                                            <div class="row">
                                                
                                                <div class="col-xs-6 col-md-4">
                                                <div class="scoreinner">No. of Question<span>{{$noofques}}</span></div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                <div class="scoreinner">Total Correct<span>{{$noofcorrect}}</span></div>
                                                </div>
                                                <div class="col-xs-6 col-md-4">
                                                <div class="scoreinner">Mark Gained<span>{{$markGained}}</span></div>
                                                </div>
                                            </div>
                                            
                                        @empty
                                            
                                        @endforelse
                                </div>
                                @endif
                                <div class="clear"></div>
                           </div>
                           @php 
                           $q_count++;
                        @endphp   
                       @empty
                           <p>Sorry.No question here.</p>
                       @endforelse
                       <div class="col-sm-12 col-lg-8 ">
                        <div class="d-flex align-items-center">
                        <div>{{ $allquestions->links('frontend.paid-mock-test.result_pagination') }}</div>
                        <div style="padding-left: 10px">
                            <div class="form-inline">
                                <label ><span>Go to Question </span></label>
                        <select id="pagination" class="selectQuestion form-control">
                            @for ($i = 1; $i <= $total_questions; $i++)
                                
                            <option value="{{$i}}" {{$allquestions[0]->question_no==$i?"selected":''}}   >{{$i}}</option>
                            @endfor
                            
                        </select>
                            </div>
                            
                        </div>
                    </div>
                        
                    </div>
                </form>
                    

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
<script>
    var fixmeTop = $('.fixme').offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            $('.fixme').css({
                position: 'fixed',
                top: '190px',
                right: '15%',
                width: '24%',
                
            });
        } else {
            $('.fixme').css({
                position: 'static',
                width: '34%'
            });
        }
    });
    $(".selectQuestion").on('change',function(){
        var qno=$(this).val();
        var href = new URL(window.location);
        href.searchParams.set('page', qno);
        window.location=href.toString(); 
    })
    </script>
@endpush