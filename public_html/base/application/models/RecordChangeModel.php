<?php
class RecordChangeModel{
	public function render($file) {
		ob_start();
		$params = parse_ini_file('settings.ini');
		$db = new PDO($params['db.conn'],
				$params['db.user'],
				$params['db.pass']);
		$id = $this->id;
		$date1 = date('d.m.Y');
		$select = $db->prepare("SELECT id,client,vin,date_in,date_out,auto,num_plate,phone,state from records where id=$id");
		$select->execute();
		$records = $select->fetch(PDO::FETCH_ASSOC);
		//-----------------------------------------------------------------------------------
		$select = $db->prepare("SELECT price,work,employee from works where record_id=$id");
		$select->execute();
		$works = $select->fetchAll(PDO::FETCH_ASSOC);
		//-----------------------------------------------------------------------------------
		$select = $db->prepare("SELECT name,date,price,price_self,state,comment from goods where record_id = $id");
		$select->execute();
		$goods = $select->fetchAll(PDO::FETCH_ASSOC);
		//-----------------------------------------------------------------------------------
		$select = $db->prepare("SELECT date,money,comment from money where record_id = $id");
		$select->execute();
		$money = $select->fetchAll(PDO::FETCH_ASSOC);
		//-----------------------------------------------------------------------------------
		$select = $db->prepare("SELECT id,name,presence from people");
		$select->execute();
		$people = $select->fetchAll(PDO::FETCH_ASSOC);
		//-----------------------------------------------------------------------------------
		$forecast = array();

		$forecast[101] = array('0' => 0, '1' => 0, '2' => 0);
		$forecast[100] = array('0' => 0, '1' => 0, '2' => 0);
		$forecast['consumables'] = array('0' => 0, '1' => 0, '2' => 0);
		//$forecast[99] = array('0' => 0, '1' => 0, '2' => 0);
		
		foreach($works as $work){
			if(!isset($forecast[$work['employee']]))
				$forecast[$work['employee']] = array('0' => 0, '1' => 0, '2' => 0);
			$forecast[$work['employee']][0] += (int)$work['price'] * 0.4;
			//$forecast[99][0] += (int)$work['price'] * 0.05;
			$forecast[100][0] += (int)$work['price'] * 0.08;
			$forecast[101][0] += (int)$work['price'] * 0.32;
			$forecast['consumables'][0] += (int)$work['price'] * 0.2;
			
		}	
		unset($work);

		foreach($goods as $good){
			//$forecast[99][1] += (int)$good['price'] * 0.05;
			$forecast[100][1] += (int)($good['price'] - $good['price_self']) * 0.16;
			$forecast[101][1] += (int)($good['price'] - $good['price_self']) * 0.64;
			$forecast['consumables'][1] += (int)($good['price'] - $good['price_self']) * 0.2;
		}
		unset($good);
		
		foreach($forecast as &$temp){
			$temp[2] = $temp[1] + $temp[0];
		}
		unset($temp);
		//----------------------------------------------------------------------------------
		function check_name($id, $people){
			foreach($people as $ppl){
				if($ppl['id'] == $id){	
					return $ppl['name'];
				}
			}
			if($id == 99)
				return "Постол Иван";
			else
				return "Расходники";
			unset($ppl);
		}
		//-----------------------------------------------------------------------------------
		require_once (__DIR__."/../views/admin_default.php");
		echo "<title>Наряд №{$id}</title>";
		echo "<script src='{$params['url']}js/change_records.js'></script>";
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}