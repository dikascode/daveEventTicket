<?php

    class HomeModel extends Model {
        public function Index() {
            $this->query('SELECT * FROM events ORDER BY id DESC');
            $rows = $this->resultSet();

            // if(isset($_POST['submit']) && $_POST['submit']){
            //     echo "Hi I got here";
            // }

            return $rows;

        
        }
    }

?>