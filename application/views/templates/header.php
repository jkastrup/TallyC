<?php
	if($this->session->userdata('email') == ""){
		redirect(base_url());	
	}
?>

<html>
        <head>
        	<link href="/assets/css/header.css" type="text/css" rel="stylesheet" />
            <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
            <title>TallyC</title>
        </head>
        
        <body>
        	<header>
            	<div id="logout">
                	 <?php echo anchor('user/logout', 'Logout'); ?>
                </div>
            	<div id="logo">
					<?php
                        $this->load->helper("html");
                        
						$prop = array(
							'src' => '/assets/images/tallyc-logo.png',
							'alt' => 'TallyC',
							'class' => 'img',
							'title' => 'TallyC &copy; 2015'
						);
						echo img($prop);
                        
                    ?>	
              	</div><!-- end #logo -->
                <nav>
               		<ul>
						<li class="<?php 
							if($this->uri->segment(3)=='home'){
								echo 'active';
							}?>">
                            <a href="<? echo site_url('pages/view/home'); ?>">Home</a>
                        </li>
						<li class="<?php 
							if($this->uri->segment(3)=='estimation'){
								echo 'active';
							}?>">
                            <a href="<? echo site_url('pages/view/estimation'); ?>">Estimator</a>
                        </li>
						<li class="<?php 
							if($this->uri->segment(3)=='vehicles'){
								echo 'active';
							}?>">
                            <a href="<? echo site_url('pages/view/vehicles'); ?>">Vehicles</a>
                        </li>
                        <li class="<?php 
							if($this->uri->segment(3)=='my_vehicles'){
								echo 'active';
							}?>">
                            <a href="<? echo site_url('pages/view/my_vehicles'); ?>">My Vehicles</a>
                        </li>
                        <li class="<?php 
                            if($this->uri->segment(3)=='trips_view' || $this->uri->segment(1) == 'trips'){
                                echo 'active';
                            }?>">
                            <a href="<? echo site_url('trips'); ?>">My Trips</a>
                        </li>
                        
                    </ul>
                   
                </nav>
            </header>
                
