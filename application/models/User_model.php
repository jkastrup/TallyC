<?php
	// Protect against direct access
	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');	
	}
	
	class User_model extends CI_Model {
		public function __construct(){
			parent::__construct();	
		}
		
		// Used to test if user is in the database
		// If successful, set user data
		function login($email, $password){
			// Set query constraints
			$this->db->where("email", $email);
			$this->db->where("password", $password);
			
			// Select user from database
			$query = $this->db->get('users');
			
			// Test query
			if ($query->num_rows() > 0) {
				// Success
				foreach($query->result() as $row) {
					// Add all data to the session
					$newdata = array(
						'userID' => $row->userID,
						'f_name' => $row->first_name,
						'l_name' => $row->last_name,
						'email' => $row->email,
						'logged_in' => TRUE,
					);
				}
				// set user data and return true
				$this->session->set_userdata($newdata);
				return TRUE;
			} else {
				return FALSE;
			}
		}
		
		// Adds a user to the database from registration
		public function add_user(){
			// Store user input - hash password
			$data = array(
				'first_name' => $this->input->post('f-name'),
				'last_name' => $this->input->post('l-name'),
				'email' => $this->input->post('email_address'),
				'password' => md5($this->input->post('password'))
			);
			
			// Add new user to database
			$this->db->insert('users', $data);
		}
		
		
	}// end User_model	
	
	
	
	
	
?>