<?php 
class Helpline_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function insert_call(){
		$callsid=$this->input->get('CallSid');
		$from_number = $this->input->get('From');
		$to_number = $this->input->get('To');
		$direction = $this->input->get('Direction');
		$dial_call_duration = $this->input->get('DialCallDuration');
		$start_time = $this->input->get('StartTime');
		$current_server_time = $this->input->get('CurrentTime');
		$end_time = $this->input->get('EndTime');
		$call_type = $this->input->get('CallType');
		$recording_url = $this->input->get('RecordingUrl');
		$dial_whom_number = $this->input->get('DialWhomNumber');
		$data = array(
			'callsid'=>$callsid,
			'from_number' => $from_number,
			'to_number' => $to_number,
			'direction' => $direction,
			'dial_call_duration' => $dial_call_duration,
			'start_time' => $start_time,
			'current_server_time' => $current_server_time,
			'end_time' => $end_time,
			'call_type' => $call_type,
			'recording_url' => $recording_url,
			'dial_whom_number' => $dial_whom_number,
			'create_date_time' => date("Y-m-d H:i:s")
		);
		
		if($this->db->insert('helpline_call',$data)){
			return true;
		}
		else return false;	
	}	
	function insert_outbound_call(){
		$callsid=$this->input->post('CallSid');
		$from_number = $this->input->post('From');
		$to_number = $this->input->post('To');
		$direction = $this->input->post('Direction');
		$dial_call_duration = $this->input->post('Duration');
		$start_time = $this->input->post('StartTime');
		$end_time = $this->input->post('EndTime');
		$call_type = "Out-going";
		$recording_url = $this->input->post('RecordingUrl');
		$dial_whom_number = $this->input->post('DialWhomNumber');
		$data = array(
			'callsid'=>$callsid,
			'from_number' => $from_number,
			'to_number' => $to_number,
			'direction' => $direction,
			'dial_call_duration' => $dial_call_duration,
			'start_time' => $start_time,
			'end_time' => $end_time,
			'call_type' => $call_type,
			'recording_url' => $recording_url,
			'dial_whom_number' => $from,
			'create_date_time' => date("Y-m-d H:i:s")
		);
		
		if($this->db->insert('helpline_call',$data)){
			return true;
		}
		else return false;	
	}	
	
	function update_call(){
		$calls = $this->input->post('call');
		$data=array();
		foreach($calls as $call){
			$data[]=array(
				'call_id'=>$call,
				'caller_type_id'=>$this->input->post("caller_type_".$call),
				'call_category_id'=>$this->input->post("call_category_".$call),
				'resolution_status_id'=>$this->input->post("resolution_status_".$call),
				'hospital_id'=>$this->input->post("hospital_".$call),
				'ip_op'=>$this->input->post("visit_type_".$call),
				'visit_id'=>$this->input->post("visit_id_".$call),
				'note'=>$this->input->post("note_".$call),
				'updated'=>1
			);
		}
		$this->db->trans_start();
			$this->db->update_batch('helpline_call',$data,'call_id');
		$this->db->trans_complete();
		if($this->db->trans_status()===TRUE){
			return true;
		}
		else {
			$this->db->trans_rollback();
			return false;
		}
		
	}
	function get_calls(){
		if($this->input->post('date')){
			$this->db->where('DATE(start_time)',date("Y-m-d",strtotime($this->input->post('date'))));
		}
		else 
			$this->db->where('DATE(start_time)',date("Y-m-d"));
		$this->db->select('helpline_call.*,caller_type,call_category,resolution_status,hospital')->from('helpline_call')
		->join('helpline_caller_type','helpline_call.caller_type_id = helpline_caller_type.caller_type_id','left')
		->join('helpline_call_category','helpline_call.call_category_id = helpline_call_category.call_category_id','left')
		->join('helpline_resolution_status','helpline_call.resolution_status_id = helpline_resolution_status.resolution_status_id','left')
		->join('hospital','helpline_call.hospital_id = hospital.hospital_id','left')
		->order_by('start_time','desc');
		$query = $this->db->get();
		return $query->result();
	}
	function get_caller_type(){
		$this->db->select('*')->from('helpline_caller_type');
		$query = $this->db->get();
		return $query->result();
	}
	function get_call_category(){
		$this->db->select('*')->from('helpline_call_category');
		$query = $this->db->get();
		return $query->result();
	}
	function get_resolution_status(){
		$this->db->select('*')->from('helpline_resolution_status');
		$query = $this->db->get();
		return $query->result();
	}
	function get_hospital_district(){
		$this->db->select('DISTINCT district',false)->from('hospital')->order_by('district');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_detailed_report(){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$this->db->where('(DATE(start_time) BETWEEN "'.date("Y-m-d",strtotime($this->input->post('from_date'))).'" AND "'.date("Y-m-d",strtotime($this->input->post('to_date'))).'")');
		}
		else 
			$this->db->where('DATE(start_time)',date("Y-m-d"));
		$this->db->select('*,helpline_call.note')->from('helpline_call')
		->join('helpline_caller_type','helpline_call.caller_type_id = helpline_caller_type.caller_type_id','left')
		->join('helpline_call_category','helpline_call.call_category_id = helpline_call_category.call_category_id','left')
		->join('helpline_resolution_status','helpline_call.resolution_status_id = helpline_resolution_status.resolution_status_id','left')
		->join('hospital','helpline_call.hospital_id = hospital.hospital_id','left')
		->order_by('start_time','desc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function dashboard($type=""){
		
		if($type == "caller_type"){
			$this->db->select('caller_type,count(call_id) as count');
			$this->db->group_by('helpline_caller_type.caller_type_id');
			$this->db->order_by('count','desc');
		}
		if($type == "call_category"){
			$this->db->select('call_category,count(call_id) as count');
			$this->db->group_by('helpline_call_category.call_category_id');
			$this->db->order_by('count','desc');
		}
		if($type == "hospital"){
			$this->db->select('hospital_short_name hospital,count(call_id) as count');
			$this->db->group_by('hospital.hospital_id');
			$this->db->order_by('count','desc');
		}
		if($type == "district"){
			$this->db->select('district,count(call_id) as count');
			$this->db->group_by('hospital.district');
			$this->db->order_by('count','desc');
		}
		if($type == "volunteer"){
			$this->db->select('short_name,count(call_id) as count');
			$this->db->group_by('dial_whom_number');
			$this->db->order_by('count','desc');
		}
		if($type == "call_type"){
			$this->db->select('CONCAT(direction," ",call_type) call_type,count(call_id) as count',false);
			$this->db->group_by('call_type,direction');
			$this->db->order_by('count','desc');
		}
		if($type == "to_number"){
			$this->db->select('to_number,count(call_id) as count');
			$this->db->group_by('to_number');
			$this->db->order_by('count','desc');
		}
		if($type == "op_ip"){
			$this->db->select('ip_op,count(call_id) as count');
			$this->db->group_by('ip_op');
			$this->db->order_by('count','desc');
		}
		if($type == "duration"){
			$this->db->select('dial_call_duration');
			$this->db->order_by('dial_call_duration');
			$this->db->where('call_type','completed');
		}
		
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$this->db->where('date(start_time) >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
			$this->db->where('date(start_time) <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		}
		else if($this->input->post('from_date')){
			$this->db->where('date(start_time) >=',date("Y-m-d",strtotime($this->input->post('from_date'))));
		}
		else if($this->input->post('to_date')){
			$this->db->where('date(start_time) <=',date("Y-m-d",strtotime($this->input->post('to_date'))));
		}
		else
			$this->db->where('date(start_time)',date("Y-m-d"));
		
		if($this->input->post('caller_type')){
			$this->db->where('helpline_caller_type.caller_type_id',$this->input->post('caller_type'));
		}
		if($this->input->post('call_category')){
			$this->db->where('helpline_call_category.call_category_id',$this->input->post('call_category'));
		}
		if($this->input->post('resolution_status')){
			$this->db->where('helpline_resolution_status.resolution_status_id',$this->input->post('resolution_status'));
		}
		if($this->input->post('hospital')){
			$this->db->where('hospital.hospital_id',$this->input->post('hospital'));
		}
		if($this->input->post('district')){
			$this->db->where('hospital.district',$this->input->post('district'));
		}
		if($this->input->post('visit_type')){
			$this->db->where('visit_type.ip_op',$this->input->post('visit_type'));
		}
		
		$this->db->from('helpline_call')
		->join('helpline_caller_type','helpline_call.caller_type_id = helpline_caller_type.caller_type_id','left')
		->join('helpline_call_category','helpline_call.call_category_id = helpline_call_category.call_category_id','left')
		->join('helpline_receiver','helpline_call.dial_whom_number = helpline_receiver.phone','left')
		->join('hospital','helpline_call.hospital_id = hospital.hospital_id','left');
		$query = $this->db->get();
		return $query->result();
	}
}
?>