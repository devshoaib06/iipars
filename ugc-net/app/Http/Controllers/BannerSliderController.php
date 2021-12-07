<?php

namespace App\Http\Controllers;


use App\User;

use Hasher;
use Validator;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\BannerSliderMaster;


class BannerSliderController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }

    public function showBannerSliderList()
    {
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'banner-slider';
            $data_msg['menu_child'] = 'banner-slider-list';
            
            
            return view('admin.banner_slider.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxBannerSliderList(Request $request)
    {

        if ($request->ajax()) {

            $title = $request->input('title');
           

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['status', '<>', '3'];

            if ($title != '') {
                $arrSearch[] = ['title', 'like', '%' . $title . '%'];
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
                $arrSearch[] = ['news.status', $status];
            }

           
            $newsfeed = BannerSliderMaster::where($arrSearch);

          
            $iTotalRecords = $newsfeed->count();
            
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');
            
            $column = array('#', 'title','created_at', 'status', 'action');


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

            $subjects = $newsfeed->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


           

            $sl = 1;
            
            foreach ($subjects as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }

                
                              
                $records["data"][] = array(
                    $sl,
                    strip_tags($t->title),
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    $status,
                    '<a href="' .route('edit-banner-slider',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'title' => 'required|max:255',
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

    public function createBannerSlider(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'banner-slider';
            $data_msg['menu_child'] = 'banner-slider-list';

            
            if ($request->method() === "POST") {
           

                $title = $request->input('title');
                $link = $request->input('link');
                $status = $request->input('status');

                $data = array(					
                    'title' => $title,
                    'link' => $link,
                    'status' => $status
                );

               				
                $validator = $this->validatorRegisterGeneral($data);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   
                    return redirect()->intended(route('create-banner-slider'))->withErrors($val)->withInput();
                }

				
				
				
				BannerSliderMaster::create($data);
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Banner Slider successfully added');
                
                return redirect()->intended(route('banner-slider'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Banner Slider successfully added');
            }
			
            return view('admin.banner_slider.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editBannerSlider(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $bannerslider = BannerSliderMaster::where(['id'=> $id])->first();
           
            $data_msg['bannerslider'] = $bannerslider;
            $data_msg['menu_parent'] = 'banner-slider';
            $data_msg['menu_child'] = 'banner-slider-list';
			
            return view('admin.banner_slider.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editBannerSliderAction(Request $request, $id) {
        
        $data = $request->all();
        $newsfeed =  BannerSliderMaster::where(['id'=> $id])->first();
        
        $newsfeed->update($data);

       	
        return redirect()->intended(route('edit-banner-slider',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

    

}
