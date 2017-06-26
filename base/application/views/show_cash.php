<?php
	echo"
<input id = 'cash_date' style = 'width:75px' type = 'text' value = '{$this->id}' name = 'date' class = 'datepicker'/>
<div class = 'cash_table'>
	<img src = '{$params['url']}ico/arrow.png' class = 'arrow_in' title = 'скрывает/показывает весь приход'/>
	<img src = '{$params['url']}ico/arrow.png' class = 'arrow_out' title = 'скрывает/показывает всю выдачу'/>
	<img src = '{$params['url']}ico/money.png' class = 'money_in' title = 'добавить приход'/>
	<img src = '{$params['url']}ico/money.png' class = 'money_out' title = 'добавить выдачу'/>
	<div class = 'i_money_in vis' id = '{$this->id}'>
		<input name = 'money_in' placeholder = 'Сумма' style = 'width:50px' type = 'text' />
		<input name = 'comment_in' placeholder = 'Примечание' style = '' type = 'text' />
		<img src = '{$params['url']}ico/ok.png' class = 'ok_in' title = 'ok'/>
	</div>
	<div class = 'i_money_out vis' id = '{$this->id}'>
		<input name = 'money_out' placeholder = 'Сумма' style = 'width:50px' type = 'text' />
		<input name = 'comment_out' placeholder = 'Примечание' style = '' type = 'text' />
		<select style = 'width:180px' name = 'varian_out'>
			<option disabled selected value = ''>Выберете рассходник</option>";
	foreach($variant as $type){
		echo"
			<option value = '{$type['name']}'>{$type['name']}</option>";
	}
	unset($type);
	echo"
		</select>
		<img src = '{$params['url']}ico/ok.png' class = 'ok_out' title = 'ok'/>
	</div>
	<h1 class = 'text_center'>$money_yestarday</h1>
	<div class = 't_money_in'>";
	if(($cash_in)||($cash_in1)){
	echo"
		<div class = 'separator'></div>
		<h5 class = 'text_center'>
			Приход <span class = 'cash_in_h5'></span>
		</h5>
		<div class = 'separator'></div>
		<br />
		<table width = '100%' >";
	foreach($cash_in as $cash){
		echo"
			<tr>	
				<td width = '25%'>
					<p class = 'text_center cash_in'>{$cash['money']} грн</p>
				</td>
				<td width = '65%'>
					<p class = 'text_center'>";echo client_name($cash['record_id'], $db);echo"</p>
				</td>
				<td width = '15%'>
					<a href = '{$params['url']}records/change/id/{$cash['record_id']}'>
						<img src = '{$params['url']}ico/change.png' width = '20px' title = '#'/>
					</a>
				</td>
			</tr>";
	}
	unset($cash);
	foreach($cash_in1 as $cash){
		echo"
			<tr id = {$cash['id']}>	
				<td width = '25%'>
					<p class = 'text_center cash_in'>{$cash['money']} грн</p>
				</td>
				<td width = '65%'>
					<p class = 'text_center'>{$cash['comment']}</p>
				</td>
				<td width = '15%'>
					<img src = '{$params['url']}ico/minus.png' class = 'minus_but_in' width = '20px' title = '-'/>
				</td>
			</tr>";
	}
	unset($cash);
	echo"
		</table>";
	}
	echo"
	</div>
	<div class = 't_money_out'>";
	if(($cash_out)||($cash_out_charge)||($cash_out_goods)){
		echo"
		<div class = 'separator'></div>
		<h5 class = 'text_center'>
			Выдача <span class = 'cash_out_h5'></span>
		</h5>
		<div class = 'separator'></div>
		<br />
		<table width = '100%'>";
	foreach($cash_out_goods as $cash){
		echo"
			<tr>
				<td width = '17%'>
					<p class = 'text_center cash_out'>{$cash['price_self']} грн</p>
				</td>	
				<td width = '50%'>
					<p class = 'text_center'>{$cash['name']}</p>
				</td>
				<td width = '23%'>
					<p>{$cash['auto']}</p>
				</td>
				<td width = '10%'>
					<a href = '{$params['url']}records/change/id/{$cash['record_id']}'>
						<img src = '{$params['url']}ico/change.png' width = '20px' title = '#'/>
					</a>
				</td>
			</tr>";
	}
	unset($cash);
	foreach($cash_out as $cash){
		echo"
			<tr id = '{$cash['id']}'>
				<td width = '17%'>
					<p class = 'text_center cash_out'>{$cash['money']} грн</p>
				</td>	
				<td width = '50%'>
					<p class = 'text_center'>{$cash['comment']}</p>
				</td>
				<td width = '23%'>
					<p>{$cash['variant']}</p>
				</td>
				<td width = '10%'>
					<img src = '{$params['url']}ico/minus.png' class = 'minus_but_out' width = '20px' title = '-'/>
				</td>
			</tr>";
	}
	unset($cash);
	foreach($cash_out_charge as $cash){
		echo"
			<tr>
				<td width = '17%'>
					<p class = 'text_center cash_out'>{$cash['money']} грн</p>
				</td>	
				<td width = '50%' colspan = '2'>
					<p class = 'text_center'>ЗП {$cash['name']}</p>
				</td>
				<td width = '10%'>
					<a href = '{$params['url']}charge/show/id/{$cash['person_id']}'>
						<img src = '{$params['url']}ico/change.png' width = '20px' title = '#'/>
					</a>
				</td>
			</tr>";
	}
	unset($cash);
	echo"
		</table>";
	}
	echo"
	</div>
</div>
<h1 class = 'text_center'>$money_now</h1>




	";
?>