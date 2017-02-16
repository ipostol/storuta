<?php
class ChargeModel{
	public function render($file) {
		ob_start();
		$params = parse_ini_file('settings.ini');
		$db = new PDO($params['db.conn'],
				$params['db.user'],
				$params['db.pass']);
		$select = $db->prepare("SELECT id, name, presence from people where presence <> 0");
		$select->execute();
		$people = $select->fetchAll(PDO::FETCH_ASSOC);
		$select = $db->prepare("SELECT works.id,record_id,employee,price,work,records.auto,records.date_out from works,records where record_id = records.id");
		$select->execute();
		$works = $select->fetchAll(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT records.auto,name,price,price_self,records.id,records.date_out from goods,records where record_id = records.id AND records.state <> 0");
		$select->execute();
		$goods = $select->fetchAll(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT id from records where state <> 0");
		$select->execute();
		$records = $select->fetchAll(PDO::FETCH_ASSOC);
		$select = $db->prepare("SELECT id,person_id,date,money,comment from charge");
		$select->execute();
		$ppl_charge_all = array_reverse($select->fetchAll(PDO::FETCH_ASSOC));

		foreach($works as $work){
			foreach($records as $record){
				if($work['record_id']==$record['id']){
					$charge[100][] = array('id' => $record['id'],'money' => $work['price']*0.08,'auto' => $work['auto'],'name' => $work['work'], 'date' => $work['date_out']);
					$charge[101][] = array('id' => $record['id'],'money' => $work['price']*0.32,'auto' => $work['auto'],'name' => $work['work'], 'date' => $work['date_out']);
					if($work['date_out'] > strtotime('14.03.2015') && $work['date_out'] < strtotime('30.09.2015'))
						$charge[99][] = array('id' => $record['id'],'money' => $work['price']*0.05,'auto' => $work['auto'],'name' => $work['work'], 'date' => $work['date_out']);
					$charge[$work['employee']][] = array('id' => $record['id'],'money' => $work['price']*0.4,'auto' => $work['auto'],'name' => $work['work'], 'date' => $work['date_out']);
					break;
				}
			}
			unset($record);
		}
		unset($work);

		foreach($goods as $good){
			if($good['price']-$good['price_self'] != 0){
				$charge[100][] = array('id' => $good['id'],'money' => ($good['price']-$good['price_self'])*0.16,'auto' => $good['auto'], 'name' => $good['name'], 'date' => $good['date_out']);
				$charge[101][] = array('id' => $good['id'],'money' => ($good['price']-$good['price_self'])*0.64,'auto' => $good['auto'], 'name' => $good['name'], 'date' => $good['date_out']);
				if($good['date_out'] > strtotime('14.03.2015') && $good['date_out'] < strtotime('30.09.2015'))
					$charge[99][] = array('id' => $good['id'],'money' => ($good['price']-$good['price_self'])*0.05,'auto' => $good['auto'], 'name' => $good['name'], 'date' => $good['date_out']);
			}
		}
		unset($good);
		
		foreach($people as $ppl){
			$all_salary[$ppl['id']] = 0;
		}
		unset($ppl);
		foreach($people as $ppl){
			if($charge[$ppl['id']]){
				foreach($charge[$ppl['id']] as $salary){
					$all_salary[$ppl['id']] += $salary['money']; 
				}
				unset($salary);
				foreach($ppl_charge_all as $ppl_charge){
					if($ppl_charge['person_id'] == $ppl['id']){
						$all_salary[$ppl['id']] -= $ppl_charge['money'];
					}
				}
				unset($ppl_charge);	
				$all_salary[$ppl['id']]	= (int)$all_salary[$ppl['id']];		
			}
		}
		unset($ppl);
		
		
		foreach($people as $ppl){
			for($i = 0; $i < count($charge[$ppl['id']])-1; $i++){
				for($j = $i+1; $j < count($charge[$ppl['id']]); $j++){
					if((int)$charge[$ppl['id']][$i]['id'] > (int)$charge[$ppl['id']][$j]['id']){
						$temp = $charge[$ppl['id']][$i];
						$charge[$ppl['id']][$i] = $charge[$ppl['id']][$j];
						$charge[$ppl['id']][$j] = $temp;
					}
				}
			}
		}
		unset($ppl);
		
		foreach($people as $ppl){
			for($i = 0; $i < count($charge[$ppl['id']])-1; $i++){
				for($j = $i+1; $j < count($charge[$ppl['id']]); $j++){
					if($charge[$ppl['id']][$i]['date'] < $charge[$ppl['id']][$j]['date']){
						$temp = $charge[$ppl['id']][$i];
						$charge[$ppl['id']][$i] = $charge[$ppl['id']][$j];
						$charge[$ppl['id']][$j] = $temp;
					}
				}
			}
			
		}
		unset($ppl);
		//----------------------------------------------- Work with date select
		if($this->Date){
			$first_date = strtotime(substr($this->Date,0,10));
			$second_date = strtotime(substr($this->Date,-10));
			foreach($people as &$ppl){
				$ppl['sum'] = 0;
				$ppl['sum_out'] = 0;
				foreach($charge[$ppl['id']] as $once){
					if(($once['date'] <= $second_date) && ($once['date'] >= $first_date)){
						$ppl['sum'] += $once['money'];
					}
				}
				unset($once);
			}
			unset($ppl);
			foreach($ppl_charge_all as $charge_out){
				if(($charge_out['date'] <= $second_date) && ($charge_out['date'] >= $first_date))
					foreach($people as &$p){
						if($p['id'] == $charge_out['person_id'])
							$p['sum_out'] += $charge_out['money'];
					}
					unset($p);
			}
			unset($charge_out);
		}
		//---------------------------------------------------
		
		require_once (__DIR__."/../views/admin_default.php");
		echo "<title>Зарплаты</title>";
		echo "<link href='{$params['url']}css/charge.css' rel='stylesheet'>";
		echo "<script src = '{$params['url']}js/charge.js'></script>";
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}