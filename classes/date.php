<?php
class dateIcs {
	static public function _( $time = NULL ) {
		if (is_null($time)) {
			$time = time();
		}
		return date(ICS_DATE_FORMAT_HIS, $time);
	}
}
