<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\library\encryptDecrypt;
use App\library\myFunctions;
use App\Product;
use App\ProductContributorItemRelation;
use App\ItemContributorRelation;

use App\Item;
use App\Video;
use App\ProductVideoRelation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Storage;
use App\Helpers\ImageHelper;
use App\ExamPaperMaterialMaster;
use App\ExamMaster;
use App\SubjectMaster;
use App\MaterialMaster;
use App\PaperMaster;
use App\CourseExamPaperRelation;
use App\CourseStructureRelation;
use App\CourseSubjectRelation;
use App\CourseExamPaperSubjectRelation;
use Str;

class ProductController extends Controller
{
    public function __construct()
    {
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

    public function listCourse()
    {
        $data_msg = array();
        if (Auth::guard('admins')->check()) {
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'course';
            $data_msg['allProducts'] = Product::where('status', 1)->orderBy('name', 'Asc')->get();

            $data_msg['allExams'] = ExamMaster::where('status', '<>', '3')
                ->orderBy('exam_name', 'desc')->get();


            $data_msg['allPapers'] = DB::table('paper_masters as pm')
                ->join('exam_masters as em', 'pm.exam_id', 'em.id')
                ->select('pm.id', 'pm.paper_name', 'em.exam_name')
                ->get();
            $data_msg['allsubjects'] = SubjectMaster::where('status', 1)
                ->orderBy('subject_name', 'Asc')
                ->get();
            //$data_msg["masterList"] = Item::orderBy('updated_at', 'desc')->get();
            return view('admin.courses.products.list', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addCourse()
    {
        if (Auth::guard('admins')->check()) {

            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'course';

            $data_msg['items'] = Item::where('status', 1)->get();
            $data_msg['contributors'] = DB::table('users')
                ->join('contributors as ct', 'ct.user_id', 'users.id')
                ->select('users.id', 'ct.*', 'users.name', 'users.is_approved', 'users.status')
                ->where([
                    'users.user_type_id' => 3,
                    'users.status' => 1
                ])->get();


            $data_msg['videos'] = Video::where('status', 1)->get();
            $data_msg['exam_paper_materials'] = $papers = DB::table('exam_paper_material_relations AS epmr')
                ->select('epmr.id', 'E.exam_name', 'pm.paper_name', 'epmr.paper_id', 'epmr.created_at', 'epmr.status', 'epmr.material_list')
                ->join('exam_masters as E', 'E.id', 'epmr.exam_id')
                ->join('paper_masters as pm', 'epmr.paper_id', 'pm.id')
                ->get();
            $data_msg['subjects'] = SubjectMaster::where('status', 1)->get();

            $data_msg['allMaterials'] = MaterialMaster::where('status', 1)->get();
            $data_msg['allExams'] =  ExamMaster::where('status', 1)->get();
            $data_msg['allPapers'] =  PaperMaster::where('status', 1)->get();
            $data_msg['allSubjects'] = SubjectMaster::where('status', 1)->get();
            // dd($data_msg);
            return view('admin.courses.products.add', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function addCourseAction(Request $request)
    {

        if (Auth::guard('admins')->check()) {
            try {
                //Product Table data
                $name = $request->input('g_name');
                $short_description = $request->input('s_description');
                $intro_text = $request->input('intro_text');
                $description = $request->input('description');
                $important_notice = $request->input('important_notice');
                $course_price = $request->input('course_price');
                $revised_price = $request->input('revised_price');
                $no_of_students = $request->input('no_of_students');

                $revised_percent = $request->input('revised_percent');
                $d_p_d = explode('/', $request->input('start_date'));
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $str = $d_p_d_m;

                $d_p_d = explode('/', $request->input('end_date'));
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $end_date = $d_p_d_m;

                $start_date = date('Y-m-d', strtotime($str));
                $end_date = date('Y-m-d', strtotime($end_date));

                // $start_date=date('Y-m-d H:i:s',strtotime($request->input('start_date')));
                // $end_date=date('Y-m-d H:i:s',strtotime($request->input('end_date')));
                $meta_key = $request->input('meta_key');
                $meta_title = $request->input('meta_title');
                $img_alt = $request->input('img_alt');
                $meta_description = $request->input('meta_description');
                $meta_robots = $request->input('meta_robots');
                $is_popular = $request->input('is_popular');
                $is_combo = $request->input('is_combo');
                $home_slider = $request->input('home_slider');
                $is_reseller_charge = $request->input('is_reseller_charge');
                $slug = $request->input('slug') != "" ? Str::slug($request->input('slug')) : Str::slug($name, '-');
                $is_preview = $request->input('is_preview');
                $preview_main_course = isset($request->preview_main_course)?$request->preview_main_course:'';

                $slug_count = Product::where('slug', $slug)->count();
                if ($slug_count > 0) {
                    return redirect()->intended(route('createCourse'))->with('messageClass', 'alert alert-danger')
                        ->with('message', 'Course slug is duplicate.');
                }


                $filename = "";

                if ($request->hasFile('image')) {
                    $filename = $this->uploadImage($request);
                }

                $product_data = array(
                    'name' => $name,
                    'short_description' => $short_description,
                    'intro_text' => $intro_text,
                    'description' => $description,
                    'price' => $course_price,
                    'revised_price' => $revised_price,
                    'no_of_students' => $no_of_students,

                    'revised_percent' => $revised_percent,
                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'is_popular' => $is_popular,
                    'is_combo' => $is_combo,
                    'home_slider' => $home_slider,
                    'is_reseller_charge' => $is_reseller_charge,
                    'important_notice' => $important_notice,
                    'meta_key' => $meta_key,
                    'img_alt' => $img_alt,
                    'meta_title' => $meta_title,
                    'meta_description' => $meta_description,
                    'meta_robots' => $meta_robots,
                    'slug' => $slug,
                    'is_preview' => $is_preview,
                    'preview_main_course' => $preview_main_course,
                    'image' => $filename,
                );
                DB::beginTransaction();

                try {
                    $product_info = Product::create($product_data);

                   
                    if ($request->has('exam_id')) {
                        $product_id = $product_info->product_id;
                        $this->saveCourseSubject($request, $product_id);
                        $this->saveCourseExamPaper($request, $product_id);
                        $this->saveCourseStructure($request, $product_id);
                        $this->saveCourseExamPaperSubject($request, $product_id);
                        
                    }

                    if ($product_info && $request->has('video')) {
                        $product_id = $product_info->product_id;
                        $this->saveProductVideo($request, $product_id);
                    }
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->intended(route('createCourse'))
                        ->withErrors($e->getMessage())->withInput();
                }


                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Course successfully added');

                return redirect()->intended(route('courses'))->with('messageClass', 'alert alert-success')
                    ->with('message', 'Course successfully added');
            } catch (\Exception $e) {

                return redirect()->intended(route('createCourse'))
                    ->withErrors($e->getMessage())->withInput();
            }
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }



    private function saveProductContributorItem($request, $product_id)
    {
        $items = $request->input('item_id');
        $contributor = $request->input('contributor');
        $price = $request->input('price');


        try {

            for ($count = 0; $count < count($items); $count++) {


                $product_item_data = array(
                    'product_id' => $product_id,
                    'contributor_id' => $contributor[$count],
                    'item_id' => $items[$count],
                    'price' => $price[$count],
                );
                /*print_r($product_item_data);*/
                ProductContributorItemRelation::updateOrCreate($product_item_data, $product_item_data);
            }
            return;
        } catch (\Exception $e) {

            return redirect()->intended(route('createCourse'))
                ->withErrors($e->getMessage())->withInput();
        }
    }
    private function saveCourseSubject($request, $product_id)
    {
        //$subject_list=$request->input('subject_list');
        try {
            $checkdataExist = CourseSubjectRelation::where('product_id', $product_id)->count();


            if ($checkdataExist > 0) {
                CourseSubjectRelation::where('product_id', $product_id)->delete();
            }
            $paper_list = $request->paper_list;
            $exam_id = $request->exam_id;
            $temp_arr = [];
            foreach ($paper_list as $key => $val) {

                $subject_list = $request->input('subject_list' . $val);
                $temp_arr = array_merge($temp_arr, $subject_list);
            }
            $exam_subjects = array_unique($temp_arr);

            foreach ($exam_subjects as $exam_sub) {
                $course_exam_subject_data = array(
                    'product_id' => $product_id,
                    'exam_id' => $exam_id,
                    'subject_id' => $exam_sub

                );
                CourseSubjectRelation::create($course_exam_subject_data);
            }

            
            return;
        } catch (\Exception $e) {

            return redirect()->intended(route('createCourse'))
                ->withErrors($e->getMessage())->withInput();
        }
    }
    private function saveCourseExamPaper($request, $product_id)
    {
        $paper_list = $request->input('paper_list');
        $exam_id = $request->input('exam_id');
        try {
            $checkdataExist = CourseExamPaperRelation::where('product_id', $product_id)->count();
            if ($checkdataExist > 0) {
                CourseExamPaperRelation::where('product_id', $product_id)->delete();
            }

            for ($count = 0; $count < count($paper_list); $count++) {
                $product_item_data = array(
                    'product_id' => $product_id,
                    'exam_id' => $exam_id,
                    'paper_id' => $paper_list[$count]
                );
                CourseExamPaperRelation::updateOrCreate($product_item_data, $product_item_data);
            }
            return;
        } catch (\Exception $e) {

            return redirect()->intended(route('createCourse'))
                ->withErrors($e->getMessage())->withInput();
        }
    }
    private function saveCourseExamPaperSubject($request, $product_id)
    {
        $paper_list = $request->input('paper_list');
        $exam_id = $request->input('exam_id');
        
       $product_item_data = $subject_list=[];
        
       
        try {
            $checkdataExist = CourseExamPaperSubjectRelation::where('product_id', $product_id)->count();
            if ($checkdataExist > 0) {
                CourseExamPaperSubjectRelation::where('product_id', $product_id)->delete();
            }

            foreach ($paper_list as $key => $val) {
                $sl = $request->input('subject_list' . $val);
                $subject_list = array_merge($subject_list, $sl);
                for($i=0;$i<count($sl);$i++){

                    $product_item_data = array(
                        'product_id' => $product_id,
                        'exam_id' => $exam_id,
                        'paper_id' => $val,
                        'subject_id' => $sl[$i],
                    );
                    CourseExamPaperSubjectRelation::create($product_item_data, $product_item_data);
                }
            }
                //dd($product_item_data);
            return;
        } catch (\Exception $e) {

            return redirect()->intended(route('createCourse'))
                ->withErrors($e->getMessage())->withInput();
        }
    }
    private function saveCourseStructure($request, $product_id)
    {
        $exam_id = $request->exam_id;
        $paper_list = $request->paper_list;
        $price = $request->course_price;

        $course_data = $paper = $papermaterial = [];
        foreach ($paper_list as $key => $val) {
            //$paper[$val]=$request->input('material_list'.$val);
            $material_list[] = $request->input('material_list' . $val);
            $subject_list[] = $request->input('subject_list' . $val);

            $paper[$val] = array_merge($material_list, $subject_list);
            $material_list = [];
            $subject_list = [];
            $papermaterial[$val] = $request->input('all_material' . $val);
        }
        //echo "<pre>";
        $course_data[$exam_id] = $paper;
        $course_subject[$exam_id] = $request->input('subject_list');
        try {
            $checkdataExist = CourseStructureRelation::where('product_id', $product_id)->count();
            if ($checkdataExist > 0) {
                CourseStructureRelation::where('product_id', $product_id)->delete();
            }
            $product_item_data = array(
                'product_id' => $product_id,
                'course_data' => json_encode($course_data),
                'course_subject' => json_encode($course_subject),
                'paper_allmaterial' => json_encode($papermaterial),
                'price' => $price

            );
            // echo "<pre>";
            // print_r(json_encode($course_data));die;
            CourseStructureRelation::updateOrCreate($product_item_data, $product_item_data);

            return;
        } catch (\Exception $e) {

            return redirect()->intended(route('createCourse'))
                ->withErrors($e->getMessage())->withInput();
        }
    }

    public function ajaxCourseList(Request $request)
    {

        if ($request->ajax()) {
            $product_id = $request->input('product_id');
            //$request->session()->put('item_id', $item_id);

            $name = $request->product_name;

            //$request->session()->put('name', $name);

            $contributor_name = $request->input('contributor_name');
            //$request->session()->put('contributor_name', $contributor_name);

            $date_from = $request->input('date_from');
            //$request->session()->put('date_from', $date_from);

            $date_to = $request->input('date_to');
            //$request->session()->put('date_to', $date_to);

            $exam_id = $request->input('exam_id');
            $paper_id = $request->input('paper_id');
            $subject_id = $request->input('subject_id');
            //$request->session()->put('status', $status);
            $status = $request->input('status');

            $arrSearch[] = ['products.status', '<>', '3'];

            if ($product_id != '') {
                $arrSearch[] = ['products.product_id', $product_id];
            }
            if ($name != '') {
                $arrSearch[] = ['products.name', 'like', '%' . $name . '%'];
            }

            if ($date_from != '') {

                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;


                $arrSearch[] = ['products.start_date', '>=', $date_from];
            }

            if ($date_to != '') {

                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;

                $arrSearch[] = ['products.end_date', '<=', $date_to];
            }

            if ($status != '') {
                $arrSearch[] = ['products.status', $status];
            }
            if ($exam_id != '') {
                $arrSearch[] = ['cepr.exam_id', $exam_id];
            }
            if ($paper_id != '') {
                $arrSearch[] = ['cepr.paper_id', $paper_id];
            }
            if ($subject_id != '') {
                $arrSearch[] = ['csr.subject_id', $subject_id];
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

            if ($subject_id != '') {
                $items = DB::table('products')
                    ->select(
                        'products.name',
                        'products.start_date',
                        'products.end_date',
                        'products.product_id',
                        'products.status',
                        'cepr.exam_id',
                        'csr.subject_id',
                        'products.updated_at'
                    )
                    ->leftJoin('course_exam_paper_relations as cepr', 'products.product_id', 'cepr.product_id')
                    ->leftJoin('course_subject_relations as csr', 'products.product_id', 'csr.product_id')
                    ->groupBy('products.product_id')
                    ->where($arrSearch);
            } else {

                $items = DB::table('products')
                    ->select(
                        'products.name',
                        'products.start_date',
                        'products.end_date',
                        'products.product_id',
                        'products.status',
                        'cepr.exam_id',
                        'cepr.paper_id',
                        'products.updated_at'
                    )
                    ->leftJoin('course_exam_paper_relations as cepr', 'products.product_id', 'cepr.product_id')
                    ->groupBy('products.product_id')
                    ->where($arrSearch);
                //echo "sfsf";           
            }

            $items = $items->get();
            $iTotalRecords = count($items);
            //return $iTotalRecords;
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

            //$column = array( '#','products.product_id','name','cepr.exam_id','cepr.paper_id','csr.subject_id','products.start_date','products.end_date','status','action');
            $column = array('products.product_id', 'name', 'cepr.exam_id', 'cepr.paper_id', 'products.start_date', 'products.end_date', 'status', 'action');


            if ($order[0]['column'] != '') {
                $column_name = $column[$order[0]['column']];
            } else {
                $column_name = $column[4];

                //$column_name = 'products.updated_at';
            }

            if ($order[0]['dir'] != '') {
                $asc_desc = $order[0]['dir'];
            } else {
                $asc_desc = 'desc';
            }


            if ($subject_id != '') {
                $items_1 = DB::table('products')
                    ->select(
                        'products.name',
                        'products.start_date',
                        'products.end_date',
                        'products.product_id',
                        'products.status',
                        'cepr.exam_id',
                        'cepr.paper_id',
                        'csr.subject_id',
                        'products.updated_at'
                    )
                    ->leftJoin('course_exam_paper_relations as cepr', 'products.product_id', 'cepr.product_id')
                    ->leftJoin('course_subject_relations as csr', 'products.product_id', 'csr.product_id')
                    ->groupBy('products.product_id')
                    ->where($arrSearch);
            } else {
                $items_1 = DB::table('products')
                    ->select(
                        'products.name',
                        'products.start_date',
                        'products.end_date',
                        'products.product_id',
                        'products.status',
                        'cepr.exam_id',
                        'cepr.paper_id',
                        'products.updated_at'
                    )
                    ->leftJoin('course_exam_paper_relations as cepr', 'products.product_id', 'cepr.product_id')
                    ->groupBy('products.product_id')
                    ->where($arrSearch);
            }



            $items_1 = $items_1->orderBy($column_name, $asc_desc)
                ->skip($iDisplayStart)
                ->take($iDisplayLength)
                ->get();
            $sl = 1;
            foreach ($items_1 as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
                $course_infos = CourseStructureRelation::where('product_id', $t->product_id)->first();
                $relatedexam = '';
                $relatedPapers = array();
                $relatedSubjects = [];
                if ($course_infos) {
                    $course_data = json_decode($course_infos->course_data);
                    $course_subjects = json_decode($course_infos->course_subject);
                    $relatedexam = ExamMaster::find(key($course_data));
                    @$relatedexam = $relatedexam->exam_name;


                    foreach ($course_data as $exam) {
                        foreach ($exam as $key => $val) {
                            $paperinfo = PaperMaster::find($key);

                            $relatedPapers[] = @$paperinfo->paper_name;
                            $relatedmaterials[$key] = $val[0];
                            @$relatedSubjects[$key] = $val[1];
                        }
                    }
                    $allrelatedSubjects = [];
                    // foreach($relatedSubjects as $csubjects){
                    //     foreach($csubjects as $csubject){

                    //         $subjectinfo=SubjectMaster::find($csubject);
                    //         // if($subjectinfo){

                    //         //     $allrelatedSubjects[]=$subjectinfo->subject_name;
                    //         // }

                    //     }  
                    // }
                    $relatedPapers = implode(",<br>", $relatedPapers);
                    $allrelatedSubjects = implode(",<br>", $allrelatedSubjects);
                    //print_r($allrelatedSubjects);die;
                }

                $records["data"][] = array(
                    //$sl,
                    $t->product_id,
                    $t->name,
                    $relatedexam,
                    $relatedPapers,
                    //$relatedPapers,
                    //$allrelatedSubjects,
                    \Carbon\Carbon::parse($t->start_date)->format('d/m/Y'),
                    \Carbon\Carbon::parse($t->end_date)->format('d/m/Y'),
                    $status,
                    '<a href="' . route('editCourse', ['id' => \Hasher::encode($t->product_id)]) . '" class="btn btn-sm btn-default edit-btn margin-bottom-5"><i class="fa fa-edit"></i> Edit </a>
                    <a href="javascript:void(0)"  class="btn btn-sm btn-default remove-product edit-btn  confirmation" data-value="' . $t->product_id . '" ><i class="fa fa-trash"></i> Delete </a>
                    '
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
        $course_pic_name = ImageHelper::savePdfForGallery($uploadedFile, config('disk.get_course'));
        return $course_pic_name;
    }

    public function ajaxCourseMaterialList(Request $request)
    {
        $contributors = DB::table('item_contributor_relations as icr')
            ->join('contributors as ct', 'icr.contributor_id', 'ct.contributor_id')
            ->select('ct.firstname', 'ct.lastname', 'ct.contributor_id', 'icr.item_id')
            ->where('icr.item_id', $request->itemid)
            ->get();

        return $contributors;
    }
    public function ajaxEditCourseMaterialList(Request $request)
    {
        $contributors = DB::table('item_contributor_relations as icr')
            ->leftJoin('contributors as ct', 'icr.contributor_id', 'ct.contributor_id')
            ->leftJoin('product_contributor_item_relations as pci', function ($join) {
                $join->on('pci.contributor_id', '=', 'icr.contributor_id');
                $join->on('pci.item_id', '=', 'icr.item_id');
            })
            ->select('ct.firstname', 'ct.lastname', 'ct.contributor_id', 'icr.item_id', 'pci.price')
            ->where('icr.item_id', $request->itemid)
            ->where(function ($q) use ($request) {
                $q->where('pci.product_id', $request->product_id)
                    ->orWhereNull('pci.product_id');
            })
            ->get();

        // print_r($contributors);die;              
        $contributor_price = array();

        return $contributors;
    }


    private function saveProductVideo($request, $product_id)
    {
        $videos = $request->input('video');
        $video_data = array();

        foreach ($videos as $video) {
            $video_data[] = array(
                'product_id' => $product_id,
                'video_id' => $video,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
            );
        }

        ProductVideoRelation::insert($video_data);
    }

    public function editCourse(Request $request, $id)
    {

        if (Auth::guard('admins')->check()) {

            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'course';
            $data_msg['product'] = Product::find($id);

            $items = Item::where('status', 1)->get();

            $item_contributors = [];
            $product_contributor_item = [];
            foreach ($items as $item) {
                $item_contributor = DB::table('item_contributor_relations as icr')
                    ->join('contributors as ct', 'icr.contributor_id', 'ct.contributor_id')
                    ->select('ct.firstname', 'ct.lastname', 'ct.contributor_id', 'icr.item_id')
                    ->where('icr.item_id', $item->item_id)
                    ->get()->toArray();

                $product_contributor_item[] = ProductContributorItemRelation::where(['product_id' => $id, 'item_id' => $item->item_id])->count();

                $item_contributors[$item->name] = $item_contributor;
            }

            $data_msg['videos'] = Video::where('status', 1)->get();

            $data_msg['items'] = $item_contributors;
            $data_msg['product_contributor_item'] = $product_contributor_item;
            $related_videos = ProductVideoRelation::where(['product_id' => $id])->get();


            $product_videos = array();
            foreach ($related_videos as $related_video) {
                $product_videos[] = $related_video->video_id;
            }
            $data_msg['product_video'] = $product_videos;

            $data_msg['allMaterials'] = MaterialMaster::where('status', 1)->get();
            $data_msg['allExams'] =  ExamMaster::where('status', 1)->get();

            $course_infos = CourseStructureRelation::where('product_id', $id)->first();
            $data_msg['relatedexam'] = "";
            $data_msg['allPapers'] = $data_msg['relatedSubjects'] = [];
            if ($course_infos) {

                $course_data = json_decode($course_infos->course_data);
                $course_subjects = json_decode($course_infos->course_subject);
                $paper_allmaterial = json_decode($course_infos->paper_allmaterial);
                
                $data_msg['relatedexam'] = key($course_data);
                $data_msg['allSubjects'] = SubjectMaster::where('status', 1)->where('exam_id', key($course_data))->orderBy('sequence','asc')->get();

                $paperlist = DB::table('paper_masters AS pm')
                    ->select('pm.id as paper_id', 'E.exam_name', 'pm.paper_name')
                    ->join('exam_masters as E', 'E.id', 'pm.exam_id')
                    //->join('paper_masters as pm','epmr.paper_id','pm.id')
                    ->where('pm.exam_id', key($course_data))
                    ->where('pm.status', 1)
                    ->get();


                $exam_id = key($course_data);
                $material_array = array();

                foreach ($paperlist as $paper) {
                    $paper_id = $paper->paper_id;

                    $material_lists = ExamPaperMaterialMaster::where([
                        'exam_id' => $exam_id,
                        'paper_id' => $paper->paper_id,
                    ])->first();
                    if ($material_lists) {
                        $materials = explode(",", $material_lists->material_list);
                        foreach ($materials as $material) {
                            $materialinfo = MaterialMaster::where('id', $material)->where('status', 1)->first();
                            if ($materialinfo) {

                                $material_details = array(
                                    'material_name' => $materialinfo->material_name,
                                    'material_id' => $material,
                                    'paper_id' => $paper_id,
                                );
                                $material_array[] = $material_details;
                            }
                        }
                    }
                }

                $data_msg['allPapers'] = $paperlist;

                $material_array = $this->multi_unique($material_array);

                $relatedPapers = array();
                $relatedmaterials = array();
                $relatedSubjects = [];
                $selectallmaterial = $all_material_array = [];
                foreach ($course_data as $exam) {
                    foreach ($exam as $key => $val) {
                        $relatedPapers[] = $key;
                        $relatedmaterials[$key] = $val[0];
                        @$relatedSubjects[$key] = $val[1];
                    }
                }
                // dd($relatedSubjects);
                $paper_allmaterial = (array)$paper_allmaterial;
                $paper_allmaterial = array_filter($paper_allmaterial);
                foreach ($paper_allmaterial as $paper => $allmaterial) {



                    $all_material_array[$paper] = $allmaterial;
                }
                // echo "<pre>";

                // print_r($all_material_array);die;

                $data_msg['all_material_array'] = $all_material_array;
                $data_msg['relatedPapers'] = $relatedPapers;
                $data_msg['related_materials'] = $material_array;
                $data_msg['selectedmaterials'] = $relatedmaterials;
                $data_msg['relatedSubjects'] = $relatedSubjects;
                //dd($data_msg);
            }
            return view('admin.courses.products.edit', $data_msg);
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    public function editCourseAction(Request $request, $id)
    {


        if (Auth::guard('admins')->check()) {
            //try {

                // dd($request->all());    
                $product = Product::find($id);
                $product_id = $id;

                $this->saveCourseStructure($request, $product_id);
                $this->saveCourseExamPaperSubject($request, $product_id);
                


                $name = $request->input('g_name');
                $short_description = $request->input('s_description');
                $intro_text = $request->input('intro_text');
                $description = $request->input('description');
                $course_price = $request->input('course_price');
                $revised_price = $request->input('revised_price');
                $no_of_students = $request->input('no_of_students');

                $revised_percent = $request->input('revised_percent');

                $d_p_d = explode('/', $request->input('start_date'));
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $str = $d_p_d_m;

                $d_p_d = explode('/', $request->input('end_date'));
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $end_date = $d_p_d_m;

                $start_date = date('Y-m-d', strtotime($str));
                $end_date = date('Y-m-d', strtotime($end_date));
                $is_popular = $request->input('is_popular');
                $is_combo = $request->input('is_combo');
                $home_slider = $request->input('home_slider');
                $is_reseller_charge = $request->input('is_reseller_charge');
                $important_notice = $request->input('important_notice');
                $meta_key = $request->input('meta_key');
                $img_alt = $request->input('img_alt');

                $meta_title = $request->input('meta_title');
                $meta_description = $request->input('meta_description');
                $meta_robots = $request->input('meta_robots');
                $slug = $request->input('slug') != "" ? $request->input('slug') : Str::slug($name, '-');
                $is_preview = $request->input('is_preview');
                $preview_main_course = isset($request->preview_main_course)?$request->preview_main_course:'';
                $status = $request->input('status');

                //echo "<pre>";
                $exploded_meta = explode(',', $meta_key);
                foreach ($exploded_meta as $meta) {
                    $meta_slug[] = Str::slug($meta, '-');
                }
                $meta_key = implode(",", $meta_slug);
                // echo $meta_key;
                // die;
                //$slug=Str::slug($name, '-');
                $slug_count = Product::where('slug', $slug)->count();
                //dd($slug,$slug_count);
                if ($slug_count > 1) {
                    return redirect()->intended(route('editCourse', ['id' => \Hasher::encode($id)]))->with('messageClass', 'alert alert-danger')
                        ->with('message', 'Course slug is duplicate.');
                }



                $filename = $product->image;
                $exist_filename = $product->image;
                if ($exist_filename) {
                    ImageHelper::createThumbnail($exist_filename, config('disk.get_course'));
                }
                if ($request->hasFile('image')) {
                    $filename = $this->uploadImage($request);
                }

                $product_data = array(
                    'name' => $name,
                    'short_description' => $short_description,
                    'intro_text' => $intro_text,
                    'description' => $description,
                    'price' => $course_price,
                    'revised_percent' => $revised_percent,
                    'revised_price' => $revised_price,
                    'no_of_students' => $no_of_students,

                    'start_date' => $start_date,
                    'end_date' => $end_date,
                    'is_popular' => $is_popular,
                    'is_combo' => $is_combo,
                    'home_slider' => $home_slider,
                    'is_reseller_charge' => $is_reseller_charge,
                    'important_notice' => $important_notice,
                    'meta_key' => $meta_key,
                    'meta_title' => $meta_title,
                    'img_alt' => $img_alt,
                    'meta_description' => $meta_description,
                    'meta_robots' => $meta_robots,
                    'status' => $status,
                    'slug' => $slug,
                    'is_preview' => $is_preview,
                    'preview_main_course' => $preview_main_course,
                    'image' => $filename,
                );

                //return $product_data;
                DB::beginTransaction();

                try {
                    $product_info = $product->update($product_data);


                    //$this->updateProductContributorItem($request,$product_id);
                    $this->saveCourseSubject($request, $product_id);
                    $this->saveCourseExamPaper($request, $product_id);
                    $this->saveCourseStructure($request, $product_id);
                    $this->updateProductVideo($request, $product_id);

                    DB::commit();

                    if ($request->request_type == "duplicate") {
                        $slug_count = Product::where('slug', $slug)->count();
                        if ($slug_count > 1) {
                            return redirect()->intended(route('editCourse', ['id' => \Hasher::encode($id)]))->with('messageClass', 'alert alert-danger')
                                ->with('message', 'Course slug is duplicate.');
                        }
                        $newProductId = $this->saveAsDuplicate($request, $id);
                        $request->session()->flash('messageClass', 'alert alert-success');
                        $request->session()->flash('message', 'Course duplicated successfully');

                        return redirect()->intended(route('editCourse', ['id' => \Hasher::encode($newProductId)]))->with('messageClass', 'alert alert-success')
                            ->with('message', 'Course duplicated successfully');
                    }
                } catch (\Exception $e) {
                    DB::rollback();
                    return redirect()->intended(route('editCourse', ['id' => \Hasher::encode($id)]))
                        ->withErrors($e->getMessage())->withInput();
                }

                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Course successfully updated');

                return redirect()->intended(route('editCourse', ['id' => \Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
                    ->with('message', 'Course successfully updated');
            // } catch (\Exception $e) {

            //     return redirect()->intended(route('editCourse', ['id' => \Hasher::encode($id)]))
            //         ->withErrors($e->getMessage())->withInput();
            // }
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    private function multi_unique($src)
    {
        $output = array_map(
            "unserialize",
            array_unique(array_map("serialize", $src))
        );
        return $output;
    }

    private function updateProductContributorItem($request, $product_id)
    {
        $deleteProductContributor = ProductContributorItemRelation::where('product_id', $product_id)->delete();

        if ($request->has('item_id')) {
            $items = $request->input('item_id');
            $contributor = $request->input('contributor');
            $price = $request->input('price');


            for ($count = 0; $count < count($items); $count++) {


                $product_item_data = array(
                    'product_id' => $product_id,
                    'contributor_id' => $contributor[$count],
                    'item_id' => $items[$count],
                    'price' => $price[$count],
                );
                /*print_r($product_item_data);*/
                ProductContributorItemRelation::updateOrCreate($product_item_data, $product_item_data);
            }
            return;
        }
    }
    private function updateProductVideo($request, $product_id)
    {
        $delete_video = ProductVideoRelation::where('product_id', $product_id)->delete();
        if ($request->has('video')) {

            $videos = $request->input('video');
            $video_data = array();
            foreach ($videos as $video) {
                $video_data[] = array(
                    'product_id' => $product_id,
                    'video_id' => $video,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                );
            }

            ProductVideoRelation::insert($video_data);
        }
    }

    public function ajaxAddCourseExamPaper(Request $request)
    {
        $exam_id = $request->exam_id;
        // $paperlist = DB::table('exam_paper_material_relations AS epmr')
        //         ->select('epmr.id', 'E.exam_name','pm.paper_name', 'epmr.paper_id')
        //         ->join('exam_masters as E','E.id','epmr.exam_id')
        //         //->join('paper_masters as pm','epmr.paper_id','pm.id')
        //         ->where('epmr.exam_id',$exam_id)
        //         ->where('epmr.status',1)
        //         ->get();
        $paperlist = DB::table('paper_masters AS pm')
            ->select('pm.id as paper_id', 'E.exam_name', 'pm.paper_name')
            ->join('exam_masters as E', 'E.id', 'pm.exam_id')
            //->join('paper_masters as pm','epmr.paper_id','pm.id')
            ->where('pm.exam_id', $exam_id)
            ->where('pm.status', 1)
            ->get();

        return $paperlist;
    }
    public function ajaxAddCourseExamPaperMaterial(Request $request)
    {
        $exam_id = $request->exam_id;
        $paper_id = $request->paper_id;
        $material_lists = ExamPaperMaterialMaster::where([
            'exam_id' => $exam_id,
            'paper_id' => $paper_id,
        ])
            ->first();
        $data = [];
        if ($material_lists) {
            $materials = explode(",", $material_lists->material_list);
            $material_array = array();
            foreach ($materials as $material) {
                $materialinfo = MaterialMaster::where('id', $material)->where('status', 1)->first();
                if ($materialinfo) {
                    $material_details = array(
                        'material_name' => $materialinfo->material_name,
                        'material_id' => $material,
                        'paper_id' => $paper_id,
                    );
                    $material_array[] = $material_details;
                }
            }
            $data['material_array'] = $material_array;
            $data['allSubjects'] = SubjectMaster::where('status', 1)->where([
                    'exam_id'=>$request->exam_id,
                    'paper_id'=>$request->paper_id

                ])->orderBy('sequence','asc')->get();
            // $data['allSubjects']= SubjectMaster::where('status',1)->get();//

            $data['paper_id'] = $paper_id;
        }

        return response()->json($data);
        //return $paperlist;
    }

    public function ajaxCourseExamPaper(Request $request)
    {
        $exam_id = $request->exam_id;

        $data['paperlist'] = DB::table('paper_masters AS pm')
            ->select('pm.id as paper_id', 'E.exam_name', 'pm.paper_name')
            ->join('exam_masters as E', 'E.id', 'pm.exam_id')
            //->join('paper_masters as pm','epmr.paper_id','pm.id')
            ->where('pm.exam_id', $exam_id)
            ->where('pm.status', 1)
            ->get();
        $data['allSubjects'] = SubjectMaster::where('status', 1)->where('exam_id', $request->exam_id)->get();


        return response()->json($data);
    }

    public function saveAsDuplicate($request, $id)
    {
        $product = Product::find($id);
        $newProduct = $product->replicate();
        $newProduct->save();
        $newProductId = $newProduct->product_id;

        //$this->saveCourseSubject($request,$newProductId);
        $this->saveCourseExamPaper($request, $newProductId);
        $this->saveCourseStructure($request, $newProductId);
        $this->updateProductVideo($request, $newProductId);

        return $newProductId;
    }

    public function createSlug($title, $id = 0)
    {

        $slug = $title;
        $allSlugs = $this->getRelatedSlugs($slug, $id);
        if (!$allSlugs->contains('slug', $slug)) {
            return $slug;
        }
        echo "<pre>";
        print_r($allSlugs);
        die;

        $i = 1;
        $is_contain = true;
        do {
            $newSlug = $slug . '-' . $i;

            if (!$allSlugs->contains('slug', $newSlug)) {
                $is_contain = false;
                return $newSlug;
            }
            $i++;
        } while ($is_contain);
    }

    protected function getRelatedSlugs($slug, $id = 0)
    {
        $product = Product::select('slug')->where('slug', 'like', $slug . '%')
            ->where('product_id', '<>', $id)
            //->orderBy('product_id',desc)
            ->get();
        return $product;
    }

    public function ajaxProductDelete(Request $request)
    {
        $response = [
            'status' => 0,
            'message' => 'Something went wrong.'
        ];
        try {

            $product_id = $request->product_id;

            $result = Product::where('product_id', $product_id)->delete();
            if ($result) {
                $response = [
                    'status' => 1,
                    'message' => 'success'
                ];
            }
            return json_encode($response);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == 23000) {
                $response = [
                    'status' => 0,
                    'message' => 'Sorry, Course cannot be deleted.',

                ];
                return json_encode($response);
            }
            $response = [
                'status' => 0,
                'message' => $e->errorInfo,
                'code' => $e->getCode()
            ];
            return json_encode($response);
        }
    }

    public function ajaxPreviewMainCourse(Request $request)
    {
        $myFunction= new \App\library\myFunctions();
        $exam_id=$request->exam_id;
        $paper_id=$request->paper_id;
        $allCourses=$myFunction->getCourses($exam_id,$paper_id);

        $html='<label class="control-label">Preview Main Course <span class="required"> * </span></label>
        <select name="preview_main_course" id="preview_main_course"
        class="form-control">';
        $html.='<option value="">Select Main Course</option>';
        foreach ($allCourses as $course) {
            if(!empty($course->product)){
                $html.='<option value="'.$course->product->product_id.'">';
                $html.= $course->product->name;
                $html.='</option>';
            }
        }
        $html.='</select>';

        return $html;
    }
}
