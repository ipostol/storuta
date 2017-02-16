<?php
class FrontController {
	protected $_controller, $_action, $_params, $_body;
	static $_instance;

	public static function getInstance() {
		if(!(self::$_instance instanceof self)) 
			self::$_instance = new self();
		return self::$_instance;
	}
	private function __construct(){
		date_default_timezone_set("Europe/Kiev");
		$request = $_SERVER['REQUEST_URI'];
		$splits = explode('/', trim($request,'/'));
		//Какой сontroller использовать?
		if((empty($splits[1]))||(!file_exists('application/controllers/'.ucfirst($splits[1]).'Controller.php')))
			$this->_controller = 'IndexController';
		else 
			$this->_controller = ucfirst($splits[1]).'Controller';
				
		//Какой action использовать?
		$this->_action = !empty($splits[2]) ? $splits[2].'Action' : 'indexAction';
		//Есть ли параметры и их значения?
		if(!empty($splits[3])){
			$keys = $values = array();
				for($i=3, $cnt = count($splits); $i<$cnt; $i++){
					if($i % 2 != 0){
						$keys[] = $splits[$i];
					}else{
						$values[] = $splits[$i];
					}
				}
			try{
				if($i %2 ==0)
					throw new Exception("ArrayCombine");
				else
					$this->_params = array_combine($keys, $values);
			}catch(Exception $e){
				header("Location: http://".$_SERVER['HTTP_HOST']."/base/index.php");
			}
			
		}
	}
	public function route() {
		if(class_exists($this->getController())) {
			$rc = new ReflectionClass($this->getController());
			if($rc->implementsInterface('IController')) {
				if($rc->hasMethod($this->getAction())) {
					$controller = $rc->newInstance();
					$method = $rc->getMethod($this->getAction());
					$method->invoke($controller);
				} else {
					throw new Exception("Action");
				}
			} else {
				throw new Exception("Interface");
			}
		} else {
			throw new Exception("Controller");
		}
	}
	public function getParams() {
		return $this->_params;
	}
	public function getController() {
		return $this->_controller;
	}
	public function getAction() {
		return $this->_action;
	}
	public function getBody() {
		return $this->_body;
	}
	public function setBody($body) {
		$this->_body = $body;
	}
}	
?>