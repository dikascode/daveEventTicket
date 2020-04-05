<div class="container-fluid">




  <div class="col-md-12">

  <div class="row">
  <h1 class="page-header">
    Add Event

  </h1>

  <?php add_event() ?>

  <?php $crsf = form_protect(); ?>
  </div>
                


  <form action="" method="post" enctype="multipart/form-data">


  <div class="col-md-8">

  <div class="form-group">
      <label for="event_name">Event Name </label>
          <input type="text" name="event_name" class="form-control" placeholder="Make it as concise as possible. That is: NOT TOO LONG">
          <input type="hidden" name="crsf" value="<?php echo $crsf; ?>">
        
    </div>

    <div class="form-group">
      <label for="event_name">Event Venue </label>
        <input type="text" name="event_venue" class="form-control" placeholder="Make it as concise as possible. That is: NOT TOO LONG">
    </div>

    <div class="form-group">
    <label for="event_name">Event Date/Time </label>
        <input type="text" name="event_date" class="form-control" placeholder="Please input date and time in this format: Y-M-D Hr:Min:Sec">
    </div>

      <div class="form-group">
            <label for="event_name">Event Description</label>
        <textarea name="event_desc" id="" cols="30" rows="10" class="form-control"></textarea>
      </div>

    <!-- Event Image -->
      <div class="form-group">
          <label for="event_name">Event Big Image <span style="font-size: 10px; color:red;">1920x1280 resolution</span></label>
          <input type="file" name="file">
        
      </div>

      <div class="form-group">
          <label>Event Small Image <span style="font-size: 10px; color:red;">700x480 resolution</span></label>
          <input type="file" name="file2">
        
      </div>


      <!-- <div class="form-group row">

        <div class="col-xs-3">
          <label for="product-price">Product Price</label>
          <input type="number" name="product_price" min="50" max="30000" class="form-control" size="60">
        </div>
      </div> -->

  </div><!--Main Content-->


  <!-- SIDEBAR-->


  <aside id="admin_sidebar" class="col-md-4">

      
      <div class="form-group">
          <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
      </div>


      <!-- Event Categories-->

      <div class="form-group">
          <label for="event_name">Event Category</label>
    
          <select name="event_category_id" id="" class="form-control">
              <option value="">Select Category</option>
              <?php get_categories_add_event_page() ?>
            
          </select>
      </div>


      <!-- Product Brands-->

<!-- 
      <div class="form-group">
        <label for="event_name">Product Quantity</label>
          <input type="number" min="1" max="100" class="form-control" name="product_quantity">
      </div> -->

  <!-- Product Tags -->

  </aside><!--SIDEBAR-->


      
  </form>



                



  </div>
  <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

