<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class gallery extends CI_Controller
{
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}

	public function image_list()
	{
		$image_list=[];
		$image_arr=[];

		$category_list=$this->admin_model->selectAll('tbl_video_category');

		foreach($category_list as $row_cat)
		{
			$catArr['id']= $row_cat->video_category_id;
			$catArr['video_category']= $row_cat->video_category;
			// $catArr['image_arr']= $image_arr;
			

			array_push($image_list,$catArr);

		}

		$image_gallery = $this->common->select($table_name='tbl_image_gallery',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			

			foreach($image_gallery as $img)
			{
				$imgArr['video_category_id']=$img->video_category_id;
				$imgArr['video_gallery_image']=base_url().'assets/upload/gallery_image/resize/'. $img->video_gallery_image;

				array_push($image_arr, $imgArr);

			}

		// print_r($all_news_feed);
	

 	echo json_encode(array('image_list'=>$image_list,'image_arr'=>$image_arr));
         



	}


	public function video_list()
	{
		$video_list=[];
		$video_arr=[];



		$category_list=$this->admin_model->selectAll('tbl_video_category');

		foreach($category_list as $row_cat)
		{
			$catArr['id']= $row_cat->video_category_id;
			$catArr['video_category']= $row_cat->video_category;
			// $catArr['video_arr']= $video_arr;
			array_push($video_list,$catArr);

		}

		$video_gallery = $this->common->select($table_name='tbl_video_gallery',$field=array(), $where=array(), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
			
			foreach($video_gallery as $video)
			{
				$vidArr['video_category_id']=$video->video_category_id;
				$vidArr['video_link']=$video->video_gallery_link;
				$vidArr['video_gallery_image']=base_url().'assets/upload/gallery_image/'. $video->video_gallery_image;

				array_push($video_arr, $vidArr);

			}



		// print_r($all_news_feed);
	

 	echo json_encode(array('video_list'=>$video_list,'video_arr'=>$video_arr));

	}

	function get_video()
	{
		$json    			=  file_get_contents('php://input');
		$obj     			=  json_decode($json);
		// print_r($obj);exit;

		

		$video_category_id = $obj->category_id;
		$video_arr=[];

		 // echo $video_category_id;

		
			$video_gallery = $this->common->select($table_name='tbl_video_gallery',$field=array(), $where=array('video_category_id'=>$video_category_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');
		

		
			
			foreach($video_gallery as $video)
			{
				$vidArr['video_category_id']=$video->video_category_id;
				$vidArr['video_link']=$video->video_gallery_link;
				$vidArr['video_gallery_image']=base_url().'assets/upload/gallery_image/'. $video->video_gallery_image;

				array_push($video_arr, $vidArr);

			}

		echo json_encode(array('video'=>$video_arr));	
	}

	function get_image()
	{

		$json    			=  file_get_contents('php://input');
		$obj     			=  json_decode($json);
		// print_r($obj);exit;

		

		$video_category_id = $obj->category_id;
		$image_arr=[];

		$image_gallery = $this->common->select($table_name='tbl_image_gallery',$field=array(), $where=array('video_category_id'=>$video_category_id), $where_or=array(),$like=array(),$like_or=array(),$order=array(),$start='',$end='');

		foreach($image_gallery as $img)
			{
				$imgArr['video_category_id']=$img->video_category_id;
				$imgArr['video_gallery_image']=base_url().'assets/upload/gallery_image/resize/'. $img->video_gallery_image;

				array_push($image_arr, $imgArr);

			}

	echo json_encode(array('image_arr'=>$image_arr));	


	}
}



 ?>