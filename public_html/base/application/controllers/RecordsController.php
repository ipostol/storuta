<?php
session_start();
if($_SESSION['login']!='true'){
	header("Location: http://".$_SERVER['HTTP_HOST']."/base");
}
class RecordsController implements IController {
	public function indexAction() {
		header("Location: http://{$_SERVER[HTTP_HOST]}/base/records/show");
	}
	public function showAction(){
		$fc = FrontController::getInstance();
		$model = new RecordsModel();
		$output = $model->render('../views/show_records.php');
		$fc->setBody($output);	
	}
	public function changeAction(){
		$fc = FrontController::getInstance();
		$params =$fc->getParams();
		$model = new RecordChangeModel();
		$model->id = $params['id'];
		$output = $model->render('../views/change_record.php');
		$fc->setBody($output);	
	}
	public function addAction(){
		$fc = FrontController::getInstance();
		$model = new AddRecordModel();
		$output = $model->render('../views/add_record.php');
		$fc->setBody($output);	
	}
}
?>