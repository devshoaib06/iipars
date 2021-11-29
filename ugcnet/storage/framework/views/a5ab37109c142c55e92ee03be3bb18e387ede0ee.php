<?php 
    $myLibrary=new \App\library\myFunctions();
    $marksperQues=$myLibrary->marksperQues($allquestions->questionDetails->question_id,$mock_test_id);

?>
<div class="row">
    <div class="col-sm-12 col-md-7 col-lg-7">
                <div class="questionCont">
                        <input type="hidden" name="drafts[]" value="" class="draftclass">
                        <input type="hidden" name="question_id" value="<?php echo e($allquestions->questionDetails->question_id); ?>" id="question_id">
                        

                    
                            <div >
                                <div class="questionWrap">
                                    <div class="marksband">
                                        <span class="correctmarks">+<?php echo e($marksperQues); ?></span> /
                                            <span class="wrongmarks">-0</span>
                                        </div>
                                    <div class="question">
                                        <h1><span id="question_no" data-val="<?php echo e($allquestions->question_no); ?>"><?php echo e($allquestions->question_no); ?>.</span><?php echo $allquestions->questionDetails->questionMaster->question; ?></h1>
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
                                <?php if($q_count==$noofques): ?>
                                <button type="button" id="nextBtn_<?php echo e($q_count); ?>" class="submitbtn  btn btn-primary sbttest" data-toggle="modal" data-target="#submit_test">Submit</button>
                                
                                <?php else: ?>
                                    <button type="submit" id="skipBtn_<?php echo e($q_count); ?>" class=" submitbtn skip-btn btn btn-default">Skip</button>
                                    
                                    <button type="button" id="nextBtn_<?php echo e($q_count); ?>" class="submitbtn save-next  btn btn-primary ">Save & Next</button>
                                <?php endif; ?>
                            </div>
                            <?php 
                                $q_count++;
                            ?>  
                                
                    </div>
            
    </div>
    <div class="col-sm-12 col-md-5 col-lg-5">
        <div class="rightPanel">
        <h4><?php echo e($subject); ?></h4>
        
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
                        $curNum=$q_count-1;
                    ?>    
                    
                    <li class="question_count <?php echo e($class); ?> <?php echo e($curNum==$j?'currentNum':''); ?>" data-val="<?php echo e($j); ?>" id="question_count_<?php echo e($j); ?>"><?php echo e($j); ?></li>
            
                <?php endfor; ?>
                
            </ul>

        </div>

    </div>
</div><?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/_nextquestions.blade.php ENDPATH**/ ?>