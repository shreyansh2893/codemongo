<?php
	class Users extends CI_Controller{
	

		//login User
		public function login(){
			$data['title'] = 'Login';

			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
			if($this->form_validation->run() === False){
				$this->load->view('templates/header');
				$this->load->view('login', $data);
				$this->load->view('templates/footer');

			}else{
				//Get username
				$username = $this->input->post('username');
				//Get and Encrypt Password
				$password = $this->input->post('password');

				if($username=="shrey" && $password == "shrey@123"){

						//Create Session
					$user_data = array(
						//'user_id' => $user_id,
						'username' => $username,
						'logged_in'  => true
					);
					$this->session->set_userdata($user_data);
					//set messages which is thrugh session----in autoload[librries] =array('session');
					$this->session->set_flashdata('user_loggedin', 'You are now logged in');

					redirect('students');
					//echo "success";exit;
				}

				

				else{

						//set messages which is thrugh session----in autoload[librries] =array('session');
						$this->session->set_flashdata('loggin_failed', 'Login is invalid');

						redirect('/');

					}				
			}
		}

		//user log out
		public function logout(){
			//unset user data
			$this->session->unset_userdata('logged_in');
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');

			//set messages which is thrugh session----in autoload[librries] =array('session');
			$this->session->set_flashdata('user_loggedout', 'You are now logged out');
			redirect('/');
		}


	
	}
