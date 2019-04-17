<?php
session_start();
include("header.php");

if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    if(isset($_POST['Build'])){
        $Factory = $_POST['Factory'];
		$Farm = $_POST['Farm'];
		$Storehouse = $_POST['Storehouse'];
		$Bank = $_POST['Bank'];
		$Village = $_POST['Village'];
		$City = $_POST['City'];
        $Food_needed = (100 * $Storehouse)+ (2000 * $Village) + (20000 * $City);
		$money_needed = (150 * $Bank)+(100 * $Farm) + (100 * $Factory) + (2000 * $Village) + (20000 * $City);
        if($Factory < 0 || $Farm < 0 || $Storehouse < 0 || $Bank < 0 || $Village < 0 || $City < 0){
            echo("You must Build a positive number of Buildings!");
        }elseif($resources['Food'] < $Food_needed){
            echo("You do not have enough Food!");
        }elseif($resources['Money'] < $money_needed){
        	echo("You do not have enough Money!");
        }else{
            $building['Factory'] += $Factory;
            $building['Farm'] += $Farm;
            $building['Storehouse'] += $Storehouse;
            $building['Bank'] += $Bank;
			$building['Village'] += $Village;
			$building['City'] += $City;
            
            $update_building = mysqli_query($link, "UPDATE `buildings` SET 
                                        `Factory`='".$building['Factory']."',
                                        `Farm`='".$building['Farm']."',
                                        `Storehouse`='".$building['Storehouse']."',
                                        `Bank`='".$building['Bank']."',
                                        `Village`='".$building['Village']."',
                                        `City`='".$building['City']."'
                                        WHERE `ID_Building`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $resources['Food'] -= $Food_needed;
            $resources['Money'] -= $money_needed;
            $update_Food = mysqli_query($link, "UPDATE `resources` SET `Food`='".$resources['Food']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $update_Money = mysqli_query($link, "UPDATE `resources` SET `Money`='".$resources['Money']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            include("update_stats.php");
            echo("You have Built your Buildings!");
		}
    }elseif(isset($_POST['Demolish'])){
        $Factory = $_POST['Factory'];
        $Farm = $_POST['Farm'];
        $Storehouse = $_POST['Storehouse'];
        $Bank = $_POST['Bank'];
        $Village = $_POST['Village'];
		$City = $_POST['City'];
        $Food_gained =  (150 * $Storehouse) + (1600 * $Village) + (16000 * $City);
        $Money_Gained = (150 * $Bank) +(100 * $Factory)+(80 * $Farm)+ (1600 * $Village) + (16000 * $City);
        if($Factory < 0 || $Farm < 0 || $Storehouse < 0 || $Bank < 0){
            echo("You must Demolish a positive number of buildings!");
        }elseif($Factory > $building['Factory'] || $Farm > $building['Farm'] || 
                $Storehouse > $building['Storehouse'] || $Bank > $building['Bank'] || $Village > $building['Village'] || $City > $building['City']){
            echo("You do not have that many buildings to Demolish!");
        }else{
            $building['Factory'] -= $Factory;
            $building['Farm'] -= $Farm;
            $building['Storehouse'] -= $Storehouse;
            $building['Bank'] -= $Bank;
			$building['Village'] -= $Village;
			$building['City'] -= $City;
            
            $update_building = mysqli_query($link, "UPDATE `buildings` SET 
                                        `Factory`='".$building['Factory']."',
                                        `Farm`='".$building['Farm']."',
                                        `Storehouse`='".$building['Storehouse']."',
                                        `Bank`='".$building['Bank']."',
                                        `Village`='".$building['Village']."',
                                        `City`='".$building['City']."'
                                        WHERE `ID_building`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $resources['Food'] += $Food_gained;
            $resources['Money'] += $Money_gained;
            $update_Food = mysqli_query($link, "UPDATE `resources` SET `Food`='".$resources['Food']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $update_Money = mysqli_query($link, "UPDATE `resources` SET `Money`='".$resources['Money']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            include("update_stats.php");
            echo("You have Demolished your buildings!");
        }
    }
    ?>
    <center><h2>Your buildings</h2></center>
    <br />
    You can Build and Demolish your buildings here.
    <br /><br />
    <form action="buildings.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>Building Type</b></td>
            <td><b>Number of Buildings</b></td>
            <td><b>Building Costs</b></td>
            <td><b>Build More</b></td>
        </tr>
        <tr>
            <td>Factory</td>
            <td><?php echo number_format($building['Factory']); ?></td>
            <td>100 Money</td>
            <td><input type="text" name="Factory" value="0" /></td>
        </tr>   
        <tr>
            <td>Farm</td>
            <td><?php echo number_format($building['Farm']); ?></td>
            <td>100 Money</td>
            <td><input type="text" name="Farm" value="0" /></td>
        </tr>     
        <tr>
            <td>Storehouse</td>
            <td><?php echo number_format($building['Storehouse']); ?></td>
            <td>200 Food</td>
            <td><input type="text" name="Storehouse"  value="0"/></td>
        </tr>    
        <tr>
            <td>Bank</td>
            <td><?php echo number_format($building['Bank']); ?></td>
            <td>200 Money</td>
            <td><input type="text" name="Bank" value="0"/></td>
        </tr>
        <td></td>
        <tr>
            <td>Village</td>
            <td><?php echo number_format($building['Village']); ?></td>
            <td>2000 Food <br></br> 2000 Money</td>
            <td><input type="text" name="Village" value="0"/></td>
        </tr>
        <td></td>
        <tr>
            <td>City</td>
            <td><?php echo number_format($building['City']); ?></td>
            <td>20000 Food<br></br> 20000 Money</td>
            <td><input type="text" name="City" value="0"/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="Build" value="Build"/></td>
        </tr>
    </table>
    </form>
    <hr />
        <form action="buildings.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
            <td><b>building Type</b></td>
            <td><b>Number of buildings</b></td>
            <td><b>Food Gain</b></td>
            <td><b>Demolish More</b></td>
        </tr>
        <tr>
            <td>Factory</td>
            <td><?php echo number_format($building['Factory']); ?></td>
            <td>80 Money</td>
            <td><input type="text" name="Factory" value="0"/></td>
        </tr>
        <tr>
            <td>Farm</td>
            <td><?php echo number_format($building['Farm']); ?></td>
            <td>80 Money</td>
            <td><input type="text" name="Farm" value="0" /></td>
        </tr>
        <tr>
            <td>Storehouse</td>
            <td><?php echo number_format($building['Storehouse']); ?></td>
            <td>150 Food</td>
            <td><input type="text" name="Storehouse" value="0"/></td>
        </tr>
        <tr>
            <td>Bank</td>
            <td><?php echo number_format($building['Bank']); ?></td>
            <td>150 Money</td>
            <td><input type="text" name="Bank" value="0"/></td>
        </tr>
        <td></td>
        <tr>
            <td>Village</td>
            <td><?php echo number_format($building['Bank']); ?></td>
            <td>1600 Food <br></br> 1600 Money</td>
            <td><input type="text" name="Village" value="0"/></td>
        </tr>
        <td></td>
        <tr>
            <td>City</td>
            <td><?php echo number_format($building['Bank']); ?></td>
            <td>16000 Food <br></br> 16000 Food</td>
            <td><input type="text" name="City" value="0"/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="Demolish" value="Demolish"/></td>
        </tr>
    </table>
    </form>
    <?php
}
include("footer.php");
?>