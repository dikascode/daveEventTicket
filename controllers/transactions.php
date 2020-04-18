<?php 
class Transactions extends Controller {
    protected function Index() {
        $viewmodel = new TransactionModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function fail() {
        $viewmodel = new TransactionModel();
        $this->returnView($viewmodel->fail(), true);
    }


}

?>