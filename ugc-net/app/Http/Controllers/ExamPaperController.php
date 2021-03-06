<?php

namespace App\Http\Controllers;

use Validator;
use Mail;
use App\Admin;
use App\User;

use App\ExamMaster;
//use App\ModulesAction;
use Hasher;

use App\MaterialMaster;
use App\ExamPaperMaterialMaster;
use App\ExamPaperMaterialContributor;
use App\ExamPaperMaterialContent;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\library\myFunctions;
use App\PaperMaster;
use App\Helpers\ImageHelper;
use App\Media;


class ExamPaperController extends Controller {

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

    public function showExamPaperList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'products';
            $menu_child = 'exam_paper';
			$allExams = ExamMaster::where('status', '<>', '3')
                            ->orderBy('exam_name', 'desc')->get();
            // $allPapers=PaperMaster::where('status',1)
            //             ->orderBy('paper_name', 'desc')
            //             ->get();

            $allPapers=DB::table('paper_masters as pm')
                        ->join('exam_masters as em','pm.exam_id','em.id')
                        ->select('pm.id','pm.paper_name','em.exam_name')
                        ->get();
            $allmaterials=MaterialMaster::where('status',1)
                        ->orderBy('material_name', 'desc')
                        ->get();
            
           
            return view('admin.courses.exam.exam_paper.list', compact('menu_parent', 'menu_child','allExams','allPapers','allmaterials'));
			
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxExamPaperList(Request $request) {

        if ($request->ajax()) {

            $exam_id = $request->input('exam_id');
            $paper_id = $request->input('paper_id');
            $material_id = $request->input('material_id');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['epmr.status', '<>', '3'];

            if ($exam_id != '') {
                $arrSearch[] = ['epmr.exam_id', 'like', '%' . $exam_id . '%'];
            }

            if ($paper_id != '') {
                $arrSearch[] = ['epmr.paper_id', 'like', '%' . $paper_id . '%'];
            }
            if ($date_from != '') {
                
                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;
                
                $arrSearch[] = ['epmr.created_at', '>=', $date_from];
            }
            
            if ($date_to != '') {
                
                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;
                
                $arrSearch[] = ['epmr.created_at', '<=', $date_to];
            }
            
            
            if ($status != '') {
                $arrSearch[] = ['epmr.status', $status];
            }
            if ($material_id != '') {
                //$arrSearch[] = ['find_in_set', '(', '"' . $paper_id . '",epmr.material_list'];
            }
           // dd($arrSearch);
            
            /* if ($testimonial_type != '') {
                $arrSearch[] = ['testimonial_type', $testimonial_type];
            }*/
            $papers = DB::table('exam_paper_material_relations AS epmr')
                    ->select('epmr.id', 'E.exam_name','pm.paper_name', 'epmr.paper_id', 'epmr.created_at', 'epmr.status','epmr.material_list')
                    ->join('exam_masters as E','E.id','epmr.exam_id')
                    ->join('paper_masters as pm','epmr.paper_id','pm.id')
                    ->where(function($query) use($material_id){
                        if ($material_id != '') {
                            $query->orWhereRaw("find_in_set($material_id,epmr.material_list)");
                        }
                    })                    
                    ->where($arrSearch);

            //$coupons = $coupons->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $papers->count();
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
            
            $column = array('#', 'E.exam_name', 'epmr.paper_name','epmr.material_list' ,'epmr.created_at', 'epmr.status', 'action');


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

            $papers = $papers->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            //dd($papers);
            foreach ($papers as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
                $material_lists=explode(',',$t->material_list);
                $allmaterials=array();
                foreach($material_lists as $material_list){
                    $material=MaterialMaster::find($material_list);

                    $allmaterials[]=@$material->material_name;

                }
                $related_materials= implode(",<br>",$allmaterials);            
                $records["data"][] = array(
                    $sl,
                    $t->exam_name,
                    $t->paper_name,
                    $related_materials,
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),                                        
                    $status,
                    '<a href="' .route('editExamPaper',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
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
            'exam_id' => 'required',
            'paper_id' => 'required',
            'material_list' => 'required',
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

    public function createExamPaper(Request $request) {
        $data_msg = array();
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'exam_paper';
            $data_msg['allMaterials']=MaterialMaster::where('status',1)->get();
            $data_msg['allExams']=  ExamMaster::where('status',1)->get();     
            $data_msg['allPapers']=  PaperMaster::where('status',1)->get();     
            if ($request->method() === "POST") {
                //return  $request;

                $exam = $request->input('exam');
                $paper = $request->input('paper');
                $material_list = $request->input('material_list');
                $status = $request->input('status');

                $data_check = array(					
                    'exam_id' => $exam,
                    'paper_id' => $paper,
                    'material_list' => implode(",",$material_list),
                    
                );
                $checkExists=ExamPaperMaterialMaster::where($data_check)->exists();
                if($checkExists){
                    $request->session()->flash('messageClass', 'alert alert-danger');
                    $request->session()->flash('message', 'Exam Paper Material Combination is already exists');
                    
                    return redirect()->intended(route('createExamPaper'))->with('messageClass', 'alert alert-danger')
                                    ->with('message', 'Exam Paper Material Combination is exists')->withInput();
                }
                $data_exam_details = array(					
                    'exam_id' => $exam,
                    'paper_id' => $paper,
                    'material_list' => implode(",",$material_list),
                    'status'=>$status
                );
                //return $data_exam_details;
               				
                $validator = $this->validatorRegisterGeneral($data_exam_details);
                
                if ($validator->fails()) {
                    $val = $validator->errors();
                   // dd($val);
                    return redirect()->intended(route('createExamPaper'))->withErrors($val)->withInput();
                }
				ExamPaperMaterialMaster::create($data_exam_details);
                             
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Exam Paper Material successfully added');
                
                return redirect()->intended(route('exam-paper'))->with('messageClass', 'alert alert-success')
                                ->with('message', 'Exams Paper Material successfully added');
            }
			
            return view('admin.courses.exam.exam_paper.create', $data_msg);
							
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editExamPaper(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
			
            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'exam_paper';

            $exam = ExamPaperMaterialMaster::where('status','<>',3)->where(['id'=> $id])->first();
            //return $exam;
            $exam_id=$exam->exam_id;
            $paperlist=PaperMaster::where('exam_id',$exam_id)
                    ->where('status',1)
                    ->get();
            
            $data_msg["relatedexam"] = $exam;
            
            $data_msg['allMaterials']=MaterialMaster::where('status',1)->get();
            $data_msg['allExams']=  ExamMaster::where('status',1)->get();     
            $data_msg['allPapers']=  $paperlist;
            $data_msg['related_materials']=explode(',',$exam->material_list);

        
            
			
            return view('admin.courses.exam.exam_paper.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editExamPaperAction(Request $request, $id) {

        $data = $request->all();
        
        
        
        $exam_paper_material =  ExamPaperMaterialMaster::where(['id'=> $id])->first();
        
        $exam_paper_material->exam_id = $request->input('exam');
        $exam_paper_material->paper_id = $request->input('paper');
        $exam_paper_material->material_list = $request->input('material_list');
        $exam_paper_material->status = $request->input('status');
        
        $data_exam_details = array(					
            'exam_id' => $exam_paper_material->exam_id,
            'paper_id' => $exam_paper_material->paper_id,
            'material_list' => implode(",",$exam_paper_material->material_list),
            'status' => $exam_paper_material->status
        );
             
         $exam_paper_material->update($data_exam_details);

       	
        return redirect()->intended(route('editExamPaper',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

    public function ajaxExamPaper(Request $request){
        $exam_id=$request->exam_id;

        $paperlist=PaperMaster::where('exam_id',$exam_id)
                ->where('status',1)
                ->get();
        return $paperlist;
    }

    public function ajaxExamPaperUnits(Request $request){
        $exam_id=$request->exam_id;
        $paper_id=$request->paper_id;

        $units=\App\SubjectMaster::where('exam_id',$exam_id)
                ->where('paper_id',$paper_id)
                ->where('status',1)
                ->orderBy('sequence','asc')
                ->get();

        $html="<option value=''>Select</option>";        
        foreach ($units as $unit) {
            $html.="<option value='".$unit->id."'>".$unit->subject_name."</option>";  
        }

        return $html;
    }

    public function showExamPaperMaterialContentList() {

        if (Auth::guard('admins')->check()) {
			
            $menu_parent = 'products';
            $menu_child = 'exam_paper_material_content';
			$allExams = ExamMaster::where('status', '<>', '3')
                            ->orderBy('exam_name', 'desc')->get();
            
            $allPapers=DB::table('paper_masters as pm')
                        ->join('exam_masters as em','pm.exam_id','em.id')
                        ->select('pm.id','pm.paper_name','em.exam_name')
                        ->get();
            $allmaterials=MaterialMaster::where('status',1)
                        ->orderBy('material_name', 'desc')
                        ->get();
            $allSubjects=\App\SubjectMaster::where('status',1)->get();
            
            
           
            return view('admin.courses.exam.exam_paper_material_content.list', compact('menu_parent', 'menu_child','allExams','allPapers','allmaterials','allSubjects'));
			
				
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function ajaxExamPaperMaterialContentList(Request $request) {

        if ($request->ajax()) {

            $exam_id = $request->input('exam_id');
            $paper_id = $request->input('paper_id');
            $subject_id = $request->input('subject_id');
            $material_id = $request->input('material_id');
            $date_from = $request->input('date_from');
            $date_to = $request->input('date_to');
            $status = $request->input('status');

            $arrSearch[] = ['epmr.status', '<>', '3'];

            if ($exam_id != '') {
                $arrSearch[] = ['epmr.exam_id', 'like', '%' . $exam_id . '%'];
            }

            if ($paper_id != '') {
                $arrSearch[] = ['epmr.paper_id', 'like', '%' . $paper_id . '%'];
            }
            if ($subject_id != '') {
                $arrSearch[] = ['epmr.subject_id', 'like', '%' . $subject_id . '%'];
            }
            if ($date_from != '') {
                
                $d_p_d = explode('/', $date_from);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_from = $d_p_d_m;
                
                $arrSearch[] = ['epmr.created_at', '>=', $date_from];
            }
            
            if ($date_to != '') {
                
                $d_p_d = explode('/', $date_to);
                $d_p_d_m = $d_p_d[2] . '-' . $d_p_d[1] . '-' . $d_p_d[0];
                $date_to = $d_p_d_m;
                
                $arrSearch[] = ['epmr.created_at', '<=', $date_to];
            }
            
            
            if ($status != '') {
                $arrSearch[] = ['epmr.status', $status];
            }
            if ($material_id != '') {
                $arrSearch[] = ['epmr.material_id', $material_id];
            }
            
           // dd($arrSearch);
            
            /* if ($testimonial_type != '') {
                $arrSearch[] = ['testimonial_type', $testimonial_type];
            }*/
            $papers = DB::table('exam_paper_material_content AS epmr')
                    ->select('epmr.id', 'E.exam_name','pm.paper_name', 'epmr.paper_id','epmr.subject_id','sm.subject_name',
                            'epmr.created_at','epmr.status','epmr.material_id','mm.material_name')
                    ->join('exam_masters as E','E.id','epmr.exam_id')
                    ->join('paper_masters as pm','epmr.paper_id','pm.id')
                    ->join('subject_masters as sm','epmr.subject_id','sm.id')
                    ->join('material_masters as mm','epmr.material_id','mm.id')
                    ->where($arrSearch);

            //$coupons = $coupons->get();

            //return $users;
            //$iTotalRecords = count($videos);
            $iTotalRecords = $papers->count();
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
            
            $column = array('#', 'E.exam_name', 'pm.paper_name','sm.subject_name','mm.material_name','epmr.status','epmr.created_at', 'action');


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

            $papers = $papers->orderBy($column_name, $asc_desc)
            ->skip($iDisplayStart)
            ->take($iDisplayLength)
            ->get();


            $myFunctions = new myFunctions;

            $sl = 1;
            //dd($papers);
            foreach ($papers as $t) {
                $status = '';
                if ($t->status == '1') {
                    $status = '<span class="label label-sm label-success"> Active </span>';
                } else {
                    $status = '<span class="label label-sm label-warning"> Inactive </span>';
                }
                $material_lists='';
                $allmaterials=array();
               
                $related_materials= implode(",",$allmaterials);            
                $records["data"][] = array(
                    $sl,
                    $t->exam_name,
                    $t->paper_name,
                    $t->subject_name,
                    $t->material_name,                    
                    \Carbon\Carbon::parse($t->created_at)->format('d/m/Y'),                                        
                    $status,
                    '<a href="' .route('editExamPaperMaterialContent',['id'=>Hasher::encode($t->id)]) . '" class="btn btn-sm btn-default"><i class="fa fa-edit"></i> Edit </a>'
                        
                );

                $sl++;
            }

            $records["draw"] = $sEcho;
            $records["recordsTotal"] = $iTotalRecords;
            $records["recordsFiltered"] = $iTotalRecords;


            echo json_encode($records);
        }
    }

    public function createExamPaperMaterialContent(Request $request) {
        $data_msg = array();
        
        if (Auth::guard('admins')->check()) {
            
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'exam_paper_material_content';
            $data_msg['allMaterials']=MaterialMaster::where('status',1)->get();
            $data_msg['allExams']=  ExamMaster::where('status',1)->get();     
            $data_msg['allPapers']=  PaperMaster::where('status',1)->get();  
            $data_msg['exam_paper_materials']= $papers = DB::table('exam_paper_material_relations AS epmr')
            ->select('epmr.id', 'E.exam_name','pm.paper_name', 'epmr.paper_id','epmr.exam_id', 'epmr.created_at', 'epmr.status','epmr.material_list')
            ->join('exam_masters as E','E.id','epmr.exam_id')
            ->join('paper_masters as pm','epmr.paper_id','pm.id')
            ->get();
            $data_msg['subjects']=\App\SubjectMaster::where('status',1)->get();
            
            
            if ($request->method() === "POST") {
                // dd($request->all());
                $exam_id = $request->input('exam_id');
                $paper_id = $request->input('paper_id');
                $material_id = $request->input('material_id');
                $subject_id = $request->input('subject_id');
                $contributor_list = $request->input('contributor_list');
                $price = $request->input('price');
                $videos = $request->input('videos');
                $videos_title = $request->input('videos_title');

                $material_content_files = $request->file('material_content_files');
                
                $i=0;
                
                $data_exam_details = array(					
                    'exam_id' => $exam_id,
                    'paper_id' => $paper_id,
                    'material_id' => $material_id,
                    'subject_id' => $subject_id,                   
                );
                $checkExists=ExamPaperMaterialContent::where($data_exam_details)->exists();
                //dd($checkExists);
                if($checkExists){
                    $request->session()->flash('messageClass', 'alert alert-danger');
                    $request->session()->flash('message', 'Exam Paper Material Content Combination is already exists');
                    
                    return redirect()->intended(route('createExamPaperMaterialContent'))->with('messageClass', 'alert alert-danger')
                                    ->with('message', 'Exam Paper Material Content Combination is already exists');
                }
                $exam_paper_material_content_id_create=ExamPaperMaterialContent::create($data_exam_details);
                $exam_paper_material_content_id=$exam_paper_material_content_id_create->id;
                
                if($request->has('contributor_list')){
                    foreach($contributor_list as $contributor){
    
                        $data_exam_details = array(	
                            'contributor_id' => $contributor,
                            'price' => $price[$i],
                            'exam_paper_material_content_id'=>$exam_paper_material_content_id
                        );
                        
                        ExamPaperMaterialContributor::create($data_exam_details);
                        $i++;
                    }
                }
                
                if($request->hasFile('material_content_files')){
                    
                    $count=0;
                    foreach($material_content_files as $uploadfile){
                        $uploadedFile = $material_content_files[$count];
                        $filename=ImageHelper::saveFileForGallery($uploadedFile,config('disk.get_material'));;
                        $data_media_details = array(
                            'value' => $filename,
                            'media_type'=>'pdf',
                            'exam_paper_material_content_id'=>$exam_paper_material_content_id
                            
                        );
                        Media::create($data_media_details);
                        $count++;
                    }
                }
                if($request->has('videos')){
                    $vcount=0;

                    foreach($videos as $video){
                        $data_media_details = array(
                            'title'=>$videos_title[$vcount],
                            'value' => $video,
                            'media_type'=>'video',
                            'exam_paper_material_content_id'=>$exam_paper_material_content_id
                            
                        );  
                        if(!empty($video)){
                            Media::create($data_media_details);   
                            $vcount++;

                            
                        }
                    }
                }
                
                $request->session()->flash('messageClass', 'alert alert-success');
                $request->session()->flash('message', 'Exam Paper Material successfully added');
                
                return redirect()->intended(route('exam-paper-material-content'))->with('messageClass', 'alert alert-success')
                ->with('message', 'Exams Paper Material successfully added');
            }
			
            return view('admin.courses.exam.exam_paper_material_content.create', $data_msg);
            
        } else {
            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }
    
    public function editExamPaperMaterialContent(Request $request, $id) {
        
        if (Auth::guard('admins')->check()) {
            // return $id;
            $data_msg = array();
            $data_msg['menu_parent'] = 'products';
            $data_msg['menu_child'] = 'exam_paper_material_content';
            
            $exam = ExamPaperMaterialContent::where('status','<>',3)->where(['id'=> $id])->first();

            $request->request->add(['subject_id' =>$exam->subject_id]);

            //$data_msg['allContributors']=$this->ajaxGetSubjectContributors($request);
            $allContributors=$this->ajaxGetSubjectContributors($request);

            //return $allContributors;
            $contributors=[];
            foreach($allContributors as $contributor){
                $users=User::find($contributor->user_id);
                if($users->status==1){
                    $contributors[]=$contributor;
                }
            }
            $data_msg['allContributors']=$contributors;
            //print_r($data_msg['allContributors']);die;

            $exam_id=$exam->exam_id;
            $paperlist=PaperMaster::where('exam_id',$exam_id)
            ->where('status',1)
            ->get();
            
            
            $data_msg['allMaterials']=MaterialMaster::where('status',1)->get();
            $data_msg['allExams']=  ExamMaster::where('status',1)->get();     
            $data_msg['allPapers']=  $paperlist;
            $data_msg['subjects']=\App\SubjectMaster::where('status',1)->get();
            $data_msg["relatedexam"] = $exam;
            $data_msg['material_contents']=Media::where('exam_paper_material_content_id',$id)->get();
            $contributors=DB::table('exam_paper_material_contributor AS epmr')
                        ->select('epmr.id','epmr.exam_paper_material_content_id',
                                'epmr.contributor_id', 'epmr.price','cont.firstname','cont.lastname','users.status')
                        ->join('contributors as cont','cont.contributor_id','epmr.contributor_id')
                        ->join('users','cont.user_id','users.id')
                        ->where('epmr.exam_paper_material_content_id',$id)
                        ->where('users.status',1)
                        ->get();
            $related_contributors=array();            
            foreach($contributors as $contributor){
                $related_contributors[]=$contributor->contributor_id;
            }

            $data_msg['relatedcontributors']=$related_contributors;
            //return $data_msg['relatedcontributors'];
            return view('admin.courses.exam.exam_paper_material_content.edit', $data_msg);
			
        } else {

            return redirect()->intended(config("constants.admin_prefix") . '/login');
        }
    }

    public function editExamPaperMaterialContentAction(Request $request, $id) {
        //die;
        //return $id;
        $data = $request->all();
        // dd($data);
        
        $exam_paper_material =  ExamPaperMaterialContent::where(['id'=> $id])->first();
        
        $exam_paper_material->exam_id = $request->input('exam_id');
        $exam_paper_material->paper_id = $request->input('paper_id');
        $exam_paper_material->material_id = $request->input('material_id');
        $exam_paper_material->subject_id = $request->input('subject_id');
        $exam_paper_material->status = $request->input('status');
        
        $data_exam_details = array(					
            'exam_id' => $exam_paper_material->exam_id,
            'paper_id' => $exam_paper_material->paper_id,
            'material_id' => $exam_paper_material->material_id,
            'subject_id' => $exam_paper_material->subject_id,
            'status' => $exam_paper_material->status
        );
        $exam_paper_material->update($data_exam_details);

        $contributor_list = $request->input('contributor_list');
                $price = $request->input('price');
                $videos = $request->input('videos');
                $videos_title = $request->input('videos_title');
                $material_content_files = $request->file('material_content_files');
            ExamPaperMaterialContributor::where('exam_paper_material_content_id',$id)->delete();
        if($request->has('contributor_list')){
            $i=0;
            foreach($contributor_list as $contributor){

                $data_exam_details = array(	
                    'contributor_id' => $contributor,
                    'price' => $price[$i],
                    'exam_paper_material_content_id'=>$id
                );
                ExamPaperMaterialContributor::create($data_exam_details);
                $i++;
            }
        }
        
        if($request->hasFile('material_content_files')){
            
            $count=0;
            foreach($material_content_files as $uploadfile){
                $uploadedFile = $material_content_files[$count];
                $filename=ImageHelper::saveFileForGallery($uploadedFile,config('disk.get_material'));;
                $data_media_details = array(
                    'value' => $filename,
                    'media_type'=>'pdf',
                    'exam_paper_material_content_id'=>$id
                    
                );
                Media::create($data_media_details);
                $count++;
            }
        }
        if($request->has('videos')){
            $deleteVideoFiles=Media::where('exam_paper_material_content_id',$id)
                ->where('media_type','video')
                ->delete();
            $vcount=0;
            foreach($videos as $video){
                if(!empty($video)){
                    $data_media_details = array(	
                        'title'=>$videos_title[$vcount],
                        'value' => $video,
                        'media_type'=>'video',
                        'exam_paper_material_content_id'=>$id
                        
                    );  
                    Media::create($data_media_details);
                    $vcount++;
                }
            }
        }    
        

       	
        return redirect()->intended(route('editExamPaperMaterialContent',['id'=>Hasher::encode($id)]))->with('messageClass', 'alert alert-success')
        ->with('message', 'Updated successfully');
	        
    }

    public function ajaxGetSubjectContributors(Request $request){
        $subject_id=$request->subject_id;

        $query = DB::table('contributors')
         ->select('contributor_id','user_id','firstname','lastname')
         ->join('users','users.id','contributors.user_id')  
         ->where('users.status',1) 
         ->whereRaw("FIND_IN_SET($subject_id,subject_list)")
         ->get();

         return $query;
    }

    public function ajaxdeleteMaterialContent(Request $request){
        
        $media_id=$request->media_id;
        $deletePdfFiles=Media::where('media_id',$media_id)->delete();

        if($deletePdfFiles){
            return 1;
        }
        return 0;
    }

}
