<?php
	class User extends CI_Controller {
		public function __construct() {
			parent::__construct();	
		}
		
		// Main function for User
		public function index() {
			if($this->session->userdata('email') != '') {
				// User is logged in
				$this->welcome();	
			} else {
				// User is NOT logged in
				// Load registration page
				$data['title'] = 'Login';
				$this->load->view('templates/login_header', $data);
				$this->load->view('pages/login_view', $data);
				$this->load->view('pages/register_view', $data);	
				$this->load->view('templates/footer', $data);
			}
		}
		
		// Displays welcome page for logged in user
		public function welcome() {
			// Load welcome page
			$data['title'] = "Welcome!";
			$this->load->view('templates/header', $data);
			$this->load->view('pages/home', $data);
			$this->load->view('templates/footer', $data);
		}
		
		// Send login input to user_model/login function
		public function login() {
			// Store POSTed variables
			$email = $this->input->post('email');
			$password= md5($this->input->post('pass'));
			
			// Store user_model/login result
			$this->load->model('User_model');
			$result = $this->User_model->login($email, $password);
			
			// test result for successful login
			if($result) {
				// Success - Display welcome page
				$this->welcome();	
			} else {
				// Fail - Display Registration through user/index function
				$this->index();	
			}
		}
		
		// Validate and Register the user
		public function registration() {
			// Load validation library and model
			$this->load->library('form_validation');
			$this->load->model('User_model');
			
			// Set validation rules
			$this->form_validation->set_rules('f-name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('l-name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('email_address', 'Email', 'trim|required|valid_email|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');
			$this->form_validation->set_rules('con_password', 'Confirm Password', 'trim|required|matches[password]');
			
			// Test form validation
			if ($this->form_validation->run() == FALSE) {
				// Validation Failed, redirect to login
				$data['title'] = 'Login';
				$this->load->view('templates/login_header', $data);
				$this->load->view('pages/login_view', $data);
				$this->load->view('pages/register_view', $data);	
				$this->load->view('templates/footer', $data);
			} else {
				// Validation Success, add user to database
				$this->User_model->add_user();
				
				// Redirect to access page to allow login
				$this->thanks();
			}	
		}
		
		// After successful registration, thank user then allow login
		public function thanks() {
			$data['title'] = 'Registration Successful';
			$this->load->view('templates/login_header', $data);
			$this->load->view('pages/thanks_view', $data);
			$this->load->view('pages/login_view', $data);
			$this->load->view('templates/footer', $data); 	
		}
		
		// Logout Functionality
		public function logout() {
			// Delete session data, redirect to login page
			$newdata = array(
				'userId' => '',
				'email' => '',
				'logged_in' => FALSE
			);	
			
			$this->session->unset_userdata($newdata);
			$this->session->sess_destroy();
			redirect(base_url());
		}
		
		
	}

?>