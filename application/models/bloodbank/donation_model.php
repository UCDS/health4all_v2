<?php

class Donation_Model extends CI_Model{
   
   function __construct() {
       parent::__construct();
   }
   
   function get_donation(){
       
       $blood_unit_num = "";
       if($this->input->post('blood_unit_num')){
           $blood_unit_num = $this->input->post('blood_unit_num');
       }else{
           return false;
       }
       
       $this->db->select('bb_donation.blood_unit_num, bb_donation.segment_num, bb_donation.bag_type, '
               . 'bb_donation.donation_date, bb_donation.donation_time, bb_donation.collected_by, bb_donation.camp_id, '
               . 'blood_donor.name, blood_donor.phone, blood_donor.email, blood_grouping.*, '
               . 'blood_screening.*,'
               . 'blood_inventory.volume')
            ->from('bb_donation')
            ->join('blood_donor','bb_donation.donor_id = blood_donor.donor_id')
            ->join('blood_inventory','bb_donation.donation_id = blood_inventory.donation_id')
            ->join('blood_grouping','bb_donation.donation_id = blood_grouping.donation_id')
            ->join('blood_screening','bb_donation.donation_id = blood_screening.donation_id')
            ->where('bb_donation.blood_unit_num', $blood_unit_num)
            ->where('MONTH(bb_donation.donation_date) - MONTH(NOW()) < 3');
       
       $query = $this->db->get();
      
       $result = $query->result();
       
       return $result[0];
   }
   
   function update_blood_bag_info(){
       
        $this->db->select('bb_donation.donation_id, bb_donation.blood_unit_num, bb_donation.segment_num, bb_donation.bag_type, bb_donation.camp_id, blood_inventory.volume')
               ->from('bb_donation')
               ->join('blood_inventory','bb_donation.donation_id = blood_inventory.donation_id')
               ->where('bb_donation.donation_id',$this->input->post('donation_id'));
       
        $query = $this->db->get();
        echo $this->db->last_query();
        $result = $query->result();
       
        $log = 'Update Blood Bag Info-'.$result[0]->donation_id.'-'
               .$result[0]->blood_unit_num.'-'
               .$result[0]->segment_num.'-'
               .$result[0]->bag_type.'-'
               .$result[0]->volume.'-'
               .$result[0]->camp_id;
        $staff_id = $this->session->userdata('staff_id');
       
        $data_trail = array(
           'trail' => $log,
           'staff_id' => $staff_id
        );
       
        $blood_bag_data = array(
            'blood_unit_num' => $this->input->post('blood_unit_num'),
            'segment_num' => $this->input->post('segment_num'),
            'bag_type' => $this->input->post('bag_type'),
            'camp_id' => $this->input->post('camp_id')
        );
       
        $blood_inventory = array(
           'volume' => $this->input->post('volume')
        );
       
        $this->db->trans_start();
        $this->db->insert('bloodbank_edit_log', $data_trail); 
        $this->db->where('donation_id', $this->input->post('donation_id'));
        $this->db->update('bb_donation', $blood_bag_data);
        $this->db->where('donation_id', $this->input->post('donation_id'));
        $this->db->update('blood_inventory', $blood_inventory);
        $this->db->trans_complete();
        
        return $this->db->trans_status();
   }
}

?>
