<?php
	global $wpdb;
	if (!defined('WPLANG') || WPLANG == '') {
		define('ICS_WPLANG', 'en_GB');
	} else {
		define('ICS_WPLANG', WPLANG);
	}
	if (!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}

	define('ICS_PLUG_NAME', basename(dirname(__FILE__)));
	define('ICS_DIR', WP_PLUGIN_DIR . DS . ICS_PLUG_NAME . DS);
	define('ICS_TPL_DIR', ICS_DIR . 'tpl' . DS);
	define('ICS_CLASSES_DIR', ICS_DIR . 'classes' . DS);
	define('ICS_TABLES_DIR', ICS_CLASSES_DIR . 'tables' . DS);
	define('ICS_HELPERS_DIR', ICS_CLASSES_DIR . 'helpers' . DS);
	define('ICS_LANG_DIR', ICS_DIR . 'lang' . DS);
	define('ICS_IMG_DIR', ICS_DIR . 'img' . DS);
	define('ICS_TEMPLATES_DIR', ICS_DIR . 'templates' . DS);
	define('ICS_MODULES_DIR', ICS_DIR . 'modules' . DS);
	define('ICS_FILES_DIR', ICS_DIR . 'files' . DS);
	define('ICS_ADMIN_DIR', ABSPATH . 'wp-admin' . DS);

	define('ICS_PLUGINS_URL', plugins_url());
	define('ICS_SITE_URL', get_bloginfo('wpurl') . '/');
	define('ICS_JS_PATH', ICS_PLUGINS_URL . '/' . ICS_PLUG_NAME . '/js/');
	define('ICS_CSS_PATH', ICS_PLUGINS_URL . '/' . ICS_PLUG_NAME . '/css/');
	define('ICS_IMG_PATH', ICS_PLUGINS_URL . '/' . ICS_PLUG_NAME . '/img/');
	define('ICS_MODULES_PATH', ICS_PLUGINS_URL . '/' . ICS_PLUG_NAME . '/modules/');
	define('ICS_TEMPLATES_PATH', ICS_PLUGINS_URL . '/' . ICS_PLUG_NAME . '/templates/');
	define('ICS_JS_DIR', ICS_DIR . 'js/');

	define('ICS_URL', ICS_SITE_URL);

	define('ICS_LOADER_IMG', ICS_IMG_PATH . 'loading.gif');
	define('ICS_TIME_FORMAT', 'H:i:s');
	define('ICS_DATE_DL', '/');
	define('ICS_DATE_FORMAT', 'm/d/Y');
	define('ICS_DATE_FORMAT_HIS', 'm/d/Y (' . ICS_TIME_FORMAT . ')');
	define('ICS_DATE_FORMAT_JS', 'mm/dd/yy');
	define('ICS_DATE_FORMAT_CONVERT', '%m/%d/%Y');
	define('ICS_WPDB_PREF', $wpdb->prefix);
	define('ICS_DB_PREF', 'ics_');
	define('ICS_MAIN_FILE', 'ics.php');

	define('ICS_DEFAULT', 'default');
	define('ICS_CURRENT', 'current');
	
	define('ICS_EOL', "\n");    
	
	define('ICS_PLUGIN_INSTALLED', true);
	define('ICS_VERSION', '1.0.8');
	define('ICS_USER', 'user');
	
	define('ICS_CLASS_PREFIX', 'icsc');     
	define('ICS_FREE_VERSION', false);
	define('ICS_TEST_MODE', true);
	
	define('ICS_SUCCESS', 'Success');
	define('ICS_FAILED', 'Failed');
	define('ICS_ERRORS', 'icsErrors');
	
	define('ICS_ADMIN',	'admin');
	define('ICS_LOGGED','logged');
	define('ICS_GUEST',	'guest');
	
	define('ICS_ALL', 'all');
	
	define('ICS_METHODS', 'methods');
	define('ICS_USERLEVELS', 'userlevels');
	/**
	 * Framework instance code
	 */
	define('ICS_CODE', 'ics');
	define('ICS_LANG_CODE', 'ics_lng');
	/**
	 * Plugin name
	 */
	define('ICS_WP_PLUGIN_NAME', 'Comparison Slider');
	/**
	 * Custom defined for plugin
	 */
	define('ICS_SHORTCODE', 'ics-comparison-slider');
