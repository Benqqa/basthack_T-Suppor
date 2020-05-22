<?php
	include_once('../functions/api.php');
	if(isset($_GET['id']) AND isset($_GET['text'])){
		echo add_message($_GET['id'],$_GET['text']);
	}
?> 
