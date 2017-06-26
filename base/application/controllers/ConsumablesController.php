<?php
session_start();
if($_SESSION['login']!='true'){
	header("Location: http://".$_SERVER['HTTP_HOST']."/base");
}
class ConsumablesController implements IController {
	public function indexAction() {
		header("Location: http://{$_SERVER[HTTP_HOST]}/base/consumables/show");
	}
	public function showAction(){
		$fc = FrontController::getInstance();
		$params =$fc->getParams();
		$model = new ConsumablesModel();;
		$model->id = $params['id'];
		$output = $model->render('../views/show_consumables.php');
		$fc->setBody($output);
	}
}
?>