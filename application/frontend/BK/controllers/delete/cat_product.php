<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class cat_product extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();

	}
	
	public function index()
	{
		
		$data['parent_category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('parent_category'=>'o','sub_category'=>'o'), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
        $data['brand'] = $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		$url=$this->uri->segment(2);

		 //$data['url']=$this->blog_model->selectOne('tbl_category','category_slug',@$url);

		 $data['url']=$this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array('category_id'=>@$url), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 if($this->uri->segment(2))
		 {

		 	 $url=$this->uri->segment(2);

		 	 $total_row=$this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('cat_id'=>@$data['url'][0]->category_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		 }

		 else
		 {
			 $total_row=$this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		 }


            if($this->uri->segment(2))
            {
            		$url=$this->uri->segment(2);
                    $config['base_url'] = base_url().$this->url->slug(2)."/".$url."?";
            }

              else
            {
                 $config['base_url'] = base_url().$this->url->slug(2)."/".$url."?";
            }

             $config['total_rows'] = count($total_row); 
            $config['per_page'] = 10;
            $config['first_link'] = 'FIRST';
            $config['last_link'] = 'LAST';
            $config['first_tag_open'] = '<li  class="paging-nav">';
            $config['first_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li  class="paging-nav">';
            $config['last_tag_close'] = '</li>';
            $config['next_link'] = 'NEXT<i class="fa fa-angle-double-right"></i>';
            $config['next_tag_open'] = '<li  class="paging-nav">';
            $config['next_tag_close'] = '</li>';
            $config['prev_link'] = '<i class="fa fa-angle-double-left"></i>PREV';
            $config['prev_tag_open'] = '<li  class="paging-nav">';
            $config['prev_tag_close'] = '</li>';
            $config['full_tag_open'] = '<ul class="pagination" id="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['cur_tag_open'] = '<li class="number active"><span class="font600"><b>';
            $config['cur_tag_close'] = '</b></span></li>';
            $config['num_tag_open'] = '<li class="number"><span class="font600">';
            $config['num_tag_close'] = '</span></li>';

            $config["num_links"] =5;
            $config['page_query_string'] = TRUE;

             $this->pagination->initialize($config);
            if(isset($_GET['per_page'])){
                $page = $_GET['per_page'] ;


            }
            else{
                $page = 0;
            }

             $str_links = $this->pagination->create_links();

          
            /*echo "<pre>";print_r($str_links);
            exit;*/
           $data['links'] = $str_links;

             if($this->uri->segment(2))
            {
            		 $url=$this->uri->segment(2);
                    //echo $url;exit;
                    $url_id= @$data['url'][0]->category_id;
                   // fetch_all_blog_select('tbl_product',$config['per_page'],$page,$url_id);

                    $data['product']= $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('cat_id'=>$url_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = $page, $end = $config['per_page']);
            }

             else
            {
            	 $data['product']= $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('cat_id'=>@$url_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = $page, $end = $config['per_page']);

               // $data['product']=$this->blog_model->fetch_all_blog('tbl_product',$config['per_page'],$page);
            }

	
		
		$this->load->view('common/header');
		$this->load->view('category',$data);
		$this->load->view('common/footer');
	}
	
	


	
}
?>