<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class home extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{
		
		$data['parent_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$data['home_show_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o','show_menu'=>'yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['featured_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('featured'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		//$data['popular_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('popular_product'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		//$data['top_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('top_product'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['special_offer_product_1'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('popular_product'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '0', $end = '3');
		$data['special_offer_product_2'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('popular_product'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '3', $end = '3');
		$data['special_offer_product_3'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('popular_product'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '6', $end = '3');
		/*if (is_float((count($data['special_offer_product']))/3))
		{
  			$str = ((count($data['special_offer_product']))/3); 
			$str_arr = explode('.',$str);
			//echo $str_arr[0];  exit;
			$data['spcl_off_pro_div'] = ($str_arr[0])+1;
			//echo $data['spcl_off_pro_div']; exit;
		}
		else
		{
			$data['spcl_off_pro_div'] = ((count($data['special_offer_product']))/3);
		}*/
		//$data['special_deal_product_1'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('special_deals'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '0', $end = '3');
		//$data['special_deal_product_2'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('special_deals'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '3', $end = '3');
		//$data['special_deal_product_3'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('special_deals'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '6', $end = '3');

		$data['trending_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '0', $end = '8');
		$data['best_seller_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('best_seller'=>'Yes'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['slider'] = $this->common_model->common($table_name = 'tbl_home_slider', $field = array(), $where = array('status'=>'active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$data['banner'] = $this->common_model->common($table_name = 'tbl_banner', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '0', $end = '4');
		//echo '<pre>'; print_r($data); exit;
		
		$this->load->view('common/header');
		$this->load->view('home',$data);
		$this->load->view('common/footer');
	}
	
	


	
}
?>