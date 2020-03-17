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
    <h1>Ticket Details</h1>
    <h4>Ticket information will be sent to you</h4>
    </div>
</div>
<div class="row">
    
    <div class="col-lg-7 col-sm-push-5" style="background-color:#F5F5F5; padding:2%;">
        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control name" id="name" type="text" placeholder="Please Enter Your Name" name="name" />
            </div>

            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" id="email" type="email" placeholder="Please Enter Your Email" name="email" />
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6 col-sm-6">
                <input class="form-control" id="number" type="text" placeholder="Please Enter Your Phone Number" name="number" />
            </div>
        </div>
    </div>

    <div class="col-lg-5" style="margin-bottom: 2%;">
        <div class="ticketClass">
            <h4>Ticket Order</h4>
            <?php

            $ticket_value = $_SESSION['ticket_data'];
                

                foreach($ticket_value as $key => $value):

                if($value > 0):

                
            
            ?>
            <div class="row priceCat">
                <div class="col-md-6 col-sm-6"><?php echo $value. ' x ' .  $viewmodel[$key - 1]['class']; ?></div>
                <div class="col-md-6 col-sm-6">&#8358; <?php echo number_format($_SESSION['ticket_price'][$key]); ?></div>
                
            </div> <hr />
            <?php 
                endif; 
                endforeach;

                

                // print_r($_SESSION['ticket_data']);
                // print_r($_SESSION['ticket_price']);
                
            ?>
             <div class="row priceCat">
                <div class="col-md-6 col-sm-6">SUBTOTAL</div>
                <div class="col-md-6 col-sm-6">&#8358; <?php echo number_format($_SESSION['total_price']); ?></div> 
            </div><hr />

            <div class="row priceCat">
                <div class="col-md-6 col-sm-6">Service Charge</div>
                <div class="col-md-6 col-sm-6">&#8358; <?php echo number_format($service_charge = $_SESSION['total_price'] * 0.020); ?></div> 
            </div>
            <span style="font-size: 10px;">(Online Payment Convenience Fee)</span> <hr />

            <div class="row priceCat">
                <div class="col-md-6 col-sm-6">Total Price</div>
                <div class="col-md-6 col-sm-6">&#8358; <?php echo number_format($_SESSION['ticket_total_price'] = $_SESSION['total_price'] + $service_charge); ?></div> 
            </div>

            <div class="row">
                <div class="form-group col-md-3 col-sm-3">

                <?php

                echo flutter_wave();

                ?>
                
                </div>

            </div>

            

        </div>
    </div>
</div>
 
</div>