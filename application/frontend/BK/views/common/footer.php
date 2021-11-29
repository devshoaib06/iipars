<!-- ============================================================= FOOTER ============================================================= -->
<footer id="footer" class="footer color-bg">
  <div class="footer-bottom">
    <div class="container">
      <div class="row">

          <div class="col-xs-12 col-sm-6 col-md-3 did">
          <div class="module-heading">
            <h4 class="module-title">Legal Info</h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a title="Privacy Policy" href="<?php echo $this->url->link(31); ?>">Privacy Policy</a></li>
              <li><a title="Terms of Sale" href="<?php echo $this->url->link(30); ?>">Terms of Sale</a></li>
              <li><a href="<?php echo $this->url->link(29); ?>" title="faq">FAQ</a></li>
              <li><a title="Report Abuse & Takedown Policy" href="<?php echo $this->url->link(28); ?>">Patent &amp; Trademarks</a></li>
              <li class="last"><a title="Terms & Conditions" href="<?php echo $this->url->link(21); ?>">Terms &amp; Conditions</a></li>
            </ul>
          </div>
          <!-- /.module-body --> 
        </div>
        
        <!-- /.col -->
        
        <div class="col-xs-12 col-sm-6 col-md-3 did">
          <div class="module-heading">
            <h4 class="module-title">Customer Service</h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="<?php echo $this->url->link(34); ?>" title="My Account">My Account</a></li>
               <li><a href="#" title="Investment">Investment</a></li>
              <li><a href="#" title="Special">Specials</a></li>
              <li class="last"><a href="#" title="Help Center">Help Center</a></li>

              <li><a href="<?php echo $this->url->link(32); ?>" title="contact us">Contact Us</a></li>

            </ul>
          </div>
          <!-- /.module-body --> 
        </div>
        <!-- /.col -->
        
    
        <!-- /.col -->
        
        <div class="col-xs-12 col-sm-6 col-md-3 did">
          <div class="module-heading">
            <h4 class="module-title">Useful Links</h4>
          </div>
          <!-- /.module-heading -->
          
          <div class="module-body">
            <ul class='list-unstyled'>
              <li class="first"><a href="<?php echo $this->url->link(22); ?>" title="About us">About Us</a></li>
              <li><a href="#" title="Services">Services</a></li>
              <li><a href="programme.php" title="Programme">Programme</a></li>
              <li><a href="franchise.php" title="Franchise">Franchise</a></li>
             
              <li><a href="finance.php" title="Finance">Finance</a></li>
              
            </ul>
          </div>
          <!-- /.module-body --> 
        </div>


        <div class="col-xs-12 col-sm-6 col-md-3 did">
          <div class="module-heading">
            <h4 class="module-title">Contact Us</h4>
          </div>
          <!-- /.module-heading -->
          <?php 

        $data['contact'] = $this->common_model->common($table_name = 'tb_site_address', $field = array(), $where = array('  site_address_id'=>1), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        

        $data['social'] = $this->common_model->common($table_name = 'tbl_social_link', $field =array(), $where = array(), $where_or = array('id'=>3), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        ?>
          <div class="module-body">
            <ul class="toggle-footer" style="">
              <?php foreach ($data['contact'] as $row1) { ?>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body">
                  <p><?php echo @$row1->site_phone ?><br><?php echo @$row1->mobile ?></p>
                </div>
              </li>
              <li class="media">
                <div class="pull-left"> <span class="icon fa-stack fa-lg"> <i class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span> </div>
                <div class="media-body"> <span><a href="#"><?php echo $row1->site_email ?></a></span> </div>
              </li>
              <?php } ?>
            </ul>

<div class="module-heading">
            <h4 class="module-title">Stay Connected</h4>
          </div>

         







          </div>


           <div id="social-icon">
             <?php foreach ($data['social'] as $row) { ?>
          <ul class="link1">
          <li><a href="<?php echo $row->facebook_link ?>" class="fot-icon" title="facebook" target="blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>

           <li><a href="<?php echo $row->googleplus_link ?>" class="fot-icon" title="google plus" target="blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>

            <li><a href="<?php echo $row->linkedin_link ?>" class="fot-icon" title="linkedin" target="blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>


             <li><a href="<?php echo $row->pinterest_link ?>" class="fot-icon" title="pinterest" target="blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>

              <li><a href="<?php echo $row->twitter_link ?>" class="fot-icon" title="twitter" target="blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        
        </ul>
        <?php } ?>
        </div>
          <!-- /.module-body --> 
        </div>



      </div>
    </div>
  </div>
  <div class="copyright-bar">
    <div class="container">
      
      <div class="col-xs-12 col-sm-6 no-padding">
        <div class="clearfix payment-methods">
          <ul>
            <li>Copyright © 2017</li>
            
        </div>
        <!-- /.payment-methods --> 
      </div>

      <div class="col-xs-12 col-sm-6 no-padding">
        <div class="clearfix payment-methods" id="text-al">
          <ul>
            <li>
              <a href="http://www.exprolab.com/" target="blank">Design by Exprolab.com</a>
            </li>
            </ul>
        </div>
        <!-- /.payment-methods --> 
      </div>
    </div>
  </div>
  </div>
</footer>
<!-- ============================================================= FOOTER : END============================================================= --> 

<!-- For demo purposes – can be removed on production --> 

<!-- For demo purposes – can be removed on production : End --> 

<!-- JavaScripts placed at the end of the document so the pages load faster --> 
<script src="<?php echo base_url();?>assets/js/jquery-1.11.1.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/bootstrap-hover-dropdown.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/owl.carousel.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/echo.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.easing-1.3.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/bootstrap-slider.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/jquery.rateit.min.js"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/js/lightbox.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/bootstrap-select.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/scripts.js"></script>
<!-- <script src="assets/js/script.js"></script> -->
<script src="<?php echo base_url();?>assets/js/jquery.elevatezoom.js"></script>

<script src="<?php echo base_url();?>assets/js/ubislider.js"></script>


<script type="text/javascript">
$(document).ready(function(){
 $('#slider').ubislider({
    arrowsToggle: true,
    type: 'ecommerce',
    hideArrows: true,
    autoSlideOnLastClick: true,
    modalOnClick: true,
    onTopImageChange: function(){
      $('#imageSlider img').elevateZoom();
    }
 }); 
});

</script>


<script type="text/javascript">
$(document).ready(function() {
  $('.ser-slid').owlCarousel({
    items:5,
    loop:true,
  
    nav:true,
     autoplay:true,
    autoplayTimeout:500,
    autoplayHoverPause:true,
    navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
   responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true,
        },
        600:{
            items:2,
            nav:true,
        },
        1000:{
            items:4,
            nav:true,
            loop:true,
        }
    }
})

});
</script>









</body>

</html>
<script type="text/javascript">
  function add_to_cart(id)
   {
    //alert(id);
    var base_url='<?php echo base_url(); ?>';
    var item_qnty = $("#quantity").val();
    //alert(item_qnty);

      $.ajax(
      {

        type: "POST",
        dataType: 'html',
        url: base_url + "manage_cart/add_to_cart",
        data: {product_id:id,product_quantity:item_qnty},
        async: false,
        success: function (data) {
               //alert(data);
               

               alert('Item successfully added to your cart');


               $("#cart_list").html(data);
               $('body').animate({ scrollTop: 40 }, 'slow')

           }

       });
  }
</script>

<script type="text/javascript">
  function add_to_cart_single(id)
   {
    //alert(id);
    var base_url='<?php echo base_url(); ?>';
    

      $.ajax(
      {

        type: "POST",
        dataType: 'html',
        url: base_url + "manage_cart/add_to_cart",
        data: {product_id:id,product_quantity:1},
        async: false,
        success: function (data) {
               //alert(data);
               

               alert('Item successfully added to your cart');


               $("#cart_list").html(data);
               $('body').animate({ scrollTop: 40 }, 'slow')

           }

       });
  }
</script>

<script type="text/javascript">
  function delete_cart(id)
  {
        //alert(id);
      var base_url='<?php echo base_url(); ?>';

        $.ajax(

            {

            type: "POST",

            dataType: 'html',

            url: base_url + "manage_cart/remove_cart",

            data: {cart_id:id},

            async: false,

            success: function (data) {

              // alert(data);

              alert('Item deleted from your cart');

               $("#cart_list").html(data);

            }

            

        });
  }
</script>
<script type="text/javascript">
  function buy_single(id)
   {
    //alert(id);
    var base_url='<?php echo base_url(); ?>';
    

      $.ajax(
      {

        type: "POST",
        dataType: 'html',
        url: base_url + "manage_cart/add_to_cart",
        data: {product_id:id,product_quantity:1},
        async: false,
        success: function (data) {
               //alert(data);
               
               //alert('Item successfully added to your cart');

               $("#cart_list").html(data);
               //$('body').animate({ scrollTop: 40 }, 'slow')
               window.location.href='<?php echo base_url();?>checkout'
               //window.location.href='<?php echo $this->url->link(8); ?>

           }

       });
  }
</script>
<script type="text/javascript">

  function add_to_wishlist(id)
  {
        //alert(id);
        var base_url='<?php echo base_url(); ?>';

        $.ajax(

            {

            type: "POST",

            dataType: 'json',

            url: base_url + "wishlist/add_wishlist",

            data: {pro_id:id},

            async: true,

            success: function (data) {

              
                console.log(data.wishlist);
                var perform= data.wishlist;
               
                 if(perform==2)
                 {
                   alert('Item Added To Wishlist');
                   //location.reload();
                  }

                 if(perform==1)
                 {
                    alert('Item Deleted From Wishlist');
                    //location.reload();
                 }
                 if(perform==3)
                 {
                    if(confirm('Plaese Log in !'))
                    {
                    window.location.href = base_url+"<?php echo $this->url->slug(3)?>";
                    }
                   //location.reload();
                 }
                 
                 
               
        }

            

        }); 
  

    }
</script>
<script type="text/javascript">
  function remove_wishlist(id)

    {
       //alert(id);
        var base_url='<?php echo base_url(); ?>';
        if(confirm('Are you sure??'))
        {
        $.ajax(

            {

            type: "POST",

            dataType: 'json',

            url: base_url + "wishlist/remove_wishlist",

            data: {wish_id:id},

            async: false,

            success: function (data) {

               //alert(data);

               var perform= data.del_result;
               if(perform==1)
               {
                alert('Item deleted from your list');
                location.reload();
               }
              

            }

            

        });

    }

    }
</script>


<!-- jQuery UI -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



                    <script type="text/javascript">
                      
                      

                        var base_url='<?php echo base_url()?>';
                       function product_auto(text_id)
                        {
                                var query = $('#search_name').val();

                                      $('#ssearch_name').autocomplete({
                               source: function(request, response) {
                                 $.ajax({
             
                                 url:base_url+'autocomplete_search/autocomplete_product',
                                 //data:{'request':$("#"+text_id).val(),cat_id:cat_id},

                                data:{'request':query},


                                 dataType: "json",
                                type: "POST",
                                success: function(data){
                                 //console.log(data);
                                response(data);
                                 /*alert(data);*/
                                                     }
                                });
                                 },
                            });
                       }
                    </script>

<link href="<?php echo base_url(); ?>star_rating/rating.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo base_url(); ?>star_rating/rating.js"></script>
<script language="javascript" type="text/javascript">
  $(function() {

     $('#manufactured_date').datepicker({
      autoclose: true
    });

     $('#expiry_date').datepicker({
      autoclose: true
    });


    $("#rating_star").codexworld_rating_widget({
      starLength: '5',
      initialValue: '1',
      //callbackFunctionName: 'processRating',
      imageDirectory: '<?php echo base_url(); ?>star_rating/images/',
      inputAttr: 'postID'
    });
    $("#rating_star1").codexworld_rating_widget({
      starLength: '5',
      initialValue: '1',
      //callbackFunctionName: 'processRating',
      imageDirectory: '<?php echo base_url(); ?>star_rating/images/',
      inputAttr: 'postID'
    });
  });

</script>