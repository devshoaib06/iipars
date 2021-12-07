<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Manage_research extends CI_Controller 
{	
	 
	public function __construct()
    {
          parent::__construct();
           $this->load->database();

	}
	
	public function index()
	{


		$data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');



		$data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('research_general_guideline_view',$data);
		$this->load->view('common/footer');
	}

	public function all()
	{





        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');

        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('research_work_service',$data);
		$this->load->view('common/footer');
	}

	public function writing_consultancy()
	{

$data['page_title']= 'Research Paper Writing Consultancy';



        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');
        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('research_general_guideline_view',$data);
		$this->load->view('common/footer');
	}

	public function paper_publication()
	{


$data['page_title']= 'Research Paper Publication Consultancy';


        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');

        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('research_publication_consultancy',$data);
		$this->load->view('common/footer');
	}
	public function synopsis_writing()
	{
$data['page_title']= 'Synopsis Writing Consultanc';




        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');

        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('research_general_guideline_view',$data);
		$this->load->view('common/footer');
	}

	public function mphil_dissertation()
	{

$data['page_title']= 'M.Phil. Dissertation writing Consultancy';



        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');
        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('mphil_consultancy',$data);
		$this->load->view('common/footer');
	}

	public function project_work()
	{


$data['page_title']= 'Project Work Writing Consultancy';


        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');

        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('project_work_writing_consult',$data);
		$this->load->view('common/footer');
	}

	public function data_analysis()
	{


$data['page_title']= 'Data Analysis & Research Methodology';


        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');
        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('data_analylis_view',$data);
		$this->load->view('common/footer');
	}

	public function project_work_book()
	{


$data['page_title']= 'Project Work to Book Publication';


        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');

        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('project_work_to_book_view',$data);
		$this->load->view('common/footer');
	}

		public function pliagiarism_checking()
	{

$data['page_title']= 'Plagiarism Checking ';



        $data['manage_home']=$this->admin_model->selectAll('tbl_research_guideline');
        $data['subjects']=$this->teachinns_home_model->subjects();
		$this->load->view('common/header',$data);
		$this->load->view('research_general_guideline_view',$data);
		$this->load->view('common/footer');
	}

	public function apply_form()
	{


	


		
		 $this->load->view('common/header');
		$this->load->view('research_online_submission_form');
		$this->load->view('common/footer');
	}


	function research_paper_submit()
	{
		$nam= $this->input->post('nam');
		$email= $this->input->post('email');
		$phone= $this->input->post('phone');
		$wp= $this->input->post('wp');
		$subject= $this->input->post('subject');
		$designation= $this->input->post('designation');
		$subject2= $this->input->post('subject2');
		$specialisation= $this->input->post('specialisation');
		$mphil= $this->input->post('mphil');
		$nopaper= $this->input->post('nopaper');
		$in_words= $this->input->post('in_words');
		$total_amount= $this->input->post('total_amount');
		$t_amount_words= $this->input->post('t_amount_words');




		$data= array(
			 'nam'=>$nam,
			 'email'=>$email,
			 'phone'=>$phone,
			 'wp'=>$wp,
			 'subject'=>$subject,
			 'designation'=>$designation,
			 'subject2'=>$subject2,
			 'specialisation'=>$specialisation,
			 'mphil'=>$mphil,
			 'nopaper'=>$nopaper,
			 'in_words'=>$in_words,
			 'total_amount'=>$total_amount,
			 't_amount_words'=>$t_amount_words,
			 'created_on'=>date('Y-m-d')

		            );


		$this->db->insert('tbl_research_paper_consul_form',$data);
		$this->session->set_flashdata('succ_msg','Submitted Successfully');
		redirect('manage_research/apply_form','refresh');





	}

	

	



	
	
	


	
}
?>