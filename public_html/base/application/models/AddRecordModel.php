<?php
class AddRecordModel{
	public function render($file) {
		ob_start();
		$params = parse_ini_file('settings.ini');
		$db = new PDO($params['db.conn'],
				$params['db.user'],
				$params['db.pass']);
		$select = $db->prepare("SELECT id,name from people where presence=1");
		$select->execute();
		$records = $select->fetchAll(PDO::FETCH_ASSOC);
		require_once (__DIR__."/../views/admin_default.php");
		echo "<script src='{$params['url']}js/add_records.js'></script>";
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}