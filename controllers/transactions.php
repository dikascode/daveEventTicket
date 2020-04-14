<?php 
class Transactions extends Controller {
    protected function Index() {
        $viewmodel = new TransactionModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function t_fail() {
        $viewmodel = new TransactionModel();
        $this->returnView($viewmodel->t_fail(), true);
    }


}

?>