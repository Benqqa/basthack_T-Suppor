<?php
	include_once('../functions/api.php');
	if(isset($_GET['n'])){
		$n=$_GET['n'];
	}
	else{
		$n=10;
	}
	if(isset($_GET['lid'])){
		$lid=$_GET['lid'];
	}
	else{
		$lid=0;
	}
	echo last_tasks_users($n,$lid);
?> 
