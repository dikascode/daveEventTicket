<?php
    class Users extends Controller {
        protected function register() {
            $viewmodel = new userModel;
            $this->returnView($viewmodel->register(), true);
        }


        //login controller
        protected function login() {
            $viewmodel = new userModel;
            $this->returnView($viewmodel->login(), true);
        }

        //logout controller

        protected function logout() {
            unset($_SESSION['is_logged_in']);
            unset($_SESSION['user_data']);
            session_destroy();

            //redirect

            header('Location: '. ROOT_URL);

            
        }
    }

?>