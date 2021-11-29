<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class product_details extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();

	}

	public function index()
	{

		$id=$this->uri->segment(2);

		$product_cat = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$pro_cat_id = @$product_cat[0]->cat_id;




		$data['product_details']= $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$id,'status'=>'Active'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['product_details_image']= $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>@$data['product_details'][0]->id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


		$data['related_product']=$this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id !='=>$id,'status'=>'Active','cat_id'=>$pro_cat_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['total_review']= $this->common_model->common($table_name = 'tbl_review', $field = array(), $where = array('product_id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$color = $product_cat[0]->product_shipping_weight_class; 
		$data['pro_color']= $this->common_model->common($table_name = 'tbl_weight_class', $field = array(), $where = array('weight_class_id'=>$color), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['banner'] = $this->common_model->common($table_name = 'tbl_banner', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '0', $end = '4');
		$data['trending_product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '0', $end = '8');

		$data['product_color_id'] = $this->common_model->common($table_name = 'tbl_product_color', $field = array(), $where = array('product_id'=>@$data['product_details'][0]->id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		
		//echo "<pre>";
		//print_r($data['product_color_id']);exit;
		//$data['product_color_id'] = $this->common_model->common($table_name = 'tbl_product_color', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array('id'=>'DESC'), $start = '0', $end = '8');

		$data['color_id'] = $this->common_model->common($table_name = 'tbl_color', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         $data['color']=array();
         foreach ($data['product_color_id'] as $value) {
         	foreach ($data['color_id'] as  $value1) {
         		if ($value->color_id==$value1->color_id) {
         			$data['color'][]=$value1->color_code;
         		}
         	}
         }

        //print_r($data['color']);exit();
		//echo $data['product_details'][0]->id;
		//echo '<pre>'; print_r($data['product_color_id']);exit;
        $data['pro_size'] = $this->common_model->common($table_name = 'tbl_product_size', $field = array(), $where = array('product_id'=>@$data['product_details'][0]->id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



		$this->load->view('common/header');
		$this->load->view('product_details',$data);
		$this->load->view('common/footer');
	}

}