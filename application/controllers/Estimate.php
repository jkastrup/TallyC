<?php
	// Estimation Controller
	class Estimate extends CI_Controller {
		public function __construct() {
			parent::__construct();	
		}
	
		public function saveTrip(){
			//  $vehicleID(3), $distance(4), $cost_pg(5), $name(6)
			$vehicleID = $this->uri->segment(3);
			$distance = $this->uri->segment(4);
			$cost_pg = $this->uri->segment(5);
			$trip_name = $this->uri->segment(6);
			$trip_cost = $this->uri->segment(7);
			
			// Load and run model function
			$this->load->model('Estimate_model');
			if($this->Estimate_model->saveTrip($vehicleID, $distance, $cost_pg, $trip_name, $trip_cost)) {
				// Set session data and return to view
				$this->session->set_userdata('save_msg', 'Trip has been saved to your account!');
				redirect(site_url()."/pages/view/estimation/save_success");			
			} else {
				// Set session data and return to view
				$this->session->set_userdata('save_msg', 'Trip failed to save to to your account!');
				redirect(site_url()."/pages/view/estimation/save_failed");			
			}
		}
	}
?>