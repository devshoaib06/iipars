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
                    <div class="mcqTestHead">    
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
                                    <td>{{$total_score}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                <form>
                    {{-- <div class="questionWrap">
                        <div class="question">
                            <h1><span>1.</span>Which of the following games is not included in the Olympic Games?</h1>
                        </div>
                        <label class="optionA"><span>A</span> Skiing</label>
                        <label class="optionB"><span>B</span> Cycling <i class="fa fa-times-circle"></i></label>
                        <label class="optionC"><span>C</span> Cricket <i class="fa fa-check-circle"></i></label>
                        <label class="optionD"><span>D</span> Archery</label>
                    </div>
                    <div class="resultWrap">
                        <p>Your answer: Option <strong>B</strong></p>
                        <p>Correct answer: Option <strong>C</strong></p>
                        <p>Explanation:</p>
                    </div> --}}
                    @php 
                        $q_count=1;
                    @endphp
                    @forelse ($allquestions as $question)
                            <div class="questionWrap">
                                <div class="question">
                                    <h1><span>{{$q_count}}.</span>{{$question->question}}</h1>
                                </div>
                                @php 
                                    $qoptions=$myLibrary->getQuestionOptions($question->id);
                                    $index=0;
                                    @$student_answer=$myLibrary->getStudentAnswer($question->id,$exam_id);
                                    $qanswer=$myLibrary->getCorrectOptionsExplain($question->id);
                                @endphp
                               
                                @forelse ($qoptions as $option)
                                    <label class="option{{$optionsLabel[$index]}}">
                                        <span>{{$optionsLabel[$index]}}</span>
                                        {{$option->answer}}
                                       @if($option->id==$qanswer->correct_answer_id)
                                        <i class="fa fa-check-circle"></i>
                                       @endif
                                       @if(@$option->id==@$student_answer->answer_id)
                                          @if ($student_answer->is_correct==0)
                                            <i class="fa fa-times-circle"></i>
                                          @endif  
                                       @endif
                                    </label>
                                    @php 
                                        $index++;
                                    @endphp
                                @empty
                                    <p>No Options</p>
                                    
                                @endforelse
                                
                            </div>
                            @php 

                            @endphp
                            <div class="resultWrap">
                                @if(@$student_answer->option_label)
                                 <p>Your answer: Option <strong>{{@$student_answer->option_label}}</strong></p>
                                @else
                                 <p>Your answer:</p>
                                @endif
                                <p>Correct answer: Option <strong>{{$qanswer->option_label}}</strong></p>
                                <p>Explanation:</p>{{$qanswer->correct_clarification}}
                            </div>
                         @php 
                            $q_count++;
                         @endphp   
                        @empty
                            <p>Sorry.No question here.</p>
                        @endforelse
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
@endpush