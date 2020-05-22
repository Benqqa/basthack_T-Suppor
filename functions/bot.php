<?php
	include_once('fun.php');
	include_once('config.php');
	//Работа бота с запросом
	function bot_request($text){
		if($text=='человек' or $text=='оператор'){
			$ret="Ваш запрос передан оператору, ожидайте!";
		}
		elseif($r=cmd_search($text)){
			$ret=$r;
		}
		elseif($r=faq_search($text)){
			$ret=$r."\n Это помогло? Если нет, то переформулируйте вопрос или позовите оператора";
		}
		else{
			$ret='Извините, похоже я не могу вам помочь, для связи с сотрудником службы поддержки напишите "оператор"';
		}
		return $ret;
	}
	//Поиск по командам
	function cmd_search($text){
		$res=my_query("SELECT `output` from `command` where `input` LIKE '%".$text."%'",array(0=>$text));
		if($r=mysqli_fetch_assoc($res)){
			return $r['output'];
		}
		else{
			return false;
		}
	}
	function faq_search($text){
		$res=my_query("SELECT * FROM faq
        WHERE MATCH (text) AGAINST ('".$text."');",array(0=>$text));
		if($r=mysqli_fetch_assoc($res)){
			return $r['text'];
		}
		else{
			return false;
		}
	}
?> 
