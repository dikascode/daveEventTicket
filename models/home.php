<?php
echo __DIR__;
    class HomeModel extends Model {
        public function Index() {
            $this->query('SELECT * FROM events ORDER BY id DESC');
            $rows = $this->resultSet();
            return $rows;

        
        }
    }

?>