<?
	date_default_timezone_set("Europe/Kiev");
	if($_SERVER['REQUEST_METHOD']=='POST'){
			$id = $_POST['id'];
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
$id = make_words($id);
$n = make_words($n);
$v = make_words($v);
$c_n = make_words($c_n);
$ph = make_words($ph);
$n_pl = make_words($n_pl);
$dt_in = make_words($dt_in);
$dt_out = make_words($dt_out);
$st = make_words($st);
$work = make_words($work);
$money = make_words($money);
$goods = make_words($goods);
$params = parse_ini_file('config.ini');
$db = new PDO($params['db.conn'],
		$params['db.user'],
		$params['db.pass']);
//---------------------------------------------------------------------------------------------------------delete_old_info
	function sql($sql,$id,$db){
		$insert = $db->prepare($sql);
		$insert->execute(array($id));
	}
	sql("DELETE FROM records WHERE id = ?",$id,$db);
	sql("DELETE FROM goods WHERE record_id = ?",$id,$db);
	sql("DELETE FROM money WHERE record_id = ?",$id,$db);
	sql("DELETE FROM works WHERE record_id = ?",$id,$db);	
//------------------------------------------------------------
	$data = array('id' => $id, 'n' => $n, 'v' => $v, 'c_n' => $c_n, 'ph' => $ph, 'n_pl' => $n_pl, 'dt_in' => strtotime($dt_in), 'dt_out' => strtotime($dt_out), 'st' => $st);
		$sql = "INSERT INTO records(
							id,
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
							:id,
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
	$temp_id = $id;
	for($i=0;$i<count($work);$i+=3){
		if(strlen($work[$i+2])>4)
			$work[$i+2]= substr($work[$i+2],0,5);
		$data = array('record_id' => $temp_id, 'work' => $work[$i], 'employee' => $work[$i+1], 'price' => abs($work[$i+2]));
		$sql = "INSERT INTO works(
							record_id,
							employee,
							price,
							work)
						VALUES(
							:record_id,
							:employee,
							:price,
							:work
							)";
		$insert = $db->prepare($sql);
		$insert->execute($data);
	}
	
	for($i=0;$i<count($money);$i+=3){
		if(strlen($money[$i+1])>4)
			$money[$i+2]= substr($money[$i+2],0,5);
		$data = array('record_id' => $temp_id, 'date' => strtotime($money[$i]), 'money' => abs($money[$i+2]), 'comment' => $money[$i+1]);
		$sql = "INSERT INTO money(
							record_id,
							date,
							money,
							comment)
						VALUES(
							:record_id,
							:date,
							:money,
							:comment
							)";
		$insert = $db->prepare($sql);
		$insert->execute($data);
	}
	for($i=0;$i<count($goods);$i+=5){
		if(strlen($goods[$i+1])>4)
			$goods[$i+1]= substr($goods[$i+1],0,5);
		if(strlen($goods[$i+2])>4)
			$goods[$i+2]= substr($goods[$i+2],0,5);	
		$data = array('record_id' => $temp_id, 'date' => strtotime($goods[$i+3]), 'name' => $goods[$i], 'price' => abs($goods[$i+1]), 'price_self' => abs($goods[$i+2]), 'comment' => $goods[$i+4]);
		$sql = "INSERT INTO goods(
							record_id,
							date,
							name,
							price,
							price_self,
							comment)
						VALUES(
							:record_id,
							:date,
							:name,
							:price,
							:price_self,
							:comment
							)";
		$insert = $db->prepare($sql);
		$insert->execute($data);
	}
	
	unset($insert);
	unset($db);
}
	
?>