<?php
class pagesViewIcs extends viewIcs {
	public function displayDeactivatePage() {
		$this->assign('GET', reqIcs::get('get'));
		$this->assign('POST', reqIcs::get('post'));
		$this->assign('REQUEST_METHOD', strtoupper(reqIcs::getVar('REQUEST_METHOD', 'server')));
		$this->assign('REQUEST_URI', basename(reqIcs::getVar('REQUEST_URI', 'server')));
		parent::display('deactivatePage');
	}
}
