<?php
	include_once('../functions/api.php');
	if(isset($_GET['text'])){
		echo add_message_adm($_GET['text']);
	}
?> 
