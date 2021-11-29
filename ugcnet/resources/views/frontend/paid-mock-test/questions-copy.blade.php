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
                <form action="{{route('submitAnwser')}}" method="POST"    id="mt_test" >
                        @csrf

                        @php 
                            $q_count=$opt_count=1;
                            
                        @endphp
                    <div class="row" id="_nextquest">
                        <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div class="questionCont">
                                            <input type="hidden" name="drafts[]" value="" class="draftclass">
                                            <input type="hidden" name="question_id" value="{{$allquestions->question_id}}" id="question_id">
                                            
                                            
                                        
                                                <div >
                                                    <div class="questionWrap">
                                                        <div class="question">
                                                            <h1><span id="question_no" data-val="{{$q_count}}">{{$q_count}}.</span>{{$allquestions->question->questionMaster->question}}</h1>
                                                        </div>
                                                        @if ($allquestions->question->questionMaster->option_type==0)
                                                            
                                                            @include('frontend.paid-mock-test._none')
                                                        @endif
                                                        @if ($allquestions->question->questionMaster->option_type==1)
                                                            
                                                            @include('frontend.paid-mock-test._simple')
                                                        @endif
                                                        @if ($allquestions->question->questionMaster->option_type==2)
                                                            @include('frontend.paid-mock-test._conjugate')
                                                            
                                                        @endif
                                                        
                                                    </div>
                                                </div>
                                                <div class="btnDiv">
                                                    <button type="submit" id="draftBtn_{{$q_count}}" class="submitbtn mark-btn btn btn-draft">Mark</button>
                                                    <button type="submit" id="skipBtn_{{$q_count}}" class=" submitbtn skip-btn btn btn-default">Skip</button>
                                                    <button type="button" id="nextBtn_{{$q_count}}" class="submitbtn save-next  btn btn-primary">Save & Next</button>
                                                </div>
                                                @php 
                                                    $q_count++;
                                                @endphp  
                                                    
                                        </div>
                                
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <div class="rightPanel">
                            <h4>{{$allquestions->question->subject->subject_name}}</h4>
                            
                                <ul class="answerType">
                                    <li><span class="answered"></span><div class="ansText">0</div> answered</li>
                                    <li><span class="mark"></span><div class="markText">0</div> mark</li>
                                    <li><span class="unanswered"></span><div class="unansText">{{$noofques}}</div> unanswered</li>
                                </ul>
                                <ul class="questionNum">
                                   
                                    @for ($j=1;$j<=$noofques;$j++)
                                        <li class="question_count" data-val="{{$j}}" id="question_count_{{$j}}">{{$j}}</li>
                                
                                    @endfor
                                    
                                </ul>

                            </div>

                        </div>
                    </div>
                </form>

                              


        </div>
        <div class="testClock">
            <h3>Time Left: <span class="timer">{{trim(getMockTestSettings('mt_duration'))}}:00</span> </h3>
        </div>

    </section>
</section>
@endsection

@push('page_js')
<script>
    var sbtclicked=0;
    var markedArray=[];
    $(document).ready(function(){
        // $questions = $('.questionWrap');
        // $buttons = $('.btnDiv');
        
        // var totalQuestions = $('.questionWrap').size();
        // var totalButtons = $('.btnDiv').size();


        // $('.unansText').html(totalQuestions)

        
        // var currentQuestion = 0;
        // $questions.hide();
        // $buttons.hide();

        // $($questions.get(currentQuestion)).fadeIn();
        // $($buttons.get(currentQuestion)).fadeIn();
        
        $("#mt_test").submit(function(e) {
            e.preventDefault();
            if(sbtclicked==3){
                $.MessageBox({
                input    : false,
                message  : "Your time is up.Exam finished."
                }).done(function(data){
                
                    //$("#mt_test").submit();
                    $("#mt_test").unbind('submit').submit()
                });
                return true;
            }

            //var conf=confirm('Are you sure you want to submit?');
            $($buttons.get(currentQuestion)).fadeOut();

            $($questions.get(currentQuestion)).fadeOut(function () {
                

                currentQuestion = currentQuestion - 1;
                if (currentQuestion == totalQuestions) {
                    //alert();

                } else {
                    $($questions.get(currentQuestion)).fadeIn();
                    $($buttons.get(currentQuestion)).fadeIn();

                    $('#question_count_'+(currentQuestion+1)).addClass('currentNum');


                }
            });
            $.MessageBox({
                buttonDone  : "Yes",
                buttonFail  : "No",
                message     : "Are you sure you want to submit?"
                }).done(function(){
                    sbtclicked=2;

                    $("#mt_test").unbind('submit').submit()

                }).fail(function(){
                    return false;
            });
            
        })


        $('body').on('click','.save-next',function (e) {
        
            e.preventDefault();
           
            let data=$('#mt_test').serialize();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            let answer=$('input[name=answer]:checked').val();
            if(answer==undefined || answer==''){
                alert('Please select the option.')
                return false;
            }
            
            let sbtdata={
                answer:answer,
                question_id:question_id,
                question_no:question_no,
                answer_type:2,
                _token:token
            }
            let url=$('#mt_test').attr('action');
            $.post(url,sbtdata,function(res){
                $("#_nextquest").html(res.html)
            })
        });
        $('body').on('click','.skip-btn',function (e) {
            e.preventDefault();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            
            
            let sbtdata={
                question_id:question_id,
                question_no:question_no,
                answer_type:0,
                _token:token
            }
            let url=$('#mt_test').attr('action');
            $.post(url,sbtdata,function(res){
                $("#_nextquest").html(res.html)
            })

        });
        $('body').on('click','.mark-btn',function (e) {
        
            //debugger;
            e.preventDefault();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            
            
            let sbtdata={
                question_id:question_id,
                question_no:question_no,
                answer_type:1,
                _token:token
            }
            let url=$('#mt_test').attr('action');
            $.post(url,sbtdata,function(res){
                $("#_nextquest").html(res.html)
            })
            // var curQuestion=$($questions.get(currentQuestion));

            // if($('#question_count_'+(currentQuestion+1)).hasClass('markNum')){
            //     $('#question_count_'+(currentQuestion+1)).removeClass('markNum');
            //     $('#draftBtn_'+(currentQuestion+1)).removeClass('marked');
            //     $('#draftBtn_'+(currentQuestion+1)).text('Mark');
            //     markedArray.splice( $.inArray(curQuestion, markedArray), 1 );
            //     // markedArray = jQuery.grep(markedArray, function(value) {
            //     //     return value != curQuestion;
            //     // });

            // }else{
            //     var markedQuestion=curQuestion.children('input').val();
            //     $("#draftBtn_"+(currentQuestion+1)).addClass('marked');
            //     $('#draftBtn_'+(currentQuestion+1)).text('Marked');

            //     markedArray.push(markedQuestion);

            //     $('#question_count_'+(currentQuestion+1)).addClass('markNum');
            // }

            //     $('.draftclass').val(markedArray);

            
                

        });

        $('body').on('click','.question_count',function (e) {
            e.preventDefault();
            //let question_id=$(this).data('val');
            let question_no=$(this).data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            
            
            let sbtdata={
                question_no:question_no,
                _token:token
            }
            let url=$('#mt_test').attr('action');
            $.post(url,sbtdata,function(res){
                $("#_nextquest").html(res.html)
            })
            
        })
        $('.option').dblclick(function(){
            
            if($(this).find('input').is(':checked')){
                $(this).find('input').removeAttr('checked');
                $(this).removeClass('checked');
            }
        })
    });
</script>
<script language="javascript">
    function CountDown(duration, display) {
        if (!isNaN(duration)) {
            var timer = duration, minutes, seconds;
            
            var interVal=  setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                $('.timer').html("<b>" + minutes + "m : " + seconds + "s" + "</b>");
                if (--timer < 0) {
                    timer = duration;
                    $('.timer').html("<b> 00 m : 00 s" + "</b>");
                    sbtclicked=3;
                    $('#mt_test').submit();
                    clearInterval(interVal)
                }
                },1000);
        }
    }
    
    function SubmitFunction(){
        $('form').submit();
        
    }
    var mt_duration={{trim(getMockTestSettings('mt_duration'))*60}};

    CountDown(mt_duration,$('.timer'))
    


</script>    
<script>
    // window.history.forward(1);
    // document.onkeydown = function(){
    // switch (event.keyCode){
    //         case 116 : //F5 button
    //             event.returnValue = false;
    //             event.keyCode = 0;
    //             return false;
    //         case 82 : //R button
    //             if (event.ctrlKey){ 
    //                 event.returnValue = false;
    //                 event.keyCode = 0;
    //                 return false;
    //             }
    //     }
    // }
    // if (document.layers) {
    //     //Capture the MouseDown event.
    //     document.captureEvents(Event.MOUSEDOWN);
    
    //     //Disable the OnMouseDown event handler.
    //     document.onmousedown = function () {
    //         return false;
    //     };
    // }
    // else {
    //     //Disable the OnMouseUp event handler.
    //     document.onmouseup = function (e) {
    //         if (e != null && e.type == "mouseup") {
    //             //Check the Mouse Button which is clicked.
    //             if (e.which == 2 || e.which == 3) {
    //                 //If the Button is middle or right then disable.
    //                 return false;
    //             }
    //         }
    //     };
    // }
    
    // //Disable the Context Menu event.
    // document.oncontextmenu = function () {
    //     return false;
    // };


    // window.onbeforeunload = function() {
    //     if(sbtclicked==3){
    //             //alert('Are you sure you want to submit test now?');
    //             return;
    //     }
    //     if(sbtclicked==2){
            
    //         return;
    //     }
    //     return "Leave this page ?";
    // }

</script>
       
   
@endpush