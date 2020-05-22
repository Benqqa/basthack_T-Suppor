<?php
	include_once('../functions/fun.php');
	$level=1;
	$title='Новая заявка';
	if(check_cookie()){
		$id=get_id_by_session($_COOKIE['session'],$_COOKIE['token']);
		$arr=full_user_info($id);
		if(isset($_POST['title'])AND isset($_POST['data'])AND isset($_POST['subject'])){
			if(!empty($_FILES)){
				if($re=upload_task_img($id)){
					
				}
				else{
					echo"<script>alert('Something went wrong')</script>";
				}
			}
			else{
				$re='No image';
			}
			if($tid=add_task($id,$_POST['title'],$_POST['data'],$_POST['subject'],$re)){
				header('Location: ../chat/chat.html?task='.$tid);
				//header('Location: ../chat');
			}
			else{
				echo"<script>alert('Something went wrong')</script>";
			}
		}
		include_once('../module/header.php');
		include_once('form.php');
	}
	else{
		create_refer('task');
		header('Location: ../auth');
	}
	include_once('../module/footer.php');
?> 
