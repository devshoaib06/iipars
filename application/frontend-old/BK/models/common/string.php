<?php
class string extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    	
    //START USER DETAIL
	function truncate($string='',$seperator='',$index='')
	{
		$string=explode($seperator,$string);
		return $string[$index];
	}
	
}
?>