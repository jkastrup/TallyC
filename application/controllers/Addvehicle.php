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
		
		// Delete vehicle from user account
		public function delete(){
			$vehicleID = $this->input->post('vehicleID');
			
			// Load model and delete trip
			$this->load->model('Vehicle_model');
			if($this->Vehicle_model->delete($vehicleID)){
				$this->session->userdata['vehicle-delete'] = TRUE;
				redirect(site_url('/pages/view/my_vehicles'));
			} else {
				$this->session->userdata['vehicle-delete'] = FALSE;
				redirect(site_url('pages/view/my_vehicles'));
			}
		}
	}
?>