<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>

<?php 
    $myLibrary=new \App\library\myFunctions();
    $timeinsec=trim(getMockTestCountDown("$mock_test_id"));
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
                    <div class="col-sm-6 col-md-6 col-lg-6" >
                        <div class="mcqTestHead">
                            <h3>Time Left: <span class="timer"><?php echo e(gmdate("H",$timeinsec).' hr : '.gmdate("i",$timeinsec).'m : '.gmdate("s",$timeinsec).'s'); ?></span> </h3>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6" style="text-align: right;">

                        <button type="button" id="nextBtn" class="submitbtn endtest  btn btn-primary" data-toggle="modal" data-target="#submit_test">End Test</button>
                    </div>

                </div>
                <form action="<?php echo e(route('submitAnwser')); ?>" method="POST"    id="mt_test" >
                        <?php echo csrf_field(); ?>

                        <?php 
                            $q_count=$opt_count=1;
                            $marksperQues=$myLibrary->marksperQues($allquestions->questionDetails->question_id,$mock_test_id);
                            
                        ?>
                    <div class="row" id="_nextquest">
                        <div class="col-sm-12 col-md-7 col-lg-7">
                                    <div class="questionCont">
                                            <input type="hidden" name="drafts[]" value="" class="draftclass">
                                            <input type="hidden" name="question_id" value="<?php echo e($allquestions->questionDetails->question_id); ?>" id="question_id">
                                                <div class="">
                                                    <div class="questionWrap">
                                                        <div class="marksband">
                                                        <span class="correctmarks">+<?php echo e($marksperQues); ?></span> /
                                                            <span class="wrongmarks">-0</span>
                                                        </div>
                                                        <div class="question">
                                                            <div class="q-title"><span id="question_no" data-val="<?php echo e($allquestions->question_no); ?>"><?php echo e($allquestions->question_no); ?>.</span><?php echo $allquestions->questionDetails->questionMaster->question; ?></div>
                                                        </div>
                                                        
                                                        <?php if($allquestions->questionDetails->questionMaster->option_type==0): ?>
                                                            
                                                            <?php echo $__env->make('frontend.paid-mock-test._none', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                        <?php if($allquestions->questionDetails->questionMaster->option_type==1): ?>
                                                            
                                                            <?php echo $__env->make('frontend.paid-mock-test._simple', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        <?php endif; ?>
                                                        <?php if($allquestions->questionDetails->questionMaster->option_type==2): ?>
                                                            <?php echo $__env->make('frontend.paid-mock-test._conjugate', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                            
                                                        <?php endif; ?>
                                                        
                                                    </div>
                                                </div>
                                                <div class="btnDiv">
                                                    <?php
                                                        $class="";
                                                        $getAnswerType=$myLibrary->getStudentMockAnswer($q_count,$mock_test_id);
                                                        $markText="Mark";
                                                        if($getAnswerType==1){
                                                            $class="marked";
                                                            $markText="Unmark";
                                                        }
                                                        
                                                    ?>    
                                                    <?php if($getAnswerType==1): ?>
                                                    <button type="submit" id="draftBtn_<?php echo e($q_count); ?>"   class="submitbtn unmark-btn btn btn-draft <?php echo e($class); ?>"><?php echo e($markText); ?></button>
                                                        
                                                    <?php else: ?>
                                                    <button type="submit" id="draftBtn_<?php echo e($q_count); ?>"   class="submitbtn mark-btn btn btn-draft <?php echo e($class); ?>"><?php echo e($markText); ?></button>
                                                        
                                                    <?php endif; ?>
                                                    <button type="submit" id="skipBtn_<?php echo e($allquestions->question_no); ?>" class=" submitbtn skip-btn btn btn-default">Skip</button>
                                                    <button type="button" id="nextBtn_<?php echo e($allquestions->question_no); ?>" class="submitbtn save-next  btn btn-primary">Save & Next</button>
                                                </div>
                                                <?php 
                                                    $q_count++;
                                                ?>  
                                                    
                                        </div>
                                
                        </div>
                        <div class="col-sm-12 col-md-5 col-lg-5">
                            <div class="rightPanel">

                            <h4><?php echo e($allquestions->questionDetails->subject->subject_name); ?></h4>
                            
                                <ul class="answerType">
                                    <li><span class="answered"></span><div class="ansText"><?php echo e($answeredQues); ?></div> answered</li>
                                    <li><span class="mark"></span><div class="markText"><?php echo e($draftQues); ?></div> mark</li>
                                    <li><span class="unanswered"></span><div class="unansText"><?php echo e($unanswered); ?></div> unanswered</li>
                                </ul>
                                <ul class="questionNum">
                                    
                                    <?php for($j=1;$j<=$noofques;$j++): ?>
                                    <?php
                                        $class="";
                                        $getAnswerType=$myLibrary->getStudentMockAnswer($j,$mock_test_id);
                                        
                                        if($getAnswerType==1){
                                            $class="markNum";
                                        }
                                        if($getAnswerType==2){
                                            $class='answeredNum';
                                        }
                                        $curNum=$allquestions->question_no;
                                    ?>    
                                    
                                    <li class="question_count <?php echo e($class); ?> <?php echo e($curNum==$j?'currentNum':''); ?>"  data-val="<?php echo e($j); ?>" id="question_count_<?php echo e($j); ?>"><?php echo e($j); ?></li>
                            
                                <?php endfor; ?>
                                </ul>

                            </div>

                        </div>
                    </div>
                </form>
                <div id="overlay">
                    <div class="cv-spinner">
                        <span class="spinner"></span>
                    </div>
                </div>
                              


        </div>
        <div class="testClock">
            <h3>Time Left: <span class="timer"><?php echo e(trim(getMockTestSettings('mt_duration'))); ?>:00</span> </h3>
        </div>

    </section>
</section>
<div class="modal fade  modal-pop" id="submit_test">
    <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="logincont">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <div class="poplogo">
                            <h2>Are you sure  to end the test?</h2>
                        </div>
                        <h4 class="text-center">Questions summary</h4>
                        <div class="poptext text-center" style="padding-bottom: 20px;">
                            <span class="loader" style="display: none"><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></span>
                            <ul class="answerType" id="sbtQSummary">

                                
                            </ul>
                        </div>
                    <div class="row">

                        <div class="col-sm-6 text-right  mt-2">
                            <a href="<?php echo e(route('mockTestFinalSubmit',['mock_test_id'=>\Hasher::encode($mock_test_id)])); ?>">
                                <button type="submit" class="submitbut1 btn btn-green" id="rset">END TEST</button>
                            </a>      
                        </div>
                        <div class=" col-sm-6  mt-2">
                        <a href="javascript:void(0)" class=" " data-dismiss="modal" aria-label="Close">
                            <button type="submit" class="btn btn-primary " >RESUME TEST</button>
                            
                        </a>
                        
                        </div>
                    </div>
                     </div>
                </div>
            
    </div>
</div> 

<div class="modal fade  modal-pop" id="time_up">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
        <div class="logincont">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="poplogo">
                <i class="fa fa-3x fa-clock-o"></i>
                <h2>Your time is up.</h2>
            </div>
            <h4 class="text-center">You will be redirected to result page.</h4>
            
            </div>
            </div>
    </div>
            
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<script src="<?php echo e(asset('public/frontend/js/jquery.toast.js')); ?>"></script>
<script>
    var sbtclicked=0;
    var markedArray=[];
    $(document).ready(function(){
        
        
        

        $('body').on('click','.save-next',function (e) {
        
            e.preventDefault();
            let data=$('#mt_test').serialize();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            let answer=$("input[name='answer[]']:checked")
              .map(function(){return $(this).val();}).get();
            
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
            $.ajax({
                url: url,
                type: 'post',
                data: sbtdata,
                beforeSend: function(){
                    // Show image container
                    $(".loaderdiv").toggle();
                },
                success: function(response){
                    $('.response').empty();
                    $("#_nextquest").html(response.html)
                },
                complete:function(data){
                    // Hide image container
                    // $("#_nextquest").fadeOut(300);      
                    $(".loaderdiv").toggle();          
                }
            });
            
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
            $.ajax({
                url: url,
                type: 'post',
                data: sbtdata,
                beforeSend: function(){
                    // Show image container
                    $(".loaderdiv").toggle();

                },
                success: function(response){
                    $('.response').empty();
                    $("#_nextquest").html(response.html)
                },
                complete:function(data){
                    
                    $(".loaderdiv").toggle();
         
                }
            });
            

        });
        $('body').on('click','.mark-btn',function (e) {
        
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
            $.ajax({
                url: url,
                type: 'post',
                data: sbtdata,
                beforeSend: function(){
                    // Show image container
                    $(".loaderdiv").toggle();

                },
                success: function(response){
                    $('.response').empty();
                    $("#_nextquest").html(response.html)
                },
                complete:function(data){
                       
                    $(".loaderdiv").toggle();
         
                }
            });
        });
        $('body').on('click','.unmark-btn',function (e) {
        
            e.preventDefault();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
        
            $("#question_count_"+question_no).removeClass('markNum');
            $("#draftBtn_"+question_no).removeClass('unmark-btn');
            $("#draftBtn_"+question_no).addClass('mark-btn');
            $("#draftBtn_"+question_no).text('Mark');

            

            let sbtdata={
                question_id:question_id,
                question_no:question_no,
                answer_type:0,
                _token:token
            }
            let url="<?php echo e(route('submitUnmarkedStudentAnwser')); ?>";
            $.ajax({
                url: url,
                type: 'post',
                data: sbtdata,
                beforeSend: function(){
                    // Show image container
                    $(".loaderdiv").toggle();

                },
                success: function(response){
                    $('.response').empty();
                    $("#_nextquest").html(response.html)
                },
                complete:function(data){
                       
                    $(".loaderdiv").toggle();
         
                }
            });
        
        });

        $('body').on('click','.question_count',function (e) {
            e.preventDefault();
            
            let question_no=$(this).data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            
            
            let sbtdata={
                
                question_no:question_no,
                answer_type:1,
                _token:token
            }
            let url="<?php echo e(route('showQuestion')); ?>";
            $.ajax({
                url: url,
                type: 'post',
                data: sbtdata,
                beforeSend: function(){
                    // Show image container
                    $(".loaderdiv").toggle();

                },
                success: function(response){
                    $('.response').empty();
                    $("#_nextquest").html(response.html)
                },
                complete:function(data){
                       
                    $(".loaderdiv").toggle();
         
                }
            });
            // $.post(url,sbtdata,function(res){
            //     $("#_nextquest").html(res.html)
            // })
            
        })

        $('body').on('click','.sbttest',function(e){
            e.preventDefault();
            let data=$('#mt_test').serialize();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            let answer=$("input[name='answer[]']:checked")
              .map(function(){return $(this).val();}).get();
            let answer_type=0

            debugger;
            if((answer==undefined || answer=='') && question_no!="<?php echo e($noofques); ?>"){
                alert('Please select the option.')
                return false;
            }

            if(answer!=undefined){
                $("#question_count_"+question_no).addClass('answeredNum');
                $("#question_count_"+question_no).removeClass('markNum');
                answer_type=2;
                
                let sbtdata={
                    answer:answer,
                    question_id:question_id,
                    question_no:question_no,
                    answer_type:answer_type,
                    _token:token
                }
                let sbturl=$('#mt_test').attr('action');
                $.post(sbturl,sbtdata,function(res){
                    
                    let url="<?php echo e(route('getQuestionSummary')); ?>";
                    sbtclicked=2
                    $.get(url,function(res){
                        $(".answerType").html(res.html)
                    })
                })
            }
            let url="<?php echo e(route('getQuestionSummary')); ?>";
                    
            $.get(url,function(res){
                $(".answerType").html(res.html)
            })
        })
        $('body').on('click','.endtest',function(e){
            e.preventDefault();
            $('.loader').toggle();
            let data=$('#mt_test').serialize();
            let question_id=$('#question_id').val();
            let question_no=$('#question_no').data('val');
            let token = $('#mt_test').find('input[name="_token"]').val();
            let answer=$('input[name=answer]:checked').val();
            let answer_type=0
            //debugger;
            if(answer==undefined || answer==''){
                answer="";
            }
            if(answer!=""){
                answer_type=2;
                let sbtdata={
                    answer:answer,
                    question_id:question_id,
                    question_no:question_no,
                    answer_type:answer_type,
                    _token:token
                }
                let sbturl=$('#mt_test').attr('action');
                $.post(sbturl,sbtdata,function(res){
                    //$("#_nextquest").html(res.html)
                    let url="<?php echo e(route('getQuestionSummary')); ?>";
                    sbtclicked=2
                    $.get(url,function(res){
                        $(".answerType").html(res.html)
                    })
                    sbtclicked=2;
                })
            }

            let url="<?php echo e(route('getQuestionSummary')); ?>";
                    
            $.get(url,function(res){
                $(".answerType").html(res.html)
                $('.loader').toggle();

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
            var timer = duration,hours ,minutes, seconds;
            //var hours=duration;

            var updateDateTimeUrl="<?php echo e(route('updateStudentResponseTime')); ?>";
            var interVal=  setInterval(function () {
               
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);
                
               
                
                hours   = Math.floor(timer / 3600);
                minutes = Math.floor((timer - (hours * 3600)) / 60);
                seconds = timer - (hours * 3600) - (minutes * 60);

   

                hours = hours < 10 ? "0" + hours : hours;
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

              
               

                $('.timer').html("<b>"+ hours +" hr : " + minutes + "m : " + seconds + "s" + "</b>");
                    if (--timer < 0) {
                        timer = duration;
                        $('.timer').html("<b> 00 m : 00 s" + "</b>");
                        // sbtclicked=3;
                        // $('#mt_test').submit();
                        $('#time_up').modal('toggle');

                        setTimeout(function(){
                            window.location.replace("<?php echo e(route('mockTestFinalSubmit',['mock_test_id'=>\Hasher::encode($mock_test_id)])); ?>");
                        },3000)
                        
                        clearInterval(interVal)
                    }
                },1000);
                
                if (timer < 5*60) {

                    $.toast({
                    text : "Less than 5 mins left.",
                    position:'left',
                    hideAfter: 5000*60,
                    allowToastClose:true,


                    })
                }
        }
    }

   
    function SubmitFunction(){
        $('form').submit();
        
    }
    var mt_duration=<?php echo e(trim(getMockTestCountDown("$mock_test_id"))); ?>;

    CountDown(mt_duration,$('.timer'))

    var updateDateTimeUrl="<?php echo e(route('updateStudentResponseTime')); ?>";

    // repeat with the interval of 2 seconds
    let timerId = setInterval(function () {

            let data={
                    'mock_test_id':"<?php echo e($mock_test_id); ?>",
                    _token:"<?php echo e(csrf_token()); ?>"
                };
                $.post(updateDateTimeUrl,data,function(){

                }); 
    },60*1000);
    
    // after 5 seconds stop
    setTimeout(() => { 
        clearInterval(timerId); 
        alert('stop'); 
    },7200000);
     
   
    

</script>    
<script>
    window.history.forward(1);
    document.onkeydown = function(){
        debugger
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
            case 123 : //R button
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
    // $(document).on("submit", "form#mt_test", function(event){
    //     window.onbeforeunload = null;
    // });

    // window.onbeforeunload = function() {
        
    //     return "Leave this page ?";
    // }

</script>
       
   
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/questions.blade.php ENDPATH**/ ?>