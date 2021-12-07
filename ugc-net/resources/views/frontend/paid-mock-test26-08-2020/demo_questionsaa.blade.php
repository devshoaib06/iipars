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
                        <form action="" method="" id="mt_test" >
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

                                        {{-- <label class="option"><span>A</span>
                                            <input type="radio" class="optionInp" name="name" value="140"> 10
                                        </label>
                                        <label class="option"><span>B</span>
                                            <input type="radio" class="optionInp" name="name" value="141"> 12
                                        </label>
                                        <label class="option"><span>C</span>
                                            <input type="radio" class="optionInp" name="name" value="142"> 14
                                        </label>
                                        <label class="option"><span>D</span>
                                            <input type="radio" class="optionInp" name="name" value="143"> 8
                                        </label>                                                                      --}}
                                    </div>
                                    @php 
                                        $q_count++;
                                    @endphp  
                                @endforeach
                                                                
                                <div class="btnDiv">
                                    <button type="submit" id="draftBtn" class="submitTest btn btn-draft">Mark</button>
                                    <button type="submit" id="skipBtn" class="submitTest btn btn-default">Skip</button>
                                    <button type="button" id="nextBtn" class="submitTest btn btn-primary">Save & Next</button>
                                </div>
                            </div>
                                
                            
                        </form>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="rightPanel">
                            <h4>General Knowledge</h4>
                            <ul class="answerType">
                                <li><span class="answered"></span><span class="answered_count">0</span>answered</li>
                                <li><span class="mark"></span><span class="marked_count">0</span>mark</li>
                                <li><span class="unanswered"></span><span class="unanswered_count">0</span>unanswered</li>
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
                                {{-- <li>2</li>
                                <li class="unansweredNum">3</li>
                                <li class="unansweredNum">4</li>
                                <li>5</li>
                                <li class="unansweredNum">6</li>
                                <li class="unansweredNum">7</li>
                                <li class="answeredNum">8</li>
                                <li class="answeredNum">9</li>
                                <li class="answeredNum">10</li>
                                <li class="answeredNum">11</li>
                                <li class="markNum">12</li>
                                <li class="markNum">13</li>
                                <li>14</li>
                                <li class="markNum">15</li>
                                <li class="answeredNum">16</li>
                                <li class="answeredNum">17</li>
                                <li class="answeredNum">18</li>
                                <li class="answeredNum">19</li>
                                <li class="answeredNum">20</li> --}}
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
                        $('#question_count_'+(currentQuestion+1)).removeClass('unansweredNum');
                        $('#question_count_'+(currentQuestion+1)).removeClass('answeredNum');
                    if(checked_option){
                        $('#question_count_'+(currentQuestion+1)).addClass('answeredNum');
                    }else{
                        $('#question_count_'+(currentQuestion+1)).addClass('unansweredNum');

                    }

                    currentQuestion = currentQuestion + 1;
                    if (currentQuestion == totalQuestions) {
                        alert();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        

                    }
                });
                    setTimeout(function(){ 
                        
                        var totalAnswered = $('.answeredNum').size();
                        var totalUnAnswered = $('.unansweredNum').size();
                        var totalMarked = $('.marked').size();
                        $('.answered_count').html(totalAnswered)
                        $('.unanswered_count').html(totalUnAnswered)
                        $('.marked_count').html(totalMarked)
                    }, 1000);

            });
            $('#skipBtn').click(function (e) {
                e.preventDefault();
                $($questions.get(currentQuestion)).fadeOut(function () {
                    $('#question_count_'+(currentQuestion+1)).addClass('unansweredNum');
                    currentQuestion = currentQuestion + 1;
                    if (currentQuestion == totalQuestions) {
                        alert();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();

                    }
                });

                setTimeout(function(){ 
                        
                    var totalAnswered = $('.answeredNum').size();
                    var totalUnAnswered = $('.unansweredNum').size();
                    var totalMarked = $('.marked').size();
                    $('.answered_count').html(totalAnswered)
                    $('.unanswered_count').html(totalUnAnswered)
                    $('.marked_count').html(totalMarked)
                }, 1000);

            });
            $('#draftBtn').click(function (e) {
                e.preventDefault();
                
                $('#question_count_'+(currentQuestion+1)).addClass('marked');
                    

            });

            $('.question_count').click(function(){
                
                currentQuestion=$(this).text()-1;
                $questions = $('.questionWrap');                
                $questions.hide();
                $($questions.get(currentQuestion)).fadeOut(function () {

               
                    if (currentQuestion == totalQuestions) {

                        
                        alert();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
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