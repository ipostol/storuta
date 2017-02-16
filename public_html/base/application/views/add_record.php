<?php
echo <<<LABEL
<div id="add_record">
<table id = "record_table">
<tr height='43px'>
	<td>
		<p>Заказчик</p>
	</td>
	<td class='td_left'>
		<input type="text" name="name"></input>
	</td>
</tr>
<tr height='43px'>
	<td>
		<p>Модель</p>
	</td>
	<td>
		<input type="text" name="car_name"></input>
	</td>
</tr height='43px'>
<tr height='43px'>
	<td>
		<p>VIN</p>
	</td>
	<td>
		<input type="text" name="vin"></input>
	</td>
</tr>
<tr height='43px'>
	<td>
		<p>ГосНомер</p>
	</td>
	<td>
		<input type="text" name="num_plate"></input>
	</td>
</tr>
<tr height='43px'>
	<td>
		<p>Телефон</p>
	</td>
	<td>
		<input type="text" name="phone"></input>
	</td>
</tr>
<tr height='43px'>
	<td>
		<p>Дата приёма</p>
	</td>
	<td>
		<input type="text" name="date_in" class="datepicker"/>
	</td>
</tr>
<tr height='43px'>
	<td>
		<p>Дата выдачи</p>
	</td>
	<td>
		<input type="text" name="date_out" class="datepicker"/>
	</td>
</tr>
<tr height='43px'>
	<td>
		<p>Состояние</p>
	</td>
	<td>
		<select name="state">
		<option value="0">Невыполнено</option>
		<option value="1">Выполнено</option>
		</select>
	</td>
</tr>
</table>
<button class="records_button" id = 'send_id' onclick="send(this.id)" type="button">Создать</button>
</div>
LABEL;
?>