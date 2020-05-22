 <?php 
	include_once('fun.php');
	//Все таски
	function last_tasks($n,$lid=0){
		if($id=check_cookie()){
			if(1<power_by_id($id)){
				$r=my_query('SELECT `id` FROM `task` WHERE `status`<1 AND `id`>'.$lid.' LIMIT '.$n.';',array(0=>$lid,1=>$n));
				if($res=mysqli_fetch_assoc($r)){
					$ar=array();
					array_push($ar,(int)$res['id']);
					while($res=mysqli_fetch_assoc($r)){
						array_push($ar,(int)$res['id']);
					}
					return json_encode($ar, JSON_UNESCAPED_UNICODE);
				}
				else{
					return "no tasks";
				}
			}
			else{
				return "no access";
			}
		}
		else{
			return "auth failed";
		}
	}
	//Все таски юзера
	function last_tasks_users($n,$lid=0){
		if($id=check_cookie()){
			if(1<power_by_id($id)){
				$r=my_query('SELECT `id` FROM `task` WHERE `user_id`='.$id.' AND `status`<1 AND `id`>'.$lid.' LIMIT '.$n.';',array(0=>$lid,1=>$n));
				if($res=mysqli_fetch_assoc($r)){
					$ar=array();
					array_push($ar,(int)$res['id']);
					while($res=mysqli_fetch_assoc($r)){
						array_push($ar,(int)$res['id']);
					}
					return json_encode($ar, JSON_UNESCAPED_UNICODE);
				}
				else{
					return "no tasks";
				}
			}
			else{
				return "no access";
			}
		}
		else{
			return "auth failed";
		}
	}
	//Информация о таске
	function task_info(){
		if(isset($_GET['id'])){
			if($id=check_cookie()){
				if(1<power_by_id($id)){
					$iid=$_GET['id'];
					$r=my_query('SELECT `title`, `subject`, `data`,`create_date`,`user_id`,`status` FROM `task` WHERE `id`='.$iid.';',array(0=>$iid));
					if($res=mysqli_fetch_assoc($r)){
						return json_encode($res, JSON_UNESCAPED_UNICODE);
					}
					else{
						return "no task";
					}
				}
				else{
					return "no access";
				}
			}
			else{
				return "auth failed";
			}
		}
		else{
			return false;
		}
	}
	//Все юзеры
	function last_users($n,$lid=0){
		if($id=check_cookie()){
			$r=my_query('SELECT `id` FROM `users` WHERE `id`>'.$lid.' LIMIT '.$n.';',array(0=>$lid,1=>$n));
			if($res=mysqli_fetch_assoc($r)){
				$ar=array();
				array_push($ar,(int)$res['id']);
				while($res=mysqli_fetch_assoc($r)){
					array_push($ar,(int)$res['id']);
				}
				return json_encode($ar, JSON_UNESCAPED_UNICODE);
			}
			else{
				return "no users";
			}
		}
		else{
			return "auth failed";
		}
	}
	//Информация о юзере
	function user_info(){
		if(isset($_GET['id'])){
			if($id=check_cookie()){
				$iid=$_GET['id'];
				$r=my_query('SELECT `name`, `surname`, `image` FROM `users` WHERE `id`='.$iid.';',array(0=>$iid));
				if($res=mysqli_fetch_assoc($r)){
					if(is_null($res['image']) or$res['image']==null or$res['image']=='null' or $res['image']=='no image'){
						$res['image']='no_image.jpg';
					}
					return json_encode($res, JSON_UNESCAPED_UNICODE);
				}
				else{
					return "no user";
				}
			}
			else{
				return "auth failed";
			}
		}
		else{
			return false;
		}
	}
	//заявка выполнена
	function done($id){
		if($uid=check_cookie()){
			my_query('INSERT INTO  `task` SET value=2 WHERE `id`='.$id.' AND `user_id`='.$uid.';',array(0=>$id));
		}
	}
	//Полная информация о юзере
	function fulll_user_info(){
		if(isset($_GET['id'])){
			if($id=check_cookie()){
				if(power_by_id($id)>1){
					$iid=$_GET['id'];
					$r=my_query('SELECT * FROM `users` WHERE `id`='.$iid.';',array(0=>$iid));
					if($res=mysqli_fetch_assoc($r)){
						if(is_null($res['image']) or$res['image']==null or$res['image']=='null' or $res['image']=='no image'){
							$res['image']='no_image.jpg';
						}
						return json_encode($res, JSON_UNESCAPED_UNICODE);
					}
					else{
						return "no user";
					}
				}
				else{
					return "access denied";
				}
			}
			else{
				return "auth failed";
			}
		}
		else{
			return false;
		}
	}
	//Вывод json'a с сообщениями сапортов
	function task_chat($id,$n,$lid=0){
		if($uid=check_cookie()){
			if(power_by_id($uid)>1){
				$r=my_query('SELECT * FROM `task` WHERE `id`='.$id.';',array(0=>$id));
				if($r){
					if($res=mysqli_fetch_assoc($r)){
						$r=my_query('SELECT * FROM `chat'.$id.'`  ORDER BY `id` DESC LIMIT '.$n.';',array(0=>$n));
						if($res=mysqli_fetch_assoc($r)){
							$ar=array();
							array_push($ar,$res);
							while($res=mysqli_fetch_assoc($r)){
								array_push($ar,$res);
							}
							return json_encode($ar, JSON_UNESCAPED_UNICODE);
						}
					}
				}
			}
			else{
				$r=my_query('SELECT * FROM `task` WHERE `user_id`='.$uid.';',array(0=>$iid));
				if($res=mysqli_fetch_assoc($r)){
					$r=my_query('SELECT * FROM `chat'.$id.'`  ORDER BY `id` DESC LIMIT '.$n.';',array(0=>$lid,1=>$n));
					if($res=mysqli_fetch_assoc($r)){
						$ar=array();
						array_push($ar,$res['id']);
						while($res=mysqli_fetch_assoc($r)){
							array_push($ar,$res);
						}
						return json_encode($ar, JSON_UNESCAPED_UNICODE);
					}
				}
			}
		}
		else{
			return "auth failed";
		}
	}
	//Написать сообщение в чат
	function add_message($id,$text){
		if($uid=check_cookie()){
			my_query('INSERT INTO `chat'.$id.'` SET `owner_id`='.$uid.' ,`data`="'.$text.'";',array(0=>$id,1=>$text));
		}
	}
	//Вывод json'a с сообщениями сапортов
	function ad_chat($n){
		if($uid=check_cookie()){
			if(power_by_id($uid)>1){
				$r=my_query('SELECT * FROM `admins_chat`  ORDER BY `id` DESC LIMIT '.$n.';',array(0=>$n));
				if($res=mysqli_fetch_assoc($r)){
					$ar=array();
					array_push($ar,$res);
					while($res=mysqli_fetch_assoc($r)){
						array_push($ar,$res);
					}
					return json_encode($ar, JSON_UNESCAPED_UNICODE);
				}
			}
		}
		else{
			return "auth failed";
		}
	}
	//Написать сообщение в чат
	function add_message_adm($text){
		if(power_by_id($uid)>1){
			if($uid=check_cookie()){
				my_query('INSERT INTO `admins_chat` SET `owner_id`='.$uid.' ,`data`="'.$text.'";',array(0=>$id,1=>$text));
			}
		}
	}
?>
