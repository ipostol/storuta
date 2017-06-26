<?php
class RecordsModel{
	public function render($file) {
		ob_start();
		$params = parse_ini_file('settings.ini');
		$db = new PDO($params['db.conn'],
				$params['db.user'],
				$params['db.pass']);
		$select = $db->prepare("SELECT id,client,date_in,date_out,auto,state,status from records");
		$select->execute();
		$records = array_reverse($select->fetchAll(PDO::FETCH_ASSOC));
		$link_add = $params['url']."records/add";
		require_once (__DIR__."/../views/admin_default.php");
		echo "<title>Заказ наряды</title>";
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}