<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

Route::get('/', 'FrontEndController@home')->name('home');
// Route::get('/course/{exam}/{slug}', 'FrontEndController@courseContent')->name('front.corsCont');
Route::get('/course/{slug}', 'FrontEndController@courseContent')->name('front.corsCont');
Route::get('/course-list/{slug}', 'FrontEndController@coursetagList')->name('front.corstagList');
Route::get('/contact-us', 'FrontEndController@contactus')->name('contactus');
Route::post('/contact-us', 'FrontEndController@contactAction')->name('contactAction');
Route::get('/ajax-visitors', 'FrontEndController@saveVisitor')->name('ajax-visitors');
Route::post('/ajax-buy-product', 'FrontEndController@saveVisitorBuyCourseInfo')->name('visitor-buy-product');
Route::post('/ajax-remove-buy-product', 'FrontEndController@removeVisitorBuyCourseInfo')->name('visitor-remove-buy-product');
Route::post('/ajax-mocktest-login', 'FrontEndController@saveMockTestSessionLogin')->name('saveMockTestSessionLogin');
Route::get('last-minute-suggestion','FrontEndController@lastMinuteSuggestion')->name('last-minute-suggestion');

// Route::post('/ajax-remove-mocktest-login', 'FrontEndController@removeMockTestSessionLogin')->name('removeMockTestSessionLogin');

//Article
Route::get('/articles/submit-your-article', 'ArticleController@showArticleForm')->name('showArticleForm');
Route::post('/submit-article', 'ArticleController@frontendSubmitArticle')->name('submitArticle');
Route::get('/articles/{category}', 'ArticleController@showCategoryWiseArticle')->name('articles');
Route::get('/articles', 'ArticleController@allArticles')->name('all-articles');
Route::get('/article/{category}/{slug}', 'ArticleController@articleDetails')->name('articleDetails');
Route::post('/ajax-insert-newsletter', 'NewsLetterController@saveNewsletterEmail')->name('insert-newsletter');
Route::post('/ajax-check-newsletter-email', 'NewsLetterController@checkEmailExists')->name('newsletter-checkEmailExists');
Route::get('download-article-file/{article_id}', 'ArticleController@downloadArticleFile')->name('downloadArticleFile');



//Current Affairs
Route::get('/current-affairs', 'ArticleController@showCurrentAffairs')->name('showCurrentAffairs');
Route::get('/current-affair/{slug}', 'ArticleController@articleDetails')->name('currentAffairDetails');



Route::get('/sign-up', 'Auth\RegisterController@signUp')->name('sign-up');
Route::post('/sign-up', 'Auth\RegisterController@signupAction')->name('signupAction');
Route::post('userlogin', 'Auth\LoginController@login')->name('loginAction');
Route::get('/logout', 'Auth\LoginController@logout')->name('frontendlogout');
//Forget Password
Route::post('/forget-password', 'Auth\AuthController@forgetPasswordAction')->name('forget_password_action');
Route::get('/reset-password/{token}', 'Auth\AuthController@resetPasswordPage')->name('reset_password_page');
Route::post('/reset-password', 'Auth\AuthController@resetPasswordAction')->name('reset_password_action');


Route::get('/razorpay', 'RazorpayController@index')->name('razorpay');

// Check Email
Route::post('/check-useremail', 'UserController@checkUseremail')->name('check_useremail');
Route::post('/update-password', 'UserController@updatePassword')->name('update_password');
//Dashboard

Route::post('/payment-request', 'FrontendContributor\FrontendContributorController@paymentRequestAction')->name('paymentrequestAction');

Route::get('/mock-test', 'MockTestController@showQuestionList')->name('mock-test');
Route::get('/demo-mock-test/', 'MockTestController@demoshowQuestionList')->name('demo-mock-test');


Route::group(['prefix' => 'student',  'middleware' => 'student'],function () {
    
    Route::get('/dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('/myAccount', 'UserController@myAccount')->name('my_account');
    Route::get('/myCourses/{course_id}', 'UserController@myCourses')->name('my_courses');
    Route::post('/account-update/{id}', 'UserController@myAccountAction')->name('account-update');
    Route::get('/changePassword', 'UserController@changePassword')->name('change-password');
    
    Route::get('download-content/{media_id}', 'UserController@downloadContent')->name('downloadContent');

    Route::any('checkout', 'OrderController@index')->name('billing');
    Route::post('placeorder', 'OrderController@billing')->name('billingAction');
    Route::get('order-pay/{order_id}', 'OrderController@orderPay')->name('orderPay');
    Route::get('thank-you/{order_id}', 'OrderController@thankYou')->name('thankYou');
    Route::get('payment-cancel/{order_id}', 'OrderController@paymentCancel')->name('paymentCancel');
    Route::post('/ajax-check-coupon', 'OrderController@ajaxCheckCoupon')->name('ajaxCheckCoupon');
    Route::post('/ajax-check-reseller-code', 'OrderController@ajaxResellerCode')->name('ajaxResellerCode');
    Route::post('/ajax-payment-success', 'OrderController@paymentSuccessAction')->name('payment-success');
    Route::get('orders', 'OrderController@myOrders')->name('myOrders');
    Route::get('order-info', 'OrderController@viewOrderInfo')->name('viewOrderInfo');
    Route::get('downloadInvoice/{order_id}', 'OrderController@downloadInvoicePDF')->name('downloadInvoicePDF');
    Route::post('/ajax-check-reseller-exists', 'OrderController@ajaxResellerCodeExists')->name('ajaxResellerCodeExists');

    Route::get('/mock-test-instruction', 'MockTestController@showInstruction')->name('showInstruction');
    Route::post('/startExam', 'MockTestController@startExam')->name('startExam');
    Route::get('/mock-test/{exam_id}', 'MockTestController@showQuestionList')->name('mock-test');
    Route::post('/mock-test-submit', 'MockTestController@submitStudentAnwser')->name('submitStudentAnwser');
    Route::get('/mock-test/result/{exam_id}', 'MockTestController@showResult')->name('mt-result');

     //Paid Mock Test
    
     Route::post('/mock-test-instructions', 'PaidMockTestController@showInstruction')->name('showInstructions');
     Route::post('/startPaidExam/{mock_test_id}', 'PaidMockTestController@startExam')->name('startPaidExam');
     Route::get('/mocktest/{mock_test_id}', 'PaidMockTestController@showQuestionList')->name('mocktest');
     Route::get('/mocktest-des', 'PaidMockTestController@showQuestionDesList');
     Route::get('/prime-mock-test/{course_id}', 'PaidMockTestController@mockTest')->name('studentMocktest');
     Route::post('/answer-submit', 'PaidMockTestController@submitStudentAnwser')->name('submitAnwser');
     Route::post('/answer-unmarked', 'PaidMockTestController@submitUnmarkedStudentAnwser')->name('submitUnmarkedStudentAnwser');
     Route::post('/show-question', 'PaidMockTestController@showQuestion')->name('showQuestion');
     //Route::post('/question', 'PaidMockTestController@submitStudentAnwser')->name('submitAnwser');
     Route::post('/ajax-update-response', 'PaidMockTestController@updateStudentResponseTime')->name('updateStudentResponseTime');
     //Route::get('/mock-test/result/{exam_id}', 'PaidMockTestController@showResult')->name('mt-result');
     Route::any('/ajax-question-summary', 'PaidMockTestController@getQuestionSummary')->name('getQuestionSummary');
     Route::any('/mocktest/submit/{mock_test_id}', 'PaidMockTestController@mockTestFinalSubmit')->name('mockTestFinalSubmit');
 
     Route::get('/mocktest/result/{mock_test_id}', 'PaidMockTestController@showResult')->name('pmt-result');
     //Route::any('/mocktest/{mock_test_id}', 'PaidMockTestController@showResumeQuesList')->name('resumeMTest');
     Route::get('/mock-tests', 'PaidMockTestController@studentMockTests')->name('my_mock_tests');
 
 
     //End Mock Test

    Route::get('/demo-prime-mock-test/{course_id}', 'PaidMockTestController@demomockTest')->name('demostudentMocktest');
    Route::post('/demo-mock-test-instructions', 'PaidMockTestController@demoshowInstruction')->name('demoshowInstructions');
    Route::post('/demo-startPaidExam', 'PaidMockTestController@demostartExam')->name('demostartPaidExam');
    Route::get('/demo-mocktest', 'PaidMockTestController@demoshowQuestionList')->name('demomocktest');

});
Route::prefix('contributor')->group(function () {

    //Login
    Route::get('login', 'ContributorAuth\ContributorAuthController@showLoginForm')->name('contributorlogin');
    Route::post('login', 'ContributorAuth\ContributorAuthController@login')->name('contributorloginAction');
    Route::get('logout', 'ContributorAuth\ContributorAuthController@logout');

    Route::get('forgot-password', 'ContributorAuth\ContributorAuthController@showForgotPasswordForm')->name('contributorforgotpassword');

    
    Route::get('/', 'FrontendContributor\FrontendContributorController@index')->name('contributordashboard');
    Route::get('/dashboard', 'FrontendContributor\FrontendContributorController@index')->name('contributordashboard');
    Route::get('/myAccount', 'FrontendContributor\FrontendContributorController@myAccount')->name('contributoraccount');
    Route::get('/edit-account/{user_id}', 'FrontendContributor\FrontendContributorController@editContributor')->name('contributor-edit-account');
    Route::get('/changePassword', 'FrontendContributor\FrontendContributorController@changePassword')->name('contributor-change-password');
    //Route::post('/update-password', 'UserController@updatePassword')->name('contributor-update-password');
    
    
    Route::post('/account-update/{id}', 'FrontendContributor\FrontendContributorController@myAccountAction')->name('contributor-account-update');
    Route::post('/ajax-payment-filter', 'FrontendContributor\FrontendContributorController@ajaxpaymentFilter')->name('ajaxContributorpaymentFilter');
    
    
    
});
Route::prefix('reseller')->group(function () {
    
    //Login
    Route::get('login', 'ResellerAuth\ResellerAuthController@showLoginForm')->name('resellerlogin');
    Route::post('login', 'ResellerAuth\ResellerAuthController@login')->name('resellerloginAction');
    Route::get('logout', 'ResellerAuth\ResellerAuthController@logout');
    
    Route::get('forgot-password', 'ResellerAuth\ResellerAuthController@showForgotPasswordForm')->name('resellerforgotpassword');
    
    Route::get('/sign-up', 'ResellerAuth\ResellerAuthController@signUp')->name('reseller-sign-up');
    Route::post('/sign-up', 'ResellerAuth\ResellerAuthController@signupAction')->name('resellersignupAction');
    Route::get('/change-password', 'ResellerAuth\ResellerAuthController@changePassword')->name('reseller-change-password');
    
    Route::get('/', 'FrontendResellerController@index')->name('resellerdashboard');
    Route::get('/dashboard', 'FrontendResellerController@index')->name('resellerdashboard');
    Route::get('/myAccount', 'FrontendResellerController@myAccount')->name('reselleraccount');
    Route::get('/edit-account/{user_id}', 'FrontendResellerController@editReseller')->name('reseller-edit-account');
    Route::get('/{code}', 'FrontendResellerController@saveResellerCodeSession');
    
    //Route::post('/update-password', 'UserController@updatePassword')->name('reseller-update-password');
    

    Route::post('/account-update/{id}', 'FrontendResellerController@myAccountAction')->name('reseller-account-update');
    Route::post('/payment-request', 'FrontendResellerController@paymentRequestAction')->name('resellerpaymentrequestAction');
    Route::post('/ajax-payment-filter', 'FrontendResellerController@ajaxpaymentFilter')->name('ajaxpaymentFilter');



});

//Course details
//Admin
Route::prefix('admin')->group(function () {

    //Login
    Route::get('login', 'AdminAuth\AuthController@showLoginForm');
    Route::post('admin/login', 'AdminAuth\AuthController@adminloginIIPARS');
    Route::post('login', 'AdminAuth\AuthController@login');
    Route::get('logout', 'AdminAuth\AuthController@logout');

    Route::get('/', 'AdminController@index');
    
    //Admin Profile Update
    Route::get('profile', 'AdminController@editAdmin');
    Route::post('admin-update', 'AdminController@adminUpdate');
    Route::post('admin-image', 'AdminController@adminImageUpdate');
    Route::post('admin-password-update', 'AdminController@adminPasswordUpdate');


    Route::get('users', 'AdminController@showUserList');
    Route::post('/ajax-user-list', 'AdminController@ajaxUserList');
    Route::any('user/create', 'AdminController@createUser');
    Route::get('user/edit/{id}', 'AdminController@editUser');
    Route::post('user-update/{id}', 'AdminController@editUserAction');
    //Route::post('user-image-update/{id}', 'AdminController@userImageUpdate');
    Route::post('user-password-update/{id}', 'AdminController@userPasswordUpdate');


    //Email & Mobile Number Exist or Not-Exist Ajax Validation
    Route::post('/email-exist', 'AdminController@emailExist');
    Route::post('/email-exist-update', 'AdminController@emailExistUpdate');
    Route::post('/mobile-number-exist', 'AdminController@mobileNumberExist');
    Route::post('/mobile-number-exist-update', 'AdminController@mobileNumberExistUpdate');

    //Email Template    
    Route::get('email-template', 'SettingsController@emailTemplatesList');
    Route::get('email-template/edit/{rid}', 'SettingsController@emailTemplatesEdit');
    Route::post('email-template/edit/{rid}', 'SettingsController@emailTemplatesEditAction');
    
    //General Site Setting
    Route::get('setting', 'SettingsController@general');
    Route::post('setting', 'SettingsController@generalAction');

    //Reseller Comission Settings
    Route::get('reseller-commission', 'SettingsController@resellerCommission')->name('showResellerCommission');
    Route::any('reseller-commission/save', 'SettingsController@ajaxsaveRcSlab')->name('saveResellerCommission');
    Route::any('reseller-commission/update', 'SettingsController@ajaxupdateRcSlab')->name('updateResellerCommission');
    Route::any('ajax-next-slab', 'SettingsController@nextSlabRow')->name('nextSlabRow');
    Route::any('reseller-commission/delete', 'SettingsController@deleteSlab')->name('deleteSlab');


    //Payment Gateway Setting
    Route::get('payment-setting', 'SettingsController@paymentGateway');
    Route::post('payment-setting', 'SettingsController@paymentGatewayAction');

    //CMS 
    Route::get('cms', 'SettingsController@listCms');
    Route::get('cms/add', 'SettingsController@addCms');
    Route::post('cms/add', 'SettingsController@addCmsAction');
    Route::get('cms/edit/{id}', 'SettingsController@editCms');
    Route::post('cms/edit/{id}', 'SettingsController@editCmsAction');

    //Category
    Route::get('category-list', 'SettingsController@listCategory');
    Route::get('add-category', 'SettingsController@addCategory');
    Route::post('add-category', 'SettingsController@addCategoryAction');
    Route::get('edit-category/{id}', 'SettingsController@editCategory');
    Route::post('edit-category/{id}', 'SettingsController@editCategoryAction');

    //Students
    Route::get('students', 'StudentController@showStudentList')->name('students');
    Route::post('/ajax-student-list', 'StudentController@ajaxStudentList');
    Route::any('student/create', 'StudentController@createStudent')->name('createStudent');
    Route::get('student/edit/{id}', 'StudentController@editStudent')->name('editStudent');
    Route::post('student-update/{id}', 'StudentController@editStudentAction')->name('student-update');
    //Route::post('user-image-update/{id}', 'StudentController@userImageUpdate');
    Route::post('student-password-update/{id}', 'StudentController@studentPasswordUpdate')->name('student-password-update'); 

    //Contributors
    Route::get('contributors', 'ContributorController@showContributorList')->name('contributors');
    Route::post('/ajax-contributor-list', 'ContributorController@ajaxContributorList')->name('contributor-list');
    Route::any('contributor/create', 'ContributorController@createContributor')->name('createContributor');
    Route::get('contributor/edit/{id}', 'ContributorController@editContributor')->name('editContributor');
    Route::post('contributor-update/{id}', 'ContributorController@editContributorAction')->name('contributor-update');
    Route::post('contributor-password-update/{id}', 'ContributorController@contributorPasswordUpdate')->name('contributor-password-update'); 
    Route::post('contributor-bankdetails-update/{id}', 'ContributorController@contributorBankDetailUpdate')->name('contributor-bankdetails-update'); 

    //Distributors
    Route::get('distributors', 'DistributorController@showDistributorList')->name('distributors');
    Route::post('/ajax-distributor-list', 'DistributorController@ajaxDistributorList')->name('distributor-list');
    Route::any('distributor/create', 'DistributorController@createDistributor')->name('createDistributor');
    Route::get('distributor/edit/{id}', 'DistributorController@editDistributor')->name('editDistributor');
    Route::post('distributor-update/{id}', 'DistributorController@editDistributorAction')->name('distributor-update');
    Route::post('distributor-password-update/{id}', 'DistributorController@distributorPasswordUpdate')->name('distributor-password-update'); 
    Route::post('/slug-exist', 'DistributorController@distributorSlugExist')->name('distributorSlugExist');
    Route::post('distributor-bankdetails-update/{id}', 'DistributorController@distributorBankDetailUpdate')->name('distributor-bankdetails-update'); 

    
    //Materials/items 
    Route::get('items', 'ItemController@listItem')->name('items');
    Route::post('/ajax-item-list', 'ItemController@ajaxItemList');
    Route::get('items/add', 'ItemController@addItem')->name('createItem');
    Route::post('items/add', 'ItemController@addItemAction')->name('addItemAction');
    Route::post('/ajax-item-image-list-admin', 'ItemController@ajaxItemImageList');
    Route::post('/ajax-item-image-remove-admin', 'ItemController@ajaxRemovePdffile');
    
    Route::post('/ajax-item-image-upload-admin', 'ItemController@ajaxItemImageUpload');
    
    Route::get('items/edit/{id}', 'ItemController@editItem')->name('editItem');
    Route::post('items/edit/{id}', 'ItemController@editItemAction')->name('editItemAction');
    Route::get('download-item/{media_id}', 'ItemController@downloadItem')->name('downloadItem');
    
    
    
    //Courses/products
    Route::get('courses', 'ProductController@listCourse')->name('courses');
    Route::post('/ajax-course-list', 'ProductController@ajaxCourseList')->name('ajaxCourseList');
    Route::get('course/add', 'ProductController@addCourse')->name('createCourse');
    Route::post('course/add', 'ProductController@addCourseAction')->name('addCourseAction');
    Route::post('/ajax-course-material-list-admin', 'ProductController@ajaxCourseMaterialList')->name('ajaxCourseMaterialList');
    Route::post('/ajax-course-material-list-edit', 'ProductController@ajaxEditCourseMaterialList')->name('ajaxEditCourseMaterialList');
    Route::post('/ajax-course-image-upload-admin', 'ProductController@ajaxCourseImageUpload');
    Route::get('courses/edit/{id}', 'ProductController@editCourse')->name('editCourse');
    Route::post('courses/edit/{id}', 'ProductController@editCourseAction')->name('editCourseAction');
    Route::post('/ajax-addcourse-exam-paper-list', 'ProductController@ajaxAddCourseExamPaper')->name('ajaxAddCourseExamPaper');
    Route::post('/ajax-addcourse-exam-paper-material', 'ProductController@ajaxAddCourseExamPaperMaterial')->name('ajaxAddCourseExamPaperMaterial');    
    Route::post('/ajax-product-delete', 'ProductController@ajaxProductDelete')->name('ajaxProductDelete');
    Route::post('/ajax-course-exam-paper', 'ProductController@ajaxCourseExamPaper')->name('ajaxCourseExamPaper'); 

    //Courses/Combo Course
    Route::get('combo-course', 'ComboCourseController@listComboCourse')->name('combo-course');
    Route::post('/ajax-combo-course-list', 'ComboCourseController@ajaxComboCourseList')->name('ajaxComboCourseList');
    Route::get('combo-course/add', 'ComboCourseController@addComboCourse')->name('createComboCourse');
    Route::post('combo-course/add', 'ComboCourseController@addComboCourseAction')->name('addComboCourseAction');
    Route::post('/ajax-combo-course-material-list-admin', 'ComboCourseController@ajaxComboCourseMaterialList')->name('ajaxComboCourseMaterialList');
    Route::post('/ajax-combo-course-material-list-edit', 'ComboCourseController@ajaxEditComboCourseMaterialList')->name('ajaxEditComboCourseMaterialList');
    Route::post('/ajax-course-image-upload-admin', 'ComboCourseController@ajaxComboCourseImageUpload');
    Route::get('combo-course/edit/{id}', 'ComboCourseController@editComboCourse')->name('editComboCourse');
    Route::post('combo-course/edit/{id}', 'ComboCourseController@editComboCourseAction')->name('editComboCourseAction');
    

    //Videos
    Route::get('videos', 'VideoController@showVideoList')->name('videos');
    Route::post('/ajax-video-list', 'VideoController@ajaxVideoList');
    Route::any('videos/create', 'VideoController@createVideo')->name('createVideo');
    Route::get('videos/edit/{id}', 'VideoController@editVideo')->name('editVideo');
    Route::post('videos/update/{id}', 'VideoController@editVideoAction')->name('videoUpdate');

    //Videos
    Route::get('testimonials', 'TestimonialController@showVideoList')->name('testimonials');
    Route::post('/ajax-testimonial-list', 'TestimonialController@ajaxTestimonialList');
    Route::any('testimonials/create', 'TestimonialController@createTestimonials')->name('createTestimonials');
    Route::get('testimonials/edit/{id}', 'TestimonialController@editTestimonial')->name('editTestimonial');
    Route::post('testimonials/update/{id}', 'TestimonialController@editVideoAction')->name('testimonialUpdate');

     //Coupon
    Route::get('coupons', 'CouponController@showCouponList')->name('coupons');
    Route::post('/ajax-coupon-list', 'CouponController@ajaxCouponList');
    Route::any('coupons/create', 'CouponController@createCoupons')->name('createCoupons');
    Route::get('coupons/edit/{id}', 'CouponController@editCoupon')->name('editCoupon');
    Route::post('coupons/update/{id}', 'CouponController@editCouponAction')->name('couponUpdate');

     //Subject
    Route::get('subjects', 'SubjectController@showSubjectList')->name('subjects');
    Route::post('/ajax-subject-list', 'SubjectController@ajaxSubjectList');
    Route::any('subjects/create', 'SubjectController@createSubjects')->name('createSubjects');
    Route::get('subjects/edit/{id}', 'SubjectController@editSubject')->name('editSubject');
    Route::post('subjects/update/{id}', 'SubjectController@editSubjectAction')->name('subjectUpdate');

     //Material
    Route::get('materials', 'MaterialController@showMaterialList')->name('materials');
    Route::post('/ajax-material-list', 'MaterialController@ajaxMaterialList');
    Route::any('materials/create', 'MaterialController@createMaterials')->name('createMaterials');
    Route::get('materials/edit/{id}', 'MaterialController@editMaterial')->name('editMaterial');
    Route::post('materials/update/{id}', 'MaterialController@editMaterialAction')->name('materialUpdate');

     //Exam
    Route::get('exams', 'ExamController@showExamList')->name('exams');
    Route::post('/ajax-exam-list', 'ExamController@ajaxExamList');
    Route::any('exams/create', 'ExamController@createExams')->name('createExams');
    Route::get('exams/edit/{id}', 'ExamController@editExam')->name('editExam');
    Route::post('exams/update/{id}', 'ExamController@editExamAction')->name('examUpdate');

    //Paper
    Route::get('papers', 'PaperController@showPaperList')->name('papers');
    Route::post('/ajax-paper-list', 'PaperController@ajaxPaperList');
    Route::any('papers/create', 'PaperController@createPapers')->name('createPapers');
    Route::get('papers/edit/{id}', 'PaperController@editPaper')->name('editPaper');
    Route::post('papers/update/{id}', 'PaperController@editPaperAction')->name('paperUpdate');
    
    //Exam Paper
    Route::get('exam-paper', 'ExamPaperController@showExamPaperList')->name('exam-paper');
    Route::post('/ajax-exam-paper-material-list', 'ExamPaperController@ajaxExamPaperList')->name('ajaxExamPaperList');
    Route::post('/ajax-exam-paper-list', 'ExamPaperController@ajaxExamPaper')->name('ajaxExamPaper');
    Route::any('exam-paper/create', 'ExamPaperController@createExamPaper')->name('createExamPaper');
    Route::get('exam-paper/edit/{id}', 'ExamPaperController@editExamPaper')->name('editExamPaper');
    Route::post('exam-paper/update/{id}', 'ExamPaperController@editExamPaperAction')->name('examPaperUpdate');
    
    //Exam Paper Material Content
    Route::get('exam-paper-material-content', 'ExamPaperController@showExamPaperMaterialContentList')->name('exam-paper-material-content');
    Route::post('/ajax-exam-paper-material-content-list', 'ExamPaperController@ajaxExamPaperMaterialContentList')->name('ajaxExamPaperMaterialContentList');    
    Route::any('exam-paper-material-content/create', 'ExamPaperController@createExamPaperMaterialContent')->name('createExamPaperMaterialContent');
    Route::get('exam-paper-material-content/edit/{id}', 'ExamPaperController@editExamPaperMaterialContent')->name('editExamPaperMaterialContent');
    Route::post('exam-paper-material-content/update/{id}', 'ExamPaperController@editExamPaperMaterialContentAction')->name('examPaperMaterialContentUpdate');
    Route::post('/ajax-subject-contributor-list', 'ExamPaperController@ajaxGetSubjectContributors')->name('ajaxSubjectContributor');    
    Route::post('/ajax-remove-material-content', 'ExamPaperController@ajaxdeleteMaterialContent')->name('ajaxdeleteMaterialContent');    
    
    Route::get('orders', 'OrderController@showOrderList')->name('orderList');
    Route::post('/ajax-orders-list', 'OrderController@ajaxOrderList')->name('ajaxOrderList');
    Route::get('order/{id}', 'OrderController@viewOrderDetails')->name('viewOrderDetails');
    Route::post('order', 'OrderController@viewOrderDetails')->name('viewOrderDetails');
    Route::post('/ajax-delete-order', 'OrderController@ajaxOrderDelete')->name('ajaxOrderDelete');

    Route::get('payment-request', 'PaymentController@showPaymentRequestList')->name('paymentRequestList');
    Route::post('/ajax-payment-request-list', 'PaymentController@ajaxPaymentRequestList')->name('ajaxpaymentRequestList');
    //Route::get('payment-request/{id}', 'PaymentController@viewPaymentRequestDetails')->name('viewpaymentRequestDetails');
    //Route::post('payment-request', 'PaymentController@viewPaymentRequestDetails')->name('viewpaymentRequestDetails');
    Route::any('payment-request-details/{id}', 'PaymentController@viewPaymentRequestDetails')->name('viewPaymentRequestDetails');
    Route::any('update-payment-request/{id}', 'PaymentController@updatePaymentRequestDetails')->name('updatePaymentRequestDetails');

  

    Route::get('newsletter', 'NewsLetterController@showNewsLetterList')->name('newsletter-list');
    Route::post('/ajax-newsletter-list', 'NewsLetterController@ajaxNewsLetterList')->name('ajax-newsletter-list');
    
    Route::get('contact-us', 'ContactUsController@showContactUsList')->name('contact-us');
    Route::post('/ajax-contact-list', 'ContactUsController@ajaxContactUsList')->name('ajax-contactus-list');

    Route::get('news-feed', 'NewsFeedController@showNotificationList')->name('newsfeed');
    Route::post('/ajax-newsfeed-list', 'NewsFeedController@ajaxNewsFeedList')->name('ajax-newsfeed-list');
    Route::any('newsfeed/create', 'NewsFeedController@createNewsFeed')->name('createNewsFeed');
    Route::get('newsfeed/edit/{id}', 'NewsFeedController@editNewsFeed')->name('editNewsFeed');
    Route::post('newsfeed/update/{id}', 'NewsFeedController@editNewsFeedAction')->name('newsFeedUpdate');


    Route::get('banner-slider', 'BannerSliderController@showBannerSliderList')->name('banner-slider');
    Route::post('/ajax-banner-slider', 'BannerSliderController@ajaxBannerSliderList')->name('ajax-banner-slider-list');
    Route::any('banner-slider/create', 'BannerSliderController@createBannerSlider')->name('create-banner-slider');
    Route::get('banner-slider/edit/{id}', 'BannerSliderController@editBannerSlider')->name('edit-banner-slider');
    Route::post('banner-slider/update/{id}', 'BannerSliderController@editBannerSliderAction')->name('update-banner-slider');

    Route::get('mentors', 'MentorController@showMentorList')->name('mentors');
    Route::post('/ajax-mentor-list', 'MentorController@ajaxMentorList')->name('ajax-mentor-list');
    Route::any('mentor/create', 'MentorController@createMentor')->name('createMentor');
    Route::get('mentor/edit/{id}', 'MentorController@editMentor')->name('editMentor');
    Route::post('mentor/{id}', 'MentorController@editMentorAction')->name('mentor-update');

    Route::get('articles', 'ArticleController@showArticleList')->name('article-list');
    Route::post('/ajax-article-list', 'ArticleController@ajaxArticleList')->name('ajaxArticleList');
    Route::any('article/create', 'ArticleController@createArticle')->name('createArticle');
    Route::get('article/edit/{id}', 'ArticleController@editArticle')->name('editArticle');
    Route::any('article-update/{id}', 'ArticleController@editArticleAction')->name('article-update');

    
    Route::get('article-categories', 'ArticleController@showcategoryList')->name('showcategoryList');
    Route::post('/ajax-article-list', 'ArticleController@ajaxArticleList')->name('ajaxArticleList');
    Route::any('article/categories/create', 'ArticleController@createCategory')->name('createCategory');
    Route::get('article/category/edit/{id}', 'ArticleController@editArticleCategory')->name('editArticleCategory');
    Route::post('article/category/{id}', 'ArticleController@editArticleCategoryAction')->name('editArticleCategoryAction');

    Route::get('banner', 'BannerController@createBanner')->name('showBanner');
    Route::any('banner/create', 'BannerController@createBanner')->name('createBanner');
    Route::any('banner/upload', 'BannerController@uploadImageCKeditor')->name('uploadImageCKeditor');

    Route::get('floater-signup', 'SettingsController@manageFloaterSignUp')->name('showFloaterSignUp');
    Route::any('floater-signup/create', 'SettingsController@manageFloaterSignUp')->name('saveFloaterSignUp');
    
    
    // Route::get('questions', 'QuestionsController@showQuestionList')->name('questionslist');
    // Route::post('/ajax-questions-list', 'QuestionsController@ajaxQuestionList')->name('ajaxQuestionList');
    // Route::any('questions/create', 'QuestionsController@createQuestion')->name('createQuestion');
    // Route::get('questions/edit/{id}', 'QuestionsController@editQuestion')->name('editQuestion');
    // Route::any('questions-update/{id}', 'QuestionsController@editQuestionAction')->name('editQuestionAction');

    Route::get('questions', 'QuestionsController@showMockQuestionList')->name('showMockQuestionList');
    Route::post('/ajax-questions-list', 'QuestionsController@ajaxMockQuestionList')->name('ajaxMockQuestionList');
    Route::any('questions/create', 'QuestionsController@createMockQuestion')->name('createQuestion');
    Route::get('questions/edit/{id}', 'QuestionsController@editMockQuestion')->name('editMockQuestion');
    Route::any('questions-update/{id}', 'QuestionsController@editMockQuestionAction')->name('editMockQuestionAction');
    Route::post('/ajax-delete-question', 'QuestionsController@ajaxQuestionDelete')->name('ajaxQuestionDelete');


    Route::get('mock-tests', 'PaidMockTestController@showAdminMockExamList')->name('mocktestlist');
    Route::post('/ajax-mock-tests-list', 'PaidMockTestController@ajaxAdminMockExamList')->name('ajaxmocktestlist');

    Route::get('mock-exams', 'MockTestController@showMockExamList')->name('mockexamlist');
    Route::post('/ajax-mock-exams-list', 'MockTestController@ajaxMockExamList')->name('ajaxmockexamlist');
    Route::any('result-declare', 'MockTestController@declareMockExamResult')->name('declareMockExamResult');
    Route::get('mock-exam/edit/{id}', 'MockTestController@editMockExam')->name('editMockExam');
    Route::any('question-answer-update/{id}', 'MockTestController@editMockExamAction')->name('editMockExamAction');
    
    Route::get('mock-test-categories', 'MockTemplateController@showQuestioncategoryList')->name('showMockcategoryList');
    Route::any('mock-test/categories/create', 'MockTemplateController@createQuestionCategory')->name('createMockCategory');
    Route::get('mock-test/category/edit/{id}', 'MockTemplateController@editQuestionCategory')->name('editMockCategory');
    Route::post('mock-test/category/{id}', 'MockTemplateController@editQuestionCategoryAction')->name('editMockCategoryAction');
    
    Route::get('mock-templates', 'MockTemplateController@showMockTemplateList')->name('showMockTemplateList');
    Route::post('/ajax-mock-templates-list', 'MockTemplateController@ajaxMockTemplateList')->name('ajaxMockTemplateList');
    Route::any('mock-template/create', 'MockTemplateController@createMockTemplate')->name('createMockTemplate');
    Route::get('mock-template/edit/{id}', 'MockTemplateController@editMockTemplate')->name('editMockTemplate');
    Route::post('mock-template/{id}', 'MockTemplateController@editMockTemplateAction')->name('editMockTemplateAction');


    Route::get('mock-template-details', 'MockTemplateController@showMockTemplateDetailsList')->name('showMockTemplateDetailsList');
    Route::post('/ajax-mock-template-detail-list', 'MockTemplateController@ajaxMockTemplateDetailsList')->name('ajaxMockTemplateDetailsList');
    Route::any('mock-template-detail/create', 'MockTemplateController@createMockTemplateDetails')->name('createMockTemplateDetails');
    Route::get('mock-template-detail/edit/{id}', 'MockTemplateController@editMockTemplateDetails')->name('editMockTemplateDetails');
    Route::post('mock-template-detail/{id}', 'MockTemplateController@editMockTemplateDetailsAction')->name('editMockTemplateDetailsAction');

    Route::get('mock-tabulation-rule', 'MockTabulationRuleController@show')->name('showMockTabRuleList');
    Route::post('/ajax-mock-tabulation-rule-list', 'MockTabulationRuleController@ajaxList')->name('ajaxMockTabRuleList');
    Route::any('mock-tabulation-rule/create', 'MockTabulationRuleController@create')->name('createMockTabRule');
    Route::get('mock-tabulation-rule/edit/{id}', 'MockTabulationRuleController@edit')->name('editMockTabRule');
    Route::post('mock-tabulation-rule/{id}', 'MockTabulationRuleController@update')->name('editMockTabRuleAction');


    Route::get('mock-tabulation-rule-details', 'MockTabulationRuleController@showDetailsList')->name('showMockTabRuleDetailsList');
    Route::post('/ajax-mock-tabulation-rule-detail-list', 'MockTabulationRuleController@ajaxDetailsList')->name('ajaxMockTabRuleDetailsList');
    Route::any('mock-tabulation-rule-detail/create', 'MockTabulationRuleController@createDetails')->name('createMockTabRuleDetails');
    Route::get('mock-tabulation-rule-detail/edit/{id}', 'MockTabulationRuleController@editDetails')->name('editMockTabRuleDetails');
    Route::post('mock-tabulation-rule-detail/{id}', 'MockTabulationRuleController@editDetailsAction')->name('editMockTabRuleDetailsAction');

    Route::get('mock-question-levels', 'MockQuestionLevelController@showQuestionLevelList')->name('showQuestionLevelList');
    Route::post('/ajax-mock-question-level-list', 'MockQuestionLevelController@ajaxQuestionLevelList')->name('ajaxQuestionLevelList');
    Route::any('mock-test/categories/create', 'MockQuestionLevelController@createQuestionLevel')->name('createQuestionLevel');
    Route::get('mock-test/category/edit/{id}', 'MockQuestionLevelController@editQuestionLevel')->name('editQuestionLevel');
    Route::post('mock-test/category/{id}', 'MockQuestionLevelController@editQuestionLevelAction')->name('editQuestionLevelAction');
    
    //Mock Test Setting
    Route::get('mock-test/setting', 'MockTestController@settings')->name('showSettingsForm');
    Route::post('mock-test/setting', 'MockTestController@settingsAction')->name('settingsAction');
    
});




Route::get('{url}', 'CmsController@showCms'); //To be alwayes at last line of page  
