<!-- Start main-content -->
  <div class="main-content">

    <!-- Section: inner-header -->
    <section class="inner-header divider parallax layer-overlay overlay-white-8" data-bg-img="<?php echo base_url();?>assets/images/bg6.jpg">
      <div class="container pt-30 pb-30">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h2 class="title">Purchase Your E-Book/ Shorts Notes</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li class="active text-theme-colored">Purchase Your E-Book/ Shorts Notes</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </section>
    </div>

   


    <section class="pu_all_p_cus_sec">
      <div class="container">
      <div class="row">

     <!-- <?php echo $this->session->flashdata('succ_msg'); ?> -->
        <?php

        foreach($ebook_list as $row) 
        {

        
         ?>

      <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/upload/ebook/resize/<?php echo $row->image; ?>">
      </div>
      <div class="main_pur_conte_p_cus">
      <p><?php echo $row->title; ?></p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>manage_ebook/buy_now/<?php echo $row->id; ?>">Buy Now</a>
      </div>
      </div>
      </div>
      </div>

    <?php } ?>



  <!--     <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/img/the-chemistry-book.jpg">
      </div>
      <div class="main_pur_conte_p_cus">
      <p>Chemistry book</p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>about_us">Buy Now</a>
      </div>
      </div>
      </div>
      </div> -->




 <!--      <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/img/the-chemistry-book.jpg">
      </div>
      <div class="main_pur_conte_p_cus">
      <p>Chemistry book</p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>about_us">Buy Now</a>
      </div>
      </div>
      </div>
      </div> -->




  <!--     <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/img/the-chemistry-book.jpg">
      </div>
      <div class="main_pur_conte_p_cus">
      <p>Chemistry book</p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>about_us">Buy Now</a>
      </div>
      </div>
      </div>
      </div> -->

 <!--      <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/img/the-chemistry-book.jpg">
      </div>
      <div class="main_pur_conte_p_cus">
      <p>Chemistry book</p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>about_us">Buy Now</a>
      </div>
      </div>
      </div>
      </div> -->


 <!--      <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/img/the-chemistry-book.jpg">
      </div>
      <div class="main_pur_conte_p_cus">
      <p>Chemistry book</p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>about_us">Buy Now</a>
      </div>
      </div>
      </div>
      </div> -->



  <!--     <div class="col-md-3">
      <div class="pur_ebbok_all_sec">
      <div class="pur_ebbok_img_sec">
      <img src="<?php echo base_url();?>assets/img/the-chemistry-book.jpg">
      </div>
      <div class="main_pur_conte_p_cus">
      <p>Chemistry book</p>
      <div class="buy_now_btn_pur">
       <a class="btn hvr-bounce-to-bottom btn-theme-colored" href="<?php echo base_url();?>about_us">Buy Now</a>
      </div>
      </div>
      </div>
      </div> -->


      </div>
      </div>
    </section>