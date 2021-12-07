<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class news_feed extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function feeds()
	{
		$all_news_feed=[];
		

		$news_feed = $this->common_model->common($table_name = 'tbl_news_feed', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($news_feed as $row_news_feed)
		{
			
			$newsArr['title']= $row_news_feed->title;
			$newsArr['image']= $row_news_feed->image;
			$newsArr['description']= $row_news_feed->description;

			array_push($all_news_feed,$newsArr);

		}

		// print_r($all_news_feed);
	

 	echo json_encode(array('all_news_feed'=>$all_news_feed));
         



	}
}



 ?>