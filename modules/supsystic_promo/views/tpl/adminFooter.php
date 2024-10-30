<div class="icsAdminFooterShell">
	<div class="icsAdminFooterCell">
		<?php echo esc_html(ICS_WP_PLUGIN_NAME); ?>
		<?php echo esc_html__('Version', ICS_LANG_CODE); ?>:
		<a target="_blank" href="http://wordpress.org/plugins/popup-by-supsystic/changelog/"><?php echo esc_html(ICS_VERSION); ?></a>
	</div>
	<div class="icsAdminFooterCell">|</div>
	<?php if (!frameIcs::_()->getModule(implode('', array('l','ic','e','ns','e')))) { ?>
	<div class="icsAdminFooterCell">
		<?php echo esc_html__('Go', ICS_LANG_CODE); ?>&nbsp;<a target="_blank" href="<?php echo esc_url($this->getModule()->getMainLink()); ?>"><?php echo esc_html__('PRO', ICS_LANG_CODE); ?></a>
	</div>
	<div class="icsAdminFooterCell">|</div>
	<?php } ?>
	<div class="icsAdminFooterCell">
		<a target="_blank" href="http://wordpress.org/support/plugin/popup-by-supsystic"><?php echo esc_html__('Support', ICS_LANG_CODE); ?></a>
	</div>
	<div class="icsAdminFooterCell">|</div>
	<div class="icsAdminFooterCell">
		Add your <a target="_blank" href="http://wordpress.org/support/view/plugin-reviews/popup-by-supsystic?filter=5#postform">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on wordpress.org.
	</div>
</div>
