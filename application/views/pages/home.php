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
		echo heading('Welcome '.$this->session->userdata('f_name').'!',2);
	?>
</div><!-- end #welcome -->

<div id="main">

</div><!-- end #main -->









