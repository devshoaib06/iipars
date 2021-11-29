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
use App\ArticleMaster;
use App\ArticleCategory;
use App\Helpers\ImageHelper;
use Hasher;
use Str;

class ArticleController extends Controller
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



    public function showArticleForm(){
        $DataBag = $meta_array= array();

       $result = DB::table('videos')->distinct()
                    ->select('title', 'video_url')                    
                    ->where('status', '=', 1);  

        $result = $result->get();

            $DataBag['result'] = $result; 

        $meta_array['meta_title']='Articles | Teachinns';
        $meta_array['meta_desc']='We at Teachinns welcome experts to send their articles related to CSIR UGC NET/SET/JRF exam preparation, tips, tricks, and more!';
        $meta_array['meta_keyword']='Articles';
        $meta_array['meta_robots']='Articles';
        
        $DataBag['page_metadata'] = (object)$meta_array;

        // $DataBag['allArticles']=DB::table('article_masters as am')
        // ->select('am.*','ac.name as cat_name','am.status')
        //     ->join('article_categories as ac','ac.id','am.category_id')
        //     ->where('am.status',1)
        //     ->where('am.category_id',1)
        //     ->get();
        // //return $DataBag['allArticles'];
        return view('frontend.articles.submit-article', $DataBag);

    }
    public function showCategoryWiseArticle($category){
        $cat_info=ArticleCategory::where('slug',$category)->first();
        //return $category;
        if(!$cat_info){
            return view('frontend.errors.404');
        }

        $DataBag = $meta_array= array();

       $result = DB::table('videos')->distinct()
                    ->select('title', 'video_url')                    
                    ->where('status', '=', 1);  

        $result = $result->get();

            $DataBag['result'] = $result; 

        $meta_array['meta_title']='Articles | Teachinns';
        $meta_array['meta_desc']='We at Teachinns welcome experts to send their articles related to CSIR UGC NET/SET/JRF exam preparation, tips, tricks, and more!';
        $meta_array['meta_keyword']='Articles';
        $meta_array['meta_robots']='Articles';
        
        $DataBag['page_metadata'] = (object)$meta_array;

        $DataBag['allArticles']=DB::table('article_masters as am')
        ->select('am.*','am.status','acr.category_id','ac.name as cat_name','ac.slug as cat_slug')
            ->join('article_category_relations as acr','acr.article_id','am.id')
            ->join('article_categories as ac','acr.category_id','ac.id')
            ->where('am.status',1)
            ->where('acr.category_id',$cat_info->id)
            ->where('am.is_featured',0)
            ->get();
        $DataBag['featured_article']=DB::table('article_masters as am')
        ->select('am.*','am.status','acr.category_id','ac.name as cat_name','ac.slug as cat_slug')
            ->join('article_category_relations as acr','acr.article_id','am.id')
            ->join('article_categories as ac','acr.category_id','ac.id')
            ->where('am.status',1)
            ->where('acr.category_id',$cat_info->id)
            ->where('am.is_featured',1)
            ->first();
         
        $DataBag['category']=$cat_info->name;    
        $DataBag["categories"] = \App\ArticleCategory::where('status',1)->orderBy('name', 'desc')->get();

        //return $DataBag['allArticles'];
        return view('frontend.articles.article', $DataBag);

    }
    public function articleDetails($category,$slug)
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-list';



            $article = DB::table('article_masters as am')
                ->select('am.*','am.status','ac.name as cat_name','ac.slug as cat_slug')
                ->join('article_category_relations as acr','acr.article_id','am.id')
                ->join('article_categories as ac','acr.category_id','ac.id')
                ->where('am.slug', $slug)->first();

            $meta_array['meta_title']=$article->meta_title?$article->meta_title:'Articles | Teachinns';
            $meta_array['meta_desc']=$article->meta_description?$article->meta_description:'We at Teachinns welcome experts to send their articles related to CSIR UGC NET/SET/JRF exam preparation, tips, tricks, and more!';
            $meta_array['meta_keyword']=$article->meta_tags?$article->meta_tags:'Articles';
            $meta_array['meta_robots']=$article->meta_robots?$article->meta_robots:'meta_robots';
            
            $data_msg['page_metadata'] = (object)$meta_array;

            //dd($article);
            //$article = \App\ArticleMaster::where('slug', $slug)->firstOrFail(); 
            $data_msg["article_info"]=$article;
            $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('name', 'desc')->get();
            return view('frontend.articles.article_details', $data_msg);
        
    }
    
    
    
    public function allArticles(){
        $DataBag = $meta_array= array();

        $meta_array['meta_title']='Articles | Teachinns';
        $meta_array['meta_desc']='We at Teachinns welcome experts to send their articles related to CSIR UGC NET/SET/JRF exam preparation, tips, tricks, and more!';
        $meta_array['meta_keyword']='Articles';
        $meta_array['meta_robots']='Articles';
        
        $DataBag['page_metadata'] = (object)$meta_array;

        $DataBag['allArticles']=DB::table('article_masters as am')
        ->select('am.*','am.status')
            // ->join('article_category_relations as acr','acr.article_id','am.id')
            // ->join('article_categories as ac','acr.category_id','ac.id')
            ->where('am.status',1)
            ->where('am.category_id',2)

            ->orderBy('am.created_at','desc')
            //->where('am.category_id',1)
            ->paginate(6);
            //->get();

       
        $DataBag['featured_article']=DB::table('article_masters as am')
        ->select('am.*','am.status')
            // ->join('article_category_relations as acr','acr.article_id','am.id')
            // ->join('article_categories as ac','acr.category_id','ac.id')
            ->where('am.status',1)
            //->where('acr.category_id',$cat_info->id)
            ->where('am.is_featured',1)
            ->first();
            $DataBag["categories"] = \App\ArticleCategory::where('status',1)->orderBy('name', 'desc')->get();

        return view('frontend.articles.article_listing', $DataBag);

    }

    public function frontendSubmitArticle(Request $request)
    {
        try{
            
            $g_recaptcha_response = $request->input('g-recaptcha-response');
            $data_user_details = array(
                
                'email' => $request->writer_email,
                'g-recaptcha-response' => $g_recaptcha_response
            );
            
            $validator = $this->validatorRegisterGeneral($data_user_details);
            //dd($validator->errors());
            if ($validator->fails()) {
                $val = $validator->errors();
                return redirect()->intended(route('showArticleForm'))->withErrors($val)->withInput();
                
                
            }
 
            $image=$file="";
            if($request->hasFile('image')){
                $uploadedFile = $request->file('image');
                $image=$this->uploadImage($uploadedFile,config('disk.get_article_image'));
            }
            if($request->hasFile('file')){
                $uploadedFile = $request->file('file');
                $file=$this->uploadImage($uploadedFile,config('disk.get_article_file'));
            }
            $slug = $this->createSlug($request->title);
            $article_data=array(
                'category_id' =>  1,
                'writer_name' =>  $request->input('writer_name'),
                'writer_email' =>  $request->input('writer_email'),
                'writer_phone' =>  $request->input('writer_phone'),
                'title' =>  $request->input('title'),
                'description' =>  $request->input('description'),
                'meta_tags' =>  $request->input('meta_tags'),
                'meta_keywords' => $request->input('meta_keywords'),
                'image' => $image,
                'file' => $file,
                'status'=>0,
                'slug'=>$slug,
                'is_featured'=>$request->is_featured
            );
            //return $article_data;
            $article_info=ArticleMaster::create($article_data);
            
            
                $data=array(
                    'article_id'=>$article_info->id,
                    'category_id'=>1
                );
                \App\ArticleCategoryRelation::create($data);
            
            return redirect()->intended(route('showArticleForm'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Thanks for submitting article.Once reviewed,it will be published.');

        }catch(\Exception $e){
            return redirect()->intended(route('showArticleForm'))->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage());
        }
    }
    public function createArticle(Request $request) {
        $data_msg = array();
        $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('updated_at', 'desc')->get();

        if (Auth::guard('admins')->check()) {
            try{
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-list';

            if ($request->method() === "POST") {

                //return $request;
                    $image=$file=$fileName="";
                if($request->hasFile('image')){
                    $uploadedFile = $request->file('image');
                    $fileName=$uploadedFile->getClientOriginalName();

                    $image=$this->uploadImage($uploadedFile,config('disk.get_article_image'));
                }
                if($request->hasFile('file')){
                    $uploadedFile = $request->file('file');
                    $fileName=$uploadedFile->getClientOriginalName();

                    //$file=$this->uploadImage($uploadedFile,config('disk.get_article_file'));
                    $file=ImageHelper::saveFileForGallery($uploadedFile,config('disk.get_article_file'));

                }
                $slug = $this->createSlug($request->title);

               
                $category_list=$request->category_list;

                $article_data=array(
                    'category_id' =>  implode(',',$category_list),
                    'writer_name' =>  $request->input('writer_name'),
                    'writer_email' =>  $request->input('writer_email'),
                    'writer_phone' =>  $request->input('writer_phone'),
                    'title' =>  $request->input('title'),
                    'description' =>  $request->input('description'),
                    'meta_tags' =>  $request->input('meta_tags'),
                    'meta_keywords' => $request->input('meta_keywords'),
                    'meta_title' => trim($request->input('meta_title')),
                    'meta_robots' => trim($request->input('meta_robots')),
                    'meta_description' => trim($request->input('meta_description')),
                    'image' => $image,
                    'file' => $file,
                    'fileName'=>$fileName,
                    'slug' => $slug,
                );
                $article_info=ArticleMaster::create($article_data);
                //return $article_info;
            
                foreach($category_list as $cat){
                    $data=array(
                        'article_id'=>$article_info->id,
                        'category_id'=>$cat
                    );
                    \App\ArticleCategoryRelation::create($data);
                }

                    $request->session()->flash('messageClass', 'alert alert-success');
                    $request->session()->flash('message', 'Article successfully created');
                        
                    return redirect()->intended(route('article-list'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Article successfully created');
            }
            	   return view('admin.articles.create', $data_msg);

            }catch(\Exception $e){
                return redirect()->back()->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage());
            }
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
   

    public function ajaxArticleList(Request $request)
    {

        if ($request->ajax())
        {
            $title = $request->input('title');
            $writer_name = $request->input('writer_name');
            $category = $request->input('category');
            $status = $request->input('status');
            $is_featured = $request->input('is_featured');
           
            
            $date_from = $request->input('date_from');
            
            $date_to = $request->input('date_to');
            
            
            
            
            $arrSearch[] =['am.status','<>',3] ;
            
            if ($title != '') {
                $arrSearch[] = ['am.title', 'like', '%' . $title . '%'];
            }
            if ($writer_name != '') {
                $arrSearch[] = ['am.writer_name', 'like', '%' . $writer_name . '%'];
            }
            
            // if ($category != '') {
            //     $arrSearch[] = ['am.category_id', $category];
            // }
            if ($status != '') {
                $arrSearch[] = ['am.status',$status];
            }
            if ($is_featured != '') {
                $arrSearch[] = ['am.is_featured',$is_featured];
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
            

                
            $items = DB::table('article_masters as am')
                ->select('am.*','am.status')
                ->where(function($query) use($category){
                    if ($category != '') {
                        $query->orWhereRaw("find_in_set($category,am.category_id)");
                    }
                }) 
                //->join('article_categories as ac','ac.id','am.category_id')
                ->where($arrSearch);

            $items = $items->get();
            //dd($items);
            $iTotalRecords = count($items);

           
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);

            $records = array();
            $records["data"] = array();

            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;


            $order = $request->input('order');

            $column = array( 'am.id','am.title','category','am.writer_name','am.is_featured','am.created_at','action');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                //$column_name = $column[4];
                $column_name = 'am.id';
                
            }

            // if ($order[0]['dir'] != '') {
            //     $asc_desc = $order[0]['dir'];
            // } else {
            // }
            $asc_desc = 'desc';
            

            
            $items_1 = DB::table('article_masters as am')
                ->select('am.*','am.status')
                ->where(function($query) use($category){
                    if ($category != '') {
                        $query->orWhereRaw("find_in_set($category,am.category_id)");
                    }
                }) 
                //->join('article_categories as ac','ac.id','am.category_id')
                ->where($arrSearch);

            


            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
               
                $is_featured = '';
                if ($t->is_featured == '1') {
                    $status = '';
                    $is_featured = '<span class="label label-sm label-success"> Yes </span>';
                }else{
                    $is_featured = '<span class="label label-sm label-warning">No</span>';

                }
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                }else{
                    $status = '<span class="label label-sm label-warning">Inactive</span>';

                }
                
                $categories=explode(",",$t->category_id);
                $allcat=[];
                foreach($categories as $cat_id){
                    $cat_info=\App\ArticleCategory::find($cat_id);
                    $allcat[]=$cat_info->name;
                }
                $related_categories= implode(",<br>",$allcat);
               
                $records["data"][] = array(
                    
                    $sl,
                    $t->title,
                    $related_categories,
                    $t->writer_name,
                    $is_featured,
                    $status,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),
                    '<a href="'.route('editArticle',['id'=>Hasher::encode($t->id)]).'" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> Edit </a>'
                    
                );

                $sl++;
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;

            echo json_encode($records);
            exit;
        }
    }

    public function showArticleList()
    {
        //dd(\App\ArticleCategory::find(1)->articles);
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-list';
            
            $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            return view('admin.articles.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    
    

    public function editArticle(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            $article_info =ArticleMaster::find($id);  
                        
            $data_msg["article_info"] = $article_info;
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-list';


            $data_msg["categories"] = \App\ArticleCategory::where('status',1)->orderBy('updated_at', 'desc')->get();
            $selected_cat=\App\ArticleCategoryRelation::where('article_id',$id)->get();
            $newSelectArray=[];
            foreach($selected_cat as $scat){
                $newSelectArray[]=$scat->category_id;
            }
            //return $newSelectArray;
			$data_msg['selected_cat']=$newSelectArray;
			
            return view('admin.articles.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editArticleAction(Request $request, $id) 
    {
        //return $request;
        if($request->has('writer_name')){

            ArticleMaster::where('is_featured',1)->update(['is_featured' => 0]);
            $articleDetails=ArticleMaster::find($id);
            $image=$articleDetails->image;
            $file=$articleDetails->file;
            $slug=$articleDetails->slug;
            if($articleDetails->slug==""){
                $slug = $this->createSlug($request->title,$id);
            }
            $fileName="";
            if($request->has('image')){
            if($request->hasFile('image')){
                $uploadedFile = $request->file('image');
                $fileName=$uploadedFile->getClientOriginalName();

                $image=$this->uploadImage($uploadedFile,config('disk.get_article_image'));
            }           
            }
            if($request->has('file')){
                if($request->hasFile('file')){
                    $uploadedFile = $request->file('file');
                    $fileName=$uploadedFile->getClientOriginalName();
                    //$file=$this->uploadImage($uploadedFile,config('disk.get_article_file'));
                    $file=ImageHelper::saveFileForGallery($uploadedFile,config('disk.get_article_file'));

                }
            } 
            $category_list=$request->category_list;

            $article_data=array(
                'category_id'=>implode(',',$category_list),
                'writer_name' =>  $request->input('writer_name'),
                'writer_email' =>  $request->input('writer_email'),
                'writer_phone' =>  $request->input('writer_phone'),
                'title' =>  $request->input('title'),
                'description' =>  $request->input('description'),
                'meta_tags' =>  $request->input('meta_tags'),
                'meta_keywords' => $request->input('meta_keywords'),
                'meta_title' => trim($request->input('meta_title')),
                'meta_robots' => trim($request->input('meta_robots')),
                'meta_description' => trim($request->input('meta_description')),
                'is_featured' => $request->input('is_featured'),
                'status' => $request->input('status'),
                'image' => $image,
                'file' => $file,
                'fileName'=>$fileName,
                'slug'=>$slug
            );

            
            $updated_user_info=$articleDetails->update($article_data);
            
            
                \App\ArticleCategoryRelation::where('article_id',$id)->delete();
            
            foreach($category_list as $cat){
                $data=array(
                    'article_id'=>$id,
                    'category_id'=>$cat
                );
                \App\ArticleCategoryRelation::create($data);
            }

            \Session::flash('messageClass', 'alert alert-success');
            \Session::flash('message', 'Updateded successfully');
            
            return back();
        }
		
		return back();
        
    }

    public function downloadArticleFile($article_id) {
        //dd(Auth::check());
         //if (Auth::guard('admins')->check()) {
            $article_id=\Hasher::decode($article_id);
             $article_info=ArticleMaster::find($article_id);
             $pathToFile =storage_path('uploads/articles/files/') . $article_info->file;
            
             return response()->download($pathToFile, $article_info->fileName);
        //  } else {
        //      return redirect()->intended('/login');
        //  }
     }

    protected function validatorRegisterGeneral(array $data) {
        //dd($data);
        $validate = [
            
            'email' => 'required|email|max:255',
            //'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|captcha'
        ];

        return Validator::make($data, $validate);
    }

    public function uploadImage($uploadedFile,$disk)
    {
      $course_pic_name=ImageHelper::savePdfForGallery($uploadedFile,$disk);
      return $course_pic_name;
    }

    public function createSlug($title, $id = 0)
    {
        // Normalize the title
        $slug = Str::slug($title);

        // Get any that could possibly be related.
        // This cuts the queries down by doing it once.
        $allSlugs = $this->getRelatedSlugs($slug, $id);

        // If we haven't used it before then we are all good.
        if (! $allSlugs->contains('slug', $slug)){
            return $slug;
        }

        // Just append numbers like a savage until we find not used.
        for ($i = 1; $i <= 10; $i++) {
            $newSlug = $slug.'-'.$i;
            if (! $allSlugs->contains('slug', $newSlug)) {
                return $newSlug;
            }
        }

        throw new \Exception('Can not create a unique slug');
    }

    public function showcategoryList()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-cat-list';
            $categories=ArticleCategory::all();
            $data_msg['categories']=$categories;
            return view('admin.articles.categories.list',$data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function createCategory(Request $request) {
        $data_msg = array();
       
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-cat-list';
            
            if ($request->method() === "POST") {
            $slug = $this->createSlug($request->cat_name);
              
           

            $article_cat_data=array(
                
                'name' =>  $request->input('cat_name'),
                'status' =>  $request->input('status'),
                'slug' =>  $slug,
            );
            
            $article_info=ArticleCategory::create($article_cat_data);

                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Article Category successfully created');
                    
                return redirect()->intended(route('showcategoryList'))->with('messageClass', 'alert alert-success')
                                    ->with('message', 'Article Category successfully created');
            }
            	return view('admin.articles.categories.create', $data_msg);
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editArticleCategory(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {

			
            $data_msg = array();

            $article_info =ArticleCategory::find($id);  
                        
            $data_msg["article_info"] = $article_info;
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-cat-list';
            return view('admin.articles.categories.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editArticleCategoryAction(Request $request, $id) {
        
        $data_msg = array();
       
        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'article';
            $data_msg['menu_child'] = 'article-cat-list';

            if ($request->method() === "POST") {
              
            $article_info=ArticleCategory::find($id);
            $slug = $this->createSlug($request->cat_name,$id);
            $article_cat_data=array(
                'name' =>  $request->input('cat_name'),
                'status' =>  $request->input('status'),
                'slug'=>$slug
            );
            
            $article_info=$article_info->update($article_cat_data);

                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Article category updated successfully ');
                    
                return redirect()->intended(route('editArticleCategory',['id'=>\Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                    ->with('message', 'Article category updated successfully ');
            }
            	
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
		
		
        
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        return ArticleMaster::select('slug')->where('slug', 'like', $slug.'%')
            ->where('id', '<>', $id)
            ->get();
    }

    public function notFound($lng) {

        return view('errors.404');
    } 
}
