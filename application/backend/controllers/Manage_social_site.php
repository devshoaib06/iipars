<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_social_site extends CI_Controller 
{
	
 public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('admin_model');
        $this->load->model('common');
        $this->load->model('url_slug_model');
	    $this->load->model('page_model');
		$this->load->library('image_lib');
        $this->load->helper('text');
		$this->session_check_and_session_data->session_check();
		
    }

public function site_view()
{
	if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }

	 $data['active']="Manage_social_site";
	$data['site']=$this->common->select($table_name='tbl_social_link',$field=array(),$where=array(),$like=array(),$order=array(),$where_or=array(),$like_or_array=array());

	
	


	    $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
       $this->load->view('manage_social_site/social_link',$data);
        $this->load->view('common/footer');
	
}

public function site_update()
{
	
	if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }

	$fb=$this->input->post('fb');
	$twt=$this->input->post('twitter_link');
	$insta=$this->input->post('insta_link');

	$linked=$this->input->post('linked_link');
	$ytb=$this->input->post('youtube_link');
	$pinter_link=$this->input->post('pinter_link');
	$gplus_link=$this->input->post('gplus_link');
	
	$id=$this->input->post('site_id');
	
	$data_update=array(
					  'facebook_link'=>$fb,
					  'twitter_link'=>$twt,
					  'instagram_link'=>$insta,
					  'linkedin_link'=>$linked,
					  'youtube_link'=>$ytb,
					  'pinterest_link'=>$pinter_link,
					  'googleplus_link'=>$gplus_link,
					 
				);
	$this->db->where('id',$id);
	$this->db->update('tbl_social_link',$data_update);
	$this->session->set_flashdata('succ_msg','social site updated successfully');
    redirect('Manage_social_site/site_view/','refresh');
	

}



public function visitor()
{
	if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }

	 $data['active']="visitor";
	$data['visitor']=$this->common->select($table_name='tbl_no_of_visitor',$field=array(),$where=array(),$like=array(),$order=array(),$where_or=array(),$like_or_array=array());

	
	


	    $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
       $this->load->view('visitor',$data);
        $this->load->view('common/footer');
	
}


function visitor_update()
{
	$visitor= $this->input->post('visitor');
	$hidden_id= $this->input->post('hidden_id');

	$data= array(
		     'count'=>$visitor
	             );

	$this->db->where('id',$hidden_id);
	$this->db->update('tbl_no_of_visitor',$data);

	$this->session->set_flashdata('succ_msg','Updated successfully');


    redirect('Manage_social_site/visitor/','refresh');


}



public function download()
{
	if($this->session->userdata('hs_admin_id')=="")
      {
      	redirect('index.php/admin_login');
      }

	 $data['active']="download";
	$data['download']=$this->common->select($table_name='tbl_download',$field=array(),$where=array(),$like=array(),$order=array(),$where_or=array(),$like_or_array=array());

	
	


	    $this->load->view('common/header');
        $this->load->view('common/leftmenu',$data);
       $this->load->view('download',$data);
        $this->load->view('common/footer');
	
}


function download_update()
{
	$content= $this->input->post('content');
	$old_image= $this->input->post('old_image');

	$hidden_id= $this->input->post('hidden_id');


	  	if($_FILES['image']['name']==NULL)

         {
             $image=$old_image;
         }
        else
        {
            $new_name1 = str_replace(".", "", microtime());
            $new_name = str_replace(" ", "_", $new_name1);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file = $_FILES['image']['name'];
            $ext = substr(strrchr($file, '.'), 1);
          
               
              
              

                move_uploaded_file($file_tmp, "../assets/upload/prospecus/" . $new_name . "." . $ext);
                $image = $new_name . "." . $ext;
                @unlink('../assets/upload/prospecus/'.$old_image);

                // $config['image_library'] = 'gd2';
                // $config['source_image'] = '../assets/upload/prospecus/' . $image;
                // $config['maintain_ratio'] = FALSE;
                // $config['quality'] = "100%";
               
    
                // $config['create_thumb'] = FALSE;
                // $config['maintain_ratio'] = FALSE;
                // $config['new_image'] = '../assets/upload/slider/small/' .$image;
                // $config['quality'] = "100%";
                // $config['width'] = 1920;
                // $config['height']= 550;
                // $config['master_dim'] ="height" ;

               // $this->image_lib->initialize($config);
               // $this->image_lib->resize(); 
               // $this->image_lib->clear();
                      
            
           
        }

	$data= array(
		     'content'=>$content,
		     'prospectus'=>$image,
	             );

	$this->db->where('id',$hidden_id);
	$this->db->update('tbl_download',$data);

	$this->session->set_flashdata('succ_msg','Updated successfully');


    redirect('Manage_social_site/download/','refresh');


}



}
?>



