<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Contributor;
use App\User;
use App\Media;
use App\ItemContributorRelation;
use App\MediaItemRelation;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\library\myFunctions;
use App\Helpers\ImageHelper;
use Storage;

class ItemController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        $lang = Session::get('variableLocale');
        if ($lang != null) {
            Session::put('variableLocale', 'en');
            \App::setLocale($lang);
        }
    }
    
    public function listItem()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check())
        {
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'materials';
    
            $data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            return view('admin.courses.items.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    
    public function ajaxItemList(Request $request)
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

            $arrSearch[] = ['items.status', '<>', '3'];
            
            if ($item_id != '') {
                $arrSearch[] = ['items.item_id', $item_id];
            }
            if ($name != '') {
                $arrSearch[] = ['items.name', 'like', '%' . $name . '%'];
            }

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;

                $arrSearch[] = ['items.created_at', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['items.created_at', '<=', $date_to];
            }

            if ($status != '') {
                $arrSearch[] = ['items.status', $status];
            }



            //$items = DB::table('items')->select('items.name', DB::raw("CONCAT('contributors.firstname',' ', 'contributors.lastname') AS name"), 'items.created_at', 'items.item_id', 'items.status')
            ////->join("item_contributor_relations",function($join){
            ////    $join->on('items.item_id', '=', 'item_contributor_relations.item_id');
            ////        //->on('contributors.contributor_id', '=', 'item_contributor_relations.contributor_id');
            ////})
            //->leftJoin('item_contributor_relations','items.item_id', '=', 'item_contributor_relations.item_id')
            //->leftJoin('contributors', 'item_contributor_relations.contributor_id', '=', 'contributors.contributor_id')
            ////->join('item_contributor_relations', 'items.item_id', '=', 'item_contributor_relations.item_id')
            ////->join('item_contributor_relations', 'contributors.contributor_id', '=', 'item_contributor_relations.contributor_id')
            //->where($arrSearch);
                
            $items = DB::table('items')->select('items.name','items.created_at', 'items.item_id', 'items.status')
           // ->leftJoin('item_contributor_relations','items.item_id', '=', 'item_contributor_relations.item_id')
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

            $column = array( '#','name','items.created_at','status','action');


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
            $items_1 = DB::table('items')->select('items.name','items.created_at', 'items.item_id', 'items.status')
            //->leftJoin('item_contributor_relations','items.item_id', '=', 'item_contributor_relations.item_id')
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
                    '<a href="' .route('editItem',['id'=>\Hasher::encode($t->item_id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
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
    
    public function addItem()
    {
        if (Auth::guard('admins')->check())
        {
           
            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'materials';
           
            $data_msg['contributors']=DB::table('users')
                        ->join('contributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.name', 'users.is_approved','users.status')
                        ->where([
                        'users.user_type_id'=>3,
                        'users.status'=>1
                        ])->get();
            return view('admin.courses.items.add', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addItemAction(Request $request)
    {   

        if (Auth::guard('admins')->check()) {

            $media_items=array();
            $item_contributors=array();

            $name=$request->input('g_name');
            $status=$request->input('status');
            $videos=$request->input('videos');
            $contibutors=$request->input('contibutors');

            $item_data=array(
                'name'=>$name,
                'status'=>$status
            );
            $item=Item::create($item_data);

            if($item){
                $item_id=$item->item_id;
                //$item_id=1;
                if(!is_null($request->input('material_files')[0]))
                {
                    
                    $material_files=$request->input('material_files'); 
                    $material_files=explode(",",$material_files[0]);
                    foreach(array_filter($material_files) as $material_file){
                        $data=array(
                              'value'=>  rtrim($material_file,','),
                              'media_type'=>'pdf'
                        );
                        $media_info=Media::create($data);
                        $media_item_data=array(
                            'item_id'=>$item_id,
                            'media_id'=>$media_info->media_id
                        );
                        $media_items[]=$media_item_data;

                    }     
                }
                if(!is_null($request->input('videos')[0]))
                {
                    
                    foreach($videos as $video){
                        $video_data=array(
                              'value'=>  $video,
                              'media_type'=>'video'
                        );
                        $media_info=Media::create($video_data);
                        $media_item_data=array(
                            'item_id'=>$item_id,
                            'media_id'=>$media_info->media_id
                        );
                        $media_items[]=$media_item_data;
                    }
                }
                if(isset($contibutors)){

                    foreach($contibutors as $contibutor){

                        $contributor_data=array(
                              'item_id'=>  $item_id,
                              'contributor_id'=> $contibutor
                        );
                        
                        $media_info=ItemContributorRelation::create($contributor_data);
                    }     
                    
                }

                MediaItemRelation::insert($media_items);
            }

            $request->session()->flash('messageClass', 'alert alert-success');
            $request->session()->flash('message', 'Material successfully added');
            
            return redirect()->intended(route('createMaterial'))->with('messageClass', 'alert alert-success')
                            ->with('message', 'Material successfully added');

        }
        else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }

    }

    public function editItem(Request $request, $id) 
    { 
        if (Auth::guard('admins')->check()) {

            
            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'materials';

           $data_msg['contributors']=DB::table('users')
                        ->join('contributors as ct','ct.user_id','users.id')
                        ->select('users.id', 'ct.*', 'users.name', 'users.is_approved','users.status')
                        ->where([
                        'users.user_type_id'=>3,
                        'users.status'=>1
                        ])->get();

            $data_msg['items']=DB::table('items as item')
                        ->join('media_item_relations as mir','mir.item_id','item.item_id')
                        ->rightJoin('media as media','media.media_id','mir.media_id')
                        ->select('item.name','item.status','item.item_id','mir.relation_id','media.value','media.media_type','mir.media_id')
                        ->where('item.item_id',$id)
                        ->get();

            $data_msg['material_item']=Item::find($id);            
            $results=ItemContributorRelation::select('contributor_id')
                                        ->where('item_id',$id)->get();

             $data_msg['s_contributors']=array();           
            foreach ($results as $item) {
                array_push( $data_msg['s_contributors'],$item->contributor_id);
            }
            

            return view('admin.courses.items.edit', $data_msg);
            
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    
    public function ajaxItemImageList(Request $request, $hotel_id)
    {
        if ($request->ajax())
        {
            $arrSearch[] = ['hotel_images.status', '<>', '3'];
            $arrSearch[] = ['hotel_images.hotel_id', $hotel_id];
            $listData = DB::table('hotel_images')->select('image_name', 'ordering', 'is_default', 'id')
                    ->where($arrSearch);
            $listData = $listData->get();
            $iTotalRecords = count($listData);
            
            $iDisplayLength = intval($_REQUEST['length']);
            $iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
            $iDisplayStart = intval($_REQUEST['start']);
            $sEcho = intval($_REQUEST['draw']);
            
            $records = array();
            $records["data"] = array();
            
            $end = $iDisplayStart + $iDisplayLength;
            $end = $end > $iTotalRecords ? $iTotalRecords : $end;

            $order = $request->input('order');

            $column = array('image_name', 'ordering', 'is_default', 'action');


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

            $myFunctions = new myFunctions;
            
            $listData_1 = DB::table('hotel_images')->select('image_name', 'ordering', 'is_default', 'id', 'hotel_id')
                    ->where($arrSearch);

            $listData_1 = $listData_1->orderBy($column_name, $asc_desc)
                    ->skip($iDisplayStart)
                    ->take($iDisplayLength)
                    ->get();

            foreach ($listData_1 as $t)
            {
                $preview_img = $myFunctions->hotelImage($t->image_name, 'preview');
                $thumb_img = $myFunctions->hotelImage($t->image_name, 'thumb');
                
                $default_checked = "";

                $arr_access = unserialize(Auth::guard('admins')->user()->access);
                if ((is_array($arr_access) && in_array(3, $arr_access))) {
                    $button = '<a href="javascript:delete_image(' . $t->id . ');" class="btn btn-default btn-sm"><i class="fa fa-times"></i> Remove </a>';
                    if ($t->is_default) {
                        $default_checked = "checked";
                        $button = "";
                    }
                    $order = '<input type="text" class="form-control" rel="' . $t->ordering . '" id="image_order_' . $t->id . '"  value="' . $t->ordering . '" onblur="set_image_order(' . $t->id . ')" >';
                    $base = '<label><input type="radio" onclick="set_image_default(' . $t->id . ')" class="image-set-default" name="image_default[]" value="' . $t->id . '" ' . $default_checked . '> </label>';
                } else {
                    $button = '';
                    if ($t->is_default) {
                        $default_checked = "Default";
                        $button = "";
                    }
                    $order = $t->ordering;
                    $base = $default_checked;
                }


                /* $default_checked = "";
                  $action = '<a href="javascript:delete_image(' . $t->id . ');" class="btn btn-default btn-sm"><i class="fa fa-times"></i> Remove </a>';
                  if ($t->is_default) {
                  $default_checked = "checked";
                  $action = "";
                  } */

                $records["data"][] = array(
                    '<a href="' . $preview_img . '" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="' . $thumb_img . '" alt=""> </a>',
                    $order,
                    $base,
                    $button,
                );
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;
            echo json_encode($records);
            exit;
        }
    }
    
    public function ajaxItemImageUpload(Request $request)
    {
        if($request->hasFile('file'))
        {
            $mate_pic = $request->file('file');
            $mate_pic_name=ImageHelper::savePdfForGallery($mate_pic,config('disk.get_material'));
            
            //$myFunctions->upload_file($mate_pic, config('path.absolute_path') . config('path.material_image'), $mate_pic_name);
            $answer = array('result' => 'OK','file_name' => $mate_pic_name);
        } else {
            $answer = array('result' => 'FAILED');
        }
        $json = json_encode($answer);
        echo $json;
        exit;
    }

    public function downloadItem($media_id) {
       //dd(Auth::check());
        if (Auth::guard('admins')->check()) {

           
            $media_info=Media::find($media_id);
            $pathToFile = $path = storage_path('uploads/materials/') . $media_info->value;
            return response()->download($pathToFile, $media_info->value);
        } else {
            return redirect()->intended('/login');
        }
    }

    public function editItemAction(Request $request,$id)
    {   
        //return $request;
        if (Auth::guard('admins')->check()) {
            $media_items=array();
            
            $name=$request->input('g_name');
            $status=$request->input('status');
            $contibutors=$request->input('contibutors');

            $item_data=Item::find($id);
            $item_data->name=$name;
            $item_data->status=$status;

            $item=$item_data->save();
            
            if($item){
                $item_id=$id;
                
                if(!is_null($request->input('material_files')[0]))
                { 
                   $media_items=$this->saveMaterials($request,$item_id);
                }
                if(!is_null($request->input('delete_materials')[0]))
                { 
                   $this->deleteMaterials($request->input('delete_materials')[0]);
                }
                if(!is_null($request->input('videos')[0]))
                {
                   $media_items=$this->saveVideos($request,$item_id);
                }
                if(isset($contibutors)){
                    $this->saveContributors($request,$item_id);
                }
            }

            $request->session()->flash('messageClass', 'alert alert-success');
            $request->session()->flash('message', 'Material successfully updated');
            
            return redirect()->intended(route('editMaterial',['id'=>\Hasher::encode($item_id)]))->with('messageClass', 'alert alert-success')
                            ->with('message', 'Material  successfully updated');
        }
        else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function saveItems($request,$item_id=""){
        $material_files=$request->input('material_files'); 

        $material_files=explode(",",$material_files[0]);

        foreach(array_filter($material_files) as $material_file){
            $data=array(
                  'value'=>  rtrim($material_file,','),
                  'media_type'=>'pdf'
            );
            $media_info=Media::create($data,$data);
            $media_item_data=array(
                'item_id'=>$item_id,
                'media_id'=>$media_info->media_id
            );
            $media_items[]=$media_item_data;
                MediaItemRelation::insert($media_items);


        }    
        return $media_items;
    }

    private function saveVideos($request,$item_id){
        $videos=$request->input('videos');
        //$deletedRows = MediaItemRelation::where('item_id', $item_id)->delete();
        foreach($videos as $video){
            $video_data=array(
                  'value'=>  $video,
                  'media_type'=>'video'
            );
            Media::where($video_data)->delete();

            $media_info=Media::create($video_data,$video_data);
            $media_item_data=array(
                'item_id'=>$item_id,
                'media_id'=>$media_info->media_id
            );
           
            MediaItemRelation::create($media_item_data);

        }
        

    }

    private function saveContributors($request,$item_id){
        $contibutors=$request->input('contibutors');
        $deletedRows = ItemContributorRelation::where('item_id', $item_id)->delete();
        foreach($contibutors as $contibutor){

            $contributor_data=array(
                  'item_id'=>  $item_id,
                  'contributor_id'=> $contibutor
            );
            
            $media_info=ItemContributorRelation::create($contributor_data);
        }     
    }
    
    public function ajaxRemovePdffile(Request $request)
    {
        if ($request->ajax())
        {
            $mate_pic = $request->input('mat_file_name');
            $mate_remove = ImageHelper::removePdfMaterial($mate_pic,config('disk.get_material'));
            if($mate_remove)
            {
                $answer = array('result' => 'OK');
            }
            else
            {
                $answer = array('result' => 'FAILED');
            }
        } else {
            $answer = array('result' => 'FAILED');
        }
        $json = json_encode($answer);
        echo $json;
        exit;
    }

    private function deleteItems($materials){
        $materials=explode(",",$materials);
        
        foreach(array_filter($materials) as $material){
            $file_info=Media::where('media_id',$material)->first();
            $media_name=$file_info->value;

            $data=array(
                  'media_id'=> rtrim($material,","),

            );
            
            $deletedRows = Media::where($data)->delete();
            $file='uploads/materials/'.$media_name;
            $exists= Storage::exists($file);
            if($deletedRows && $exists){
                unlink(storage_path('uploads/materials/'.$media_name));

            }
            

        }     
    }



   
}
