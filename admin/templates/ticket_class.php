<div id="page-wrapper">

<div class="container-fluid">





<h1 class="page-header">
Event Ticket Class

</h1>

<h4 class="bg-success"><?php display_message(); ?></h4>


<div class="col-md-4">

<?php add_ticket_class();  ?>

<?php $crsf = form_protect(); ?>

<form action="" method="post">

<div class="form-group">
<label for="category-title">Ticket Class</label>
<input name="class" type="text" class="form-control">
<input name="crsf" type="hidden" value="<?php echo $crsf; ?>">
</div>

<div class="form-group">
<label for="category-title">Ticket Price</label>
<input name="price" type="text" class="form-control">
</div>

<div class="form-group">

<input name="add_class" type="submit" class="btn btn-primary" value="Add Ticket Class">
</div>      


</form>


</div>


<div class="col-md-8">

<table class="table">
<thead>

<tr>
    <th>id</th>
    <th>Title</th>
    <th>Price</th>
</tr>
</thead>


<tbody>
<?php show_ticket_class_in_admin(); ?>
</tbody>

</table>

</div>



</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

