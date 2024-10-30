<?php
/**
 * Plugin Name: Comparison Slider
 * Plugin URI: https://pareslider.com/
 * Description: Image Comparison Slider plugin allow user to view a comparison between two images.
 * Version: 1.0.8
 * Author: pareslider.com
 * Author URI: https://pareslider.com
 * License: GPLv2 or later
 **/
	/**
	 * Base config constants and functions
	 */
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php');
    require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'functions.php');
	/**
	 * Connect all required core classes
	 */
    importClassIcs('dbIcs');
    importClassIcs('installerIcs');
    importClassIcs('baseObjectIcs');
    importClassIcs('moduleIcs');
    importClassIcs('modelIcs');
    importClassIcs('viewIcs');
    importClassIcs('controllerIcs');
    importClassIcs('helperIcs');
    importClassIcs('dispatcherIcs');
    importClassIcs('fieldIcs');
    importClassIcs('tableIcs');
    importClassIcs('frameIcs');
	/**
	 * @deprecated since version 1.0.1
	 */
    importClassIcs('langIcs');
    importClassIcs('reqIcs');
    importClassIcs('uriIcs');
    importClassIcs('htmlIcs');
    importClassIcs('responseIcs');
    importClassIcs('fieldAdapterIcs');
    importClassIcs('validatorIcs');
    importClassIcs('errorsIcs');
    importClassIcs('utilsIcs');
    importClassIcs('modInstallerIcs');
	importClassIcs('installerDbUpdaterIcs');
	importClassIcs('dateIcs');
	/**
	 * Check plugin version - maybe we need to update database, and check global errors in request
	 */
    installerIcs::update();
    errorsIcs::init();
    /**
	 * Start application
	 */
    frameIcs::_()->parseRoute();
    frameIcs::_()->init();
    frameIcs::_()->exec();
	
	//var_dump(frameIcs::_()->getActivationErrors()); exit();
