<?php
	//DATABASE CONNECTION
	 $dbserver 		= "localhost";
	 $dbusername 	= "root";
	 $dbpassword 	= "rdFruepjiUbGMi69";
	 $db 			= "gc-low";
	
	//CREATE CONNECTION
	$link = mysqli_connect($dbserver, $dbusername, $dbpassword, $db);
	
//battle config	
	//Attack power percentage
	$aep = 0.1;
	//max ratio
	$mratio = 0.15;
	//village def
	$vdef = 3.5;
	//city def
	$cdef = 6.5;
	//city cap rate
	$ccr = 1;
	//village cap rate
	$vcr = 1;
	//bank and storehouse save rate
	$basS = 100;
//Unit config
	//tier 1 units buy
	$tr1b = 10;
	//tier 1 units sell
	$tr1s = 8;
	//tier 2 units buy
	$tr2b = 50;
	//tier 2 units sell
	$tr2s = 40;
//stat updates config
	//base attack/def
	$bad1 = 10;
	$bad2 = 5;
	//tank attack
	$tankA = 20;
	$tankB = 10;
	//bomber attack
	$bombA = 50;
	$bombB = 10;
	//offense on defense
	$offOD = 5;
	//village def
	$villdef = 20;
	//city def
	$citydef = 50;
	//farm inc
	$farmInc = 5;
	//factory inc
	$facInc = 5;
	//worker inc
	$workInc = 2;
	//farmer inc
	$farmerInc = 3;
	//city and village income
	$villIncFarm = 10;
	$cityIncFarm = 15;
//buildings config
	//storehouse buy
	$storeb = 200;
	//farm buy
	$farmb = 100;
	//factory buy
	$factb = 100;
	//bank buy
	$bankb = 200;
	//village buy
	$villageb = 2000;
	//city buy
	$cityb = 20000;
	//storehouse sell
	$storeS = 160;
	//farm sell
	$farmS = 80;
	//factory sell
	$factS = 80;
	//bank se;;
	$bankS = 160;
	//village sell
	$villageS = 1600;
	//city sell
	$cityS = 16000;
//weapons config
	//tier 1 buys
	$wtr1b = 10;
	//tier 2 buys
	$wtr2b = 100;
	//tier 1 buys
	$wtr1s = 8;
	//tier 2 buys
	$wtr2s = 80;
	
	
	
	
	
	
	
?>