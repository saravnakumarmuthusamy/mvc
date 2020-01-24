<?php
 
    // Script By Qassim Hassan, wp-time.com
 
    session_start();
 
    if( isset($_SESSION['user_info']) ){ // if user is logged in
        $user_info = $_SESSION['user_info'];
        ?>
            <h3>Welcome <?php echo $user_info["firstName"]; ?> <?php echo $user_info["lastName"]; ?> !</h3>
            <p><img src="<?php echo $user_info['pictureUrls']['values'][0]; ?>"></p>
            <!-- <p>Connections: <?php echo $user_info["numConnections"]; ?></p> -->
            <p>Your Email: <?php echo $user_info["emailAddress"]; ?></p>
            <p><a href="logout.php">Logout</a></p>
        <?php
    }
 
    else{ // if user is not logged in
        echo '<a href="login.php">Login With LinkedIn</a>';
    }
 
?>