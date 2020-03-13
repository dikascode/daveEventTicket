<?php 

class Team extends Controller {
    protected function Index() {
        $viewmodel = new TeamModel();
        $this->returnView($viewmodel->Index(), true);
    }

}

?>