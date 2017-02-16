<?
	date_default_timezone_set("Europe/Kiev");
	if($_SERVER['REQUEST_METHOD']=='POST'){
			$date = $_POST['date'];
			$money = $_POST['money'];
			$comment = $_POST['comment'];
			$person = $_POST['person'];
			
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
$comment = make_words($comment);
$person = make_words($person);
$params = parse_ini_file('config.ini');
$db = new PDO($params['db.conn'],
		$params['db.user'],
		$params['db.pass']);
	$data = array('money' => $money, 'date' => strtotime($date), 'comment' => $comment, 'person' => $person);
		$sql = "INSERT INTO charge(
							money,
							date,
							comment,
							person_id							
							)
						VALUES(
							:money,
							:date,
							:comment,
							:person)";					
	$insert = $db->prepare($sql);
	$insert->execute($data);
}
?>