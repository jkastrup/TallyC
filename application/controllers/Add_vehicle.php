<?php
	// Add a vehicle to a user controller
	// Protect against direct access
	class Add_vehicle extends CI_Controller {
		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
			// Add selected vehicle to userVehicles table under userID	
			redirect(base_url());
		}
	}
?>