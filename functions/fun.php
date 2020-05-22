<?php
	include_once('config.php');
	//Функция для безопасных SQL запросов, первый аргумент - текст запроса в бд, второй - массив из экранируемых строк
	function my_query($q, $for_safe=array()){
		global $mysql;
		$link = mysqli_connect($mysql['host'], $mysql['user'], $mysql['password'], $mysql['dbname']);
		if(!empty($for_safe)){
			foreach($for_safe as $text){
				mysqli_real_escape_string($link,$text);
			}
		}
		$res=false;
		if($link){
			$res=mysqli_query($link,$q);
			mysqli_close($link);
		}
		return $res;
	}
	//Сгененрировать строку в 64 символа
	function gen_token() {//Генератор токенов
		$token =  hash('sha256',microtime() . 'salt' . time());
		return $token;
	}
	//Функция авторизации, вводится email и пароль
	function auth($email,$password){
		$ret=false;
		$res=my_query('SELECT * FROM `users` WHERE `email`="'.$email.'" AND `password`="'. hash('sha256',$password).'";',array(0=>$email,1=>$password));
			if($result=mysqli_fetch_assoc($res)){
				if((int)$result['value']>0){
					$session=gen_token();
					$token=gen_token();
					create_web_session($session,$token,$result['id']);
					$id=id_by_mail($email);
					$ret=true;
				}
				else{
					$ret="NA";
				}
			}
		return $ret;
	}
	//Функция, создющая куки и пишет в бд
	function create_web_session($session,$token,$id){
		$res=my_query('INSERT INTO `connections` SET session="'.$session.'", token="'.$token.'",user_id="'.$id.'";',array(0=>$session,1=>$token));
		create_st_cookie($session,$token);
	}
	//Функция для проверки валидности сессии в браузере
	function check_cookie(){
		$ret=false;
		if(isset($_COOKIE['session']) AND isset($_COOKIE['token'])){
			$session=$_COOKIE['session'];
			$token=$_COOKIE['token'];
			$res=my_query('SELECT * FROM `connections` WHERE session="'.$session.'" AND token="'.$token.'";',array(0=>$session,1=>$token));
			if($res=mysqli_fetch_assoc($res)){
				$ret=true;
				//change_cookie($_COOKIE['session'],$_COOKIE['token']);
			}
		}
		return $ret;
	}
	//Функция для изменения токена
	function change_cookie($session,$token){
		$token=gen_token();
		$res=my_query('UPDATE `connections` SET token="'.$token.'"  WHERE session="'.$session.'";',array(0=>$session,1=>$token));
		create_st_cookie($session,$token);
	}
	//Создать сессию+токен в коках
	function create_st_cookie($session,$token){
		setcookie("session", $session, time()+3600000, "/");
		setcookie("token", $token, time()+3600000, "/");
	}
	//Получить id по сессии
	function get_id_by_session($session,$token){
		$res=my_query('SELECT * FROM `connections` WHERE session="'.$session.'";',array(0=>$session,1=>$token));
		if($r=mysqli_fetch_assoc($res)){
			return $r['user_id'];
		}
	}
	//Переход на рефер ссылку
	function goto_refer_cookie(){
		global $links;
		$ref='Location: '.$links['site'];
		if(isset($_COOKIE["refer"])){
			$ref='Location: ../'.$_COOKIE["refer"];
			unset($_COOKIE['refer']);
			setcookie('refer', null, -1, '/');
		}
		header($ref);
		exit();
	}
	//Функция создания рефера
	function create_refer($place){
		setcookie("refer", $place, time()+3600000, "/");
	}
	//Функция деавторизации юзера
	function deauth(){
		if(isset($_COOKIE['sesion'])){
			unset($_COOKIE['session']);
			setcookie('session', null, -1, '/');
		}
		if(isset($_COOKIE['token'])){
			unset($_COOKIE['token']);
			setcookie('token', null, -1, '/');
		}
		header('Location: ../');
	}
	//Функция отправки почты, указать отправителя, тему, текст письма
	function smtp_send($to,$subject,$body,$from){
		global $mail_config;
		require_once "SendMailSmtpClass.php"; // Сторонний код для smtp
		$mailSMTP = new SendMailSmtpClass($mail_config['smtp_username'], $mail_config['smtp_password'], $mail_config['smtp_host'], $mail_config['sender_name'], $mail_config['smtp_port']);
		// заголовок письма
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
		$headers .= "From: '".$from."'<".$mail_config['sender_name'].">\r\n"; // от кого письмо
		$result =  $mailSMTP->send($to, $subject, $body, $headers); // отправляем письмо
		return $result;
	}
	//Функция отправки почты с сапорта
	function smtp_send_support($to,$subject,$body){
		global $support_mail;
		require_once "SendMailSmtpClass.php"; // Сторонний код для smtp
		$mailSMTP = new SendMailSmtpClass($support_mail['smtp_username'], $support_mail['smtp_password'], $support_mail['smtp_host'], $support_mail['sender_name'], $support_mail['smtp_port']);
		// заголовок письма
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
		$headers .= "From: Служба поддержки<".$support_mail['sender_name'].">\r\n"; // от кого письмо
		$result =  $mailSMTP->send($to, $subject, $body, $headers); // отправляем письмо
		return $result;
	}
	//Загрузка картинки
	function upload_img($uploaddir){
		global $_FILES;
		$ret=false;
		$user_file_name=$_FILES['userfile']['name'];
		$type=false;
		if(substr($user_file_name,strlen($_FILES['userfile']['name'])-4)==".gif"){
			$type=".gif";
		}
		elseif(substr($user_file_name,strlen($_FILES['userfile']['name'])-4)==".jpg"){
			$type=".jpg";
		}
		elseif(substr($user_file_name,strlen($_FILES['userfile']['name'])-5)==".jpeg"){
			$type=".jpeg";
		}
		elseif(substr($user_file_name,strlen($_FILES['userfile']['name'])-4)==".bmp"){
			$type=".bmp";
		}
		elseif(substr($user_file_name,strlen($_FILES['userfile']['name'])-4)==".png"){
			$type=".png";
		}
		if($type){
			$filename=gen_token().$type;
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploaddir.$filename)) {
				$ret=$filename;
			}
		}
		return $ret;
	}
	//Обращение к загрузке лого пользователя
	function upload_user_img($id){
		if($re= upload_img('../img/user_icon/')){
			my_query('UPDATE `users` SET `image`="'. $re.'" WHERE `id`="'.$id.'";',array(0=>$id));
			return true;
		}
		else{
			return false;
		}
	}
	//Обращение к загрузке изображения таска
	function upload_task_img($id){
		if($re= upload_img('../img/tasks/')){
			return $re;
		}
		else{
			return false;
		}
	}
	//Вывести всю информацию о пользователе
	function full_user_info($id){
		$res=my_query('SELECT * from `users` WHERE `id`="'.$id.'";',array(0=>$id));
		if($re=mysqli_fetch_assoc($res)){
			return $re;
		}
		else{
			return false;
		}
	}
	//Смена пароля
	function update_password($id,$old,$new){
		$ret=false;
		$res=my_query('SELECT * FROM `users` WHERE `id`="'.$id.'" AND `password`="'. hash('sha256',$old).'";',array(0=>$id));
			if($result=mysqli_fetch_assoc($res)){
				my_query('UPDATE `users` SET `password`="'. hash('sha256',$new).'" WHERE `id`="'.$id.'" AND `password`="'. hash('sha256',$old).'";',array(0=>$id));
				$ret=true;
			}
		return $ret;
	}
	//Вывести права пользователя
	function power_by_id($id){
		$res=my_query('SELECT * FROM `users` WHERE `id`="'.$id.'";',array(0=>$id));
			if($result=mysqli_fetch_assoc($res)){
				return (int)$result['value'];
			}
			else{
				return false;
			}
	}
	//Добавить пользователя
	function add_user($email,$value){
		if(check_mail($email)){
			global $links;
			$t=gen_token();
			$res=my_query('INSERT INTO `confirmations` SET `email`="'.$email.'", `value` ="'.$value.'",token="'.$t.'";',array(0=>$email,1=>$value));
			$text="<h1>Подтверждение регистрации</h1><br>".$email.", вы получили данное письмо, так как был зарегистрированы в системе %System%. Для окончания регистрации перейдите по ссылке".'<a href="'.$links['site'].'/confirm?t='.$t.'">'.$links['site'].'/confirm?t='.$t.'</a>' ;
			$m=smtp_send($email,"Регистрация нового пользователя",$text,"sendbot newpage.xyz");
			if($m){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	//Функция проверки свободности имейла
	function check_mail($email){
		$res=my_query('SELECT * FROM `users` WHERE email="'.$email.'";',array(0=>$email));
		if(mysqli_fetch_assoc($res)){
			return false;
		}
		else{
			return true;
		}
	}
	//Функция регистрации пользователя,вводить имя, фамилию, email, пароль
	function reg_user($name,$surname,$patronymic,$phone,$email,$password,$value){
		if(check_mail($email)){
			my_query('INSERT INTO `users` set `value`='.$value.', `name`="'.$name.'", `patronymic`="'.$patronymic.'", `surname`="'.$surname.'", `email`="'.$email.'", `phone`="'.$phone.'",`password`="'. hash('sha256',$password).'";',array(0=>$email,1=>$password,2=>$name,3=>$surname,4=>$patronymic,5=>$phone));
			return true;
		}
		else{
			return false;
		}
	}
	//Регистрация по подтверждению
	function confirmed_reg($token,$name,$surname,$patronymic,$phone,$password){
		$ret=false;
		if($a=confirmer($token)){
			$ret=reg_user($name,$surname,$patronymic,$phone,$a[0],$password,$a[1]);
			if($ret){
				$res=my_query('DELETE FROM `confirmations` WHERE token="'.$token.'";',array(0=>$token));
			}
		}
		return $ret;
	}
	//Проверить наличие разрешения на регистрацию
	function confirmer($token){
		$ret=false;
		$res=my_query('SELECT `email`,`value` FROM `confirmations` WHERE token="'.$token.'";',array(0=>$token));
		if($r=mysqli_fetch_assoc($res)){
			$ret=array(0=>$r['email'],1=>$r['value']);
		}
		return $ret;
	}
	//Обновить информацию о пользователе
	function update_user($id,$name,$surname,$patronymic,$phone,$vk_id){
		my_query('UPDATE `users` set `name`="'.$name.'", `patronymic`="'.$patronymic.'", `surname`="'.$surname.'",`phone`="'.$phone.'",`vk_id`="'.$vk_id.'" where id='.$id.';',array(0=>$vk_id,1=>$name,2=>$surname,3=>$patronymic,4=>$phone));
	}
	//Вывод допустимых причин обращения
	function reason_selector(){
		echo "<select name='subject'>";
		$res=my_query('SELECT * from `subjects`;');	
		while($r=mysqli_fetch_assoc($res)){
				echo "<option value='".$r['id']."'>".$r['name']."</option>";
			}

		echo "</select>";			
	}
	//Вывод допустимых причин типов
	function type_selector(){
		echo "<select name='type'>";
		$res=my_query('SELECT * from `types`;');	
		while($r=mysqli_fetch_assoc($res)){
				echo "<option value='".$r['id']."'>".$r['name']."</option>";
			}

		echo "</select>";			
	}
	//Добавить заявку
	function add_task($user_id,$title,$text,$subject,$img){
		my_query('INSERT INTO `task` set `status`=0, `user_id`='.$user_id.',`subject`='.$subject.',`data`="'.$text.'",`title`="'.$title.'",`img`="'.$img.'";',array(0=>$subject,1=>$text,2=>$title,3=>$img));
		$r=my_query('SELECT * FROM `task` WHERE `user_id`='.$user_id.' ORDER BY id DESC;');
		if($res=mysqli_fetch_assoc($r)){
			my_query('CREATE TABLE `chat'.$res['id'].'` LIKE `chat_example`');
			return $res['id'];
		}
		return false;
	}
	//Добавить таск по емайл
	function add_mail_task($email,$title,$text){
		if($id=id_by_mail($email)){
			my_query('INSERT INTO `task` set `status`=0, `user_id`='.$id.',`subject`=0,`data`="'.$text.'",`title`="'.$title.'",`is_email`=1;',array(0=>$text,1=>$title));
			$r=my_query('SELECT * FROM `task` WHERE `user_id`='.$id.' ORDER BY id DESC;');
			if($res=mysqli_fetch_assoc($r)){
				my_query('CREATE TABLE `chat'.$res['id'].'` LIKE `chat_example`');
				smtp_send_support($email,'Заша заявка принята','Заявка принята и ожидает специалиста');
				return $res['id'];
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}
	//Проверка доступа из вк
	function vk_user_in_db($id){
		$res=my_query('SELECT * FROM `users` WHERE `vk_id`="'.$id.'";',array(0=>$id));
		if($result=mysqli_fetch_assoc($res)){
			return true;
		}
		else{
			return false;
		}
	}
	//Добавить новый faq
	function add_user_faq($text){
		my_query('INSERT INTO `faq` set text="'.$text.'";',array(0=>$text));
		return true;
	}
	//Добавить новый вопрос
	function add_cmd($input,$output){
		my_query('INSERT INTO `command` set input="'.$input.'",output="'.$output.'";',array(0=>$input,0=>$output));
		return true;
	}
	//Функция получения id по имейла
	function id_by_mail($email){
		$res=my_query('SELECT `id` FROM `users` WHERE email="'.$email.'";',array(0=>$email));
		if($r=mysqli_fetch_assoc($res)){
			return $r['id'];
		}
		else{
			return false;
		}
	}
	//Проверить почту
	function get_mails(){
		global $support_mail;
		$connect = imap_open("{".$support_mail['imap_adress']."}", $support_mail['imap_login'], $support_mail['imap_password']);
		if(!$connect){
			return false;
		}
		else{
			$msg_num = imap_num_msg($connect);
			$from=array();
			for($i = $msg_num; $i >= 1; $i--){
				$msg_header = imap_header($connect, $i);
				if($msg_header->Unseen=="U"){
					$sender=$msg_header->from[0]->mailbox."@".$msg_header->from[0]->host;
					array_push($from,$sender);
				}
			}
			$new_mails = imap_search($connect, 'UNSEEN');
			$new_mails = implode(",", $new_mails);
			$overview = imap_fetch_overview($connect,$new_mails,0);
			$i=count($from)-1;
			$ret=array();
			foreach ($overview as $ow) {
				$subject = iconv_mime_decode($ow->subject,0,"UTF-8");
				$body = imap_fetchbody($connect,$ow->msgno,1); 
				array_push($ret,array('from'=>$from[$i],'subject'=>$subject,'body'=>base64_decode($body)));
				$i--;
			}
			imap_close($connect);
		}
		return $ret;
	}
	//Проверить почту саппорта
	function support_mail_checker(){
		if($ret=get_mails()){
			foreach($ret as $value){
				add_mail_task($value['from'],$value['subject'],$value['body']);				
			}
		}
	}
	
	//Добавить тип
	function add_type($title,$data){
		if($re= upload_img('../img/types/')){
			my_query('INSERT INTO `types` SET `name`="'.$title.'" , `img`="'. $re.'",`text`="'.$data.'";',array(0=>$title,1=>$data));
			return true;
		}
		return false;
	}
	//Вывести список типов
	function show_types($lim){
		$ret=my_query('SELECT * FROM `types` ORDER BY `id` DESC LIMIT '.$lim.';');
		$arr=array();
		while($a=mysqli_fetch_assoc($ret)){
			array_push($arr,$a);
		}
		return $arr;
	}
	//Добавить оборудование
	function add_device($title,$type,$coast,$data){
		if($re= upload_img('../img/devices/')){
			my_query('INSERT INTO `devices` SET `title`="'.$title.'", `image`="'. $re.'",`data`="'.$data.'", `type`='.$type.', `coast`='.$coast.';',array(0=>$coast,1=>$data));
			echo 'INSERT INTO `devices` SET `title`="'.$title.'", `image`="'. $re.'",`data`="'.$data.'", `type`='.$type.', `coast`='.$coast.';';
			return true;
		}
		return false;
	}
	//Добавить экземпляр оборудование
	function add_user_device($user,$dev_id,$serial,$start_date,$end_date){
		global $constants;
			$ret=my_query('SELECT * FROM `devices` WHERE `id`='.$dev_id.';');
			if($a=mysqli_fetch_assoc($ret)){
				$inuse=true;
				if($ret['coast']>$constants['max_coast']){
					$inuse=false;
					$res=user_info();
					admin_notify("Дорогостоящее оборудование","Пользвователь".$res['name']." ".$res['surname']." заказал оборудование ".$ret['title']." (".$dev_id.",) стоимостью".$ret['coast']." Необходимо подтвержедние");
				}
				my_query('INSERT INTO `user_devices` SET `in_use`='.$inuse.', `d_id`="'.$dev_id.'", `owner_id`='.$user.', `start_date`="'.date('Y-m-d', strtotime($start_date)).'", `end_date`="'.date('Y-m-d', strtotime($end_date)).'", `serial`="'.$serial.'";',array(0=>$start_date,1=>$end_date,2=>$data,3=>$serial));
				return true;
			}
		return false;
	}
	//Вывести список оборудование
	function show_device($lim){
		$ret=my_query('SELECT * FROM `devices` ORDER BY `id` DESC LIMIT '.$lim.';');
		$arr=array();
		while($a=mysqli_fetch_assoc($ret)){
			array_push($arr,$a);
		}
		return $arr;
	}
	//Вывести список поьзовательского оборудования
	function show_user_device($lim){
		$ret=my_query('SELECT * FROM `user_devices` ORDER BY `id` DESC LIMIT '.$lim.';');
		$arr=array();
		while($a=mysqli_fetch_assoc($ret)){
			array_push($arr,$a);
		}
		return $arr;
	}
	//Уведомления админу
	function admin_notify($subject,$text){
		$res=mysqli_fetch_assoc('SELECT `email` FROM `users` WHERE `status`>2');
		while($res=mysqli_fetch_assoc()){
			smtp_send($res['email'],$subject,$text,'No reply');
		}
	}
?>
