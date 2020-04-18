<?php
    class CategoryModel extends Model {
        public function view() {
            $this->query('SELECT * FROM events WHERE cat_id = :id ORDER BY id DESC');
            $this->bind(':id', $_GET['id']);
            $rows = $this->resultSet();
            if($rows) {
                return $rows;
            }
    }
}

?>