<?php header("Content-type:text/html;charset=utf-8");
?>
<script src="jquery.js"></script>
<script src="my_js.js"></script>
<style>
.for_td{
	background-color:black;
	}
.first
{
	background-color:red;
}
.end
{
	background-color:blue;	
}
  td,tr{
    border:1px solid black;
}
  table{
   border-collapse: collapse;
  }
</style>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
	$length = abs($_POST['length']);
	if($length){
		$length2 = $length*40+$length*5;
		echo "<table border='3px' width='$length2'>";
		for($i=0;$i<$length;$i++){
			echo "<tr>";
			for($j=0;$j<$length;$j++){
				echo "<td height='40' width='40'></td>";
				}
			echo "</tr>";
			}
		echo "</table>";
		echo "<br/><br/>";
		echo "<button id = 'button' type='button' name = '$length'> Ready </button>";
		echo "<button id = 'button1' type='button' name = '$length'> Ready </button>";
	}
	else{
			echo <<<LABEL
			<form action="form_lab.php">
			<p>Вы ввели неправильное значение, нажмиите кнопку, если хотите попробывать снова</p>
			<button type="submit">Try again</button>
			</form>
LABEL;
		}
}
?>