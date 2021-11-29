<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

class AppController extends Controller
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
        
        $shareData['newsfeed'] = $newsfeed;
        $shareData['combo_pack_products'] = $combo_pack_products;
        $shareData['mainMenu'] = $mainMenu;
        $shareData['exams'] = $exams;
        
        
        View::share($shareData);
	}


    public function getNewsFeed(Request $request)
    {
        $newsfeed=\App\NewsFeedMaster::where('status',1)->get();  
        
        $returnData=array(
            'success'=>1,
            'message'=>'Success',
            'newsfeed'=>$newsfeed
        );
        return $returnData;
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
            'name' => 'required|max:255',
            'phone' => 'required|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
            //'password' => 'required|min:6',
            //'g-recaptcha-response' => 'required|captcha'
        ];

        return Validator::make($data, $validate);
    }

    public function contactAction(Request $request)
    {
        //return $request->all();
        try{
            $emailData = array();

            $emailData['name']=$request->name;
            $emailData['email']=$request->email;
            $emailData['phone']=$request->phone;
            $emailData['subject']=$request->subject;
            $emailData['message']=$request->message;

            $data_user_details = array(
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
            );


            $validator = $this->validatorRegisterGeneral($data_user_details);
            
            if ($validator->fails()) { 
                return response()->json(['success'=>0,'error'=>$validator->errors()], 401);            
            }


            $contactus=\App\ContactUs::create($emailData);
            // $emailData['body'] = trim($content);
            $emailData['to_email'] = $request->email;
            $emailData['from_email'] = trim(getSettings('from_email'));
            $emailData['from_name'] = trim(getSettings('from_name'));

            
            
            Mail::send('frontend.emails.contact-us', ['emailData' => $emailData], function ($message) use ($emailData) {
    
                $message->from($emailData['from_email'], $emailData['from_name']);

                $message->to($emailData['to_email'])->subject($emailData['subject']);
                
            });

            $returnData=array(
                'success'=>1,
                'message'=>'Message sent successfully.We will contact back soon.',
            );
            return $returnData;

        }catch(\Exception $e){
            
            $returnData=array(
                'success'=>1,
                'message'=>$e->getMessage(),
            );
            return $returnData;
        }
    }
    public function getBannerSliders(Request $request)
    {
        //$newsfeed=\App\NewsFeedMaster::where('status',1)->get();  
        $bannersliders = \App\BannerSliderMaster::where('status',1)->get();
        
        $returnData=array(
            'success'=>1,
            'message'=>'Success',
            'bannersliders'=>$bannersliders
        );
        return $returnData;
    }
    
    

    /************ GLOBAL SEARCH ******************/



    public function notFound($lng) {
        return view('errors.404');
    } 
}
