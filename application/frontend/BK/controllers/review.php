<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class review extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();

	}
	
	public function submit()
	{

		if($this->session->userdata('user_session_id')!='')
		{
			$user_id= $this->session->userdata('user_session_id');
		}
		else
		{
			$this->session->set_flashdata('err_msg','Plaese Log in !');
			redirect($this->url->link(3),'refresh');
		}

		
		$product_id= $this->input->post('product_id');
		$name= $this->input->post('name');
		$email= $this->input->post('email');
		$rating= $this->input->post('rating_star');		
		$message= $this->input->post('review_msg');
		$current_date = date('Y-m-d');
		
		$chk_tbl_review = $this->common_model->common($table_name = 'tbl_review', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		if(count($chk_tbl_review)>0)
		{
			$update_data = array(


								'user_id'=>$user_id,
								'product_id'=>$product_id,
								'user_name'=>$name,
								'user_email'=>$email,
								'user_message'=>$message,
								'rating'=>$rating,							
								'created_date'=>$current_date,

							);
			$this->db->where('user_id',$user_id);
			$this->db->update('tbl_review',$update_data);
		}
		else
		{
			$insert_data = array(


								'user_id'=>$user_id,
								'product_id'=>$product_id,
								'user_name'=>$name,
								'user_email'=>$email,
								'user_message'=>$message,
								'rating'=>$rating,							
								'created_date'=>$current_date,

							);

			//echo '<pre>'; print_r($insert_data); exit;
			$this->db->insert('tbl_review',$insert_data);
		}
		

		$chk_avg_rating =  $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		//echo '<pre>'; print_r($chk_avg_rating); exit;
		if(@$chk_avg_rating[0]->avg_rating>0)
		{
			$avg_rating = @$chk_avg_rating[0]->avg_rating;
			$new_avg_sum = ($avg_rating+$rating);

			$new_avg = round($new_avg_sum/2);

			//echo $new_avg; exit;

			$new_avg_rating = array(

								
								'avg_rating'=>$new_avg,

							);

			$this->db->where('id',$product_id);
			$this->db->update('tbl_product',$new_avg_rating);
		}
		else
		{
			//echo 'hf'; exit;
			$avg_rating = array(

								
								'avg_rating'=>$rating,

							);
			$this->db->where('id',$product_id);
			$this->db->update('tbl_product',$avg_rating);
		}
		
		@$product_details = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$product_slug = @$product_details[0]->slug;
		redirect($this->url->link(4).'/'.$product_id.'/'.$product_slug,'refresh');

	}
	
	


	
}
?>