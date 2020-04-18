<div class="row">
    <div class="col-md-2">

    </div>
    <?php 
        $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $query = "SELECT * FROM events";
        $result = mysqli_query($connection, $query);
        
        $events = array();
        
        while($rows = mysqli_fetch_assoc($result)){
            $events[] = $rows;
        }
    ?>

    <div class="col-md-6">
        <h2 style="color: #00043C">Please confirm ticket number</h2>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <div class="form-group">
                <label for="event_name">Event Name</label>

                <select name="event_id" id="" class="form-control">
                    <option value="">Select Event</option>
                    <?php
                    foreach ($events as $row):
                    ?>

                <option style="color: black" value="<?php echo $row['id'] ?>"><?php echo $row['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

                    

            <div class="form-group">
                <label for="event_name">Ticket Details</label>
                <textarea name="t_number" cols="20" rows="5" class="form-control"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary" value="Confirm Ticket">
            </div>
        </form>
    </div>

    <div class="col-md-2">

    </div>
</div>