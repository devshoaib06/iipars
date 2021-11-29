<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function all_data()
	{
		$sliders=[];
		$welcome_content=[];
		$why_choose_us_details=[];
		$importantlinks=[];
		$news_details=[];


		$slider = $this->common_model->common($table_name = 'tbl_slider', $field = array(), $where = array('slider_status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($slider as $image)
		{
			$sliderArr['image']= base_url().'assets/upload/slider/'.$image->slider_image;
			$sliderArr['title1']= $image->first_title;
			$sliderArr['title2']= $image->second_title;

			array_push($sliders,$sliderArr);

		}

		$manage_home = $this->common_model->common($table_name = 'tbl_manage_home', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($manage_home as $welcome)
		{
			$welcomeArr['image']= base_url().'assets/upload/manage_home/'.$welcome->image;
			$welcomeArr['id']=$welcome->id;
			$des= strip_tags($welcome->description) ;
			$welcomeArr['description']=character_limiter($des,200);

			array_push($welcome_content,$welcomeArr);
		}

		$why_choose_us = $this->common_model->common($table_name = 'tbl_why_choose_us', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($why_choose_us as $choose)
		{
			$chooseArr['image']= base_url().'assets/upload/why_choose_us/'.$choose->image;
			$chooseArr['title']= $choose->title;
			$chooseArr['description']= $choose->description;

			array_push($why_choose_us_details,$chooseArr);
		}

		$link_details = $this->common_model->common($table_name = 'tbl_importain_link', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($link_details as $row)
		{
			$linkarr['title']= $row->title;
			$linkarr['link']= $row->link;

			array_push($importantlinks,$linkarr);

		}

		$news_feed_details = $this->common_model->common($table_name = 'tbl_news_feed', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		foreach($news_feed_details as $news)
		{
			$newsarr['title']= $news->title;
			$newsarr['image']= base_url().'assets/upload/news_feed/'.$news->image;
			$data=$news->created_date;
			$timestamp = strtotime($data);
			$newDate = date('F-d-Y', $timestamp); 
			
			$newsarr['created_date']=$newDate;

			array_push($news_details,$newsarr);
		}


		// print_r($why_choose_us);

		echo json_encode(array($result='1','sliders'=>$sliders,'welcome_content'=>$welcome_content,'why_choose_us_details'=>$why_choose_us_details,'importantlinks'=>$importantlinks,'news_details'=>$news_details));


	}


	function about_details()
	{

		$welcome_content=[];
		
	    $about_details = $this->common_model->common($table_name = 'tbl_manage_home', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	    foreach($about_details as $welcome)
		{
			$welcomeArr['image']= base_url().'assets/upload/manage_home/'.$welcome->image;
			$welcomeArr['id']=$welcome->id;
			$welcomeArr['description']=$welcome->description;

			array_push($welcome_content,$welcomeArr);
		}

		echo json_encode(array($result='1','welcome_content'=>$welcome_content));
	   
	}


}



 ?>