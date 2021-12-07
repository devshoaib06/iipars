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
                {{-- <li><a href="{{ route('home') }}">Home</a></li> --}}
                <li>Mock Test</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="mcqTestHead">
                            <h3>Time Left: <span class="timer">{{trim(getMockTestSettings('mt_duration'))}}:00</span> </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <form action="{{route('submitStudentAnwser')}}" method="POST"    id="mt_test" >
                                @csrf

                                <div class="questionCont">
                                        @php 
                                            $q_count=1;
                                        @endphp
                                        @foreach ($allquestions as $question)
                                            
                                            <div class="questionWrap">
                                                <div class="question">
                                                    <h1><span>{{$q_count}}.</span>{{$question->question}}</h1>
                                                </div>
                                                @php 
                                                    $qoptions=$myLibrary->getQuestionOptions($question->id);
                                                    $index=0;
                                                @endphp
                                                <input type="hidden" name="questions[{{ $question->id }}]" value="{{ $question->id }}">
                                                <input type="hidden" name="drafts[]" value="{{ $question->id }}" class="draftclass">
                                                @forelse ($qoptions as $option)
                                                <label class="option"><span>{{$optionsLabel[$index]}}</span>
                                                    <input type="radio" name="answer[{{$question->id}}]" value="{{$option->id}}"> {{$option->answer}}
                                                </label>
                                                    @php 
                                                        $index++;
                                                    @endphp
                                                @empty
                                                    <p>No Options</p>
                                                    
                                                @endforelse
        
                                                
                                            </div>
                                            @php 
                                                $q_count++;
                                            @endphp  
                                        @endforeach
                                                                        
                                        <div class="btnDiv">
                                            <button type="submit" id="draftBtn" class="submitTest btn btn-draft">Mark</button>
                                            <button type="submit" id="skipBtn" class="submitTest btn btn-default">Skip</button>
                                            <button type="submit" id="nextBtn" class="submitTest btn btn-primary">Save & Next</button>
                                        </div>
                                    </div>
                            
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="rightPanel">
                            <h4>General Knowledge</h4>
                            <ul class="answerType">
                                <li><span class="answered"></span><div class="ansText">0</div> answered</li>
                                <li><span class="mark"></span><div class="markText">0</div> mark</li>
                                <li><span class="unanswered"></span><div class="unansText">0</div> unanswered</li>
                            </ul>
                            <ul class="questionNum">
                                @php 
                                    $list_count=1;
                                @endphp
                                @foreach ($allquestions as $question)
                                    <li class="question_count" id="question_count_{{$list_count}}">{{$list_count}}</li>
                                @php 
                                    $list_count++;
                                @endphp 
                                @endforeach
                                
                            </ul>

                        </div>

                    </div>
                </div>

                              


        </div>
        <div class="testClock">
            <h3>Time Left: <span class="timer">{{trim(getMockTestSettings('mt_duration'))}}:00</span> </h3>
        </div>

    </section>
</section>
@endsection

@push('page_js')
<script>
        $(document).ready(function(){
            $questions = $('.questionWrap');
            
            var totalQuestions = $('.questionWrap').size();
            var currentQuestion = 0;
            $questions.hide();
            $($questions.get(currentQuestion)).fadeIn();
            $('#nextBtn').click(function (e) {
                e.preventDefault();
                $($questions.get(currentQuestion)).fadeOut(function () {

                    var checked_option=$($questions.get(currentQuestion)).children().hasClass('checked');
                    currentQuestion = currentQuestion + 1;
                    $('#question_count_'+(currentQuestion)).removeClass('unansweredNum');
                    $('#question_count_'+(currentQuestion)).removeClass('answeredNum');
                    $('#question_count_'+(currentQuestion)).removeClass('currentNum');
                    if(checked_option){
                        $('#question_count_'+(currentQuestion)).addClass('answeredNum');
                    }else{
                        $('#question_count_'+(currentQuestion)).addClass('unansweredNum');

                    }
                    if (currentQuestion == totalQuestions) {
                        $('#mt_test').submit();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        $('#question_count_'+(currentQuestion+1)).addClass('currentNum');

                    }
                });
                    setTimeout(function(){ 
                        
                        var totalAnswered = $('.answeredNum').size();
                        var totalUnAnswered = $('.unansweredNum').size();
                        var totalMarked = $('.markNum').size();
                        $('.ansText').html(totalAnswered)
                        $('.unansText').html(totalUnAnswered)
                        $('.markText').html(totalMarked)
                    }, 1000);

            });
            $('#skipBtn').click(function (e) {
                e.preventDefault();
                $($questions.get(currentQuestion)).fadeOut(function () {
                    $('.question_count').removeClass('currentNum');
                    $('#question_count_'+(currentQuestion+1)).addClass('unansweredNum');

                    currentQuestion = currentQuestion + 1;
                    if (currentQuestion == totalQuestions) {
                        alert();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        $('#question_count_'+(currentQuestion+1)).addClass('currentNum');


                    }
                });

                setTimeout(function(){ 
                        
                    var totalAnswered = $('.answeredNum').size();
                    var totalUnAnswered = $('.unansweredNum').size();
                    var totalMarked = $('.markNum').size();
                    $('.ansText').html(totalAnswered)
                        $('.unansText').html(totalUnAnswered)
                        $('.markText').html(totalMarked)
                }, 1000);

            });
            $('#draftBtn').click(function (e) {
                e.preventDefault();
                $('.draftclass').val();
                console.log($('.draftclass').val())
                if($('#question_count_'+(currentQuestion+1)).hasClass('markNum')){

                    $('#question_count_'+(currentQuestion+1)).removeClass('markNum');
                }else{

                    $('#question_count_'+(currentQuestion+1)).addClass('markNum');
                }
                
                    

            });

            $('.question_count').click(function(){
                
                currentQuestion=$(this).text()-1;
                $questions = $('.questionWrap');                
                $questions.hide();
                $($questions.get(currentQuestion)).fadeOut(function () {

                    $('.question_count').removeClass('currentNum');
                    
                    if (currentQuestion == totalQuestions) {

                        
                        alert();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        $('#question_count_'+(currentQuestion+1)).addClass('currentNum');

                    }
                });
            })
            $('.option').dblclick(function(){
                
                if($(this).find('input').is(':checked')){
                    $(this).find('input').removeAttr('checked');
                    $(this).removeClass('checked');
                }
            })
        });

        
        </script>
@endpush