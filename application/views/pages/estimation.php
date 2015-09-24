<!-- 
	#Estimator will calculate the cost for a trip
    based on the vehicle's mpg, distance, and fuel cost
-->
<link href="/assets/css/estimator.css" type="text/css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<?php
	
	// Check for POSTed variables and store them
	if ($_SERVER['REQUEST_METHOD'] == "POST"){
			// Miles per Gallon
			$est_mpg = "";
			$vehicleID = $this->input->post('vehicleID');
			// Test if user put in trip name
			if($this->input->post('trip-name') == NULL){
				// load default name
				$trip_name = 'Default Trip';
			} else {
				// load user input trip name
				$trip_name = $this->input->post('trip-name');
			}
			$result = $this->db->query("SELECT mpg FROM vehicles WHERE vehicleID=".$vehicleID);
			foreach($result->result() as $row){
				$est_mpg = $row->mpg;	
			}
			// Distance
			$est_dist = $_POST['est-dist'];
			// Fuel Cost
			$est_fc = $_POST['est-fc'];
			setlocale(LC_MONETARY, 'en_US');
			$est_fc_form = "$".substr(money_format('%i', $est_fc), 3);
			
			// Basic Estimation for total fuel cost of the trip
			$trip_cost = ($est_dist / $est_mpg) * $est_fc;
			// Format Cost to USD
			$trip_cost_form = "$".substr(money_format('%i', $trip_cost), 3);
	}
?>

<div id="save-msg">
	<?php
		if($this->session->userdata('save_msg')){
				echo "<p class='".$this->uri->segment(4)."'>".$this->session->userdata('save_msg')."</p>";
				// ensures permeation of message
				$this->session->unset_userdata('save_msg');	
			}
	?>
</div><!-- end #save-msg -->


<div id="estimator">
	<?php
		// Load Helpers
		$this->load->helper('form');
		$this->load->helper('html');
		
		
        $query = $this->db->get('vehicles');
 
		// Create the Select field for the vehicles
		$names = array();
		$vehicles = array();
		foreach ($query->result() as $row) {
			$str = $row->year.' '.$row->make.' '.$row->model.' ('.$row->mpg.' mpg)';
			array_push($names, $str);
			array_push($vehicles, $row->vehicleID);
		}
		// Will be used in the form below
		$options = array_combine($vehicles, $names);
		
		$atr = array('class' => 'estimation-form');
		echo form_open(site_url().'/pages/view/estimation', $atr);
		echo "<h2>Trip Estimation</h2>";
		
		// Select vehicle
		$atr = array(
			'id'		=>	'vehicle',
			'required'	=>	'required'
		);
		echo form_label('Vehicle: ', 'vehicleID');
		echo form_dropdown('vehicleID', $options);
		echo "<a class='add-v' href=". site_url('/pages/view/vehicles') . ">Add a Vehicle</a>";
		
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
		echo form_label('Distance (miles): ', 'est-dist');
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
		
		// Trip Name
		$atr = array(
			'type' => 'text',
			'name' => 'trip-name',
			'id' => 'trip_name',
			'size' => '20'
		);
		echo form_label('Trip Name', 'trip-name');
		echo form_input($atr);
		// Submit Button
		$atr = array(
			'type' 	=> 'submit',
			'name'	=> 'e-submit',
			'class'	=> 'button',
			'value'	=> 'Estimate Cost',
		);
		echo form_submit($atr, 'Estimate Cost');
		echo form_close();
	
	?> 
</div><!-- end #estimator -->

<div id="est-msg">
	<?php
		// If POSTed variables exist then trip cost has been calculated
		if($_SERVER['REQUEST_METHOD'] == "POST") {
			// Display Heading
			$str = "Total Trip Cost: " . $trip_cost_form;
			echo heading($str, 2, 'class="est-cost"');
			// Display Details
			echo"<p class='est-details'>At ".$est_mpg."mpg your trip of ".$est_dist." miles will cost ".$trip_cost_form." at ".$est_fc_form." a gallon.";
			echo "<br/>";
			
			// Generate hidden form
			// hidden form will POST save data to controller
			$atr = array('class' => 'save-trip');
			echo form_open(site_url().'/estimate/savetrip', $atr);
			echo "<input id='vehicleID' class='hidden' name='vehicleID' type='text' value='".$vehicleID."'>
				<input id='trip-name' class='hidden' name='trip-name' type='text' value='".$trip_name."'>
				<input id='trip-cost' class='hidden' name='trip-cost' type='text' value='".$trip_cost."'>
				<input id='distance' class='hidden' name='distance' type='text' value='".$est_dist."'>
				<input id='cost-pg' class='hidden' name='cost-pg' type='text' value='".$est_fc."'>
				<input type='submit' name='save-trip' class='save button' value='Save Trip'>
				";
			
			
			
		} else {
			echo heading("Estimate the cost of your trip!", 2);
			echo "<p style='margin:0;'>Use the 'Trip Estimation' to the left to estimate how much fuel will cost for your trip</p>";
			echo "<p style='margin:0;'>The more accurate you are with your info, the more accurate the estimation will be!";	
		}
	?>
    <p class="est-details"></p>
</div><!-- end #est-message -->


<script>	
	$('.save').click(function(e) {
        e.preventDefault();
		// Set values
		var $trip_cost = $('#trip-cost').attr('value');
		var $vehicleID = $('#vehicleID').attr('value');
		var $distance = $('#distance').attr('value');
		var $fc = $('#cost-pg').attr('value');
		var $name = $('#trip-name').attr('value');
		// Send to controller for trip save
		window.location.replace("http://localhost:8888/index.php/estimate/saveTrip/" + $vehicleID + "/" + $distance + "/" + $fc + "/" + $name + "/" + $trip_cost );
    });
</script>