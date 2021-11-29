<?php
class search_model extends CI_Model {

    
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	function search_one_multiple_place($data,$col,$table,$join_condition,$limit,$start)
	{	//echo "<pre>";echo $data;
		$list = array();
		
		for($tbl=0; $tbl<count($table); $tbl++)
		{
			 if($table[$tbl]!='')
			 {
				 	 for($cl=0; $cl<count($col[$tbl]); $cl++)
					{
						$where_clause='';
				 		$this -> db -> select('*') -> from($table[0]);
						if(count($join_condition)>0)
						{
							if(count($table)>1)
							{
								for($tbl_join=0; $tbl_join<count($table); $tbl_join++)
								{
									 if($table[$tbl_join]!='')
									 {
										 if($tbl_join>0 && count($join_condition)>0)
										 {						 
											$this -> db ->join($table[$tbl_join],$join_condition[$tbl_join-1]);						
										 }
									 } 
								}
							}
						}
						
						if(($col[$tbl][$cl]!='') && ($data!=''))
						{
							 $column[$cl]= "`".$table[$tbl]."`.`".$col[$tbl][$cl]."`";
							
							 	if($where_clause=='')
								 {
									$where_clause=$column[$cl]." LIKE '%".$data."%' OR ".$column[$cl]." LIKE '%".strtoupper($data)."%' OR ".$column[$cl]." LIKE '%".strtolower($data)."%' OR ".$column[$cl]." LIKE '%".ucfirst($data)."%' " ;
								 }
							$this -> db ->where($where_clause);
							if($limit!=''){
								$this->db->limit($limit, $start);
							}
							$query = $this -> db -> get();
							if($query -> num_rows > 0)
							{ 
								$list[]=$query->result();									 
							}
						}
			 		}
			}
		}		
		//echo "<pre>"; print_r($list);	
		return  $list;	
		
	}
	
	function join_search_multiple_value($data,$col,$table,$join_condition,$limit,$start,$orderBy_column,$orderBy_attr)
	{	
		$list = array();		
		$where_clause='';
		$this -> db -> select('*') -> from($table[0]);
			if(count($join_condition)>0)
			{
				if(count($table)>1)
				{
					for($tbl_join=0; $tbl_join<count($table); $tbl_join++)
					{
						 if($table[$tbl_join]!='')
						 {
							 if($tbl_join>0 && count($join_condition)>0)
							 {						 
								$this -> db ->join($table[$tbl_join],$join_condition[$tbl_join-1]);						
							 }
						 } 
					}
				}
			}
					for($tbl=0; $tbl < count($table); $tbl++)
					{
						 if($table[$tbl]!='')
						 {	
								if(isset($col[$tbl]))
								{			
								 	for($cl=0; $cl<count($col[$tbl]); $cl++)
									{
										if(($col[$tbl][$cl]!='') && ($data[$tbl][$cl]!=''))
										{
											 $column[$cl]= $table[$tbl].".".$col[$tbl][$cl];
											 $columnvalue[$cl]=$data[$tbl][$cl];
												
											 if($where_clause=='')
											 {
												$where_clause=$column[$cl]." = '".$columnvalue[$cl]."'" ;
											 }
											 else{
												 $where_clause=$where_clause ." And ".$column[$cl]." = '".$columnvalue[$cl]."'" ;
											 }
										}
									}
							 }
								
						 }
					}
		
				if($where_clause!='')
				 {
					$this -> db ->where($where_clause);
				 }
				if($limit!=''){
					$this->db->limit($limit, $start);
				}
				if($orderBy_column!=''){
				$this->db->order_by($orderBy_column,$orderBy_attr);
			}
				$query = $this -> db -> get();
				//echo $this->db->last_query(); exit;					
				if($query -> num_rows > 0)
				{
					$list[]=$query->result();
				}
			
		
		//echo $this->db->last_query();
		//echo "<pre>"; print_r($list);			
		return  $list;			
	}
	
	function join_search_whereclause($where_clause,$table,$join_condition,$limit,$start,$orderBy_column,$orderBy_attr)
	{	
		$list = array();		
		$this -> db -> select('*') -> from($table[0]);
			if(count($join_condition)>0)
			{
				if(count($table)>1)
				{
					for($tbl_join=0; $tbl_join<count($table); $tbl_join++)
					{
						 if($table[$tbl_join]!='')
						 {
							 if($tbl_join>0 && count($join_condition)>0)
							 {						 
								$this -> db ->join($table[$tbl_join],$join_condition[$tbl_join-1]);						
							 }
						 } 
					}
				}
			}
					
		
				if($where_clause!='')
				 {
					$this -> db ->where($where_clause);
				 }
				if($limit!=''){
					$this->db->limit($limit, $start);
				}
				if($orderBy_column!=''){
					$this->db->order_by($orderBy_column,$orderBy_attr);
				}
				$query = $this -> db -> get();
				//echo $this->db->last_query(); exit;					
				if($query -> num_rows > 0)
				{
					$list[]=$query->result();
				}
		
		//echo $this->db->last_query();				
		return  $list;			
	}
			
function selectAllwhereGroupby($table,$where_clause,$orderBy_column,$orderBy_attr,$group_by_column){
		$this -> db -> select('*')-> from($table);
		if($where_clause!='')
				 {
					$this -> db ->where($where_clause);
				 }
		if($orderBy_column!=''){
			$this->db->order_by($orderBy_column,$orderBy_attr);
		}
		if($group_by_column!=''){
					$this->db->group_by($group_by_column);
				}
		$query = $this -> db -> get();
		$list=array();
		if($query -> num_rows > 0)
		{
			return $list=$query->result();
		}		
		return $list;
	}		
}
?>