<?php
class comparisonIcs extends moduleIcs {
	public function init() {
		dispatcherIcs::addFilter('mainAdminTabs', array($this, 'addAdminTab'));
		add_shortcode(ICS_SHORTCODE, array($this, 'render'));
	}
	public function addAdminTab($tabs) {
		$tabs[ $this->getCode(). '_add_new' ] = array(
			'label' => __('Add New Slider', ICS_LANG_CODE), 'callback' => array($this, 'getEditTabContent'), 'fa_icon' => 'fa-plus-circle', 'sort_order' => 10, 'add_bread' => $this->getCode(),
		);
		$tabs[ $this->getCode(). '_edit' ] = array(
			'label' => __('Edit', ICS_LANG_CODE), 'callback' => array($this, 'getEditTabContent'), 'sort_order' => 20, 'child_of' => $this->getCode(), 'hidden' => 1, 'add_bread' => $this->getCode(),
		);
		$tabs[ $this->getCode() ] = array(
			'label' => __('Sliders', ICS_LANG_CODE), 'callback' => array($this, 'getTabContent'), 'fa_icon' => 'fa-list', 'sort_order' => 20, //'is_main' => true,
		);
		return $tabs;
	}
	public function getTabContent() {
		return $this->getView()->getTabContent();
	}
	public function getEditTabContent() {
		$id = (int) reqIcs::getVar('id', 'get');
		return $this->getView()->getEditTabContent( $id );
	}
	public function getEditLink( $id, $comparisonTab = '' ) {
		$link = frameIcs::_()->getModule('options')->getTabUrl( $this->getCode() . '_edit' );
		$link .= '&id=' . $id;
		if(!empty($comparisonTab)) {
			$link .= '#' . $comparisonTab;
		}
		return $link;
	}
	public function render( $params ) {
		return $this->getView()->renderHtml($params);
	}

}

