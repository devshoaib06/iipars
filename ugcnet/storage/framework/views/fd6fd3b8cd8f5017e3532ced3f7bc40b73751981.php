<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true"
    data-slide-speed="200" style="padding-top: 20px;">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    <li class="sidebar-toggler-wrapper hide">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler"> </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
    </li>
    <li class="nav-item  start <?php if($menu_parent == 'dashboard'): ?> active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-dashboard"></i>
            <span class="title">Dashboard</span>
            <span class="arrow <?php if($menu_parent == 'dashboard'): ?>  open <?php endif; ?>"></span>
        </a>

        <ul class="sub-menu">
            <li class="nav-item start  <?php if($menu_child == 'dashboard'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>" class="nav-link ">
                    <!--<i class="icon-bar-chart"></i>-->
                    <span class="title">Dashboard</span>
                </a>
            </li>
        </ul>
    </li>


    <li class="nav-item  <?php if($menu_parent == 'users'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Mentor Management</span>
            <span class="arrow <?php if($menu_parent == 'users'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/sub_admin_list_manage"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Mentors</span>
                </a>
            </li>

        </ul>
    </li>
    <li class="nav-item  <?php if($menu_parent == 'users'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-th"></i>
            <span class="title">Master Data</span>
            <span class="arrow <?php if($menu_parent == 'users'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Admin_service" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Providers</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Admin_service/university_view"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Institutes</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Admin_service/kpo_view"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Subjects</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Admin_service/examination_type_view"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Service Type </span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Admin_service/examination_view"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Services </span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_link" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Important Links </span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_news_feed"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">News Feed </span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_package" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage Package </span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  <?php if($menu_parent == 'users'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-home"></i>
            <span class="title">Manage Home</span>
            <span class="arrow <?php if($menu_parent == 'users'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_slider/ceo"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage home page content</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_slider" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Home Slider</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_home" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Our Mission and Vission and Welcome to IIPARS</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/why_choose_us" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Why Choose us</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/admin_contact" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Contact us</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/admin_contact/contact_query"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Contact us Query</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/admin_contact/single_line_header"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Single line Header</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Manage_social_site/site_view"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage Social Link</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Manage_social_site/visitor"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage Visitor</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Manage_social_site/download"
                    class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage Download</span>
                </a>
            </li>

        </ul>
    </li>

    <li class="nav-item  <?php if($menu_parent == 'users'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-home"></i>
            <span class="title">User Management</span>
            <span class="arrow <?php if($menu_parent == 'users'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'students'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_user_student"
                    class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage User</span>
                </a>
            </li>
        </ul>
    </li>




    <li class="nav-item  <?php if($menu_parent == 'products'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-book"></i>
            <span class="title">Courses</span>
            <span class="arrow <?php if($menu_parent == 'products'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">

            <li class="nav-item  <?php if($menu_child == 'course'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(url(route('courses'))); ?>" class="nav-link ">
                    <span class="title">Course</span>
                </a>
            </li>

            <li class="nav-item  <?php if($menu_child == 'list_exam'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(url(config('constants.admin_prefix') . '/exams')); ?>" class="nav-link ">
                    <span class="title">Exams</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list_paper'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(url(config('constants.admin_prefix') . '/papers')); ?>" class="nav-link ">
                    <span class="title">Papers</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list_subject'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(url(config('constants.admin_prefix') . '/subjects')); ?>" class="nav-link ">
                    <span class="title">Subjects</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list_material'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(url(config('constants.admin_prefix') . '/materials')); ?>" class="nav-link ">
                    <span class="title">Material Type</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'exam_paper'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('exam-paper')); ?>" class="nav-link ">
                    <span class="title">Exam Paper Material</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'exam_paper_material_content'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('exam-paper-material-content')); ?>" class="nav-link ">
                    <span class="title">Exam Paper Material Content</span>
                </a>
            </li>
        </ul>
    </li>
    
    
    <li class="nav-item  <?php if($menu_parent == 'mock-test'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-question" aria-hidden="true"></i>
            <span class="title">Mock Test</span>
            <span class="arrow <?php if($menu_parent == 'mock-test'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
           
            <li class="nav-item  <?php if($menu_child == 'examlist'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('mocktestlist')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">List</span>
                </a>
            </li>

           
            <li class="nav-item  <?php if($menu_child == 'questionslist'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('showMockQuestionList')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Questions</span>
                </a>
            </li>
            
            <li class="nav-item  <?php if($menu_child == 'mock-template'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('showMockTemplateList')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Test Pattern</span>
                </a>
            </li>
            
            <li class="nav-item  <?php if($menu_child == 'questions-level'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('showQuestionLevelList')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Level</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'tab-rule'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('showMockTabRuleList')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Tabulation Rule</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'tab-rule-detail'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('showMockTabRuleDetailsList')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Tabulation Rule Details</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'mock-settings'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(route('showSettingsForm')); ?>" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Settings</span>
                </a>
            </li>
        </ul>
    </li>




    <li class="nav-item  <?php if($menu_parent == 'videos'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-home"></i>
            <span class="title">E-Book and Short Notes</span>
            <span class="arrow <?php if($menu_parent == 'videos'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list_video'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_ebook" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Invitation For E-Book</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list_video'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_ebook/ebook_list" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Book List</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list_video'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_ebook/purchase_ebook" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Purchase E-Book</span>
                </a>
            </li>
        
        </ul>
    </li>

   

    <li class="nav-item  <?php if($menu_parent == 'payment-request'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-home"></i>
            <span class="title">Research Paper Consultancy</span>
            <span class="arrow <?php if($menu_parent == 'payment-request'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_research_guideline" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage General Guideline</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_research_guideline/research_paper_consul_form" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Research Paper Consultancy Application</span>
                </a>
            </li>
 
        </ul>
    </li>
    <li class="nav-item  <?php if($menu_parent == 'payment-request'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-home"></i>
            <span class="title">Dissertation/Thesis Consultancy</span>
            <span class="arrow <?php if($menu_parent == 'payment-request'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_disertation_guideline" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage General Guideline</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_disertation_guideline/thesis_consul_list" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Thesis Consultancy Application</span>
                </a>
            </li>
            
 
        </ul>
    </li>
    <li class="nav-item  <?php if($menu_parent == 'payment-request'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-home"></i>
            <span class="title">PHD Thesis to Book Conversion</span>
            <span class="arrow <?php if($menu_parent == 'payment-request'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_phd_thesis_guideline" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage General Guideline</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/manage_phd_thesis_guideline/phd_thesis_online_application" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">PHD Thesis Online Application</span>
                </a>
            </li>
 
        </ul>
    </li>
    <li class="nav-item  <?php if($menu_parent == 'payment-request'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Service Data</span>
            <span class="arrow <?php if($menu_parent == 'payment-request'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Admin_datalist/form_list" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Service Data List</span>
                </a>
            </li>
            
 
        </ul>
    </li>
    <li class="nav-item  <?php if($menu_parent == 'payment-request'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-youtube-play"></i>
            <span class="title">Manage Gallery</span>
            <span class="arrow <?php if($menu_parent == 'payment-request'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Manage_video_category" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Gallery Category</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Manage_video_category/video_gallery_view" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Video Gallery</span>
                </a>
            </li>
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/Manage_video_category/video_gallery_view" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Image Gallery</span>
                </a>
            </li>
            
        </ul>
    </li>
    <li class="nav-item  <?php if($menu_parent == 'payment-request'): ?>  active open <?php endif; ?>">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-file-text-o"></i>
            <span class="title">Content management</span>
            <span class="arrow <?php if($menu_parent == 'payment-request'): ?>  open <?php endif; ?>"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  <?php if($menu_child == 'list-payment-request'): ?>  active open <?php endif; ?>">
                <a href="<?php echo e(config('path.iipars_admin_base_url')); ?>/index.php/page_list_manage" class="nav-link ">
                    <i class="fa fa-list" aria-hidden="true"></i>
                    <span class="title">Manage Page</span>
                </a>
            </li>
           
            
        </ul>
    </li>



    

        </ul>
    </li>
</ul>
<?php /**PATH /var/www/html/iipars/ugcnet/resources/views/admin/partials/sidebarMenu.blade.php ENDPATH**/ ?>