<?php
class comparisonViewIcs extends viewIcs {
	public function getTabContent() {
		//This style and script fot showing preview in admin show all comparison tab
		frameIcs::_()->addStyle('frontend.before-after.css', $this->getModule()->getModPath() . 'css/before-after.css');
		frameIcs::_()->addStyle('frontend.comparison', $this->getModule()->getModPath() . 'css/frontend.comparison.css');
		frameIcs::_()->addScript('frontend.before-after.js', $this->getModule()->getModPath() . 'js/before-after.js');

		frameIcs::_()->addStyle('admin.comparison.css', $this->getModule()->getModPath() . 'css/admin.comparison.css');
		frameIcs::_()->getModule('templates')->loadJqGrid();
		frameIcs::_()->addScript('admin.comparison.list', $this->getModule()->getModPath() . 'js/admin.comparison.list.js');
		frameIcs::_()->addJSVar('admin.comparison.list', 'icsTblDataUrl', uriIcs::mod('comparison', 'getListForTbl', array('reqType' => 'ajax')));
		frameIcs::_()->addJSVar('admin.comparison.list', 'url', admin_url('admin-ajax.php'));
		frameIcs::_()->getModule('templates')->loadBootstrapSimple();
		frameIcs::_()->addScript('admin.comparison', $this->getModule()->getModPath() . 'js/admin.comparison.js');
		$this->assign('addNewLink', frameIcs::_()->getModule('options')->getTabUrl('comparison_add_new'));

		return parent::getContent('comparisonAdmin');
	}
	public function getEditTabContent( $idIn ) {

		$id = isset($idIn) ? $idIn : false;

		if ( $id ) {
			$slider   = $this->getModel()->getById( $id );
			$settings = $slider['setting_data'];
			$this->assign('settings', $settings);
			$this->assign('slider', $slider);
		}

		frameIcs::_()->getModule('templates')->loadJqueryUi();
		frameIcs::_()->addStyle('admin.comparison', $this->getModule()->getModPath() . 'css/admin.comparison.css');
		frameIcs::_()->addScript('admin.comparison.edit', $this->getModule()->getModPath() . 'js/admin.comparison.edit.js');
		frameIcs::_()->addScript('admin.photo', $this->getModule()->getModPath() . 'js/photo.js');
		frameIcs::_()->getModule('templates')->loadBootstrapSimple();
		frameIcs::_()->addJSVar('admin.comparison.edit', 'url', admin_url('admin-ajax.php'));
		dispatcherIcs::addAction('afterAdminBreadcrumbs', array($this, 'showEditComparisonFormControls'));
		frameIcs::_()->getModule('templates')->loadBxSlider();
		frameIcs::_()->getModule('templates')->loadFontAwesome();

		return parent::getContent('comparisonEditAdmin');
	}

	public function renderHtml( $params ) {
		$id = isset($params['id']) ? (int) $params['id'] : 0;
		if (!$id){
			return false;
		}
		$slider = $this->getModel()->getById($id);
		$settings = $slider['setting_data'];

		frameIcs::_()->addStyle('frontend.before-after.css', $this->getModule()->getModPath() . 'css/before-after.css');
		frameIcs::_()->addStyle('frontend.comparison', $this->getModule()->getModPath() . 'css/frontend.comparison.css');
		frameIcs::_()->addScript('frontend.before-after.js', $this->getModule()->getModPath() . 'js/before-after.js');
		frameIcs::_()->getModule('templates')->loadFontAwesome();

		$viewId = $id . '_' . mt_rand(0, 999999);
		$this->assign('viewId', $viewId);
		$this->assign('settings', $settings);

		return parent::getContent('comparisonHtml');
	}

	public function showEditComparisonFormControls() {
		parent::display('comparisonEditFormControls');
	}

}
