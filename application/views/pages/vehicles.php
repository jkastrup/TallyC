<!-- 
	Vehicles.php will give the user the ability to add a vehicle to the database
-->


<link rel="stylesheet" type="text/css" href="/assets/css/vehicles.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<?php
	// Check for POSTed variables from the form
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		// Store POST variables
		$year = $_POST['v-year'];
		$make = $_POST['v-make'];
		$model = $_POST['v-model'];
		$mpg = $_POST['v-mpg'];
		
		// Insert into Database
		$this->year = $year;
		$this->make = $make;
		$this->model = $model;
		$this->mpg = $mpg;
		$this->db->insert('vehicles', $this);
		// If insert is successful display
		if($this->db->affected_rows() > 0){
			echo "<div id='add-msg'>Vehicle has been added to the database successfully!</div>";
		}
	}
?>      
<div id="wrapper">
    <!--
        Create the 'Add Vehicle' form
        This form will add a vehicle to the database
    -->
    <div id="vehicle_form">
        <h2>Add a Vehicle </h2>
        <!-- Form for trip estimation -->
        <?php
            // Load Helpers
            $this->load->helper('form');
            $this->load->helper('html');
            
            // Generate Form
            $atr = array('class' => 'vehicle-form');
            echo form_open(site_url().'index.php/pages/view/vehicles', $atr);
            // Input
            $atr = array(
                'name'			=>	'v-year',
                'id'			=>	'v-year',
                'maxlength' 	=>	'4',
                'size'			=>	'5',
                'placeholder'	=>	'1999',
                'required'		=>	'required'
            );
            echo form_label('Year: ', 'v-year');
            echo form_input($atr);
            // Input
            $atr = array(
                'name'			=>	'v-make',
                'id'			=>	'v-make',
                'maxlength' 	=>	'50',
                'size'			=>	'25',
                'placeholder'	=>	'Honda',
                'required'		=>	'required'
            );
            echo form_label('Make: ', 'v-make');
            echo form_input($atr);
            // Input
            $atr = array(
                'name'			=>	'v-model',
                'id'			=>	'v-model',
                'maxlength' 	=>	'50',
                'size'			=>	'25',
                'required'		=>	'required',
                'placeholder'	=>	'Accord'		
            );
            echo form_label('Model: ', 'v-model');
            echo form_input($atr);
            // Input
            $atr = array(
                'type'			=> 	'number',
                'name'			=>	'v-mpg',
                'id'			=>	'v-mpg',
                'min'			=>	'0',
                'max'			=>	'999',
                'maxlength' 	=>	'3',
                'size'			=>	'5',
                'required'		=>	'required',
                'placeholder'	=>	'33'		
            );
            echo form_label('MPG: ', 'v-mpg');
            echo form_input($atr);
            // Submit Button
            $atr = array(
                'type' 	=> 'submit',
                'name'	=> 'v-submit',
                'class'	=> 'button',
                'value'	=> 'Submit Vehicle',
            );
            echo form_submit($atr);
			echo form_close();
        ?>    
                    
    </div><!-- end #vehicle_form -->
    
    
    <!-- Div displaying current vehicles in the database -->
    <div id="vehicles">
        <?php
            // Select all vehicles from the database
            $query = $this->db->get('vehicles');
            
            // Display each car info
            foreach($query->result() as $vehicle){
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
                $a = "https://www.google.com/search?newwindow=1&site=&source=hp&q=" . $year . " " . $make . " " . $model;
                $output = "<div class='vehicle-info' title='". $vehicleID . "'><p><a title='Open in Google' target='_blank' href='".$a ."'>" . $year . " " . $make . " " . $model . "</a></p><p>Avg MPG: " . $mpg . "</p><button class='button edit'>Edit</button><button class='button add'>Add Car</button><div class='avatar-container'>" . img($img) . "</div></div>";
                
                echo $output;
            }
        ?>
    </div><!-- end #vehicles -->
    
</div><!-- end #wrapper -->
<!-- script disabling edit buttons until functionality has been written -->
<script type='text/javascript'>
    $('.edit').attr('disabled', 'disabled');
	$('.add').click(function(e) {
        e.preventDefault();
		
		$.ajax({
			type: 'post',
			url: '/add_vehicle/add',
			data: 'vehicleID='+ $(this).parent().attr('title'),
			error: function(){},
			success: function(){}	
		});
    });
</script>
