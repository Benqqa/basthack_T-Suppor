//Функция дял ajax-get запросов, вводится адрес и функция для возврата(необязательно);
function ajax(url,fun=false){
	 var xmlhttp = new XMLHttpRequest();
	var func=fun;
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == XMLHttpRequest.DONE) {
           if (xmlhttp.status == 200) {
			   if(func!=undefined&func!=false){
				func(xmlhttp.responseText);
			   }
			   else{
				console.log(xmlhttp.responseText);
			   }
           }
           else {
			    if(func!=undefined&func!=false){
					func(xmlhttp.status + ': ' + xmlhttp.statusText);
				}
			   else{
				console.log(xmlhttp.status + ': ' + xmlhttp.statusText);
			   }
           }
        }
    };

    xmlhttp.open("GET", url, true);
    xmlhttp.send();
}
//Функция запроса чатов пользователя (авторизация через cookie)
function bot_send(text,fun){
		ajax("../ajax_api/bot.php?text="+text,fun);
}
