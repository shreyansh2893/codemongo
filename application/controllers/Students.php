<?php
	class Students extends CI_Controller{
	
		function __construct() {
		parent::__construct();
		$this->load->model('Student_model');
	}

	// Student list
	function index() {
			if(!$this->session->userdata('logged_in')){
				redirect('/');
			}

		$data['students'] = $this->Student_model->get_student_list();
		$data['subjects'] = $this->Student_model->get_subject();
		//echo json_encode(iterator_to_array($data['users']));
		$this->load->view('templates/header');
		$this->load->view('students', $data);
		$this->load->view('templates/footer');

			if($this->input->post('submit_pop')) {
				//echo $this->input->post('subject');
				//echo $aa;
				//exit;
          //  $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
          //  $this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');

            if($this->input->post('id')){
            	  $result = $this->Student_model->update_student($this->input->post('id'),$this->input->post('rno'), $this->input->post('name'), $this->input->post('subject'), $this->input->post('marks'));                
                if($result === TRUE) {
					redirect('/students');
				} else {
					$data['error'] = 'Error occurred during updating data';
					$this->load->view('students', $data);
				}
            }


             if($this->input->post('id')==""){
            	
             	//	 $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
           // $this->form_validation->set_rules('email', 'Email Address', 'trim|valid_email|required');

            // if ($this->form_validation->run() !== FALSE) {
                $result = $this->Student_model->create_student($this->input->post('rno'),$this->input->post('name'), $this->input->post('subject') , $this->input->post('marks'), 0, 0, 0);
				if($result === TRUE) {
					redirect('students');
				} else {
					$data['error'] = 'Error occurred during saving data';
					$this->load->view('user_create', $data);
				}
    //         } else {
				// $data['error'] = 'Error occurred during saving data: all fields are required';
    //             $this->load->view('user_create', $data);
    //         }

            }

              
            
        }
	}


	function delete($_id) {
		//echo $_id;exit();
		if ($_id) {
            $this->Student_model->delete_student($_id);
        }
		redirect('/');
	}
	
}
?>