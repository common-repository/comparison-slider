<?php
class mailViewIcs extends viewIcs {
	public function getTabContent() {
		frameIcs::_()->getModule('templates')->loadJqueryUi();
		frameIcs::_()->addScript('admin.' . $this->getCode(), $this->getModule()->getModPath(). 'js/admin.' . $this->getCode() . '.js');
		
		$this->assign('options', frameIcs::_()->getModule('options')->getCatOpts( $this->getCode() ));
		$this->assign('testEmail', frameIcs::_()->getModule('options')->get('notify_email'));
		return parent::getContent('mailAdmin');
	}
}
