<?php if($_SESSION['total_price']){ ?>

<h3>Congratulations, you've purchased your ticket and its details has been sent to your mail. <span style="color:red">Please come along with it to the event.</span></h3>
<p>Go back <a href="<?php echo ROOT_URL ?>">HOME</a> to browse more events.</p>

<?php } else{ header('Location: '. ROOT_URL); }?>