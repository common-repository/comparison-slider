<?php
class tableUsage_statIcs extends tableIcs {
    public function __construct() {
        $this->_table = '@__usage_stat';
        $this->_id = 'id';     
        $this->_alias = 'sup_usage_stat';
        $this->_addField('id', 'hidden', 'int', 0, __('id', ICS_LANG_CODE))
			->_addField('code', 'hidden', 'text', 0, __('code', ICS_LANG_CODE))
			->_addField('visits', 'hidden', 'int', 0, __('visits', ICS_LANG_CODE))
			->_addField('spent_time', 'hidden', 'int', 0, __('spent_time', ICS_LANG_CODE))
			->_addField('modify_timestamp', 'hidden', 'int', 0, __('modify_timestamp', ICS_LANG_CODE));
    }
}
