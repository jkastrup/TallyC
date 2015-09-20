<!--
This document is contained within the <body> tags
generated from the 'header.php' template ('application/views/templates/header.php')

Home page for TallyC web application
-->
<!-- Landing Page to be compeleted during next phase of development -->
<!--<link rel="stylesheet" type="text/css" href="/assets/css/home.css" />-->
<style>body{font-family: 'Roboto', sans-serif;}#main{text-align:center}</style>

<div id="main">

	<?php
		echo heading('Login Successful. Welcome '.$this->session->userdata('f_name'), 2);
		echo heading("Landing Page is currently under development",2);
		echo "<p>For now the landing page has been disabled. But, it will be complete in Version 2 by next week</p>";
		echo "<p>Click on the tabs at the top to get started!</p>";
		
	?>
</div><!-- end #main -->










