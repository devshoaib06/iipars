<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\library\encryptDecrypt;
use App\library\myFunctions;
use App\Product;
use App\ComboProduct;
use App\ComboProductContributorRelation;

use App\Item;
use App\Video;
use App\ComboProductVideoRelation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Helpers\ImageHelper;


class ComboCourseController extends Controller
{
    public function __construct() {
        //$this->middleware('auth');
        /*$lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }*/
    }
    
    private $form_rules = [
        'hotel_name' => 'required',
        'hotel_type' => 'required',
        'country_id' => 'required',
        'location_id' => 'required',
        'zip_code' => 'required',
        'phone_number' => 'required',
        'email' => 'required|email|max:255',
        'address' => 'required',
        'description' => 'required',
        'hotel_size' => 'required',
        'arriving_leaving' => 'required',
        'required_at_check_in' => 'required',
        'children' => 'required',
        'pets' => 'required',
        'internet' => 'required',
        'transfers' => 'required',
        'parking' => 'required',
        'offsite' => 'required',
        'no_of_room_v' => 'integer',
        'percentage_adv' => 'max:100.00',
        'city' => 'required',
        
        'geo_location' => 'required',
    ];

    public function listComboCourse()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'combo-course';
    
            //$data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            return view('admin.courses.combo_course.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addComboCourse()
    {
        if (Auth::guard('admins')->check())
        {
           
            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'combo-course';
           
            $data_msg['items']=Product::where('status',1)->get();

            $product_contributors=array();
            foreach ($data_msg['items'] as $item) {
                $product_contributors[$item->product_id]=DB::table('product_contributor_item_relations as pcir')
                                    ->join('contributors as cnt','pcir.contributor_id','cnt.contributor_id')
                                    //->leftJoin('products as prd','prd.product_id','pcir.contributor_id')
                                    ->select("cnt.contributor_id",'cnt.firstname','cnt.lastname','pcir.product_id')
                                    ->where('pcir.product_id',$item->product_id)
                                    ->distinct('cnt.contributor_id')
                                    ->get()->toArray();
            }
                //array_unique($product_contributors);                    
            /*echo "<pre>";
            print_r($product_contributors);
            die;*/
            $data_msg['product_contributors']= $product_contributors;
            $data_msg['videos']= Video::where('status',1)->get();
            return view('admin.courses.combo_course.add', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addComboCourseAction(Request $request)
    {
        //return $request;
        if (Auth::guard('admins')->check()) {
            try {
                //Product Table data
                $name=$request->input('g_name');
                $short_description=$request->input('s_description');
                $description=$request->input('description');
                $course_price=$request->input('course_price');
                $discount_price=$request->input('discount_price');
                $expiry_date=date('Y-m-d H:i:s',strtotime($request->input('expiry_date')));
                $is_popular=$request->input('is_popular');
                $home_slider=$request->input('home_slider');
                $important_notice=$request->input('important_notice');
                $meta_key=$request->input('meta_key');
                
                
                $filename="";

                if($request->hasFile('image')){
                    $filename=$this->uploadImage($request);
                }
               
                $product_data=array(
                    'name'=>$name,
                    'short_description'=>$short_description,
                    'description'=>$description,
                    'price'=>$course_price,
                    'expiry_date'=>$expiry_date,
                    'is_popular'=>$is_popular,
                    'home_slider'=>$home_slider,
                    'important_notice'=>$important_notice,
                    'meta_key'=>$meta_key,
                    'discount_price'=>$discount_price,
                    'image'=>$filename,
                );
                DB::beginTransaction();

                try {
                    $product_info=ComboProduct::create($product_data);

                    $product_id=$product_info->combo_id;
                    if($product_info && $request->has('prod_contributors')){
                        //$this->saveComboProductContributor($request,$product_id);
                        $this->saveComboProductContributorProduct($request,$product_id);
                    }

                    if($product_info && $request->has('video')){
                        $this->saveComboProductVideo($request,$product_id);
                    }
                    DB::commit();
                }catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->intended(route('createComboCourse'))
                    ->withErrors($e->getMessage())->withInput();
                }


                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Course successfully added');
                
                return redirect()->intended(route('createComboCourse'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Course successfully added');
            }catch (\Exception $e) {
                
                return redirect()->intended(route('createComboCourse'))
                ->withErrors($e->getMessage())->withInput();
            }
        }
        else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }

    }

    public function editComboCourse(Request $request, $id) 
    {
        
        if (Auth::guard('admins')->check())
        {
           
            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'combo-course';
            $data_msg['product']=ComboProduct::find($id);

            $data_msg['items']=Product::where('status',1)->get();

             $product_contributors=array();
            foreach ($data_msg['items'] as $item) {
                $product_contributors[$item->product_id]=DB::table('product_contributor_item_relations as pcir')
                                    ->join('contributors as cnt','pcir.contributor_id','cnt.contributor_id')
                                    ->select("cnt.contributor_id",'cnt.firstname','cnt.lastname','pcir.product_id')
                                    ->where('pcir.product_id',$item->product_id)
                                    ->distinct('cnt.contributor_id')
                                    ->get()->toArray();
            }
               
            $data_msg['product_contributors']= $product_contributors;
            $data_msg['videos']= Video::where('status',1)->get(); 
           
           
            //Related Videos           
            $related_videos=ComboProductVideoRelation::where(['combo_id'=>$id])->get();

            $product_videos=array();
            foreach ($related_videos as $related_video) {
               $product_videos[]=$related_video->video_id;
            }

            $data_msg['product_video']=$product_videos;
            //$data_msg['combo_products']=$combo_products;
            // $data_msg['combo_product_contributors']=$combo_product_contributors;

            //Related Course
         /*  echo "<pre>";
           print_r($combo_products);
           die;*/


            return view('admin.courses.combo_course.edit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    //private function saveComboProductContributor($request,$combo_id){
    //    $contributors=$request->input('contributors');
    //    try{
    //    for($count=0;$count<count($contributors);$count++) {
    //
    //       
    //        $product_item_data=array(
    //            'combo_id'=>$combo_id,
    //            'contributor_id'=>$contributors[$count]                
    //        );
    //       
    //        ComboProductContributorRelation::updateOrCreate($product_item_data,$product_item_data);
    //    }
    //    return;
    //    }catch (\Exception $e) {
    //            
    //            return redirect()->intended(route('createCourse'))
    //            ->withErrors($e->getMessage())->withInput();
    //    }
    //}
    private function saveComboProductContributorProduct($request,$combo_id){
        $prod_contributors=$request->input('prod_contributors');
        $contributors=$request->input('contributors');
        try{
        
        for($count=0;$count<count($prod_contributors);$count++) {
            $product_item_data=array(
                'combo_id'=>$combo_id,
                'product_id'=>$prod_contributors[$count],
                'contributor_id'=>$contributors[$count]
            );
            
            ComboProductContributorRelation::updateOrCreate($product_item_data,$product_item_data);
        }
        return;
        }catch (\Exception $e) {
                
                return redirect()->intended(route('createCourse'))
                ->withErrors($e->getMessage())->withInput();
        }
    }

    public function ajaxComboCourseList(Request $request)
    {

        if ($request->ajax())
        {
            $item_id = $request->input('item_id');
            //$request->session()->put('item_id', $item_id);
            
            $name = $request->input('name');
            //$request->session()->put('name', $name);
            
            $contributor_name = $request->input('contributor_name');
            //$request->session()->put('contributor_name', $contributor_name);
            
            $date_from = $request->input('date_from');
            //$request->session()->put('date_from', $date_from);

            $date_to = $request->input('date_to');
            //$request->session()->put('date_to', $date_to);

            $status = $request->input('status');
            //$request->session()->put('status', $status);

            $arrSearch[] = ['status', '<>', '3'];
            
            if ($item_id != '') {
                $arrSearch[] = ['item_id', $item_id];
            }
            if ($name != '') {
                $arrSearch[] = ['name', 'like', '%' . $name . '%'];
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
                $arrSearch[] = ['products.status', $status];
            }



            //$items = DB::table('items')->select('products.name', DB::raw("CONCAT('contributors.firstname',' ', 'contributors.lastname') AS name"), 'products.created_at', 'products.item_id', 'products.status')
            ////->join("item_contributor_relations",function($join){
            ////    $join->on('products.item_id', '=', 'item_contributor_relations.item_id');
            ////        //->on('contributors.contributor_id', '=', 'item_contributor_relations.contributor_id');
            ////})
            //->leftJoin('item_contributor_relations','products.item_id', '=', 'item_contributor_relations.item_id')
            //->leftJoin('contributors', 'item_contributor_relations.contributor_id', '=', 'contributors.contributor_id')
            ////->join('item_contributor_relations', 'products.item_id', '=', 'item_contributor_relations.item_id')
            ////->join('item_contributor_relations', 'contributors.contributor_id', '=', 'item_contributor_relations.contributor_id')
            //->where($arrSearch);
                
            $items = DB::table('combo_products')->select('name','created_at', 'combo_id', 'status')
           // ->leftJoin('item_contributor_relations','products.item_id', '=', 'item_contributor_relations.item_id')
            ->where($arrSearch);
            
            //if ($name != '') {
            //    $items = $items->WhereRaw("concat(contributors.firstname, ' ', contributors.lastname) like '%$name%' ");
            //}

            $items = $items->get();
            //return $items;
            $iTotalRecords = count($items);

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

            $column = array( '#','name','created_at','status','action');


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

            //$myFunctions = new myFunctions;
            $items_1 = DB::table('combo_products')->select('name','created_at', 'combo_id', 'status')
            
            //->leftJoin('item_contributor_relations','products.item_id', '=', 'item_contributor_relations.item_id')
            ->where($arrSearch);

            //if ($name != '') {
            //    $items_1 = $items_1->WhereRaw("concat(contributors.firstname, ' ', contributors.lastname) like '%$name%' ");
            //}


            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();
            $sl = 1;
            foreach ($items_1 as $t)
            {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
               

                $records["data"][] = array(
                    $sl,
                    $t->name,
                    $t->created_at,
                    $status,
                    '<a href="' .route('editComboCourse',['id'=>\Hasher::encode($t->combo_id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
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

    public function uploadImage($request)
    {
      $uploadedFile = $request->file('image');
      $course_pic_name=ImageHelper::savePdfForGallery($uploadedFile,config('disk.get_course'));
      return $course_pic_name;
    }

    public function ajaxCourseMaterialList(Request $request)
    {
        $contributors=DB::table('item_contributor_relations as icr')
                      ->join('contributors as ct','icr.contributor_id','ct.contributor_id')
                      ->select('ct.firstname','ct.lastname','ct.contributor_id','icr.item_id')
                      ->where('icr.item_id',$request->itemid)
                      ->get();
                      
        return $contributors;
    }
    public function ajaxEditCourseMaterialList(Request $request)
    {
        $contributors=DB::table('item_contributor_relations as icr')
                      ->leftJoin('contributors as ct','icr.contributor_id','ct.contributor_id')
                      ->leftJoin('product_contributor_item_relations as pci', function($join) 
                        {
                            $join->on('pci.contributor_id', '=', 'icr.contributor_id');
                            $join->on('pci.item_id', '=', 'icr.item_id');
                            
                        })
                      ->select('ct.firstname','ct.lastname','ct.contributor_id','icr.item_id','pci.price')
                      ->where('icr.item_id',$request->itemid)
                      ->where(function($q) use ($request){
                          $q->where('pci.product_id',$request->product_id)
                            ->orWhereNull('pci.product_id');
                      })
                      ->get();
       
       // print_r($contributors);die;              
        $contributor_price=array();
            
        return $contributors;
    }


    private function saveComboProductVideo($request,$combo_id)
    {
        $videos=$request->input('video');
        $video_data=array();

        foreach ($videos as $video) {
            $video_data[]=array(
                'combo_id'=>$combo_id,
                'video_id'=>$video,                
            );
        }

        ComboProductVideoRelation::insert($video_data);
    }
    public function editComboCourseAction(Request $request,$id)
    {
       //return $request;
        if (Auth::guard('admins')->check()) {
            try {
                
                $product=ComboProduct::find($id);
                //Product Table data
                $name=$request->input('g_name');
                $short_description=$request->input('s_description');
                $description=$request->input('description');
                $course_price=$request->input('course_price');
                $discount_price=$request->input('discount_price');
                $expiry_date=date('Y-m-d H:i:s',strtotime($request->input('expiry_date')));
                $is_popular=$request->input('is_popular');
                $home_slider=$request->input('home_slider');
                $important_notice=$request->input('important_notice');
                $meta_key=$request->input('meta_key');
                $status=$request->input('status');
                
                
                $filename=$product->image;

                if($request->hasFile('image')){
                    $filename=$this->uploadImage($request);
                }
               
                $product_data=array(
                    'name'=>$name,
                    'short_description'=>$short_description,
                    'description'=>$description,
                    'price'=>$course_price,
                    'discount_price'=>$discount_price,
                    'expiry_date'=>$expiry_date,
                    'is_popular'=>$is_popular,
                    'home_slider'=>$home_slider,
                    'important_notice'=>$important_notice,
                    'meta_key'=>$meta_key,
                    'status'=>$status,
                    'image'=>$filename,
                );

                //return $product_data;
                DB::beginTransaction();

                try {
                    $product_info=$product->update($product_data);

                    $combo_id=$id;
                    
                    $this->updateComboProductContributor($request,$combo_id);
                        //$this->updateComboProductsProduct($request,$combo_id);
                    

                    if($request->has('video')){
                      
                        $this->updateComboProductVideo($request,$combo_id);
                    }
                    DB::commit();
                }catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->intended(route('editComboCourse',['id'=>\Hasher::encode($id)]))
                    ->withErrors($e->getMessage())->withInput();
                }


                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Course successfully updated');
                
                return redirect()->intended(route('editComboCourse',['id'=>\Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Course successfully updated');
            }catch (\Exception $e) {
                
                return redirect()->intended(route('editComboCourse',['id'=>\Hasher::encode($id)]))
                ->withErrors($e->getMessage())->withInput();
            }
        }
        else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }

    }

    private function updateComboProductContributor($request,$combo_id)
    {

        $deleteProductContributor=ComboProductContributorRelation::where('combo_id',$combo_id)->delete();
        
        if($request->has('prod_contributors')){

            $contributors=$request->input('contributors');
            
            $prod_contributors=$request->input('prod_contributors');
            
            for($count=0;$count<count($prod_contributors);$count++) {
                $product_item_data=array(
                    'combo_id'=>$combo_id,
                    'product_id'=>$prod_contributors[$count],
                    'contributor_id'=>$contributors[$count]
                );
                
                ComboProductContributorRelation::updateOrCreate($product_item_data,$product_item_data);
            }
        }
    }
    
    //private function updateComboProductsProduct($request,$combo_id){
    //    $prod_contributors=$request->input('prod_contributors');
    //    
    //    $deleteProduct=ComboProductsProductRelation::where('combo_id',$combo_id)->delete();
    //    
    //    for($count=0;$count<count($prod_contributors);$count++) {
    //        $product_item_data=array(
    //            'combo_id'=>$combo_id,
    //            'product_id'=>$prod_contributors[$count]                
    //        );
    //        
    //        ComboProductsProductRelation::updateOrCreate($product_item_data,$product_item_data);
    //    }
    //    
    //}
    
    private function updateComboProductVideo($request,$combo_id)
    {
        $delete_video=ComboProductVideoRelation::where('combo_id',$combo_id)->delete();
        if($request->has('prod_contributors')){

            $videos=$request->input('video');
            $video_data=array();
            foreach ($videos as $video) {
                $video_data[]=array(
                    'combo_id'=>$combo_id,
                    'video_id'=>$video,
                );
            }

            ComboProductVideoRelation::insert($video_data);
        }
    }

}
