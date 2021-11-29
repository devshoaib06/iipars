<?php

class send_sms_model extends CI_Model{

		function __construct()
		{
			parent::__construct();
		}


		function send_sms($sms_text,$mobile)
		{


			$curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.msg91.com/api/sendhttp.php?country=91&sender=TXLCOM&route=4&mobiles=".$mobile."&authkey=300887A45yjqk6Yx5db33f8e&encrypt=&message=".$sms_text,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);


  }
		
	

	}
	?>
