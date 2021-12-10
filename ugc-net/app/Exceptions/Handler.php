<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {   
        $mainMenu = \App\Product::select('name','product_id','slug')->where('status', '=', '1')->orderBy('name', 'asc')->get();
        $exams = \App\ExamMaster::select('exam_name','id')->where('status', '=', '1')->orderBy('id', 'asc')->get();
        $combo_pack_products = \App\Product::select('product_id','name','slug')
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
        $floatersignup=\App\FloaterSignUpMaster::where('status',1)->first();   
        $shareData['floatersignup'] = $floatersignup;
        
        if ($this->isHttpException($exception)) {
            
            if ($exception->getStatusCode() == 404) {
                return response()->view('frontend.errors.' . '404', $shareData, 404);
            }
            switch ($exception->getStatusCode()) {

                // not authorized
                case '403':
                    return \Response::view('errors.403',array(),403);
                    break;
    
                // not found
                case '404':
                    return \Response::view('frontend.errors.' . '404', $shareData, 404);
                    break;
    
                // internal error
                case '500':
                    return \Response::view('errors.500',array(),500);
                    break;
    
                default:
                    return $this->renderHttpException($exception);
                    break;
            }
            return parent::render($request, $exception);
        }
        dd($exception);
        return response()->json(
            [
                'errors' => [
                    'status' => 401,
                    'message' => $exception->getMessage(),
                ]
            ], 401
        );
        
    }
}
