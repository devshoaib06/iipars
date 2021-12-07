<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class important_links extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function links()
	{
		$all_links=[];
		

		$link = $this->common_model->common($table_name = 'tbl_importain_link', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($link as $row_links)
		{
			
			$linkArr['href_link']= $row_links->link;
			$linkArr['title']= $row_links->title;

			array_push($all_links,$linkArr);

		}

		// print_r($all_links);
	

 	echo json_encode(array('all_links'=>$all_links));
         



	}
}



 ?>