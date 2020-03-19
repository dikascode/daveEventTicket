<?php add_user(); ?>
  <h1 class="page-header">
      Add User
      <small>Page</small>
  </h1>


<form action="" method="post" enctype="multipart/form-data">

<?php $crsf = form_protect(); ?>

  <div class="col-md-6">

     <div class="form-group">
     
      <input type="file" name="file">
         
     </div>


     <div class="form-group">
      <label for="username">Username</label>
      <input type="text" name="username" class="form-control" >
      <input type="hidden" name="crsf" value="<?php echo $crsf; ?>">
         
     </div>


      <div class="form-group">
          <label for="email">Email</label>
      <input type="text" name="email" class="form-control"   >
         
     </div>

      <div class="form-group">
          <label for="password">Password</label>
      <input type="password" name="password" class="form-control"  >
         
     </div>

      <div class="form-group">


      <input type="submit" name="add_user" class="btn btn-primary pull-right" value="Add User" >
         
     </div>


      

  </div>



</form>





    