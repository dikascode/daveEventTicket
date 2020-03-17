<?php session_destroy(); ?>

<?php

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);


?>
<div class="row">
	    <div class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image:url(assets/images/pic1.jpg);">
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

	      <div class="slider-item" style="background-image:url(assets/images/pic2.jpg);">
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

	      <div class="slider-item" style="background-image:url(assets/images/admission-2974645_1920.jpg);">
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
	<hr>
	 <!-- Carousel fro multiple items -->
	 <div class="top-content" style="margin-top:2%;">
        	<div class="container-fluid">
        		<div id="carousel-example" class="carousel slide" data-ride="carousel">
        			<div class="carousel-inner row w-100 mx-auto" role="listbox">
					<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3 active">
					<div  style="background-color: #00043C;">
					<?php

					$tickets_query = "SELECT * FROM tickets LEFT JOIN events ON tickets.event_id = events.id WHERE tickets.event_id = {$viewmodel[0]['id']}";
					$result = mysqli_query($connection, $tickets_query);

					?>
					<img src="assets/images/<?php echo $viewmodel[0]['small_image']; ?>" class="img-fluid mx-auto" alt="<?php echo $viewmodel[0]['small_image']; ?>"> <br />
					<span style="margin-left: 5%; font-weight: bold; color:#FDBE34;"><?php echo substr($viewmodel[0]['name'], 0, 25); ?></span> <br>
					<span style="margin-left: 5%; color:white;"><i class="fa fa-map-marker"></i> <?php echo substr($viewmodel[0]['location'], 0, 30); ?></span> <br>
					<?php $rows = mysqli_fetch_array($result); if($rows['event_id'] == $viewmodel[0]['id']) { ?>
					<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format($row['price']); ?></span> <br>
					<?php }else { ?>
						<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format(000); ?></span> <br>
					<?php } ?>
					<a style="margin-left: 5%; background-color: #FDBE34; color:#00043C;" class="btn" href="<?php echo ROOT_PATH; ?>?controller=events&action=view&id=<?php echo $viewmodel[0]['id']; ?>">Buy Ticket</a>
					</div>
					</div>
					<?php 
					
					for($i=1; $i<6; $i++ ){

					$tickets_query = "SELECT * FROM tickets LEFT JOIN events ON tickets.event_id = events.id WHERE tickets.event_id = {$viewmodel[$i]['id']}";
					$result = mysqli_query($connection, $tickets_query);
				
					?>
						<div class="carousel-item col-12 col-sm-6 col-md-4 col-lg-3">
						<div  style="background-color:#00043C;">
							<img src="assets/images/<?php echo $viewmodel[$i]['small_image']; ?>" class="img-fluid mx-auto" alt="<?php echo $viewmodel[$i]['small_image']; ?>"> <br />
							<span style="margin-left: 5%; font-weight: bold;  color:#FDBE34;"><?php echo substr($viewmodel[$i]['name'], 0, 25); ?></span> <br>
							<span style="margin-left: 5%; color:white;"><i class="fa fa-map-marker"></i> <?php echo substr($viewmodel[$i]['location'], 0, 25); ?></span> <br>
							<?php $rows = mysqli_fetch_array($result); if($rows['event_id'] == $viewmodel[$i]['id']) { ?>
							<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format($rows['price']); ?></span> <br>
							<?php }else{ ?>
							<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format(0000); ?></span> <br>
							<?php } ?>
							<a style="margin-left: 5%; background-color: #FDBE34; color:#00043C;" class="btn" href="<?php echo ROOT_PATH; ?>?controller=events&action=view&id=<?php echo $viewmodel[$i]['id']; ?>">Buy Ticket</a>
						</div>
						</div>
					<?php }?>
        			</div>
        			<a class="" href="#carousel-example" role="button" data-slide="prev">
						<span aria-hidden="true"></span>
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

<hr>

<div class="row" style="background-color: grey; padding: 2%;">

<div class="row">
	<div class="col-md">
		<h2 style="font-weight: bold; color:#FDBE34">Ongoing Events >>></h2>
	</div>

</div>
<div class="row">
<?php 

for($i=0; $i<6; $i++ ){

	$tickets_query = "SELECT * FROM tickets LEFT JOIN events ON tickets.event_id = events.id WHERE tickets.event_id = {$viewmodel[$i]['id']}";
	$result = mysqli_query($connection, $tickets_query);
	
	
?>
	<div style="margin-bottom: 3%;" class="col-md-6 col-lg-3">
		<div  style="background-color:#00043C; border-radius: 15px;">
			<img src="assets/images/<?php echo $viewmodel[$i]['small_image']; ?>" class="img-fluid mx-auto" alt="<?php echo $viewmodel[$i]['small_image']; ?>"> <br />
			<span style="margin-left: 5%; font-weight: bold;  color:#FDBE34;"><?php echo substr($viewmodel[$i]['name'], 0, 30); ?></span> <br>
			<span style="margin-left: 5%; color:white;"><i class="fa fa-map-marker"></i> <?php echo substr($viewmodel[$i]['location'], 0, 30); ?></span> <br>
			<?php $rows = mysqli_fetch_array($result); if($rows['event_id'] == $viewmodel[$i]['id']) { ?>
			<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format($rows['price']); ?></span> <br>
			<?php } else{ ?>
			<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format(0000); ?></span> <br>
			<?php } ?>
			<a style="margin-left: 5%; background-color: #FDBE34; color:#00043C;" class="btn" href="<?php echo ROOT_PATH; ?>?controller=events&action=view&id=<?php echo $viewmodel[$i]['id']; ?>">Buy Ticket</a>
		</div>
	</div>
	

<?php } ?>
</div>

<div class="row">
	<div class="col-md">
		<a href="<?php echo ROOT_PATH ?>?controller=events" style="font-weight: bold; color:#FDBE34">All Event >>></a>
	</div>

</div>
</div>

	

 
	
	
		
    

