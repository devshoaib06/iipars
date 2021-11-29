<?php
class url_slug_model extends CI_Model 
{

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
	    $this->load->model('custom_model');	
    }
    
	function url_slug($string)
	{
		//Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
		$string = strtolower($string);
		//Strip any unwanted characters
		$string = preg_replace("/[^a-z0-9_\s-]/", " ", $string);
		//Clean multiple dashes or whitespaces
		$string = preg_replace("/[\s-]+/", "-", $string);
		//Convert whitespaces and underscore to dash
		$string = preg_replace("/[\s_]/", "-", $string);
		//$string =substr_replace($string ,"",-1);//Last dashes remove
		return $string;	
	}
	
	
}
?>