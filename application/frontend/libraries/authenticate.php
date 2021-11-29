<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

  /**

  * Ignited Global Function

  *

  * This is a wrapper class/library based on the native Datatables server-side implementation by Allan Jardine

  * found at http://datatables.net/examples/data_sources/server_side.html for CodeIgniter

  *

  * @package    CodeIgniter

  * @subpackage libraries

  * @category   library

  * @version    0.7

  * @author     Nilu <gravetax@gmail.com>

  *        

  */

  class authenticate

  {

	  public function authenticate_user()

	  {

		$CI =& get_instance();

		if($CI->session->userdata('admin_user_data')==false)

		{

			redirect('index.php/login');

		}

	  }
	  
	  public function logout(){
		 $CI->session->sess_destroy();
        $CI->session->set_flashdata("message",  popup_msg("You have logged out"));  
	  }

	  

	

  }