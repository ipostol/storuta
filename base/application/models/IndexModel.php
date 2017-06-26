<?php
class IndexModel{
	public function render($file) {
		$params = parse_ini_file('settings.ini');
		ob_start();
		require_once (__DIR__."/../views/admin_default.php");
		if($file)
			include(dirname(__FILE__).'/'.$file);
		require_once (__DIR__."/../views/admin_default_end.php");
		return ob_get_clean();
	}
}