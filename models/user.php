<?php

    class UserModel extends Model {
        public function register() {

             //Sanitize POST
             $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            
             //encrypyt password
             $password = md5($post['password']);

             if($post['submit']) {

                if($post['name'] == '' || $post['email'] == '' || $post['password'] == '') {
                    Messages::setMsg('Please Fill In All Fields', 'error');
                    return;
                 }
    

                 //insert into database
                 $this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
                 $this->bind(':name', $post['name']);
                 $this->bind(':email', $post['email']);
                 $this->bind(':password', $password);
 
                 $this->execute();
 
                 //Verify
 
                 if($this->lastInsertId()) {
                     //redirect
                     header('Location: '.ROOT_URL."?controller=user&action=login");
                 }
             }
 
            return;
        }


        public function login() {

            //Sanitize POST
            $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            //encrypyt password
            $password = md5($post['password']);

            if($post['submit']) {

                //Compare Log in
                $this->query('SELECT * FROM users WHERE email = :email AND password = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);

                $row = $this->single();

                if($row) {
                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "id"    => $row['id'],
                        "name"  => $row['name'],
                        "email" => $row['email']
                    );
                    //redirect
                     header('Location: '.ROOT_URL."?controller=shares");
                }   else {
                    Messages::setMsg('Incorrect Login', 'error');
                }

                    //redirect
                   
                
            }

           return;
       }
    }

?>