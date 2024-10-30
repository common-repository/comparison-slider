<?php
class comparisonModelIcs extends modelIcs {
	public function __construct() {
		$this->_setTbl('sliders');
	}
	/**
	 * Exclude some data from list - to avoid memory overload
	 */
//	public function getSimpleList($where = array(), $params = array()) {
//		if($where)
//			$this->setWhere ($where);
//		return $this->setSelectFields('id, title, plugin, setting_data')->getFromTbl( $params );
//	}
	public function updateSettingFromTpl( $d = array() ) {
		$id = isset($d['id']) ? ($d['id']) : '';
		//if id not empty
		if (!empty($id)) {
			$statusUpdate = $this->updateById( $d , $id );
			if ($statusUpdate) {
				return $id;
			}
		} else if ( empty($id) ) {
			$idInsert = $this->insert( $d );
			if ($idInsert) {
				$d['title'] = (string)$idInsert;
				$d['id'] = (string)$idInsert;
				$this->updateById( $d , $idInsert );
			}
			return $idInsert;
		} else {
			$this->pushError (__('Please enter Name', ICS_LANG_CODE), 'title');
		}
		return false;
	}
	protected function _afterGetFromTbl( $row ) {
		$settingData = isset($row['setting_data']) ? $row['setting_data'] : '';
		if (empty($settingData)) {
			return $row;
		} else {
			$settings = unserialize($settingData);
			$row['setting_data'] = $settings;
		}
		return $row;
	}
	protected function _dataSave( $data, $update = false ) {
		$settings = isset($data['settings']) ? $data['settings'] : '';
		if (empty($settings)) {
			return $data;
		} else {
			$settings = serialize($settings);
			$data['setting_data'] = $settings;
		}
		return $data;
	}
}
