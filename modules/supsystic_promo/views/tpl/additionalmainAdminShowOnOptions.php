<label class="supsystic-tooltip-right" title="<?php echo esc_html(sprintf(__('Show when user tries to exit from your site. <a target="_blank" href="%s">Check example.</a>', ICS_LANG_CODE), 'https://pareslider.com/exit-popup/?utm_source=plugin&utm_medium=onexit&utm_campaign=popup')); ?>">
	<a target="_blank" href="<?php echo esc_url($this->promoLink); ?>" class="sup-promolink-input">
		<?php echo htmlIcs::radiobutton('promo_show_on_opt', array(
			'value' => 'on_exit_promo',
			'checked' => false,
		))?>
		<?php echo esc_html__('On Exit from Site', ICS_LANG_CODE); ?>
	</a>
	<a target="_blank" href="<?php echo esc_url($this->promoLink); ?>"><?php echo esc_html__('Available in PRO'); ?></a>
</label>
