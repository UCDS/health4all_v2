<?php 
class Sanitation_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function upload_evaluation(){
		$userdata=$this->session->userdata('logged_in');
		$user_id=$userdata['user_id'];
		$date=date("Y-m-d",strtotime($this->input->post('evaluation_date')));
		$daily_activities=array();
		$weekly_activities=array();
		$monthly_activities=array();
		$fortnightly_activities=array();
		$data=array();
		$update_data=array();
		$activities_done=array();
		$done_id=array();
		if($this->input->post('activity_id')){
			$daily_activities = $this->input->post('activity_id');
			$this->db->select('activity_done_id,activity_id')->from('activity_done')->where_in('activity_id',$daily_activities)->where('date',$date);
			$query=$this->db->get();
			$result=$query->result();
			foreach($result as $row){
				$activities_done[]=$row->activity_id;
				$done_id[]=$row->activity_done_id;
			}
		}
		if($this->input->post('weekly_activity_id')){
			$day = date('w',strtotime($this->input->post('date')));
			$week_start = date('Y-m-d', strtotime('-'.$day.' days'));
			$week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
			$weekly_activities = $this->input->post('weekly_activity_id');
			$this->db->select('activity_done_id,activity_id')->from('activity_done')->where_in('activity_id',$weekly_activities)->where("(date BETWEEN '$week_start' AND '$week_end')");
			$query=$this->db->get();
			$result=$query->result();
			foreach($result as $row){
				$activities_done[]=$row->activity_id;
				$done_id[]=$row->activity_done_id;
			}
		}
		if($this->input->post('fortnightly_activity_id')){
			$fortnight_start_date=date("Y-m-1",strtotime($date));
			if($date-$fortnight_start_date>15)
			$fortnight_end_date=date("Y-m-15",strtotime($date));
			else { 
				$fortnight_start_date=date("Y-m-15",strtotime($date));
				$fortnight_end_date=date("Y-m-t",strtotime($date));
			}
			$fortnightly_activities = $this->input->post('fortnightly_activity_id');
			$this->db->select('activity_done_id,activity_id')->from('activity_done')->where_in('activity_id',$fortnightly_activities)->where("(date BETWEEN '$fortnight_start_date' AND '$fortnight_end_date')");
			$query=$this->db->get();
			echo $this->db->last_query();
			$result=$query->result();
			foreach($result as $row){
				$activities_done[]=$row->activity_id;
				$done_id[]=$row->activity_done_id;
			}
		}
		if($this->input->post('monthly_activity_id')){
			$monthly_activities = $this->input->post('monthly_activity_id');
			$this->db->select('activity_done_id,activity_id')->from('activity_done')->where_in('activity_id',$monthly_activities)->where("MONTH(date) = MONTH('$date')")->where("YEAR(date) = YEAR('$date')");
			$query=$this->db->get();
			echo $this->db->last_query();
			$result=$query->result();
			foreach($result as $row){
				$activities_done[]=$row->activity_id;
				$done_id[]=$row->activity_done_id;
			}
		}
		if(count($daily_activities)>0){
		foreach($daily_activities as $activity){
		if($this->input->post('activity_'.$activity)){
			if(in_array($activity,$activities_done)){
				$key=array_search($activity,$activities_done);
				$update_data[]=array(
					'activity_done_id'=>$done_id[$key],
					'activity_id'=>$activity,
					'date'=>$date,
					'time'=>date("H:i:s",strtotime($this->input->post('activity_'.$activity))),
					'user_id'=>$user_id
				);
				continue;
			}
			$data[]=array(
				'activity_id'=>$activity,
				'date'=>$date,
				'time'=>date("H:i:s",strtotime($this->input->post('activity_'.$activity))),
				'user_id'=>$user_id
			);
		}
		}
		}
		if(count($weekly_activities)>0){
		foreach($weekly_activities as $activity){
		if($this->input->post('other_activity_'.$activity)){
			if(in_array($activity,$activities_done)){
				$key=array_search($activity,$activities_done);
				$update_data[]=array(
					'activity_done_id'=>$done_id[$key],
					'activity_id'=>$activity,
					'date'=>date("Y-m-d",strtotime($this->input->post('activity_date_'.$activity))),
					'time'=>date("H:i:s",strtotime($this->input->post('other_activity_'.$activity))),
					'user_id'=>$user_id
				);
				continue;
			}
			$data[]=array(
				'activity_id'=>$activity,
				'date'=>date("Y-m-d",strtotime($this->input->post('activity_date_'.$activity))),
				'time'=>date("H:i:s",strtotime($this->input->post('other_activity_'.$activity))),
				'user_id'=>$user_id
			);
		}
		}
		}
		if(count($fortnightly_activities)>0){
		foreach($fortnightly_activities as $activity){
		if($this->input->post('other_activity_'.$activity)){
			if(in_array($activity,$activities_done)){
				$key=array_search($activity,$activities_done);
				$update_data[]=array(
					'activity_done_id'=>$done_id[$key],
					'activity_id'=>$activity,
					'date'=>date("Y-m-d",strtotime($this->input->post('activity_date_'.$activity))),
					'time'=>date("H:i:s",strtotime($this->input->post('other_activity_'.$activity))),
					'user_id'=>$user_id
				);
				continue;
			}
			$data[]=array(
				'activity_id'=>$activity,
				'date'=>date("Y-m-d",strtotime($this->input->post('activity_date_'.$activity))),
				'time'=>date("H:i:s",strtotime($this->input->post('other_activity_'.$activity))),
				'user_id'=>$user_id
			);
		}
		}
		}
		if(count($monthly_activities)>0){
		foreach($monthly_activities as $activity){
		if($this->input->post('other_activity_'.$activity)){
			if(in_array($activity,$activities_done)){
				$key=array_search($activity,$activities_done);
				$update_data[]=array(
					'activity_done_id'=>$done_id[$key],
					'activity_id'=>$activity,
					'date'=>date("Y-m-d",strtotime($this->input->post('activity_date_'.$activity))),
					'time'=>date("H:i:s",strtotime($this->input->post('other_activity_'.$activity))),
					'user_id'=>$user_id
				);
				continue;
			}
			$data[]=array(
				'activity_id'=>$activity,
				'date'=>date("Y-m-d",strtotime($this->input->post('activity_date_'.$activity))),
				'time'=>date("H:i:s",strtotime($this->input->post('other_activity_'.$activity))),
				'user_id'=>$user_id
			);
		}
		}
		}
		if(count($data)==0 && count($update_data)==0) return false;
		$this->db->trans_start();
		if(count($data)>0){
			$this->db->insert_batch('activity_done',$data);
		}
		if(count($update_data)>0){
			$this->db->update_batch('activity_done',$update_data,'activity_done_id');
		}
		echo $this->db->last_query();
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			return FALSE;
		}
		else return true;
	}
	
	function get_scores(){
		$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
		$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
			$from_day = date('w',strtotime($this->input->post('from_date')));
			$to_day = date('w',strtotime($this->input->post('to_date')));
			$week_start_date = date('Y-m-d', strtotime($from_date.' - '.$from_day.' days'));
			$week_end_date = date('Y-m-d', strtotime($to_date.' + '.(6-$to_day).' days'));
			$fortnight_start_date=date("Y-m-1",strtotime($from_date));
			if($from_date-$fortnight_start_date>15)
			$fortnight_end_date=date("Y-m-15",strtotime($to_date));
			else { 
				$fortnight_start_date=date("Y-m-15",strtotime($from_date));
				$fortnight_end_date=date("Y-m-t",strtotime($to_date));
			}
				$month_start_date=date("Y-m-1",strtotime($from_date));
				$month_end_date=date("Y-m-t",strtotime($to_date));
		$query=$this->db->query("SELECT weightages.hospital_id,weightages.hospital,daily_score,weekly_score,fortnightly_score,monthly_score,daily_total,weekly_total,fortnightly_total,monthly_total FROM 
				(SELECT hospital_id,hospital, 
				SUM( CASE WHEN frequency_type = 'Daily' THEN weightage ELSE 0 END) daily_score,
				SUM( CASE WHEN frequency_type = 'Weekly' THEN weightage ELSE 0 END) weekly_score,
				SUM( CASE WHEN frequency_type = 'Fortnightly' THEN weightage ELSE 0 END) fortnightly_score,
				SUM( CASE WHEN frequency_type = 'Monthly' THEN weightage ELSE 0 END) monthly_score
				FROM activity_done
				JOIN facility_activity
				USING ( activity_id )
				JOIN area_activity
				USING ( area_activity_id )
				JOIN area ON facility_activity.facility_area_id = area.area_id
				JOIN department
				USING ( department_id )
				JOIN hospital
				USING ( hospital_id )
				WHERE (activity_done.date BETWEEN '$from_date' AND '$to_date') 
				GROUP BY hospital_id) scores
				LEFT JOIN 
				(SELECT hospital_id,hospital,
				SUM( CASE WHEN frequency_type = 'Daily' THEN weightage * DATEDIFF( '$to_date', '$from_date' ) ELSE 0 END ) daily_total ,
				SUM(CASE WHEN frequency_type = 'Weekly' THEN weightage * DATEDIFF( '$week_end_date', '$week_start_date' ) /7 ELSE 0 END ) weekly_total,
				SUM(CASE WHEN frequency_type = 'Fornightly' THEN weightage * DATEDIFF( '$fortnight_end_date', '$fortnight_start_date' ) /15 ELSE 0 END ) fortnightly_total,
				SUM(CASE WHEN frequency_type = 'Monthly' THEN weightage * DATEDIFF( '$month_end_date', '$month_start_date' ) /30 ELSE 0 END ) monthly_total
				FROM facility_activity
				JOIN area_activity ON facility_activity.area_activity_id = area_activity.area_activity_id
				JOIN area ON facility_activity.facility_area_id = area.area_id
				JOIN department
				USING ( department_id )
				JOIN hospital
				USING ( hospital_id )
				GROUP BY hospital_id) weightages ON scores.hospital_id = weightages.hospital_id");
			return $query->result();
		}

			
}
?>
