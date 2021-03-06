<?php


function getUserPetCategory($u_id) {

    $list = DB::table('pets')
            ->select('pets.name as pet','categories.name as category','pets.category_id')
            ->join('categories', 'pets.category_id', '=', 'categories.id')
            ->where('user_id', '=', $u_id)
            ->get();


    $pet = '';

    foreach ($list as $v){

        $arr = DB::table('categories')->where('id', '=', $v->category_id)->first();
        $parent_id = trim($arr->parent_id);
        

        $arr = DB::table('categories')->where('id', '=', $parent_id)->first();
        $parent_name = trim($arr->name);
        


        //$pet .= $v->pet.' ('.$parent_name.' - '.$v->category.'), <br>';    
        $pet .= $v->pet.' ('.$parent_name.'), <br>';    
    }

    if($pet != ''){
        $l = strlen($pet);
        $pet = substr($pet, 0, $l - 6);
    }
    

    return $pet;
}


function getPetAllCategory($p_id) {

    $list = DB::table('pets')
            ->select('pets.name as pet','categories.name as category','pets.category_id')
            ->join('categories', 'pets.category_id', '=', 'categories.id')
            ->where('pets.id', '=', $p_id)
            ->get();


    $pet = '';

    foreach ($list as $v){

        $arr = DB::table('categories')->where('id', '=', $v->category_id)->first();
        $parent_id = trim($arr->parent_id);
        

        $arr = DB::table('categories')->where('id', '=', $parent_id)->first();
        $parent_name = trim($arr->name);
        


        //$pet .= $v->pet.' ('.$parent_name.' - '.$v->category.'), <br>';    
        $pet .= $parent_name;    
    }

    /*if($pet != ''){
        $l = strlen($pet);
        $pet = substr($pet, 0, $l - 6);
    }*/
    

    return $pet;
}



function getUserStoreCategory($u_id) {

    $list = DB::table('stores')
            ->select('stores.name as stores','stores.id')            
            ->where('user_id', '=', $u_id)
            ->get();


    $category = '';
    $arr_dup_cat_id = array();

    foreach ($list as $v){

        $arr = DB::table('store_categories')->where('store_id', '=', $v->id)->first();
        $category_id = trim($arr->category_id);

        

        if (in_array($category_id, $arr_dup_cat_id)){

        }else{
        

        $arr = DB::table('categories')->where('id', '=', $category_id)->first();
        $category_name = trim($arr->name);

        }

    $arr_dup_cat_id[] = $category_id;
        

        $category .= $category_name.', ';    
    }

    if($category != ''){
        $l = strlen($category);
        $category = substr($category, 0, $l - 2);
    }
    

    return $category;
}


function getStoreAllCategory($s_id) {

   


    $category = '';
    $arr_dup_cat_id = array();



    $arr = DB::table('store_categories')->where('store_id', '=', $s_id)->get();

    foreach ($arr as $v){

    $category_id = trim($v->category_id);



    if (in_array($category_id, $arr_dup_cat_id)){

    }else{


    $arr = DB::table('categories')->where('id', '=', $category_id)->first();
    $category_name = trim($arr->name);

    }

    $arr_dup_cat_id[] = $category_id;


    $category .= $category_name.', ';   
    } 


    if($category != ''){
    $l = strlen($category);
    $category = substr($category, 0, $l - 2);
    }


    return $category;
}

function getStoreAllHour($s_id) {

   


    $category = '';
    $arr_dup_cat_id = array();



    $arr = DB::table('store_hours')->where('store_id', '=', $s_id)->get();
    $text = '';
    foreach ($arr as $v){

        $week_day = trim($v->week_day);

        $time = trim($v->time);
        


        $text .= $week_day.' - '.$time.'  ' ;   

    } 


    

    return $text;
}


function mutual_friends_count($u_id,$txt) {

    $member_list = DB::table('user_connections')
            ->select('user_id','f_user_id')        
            ->where('user_id', '=', $u_id)
            ->orWhere('f_user_id', '=', $u_id)
            ->get();


   

    $arr_member_friend = array();

    foreach ($member_list as $v){

        if($u_id == $v->user_id){
            $arr_member_friend[] = $v->f_user_id;
        }else{
            $arr_member_friend[] = $v->user_id;
        }        

    }



    $my_id = Auth::id();

    $my_list = DB::table('user_connections')
            ->select('user_id','f_user_id')              
            ->where('user_id', '=', $my_id)
            ->orWhere('f_user_id', '=', $my_id)
            ->get();



    $arr_my_friend = array();

    foreach ($my_list as $v){

        if($my_id == $v->user_id){
            $arr_my_friend[] = $v->f_user_id;
        }else{
            $arr_my_friend[] = $v->user_id;
        }        

    }



    $result = array_intersect($arr_member_friend, $arr_my_friend); 


    $total = count($result);

    if($total > 1){
        $m_f = $total .' Mutual '.$txt.'s'; 
    }elseif($total == 1){
        $m_f = $total .' Mutual '.$txt; 
    }else{
        $m_f = 'No Mutual '.$txt; 
    }


   
    return $m_f;
}

function mutual_friends_only_count($u_id,$txt) {

    $member_list = DB::table('user_connections')
            ->select('user_id','f_user_id')        
            ->where('user_id', '=', $u_id)
            ->orWhere('f_user_id', '=', $u_id)
            ->get();


    

    $arr_member_friend = array();

    foreach ($member_list as $v){

        if($u_id == $v->user_id){
            $arr_member_friend[] = $v->f_user_id;
        }else{
            $arr_member_friend[] = $v->user_id;
        }        

    }



    $my_id = Auth::id();

    $my_list = DB::table('user_connections')
            ->select('user_id','f_user_id')              
            ->where('user_id', '=', $my_id)
            ->orWhere('f_user_id', '=', $my_id)
            ->get();



    $arr_my_friend = array();

    foreach ($my_list as $v){

        if($my_id == $v->user_id){
            $arr_my_friend[] = $v->f_user_id;
        }else{
            $arr_my_friend[] = $v->user_id;
        }        

    }



    $result = array_intersect($arr_member_friend, $arr_my_friend); 


    $total = count($result);

    if($total > 1){
        $m_f = $total .' Mutual '.$txt.'s'; 
    }elseif($total == 1){
        $m_f = $total .' Mutual '.$txt; 
    }else{
        $m_f = 'No Mutual '.$txt; 
    }


   
    return $total;
}

function member_mutual_friends_count($u_id,$m_id,$txt) {

    $member_list = DB::table('user_connections')
            ->select('user_id','f_user_id')        
            ->where('user_id', '=', $u_id)
            ->orWhere('f_user_id', '=', $u_id)
            ->get();


   

    $arr_member_friend = array();

    foreach ($member_list as $v){

        if($u_id == $v->user_id){
            $arr_member_friend[] = $v->f_user_id;
        }else{
            $arr_member_friend[] = $v->user_id;
        }        

    }



    $my_id = $m_id;

    $my_list = DB::table('user_connections')
            ->select('user_id','f_user_id')              
            ->where('user_id', '=', $my_id)
            ->orWhere('f_user_id', '=', $my_id)
            ->get();



    $arr_my_friend = array();

    foreach ($my_list as $v){

        if($my_id == $v->user_id){
            $arr_my_friend[] = $v->f_user_id;
        }else{
            $arr_my_friend[] = $v->user_id;
        }        

    }



    $result = array_intersect($arr_member_friend, $arr_my_friend); 


    $total = count($result);

    if($total > 1){
        $m_f = $total .' Mutual '.$txt.'s'; 
    }elseif($total == 1){
        $m_f = $total .' Mutual '.$txt; 
    }else{
        $m_f = 'No Mutual '.$txt; 
    }


   
    return $m_f;
}



function getRateing($v) { 
    
    $rat = '';

     for($i = 1; $i <= $v ;$i++ ){
        $rat .= '<div class="star"><i class="fa fa-star" aria-hidden="true"></i></div>';  
     }  

     $k = 5 - $v;

     for($j = 1; $j <= $k ;$j++ ){
        $rat .= '<div class="star"><i class="fa fa-star-o" aria-hidden="true"></i></div>';  
     }    



    return $rat;
}

function getRateingAdmin($v) { 
    
    $rat = '';

     for($i = 1; $i <= $v ;$i++ ){
        $rat .= '<i class="fa fa-star" aria-hidden="true"></i> ';  
     }  

     $k = 5 - $v;

     for($j = 1; $j <= $k ;$j++ ){
        $rat .= '<i class="fa fa-star-o" aria-hidden="true"></i> ';  
     }    



    return $rat;
}

function getAverageRateing($to_user_id) { 
    
    $rat = '';



    $reviews_list = DB::table('reviews')
            ->select('rate')              
            ->where('to_user_id', '=', $to_user_id)
            ->where('status', '=', 1)            
            ->get();



    $tot_reviews = 0;
    $j = 0;

    foreach ($reviews_list as $v){

        
            $tot_reviews += $v->rate;
           
            ++$j;
    }


    if($tot_reviews != 0 && $j != 0){
        $v = round($tot_reviews / $j);
    }else{
        $v = 0;   
    }





     for($i = 1; $i <= $v ;$i++ ){
        $rat .= '<div class="star"><i class="fa fa-star" aria-hidden="true"></i></div>';  
     }  

     $k = 5 - $v;

     for($j = 1; $j <= $k ;$j++ ){
        $rat .= '<div class="star"><i class="fa fa-star-o" aria-hidden="true"></i></div>';  
     }    



    return $rat;//.'-'.$tot_reviews .'-'.$j.'-'.$v
}

function getAverageRate($to_user_id) { 
    
   


    $reviews_list = DB::table('reviews')
            ->select('rate')              
            ->where('to_user_id', '=', $to_user_id)
            ->where('status', '=', 1)            
            ->get();



    $tot_reviews = 0;
    $j = 0;

    foreach ($reviews_list as $v){

        
            $tot_reviews += $v->rate;
           
            ++$j;
    }


    if($tot_reviews != 0 && $j != 0){
        $v = round($tot_reviews / $j);
    }else{
        $v = 0;   
    }

    return $v;//.'-'.$tot_reviews .'-'.$j.'-'.$v
}


function getAge($dob) { 
    
    $diff = (date('Y') - date('Y',strtotime($dob)));
   // echo $diff;

    return $diff;
}

function getSettings($setting_id) {

    $arr = DB::table('settings')->where('setting_id', '=', $setting_id)->first();
    $result = "";
    if (!empty($arr)) {
        $result = trim($arr->content);
    }

    return $result;
}
function getMockTestSettings($setting_id) {

    $arr = DB::table('mock_exam_settings')->where('setting_id', '=', $setting_id)->first();
    $result = "";
    if (!empty($arr)) {
        $result = trim($arr->content);
    }

    return $result;
}

function getMockTestCountDown($mock_test_id) {

    $arr = \App\StudentMockTest::find($mock_test_id);
    $result = "";
    if (!empty($arr)) {
        $result = trim($arr->countdown);
    }

    return $result;
}



function getHeaderUserImage() {
    if (Auth::check()) {
        $uid = Auth::id();
        $uArr = DB::table('user_master')->where('id', '=', $uid)->first();
        if (!empty($uArr)) {
            if (trim($uArr->image) != null && trim($uArr->image) != NULL && trim($uArr->image) != "") {
                return trim($uArr->image);
            }
        }
    }

    return "no_image.png";
}

function getUserType() {
    if (Auth::check()) {
        $uid = Auth::id();
        $uArr = DB::table('user_master')->where('id', '=', $uid)->first();
        if (!empty($uArr)) {
            return trim($uArr->user_type);
        }
    }

    return 0;
}

function getHeaderMenuItems() {
    $menuItem = DB::table('work_category')
            ->where('status', '=', '1')
            ->where('show_in_header', '=', '1')
            ->orderBy('menu_order', 'ASC')
            ->take(config('constants.home_menu_no'))
            ->get();

    return $menuItem;
}

function time_elapsed_string($datetime, $full = false) {

    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function getTimeZoneName($tmID) {
    $arr = DB::table('timezone_master')->where('timezone_id', '=', $tmID)->first();
    if (!empty($arr)) {
        return $arr->name;
    }

    return "";
}

function getCountryName($cid) {
    $arr = DB::table('country_master')->where('id', '=', $cid)->first();
    if (!empty($arr)) {
        return $arr->country_name;
    }

    return "";
}





/** New * */





function getRatingByAgentId($agid) {

    if ($agid != "") {

        $rtn = DB::table('user_rating')->where('rating_user_id', '=', $agid)->avg('rate');

        return $rtn;
    }

    return 0;
}


function getUserRolePermission($id,$slag) {
    $arr = DB::table('user_role')->select('*')->where('user_id', '=', $id)->where('slag', '=', $slag)
					->join('role_master', 'user_role.role_slag', '=', 'role_master.slag')
					->first();
					//->get();
   
	
	
	$rtn = 0;

        if (!empty($arr)) {

            $rtn = 1;
        }

    return $rtn;
}

function dateFormatForComment($old_date){
      
    return $newDateTime = date('d-m-Y h:i A', strtotime($old_date));
}


function getYoutubeEmbedUrl($url){

    $whitelist = ['YouTube', 'Vimeo','Facebook','Twitvid','Dailymotion','Yahoo Video','Local Content','instagram'];

    //Optional parameters to be appended to embed
    $params = [
        'autoplay' => 1,
        'loop' => 1
      ];

    //Optional attributes for embed container
    $attributes = [
      'type' => null,
      'class' => 'iframe-class',
      'data-html5-parameter' => true
    ];

    return LaravelVideoEmbed::parse($url, $whitelist, $params, $attributes);
    
}

function turnUrlIntoHyperlink($value, $protocols = array('http', 'mail'), array $attributes = array()){

    //The Regular Expression filter
    $attr = '';
        foreach ($attributes as $key => $val) {
            $attr .= ' ' . $key . '="' . htmlentities($val) . '"';
        }
        
        $links = array();
        
        // Extract existing links and tags
        $value = preg_replace_callback('~(<a .*?>.*?</a>|<.*?>)~i', function ($match) use (&$links) { return '<' . array_push($links, $match[1]) . '>'; }, $value);
        
        // Extract text links for each protocol
        foreach ((array)$protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':   $value = preg_replace_callback('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr)

                 { if ($match[1]) $protocol = $match[1]; $link = $match[2] ?: $match[3];

                  return '<' .array_push($links,"<a $attr href=\"$protocol://$link\" target='_blank'>$protocol://$link</a>") .'>'; }, $value); break;
                case 'mail':    $value = preg_replace_callback('~([^\s<]+?@[^\s<]+?\.[^\s<]+)(?<![\.,:])~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"mailto:{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
                case 'twitter': $value = preg_replace_callback('~(?<!\w)[@#](\w++)~', function ($match) use (&$links, $attr) { return '<' . array_push($links, "<a $attr href=\"https://twitter.com/" . ($match[0][0] == '@' ? '' : 'search/%23') . $match[1]  . "\">{$match[0]}</a>") . '>'; }, $value); break;
                default:        $value = preg_replace_callback('~' . preg_quote($protocol, '~') . '://([^\s<]+?)(?<![\.,:])~i', function ($match) use ($protocol, &$links, $attr) { return '<' . array_push($links, "<a $attr href=\"$protocol://{$match[1]}\">{$match[1]}</a>") . '>'; }, $value); break;
            }
        }
        
        // Insert all link
        return preg_replace_callback('/<(\d+)>/', function ($match) use (&$links) { return $links[$match[1] - 1]; }, $value);
}





?>