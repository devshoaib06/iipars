<?php

namespace App\Http\Controllers;


use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use App\Models\Menu\MenuMaster;
//use App\Models\Menu\NaviMaster;
//use App\Models\CmsLinks;
use App\Product;
use App\ExamMaster;
use App\CmsMasters;
use App\Video;
use App\Testimonial;
use Carbon\Carbon;
use Redirect;
use Session;
use View;
use DB;
use File;

//use App\library\myFunctions;

class CmsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $shareData = array();
        
		$mainMenu = Product::select('product_id','name','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();
        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();  
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $shareData['articlecats'] = $articles_cat;   
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;              

        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        View::share($shareData);
    }

    // use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        /* if (Auth::check()) {
          return redirect()->intended('dashboard');
          } else {
          return view('frontend.home');
          } */

     
        
    }

   

    public function showCms($url) {


        $data_msg = array();

        $lang = \App::getLocale();
        $data_msg['lang'] = $lang;


        $data = CmsMasters::where('url', $url)->get();

        if (!count($data)) {
            return redirect()->intended('/');
        }



        $pid = $data[0]->cms_id;

        $cms = CmsMasters::select('cms_id','url','heading','description','meta_title','meta_keyword',
                            'meta_robots','meta_description as meta_desc','status','created_at','updated_at'
                        )->find($pid);



        $data_msg['cms_page'] = $url;
        $data_msg['mentors']=\App\MentorMaster::where('status',1)
                            ->where('is_featured',1)->get();
                                    
        
        
        $data_msg['cms'] = $cms;

        
        $data_msg['page_metadata'] = $cms;
        return view('frontend.cms', $data_msg);      

       
    }  

   

}
