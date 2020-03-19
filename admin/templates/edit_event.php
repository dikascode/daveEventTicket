

<div id="page-wrapper">

<div class="container-fluid">






<div class="col-md-12">

<div class="row">
<h1 class="page-header">
  Edit Event

</h1>

<?php 

$crsf = form_protect();


  if(isset($_GET['id']))  {

    $query = query('SELECT * FROM events WHERE id =' . escape_string($_GET['id']).  ' ' );
    confirm($query);

    while($row = fetch_array($query)) {
      $event_title            = escape_string($row['name']);
      $event_venue            = escape_string($row['location']);
      $date_time              = escape_string($row['date']);
      $cat_id                 = escape_string($row['cat_id']);
      $event_desc             = escape_string($row['description']);
      $small_image            = display_image($row['small_image']);
      $big_image              = display_image($row['big_image']);
    }

  }

  //update function
  update_event();
  
?>

</div>
              


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="Event-title">Event Title </label>
        <input type="text" name="event_title" class="form-control" value="<?php echo $event_title; ?>">
        <input type="hidden" name="crsf" value="<?php echo $crsf; ?>">
      
  </div>

  <div class="form-group">
      <label for="event_name">Event Venue </label>
        <input type="text" name="event_venue" class="form-control" value="<?php echo $event_venue; ?>">
    </div>

    <div class="form-group">
    <label for="event_name">Event Date/Time </label>
        <input type="text" name="event_date" class="form-control"  value="<?php echo $date_time;  ?>">
    </div>


    <div class="form-group">
          <label for="Event-title">Event Description</label>
      <textarea name="event_desc" id="" cols="30" rows="10" class="form-control"><?php echo $event_desc; ?></textarea>
    </div>

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

    
    <div class="form-group">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
    </div>


    <!-- Event Categories-->

    <div class="form-group">
        <label for="Event-title">Event Category</label>
  
        <select name="cat_id" id="" class="form-control">

        <!-- Getting a default select option by invoking the Event category function -->
            <option value="<?php echo $cat_id ?>"><?php echo show_event_category_title ($cat_id) ?></option>
            <?php get_categories_add_event_page(); ?>
          
        </select>
</div>



<!-- Event Tags -->

    <!-- <div class="form-group">
          <label for="Event-title">Event Keywords</label>
          <hr>
        <input type="text" name="Event_tags" class="form-control">
    </div> -->

    <!-- Event Image -->
    <div class="form-group">
        <label for="Event-title">Event Big Image <span style="font-size: 10px; color:red;">1920x1280 resolution</span></label>
        <input type="file" name="file"><br>
        <img width="200" src = "<?php echo $big_image ?>" alt="">
      
    </div>


    <div class="form-group">
        <label for="Event-title">Event Small Image <span style="font-size: 10px; color:red;">700x480 resolution</span></label>
        <input type="file" name="file2"><br>
        <img width="200" src = "<?php echo $small_image ?>" alt="">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>



              



</div>
<!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

