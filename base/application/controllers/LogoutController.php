<?php
class LogoutController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();	
		/* Инициализация модели */
		session_start();
		unset($_SESSION['login']);
		header("Location: http://".$_SERVER['HTTP_HOST']."/base/index.php");
	}
}
?>