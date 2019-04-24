<?php
session_start();
include("header.php");

if(isset($_POST['login'])){
    if(isset($_SESSION['uid'])){
        echo "You are already logged in!";
    }else{
        $email = $_POST['Email'];
        $password = $_POST['password'];
	
        
        $login_check = mysqli_query($link, "SELECT `ID_User` FROM `users` WHERE `email`='$email' AND password='".md5($password)."'") or die(mysqli_error($link));
        if(mysqli_num_rows($login_check) == 0){
            echo "Invalid Email/Password Combination!";
        }else{
            $get_id = mysqli_fetch_assoc($login_check);
            $_SESSION['uid'] = $get_id['ID_User'];
            header("Location: index.php");
        }
    }
}else{
    echo "You have visited this page incorrectly!";
}



include("footer.php");
?>