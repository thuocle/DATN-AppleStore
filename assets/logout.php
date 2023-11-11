<?php session_start();
    if(isset($_SESSION['admin'])) {
        unset($_SESSION['admin']);
        header('Location:../Login/GoogleLogin.php');
    }
    if(isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        header('Location:../Login/GoogleLogin.php');
    }
    
?>