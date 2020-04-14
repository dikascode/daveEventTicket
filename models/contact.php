<?php

    class ContactModel extends Model{
        public function Index() {

             //Sanitize POST from views page
             $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if($post['submit']) {
                $name = $post['name'];
                $message = $post['message'];
                $email = $post['email'];
                $subject = $post['subject'];

                if(empty($name) || empty($message) || empty($email) || empty($subject) ) {

                    Messages::setMsg('All Fields Are Required', 'error');

                } else {
                    $htmlBody = "

                    <h2>{$subject}</h2>
                    <p>Name: $name. Email: $email</p>
                    <p>{$message}</p>
                    
                    ";
                    Mails::sendEmail('uconnect.ng1@gmail.com', $subject, $htmlBody);

                    Messages::setMsg(''.$name.', thanks for reaching out. Your message has been sent successfully. We will reply ASAP', 'Message');
                }

                

            }
            return;
        }

    }

?>