<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler"> </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
                <!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
                <!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
                <form class="sidebar-search  sidebar-search-bordered" action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <!--<div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>-->
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
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
			
			<li class="nav-item  @if ($menu_parent == 'settings')  active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Settings</span>
                    <span class="selected"></span>
                    <span class="arrow @if ($menu_parent == 'settings')  open @endif "></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item  @if ($menu_child == 'workcategory')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/workcategory') }}" class="nav-link ">
							<!--<i class="icon-user"></i>-->
                            <span class="title">Work Category</span>                            
                        </a>
                    </li>	
					
					<li class="nav-item  @if ($menu_child == 'skills')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/skills') }}" class="nav-link ">
							<!--<i class="icon-user"></i>-->
                            <span class="title">Skills</span>                            
                        </a>
                    </li>	
					
					<li class="nav-item  @if ($menu_child == 'proficiency')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/english-proficiency') }}" class="nav-link ">
							<!--<i class="icon-user"></i>-->
                            <span class="title">English Proficiency</span>                            
                        </a>
                    </li>
					
					<li class="nav-item  @if ($menu_child == 'availability')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/work-availability') }}" class="nav-link ">
							<!--<i class="icon-user"></i>-->
                            <span class="title">Workdeliver Availability</span>                            
                        </a>
                    </li>
					
					<li class="nav-item  @if ($menu_child == 'cms')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/cms') }}" class="nav-link ">
							<!--<i class="icon-user"></i>-->
                            <span class="title">CMS</span>                            
                        </a>
                    </li>
					
					<li class="nav-item  @if ($menu_child == 'disput')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/disput-issues') }}" class="nav-link ">
							<!--<i class="icon-user"></i>-->
                            <span class="title">Disput Issues</span>                            
                        </a>
                    </li>
								
                </ul>
            </li>
			
            <!--<li class="heading">
                <h3 class="uppercase">Layouts</h3>
            </li>-->
            
            <li class="nav-item  @if ($menu_parent == 'users')  active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>
                    <span class="title">User</span>
                    <span class="arrow @if ($menu_parent == 'users')  open @endif"></span>
                </a>
                <ul class="sub-menu">        
                    <li class="nav-item  @if ($menu_child == 'freelancer')  active open @endif">
                        <a href="{{ url(config("constants.admin_prefix").'/users-freelancer') }}" class="nav-link ">
                            <!--<i class="icon-user"></i>-->
                            <span class="title">Freelancer</span>
                        </a>
                    </li>
                    <li class="nav-item  @if ($menu_child == 'employer')  active open @endif">
                        <a href="{{ url(config("constants.admin_prefix").'/users-employer') }}" class="nav-link ">
                            <!--<i class="icon-user"></i>-->
                            <span class="title">Employer</span>
                        </a>
                    </li>
                </ul>
            </li>
			
			<li class="nav-item  @if ($menu_parent == 'jobs')  active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-briefcase"></i>
                    <span class="title">Jobs</span>
                    <span class="selected"></span>
                    <span class="arrow @if ($menu_parent == 'settings')  open @endif "></span>
                </a>
                <ul class="sub-menu">
					<li class="nav-item  @if ($menu_child == 'job')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/job') }}" class="nav-link ">
							<!--<i class="icon-diamond"></i>-->
                            <span class="title">Job</span>                            
                        </a>
                    </li>
                </ul>
            </li>
			
			<li class="nav-item  @if ($menu_parent == 'withdraw')  active open @endif">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="icon-action-redo"></i>
					<span class="title">Withdraw</span>
					<span class="selected"></span>
					<span class="arrow @if ($menu_parent == 'withdraw')  open @endif "></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item  @if ($menu_child == 'withdraw-request')  active open @endif ">
						<a href="{{ url(config("constants.admin_prefix").'/withdraw-request-list') }}" class="nav-link ">
							<!--<i class="icon-diamond"></i>-->
							<span class="title">Withdraw Request</span>                            
						</a>
					</li>
				</ul>
			</li>

			<li class="nav-item  @if ($menu_parent == 'disput')  active open @endif">
				<a href="javascript:;" class="nav-link nav-toggle">
					<i class="icon-bell"></i>
					<span class="title">Disput</span>
					<span class="selected"></span>
					<span class="arrow @if ($menu_parent == 'disput')  open @endif "></span>
				</a>
				<ul class="sub-menu">
					<li class="nav-item  @if ($menu_child == 'disput-request')  active open @endif ">
						<a href="{{ url(config("constants.admin_prefix").'/disput-request-list') }}" class="nav-link ">
							<!--<i class="icon-diamond"></i>-->
							<span class="title">Disput Request</span>                            
						</a>
					</li>
				</ul>
			</li>
            
           	<li class="nav-item  @if ($menu_parent == 'eml_tmpl')  active open @endif">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-envelope-open"></i>
                    <span class="title">Email Template</span>
                    <span class="selected"></span>
                    <span class="arrow @if ($menu_parent == 'eml_tmpl')  open @endif "></span>
                </a>
                <ul class="sub-menu">
					<li class="nav-item  @if ($menu_child == 'eml_tmpl')  active open @endif ">
                        <a href="{{ url(config("constants.admin_prefix").'/email-template') }}" class="nav-link ">
							<!--<i class="icon-diamond"></i>-->
                            <span class="title">Template</span>                            
                        </a>
                    </li>
                </ul>
            </li>
			
			
			
			
			
			

        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>