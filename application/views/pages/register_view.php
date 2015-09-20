<!-- register_view.php -->
<div id="container">
	<?php
		// Load HTML helper
		$this->load->helper('html');
		
		// Create Registration Form
		echo form_open('user/registration');
		echo heading('Register', 2);
		
		// First name
		$atr = array(
			'type'			=> 	'text',
			'name'			=>	'f-name',
			'id'			=>	'f-name',
			'maxlength' 	=>	'20',
			'size'			=>	'20',
			'value'			=>	set_value('f-name'),
			'required'		=>	'required'
		);
		echo form_label('First Name: ', 'f-name');
		echo form_input($atr);
		
		// Last name
		$atr = array(
			'type'			=> 	'text',
			'name'			=>	'l-name',
			'id'			=>	'l-name',
			'maxlength' 	=>	'20',
			'size'			=>	'20',
			'value'			=>	set_value('l-name'),
			'required'		=>	'required'
		);
		echo form_label('Last Name: ', 'l-name');
		echo form_input($atr);
		
		// Email
		$atr = array(
			'type'			=> 	'email',
			'name'			=>	'email_address',
			'id'			=>	'email_address',
			'maxlength' 	=>	'50',
			'size'			=>	'50',
			'value'			=>	set_value('email_address'),
			'required'		=>	'required'
		);
		echo form_label('Email: ', 'email_address');
		echo form_input($atr);
		
		// Password
		$atr = array(
			'type'			=> 	'password',
			'name'			=>	'password',
			'id'			=>	'password',
			'maxlength' 	=>	'20',
			'size'			=>	'20',
			'required'		=>	'required'
		);
		echo form_label('Password ', 'password');
		echo form_input($atr);
		
		// Password Confirmation
		$atr = array(
			'type'			=> 	'password',
			'name'			=>	'con_password',
			'id'			=>	'con_password',
			'maxlength' 	=>	'20',
			'size'			=>	'20',
			'required'		=>	'required'
		);
		echo form_label('Confirm Password ', 'con_password');
		echo form_input($atr);
		
		// Submit
		echo form_submit('reg_submit', 'Register');
		echo form_close();
	?>
</div>