<?php


    class EventModel extends Model{
        public function Index() {
            $this->query('SELECT * FROM events ORDER BY id DESC');
            $rows = $this->resultSet();

            return $rows;
        }


       

        public function view() {

            /**************************TEST****************** */

            
            /**************************TEST*********************** */



            if(!isset($_SESSION['ticket_page'] )){

            $this->query('SELECT * FROM tickets, events WHERE tickets.event_id = events.id AND tickets.event_id = :id ORDER BY id desc');
            $this->bind(':id', $_GET['id']);
            $rows = $this->resultSet();


            //Sanitize POST from views page
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $i = 1;
            $j = 1;

            if($post['submit']) {

                //check if at least 1 ticket is selected
                
                if(in_array(1, $post) || in_array(2, $post) || in_array(3, $post) || in_array(4, $post) || in_array(5, $post) || in_array(6, $post) || in_array(7, $post) || in_array(8, $post) || in_array(9, $post) || in_array(10, $post)) {

                    foreach ($post as $value) {
                        $_SESSION['Tnumber_'.$i.''] =  $value;

                        $i++;
                        
                    }

                } else {
                    Messages::setMsg('You Have To Pick A Ticket To Proceed', 'error');
                }

            

                //filter off non numerics 
                $filtered_array = array_filter($_SESSION, 'is_numeric');

                //Caluclate the price for each ticket bought and assign value to a session array

                if(count($filtered_array) < count($post)) {
                
                    foreach ($filtered_array as $value) {
                        $_SESSION['ticket_data'][$j] = $value;
                        $_SESSION['ticket_price'][$j] = $filtered_array['Tnumber_'.$j.''] * $rows[$j-1]['price'];
                        $_SESSION['total_price'] += $_SESSION['ticket_price'][$j];

                        $j++;
                    }
                }

                // echo "<pre>";
                // print_r($filtered_array);
                // print_r($_SESSION);
                // echo "</pre>";

                if(isset($_SESSION['total_price']) && $_SESSION['total_price'] > 0 ) {
                    header('Location: '.ROOT_PATH."/events/ticketSale/".$_GET['id']);

                }
                

            }
            
            
            return $rows;
        } else {
            header('Location: '.ROOT_PATH);
        }
        
        }


        public function ticketSale() {

            if($_SESSION['total_price']) {

            
            $_SESSION['e_no_concern_u'] = $_GET['id'];
            $_SESSION['ticket_page'] = "Arrived Here";
            $this->query('SELECT * FROM tickets, events WHERE tickets.event_id = events.id AND tickets.event_id = :id');
            $this->bind(':id', $_GET['id']);
            $rows = $this->resultSet();
               
            return $rows;

            } else {
                header('Location: '.ROOT_PATH);
            }
        }



        public function confirm() {
            //Sanitize POST from views page
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($post['submit']) {
                # code...  
                $this->query('SELECT * FROM reports WHERE event_id = :event_id AND ticket_number = :t_number');

                //select subtring from the inputted ticket details
                $ticket_number = substr(trim($post['t_number']), 15, 10);

                $this->bind(':event_id', $post['event_id']);
                $this->bind(':t_number', $ticket_number);
                $row = $this->resultSet();

                // echo $ticket_number;


                $this->query('SELECT * FROM confirmed_ticket WHERE ticket_number = :t_number');
                $this->bind(':t_number', $ticket_number);

                $verified_ticket = $this->resultSet();

                if($post['event_id'] == '' || $ticket_number == ''){
                    Messages::setMsg('Please select an event and input the ticket details to proceed.', 'error');
                } else {

                

                    if (isset($row[0]['ticket_number']) && $row[0]['ticket_number']) {
                        
                        if(isset($verified_ticket[0]['ticket_number']) && $verified_ticket[0]['ticket_number'] == $ticket_number){


                            Messages::setMsg('Uh, something is OFF! This Ticket Number has been verified already for this event. Verified name is '. $verified_ticket[0]['cust_name'] . ' with number '.$row[0]['cust_number'], 'error');
                        
                        }else{
                        // echo "<pre>";
                        // print_r($row);
                        // echo "</pre>";
                            Messages::setMsg('Ticket Number Valid And Purchased by '.$row[0]['cust_name'].' with number '.$row[0]['cust_number'], 'T');

                            $this->query("INSERT INTO confirmed_ticket(ticket_number, cust_name, cust_number) VALUES(:t_number, :cust_name, :cust_number)");
                            $this->bind(':t_number', $ticket_number);
                            $this->bind(':cust_name', $row[0]['cust_name']);
                            $this->bind(':cust_number', $row[0]['cust_number']);
                            $this->execute();

                        }

                        
                    }else {
                        Messages::setMsg('This Ticket Number is INVALID. Please Ensure you selected the right event name', 'error');
                    }

                }
            }
          


        }


    }

?>