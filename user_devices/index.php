<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Админъка';
	?>
<?php
	if(check_cookie()){
		$id=get_id_by_session($_COOKIE['session'],$_COOKIE['token']);
		if(power_by_id($id)>0){
			if(ISSET($_POST['start'])AND isset($_POST['end'])AND isset($_POST['serial']) AND isset($_POST['type'])){
				add_user_device($_POST['serial'],$_POST['start'],$_POST['end'],$_POST['type']);
			}
			include_once('../module/header.php');
			include_once('forms.php');
			include_once('../module/footer.php');
		}
		else{
			create_refer('user_device');
			header('Location: ../404.html');
		}
	}
	else{
		create_refer('user_device');
		header('Location: ../auth');
	}
?>
