<?php
class IndexController implements IController {
	public function indexAction() {
		$fc = FrontController::getInstance();	
		/* Инициализация модели */
		session_start();
		if(md5($_POST['password'])=='1b47b914c8e581e5e67d34a25fc5ef28'){
			$_SESSION['login']='true';
			$_SESSION['name']=$_POST['name'];
			header("Location: http://".$_SERVER['HTTP_HOST']."/base");
		}
		if($_SESSION['login']=='true'){
			$model = new IndexModel();
			$output = $model->render('');
		}
		else{
			$model = new IndexGuestModel();
			$output = $model->render('../views/user_default.php');
		}
		$fc->setBody($output);
	}
}
?>