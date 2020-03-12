<?php

    class Bootstrap {
        private $controller;
        private $action;
        private $request;

        public function __construct($request) {
            $this->request = $request;
            if(isset($this->request['controller']) == "") {
                $this->controller = 'home';
            }else {
                $this->controller = $this->request['controller'];
            }

            if(isset($this->request['action']) == "") {
                $this->action = 'index';
            }else {
                $this->action = $this->request['action'];
            }

            //echo $this->controller;
        }


        public function createController() {
            //check for class
            if(class_exists($this->controller)){
                $parents = class_parents($this->controller);

                //check extend
                if(in_array("Controller", $parents)) {

                    //check if controller includes action pased in
                    if(method_exists($this->controller, $this->action)) {
                        return new $this->controller($this->action, $this->request);
                    } else{
                        //Method doesn't exist
                        echo '<h1>Method does not exist</h1>';
                        return;
                    }

                } else {
                    //Base contoller not found
                    echo '<h1>Base Controller does not exist</h1>';
                    return;
                }
            } else {
                 //Contoller class not found
                 echo '<h1>Controller class does not exist</h1>';
                 return;
            }
        }
    }

?>