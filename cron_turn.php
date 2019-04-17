<?php
include("config.php");
connect();

// Turns every 30 minutes

$get_users = mysqli_query($link, "SELECT * FROM `resources`") or die(mysqli_error($link));
while($user = mysqli_fetch_assoc($get_users)){
    $update = mysqli_query($link, "UPDATE `resources` SET
                            `Money`=`Money`+'".$user['Income']."',
                            `Food`=`Food`+'".$user['Farming']."',
                            `turns`=`turns`+'5' WHERE `ID_Resrc`='".$user['ID_Resrc']."'") or die(mysql_error($link));
}

?>