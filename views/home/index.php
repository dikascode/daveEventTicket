<?php session_destroy(); ?>
<div class="hero-wrap">
	    <div class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image:url(assets/images/bg_1.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text align-items-center justify-content-center">
		          <div class="col-md-12 ftco-animate">
		          	<div class="text w-100 text-center">
		          		<h2>We're here to help you</h2>
			            <h1 class="mb-3">Event Planner</h1>
		            </div>
		          </div>
		        </div>
	        </div>
	      </div>

	      <div class="slider-item" style="background-image:url(assets/images/bg_2.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text align-items-center justify-content-center">
		          <div class="col-md-12 ftco-animate">
		          	<div class="text w-100 text-center">
		          		<h2>Best Event Planner in the World</h2>
			            <h1 class="mb-3">We Make Events a Success</h1>
		            </div>
		          </div>
		        </div>
	        </div>
	      </div>

	      <div class="slider-item" style="background-image:url(assets/images/bg_3.jpg);">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text align-items-center justify-content-center">
		          <div class="col-md-12 ftco-animate">
		          	<div class="text w-100 text-center">
		          		<h2>We Plan and It's a Goal</h2>
			            <h1 class="mb-3">Most Innovative Event Planner</h1>
		            </div>
		          </div>
		        </div>
	        </div>
	      </div>
		</div>
		
		   <div>
		
	 <!-- Carousel fro multiple items -->
	 <div class="top-content" style="margin-bottom:2%; margin-top:2%;">
        	<div class="container-fluid">
        		<div id="carousel-example" class="carousel slide" data-ride="carousel">
        			<div class="carousel-inner row w-100 mx-auto" role="listbox">
					<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
					<img src="assets/images/<?php echo $viewmodel[0]['small_image']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo $viewmodel[0]['small_image']; ?>"> <br />
							<a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>?controller=events&action=view&id=<?php echo $viewmodel[0]['id']; ?>">Buy Ticket</a>
					</div>
					<?php for($i=1; $i<count($viewmodel); $i++ ){ ?>
            			<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
							<img src="assets/images/<?php echo $viewmodel[$i]['small_image']; ?>" class="img-fluid mx-auto d-block" alt="<?php echo $viewmodel[$i]['small_image']; ?>"> <br />
							<a class="btn btn-primary" href="<?php echo ROOT_PATH; ?>?controller=events&action=view&id=<?php echo $viewmodel[$i]['id']; ?>">Buy Ticket</a>
						</div>
					<?php }?>
        			</div>
        			<a class="carousel-control-prev" href="#carousel-example" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carousel-example" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
        		</div>
        	</div>
        </div>
	
	</div>
	  </div>

 
	
	
		
    

