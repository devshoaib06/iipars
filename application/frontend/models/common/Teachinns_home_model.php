<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class teachinns_home_model extends CI_Model
{
	public $db2;

	function __construct()
	{
		// Call the Model constructor
		parent::__construct();
		$this->db2 = $this->load->database('database2', TRUE);
	}

	public function common($table_name = '', $field = array(), $where = array(), $where_or = array(), $like = array(), $like_or = array(), $order = array(), $start = '', $end = '', $where_in_array = array())
	{
		// echo "<pre>";
		// print_r($this->db2);
		// die;
		if (trim($table_name)) {
			if (count($field) > 0) {
				$field = implode(',', $field);
			} else {
				$field = '*';
			}

			$this->db2->select($field);
			$this->db2->from($table_name);

			if (count($where) > 0) {

				foreach ($where as $key => $val) {
					if (trim($val)) {
						$this->db2->where($key, $val);
					}
				}
			}


			if (count($where_or) > 0) {
				foreach ($where_or as $key => $val) {


					if (trim($val)) {

						$this->db2->or_where($key, $val);
					}
				}
			}

			if (count($order) > 0) {

				foreach ($order as $key => $val) {
					if (trim($val)) {
						$this->db2->order_by($key, $val);
					}
				}
			}

			if (count($like) > 0) {

				foreach ($like as $key => $val) {
					if (trim($val)) {
						$this->db2->like($key, $val);
					}
				}
			}


			if ($end) {

				$this->db2->limit($end, $start);
			}

			if (count($where_in_array) > 0) {

				$this->db2->where_in('user_id', $where_in_array);
			}

			$query = $this->db2->get();
			$resultResponse = $query->result();
			return $resultResponse;
		} else {
			echo 'Table name should not be empty';
			exit;
		}
	}

	public function sum($table_name = '', $field_name = '', $where = array(), $where_or = array(), $start = '', $end = '')
	{
		if (trim($field_name) && trim($table_name)) {
			$this->db->select_sum($field_name);
			$this->db->from($table_name);

			if (count($where) > 0) {

				foreach ($where as $key => $val) {
					if (trim($val)) {
						$this->db->where($key, $val);
					}
				}
			}
			$query = $this->db->get();
			$resultResponse = $query->result();
			return $resultResponse;
		} else {
			echo 'Opps!something went wrong';
		}
	}


	public function subjects()
	{
		//$this->db->select('DISTINCT(subject_name)'); 
		//echo "<pre>";
		//print_r($this->db2);die;
		$this->db2->select('*');
		//$this->db->group_by('subject_name'); 
		$this->db2->from('paper_masters');
		$this->db2->where('status', 1);


		$query = $this->db2->get();
		return $query->result();
	}
	public function units()
	{

		$this->db2->select('*');
		//$this->db->group_by('subject_name'); 
		$this->db2->from('subject_masters');
		$this->db2->where('status', 1);


		$query = $this->db2->get();
		return $query->result();
	}
	public function subjectUnits($subject_id)
	{
		// echo "<pre>";
		// print_r($subject_id);die;
		$this->db2->select('*');
		$this->db2->from('paper_masters');
		$this->db2->where('status', 1);


		$query = $this->db2->get();
		return $query->result();
	}
	public function subjectUnitMaterial($subject_id)
	{
		// echo "<pre>";
		// print_r($subject_id);die;
		$this->db2->select('*');
		$this->db2->from('paper_masters');
		$this->db2->where('status', 1);


		$query = $this->db2->get();
		return $query->result();
	}



	public function getCourseInfo($exam_id = 1, $paper_id)
	{
		$this->db2->select('cepr.product_id,cepr.exam_id,cepr.paper_id,products.name,products.slug');
		$this->db2->join('products','cepr.product_id=products.product_id');
		$this->db2->from('course_exam_paper_relations as cepr');
		$this->db2->where('exam_id', $exam_id);
		$this->db2->where('paper_id', $paper_id);


		$query = $this->db2->get();
		return $query->row();
	}
	public function getPaperUnits($exam_id = 1, $paper_id)
	{
		$this->db2->select('cepsr.product_id,products.is_preview,cepsr.exam_id,cepsr.paper_id,products.name,products.slug,subject_masters.subject_name,cepsr.subject_id');
		$this->db2->join('products','cepsr.product_id=products.product_id');
		$this->db2->join('subject_masters','cepsr.subject_id=subject_masters.id');
		$this->db2->from('course_exam_paper_subject_relations as cepsr');
		$this->db2->where('cepsr.exam_id', $exam_id);
		$this->db2->where('cepsr.paper_id', $paper_id);
		$this->db2->order_by('subject_masters.id', 'asc');

		$query = $this->db2->get();
		// print_r($query->result());die;
		return $query->result();
	}
}
