<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>
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
                            <h3>Time Left: <span class="timer"><?php echo e(trim(getMockTestSettings('mt_duration'))); ?>:00</span> </h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7">
                        <form action="<?php echo e(route('submitStudentAnwser')); ?>" method="POST"    id="mt_test" >
                                <?php echo csrf_field(); ?>

                                <div class="questionCont">
                                        <input type="hidden" name="drafts[]" value="" class="draftclass">

                                        <?php 
                                            $q_count=1;
                                            
                                        ?>
                                        <?php $__currentLoopData = $allquestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            
                                            <div class="questionWrap">
                                                <div class="question">
                                                    <h1><span><?php echo e($q_count); ?>.</span><?php echo e($question->question); ?></h1>
                                                </div>
                                                <?php 
                                                    $qoptions=$myLibrary->getQuestionOptions($question->id);
                                                    $index=0;
                                                ?>
                                                <input type="hidden" name="questions[<?php echo e($question->id); ?>]" value="<?php echo e($question->id); ?>">
                                                <?php $__empty_1 = true; $__currentLoopData = $qoptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <label class="option"><span><?php echo e($optionsLabel[$index]); ?></span>
                                                    <input type="radio" name="answer[<?php echo e($question->id); ?>]" value="<?php echo e($option->id); ?>"> <?php echo e($option->answer); ?>

                                                </label>
                                                    <?php 
                                                        $index++;
                                                    ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <p>No Options</p>
                                                    
                                                <?php endif; ?>
        
                                                
                                            </div>
                                            <div class="btnDiv">
                                                <button type="submit" id="draftBtn_<?php echo e($q_count); ?>" class="submitbtn mark-btn btn btn-draft">Mark</button>
                                                <button type="submit" id="skipBtn_<?php echo e($q_count); ?>" class=" submitbtn skip-btn btn btn-default">Skip</button>
                                                <button type="button" id="nextBtn_<?php echo e($q_count); ?>" class="submitbtn save-next  btn btn-primary">Save & Next</button>
                                            </div>
                                            <?php 
                                                $q_count++;
                                            ?>  
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        
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
                                <?php 
                                    $list_count=1;
                                ?>
                                <?php $__currentLoopData = $allquestions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="question_count" id="question_count_<?php echo e($list_count); ?>"><?php echo e($list_count); ?></li>
                                <?php 
                                    $list_count++;
                                ?> 
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                
                            </ul>

                        </div>

                    </div>
                </div>

                              


        </div>
        <div class="testClock">
            <h3>Time Left: <span class="timer"><?php echo e(trim(getMockTestSettings('mt_duration'))); ?>:00</span> </h3>
        </div>

    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script>
         var sbtclicked=0;
         var markedArray=[];


        $(document).ready(function(){
            $questions = $('.questionWrap');
            $buttons = $('.btnDiv');
            debugger;
            var totalQuestions = $('.questionWrap').size();
            var totalButtons = $('.btnDiv').size();


            $('.unansText').html(totalQuestions)

            
            var currentQuestion = 0;
            $questions.hide();
            $buttons.hide();

            $($questions.get(currentQuestion)).fadeIn();
            $($buttons.get(currentQuestion)).fadeIn();
            
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

                // if(conf){
                //     sbtclicked=2;
                //     return true;
                // }
                
                
            })



            $('.save-next').click(function (e) {
                
                $('.skip-btn').prop('disabled',false);
                
                //e.preventDefault();
                //debugger
                $($buttons.get(currentQuestion)).fadeOut();
                
                $($questions.get(currentQuestion)).fadeOut(function () {

                    var checked_option=$($questions.get(currentQuestion)).children().hasClass('checked');
                    

                    currentQuestion = currentQuestion + 1;

                    $('#question_count_'+(currentQuestion)).removeClass('unansweredNum');
                    $('#question_count_'+(currentQuestion)).removeClass('answeredNum');
                    $('#question_count_'+(currentQuestion)).removeClass('currentNum');
                    if(checked_option){
                        $('#question_count_'+(currentQuestion)).addClass('answeredNum');
                        if($('#question_count_'+(currentQuestion)).hasClass('markNum')){
                            $('#question_count_'+(currentQuestion)).removeClass('markNum');
                            markedArray.splice( $.inArray(currentQuestion, markedArray), 1 );
                        }
                    }else{
                        $('#question_count_'+(currentQuestion)).addClass('unansweredNum');

                    }
                    if (currentQuestion ==totalQuestions ) {
                        //debugger;
                        //$("#nextBtn").text('Submit');
                       // $('#mt_test').submit();

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        $($buttons.get(currentQuestion)).fadeIn();

                        $('#question_count_'+(currentQuestion+1)).addClass('currentNum');

                    }
                    if(currentQuestion+1 ==totalQuestions){
                        $("#skipBtn_"+(currentQuestion+1)).prop('disabled',true);

                        $("#nextBtn_"+(currentQuestion+1)).text('Submit');
                        $("#nextBtn_"+(currentQuestion+1)).attr('type','submit')

                    }
                });
                    setTimeout(function(){ 
                        
                        var totalAnswered = $('.answeredNum').size();
                        var totalUnAnswered = totalQuestions-totalAnswered;
                        var totalMarked = $('.markNum').size();
                        $('.ansText').html(totalAnswered)
                        $('.unansText').html(totalUnAnswered)
                        $('.markText').html(totalMarked)
                    }, 1000);

            });
            $('.skip-btn').click(function (e) {
                e.preventDefault();
                //debugger
                $(this).prop('disabled',false);
                
                var $this=$($questions.get(currentQuestion));
                $this.children('label.option').removeClass('checked');
                $this.children('label.option').find('input').removeClass('checked');
                $this.children('label.option').find('input').removeAttr('checked');
               
                $($buttons.get(currentQuestion)).fadeOut();


                
                $($questions.get(currentQuestion)).fadeOut(function () {
                    $('.question_count').removeClass('currentNum');
                    $('#question_count_'+(currentQuestion+1)).addClass('unansweredNum');

                    currentQuestion = currentQuestion + 1;
                    if($('#question_count_'+(currentQuestion)).hasClass('markNum')){
                            $('#question_count_'+(currentQuestion)).removeClass('markNum');
                            markedArray.splice( $.inArray(currentQuestion, markedArray), 1 );
                    }
                    if (currentQuestion == totalQuestions) {
                        

                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        $($buttons.get(currentQuestion)).fadeIn();

                        $('#question_count_'+(currentQuestion+1)).addClass('currentNum');


                    }
                    if(currentQuestion+1 ==totalQuestions){
                        $("#skipBtn_"+(currentQuestion+1)).prop('disabled',true);
                        $("#nextBtn_"+(currentQuestion+1)).text('Submit');
                        $("#nextBtn_"+(currentQuestion+1)).attr('type','submit')

                    }
                });

                setTimeout(function(){ 
                        
                    var totalAnswered = $('.answeredNum').size();
                    var totalUnAnswered = totalQuestions-totalAnswered;

                    var totalMarked = $('.markNum').size();
                    $('.ansText').html(totalAnswered)
                        $('.unansText').html(totalUnAnswered)
                        $('.markText').html(totalMarked)
                }, 1000);

            });
            $('.mark-btn').click(function (e) {
                //debugger;
                e.preventDefault();
                
                var curQuestion=$($questions.get(currentQuestion));

                if($('#question_count_'+(currentQuestion+1)).hasClass('markNum')){
                    $('#question_count_'+(currentQuestion+1)).removeClass('markNum');
                    $('#draftBtn_'+(currentQuestion+1)).removeClass('marked');
                    $('#draftBtn_'+(currentQuestion+1)).text('Mark');
                    markedArray.splice( $.inArray(curQuestion, markedArray), 1 );
                    // markedArray = jQuery.grep(markedArray, function(value) {
                    //     return value != curQuestion;
                    // });

                }else{
                    var markedQuestion=curQuestion.children('input').val();
                    $("#draftBtn_"+(currentQuestion+1)).addClass('marked');
                    $('#draftBtn_'+(currentQuestion+1)).text('Marked');

                    markedArray.push(markedQuestion);

                    $('#question_count_'+(currentQuestion+1)).addClass('markNum');
                }

                    $('.draftclass').val(markedArray);
                
                    

            });

            $('.question_count').click(function(){
                $("#nextBtn").text('Save & Next');
                $("#nextBtn").attr('type','button')
                currentQuestion=$(this).text()-1;
                $questions = $('.questionWrap');                
                $questions.hide();
                $buttons.hide();
                $('.skip-btn').prop('disabled',false);


                $($buttons.get(currentQuestion)).fadeOut();

                $($questions.get(currentQuestion)).fadeOut(function () {

                    $('.question_count').removeClass('currentNum');
                    
                    if (currentQuestion == totalQuestions) {


                    } else {
                        $($questions.get(currentQuestion)).fadeIn();
                        $($buttons.get(currentQuestion)).fadeIn();

                        $('#question_count_'+(currentQuestion+1)).addClass('currentNum');

                    }
                    if(currentQuestion+1 ==totalQuestions){
                        $("#skipBtn_"+(currentQuestion+1)).prop('disabled',true);

                        $("#nextBtn_"+(currentQuestion+1)).text('Submit');
                        $("#nextBtn_"+(currentQuestion+1)).attr('type','submit')

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
           var mt_duration=<?php echo e(trim(getMockTestSettings('mt_duration'))*60); ?>;
       
            CountDown(mt_duration,$('.timer'))
          
       
       
       </script>    
       <script>
        window.history.forward(1);
        document.onkeydown = function(){
        switch (event.keyCode){
                case 116 : //F5 button
                    event.returnValue = false;
                    event.keyCode = 0;
                    return false;
                case 82 : //R button
                    if (event.ctrlKey){ 
                        event.returnValue = false;
                        event.keyCode = 0;
                        return false;
                    }
            }
        }
        if (document.layers) {
            //Capture the MouseDown event.
            document.captureEvents(Event.MOUSEDOWN);
        
            //Disable the OnMouseDown event handler.
            document.onmousedown = function () {
                return false;
            };
        }
        else {
            //Disable the OnMouseUp event handler.
            document.onmouseup = function (e) {
                if (e != null && e.type == "mouseup") {
                    //Check the Mouse Button which is clicked.
                    if (e.which == 2 || e.which == 3) {
                        //If the Button is middle or right then disable.
                        return false;
                    }
                }
            };
        }
        
        //Disable the Context Menu event.
        document.oncontextmenu = function () {
            return false;
        };


        window.onbeforeunload = function() {
            if(sbtclicked==3){
                    //alert('Are you sure you want to submit test now?');
                    return;
            }
            if(sbtclicked==2){
                
                return;
            }
            return "Leave this page ?";
        }

       </script>
       
   
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/mock-test/questions.blade.php ENDPATH**/ ?>