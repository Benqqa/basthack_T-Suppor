<?php
	include_once('../functions/bot.php');
	include_once('../functions/config.php');
	include_once('../functions/fun.php');
	if(check_cookie()){
		if(isset($_GET['text'])){
			echo bot_request($_GET['text']);
		}
	}
?> 
