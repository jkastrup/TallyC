<link href='/assets/css/trips.css' type="text/css" rel="stylesheet"/>


<div class='content'>
	<?php
	// Check for trips
	if(is_array($results) || is_object($results)){
		// trips exist, display them
		echo "<div class='trips'>";
		foreach($results as $trip){
			// display Name, Distance, trip cost, cost-pg, year,make,model, mpg
			//echo "Trip Name: " . $trip['trip_name']. "<br/>";
			//echo "Distance: " . $trip['trip_distance']. "<br/>";
			//echo "Trip Cost: " . $trip['trip_cost']. "<br/>";
			//echo "Price Per Gallon: " . $trip['cost_pg']. "<br/>";
			//echo "Vehicle: " . $trip['year'] . " " . $trip['make'] . " " . $trip['model'] . " " . $trip['mpg'] . "mpg<br/>";
			//echo "<br/>";
			echo "<div class='trip'>";
			echo heading($trip['trip_name'], 2);
			echo "<p><strong>Distance:</strong> " . $trip['trip_distance'] . " miles</p>";
			echo "<p><strong>Trip Cost:</strong> $" . $trip['trip_cost'] . "</p>";
			echo "<p><strong>Price Per Gallon:</strong> $" . $trip['cost_pg'] . "</p>";
			echo "<p><strong>Vehicle:</strong> " . $trip['year'] . " " . $trip['make'] . " " . $trip['model'] . " " . $trip['mpg'] . "mpg";
			// Form for delete submission
			$atr = array('class' => 'del-trip-form');
			echo form_open(site_url().'/trips/deletetrip', $atr);
			$atr = array(
				'type' => 'text',
				'class' => 'hidden',
				'name' => 'tripID',
				'id' => 'tripID',
				'value' => $trip['tripID']
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
		echo "</div>";
	} else {
		// trips dont exist yet
		echo "<div class='trips'>";
		echo heading("You haven't saved any trips yet!", 2);
		echo "<a class='add-v' href=". site_url('/pages/view/estimation') . ">Create a trip!</a>";
		echo "</div>";
	}
		
	?>
</div><!-- end .content -->