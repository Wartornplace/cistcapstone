<?php
session_start();
include("header.php");
?>
Register
<br /><br />
<?php
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
	
	
	
    
    if($username == "" || $password == "" || $email == ""){
        echo "Please supply all fields!";
    }elseif(strlen($username) > 20){
        echo "Username must be less than 20 characters!";
    }elseif(strlen($password) < 8) {
    	echo "Password not long enough, please have a pasword longer than 8 characters!";
    }elseif(strlen($password) > 16) {
    	echo "Password too long, please have a pasword no more than 16 characters!";
    }elseif (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email)){
    	echo "Invalid email";
    }
    else{
        $register1 = mysqli_query($link, "SELECT ID_User FROM users WHERE username = '$username'") or die(mysqli_error($link));
        $register2 = mysqli_query($link, "SELECT ID_User FROM users WHERE email ='$email'") or die(mysqli_error($link));
        if(mysqli_num_rows($register1) > 0){
            echo "That username is already in use!";
        }elseif(mysqli_num_rows($register2) > 0){
            echo "That e-mail address is already in use!";
        }else{
        	$ins1 = mysqli_query($link, "INSERT INTO users (`username`,`password`,`email`) VALUES ('$username','".."','$email')") or die(mysqli_error($link));
            $ins2 = mysqli_query($link, "INSERT INTO resources (`Money`,`Attack`,`Defense`,`Food`, `Income`,`Farming`,`turns`) VALUES (100,10,10,100,10,11,100)") or die(mysqli_error($link));
            $ins3 = mysqli_query($link, "INSERT INTO units (`Farmers`,`Workers`,`Soldiers`,`Guards`,`Drivers`,`Pilots`) VALUES (5,5,0,0,0,0)") or die(mysqli_error($link));
            $ins4 = mysqli_query($link, "INSERT INTO weapons (`Guns`,`Barricades`,`Tanks`,`Bombers`) VALUES (0,0,0,0)") or die(mysqli_error($link));
           	$ins5 = mysqli_query($link, "INSERT INTO rank (`Attack`,`Defense`,`overall`) VALUES(0,0,0)") or die(mysql_error($link));
			$ins6 = mysqli_query($link, "INSERT INTO buildings (`Factory`,`Farm`,`Village`,`City`,`Storehouse`,`Bank`) VALUES(0,0,0,0,0,0)") or die(mysql_error($link));
            echo "You have registered!";
        }
    }
}
?>
<br /><br />
<form action="register.php" method="POST">
Username: <input type="text" name="username"/><br />
Password: <input type="password" name="password"/><br />
E-mail: <input type="text" name="email"/><br />
<input type="submit" name="register" value="Register"/>
</form>
<?php
include("footer.php");
?>