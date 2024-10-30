<?php
class templatesIcs extends moduleIcs {
    protected $_styles = array();
	private $_cdnUrl = '';
	
	public function __construct( $d ) {
		parent::__construct($d);
		$this->getCdnUrl();	// Init CDN URL
	}
	public function getCdnUrl() {
		if (empty($this->_cdnUrl)) {
			if ((int) frameIcs::_()->getModule('options')->get('use_local_cdn')) {
				$uploadsDir = wp_upload_dir( null, false );
				$this->_cdnUrl = $uploadsDir['baseurl'] . '/' . ICS_CODE . '/';
				if (uriIcs::isHttps()) {
					$this->_cdnUrl = str_replace('http://', 'https://', $this->_cdnUrl);
				}
				dispatcherIcs::addFilter('externalCdnUrl', array($this, 'modifyExternalToLocalCdn'));
			} else {
				$this->_cdnUrl = (uriIcs::isHttps() ? 'https' : 'http') . '://supsystic-42d7.kxcdn.com/';
			}
		}
		return $this->_cdnUrl;
	}
	public function modifyExternalToLocalCdn( $url ) {
		$url = str_replace(
			array('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css'), 
			array($this->_cdnUrl . 'lib/font-awesome'), 
			$url);
		return $url;
	}
    public function init() {
        if (is_admin()) {
			if ($isAdminPlugOptsPage = frameIcs::_()->isAdminPlugOptsPage()) {
				$this->loadCoreJs();
				$this->loadAdminCoreJs();
				$this->loadCoreCss();
				$this->loadChosenSelects();
				frameIcs::_()->addScript('adminOptionsIcs', ICS_JS_PATH . 'admin.options.js', array(), false, true);
				add_action('admin_enqueue_scripts', array($this, 'loadMediaScripts'));
				add_action('init', array($this, 'connectAdditionalAdminAssets'));
			}
			// Some common styles - that need to be on all admin pages - be careful with them
			frameIcs::_()->addStyle('supsystic-for-all-admin-' . ICS_CODE, ICS_CSS_PATH . 'supsystic-for-all-admin.css');
		}
        parent::init();
    }
	public function connectAdditionalAdminAssets() {
		if (is_rtl()) {
			frameIcs::_()->addStyle('styleIcs-rtl', ICS_CSS_PATH . 'style-rtl.css');
		}
		frameIcs::_()->addJSVar('coreIcs', 'ICS_DATA2', array('icsNonce' =>  wp_create_nonce('ics-nonce')));
	}
	public function loadMediaScripts() {
		if (function_exists('wp_enqueue_media')) {
			wp_enqueue_media();
		}
	}
	public function loadAdminCoreJs() {
		frameIcs::_()->addScript('jquery-ui-dialog');
		frameIcs::_()->addScript('jquery-ui-slider');
		frameIcs::_()->addScript('wp-color-picker');
		frameIcs::_()->addScript('icheck', ICS_JS_PATH . 'icheck.min.js');
		$this->loadTooltipster();
	}
	public function loadCoreJs() {
		static $loaded = false;
		if (!$loaded) {
			frameIcs::_()->addScript('jquery');

			frameIcs::_()->addScript('commonIcs', ICS_JS_PATH . 'common.js');
			frameIcs::_()->addScript('coreIcs', ICS_JS_PATH . 'core.js');

			$ajaxurl = admin_url('admin-ajax.php');
			$jsData = array(
				'siteUrl'					=> ICS_SITE_URL,
				'imgPath'					=> ICS_IMG_PATH,
				'cssPath'					=> ICS_CSS_PATH,
				'loader'					=> ICS_LOADER_IMG, 
				'close'						=> ICS_IMG_PATH. 'cross.gif', 
				'ajaxurl'					=> $ajaxurl,
				'options'					=> frameIcs::_()->getModule('options')->getAllowedPublicOptions(),
				'ICS_CODE'					=> ICS_CODE,
				//'ball_loader'				=> ICS_IMG_PATH. 'ajax-loader-ball.gif',
				//'ok_icon'					=> ICS_IMG_PATH. 'ok-icon.png',
				'jsPath'					=> ICS_JS_PATH,
			);
			if (is_admin()) {
				$jsData['isPro'] = frameIcs::_()->getModule('supsystic_promo')->isPro();
				$jsData['mainLink'] = frameIcs::_()->getModule('supsystic_promo')->getMainLink();
			}
			$jsData = dispatcherIcs::applyFilters('jsInitVariables', $jsData);
			frameIcs::_()->addJSVar('coreIcs', 'ICS_DATA', $jsData);
			$loaded = true;
		}
	}
	public function loadTooltipster() {
		frameIcs::_()->addScript('tooltipster', frameIcs::_()->getModule('templates')->getModPath() . 'lib/tooltipster/jquery.tooltipster.min.js');
		frameIcs::_()->addStyle('tooltipster', frameIcs::_()->getModule('templates')->getModPath() . 'lib/tooltipster/tooltipster.css');
	}
	public function loadSlimscroll() {
		frameIcs::_()->addScript('jquery.slimscroll', frameIcs::_()->getModule('templates')->getModPath() . 'js/jquery.slimscroll.js');
	}
	public function loadCodemirror() {
		frameIcs::_()->addStyle('icsCodemirror', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/codemirror.css');
		frameIcs::_()->addStyle('codemirror-addon-hint', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/addon/hint/show-hint.css');
		frameIcs::_()->addScript('icsCodemirror', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/codemirror.js');
		frameIcs::_()->addScript('codemirror-addon-show-hint', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/addon/hint/show-hint.js');
		frameIcs::_()->addScript('codemirror-addon-xml-hint', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/addon/hint/xml-hint.js');
		frameIcs::_()->addScript('codemirror-addon-html-hint', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/addon/hint/html-hint.js');
		frameIcs::_()->addScript('codemirror-mode-xml', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/mode/xml/xml.js');
		frameIcs::_()->addScript('codemirror-mode-javascript', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/mode/javascript/javascript.js');
		frameIcs::_()->addScript('codemirror-mode-css', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/mode/css/css.js');
		frameIcs::_()->addScript('codemirror-mode-htmlmixed', frameIcs::_()->getModule('templates')->getModPath() . 'lib/codemirror/mode/htmlmixed/htmlmixed.js');
	}
	public function loadCoreCss() {
		$this->_styles = array(
			'styleIcs'			=> array('path' => ICS_CSS_PATH. 'style.css', 'for' => 'admin'), 
			'supsystic-uiIcs'	=> array('path' => ICS_CSS_PATH. 'supsystic-ui.css', 'for' => 'admin'), 
			'dashicons'			=> array('for' => 'admin'),
			'bootstrap-alerts'	=> array('path' => ICS_CSS_PATH. 'bootstrap-alerts.css', 'for' => 'admin'),
			'icheck'			=> array('path' => ICS_CSS_PATH. 'jquery.icheck.css', 'for' => 'admin'),
			//'uniform'			=> array('path' => ICS_CSS_PATH. 'uniform.default.css', 'for' => 'admin'),
			'wp-color-picker'	=> array('for' => 'admin'),
		);
		foreach ($this->_styles as $s => $sInfo) {
			if (!empty($sInfo['path'])) {
				frameIcs::_()->addStyle($s, $sInfo['path']);
			} else {
				frameIcs::_()->addStyle($s);
			}
		}
		$this->loadFontAwesome();
	}
	public function loadJqueryUi() {
		static $loaded = false;
		if (!$loaded) {
			frameIcs::_()->addStyle('jquery-ui', ICS_CSS_PATH . 'jquery-ui.min.css');
			frameIcs::_()->addStyle('jquery-ui.structure', ICS_CSS_PATH . 'jquery-ui.structure.min.css');
			frameIcs::_()->addStyle('jquery-ui.theme', ICS_CSS_PATH . 'jquery-ui.theme.min.css');
			frameIcs::_()->addStyle('jquery-slider', ICS_CSS_PATH . 'jquery-slider.css');
			$loaded = true;
		}
	}
	public function loadJqGrid() {
		static $loaded = false;
		if (!$loaded) {
			$this->loadJqueryUi();
			frameIcs::_()->addScript('jq-grid', frameIcs::_()->getModule('templates')->getModPath() . 'lib/jqgrid/jquery.jqGrid.min.js');
			frameIcs::_()->addStyle('jq-grid', frameIcs::_()->getModule('templates')->getModPath() . 'lib/jqgrid/ui.jqgrid.css');
			$langToLoad = utilsIcs::getLangCode2Letter();
			$availableLocales = array('ar','bg','bg1251','cat','cn','cs','da','de','dk','el','en','es','fa','fi','fr','gl','he','hr','hr1250','hu','id','is','it','ja','kr','lt','mne','nl','no','pl','pt','pt','ro','ru','sk','sr','sr','sv','th','tr','tw','ua','vi');
			if (!in_array($langToLoad, $availableLocales)) {
				$langToLoad = 'en';
			}
			frameIcs::_()->addScript('jq-grid-lang', frameIcs::_()->getModule('templates')->getModPath() . 'lib/jqgrid/i18n/grid.locale-'. $langToLoad. '.js');
			$loaded = true;
		}
	}
	public function loadFontAwesome() {
		frameIcs::_()->addStyle('font-awesomeIcs', frameIcs::_()->getModule('templates')->getModPath() . 'css/font-awesome.min.css');
	}
	public function loadChosenSelects() {
		frameIcs::_()->addStyle('jquery.chosen', frameIcs::_()->getModule('templates')->getModPath() . 'lib/chosen/chosen.min.css');
		frameIcs::_()->addScript('jquery.chosen', frameIcs::_()->getModule('templates')->getModPath() . 'lib/chosen/chosen.jquery.min.js');
	}
	public function loadDatePicker() {
		frameIcs::_()->addScript('jquery-ui-datepicker');
	}
	public function loadJqplot() {
		static $loaded = false;
		if(!$loaded) {
			$jqplotDir = frameIcs::_()->getModule('templates')->getModPath() . 'lib/jqplot/';

			frameIcs::_()->addStyle('jquery.jqplot', $jqplotDir . 'jquery.jqplot.min.css');

			frameIcs::_()->addScript('jplot', $jqplotDir . 'jquery.jqplot.min.js');
			frameIcs::_()->addScript('jqplot.canvasAxisLabelRenderer', $jqplotDir . 'jqplot.canvasAxisLabelRenderer.min.js');
			frameIcs::_()->addScript('jqplot.canvasTextRenderer', $jqplotDir . 'jqplot.canvasTextRenderer.min.js');
			frameIcs::_()->addScript('jqplot.dateAxisRenderer', $jqplotDir . 'jqplot.dateAxisRenderer.min.js');
			frameIcs::_()->addScript('jqplot.canvasAxisTickRenderer', $jqplotDir . 'jqplot.canvasAxisTickRenderer.min.js');
			frameIcs::_()->addScript('jqplot.highlighter', $jqplotDir . 'jqplot.highlighter.min.js');
			frameIcs::_()->addScript('jqplot.cursor', $jqplotDir . 'jqplot.cursor.min.js');
			frameIcs::_()->addScript('jqplot.barRenderer', $jqplotDir . 'jqplot.barRenderer.min.js');
			frameIcs::_()->addScript('jqplot.categoryAxisRenderer', $jqplotDir . 'jqplot.categoryAxisRenderer.min.js');
			frameIcs::_()->addScript('jqplot.pointLabels', $jqplotDir . 'jqplot.pointLabels.min.js');
			frameIcs::_()->addScript('jqplot.pieRenderer', $jqplotDir . 'jqplot.pieRenderer.min.js');
			$loaded = true;
		}
	}
	public function loadSortable() {
		static $loaded = false;
		if (!$loaded) {
			frameIcs::_()->addScript('jquery-ui-core');
			frameIcs::_()->addScript('jquery-ui-widget');
			frameIcs::_()->addScript('jquery-ui-mouse');

			frameIcs::_()->addScript('jquery-ui-draggable');
			frameIcs::_()->addScript('jquery-ui-sortable');
			$loaded = true;
		}
	}
	public function loadMagicAnims() {
		static $loaded = false;
		if (!$loaded) {
			frameIcs::_()->addStyle('magic.anim', frameIcs::_()->getModule('templates')->getModPath() . 'css/magic.min.css');
			$loaded = true;
		}
	}


	public function loadCssAnims() {
		static $loaded = false;
		if (!$loaded) {
			//ver 3.4.0
			frameIcs::_()->addStyle('animate.styles', frameIcs::_()->getModule('templates')->getModPath() . 'css/animate.min.css');
			$loaded = true;
		}
	}
	public function loadBootstrapSimple() {
		static $loaded = false;
		if (!$loaded) {
			frameIcs::_()->addStyle('bootstrap-simple', ICS_CSS_PATH . 'bootstrap-simple.css');
			$loaded = true;
		}
	}
	public function loadGoogleFont( $font ) {
		static $loaded = array();
		if (!isset($loaded[ $font ])) {
			frameIcs::_()->addStyle('google.font.' . str_replace(array(' '), '-', $font), 'https://fonts.googleapis.com/css?family=' . urlencode($font));
			$loaded[ $font ] = 1;
		}
	}
	public function loadBxSlider() {
		static $loaded = false;
		if (!$loaded) {
			frameIcs::_()->addStyle('bx-slider', ICS_JS_PATH . 'bx-slider/jquery.bxslider.css');
			frameIcs::_()->addScript('bx-slider', ICS_JS_PATH . 'bx-slider/jquery.bxslider.min.js');
			$loaded = true;
		}
	}
}
