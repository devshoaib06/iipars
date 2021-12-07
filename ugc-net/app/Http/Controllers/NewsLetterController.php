<?php

namespace App\Http\Controllers;


use App\User;

use Hasher;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\NewsLeterSubscriptionEmail;


class NewsLetterController extends Controller {

    public function __construct() {
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }

    public function showNewsLetterList()
    {
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'newsletter';
            $data_msg['menu_child'] = 'newsletter-list';
            
            
            return view('admin.newsletter.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxNewsLetterList(Request $request)
    {

        if ($request->ajax()) {

            
            $email = $request->input('email');
            $date_from = $request->input('date_from');
           
            $date_to = $request->input('date_to');

            $arrSearch[] = ['status', '<>', '3'];
           

            if ($email != '') {
                $arrSearch[] = ['email', 'like', '%' . $email . '%'];
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

            $users = NewsLeterSubscriptionEmail::where($arrSearch);

           

            $users = $users->get();

           

            $iTotalRecords = count($users);



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

            $column = array('#', 'email','created_at');


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
            
            $users_1 = NewsLeterSubscriptionEmail::where($arrSearch);

           

            $users_1 = $users_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();


            //->toSql();
            //dd($fundsTransactionList);
            //die;
            $action="";
            $sl = 1;
            foreach ($users_1 as $t) {

                $records["data"][] = array(
                    $sl,
                    $t->email,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    $action
                );

                $sl++;
            }


            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;


            echo json_encode($records);
        }
    }


    
    public function saveNewsletterEmail(Request $request) {
        
        $newsletter_data=array(
            'email'=>$request->email
        );
        $newletter=NewsLeterSubscriptionEmail::create($newsletter_data);
            
        if($newletter){
            return 1;
        }

        return 0;
    }

    public function checkEmailExists(Request $request) {
        if ($request->ajax()) {
            $email = trim($request->input('email'));
            
            $ck = NewsLeterSubscriptionEmail::where('email',$email)->first();
            
            if ($ck) {
                return "false";
            } else {
                return "true";
            }
        }
    }

}
