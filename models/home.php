<?php

    class HomeModel extends Model {
        public function Index() {
            $this->query('SELECT * FROM events ORDER BY id DESC');
            $rows = $this->resultSet();
            // echo "<pre>";
            // print_r($rows);
            // echo "</pre>";

            return $rows;
        }
    }

?>