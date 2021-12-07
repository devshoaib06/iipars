<?php if($paginator->hasPages()): ?>
<?php
    $myLibrary=new \App\library\myFunctions();
?>
    <nav>
        <ul class="pagination result">
           
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">&lsaquo;</a>
                </li>
            <?php endif; ?>

            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php
                //   echo "<pre>";   
                //        print_r($paginator[0]->mock_test_id);
                //     echo "</pre>";   
                    //dd($elements)
                ?>
                <?php if(is_string($element)): ?>
                    <li class="disabled" aria-disabled="true"><span><?php echo e($element); ?></span></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                    //echo "<pre>";  
                        $iscorrect=$myLibrary->checkCorrection($paginator[0]->mock_test_id,$page);  
                        $checkAnsweredtype=$myLibrary->checkAnswered($paginator[0]->mock_test_id,$page);  
                       //print_r($iscorrect);
                    //echo "</pre>";   
                   ?>
                        <?php if($page == $paginator->currentPage()): ?>
                    <li class="active "  aria-current="page"><span class="
                        <?php if($checkAnsweredtype==0): ?>
                            <?php echo e('unanswered'); ?>

                        <?php else: ?>
                        <?php echo e($iscorrect==1?'correntans':'incorrectans'); ?>

                        <?php endif; ?>
                        "><?php echo e($page); ?></span></li>
                        <?php else: ?>
                            <li ><a href="<?php echo e($url); ?>" class="
                                <?php if($checkAnsweredtype==0): ?>
                                 <?php echo e('unanswered'); ?>


                                <?php else: ?>
                                <?php echo e($iscorrect==1?'correntans':'incorrectans'); ?>

                                <?php endif; ?>
                        "><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">&rsaquo;</a>
                </li>
            <?php else: ?>
                <li class="disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
<?php /**PATH /home/teachinns/public_html/resources/views/frontend/paid-mock-test/result_pagination.blade.php ENDPATH**/ ?>