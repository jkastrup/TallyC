<!-- Provides login form -->
<div class='error_message'>
    <?php 
		if( validation_errors() != ""){
			echo heading('ERRORS', 4);
			echo validation_errors(); 
		}
	?>
</div><!-- end .error_message -->

<div id="content">
	<?php 
		// Create login form
		echo form_open(site_url('user/login')); 
		echo heading('Login', 2);
		
		$atr = array(
			'type'			=> 	'email',
			'name'			=>	'email',
			'id'			=>	'email',
			'maxlength' 	=>	'50',
			'size'			=>	'50',
			'autofocus'		=> 	'autofocus',
			'required'		=>	'required'
		);
		echo form_label('Email:', 'email');
		echo form_input($atr);
		
		$atr = array(
			'type'			=> 	'password',
			'name'			=>	'pass',
			'id'			=>	'pass',
			'maxlength' 	=>	'20',
			'size'			=>	'20',
			'required'		=>	'required'
		);
		echo form_label('Password: ', 'pass');
		echo form_input($atr);
		
		echo form_submit('login_submit', 'Login');
		echo form_close();
		
	?>
    
    
    
</div>