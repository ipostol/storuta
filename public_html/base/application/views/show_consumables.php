<?php
echo"
<img src = '{$params['url']}ico/time.png' class = 'time' title = 'установка даты'/>
<h4>Всего осталось на расходы: {$end_sum} грн</h4>
<select class = 'consumables_select'>
	<option selected = 'selected' value = '0'>Все</option>";
foreach($consumables as $cons){
	echo "<option value = '{$cons['id']}'>{$cons['name']}</option>";
}
echo"
</select>
<div class = 'for_time'>
	<input class = 'datepicker time_input' style = 'width:184px;text-align:center' placeholder = 'От' type = 'text'></input>
	<input class = 'datepicker time_input' style = 'width:184px;text-align:center' placeholder = 'До' type = 'text'></input>
</div>
<div class = 'cons_content'>
</div>
";
?>