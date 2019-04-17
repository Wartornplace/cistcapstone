<?php
session_start();
include("header.php");

// Check for login
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    // User buys weapons
    if(isset($_POST['buy'])){
        $guns = $_POST['Guns'];
        $barricades = $_POST['Barricades'];
		$tanks = $_POST['Tanks'];
        $bombers = $_POST['Bombers'];
        $money_neededG = (10 * $guns) + (10 * $barricades) + (100 * $tanks) + (100 * $bombers);
		
        if($guns < 0 || $barricades < 0 || $tanks < 0 || $bombers < 0){
            echo ("You must buy a positive number of weapons!");
        }elseif($resources['Money'] < $money_neededG){
            echo ("You do not have enough Money for Guns!");
        }else{
            $weapon['Guns'] += $guns;
			$weapon['Barricades'] += $barricades;
			$weapon['Tanks'] += $tanks;
			$weapon['Bombers'] += $bombers;
            
            $update_weapons = mysqli_query($link, "UPDATE `weapons` SET 
                                            `Guns`='".$weapon['Guns']."',
                                            `Barricades`='".$weapon['Barricades']."',
                                            `Tanks`='".$weapon['Tanks']."',
                                            `Bombers`='".$weapon['Bombers']."'
                                            WHERE `ID_Weapons`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $resources['Money'] -= $money_neededG;
            $update_Money = mysqli_query($link, "UPDATE `resources` SET `Money`='".$resources['Money']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            include("update_stats.php");
            echo ("You have bought weapons!");
        }
    }elseif(isset($_POST['sell'])){
        // User sells weapons
        $guns = $_POST['Guns'];
        $barricades = $_POST['Barricades'];
		$tanks = $_POST['Tanks'];
        $bombers = $_POST['Bombers'];
        $Money_gained = (8 * $guns) + (8 * $barricades) + (80 * $tanks) + (80 * $bombers);
        
        if($guns < 0 || $barricades < 0 || $tanks < 0 || $bombers < 0){
            echo("You must sell a positive number of weapons!");
        }elseif($guns > $weapon['Guns'] || $barricades > $weapon['Barricades'] || $weapon['Tanks'] || $weapon['Bombers']){
            echo("You do not have that many weapons to sell!");
        }else{
            $weapon['Guns'] -= $guns;
			$weapon['Barricades'] -= $barricades;
			$weapon['Tanks'] -= $tanks;
			$weapon['Bombers'] -= $bombers;
            
            $update_weapons = mysqli_query($link, "UPDATE `weapons` SET 
                                            `Guns`='".$weapon['Guns']."',
                                            `Barricades`='".$weapon['Barricades']."',
                                            `Tanks`='".$weapon['Tanks']."',
                                            `Bombers`='".$weapon['Bombers']."'
                                            WHERE `ID_Weapons`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            $resources['Money'] += $Money_gained;
            $update_Money = mysqli_query($link, "UPDATE `resources` SET `Money`='".$resources['Money']."' 
                                        WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
            include("update_stats.php");
            echo("You have sold weapons!");
        }
    }
    ?>
    <center><h2>Your Weapons</h2></center>
    <br />
    You can buy and sell weapons here.
    <br /><br />
    <h5>Buy Weapons</h5>
    <form action="weapons.php" method="post">
    <table cellpadding="5" cellspacing="5">
        <tr>
        	<td><b>Weapon Type</b></td>
            <td><b>Weapon Name</b></td>
            <td><b>Number of Weapons</b></td>
            <td><b>Cost</b></td>
            <td><b>Sell More</b></td>
        </tr>
        <tr>
        	<td>Offensive</td>
            <td>Guns</td>
            <td><?php echo number_format($weapon['Guns']); ?></td>
            <td>$10</td>
            <td><input type="text" name="Guns" value="0"/></td>
        </tr>
        <tr>
        	<td>Offensive</td>
            <td>Tanks</td>
            <td><?php echo number_format($weapon['Tanks']); ?></td>
            <td>$100</td>
            <td><input type="text" name="Tanks" value="0"/></td>
        </tr>
        <tr>
        	<td>Offensive</td>
            <td>Bombers</td>
            <td><?php echo number_format($weapon['Bombers']); ?></td>
            <td>$100</td>
            <td><input type="text" name="Bombers" value="0"/></td>
        </tr>
        <tr>
        	<td>Defensive</td>
            <td>Barricades</td>
            <td><?php echo number_format($weapon['Barricades']); ?></td>
            <td>$10</td>
            <td><input type="text" name="Barricades" value="0"/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="buy" value="Buy"/></td>
        </tr>
    </table>
    </form>
    <hr />
    <h5>Sell Weapons</h5>
    <form action="weapons.php" method="post" >
    <table cellpadding="5" cellspacing="5">
        <tr>
        	<td><b>Weapon Type</b></td>
            <td><b>Weapon Name</b></td>
            <td><b>Number of Weapons</b></td>
            <td><b>Gain</b></td>
            <td><b>Sell More</b></td>
        </tr>
        <tr>
        	<td>Offensive</td>
            <td>Guns</td>
            <td><?php echo number_format($weapon['Guns']); ?></td>
            <td>$8</td>
            <td><input type="text" name="Guns" value="0"/></td>
        </tr>
        <tr>
        	<td>Offensive</td>
            <td>Tanks</td>
            <td><?php echo number_format($weapon['Tanks']); ?></td>
            <td>$80</td>
            <td><input type="text" name="Tanks" value="0"/></td>
        </tr>
        <tr>
        	<td>Offensive</td>
            <td>Bombers</td>
            <td><?php echo number_format($weapon['Bombers']); ?></td>
            <td>$80</td>
            <td><input type="text" name="Bombers" value="0"/></td>
        </tr>
        <tr>
        	<td>Defensive</td>
            <td>Barricades</td>
            <td><?php echo number_format($weapon['Barricades']); ?></td>
            <td>$8</td>
            <td><input type="text" name="Barricades" value="0"/></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td><input type="submit" name="sell" value="Sell"/></td>
        </tr>
    </table>
    </form>
<?php
}
include("footer.php");
?>