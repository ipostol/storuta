<?php
require_once "header.php";
$date = date("d-m-Y H:i:s");
echo <<<LABEL
<body>
<div id="skin">
<div id="time">
	<p class = 'show_not_price'>
		{$date}
		{$_SESSION['name']}
		<a href = "{$params['url']}logout" >Выход</a>
	</p>
</div>
<div id="css-menu">
			<ul>
			<li><a href="{$params['url']}records/show">
				<span class="text-top">Заказ наряды</span>
				<span class="text-bottom">Инфо</span>
				</a></li>
				<li><a href="{$params['url']}charge/show">
				<span class="text-top">Зарплаты</span>
				<span class="text-bottom">все выплаты</span>
				</a></li>
				<li><a href="{$params['url']}cash/show">
				<span class="text-top">Касса</span>
				<span class="text-bottom">Все рассходы</span>
				</a></li>
				<li><a href="{$params['url']}consumables/show">
				<span class="text-top">Рассходники</span>
				<span class="text-bottom">Расходы и т.д</span>
				</a></li>
			</ul>
</div>
LABEL;
?>