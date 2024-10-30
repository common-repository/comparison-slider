<?php
class adminmenuIcs extends moduleIcs {
	protected $_mainSlug = 'ics-comparison-slider';
	private $_mainCap = 'manage_options';
    public function init() {
        parent::init();
		add_action('admin_menu', array($this, 'initMenu'), 9);
		$plugName = plugin_basename(ICS_DIR. ICS_MAIN_FILE);
		add_filter('plugin_action_links_'. $plugName, array($this, 'addSettingsLinkForPlug') );
    }
	public function addSettingsLinkForPlug($links) {
		$mainLink = 'https://pareslider.com/';
		$twitterStatus = sprintf(__('Cool WordPress plugins from pareslider.com developers. I tried %s - and this was what I need! #pareslider.com', ICS_LANG_CODE), ICS_WP_PLUGIN_NAME);
		array_unshift($links, '<a href="'. $this->getMainLink(). '">'. __('Settings', ICS_LANG_CODE). '</a>');
		array_push($links, '<a title="'. __('More plugins for your WordPress site here!', ICS_LANG_CODE). '" href="'. $mainLink. '" target="_blank">pareslider.com</a>');
		array_push($links, '<a title="'. __('Spread the word!', ICS_LANG_CODE). '" href="https://www.facebook.com/sharer/sharer.php?u='. urlencode($mainLink). '" target="_blank" class="dashicons-before dashicons-facebook-alt"></a>');
		array_push($links, '<a title="'. __('Spread the word!', ICS_LANG_CODE). '" href="https://twitter.com/home?status='. urlencode($twitterStatus). '" target="_blank" class="dashicons-before dashicons-twitter"></a>');
		array_push($links, '<a title="'. __('Spread the word!', ICS_LANG_CODE). '" href="https://plus.google.com/share?url='. urlencode($mainLink). '" target="_blank" class="dashicons-before dashicons-googleplus"></a>');
		return $links;
	}
	public function initMenu() {
		$mainCap = $this->getMainCap();
		$mainSlug = dispatcherIcs::applyFilters('adminMenuMainSlug', $this->_mainSlug);
		$mainMenuPageOptions = array(
			'page_title' => ICS_WP_PLUGIN_NAME, 
			'menu_title' => ICS_WP_PLUGIN_NAME, 
			'capability' => $mainCap,
			'menu_slug' => $mainSlug,
			'function' => array(frameIcs::_()->getModule('options'), 'getAdminPage'));
		$mainMenuPageOptions = dispatcherIcs::applyFilters('adminMenuMainOption', $mainMenuPageOptions);
        add_menu_page($mainMenuPageOptions['page_title'], $mainMenuPageOptions['menu_title'], $mainMenuPageOptions['capability'], $mainMenuPageOptions['menu_slug'], $mainMenuPageOptions['function'], 'dashicons-image-flip-horizontal');
		//remove duplicated WP menu item
		//add_submenu_page($mainMenuPageOptions['menu_slug'], '', '', $mainMenuPageOptions['capability'], $mainMenuPageOptions['menu_slug'], $mainMenuPageOptions['function']);
		$tabs = frameIcs::_()->getModule('options')->getTabs();
		$subMenus = array();
		foreach ($tabs as $tKey => $tab) {
			if ($tKey == 'main_page') {
				continue;	// Top level menu item - is main page, avoid place it 2 times
			}
			if ((isset($tab['hidden']) && $tab['hidden'])
				|| (isset($tab['hidden_for_main']) && $tab['hidden_for_main'])	// Hidden for WP main
				|| (isset($tab['is_main']) && $tab['is_main'])) {
					continue;
				}
			$subMenus[] = array(
				'title' => $tab['label'], 'capability' => $mainCap, 'menu_slug' => 'admin.php?page='. $mainSlug. '&tab='. $tKey, 'function' => '',
			);
		}
		$subMenus = dispatcherIcs::applyFilters('adminMenuOptions', $subMenus);
		foreach ($subMenus as $opt) {
			add_submenu_page($mainSlug, $opt['title'], $opt['title'], $opt['capability'], $opt['menu_slug'], $opt['function']);
		}
	}
	public function getMainLink() {
		return uriIcs::_(array('baseUrl' => admin_url('admin.php'), 'page' => $this->getMainSlug()));
	}
	public function getMainSlug() {
		return $this->_mainSlug;
	}
	public function getMainCap() {
		return dispatcherIcs::applyFilters('adminMenuAccessCap', $this->_mainCap);
	}
}

