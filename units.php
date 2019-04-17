<?php
session_start();
include("header.php");

if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    if(isset($_POST['train'])){
        $Workers = $_POST['Workers'];
		$Farmers = $_POST['Farmers'];
		$Soldiers = $_POST['Soldiers'];
		$Guards = $_POST['Guards'];
		$Drivers = $_POST['Drivers'];
		$Pilots = $_POST['Pilots'];
        $Food_needed = (10 * $Workers) + (10 * $Farmers) + (10 * $Soldiers) + (10 * $Guards) + (50 * $Drivers) + (50 * $Pilots);
        if($Workers < 0 || $Farmers < 0 || $Soldiers < 0 || $Guards < 0 || $Drivers< 0 || $Pilots < 0){
            echo("You must train a positive number of workers!");
        }elseif($resources['Food'] < $Food_needed){
            echo("You do not have enough Food!");
        }else{
            $unit['Workers'] += $Workers;
            $unit['Farmers'] += $Farmers;
            $unit['Soldiers'] += $Soldiers;
            $unit['Guards'] += $Guards;
			$unit['Drivers'] += $Drivers;
            $unit['Pilots'] += $Pilots;
            
            $update_unit = mysqli_query($link, "UPDATE `units` SET 
                                        `Workers`='".$unit['Workers']."',
                                        `Farmers`='".$unit['Farmers']."',
                                        `Soldiers`='".$unit['Soldiers']."',
                                        `Guards`='".$unit['Guards']."',
                                        `Drivers`='".$unit['Drivers']."',
                                        `Pilots`='".$unit['Pilots']."'
                                        WHERE `ID_Unit`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $resources['Food'] -= $Food_needed;
            $update_Food = mysqli_query($link, "UPDATE `resources` SET `Food`='".$resources['Food']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            include("update_stats.php");
            echo("You have trained your Units!");
		}
    }elseif(isset($_POST['untrain'])){
        $Workers = $_POST['Workers'];
        $Farmers = $_POST['Farmers'];
        $Soldiers = $_POST['Soldiers'];
        $Guards = $_POST['Guards'];
        $Drivers = $_POST['Drivers'];
		$Pilots = $_POST['Pilots'];
        $Food_gained = (8 * $Workers) + (8 * $Farmers) + (8 * $Soldiers) + (8 * $Guards)+ (40 * $Drivers) + (40 * $Pilots);
        if($Workers < 0 || $Farmers < 0 || $Soldiers < 0 || $Guards < 0 || $Drivers< 0 || $Pilots < 0){
            echo("You must untrain a positive number of units!");
        }elseif($Workers > $unit['Workers'] || $Farmers > $unit['Farmers'] || 
                $Soldiers > $unit['Soldiers'] || $Guards > $unit['Guards'] || $Drivers > $unit['Drivers'] || $Pilots > $unit['Pilots']){
            echo("You do not have that many units to untrain!");
        }else{
            $unit['Workers'] -= $Workers;
            $unit['Farmers'] -= $Farmers;
            $unit['Soldiers'] -= $Soldiers;
            $unit['Guards'] -= $Guards;
            $unit['Drivers'] -= $Drivers;
            $unit['Pilots'] -= $Pilots;
            
            $update_unit = mysqli_query($link, "UPDATE `units` SET 
                                        `Workers`='".$unit['Workers']."',
                                        `Farmers`='".$unit['Farmers']."',
                                        `Soldiers`='".$unit['Soldiers']."',
                                        `Guards`='".$unit['Guards']."',
                                        `Drivers`='".$unit['Drivers']."',
                                        `Pilots`='".$unit['Pilots']."' 
                                        WHERE `ID_Unit`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $resources['Food'] += $Food_gained;
            $update_Food = mysqli_query($link, "UPDATE `resources` SET `Food`='".$resources['Food']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            include("update_stats.php");
            echo("You have untrained your units!");
        }
    }
    ?>
    <center><h2>Your Units</h2></center>
    <br />
    You can train and untrain your units here.
    <br /><br />
    <form action="units.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>Unit Type</b></td>
            <td><b>Unit Name</b></td>
            <td><b>Number of Units</b></td>
            <td><b>Unit Cost</b></td>
            <td><b>Train More</b></td>
        </tr>
        <tr>
        	<td>Civilian</td>
            <td>Workers</td>
            <td><?php echo number_format($unit['Workers']); ?></td>
            <td>10 Food</td>
            <td><input type="text" name="Workers" value="0" /></td>
        </tr>   
        <tr>
        	<td>Civilian</td>
            <td>Farmers</td>
            <td><?php echo number_format($unit['Farmers']); ?></td>
            <td>10 Food</td>
            <td><input type="text" name="Farmers" value="0" /></td>
        </tr>     
        <tr>
        	<td>Military</td>
            <td>Soldiers</td>
            <td><?php echo number_format($unit['Soldiers']); ?></td>
            <td>10 Food</td>
            <td><input type="text" name="Soldiers"  value="0"/></td>
        </tr>
        <tr>
        	<td>Military</td>
            <td>Guards</td>
            <td><?php echo number_format($unit['Guards']); ?></td>
            <td>10 Food</td>
            <td><input type="text" name="Guards" value="0"/></td>
        </tr>
         
        <tr>
        	<td>Military</td>
            <td>Drivers</td>
            <td><?php echo number_format($unit['Drivers']); ?></td>
            <td>50 Food</td>
            <td><input type="text" name="Drivers"  value="0"/></td>
        </tr> 
        <tr>
        	<td>Military</td>
            <td>Pilots</td>
            <td><?php echo number_format($unit['Pilots']); ?></td>
            <td>50 Food</td>
            <td><input type="text" name="Pilots"  value="0"/></td>
        </tr>
        <tr>    
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="train" value="Train"/></td>
        </tr>
    </table>
    </form>
    <hr />
        <form action="units.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
        	<td><b>Unit Type</b></td>
            <td><b>Unit Name</b></td>
            <td><b>Number of Units</b></td>
            <td><b>Food Gain</b></td>
            <td><b>Untrain More</b></td>
        </tr>
        <tr>
        	<td>Civilian</td>
            <td>Workers</td>
            <td><?php echo number_format($unit['Workers']); ?></td>
            <td>8 Food</td>
            <td><input type="text" name="Workers" value="0"/></td>
        </tr>
        <tr>
        	<td>Civilian</td>
            <td>Farmers</td>
            <td><?php echo number_format($unit['Farmers']); ?></td>
            <td>8 Food</td>
            <td><input type="text" name="Farmers" value="0" /></td>
        </tr>
        <tr>
        	<td>Military</td>
            <td>Soldiers</td>
            <td><?php echo number_format($unit['Soldiers']); ?></td>
            <td>8 Food</td>
            <td><input type="text" name="Soldiers" value="0"/></td>
        </tr>
        <tr>
        	<td>Military</td>
            <td>Guards</td>
            <td><?php echo number_format($unit['Guards']); ?></td>
            <td>8 Food</td>
            <td><input type="text" name="Guards" value="0"/></td>
        </tr>
        <tr>
        	<td>Military</td>
            <td>Drivers</td>
            <td><?php echo number_format($unit['Drivers']); ?></td>
            <td>40 Food</td>
            <td><input type="text" name="Drivers"  value="0"/></td>
        </tr> 
        <tr>
        	<td>Military</td>
            <td>Pilots</td>
            <td><?php echo number_format($unit['Pilots']); ?></td>
            <td>40 Food</td>
            <td><input type="text" name="Pilots"  value="0"/></td>
        </tr> 
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="untrain" value="Untrain"/></td>
        </tr>
    </table>
    </form>
    <?php
}
include("footer.php");
?>