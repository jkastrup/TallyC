
<link rel="stylesheet" type="text/css" href="/assets/css/my_vehicles.css" />

<div class="content">
	<h2> My Vehicles </h2>
	<div class="my_cars">
		<?php
            // MY VEHICLES PAGE
            
            $userID = $this->session->userdata('userID');
            $query = "SELECT id, userID, uV.vehicleID, year, make, model, mpg FROM userVehicles as uV join vehicles on vehicles.vehicleID = uV.vehicleID where userID=".$userID.";";
            $result = $this->db->query($query);
            if( $result->num_rows() > 0 ){
                // successful query
                foreach($result->result() as $vehicle) {
                	//echo "<p>".$vehicle->year." ".$vehicle->make." ".$vehicle->model." ".$vehicle->mpg."</p>";
					$year = $vehicle->year;
					$make = $vehicle->make;
					$model = $vehicle->model;
					$mpg = $vehicle->mpg;
					$vehicleID = $vehicle->vehicleID;
					
					// Fill in default images
					// Later versions will allow user uploaded images
					$img = array(
						'src'	=> '/assets/images/car-default.png',
						'alt'	=> $year . " " . $make . " " . $model,
						'class'	=> 'avatar',
						'title'	=> $year . " " . $make . " " . $model
					);
					$url = 'window.location.href="'.site_url().'/addvehicle/add"';
					
					$a = "https://www.google.com/search?newwindow=1&site=&source=hp&q=" . $year . " " . $make . " " . $model;
					$output = "<div class='vehicle-info' title='". $vehicleID . "'><p><a title='Open in Google' target='_blank' href='".$a ."'>" . $year . " " . $make . " " . $model . "</a></p><p>Avg MPG: " . $mpg . "</p><div class='avatar-container'>" . img($img) . "</div></div>";
					
					echo $output;
                }
            } else {
                // Failed query
                
            }
        ?>
    </div>
</div>