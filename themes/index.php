<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Админъка';
	?>
<?php
	if(check_cookie()){
		$id=get_id_by_session($_COOKIE['session'],$_COOKIE['token']);
		if(power_by_id($id)>2){
			if((!empty($_FILES))AND isset($_POST['title']) AND isset($_POST['data'])){
				add_type($_POST['title'],$_POST['data']);
			}
			include_once('../module/header.php');
			include_once('forms.php');
			include_once('../module/footer.php');
		}
		else{
			create_refer('themes');
			header('Location: ../404.html');
		}
	}
	else{
		create_refer('themes');
		header('Location: ../auth');
	}
?>
