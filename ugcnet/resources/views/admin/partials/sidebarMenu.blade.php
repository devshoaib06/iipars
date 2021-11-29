<ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px;">
    <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
    <li class="sidebar-toggler-wrapper hide">
        <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="sidebar-toggler"> </div>
        <!-- END SIDEBAR TOGGLER BUTTON -->
    </li>
    <li class="nav-item  start @if ($menu_parent == 'dashboard') active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="arrow @if ($menu_parent == 'dashboard')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item start  @if ($menu_child == 'dashboard')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix")) }}" class="nav-link ">
                    <!--<i class="icon-bar-chart"></i>-->
                    <span class="title">Dashboard</span>
                </a>
            </li>                    
        </ul>
    </li>

    <li class="nav-item  @if ($menu_parent == 'users')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-user"></i>
            <span class="title">Users</span>
            <span class="arrow @if ($menu_parent == 'users')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'students')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/students') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Student</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'contributors')  active open @endif">
                <a href="{{route('contributors')}}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Contributors</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'distributors')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/distributors') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Resellers</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'mentors')  active open @endif">
                <a href="{{route('mentors') }}" class="nav-link ">
                    
                    <span class="title">Mentors</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  @if ($menu_parent == 'orders')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-book"></i>
            <span class="title">Orders</span>
            <span class="arrow @if ($menu_parent == 'orders')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'order-list')  active open @endif">
                <a href="{{ route('orderList') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  @if ($menu_parent == 'products')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-graph"></i>
            <span class="title">Courses</span>
            <span class="arrow @if ($menu_parent == 'products')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            {{-- <li class="nav-item  @if ($menu_child == 'combo-course')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/combo-course') }}" class="nav-link ">
                    <span class="title">Combo Course</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'course')  active open @endif">
                <a href="{{ url(route('courses')) }}" class="nav-link ">
                    <span class="title">Course</span>
                </a>
            </li>
            {{-- <li class="nav-item  @if ($menu_child == 'materials')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/items') }}" class="nav-link ">
                    <span class="title">Items</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'list_exam')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/exams') }}" class="nav-link ">
                    <span class="title">Exams</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'list_paper')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/papers') }}" class="nav-link ">
                    <span class="title">Papers</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'list_subject')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/subjects') }}" class="nav-link ">
                    <span class="title">Subjects</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'list_material')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/materials') }}" class="nav-link ">
                    <span class="title">Material Type</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'exam_paper')  active open @endif">
                <a href="{{ route('exam-paper') }}" class="nav-link ">
                    <span class="title">Exam Paper Material</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'exam_paper_material_content')  active open @endif">
                <a href="{{ route('exam-paper-material-content') }}" class="nav-link ">
                    <span class="title">Exam Paper Material Content</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="nav-item  @if ($menu_parent == 'article')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-file-text"></i>
            <span class="title">Articles</span>
            <span class="arrow @if ($menu_parent == 'article')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'article-list')  active open @endif">
                <a href="{{ route('article-list') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'article-cat-list')  active open @endif">
                <a href="{{ route('showcategoryList') }}" class="nav-link ">
                    <span class="title">Categories</span>
                </a>
            </li>
        </ul>
    </li>
    {{-- <li class="nav-item  @if ($menu_parent == 'mock-test')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-question" aria-hidden="true"></i>
            <span class="title">Mock Test</span>
            <span class="arrow @if ($menu_parent == 'mock-test')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'examlist')  active open @endif">
                <a href="{{ route('mockexamlist') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'questionslist')  active open @endif">
                <a href="{{ route('questionslist') }}" class="nav-link ">
                    <span class="title">Questions</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'mock-test-cat-list')  active open @endif">
                <a href="{{ route('showMockcategoryList') }}" class="nav-link ">
                    <span class="title">Categories</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'mock-settings')  active open @endif">
                <a href="{{ route('showSettingsForm') }}" class="nav-link ">
                    <span class="title">Settings</span>
                </a>
            </li>
        </ul>
    </li> --}}
    <li class="nav-item  @if ($menu_parent == 'mock-test')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-question" aria-hidden="true"></i>
            <span class="title">Mock Test</span>
            <span class="arrow @if ($menu_parent == 'mock-test')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            {{-- <li class="nav-item  @if ($menu_child == 'examlist')  active open @endif">
                <a href="{{ route('mockexamlist') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'examlist')  active open @endif">
                <a href="{{ route('mocktestlist') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
            
            {{-- <li class="nav-item  @if ($menu_child == 'questionslist')  active open @endif">
                <a href="{{ route('questionslist') }}" class="nav-link ">
                    <span class="title">Questions</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'questionslist')  active open @endif">
                <a href="{{ route('showMockQuestionList') }}" class="nav-link ">
                    <span class="title">Questions</span>
                </a>
            </li>
            {{-- <li class="nav-item  @if ($menu_child == 'mock-test-cat-list')  active open @endif">
                <a href="{{ route('showMockcategoryList') }}" class="nav-link ">
                    <span class="title">Categories</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'mock-template')  active open @endif">
                <a href="{{ route('showMockTemplateList') }}" class="nav-link ">
                    <span class="title">Test Pattern</span>
                </a>
            </li>
            {{-- <li class="nav-item  @if ($menu_child == 'questions-template-details')  active open @endif">
                <a href="{{ route('showMockTemplateDetailsList') }}" class="nav-link ">
                    <span class="title">Template Details</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'questions-level')  active open @endif">
                <a href="{{ route('showQuestionLevelList') }}" class="nav-link ">
                    <span class="title">Level</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'tab-rule')  active open @endif">
                <a href="{{ route('showMockTabRuleList') }}" class="nav-link ">
                    <span class="title">Tabulation Rule</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'tab-rule-detail')  active open @endif">
                <a href="{{ route('showMockTabRuleDetailsList') }}" class="nav-link ">
                    <span class="title">Tabulation Rule  Details</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'mock-settings')  active open @endif">
                <a href="{{ route('showSettingsForm') }}" class="nav-link ">
                    <span class="title">Settings</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  @if ($menu_parent == 'videos')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-video-camera"></i>
            <span class="title">Videos</span>
            <span class="arrow @if ($menu_parent == 'videos')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'list_video')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/videos') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li>

    {{-- <li class="nav-item  @if ($menu_parent == 'testimonials')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-quote-left"></i>
            <span class="title">Testimonials</span>
            <span class="arrow @if ($menu_parent == 'testimonials')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'list_testimonial')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/testimonials') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li> --}}

    <li class="nav-item  @if ($menu_parent == 'payment-request')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-money"></i>
            <span class="title">Payment Request</span>
            <span class="arrow @if ($menu_parent == 'payment-request')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'list-payment-request')  active open @endif">
                <a href="{{route('paymentRequestList') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li>

    

    <li class="nav-item  @if ($menu_parent == 'newsletter')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-file-text"></i>
            <span class="title">Newsletter</span>
            <span class="arrow @if ($menu_parent == 'newsletter')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'newsletter-list')  active open @endif">
                <a href="{{ route('newsletter-list') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  @if ($menu_parent == 'contact-us')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-phone"></i>
            <span class="title">Contact Us</span>
            <span class="arrow @if ($menu_parent == 'contact-us')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'contact-us-list')  active open @endif">
                <a href="{{ route('contact-us') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item  @if ($menu_parent == 'newsfeed')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-newspaper-o"></i>
            <span class="title">News Feed</span>
            <span class="arrow @if ($menu_parent == 'newsfeed')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'newsfeed-list')  active open @endif">
                <a href="{{ route('newsfeed') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li> 
    <li class="nav-item  @if ($menu_parent == 'banner-slider')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-sliders"></i>
            <span class="title">Slider Box</span>
            <span class="arrow @if ($menu_parent == 'banner-slider')  open @endif"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item  @if ($menu_child == 'banner-slider-list')  active open @endif">
                <a href="{{ route('banner-slider') }}" class="nav-link ">
                    <span class="title">List</span>
                </a>
            </li>
        </ul>
    </li> 
        
    <li class="nav-item  @if ($menu_parent == 'settings')  active open @endif">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-settings"></i>
            <span class="title">Settings</span>
            <span class="selected"></span>
            <span class="arrow @if ($menu_parent == 'settings')  open @endif "></span>
        </a>
        <ul class="sub-menu">
            
            {{-- <li class="nav-item  @if ($menu_child == 'category-list')  active open @endif ">
                <a href="{{ url(config("constants.admin_prefix").'/category-list') }}" class="nav-link ">
                    <span class="title">Category</span>
                </a>
            </li> --}}
            <li class="nav-item  @if ($menu_child == 'reseller-commission')  active open @endif ">
                <a href="{{ route('showResellerCommission')}}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Reseller commission </span>
                </a>
            </li>
            
            <li class="nav-item  @if ($menu_child == 'cms')  active open @endif ">
                <a href="{{ url(config("constants.admin_prefix").'/cms') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">CMS</span>
                </a>
            </li>
            
            <li class="nav-item  @if ($menu_child == 'list_coupon')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/coupons') }}" class="nav-link ">
                    <span class="title">Coupons</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'list_testimonial')  active open @endif">
                <a href="{{ url(config("constants.admin_prefix").'/testimonials') }}" class="nav-link ">
                    <span class="title">Testimonials</span>
                </a>
            </li>
            
            
            <li class="nav-item  @if ($menu_child == 'gnrl')  active open @endif ">
                <a href="{{ url(config("constants.admin_prefix").'/setting') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">General Settings</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'pgnrl')  active open @endif ">
                <a href="{{ url(config("constants.admin_prefix").'/payment-setting') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Payment Gateway Settings</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'eml_tmpl')  active open @endif ">
                <a href="{{ url(config("constants.admin_prefix").'/email-template') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Email Templates</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'banner_tmpl')  active open @endif ">
                <a href="{{ url(config("constants.admin_prefix").'/banner') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Notice</span>
                </a>
            </li>
            <li class="nav-item  @if ($menu_child == 'floater-sign')  active open @endif ">
                <a href="{{ route('showFloaterSignUp') }}" class="nav-link ">
                    <!--<i class="icon-user"></i>-->
                    <span class="title">Floater Sign Up</span>
                </a>
            </li>
            
        </ul>
    </li>
</ul>