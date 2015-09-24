<?php
	// Trip Controller
	// Estimation Controller
	class Trips extends CI_Controller {
		
		function __construct() {
			parent::__construct();	
		}
		
		// Retrieve current user's trips to display in view
		public function index() {
			// Load the model
			$this->load->model('Trip_model');
			// Check for success
			if($this->Trip_model->getTrips() != FALSE){
				// Send results to view
				$results = $this->Trip_model->getTrips();
				$data = array();
				$data['title'] = "trips";
				$data['results'] = $results;
				$this->load->view('/templates/header', $data);
				$this->load->view('/pages/trips_view', $data);
				$this->load->view('/templates/footer', $data);
			} else {
				// Load no results message, send to view
				$data = array (
					'results' => "You haven't saved any trips yet!"
				);
				$this->load->view("/templates/header", $data);
				$this->load->view("/pages/trips_view", $data);
				$this->load->view("/templates/footer", $data);
			}
		}
	}

?>