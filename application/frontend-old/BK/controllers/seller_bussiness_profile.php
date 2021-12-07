<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class seller_bussiness_profile extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();
           $this->load->library('image_lib');

	}

	public function index()
	{
		
        $this->session->unset_userdata('search_sess_name');
        $this->session->unset_userdata('search_category');
        
        $seller_id=$this->session->userdata('user_session_id');
		//echo $seller_id;exit;

		$data['seller_detail'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['seller_company_detail'] = $this->common_model->common($table_name = 'tbl_seller_company', $field = array(), $where = array('seller_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



	    $this->load->view('common/header');
		$this->load->view('seller_bussiness_profile',$data);
		$this->load->view('common/footer');

	}

	public function seller_bussiness_profile_action()
	{
		$seller_id=$this->session->userdata('user_session_id');
		//echo $seller_id;exit;
		$chk_seller_company = $this->common_model->common($table_name = 'tbl_seller_company', $field = array(), $where = array('seller_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
		

		$company_name=$this->input->post('company_name');
		$company_phone=$this->input->post('company_phone');
		$company_email=$this->input->post('company_email');
		$company_gst=$this->input->post('company_gst');
		$company_address=$this->input->post('company_address');
		$company_city=$this->input->post('company_city');
		$company_pincode=$this->input->post('company_pincode');
		$company_state=$this->input->post('company_state');


		$fname=$this->input->post('fname');
		$lname=$this->input->post('lname');
		$email=$this->input->post('email');
		$mobile=$this->input->post('mobile');

		//echo $fname;exit;
		if(count($chk_seller_company)>0)
		{
			$data=array(

				'company_name'=>$company_name,
				'company_phone'=>$company_phone,
				'company_email'=>$company_email,
				'company_gstin'=>$company_gst,
				'company_address'=>$company_address,
				'company_city'=>$company_city,
				'company_pincode'=>$company_pincode,
				'company_state'=>$company_state,
				'seller_id'=>$seller_id


			);
			$this->db->where('seller_id',$seller_id);
			$this->db->update('tbl_seller_company',$data);
			$this->session->set_flashdata('updtmsg','Data has been updated properly...');

		}
		else
		{
			$data=array(

				'company_name'=>$company_name,
				'company_phone'=>$company_phone,
				'company_email'=>$company_email,
				'company_gstin'=>$company_gst,
				'company_address'=>$company_address,
				'company_city'=>$company_city,
				'company_pincode'=>$company_pincode,
				'company_state'=>$company_state,
				'seller_id'=>$seller_id


			);

		
			$this->db->insert('tbl_seller_company',$data);
			$this->session->set_flashdata('msg','Data has been added properly...');
		}
		
		//redirect($this->url->link(21),'refresh');
	

	

	    //$hidden_seller_id=$this->input->post('hidden_seller_id');
	    	/*$this->db->where('seller_id',$seller_id);
		    $this->db->update('tbl_seller_company',$data);
			
			$this->session->set_flashdata('updtmsg','Data has been updated properly...');
			redirect($this->url->link(21),'refresh');*/
			if($_FILES['img_upload']['name']=="")
        {
             $image=$this->input->post('hidden_image');
            
        }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['img_upload']['tmp_name'];
            $file = $_FILES['img_upload']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg")
            {
            	$image=$this->input->post('hidden_image');

                @unlink('./assets/upload/seller_image/'.$image);

                move_uploaded_file($file_tmp, "./assets/upload/seller_image/" . $new_name . "." . $ext);

                $image = $new_name . "." . $ext;
               
           
           
                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = './assets/upload/seller_image/'.$image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 116;
                $img_config_4['height'] = 116;
                $img_config_4['new_image'] ='./assets/upload/seller_image/'.$image;
                //echo '<pre>';print_r($img_config_4);
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                $this->image_lib->clear();

                   
             
                      

            }
            else
            {
                $this->session->set_flashdata('image_error','please upload an image..!');
                 redirect($this->url->link(5),'refresh');
            }
        }
	    
		$seller_detail=array(


					'first_name'=>$fname,
					'last_name'=>$lname,
					'login_email'=>$email,
					'image'=>$image,
					'mobile'=>$mobile
			);
		$this->db->where('user_id',$seller_id);
		$this->db->update('tbl_user',$seller_detail);
		$this->session->set_flashdata('update','Data has been updated successfully...');
		redirect($this->url->link(21),'refresh');
	


	}

	function change_password()
	{

		$user_id = $this->session->userdata('user_session_id');

	    $data['password'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$this->load->view('common/header');
		$this->load->view('seller_password_change',$data);
		$this->load->view('common/footer');
	}
	function get_old_password()
    {
        
        $old_pass=$this->input->post('id');
        $old_pass_md=$old_pass;
        $user_id = $this->session->userdata('user_session_id');

        $data=$this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('login_pass'=>$old_pass_md,'user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        //$data=$this->admin_model->selectOne('tbl_user','login_pass',$old_pass_md);
        if(count($data)==0)
        {
            $status='N';
        }
        echo json_encode(array('msg'=>$status));

    }

	function change_password_action()
	{
			$old_pass=$this->input->post('hidden_pass');
			$user_id=$this->input->post('user_id');
			//$user_id = $this->session->userdata('user_session_id');
			$old_pass_user_typing=$this->input->post('old_pass');
			$new_pass=$this->input->post('new_pass');
			$confirm_pass=$this->input->post('confirm_pass');

			
					if($old_pass==$old_pass_user_typing && $new_pass==$confirm_pass)

					{
							$data=array(

									'login_pass'=>$new_pass
								);

							$this->db->where('user_id',$user_id);
		                    $this->db->update('tbl_user',$data);
		                    $this->session->set_flashdata('succ_msg','<strong>Password Has been Changed Successfully...</strong>');
		                   redirect($this->url->link(22),'refresh');

					}

					else
					{
								$this->session->set_flashdata('error_msg','<strong>Password Not matched properly...</strong>');
		                       redirect($this->url->link(22),'refresh');

					}
	}

	function seller_product_list()
	{

		   $user_id = $this->session->userdata('user_session_id');

		   $data['user'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


	       $data['product_list'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('seller_id'=>$user_id,'user_type_id'=>2), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

			$this->load->view('common/header');
		    $this->load->view('seller_product_list',$data);
		    $this->load->view('common/footer');

	}

	function add_product()
	{
		
			$seller_id=$this->session->userdata('user_session_id');
		//echo $seller_id;exit;
			$data['product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

			//$data['category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

			$data['brand'] = $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');




		$data['seller_detail'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');


			$this->load->view('common/header');
		    $this->load->view('seller_add_product',$data);
		    $this->load->view('common/footer');
	}

	function create_slug($string)
  {     
        $replace = '-';         
        $string = strtolower($string);     
 
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);     
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
 
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);     
 
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);     
 
        //limit the slug size     
        $string = substr($string, 0, 100);     
 
        //slug is generated     
        return $string; 
    }

    function change_home_status()
    {
    $p_id=$this->input->post('pid');

      $data= $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$p_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

    //$data=$this->admin_model->selectOne('tbl_product','id',$p_id);
    $home_stat=$data[0]->featured;


    if($home_stat=="Yes")
    {
        $pop="No";
        $result['status']=0;
    }
    if($home_stat=="No")
    {
        $pop="Yes";
        $result['status']=1;
    }
    $data=array('featured'=>$pop);

    $this->db->where('id',$p_id);
    $this->db->update('tbl_product',$data);
    
    echo json_encode(array('changedone'=>$result));

}


	function category_slug_show()
     {
            
            $category_slug=$this->input->post('slug');

            $cat_slug=$this->create_slug($category_slug);

            if($cat_slug!='')
            {

             echo json_encode(array('slug_name'=>$cat_slug));

            }


    }

    function file_box_show()
    {
            $id=$this->input->post('num');
            $next=$id+1;
            ?>
      
          
                 <div class="row" id="bp-mar">
                                           <div class="col-lg-3 col-md-3 col-sm-4 col-xs-">
                                        <label>Product image<sup><i class="fa fa-star" id="font-sz"></i></sup></label> 
                                          </div>
                                            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                                                <input class="form-control" type="file" name="image[]" id="image" style="margin-bottom:12px" >

                                                    
                                            </div>
                                            <table>
                                                    <tr>
                                                         <td>
                                            <?php if($next!=5){ ?><a href="javacript:void(0)" class="btn btn-primary" id="no_<?php echo $next; ?>" onclick="produce_file_box('<?php echo $next; ?>')"><b>+</b></a><?php } ?></td>
                                        <td>
                                                                 <a href="javacript:void(0)" class="btn btn-primary" id="minus" onclick="hiding_out('<?php echo $next; ?>');"><b>-</b></a></td>
                                                    </tr>
                                            </table>
                                           
                                        </div>
        <?php
      }


      function add_seller_product_action()
      {
      	$seller_id=$this->session->userdata('user_session_id');
      	$cat_id = $this->input->post('category');
    	$product_name = $this->input->post('product_name');
        $brand = $this->input->post('brand');
        $weight = $this->input->post('weight');
    	//$featured = $this->input->post('featured');
    	$availability = $this->input->post('availability');
    	$price = $this->input->post('price');
    	$discount = $this->input->post('discount');
    	$sku = $this->input->post('sku');
    	$manufactured=$this->input->post('manufactured_date');
        $manufactured_date = date("Y-m-d", strtotime($manufactured));    	
    	$expiry=$this->input->post('expiry_date');
        $expiry_date = date("Y-m-d", strtotime($expiry)); 
    	$product_description=$this->input->post('product_description');
    	$meta_title=$this->input->post('meta_title');
    	$meta_key=$this->input->post('meta_key');
    	$meta_description=$this->input->post('meta_description');
    	$product_slug=$this->create_slug($product_name);
    	$status=$this->input->post('status');
        //$pro_slug=$this->create_slug($product_name);

        if($discount > 0)
        { 

            
            $disc_amnt= $price*($discount/100);
            $net_price1=($price-$disc_amnt);
            $net_price= number_format($net_price1, 2, '.', '');

        }
        else
        {
        	$net_price = $price;
        }

        $pro_image= $this->image_upload();

        $current_date=date('Y-m-d H:i:s');

        $data = array(

    			'cat_id'=>$cat_id,    			
    			'product_name'=>$product_name,
                'brand_id'=>$brand,
                'slug'=>$product_slug,
    			'price'=>$price,
    			'weight'=>$weight,
    			'discount'=>$discount,    			
    			'net_price'=>$net_price,
    			//'featured'=>$featured,
    			'availability'=>$availability,
    			'sku_id'=>$sku,
    			'status'=>$status,
    			'manufactured_date'=>$manufactured_date,
    			'expiry_date'=>$expiry_date,
    			'description'=>$product_description,
    			'meta_title'=>$meta_title,
    			'meta_description'=>$meta_description,    			    			
    			'meta_keyword'=>$meta_key,
    			'created_by'=>$this->session->userdata('user_session_id'),
    			'seller_id'=>$seller_id,
    			'user_type_id'=>2,
    			'created_on'=>$current_date

                );
        //print_r($data);exit;

        $this->db->insert('tbl_product',$data);

        $product_id = $this->db->insert_id();

        if(count($pro_image)>0)
				{
					for($x=0;$x<count($pro_image);$x++)
					{
						//echo $image[$x]['product_image'];exit;
						$product_image_array = array(

													'product_id'=>$product_id,
													'image'=>$pro_image[$x]['product_image'],
																										
													);
						//print_r($product_image_array);exit;
						$this->db->insert('tbl_product_image',$product_image_array);
					}
				}

				$this->session->set_flashdata('succ_add','One Product added successfully');
    	       redirect($this->url->link(23),'refresh');
      }

    function image_upload()
	{
		//echo $abc;exit;
		$this->load->library('upload');		
		//print_r($_FILES['image']['name']);
		$files = $_FILES;
		$cpt = count($_FILES['image']['name']);
		$count = 0;
		$image_array = array();
		for($i=0; $i<$cpt; $i++)
		{	
			$_FILES['userfile']['name']= $files['image']['name'][$i];
        	$_FILES['userfile']['type']= $files['image']['type'][$i];
        	$_FILES['userfile']['tmp_name']= $files['image']['tmp_name'][$i];
        	$_FILES['userfile']['error']= $files['image']['error'][$i];
        	$_FILES['userfile']['size']= $files['image']['size'][$i];    

        	$this->upload->initialize($this->set_upload_options());
			if($this->upload->do_upload())
			{
				$file_info = $this->upload->data();
				//echo '<pre>';print_r($file_info); exit;
				$img_config_4['image_library'] = 'gd2';
				$img_config_4['source_image'] = 'assets/upload/product/'.$file_info['orig_name'];
				$img_config_4['create_thumb'] = FALSE;
				$img_config_4['maintain_ratio'] = FALSE;
				$img_config_4['width'] = 317;
		   		$img_config_4['height']= 317;
				$img_config_4['new_image'] ='assets/upload/product/large/'.$file_info['orig_name'];
				//echo '<pre>';print_r($img_config_4); exit;
				//$image_config['quality'] = "100%";
				//$image_config['master_dim'] = "height";
				$this->image_lib->initialize($img_config_4);
				$this->image_lib->resize();
				$this->image_lib->clear();
				
		   

				$img_config_4['image_library'] = 'gd2';
				$img_config_4['source_image'] = 'assets/upload/product/'.$file_info['orig_name'];
				$img_config_4['create_thumb'] = FALSE;
				$img_config_4['maintain_ratio'] = FALSE;
				$img_config_4['width']	= 189;
				$img_config_4['height']	= 189;
				$img_config_4['new_image'] ='assets/upload/product/'.$file_info['orig_name'];
				//echo '<pre>';print_r($img_config_4);
				//$image_config['quality'] = "100%";
                //$img_config_4['master_dim'] = "height";
				$this->image_lib->initialize($img_config_4);
				$this->image_lib->resize();

				$this->image_lib->initialize($img_config_4);
				$this->image_lib->resize();
				$this->image_lib->clear();

			
				
				//echo '<pre>';print_r($file_info);exit;
				$image_array[$count]['product_image'] = $file_info['orig_name'];
				$count++;
			}
		}	

		
		//echo '<pre>';print_r($image_array);
		//exit;
		return $image_array;      
	}

    private function set_upload_options()
	{   
    //upload an image options
    	$new_name = str_replace(".","",microtime());						
		$config['upload_path'] ='assets/upload/product/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';				
		$config['file_name']=$new_name;
		
		//echo '<pre>';print_r($config);exit;
		
    	return $config;
	} 

	function edit_seller_product_action()
	{
		$pro_id=$this->input->post('edit_id');
				
		$seller_id=$this->session->userdata('user_session_id');
      	$cat_id = $this->input->post('category');
    	$product_name = $this->input->post('product_name');
        $brand = $this->input->post('brand');
        $weight = $this->input->post('weight');
    	//$featured = $this->input->post('featured');
    	$availability = $this->input->post('availability');
    	$price = $this->input->post('price');
    	$discount = $this->input->post('discount');
    	$sku = $this->input->post('sku');
    	$manufactured=$this->input->post('manufactured_date');
        $manufactured_date = date("Y-m-d", strtotime($manufactured));    	
    	$expiry=$this->input->post('expiry_date');
        $expiry_date = date("Y-m-d", strtotime($expiry)); 
    	$product_description=$this->input->post('product_description');
    	$meta_title=$this->input->post('meta_title');
    	$meta_key=$this->input->post('meta_key');
    	$meta_description=$this->input->post('meta_description');
    	$product_slug=$this->create_slug($product_name);
    	$status=$this->input->post('status');

    	if($discount > 0)
        { 

            
            $disc_amnt= $price*($discount/100);
            $net_price1=($price-$disc_amnt);
            $net_price= number_format($net_price1, 2, '.', '');

        }
        else
        {
            $net_price = $price;
        }

       
        
        $current_date=date('Y-m-d H:i:s');

         $data = array(

    			'cat_id'=>$cat_id,    			
    			'product_name'=>$product_name,
                'brand_id'=>$brand,
                'slug'=>$product_slug,
    			'price'=>$price,
    			'weight'=>$weight,
    			'discount'=>$discount,    			
    			'net_price'=>$net_price,
    			//'featured'=>$featured,
    			'availability'=>$availability,
    			'sku_id'=>$sku,
    			'status'=>$status,
    			'manufactured_date'=>$manufactured_date,
    			'expiry_date'=>$expiry_date,
    			'description'=>$product_description,
    			'meta_title'=>$meta_title,
    			'meta_description'=>$meta_description,    			    			
    			'meta_keyword'=>$meta_key,
    			'modified_by'=>$this->session->userdata('user_session_id'),
    			'seller_id'=>$seller_id,
    			'user_type_id'=>2,
    			'modified_on'=>$current_date

                );

         	$this->db->where('id',$pro_id);
         	$this->db->update('tbl_product',$data);

         	   $this->session->set_flashdata('succ_updt','One Product Updated successfully');
    	       redirect($this->url->link(23),'refresh');

	}

	function product_image_view()

	{

		$product_id=$this->uri->segment(3);
        //echo $product_id; exit;
       $user_id = $this->session->userdata('user_session_id');

		   $data['user'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

        $data['product_image'] = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$product_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



            $this->load->view('common/header');
		    $this->load->view('product_image_list',$data);
		    $this->load->view('common/footer');
	}

	function delete_seller_product()
{
	$id=$this->uri->segment(3);
	//echo $id; exit;
	$data = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

	$image = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');
	
	
	if(count($data)!=0)
			{
			$this->db->where('id',$id);
			$this->db->delete('tbl_product');

			$this->db->where('product_id',$id);
			$this->db->delete('tbl_product_image');

			}
	if(count($image)>0)
	{
		for($x=0;$x<count($image);$x++)
						{
						
							@unlink('assets/upload/product/'.$image[$x]->image);
							@unlink('assets/upload/product/large/'.$image[$x]->image);
																																														
							
						}
	}
			
				
	$this->session->set_flashdata('succ_delete','One Product deleted successfully');	
	redirect($this->url->link(23),'refresh');

}

public function delete_seller_product_image()
	{
		

		$pro_image_id = $this->uri->segment(3);
		

		$data['product_id'] = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('pro_image_id'=>$pro_image_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$product_id = $data['product_id'][0]->product_id;
		$product_image = $data['product_id'][0]->image;
		//echo $product_image; exit;
		$this->db->where('pro_image_id',$pro_image_id);
		$this->db->delete('tbl_product_image');

		@unlink('assets/upload/product/'.$product_image);
		@unlink('assets/upload/product/large/'.$product_image);

		$this->session->set_flashdata('succ_delete','One Product Image deleted successfully');
    	redirect('seller_bussiness_profile/product_image_view/'.$product_id,'refresh');


	}

	function seller_image_upload()
	{
			if($_FILES['img_upload']['name']=="")
        {
            $image="";
            
        }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['img_upload']['tmp_name'];
            $file = $_FILES['img_upload']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg")
            {
                move_uploaded_file($file_tmp, "assets/upload/product/" . $new_name . "." . $ext);
                
                $image = $new_name . "." . $ext;

                



                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = 'assets/upload/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 189;
                $img_config_4['height'] = 189;
                $img_config_4['new_image'] ='assets/upload/product/' . $image;
                //echo '<pre>';print_r($img_config_4); exit;
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                

                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = 'assets/upload/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 317;
                $img_config_4['height'] = 317;
                $img_config_4['new_image'] ='assets/upload/product/large/' . $image;
                //echo '<pre>';print_r($img_config_4); exit;
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                $this->image_lib->clear();


            
            }



            
        }
        $prod_id=$this->input->post('pro_id');
        //echo $prod_id;exit;
        $seller_image_upload=array(

        			'image'=>$image,
        			'product_id'=>$prod_id
        	);
            $this->db->insert('tbl_product_image', $seller_image_upload);

        	$this->session->set_flashdata('succ_image','One Product Image Added successfully');
            redirect('seller_bussiness_profile/product_image_view/'.$prod_id,'refresh');
	}

	function edit_seller_product()
	{

		$id=$this->uri->segment(3);

		$seller_id = $this->session->userdata('user_session_id');

		$data['product_details'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		$data['seller_detail'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		//$data['category'] = $this->common_model->common($table_name = 'tbl_category', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



        //$data['category']=$this->admin_model->selectAll('tbl_category');
        $data['brand'] = $this->common_model->common($table_name = 'tbl_brand', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

         $data['product_image'] = $this->common_model->common($table_name = 'tbl_product_image', $field = array(), $where = array('product_id'=>$id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');



        //$data['brand']=$this->admin_model->selectAll('tbl_brand');
        //$data['product_image']=$this->admin_model->selectOne('tbl_product_image','product_id',$pro_id);


		    $this->load->view('common/header');
		    $this->load->view('seller_product_edit',$data);
		    $this->load->view('common/footer');


	}

	function seller_image_edit_upload()
	{

		$id=$this->input->post('hidden_id');
		$pro_id=$this->input->post('hidden_pro_id');
		$img=$this->input->post('hidden_img');
		

		        if($_FILES['img_upload']['name']=="")
        {
            $image=$img;
            
        }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['img_upload']['tmp_name'];
            $file = $_FILES['img_upload']['name'];
            $ext = substr(strrchr($file, '.'), 1);
            if ($ext == "png" || $ext == "jpg" || $ext == "jpeg")
            {
            	$image=$img;
            	@unlink('../assets/upload/product/'.$image);
			    @unlink('../assets/upload/product/large/'.$image);

                move_uploaded_file($file_tmp, "assets/upload/product/" . $new_name . "." . $ext);
                
                $image = $new_name . "." . $ext;

                



                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = 'assets/upload/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 189;
                $img_config_4['height'] = 189;
                $img_config_4['new_image'] ='assets/upload/product/' . $image;
                //echo '<pre>';print_r($img_config_4); exit;
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                

                $img_config_4['image_library'] = 'gd2';
                $img_config_4['source_image'] = 'assets/upload/product/' . $image;
                $img_config_4['create_thumb'] = FALSE;
                $img_config_4['maintain_ratio'] = FALSE;
                $img_config_4['width']  = 317;
                $img_config_4['height'] = 317;
                $img_config_4['new_image'] ='assets/upload/product/large/' . $image;
                //echo '<pre>';print_r($img_config_4); exit;
                $this->image_lib->initialize($img_config_4);
                $this->image_lib->resize();
                $this->image_lib->clear();


            
            }




            
        }
         $data = array(	

         	            'pro_image_id'=>$id,
						'image'=>$image 

					   );

       // echo '<pre>'; print_r($data); exit;
		$this->db->where('pro_image_id',$id);
		$this->db->update('tbl_product_image',$data);
		$this->session->set_flashdata('succ_updt_image','One Product Image Updated successfully....');
        redirect('seller_bussiness_profile/product_image_view/'.$pro_id,'refresh');


		

	}

	function close_seller_account()

	{
			$seller_id = $this->session->userdata('user_session_id');

			//echo $seller_id;exit;

			$data['seller_detail'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$seller_id), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

			 $this->load->view('common/header');
		     $this->load->view('seller_close_account',$data);
		     $this->load->view('common/footer');


	}

	function close_account()
	{

		$user_id = $this->session->userdata('user_session_id');

		$data['acc_close'] = $this->common_model->common($table_name = 'tbl_user', $field = array(), $where = array('user_id'=>$user_id,'user_type_id'=>2), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		//$data['product'] = $this->common_model->common($table_name = 'tbl_product', $field = array(), $where = array('seller_id'=>$user_id,'user_type_id'=>2), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '');

		






		
		if(@count($data['acc_close'][0])>0)
		{

			$data=array(

					'status'=>'inactive'

				      );

			$this->db->where('user_id',$user_id);
			$this->db->update('tbl_user',$data);

		
				$data=array(

					'product_show_status'=>'inactive'

				      );

			$this->db->where('seller_id',$user_id);
			$this->db->update('tbl_product',$data);

		}	
			$this->session->unset_userdata('user_session_id');
			$this->session->set_flashdata('close_acc','Your Account Successfully Deactivated....');
			redirect($this->url->link(3),'refresh');
		}






	

	


}
?>