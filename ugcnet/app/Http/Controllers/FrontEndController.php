<?php

namespace App\Http\Controllers;

use App\CourseExamPaperRelation;
use App\ExamPaperMaterialMaster;
use App\MaterialMaster;
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
use Session;
use View;
use DB;
use File;
use Auth;
use App\VisitorDetail;
use Mail;
use Validator;
use App\BannerMaster;
use App\BannerSliderMaster;



class FrontEndController extends Controller
{
	public function __construct() 
	{
        $shareData = array();
        
        $mainMenu = Product::select('name','product_id','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = Product::select('product_id','name','slug')
                        ->where(['status' => '1',
                                'is_combo'=>1
                        ])
                        ->orderBy('name', 'asc')
                        ->get();
        $articles_cat=\App\ArticleCategory::where('status',1)->get();                
        $shareData['articlecats'] = $articles_cat;   
        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();    
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;            
        
        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        
        View::share($shareData);
	}



    
    public function home()
    {
        //dd(Auth::check());
        $DataBag = $meta_array = array();
        $mainMenu = Product::select('name','product_id','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $DataBag['mainMenu'] = $mainMenu;
        $DataBag['home_banners'] = Product::select('product_id','name','meta_key','price','revised_price','slug')->where('home_slider', '=', '1')->where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        //return $DataBag;
        $DataBag['home_feature_courses'] = Product::select('*')
                ->where('is_popular', '=', '1')
                ->where(['status'=> '1'] )
                ->where('price','<>', '0' )
                ->where('end_date','>=',date('Y-m-d'))
                ->orderBy('name', 'ASC')
                ->get();

        $DataBag['preview_courses'] = Product::select('*')
                
                ->where(['status'=> '1'] )
                ->where('price', '0')
                ->where('end_date','>=',date('Y-m-d'))
                ->orderBy('name', 'ASC')
                ->get();
        //return $DataBag['preview_courses'];
        $DataBag['home_videos'] = Video::select('title','video_url')->where('is_home', '=', '1')->where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        
        $DataBag['home_testimonial_videos'] = Testimonial::select('student_name','student_course','video_url')->where('testimonial_type', '=', '1')->where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        
        $DataBag['home_testimonial_text'] = Testimonial::select('student_name','student_course','testimonial_text')->where('testimonial_type', '=', '2')->where('status', '=', '1')->orderBy('created_at', 'desc')->get();
        $DataBag['banner'] = BannerMaster::where('status',1)->first();
        $DataBag['bannersliders'] = BannerSliderMaster::where('status',1)->orderBy('updated_at','desc')->get();
        
        $meta_array['meta_title']='UGC & CSIR NTA NET/SET/JRF Study Material 2020 | Teachinns';
        $meta_array['meta_desc']='Teachinns-the #1 online exam preparation site to get success in the UGC CSIR/ NET/SET/JRF exam 2020. 100% syllabus covering study material, mock tests, & more.';
        $meta_array['meta_keyword']='ugc net study material, ugc net paper 1 study material pdf, csir net study material, ugc net preparation material';
        $meta_array['meta_robots']='Teachinns';
        
        $DataBag['page_metadata'] = (object)$meta_array;
        
    	return view('frontend.home', $DataBag);
    }
    
    public function courseContent($slug)
    {
        $DataBag = $meta_array = array();
        
        $product = Product::select('*')
                            ->where('slug', '=', $slug)
                            ->where('status', '=', '1')
                            ->first();
       // return $slug;
       if($product){
       $meta_array['meta_title']=$product->meta_title.' | Teachinns';
       $meta_array['meta_desc']=$product->meta_description;
       $meta_array['meta_keyword']=$product->meta_key; 
       $meta_array['meta_robots']=$product->meta_robots; 

       $DataBag['course_details_page']=$product;
        if (empty($DataBag['course_details_page'])) {
            return redirect()->intended('/');
        }
        $product_id=$DataBag['course_details_page']->product_id;
        $product_paper_exam_relation=CourseExamPaperRelation::where('product_id',$product_id)->first();
        $exam_id=$product_paper_exam_relation->exam_id;
        $paper_id=$product_paper_exam_relation->paper_id;

       
        $course_infos=\App\CourseStructureRelation::where('product_id',$product_id)->first();
        $course_data=json_decode($course_infos->course_data);
        
        $paperlist = DB::table('exam_paper_material_relations AS epmr')
                            ->select('epmr.id', 'E.exam_name','pm.paper_name', 'epmr.paper_id')
                            ->join('exam_masters as E','E.id','epmr.exam_id')
                            ->join('paper_masters as pm','epmr.paper_id','pm.id')
                            ->where('epmr.exam_id',key($course_data))                        
                            ->get();

                
                $relatedPapers=array();
                $relatedmaterials=array();
                foreach($course_data as $exam){
                    foreach($exam as $key=>$val){
                        $relatedPapers[]=$key;
                        $relatedmaterials[$key]=$val[0]==null?[]:$val[0];
                    }  
                }
            //     echo "<pre>";
            // print_r($relatedmaterials);die; 
                //foreach
        
        
        $DataBag['related_materials']=$relatedmaterials;
       


        //return $DataBag['related_materials'];
        $DataBag['page_metadata'] = (object)$meta_array;
        // dd($DataBag);
        return view('frontend.course.iiparsdetails', $DataBag);
        return view('frontend.course.details', $DataBag);
        }else{
        abort(404); 
       }
    }


    public function coursetagList($slug)
    {
        $DataBag = $meta_array = array();
        $meta_array['meta_title']='Teachinns - Tags';
        $meta_array['meta_desc']='Teachinns';
        $meta_array['meta_keyword']=$slug;
       
        $DataBag['courses']=Product::select('product_id','name','price','revised_price','image','slug')->where('meta_key','like', '%' . $slug )->get();
        $DataBag['slug']=$slug;

        //return $DataBag;
        $DataBag['page_metadata'] = (object)$meta_array;
        
        return view('frontend.course.course_tag_list', $DataBag);
    }

    
    /********************************************************************************************************************/
    public function cmsPage( $lng, $slug ) {
    	$DataBag = array();
        $breadcrumbs = array();

    	$device = 1;
        $agent = new Agent();
        if( $agent->isMobile() ) { $device = 2; }
        $DataBag['device'] = $device;
        
        $DataBag['lng'] = $lng;
        $getlngid = getLngIDbyCode( $lng );

        $view = 'front_end.home';
    	
        $cms = CmsLinks::where('slug_url', '=', trim($slug))->first();
    	if( !empty($cms) ) {

            $table_id = $cms->table_id;
            $table_type = $cms->table_type;





            /** PRODUCT **/
            if( $table_type == 'PRODUCT' ) {
                
                $data = \App\Models\Product\Products::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.product.product_page';
            }



            /** PRODUCT CATEGORY **/
            if( $table_type == 'PRODUCT_CATEGORY' ) {
                
                $data = \App\Models\Product\ProductCategories::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.product.product_category_page';
            }

            /** TECHNICAL RESOURCE **/
            if( $table_type == 'TECH_RESOURCE' ) {
                
                $data = \App\Models\TechResource\TechResource::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.tech_resource.tech_resource_content';
            }

            /** CONTENTS **/
            if( $table_type == 'DYNA_CONTENT' ) {
                
                $data = \App\Models\Content\Contents::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.dyna_content.content_page';
            }




            /** ARTICLE **/
            if( $table_type == 'ARTICLE' ) {
                
                return redirect()->route('front.artCont', array('lng' => $lng, 'slug' => $slug ));
            }



            /** ARTICLE CATEGORY **/
            if( $table_type == 'ARTICLE_CATEGORY' ) {
                
                return redirect()->route('newsArticleList', array('lng' => $lng));
            }




            /** EVENT **/
            if( $table_type == 'EVENT' ) {
                
                $data = \App\Models\Events::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $eventCats = \App\Models\EventCategories::where('status', '=', '1')->orderBy('created_at', 'desc')->paginate( 20 );
                $DataBag['listCats'] = $eventCats;

                $yearArr = array();
                $createdAt = \App\Models\Events::where('status', '=', '1')
                ->where('parent_language_id', '=', '0')->orderBy('created_at', 'desc')->pluck('created_at')->toArray();
                if( !empty($createdAt) ) {
                    foreach( $createdAt as $v ) {
                        $onlyYear = Carbon::createFromFormat('Y-m-d H:i:s', $v)->year;
                        array_push( $yearArr , $onlyYear );
                    }
                }
                $uniqueYear = array_unique( $yearArr );
                $DataBag['yearList'] = $uniqueYear;
                
                $view = 'front_end.event.content_page';
            }



            /** EVENT CATEGORY **/
            if( $table_type == 'EVENT_CATEGORY' ) {
                
                return redirect()->route('eventLists', array('lng' => $lng));
            }




            /** INDUSTRY **/
            if( $table_type == 'INDUSTRY' ) {
                
                $data = \App\Models\Industry\Industries::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.industry.industry';
            }




            /** FLOWSHEET CATEGORY **/
            if( $table_type == 'FLOWSHEET_CATEGORY' ) {
                
                $data = \App\Models\IndustryFlowsheet\FlowsheetCategories::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.industry.flowsheet_category';
            }




            /** FLOWSHEET **/
            if( $table_type == 'FLOWSHEET' ) {
                
                $data = \App\Models\IndustryFlowsheet\Flowsheet::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['fsmarkers'] = \App\Models\IndustryFlowsheet\FlowsheetMarker::where('flowsheet_id', '=', $table_id)->get();

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.industry.flowsheet';
            }




            /** DISTRIBUTOR CATEGORY **/
            if( $table_type == 'DISTRIBUTOR_CATEGORY' ) {
                
                /*$data = \App\Models\Distributor\DistributorCategories::with(['pageBuilderContent', 'DistributorIds'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.distributor.distributor_category';*/

                return redirect()->route('front.distrbCat', array('lng' => $lng, 'catslug' => $slug));
            }




            /** DISTRIBUTOR **/
            if( $table_type == 'DISTRIBUTOR' ) {
                
                /*$data = \App\Models\Distributor\Distributor::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();

                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.distributor.distributor';*/

                $distrb = \App\Models\Distributor\Distributor::where('id', '=', $table_id)->first();
                if( !empty($distrb) ) {
                    if( isset($distrb->distrCategorytOne) && isset($distrb->distrCategorytOne->catInfo) ) {
                        $catslug = $distrb->distrCategorytOne->catInfo->slug;
                        return redirect()->route('front.distrb', array('lng' => $lng, 'catslug' => $catslug, 'slug' => $slug));
                    }
                }
            }



            /** DISTRIBUTOR CONTENT **/
            if( $table_type == 'DISTRIBUTOR_CONTENT' ) {
                
                /*$data = \App\Models\Distributor\DistributorContents::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();
                
                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.distributor.distributor_content';*/

                $disCont = \App\Models\Distributor\DistributorContents::where('id', '=', $table_id)->first();
                if( !empty($disCont) ) {
                    if( isset($disCont->distributorInfo) && isset($disCont->distributorInfo->distrCategorytOne) && isset($disCont->distributorInfo->distrCategorytOne->catInfo) ) {
                        $disslug = $disCont->distributorInfo->slug;
                        $catslug = $disCont->distributorInfo->distrCategorytOne->catInfo->slug;
                    return redirect()->route('front.distrbCont', array('lng' => $lng, 'catslug' => $catslug, 'disslug' => $disslug, 'slug' => $slug));
                    }
                }
            }




            /** PEOPLES PROFILE CATEGORY **/
            if( $table_type == 'PEOPLE_PROFILE_CATEGORY' ) {
                
                $data = \App\Models\PeoplesProfile\PeopleProfileCategories::with(['pageBuilderContent'])
                ->where('language_id', '=', $getlngid)->where('id', '=', $table_id)->first();

                $DataBag['allData'] = $data;

                $DataBag['page_metadata'] = $DataBag['allData'];

                $DataBag['breadcrumbs'] = $breadcrumbs;
                
                $view = 'front_end.people_profile.profile_category';
            }




            /** PEOPLES PROFILE **/
            if( $table_type == 'PEOPLE_PROFILE' ) {
                
                return redirect()->route('front.profCont', array('lng' => $lng, 'slug' => $slug));
            }
			
		} else {
            abort(404);
        }

        return view ( $view, $DataBag );
    }
    /********************************************************************************************************************/

    public function landingPages( $lng, $slug ) {

        $page = \App\Models\LandingPages::where('slug', '=', $slug)->first();
        if( !empty($page) ) {
            $dirName = $page->dir_name;
            $landingPages_folder = public_path('landing_pages/' . $dirName);
            $asset = asset('public/landing_pages/' . $dirName);            

            $pageContent = file_get_contents($landingPages_folder.'/index.html');

            preg_match_all('/href=["\']?([^"\'>]+)["\']?/', $pageContent, $arr, PREG_PATTERN_ORDER);

            if( !empty( $arr ) ) {
                foreach( array_unique($arr[1]) as $v ) {
                    if ( (strpos($v, 'http') === false) && (strpos($v, '#') === false) ) {
                        $pageContent = str_replace($v, $asset.'/'.$v, $pageContent);
                    }
                }
            }

            preg_match_all('/src=["\']?([^"\'>]+)["\']?/', $pageContent, $arr, PREG_PATTERN_ORDER);

            if( !empty( $arr ) ) {
                foreach( array_unique($arr[1]) as $v ) {
                    if ( (strpos($v, 'http') === false) && (strpos($v, '#') === false) ) {
                        $pageContent = str_replace($v, $asset.'/'.$v, $pageContent);
                    }
                }
            }

            echo $pageContent;
        }
    }

    public function contactus()
    {
        $meta_array['meta_title']='Contact Us | Teachinns';
        $meta_array['meta_desc']='Do you have any queries? Please feel free to reach us; we will soon get back to you! ';
        $meta_array['meta_keyword']='Teachinns';
        $meta_array['meta_robots']='Teachinns';

        $DataBag['page_metadata'] = (object)$meta_array;

        return view('frontend.contactus',$DataBag);
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

    public function contactAction(Request $request)
    {
        //return $request->all();
        try{
            $emailData = array();

            $emailData['name']=$request->cname;
            $emailData['email']=$request->email;
            $emailData['phone']=$request->phone;
            $emailData['subject']=$request->subject;
            $emailData['message']=$request->message;
            $g_recaptcha_response = $request->input('g-recaptcha-response');


            $contactus=\App\ContactUs::create($emailData);
            // $emailData['body'] = trim($content);
            $emailData['to_email'] = $request->email;
            $emailData['from_email'] = trim(getSettings('from_email'));
            $emailData['from_name'] = trim(getSettings('from_name'));

            $data_user_details = array(
                
                'email' => $request->email,
                'g-recaptcha-response' => $g_recaptcha_response
            );

            $validator = $this->validatorRegisterGeneral($data_user_details);
            if ($validator->fails()) {
                $val = $validator->errors();
                
                return back()->withErrors($val)->withInput();
            }

            Mail::send('frontend.emails.contact-us', ['emailData' => $emailData], function ($message) use ($emailData) {
    
                $message->from($emailData['from_email'], $emailData['from_name']);

                $message->to($emailData['to_email'])->subject($emailData['subject']);
                
            });

            return redirect()->intended(route('contactus'))->with('messageClass', 'alert alert-success')
                                        ->with('message', 'Thanks for contacting us.We will get back to you soon.');

        }catch(\Exception $e){
            return redirect()->intended(route('contactus'))->with('messageClass', 'alert alert-danger')
                                        ->with('message', $e->getMessage());
        }
    }

    
    public function saveVisitor(Request $request)
    {
       
        $data=array(
            'visitor_ip'=>$request->ip(),
            'visited_page'=>$request->visited_page,
        );
        $visitor_info=VisitorDetail::where('visitor_ip',$request->ip())->first();
        if(!$visitor_info){

            VisitorDetail::create($data);
        }
        


    }

    public function saveVisitorBuyCourseInfo(Request $request)
    {
       $product_id=$request->product_id;
       //$request->session()->put('buy_course_id', $product_id);
       session(['buy_course_id' => $product_id]);
       //return $value = $request->session()->pull('buy_course_id');
    }
    public function removeVisitorBuyCourseInfo(Request $request)
    {
        
       $request->session()->forget('buy_course_id');
       $request->session()->forget('mock_test_login');

       //return $value = $request->session()->pull('buy_course_id');
    }
    public function saveMockTestSessionLogin(Request $request)
    {
       
       session(['mock_test_login' =>1]);
       
    }
    public function removeMockTestSessionLogin(Request $request)
    {
        
       $request->session()->forget('mock_test_login');
       
    }

    public function lastMinuteSuggestion(Request $request)
    {
        
        $meta_array['meta_title']='Last Minute Suggestions | Teachinns';
        $meta_array['meta_desc']='Last Minute Suggestions | Teachinns ';
        $meta_array['meta_keyword']='Teachinns';
        $meta_array['meta_robots']='Teachinns';

        $DataBag['page_metadata'] = (object)$meta_array;
        $DataBag['home_feature_courses'] = Product::select('*')
                //->where('is_popular', '=', '1')
                ->where(['status'=> '1'] )
                ->where('price','<>', '0' )
                ->where('created_at','>=','2020-08-21')
                ->orderBy('name', 'ASC')
                ->get();

              
        return view('frontend.lastMinuteSuggestion',$DataBag);
    }

    /************ GLOBAL SEARCH ******************/



    public function notFound($lng) {
        return view('errors.404');
    } 
}
