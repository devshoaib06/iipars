<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>
<?php
    $myfunction = new App\library\myFunctions();
    $protocol = $myfunction->getYoutubeProtocol();                                                

?>
<section class="innerbanner">
    <img src="<?php echo e(asset('public/frontend/images/shortbanner.jpg')); ?>" alt="Crack the CSIR-UGC NET/SET/JRF exam with our online course material
">
</section>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(url('/')); ?>">Home</a></li>
                <li>Article</li>
                <li><?php echo e($article_info->title); ?></li>
            </ul>
        </div>
    </section>
    <section class="innerpage">

        
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="articleDetails">
                        <h1><?php echo e($article_info->title); ?></h1>
                        <div class="caption">
                            <div class="subcource">
                                <ul>
                                    <?php 
                                        $meta_keys=explode(',', $article_info->meta_tags);
                                        $meta_keys=array_filter($meta_keys);
                                        $fileexists=Storage::disk(config('disk.get_article_file'))->has($article_info->file);
                                         $file=Storage::disk(config('disk.get_article_file'))->url($article_info->file);
                                    ?>
                                    <?php $__currentLoopData = $meta_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($info); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">

                                <small><i class="fas fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($article_info->created_at)->format('d/m/Y')); ?></small></div>
                                <?php if($fileexists): ?> 
                                    <div class="col-xs-6 text-right">
                                        <?php if(auth()->guard()->check()): ?>
                                        <a href="<?php echo e(route('downloadArticleFile',['article_id'=>\Hasher::encode($article_info->id)])); ?>" class="buynow ">
                                            <i class="fa fa-download"></i> 
                                            Download
                                        </a>
                                        <?php endif; ?>
                                        <?php if(auth()->guard()->guest()): ?>
                                        <a href="#" class="buynow " data-toggle="modal" data-target=".login-modal">
                                            <i class="fa fa-download"></i> 
                                            Download
                                        </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                        </div>
                        
                        
                        <div class="courseImg">
                            <?php 
                                $imgsrc=Storage::disk(config('disk.get_article_image'))->has($article_info->image)?Storage::disk(config('disk.get_article_image'))->url($article_info->image): Storage::disk(config('disk.get_article_image'))->url('no-image.jpg');
                                
                            ?>
                            
                            <img src="<?php echo e($imgsrc); ?>" class="img-responsive" />
                        </div>
                        <div class="outerleftsection">
                            <?php echo $article_info->description; ?>

                        </div>
                        
                        <?php 
                        $myFunction= new App\library\myFunctions();
                        $relatedcategories=explode(",",$article_info->category_id);
                        $firstcat=$myFunction->getCategoryName($relatedcategories[0]);
                        // $myFunction->getCategoryName($article_info->category);
                        ?>
                        <?php $__empty_1 = true; $__currentLoopData = $relatedcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php 
                            $cat_info=$myFunction->getCategoryName($item);
                        ?>
                            <a href="<?php echo e(route('articles',['category'=>$cat_info->slug])); ?>"><span class="categories-tag"><?php echo e($cat_info->name); ?></span></a>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="otherArticle">
                        <h2>Categories</h2>
                        <ul>
                            <li>
                                <a href="<?php echo e(route('articles',['category'=>'current-affairs'])); ?>">Current Affairs</a>
                            </li>
                            
                            
                            
                        </ul>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('page_js'); ?>
<script>
    $('.buy-now-login').click(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let product_id=$(this).data('productid')
        let url="<?php echo e(route('visitor-buy-product')); ?>";
        let data={
            product_id:product_id
        }
        $.post(url,data,function(response){

        })
    })
    $('.login-modal').on('hidden.bs.modal', function () {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let product_id=$(this).data('productid')
        let url="<?php echo e(route('visitor-remove-buy-product')); ?>";
        $.post(url,function(response){

        })
    })   
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/articles/article_details.blade.php ENDPATH**/ ?>