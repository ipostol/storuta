<?	
date_default_timezone_set("Europe/Kiev");
function sort_time($mas){
	for($i = 0; $i<count($mas)-1; $i++)
		for($j = $i+1; $j<count($mas); $j++){
				if($mas[$i]['date'] < $mas[$j]['date']){
						$temp = $mas[$i];
						$mas[$i] = $mas[$j];
						$mas[$j] = $temp;
					}
		}
	return $mas;
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){	
	$id = $_POST['id'];
	$params = parse_ini_file('config.ini');
	$db = new PDO($params['db.conn'],
		$params['db.user'],
		$params['db.pass']);
	$date = $_POST['date'];
	if($date){
		if($date[0] == '_')
			$date1 = 0;
		else
			$date1 = substr($date,0,10);
		if($date[strlen($date)-1] == '_')
			$date2 = date("d.m.Y");
		else
			$date2 = substr($date,-10);

		$date1 = strtotime($date1);
		$date2 = strtotime($date2);
		
		if($id == 0){
			$select = $db->prepare("select comment, date, money from cash_out where date >= ? AND date <= ?");
			$select->execute(array($date1, $date2));
			$consumables = array_reverse($select->fetchAll(PDO::FETCH_ASSOC));
			
			$select = $db->prepare("select sum(money) from cash_out where date >= ? AND date <= ?");
			$select->execute(array($date1, $date2));
			$sum = $select->fetchAll(PDO::FETCH_ASSOC);	
		}else{
			$select = $db->prepare("select comment, date, money from cash_out, cash_type where cash_type.id = ? and cash_type.name = cash_out.variant and date >= ? AND date <= ?");
			$select->execute(array($id,$date1, $date2));
			$consumables = $select->fetchAll(PDO::FETCH_ASSOC);
			
			$select = $db->prepare("select sum(money) from cash_out, cash_type where cash_type.id = ? and cash_type.name = cash_out.variant and date >= ? AND date <= ?");
			$select->execute(array($id,$date1, $date2));
			$sum = $select->fetchAll(PDO::FETCH_ASSOC);	
		}
		if($id == 1 || $id == 0){
			$select = $db->prepare("select date, money from charge where person_id = 99 AND date >= ? AND date <= ?");
			$select->execute(array($date1, $date2));
			$consumables_ivan = $select->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($consumables_ivan as &$ivan){
				$ivan['comment'] = 'ЗП Постол Ваня';
				$consumables[] = $ivan;
			}
			unset($ivan);
			
			$select = $db->prepare("select sum(money) from charge where person_id = 99 AND date >= ? AND date <= ?");
			$select->execute(array($date1, $date2));
			$sum_ivan = $select->fetchAll(PDO::FETCH_ASSOC);	
			
			$sum[0]['sum(money)'] += $sum_ivan[0]['sum(money)'];
			
			
		}
	}else{
		if($id == 0){
			$select = $db->prepare("select comment, date, money from cash_out");
			$select->execute();
			$consumables = array_reverse($select->fetchAll(PDO::FETCH_ASSOC));
			
			$select = $db->prepare("select sum(money) from cash_out");
			$select->execute();
			$sum = $select->fetchAll(PDO::FETCH_ASSOC);	
		}else{
			$select = $db->prepare("select comment, date, money from cash_out, cash_type where cash_type.id = ? and cash_type.name = cash_out.variant");
			$select->execute(array($id));
			$consumables = $select->fetchAll(PDO::FETCH_ASSOC);
			
			$select = $db->prepare("select sum(money) from cash_out, cash_type where cash_type.id = ? and cash_type.name = cash_out.variant");
			$select->execute(array($id));
			$sum = $select->fetchAll(PDO::FETCH_ASSOC);				
		}
		if($id == 1 || $id == 0){
			$select = $db->prepare("select date, money from charge where person_id = 99");
			$select->execute(array($date1, $date2));
			$consumables_ivan = $select->fetchAll(PDO::FETCH_ASSOC);

			foreach($consumables_ivan as &$ivan){
				$ivan['comment'] = 'ЗП Постол Ваня';
				$consumables[] = $ivan;
			}
			unset($ivan);
			
			$select = $db->prepare("select sum(money) from charge where person_id = 99");
			$select->execute(array($date1, $date2));
			$sum_ivan = $select->fetchAll(PDO::FETCH_ASSOC);	
			
			$sum[0]['sum(money)'] += $sum_ivan[0]['sum(money)'];
			
			
		}
	}
	
	$consumables = sort_time($consumables);
	if($consumables){
		echo"
<div class = 'separator'></div>
<table width = '400px'>
	<tr>
		<td colspan = '4'><h4 align = 'center'>Потраченно {$sum[0]['sum(money)']} грн</h4></td>
	</tr>
	";
	foreach($consumables as $cons){
		$date = date("d.m.Y",$cons['date']);
		echo"
	<tr class = 'name{$id}'>
		<td width = '40%'><p>{$cons['comment']}</p></td>
		<td width = '25%'><p>{$date}</p></td>
		<td width = '20%'><p>{$cons['money']} грн</p></td>
		<td width = '15%'><a href = '{$params['url']}cash/show/id/{$date}'><img class = 'open' src = '{$params['url']}ico/change.png' width = '20px' title = '#'/></a></td>
	</tr>
	";
	}
	echo"
</table>
";
}
	
	 
}
?>