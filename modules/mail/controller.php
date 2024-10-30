<?php
class mailControllerIcs extends controllerIcs {
	public function testEmail() {
		$res = new responseIcs();
		$email = reqIcs::getVar('test_email', 'post');
		if ($this->getModel()->testEmail($email)) {
			$res->addMessage(__('Now check your email inbox / spam folders for test mail.'));
		} else {
			$res->pushError ($this->getModel()->getErrors());
		}
		$res->ajaxExec();
	}
	public function saveMailTestRes() {
		$res = new responseIcs();
		$result = (int) reqIcs::getVar('result', 'post');
		frameIcs::_()->getModule('options')->getModel()->save('mail_function_work', $result);
		$res->ajaxExec();
	}
	public function saveOptions() {
		$res = new responseIcs();
		$optsModel = frameIcs::_()->getModule('options')->getModel();
		$submitData = reqIcs::get('post');
		if ($optsModel->saveGroup($submitData)) {
			$res->addMessage(__('Done', ICS_LANG_CODE));
		} else {
			$res->pushError ($optsModel->getErrors());
		}
		$res->ajaxExec();
	}
	public function getPermissions() {
		return array(
			ICS_USERLEVELS => array(
				ICS_ADMIN => array('testEmail', 'saveMailTestRes', 'saveOptions')
			),
		);
	}
}
