<link href='/assets/css/trips.css' type="text/css" rel="stylesheet"/>


<div class='content'>
	<?php
	// Check for trips
	if(count($results) > 0){
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