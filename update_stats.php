<?php

$income = (2 * pow($unit['Workers'], 0.5)) + (5 * $building['Factory']);

$farming = 5 * pow($unit['Farmers'],0.5) + (5 * $building['Farm']);

$num1 = min($weapon['Guns'],$unit['Soldiers'] || $weapon['Tanks'],$unit['Drivers'] || $weapon['Bombers'],$unit['Pilots']);

if($num1 == $weapon['Guns'] || $num1 == $weapon['Tanks'] || $num1 == $weapon['Bombers']){
    $attack = ((10 * $weapon['Guns']) + ($unit['Soldiers'] - $weapon['Guns'])) + ((20 * $weapon['Tanks']) + ($unit['Drivers'] - $weapon['Tanks'])) + ((50 * $weapon['Bombers']) + ($unit['Pilots'] - $weapon['Bombers'])) ;
}else{
    $attack = (10 * $unit['Soldiers']) + (10 * $unit['Drivers']) + (10 * $unit['Pilots']);
}

$num2 = min($weapon['Barricades'],$unit['Guards']) || $building['Village'] || $building['City'];

if($num2 == $weapon['Barricades']  || $num2 == $building['Village'] || $num2 == $building['City']){
    $defense = ((10 * $weapon['Barricades'] + 20 * $building['Village'] + 50 * $building['City']) + ($unit['Guards'] - $weapon['Barricades'])) + (5 * $unit['Soldiers']) + (5 * $unit['Drivers']) + (5 * $unit['Pilots']);
}else{
    $defense = (10 * $unit['Guards']);
}

$update_stats = mysqli_query($link, "UPDATE `resources` SET 
                            `income`='".$income."',`farming`='".$farming."',
                            `attack`='".$attack."',`defense`='".$defense."'
                            WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));

?>