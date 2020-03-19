<?php 

include_once("templates/header.php");
require_once("admin_functions.php");

?>

<?php 

if (!isset($_SESSION['username'])) {
    redirect("http://localhost/daveTicket/admin/login.php");
} 

?>

        <div id="page-wrapper">

            <div class="container-fluid">


             <?php 

             
                if($_SERVER['REQUEST_URI'] == "/daveTicket/admin/" || $_SERVER['REQUEST_URI'] == "/daveTicket//admin/index.php") {
                    include("templates/admin_content.php");
                }

                if(isset($_GET['orders'])) {
                    include("templates/orders.php");
                }

                if(isset($_GET['add_event'])) {
                    include("templates/add_event.php");
                }


                if(isset($_GET['categories'])) {
                    include("templates/categories.php");
                }

                if(isset($_GET['edit_event'])) {
                    include("templates/edit_event.php");
                }


                if(isset($_GET['ticket_class'])) {
                    include("templates/ticket_class.php");
                }


                if(isset($_GET['events'])) {
                    include("templates/events.php");
                }

                if(isset($_GET['users'])) {
                    include("templates/users.php");
                }

                if(isset($_GET['add_user'])) {
                    include("templates/add_user.php");
                }

                if(isset($_GET['edit_user'])) {
                    include("templates/edit_user.php");
                }

                if(isset($_GET['reports'])) {
                    include("templates/reports.php");
                }


                if(isset($_GET['delete_order_id'])) {
                    include("templates/delete_order.php");
                }

                if(isset($_GET['delete_ticket_class'])) {
                    include("templates/delete_ticket_class.php");
                }

                if(isset($_GET['delete_category'])) {
                    include("templates/delete_category.php");
                }

                if(isset($_GET['delete_event'])) {
                    include("templates/delete_event.php");
                }

                if(isset($_GET['delete_user'])) {
                    include("templates/delete_user.php");
                }

                if(isset($_GET['delete_report'])) {
                    include("templates/delete_report.php");
                }

             ?>

            </div>
            <!-- /.container-fluid -->

        </div>

        <?php include("templates/footer.php"); ?>