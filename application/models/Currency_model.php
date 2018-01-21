<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Currency_model extends CI_Model {
	var $table = 'currencies';
	public function __construct(){
		parent::__construct();
		$this->load->database();
	}

	public function save($data) //Save data in currencies table
	{
		$this->db->insert($this->table, $data);
		if ($this->db->affected_rows() === 1) {
				return true;
			}
			else {
				return false;
			}
	 } 

	public function get_all()  //bring the whole data from currencies table
	{
		$this->db->from($this->table);
		$this->db->order_by('currencies.date', 'desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_by_month($month)  //bring the whole data from currencies table by month
	{
		
		if($month!='02'){ //get range of days wheter if it is a 30 days month, 31, or february

			if($month%2==0){
				$first_date ='2017-'.$month.'-01';
				$second_date ='2017-'.$month.'-30';
			}
			else{
				$first_date ='2017-'.$month.'-01';
				$second_date ='2017-'.$month.'-31';
			}

		}
		else{
			$first_date ='2017-'.$month.'-01';
			$second_date ='2017-'.$month.'-28';
		}
		
		$this->db->from($this->table);
		$this->db->where('date >=', $first_date);
		$this->db->where('date <=', $second_date);
		$this->db->order_by('currencies.date', 'desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

	public function get_by_curr($currency)  //bring the whole data from a certain currency
	{
		
		$this->db->select('date,'.$currency);
		$this->db->from($this->table);
		$this->db->order_by('currencies.date', 'desc');
		$query = $this->db->get();
		$result = $query->result_array();
		return $result;
	}

}	    