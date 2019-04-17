<?php
session_start();
include("header.php");


if(!isset($_SESSION['uid'])){
 ?>
 <h3>Welcome to the Beta test for Global Crisis - Leaders of War</h3>
	<p>In Leaders of War you are a strong charasmatic leader who has begun to band together survivors of a
		wartorn world.  The old governments and class hierarchies have crumbled to the tests of time and 
		civil wars.  Can you successfully lead your people to new horizons and become the greatest Leader of
		War!</p>
	<p>This game is currently in the beta testing stage of development and has the possibility of a few bugs.
		Understand that as play goes on many of the features may be overpowered or broken and will be scaled
		back in order to allow for fair gameplay.  As changes are applied some will not require a hard reset
		but others will so please be patient and anyone playing will be notified on the discord.</p>
 <?php
}else{
    ?>
    <center><h2>Your Stats</h2></center>
    <br />
    <table cellpadding="3" cellspacing="5">
        <tr>
            <td>Username:</td>
            <td><i><?php echo $user['username']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>This is your username</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Attack:</td>
            <td><i><?php echo $resources['Attack']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Units cannot fight without their weapons of war, keep your troops supplied to raise your attack power </td>
        </tr>
        <tr>
            <td>Defense:</td>
            <td><i><?php echo $resources['Defense']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>All of your units protect you and your followers but only guards may use barricades.  Buy Villages and Cities to increase your defenses</td>
        </tr>
        <tr>
            <td>Money:</td>
            <td><i><?php echo $resources['Money']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Even after the corporations fell Money always finds a way to implant itself into socity. Use Money to buy weapons and buildings.</td>
        </tr>
        <tr>
            <td>Food:</td>
            <td><i><?php echo $resources['Food']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Food will always be a priority for any following or nation, keep your people well fed and you can use it to recruit soldiers and workers.</td>
        </tr>
        <td></td>
            <td></td>
        <tr>
            <td>Income:</td>
            <td><i><?php echo $resources['Income']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Several buildings as well as workers will allow you to keep a steady income, the number represents how much money you will make each turn (30 min.)</td>
        </tr>
        <tr>
            <td>Farming:</td>
            <td><i><?php echo $resources['Farming']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Several buildings as well as workers will allow you to keep a steady food stockpile, the number represents how much food you will make each turn (30 min.)</td>
        </tr>
        <tr>
            <td>Turns:</td>
            <td><i><?php echo $resources['turns']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>This number represents the amount of turns you currently possess in order to be used in combat against other players</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Workers:</td>
            <td><i><?php echo $unit['Workers']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Workers provide an income of 2(√workers) Example: 5 workers provides an income of ~4.47</td>
        </tr>
        <tr>
            <td>Farmers:</td>
            <td><i><?php echo $unit['Farmers']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Farmers provide food at a rate of 5(√workers) Example: 5 Farmers provides an income of ~11.1</td>
            
        </tr>
        <tr>
            <td>Soldiers:</td>
            <td><i><?php echo $unit['Soldiers']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Soldiers along with other offensive military personnel allow you to attack others.  A Soldier's power is determined by the presence of Guns. Example: 2 Soldiers with 2 Guns = 20 attack power.  4 Soldiers with 2 guns = 22 attack power; as there are only 2 guns to supply 2 of the 4 soldiers leaving 2 soldiers to fight without guns</td>
        </tr>
        <tr>
            <td>Guards:</td>
            <td><i><?php echo $unit['Guards']; ?></i></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Guards are the only defensive units that can use barricades but all units fight to defend.  A Guard's power is determined by the presense of a barricade. Example: 2 Guards with 2 barricades = 20 defense power.  4 Guards with 2 barricades = 22 defense power; as there are only 2 barricades to supply 2/4 Guards leaving 2 soldiers to fight without Barricades. Soldiers and other offensive units provide a solid defense of 5. </td>
        </tr>
    </table>
    
    <?php
}
include("footer.php");
?>