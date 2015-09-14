<!-- 
	#Estimator will calculate the cost for a trip
    based on the vehicle's mpg, distance, and fuel cost
-->
<link href="/assets/css/estimator.css" type="text/css" rel="stylesheet" />

<?php
	
	// Check for POSTed variables and store them
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
			// Miles per Gallon
			$est_mpg = $_POST['est-mpg'];
			// Distance
			$est_dist = $_POST['est-dist'];
			// Fuel Cost
			$est_fc = $_POST['est-fc'];
			setlocale(LC_MONETARY, 'en_US');
			$est_fc_form = "$".substr(money_format('%i', $est_fc), 3);
			
			// Basic Estimation for total fuel cost of the trip
			$trip_cost = ($est_dist / $est_mpg) * $est_fc;
			// Format Cost to USD
			$trip_cost = "$".substr(money_format('%i', $trip_cost), 3);
	}
?>


<div id="estimator">
	<?php
		// Load Helpers
		$this->load->helper('form');
		$this->load->helper('html');
		// Grab vehicles from the database
		//$query = $this->db->query('SELECT * FROM vehicles;');
		//$user = 'root';
		//$pass = 'root';
		//$db_info = "mysql:host=localhost;dbname=tallyc;port=8889";
		//$dbh = new PDO($db_info, $user, $pass);
		//$stmt = $dbh->prepare("SELECT * FROM vehicles");
		//$stmt->execute();
		//$my_query = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
        $query = $this->db->get('vehicles');
 
		// Create the Select field for the vehicles
		$names = array();
		$mpgval = array();
		foreach ($query->result() as $row) {
			$str = $row->year.' '.$row->make.' '.$row->model.' ('.$row->mpg.' mpg)';
			array_push($names, $str);
			array_push($mpgval, $row->mpg);
		}
		// Will be used in the form below
		$options = array_combine($mpgval, $names);
		
		$atr = array('class' => 'estimation-form');
		echo form_open(site_url().'index.php/pages/view/estimation', $atr);
		echo "<h2>Trip Estimation</h2>";
		
		// Select vehicle
		$atr = array(
			'id'		=>	'vehicle',
			'required'	=>	'required'
		);
		echo form_label('Vehicle: ', 'est-mpg');
		echo form_dropdown('est-mpg', $options);
		echo "<a class='add-v' target='_blank' href=". site_url('index.php/pages/view/vehicles') . ">Add a Vehicle</a>";
		
		// Distance input
		$atr = array(
			'type'	=> 'number',
			'name'	=> 'est-dist',
			'id'	=> 'est-dist',
			'min'	=> '0',
			'size'	=> '20',
			'required' => 'required',
			'placeholder' => 'Miles...'
		);
		echo form_label('Distance: ', 'est-dist');
		echo form_input ($atr);
		
		// Average fuel cost
		$atr = array(
			'type' 	=> 'number',
			'name' 	=> 'est-fc',
			'id'	=> 'est-fc',
			'min'	=> '0',
			'step'	=> '.01',
			'size'	=> '20',
			'required' => 'required',
			'placeholder' => '$0.00'
		);
		echo form_label('Cost per Gallon', 'est-fc');
		echo form_input($atr);
		// Submit Button
		$atr = array(
			'type' 	=> 'submit',
			'name'	=> 'e-submit',
			'class'	=> 'button',
			'value'	=> 'Estimate Cost',
		);
		echo form_submit($atr, 'Estimate Cost');
	
	?> 
</div><!-- end #estimator -->

<div id="est-msg">
	<?php
		// If POSTed variables exist then trip cost has been calculated
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			// Display Heading
			$str = "Total Trip Cost: " . $trip_cost;
			echo heading($str, 2, 'class="est-cost"');
			// Display Details
			echo"<p class='est-details'>At ".$est_mpg."mpg your trip of ".$est_dist." miles will cost ".$trip_cost." at ".$est_fc_form." a gallon.";
			
		} else {
			echo heading("Estimate the cost of your trip!", 2);
			echo "<p style='margin:0;'>Use the 'Trip Estimation' to the left to estimate how much fuel will cost for your trip</p>";
			echo "<p style='margin:0;'>The more accurate you are with your info, the more accurate the estimation will be!";	
		}
	?>
    <p class="est-details"></p>
</div><!-- end #est-message -->