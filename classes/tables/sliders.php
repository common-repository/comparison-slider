<?php
class tableSlidersIcs extends tableIcs {
	public function __construct() {
		$this->_table = '@__sliders';
		$this->_id = 'id';
		$this->_alias = 'icl_sliders';
		$this->_addField('id', 'text', 'int')
		     ->_addField('title', 'text', 'varchar')
		     ->_addField('plugin', 'text', 'varchar')
		     ->_addField('setting_data', 'text', 'text');
	}
}
