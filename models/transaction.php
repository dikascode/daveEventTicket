<?php

    class TransactionModel extends Model{
       
        public function Index () {


            $this->query('SELECT * FROM tickets, events WHERE tickets.event_id = events.id AND tickets.event_id = :id');
            $this->bind(':id', $_GET['id']);
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
        
        
                echo "<pre>";
                print_r($resp['data']);
                echo "</pre>";
        
        
                //sessions for customer
        
                $_SESSION['cust_email']     = $cust_email;
                $_SESSION['cust_number']    = $cust_number;
                $_SESSION['cust_name']      = $cust_name;
                $_SESSION['transaction_ref'] = $tnx_ref;
                
        
                if (($chargeResponsecode == "00" || $chargeResponsecode == "0") && ($chargeAmount == $amount)  && ($chargeCurrency == $currency) && isset($_SESSION['ticket_total_price'])) {
        
                    $total = 0;
                    $item_quantity = 0;
        
        
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
                    $id = $_GET['id'];

                        foreach($ticket_value as $key => $value):
                            
                            if($value > 0) {

                        // insert into reports table

                         $this->query("INSERT INTO reports (event_id, order_id, ticket_price, ticket_name, ticket_quantity)
                         VALUES(:id, :last_id, :ticket_price, :ticket_name,  :ticket_quantity)");
         
                        $this->bind(':id', $id);
                        $this->bind(':last_id', $last_id);
                        $this->bind(':ticket_price', $_SESSION['ticket_price'][$key]);
                        $this->bind(':ticket_name', $rows[$key-1]['class']);
                        $this->bind(':ticket_quantity', $value);
                            }

                        endforeach;

                    
                    
                   
                }


                   
                   


                
                


    }
    
    }

    return;
    session_destroy();
    }
}


?>