<?php

namespace App\library;

//use App\User;
use App\Models\Admin;
use App\Models\User;
use Intervention\Image\Facades\Image; // Use this if you want facade style code
use App\Models\WorkCategory;
use App\Models\Country;
use App\Models\Skill;
use App\Models\FreelancerSkill;
use App\Models\MessageMaster;
use App\Models\Timezone;
use App\Models\NotificationMaster;
use App\Models\MessageAttachment;
use App\Models\CmsMaster;
use App\Models\UserFavorite;
use App\ProductContributorItemRelation;
use App\ComboProductContributorRelation;
use App\ExamMaster;
use App\Product;
use App\MaterialMaster;
use App\SubjectMaster;
use App\ExamPaperMaterialContent;

use Illuminate\Support\Facades\DB;
use Storage;
use Str;
use Auth;
class myFunctions {

    public function is_ok() {
        return 'myFunction is OK';
    }

    public function randString($digits) {

        $alphanum = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

        // generate the random string

        $rand = substr(str_shuffle($alphanum), 0, $digits);

        $time = time();



        $val = $time . $rand;

        return $val;
    }

    public static function dispMsgWithEmoji($msg_text, $words) {

        $counter = 1;
        $msg_array = array();
        $message = '';

        $msg_text = preg_replace("/<div>(.*?)<\/div>/", "$1", $msg_text);

        $expl = explode("<br>", $msg_text);



        // Only need 3 line data.
        $str = '';
        $max_br = 2;

        if (is_array($expl)) {
            for ($cnt = 0; $cnt < count($expl); $cnt++) {


                if ($max_br >= $cnt) {
                    if ($expl[$cnt] != '') {

                        $str .= $expl[$cnt] . ' <br />';
                    }
                }
            }

            $full_msg_text = $str;
        } else {
            $full_msg_text = $msg_text;
        }


        $msg_slipt_emoji = preg_split("/(<[^>]*[^\/]>)/i", $full_msg_text, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        if (count($msg_slipt_emoji) > 0) {

            foreach ($msg_slipt_emoji as $val) {

                if (preg_match("/<img[^>]+\>/i", $val)) {

                    if ($counter <= $words) {

                        array_push($msg_array, $val);

                        $counter++;
                    }
                } else {

                    $non_emoji_elements = preg_split("/[\s,]+/", $val);

                    foreach ($non_emoji_elements as $element) {

                        if ($element != '') {

                            if ($counter <= $words) {

                                array_push($msg_array, $element);

                                $counter++;
                            }
                        }
                    }
                }
            }
        }

        # print("<pre>");
        # print_r($msg_array);

        if (count($msg_array) > 0) {

            $message = implode(" ", $msg_array);
        }

        return $message;
        //return preg_replace("/<div>(.*?)<\/div>/", "$1", $message);
    }

    public static function dispMsgWithEmojiPDF($msg_text, $emoji_path = null) {

        $counter = 1;
        $msg_array = array();
        $message = '';

        $msg_slipt_emoji = preg_split("/(<[^>]*[^\/]>)/i", $msg_text, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        if (count($msg_slipt_emoji) > 0) {

            foreach ($msg_slipt_emoji as $val) {

                if (preg_match("/<img[^>]+\>/i", $val)) {

                    $alt = '';
                    $img = '';
                    preg_match_all('/alt=\"(.*?)\"(.*?)>/si', $val, $out, PREG_SET_ORDER);

                    if (!empty($out) && count($out[0]) > 1) {
                        $alt = $out[0][1];

                        $emoji_icon = config('emoji.' . $alt);

                        if ($emoji_path != null) {
                            $emoji_icon_path = url("public/frontend/emoji_icons/");
                            $emoji_icon_url = $emoji_icon_path . "/" . $emoji_icon;
                        } else {
                            $emoji_icon_path = config('path.emoji_icon_path');
                            $emoji_icon_url = $emoji_icon_path . $emoji_icon;
                        }





                        $img = '<img src="' . $emoji_icon_url . '"  width="20">';

                        array_push($msg_array, $img);
                    }
                } else {

                    $non_emoji_elements = preg_split("/[\s,]+/", $val);

                    foreach ($non_emoji_elements as $element) {

                        if ($element != '') {

                            array_push($msg_array, $element);
                        }
                    }
                }
            }
        }

        if (count($msg_array) > 0) {

            $message = implode(" ", $msg_array);
        }


        return $message;
    }

    public function resize($image, $size_path) {
        try {
            $extension = $image->getClientOriginalExtension();
            $imageRealPath = $image->getRealPath();
            $imageName = $this->randString(8); //'thumb_'. $image->getClientOriginalName();

            $imageName = $imageName . "." . $extension;

            //$imageManager = new ImageManager(); // use this if you don't want facade style code
            //$img = $imageManager->make($imageRealPath);

            foreach ($size_path as $v) {

                $img = Image::make($imageRealPath); // use this if you want facade style code
                if (!isset($v['height'])) {
                    $v['height'] = null;
                }

                $img->resize(intval($v['size']), $v['height'], function($constraint) {
                    $constraint->aspectRatio();
                });


                $img->save($v['path'] . $imageName);
            }

            return $imageName;
        } catch (Exception $e) {
            return false;
        }
    }

    /* public function upload_file($file, $path, $new_name = null) {

      if($new_name == null || $new_name == ""){
      $extension = $file->getClientOriginalExtension();

      $fileName_only = $this->randString(8); //'thumb_'. $image->getClientOriginalName();

      $fileName = $fileName_only . "." . $extension;
      } else {
      $extension = $file->getClientOriginalExtension();

      $fileName_only = $this->randString(8);
      $fileName = $new_name;
      }
      $file->move($path, $fileName);

      $arr_return = array();

      $arr_return[0] = $fileName_only;
      $arr_return[1] = $extension;

      //return $fileName;
      return $arr_return;
      } */

    public function upload_file($file, $path, $location_pic = NULL) {
        $extension = $file->getClientOriginalExtension();
        $fileName_only = $this->randString(8);
        if ($location_pic) {
            $fileName = $location_pic;
        } else {
            $fileName = $fileName_only . "." . $extension;
        }
        $file->move($path, $fileName);
        $arr_return = array();
        $arr_return[0] = $fileName_only;
        $arr_return[1] = $extension;
        //return $fileName;
        return $arr_return;
    }

    public static function userImage($user_id, $folder = "thumb")
    {
        $userDetails = User::where('id', $user_id)->get();
        if ($userDetails->count()) {
            $profile_image = $userDetails[0]->image;
        } else {
            $profile_image = "";
        }


        $exists = Storage::disk('s3')->exists(config("constants.s3_folder") . $profile_image);
        if ($exists) {
            Storage::disk('s3')->setVisibility(config("constants.s3_folder") . $profile_image, 'public');
            $val = Storage::disk('s3')->temporaryUrl(config("constants.s3_folder") . $profile_image, now()->addSeconds(10));
            
        } else {
            if ($profile_image == "") {
                $profile_image = "profile-img.png";
            }

            switch ($folder) {
                case "thumb":
                    $image_path = config('path.user_image') . 'thumb/';
                    break;

                case "preview":
                    $image_path = config('path.user_image') . 'preview/';
                    break;
            }

            $val = $image_path . $profile_image;
        }







        return $val;
    }
	
	public static function userImagePublic($user_id, $folder = "thumb") {


        $userDetails = User::where('id', $user_id)->get();

        if ($userDetails->count()) {
            $profile_image = $userDetails[0]->image;
        } else {
            $profile_image = "";
        }


        $exists = Storage::disk('s3')->exists(config("constants.s3_folder") . $profile_image);
        if ($exists) {
            Storage::disk('s3')->setVisibility(config("constants.s3_folder") . $profile_image, 'public');
            //$val = Storage::disk('s3')->temporaryUrl(config("constants.s3_folder") . $profile_image, now()->addSeconds(60));
			$val = Storage::disk('s3')->url(config("constants.s3_folder") . $profile_image);
            
        } else {
            if ($profile_image == "") {
                $profile_image = "profile-img.png";
            }

            switch ($folder) {
                case "thumb":
                    $image_path = config('path.user_image') . 'thumb/';
                    break;

                case "preview":
                    $image_path = config('path.user_image') . 'preview/';
                    break;
            }

            $val = $image_path . $profile_image;
        }







        return $val;
    }

    public static function adminImage($user_id, $folder = "thumb") {


        $userDetails = Admin::where('id', $user_id)->get();

        if ($userDetails->count()) {
            $profile_image = $userDetails[0]->image;
        } else {
            $profile_image = "";
        }

        if ($profile_image == "") {
            //$profile_image = "profile-img.png";
            $profile_image = "porfilepic.jpg";
        }

        switch ($folder) {
            case "thumb":
                $image_path = config('path.user_image') . 'thumb/';
                break;

            case "preview":
                $image_path = config('path.user_image') . 'preview/';
                break;
        }

        $val = $image_path . $profile_image;

        return $val;
    }

    public static function portfolioImage($image_name, $folder = "thumb") {

        if ($image_name == "") {
            //$image_name = "portfolio-img.png";
            $image_name = "portfolio-img.jpg";
        }

        switch ($folder) {
            case "thumb":
                $image_path = config('path.portfolio_image') . 'thumb/';
                break;

            case "preview":
                $image_path = config('path.portfolio_image') . 'preview/';
                break;
        }

        $val = $image_path . $image_name;

        return $val;
    }

    public static function userName($user_id, $type = "full") {

        $name = "";

        if ($user_id) {
            $userDetails = User::where('id', $user_id)->get();

            if ($userDetails->count()) {
                $first_name = $userDetails[0]->first_name;
                $last_name = $userDetails[0]->last_name;
                $username = $userDetails[0]->username;

                $s_last_name = substr($last_name, 0, 1);
            }


            switch ($type) {
                case "full":
                    $name = ucfirst($first_name) . " " . ucfirst($last_name);
                    break;

                case "sort":
                    $name = ucfirst($first_name) . " " . ucfirst($s_last_name) . ".";
                    break;

                case "usrnm":
                    $name = ucfirst($username);
                    break;

                case "fname":
                    $name = ucfirst($first_name);
                    break;
            }
        }

        return $name;
    }

    public static function userCountry($user_id) {


        $userDetails = User::where('user_id', $user_id)->get();

        if ($userDetails->count()) {
            $country_id = $userDetails[0]->country_id;
        }


        $country = Country::where('country_id', $country_id)->get();

        if ($country->count()) {
            $country_name = $country[0]->country_name;
        } else {
            $country_name = "";
        }


        return $country_name;
    }

    public static function getCountry($c_id) {

        $country = Country::where('country_id', $c_id)->get();

        if ($country->count()) {
            $country_name = $country[0]->country_name;
        } else {
            $country_name = "";
        }


        return $country_name;
    }

    public static function getWorkCategoryNameById($id) {

        $workCategory = WorkCategory::where('id', $id)->get();

        if ($workCategory->count()) {
            $category_name = $workCategory[0]->name;
        } else {
            $category_name = "";
        }


        return $category_name;
    }

    public static function userInterest($uid) {

        $interest_txt = "";

        $user_interest = \App\Models\UserInterest::where('status', '1')->where('user_id', $uid)->get();
        foreach ($user_interest as $v) {

            $interest_data = \App\Models\Interest::where('status', '1')->where('id', $v->interest_id)->get();

            $interest = $interest_data[0];


            $interest_txt .= '' . $interest->name . ', ';
        }

        if ($interest_txt != '') {
            $l = strlen($interest_txt);
            $interest_txt = substr($interest_txt, 0, $l - 2);
        } else {
            $interest_txt = "No Record Found";
        }

        return $interest_txt;
    }

    public static function getCountryData($country_id) {

        $data = Country::where('country_id', $country_id)->first();

        return $data;
    }

    public static function dateText($date, $format = null) {

        $pos = strpos($date, '0000-00-00');

        if ($pos === false) {

            $client_time_zone = 'Pacific/Auckland';
            //$client_time_zone = 'America/New_York';
            //$client_time_zone = 'Asia/Calcutta';			
            if ((\Auth::check() && \Auth::user()->timezone_id == 1)) {
                $client_time_zone = \Auth::user()->timezone_id;
            }
            $server_tiem_zone = date_default_timezone_get();
            $dt = $date;
            $date = new \DateTime($dt, new \DateTimeZone($server_tiem_zone));
            $date->setTimezone(new \DateTimeZone($client_time_zone));
            $date = $date->format('Y-m-d H:i:s');




            //$dateText = date("M jS, Y", strtotime($date));
            if ($format == 'full') {
                $dateText = date("F j, Y", strtotime($date));
            } elseif ($format == 'detl') {
                $dateText = date("F j, Y, g:i a", strtotime($date));
            } elseif ($format == 'time') {
                $dateText = date("g:i A", strtotime($date));
            } elseif ($format == 'full_all') {
                $dateText = date("F j, Y G:i:s", strtotime($date));
            } elseif ($format == 'full_m_y') {
                //January 2012
                $dateText = date("F Y ", strtotime($date));
            } elseif ($format == 'd_m_y') {
                //6/10/2016 
                $dateText = date("d/m/Y ", strtotime($date));
            } elseif ($format == 'mm/dd/yy') {
                //06/10/2016 
                $dateText = date("m/d/Y ", strtotime($date));
            } elseif ($format == 'd.m.y') {
                //10.6.2016 
                $dateText = date("d.m.Y", strtotime($date));
            } elseif ($format == 'm_d_y') {
                //June 08, 2016
                $dateText = date("F d, Y ", strtotime($date));
            } elseif ($format == 'sm_d_y') {
                //Aug 08, 2016
                $dateText = date("M d, Y ", strtotime($date));
            } elseif ($format == 'd/m/y-h:m') {
                //12/09/2013 09:20:45
                $dateText = date("d/m/Y G:i", strtotime($date));
            } elseif ($format == 'm_d_y-h_m-A-e') {
                //May 10, 2016 at 02:54 PM IST
                $dateText = date("F d, Y", strtotime($date)) . ' at ' . date("G:i A T", strtotime($date));
            } elseif ($format == 'm/d/y-h:m') {
                //12/09/2013 09:20:45
                //$dateText = date("m/d/Y G:i", strtotime($date));
                $dateText = date("m/d/Y h:i a", strtotime($date));
            } elseif ($format == 'm/d/y_H:i:s') {
                //02/15/2013 13:20:45                
                $dateText = date("m/d/Y H:i:s", strtotime($date));
            } elseif ($format == 'jS_M_y') {
                //1st Jan,19              
                $dateText = date("jS M,y", strtotime($date));
            } elseif ($format == 'jS_M_y_full') {
                //1st Jan 2019              
                $dateText = date("jS M Y", strtotime($date));
            } elseif ($format == 'D') {
                //  Mon through Sun              
                $dateText = date("D", strtotime($date));
            } else {
                //$dateText = date("F Y", strtotime($date));
                $dateText = $date;
            }
        } else {
            $dateText = '-';
        }

        return $dateText;
    }

    public static function dateTextUserToServer($date, $format = null) {

        //$client_time_zone = Auth::guard('admins')->user()->timezone;
        //$client_time_zone = 'America/New_York';        
        //$client_time_zone = 'Asia/Calcutta';
        $client_time_zone = 'Pacific/Auckland';
        //$client_time_zone = 'America/New_York';
        //$client_time_zone = 'Asia/Calcutta';			
        if ((\Auth::check() && \Auth::user()->timezone_id == 1)) {
            $client_time_zone = \Auth::user()->timezone_id;
        }
        $server_tiem_zone = date_default_timezone_get();
        $dt = $date;
        $date = new \DateTime($dt, new \DateTimeZone($client_time_zone));
        $date->setTimezone(new \DateTimeZone($server_tiem_zone));
        $date = $date->format('Y-m-d H:i:s');


        if ($format == 'dt') {
            //2017-09-06
            $dateText = date("Y-m-d", strtotime($date));
        } elseif ($format == 'dt_tm') {
            //2017-09-06 21:11:42
            $dateText = date("Y-m-d G:i:s", strtotime($date));
        } else {
            $dateText = $date;
        }


        return $dateText;
    }

    public static function userOnlineStatus($user_id) {

        $status = 0;
        $userDetails = User::where('user_id', $user_id)->get();

        if ($userDetails->count()) {
            $online_datetime = $userDetails[0]->online_datetime;

            $time_diff = strtotime(date("Y-m-d H:i:s")) - strtotime($online_datetime);

            if ($time_diff > 10) {
                $status = 0;
            } else {
                $status = 1;
            }
        }

        return $status;
    }

    public static function messageRead($message_id, $message_to) {

        $user_id = \Auth::id();

        if ($user_id == $message_to) {
            $MessageMaster = MessageMaster::find($message_id);
            $user_data = [
                'message_to_read' => '1'
            ];
            $MessageMaster->update($user_data);
        }
    }

    public static function getTimezoneName($timezone_id) {

        $data = Timezone::where([['timezone_id', $timezone_id],])->get();
        $timezone = "";
        if ($data->count()) {
            $timezone = $data[0]->name;
        }
        return $timezone;
    }

    public static function getMessageAttachment($message_id) {

        $message_attachment = MessageAttachment::where([['status', '1'], ['message_id', $message_id],])->get();

        return $message_attachment;
    }

    public static function notificationRead($id) {

        //$user_id = \Auth::id();

        $NotificationMaster = NotificationMaster::find($id);
        $user_data = [
            'read_status' => '1'
        ];
        $NotificationMaster->update($user_data);
    }

    public static function bannerImage($image_name, $folder = "thumb") {

        if ($image_name == "") {
            //$image_name = "portfolio-img.png";
            //$image_name = "portfolio-img.jpg";
            $image_name = "default.png";
        }

        switch ($folder) {
            case "thumb":
                $image_path = config('path.banner_image') . 'thumb/';
                break;

            case "preview":
                $image_path = config('path.banner_image') . 'preview/';
                break;

            case "original":
                $image_path = config('path.banner_image') . 'original/';
                break;
        }

        $val = $image_path . $image_name;

        return $val;
    }

    public static function partnerImage($image_name, $folder = "thumb") {

        if ($image_name == "") {
            $image_name = "default.png";
        }

        switch ($folder) {
            case "thumb":
                $image_path = config('path.partner_image') . 'thumb/';
                break;

            case "preview":
                $image_path = config('path.partner_image') . 'preview/';
                break;

            case "original":
                $image_path = config('path.partner_image') . 'original/';
                break;
        }

        $val = $image_path . $image_name;

        return $val;
    }

    public static function contentCms($url) {

        $data = CmsMaster::where('url', $url)->get();

        return $data[0];
    }

    public static function memberFavoriteBtn($fid, $uid) {

        //$lang = \App::getLocale();
        //$user_id = \Auth::id();
        $icon_heart = "";



        $hasHoatelInList = UserFavorite::where([['status', '1'], ['user_id', $uid], ['member_id', $fid]])->get();
        $hasHoatelInList_count = $hasHoatelInList->count();

        if ($hasHoatelInList_count) {
            //$icon_heart .= '<a href="javascript:void(0)"><i class="fa fa-heart" aria-hidden="true"></i></a>';

            $icon_heart .= '<a class="add-to-wishlist" href="javascript:void(0)" onClick="removeFromFavorite(' . $fid . ')"><img src="' . config('path.frontend_path') . 'images/little-heart.png" alt="" /></a>';
        } else {
            $icon_heart .= '<a class="add-to-wishlist" href="javascript:void(0)" onClick="addToFavorite(' . $fid . ')"><img src="' . config('path.frontend_path') . 'images/wishlist.png" alt="" /></a>';

            //$icon_heart .= '<a href="javascript:void(0)" onClick="addToWishList(' . $fid . ',' . $uid . ')"><i class="fa fa-heart-o" aria-hidden="true"></i></a>';
        }


        echo $icon_heart;
    }

    public static function memberLikeBtn($mid, $uid) {

        $icon_like = "";

        $result = \App\Models\UserLike::where([['status', '1'], ['user_id', $uid], ['member_id', $mid]])->get();
        $result_count = $result->count();

        if ($result_count) {

            $icon_like .= '<a href="javascript:void(0)" onClick="removeFromLike(' . $mid . ')"><img src="' . config('path.frontend_path') . 'images/like.png" alt="" /></a>';
        } else {
            $icon_like .= '<a href="javascript:void(0)" onClick="addToLike(' . $mid . ')"><img src="' . config('path.frontend_path') . 'images/not-like.png" alt="" /></a>';
        }


        echo $icon_like;
    }

    public static function memberMatchRequest($uid) {

        $userMaster = DB::table('user_master as um')
                ->leftJoin('user_favourite as uf', 'uf.user_id', '=', 'um.id')
                ->where('um.status', '=', '1')
                ->where('um.user_type', '=', '5')
                //->where('um.id', '!=', $uid)
                ->where('uf.member_id', $uid)
                ->orderBy('um.created_at', 'desc')
                ->skip(0)
                ->take(5)
                ->get();

        $html = "";

        if (count($userMaster)) {
            foreach ($userMaster as $v) {
                $image_path = config('path.user_image') . 'thumb/' . $v->image;                          
                
                $exists = Storage::disk('s3')->exists(config("constants.s3_folder") . $v->image);
                if ($exists) {
                    Storage::disk('s3')->setVisibility(config("constants.s3_folder") . $v->image, 'public');
                    $image_path = Storage::disk('s3')->temporaryUrl(config("constants.s3_folder") . $v->image, now()->addSeconds(10));
                } 
                
                $html .= '<a href=member/' . $v->username . '><img src="' . $image_path . '"  alt="' . $v->username . '" class="thumb-image" /></a>';
            }
        } else {
            $html = "No record";
        }

        return $html;
    }

    public static function memberMatch($uid) {

        $userMaster = DB::table('user_master as um')
                ->leftJoin('user_match as umt', 'umt.member_id', '=', 'um.id')
                ->where('um.status', '=', '1')
                ->where('um.user_type', '=', '5')
                //->where('um.id', '!=', $uid)
                ->where('umt.user_id', $uid)
                ->orderBy('um.created_at', 'desc')
                ->skip(0)
                ->take(5)
                ->get();

        $html = "";

        if (count($userMaster)) {
            foreach ($userMaster as $v) {
                $image_path = config('path.user_image') . 'thumb/' . $v->image;
                
                $exists = Storage::disk('s3')->exists(config("constants.s3_folder") . $v->image);
                if ($exists) {
                    Storage::disk('s3')->setVisibility(config("constants.s3_folder") . $v->image, 'public');
                    $image_path = Storage::disk('s3')->temporaryUrl(config("constants.s3_folder") . $v->image, now()->addSeconds(10));
                } 
                
                $html .= '<a href=member/' . $v->username . '><img src="' . $image_path . '"  alt="' . $v->username . '" class="thumb-image" /></a>';
            }
        } else {
            $html = "No record";
        }

        return $html;
    }

    public static function memberOnline($uid) {

        $search_gender = \Auth::user()->search_gender;


        $userMaster = DB::table('user_master as um')
                //->leftJoin('user_favourite as uf', 'uf.user_id', '=', 'um.id')                        
                ->where('um.status', '=', '1')
                ->where('um.user_type', '=', '5')
                ->where('um.online_status', '=', '1')
                ->where('um.sex', '=', $search_gender)
                ->where('id', '!=', $uid)
                ->orderBy('um.created_at', 'desc')
                ->skip(0)
                ->take(5)
                ->get();

        $html = "";

        if (count($userMaster)) {
            foreach ($userMaster as $v) {
                $image_path = config('path.user_image') . 'thumb/' . $v->image;
                
                $exists = Storage::disk('s3')->exists(config("constants.s3_folder") . $v->image);
                if ($exists) {
                    Storage::disk('s3')->setVisibility(config("constants.s3_folder") . $v->image, 'public');
                    $image_path = Storage::disk('s3')->temporaryUrl(config("constants.s3_folder") . $v->image, now()->addSeconds(10));
                } 
                
                $html .= '<a href=member/' . $v->username . '><img src="' . $image_path . '"  alt="' . $v->username . '" class="thumb-image" /></a>';
            }
        } else {
            $html = "No record";
        }


        return $html;
    }
    
    public static function getContributorItemPrice($item,$product_id){
        $contributor_id=$item->contributor_id;
        $item_id=$item->item_id;

        $result=ProductContributorItemRelation::where([
            'contributor_id'=>$contributor_id,
            'item_id'=>$item_id,
            'product_id'=>$product_id,
        ])->first();

        return @$result->price;

    }

    public static function getProductName($product_id){
        
        $result=Product::where([
            'product_id'=>$product_id,
        ])->first();

        return @$result->name;

    }

    public function getMaterialName($materialid)
    {
        $material=MaterialMaster::find($materialid);

        return @$material->material_name;
    }
    public function getSubjectName($subject_id)
    {
        $subject=SubjectMaster::find($subject_id);

        return $subject->subject_name;
    }
    public function getExamName($exam_id)
    {
        $subject=ExamMaster::find($exam_id);

        return $subject->exam_name;
    }
    public function getPaperName($paper_id)
    {
        $paper=\App\PaperMaster::find($paper_id);

        return $paper->paper_name;
    }

    public function getExamPaper($exam_id)
    {
        $paper=\App\PaperMaster::where('exam_id',$exam_id)->where('status',1)->get();

        return $paper;
    }

    public static function checkRelatedProduct($product_id,$combo_id){
        
        $result=ComboProductContributorRelation::where([
            'combo_id'=>$combo_id,
            'product_id'=>$product_id
        ])->exists();
        /*dd($result);*/
        return $result;

    }
    public static function checkRelatedContributor($product_id,$contributor_id,$combo_id){
        
        /*$result=ComboProductContributorRelation::where([
            'combo_id'=>$combo_id,
            'contributor_id'=>$contributor_id
        ])->exists();*/

        $result=DB::table('combo_product_contributor_relations as cpcr')
                //->join('combo_products_product_relations as cppr','cpcr.combo_id','cppr.combo_id')
                ->select('cpcr.combo_id','cpcr.contributor_id','cpcr.product_id')
                ->where('cpcr.combo_id',$combo_id)
                ->where('cpcr.contributor_id',$contributor_id)
                ->where('cpcr.product_id',$product_id)
                ->distinct('cpcr.product_id')
                ->count();
        /*dd($result);*/
        return @$result;

    }
    
    public function parseYouTubeUrl($url)
    {
        $pattern = '#^(?:https?://)?(?:www\.)?(?:m\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
        preg_match($pattern, $url, $matches);
        return (isset($matches[1])) ? $matches[1] : false;
    }
    
    public function getCourseVideos($course_id)
    {
        $videoMaster = DB::table('videos as v')
                ->select('v.title','v.video_url')
                ->join('product_video_relations as pvr', 'pvr.video_id', '=', 'v.id')
                ->where('v.status', '=', '1')
                ->where('pvr.product_id', $course_id)
                ->orderBy('v.created_at', 'desc')
                ->get();
                
        if (count($videoMaster)) {
            return $videoMaster;
        }
        else
        {
            return false;
        }
    }

    
    public function checkRelatedContentContributor($content_id,$contributor_id){       
        //dd($contributor_id);
        $result=\App\ExamPaperMaterialContributor::where('exam_paper_material_content_id',$content_id)
                ->where('contributor_id',$contributor_id)
                ->first();
        
        return @$result;

    }

    public function getRelatedMaterialContent($data){
        $exam_paper_material_content=ExamPaperMaterialContent::where($data)
        ->where('status',1)
        ->first();
        
        @$medias=\App\Media::where('exam_paper_material_content_id',$exam_paper_material_content->id)->get();

        return $medias;

    }
    public function getRelatedMaterial($product_id){
        //$product_id=$course_id;
            $data_msg = array();
            $products=Product::select('name','short_description','category_id','price','revised_price','image')
                     ->where('product_id',$product_id)->first();
            $course_infos=\App\CourseStructureRelation::where('product_id',$product_id)->first();
            
            $data_msg['relatedexam']="";
            $data_msg['allPapers']=$data_msg['relatedSubjects']=$data_msg['content_info']=$content_info=[];
            
            if($course_infos){
                
                $course_data=json_decode($course_infos->course_data);
                $material_array=array();
                foreach($course_data as $exam){
                    foreach($exam as $key=>$materials){
                        foreach($materials[0] as $material){
                            $materialinfo=MaterialMaster::where('id',$material)->first();
                            $material_details=array(
                                'material_name'=> $materialinfo->material_name,
                                'material_id'=>$material,
                            );
                            $material_array[]=$material_details;
                        } 
                    }  
                }

                return $material_array;
            }

    }

    public function getMaterialInfo($product_id)
    {
        
            $data_msg = array();
            $products=Product::select('name','short_description','category_id','price','revised_price','image')
                     ->where('product_id',$product_id)->first();
            $course_infos=\App\CourseStructureRelation::where('product_id',$product_id)->first();
            
            $data_msg['relatedexam']="";
            $data_msg['allPapers']=$data_msg['relatedSubjects']=$data_msg['content_info']=$content_info=[];
            //echo "<pre>";
            if($course_infos){
                
                $course_data=json_decode($course_infos->course_data);
                $course_subjects=json_decode($course_infos->course_subject);
                
                //print_r($course_subjects);die;
                $exam_id=key($course_data);
                
                $data_msg['relatedexam']=key($course_data);
                $relatedPapers=array();
                $relatedmaterials=array();
                foreach($course_data as $exam){
                    foreach($exam as $key=>$materials){
                        foreach($materials[0] as $material){
                            foreach($materials[1] as $csubject){
                                    $content_info[]=array(
                                       'exam_id'=>key($course_data),
                                       'paper_id'=>$key,
                                       'material_id'=>$material,
                                       'subject_id'=>$csubject       
                                    ); 
                                }
                            }
                        
                    }  
                }

                return $content_info;
            }
    }

    public function getExamSubject($exam_id){
        $exam_subjects=\App\SubjectMaster::where(['status'=>1,'exam_id'=>$exam_id])->get();

        return $exam_subjects;
    }
    public function getCourseExamSubject($exam_id,$subject_id){
        //$course_subjects=\App\CourseSubjectRelation::where(['status'=>1,'exam_id'=>$exam_id])->get();
        $courses=$rearrange_course=[];
        $full_study=$prev_question=$model_question=$last_minute=$new_courses=[];
        $courses=DB::table('course_exam_subject_relations as cesr')
                ->join('products as pr','cesr.product_id','pr.product_id')
                ->select('pr.product_id','pr.name','pr.status','pr.slug')
                ->where(['pr.status'=>1,'cesr.exam_id'=>$exam_id,'cesr.subject_id'=>$subject_id,'pr.is_combo'=>0])
                ->orderBy('pr.name', 'asc')
                ->get();
              
        foreach ($courses as $allCourse)
        {
            if (strpos($allCourse->name, 'Full Study Material') !== false)
            {
                $full_study[]=$allCourse;
            }
            else if (strpos($allCourse->name, 'Previous Years Question Solution') !== false)
            {
                $prev_question[]=$allCourse;
            }
            else if (strpos($allCourse->name, 'Model Question Analysis') !== false)
            {
                $model_question[]=$allCourse;
            }
            else if (strpos($allCourse->name, 'Last Minute Suggestion') !== false)
            {
                $last_minute[]=$allCourse;
            }
            else
            {
                $rearrange_course[]=$allCourse;
            }
            
            $new_courses=array_merge($full_study,$prev_question,$model_question,$last_minute,$rearrange_course);
        }
        //print_r($new_courses);
        return $new_courses;
    }

    public function getVistiorCount()
    {
        return \App\VisitorDetail::count();
    }

    public function getCourseExamSubjectPreview($exam_id,$subject_id,$is_preview=1){
        //$course_subjects=\App\CourseSubjectRelation::where(['status'=>1,'exam_id'=>$exam_id])->get();
        $courses=$rearrange_course=[];
        $full_study=$prev_question=$model_question=$last_minute=$new_courses=[];
        $courses=DB::table('course_exam_subject_relations as cesr')
                ->join('products as pr','cesr.product_id','pr.product_id')
                ->select('pr.product_id','pr.name','pr.status','pr.slug')
                ->where(['pr.status'=>1,'cesr.exam_id'=>$exam_id,'cesr.subject_id'=>$subject_id,
                        'pr.is_combo'=>0,'pr.is_preview'=>$is_preview])
                ->orderBy('pr.name', 'asc')
                ->get();
              
        foreach ($courses as $allCourse)
        {
            if (strpos($allCourse->name, 'Full Study Material') !== false)
            {
                $full_study[]=$allCourse;
            }
            else if (strpos($allCourse->name, 'Previous Years Question Solution') !== false)
            {
                $prev_question[]=$allCourse;
            }
            else if (strpos($allCourse->name, 'Model Question Analysis') !== false)
            {
                $model_question[]=$allCourse;
            }
            else if (strpos($allCourse->name, 'Last Minute Suggestion') !== false)
            {
                $last_minute[]=$allCourse;
            }
            else
            {
                $rearrange_course[]=$allCourse;
            }
            
            $new_courses=array_merge($full_study,$prev_question,$model_question,$last_minute,$rearrange_course);
        }
        //print_r($new_courses);
        return $new_courses;
    }

    public function getYoutubeProtocol()
    {
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
        return $protocol;
    }

    public function getProductExam($product_id)
    {
        $exams=DB::table('course_exam_subject_relations as cesr')
                ->join('exam_masters as em','cesr.exam_id','em.id')
                ->select('cesr.exam_id','em.exam_name')
                ->where(['cesr.product_id'=>$product_id])
                ->first();
        if($exams){
            return Str::slug($exams->exam_name, '-');
        }        
        return  $exams;    
    }
    public function getProductExamName($product_id)
    {
        $exams=DB::table('course_exam_subject_relations as cesr')
                ->join('exam_masters as em','cesr.exam_id','em.id')
                ->select('cesr.exam_id','em.exam_name')
                ->where(['cesr.product_id'=>$product_id])
                ->first();
        if($exams){
            return $exams->exam_name;
        }        
        return  $exams;    
    }

    public function getPaymentInfo($order_id)
    {
        //$payment_info=\App\PaymentRequestOrderDetail::where('order_id',$order_id)->first();
        $payment_info=DB::table('payment_request_masters as prm')
                        ->join('payment_request_order_details as prod','prod.payment_request_id','prm.id')
                        ->select('prod.payment_request_id','prod.order_id','prod.order_amount','prod.pay_date',
                                'prod.pay_status','prod.pay_type','prod.cheque_no_neft','prm.user_id','prm.user_type_id')
                        ->where('prod.order_id',$order_id) 
                        ->where('prm.user_id',Auth::id())
                        ->first();
        // echo "<pre>";  
        // print_r($payment_info);die;              
        if($payment_info){
            return $payment_info;
        }
        return '0';
    }
    public function getContributorTotalPaid($user_id)
    {
        $order_info=DB::table('payment_request_masters as prm')
                ->join('payment_request_order_details as prod','prod.payment_request_id','prm.id')
                ->select('prm.user_id','prm.id','prod.order_amount','prod.order_id')
                ->where('prm.user_id',$user_id)
                ->where('prod.pay_status',2)
                ->sum('prod.order_amount');

        if($order_info){
            return $order_info;
        } 
        return 0;      
    }

    public function getCategoryInfo($article_id)
    {
        $cat_info=[];
        $cat_info=DB::table('article_category_relations as acr')
        ->join('article_categories as ac','acr.category_id','ac.id')
        ->select('acr.article_id','acr.category_id','ac.name','ac.slug')
        ->where('acr.article_id',$article_id)
        ->get();
        if($cat_info){
            return $cat_info;
        }

        return $cat_info;

    }

    public function getCategoryName($cat_id)
    {
        //echo "Hiii".$cat_id;die;
        $cat_info=[];
        $cat_info=\App\ArticleCategory::find($cat_id);
        if($cat_info){
            $cat_info;
        
        }   
        return $cat_info; 
    }

    public function getQuestionOptions($question_id)
    {
        
        $question_options=\App\QuestionAnswer::where('question_id',$question_id)->get();

        return $question_options;
    }
    public function getCorrectOptionsExplain($question_id)
    {
        
        $question_options=DB::table('question_masters as qm')
                    ->join('question_answers as qa','qm.id','qa.question_id')
                    ->select('qm.correct_clarification','qa.id as correct_answer_id','qa.option_label')
                    ->where('qm.id',$question_id)
                    ->where('qa.is_correct',1)
                    ->first();

        return $question_options;
    }
    public function getStudentAnswer($question_id,$exam_id)
    {
        
        $question_options=DB::table('mock_exam_student_answers as mesa')
                    ->join('question_answers as qa','mesa.answer_id','qa.id')
                    ->select('mesa.mock_exam_id','mesa.question_id','mesa.answer_id','qa.answer','qa.option_label','mesa.is_correct')
                    ->where('mesa.question_id',$question_id)
                    ->where('mesa.mock_exam_id',$exam_id)
                    //->where('st_correct.is_correct',1)
                    ->first();

        return $question_options;
    }

    public function getStudentMockAnswer($question_no,$mock_test_id)
    {
        
        $stQuestAnswers=\App\StudentTestQuestionResult::select('id','question_id','question_no','answer_type')->where(
            ['mock_test_id' =>  $mock_test_id,'question_no'=>$question_no]
        )->first();
                   
        return $stQuestAnswers['answer_type'];
    }

    public function getNumofQues($mock_test_id,$level_id)
    {
        $noofQues=\App\StudentTestQuestionResult::where(
            ['mock_test_id' =>  $mock_test_id,'level_id'=>$level_id]
        )->count();

        return $noofQues;
    }
    public function getNumofCorrectAnswer($mock_test_id,$level_id)
    {
        $noofQues=\App\StudentTestQuestionResult::where([
            'mock_test_id' =>  $mock_test_id,
            'level_id'=>$level_id,
            'is_correct'=>1
        ])->count();

        return $noofQues;
    }
    

    public function getMarks($mock_test_id,$level_id)
    {
        $noofQues=\App\StudentTestQuestionResult::where([
            'mock_test_id' =>  $mock_test_id,
            'level_id'=>$level_id,
        ])->sum('score');

        return $noofQues;
    }

    public function checkHasQuestion($params)
    {
        
        $level_id=$params['level_id'];
        $subject_id=$params['subject_id'];
        $exam_id=$params['exam_id'];
        $paper_id=$params['paper_id'];
        $allquestions=\App\MockQuestionDetailsMaster::whereIn('level_id',$level_id)
            ->where('subject_id',$subject_id)   
            ->where('exam_id',$exam_id)   
            ->where('paper_id',$paper_id)   
            ->count();
         
        return $allquestions;    
    }

    public function checkCorrection($mock_test_id,$question_no)
    {
        
        // $mock_test_id=$params['mock_test_id'];
        // $question_no=$params['question_no'];
        
        $allquestions=\App\StudentTestQuestionResult::
            where('mock_test_id',$mock_test_id)   
            ->where('question_no',$question_no) 
            ->first();
         //print_r($allquestions);
        return @$allquestions->is_correct;    
    }

    public function checkAnswered($mock_test_id,$question_no)
    {
        
        // $mock_test_id=$params['mock_test_id'];
        // $question_no=$params['question_no'];
        
        $allquestions=\App\StudentTestQuestionResult::
            where('mock_test_id',$mock_test_id)   
            ->where('question_no',$question_no) 
            ->first();
         //print_r($allquestions);
        return @$allquestions->answer_type;    
    }

    public function marksperQues($question_id,$mock_test_id)
    {
        $student_test=\App\StudentMockTest::find($mock_test_id);
        $template_id=$student_test->template_id;
        $question_detail=\App\StudentTestQuestionResult::where('question_id',$question_id)
                ->where('mock_test_id',$mock_test_id)
                ->first();
        @$level_id=$question_detail->level_id; 
        $templateDetails=\App\MockTemplateDetails::where('level_id',$level_id)->where('template_id',$template_id)->first();
        $correctness=100;
        if($templateDetails->marks_per_question!="")   {
            $score=$templateDetails->marks_per_question;
        
            return $score;
        }        
        elseif($student_test){
            //$correctness=$this->checkcorrectness($question_id,$answer);
            $rule=\App\MockTabulationRuleDetails::where('level_id',$level_id)->where('correctness',$correctness)->first();
            $score=$rule['marks'];
            //dd($score);
            return $score;

        }

    }

    public function getCorrectAnswer($question_id)
    {
        $mockanswers=\App\MockQuestionAnswers::where('question_id',$question_id)->where('is_correct',1)->get();
        $allmockanswer=[];
        foreach($mockanswers as $mockanswer){
            $allmockanswer[]=$mockanswer->serial_no;
        }


        return implode(",",$allmockanswer);

    }

    public function getPapers()
    {
        $papers=\App\PaperMaster::where('status',1)->get();
        return $papers;

    }


    

    public function getCourseInfo($exam_id = 1, $paper_id,$subject_id)
	{
		$results = DB::table('course_exam_paper_subject_relations as cepsr')
            ->select('cepsr.product_id','products.is_preview','cepsr.exam_id','cepsr.paper_id','products.name','products.slug','subject_masters.subject_name','subject_masters.subject_slug','cepsr.subject_id')
		    ->join('products','cepsr.product_id','products.product_id')
		    ->join('subject_masters','cepsr.subject_id','subject_masters.id')
		    ->where('cepsr.exam_id', $exam_id)
		    ->where('cepsr.paper_id', $paper_id)
		    ->where('cepsr.subject_id', $subject_id)
            ->get();


		
		// echo "<pre>";
		// print_r($query->result());
		// echo "</pre>";
		return $results;
	}
	public function getPaperUnits($exam_id = 1, $paper_id)
	{
		$results = DB::table('course_exam_paper_subject_relations as cepsr')
            ->select('cepsr.product_id','subject_masters.subject_slug','products.is_preview','subject_masters.sequence','cepsr.exam_id','cepsr.paper_id','products.name','products.slug','subject_masters.subject_name','cepsr.subject_id')
		    ->join('products','cepsr.product_id','products.product_id')
		    ->join('subject_masters','cepsr.subject_id','subject_masters.id')
		    ->where('cepsr.exam_id', $exam_id)
		    ->where('cepsr.paper_id', $paper_id)
            ->groupBy('cepsr.subject_id')
            ->orderBy('subject_masters.sequence')
            ->get();
		
		return $results;
	}

    public function getOnlyPaidCourseInfo($exam_id = 1, $paper_id,$subject_id)
	{
		$results = DB::table('course_exam_paper_subject_relations as cepsr')
            ->select('cepsr.product_id','products.is_preview','cepsr.exam_id','cepsr.paper_id','products.name','products.slug','subject_masters.subject_name','subject_masters.subject_slug','cepsr.subject_id')
		    ->join('products','cepsr.product_id','products.product_id')
		    ->join('subject_masters','cepsr.subject_id','subject_masters.id')
		    ->where('cepsr.exam_id', $exam_id)
		    ->where('cepsr.paper_id', $paper_id)
		    ->where('cepsr.subject_id', $subject_id)
		    ->where('products.is_preview', 0)
            ->first();


		
		// echo "<pre>";
		// print_r($results);
		// echo "</pre>";
		return $results;
	}

    public function getPaperAdminUnits($exam_id = 1, $paper_id)
	{
		$results = \App\SubjectMaster::where('paper_id',$paper_id)->get();
		// dd($results);
		return $results;
	}

    function getCourses($exam_id = 1, $paper_id){
        $courses= \App\CourseExamPaperRelation::where([
            'exam_id' => $exam_id, 
            'paper_id'=>$paper_id
        ])->get();
        //dd($courses[0]->product->name);

        return $courses;
    }
    function getCoursePreview($product_id){
        $course= \App\Product::where('preview_main_course',$product_id)->first();

        return $course;
    }


}


?>