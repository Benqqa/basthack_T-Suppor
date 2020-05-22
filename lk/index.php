<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Лк';
	if(check_cookie()){
		$id=get_id_by_session($_COOKIE['session'],$_COOKIE['token']);
		$arr=full_user_info($id);
		if(isset($_POST['password']) AND isset($_POST['old_password'])){
			if(update_password($id,$_POST['old_password'],$_POST['password'])){
				echo"<script>alert('Password changed');</script>";
			}
			else{
				echo"<script>alert('Incorrect password')</script>";
			}
		}
		if(!empty($_POST)){
			if(isset($_POST['name'])){
				$name=$_POST['name'];
			}
			else{
				$name=$arr['name'];
			}
			if(isset($_POST['surname'])){
				$surname=$_POST['surname'];
			}
			else{
				$surname=$arr['surname'];
			}
			if(isset($_POST['patronymic'])){
				$patronymic=$_POST['patronymic'];
			}
			else{
				$patronymic=$arr['patronymic'];
			}
			if(isset($_POST['phone'])){
				$phone=$_POST['phone'];
			}
			else{
				$phone=$arr['phone'];
			}
			if(isset($_POST['vk_id'])){
				$vk_id=$_POST['vk_id'];
			}
			else{
				$vk_id=$arr['vk_id'];
			}
			
			update_user($id,$name,$surname,$patronymic,$phone,$vk_id);
			$arr=full_user_info($id);
		}
		if(!empty($_FILES)){
			$arr=full_user_info($id);
			if($re=upload_user_img($id)){

			}
			else{
				echo"<script>alert('Something went wrong')</script>";
			}
		}
		include_once('../module/header.php');
		include_once('form.php');
	}
	else{
		create_refer('lk');
		header('Location: ../auth');
	}
	include_once('../module/footer.php');
?> 
