<?php 

class About extends Controller {
    protected function Index() {
        $viewmodel = new AboutModel();
        $this->returnView($viewmodel->Index(), true);
    }

}

?>