<?php
echo <<<LABEL
<div id='all_records'>
<table width='850px' align = "center" border='2px'>
<tr>
    <th width='40px'>
   		Id
    </th>
    <th width='180px'>
    	Модель
    </th>
    <th width='180px'>
    	Заказчик
    </th>
    <th width='110px'>
    	Дата приема
    </th>
    <th width='110px'>
   		Дата выдачи
    </th>
    <th width='160px'>
   		Состояние
    </th>
	<th width='30px'>
		<a href="{$link_add}"><img src="{$params['url']}ico/plus.png" title="#" width="20px"/></a>
	</th>
</tr>
LABEL;
foreach($records as $record) {
    if($record['state'] == 2) {
      	$temp1 = 'red';
    }else {
        $temp1 = '';
    }
	if($record['state'] == 1)
		$temp = 'yellow';
	else
		$temp = '';
	echo "<tr class = '$temp $temp1' id='{$record['id']}'>\n";
		echo "<td>".$record['id']."</td>\n";
		echo "<td>".$record['auto']."</td>\n";
		echo "<td>".$record['client']."</td>\n";
		echo "<td>";if($record['date_in'])echo date('d.m.Y',$record['date_in']);echo"</td>\n";
		echo "<td>";if($record['date_out'])echo date('d.m.Y',$record['date_out']);echo"</td>\n";
		if($record['state']==0)
			echo "<td>Невыполнено</td>\n";
		else
          if($record['state'] == 1)
			echo "<td>Выполнено</td>\n";
          else
          	echo "<td>Должен</td>";
		echo "<td><a href='{$params['url']}records/change/id/{$record['id']}'><img src='{$params['url']}ico/change.png' class='change' width='20px'/></a></td>\n";
	echo "</tr>\n";
}
echo <<<LABEL
</table>
</div>
LABEL;
?>