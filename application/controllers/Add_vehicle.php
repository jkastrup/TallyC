<?php
	// Add a vehicle to a user controller
	// Protect against direct access
	class Add_vehicle extends CI_Controller {
		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
		
		}
		
		public function add() {
			$this->load->view('templates/header');
			echo $this->input->post('vehicleID');
		}
	}
?>