<?php
session_start();
include("header.php");
if(!isset($_SESSION['uid'])){
    echo "You must be logged in to view this page!";
}else{
    if(!isset($_GET['id'])){
        output("You have visited this page incorrectly!");
    }else{
        $id = $_GET['id'];
        $user_check = mysqli_query($link, "SELECT * FROM `users` WHERE `ID_User`='".$id."'") or die(mysqli_error($link));
        if(mysqli_num_rows($user_check) == 0){
            output("There is no user with that ID!");
        }else{
            $s_user = mysqli_fetch_assoc($user_check);
            $stats_stats = mysqli_query($link, "SELECT * FROM `resources` WHERE `ID_Resrc`='".$id."'") or die(mysqli_error($link));
            $s_stats = mysqli_fetch_assoc($stats_stats);
            $stats_rank = mysqli_query($link, "SELECT * FROM `rank` WHERE `ID_Rank`='".$id."'") or die(mysqli_error($link));
            $s_rank = mysqli_fetch_assoc($stats_rank);
			$stats_attack = mysqli_query($link, "SELECT `Attack` FROM `resources` WHERE `ID_Resrc`='".$_SESSION['uid']."'") or die(mysqli_error($link));
			$s_attack = mysqli_fetch_assoc($stats_attack);
            ?>
            <center><h2>Player Stats</h2></center>
            <br />
            <?php
            echo $s_user['username'];
            ?>
            <br /><br />
            <b>Rank: <?php echo $s_rank['overall']; ?></b> 
            <br />
            <b>Money: <?php echo number_format($s_stats['Money']); ?></b>
            <br />
            <b>Food: <?php echo number_format($s_stats['Food']); ?></b>
            <br />
            <b>Defense: <?php echo number_format($s_stats['Defense']); ?></b>
            <br />
            <br />
            <form action="battle.php" method="post">
            <?php
            $attacks_check = mysqli_query($link, "SELECT `ID_log` FROM `logs` WHERE `Attacker`='".$_SESSION['uid']."' AND `Defender`='".$id."' AND `time`>'".(time() - 86400)."'") or die(mysqli_error($link));
            ?>
            <i>Attacks on <?php echo $s_user['username']; ?> in the last 24 hours: (<?php echo mysqli_num_rows($attacks_check); ?>/5)</i><br />
            <?php
            if(mysqli_num_rows($attacks_check) < 5){
            ?>
            Number of Turns (1-10): <input type="text" name="turns" /> 
            <input type="submit" name="Money" value="Raid for Money" />
            <input type="submit" name="Food" value="Raid for Food" />
            <input type="submit" name="Village" value="Conquer a Village" /><b>Village Defense: <?php echo number_format($s_stats['Defense'] * 3.5); ?></b>
            <input type="submit" name="City" value="Conquer a City" /><b>City Defense: <?php echo number_format($s_stats['Defense'] * 6.5); ?></b>
            <input type="hidden" name="ID_User" value="<?php echo $id; ?>"/>
            <br />
            <br />
            <b>Your Attack Power using 10 turns: <?php echo number_format(10 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 9 turns: <?php echo number_format(9 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 8 turns: <?php echo number_format(8 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 7 turns: <?php echo number_format(7 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 6 turns: <?php echo number_format(6 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 5 turns: <?php echo number_format(5 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 4 turns: <?php echo number_format(4 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 3 turns: <?php echo number_format(3 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 2 turns: <?php echo number_format(2 * 0.1 * $s_attack['Attack']); ?></b>
            <br />
            <b>Your Attack Power using 1 turns: <?php echo number_format(1 * 0.1 * $s_attack['Attack']); ?></b>
            <?php
            }
            ?>
            </form>
            <?php
        }
    }
}
include("footer.php");
?>