<?php echo $__env->make('frontend.structure.page_meta', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php $__env->startSection('page_content'); ?>
<?php $myFunction= new App\library\myFunctions();
      $protocol = $myFunction->getYoutubeProtocol();                                                
?>
<section class="bodycont">
    <section class="breadcamp">
        <div class="container">
            <ul>
                <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li>Articles</li>
            </ul>
        </div>
    </section>
    <section class="innerpage">
        <div class="articleCont">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-9 col-lg-9">
                    <?php if(isset($featured_article)): ?>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="articleMonthHead">
                            <h1>Article of the month</h1>
                        </div>
                    </div>
                </div>
                <?php 

                            $relatedcategories=explode(",",$featured_article->category_id);
                            @$firstcat=$myFunction->getCategoryName($relatedcategories[0]);
                            // $myFunction->getCategoryName($article_info->category);
                        ?>
               
                <div class="articleMonthWrap">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-6">
                            <div class="articleMonthImg">
                                <img src="<?php echo e(Storage::disk(config('disk.get_article_image'))->url($featured_article->image)); ?>" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-6">
                            <div class="articleMonthCont">
                            <h2>
                                <a href="<?php echo e(route('articleDetails',['category'=>$firstcat->slug,'slug'=>$featured_article->slug])); ?>"><?php echo e($featured_article->title); ?></a>
                            </h2>
                            <div class="caption">
                                <div class="subcource">
                                    <ul>
                                        <?php 
                                        $meta_keys=explode(',', $featured_article->meta_tags);
                                        $meta_keys=array_filter($meta_keys);

                                    ?>
                                    <?php $__currentLoopData = $meta_keys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($info); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                
                                    </ul>
                                </div>
                            </div>
                                <p>
                                    <?php echo Str::limit($featured_article->description, 120, $end='...'); ?>

                                </p>
                                <small><i class="fas fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($featured_article->created_at)->format('d/m/Y')); ?></small>
                                
                                <ul class="catList">
                                    <li>
                                        <a href="<?php echo e(route('articles',['category'=>$firstcat->slug])); ?>"><span class="categories-tag"><?php echo e($firstcat->name); ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(count($allArticles)>0): ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="articlehead">
                            <h2>Articles</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $allArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php 

                            $relatedcategories=explode(",",$article_info->category_id);
                            $firstcat=$myFunction->getCategoryName($relatedcategories[0]);
                            // $myFunction->getCategoryName($article_info->category);
                        ?>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="articleWrap">
                                <div class="articleImg">
                                    <?php 
                                        $imgsrc=Storage::disk(config('disk.get_article_image'))->has($article_info->image)?Storage::disk(config('disk.get_article_image'))->url($article_info->image): Storage::disk(config('disk.get_article_image'))->url('no-image.jpg');
                                    ?>
                            
                                    <img src="<?php echo e($imgsrc); ?>" />
                                </div>
                                <div class="articleInfo">
                                <a href="<?php echo e(route('articleDetails',['category'=>$firstcat->slug,'slug'=>$article_info->slug])); ?>"><h2><?php echo e($article_info->title); ?></h2></a>
                                    <?php echo Str::limit($article_info->description, 120, $end='...'); ?>

                                    <small><i class="fas fa fa-calendar"></i> <?php echo e(\Carbon\Carbon::parse($article_info->created_at)->format('d/m/Y')); ?></small>
                                    <?php $__empty_2 = true; $__currentLoopData = $relatedcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <?php 
                                        $cat_info=$myFunction->getCategoryName($item);
                                    ?>
                                        <a href="<?php echo e(route('articles',['category'=>$cat_info->slug])); ?>"><span class="categories-tag"><?php echo e($cat_info->name); ?></span></a>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                        
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <?php endif; ?>
                    
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <?php echo e($allArticles->links()); ?>


                    </div>
                </div>
                <?php else: ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <div class="articlehead">
                            <h2>Articles</h2>
                        </div>
                    </div>
                </div>
                <p>Coming Soon</p>
                <?php endif; ?>
                
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
        </div>
    </section>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page_js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('frontend.layout.layout_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/teachinns/public_html/resources/views/frontend/articles/article_listing.blade.php ENDPATH**/ ?>