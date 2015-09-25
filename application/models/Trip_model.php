<?
	// Trip Model
	if (!defined('BASEPATH')) {
		exit('No direct script access allowed');	
	}
	
	class Trip_model extends CI_Model {
		public function __construct(){
			parent::__construct();	
		}
		// Function returns array of trips for current user.
		public function getTrips(){
			$userID = $this->session->userdata['userID'];
			
			// Query based on userID
			$query = $this->db->query("SELECT tripID, trip_name, trip_distance, trips.vehicleID, userID, trip_cost,cost_pg, vehicles.year, vehicles.make, vehicles.model, vehicles.mpg FROM trips
JOIN vehicles ON vehicles.vehicleID = trips.vehicleID
WHERE userID = " . $userID . ";");
			// Return results
			if($query->num_rows() > 0){
				$results = $query->result_array();
				return $results;
			} else {
				return FALSE;
			}
		}
		
		// Delete a trip from the database
		public function delTrip($tripID){
			// Delete trip
			$this->db->where('tripID', $tripID);
			$this->db->delete('trips');
			
			// Return true/false on success
			if($this->db->affected_rows() > 0){
				return TRUE;
			}else {
				return FALSE;
			}
		}
	}
?>
