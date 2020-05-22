<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Админъка';
	?>
<?php
	if(check_cookie()){
		$id=get_id_by_session($_COOKIE['session'],$_COOKIE['token']);
			if(power_by_id($id)>2){
			if(isset($_POST['q']) AND isset($_POST['ans'])){
				if(add_cmd($_POST['q'],$_POST['ans'])){
					echo "All Ok";
				}
				else{
					echo "Something went wrong";
				}
			}
			if(isset($_POST['faq'])){
				if(add_user_faq($_POST['faq'])){
					echo "All Ok";
				}
				else{
					echo "Something went wrong";
				}
			}
			include_once('../module/header.php');
			include_once('forms.php');
			include_once('../module/footer.php');
		}
		else{
			create_refer('add_chat');
			header('Location: ../404.html');
		}
	}
	else{
		create_refer('add_chat');
		header('Location: ../auth');
	}
?>
