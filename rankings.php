<?php
session_start();
include("header.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    ?>
    <center><h2>Battle Players</h2></center>
    <br />
    <table cellpadding="2" cellspacing="2">
        <tr>
            <td width="50px"><b>Rank</b></td>
            <td width="150px"><b>Username</b></td>
            <td width="100px"><b>Money</b></td>
            <td width="100px"><b>Food</b></td>
            <td width="150px"><b>Defense</b></td>
        </tr>
        <?php
        $get_users = mysqli_query($link, "SELECT `ID_Rank`,`overall` FROM `rank` WHERE `overall`>'0' ORDER BY `overall` ASC") or die(mysqli_error($link));
        while($row = mysqli_fetch_assoc($get_users)){
            echo "<tr>";
            echo "<td>" . $row['overall'] . "</td>";
            $get_user = mysqli_query($link, "SELECT `username` FROM `users` WHERE `ID_USER`='".$row['ID_Rank']."'") or die(mysqli_error($link));
            $rank_name = mysqli_fetch_assoc($get_user);
            echo "<td><a href=\"stats.php?id=" .$row['ID_Rank']."\">" . $rank_name['username'] . "</a></td>";
            $get_Money = mysqli_query($link, "SELECT `Money` FROM `resources` WHERE `ID_Resrc`='".$row['ID_Rank']."'") or die(mysqli_error($link));
            $rank_Money = mysqli_fetch_assoc($get_Money);
            echo "<td>" . number_format($rank_Money['Money']) . "</td>";
			$get_Food = mysqli_query($link, "SELECT `Food` FROM `resources` WHERE `ID_Resrc`='".$row['ID_Rank']."'") or die(mysqli_error($link));
            $rank_Food = mysqli_fetch_assoc($get_Food);
            echo "<td>" . number_format($rank_Food['Food']) . "</td>";
			$get_def = mysqli_query($link, "SELECT `Defense` FROM `resources` WHERE `ID_Resrc`='".$row['ID_Rank']."'") or die(mysqli_error($link));
            $rank_def = mysqli_fetch_assoc($get_def);
            echo "<td>" . number_format($rank_def['Defense']) . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <?php
}
include("footer.php");
?>