<?php 

class Events extends Controller {
    protected function Index() {
        $viewmodel = new EventModel();
        $this->returnView($viewmodel->Index(), true);
    }


    // protected function add() {
    //     if(!isset($_SESSION['is_logged_in'])) {
    //         header('Location: '.ROOT_URL.'?controller=shares');
    //     } else{
    //         $viewmodel = new ShareModel();
    //         $this->returnView($viewmodel->add(), true);
    //     }
       
    // }


    protected function view() {
        $viewmodel = new EventModel();
        $this->returnView($viewmodel->view(), true);
       
    }


    protected function ticketSale() {
        $viewmodel = new EventModel();
        $this->returnView($viewmodel->ticketSale(), true);
       
    }
}

?>