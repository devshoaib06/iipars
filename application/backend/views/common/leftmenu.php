

<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <!--<li class="header">HEADER</li>-->
            <!-- Optionally, you can add icons to the links -->
            
            <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
            <li><a href="<?php echo base_url(); ?>index.php/admin_dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
<?php } ?>
  <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>
      <li class="treeview <?php if(@$active=="sub_admin"){echo "active";}?>">
                <a href="">  <i class="fa fa-users" aria-hidden="true"></i><span> Mentor Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php if(@$active=="sub_admin"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/sub_admin_list_manage"><i class="fa fa-list" aria-hidden="true"></i> Mentors</a></li>

                   
               </ul>
              </li>
               
           
            <?php } ?> 

             <?php 

                $admin_details=$this->session_check_and_session_data->admin_session_data();

                if(@$admin_details[0]->user_type_id=='1')
                {
            ?>


             <li class="treeview <?php if(@$active=="cc_view" || @$active=="kpo_view" ||  @$active=="diagnosis_view" || @$active=="examination_type" || @$active=="examination_view" || @$active=="medicine_view" || @$active=="medicine_investigation" || @$active=="group_view" || @$active=="group_med_view" || @$active=="medicine_diet" || @$active=="medicine_councelling"|| @$active=="timing" || @$active=="video_category_list1" || @$active=="importain_link" || @$active=="news_feed" || @$active=="manage_package"){echo "active";}?>">
                <a href="">   <i class="fa fa-th" aria-hidden="true"></i><span> Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php if(@$active=="cc_view"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Admin_service"><i class="fa fa-list" aria-hidden="true"></i>Service Providers </a>
                    </li>

                      <li class="<?php if(@$active=='diagnosis_view'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Admin_service/university_view"><i class="fa fa-list"></i>Institutes</a>
                    </li>

                     <li class="<?php if(@$active=='kpo_view'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Admin_service/kpo_view"><i class="fa fa-list"></i> Subjects</a>              
                    </li>

                   <li class="<?php if(@$active=='examination_type'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Admin_service/examination_type_view"><i class="fa fa-list"></i>Service Type </a>              
                    </li>

                    <li class="<?php if(@$active=='examination_view'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Admin_service/examination_view"><i class="fa fa-list"></i>Services 
                     </a>              
                    </li>


                    <!-- <li class="<?php if(@$active=='video_category_list'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Manage_video_category"><i class="fa fa-list"></i>Gallery Category 
                     </a>              
                    </li> -->

                    <li class="<?php if(@$active=='importain_link'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/manage_link"><i class="fa fa-list"></i>Important Links
                     </a>              
                    </li>

                    <li class="<?php if(@$active=='news_feed'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/manage_news_feed"><i class="fa fa-list"></i>News Feed
                     </a>              
                    </li>

                    <li class="<?php if(@$active=='manage_package'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/manage_package"><i class="fa fa-list"></i>Manage Package
                     </a>              
                    </li>

                   

                  
  </ul>
                  

               </li>

               
              
             <?php }  else { ?>
             
                <li class="treeview <?php if(@$active=="cc_view" || @$active=="kpo_view" ||  @$active=="diagnosis_view" || @$active=="examination_type" || @$active=="examination_view" || @$active=="medicine_view" || @$active=="medicine_investigation" || @$active=="group_view" || @$active=="group_med_view" || @$active=="medicine_diet" || @$active=="medicine_councelling"|| @$active=="timing"){echo "active";}?>">
                <a href="">   <i class="fa fa-th" aria-hidden="true"></i><span> Institutes </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                   

                      <li class="<?php if(@$active_page=='diagnosis_view'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Admin_service/university_view"><i class="fa fa-list"></i>Institutes</a>
                    </li>


                   

                  
  </ul>
                  

               </li>
             
             
             <?php  } ?>

             <li class="treeview <?php if(@$active=="slider" || @$active=="manage_home" || @$active=="Manage_social_site" || @$active=="why_choose_us" || @$active=="contact" || @$active=="visitor" || @$active=="ceo" || @$active=="download" ){echo "active";}?>">
                <a href="">  <i class="fa fa-home" aria-hidden="true"></i><span>Manage Home</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">


                     <li class="<?php if(@$active=="ceo"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_slider/ceo"><i class="fa fa-list" aria-hidden="true"></i>Manage home page content</a></li>

                    <li class="<?php if(@$active=="slider"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_slider"><i class="fa fa-list" aria-hidden="true"></i>Home Slider</a></li>

                    <li class="<?php if(@$active=="manage_home"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_home"><i class="fa fa-list" aria-hidden="true"></i>Our Mission and Vission and Welcome to IIPARS</a></li>

                    <li class="<?php if(@$active=="why_choose_us"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/why_choose_us"><i class="fa fa-list" aria-hidden="true"></i>Why Choose us</a></li>

                     <li class="<?php if(@$active=="contact"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/admin_contact"><i class="fa fa-list" aria-hidden="true"></i>Contact us</a></li>


                     <li class="<?php if(@$active=="contact"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/admin_contact/contact_query"><i class="fa fa-list" aria-hidden="true"></i>Contact us Query</a></li>


                     <li class="<?php if(@$active=="contact"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/admin_contact/single_line_header"><i class="fa fa-list" aria-hidden="true"></i>Single line Header</a></li>


                     <li class="<?php if(@$active=="Manage_social_site"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Manage_social_site/site_view"><i class="fa fa-list" aria-hidden="true"></i>Manage Social Link</a></li>


                     <li class="<?php if(@$active=="visitor"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Manage_social_site/visitor"><i class="fa fa-list" aria-hidden="true"></i>Manage Visitor</a></li>

                     <li class="<?php if(@$active=="download"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Manage_social_site/download"><i class="fa fa-list" aria-hidden="true"></i>Manage Download</a></li>

                   
               </ul>
              </li>



               <li class="treeview <?php if(@$active=="manage_user_student" ){echo "active";}?>">
                <a href="">  <i class="fa fa-home" aria-hidden="true"></i><span>User Management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li class="<?php if(@$active=="manage_user_student"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_user_student"><i class="fa fa-list" aria-hidden="true"></i>Manage User</a></li>


                   
               </ul>
              </li>




               <li class="treeview <?php if(@$active=="manage_ebook" || @$active=="ebook_list" || @$active=="purchase_ebook" ){echo "active";}?>">
                <a href="">  <i class="fa fa-home" aria-hidden="true"></i><span>E-Book and Short Notes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li class="<?php if(@$active=="manage_ebook"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_ebook"><i class="fa fa-list" aria-hidden="true"></i>Invitation For E-Book</a></li>


                    <li class="<?php if(@$active=="ebook_list"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_ebook/ebook_list"><i class="fa fa-list" aria-hidden="true"></i>E-Book List</a></li>


                    <li class="<?php if(@$active=="purchase_ebook"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_ebook/purchase_ebook"><i class="fa fa-list" aria-hidden="true"></i>Purchase E-Book</a></li>



                   
               </ul>
              </li>



                   <li class="treeview <?php if(@$active=="manage_research_guideline" || @$active=="manage_home1" || @$active=="1why_choose_us"){echo "active";}?>">
                <a href="">  <i class="fa fa-home" aria-hidden="true"></i><span>Research Paper Consultancy</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li class="<?php if(@$active=="manage_research_guideline"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_research_guideline"><i class="fa fa-list" aria-hidden="true"></i>Manage General Guideline</a></li>

                    <li class="<?php if(@$active=="manage_research_guideline"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_research_guideline/research_paper_consul_form"><i class="fa fa-list" aria-hidden="true"></i>Research Paper Consultancy Application</a></li>

                    <!-- <li class="<?php if(@$active=="why_choose_us"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/why_choose_us"><i class="fa fa-list" aria-hidden="true"></i>Why Choose us</a></li>
 -->
                   
               </ul>
              </li>


                   <li class="treeview <?php if(@$active=="manage_disertation_guideline" || @$active=="manage_home1" || @$active=="1why_choose_us"){echo "active";}?>">
                <a href="">  <i class="fa fa-home" aria-hidden="true"></i><span>Dissertation/Thesis Consultancy</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li class="<?php if(@$active=="manage_disertation_guideline"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_disertation_guideline"><i class="fa fa-list" aria-hidden="true"></i>Manage General Guideline</a></li>

                     <li class="<?php if(@$active=="manage_disertation_guideline"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_disertation_guideline/thesis_consul_list"><i class="fa fa-list" aria-hidden="true"></i>Thesis Consultancy Application</a></li>

                    <!-- <li class="<?php if(@$active=="why_choose_us"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/why_choose_us"><i class="fa fa-list" aria-hidden="true"></i>Why Choose us</a></li> --> 

                   
               </ul>
              </li>

                     <li class="treeview <?php if(@$active=="manage_phd_thesis_guideline" || @$active=="manage_home1" || @$active=="1why_choose_us"){echo "active";}?>">
                <a href="">  <i class="fa fa-home" aria-hidden="true"></i><span>PHD Thesis to Book Conversion</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                    <li class="<?php if(@$active=="manage_phd_thesis_guideline"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_phd_thesis_guideline"><i class="fa fa-list" aria-hidden="true"></i>Manage General Guideline</a></li>

                    <li class="<?php if(@$active=="manage_phd_thesis_guideline"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/manage_phd_thesis_guideline/phd_thesis_online_application"><i class="fa fa-list" aria-hidden="true"></i>PHD Thesis Online Application</a></li>

                    <!-- <li class="<?php if(@$active=="why_choose_us"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/why_choose_us"><i class="fa fa-list" aria-hidden="true"></i>Why Choose us</a></li> -->

                   
               </ul>
              </li>

          

         

      <li class="treeview <?php if(@$active=="sub_admin"){echo "active";}?>">
                <a href="">  <i class="fa fa-users" aria-hidden="true"></i><span> Service Data</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="<?php if(@$active=="sub_admin"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Admin_datalist/form_list"><i class="fa fa-list" aria-hidden="true"></i>Service Data List</a></li>

                   
               </ul>
              </li>


              <li class="treeview <?php if(@$active=="video" || @$active=="Manage_image_category" || @$active=="video_category_list"){echo "active";}?>">
                <a href="">  <i class="fa fa-youtube-play" aria-hidden="true"></i><span>Manage Gallery</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">

                  <li class="<?php if(@$active=='video_category_list'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>index.php/Manage_video_category"><i class="fa fa-list"></i>Gallery Category 
                     </a>              
                    </li>

                    <li class="<?php if(@$active=="video"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Manage_video_category/video_gallery_view"><i class="fa fa-list" aria-hidden="true"></i>Video Gallery</a></li>


                    <li class="<?php if(@$active=="Manage_image_category"){echo "active";}?>"><a href="<?php echo base_url();?>index.php/Manage_image_category/video_gallery_view"><i class="fa fa-list" aria-hidden="true"></i>Image Gallery</a></li>

                   
               </ul>
              </li>

              <?php 

$admin_details=$this->session_check_and_session_data->admin_session_data();
       
     
    if(@$this->user_page_permission_checki_availablity_view_model->check_permission_for_controller('page_list_manage',$this->session->userdata('hs_admin_id'))=='Y' || $admin_details[0]->user_type_id==1)
    { ?>

            <li class="treeview <?php if(@$active=="page_list_manage"){echo "active";}?>">
                <a href=""><i class="fa fa-file-text-o" aria-hidden="true"></i><span> Content management</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  
                    <li class="<?php if(@$active=="page_list_manage"){echo "active";}?>"><a href="<?php echo base_url(); ?>index.php/page_list_manage"><i class="fa fa-list" aria-hidden="true"></i>Manage Page</a></li>

                </ul>
                
            </li> 
            <?php } ?>
               
           
         

            
          
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
