<div class="header-top d-none_mobile">

    <div class="container news_fes_p_cus">
      <div class="d-flex align-items-cencer">
        <div class="news-title">
          <h4 class="mt-0 line-height-1 mb-0">News <span class="text-theme-colored2"> Feed</span> <img
              src="<?php echo e(config('path.iipars_base_url')); ?>/assets/img/arrow.gif"></h4>
        </div>
        <div id="newsTicker" class="accounceBox ticker">
          <ul>
            <?php $__currentLoopData = $newsfeed; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($news->image == ''): ?>
                <li><a download href="<?php echo e($news->description); ?>"
                    target="_blank"><?php echo e($news->title); ?><img src="<?php echo e(config('path.iipars_base_url')); ?>assets/img/new.gif" class="new_gif_class"></a>
                </li>
                  
              <?php else: ?>
                <li><a download href=" <?php echo e(config('path.iipars_base_url')); ?>/upload/news_feed/<?php echo e($news->image); ?>"
                    target="_blank"><?php echo e($news->title); ?><img src="<?php echo e(config('path.iipars_base_url')); ?>assets/img/new.gif" class="new_gif_class"></a>
                </li>
                  
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>

       

      </div>

    </div>

  </div>


  <div class="header-middle p-0 bg-lighter xs-text-center">
    <div class="container pt-20 pb-20 p_cus_mobile_all_header_ppp">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-3">
          <a class="menuzord-brand pull-left flip sm-pull-center" href="<?php echo e(config('path.iipars_base_url')); ?>/"><img
              src="<?php echo e(config('path.iipars_base_url')); ?>/assets/images/new-aeducation-logo.png" alt=""></a>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-9 text-ali-rt text-ce-res">

          <div class="hed-cont widget mt-10 mb-10 m-0 res-none">
            <div class="hed-cont widget mt-10 mb-10 m-0 res-none">
              <a class="btn mt-10 trans-btn"
                href="https://web.whatsapp.com/send?phone=9547046102&amp;text=Hi, I am interested in one of your courses. Reply me back to help me with further enquiry."
                target="_blank">
                <!-- <i class="fa fa-lg fa-mobile text-primary" aria-hidden="true"></i> --><img
                  src="<?php echo e(asset('/public/frontend/images/whatsapp-M.png')); ?>" alt="Whatsapp"
                  style="height: 16px"> WhatsApp</a>
            </div>

            <a class="btn mt-10 trans-btn" href="#"><i class="fa fa-lg fa-envelope-o text-primary"
                aria-hidden="true"></i>info.iipars@gmail.com</a>
           
          </div>

          <div class="hed-cont widget mt-10 mb-10 m-0 res-none">
            <a class="btn mt-10 trans-btn" href="#"><i class="fa fa-lg fa-mobile text-primary"
                aria-hidden="true"></i> +91 9547046102</a>
            
          </div>
          <div class="hed-cont widget mt-10 mb-10 m-0 login_p_cus_mobile">
            <a class="btn mt-10 btn-success" href="<?php echo e(config('path.iipars_base_url')); ?>/sign-in"><i class="fa fa-sign-in"
                aria-hidden="true"></i> <strong>Login</strong></a>
           
          </div>



        </div>
        <div class="pull-right sm-pull-none mb-sm-15 pr-15 all_app_download_api_score_entry_lavel_p_cus">
         
        </div>


      </div>
    </div>
  </div>
<?php /**PATH /var/www/html/iipars/ugcnet/resources/views/frontend/includes/top_header_bar.blade.php ENDPATH**/ ?>