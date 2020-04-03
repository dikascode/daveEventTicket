<!DOCTYPE html>
<html lang="en">
<!-- <?php echo $_SERVER['REQUEST_URI']; ?> -->
  <head>
    <title>UConnect Event Manager</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900&display=swap" rel="stylesheet">
	<!-- New Font Awesome link -->
	<script src="https://kit.fontawesome.com/1a40728d15.js" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
 
    <link rel="stylesheet" href="assets/css/animate.css">
    
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/css/ionicons.min.css">
    
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
	<link rel="stylesheet" href="assets/css/style.css">
	

	<!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->
	
	<!-- Carousel for multiple items -->
		<!-- <link rel="stylesheet" href="assets/css_cmi/animate.css"> -->
        <!-- <link rel="stylesheet" href="assets/css_cmi/style.css"> -->
        <link rel="stylesheet" href="assets/css_cmi/media-queries.css">
		<link rel="stylesheet" href="assets/css_cmi/carousel.css">
	
		<!-- Social media share plugin -->
		<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5e8611a636c81b0012fbae5b&product=inline-share-buttons" async="async"></script>
	
  </head>
  <body>

    <div class="container pt-2">
			<div class="row justify-content-between">
				<div class="col">
					<a class="navbar-brand" href="<?php echo ROOT_URL; ?>" style="font-size:400%; margin:0;">U<span>C</span></a>
				</div>
				<div class="col d-flex justify-content-end">
					<div class="social-media">
		    		<!-- <p class="mb-0 d-flex">
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-facebook"><i class="sr-only">Facebook</i></span></a>
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-twitter"><i class="sr-only">Twitter</i></span></a>
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-instagram"><i class="sr-only">Instagram</i></span></a>
		    			<a href="#" class="d-flex align-items-center justify-content-center"><span class="fab fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
		    		</p> -->
	        		</div>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	    
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
		  </button>
		  
			<form action="#" class="searchform order-lg-last">
				<div class="form-group d-flex">
					<input id="search" type="text" class="form-control pl-3" placeholder="Search Event Name">
					<button type="submit" class="form-control search"><span class="fa fa-search"></span></button>
				</div>
				<!-- Display search -->
			<div id="displaySearch" style="width: 300px; height: 50px; position: absolute; top:60px; z-index: 10;"></div>
			</form>

			
			
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav mr-auto">
	        	<li class="nav-item active"><a href="<?php echo ROOT_URL ?>" class="nav-link">Home</a></li>
	          <li class="nav-item"><a href="<?php echo ROOT_URL ?>?controller=contact" class="nav-link">Contact</a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
	<!-- END nav -->
	

    <div class="container-fluid">

            <div class="row">
                <div class="col-md">
				<?php

					// ini_set('display_errors', 1);
					// ini_set('display_startup_errors', 1);
					// error_reporting(E_ALL);

				?>
                    <?php Messages::display(); ?>
					<?php 
						include($view);
						//include(lcfirst($view)); //remove lcfirst() if working in localhost
					?>
                </div>
            </div>
            
    </div>

       <!-- /.container -->
    </body>


    <footer class="footer">
			<div class="container-fluid px-lg-5">
				<div class="row">
					<div class="col-md-9 py-5">
						<div class="row">
							<div class="col-md-4 mb-md-0 mb-4">
								<h2 class="footer-heading">About us</h2>
								<p>We are an innovative team that's helping businesses execute successful events using tech.</p>
								<ul class="ftco-footer-social p-0">
		              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><span class="ion-logo-twitter"></span></a></li>
		              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><span class="ion-logo-facebook"></span></a></li>
		              <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><span class="ion-logo-instagram"></span></a></li>
		            </ul>
							</div>
							<div class="col-md-8">
								<div class="row justify-content-center">
									<div class="col-md-12 col-lg-10">
										<div class="row">
											<div class="col-md-6 mb-md-0 mb-4">
												<h2 class="footer-heading">Event Consultancy</h2>
												<ul class="list-unstyled">
												<li class="py-1 d-block">e-Ticket Sale</li>
												<li class="py-1 d-block">Events Management</li>
												
												</ul>
											</div>

											<div class="col-md-6 mb-md-0 mb-4">
												Questions or enquiries? <a href="<?php echo ROOT_URL; ?>?controller=contact">You can send us a message</a>
												<p style="color:white;">You can also call us on +234 81 540 54682</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt-md-5">
							<div class="col-md-12">
								<p class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					  Copyright &copy;<script>document.write(new Date().getFullYear());</script>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
 <!-- Countdown jquery -->
 <script src="assets/js/jquery.countdown.min.js"></script>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.easing.1.3.js"></script>
  <script src="assets/js/jquery.waypoints.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script>
  <script src="assets/js/jquery.animateNumber.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <script src="assets/js/scrollax.min.js"></script>
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script> -->
  <script src="assets/js/google-map.js"></script>
  <script src="assets/js/main.js"></script>

 


  <!-- Carousel Script for multiple items -->
	 	<script src="assets/js_cmi/jquery-3.3.1.min.js"></script>
		<script src="assets/js_cmi/jquery-migrate-3.0.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
        <script src="assets/js_cmi/jquery.backstretch.min.js"></script>
        <script src="assets/js_cmi/wow.min.js"></script>
        <script src="assets/js_cmi/scripts.js"></script>
    
  </body>
</html>