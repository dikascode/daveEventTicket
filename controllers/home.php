<?php
echo __DIR__ . "Homw controller";
    class Home extends Controller {
        protected function Index() {
            $viewmodel = new HomeModel();
            $this->returnView($viewmodel->Index(), true);
        }
    }

?>