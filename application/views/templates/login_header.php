<html>
        <head>
        	<link href="/assets/css/header.css" type="text/css" rel="stylesheet" />
            <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
            <title>TallyC</title>
        </head>
        
        <body>
        	<header>
            
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
               
            </header>
                          
