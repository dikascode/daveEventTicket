<?php 

class Events extends Controller {
    protected function Index() {
        $viewmodel = new EventModel();
        $this->returnView($viewmodel->Index(), true);
    }



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