<?php
header("Content-type:text/html;charset=utf8");
/* Пути по-умолчанию для поиска файлов */
set_include_path(get_include_path()
					.PATH_SEPARATOR.'application/controllers'
					.PATH_SEPARATOR.'application/models'
					.PATH_SEPARATOR.'application/views');

/* Автозагрузчик классов */
function __autoload($class){
	require_once($class.'.php');
}

/* Инициализация и запуск FrontController */
$front = FrontController::getInstance();
try{
	$front->route();
}catch(Exception $e){
	echo $e;
	//header("Location: http://".$_SERVER['HTTP_HOST']."/base/index.php");
};
/* Вывод данных */
echo $front->getBody();
?>