<?php
    //MYSQL конфигурация базы данных
	$mysql=array(
	'host'		=>'127.0.0.1',
	'user'		=>'user',
	'password'	=>'password',
	'dbname'	=>'dbname'
	);
	//Адреса и ссылки
	$links=array(
	'site'      =>'https://besthack.newpage.xyz'
	);
	$mail_config=array(
        'smtp_username' => 'smtp_username@mail',
        'sender_name'	=> 'smtp_username@mail',
        'smtp_port'     => '465',
        'smtp_host'     => 'ssl://smtp.mail.ru',
        'smtp_password' => 'smtp_password'
	);
	$support_mail=array(
		'smtp_username' => 'smtp_username@mail',
        'sender_name'	=> 'smtp_username@mail',
        'imap_login'	=> 'smtp_username@mail',
        'imap_password'	=> 'support-pass',
        'imap_adress'	=> 'imap.mail.ru:993/imap/ssl',
        'smtp_port'     => '465',
        'smtp_host'     => 'ssl://smtp.mail.ru',
        'smtp_password' => 'smtp_password'
	);
	$constants =array(
		'max_coast'=>100000
	);
	$vk= array(
	'secretkey'=>"code",
	'authkey'=>"867ab481",
	'allow_all'=>false,
	'token'=>'eb71f0053b1e55548505f92baede3f3f9efef1e45bddabb54dc2df572d07921092e566b9b2ff49d553ff'//Ключ для взаимодействия с api
	);
?>
