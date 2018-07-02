<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_Model extends CI_Model {
    function  __construct() {
        parent::__construct();
        // Load session library
        $this->load->library('session');
        
        // Load file model
        //$this->load->model('file');
    }
    
    function index(){
        $data = array();
        // If file upload form submitted
        if($this->input->post('fileSubmit') && !empty($_FILES['files']['name'])){
            $filesCount = count($_FILES['files']['name']);
            for($i = 0; $i < $filesCount; $i++){
                $_FILES['file']['name']     = $_FILES['files']['name'][$i];
                $_FILES['file']['type']     = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error']     = $_FILES['files']['error'][$i];
                $_FILES['file']['size']     = $_FILES['files']['size'][$i];
                
                // File upload configuration
                $uploadPath = 'assets/';
                $config['upload_path'] = $uploadPath;
                $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|pdf|txt';
                // Load and initialize upload library
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                
                // Upload file to server
                if($this->upload->do_upload('file')){
                    // Uploaded file data
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['uploaded_on'] = date("Y-m-d H:i:s");
                }
            }
            
          /*  if(!empty($uploadData)){
                // Insert files data into the database
                $insert = $this->file->insert($uploadData);
                
                // Upload status message
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg',$statusMsg);
            }*/
        }
        
        // Get files data from the database
        //$data['files'] = $this->file->getRows();
        
        // Pass the files data to view
       // $this->load->view('upload_file', $data);
       // $this->load->view('remov',$data);
    }

}

