<?php
class ConsumablesModel{
	public function render($file) {
		ob_start();
		$params = parse_ini_file('settings.ini');
		$db = new PDO($params['db.conn'],
				$params['db.user'],
				$params['db.pass']);
						
		$select = $db->prepare("SELECT id, name from cash_type");
		$select->execute(array($date));
		$consumables = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT sum(price_self), sum(price) from goods, records where record_id = records.id AND records.state <> 0");
		$select->execute();
		$sum_goods = $select->fetchALL(PDO::FETCH_ASSOC);	
		
		$select = $db->prepare("SELECT sum(price) from works, records where record_id = records.id AND records.state <> 0");
		$select->execute();
		$sum_works = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$select = $db->prepare("SELECT sum(money) from cash_out");
		$select->execute();
		$sum_cash = $select->fetchALL(PDO::FETCH_ASSOC);
	
		$select = $db->prepare("SELECT sum(money) from charge where person_id = 99");
		$select->execute();
		$sum_ivan = $select->fetchALL(PDO::FETCH_ASSOC);
		
		$end_sum = ($sum_goods[0]['sum(price)'] - $sum_goods[0]['sum(price_self)']) * 0.2 + $sum_works[0]['sum(price)'] * 0.2 - $sum_cash[0]['sum(money)'] - $sum_ivan[0]['sum(money)'];
		require_once (__DIR__."/../views/admin_default.php");
		echo "<title>Расходники</title>";
		echo "<link href='{$params['url']}css/consumables.css' rel='stylesheet'>";
		echo "<script src = '{$params['url']}js/consumables.js'></script>";
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}