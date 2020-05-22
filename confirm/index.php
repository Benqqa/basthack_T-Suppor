 <?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Авторизация';
	?>
<?php
	if(!check_cookie()){
		if(isset($_GET['t'])){
			if($e=confirmer($_GET['t'])){
				if(isset($_POST['name']) AND isset($_POST['surname']) AND isset($_POST['patronymic']) AND isset($_POST['phone']) AND isset($_POST['password']) ){
					if(confirmed_reg($_GET['t'],$_POST['name'],$_POST['surname'],$_POST['patronymic'],$_POST['phone'],$_POST['password'])){
						header('Location: ../auth');
					}
					else{
						include_once('../module/header.php');
						echo "Something went wrong";
						include_once('form.php');
					}
				}
				include_once('../module/header.php');
				include_once('form.php');
			}
		}
	}
	else{
		goto_refer_cookie();
	}
	?>
</div>
<?php
	include_once('../module/footer.php');
?>
