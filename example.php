<?php
	require_once("lunar_date.php");
	
	echo "The current Lunar time is " . lunar_date("Y-d-c ! H:i:S T, D") . ".\n";
	echo lunar_date("z") . " Lunar cycles have passed since the new year.\n";
?>