<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\Coupon;
//use App\ModulesAction;
use Hasher;
use App\RoleTopic;
use App\UserRole;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;

class CouponController extends Controller {

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

    public function showCouponList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'coupons';
            $menu_child = 'list_coupon';
			
            return view('admin.coupon.list', compact('menu_parent', 'menu_child'));
			if($permission || Auth::guard('admins')->user()->user_type == 1){

			
			}else{
				return view('admin.no-permission', $data_msg);
			}
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxCouponList(Request $request) {

        if ($request->ajax()) {

            $coupon_name = $request->input('coupon_name');
            $coupon_code = $request->input('coupon_code');
            $uses_per_student = $request->input('uses_per_student');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['status', '<>', '3'];

            if ($coupon_name != '') {
                $arrSearch[] = ['coupon_name', 'like', '%' . $coupon_name . '%'];
            }

            if ($coupon_code != '') {
                $arrSearch[] = ['coupon_code', 'like', '%' . $coupon_code . '%'];
            }

            if ($uses_per_student != '') {
                $arrSearch[] = ['uses_per_student', 'like', '%' . $uses_per_student . '%'];
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
            $coupons = DB::table('coupons AS C')
                    ->select('C.coupon_id', 'C.coupon_name', 'C.coupon_code', 'C.uses_per_student', 'C.created_at', 'C.status')
                    ->where($arrSearch);

            //$coupons = $coupons->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $coupons->count();
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
            
            $column = array('#', 'coupon_name', 'coupon_code', 'uses_per_student', 'created_at', 'status', 'action');


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

            $coupons = $coupons->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            
            foreach ($coupons as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                
                              
                $records["data"][] = array(
                    $sl,
                    $t->coupon_name,
                    $t->coupon_code,
                    $t->uses_per_student,
                    //\Carbon\Carbon::parse($t->created_at)->format('d/m/Y g:i A'),  
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),  
                    $status,
                    '<a href="' .route('editCoupon',['id'=>Hasher::encode($t->coupon_id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'coupon_name' => 'required|max:255',
            'discount_type' => 'required',
            'price' => 'required',
            'coupon_code' => 'required|max:255',
            'uses_per_student' => 'required|max:255', 
            'start_date' => 'required',
            'end_date' => 'required',           
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

    public function createCoupons(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'coupons';
            $data_msg['menu_child'] = 'add_coupons';

            if ($request->method() === "POST") {
            //return  $request->ip();

                $coupon_name = $request->input('coupon_name');
                $discount_type = $request->input('discount_type');
                $price = $request->input('price');
                $coupon_code = $request->input('coupon_code');
                $uses_per_student = $request->input('uses_per_student');
                $start_date = date('Y-m-d H:i:s',strtotime($request->input('start_date')));
                $end_date = date('Y-m-d H:i:s',strtotime($request->input('end_date')));
                //$testimonial_text = $request->input('testimonial_text');
               // $video_url = $request->input('video_url');

                $status = $request->input('status');

                $data_coupon_details = array(					
                    'coupon_name' => $coupon_name,
                    'discount_type' => $discount_type,
                    'price' => $price,
                    'coupon_code' => $coupon_code,
                    'uses_per_student' => $uses_per_student,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    //'testimonial_type' => $testimonial_type,
                    'status' => $status
                );

               /* if( $testimonial_type == 1 ) {
                    $data_video_details['video_url'] = $video_url;
                }

                if( $testimonial_type == 2 ) {
                    $data_video_details['testimonial_text'] = $testimonial_text;
                }*/

				
                $validator = $this->validatorRegisterGeneral($data_coupon_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(config("constants.admin_prefix") . '/' . 'coupons/create')->withErrors($val)->withInput();
                }

				
				
				
				$user_id=Coupon::create($data_coupon_details)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Coupons successfully added');
                
                return redirect()->intended(route('coupons'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Coupons successfully added');
            }
			
            return view('admin.coupon.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editCoupon(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $coupon = Coupon::where('status','<>',3)->where(['coupon_id'=> $id])->first();
          
            
            $data_msg["coupon"] = $coupon;
            $data_msg['menu_parent'] = 'coupons';
            $data_msg['menu_child'] = 'list_coupon';
			
            return view('admin.coupon.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editCouponAction(Request $request, $id) {

        $data = $request->all();
        $data['start_date'] = date('Y-m-d H:i:s',strtotime($request->input('start_date')));

        //print_r()
        $data['end_date'] = date('Y-m-d H:i:s',strtotime($request->input('end_date')));
        
        $validator = $this->validatorRegisterGeneral($data);
        
        if ($validator->fails()) {
            $val = $validator->errors();
            return redirect()->intended(config("constants.admin_prefix") . '/' . 'coupons/edit/'.Hasher::encode($id))->withErrors($val)->withInput();
        }
        
         $coupon =  Coupon::where('status','<>',3)->where(['coupon_id'=> $id])->first();



     
         $coupon->update($data);

       	
        return redirect()->intended(config("constants.admin_prefix") . '/coupons')->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

}
