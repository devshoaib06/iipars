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
                <div class="col-sm-12 col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
                    {{-- <div class="mcqTestHead">    
                        <table class="table table-responsive table-bordered">
                            <thead>
                                <tr>
                                    <td colspan="2">Your result</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Number of question:</td>
                                    <td>{{$total_questions}}</td>
                                </tr>
                                <tr>
                                    <td>Number of answered question:</td>
                                <td>{{$total_attempt_answer}}</td>
                                </tr>
                                <tr>
                                    <td>Number of unanswered question:</td>
                                    <td>{{$total_questions-$total_attempt_answer}}</td>
                                </tr>
                                <tr>
                                    <td>Total correct answers:</td>
                                    <td>{{$total_correct_answer}}</td>
                                </tr>
                                <tr>
                                    <td>Total Scored:</td>
                                    <td>{{$mock_test->secured_marks}} / {{$mock_test->full_marks}} </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
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
                                    <div class="questionband">{{$question->questionDetails->level->name}}</div>
                                    <div class="question">
                                        <h1><span>{{$question->question_no}}.</span>{{$question->questionDetails->questionMaster->question}}</h1>

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
                                $correct_explanation =[];
                                $count=0;
                                
                                @endphp
                                @foreach ($question->questionDetails->questionMaster->questionAnswers as $qanswer)
                                
                                @php
                                        if($qanswer->is_correct==1){
                                            $correct_opts[]=$qanswer->serial_no;
                                            $correct_explanation[]=$qanswer->correct_explanation;
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
                                @forelse ($correct_opts as $correct_opt)
                                    
                                    <p>Correct answer: Option <strong>{{$correct_opt}}</strong></p>
                                    <p>Explanation:{{$correct_explanation[$count]}} </p>
                                    @php
                                        $count++;
                                    @endphp
                                @empty
                                    
                                @endforelse
                                
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
                       {{ $allquestions->links() }}
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
    </script>
@endpush