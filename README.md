# besthack

## Проект basthack_T-Suppor 

[Тестовый сайт](https://besthack.newpage.xyz)

## Для разворачивания на сервере необходимо:
1. Разместить файлы в корневой директории хостинга
1. Создать базу данных, фаблон для загрузке в файле sql
1. Настроить файл /functions/config.php:
  	1. Изменить параматры подключения к бд  
  'host'		=>'127.0.0.1',//Ввести ip-адрес сервера баз данных  
	'user'		=>'user',//Ввести пользователя базы данных  
	'password'	=>'password',//Ввести пароль от пользователя  
	'dbname'	=>'db_name'//Ввести название базы данных  
 	 1. Указать валидный адрес корня сайта  
    $links=array(  
	  'site'      =>'https://www.example,com'//Адрес    
	  );    
 	 1. Настроить почту для рассылок, дополнительно смтореть у хостера почтового ящика  
  $mail_config=array(       
        'smtp_username' => 'mail@mail.ru',        //Логин(чаще всего совпадает с адресом почтового ящика)  
        'sender_name'	=> 'mail@mail.ru',          //Ящик отправителя  
        'smtp_port'     => '465',                 //Порт для SMTP   
        'smtp_host'     => 'ssl://smtp.mail.ru',  //Адрес почтового сервера  
        'smtp_password' => 'pass',                //Пароль от почтового ящика  
	);  
   1. Настроить почту для саппорта, дополнительно смтореть у хостера почтового ящика  
  $support_mail=array(
		    'smtp_username' => 'mail@mail',               /Ящик отправителя
        'sender_name'	=> 'mail@mail',                 /Ящик отправителя
        'imap_login'	=> 'mail@mail',                 /Ящик получателя
        'imap_password'	=> 'pass',                    //Пароль от почтового ящика  
        'imap_adress'	=> 'imap.mail.ru:993/imap/ssl', //Адрес почтового сервера  
        'smtp_port'     => '465',                     //Порт для SMTP  
        'smtp_host'     => 'ssl://smtp.mail.ru',      //Адрес почтового сервера  
        'smtp_password' => 'pass'                     //Пароль от почтового ящика  
	);
    1. Настроить бота вк
  $vk= array(
    'secretkey'=>"code", //Код запроса  
    'authkey'=>"b481867a",  //Ответ  
    'allow_all'=>true,      //Доступно всем?  
    'token'=>'eb71f0053b1e614f448505f92baede3f3f96ef1e45bd7bb54dc2df572d07921092e566b9b2ff49d553ff'//Ключ для взаимодействия с api //Токен  
    );
## [Панель управления](https://besthack.newpage.xyz/admin) 
 Панель управления полностью работает, но не доделан графический интефейс
 
## [API для ajax](https://besthack.newpage.xyz/ajax_test)
Для тестирования
