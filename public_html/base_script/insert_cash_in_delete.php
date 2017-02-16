<?
date_default_timezone_set("Europe/Kiev");
if($_SERVER['REQUEST_METHOD']=='POST'){
	$id = $_POST['id'];
	$params = parse_ini_file('config.ini');
	$db = new PDO($params['db.conn'],
			$params['db.user'],
			$params['db.pass']);
	$data = array($id);
		$sql = "DELETE FROM cash_in WHERE id = ?";					
	$insert = $db->prepare($sql);
	$insert->execute($data);
}
?>