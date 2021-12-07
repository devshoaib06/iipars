<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User;

use App\EmailTemplates;
use App\CmsMasters;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;
use App\FloaterSignUpMaster;
//use Input;
use Mail;
use File;

use Str;

class SettingsController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }

    /* Start State */

    private $form_rules_state = [
        'code' => 'required',
        'name' => 'required',        
        'status' => 'required',
    ];

    public function stateList() {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'state-list';

            
            
            return view('admin.settings.state.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxStateList(Request $request) {
        $myFunctions = new \App\library\myFunctions;
        //$lang = \App::getLocale();
        //$country_master = new Country();
        if ($request->ajax()) {
            $state = $request->input('state');
            $code = $request->input('code');
            
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['states.status', '<>', '3'];

            if ($state != '') {
                $arrSearch[] = ['states.name', 'like', '%' . $state . '%'];
            }
            if ($code != '') {
                $arrSearch[] = ['states.code', 'like', '%' . $code . '%'];
            }
            
            if ($date_from != '') {
                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m . ' 00:0:00';
                $arrSearch[] = ['states.updated_at', '>=', $date_from];
            }
            if ($date_to != '') {
                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m . ' 23:59:59';
                $arrSearch[] = ['states.updated_at', '<=', $date_to];
            }
            if ($status != '') {
                $arrSearch[] = ['states.status', $status];
            }




            $jobs = DB::table('states')->select('name', 'code',  'states.updated_at', 'states.status', 'states.id')
                    
                    ->where($arrSearch);

            $jobs = $jobs->get();
            $iTotalRecords = count($jobs);
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);
            $records = array();
            $records["data"] = array();
            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;
            $order = $request->input('order');
            $column = array('#', 'states.name', 'states.code',  'states.updated_at', 'states.status', 'action');
            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[0];
            }
            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }




            $jobs_1 = DB::table('states')->select('name', 'code',  'states.updated_at', 'states.status', 'states.id')
                   
                    ->where($arrSearch);




            $jobs_1 = $jobs_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();

            //->toSql();
            //dd($jobs);
            //die;
            $count = $iDisplayStart;
            foreach ($jobs_1 as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } elseif ($t->status == '0') {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
                ++$count;
                $records["data"][] = array(
                    $count,
                    $t->name,
                    $t->code,
                    
                    $myFunctions->dateText($t->updated_at, 'm_d_y'),
                    $status,
                    '<a href="' . url(config("constants.admin_prefix") . '/edit-state') . '/' . \Hasher::encode($t->id) . '" data-toggle="tooltip" class="btn btn-default btn-sm"><i class="fa fa-edit"></i> Edit </a>'
                );
            }
            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            echo json_encode($records);
        }
    }

    public function addState() {
        $lang = \App::getLocale();
       
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'state-list';

            

            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/add-state';
            return view('admin.settings.state.addedit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function formatDataState(Request $request, $id = NULL) {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
        if ($id != NULL) {
            $t_data = \App\State::where([
                        ['name', $request->input('name')],                        
                        ['id', '<>', $id]])->get();
        } else {
            $t_data = \App\State::where([['name', $request->input('name')]])->get();
        }
                                                                                                                                                           

        if (count($t_data)) {
            $data = array();
        } else {
            $data = [
                'code' => $request->input('code'),
                'name' => $request->input('name'),                
                'status' => $request->input('status'),
            ];
        }

        return $data;
    }

    public function addStateAction(Request $request) {

        $this->validate($request, $this->form_rules_state);
        $data = $this->formatDataState($request);


        if (count($data)) {
            $State = \App\State::create($data);
            //$insertedId = $State->location_id;
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'New State added successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/state-list');
    }

    public function editState($id) {
        $lang = \App::getLocale();
        
        if (Auth::guard('admins')->check()) {
            $data_msg = array();
            $data_msg["lang"] = $lang;
            
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'state-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/edit-state/' . \Hasher::encode($id);

            $state_details = \App\State::find($id);
            $data_msg['state_details'] = $state_details;
            return view('admin.settings.state.addedit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editStateAction(Request $request, $id) {

        $this->validate($request, $this->form_rules_state);
        $data = $this->formatDataState($request, $id);
        if (count($data)) {
            $states = \App\State::find($id);
            $states->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'State updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/edit-state/' . \Hasher::encode($id)); 
    }

    /* End State */  
    

    /* Start Setting */  

    public function general() {
        $lang = \App::getLocale();
        $data_msg = array();
        $data_msg['lang'] = $lang;
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'gnrl';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/setting';

            $setting = \App\Settings::where([['status', '1'],])->orderBy('display_order', 'asc')->get();
            $data_msg['setting'] = $setting;
			
			
			
            	return view('admin.settings.general.addedit', $data_msg);
			
			
			
        } else {
            //return redirect()->intended('admin/login');
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function generalAction(Request $request) {
        //$lang = \App::getLocale();

        $setting = \App\Settings::where([['status', '1'],])->get();

        foreach ($setting as $v) {

            $data = [
                'content' => $request->input($v->setting_id),
            ];
            \App\Settings::find($v->id)->update($data);
        }


        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Setting updated successfully'); //trans('categories.insert_message')       
        return redirect(config("constants.admin_prefix") . '/setting');
    }

    /* End Setting */  
    public function paymentGateway() {
        $lang = \App::getLocale();
        $data_msg = array();
        $data_msg['lang'] = $lang;
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'pgnrl';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/payment-setting';

            $setting = \App\PaymentGatewaySettings::where([['status', '1'],])->orderBy('display_order', 'asc')->get();
            $data_msg['setting'] = $setting;
			$data_msg['except_setting']=[21];
			
			
            	return view('admin.settings.payment_gateway.addedit', $data_msg);
			
			
			
        } else {
            //return redirect()->intended('admin/login');
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function paymentGatewayAction(Request $request) {
        //$lang = \App::getLocale();
        //return $request;
        $setting = \App\PaymentGatewaySettings::where([['status', '1'],])->get();

        foreach ($setting as $v) {

            $data = [
                'content' => $request->input($v->setting_id),
            ];
            \App\PaymentGatewaySettings::find($v->id)->update($data);
        }


        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Setting updated successfully'); //trans('categories.insert_message')       
        return redirect(config("constants.admin_prefix") . '/payment-setting');
    }

    /* End Setting */  

    /* Start User Type */   

    private $form_rules_user_type = [
        'user_type_name' => 'required',
        'status' => 'required',
    ];

    public function userTypeList() {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'user-type-list';

            $list = UserType::where('status', '<>', '3')
                            ->orderBy('user_type_name', 'desc')->get();
            $data_msg["userTypeList"] = $list;



            return view('admin.settings.userType.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addUserType() {

        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'user-type-list';

            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/add-user-type';
            return view('admin.settings.userType.addedit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function formatDataUserType(Request $request, $id = NULL) {

        if ($id != NULL) {
            $t_data = UserType::where([
                        ['user_type_name', $request->input('user_type_name')],
                        ['user_type_id', '<>', $id]])->get();
        } else {
            $t_data = UserType::where([['user_type_name', $request->input('user_type_name')],
                    ])->get();
        }


        if (count($t_data)) {
            $data = array();
        } else {
            $data = [
                'user_type_name' => $request->input('user_type_name'),
                'status' => $request->input('status'),
            ];
        }

        return $data;
    }

    public function addUserTypeAction(Request $request) {

        $this->validate($request, $this->form_rules_user_type);
        $data = $this->formatDataUserType($request);


        if (count($data)) {
            UserType::create($data);

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'User Type added successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('user_type_name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/user-type-list');
    }

    public function editUserType($id) {


        if (Auth::guard('admins')->check()) {
            $data_msg = array();


            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'user-type-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/edit-user-type/' . $id;

            $user_type_details = UserType::find($id);
            $data_msg['user_type_details'] = $user_type_details;

            return view('admin.settings.userType.addedit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editUserTypeAction(Request $request, $id) {

        $this->validate($request, $this->form_rules_user_type);
        $data = $this->formatDataUserType($request, $id);
        if (count($data)) {
            $master = UserType::find($id);
            $master->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'User Type updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('user_type_name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/edit-user-type/' . $id);
    }

    private $form_rules_stage = [
        'stage_name' => 'required',
        'status' => 'required',
    ];

    /* End User Type */

    /* Start CMS */

    public function listCms() {
        if (Auth::guard('admins')->check()) {


            $CmsMasters = CmsMasters::where('status', '<>', '3')
                    ->orderBy('heading', 'desc')
                    ->get();

            $menu_parent = 'settings';
            $menu_child = 'cms';
			
			
			//dd($CmsMasters);

            	return view('admin.settings.cms.list', compact('CmsMasters', 'menu_parent', 'menu_child'));
			
				
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function addCms() {

        if (Auth::guard('admins')->check()) {


            $menu_parent = 'settings';
            $menu_child = 'cms';
            $form_url = url(config("constants.admin_prefix")) . '/cms/add';
			

            	return view('admin.settings.cms.addedit', compact('menu_parent', 'menu_child', 'form_url'));
			
			
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function addCmsAction(Request $request) {
        $this->validate($request, [
            'url' => 'required',
            'heading' => 'required',
        ]);

        $CmsMasters = new CmsMasters();
        $CmsMasters->url =Str::slug($request->input('url'));// trim($request->url);
        $CmsMasters->heading = trim($request->heading);
        $CmsMasters->description = trim($request->description);
        $CmsMasters->meta_title = trim($request->meta_title);
        $CmsMasters->meta_keyword = trim($request->meta_keyword);
        $CmsMasters->meta_robots = trim($request->meta_robots);
        $CmsMasters->meta_description = trim($request->meta_description);
        $CmsMasters->status = trim($request->status);


        $ck = DB::table('cms_masters')
                        ->where('url', '=', $request->input('url'))
                        ->get()->first();


        if (empty($ck)) {
            $CmsMasters->save();
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'New CMS Page added successfully, Thankyou!'); //trans('categories.insert_message')
            //return redirect()->intended('admin/login');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! this page already exist, Try Another');
        }

        return back();
    }

    public function editCms($id) {

        //echo $id;die;
        if (Auth::guard('admins')->check()) {

            $CmsMasters = CmsMasters::find($id);

            $menu_parent = 'settings';
            $menu_child = 'cms';
            $form_url = url(config("constants.admin_prefix")) . '/cms/edit/' . \Hasher::encode($id);
			
            return view('admin.settings.cms.addedit', ['CmsMasters' => $CmsMasters, 'menu_parent' => $menu_parent, 'menu_child' => $menu_child, 'form_url' => $form_url]);
			
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function editCmsAction(Request $request, $id) {
        $this->validate($request, [
            'url' => 'required',
            'heading' => 'required',
        ]);


        $data = [
            'url' => Str::slug($request->input('url')),
            'heading' => $request->input('heading'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'meta_title' => $request->input('meta_title'),
            'meta_keyword' => $request->input('meta_keyword'),
            'meta_robots' => $request->input('meta_robots'),
            'meta_description' => $request->input('meta_description'),
        ];


        $allName = CmsMasters::where('cms_id', '!=', $id)->get()->pluck('url')->toArray();

        $current_name = trim($request->input('url'));

        if (in_array($current_name, $allName)) {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('url') . ' exist');
        } else {
            $CmsMasters = \App\CmsMasters::find($id);
            $CmsMasters->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'CMS Page updated successfully'); //trans('categories.insert_message')
        }

        return back();
    }


    /* End CMS */

    /* Start Email Template */

    public function emailTemplatesList() {
        if (Auth::guard('admins')->check())
        {
            $template = EmailTemplates::where('status', '<>', '3')
                    ->orderBy('subject', 'desc')
                    ->get();
            $menu_parent = 'settings';
            $menu_child = 'eml_tmpl';
            return view('admin.settings.emailTemplate.list', compact('template', 'menu_parent', 'menu_child'));
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function emailTemplatesEdit($rid)
    {
        if (Auth::guard('admins')->check()) {
            $data_msg = array();

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'eml_tmpl';
            
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/email-template/edit/' . $rid;

            $cms = EmailTemplates::find($rid);
            $data_msg['tmpl'] = $cms;
			
			return view('admin.settings.emailTemplate.addedit', $data_msg);
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function emailTemplatesEditAction(Request $request, $rid)
    {
        $this->validate($request, [
            'subject' => 'required|max:200',
            'content' => 'required',
        ]);

        $data = [
            'subject' => $request->input('subject'),
            'content' => $request->input('content')
        ];

        $cms = EmailTemplates::find($rid);

        $cms->update($data);

        \Session::flash('messageClass', 'alert alert-success');
        \Session::flash('message', 'Email Template updated successfully');
        //return redirect()->route('admin.workcategory.edit', [$id]);

        return redirect(config("constants.admin_prefix").'/email-template/edit/' . $rid);
    }

    /* End Email Template */


    /* Start Category */

    private $form_rules_category = [
        'name' => 'required',
    ];

    public function listCategory() {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

        $data_msg['menu_parent'] = 'settings';
        $data_msg['menu_child'] = 'category-list';

        $data_msg["masterList"] = \App\Category::orderBy('updated_at', 'desc')->get();
        return view('admin.settings.category.list', $data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addCategory()
    {
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'category-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/add-category';
            return view('admin.settings.category.addedit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function formatDataCategory(Request $request, $id = NULL)
    {
        if ($id != NULL) {
            $t_data = \App\Category::where([
                        ['name', $request->input('name')],
                        ['category_id', '<>', $id]])->get();
        } else {
            $t_data = \App\Category::where([['name', $request->input('name')],
                    ])->get();
        }
        if (count($t_data)) {
            $data = array();
        } else {
            $data = [
                'parent_id' => $request->input('parent_id'),
                'name' => $request->input('name'),
                'is_active' => $request->input('status'),
            ];
        }

        return $data;
    }

    public function addCategoryAction(Request $request)
    {
        $this->validate($request, $this->form_rules_category);
        $data = $this->formatDataCategory($request);

        if (count($data)) {
            \App\Category::create($data);

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Added successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/category-list');
    }

    public function editCategory($id)
    {
        if (Auth::guard('admins')->check()) {
            $data_msg = array();
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'category-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/edit-category/' . \Hasher::encode($id);

            $data_msg['master_details'] = \App\Category::find($id);
            return view('admin.settings.category.addedit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editCategoryAction(Request $request, $id)
    {
        $this->validate($request, $this->form_rules_category);
        $data = $this->formatDataCategory($request, $id);
        if (count($data)) {
            $master = \App\Category::find($id);
            $master->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/edit-category/' . \Hasher::encode($id));
    }

    /* End Category  */



    /*     * ***************************** UESR TYPE ****************************** */

    public function user_type_list() {
        if (Auth::guard('admins')->check()) {

            $user_type = Usertype::where('status', '<>', '3')
                    ->orderBy('name', 'desc')
                    ->get();

            $menu_parent = 'settings';
            $menu_child = 'user-type';

            return view('admin.settings.user_type.list', compact('user_type', 'menu_parent', 'menu_child'));
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function add_user_type() {
        if (Auth::guard('admins')->check()) {

            $menu_parent = 'settings';
            $menu_child = 'user-type';

            $form_url = url(config("constants.admin_prefix")) . '/user-type/add';

            return view('admin.settings.user_type.addedit', compact('menu_parent', 'menu_child', 'form_url'));
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function save_user_type(Request $request) {
        $this->validate($request, [
            'name' => 'required|unique:user_types,name',
                ], [
            'name.required' => 'Please enter user type name',
            'name.unique' => 'User type should be unique,' . $request->input('name') . ' - already exist',
        ]);

        $data = [
            'name' => trim($request->input('name')),
            'status' => trim($request->input('status'))
        ];

        $ins = Usertype::create($data);

        //dd($ins);

        if (!empty($ins)) {
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'New User Type Saved successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Something went wrong!!');
        }



        return back();
    }

    public function edit_user_type($id) {
        if (Auth::guard('admins')->check()) {

            $menu_parent = 'settings';
            $menu_child = 'user-type';

            $user_type = Usertype::find($id);

            $form_url = url(config("constants.admin_prefix")) . '/user-type/edit/' . $id;

            return view('admin.settings.user_type.addedit', compact('user_type', 'menu_parent', 'menu_child', 'form_url'));
        } else {
            return redirect()->intended('admin/login');
        }
    }

    public function save_edit_user_type(Request $request, $id) {
        $this->validate($request, [
            'name' => 'required|unique:user_types,name,' . $id,
                ], [
            'name.required' => 'Please enter user type name',
            'name.unique' => 'User type should be unique,' . $request->input('name') . ' - already exist',
        ]);

        $data = [
            'name' => trim($request->input('name')),
            'status' => trim($request->input('status'))
        ];

        $user_type_update = Usertype::find($id);


        //dd($ins);

        if ($user_type_update->update($data)) {
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'New User Type Updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Something went wrong!!');
        }



        return back();
    }

    private $form_rules_testimonial = [
        'description' => 'required',
        'status' => 'required',
        'ordering' => 'required',
        'name' => 'required'
    ];

    public function testimonialList() {//die;
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'testimonial-list';

            $list = Testimonial::where('status', '<>', '3')
                            ->orderBy('ordering', 'ASC')->get();
            $data_msg["testimonialList"] = $list;

			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'testimonial-view');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.settings.testimonial.list', $data_msg);
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addTestimonial() {

        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'testimonial-list';

            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/add-testimonial';
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'testimonial-add');
			if($permission || Auth::guard('admins')->user()->user_type == 1){
			
            	return view('admin.settings.testimonial.addedit', $data_msg);
			
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function formatDataTestimonial(Request $request, $id = NULL) {

        /* if ($id != NULL) {
          $t_data = Testimonial::where([
          ['testimonial_name', $request->input('testimonial_name')],
          ['id', '<>', $id]])->get();
          } else {
          $t_data = Testimonial::where([['testimonial_name', $request->input('testimonial_name')],
          ])->get();
          } */





        /* if (count($t_data)) {
          $data = array();
          } else { */
        $data = [
            'description' => $request->input('description'),
            'name' => $request->input('name'),
            'deg_com' => $request->input('deg_com'),
            'ordering' => $request->input('ordering'),
            'status' => $request->input('status'),
        ];

        $data['speaker_image'] = $request->input('prev_img');

        if ($request->hasFile('speaker_image')) {
            $profile_pic = $request->file('speaker_image');
            $myFunctions = new myFunctions;
            $size_path = array(
                array('size' => config('constants.speaker_image_thumb'), 'path' => config('path.absolute_path') . config('path.speaker_image_path') . 'thumb/'),
                array('size' => config('constants.speaker_image_preview'), 'path' => config('path.absolute_path') . config('path.speaker_image_path') . 'preview/')
            );
            $profile_image_name = $myFunctions->resize($profile_pic, $size_path);
            $myFunctions->upload_file($profile_pic, config('path.absolute_path') . config('path.speaker_image_path') . 'original/', $profile_image_name);
            $data['speaker_image'] = $profile_image_name;
        }


        //print_r($data);die;  
        //}

        return $data;
    }

    public function addTestimonialAction(Request $request) {

        $this->validate($request, $this->form_rules_testimonial);
        $data = $this->formatDataTestimonial($request);


        if (count($data)) {
            Testimonial::create($data);

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Testimonial added successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('testimonial_name') . ' exist');
        }
        //return redirect(config("constants.admin_prefix") . '/testimonial-list');
        return back();
    }

    public function editTestimonial($id) {


        if (Auth::guard('admins')->check()) {
            $data_msg = array();


            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'testimonial-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/edit-testimonial/' . $id;

            $testimonial_details = Testimonial::find($id);


            $data_msg['testimonial_details'] = $testimonial_details;
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'testimonial-edit');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.settings.testimonial.addedit', $data_msg);
			
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editTestimonialAction(Request $request, $id) {

        $this->validate($request, $this->form_rules_testimonial);
        $data = $this->formatDataTestimonial($request, $id);
        if (count($data)) {
            $master = Testimonial::find($id);
            $master->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Testimonial updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('testimonial_name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/edit-testimonial/' . $id);
    }

    public function editorImageUpload(Request $request) {

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES) && !empty($_FILES)) {

            $image_name = $_FILES['upload']['name'];
            $expArr = explode('.', $image_name);

            if (!empty($expArr)) {

                $ext = end($expArr);
                if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'gif') {

                    $new_imgname = time() . rand(123456, 999999) . "." . $ext;
                    $upload_path = "public/uploads/editor_uploads/" . $new_imgname;
                    move_uploaded_file($_FILES['upload']['tmp_name'], $upload_path) or die('error');
                    $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                    echo "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$upload_path', '')</script>";
                } else {

                    echo "<span style='color : RED;'><small>Select only images (jpg/png/gif)</small></span>";
                }
            } else {

                echo "<span style='color : RED;'>ERROR</span>";
            }
        }
    }


    

    


    

    

    

    
    

    

    /* Start Timezone */

    private $form_rules_timezone = [
        'timezone_id' => 'required',
        'name' => 'required',
        'dis_order' => 'required',
        'status' => 'required',
    ];

    public function timezoneList() {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'timezone-list';


            $data_msg["timezoneList"] = Timezone::where('status', '<>', '3')
                            ->orderBy('updated_at', 'asc')->get();
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'timezone-view');
			if($permission || Auth::guard('admins')->user()->user_type == 1){
			
            	return view('admin.settings.timezone.list', $data_msg);
			
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function viewTimezone($id) {


        if (Auth::guard('admins')->check()) {
            $data_msg = array();


            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'timezone-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/view-timezone/' . $id;


            $data_msg['timezone_master_details'] = Timezone::find($id);

            return view('admin.settings.timezone.view', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    /* End Timezone */
	
	
	/* Start Role  */
    
    private $form_rules_role = [
        'topic_id' => 'required',
        'name' => 'required',
        'slag' => 'required',
        'status' => 'required',
    ];

    public function listRole() {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'role-list';


            $data_msg["masterList"] = Role::where('status', '<>', '3')
                            ->orderBy('updated_at', 'desc')->get();
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'role-view');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.settings.role.list', $data_msg);
			
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addRole() {

        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'role-list';
			
			
			$allRoleTopics = RoleTopic::where('status', '<>', '3')->orderBy('name', 'asc')->get()->toArray();
            $data_msg["allRoleTopics"] = $allRoleTopics;
			
			
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/add-role';
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'role-add');
			if($permission || Auth::guard('admins')->user()->user_type == 1){
			
            	return view('admin.settings.role.addedit', $data_msg);
			
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function formatDataRole(Request $request, $id = NULL) {

        if ($id != NULL) {
            $t_data = Role::where([
                        ['topic_id', $request->input('topic_id')],
                        ['name', $request->input('name')],
                        ['slag', $request->input('slag')],
                        ['id', '<>', $id]])->get();
        } else {
            $t_data = Role::where([['name', $request->input('name')],
                    ])->get();
        }



        if (count($t_data)) {
            $data = array();
        } else {
            $data = [
                'topic_id' => $request->input('topic_id'),
                'name' => $request->input('name'),
                'slag' => $request->input('slag'),
                'status' => $request->input('status'),
            ];
        }

        return $data;
    }

    public function addRoleAction(Request $request) {

        $this->validate($request, $this->form_rules_role);
        $data = $this->formatDataRole($request);


        if (count($data)) {
            Role::create($data);
			
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Added successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/role-list');
    }

    public function editRole($id) {


        if (Auth::guard('admins')->check()) {
            $data_msg = array();


            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'role-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/edit-role/' . $id;


            $data_msg['master_details'] = Role::find($id);
			
			$allRoleTopics = RoleTopic::where('status', '<>', '3')->orderBy('name', 'asc')->get()->toArray();
            $data_msg["allRoleTopics"] = $allRoleTopics;
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'role-edit');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.settings.role.addedit', $data_msg);
			
			}else{
				return view('admin.no-permission', $data_msg);
			}
			
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editRoleAction(Request $request, $id) {

        $this->validate($request, $this->form_rules_role);
		//print_r($request->all());
		//die;
		
        $data = $this->formatDataRole($request, $id);
        if (count($data)) {
            $master = Role::find($id);
            $master->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('slag') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/edit-role/' . $id);
    }
    
    /* End Role  */
	
	
	/* Start Role Topic */
    
    private $form_rules_role_topic = [
        'name' => 'required',
        'status' => 'required',
    ];

    public function listRoleTopic() {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {

            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'role-topic-list';


            $data_msg["masterList"] = RoleTopic::where('status', '<>', '3')
                            ->orderBy('updated_at', 'desc')->get();
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'roletopic-view');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.settings.roleTopic.list', $data_msg);
				
			}else{
				return view('admin.no-permission', $data_msg);
			}	
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addRoleTopic() {

        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'role-topic-list';

            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/add-role-topic';
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'roletopic-add');
			if($permission || Auth::guard('admins')->user()->user_type == 1){
			
            	return view('admin.settings.roleTopic.addedit', $data_msg);
				
			}else{
				return view('admin.no-permission', $data_msg);
			}	
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function formatDataRoleTopic(Request $request, $id = NULL) {

        if ($id != NULL) {
            $t_data = RoleTopic::where([
                        ['name', $request->input('name')],
                        ['id', '<>', $id]])->get();
        } else {
            $t_data = RoleTopic::where([['name', $request->input('name')],
                    ])->get();
        }



        if (count($t_data)) {
            $data = array();
        } else {
            $data = [
                'name' => $request->input('name'),
                'status' => $request->input('status'),
            ];
        }

        return $data;
    }

    public function addRoleTopicAction(Request $request) {

        $this->validate($request, $this->form_rules_role_topic);
        $data = $this->formatDataRoleTopic($request);


        if (count($data)) {
            RoleTopic::create($data);

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Added successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/role-topic-list');
    }

    public function editRoleTopic($id) {


        if (Auth::guard('admins')->check()) {
            $data_msg = array();


            $data_msg['menu_parent'] = 'settings';
            $data_msg['menu_child'] = 'role-topic-list';
            $data_msg['form_url'] = url(config("constants.admin_prefix")) . '/edit-role-topic/' . $id;


            $data_msg['master_details'] = RoleTopic::find($id);
			
			$permission = getUserRolePermission(Auth::guard('admins')->user()->id,'roletopic-edit');
			if($permission || Auth::guard('admins')->user()->user_type == 1){

            	return view('admin.settings.roleTopic.addedit', $data_msg);
				
			}else{
				return view('admin.no-permission', $data_msg);
			}	
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editRoleTopicAction(Request $request, $id) {

        $this->validate($request, $this->form_rules_role_topic);
        $data = $this->formatDataRoleTopic($request, $id);
        if (count($data)) {
            $master = RoleTopic::find($id);
            $master->update($data);
            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Updated successfully');
        } else {
            \Session::flash('messageClass', 'alert alert-danger');
            \Session::flash('message', 'Sorry !!! ' . $request->input('name') . ' exist');
        }
        return redirect(config("constants.admin_prefix") . '/edit-role-topic/' . $id);
    }
    
    /* End Role Topic  */

    public function manageFloaterSignUp(Request $request) {
        $data_msg = array();
       // $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('updated_at', 'desc')->get();

        if (Auth::guard('admins')->check()) {
            try{
            $data_msg['menu_parent'] = 'setting';
            $data_msg['menu_child'] = 'floater-sign';
            $banner = FloaterSignUpMaster::find(1);
            $data_msg['banner'] = $banner;

            if ($request->method() === "POST") {

                //return $request;
               
                
                $banner->title =  $request->input('title');
                $banner->description =  $request->input('notidescription');
                $banner->time = $request->input('time');
                $banner->status = $request->input('status');
                
               
                $banner->save();
               
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Banner saved successfully ');
                    
                return redirect()->intended(route('showFloaterSignUp'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Updated successfully ');
            }
            	   return view('admin.settings.floater_signup.create', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage());
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function resellerCommission(Request $request) {
        $data_msg = array();
       // $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('updated_at', 'desc')->get();

        if (Auth::guard('admins')->check()) {
            try{
            $data_msg['menu_parent'] = 'setting';
            $data_msg['menu_child'] = 'reseller-commission';
            $data_msg['slabs']=\App\ResellerCommissionMaster::all();
            if ($request->method() === "POST") {
                \App\ResellerCommissionMaster::whereNotNull('id')->delete();

                $lower_bounds =  $request->input('lower_bound');
                
                for($i=0;$i<count($lower_bounds);$i++ ){
                    $slab=new \App\ResellerCommissionMaster();
                    
                    $slab->lower_bound =  $request->input('lower_bound');
                    $slab->upper_bound = $request->input('upper_bound');
                    $slab->commission = $request->input('commission');
                    
                    $slab->save();
                }
               
               
              
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Banner saved successfully ');
                    
                return redirect()->intended(route('showResellerCommission'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Updated successfully ');
            }
            	   return view('admin.settings.reseller_commission._form', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage());
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function nextSlabRow(Request $request)
    {
        $data_msg=[];
        $data_msg['slab']=\App\ResellerCommissionMaster::orderBy('id','desc')->first();
        $data_msg['count']=$request->noofrows+1;

        $returnHTML = view('admin.settings.reseller_commission._addnewslab',$data_msg)->render();// or method that you prefere to return data + RENDER is the key here
            //return $returnHTML;
            return response()->json( array('success' => true, 'html'=>$returnHTML) );
    }

    public function ajaxsaveRcSlab(Request $request)
    {
        $slab=new \App\ResellerCommissionMaster();
                    
        $slab->lower_bound =  $request->input('lower_bound');
        $slab->upper_bound = $request->input('upper_bound');
        $slab->commission = $request->input('commission');
        
        $slab->save();

        $request->session()->flash('messageClass', 'alert alert-success');
        $request->session()->flash('message', 'Saved successfully ');
            
        return redirect()->intended(route('showResellerCommission'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Saved successfully ');

    }

    public function ajaxupdateRcSlab(Request $request)
    {
        $id=$request->id;
        $slab= \App\ResellerCommissionMaster::find($id);
                    
        $slab->lower_bound =  $request->input('lower_bound');
        $slab->upper_bound = $request->input('upper_bound');
        $slab->commission = $request->input('commission');
        
        $slab->save();
        
        $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Banner saved successfully ');
                    
                return redirect()->intended(route('showResellerCommission'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Updated successfully ');
       // return response()->json( array('success' => true) );

    }
    public function deleteSlab(Request $request)
    {
        //return $request;
        $id=$request->id;
        $slab= \App\ResellerCommissionMaster::where('id',$id)->delete();
                    
        // return redirect()->intended(route('showResellerCommission'))->with('messageClass', 'alert alert-success')
        //                                 ->with('message', 'Deleted successfully ');
       return response()->json( array('success' => true,'msg'=> 'Deleted successfully ') );

    }
    
    
}
