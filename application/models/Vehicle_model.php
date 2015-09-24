<?php
	// Protect against direct access
	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');	
	}
	
	class Vehicle_model extends CI_Model {
		public function __construct(){
			parent::__construct();	
		}
		
		// Adds a vehicle to the user if it is NOT already there
		public function add($vehicleID){
			// Store userID
			$userID = $this->session->userdata('userID');
			
			// Check if vehicle is already there
			if(!$this->isAdded($vehicleID)){
				// Vehicle is not yet added
				// Create insertion data for database
				$data = array(
					'userID' => $userID,
					'vehicleID' => $vehicleID
				);
				// INSERT into database
				$this->db->insert('userVehicles', $data);
			
				// Return true if 1 row added successfully
				return ($this->db->affected_rows() != 1) ? false: true;
			} else {
				// vehicle already exists
				return FALSE;
			}
			
			
		}
		
		// Tests if vehicle exists in user's selection already
		// returns TRUE if vehicle is found
		public function isAdded($vehicleID) {
			$userID = $this->session->userdata('userID');
			
			// Query if the same vehicle already exists
			$sql = "
				SELECT userID, vehicleID FROM userVehicles
				WHERE (vehicleID = $vehicleID AND userID = $userID);
			";
			$query = $this->db->query($sql);
			// Return true if vehicle exists already
			return ($query->num_rows() > 0) ? TRUE : FALSE;
			
		}
		
		// Returns all vehicles in the database
		public function getVehicles() {
			$sql = "SELECT * from vehicles;";
			$query = $this->db->query($sql);
			
			// Check for success of select
			if($query->num_rows() > 0) {
				return $query;
			} else {
				return FALSE;	
			}
		}
		
		public function getUserVehicles($userID){
			$sql = 'SELECT * from userVehicles WHERE userID = '. $userID;
			$query = $this->db->query($sql);
			
			if($query->num_rows() > 0){
				return $query;
			} else {
				return false;	
			}
		}
	}