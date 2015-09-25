<!--
This document is contained within the <body> tags
generated from the 'header.php' template ('application/views/templates/header.php')

Home page for TallyC web application
-->
<!-- Landing Page to be compeleted during next phase of development -->
<!--<link rel="stylesheet" type="text/css" href="/assets/css/home.css" />-->
<style>body{font-family: 'Roboto', sans-serif;}#main{text-align:center}</style>
<link href='/assets/css/home.css' rel='stylesheet' type="text/css" />
<div id="welcome">
	<?php
		echo heading('Login Successful', 4);
		echo heading('Welcome, '.$this->session->userdata('f_name').'!',2);
	?>
</div><!-- end #welcome -->

<div id="main">
	<div class='paragraph'>
        <h2>Where to begin?</h2>
        <p>TallyC is simple, easy, and efficient.  Get started quickly by accessing the <span>The Estimator</span>, or check out the list of cars on the <span>Vehicles</span> page!</p>
        <p>We'll store a little information about your car and your trips for easy access and management</p>
    </div>
    <div class='paragraph'>
        <h2>What can we do?</h2>
        <p>You can add cars to your account for easy management after adding them to the database</p>
        <p>Add a name to a trip and save it to your account as well!</p>
	</div>
</div><!-- end #main -->









