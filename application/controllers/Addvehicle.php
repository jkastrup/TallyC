<?php
	// Add a vehicle to a user controller
	// Protect against direct access
	class Addvehicle extends CI_Controller {
		public function __construct() {
			parent::__construct();	
		}
		
		public function index() {
			// Does nothing:: Not sure if required
		}
		
		// adds a vehicle to the database
		// returns true on success
		public function add($vehicleID) {
			// Send data to model
			$this->load->model('Vehicle_model');
			
			// Check for success
			if($this->Vehicle_model->add($vehicleID)){
				// vehicle added successfully
				$this->session->set_userdata('add_msg', 'Vehicle has been successfully added to your account');
				redirect(site_url()."/pages/view/vehicles/add_success");
			} else {
				// vehicle was not added sucessfully
				$this->session->set_userdata('add_msg', 'Vehicle failed to be added to your account');
				redirect(site_url()."/pages/view/vehicles/add_failed");	
			}
		}
	}
?>