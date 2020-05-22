<?php
	include_once('../functions/bot.php');
	include_once('../functions/config.php');
	include_once('../functions/fun.php');
	$input = file_get_contents('php://input');
	if ($input) {
		$token=$vk['token'];
		$arr=json_decode($input,true);
		if($arr['secret']==$vk['secretkey']){
			if($arr['type']=='confirmation'){
				echo $vk['authkey'];
			}
			elseif($arr['type']=='message_new'){
					if(!isset($arr['object']['action'])){
						if(checkMessage($arr['object']['id'])){
							$user_id = $arr['object']['from_id'];
							if(vk_user_in_db($user_id) or $vk['allow_all']){
								if($arr['object']['text']=='start' or $arr['object']['text']=='Start' or $arr['object']['text']=='Начать' or $arr['object']['text']=='начать'){
									send_message($user_id,"Спрашивайте!"); 
								}
								else{
									if($s=bot_request($arr['object']['text'],)){
										send_message($user_id,$s);
									}
									else{
										send_message($user_id,'Ничего не найдено(');
									}
								}
							}
							else{
								send_message($user_id,'Извините, мне не разрешено отвечать Вам...');
							}
						}
					}
				echo('ok');
			}
		}
	}


	//Функции для работы с лс
	function send_message($uid,$text){
		global $token;
		$request_params = array(
			'message' => $text,
			'user_id' => $uid,
			'access_token' =>$token,
			'v' => '5.50'
		);
		$get_params = http_build_query($request_params);
		$save=file_get_contents('https://api.vk.com/method/messages.send?'. $get_params);
	}
	function checkMessage($mid){

		$query='SELECT * FROM `messages` WHERE `message_id`='.$mid.';';
		if($res= my_query('SELECT * FROM `messages` WHERE `message_id`='.$mid.';')){
			if($res=mysqli_fetch_assoc($res)){
			}
			else{
				$ret=true;
				my_query('INSERT INTO `messages` set `message_id`='.$mid.', `date`='.time().';');
			}
		}
		
	return $ret;
	}
?>
