<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use Illuminate\Http\Request;
//use App\Models\Menu\MenuMaster;
//use App\Models\Menu\NaviMaster;
//use App\Models\CmsLinks;
use App\Product;
use App\ExamMaster;
use App\Video;
use App\Testimonial;
use Carbon\Carbon;
use Redirect;
use Auth;
use View;
use DB;
use Storage;
use Validator;
use App\BannerMaster;
use App\Helpers\ImageHelper;
use Hasher;
use Str;

class BannerController extends Controller
{
	public function __construct() 
	{
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
    
    public function createBanner(Request $request) {
        $data_msg = array();
       // $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('updated_at', 'desc')->get();

        if (Auth::guard('admins')->check()) {
            try{
            $data_msg['menu_parent'] = 'setting';
            $data_msg['menu_child'] = 'banner';
            $banner = BannerMaster::find(1);
            $data_msg['banner'] = $banner;

            if ($request->method() === "POST") {

                //return $request;
               
                $image=$file=$banner->image;
                if($request->hasFile('image')){
                    
                    try{
                        $uploadedFile = $request->file('image');
                        $image=ImageHelper::savePdfForGallery($uploadedFile,'banner');
                    }  
                    catch(\Exception $e){
                        dd($e->getMessage());
                    }

                }
                $banner->title =  $request->input('title');
                $banner->description =  $request->input('notidescription');
                $banner->image = $image;
                $banner->status = $request->input('status');
                
               
                $banner->save();
               
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Banner saved successfully ');
                    
                return redirect()->intended(route('showBanner'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Banner saved successfully ');
            }
            	   return view('admin.banner.create', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage());
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   

    public function uploadImageCKeditor(Request $request)
    {
        if($request->hasFile('upload')) {
            $uploadedFile = $request->file('upload');
            //dd($uploadedFile);
            // $originName = $request->file('upload')->getClientOriginalName();
            // $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $uploadedFile->getClientOriginalExtension();
            // $fileName = $fileName.'_'.time().'.'.$extension;
        
            // $request->file('upload')->move(public_path('images'), $fileName);
            if($extension=="jpg" || $extension=="jpg" || $extension=="png" || $extension=="gif"){
                $image=ImageHelper::savePdfForGallery($uploadedFile,'banner');
                
            }else{
                $image=ImageHelper::saveFileForGallery($uploadedFile,'banner');

            }
   
            $CKEditorFuncNum = $request->CKEditorFuncNum;
            $url = asset('storage/uploads/banner/'.$image); 
            $msg = 'Uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
            
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }

    public function notFound($lng) {

        return view('errors.404');
    } 
}
