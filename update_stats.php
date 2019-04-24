<?php

include('config.php');

$income = ($workInc * pow($unit['Workers'], 0.5)) + ($facInc * $building['Factory']) + ($villIncFarm * $building['Village']) + ($cityIncFarm * $building['City']);

$farming = $farmerInc * pow($unit['Farmers'],0.5) + ($farmInc * $building['Farm']) + ($villIncFarm * $building['Village']) + ($cityIncFarm * $building['City']);

$soldier_attack = mysqli_query($link, "SELECT * FROM `units` WHERE `ID_Unit`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$u_check = mysqli_fetch_assoc($soldier_attack);
$weapon_attack = mysqli_query($link, "SELECT * FROM `weapons` WHERE `ID_Weapons`='".$_SESSION['uid']."'") or die(mysqli_error($link));
$w_check = mysqli_fetch_assoc($weapon_attack);


if($u_check['Soldiers'] == $w_check['Guns']){
    $attackS = $bad1 * $weapon['Guns'];
}else{
    $attackS = $bad2 * $u_check['Soldiers'];
}

if($u_check['Drivers'] == $w_check['Tanks']){
    $attackT = $tankA * $weapon['Tanks'];
}else{
    $attackT = $tankB * $u_check['Drivers'];
}

if($u_check['Pilots'] == $w_check['Bombers']){
    $attackB = $bombA * $weapon['Bombers'];
}else{
    $attackB = $bombB * $u_check['Pilots'];
}

$attack = $attackS + $attackB + $attackT;

if($u_check['Guards'] == $w_check['Barricades']){
    $defenseG = $bad1 * $weapon['Barricades'] + ($offOD * $unit['Soldiers']) + ($offOD * $unit['Drivers']) + ($offOD * $unit['Pilots']);
}else{
    $defenseG = $bad2 * $unit['Guards'] + ($offOD * $unit['Soldiers']) + ($offOD * $unit['Drivers']) + ($offOD * $unit['Pilots']);
}

$defense = $defenseG + ($villdef * $building['Village']) + ($citydef * $building['City']);

$update_stats = mysqli_query($link, "UPDATE `resources` SET 
                            `income`='".$income."',`farming`='".$farming."',
                            `attack`='".$attack."',`defense`='".$defense."'
                            WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));

?>