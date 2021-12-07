<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\MaterialMaster;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserRole;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;

class MaterialController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }

    public function index() {


        if (Auth::guard('admins')->check()) {

            $data_msg = array();
            $data_msg['menu_parent'] = 'dashboard';
            $data_msg['menu_child'] = 'dashboard';
            $data_msg['users'] = '';


            $data_msg['result_date'] = array();

            $totalOwner = User::where('user_type_id', '=', '3')->get()->count();//->where('email_verified_at', '<>', null)
            $totalProvider = User::where('user_type_id', '=', '4')->get()->count();//->where('email_verified_at', '<>', null)



            $data_msg['totalOwner'] = $totalOwner;
            $data_msg['totalProvider'] = $totalProvider;
			




            return view('admin.dashboard', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function setLocalLang($locale) {

        if (is_null($locale)) {
            return redirect()->back();
        }

        Session::put('variableLocale', $locale);

        return redirect()->back();
    }

    

    //User    

    public function showMaterialList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'products';
            $menu_child = 'list_material';
			
            return view('admin.courses.material.list', compact('menu_parent', 'menu_child'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxMaterialList(Request $request) {

        if ($request->ajax()) {

            $material_name = $request->input('material_name');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['status', '<>', '3'];

            if ($material_name != '') {
                $arrSearch[] = ['material_name', 'like', '%' . $material_name . '%'];
            }

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;

                $arrSearch[] = ['created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['created_at', '<=', $date_to];
            }

          
            if ($status != '') {
                $arrSearch[] = ['status', $status];
            }

           /* if ($testimonial_type != '') {
                $arrSearch[] = ['testimonial_type', $testimonial_type];
            }*/
            $materials = DB::table('material_masters AS M')
                    ->select('M.id', 'M.material_name', 'M.created_at', 'M.status')
                    ->where($arrSearch)
                    ->where('M.is_show',1);

            //$coupons = $coupons->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $materials->count();
            //$iTotalRecords = 120;
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            
            $column = array('#', 'material_name', 'created_at', 'status', 'action');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[4];
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }

            $materials = $materials->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            
            foreach ($materials as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                
                              
                $records["data"][] = array(
                    $sl,
                    $t->material_name,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),                    
                    $status,
                    '<a href="' .route('editMaterial',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
                );

                $sl++;
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;


            echo json_encode($records);
        }
    }

    protected function validatorRegisterGeneral(array $data) {
        //dd($data);
        $validate = [
            'material_name' => 'required|max:255',
            'status' => 'required',
        ];

       /*if( $data['testimonial_type'] == 1 ) {
            $validate = [  
                'video_url' => 'required|is_url' 
            ];
        }

        if( $data['testimonial_type'] == 2 ) {
            $validate['testimonial_text'] = 'required';
        }*/

        return Validator::make($data, $validate);
    }

    public function createMaterials(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'add_materials';

            if ($request->method() === "POST") {
            //return  $request->ip();

                $material_name = $request->input('material_name');

                $status = $request->input('status');

                $data_material_details = array(					
                    'material_name' => $material_name,
                    'status' => $status
                );

               				
                $validator = $this->validatorRegisterGeneral($data_material_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(route('materials'))->withErrors($val)->withInput();
                }

				
				
				
				$user_id=MaterialMaster::create($data_material_details)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Materials successfully added');
                
                return redirect()->intended(route('materials'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Materials successfully added');
            }
			
            return view('admin.courses.material.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editMaterial(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $material = MaterialMaster::where('status','<>',3)->where(['id'=> $id])->first();
          
            
            $data_msg["material"] = $material;
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'list_material';
			
            return view('admin.courses.material.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editMaterialAction(Request $request, $id) {

        $data = $request->all();
        
        $validator = $this->validatorRegisterGeneral($data);
        
        if ($validator->fails()) {
            $val = $validator->errors();
            return redirect()->intended(config("constants.admin_prefix") . '/' . 'materials/edit/'.Hasher::encode($id))->withErrors($val)->withInput();
        }
        
         $material =  MaterialMaster::where('status','<>',3)->where(['id'=> $id])->first();



     
         $material->update($data);

       	
        return redirect()->intended(config("constants.admin_prefix") . '/materials')->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

}
