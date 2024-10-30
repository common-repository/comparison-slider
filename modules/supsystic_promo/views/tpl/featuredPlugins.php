<section id="supsystic-featured-plugins" class="supsystic-item supsystic-panel">
	<div class="supsysticPageBundleContainer container-fluid">
		<div class="bundle-text col-md-7 col-xs-12"><?php echo esc_html__('Get plugins bundle today and save over 80%', ICS_LANG_CODE); ?></div>
		<div class="bundle-btn col-md-5 col-xs-12">
			<a href="<?php echo esc_url($this->bundleUrl); ?>" class="btn btn-full btn-revert hvr-shutter-out-horizontal" target="_blank">
				<?php echo esc_html__('Check It out', ICS_LANG_CODE); ?>
			</a>
		</div>
	</div>
	<hr />
	<?php foreach ($this->pluginsList as $p) { ?>
		<div class="catitem col-md-4 col-sm-6 col-xs-12">
			<div class="download-product-item">
				<div class="dp-thumb text-center">
					<a href="<?php echo esc_url($p['url']); ?>" target="_blank">
						<img src="<?php echo esc_url($p['img']); ?>" class="img-responsive wp-post-image" alt="<?php echo esc_attr($p['label']); ?>" />
					</a>
				</div>
				<div class="dp-title">
					<a href="<?php echo esc_url($p['url']); ?>" target="_blank">
						<?php echo esc_html($p['label']); ?>
					</a>
				</div>
				<div class="dp-excerpt">
					<div class="dp-excerpt-wrapper">
						<?php echo esc_html($p['desc']); ?>
					</div>
				</div>
				<div class="dp-buttons">
					<a href="<?php echo esc_url($p['url']); ?>" target="_blank" class="btn btn-full hvr-shutter-out-horizontal">
						<?php echo esc_html__('More info', ICS_LANG_CODE); ?>
					</a>
					<a href="<?php echo esc_url($p['download']); ?>" target="_blank" class="btn btn-full btn-info hvr-shutter-out-horizontal">
						<?php echo esc_html__('Download', ICS_LANG_CODE); ?>
					</a>
				</div>
			</div>
		</div>
	<?php } ?>
	<div style="clear: both;"></div>
</section>
