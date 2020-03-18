     
      <div id="page-wrapper">

            <div class="container-fluid">

             <div class="row">

<h1 class="page-header">
   All Reports

</h1>

<h2 class="bg-success"><?php display_message(); ?></h2>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Report Id</th>
           <th>Event Id</th>
           <th>Ticket Id</th>
           <th>Order Id</th>
           <th>Price</th>
           <th>Ticket Name</th>
           <th>Ticket Quantity</th>
           <th>Event Name</th>
           <th>Client Name</th>
           <th>Email</th>
           <th>Order Date</th>
           <th>Status</th>
           <th></th>
      </tr>
    </thead>
    <tbody>

    <?php get_reports(); ?> 
    
   </tbody>
</table>











                
                 


             </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


