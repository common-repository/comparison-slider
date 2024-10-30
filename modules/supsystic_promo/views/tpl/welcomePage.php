<section>
	<div class="supsystic-item supsystic-panel supsystic-plugin">
		<div id="containerWrapper">
			<div class="row">
				<div class="col-sm-12">
					<h2>
						<?php printf(__('Welcome to the %s v %s', ICS_LANG_CODE), ICS_WP_PLUGIN_NAME, ICS_VERSION); ?>
						<a style="margin-top: -8px; margin-left: 5px;" href="<?php echo esc_url($this->skipTutorLink); ?>" class="button"><?php echo esc_html__('Skip tutorial', ICS_LANG_CODE); ?></a>
					</h2>
					<p>
						<?php echo esc_html__('The best way to collect subscribers and show notifications.<br />We are trying to make our plugin work in most comfortable way for you. Here is some base information about it.', ICS_LANG_CODE); ?>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-6">
							<h3><?php echo esc_html__('Step-by-step tutorial', ICS_LANG_CODE); ?></h3>
							<p>
								<?php echo esc_html__("There're really many options of popup customization. So as soon as you close that page, I'll show you step-by-step tutorial of how to use plugin. Hope it will be usefull for you :)", ICS_LANG_CODE); ?>
							</p>
							<p>
								<?php echo esc_html__('As an option we can install and setup plugin for you.', ICS_LANG_CODE); ?>
							</p>
						</div>
						<div class="col-sm-6">
							<h3><?php echo esc_html__('Support', ICS_LANG_CODE); ?></h3>
							<p>
								<?php printf(__("We love our plugin and do the best to improve all features for You. But sometimes issues happened, or you can't find required feature that you need. Don't worry, just <a href='%s' target='_blank'>contact us</a> and we will help you!", ICS_LANG_CODE), $this->getModule()->getContactLink()); ?>
							</p>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<h3><?php echo esc_html__('Video Tutorial', ICS_LANG_CODE); ?></h3>
							<iframe type="text/html"
									width="90%"
									height="330px"
									src="https://www.youtube.com/embed/v8h2k3vvpdM"
									frameborder="0">
							</iframe>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<h3>
						<?php echo esc_html__('Frequently Asked Questions', ICS_LANG_CODE); ?>
					</h3>
					<?php foreach ($this->faqList as $fHead => $fDesc) { ?>
					<h4><?php echo esc_html($fHead); ?></h4>
					<p><?php echo esc_html($fDesc); ?></p>
					<?php } ?>
					<div style="clear: both;"></div>
					<a target="_blank" href="<?php echo esc_url($this->mainLink); ?>#faq" style="font-size: 16px; padding-right: 15px; white-space: nowrap; font-weight: normal;">
						<i class="fa fa-info-circle"></i>
						<?php echo esc_html__('Check all FAQs', ICS_LANG_CODE); ?>
					</a>
					<div style="clear: both;"></div>
					<a href="<?php echo esc_url($this->createNewLink); ?>" class="button button-primary button-hero" style="font-size: 20px; margin: 20px 20px 20px 0; min-width: 160px; text-align: center;"><?php _e("Let's Start!", ICS_LANG_CODE)?></a>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
</section>
