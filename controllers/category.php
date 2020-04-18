<?php
    class Category extends Controller {
        protected function view() {
            $viewmodel = new CategoryModel();
            $this->returnView($viewmodel->view(), true);
        }
    }

?>