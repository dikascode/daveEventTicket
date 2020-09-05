<?php
//echo $_SERVER['REQUEST_URI'];

//creating the connection
$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME); 

    
$upload_directory = "../assets/images";


/*****Helper fucntions****/

//validating input
function htmlvalidation($form_data){
    $form_data = trim( stripslashes( htmlspecialchars( $form_data ) ) );
    
    return $form_data;
}


function last_id () {
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message($msg){
    if(!empty($msg)){
    $_SESSION['message'] = $msg;
}else{
    $msg = "";
}

}


function display_message(){
    if(isset($_SESSION['message'])){

        echo $_SESSION['message'];
        unset ($_SESSION['message']);

    }
}

function redirect($location) {
    header("Location: $location");
}

function query($sql){
    global $connection;

    return mysqli_query($connection, $sql);
}

//confirm connection or show the error message
function confirm($result){
    global $connection;
    
    if(!$result){
        die("QUERY FAILED" . mysqli_error($connection));
    }
}

//escape string helper function
function escape_string($string){
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}


function fetch_array($result){
    return mysqli_fetch_array($result);
}


    //crsf function for form protection

function form_protect () {
    //create a key for hash_hmac function

    if (empty($_SESSION['key'])) 
        $_SESSION['key'] = bin2hex(random_bytes(32));

    //create CRSF token

    return $crsf = hash_hmac('sha256', 'This is our market web app', $_SESSION['key'], false);
    
    
}



// Admin orders
function display_orders () {

    $query = query("SELECT * FROM orders ORDER BY order_id desc");
    confirm($query);


    while($row = fetch_array($query)) {
       
        // heredoc
    $orders = <<<DELIMETER
    <tr>
        <td>{$row['order_id']}</td>
        <td>&#x20a6;{$row['order_amount']}</td>
        <td>{$row['order_transaction']}</td>
        <td>{$row['order_currency']}</td>
        <td>{$row['order_time']}</td>
        <td>{$row['cust_name']}</td>
        <td>{$row['cust_email']}</td>
        <td>{$row['payment_type']}</td>
        <td>{$row['order_status']}</td>
        <td><a class="btn btn-danger" href="index.php?delete_order_id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
DELIMETER;

echo $orders;

    }

}



function display_index_orders () {

    $query = query("SELECT * FROM orders ORDER BY order_id DESC LIMIT 20");
    confirm($query);

    
    $conta = 1;

    while($row = fetch_array($query)) {
       
        // heredoc
    $orders = <<<DELIMETER
    <tr>
        <td>$conta</td>
        <td>{$row['order_id']}</td>
        <td>Order Date</td>
        <td>Order Time</td>
        <td>&#x20a6;{$row['order_amount']}</td>
        <td>{$row['order_transaction']}</td>
        <td>{$row['order_currency']}</td>
        <td>Payment Type</td>
        <td>{$row['order_status']}</td>
    </tr>
DELIMETER;

echo $orders;
    $_SESSION['order_conta'] = $conta;
    $conta++;
    }

    

}




// Admin products

function display_image ($picture) {
    global $upload_directory;
    return $upload_directory . DS . $picture;
}

 function get_events_in_admin() {

    $query = query("SELECT * FROM events ORDER BY id desc");
    confirm($query);

    while($row = fetch_array($query)) {
    
    $_SESSION['class_name'] = $row['name'];

    $category_title =  show_event_category_title ($row['cat_id']);

    $product_image = display_image ($row['small_image']);

        // heredoc
    $product = <<<DELIMETER

<tr>
    <td>{$row['id']}</td>
    <td>{$row['name']}</td>
    <td><a href="index.php?edit_event&id={$row['id']}"><img width="100px" src="{$product_image}" alt="Image {$row['name']}"></a></td>
    <td>$category_title</td>
    <td><a href="index.php?ticket_class&id={$row['id']}">Ticket Class</a></td>
    <td><a class="btn btn-danger" href="index.php?delete_event&id={$row['id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
    


</tr>

DELIMETER;

    Echo $product;
     
    }

}





// Adding product in Admin

function add_event () {
    //upload directory
global $upload_directory;
    
    $crsf = form_protect();

    if (isset($_POST['publish'])) {

            //validate crsf token
    if (hash_equals($crsf, $_POST['crsf'])) {
        $event_title            = htmlvalidation($_POST['event_name']);
        $event_cat_id           = htmlvalidation($_POST['event_category_id']);
        $event_desc             = nl2br(htmlvalidation($_POST['event_desc']));
        $event_venue            = htmlvalidation($_POST['event_venue']);
        $date_time              = htmlvalidation($_POST['event_date']);
        $big_image              = htmlvalidation($_FILES['file']['name']);
        $small_image            = htmlvalidation($_FILES['file2']['name']);
        $image_temp_location    = $_FILES['file']['tmp_name'];
        $image_temp_location2   = $_FILES['file2']['tmp_name'];

        if (empty($event_title) || empty($event_cat_id) || empty($event_desc) || empty($event_venue) || empty($date_time) || empty($big_image) || empty($small_image)) {

            echo "<h3 class='bg-danger'>All Fields are Required</h3>";
            //set_message("Fields are required");

        } else {


        // UPLOAD_FOLDER . DS . $event_image

        move_uploaded_file($_FILES['file']['tmp_name'], $upload_directory . DS . $big_image);
        move_uploaded_file($_FILES['file2']['tmp_name'], $upload_directory . DS . $small_image);
    

        $query = query("INSERT INTO events(name, cat_id, description, location, date, big_image, small_image) VALUES('$event_title',
                        '$event_cat_id', '$event_desc', '$event_venue', '$date_time',
                        '$big_image', '$small_image' )");
        $last_id = last_id();

        confirm($query);
        set_message("New event with ID {$last_id} was Successfully Added");
        redirect("index.php?events");

        }
    }else {
        echo "<p class='bg-danger'>CRSF Token Failed</p>";
    }
       

    }

}


function get_categories_add_event_page(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetch_array($query)) {
       
        // heredoc
    $category_options = <<<DELIMETER
    <option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMETER;

echo $category_options;

    }

}


    // Fetching category title with passing id as parameter

function show_event_category_title ($product_category_id) {

    $category_query = query("SELECT * FROM categories WHERE cat_id = {$product_category_id}");
    confirm($category_query);

    while($category_row = fetch_array($category_query)) {
        return $category_row['cat_title'];
    }
}


// Edit function for products in admin page

function update_event () {
    global $upload_directory;

    $crsf = form_protect();

    if (isset($_POST['update'])) {

            //validate crsf token
    if (hash_equals($crsf, $_POST['crsf'])) {

        $event_title            = htmlvalidation($_POST['event_title']);
        $event_venue            = htmlvalidation($_POST['event_venue']);
        $event_date             = htmlvalidation($_POST['event_date']);
        $cat_id                 = htmlvalidation($_POST['cat_id']);
        $event_desc             = nl2br(htmlvalidation($_POST['event_desc']));
        $big_image              = htmlvalidation($_FILES['file']['name']);
        $small_image            = htmlvalidation($_FILES['file2']['name']);
        $image_temp_location    = $_FILES['file']['tmp_name'];
        $image_temp_location2   = $_FILES['file2']['tmp_name'];


        if(empty($big_image) || empty($small_image)) {
            $get_pic = query("SELECT big_image, small_image FROM events WHERE id =" . escape_string($_GET['id']) ."");
            confirm($get_pic);

            while($pic = fetch_array($get_pic)) {

                $big_image      = $pic['big_image'];
                $small_image    = $pic['small_image'];

            }
        }


        move_uploaded_file($_FILES['file']['tmp_name'], $upload_directory . DS . $big_image);
        move_uploaded_file($_FILES['file2']['tmp_name'], $upload_directory . DS . $small_image);
    
        // Update product query

        $query  = "UPDATE events SET ";
        $query .= "name                = '{$event_title}'    , ";
        $query .= "location            = '{$event_venue}'    , ";
        $query .= "date                = '{$event_date}'    , ";
        $query .= "cat_id              = '{$cat_id }'  , ";
        $query .= "description         = '{$event_desc}'     , ";
        $query .= "big_image           = '{$big_image}'    , ";
        $query .= "small_image         = '{$small_image}'     ";
        $query .= "WHERE id =" . escape_string($_GET['id']);
        
        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Event Updated Successfully");
        redirect("index.php?events");

    }else {
        echo "<p class='bg-danger'>CRSF Token Failed</p>";
    }

        

    }

}



// categories in admin

    // Show categories function

function show_categories_in_admin () {

    $query = query("SELECT * FROM categories");
    confirm($query);

    while ($row = fetch_array($query)) {

        $cat_id     = $row['cat_id'];
        $cat_title  = $row['cat_title'];

$category = <<<DELIMETER

<tr>
    <td>{$row['cat_id']}</td>
    <td>{$row['cat_title']}</td>
    <td><a class="btn btn-danger" href="index.php?delete_category&id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
</tr>

DELIMETER;

echo $category;

    }

}

    // Create categories in admin

    function add_category () {

        if (isset($_POST['add_category'])) {

            $crsf = form_protect();

                //validate crsf token
            if (hash_equals($crsf, $_POST['crsf'])) {

                $cat_title = escape_string($_POST['cat_title']);

                            if (empty($cat_title) || $cat_title == " ") {

                                echo "<h3 class='bg-danger'>Category Title is Required</h3>";

                            } else {

                                $query = query("INSERT INTO categories(cat_title) VALUES('$cat_title')");

                                confirm($query);
                                $last_id = last_id();
                                $category_title = show_event_category_title($last_id);
                                set_message($category_title . " Category Created");
                                redirect("index.php?categories");


                            }
            }else {
                echo "<p class='bg-danger'>CRSF Token Failed</p>";
            }


            
         
        }
    }



    // ticket class in admin


    function show_ticket_class_title ($ticket_id) {

        $ticket_query = query("SELECT * FROM tickets WHERE ticket_id = {$ticket_id}");
        confirm($ticket_query);
    
        while($ticket_row = fetch_array($ticket_query)) {
            return $ticket_row['class'];
        }
    }

    // Show ticket class function

function show_ticket_class_in_admin () {

$query = query("SELECT * FROM tickets WHERE event_id = {$_GET['id']}");
    confirm($query);

    while ($row = fetch_array($query)) {

        $ticket_data = query("SELECT ticket_price, ticket_quantity FROM reports WHERE ticket_id = {$row['ticket_id']}");
        confirm($ticket_data);
            $id     = $row['ticket_id'];
            $title  = $row['class'];
            $price  = number_format($row['price']);

        $t_price = array();
        $t_number = array();

        //obtain the total number and amount sold for each ticket
        while ($sale_data = mysqli_fetch_assoc($ticket_data)) {

            $t_price[] = $sale_data['ticket_price'];
            $t_number[] = $sale_data['ticket_quantity'];

            
    }

    $ticket_price       = number_format(array_sum($t_price));
    $ticket_quantity    = (array_sum($t_number));

    $category = <<<DELIMETER
    <tr>
        <td>{$id}</td>
        <td>{$title}</td>
        <td>&#8358; {$price}</td>
        <td>{$ticket_quantity}</td>
        <td>&#8358; {$ticket_price}</td>
        <td><a class="btn btn-danger" href="index.php?delete_ticket_class&t_id={$row['ticket_id']}&id={$_GET['id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        
    </tr>
    
    DELIMETER;
echo $category;
}
}



    // Create categories in admin

    function add_ticket_class () {

        if (isset($_POST['add_class'])) {

            $crsf = form_protect();

                //validate crsf token
            if (hash_equals($crsf, $_POST['crsf'])) {

                $ticket_name = escape_string($_POST['class']);
                $ticket_price = escape_string($_POST['price']);

                            if (empty($ticket_name) || empty($ticket_price)) {

                                echo "<h3 class='bg-danger'>All Fields is Required</h3>";

                            } else {

                                $query = query("INSERT INTO tickets(class, price, event_id) VALUES('$ticket_name', '$ticket_price', '{$_GET['id']}')");

                                confirm($query);
                                $last_id = last_id();
                                $ticket_title = show_ticket_class_title($last_id);
                                set_message($ticket_title . " Class Created");
                                redirect("index.php?ticket_class&id={$_GET['id']}");


                            }
            }else {
                echo "<p class='bg-danger'>CRSF Token Failed</p>";
            }


            
         
        }
    }




    // Admin Users

    function display_users () {

        $query = query("SELECT * FROM users");
        confirm($query);
    
        while ($row = fetch_array($query)) {
    
            $user_id    = $row['user_id'];
            $username   = $row['username'];
            $email      = $row['email'];
            $user_photo = display_image($row['user_photo']);
    
    $user = <<<DELIMETER
    
    <tr>
        <td>{$user_id}</td>
        <td><img width="100px" src="{$user_photo}" alt="{$row['username']} Image"></td>
        <td>{$username}</td>
        <td>{$email}</td>
        <td><a class="btn btn-danger" href="index.php?delete_user&id={$user_id}"><span class="glyphicon glyphicon-remove"></span></a></td>
    </tr>
    
    DELIMETER;
    
    echo $user;
    
        }
    
    }



    function add_user() {
        global $upload_directory;

        if (isset($_POST['add_user'])) {

            $crsf = form_protect();

        //validate crsf token

        
        if (hash_equals($crsf, $_POST['crsf'])) {

            $username       = escape_string($_POST['username']);
            $email          = escape_string($_POST['email']);
            $password       = escape_string(sha1($_POST['password']));
            $user_photo     = escape_string($_FILES['file']['name']);
            $photo_temp     = $_FILES['file']['tmp_name'];

            if (empty($username) || empty($email) || empty($password)) {

                echo "<h3 class='bg-danger'>All Fields are Required</h3>";
                //set_message("Fields are required");

            } else {

            move_uploaded_file($photo_temp, $upload_directory . DS . $user_photo);

            $query = query("INSERT INTO users(username, email, password, user_photo) VALUES('$username', '$email', '$password', '$user_photo')");
            
            confirm($query);

            set_message("$username User Created");

            redirect("index.php?users");
            }

        }else {
            echo "<p class='bg-danger'>CRSF Token Failed</p>";
        }
            
        }

        
    }


    // function for user login
function login_user(){

   

    if(isset($_POST['submit'])){
        
        $crsf = form_protect();
            //validate crsf token
        if (hash_equals($crsf, $_POST['crsf'])) {
             $username = escape_string($_POST['username']);
             $password = escape_string(sha1($_POST['password']));
    
            $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
    
            confirm($query);
    
            if(mysqli_num_rows($query) === 0){
                set_message('Your Username or Password is wrong');
                //redirect("https://youconnect.herokuapp.com/admin/login.php");
                
                redirect("http://localhost/daveTicket/admin/login.php");
            }else{
                $_SESSION['username'] = $username;
                set_message('Welcome to Admin, ' .$username. '');
                redirect("index.php?users");
            }
    
            }else{
                echo "<p class='bg-danger'>CRSF Token failed</p>";
            }
        
    
    }
    
    
    }




    /************** Reports Page in Admin ****************** */

    function get_reports() {

        $query = query("SELECT * FROM reports ORDER BY report_id desc");
        confirm($query);
    
        while($row = fetch_array($query)) {
    
        
    
            // heredoc
        $report = <<<DELIMETER
    
    <tr>
        <td align="center">{$row['report_id']}</td>
        <td align="center">{$row['event_id']}</td>
        <td align="center">{$row['ticket_id']}</td>
        <td align="center">{$row['order_id']}</td>
        <td align="center">&#8358;{$row['ticket_price']}</td>
        <td align="center">{$row['ticket_name']}</td>
        <td align="center">{$row['ticket_quantity']}</td>
        <td align="center">{$row['event_name']}</td>
        <td align="center">{$row['cust_name']}</td>
        <td align="center">{$row['cust_email']}</td>
        <td align="center">{$row['order_date']}</td>
        <td align="center">{$row['payment_status']}</td>
        <td><a class="btn btn-danger" href="index.php?delete_report&id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
       
    
    
    </tr>
    
    DELIMETER;
    
        Echo $report;
         
        }
    
    }
