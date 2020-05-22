<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Авторизация';
	?>
<?php
	if(!check_cookie()){
		if(isset($_POST['email']) AND isset($_POST['password'])){
			if($auth=auth($_POST['email'],$_POST['password'])){
				//echo $auth;
				if($auth===true){
					goto_refer_cookie();
				}
				else{
					echo"<script>alert('Your account disables,".$auth."');</script>";
					include_once('../module/header.php');
					include_once('form.php');
				}
			}
			else{
				echo"<script>alert('wrong email or password!');</script>";
				include_once('../module/header.php');
				include_once('form.php');
			}
		}
		else{
		include_once('../module/header.php');
		include_once('form.php');
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

