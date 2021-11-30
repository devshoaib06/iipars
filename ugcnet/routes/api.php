<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::any('authentication', 'API\AuthController@authenticateClient');
Route::any('admin/authentication', 'API\AuthController@authenticateClientFromIIpars');
Route::get('admin/login', 'API\AuthController@adminloginIIPARS');



Route::get('apitest','API\UserController@apitest');

Route::group(['middleware' => 'APIToken'], function(){
    Route::post('register', 'API\UserController@register');
    Route::post('login', 'API\UserController@login');
    Route::post('forgot-password', 'API\UserController@forgotPassword');
    
    
    Route::post('getAllCourseList', 'API\CourseController@getAllCourseList');
    Route::post('getPreviewCourses', 'API\CourseController@getPreviewCourses');
    Route::post('getFullCourseDetails', 'API\CourseController@getFullCourseDetails');
    Route::post('getCourseDetails', 'API\CourseController@getCourseDetails');
    Route::post('getNewsFeed', 'API\AppController@getNewsFeed');
    Route::post('getBannerSliders', 'API\AppController@getBannerSliders');
    
    Route::post('contactQuery', 'API\AppController@contactAction');
    
    
    Route::group(['middleware' => 'studentauth'], function(){
        Route::post('logout', 'API\UserController@logout');
        Route::post('getuserinfo','API\UserController@getUserInfo');
        Route::post('editProfile','API\UserController@updateProfile');
        Route::post('changePass','API\UserController@updatePassword');
        Route::post('getDasboard','API\UserController@dashboard');
        
        Route::post('getOrderList','API\OrderController@myOrders');
        Route::post('getOrderDetails','API\OrderController@viewOrderInfo');

        Route::post('checkout','API\OrderController@checkout');
        Route::post('coupon-apply','API\OrderController@checkCoupon');
        Route::post('reseller-code-apply','API\OrderController@resellerCodeExists');
        Route::post('placeorder','API\OrderController@placeorder');
        Route::post('payment-success','API\OrderController@paymentSuccessAction');
        Route::post('thank-you', 'API\OrderController@thankYouPage');


        Route::get('/mock-test-instruction', 'API\MockTestController@showInstruction')->name('showInstruction');
        Route::post('/start-exam', 'API\MockTestController@startExam')->name('startExam');
        Route::get('/mock-test/{exam_id}', 'API\MockTestController@showQuestionList')->name('mock-test');
        Route::post('/mock-test-submit', 'API\MockTestController@submitStudentAnwser')->name('submitStudentAnwser');
        Route::get('/mock-test/result/{exam_id}', 'API\MockTestController@showResult')->name('mt-result');

    });


   
});


Route::any('{path}', function() {
    return response()->json([
        'sucess'=>0,
        'message' => 'Route not found'
    ], 404);
})->where('path', '.*');
