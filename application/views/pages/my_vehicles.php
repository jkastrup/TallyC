
<link rel="stylesheet" type="text/css" href="/assets/css/my_vehicles.css" />

<?php
	// Retrieve users cars
	$userID = $this->session->userdata('userID');
	$query = "SELECT id, userID, uV.vehicleID, year, make, model, mpg FROM userVehicles as uV join vehicles on vehicles.vehicleID = uV.vehicleID where userID=".$userID.";";
	$result = $this->db->query($query);
?>

<div class='none'>
	<?php
		// Test for results
		if( $result->num_rows() == 0){
			// If there are no vehicles
			echo heading("You have no vehicles yet!", 2);
		}
	?>
</div>

<div class="content">    
    <?php 
		if($result->num_rows == 0){
			echo "<a class='add-v' style='display: block; text-align: center;' href=". site_url('/pages/view/vehicles') . ">Add a Vehicle</a>"; 
		}
	?>	
	<div class="my_cars">
		<?php
            // MY VEHICLES PAGE
     
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
					$output = "<div class='vehicle-info' title='". $vehicleID . "'><p><a title='Open in Google' target='_blank' href='".$a ."'>" . $year . " " . $make . " " . $model . "</a></p><p>Avg MPG: " . $mpg . "</p><div class='avatar-container'>" . img($img) . "</div>";
					
					echo $output;
					$atr = array('class' => 'del-vehicle-form');
					echo form_open(site_url().'/addvehicle/delete', $atr);
					$atr = array(
						'type' => 'text',
						'class' => 'hidden',
						'name' => 'vehicleID',
						'id' => 'vehicleID',
						'value' => $vehicleID
					);
					echo form_input($atr);
					$atr = array(
						'type' => 'submit',
						'class' => 'button delete',
						'value' => 'Delete'
					);
					echo form_input($atr);
					echo form_close();
					echo "</div>";
                }
            } 
        ?>
    </div>
</div>