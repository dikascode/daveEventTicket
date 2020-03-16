<?php 

    if(count($viewmodel) > 0):
    
?>

<div>

<section class="hero-wrap hero-wrap-2" style="background-image: url('assets/images/<?php echo $viewmodel[0]['big_image']; ?>');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text align-items-end">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs mb-2"><span class="mr-2"><a href="<?php echo ROOT_PATH; ?>">Home <i class="ion-ios-arrow-forward"></i></a></span> <span><?php echo $viewmodel[0]['name']; ?> <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-0 bread"><?php echo $viewmodel[0]['name']; ?></h1>
          </div>
        </div>
      </div>
</section>
<div class="row">
    <div class="col-md-12">
    <h1>Event Description</h1>
    </div>
</div>
<div class="row">
    
    <div class="col-lg-7 col-sm-push-5">
        <div class="event_desc">
        <p><?php echo $viewmodel[0]['description']; ?></p>
        </div>

        <div class="date_time">
        <p>Date</p>
        <h4><?php echo date('d F, Y', strtotime($viewmodel[0]['date'])); ?></h4>

        <p>Time</p>
        <h4><?php echo date('h:i A', strtotime($viewmodel[0]['date'])); ?></h4>

        <p>Venue</p>
        <h4><?php echo $viewmodel[0]['location']; ?></h4>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="ticketClass">
            <h4>Pricing</h4>
            <form method="post" action="<?php $_SERVER['PHP_SELF'];  ?>">
            <?php foreach($viewmodel as $item): ?>
            <div class="row priceCat">
                <div class="col-md-4 col-sm-5"><?php echo $item['class']; ?></div>
                <div class="col-md-4 col-sm-4">&#8358; <?php echo number_format($item['price']); ?></div>
                <div class="col-md-4 col-sm-3">
                    <div class="form-group">
                    
                    <input class="form-control" type="number" name="number_<?php echo $item['ticket_id']; ?>" min="0" max="20" value="0" />
                    </div> 
                </div>
            </div> <hr />
            <?php 
        
                endforeach; ?>
            <div class="row">
                <div class="form-group col-md-3 col-sm-3">
                <input style="background-color:#FDBE34; color:  ; font-weight:bold;" class="btn" type="submit" name="submit" value="SUBMIT" />
                </div>

            </div>

            </form>

        </div>
    </div>
</div>
 

    
        

  
</div>

<?php else: ?>

<div>
<div class="row">
    <div class="col-md-12">
    <h1>This Event doesn't have any Ticket for sale</h1>
    <p>Please go back <a href="<?php echo ROOT_URL; ?>">HOME</a></p>
    </div>
</div>
</div>

<?php endif; ?>