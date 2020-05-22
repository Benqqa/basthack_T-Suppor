 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 
 <form action='' method='post' enctype='multipart/form-data'>
					<input name='userfile' type='file' required>
					Загловок
					<input type='text' name='title'>
					
					<textarea name='data'></textarea>
					<input type='submit' value='Добавить'>
					</form> 
<?php
	$arr=show_types(10);
	foreach($arr as $value){
		echo "DEVICE:<br>
		name:".$value['name']."
		<img src='../img/types/".$value['img']."' width=200>
		<hr>
		";
	}
?>
        
