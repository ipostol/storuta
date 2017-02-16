<?php
class CashModel{
	public function render($file) {
		ob_start();
		$params = parse_ini_file('settings.ini');
		$db = new PDO($params['db.conn'],
				$params['db.user'],
				$params['db.pass']);
		if(!$this->id){
			$this->id = date('d.m.Y');
		}
		$date = strtotime($this->id);
		//-----------------------------------------------------------------------------
		$money_now = 0;
		$money_yestarday = 0;
		$money_money = 0;
		$money_money1 = 0;
		$money_cash_in = 0;
		$money_cash_in1 = 0;
		$money_goods = 0;
		$money_goods1 = 0;
		$money_charge = 0;
		$money_charge1 = 0;
		$money_cash_out = 0;
		$money_cash_out1 = 0;
		
		$select = $db->prepare("SELECT money from money where date <= ?  and date != ''");
		$select->execute(array($date));
		$money = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($money as $cash){
			$money_money += $cash['money'];
		}unset($cash);	
		
		$select = $db->prepare("SELECT money from cash_in where date <= ?  and date != ''");
		$select->execute(array($date));
		$cash_in = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($cash_in as $cash){
			$money_cash_in += $cash['money'];
		}unset($cash);
				
		$select = $db->prepare("SELECT money from cash_out where date <= ?  and date != ''");
		$select->execute(array($date));
		$cash_out = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($cash_out as $cash){
			$money_cash_out += $cash['money'];
		}unset($cash);
      
		$select = $db->prepare("SELECT price_self from goods where date <= ? and date != ''");
		$select->execute(array($date));
		$money_goods_ = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($money_goods_ as $cash){
			$money_goods += $cash['price_self'];
		}unset($cash);
		
		$select = $db->prepare("SELECT money from charge where date <= ? and date != ''");
		$select->execute(array($date));
		$money_charge_ = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($money_charge_ as $cash){
			$money_charge += $cash['money'];
		}unset($cash);
		//---------------------------------------------------------------------
		$select = $db->prepare("SELECT money from money where date < ?  and date != ''");
		$select->execute(array($date));
		$money1 = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($money1 as $cash){
			$money_money1 += $cash['money'];
		}unset($cash);	
		
		$select = $db->prepare("SELECT money from cash_in where date < ?  and date != ''");
		$select->execute(array($date));
		$cash_in1 = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($cash_in1 as $cash){
			$money_cash_in1 += $cash['money'];
		}unset($cash);
				
		$select = $db->prepare("SELECT money from cash_out where date < ?  and date != ''");
		$select->execute(array($date));
		$cash_out1 = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($cash_out1 as $cash){
			$money_cash_out1 += $cash['money'];
		}unset($cash);
		
		$select = $db->prepare("SELECT price_self from goods where date < ? and date != ''");
		$select->execute(array($date));
		$money_goods_1 = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($money_goods_1 as $cash){
			$money_goods1 += $cash['price_self'];
		}unset($cash);
		
		$select = $db->prepare("SELECT money from charge where date < ? and date != ''");
		$select->execute(array($date));
		$money_charge_1 = $select->fetchALL(PDO::FETCH_ASSOC);	
		foreach($money_charge_1 as $cash){
			$money_charge1 += $cash['money'];
		}unset($cash);
		
		$money_now = $money_money + $money_cash_in - $money_goods - $money_charge - $money_cash_out;
		$money_yestarday = 	$money_money1 + $money_cash_in1 - $money_goods1 - $money_charge1 - $money_cash_out1;	
		//-----------------------------------------------------------------------------
		$select = $db->prepare("SELECT record_id,money from money where date > ? AND date < ?");
		$select->execute(array($date - 10000, $date + 10000 ));
		$cash_in = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT id,comment,money from cash_in where date > ? AND date < ?");
		$select->execute(array($date - 10000, $date + 10000 ));
		$cash_in1 = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT id,comment,money,variant from cash_out where date > ? AND date < ?");
		$select->execute(array($date - 10000, $date + 10000 ));
		$cash_out = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT record_id,name,price_self,records.auto from goods, records where date > ? AND date < ? AND records.id = record_id");
		$select->execute(array($date - 10000, $date + 10000 ));
		$cash_out_goods = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT id,name from cash_type");
		$select->execute();
		$variant = $select->fetchALL(PDO::FETCH_ASSOC);
		
      	$select = $db->prepare("SELECT charge.person_id,charge.money,people.name from charge, people where date > ? AND date < ? AND people.id = charge.person_id");
		$select->execute(array($date - 10000, $date + 10000 ));
		$cash_out_charge = $select->fetchALL(PDO::FETCH_ASSOC);
     
		function client_name($id,$db){
			$select = $db->prepare("SELECT client from records where id = ?");
			$select->execute(array($id));
			$name = $select->fetchALL(PDO::FETCH_ASSOC);	
			return $name[0]['client'];		
		}
		$select = $db->prepare("SELECT id,name from people where presence = 1");
		$select->execute();
		$people = $select->fetchAll(PDO::FETCH_ASSOC);
		require_once (__DIR__."/../views/admin_default.php");
		echo "<title>Касса</title>";
		echo "<link href='{$params['url']}css/cash.css' rel='stylesheet'>";
		echo "<script src = '{$params['url']}js/cash.js'></script>";
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}