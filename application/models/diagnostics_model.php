<?php 
class Diagnostics_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function order_test(){
      	$this->db->select('visit_id, patient_id')->from('patient_visit')
		->where('hosp_file_no',$this->input->post('visit_id'))
		->where('visit_type',$this->input->post('patient_type'))
		->where('YEAR(admit_date)',$this->input->post('year'),false); 
		$query=$this->db->get();
		$row=$query->row();
		
                $visit_id=$row->visit_id;
                $patient_id = $row->patient_id;         //Getting patient ID to retrive patient DOB and gender.
                
		$doctor_id=$this->input->post('order_by');
		$test_area_id=$this->input->post('test_area');
		$order_date_time=date("Y-m-d H:i:s",strtotime($this->input->post('order_date')." ".$this->input->post('order_time')));
		$order_status=0;
                
                
                
                
		$this->db->trans_start();
			$data=array(
				'visit_id'=>$visit_id,
				'doctor_id'=>$doctor_id,
				'test_area_id'=>$test_area_id,
				'order_date_time'=>$order_date_time,
				'order_status'=>$order_status
			);
			$this->db->insert('test_order',$data);
			$order_id=$this->db->insert_id();
                        
			$sample_code=$this->input->post('sample_id');
			$sample_date_time = date("Y-m-d H:i:s");
			$specimen_type_id=$this->input->post('specimen_type');
			$specimen_source=$this->input->post('specimen_source');//--adding an extra field specimen source in order form
			$sample_container_type=$this->input->post('sample_container');
			$sample_status_id=1;
			$data=array(
				'sample_code'=>$sample_code,
				'sample_date_time'=>$sample_date_time,
				'order_id'=>$order_id,
				'specimen_type_id'=>$specimen_type_id,
				'specimen_source'=>$specimen_source,//including source field in the array containing the fields present in the order form
				'sample_container_type'=>$sample_container_type,
				'sample_status_id'=>$sample_status_id
			);
			$this->db->insert('test_sample',$data);
			$sample_id=$this->db->insert_id();
			$data=array();
                        
                        //Retrieveing gender and DOB from patient table.
                        $this->db->select('gender, dob, age_years, age_months, age_days, MIN(admit_date) admit_date')
                        ->from('patient')
                        ->where('patient.patient_id', $patient_id)
                        ->join('patient_visit', 'patient_visit.patient_id=patient.patient_id')
                        ->group_by('patient.patient_id');
                        $patient_row = $this->db->get()->row();
                        
                        $dob = strtotime($patient_row->dob);
                        $admit_date = strtotime($patient_row->admit_date);
                        $gender='';
                        if($patient_row->gender=='M')
                            $gender = 1;
                        else
                            $gender = 2;
                        $range_id = "";
                        
			if($this->input->post('test_master'))
				foreach($this->input->post('test_master') as $test_master){
                                        
                                        //Retrieving range from test ranges table if range is active.
                                        $this->db->select('test_range_id, age_type, gender, from_year, to_year, from_month, to_month, from_day, to_day')
                                                ->from('test_range')
                                                ->where('test_master_id', $test_master)
                                                ->where('range_active', 1);
                                        $query = $this->db->get();
                                        $ranges = $query->result();
                                        
                                        if($dob != strtotime(0)){
                                         
                                            $now = strtotime(date("D M d, Y G:i"));
                                            $diff = abs($now - $dob);
                                            $age_years = floor($diff / (365*60*60*24));
                                            $age_months = floor(($diff - $age_years * 365*60*60*24) / (30*60*60*24));
                                            $age_days = floor(($diff - $age_years * 365*60*60*24 - $age_months*30*60*60*24)/ (60*60*24));
                                            foreach($ranges as $range){
                                                if($gender == $range->gender || $range->gender == 3){
                                                    //All ages
                                                    if($range->age_type == 4){
                                                        $range_id = $range->test_range_id;
                                                        break;
                                                    }
                                                    //Age less than
                                                    else if ($range->age_type == 1){
                                                       if($age_years < $range->to_year){
                                                            $range_id = $range->test_range_id;
                                                            break;
                                                       }
                                                       else if($age_years == $range->to_year){
                                                           if($age_months < $range->to_month){
                                                                $range_id = $range->test_range_id;
                                                                break;
                                                           }
                                                           else if($age_months == $range->to_month)
                                                               if($age_days <= $range->to_day){
                                                                   $range_id = $range->test_range_id;
                                                                   break;
                                                               }
                                                       }
                                                    }//Age greater than.
                                                    else if($range->age_type == 2){
                                                        if($age_years > $range->from_year){
                                                           $range_id = $range->test_range_id;
                                                           break;
                                                        }
                                                       else if($age_years == $range->from_year){
                                                           if($age_months > $range->from_month){
                                                               $range_id = $range->test_range_id;
                                                               break;
                                                           }
                                                           else if($age_months == $range->from_month)
                                                               if($age_days >= $range->from_day){
                                                                    $range_id = $range->test_range_id;                                                               
                                                                    break;
                                                               }
                                                       }
                                                    }//Age in a given range.
                                                    else if($range->age_type == 3){
                                                        if($age_years >= $range->from_year && $age_years <= $range->to_year){
                                                            if($age_years == $range->from_year){
                                                                if($age_months > $range->from_month){
                                                                    $range_id = $range->test_range_id;
                                                                    break;
                                                                }else if($age_months == $range->age_months){
                                                                    if($age_days >= $range->from_days){
                                                                        $range_id = $range->test_range_id;
                                                                        break;
                                                                    }
                                                                }
                                                            }else if($age_years == $range->to_year){
                                                                if($age_years <= $range->to_year){
                                                                    if($age_months < $range->to_month){
                                                                        $range_id = $range->test_range_id;
                                                                        break; 
                                                                    }else if($age_months == $range->to_month){
                                                                        if($age_days <= $range->to_day){
                                                                            $range_id = $range->test_range_id;
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }else{ 
                                                                $range_id = $range->test_range_id;
                                                                break;
                                                            }
                                                        }
                                                    }                                                    
                                                }                                            
                                            } //Looping through ranges ends here.
                                        }//If date of birth is not set. Calculate the age from years, months, and days field along with first visit date.
                                        else{
                                         
                                            $now = strtotime(date("D M d, Y G:i"));
                                            $diff = abs($now - $admit_date);
                                            $age_years = $patient_row->age_years + floor($diff / (365*60*60*24));
                                            $age_months = $patient_row->age_months + floor(($diff - $age_years * 365*60*60*24) / (30*60*60*24));
                                            $age_days = $patient_row->age_days + floor(($diff - $age_years * 365*60*60*24 - $age_months*30*60*60*24)/ (60*60*24));
                                           
                                            foreach($ranges as $range){
                                                if($gender == $range->gender || $range->gender == 3){
                                                    //All ages
                                                    if($range->age_type==4){
                                                        $range_id = $range->test_range_id;
                                                        break;
                                                    }//Age less than
                                                    else if ($range->age_type == 1){
                                                       if($age_years < $range->to_year){
                                                            $range_id = $range->test_range_id;
                                                            break;
                                                       }
                                                       else if($age_years == $range->to_year){
                                                           if($age_months < $range->to_month){
                                                                $range_id = $range->test_range_id;
                                                                break;
                                                           }
                                                           else if($age_months == $range->to_month)
                                                               if($age_days <= $range->to_day){
                                                                   $range_id = $range->test_range_id;
                                                                   break;
                                                               }
                                                       }
                                                    }//Age greater than.
                                                    else if($range->age_type == 2){
                                                        if($age_years > $range->from_year){
                                                           $range_id = $range->test_range_id;
                                                           break;
                                                        }
                                                       else if($age_years == $range->from_year){
                                                           if($age_months > $range->from_month){
                                                               $range_id = $range->test_range_id;
                                                               break;
                                                           }
                                                           else if($age_months == $range->from_month)
                                                               if($age_days >= $range->from_day){
                                                                    $range_id = $range->test_range_id;                                                               
                                                                    break;
                                                               }
                                                       }
                                                    }//Age in a given range.
                                                    else if($range->age_type == 3){
                                                        if($age_years >= $range->from_year && $age_years <= $range->to_year){
                                                            if($age_years == $range->from_year){
                                                                if($age_months > $range->from_month){
                                                                    $range_id = $range->test_range_id;
                                                                    break;
                                                                }else if($age_months == $range->age_months){
                                                                    if($age_days >= $range->from_days){
                                                                        $range_id = $range->test_range_id;
                                                                        break;
                                                                    }
                                                                }
                                                            }else if($age_years == $range->to_year){
                                                                if($age_years <= $range->to_year){
                                                                    if($age_months < $range->to_month){
                                                                        $range_id = $range->test_range_id;
                                                                        break; 
                                                                    }else if($age_months == $range->to_month){
                                                                        if($age_days <= $range->to_day){
                                                                            $range_id = $range->test_range_id;
                                                                            break;
                                                                        }
                                                                    }
                                                                }
                                                            }else{ 
                                                                $range_id = $range->test_range_id;
                                                                break;
                                                            }
                                                        }
                                                    }                                                    
                                                }                                            
                                            } //Looping through ranges ends here.
                                        } //Setting the range_id ends here.                      
                                                
					$data[]=array(
						'order_id'=>$order_id,
						'sample_id'=>$sample_id,
						'test_master_id'=>$test_master,
						'group_id'=>0,
                                                'test_range_id'=>$range_id
					);
				}
			if($this->input->post('test_group')){
				foreach($this->input->post('test_group') as $test_group){
                                    	$this->db->select('test_master.test_master_id,has_result')->from('test_master')
                                        ->join('test_group_link','test_master.test_master_id=test_group_link.test_master_id')
					->join('test_group','test_group_link.group_id=test_group.group_id')
					->where('test_group.group_id',$test_group);
					$query=$this->db->get();
					$result=$query->result();
                                        
                                
					foreach($result as $row){
                                            //Retrieving range from test ranges table.
                                            $this->db->select('test_range_id, age_type, gender, from_year, to_year, from_month, to_month, from_day, to_day')
                                                    ->from('test_range')
                                                    ->where('test_master_id', $row->test_master_id);
                                            $query = $this->db->get();
                                            $ranges = $query->result();

                                            if($dob != strtotime(0)){
                                                $now = strtotime(date("D M d, Y G:i"));
                                                $diff = abs($now - $dob);
                                                $age_years = floor($diff / (365*60*60*24));
                                                $age_months = floor(($diff - $age_years1 * 365*60*60*24) / (30*60*60*24));
                                                $age_days = floor(($diff - $age_years1 * 365*60*60*24 - $age_months1*30*60*60*24)/ (60*60*24));
                                                foreach($ranges as $range){
                                                    if($gender == $range->gender || $range->gender == 3){
                                                        //All ages
                                                        if($range->age_type==4){
                                                            $range_id = $range->test_range_id;
                                                            break;
                                                        }
                                                        //Age less than
                                                        else if ($range->age_type == 1){
                                                           if($age_years < $range->to_year){
                                                                $range_id = $range->test_range_id;
                                                                break;
                                                           }
                                                           else if($age_years == $range->to_year){
                                                               if($age_months < $range->to_month){
                                                                    $range_id = $range->test_range_id;
                                                                    break;
                                                               }
                                                               else if($age_months == $range->to_month)
                                                                   if($age_days <= $range->to_day){
                                                                       $range_id = $range->test_range_id;
                                                                       break;
                                                                   }
                                                           }
                                                        }//Age greater than.
                                                        else if($range->age_type == 2){
                                                            if($age_years > $range->from_year){
                                                               $range_id = $range->test_range_id;
                                                               break;
                                                            }
                                                           else if($age_years == $range->from_year){
                                                               if($age_months > $range->from_month){
                                                                   $range_id = $range->test_range_id;
                                                                   break;
                                                               }
                                                               else if($age_months == $range->from_month)
                                                                   if($age_days >= $range->from_day){
                                                                        $range_id = $range->test_range_id;                                                               
                                                                        break;
                                                                   }
                                                           }
                                                        }//Age in a given range.
                                                        else if($range->age_type == 3){
                                                            if($age_years >= $range->from_year && $age_years <= $range->to_year){
                                                                if($age_years == $range->from_year){
                                                                    if($age_months > $range->from_month){
                                                                        $range_id = $range->test_range_id;
                                                                        break;
                                                                    }else if($age_months == $range->age_months){
                                                                        if($age_days >= $range->from_days){
                                                                            $range_id = $range->test_range_id;
                                                                            break;
                                                                        }
                                                                    }
                                                                }else if($age_years == $range->to_year){
                                                                    if($age_years <= $range->to_year){
                                                                        if($age_months < $range->to_month){
                                                                            $range_id = $range->test_range_id;
                                                                            break; 
                                                                        }else if($age_months == $range->to_month){
                                                                            if($age_days <= $range->to_day){
                                                                                $range_id = $range->test_range_id;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }else{ 
                                                                    $range_id = $range->test_range_id;
                                                                    break;
                                                                }
                                                            }
                                                        }                                                    
                                                    }                                            
                                                } //Looping through ranges ends here.
                                            }//If date of birth is not set. Calculate the age from years, months, and days field along with first visit date.
                                            else{
                                                
                                                $now = strtotime(date("D M d, Y G:i"));
                                                $diff = abs($now - $admit_date);                                                
                                                $age_years = $patient_row->age_years + floor($diff / (365*60*60*24));
                                                $age_months = $patient_row->age_months + floor(($diff - $age_years * 365*60*60*24) / (30*60*60*24));
                                                $age_days = $patient_row->age_days + floor(($diff - $age_years * 365*60*60*24 - $age_months*30*60*60*24)/ (60*60*24));

                                                foreach($ranges as $range){
                                                    if($gender == $range->gender || $range->gender == 3){
                                                        //All ages
                                                        if($range->age_type == 4){
                                                            $range_id = $range->test_range_id;
                                                            break;
                                                        }
                                                        //Age less than
                                                        else if ($range->age_type == 1){
                                                           if($age_years < $range->to_year){
                                                                $range_id = $range->test_range_id;
                                                                break;
                                                           }
                                                           else if($age_years == $range->to_year){
                                                               if($age_months < $range->to_month){
                                                                    $range_id = $range->test_range_id;
                                                                    break;
                                                               }
                                                               else if($age_months == $range->to_month)
                                                                   if($age_days <= $range->to_day){
                                                                       $range_id = $range->test_range_id;
                                                                       break;
                                                                   }
                                                           }
                                                        }//Age greater than.
                                                        else if($range->age_type == 2){
                                                            if($age_years > $range->from_year){
                                                               $range_id = $range->test_range_id;
                                                               break;
                                                            }
                                                           else if($age_years == $range->from_year){
                                                               if($age_months > $range->from_month){
                                                                   $range_id = $range->test_range_id;
                                                                   break;
                                                               }
                                                               else if($age_months == $range->from_month)
                                                                   if($age_days >= $range->from_day){
                                                                        $range_id = $range->test_range_id;                                                               
                                                                        break;
                                                                   }
                                                           }
                                                        }//Age in a given range.
                                                        else if($range->age_type == 3){
                                                            if($age_years >= $range->from_year && $age_years <= $range->to_year){
                                                                if($age_years == $range->from_year){
                                                                    if($age_months > $range->from_month){
                                                                        $range_id = $range->test_range_id;
                                                                        break;
                                                                    }else if($age_months == $range->age_months){
                                                                        if($age_days >= $range->from_days){
                                                                            $range_id = $range->test_range_id;
                                                                            break;
                                                                        }
                                                                    }
                                                                }else if($age_years == $range->to_year){
                                                                    if($age_years <= $range->to_year){
                                                                        if($age_months < $range->to_month){
                                                                            $range_id = $range->test_range_id;
                                                                            break; 
                                                                        }else if($age_months == $range->to_month){
                                                                            if($age_days <= $range->to_day){
                                                                                $range_id = $range->test_range_id;
                                                                                break;
                                                                            }
                                                                        }
                                                                    }
                                                                }else{ 
                                                                    $range_id = $range->test_range_id;
                                                                    break;
                                                                }
                                                            }
                                                        }                                                    
                                                    }                                            
                                                } //Looping through ranges ends here.
                                            } //Setting the range_id ends here.

						$data[]=array(
							'order_id'=>$order_id,
							'sample_id'=>$sample_id,
							'group_id'=>$test_group,
							'test_master_id'=>$row->test_master_id,
                            'test_range_id'=>$range_id                                                        
						);
					}					
						$data[]=array(
							'order_id'=>$order_id,
							'sample_id'=>$sample_id,
							'group_id'=>$test_group,
							'test_master_id'=>0,
                            'test_range_id'=>$range_id
						);
				}
			}
			$this->db->insert_batch('test',$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
				$this->db->trans_rollback();
				return false;
		}
		else return true;				
	}
	
	function get_tests_ordered($test_areas){
		$this->input->post('test_area')?$test_area=$this->input->post('test_area'):$test_area="";
		if(count($test_areas)==1){
			$test_area = $test_areas[0]->test_area_id;
		}
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date = date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date = date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=date("Y-m-d",strtotime($this->input->post('from_date'))):$from_date=date("Y-m-d",strtotime($this->input->post('to_date')));
			$to_date=$from_date;
		}
		else{
			$from_date = date("Y-m-d");
			$to_date=date("Y-m-d");
		}
		if($this->input->post('test_method_search') != ""){
			$this->db->where('tms.test_method_id',$this->input->post('test_method_search'));
		}
		if($this->input->post('hosp_file_no_search') && $this->input->post('patient_type_search')){
			$this->db->where('hosp_file_no',$this->input->post('hosp_file_no_search'));
			$this->db->where('visit_type',$this->input->post('patient_type_search'));
		}
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,
		test_name,department,visit_type,patient.first_name, patient.last_name,
		staff.first_name staff_name,hosp_file_no,sample_code,specimen_type,
		specimen_source,sample_container_type,test_status',false)
		->from('test_order')
		->join('test','test_order.order_id=test.order_id')
		->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_group','test.group_id=test_group.group_id','left')
		->join('test_master as ts','test.test_master_id=ts.test_master_id','left')
		->join('test_method tms','ts.test_method_id=tms.test_method_id','left')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id')
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id')
		->where("(DATE(order_date_time) BETWEEN '$from_date' AND '$to_date')") 
		->where('order_status <',2)
		->where('test_order.test_area_id',$test_area);
		$query=$this->db->get();
		return $query->result();
	}
	
	function get_tests_completed($test_areas){

		$this->input->post('test_area')?$test_area=$this->input->post('test_area'):$test_area="";
		if(count($test_areas)==1){
			$test_area = $test_areas[0]->test_area_id;// test_area will be updated if condition is satisfied i.e. if the value is one
		}
		//if both the fields that is "from_date" & "to_date" are entered than if condition would be executed  
		if($this->input->post('from_date') && $this->input->post('to_date')){ 
			$from_date = date("Y-m-d",strtotime($this->input->post('from_date')));  
			$to_date = date("Y-m-d",strtotime($this->input->post('to_date')));//
			}
		//if anyone of the fields either "from_date" or "to_date" are entered in this condition
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=date("Y-m-d",strtotime( $this->input->post('from_date'))):$from_date=date("Y-m-d",strtotime($this->input->post('to_date')));
			$to_date=$from_date;
		}
		//if both the fields (from_date and to_date) are not entered then default values would be assigned in this condition
		else{
			$from_date = date("Y-m-d"); 
			$to_date=date("Y-m-d");
		}
		//test_method_search searches out the test_method_id 
		if($this->input->post('test_method_search') != ""){
			$this->db->where('test_method.test_method_id',$this->input->post('test_method_search'));
		}
		//patient_type_search would search weather the patient is inpatient or outpatient
		if($this->input->post('hosp_file_no_search') && $this->input->post('patient_type_search')){
			$this->db->where('hosp_file_no',$this->input->post('hosp_file_no_search'));
			$this->db->where('visit_type',$this->input->post('patient_type_search'));
		}
		//the above searches will get the details of the patient
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,test_name,department,visit_type,patient.first_name, patient.last_name,
							staff.first_name staff_name,hosp_file_no,sample_code,specimen_type,specimen_source,sample_container_type,test_status')//adding the specimen source in the update tests
		->from('test_order')
		->join('test','test_order.order_id=test.order_id')
		->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id'	)
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id')
		
		->where("(DATE(order_date_time) BETWEEN '$from_date' AND '$to_date')") 
		->where('test_master.test_area_id',$test_area)
        ->where('test.test_status',1);//the orders will be approve if their value is 1. So we verify the condition to display the outcome
		$query=$this->db->get(); 
		return $query->result();
	}
	
	function get_tests($test_areas){

		$this->input->post('test_area')?$test_area=$this->input->post('test_area'):$test_area="";
		if(count($test_areas)==1){
			$test_area = $test_areas[0]->test_area_id;// test_area will be updated if condition is satisfied i.e. if the value is one
		}
		//if both the fields that is "from_date" & "to_date" are entered than if condition would be executed  
		if($this->input->post('from_date') && $this->input->post('to_date')){ 
			$from_date = date("Y-m-d",strtotime($this->input->post('from_date')));  
			$to_date = date("Y-m-d",strtotime($this->input->post('to_date')));//
			}
		//if anyone of the fields either "from_date" or "to_date" are entered in this condition
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=date("Y-m-d",strtotime( $this->input->post('from_date'))):$from_date=date("Y-m-d",strtotime($this->input->post('to_date')));
			$to_date=$from_date;
		}
		//if both the fields (from_date and to_date) are not entered then default values would be assigned in this condition
		else{
			$from_date = date("Y-m-d"); 
			$to_date=date("Y-m-d");
		}
		//test_method_search searches out the test_method_id 
		if($this->input->post('test_method_search') != ""){
			$this->db->where('test_method.test_method_id',$this->input->post('test_method_search'));
		}
		//patient_type_search would search weather the patient is inpatient or outpatient
		if($this->input->post('hosp_file_no_search') && $this->input->post('patient_type_search')){
			$this->db->where('hosp_file_no',$this->input->post('hosp_file_no_search'));
			$this->db->where('visit_type',$this->input->post('patient_type_search'));
		}
		//the above searches will get the details of the patient
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,test_name,department,visit_type,patient.first_name, patient.last_name,
							staff.first_name staff_name,hosp_file_no,sample_code,specimen_type,specimen_source,sample_container_type,test_status')//adding the specimen source in the update tests
		->from('test_order')
		->join('test','test_order.order_id=test.order_id')
		->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id'	)
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id')
		->where("(DATE(order_date_time) BETWEEN '$from_date' AND '$to_date')") 
		->where('test_master.test_area_id',$test_area)
        ->where_in('test.test_status',array(0,1));
		$query=$this->db->get(); 
		return $query->result();
	}
	
	function get_tests_approved($test_areas){
		$this->input->post('test_area')?$test_area=$this->input->post('test_area'):$test_area="";
		if(count($test_areas)==1){
			$test_area = $test_areas[0]->test_area_id;
		}
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date = date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date = date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=date("Y-m-d",strtotime($this->input->post('from_date'))):$from_date=date("Y-m-d",strtotime($this->input->post('to_date')));
			$to_date=$from_date;
		}
		else{
			$from_date = date("Y-m-d");
			$to_date=date("Y-m-d");
		}
		if($this->input->post('test_method_search') != ""){
			$this->db->where('test_method.test_method_id',$this->input->post('test_method_search'));
		}
		if($this->input->post('hosp_file_no_search') && $this->input->post('patient_type_search')){
			$this->db->where('hosp_file_no',$this->input->post('hosp_file_no_search'));
			$this->db->where('visit_type',$this->input->post('patient_type_search'));
		}
		$this->db->select('test_id,test_order.order_id,test_sample.sample_id,test_method,test_name,department,visit_type,patient.first_name, patient.last_name,
							staff.first_name staff_name,hosp_file_no,sample_code,specimen_type,specimen_source,sample_container_type,test_status')//adding the specimen source in the update tests
		->from('test_order')
		->join('test','test_order.order_id=test.order_id')
		->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('staff','test_order.doctor_id=staff.staff_id','left')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id')
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id')
		->where("(DATE(order_date_time) BETWEEN '$from_date' AND '$to_date')") 
		->where('test_status',2)
		->where('test_master.test_area_id',$test_area);
		$query=$this->db->get();
		return $query->result();
	}
	
	function get_order(){
		$order_id=$this->input->post('order_id');
		$this->db->select('test.test_id,test.test_master_id,test_group.group_id,test_order.order_id,test_order.order_date_time,test.reported_date_time,test_sample.sample_id,test_method,accredition_logo,
		IFNULL(test_name,group_name)test_name,department.department,unit_name,area_name,age_years,age_months,age_days,patient.gender,patient.first_name, patient.last_name,visit_type,
		order_date_time,hosp_file_no,sample_code,specimen_type,sample_container_type,
		department.department_email,
		a_staff.staff_id a_id,a_staff.email a_email,a_staff.first_name a_first_name,a_staff.phone a_phone,
		u_staff.staff_id u_id,u_staff.email u_email,u_staff.first_name u_first_name,u_staff.phone u_phone,
		d_staff.staff_id d_id,d_staff.email d_email,d_staff.first_name d_first_name,d_staff.phone d_phone,
		IFNULL(ts.binary_result,test_group.binary_result) binary_result,
		IFNULL(ts.numeric_result,test_group.numeric_result) numeric_result,
		IFNULL(ts.text_result,test_group.text_result) text_result,
		IFNULL(ts.binary_positive,test_group.binary_positive) binary_positive,
		IFNULL(ts.binary_negative,test_group.binary_negative) binary_negative,
		IFNULL(lus.lab_unit,lug.lab_unit) lab_unit,
		IF(tms.test_method = "Culture%",1,0) culture, 
		test_status,
		test_result_binary,
		test_result,
		test_result_text,hospital,hospital.logo,hospital.place,district,state,test_area,provisional_diagnosis,
		IF(micro_organism_test.micro_organism_test_id!="",GROUP_CONCAT(DISTINCT CONCAT(micro_organism_test.micro_organism_test_id,",",micro_organism,",",antibiotic),",",antibiotic_result,"^"),0) micro_organism_test,
		approved_by.first_name approved_first,approved_by.last_name approved_last,approved_by.designation approved_by_designation,
		done_by.first_name done_first,done_by.last_name done_last,done_by.designation done_by_designation,test_range.min,test_range.max,test_range.range_type',false)
		->from('test_order')->join('test','test_order.order_id=test.order_id')->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_group','test.group_id=test_group.group_id','left')
		->join('test_master as ts','test.test_master_id=ts.test_master_id','left')
		->join('test_range','test.test_range_id=test_range.test_range_id','left')
		->join('lab_unit lus','ts.numeric_result_unit=lus.lab_unit_id','left')
		->join('lab_unit lug','test_group.numeric_result_unit=lug.lab_unit_id','left')
		->join('test_method tms','ts.test_method_id=tms.test_method_id','left')
		->join('test_area tas','ts.test_area_id=tas.test_area_id','left')
		->join('micro_organism_test','test.test_id = micro_organism_test.test_id','left')
		->join('antibiotic_test','micro_organism_test.micro_organism_test_id = antibiotic_test.micro_organism_test_id','left')
		->join('antibiotic','antibiotic_test.antibiotic_id = antibiotic.antibiotic_id','left')
		->join('micro_organism','micro_organism_test.micro_organism_id = micro_organism.micro_organism_id','left')
		->join('user approved_user','test.test_approved_by = approved_user.user_id','left')
		->join('staff approved_by','approved_user.staff_id = approved_by.staff_id','left')
		->join('user done_user','test.test_done_by = done_user.user_id','left')
		->join('staff done_by','done_user.staff_id = done_by.staff_id','left')
		->join('patient_visit','test_order.visit_id = patient_visit.visit_id')
		->join('patient','patient_visit.patient_id = patient.patient_id')
		->join('department','patient_visit.department_id = department.department_id')
		->join('staff d_staff','department.lab_report_staff_id=d_staff.staff_id','left')
		->join('unit','patient_visit.unit=unit.unit_id','left')
		->join('staff u_staff','unit.lab_report_staff_id=u_staff.staff_id','left')
		->join('area','patient_visit.area=area.area_id','left')
		->join('staff a_staff','area.lab_report_staff_id=a_staff.staff_id','left')
		->join('department test_dept','tas.department_id=test_dept.department_id','left')
		->join('hospital','test_dept.hospital_id=hospital.hospital_id','left')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id','left')
		->group_by('test_id');
		$this->db->where('test_order.order_id',$order_id);
		$query=$this->db->get();
		return $query->result();
	}		
	
	function upload_test_results(){
		$tests=$this->input->post('test');
		$userdata=$this->session->userdata('logged_in');
		$data=array();
		$antibiotics_data=array();
		$this->db->trans_start();
		if(!!$tests){
		foreach($tests as $test){
			if($this->input->post('binary_result_'.$test)!=NULL || $this->input->post('numeric_result_'.$test)!=NULL || $this->input->post('text_result_'.$test)!=NULL){
				$binary_result=$this->input->post('binary_result_'.$test);
				$numeric_result=$this->input->post('numeric_result_'.$test);
				$text_result=$this->input->post('text_result_'.$test);
				$data[]=array(
					'test_id'=>$test,
					'test_result_binary'=>$binary_result,
					'test_result'=>$numeric_result,
					'test_result_text'=>$text_result,
					'test_date_time'=>date("Y-m-d H:i:s"),
					'test_status'=>1,
					'test_done_by'=>$userdata['user_id']
				);
				
				if($binary_result == 1 && !!$this->input->post('micro_organisms_'.$test)){
					$micro_organisms = $this->input->post('micro_organisms_'.$test);
					$m=0;
					foreach($micro_organisms as $mo){
						$this->db->insert('micro_organism_test',array('test_id'=>$test,'micro_organism_id'=>$mo));
						$micro_organism_test_id = $this->db->insert_id();
						if(count($this->input->post('antibiotics_'.$test."_".$mo))>0){
							$antibiotics=$this->input->post('antibiotics_'.$test.'_'.$mo);
							$i=0;
							$antibiotic_array=array();
							foreach($antibiotics as $ab){
								if(!in_array($this->input->post('antibiotics_'.$test.'_'.$mo.'_'.$i),$antibiotic_array)){
								$antibiotics_data[] = array(
									'antibiotic_id'=>$this->input->post('antibiotics_'.$test.'_'.$mo.'_'.$i),
									'micro_organism_test_id'=>$micro_organism_test_id,
									'antibiotic_result'=>$this->input->post('antibiotic_results_'.$test.'_'.$mo.'_'.$i),
								);
								$antibiotic_array[]=$this->input->post('antibiotics_'.$test.'_'.$mo.'_'.$i);
								}
							$i++;
							}
						}
						else{
							$this->db->trans_rollback();
							return false;
						}
						$m++;
					}
				}
			}
		}
		}
		if(!!$antibiotics_data)
		$this->db->insert_batch('antibiotic_test',$antibiotics_data);
		$this->db->update_batch('test',$data,'test_id');
		$this->db->select('test_status,test_master_id')->from('test')->join('test_order','test.order_id=test_order.order_id')->where('test_order.order_id',$this->input->post('order_id'));
		$query=$this->db->get();
		$result=$query->result();
		$order_status=2;
		foreach($result as $row){
			if($row->test_status == 0 && $row->test_master_id != 0) $order_status = 1;
		}
		if($order_status==2){
			$this->db->where('order_id',$this->input->post('order_id'));
			$this->db->update('test_order',array('order_status'=>$order_status));
		}
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					return false;
		}
		else return true;			
	}
	
	function approve_results(){
		$this->db->trans_start();
		$userdata = $this->session->userdata('logged_in');
		$order_approved = 1;
		foreach($this->input->post('test') as $test){
			if($this->input->post('approve_test_'.$test)==1){
				$status =2;
			}
			else if($this->input->post('approve_test_'.$test)==0){
				$status =3;
			}
			else if($this->input->post('approve_test_'.$test)==2){
				$status=1;
				$order_approved=0;
			}
			$this->db->where('test_id',$test);
			$this->db->update('test',array('test_status'=>$status,'test_approved_by'=>$userdata['user_id'],'reported_date_time'=>date("Y-m-d H:i:s")));
		}
		if($order_approved==1){
			$this->db->where('order_id',$this->input->post('order_id'));
			$this->db->update('test_order',array('order_status'=>2));
		}
		$this->db->select('department,department_email,
		a_staff.staff_id a_id,a_staff.email a_email,a_staff.first_name a_first_name,a_staff.phone a_phone,
		u_staff.staff_id u_id,u_staff.email u_email,u_staff.first_name u_first_name,u_staff.phone u_phone,
		d_staff.staff_id d_id,d_staff.email d_email,d_staff.first_name d_first_name,d_staff.phone d_phone',false)
		->from('test_order')->join('patient_visit','test_order.visit_id = patient_visit.visit_id')
		->join('area','patient_visit.area = area.area_id','left')
		->join('staff a_staff','area.lab_report_staff_id = a_staff.staff_id','left')
		->join('unit','patient_visit.unit = unit.unit_id','left')
		->join('staff u_staff','unit.lab_report_staff_id = u_staff.staff_id','left')
		->join('department','patient_visit.department_id = department.department_id','left')
		->join('staff d_staff','department.lab_report_staff_id = d_staff.staff_id','left')
		->where('order_id',$this->input->post('order_id'));
		$query=$this->db->get();
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			return $query->row();
		}	
	}
	
	function cancel_order(){
		$this->db->trans_start();
		$userdata = $this->session->userdata('logged_in');
		$this->db->where('order_id',$this->input->post('order_id'));
		$this->db->update('test_order',array('order_status'=>3));
		$this->db->where('order_id',$this->input->post('order_id'));
		$this->db->update('test',array('test_status'=>4));
		$this->db->trans_complete();
		if($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			return true;
		}	
	}
	
	function search_patients(){
		$this->db->select('first_name,last_name,hosp_file_no,patient.patient_id,age_years,age_months,age_days')
		->from('patient')
		->join('patient_visit','patient.patient_id = patient_visit.patient_id')
		->like('hosp_file_no',$this->input->post('query'),'after')
		->where('YEAR(admit_date)',$this->input->post('year'))
		->where('visit_type',$this->input->post('visit_type'));
		$query=$this->db->get();
		if($query->num_rows()>0){
		return $query->result_array();
		}
		else return false;
	}
	
	
	function get_all_tests($visit_id){
		if($this->input->post('from_date') && $this->input->post('to_date')){
			$from_date=date("Y-m-d",strtotime($this->input->post('from_date')));
			$to_date=date("Y-m-d",strtotime($this->input->post('to_date')));
		}
		else if($this->input->post('from_date') || $this->input->post('to_date')){
			$this->input->post('from_date')?$from_date=$this->input->post('from_date'):$from_date=$this->input->post('to_date');
			$to_date=$from_date;
		}
		if($this->input->post('visit_type')){
			$this->db->where('patient_visit.visit_type',$this->input->post('visit_type'));
		}
		if(!!$visit_id){
			$this->db->where('patient_visit.visit_id',$visit_id);
		}
		$this->db->select('test_id,test_order.order_id,order_date_time,age_years,age_months,age_days,test_sample.sample_id,test_method,test_name,
							department,patient.first_name, patient.last_name,hosp_file_no,visit_type,sample_code,
							specimen_type,sample_container_type,test_status,test_result,test_result_text,numeric_result,lab_unit,
							(CASE WHEN binary_result = 1 AND test_result_binary = 1 THEN binary_positive ELSE binary_negative END) test_result_binary, binary_result,
							text_result')
		->from('test_order')
		->join('test','test_order.order_id=test.order_id')
		->join('test_sample','test_order.order_id=test_sample.order_id')
		->join('test_master','test.test_master_id=test_master.test_master_id')
		->join('lab_unit','test_master.numeric_result_unit=lab_unit.lab_unit_id','left')
		->join('test_method','test_master.test_method_id=test_method.test_method_id')
		->join('test_area','test_master.test_area_id=test_area.test_area_id')
		->join('patient_visit','test_order.visit_id=patient_visit.visit_id')
		->join('patient','patient_visit.patient_id=patient.patient_id')
		->join('department','patient_visit.department_id=department.department_id')
		->join('specimen_type','test_sample.specimen_type_id=specimen_type.specimen_type_id')
		->group_by('test.test_id')
		->order_by('order_date_time','desc');	  
		$query=$this->db->get();
		return $query->result();
	}
        
    function tests_info($type){
        if($type=='master_tests'){
            $this->db->select("test_master.test_master_id,test_method,test_name, binary_result, numeric_result, text_result,test_area,comments,COUNT(test_range_id) ranges_count, lab_unit")
                    ->from("test_master")
                    ->join('test_area','test_master.test_area_id=test_area.test_area_id')
                    ->join('test_method','test_master.test_method_id=test_method.test_method_id','left')
                    ->join('test_range','test_master.test_master_id = test_range.test_master_id','left')
                    ->join('lab_unit','test_master.numeric_result_unit=lab_unit.lab_unit_id')
                    ->group_by('test_master.test_master_id');
            $query = $this->db->get();
            return $query->result();
        }
    }
    
    function test_range_info($type){
        if($type=='master_tests'){
            $this->db->select("test_master_id,gender, min, max, from_year, to_year, from_month, to_month, from_day, to_day, age_type, range_type")
                     ->from("test_range");
            $query = $this->db->get();
            return $query->result();
        }
    }
}
?>
