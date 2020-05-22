 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <br>
 <form action='' method='post'>
					<input type='date' name='start'>
					end
					<input type='date' name='end'>
					Serial number
					<input type='serial' name='serial_number'>
					<select name='type'>
					<?php
						$a=show_device(100);
						foreach($a as $as){
							echo "<option value='".$as['id']."'>".$as['title']."</option>";
						}
					?>
					</select>
					<input type='submit' value='Добавить'>
					</form> 
<?php
	$arr=show_user_device(10);
	foreach($arr as $value){
		echo "DEVICE:<br>
		name:".$value['title']."
		<img src='../img/devices/".$value['image']."' width=200>
		<hr>
		";
	}
?>
        
