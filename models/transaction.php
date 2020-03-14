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
                $cust_name = $name;
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
                        
                        $ticket_number = mt_rand(0, 10000000000);

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

                       
                        $subject = "{$cust_email}, Here is your {$rows[$key-1]['name']} Ticket Details";
                        $time = date('h:i A', strtotime($rows[$key-1]['date']));
                        $date = date('d F, Y', strtotime($rows[$key-1]['date']));
                        $price = '&#8358; '. number_format($rows[$key-1]['price']);
                        $htmlBody = "
                                    <div style='position; relative; width:600px; height:600px; padding:2%; border: 5px #00043C solid;'>
                                        <div style='width:45%; float:left;'>
                                            <p style='position:absolute; margin:auto;'>Holla, this space is for QR Code</p>
                                        </div>

                                        <div style='width:45%; float:left; background-color:black; color:white; position:absolute; margin:auto; padding:2%;'>
                                        <h3 align=center>{$rows[$key-1]['name']} Ticket Details</h3>
                                        <p align=center><span style='font-weight:bold;'>Ticket Class: {$rows[$key-1]['class']}</span></p>
                                        <p align=center>Ticket Number: {$ticket_number} </p>
                                        <p align=center>Ticket Price: {$price} </p>
                                        <p align=center>Ticket Holder: {$cust_name} </p>
                                        <p align=center>Holder Number: {$cust_number} </p>
                                        
                                        <p align=center style='font-weight:bold;'>Event Details:</p>
                                        <p align=center>Location: {$rows[$key-1]['location']}</p>
                                        <p align=center>Event Date: {$date}</p>
                                        <p align=center>Event Time: {$time}</p>

                                        <p align=center>Contact us for questions and concerns on: 081350*****</p>
                                        </div>
                                    </div>";
            
                        Mails::sendEmail($cust_email, $subject, $htmlBody);

                        }
                        
                        

                        }

                    }

                    
                    if($this->lastInsertId()) {
                        //redirect
                        // header('Location: '.ROOT_URL);

                        // echo "Hi, we made it here.";
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