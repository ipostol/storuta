<?
	date_default_timezone_set("Europe/Kiev");
	if($_SERVER['REQUEST_METHOD']=='POST'){
			$date = $_POST['date'];
			$money = $_POST['money'];
			$comment = $_POST['comment'];
			$type = $_POST['variant'];
			
	function make_words($array){
		if(is_array($array)){
			$array2 = array();
			foreach($array as $elements){
				$array1 = "";
				$elements = explode(' ',$elements);
				foreach($elements as $element){
					if(mb_strlen($element,'utf-8')>16){
						$element=mb_substr($element,0,16,'utf-8');
					}
				$array1.=$element.' ';
				}
				$array1 = mb_substr($array1,0,mb_strlen($array1,'utf-8')-1,'utf-8');
				$array2[] = $array1;
			}
		}
		else{
			$elements = explode(' ',$array);
			$array2 = "";
			foreach($elements as $element){
				if(mb_strlen($element,'utf-8')>16){
					$element=mb_substr($element,0,16,'utf-8');
				}
				$array2.=$element.' ';
			}
			$array2 = mb_substr($array2,0,mb_strlen($array2,'utf-8')-1,'utf-8');
		}
		return $array2;
	}
$money = make_words($money);
$date = make_words($date);
$date = substr($date,0,-3);
$comment = make_words($comment);
$type = make_words($type);
$params = parse_ini_file('config.ini');
$db = new PDO($params['db.conn'],
		$params['db.user'],
		$params['db.pass']);
	$data = array('money' => abs($money), 'date' => $date, 'comment' => $comment, 'variant' => $type);
		$sql = "INSERT INTO cash_out(
							money,
							date,
							comment,
							variant						
							)
						VALUES(
							:money,
							:date,
							:comment,
							:variant)";					
	$insert = $db->prepare($sql);
	$insert->execute($data);
}
?>