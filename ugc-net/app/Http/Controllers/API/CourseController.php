<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 

use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

use App\Product;
use DB;
use App\CourseStructureRelation;
use App\CourseExamPaperRelation;
use Str;


class CourseController extends Controller 
{
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function apitest()
    {
       return "hiii";
    }
    
    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    public function getAllCourseList(Request $request) 
    { 
        $allProducts=Product::where('status',1)->orderBy('name','Asc')->get();
        // $featured_course_details = DB::table('products as pro')->select('pro.product_id','pro.name','pro.short_description','pro.description','pro.price'
        //         ,'pro.revised_price','exam_masters.exam_name','pro.image')
        //         ->join('course_exam_subject_relations as cesr','pro.product_id','cesr.product_id')
        //         ->join('exam_masters','cesr.exam_id','exam_masters.id')
        //         ->where('pro.is_popular', '=', '1')
        //         ->where(['pro.status'=> '1'] )
        //         ->where('pro.price','<>', '0' )
        //         ->where('pro.end_date','>=',date('Y-m-d'))
        //         ->distinct('pro.product_id')
        //         ->orderBy('pro.name', 'ASC')
        //         ->get();
        $course_image_path=asset('storage/uploads/courses/thumbs/');    

        $featured_course_details = DB::table('products as pro')->select('pro.product_id','pro.name','pro.short_description','pro.description','pro.price'
                ,'pro.revised_price','exam_masters.exam_name',DB::raw('CONCAT("'.$course_image_path.'", "/", pro.image) AS image'))
                ->join('course_exam_subject_relations as cesr','pro.product_id','cesr.product_id')
                ->join('exam_masters','cesr.exam_id','exam_masters.id')
                ->where('pro.is_popular', '=', '1')
                ->where(['pro.status'=> '1'] )
                ->where('pro.price','<>', '0' )
                ->where('pro.end_date','>=',date('Y-m-d'))
                ->distinct('pro.product_id')
                ->orderBy('pro.name', 'ASC')
                ->get();
        
        $other_course_details = DB::table('products as pro')->select('pro.product_id','pro.name','pro.short_description','pro.description','pro.price'
        ,'pro.revised_price','exam_masters.exam_name',DB::raw('CONCAT("'.$course_image_path.'", "/", pro.image) AS image'))
            ->join('course_exam_subject_relations as cesr','pro.product_id','cesr.product_id')
            ->join('exam_masters','cesr.exam_id','exam_masters.id')
            ->where('pro.is_popular', '=', '0')
            ->where(['pro.status'=> '1'] )
            ->where('pro.price','<>', '0' )
            ->where('pro.end_date','>=',date('Y-m-d'))
            ->distinct('pro.product_id')
            ->orderBy('pro.name', 'ASC')
            ->get();

        $course_image_path=asset('storage/uploads/courses/thumbs/');    
        $logged_in_user_id=0;
        if($request->has('logged_in_user_id')){
            $logged_in_user_id=$request->logged_in_user_id;
        }
        //return $featured_course_details;        

        $returndata=[
            'success' => 1,
            'message'=>'Success',
            'featured_course_details'=>$featured_course_details,
            'other_course_details'=>$other_course_details,
            'logged_in_user_id'=>$logged_in_user_id,
            'course_image_path'=>$course_image_path

        ];
        return $returndata;
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 

    public function getPreviewCourses(Request $request)
    {
        $token = $request->bearerToken();
        

        $preview_courses=DB::table('products as pro')->select('pro.product_id','pro.name','pro.short_description','pro.description','pro.price'
        ,'pro.revised_price','exam_masters.exam_name',DB::raw('CONCAT("'.$course_image_path.'", "/", pro.image) AS image'))
        ->join('course_exam_subject_relations as cesr','pro.product_id','cesr.product_id')
        ->join('exam_masters','cesr.exam_id','exam_masters.id')
        ->where(['pro.status'=> '1'] )
        ->where('pro.price', '0' )
        ->where('pro.end_date','>=',date('Y-m-d'))
        ->distinct('pro.product_id')
        ->orderBy('pro.name', 'ASC')
        ->get();
        $logged_in_user_id=0;
        if($request->has('logged_in_user_id')){
            $logged_in_user_id=$request->logged_in_user_id;
        }
        

        $returndata=[
            'success' => 1,
            'message'=>'Success',
            'preview_courses'=>$preview_courses,
            'logged_in_user_id'=>$logged_in_user_id
        ];
        return $returndata;
    }

    public function getCourseDetails(Request $request)
    {
        try{
            $course_image_path=asset('storage/uploads/courses/thumbs/');    

            $product = Product::select('*',DB::raw('CONCAT("'.$course_image_path.'", "/",image) AS image'))
            ->where('product_id', '=', $request->course_id)
            ->where('status', '=', '1')
            ->first();
            if($product){

                $DataBag['course_details_info']=$product;
                
                $product_id=$DataBag['course_details_info']->product_id;
                
                $logged_in_user_id=0;
                if($request->has('logged_in_user_id')){
                    $logged_in_user_id=$request->logged_in_user_id;
                }
                $returndata=[
                    'success' => 1,
                    'message'=>'Success',
                    'course_details'=>$DataBag,
                    'logged_in_user_id'=>$logged_in_user_id
                ];
                return $returndata;
            }else{
                $returndata=[
                    'success' => 0,
                    'message'=>'No such course',
                    
                ];
                return $returndata;
            }

        }catch(\Exception $e){
            $returndata=[
                'success' => 0,
                'message'=>$e->getMessage(),
                
            ];
            return $returndata;
        }
    }
    public function getFullCourseDetails(Request $request)
    {
        try{
            $course_image_path=asset('storage/uploads/courses/thumbs/');    

            $product = Product::select('*',DB::raw('CONCAT("'.$course_image_path.'", "/",image) AS image'))
            ->where('product_id', '=', $request->course_id)
            ->where('status', '=', '1')
            ->first();
            if($product){

                $course_exam=DB::table('exam_masters as em')
                        ->join('course_exam_paper_relations as cepr','em.id','cepr.exam_id')
                        ->select('cepr.exam_id','em.exam_name')
                        ->where('cepr.product_id',$product->product_id)
                        ->first();

                $collection = collect($product);
                $course_details_info = $collection->merge($course_exam);
                
                $DataBag['course_details_info']=$course_details_info;
                
                $product_id=$product->product_id;

                
                $product_paper_exam_relation=CourseExamPaperRelation::where('product_id',$product_id)->first();
                $exam_id=$product_paper_exam_relation->exam_id;
                $paper_id=$product_paper_exam_relation->paper_id;

            
                $course_infos=CourseStructureRelation::where('product_id',$product_id)->first();
                $course_data=json_decode($course_infos->course_data);
                
            
                //print_r($course_data);die;                
                //$relatedPapers=array();
                $relatedmaterials=array();
                foreach($course_data as $exam){
                    foreach($exam as $key=>$val){
                        $paper_info=\App\PaperMaster::find($key);
                        $paper_name=$paper_info->paper_name;
                        $paper_name=strtolower(str_replace(' ', '_', $paper_name));
                        $study_materials=$val[0]==null?[]:$val[0];
                        //$relatedmaterials[$paper_name]=$val[0]==null?[]:$val[0];
                        foreach($val as $study_material){
                            foreach($study_material as $sm){
                               @$mnames=\App\MaterialMaster::find($sm)->material_name;
                                if($mnames){

                                    @$material_name[]=$mnames;
                                }

                            }
                            //$material_name=array_map("unserialize", array_unique(array_map("serialize", $material_name)));
                            // if($paper_name=='paper_2'){
                            //     dd($paper_name, array_unique($material_name, SORT_REGULAR),array_unique($material_name));
                            // }
                            $relatedmaterials[$paper_name]=array_values(array_unique($material_name));
                        }
                    // $relatedmaterials[$key]=$val[0]==null?[]:$val[0];
                    }  
                }
               
                $logged_in_user_id=0;
                if($request->has('logged_in_user_id')){
                    $logged_in_user_id=$request->logged_in_user_id;
                }
                
               
                
                $DataBag['related_materials']=$relatedmaterials;
                
                $returndata=[
                    'success' => 1,
                    'message'=>'Success',
                    'course_details'=>$DataBag,
                    'logged_in_user_id'=>$logged_in_user_id
                    
                ];
                
                //dd($returndata);    
                return response()->json($returndata);
                
                
               
            }else{
                $returndata=[
                    'success' => 0,
                    'message'=>'No such course',
                    
                ];
                return $returndata;
            }

        }catch(\Exception $e){
            $returndata=[
                'success' => 0,
                'message'=>$e->getMessage(),
                
            ];
            return $returndata;
        }
        

       
    }

    
   
   //Call function
   
   
}