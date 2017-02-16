<?php
echo"
<div id = 'main_charge'>
<img id = 'charge_date' src = '{$params['url']}ico/info.png' title = '?'/>";
if($this->id)
echo"<img id = 'charge_money' src = '{$params['url']}ico/money.png' title = '$'/>";
echo"
<table class = 'charge_add_date vis' width = '300px'>
	<tr>
		<td width = '45%'>
			<input class = 'datepicker date_first' style = 'width:86%' placeholder = 'От' type = 'text'></input>
		</td>
		<td width = '45%'>
			<input class = 'datepicker date_second' style = 'width:86%' placeholder = 'До' type = 'text'></input>
		</td>
		<td width = '10%'>
			<img class = 'charge_ok_date' src = '{$params['url']}ico/ok.png' width = '30px'/>
		</td>
	</tr>
</table>
</div>
";
if($this->Date){
	echo"
	<div id = 'main_charge'>
	<h3 class = 'text_center'>$this->Date</h3>
	<table width = '100%'>";
foreach($people as $ppl){
	echo"
		<tr>
			<td width = '50%'><p>{$ppl['name']}</p></td>
			<td width = '25%'><p class = 'right'>{$ppl['sum']}</p></td>
			<td width = '25%'><p class = 'right'>{$ppl['sum_out']}</p></td>
		</tr>";
}
unset($ppl);
echo"
	</table>
	</div>
";
}else{
echo"
<div id = 'main_charge'>
	<table id = '{$this->id}{$this->repair_id}' class = 'charge_add_salary vis' width = '400px'>
		<tr>
			<td width = '16%'>
				<input name = 'money' style = 'width:75%' placeholder = 'Сумма' type = 'text'></input>
			</td>
			<td width = '24%'>
				<input class = 'datepicker' name = 'date' style = 'width:86%' placeholder = 'Дата' type = 'text'></input>
			</td>
			<td width = '50%'>
				<input name = 'comment' style = 'width:90%' placeholder = 'Примечание' type = 'text'></input>
			</td>
			<td width = '10%'>
				<img class = 'charge_ok' src = '{$params['url']}ico/ok.png' width = '30px'/>
			</td>
		</tr>
	</table>
	<table class = 'charge_for_color' id = '{$this->id}' width = '300px' >
		<tr height = '43px'>
			<td width = '10%'>
			</td>
			<td width = '75%'>
				<h5>Работник</h5>
			</td>
			<td width = '15%'>
				<h5>Должны</h5>
			</td>
		</tr>
";
foreach($people as $ppl){
echo"
		<tr height = '35px'>
			<td>
				<a href='{$params['url']}charge/show/repair_id/{$ppl['id']}'><img src = '{$params['url']}ico/wrench.png' class = 'wrench' title = '#'/><a>
			</td>
			<td>	
				<a href = '{$params['url']}charge/show/id/{$ppl['id']}'><p class = 'p_{$ppl['id']}'>{$ppl['name']}</p></a>
			</td>
			<td>
				<p>{$all_salary[$ppl[id]]}</p>
			</td>
		</tr>";
}
echo"
	</table>
</div>";
if($this->id){
echo"
<div id = 'show_id'>
	<div class = 'separator'></div>
	<br/>
	<table width = '100%'>";
foreach($ppl_charge_all as $ppl_charge){
	if($ppl_charge['person_id'] == $this->id){
echo"
		<tr>
			<td width = '40%'>
				<p class = 'charge_p_left'>{$ppl_charge['money']} грн</p>
			</td>
			<td width = '60%'>
				<p class = 'charge_p_right'>";if($ppl_charge['date'])echo date('d.m.Y',$ppl_charge['date']);else echo "неизвестно";echo"</p>	
				<img id = '{$ppl_charge['id']}' class = 'charge_comment' src = '{$params['url']}ico/comment.png' title = '#' width = '20px'/>			
			</td>
		</tr>
		<tr class = '{$ppl_charge['id']} vis'>
			<td colspan = '2'>
				<p class = 'text_center'>{$ppl_charge['comment']}</p>
			</td>
		</tr>";
	}
}
unset($ppl_charge);
echo" 
	</table>
<div>";	
}
if($this->repair_id){
echo"
<div id = 'show_id' class = '{$this->repair_id}'>
	<div class = 'separator'></div>
	<br/>
	<table width = '400px' class = 'big_size'>";
if($charge[$this->repair_id]){
foreach($charge[$this->repair_id] as $work){
	echo"
		<tr>
			<td width = '15%'>
				<p>{$work['money']} грн</p>
			</td>
			<td width = '30%'>
				<p class = 'text_center'>{$work['auto']}</p>
			</td>
			<td width = '49%'>
				<p class = 'text_center'>{$work['name']}</p>
			</td>
			<td width = '6%'>
				<a href = '{$params['url']}records/change/id/{$work['id']}'><img src = '{$params['url']}ico/change.png' width = '20px' class = 'charge_url_change' title = '#'/></a>
			</td>
		</tr>";
}
unset($work);
}
echo"
	</table>";
}
}
?>