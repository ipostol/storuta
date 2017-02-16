<?php
session_start();
if($_SESSION['login']!='true'){
	header("Location: http://".$_SERVER['HTTP_HOST']."/base");
}
class CashController implements IController {
	public function indexAction() {
		header("Location: http://{$_SERVER[HTTP_HOST]}/base/cash/show");
	}
	public function showAction(){
		$fc = FrontController::getInstance();
		$params =$fc->getParams();
		$model = new CashModel();;
		$model->id = $params['id'];
		$output = $model->render('../views/show_cash.php');
		$fc->setBody($output);
	}
}
?>