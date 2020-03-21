<?php
echo __DIR__ . " Home controller";
    class Home extends Controller {
        protected function Index() {
            $viewmodel = new HomeModel();
            $this->returnView($viewmodel->Index(), true);
        }
    }

?>