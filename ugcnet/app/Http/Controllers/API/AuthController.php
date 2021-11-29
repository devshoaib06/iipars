<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use App\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;
use App\ApiUser;
use Laravel\Passport\HasApiTokens;
use Str;


class AuthController extends Controller 
{
    use HasApiTokens;
    public $successStatus = 200;
    /** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
    */ 
    private $apiToken;
    public function __construct()
    {
        // Unique Token
        $this->apiToken = uniqid(base64_encode(Str::random(60)));
    }

    public function authenticateClient(Request $request){ 
        //return $request;
        $user = ApiUser::where('user',$request->getUser())
        ->where('password', md5($request->getPassword()))
        ->first();
        
        if($user){
           $token =  $this->apiToken;
          // $token =  "asaas";
            //return $token;
            $user->api_token =$token;

            $user->update();            

            $returndata=[
                'success' => 1,
                'token'=>$token,
                'message'=>'Success',
            ];
            return response()->json($returndata, $this-> successStatus); 
        } 
        else{ 
            $returndata=[
                'success' => 0,
                'message'=>'Invalid user credentials',
               
            ];
            return $returndata;
            return response()->json($returndata, $this-> successStatus); 
            
        } 
    }
    
}