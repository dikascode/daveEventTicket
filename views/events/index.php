<div class="row" style="background-color: grey; padding: 2%;">
<div class="col-md">
<div class="row">
	<div class="col-md">
		<h2 style="font-weight: bold; color:#FDBE34">Ongoing Events >>></h2>
	</div>

</div>
<div class="row">
<?php 
$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
for($i=0; $i<count($viewmodel); $i++ ){

	$tickets_query = "SELECT * FROM tickets LEFT JOIN events ON tickets.event_id = events.id WHERE tickets.event_id = {$viewmodel[$i]['id']}";
	$result = mysqli_query($connection, $tickets_query);

//Compare dates
	if(strtotime($viewmodel[$i]['date']) >= strtotime(date('d F, Y')) ) {
	
	
?>
	<div style="margin-bottom: 3%;" class="col-md-6 col-lg-3">
		<div  style="background-color:#00043C; border-radius: 15px;">
			<img src="../../../assets/images/<?php echo $viewmodel[$i]['small_image']; ?>" class="img-fluid mx-auto" alt="<?php echo $viewmodel[$i]['small_image']; ?>"> <br />
			<span style="margin-left: 5%; font-weight: bold;  color:#FDBE34;"><?php echo substr($viewmodel[$i]['name'], 0, 30); ?></span> <br>
			<span style="margin-left: 5%; color:white;"><i class="fa fa-map-marker"></i> <?php echo substr($viewmodel[$i]['location'], 0, 30); ?></span> <br>
			<?php $rows = mysqli_fetch_array($result); if($rows['event_id'] == $viewmodel[$i]['id']) { ?>
			<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format($rows['price']); ?></span> <br>
			<?php } else{ ?>
			<span class="badge badge-primary" style="margin-left: 5%; color:white;">&#8358; <?php echo number_format(0000); ?></span> <br>
			<?php } ?>
			<span style="margin-left: 5%; color:#FDBE34;"><?php echo date('d F, Y', strtotime($viewmodel[$i]['date'])); ?></span> <br>
			<a style="margin-left: 5%; background-color: #FDBE34; color:#00043C;" class="btn" href="<?php echo ROOT_PATH; ?>/events/view/<?php echo $viewmodel[$i]['id']; ?>">Buy Ticket</a>
		</div>
	</div>
	

<?php }} ?>
</div>
</div>
</div>

<!-- Categories for events -->

<div class="row" style="background-color:grey">
    <div class="col-md" >
        <h2 style="color: white">>>> All Event Categories</h2>
    </div>
</div>
<div class="row" style="background-color:grey">
<?php

$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$cat_query = "SELECT * FROM categories";
$result = mysqli_query($connection, $cat_query);

$categories = array();

while($row = mysqli_fetch_assoc($result)){
    $categories[] = $row;
}

foreach ($categories as $row):
?>

    <div class="col-md-3">
    <a href="<?php echo ROOT_PATH; ?>/category/view/<?php echo $row['cat_id']; ?>">
        <div class="cat_display">
         <?php echo $row['cat_title']; ?> 
        </div>
    </a>
    </div>

<?php endforeach;?>
</div>