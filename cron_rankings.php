<?php
include("config.php");
connect();

// Rankings Every 15 minutes

$get_Attack = mysqli_query($link, "SELECT `ID_Resrc`,`Attack` FROM `resources` ORDER BY `Attack` DESC") or die(mysqli_error($link));
$i = 1;
$rank = array();
while($Attack = mysqli_fetch_assoc($get_Attack)){
    $rank[$Attack['ID_Resrc']] = $Attack['Attack'];
    mysqli_query($link, "UPDATE `rank` SET `Attack`='".$i."' WHERE `ID_Rank`='".$Attack['ID_Resrc']."'") or die(mysqli_error($link));
    $i++;
}

$get_Defense = mysqli_query($link, "SELECT `ID_Resrc`,`Defense` FROM `resources` ORDER BY `Defense` DESC") or die(mysqli_error($link));
$i = 1;
while($Defense = mysqli_fetch_assoc($get_Defense)){
    $rank[$Defense['ID_Resrc']] += $Defense['Defense'];
    mysqli_query($link, "UPDATE `rank` SET `Defense`='".$i."' WHERE `ID_Rank`='".$Defense['ID_Resrc']."'") or die(mysqli_error($link));
    $i++;
}

asort($rank);
$rank2 = array_reverse($rank,true);
$i = 1;
foreach($rank2 as $key => $val){
    mysqli_query($link, "UPDATE `rank` SET `overall`='".$i."' WHERE `ID_Rank`='".$key."'") or die(mysqli_error($link));
    $i++;
}
?>