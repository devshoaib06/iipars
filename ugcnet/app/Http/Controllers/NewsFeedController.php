<?php

namespace App\Http\Controllers;


use App\User;

use Hasher;
use Validator;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\NewsFeedMaster;


class NewsFeedController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }

    public function showNotificationList()
    {
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'newsfeed';
            $data_msg['menu_child'] = 'newsfeed-list';
            
            
            return view('admin.newsfeed.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxNewsFeedList(Request $request)
    {

        if ($request->ajax()) {

            $newsfeed = $request->input('newsfeed');
           

            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['news.status', '<>', '3'];

            if ($newsfeed != '') {
                $arrSearch[] = ['newsfeed', 'like', '%' . $newsfeed . '%'];
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

           
            $newsfeed = DB::table('newsfeed_masters AS news')
                    ->select('news.id','news.newsfeed', 'news.created_at', 'news.status')                    
                    ->where($arrSearch);

          
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
            
            $column = array('#', 'newsfeed','created_at', 'news.status', 'action');


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
                    $t->newsfeed,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    $status,
                    '<a href="' .route('editNewsFeed',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'newsfeed' => 'required|max:255',
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

    public function createNewsFeed(Request $request) {
        $data_msg = array();

        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'newsfeed';
            $data_msg['menu_child'] = 'newsfeed-list';

            
            if ($request->method() === "POST") {
           

                $newsfeed = $request->input('newsfeed');
                $status = $request->input('status');

                $data_newsfeed = array(					
                    'newsfeed' => $newsfeed,
                    'status' => $status
                );

               				
                $validator = $this->validatorRegisterGeneral($data_newsfeed);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   
                    return redirect()->intended(route('createNewsFeed'))->withErrors($val)->withInput();
                }

				
				
				
				$user_id=NewsFeedMaster::create($data_newsfeed)->id;
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'News successfully added');
                
                return redirect()->intended(route('newsfeed'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'News successfully added');
            }
			
            return view('admin.newsfeed.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editNewsFeed(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();

            $newsfeed = NewsFeedMaster::where(['id'=> $id])->first();
           
            $data_msg['newsfeed'] = $newsfeed;
            $data_msg['menu_parent'] = 'newsfeed';
            $data_msg['menu_child'] = 'newsfeed-list';
			
            return view('admin.newsfeed.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editNewsFeedAction(Request $request, $id) {
        
        $data = $request->all();
        $newsfeed =  NewsFeedMaster::where(['id'=> $id])->first();
        $newsfeed->update($data);

       	
        return redirect()->intended(route('editNewsFeed',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

    

}
