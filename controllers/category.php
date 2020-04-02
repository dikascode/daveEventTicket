<?php
    class Category extends Controller {
        protected function Index() {
            $viewmodel = new CategoryModel();
            $this->returnView($viewmodel->Index(), true);
        }
    }

?>