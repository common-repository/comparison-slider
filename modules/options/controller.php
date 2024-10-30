<?php
class optionsControllerIcs extends controllerIcs {
	public function getNoncedMethods() {
		return array('saveGroup');
	}
	public function saveGroup() {
		$res = new responseIcs();
		if ($this->getModel()->saveGroup(reqIcs::get('post'))) {
			$res->addMessage(__('Done', ICS_LANG_CODE));
		} else {
			$res->pushError ($this->getModel('options')->getErrors());
		}
		return $res->ajaxExec();
	}
	public function getPermissions() {
		return array(
			ICS_USERLEVELS => array(
				ICS_ADMIN => array('saveGroup')
			),
		);
	}
}

