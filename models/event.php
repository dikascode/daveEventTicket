<?php

    class EventModel extends Model{
        public function Index() {
            $this->query('SELECT * FROM events ORDER BY create_date DESC');
            $rows = $this->resultSet();
            // echo "<pre>";
            // print_r($rows);
            // echo "</pre>";

            return $rows;
        }


        public function add() {
            //Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($post['submit']) {

                if($post['title'] == '' || $post['body'] == '' || $post['link'] == '') {
                    Messages::setMsg('Please Fill In All Fields', 'error');
                    return;
                 }
                //insert into database
                $this->query('INSERT INTO shares (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
                $this->bind(':title', $post['title']);
                $this->bind(':body', $post['body']);
                $this->bind(':link', $post['link']);
                $this->bind(':user_id', $_SESSION['user_data']['id']);

                $this->execute();

                //Verify

                if($this->lastInsertId()) {
                    //redirect
                    header('Location: '.ROOT_URL. '?controller=shares');
                }
            }

            return;
        }



        public function view() {

            if(!isset($_SESSION['ticket_page'] )){

            

            $this->query('SELECT * FROM tickets, events WHERE tickets.event_id = events.id AND tickets.event_id = :id');
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

                if(isset($_SESSION['total_price']) && $_SESSION['total_price'] > 0 ) {
                    header('Location: '.ROOT_PATH."?controller=events&action=ticketSale&id=".$_GET['id']);

                }
                
                // echo "<pre>";
                // print_r($filtered_array);
                // print_r($_SESSION);
                // echo "</pre>";

            }
            
            
            return $rows;
        } else {
            header('Location: '.ROOT_PATH);
        }
        
        }


        public function ticketSale() {
            $_SESSION['ticket_page'] = "Arrived Here";
            $this->query('SELECT * FROM tickets, events WHERE tickets.event_id = events.id AND tickets.event_id = :id');
            $this->bind(':id', $_GET['id']);
            $rows = $this->resultSet();
                // echo "<pre>";
                // print_r($_SESSION);
                // echo "</pre>";
            return $rows;
        }
    }

?>