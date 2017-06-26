<?	
	date_default_timezone_set("Europe/Kiev");
	if($_SERVER['REQUEST_METHOD']=='POST'){
			$n = $_POST['name'];
			$v = $_POST['vin'];
			$c_n = $_POST['car_name'];
			$ph = $_POST['phone'];
			$n_pl = $_POST['num_plate'];
			$dt_in = $_POST['date_in'];
			$dt_out = $_POST['date_out'];
			$st = $_POST['state'];
			$work_string = $_POST['works'];
			$money_string = $_POST['money'];
			$goods_string = $_POST['goods'];
	$work = explode('|',$work_string);
	array_pop($work);
	$money = explode('|',$money_string);
	array_pop($money);
	$goods = explode('|',$goods_string);
	array_pop($goods);
	function make_words($array){
		if(is_array($array)){
			$array2 = array();
			foreach($array as $elements){
				$array1 = "";
				$elements = explode(' ',$elements);
				foreach($elements as $element){
					if(mb_strlen($element,'utf-8')>17){
						$element=mb_substr($element,0,17,'utf-8');
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
				if(mb_strlen($element,'utf-8')>17){
					$element=mb_substr($element,0,17,'utf-8');
				}
				$array2.=$element.' ';
			}
			$array2 = mb_substr($array2,0,mb_strlen($array2,'utf-8')-1,'utf-8');
		}
		return $array2;
	}
$n = make_words($n);
$v = make_words($v);
$c_n = make_words($c_n);
$ph = make_words($ph);
$n_pl = make_words($n_pl);
$dt_in = make_words($dt_in);
$dt_out = make_words($dt_out);
$st = make_words($st);
	$params = parse_ini_file('config.ini');
	$db = new PDO($params['db.conn'],
			$params['db.user'],
			$params['db.pass']);
	$data = array('n' => $n, 'v' => $v, 'c_n' => $c_n, 'ph' => $ph, 'n_pl' => $n_pl, 'dt_in' => strtotime($dt_in), 'dt_out' => strtotime($dt_out), 'st' => $st);
		$sql = "INSERT INTO records(
							client,
							vin,
							date_in,
							date_out,
							auto,
							num_plate,
							phone,
							state							
							)
						VALUES(
							:n,
							:v,
							:dt_in,
							:dt_out,
							:c_n,
							:n_pl,
							:ph,
							:st)";					
	$insert = $db->prepare($sql);
	$insert->execute($data);	
	unset($insert);
	unset($db);
}
	
?>