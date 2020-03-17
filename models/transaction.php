<?php


    class TransactionModel extends Model{
       
        public function Index () {

            $id = $_SESSION['e_no_concern_u'];


            $this->query('SELECT * FROM tickets, events WHERE tickets.event_id = events.id AND tickets.event_id = :id');
            $this->bind(':id', $id);
            $rows = $this->resultSet();
            
            


            //for flutterwave
        
            if (isset($_GET['txref'])) {
                $ref = $_GET['txref'];
                $amount = $_GET['amt']; //Correct Amount from Server
                $currency = $_GET['cur']; //Correct Currency from Server
                $name = $_GET['name'];
                
        
                $query = array(
                    "SECKEY" => "FLWSECK_TEST-43447f6d36fea2e95bef93811139fcb8-X",
                    "txref" => $ref
                );
        
                $data_string = json_encode($query);
                        
                $ch = curl_init('https://api.ravepay.co/flwv3-pug/getpaidx/api/v2/verify');                                                                      
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                              
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
                $response = curl_exec($ch);
        
                $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
                $header = substr($response, 0, $header_size);
                $body = substr($response, $header_size);
        
                curl_close($ch);
        
                $resp = json_decode($response, true);
                
        
                $paymentStatus = $resp['data']['status'];
                $tnx_ref = $resp['data']['txref'];
                $chargeResponsecode = $resp['data']['chargecode'];
                $chargeAmount = $resp['data']['amount'];
                $chargeCurrency = $resp['data']['currency'];
                $cust_email = $resp['data']['custemail'];
                $cust_number = $resp['data']['custphone'];
                $cust_name = filter_var($name, FILTER_SANITIZE_STRING);
                $paymentType = $resp['data']['paymenttype'];
                $custIP = $resp['data']['ip'];
                $orderDate = $resp['data']['created'];
        
        
                // echo "<pre>";
                // print_r($resp['data']);
                // echo "</pre>";
        
        
                //sessions for customer
        
                $_SESSION['cust_email']     = $cust_email;
                $_SESSION['cust_number']    = $cust_number;
                $_SESSION['cust_name']      = $cust_name;
                $_SESSION['transaction_ref'] = $tnx_ref;
                
        
                if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency) && isset($_SESSION['ticket_total_price'])) {
        
        
                   // insert into orders table
                   $this->query("INSERT INTO orders (order_amount, order_transaction, order_status, order_currency, cust_email, cust_number, cust_name, payment_type, cust_ip, order_date)
                   VALUES(:chargeAmount, :tnx_ref, :paymentStatus, :chargeCurrency, :cust_email, :cust_number, :cust_name, :paymentType, :custIP, :orderDate)");

                    $this->bind(':chargeAmount', $chargeAmount);
                    $this->bind(':tnx_ref', $tnx_ref);
                    $this->bind(':paymentStatus', $paymentStatus);
                    $this->bind(':chargeCurrency', $chargeCurrency);
                    $this->bind(':cust_email', $cust_email);
                    $this->bind(':cust_number', $cust_number);
                    $this->bind(':cust_name', $cust_name);
                    $this->bind(':paymentType', $paymentType);
                    $this->bind(':custIP', $custIP);
                    $this->bind(':orderDate', $orderDate);

                    $this->execute();
        
                   //Obtain the last inserted id
                   if($this->lastInsertId()) {

                    $last_id = $this->lastInsertId();
                    //insert into reports and send mail to customer


                    $ticket_value = $_SESSION['ticket_data'];
                    

                        foreach($ticket_value as $key => $value){
                               
                        if($value > 0) {
                        //Generate random 10 unique digits
                        $ticket_number = rand(0, 10000000000);

                        // insert into reports table

                         $this->query("INSERT INTO reports (event_id, order_id, ticket_id, ticket_price, ticket_name, ticket_quantity, ticket_number, cust_email, cust_number, cust_name, order_date, payment_status, event_time, event_location, event_date)
                         VALUES(:id, :last_id, :ticket_id, :ticket_price, :ticket_name, :ticket_quantity, :ticket_number, :cust_email, :cust_number, :cust_name, :order_date, :payment_status, :event_time, :event_location, :event_date)");
         
                        $this->bind(':id', $id);
                        $this->bind(':ticket_id', $rows[$key-1]['ticket_id']);
                        $this->bind(':last_id', $last_id);
                        $this->bind(':ticket_price', $rows[$key-1]['price']);
                        $this->bind(':ticket_name', $rows[$key-1]['class']);
                        $this->bind(':ticket_quantity', $value);
                        $this->bind(':ticket_number', $ticket_number);
                        $this->bind(':cust_email', $cust_email);
                        $this->bind(':cust_number', $cust_number);
                        $this->bind(':cust_name', $cust_name);
                        $this->bind(':order_date', $orderDate);
                        $this->bind(':payment_status', $paymentStatus);
                        $this->bind(':event_time', date('h:i A', strtotime($rows[$key-1]['date'])));
                        $this->bind(':event_location', $rows[$key-1]['location']);
                        $this->bind(':event_date', date('d F, Y', strtotime($rows[$key-1]['date'])));
                

                        $this->execute();

                        /******************************SEND EMAIL TO CLEINT***************************** */

                        for($i=1; $i<=$value; $i++) {
                        
                        

                       
                        $subject = "{$cust_name}, Here is your {$rows[$key-1]['name']} Ticket Details";
                        $time = date('h:i A', strtotime($rows[$key-1]['date']));
                        $date = date('d F, Y', strtotime($rows[$key-1]['date']));
                        $price = '&#8358; '. number_format($rows[$key-1]['price']);


                        /*********************************QR Code Testing ********************************************* */
                        $price_for_display = number_format($rows[$key-1]['price']);
                        
                        $qr_text = "Name: ". $cust_name . ". Number: ". $cust_number. ". Event: " . $rows[$key-1]['name']. ". Ticket Class: " . $rows[$key-1]['class'] . ". Ticket Number: " . $ticket_number . ". Ticket Price:N " . $price_for_display . "";

                        $qrImgName = "YouConnect".rand();
                        //$final ="This is Dika TESTing qr testing";
                        //$dev = " ...Develop By Ravi Khadka";
                        $qrs = QRcode::png($qr_text,"classes/userQr/$qrImgName.png","H","3","3");
                        $qrimage = $qrImgName.".png"; 
                        //$workDir = $_SERVER['HTTP_HOST'];
                        // $qrlink = $workDir."/qrcode".$qrImgName.".png";

                        $path = "classes/userQr/{$qrimage}";
            
                        // echo "<img width='300px' src='{$path}' alt=''>";


                        $htmlBody = "
                                    <div style='width:650px; height:600px; padding:2%;'>
                                        <div style='width:45%; box-sizing: border-box; height:100%; float:left; border-left: 5px red solid; border-bottom: 5px red solid; border-top:5px red solid; '>
                                        <img style='margin-top: 15%; margin-left: 7%' width='250px' src='cid:Ticket_image' alt='{$rows[$key-1]['class']} QRCode'>
                                        </div>

                                        <div style='width:45%; height:100%; float:left; box-sizing: border-box; background-color:black; padding:1%;'>
                                        <h3 align=center style='color:white;'>{$rows[$key-1]['name']} Ticket Details</h3>
                                        <p align=left style='color:white;'<span style='font-weight:bold;'>Ticket Class: {$rows[$key-1]['class']}</span></p> <hr />
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Ticket Number:</span> {$ticket_number} </p> <hr />
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Ticket Price:</span> {$price} </p> <hr />
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Ticket Holder:</span> {$cust_name} </p> <hr />
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Holder Number:</span> {$cust_number} </p> <hr />
                                        
                                        <h3 align=center style='color:white;'>Event Details</h3>
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Location:</span> {$rows[$key-1]['location']}</p> <hr />
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Event Date:</span> {$date}</p> <hr />
                                        <p align=left style='color:white;'><span style='font-weight:bold;'>Event Time:</span> {$time}</p> <hr />

                                        <p align=center style='color:white;'><span style='color:red'>Please come along with your ticket to the event.</span> Contact us for questions and concerns on: 081350*****</p>
                                        </div>
                                    </div>";
                        

                        Mails::sendEmail($cust_email, $subject, $htmlBody, $path);

                        }
                        
                        

                        }

                    }
                   
                }


                   
                   


                
                


    }
    
    }
    session_destroy();
    unset($_GET);
    return;
    
    }
}


?>