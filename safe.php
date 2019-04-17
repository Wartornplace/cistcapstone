<?php

$resources_get = mysqli_query($link, "SELECT * FROM `resources` WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$resources = mysqli_fetch_assoc($resources_get);

$unit_get = mysqli_query($link, "SELECT * FROM `units` WHERE `ID_Unit`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$unit = mysqli_fetch_assoc($unit_get);

$user_get = mysqli_query($link, "SELECT * FROM `users` WHERE `ID_User`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$user = mysqli_fetch_assoc($user_get);

$weapon_get = mysqli_query($link, "SELECT * FROM `weapons` WHERE `ID_Weapons`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$weapon = mysqli_fetch_assoc($weapon_get);

$builing_get = mysqli_query($link, "SELECT * FROM `buildings` WHERE `ID_Building`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$building = mysqli_fetch_assoc($builing_get);

?>