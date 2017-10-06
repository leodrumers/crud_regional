 <?php
    session_start();
    unset($_POST['name']);
    unset($_POST['password']);
    session_destroy();
    header('location: index.php');
?> 