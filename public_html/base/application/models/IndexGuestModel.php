<?php
class IndexGuestModel{
	public function render($file) {
		ob_start();
		include(dirname(__FILE__).'/'.$file);
		return ob_get_clean();
	}
}