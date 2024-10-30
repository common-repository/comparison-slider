<?php
class admin_navControllerIcs extends controllerIcs {
	public function getPermissions() {
		return array(
			ICS_USERLEVELS => array(
				ICS_ADMIN => array()
			),
		);
	}
}