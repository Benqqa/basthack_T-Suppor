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
					coast
					<input type='number' name='coast'>
					<textarea name='data'></textarea>
					<?php
						type_selector();
					?>
					<input type='submit' value='Добавить'>
					</form> 
<?php
	$arr=show_device(10);
	foreach($arr as $value){
		echo "DEVICE:<br>
		name:".$value['title']."
		<img src='../img/devices/".$value['image']."' width=200>
		<hr>
		";
	}
?>
        
