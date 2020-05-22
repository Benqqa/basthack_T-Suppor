<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Заявка';
	if(check_cookie()){
		include_once('form.php');
		include_once('../module/header.php');
	}
	else{
		create_refer('task_choise');
		header('Location: ../auth');
	}
	
?> 
