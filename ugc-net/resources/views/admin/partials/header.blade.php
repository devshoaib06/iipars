<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="{{ url(config('constants.admin_prefix')) }}" class="page-unload-prevent">
                <img src="{{ config('path.assets_path') }}/assets/layouts/layout/img/logo.jpg" alt="logo"
                    class="logo-default" />
                {{-- <span class="logo-lg">iipars</span> --}}
            </a>
            <div class="menu-toggler sidebar-toggler" onClick="setCookieMenu();"> </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
            data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">

                <?php
                //$myfunction = new App\library\myFunctions();
                //$last_login = $myfunction->dateText(Auth::guard('admins')->user()->last_login,'m/d/y-h:m');
                ?>
                <!-- <li class="last-login"><span>Last Login : <?php //echo $last_login;
?></span></li> -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                        data-close-others="true">
                        <!--<img alt="" class="img-circle" src="{{ config('path.assets_path') }}/assets/layouts/layout/img/avatar.png" />-->
                        <img alt="<?php echo Auth::guard('admins')->user()->name; ?>" class="img-circle"
                            src="{{ config('path.assets_path') }}/assets/layouts/layout/img/avatar.png" />


                        <span class="username username-hide-on-mobile"> 
                            <?php //echo Auth::guard('admins')->user()->name; ?> 
                            Welcome! Admin
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    @php
                       $iipars_admin_id= Session::has('iipars_admin_id')?Session::get('iipars_admin_id'):1;
                    @endphp
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="{{ url(config('path.iipars_admin_base_url') . '/index.php/profile/profile_view/'.$iipars_admin_id) }}"
                                class="page-unload-prevent">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <?php /*<li>
                                                            <a href="app_calendar.html">
                                                                <i class="icon-calendar"></i> My Calendar </a>
                                                        </li>
                                                        <li>
                                                            <a href="app_inbox.html">
                                                                <i class="icon-envelope-open"></i> My Inbox
                                                                <span class="badge badge-danger"> 3 </span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="app_todo.html">
                                                                <i class="icon-rocket"></i> My Tasks
                                                                <span class="badge badge-success"> 7 </span>
                                                            </a>
                                                        </li>*/
                        ?>
                        <li class="divider"> </li>
                        <?php /*<li>
                                                            <a href="page_user_lock_1.html">
                                                                <i class="icon-lock"></i> Lock Screen </a>
                                                        </li>*/
                        ?>
                        <li>
                            <a href="{{ url(config('constants.admin_prefix') . '/logout') }}"
                                class="page-unload-prevent">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
                <!-- END USER LOGIN DROPDOWN -->
                <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                <?php /*<li class="dropdown dropdown-quick-sidebar-toggler">
                                            <a href="javascript:;" class="dropdown-toggle">
                                                <i class="icon-logout"></i>
                                            </a>
                                        </li>*/
                ?>
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<?php
//echo Auth::guard('admins')->user()->user_id;die;
if (Auth::guard('admins')->user()->user_id) {
    $get_page = basename($_SERVER['PHP_SELF']);
    if ($get_page != 'logout') {
        $userlastpage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
        setcookie('hotkiwidates_page_url', $userlastpage, time() + 3600 * 3);
        setcookie('hotkiwidates_user_id', Auth::guard('admins')->user()->user_id, time() + 3600 * 3);
    }
}

?>
