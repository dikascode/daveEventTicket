<?php
//ajax for search bar

 //include config
 include('config.php');

 $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

 $string = $_POST['eventOutput'];

 //write query

 $searh_query = "SELECT id, name, date FROM events  where name like '%$string%' ";
 $result = mysqli_query($connection, $searh_query);

 if ($result){

         $row = $result->fetch_all(MYSQLI_ASSOC); 

	if (strlen($string) > 0) {

	foreach ($row as $key => $value) {

		if (strlen($value['name']) > 0) {

?>


<div style="background-color: rgba(0, 0, 0, 0.7); padding: 10px; margin-bottom: 1%; line-height: 15px; min-width:200px;">
	<a href="<?php echo ROOT_PATH; ?>/events/view/<?php echo $value['id']; ?>">
    <p style="font-weight: bold; margin-top: 1px; margin-bottom: 5px; color:white;"><?php echo $value['name']; ?></p>
    <p style="font-style: italic; margin-top: 1px; margin-bottom: 1px;"><?php echo date('d F, Y', strtotime($value['date'])); ?></p>
   </a>
	
</div>

<?php } } } }?>

