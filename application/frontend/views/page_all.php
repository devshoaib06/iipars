<!-- Start main-content -->

<div class="main-content">



  <!-- Section: inner-header -->
  <!-- data-bg-img="<?php echo base_url();?>assets/images/bg6.jpg"  -->

  <section class="inner-header divider parallax layer-overlay overlay-white-8" style="background-image: url(<?php echo base_url();?>assets/images/bg6.jpg); background-repeat: no-repeat; background-size: 100%; background-position: 0 0; height:200px">

    <div class="container pt-30 pb-30">

      <!-- Section Content -->

      <div class="section-content">

          

        </div>

      </div>

    </section>



<?php 

// echo '<pre>';

// print_r($page_detl);

// exit;

?>





    <!-- Section: Breadcrumb  -->

    <section class="breadcamp">

      <div class="container">

        <ul>

          <li><a href="<?php echo base_url(); ?>">Home</a></li>

          <li class="active text-theme-colored"><?php if(!empty($head)){echo $head;}?> </li>

        </ul>

      </div>

    </section>



    <!-- start Section: Content -->

    <section class="section-content__innerpage">

      <div class="container ">

        <div class="row d-flex">



          <div class="col-sm-8">
            <h1><?php if(!empty($head)){echo $head;}?></h1>
            
            <?php if(!empty($page_detl)){
            foreach($page_detl as $p){
                ?>
                <div class="each-page">
                  <h2 class="mt-0"><?php if(!empty($p->title)){echo $p->title ;}?></h2>

                  <?php if(!empty($p->sub_title)){ ?>

                  

                <?php }?>

                  <div class="cms-content">

                    <?php if(!empty($p->content)){echo $p->content ;}?>

                  </div>
            </div>

            <?php 
                }
            }
            ?>

          </div>



          <div class="col-sm-4">

            <div class="rightvideo1">

              <div class="link-sec">
					<h2>Our <span class="text-theme-colored2">Services</span></h2>
					<ul>
					    
					    <?php
                            // Load header_view
                            $this->load->view('our_services');
                            ?>
						<!--<li><a href="<?php echo base_url();?>Manage_research/writing_consultancy"><i class="fa fa-angle-double-right"></i>Research Paper Writing Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_research/paper_publication"><i class="fa fa-angle-double-right"></i>Research Paper Publication Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_phd"><i class="fa fa-angle-double-right"></i>Ph. D. Thesis writing Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_research/mphil_dissertation"><i class="fa fa-angle-double-right"></i>M.Phil. Dissertation writing Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_research/project_work"><i class="fa fa-angle-double-right"></i>Project Work Writing Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_research/data_analysis"><i class="fa fa-angle-double-right"></i>Data Analysis & Research Methodology</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_self_book_publication/writing_consultancy"><i class="fa fa-angle-double-right"></i>Book Writing Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_self_book_publication/publication_consultacy"><i class="fa fa-angle-double-right"></i>Book Publication Consultancy</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_self_book_publication/thesis_publication"><i class="fa fa-angle-double-right"></i>Thesis to Book Publication</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_self_book_publication/dissertation_publication"><i class="fa fa-angle-double-right"></i>M.Phil. Dissertation to Book Publication</a></li>-->
						<!--<li><a href="<?php echo base_url();?>Manage_self_book_publication/project_work_book"><i class="fa fa-angle-double-right"></i>Project Work to Book Publication</a></li>-->
					</ul>
				</div>

            </div>



        </div>

      </div>

    </section>







    </div>



  </section>



