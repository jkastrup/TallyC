<div class="content">
	<div class="my_cars">
		<?php
            // MY VEHICLES PAGE
            
            $userID = $this->session->userdata('userID');
            $query = "SELECT id, userID, uV.vehicleID, year, make, model, mpg FROM userVehicles as uV join vehicles on vehicles.vehicleID = uV.vehicleID where userID=".$userID.";";
            $result = $this->db->query($query);
            if( $result->num_rows() > 0 ){
                // successful query
                foreach($result->result() as $vehicle) {
                	echo "<p>".$vehicle->year." ".$vehicle->make." ".$vehicle->model." ".$vehicle->mpg."</p>";
                }
            } else {
                // Failed query
                
            }
        ?>
    </div>
</div>