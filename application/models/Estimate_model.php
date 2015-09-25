<?php
	// Protect against direct access
	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');	
	}
	
	class Estimate_model extends CI_Model {
		public function __construct(){
			parent::__construct();	
		}
		
		// Calculate the estimated cost of the trip
		public function estimateCost($mpg, $dist, $fc){
			setlocale(LC_MONETARY, 'en_US');
			// Basic Estimation for total fuel cost of the trip
			$trip_cost = ($mpg / $dist) * $fc;
			// Format Cost to USD
			$trip_cost = "$".substr(money_format('%i', $trip_cost), 3);
			
			return $trip_cost;
		}
		
		// Saves a trip to the user's account
		public function saveTrip($vehicleID, $dist, $fc,$trip_name, $trip_cost){
			$userID = $this->session->userdata['userID'];
			// data to be inserted
			$data = array(
				'trip_name' => $trip_name,
				'trip_distance' => $dist,
				'vehicleID' => $vehicleID,
				'userID' => $userID,
				'cost_pg' => $fc,
				'trip_cost' => $trip_cost
			);
			// Insert data
			$this->db->insert('trips', $data);
			// test insert success, return true/false
			if($this->db->affected_rows() == 1){
				return TRUE;
			} else {
				return FALSE;	
			}
		}
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	