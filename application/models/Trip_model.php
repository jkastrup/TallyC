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
			$query = $this->db->query("SELECT * FROM trips WHERE userID = " . $userID);
			// Return results
			if($query->num_rows() > 0){
				$results = $query->result_array();
				return $results;
			} else {
				return FALSE;
			}
		}
	}
?>
