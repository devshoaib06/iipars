@extends('admin.layouts.app')

@section('page_title')
    {{trans('common.page_title.dashboard')}}
@endsection

@section('page_level_plugins_css')
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/datatables.css" rel="stylesheet" type="text/css" />
<link href="{{config('path.assets_path')}}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_level_css')
@endsection



@section('content') 
    
    <!-- BEGIN CONTAINER -->        
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
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
                @include('admin.partials.sidebarMenu')
                <!-- END SIDEBAR MENU -->
                <!-- END SIDEBAR MENU -->
            </div>
            <!-- END SIDEBAR -->
        </div>
        <!-- END SIDEBAR -->


        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN THEME PANEL -->
                @include('admin.partials.theme')                    
                <!-- END THEME PANEL -->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <!--<ul class="page-breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <a href="#">Tables</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>Datatables</span>
                        </li>
                    </ul>
                    <div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu pull-right" role="menu">
                                <li>
                                    <a href="#">
                                        <i class="icon-bell"></i> Action</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-shield"></i> Another action</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-user"></i> Something else here</a>
                                </li>
                                <li class="divider"> </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-bag"></i> Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>-->
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title"> <?php /* Managed Countries 
					<small>blank page layout</small>*/ ?>
				</h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->
                <!--<div class="m-heading-1 border-green m-bordered">
                    <h3>DataTables jQuery Plugin</h3>
                    <p> DataTables is a plug-in for the jQuery Javascript library. It is a highly flexible tool, based upon the foundations of progressive enhancement, and will add advanced interaction controls to any HTML table. </p>
                    <p> For more info please check out
                        <a class="btn red btn-outline" href="http://datatables.net/" target="_blank">the official documentation</a>
                    </p>
                </div>-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-dark">
                                    <i class="icon-settings font-dark"></i>
                                    <span class="caption-subject bold uppercase"> User Type <?php if(isset($user_type) && !empty($user_type)) echo "(".count($user_type).")"; ?></span>
                                </div>
                                <!--<div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm active">
                                            <input type="radio" name="options" class="toggle" id="option1">Actions</label>
                                        <label class="btn btn-transparent dark btn-outline btn-circle btn-sm">
                                            <input type="radio" name="options" class="toggle" id="option2">Settings</label>
                                    </div>
                                </div>-->
                            </div>
                            <div class="portlet-body">
                                <div class="table-toolbar">
                                    <div class="row">
                                        <div class="col-md-6">
                                            
                                            <div class="btn-group">
                                                <a href="{{ url(config("constants.admin_prefix").'/user-type/add') }}"><button id="sample_editable_1_new" class="btn sbold green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button></a>
                                            </div>
                                        
                                        </div>
                                        <!--div class="col-md-6">
                                            <div class="btn-group pull-right">
                                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">Tools
                                                    <i class="fa fa-angle-down"></i>
                                                </button>
                                                <ul class="dropdown-menu pull-right">
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-print"></i> Print </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-pdf-o"></i> Save as PDF </a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;">
                                                            <i class="fa fa-file-excel-o"></i> Export to Excel </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div-->
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                            <th> User Type </th>
                                                                                                                              
                                            <th> Updated Date </th>
                                            <th> Status </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($user_type))
                                        {
                                            foreach($user_type as $v)
                                            {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkboxes" value="{{ $v->cms_id }}" /></td>
                                                <td><?php echo $v->name; ?></td>
                                                
                                                <td> {{ App\library\myFunctions::dateText($v->updated_at,'m_d_y') }} </td>
                                                <td>
                                                    @if ($v->status == '1')
                                                    <span class="label label-sm label-success"> Active </span>
                                                    @elseif ($v->status == '0')
                                                    <span class="label label-sm label-warning"> InActive </span>                                                
                                                    @endif
                                                </td>
                                                <td>  
                                                 
                                                 <a  href="{{ url(config("constants.admin_prefix").'/user-type/edit') }}/{{ $v->id }}" data-toggle="tooltip" class="btn btn-default btn-sm"><i class="fa fa-edit "></i>Edit</a>
                                                
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        } 
                                        ?>                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>
                </div>

            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
        <!-- END CONTENT -->
        <!-- BEGIN QUICK SIDEBAR -->            
        @include('admin.partials.quickSidebar')
        <!-- END QUICK SIDEBAR -->
    </div>      
    <!-- END CONTAINER -->

@endsection


@section('page_level_plugins')
<script src="{!! asset('public/assets/global/scripts/datatable.js') !!}" type="text/javascript"></script>
<script src="{!! asset('public/assets/global/plugins/datatables/datatables.min.js') !!}" type="text/javascript"></script>
<script src="{!! asset('public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') !!}" type="text/javascript"></script>
@endsection



@section('page_level_scripts')


    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script type="text/javascript">

    var TableDatatablesManaged = function () {

    var initTable1 = function () {

    var table = $('#sample_1');
            // begin first table
            table.dataTable({

            // Internationalisation. For more info refer to http://datatables.net/manual/i18n
            "language": {
            "aria": {
            "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
            },
                    "emptyTable": "No data available in table",
                    "info": "Showing _START_ to _END_ of _TOTAL_ records",
                    "infoEmpty": "No records found",
                    "infoFiltered": "(filtered1 from _MAX_ total records)",
                    "lengthMenu": "Show _MENU_",
                    "search": "Search:",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                    "previous":"Prev",
                            "next": "Next",
                            "last": "Last",
                            "first": "First"
                    }
            },
                    // Or you can use remote translation file
                    //"language": {
                    //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
                    //},

                    // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
                    // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
                    // So when dropdowns used the scrollable div should be removed. 
                    //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

                    "bStateSave": true, // save datatable state(pagination, sort, etc) in cookie.

                    "columnDefs": [ {
                    "targets": 0,
                            "orderable": false,
                            "searchable": false
                    }],
                    "lengthMenu": [
                            [5, 15, 20, - 1],
                            [5, 15, 20, "All"] // change per page values here
                    ],
                    // set the initial value
                    "pageLength": 5,
                    "pagingType": "bootstrap_full_number",
                    "columnDefs": [{  // set default column settings
                    'orderable': false,
                            'targets': [0, 4]
                    }, {
                    "searchable": false,
                            "targets": [0, 4]
                    }],
                    "order": [
                            [1, "asc"]
                    ] // set first column as a default sort by asc
            });
            var tableWrapper = jQuery('#sample_1_wrapper');
            table.find('.group-checkable').change(function () {
    var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
    if (checked) {
    $(this).prop("checked", true);
            $(this).parents('tr').addClass("active");
    } else {
    $(this).prop("checked", false);
            $(this).parents('tr').removeClass("active");
    }
    });
            jQuery.uniform.update(set);
    });
            table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
            });
    }


    return {

    //main function to initiate the module
    init: function () {
    if (!jQuery().dataTable) {
    return;
    }

    initTable1();
    }

    };
    }();
    if (App.isAngularJsApp() === false) {
jQuery(document).ready(function() {
TableDatatablesManaged.init();
});
}
    </script>   

    <!-- END PAGE LEVEL SCRIPTS -->
@endsection