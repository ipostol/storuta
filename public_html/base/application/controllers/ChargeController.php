<?php
session_start();
if($_SESSION['login']!='true'){
	header("Location: http://".$_SERVER['HTTP_HOST']."/base");
}
class ChargeController implements IController {
	public function indexAction() {
		header("Location: http://{$_SERVER[HTTP_HOST]}/base/charge/show");
	}
	public function showAction(){
		$fc = FrontController::getInstance();
		$params =$fc->getParams();
		$model = new ChargeModel();
		$model->repair_id = $params['repair_id'];
		$model->id = $params['id'];
		$model->Date = $params['date'];
		$output = $model->render('../views/show_charge.php');
		$fc->setBody($output);
	}
	public function changeAction(){
		/*$fc = FrontController::getInstance();
		$params =$fc->getParams();
		$model = new RecordChangeModel();
		$model->id = $params['id'];
		$output = $model->render('../views/change_record.php');
		$fc->setBody($output);	*/
	}
}
?>