<?php
session_start();
include("header.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    if(isset($_POST['Money'])){
    	
        $turns = $_POST['turns'];
        $id = $_POST['ID_User'];
        $user_check = mysqli_query($link, "SELECT * FROM `resources` WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
        if(mysqli_num_rows($user_check) == 0){
            echo ("There is no user with that ID!");
        }elseif($turns < 1 || $turns > 10){
            echo ("You must attack with 1-10 turns!");
        }elseif($turns > $resources['turns']){
            echo ("You do not have enough turns!");
        }elseif($id == $_SESSION['uid']){
            echo ("You cannot attack yourself!");
        }else{
        	
        	$bank_check = mysqli_query($link, "SELECT * FROM `buildings` WHERE `ID_Building`='".$id."'") or die(mysqli_error($link));
			$bank_saved = mysqli_fetch_assoc($bank_check);
            $enemy_resources = mysqli_fetch_assoc($user_check);
			$bank_s = 100 * $bank_saved['Bank'];
			$bank_minus_resources = $enemy_resources['Money'] - $bank_s;
            $attack_effect = $turns * 0.1 * $resources['Attack'];
            $defense_effect = $enemy_resources['Defense'];
            
            echo "You send your Soldiers into battle!<br><br>";
            echo "Your Soldiers dealt " . number_format($attack_effect) . " damage!<br>";
            echo "The enemy's Guards dealt " . number_format($defense_effect) . " damage!<br><br>";
            if($attack_effect > $defense_effect){
                $ratio = ($attack_effect - $defense_effect)/$attack_effect * $turns;
                $ratio = min($ratio,.15);
                $Money_stolen = floor($ratio * $bank_minus_resources);
                echo "You won the battle! You stole " . $Money_stolen . " Money!";
                $battle1 = mysqli_query($link, "UPDATE `resources` SET `Money`=`Money`-'".$Money_stolen."' WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
                $battle2 = mysqli_query($link, "UPDATE `resources` SET `Money`=`Money`+'".$Money_stolen."',`turns`=`turns`-'".$turns."' WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
                $battle3 = mysqli_query($link, "INSERT INTO `logs` (`attacker`,`defender`,`attacker_damage`,`defender_damage`,`Money`,`Food`,`village`,`city`,`time`) 
                                        VALUES ('".$_SESSION['uid']."','".$id."','".$attack_effect."','".$defense_effect."','".$Money_stolen."','0','0','0','".time()."')") or die(mysqli_error($link));
                $resources['Money'] += $Money_stolen;
                $resources['turns'] -= $turns;
            }else{
                echo "You lost the battle!";
            }
        }
    }elseif(isset($_POST['Food'])){
        $turns = $_POST['turns'];
        $id = $_POST['ID_User'];
        $user_check = mysqli_query($link, "SELECT * FROM `resources` WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
        if(mysqli_num_rows($user_check) == 0){
            echo ("There is no user with that ID!");
        }elseif($turns < 1 || $turns > 10){
            echo ("You must attack with 1-10 turns!");
        }elseif($turns > $resources['turns']){
            echo ("You do not have enough turns!");
        }elseif($id == $_SESSION['uid']){
            echo ("You cannot attack yourself!");
        }else{
        	$storehouse_check = mysqli_query($link, "SELECT * FROM `buildings` WHERE `ID_Building`='".$id."'") or die(mysqli_error($link));
			$storehouse_saved = mysqli_fetch_assoc($storehouse_check);
            $enemy_resources = mysqli_fetch_assoc($user_check);
			$storehouse_s = 100 * $storehouse_saved['Storehouse'];
			$storehouse_minus_resources = $enemy_resources['Food'] - $storehouse_s;
            $attack_effect = $turns * 0.1 * $resources['Attack'];
            $defense_effect = $enemy_resources['Defense'];
            
            echo "You send your Soldiers into battle!<br><br>";
            echo "Your Soldiers dealt " . number_format($attack_effect) . " damage!<br>";
            echo "The enemy's Guards dealt " . number_format($defense_effect) . " damage!<br><br>";
            if($attack_effect > $defense_effect){
                $ratio = ($attack_effect - $defense_effect)/$attack_effect * $turns;
                $ratio = min($ratio,.15);
                $Food_stolen = floor($ratio * $storehouse_minus_resources);
                echo "You won the battle! You stole " . $Food_stolen . " Food!";
                $battle1 = mysqli_query($link, "UPDATE `resources` SET `Food`=`Food`-'".$Food_stolen."' WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
                $battle2 = mysqli_query($link, "UPDATE `resources` SET `Food`=`Food`+'".$Food_stolen."',`turns`=`turns`-'".$turns."' WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
                $battle3 = mysqli_query($link, "INSERT INTO `logs` (`attacker`,`defender`,`attacker_damage`,`defender_damage`,`Money`,`Food`,`village`,`city`,`time`) 
                                        VALUES ('".$_SESSION['uid']."','".$id."','".$attack_effect."','".$defense_effect."','0','".$Food_stolen."','0','0','".time()."')") or die(mysqli_error($link));
                $resources['Food'] += $Food_stolen;
                $resources['turns'] -= $turns;
            }else{
                echo "You lost the battle!";
            }
        }
    }elseif(isset($_POST['Village'])){
        $turns = $_POST['turns'];
        $id = $_POST['ID_User'];
        $user_check = mysqli_query($link, "SELECT * FROM `resources` WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
        if(mysqli_num_rows($user_check) == 0){
            echo ("There is no user with that ID!");
        }elseif($turns < 1 || $turns > 10){
            echo ("You must attack with 1-10 turns!");
        }elseif($turns > $resources['turns']){
            echo ("You do not have enough turns!");
        }elseif($id == $_SESSION['uid']){
            echo ("You cannot attack yourself!");
        }else{
            $enemy_resources = mysqli_fetch_assoc($user_check);
            $attack_effect = $turns * 0.1 * $resources['Attack'];
            $defense_effect = $enemy_resources['Defense'] * 3.5 ;
            
            echo "You send your Soldiers into battle!<br><br>";
            echo "Your Soldiers dealt " . number_format($attack_effect) . " damage!<br>";
            echo "The enemy's Guards dealt " . number_format($defense_effect) . " damage!<br><br>";
            if($attack_effect > $defense_effect){
                $village_stolen = 1;
                echo "You won the battle! You conquered " . $village_stolen . " village!";
                $battle1 = mysqli_query($link, "UPDATE `buildings` SET `Village`=`Village`-'".$village_stolen."' WHERE `ID_Building`='".$id."'") or die(mysqli_error($link));
                $battle2 = mysqli_query($link, "UPDATE `buildings` SET `Village`=`Village`+'".$village_stolen."' WHERE `ID_Building`='".$_SESSION['uid']."'") or die(mysqli_error($link));
				$battle3 = mysqli_query($link, "UPDATE `resources` SET `turns`=`turns`-'".$turns."' WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));;
                $battle4 = mysqli_query($link, "INSERT INTO `logs` (`attacker`,`defender`,`attacker_damage`,`defender_damage`,`Money`,`Food`,`village`,`city`,`time`) 
                                        VALUES ('".$_SESSION['uid']."','".$id."','".$attack_effect."','".$defense_effect."','0','0','".$village_stolen."','0','".time()."')") or die(mysqli_error($link));
                $building['Village'] += $village_stolen;
                $resources['turns'] -= $turns;
            }else{
                echo "You lost the battle!";
            }
        }
    }elseif(isset($_POST['City'])){
        $turns = $_POST['turns'];
        $id = $_POST['ID_User'];
        $user_check = mysqli_query($link, "SELECT * FROM `resources` WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
        if(mysqli_num_rows($user_check) == 0){
            echo ("There is no user with that ID!");
        }elseif($turns < 1 || $turns > 10){
            echo ("You must attack with 1-10 turns!");
        }elseif($turns > $resources['turns']){
            echo ("You do not have enough turns!");
        }elseif($id == $_SESSION['uid']){
            echo ("You cannot attack yourself!");
        }else{
            $enemy_resources = mysqli_fetch_assoc($user_check);
            $attack_effect = $turns * 0.1 * $resources['Attack'];
            $defense_effect = $enemy_resources['Defense'] * 6.5 ;
            
            echo "You send your Soldiers into battle!<br><br>";
            echo "Your Soldiers dealt " . number_format($attack_effect) . " damage!<br>";
            echo "The enemy's Guards dealt " . number_format($defense_effect) . " damage!<br><br>";
            if($attack_effect > $defense_effect){
                $city_stolen = 1;
                echo "You won the battle! You conquered " . $city_stolen . " city!";
                $battle1 = mysqli_query($link, "UPDATE `buildings` SET `City`=`City`-'".$city_stolen."' WHERE `ID_Building`='".$id."'") or die(mysqli_error($link));
                $battle2 = mysqli_query($link, "UPDATE `buildings` SET `City`=`City`+'".$city_stolen."' WHERE `ID_Building`='".$_SESSION['uid']."'") or die(mysqli_error($link));
				$battle3 = mysqli_query($link, "UPDATE `resources` SET `turns`=`turns`-'".$turns."' WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));;
                $battle4 = mysqli_query($link, "INSERT INTO `logs` (`attacker`,`defender`,`attacker_damage`,`defender_damage`,`Money`,`Food`,`village`,`city`,`time`) 
                                        VALUES ('".$_SESSION['uid']."','".$id."','".$attack_effect."','".$defense_effect."','0','0','0','".$city_stolen."','".time()."')") or die(mysqli_error($link));
                $building['City'] += $city_stolen;
                $resources['turns'] -= $turns;
            }else{
                echo "You lost the battle!";
            }
        }
    }
    
    
    else{
        echo ("You have visited this page incorrectly!");
    }
}
include("footer.php");
?>