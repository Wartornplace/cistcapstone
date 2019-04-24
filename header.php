<?php
include("config.php");

?>
<html>
	
<head>
<title>Global Crisis - Leaders of War</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div>
	<?php
if(isset($_SESSION['uid'])){
    include("safe.php");
    ?>
<div id="header"><pre> Global Grisis-Leaders of War| Food:<?php echo $resources['Food']; ?>| Money:<?php echo $resources['Money']; ?> </pre> </div>
<?php
 } else{
 	?>
	<div id="header">Global Crisis - Leaders of War </div>
	<?php
}
 ?>
<div id="container">
<div id="navigation"><div id="nav_div">
<?php
if(isset($_SESSION['uid'])){
    include("safe.php");
    ?>
    &raquo; <a href="index.php">Stats</a><br /><br />
    &raquo; <a href="rankings.php">To Battle!</a><br /><br />
    &raquo; <a href="units.php">Units</a><br /><br />
    &raquo; <a href="weapons.php">Weapons</a><br /><br />
    &raquo; <a href="buildings.php">Buildings</a><br /><br />
    &raquo; <a href="logout.php">Logout</a><br /><br />
    &raquo; <a href="https://discord.gg/AKdMa4M">Discord</a>
    <?php
}else{
	
    ?>
    <form action="login.php" method="post">
    Email: <input type="text" name="Email"/><br />
    Password: <input type="password" name="password"/><br />
    <input type="submit" name="login" value="login"/>
    </form>
    &raquo; <a href="register.php">Register</a>
    <?php
}
?>
</div></div>
<div id="content"><div id="con_div">
