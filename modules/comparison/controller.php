<?php
class comparisonControllerIcs extends controllerIcs {
	public function getNoncedMethods() {
		return array('updateSettingFromTpl', 'removeGroup');
	}
	protected function _prepareTextLikeSearch( $val ) {
		$query = '(title LIKE "%' . $val . '%"';
		if (is_numeric($val)) {
			$query .= ' OR id LIKE "%' . (int) $val . '%"';
		}
		$query .= ')';
		return $query;
	}
	/**
	 * Update settings comparison slider action
	 */
	public function updateSettingFromTpl() {

		$res = new responseIcs();

		if (($id = $this->getModel()->updateSettingFromTpl(reqIcs::get('post'))) != false) {
			$res->addMessage(__('Done', ICS_LANG_CODE));
			$res->addData('edit_link', $this->getModule()->getEditLink( $id ));
		} else {
			$res->pushError ($this->getModel()->getErrors());
		}
		return $res->ajaxExec();
	}
	public function _prepareListForTbl( $data ) {
		foreach($data as $key=>$row){
			$id = $row['id'];
			$shortcode = '[' . ICS_SHORTCODE . ' id=' . esc_attr($id) . ']';
			$showPrewiewButton = '<button data-id="' . esc_attr($id) . '" data-shortcode="' . esc_attr($shortcode) . '" class="button button-primary button-prewiew" style="margin-top: 1px;">' . esc_html__('Prewiew', ICS_LANG_CODE) . '</button>';
			$showEditButton = '<button data-id="' . esc_attr($id) . '" data-href="' . esc_url($this->getModule()->getEditLink( $id )) . '" class="button button-primary button-edit" style="margin-top: 1px;">' . esc_html__('Edit', ICS_LANG_CODE) . ' <i class="fa fa-fw fa-pencil"></i></button>';
			$titleUrl = '<a href=' . esc_url($this->getModule()->getEditLink( $id )) . ' class="icsEditTitle">' . esc_html($row['title']) . ' <i class="fa fa-fw fa-pencil"></i></a><input class="icsHidden icsEditLinkInput" type="text" data-id="' . esc_attr($id) . '" value="' . esc_attr($row['title']) . '">';
			$data[$key]['shortcode'] = $shortcode;
			$data[$key]['action'] = $showEditButton . $showPrewiewButton;
			$data[$key]['title'] = $titleUrl;
		}
		return $data;
	}
	public function loadPreview() {
		$res = new responseIcs();
		$params = reqIcs::get('post');
		if (isset($params['id'])) {
			$slider = $this->getView()->renderHtml($params);
			echo $slider;
		} else {
			$res->pushError ($this->getModel()->getErrors());
		}
		exit();
	}
}

