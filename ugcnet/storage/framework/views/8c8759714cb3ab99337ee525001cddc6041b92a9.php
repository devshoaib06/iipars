<?php 
  $excluded_page=['resellerlogin','resellerforgotpassword','reseller-sign-up','reseller-change-password','contributorlogin','contributorforgotpassword','sign-up'];
 
?>
<footer>
  <div class="container">
  <div class="row">
  <div class="col-sm-3 col-md-4">
    <img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>"  alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF" class="img-responsive" />
<p>&nbsp;</p>
<h3>Call us at:</h3>
<ul>
  <li style="margin-bottom: 3px;">
    <h4><a href="tel:<?php echo e(trim(getSettings('phone'))); ?>"><strong><?php echo e(trim(getSettings('phone'))); ?></strong></a></h4>
  </li>
  <li>
    <h4><a href="tel:<?php echo e(trim(getSettings('phone-2'))); ?>"><strong><?php echo e(trim(getSettings('phone-2'))); ?></strong></a></h4>
  </li>
</ul>
    
   <p class="copyright">Copyright © <?php echo e(date('Y')); ?> Teachinns </p>
    
    </div>
  <div class="col-sm-6 col-md-6 footerlink">
	  <div class="row">
		  <div class="col-sm-6 col-xs-6">
			  <ul>
			  <li><a href="<?php echo e(route('home')); ?>">Home</a></li>
			  <li><a href="<?php echo e(url('/about-us')); ?>">About Us</a></li>
			  <li><a href="<?php echo e(url('/why-us')); ?>">Why Us</a></li>
			  <li><a href="<?php echo e(url('/privacy-policy')); ?>">Privacy Policy</a></li>
			  <li><a href="<?php echo e(url('/terms-condition')); ?>">Terms & Conditions</a></li>
			  <li><a href="#">E-book</a></li>
			  </ul>
		  </div>
		  <div class="col-sm-6 col-xs-6">
			  <ul>
			  <li><a href="<?php echo e(url('articles')); ?>">Articles</a></li>
			  <li><a href="#">Join as Contributor</a></li>
        <li><a href="<?php echo e(route('reseller-sign-up')); ?>">Sign up as Reseller</a></li>
        <li><a href="<?php echo e(route('contactus')); ?>">Contact Us</a></li>
			  </ul>
		  </div>
		</div>
	</div>

  <div class="col-sm-3 col-md-2">
    <div class="sociallink">
  	<h3>Follow Us On:</h3>
	  <a href="<?php echo e(trim(getSettings('facebook'))); ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a>
	  <a href="<?php echo e(trim(getSettings('twitter'))); ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>
	  <a href="<?php echo e(trim(getSettings('linkedin'))); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
	  <a href="<?php echo e(trim(getSettings('youtube'))); ?>"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
    <a href="https://play.google.com/store/apps/details?id=com.edu.teachinns" class="app-store"><img src="<?php echo e(asset('public/frontend/images/android-app.png')); ?>" class="img-responsive"></a>
    </div>
	  
	  
  </div>


  </div>

  </footer>

</div>
<?php echo $__env->make('cookieConsent::index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="modal fade login-modal" id="logmod" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-sm vertical-align-center" role="document">
          <div class="modal-content">
              <div class="logincont">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <div class="poplogo"><img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>"  alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF
                    "/></div>
                  <h2>Login</h2>

                  <form method="post" id="frmx" action="<?php echo e(route('loginAction')); ?>">
                      <?php echo csrf_field(); ?>
                    <div class="errormsg"></div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" class="form-control" name="email" id="email">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" name="password" id="password">
                    </div>
                    
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remberme"> Remember Me
                      </label>
                    </div>
                    <button type="submit" class="submitbut">Log In</button>

                     
                  </form>

                  <div class="row bottomlink">
                      <div class="col-sm-6"><a href="<?php echo e(route('sign-up')); ?>">Don't have an account? Sign up now</a></div>
                      <div class="col-sm-6"><a href="javascript:void(0)" data-toggle="modal" data-target=".forget-pass-modal" class="forgetpass">Lost Your Password?</a></div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>


<div class="modal fade forget-pass-modal" id="formod" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="vertical-alignment-helper">
      <div class="modal-dialog modal-sm vertical-align-center" role="document">
          <div class="modal-content">
              <div class="logincont">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <div class="poplogo"><img src="<?php echo e(asset('public/frontend/images/logo.png')); ?>"  alt="India’s no.1 online study material for UGC & CSIR NTA NET/SET/JRF
                    "/></div>
                  <h2>Forget Password</h2>

                  <form method="post" id="forgotp">
                      <?php echo e(csrf_field()); ?>

                      <div class="errormsg"></div>
                    <div class="form-group">
                      <label>Email Address</label>
                      <input type="text" class="form-control" name="femail" id="femail">
                    </div>
                    
                    <button type="submit" class="submitbut" id="rset">Send</button>
                  </form>                    
              </div>
          </div>
      </div>
  </div>
</div>

<!-- ------------------Alert------------------------- -->



<!-- ------------------Alert------------------------- -->


<script type="text/javascript" src="<?php echo e(asset('public/frontend/js/jquery.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/assets/global/plugins/jquery-validation/js/additional-methods.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/frontend/js/vertical-news.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/frontend/js/custom-scrollbar.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('public/frontend/js/messagebox.js')); ?>"></script>

<?php if($floatersignup!=null): ?>

  <?php 
    $timetoshowPopup=$floatersignup->time*1000;
  ?>
  <?php echo $__env->make('frontend.includes.modal.floater_sign', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<!-- Bootstrap Js --> 
<script src="<?php echo e(asset('public/frontend/js/bootstrap.js')); ?>/"></script> 
<!-- Bootstrap Js --> 

<!--for resize header-->
<script src="<?php echo e(asset('public/frontend/js/classie.js')); ?>"></script>

<!--Sticker js -->

<script src="<?php echo e(asset('public/frontend/js/jquery.simpleTicker.js')); ?>"></script>

<!--code for mentor slider-->

<script type="text/javascript">
$(function() {
  if($('.mentorInfo').html()){
    
    $(".newsticker-jcarousellite").jCarouselLite({
      vertical: true,
      hoverPause:true,
      visible: 2,
      auto: 2000,
      speed:1000
    });
  }
});
</script>

<!--code for ticker-->
<script type="text/javascript">
$(document).ready(function(){
  
    $.simpleTicker($("#newsTicker"),{
      speed : 1000,
      delay : 4000,
      easing : 'swing',
      effectType : 'roll'
    });
});

</script>

<!--code for custom scrollbar-->
<script>
  (function($){
      $(window).on("load",function(){
          $(".short-desc").mCustomScrollbar({
              axis: 'y',
              theme: 'teachinns'
          });
      });
  })(jQuery);
</script>
<script type="text/javascript">
    const COOKIE_DOMAIN = '<?php echo e(config('session.domain') ?? request()->getHost()); ?>';

    function deleteKSCookieAccept() {
      let name="laravel_cookie_consent";
      let value="1";
                debugger
                const date = new Date();
               
                document.cookie = name + '=' + value
                    + ';expires=Thu, 01 Jan 1970 00:00:01 GMT'
                    + ';domain=' + COOKIE_DOMAIN
                    + ';path=/<?php echo e(config('session.secure') ? ';secure' : null); ?>';

                $(".privacy_popup").show()
            }
    $("#frmx").validate({
    errorElement: 'span',
    rules: {      
        
        email:{
            required: true,
            email: true            
        },
            
        password:{
            required: true,
            minlength: 6
        },
    },
    messages: {        
        email:{
            required: 'Email is required.',
            email: 'Please enter valid email.'
        },
        password:{
            required: 'Password is required.'
        }, 
        
    },
    submitHandler: function (form) {
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let url="<?php echo e(url(route('loginAction'))); ?>";
        let data=$('#frmx').serialize();
        $.post(url,data,function(response){
          
          if(response.status==false){
             let html='<div class="alert alert-danger">';
                 html+=response.msg;
                 html+='</div>';

              $('.errormsg').html(html);   
          }else if(response.status==true && response.redirecturl=='billing'){
            window.location.replace(response.redirecturl);
          }
          else if(response.status==true){  
            window.location.replace(response.redirecturl);
            
          }else{
            
             let html='<div class="alert alert-danger">';
                 html+='Something went wrong.';
                 html+='</div>';

              $('.errormsg').html(html);
          }
        })

    }
});

$('.mock-test-login').click(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        //let mock_test=$(this).data('productid')
        let url="<?php echo e(route('saveMockTestSessionLogin')); ?>";
        
        $.post(url,function(response){

        })
    })
</script>

<script type="text/javascript">
    
    $("#forgotp").validate({
    errorElement: 'span',
    rules: {      
        
        femail:{
            required: true,
            email: true,
            remote: {
              type: 'post',
                      url: "<?php echo e(url(route('check_useremail'))); ?>",                                            
                      data: {
                            'email': function () { return $('#femail').val(); },
                            "_token": "<?php echo e(csrf_token()); ?>"
                            }
              }  
        },
    },
    messages: {        
        femail:{
            required: 'Email is required.',
            email: 'Please enter valid email.',
            remote:'Sorry! this email-id not registered.'
        },
        
    },
    submitHandler: function (form) {
      event.preventDefault();
      $(".submitbut").prop("disabled", true);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        let url="<?php echo e(url(route('forget_password_action'))); ?>";
        let data=$('#forgotp').serialize();
        $.post(url,data,function(response){
           $(".submitbut").prop("disabled", false);
          console.log(response)
          if(response.status==false){
             let html='<div class="alert alert-danger">';
                 html+=response.msg;
                 html+='</div>';

              $('.errormsg').html(html);   
          }else if(response.status==true){
            let html='<div class="alert alert-success">';
                 html+=response.message;
                 html+='</div>';
              $('.errormsg').html(html);   

          }
          else{
            let html='<div class="alert alert-danger">';
                 html+="Something went wrong";
                 html+='</div>';
              $('.errormsg').html(html);   

            //location.reload();
          }
        })          
      
      }
        
});
</script>

<script type="text/javascript">
  $('document').ready(function() {
    $('.forgetpass').click(function() {
      $('#logmod').modal('hide');
    });
  });
</script>

<script>
    function init() {
        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 00,
                header = document.querySelector("header");
            if (distanceY > shrinkOn) {
                classie.add(header,"smaller");
            } else {
                if (classie.has(header,"smaller")) {
                    classie.remove(header,"smaller");
                }
            }
        });
    }
    window.onload = init();
</script>


<!--for resize header-->
<script src="<?php echo e(asset('public/frontend/js/owl.carousel.js')); ?>"></script>
<script>
            $(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                rtl: false,
                margin: 0,
                nav: true,
				autoplay:true,
				autoplayTimeout:6000,
				autoplayHoverPause:true,
                loop: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 1
                  },
                  1000: {
                    items: 1
                  }
                }
              })
            })
          </script>
 <script>
            $(document).ready(function() {
              var owl = $('.owl-carousel2');
              owl.owlCarousel({
                rtl: false,
                margin: 0,
                nav: true,
				autoplay:true,
				autoplayTimeout:6000,
				autoplayHoverPause:true,
                loop: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 2
                  },
                  1000: {
                    items: 3
                  }
                }
              })
            })
          </script>         
  <script>
            $(document).ready(function() {
              var owl = $('.owl-carousel3');
              owl.owlCarousel({
                rtl: false,
                margin: 0,
                nav: true,
				autoplay:true,
				autoplayTimeout:6000,
				autoplayHoverPause:true,
                loop: true,
                responsive: {
                  0: {
                    items: 1
                  },
                  600: {
                    items: 2
                  },
                  1000: {
                    items: 3
                  }
                }
              })
            })
          </script>         
<script src="<?php echo e(asset('public/frontend/js/pushy.min.js')); ?>"></script>

<script type="text/javascript" src="<?php echo e(asset('public/frontend/js/vmenuModule.js')); ?>"></script>

<script type="text/javascript">
			$(document).ready(function() {
				$(".u-vmenu").vmenuModule({
					Speed: 200,
					autostart: false,
					autohide: false
				});
			});
      $(document).ready(function() {
            var owl = $('.owl-carousel4');
            owl.owlCarousel({
                rtl: false,
                margin: 0,
                nav: true,
                autoplay: true,
                autoplayTimeout: 6000,
                autoplayHoverPause: true,
                loop: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 1
                    },
                    1000: {
                        items: 1
                    }
                }
            })
        })
</script>
<script type="text/javascript">

//code for mcq page

$(document).ready(function() {
    $('.questionWrap > label').on('click', function(){
      $(this).addClass('checked').siblings().removeClass('checked');
    })
});

//code for scroll clock

$(document).ready(function() {
  let distance = 60;
  $(window).scroll(function(){
    if($(window).scrollTop() > distance){
      $('.testClock').fadeIn();
    }else{
      $('.testClock').fadeOut();
    }
  });
});


</script>

<script>
    $(document).ready(function(){
      $(".dropdown, .btn-group").hover(function(){
        var dropdownMenu = $(this).children(".dropdown-menu");
        if(dropdownMenu.is(":visible")){
          dropdownMenu.parent().toggleClass("open");
        }
      });

      $('.crossbar').click(function(){
        $('.topsection').hide();
      });
      let visitor_url="<?php echo e(route('ajax-visitors')); ?>";
      let data={
        visited_page:"<?php echo e(url()->current()); ?>"
      }
      $.get(visitor_url,data,function(res){

      })

    });   
</script>

<script>
$(document).ready(function(){
  // $('#nextBtn').click(function(e){
  //   e.preventDefault();
  //   if($('.questionCont > div').hasClass('qactive')){
  //     $('.questionCont > div').removeClass('qactive').addClass('qinactive').next().addClass('qactive').removeClass('qinactive');
  //   }
  //   //.next('div').addClass('qactive').removeClass('qinactive');
  // });
  // $('.option').dblclick(function(){
  //   if($(this).find('input').is(':checked')){
  //     $(this).find('input').removeAttr('checked');
  //   }
  // })

});

</script>

<script>

</script>
    
<?php echo $__env->yieldPushContent('page_js'); ?>

</body>
</html>
<?php /**PATH /var/www/html/iipars/ugcnet/resources/views/frontend/includes/footer.blade.php ENDPATH**/ ?>