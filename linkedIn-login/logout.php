<?php
 
    session_start();
 
    /* Script By Qassim Hassan, wp-time.com */
 
    // if user is logged in, destroy all facebook sessions
    if( isset($_SESSION['user_info']) or isset($_SESSION['login']) ){
        unset( $_SESSION['user_info'] ); // destroy
        unset( $_SESSION['login'] ); // destroy
        header("location: ../index.php"); // redirect user to index page
    }
 
    else{ // if user is not logged in
        header("location: ../index.php"); // redirect user to index page
    }
 
?>