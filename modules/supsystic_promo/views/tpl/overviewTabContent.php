<section>
	<div class="supsystic-item supsystic-panel">
		<div id="containerWrapper">
			<div class="supsistic-half-side-box supsystic-border-right">
				<h3><?php echo esc_html__('FAQ and Documentation', ICS_LANG_CODE); ?></h3>
				<div class="faq-list">
					<?php foreach ($this->faqList as $title => $desc) { ?>
						<div class="faq-title">
							 <i class="fa fa-info-circle"></i>
							 <?php echo esc_html($title); ?>
							 <div class="description" style="display: none;"><?php echo esc_html($desc); ?></div>
						</div>
					<?php } ?>
					<div style="clear: both;"></div>
					<a target="_blank" class="button button-primary button-hero" href="<?php echo esc_url($this->mainLink); ?>#faq" style="float: right;">
						<i class="fa fa-info-circle"></i>
						<?php echo esc_html__('Check all FAQs', ICS_LANG_CODE); ?>
					</a>
					<div style="clear: both;"></div>
				</div>
				<div class="video">
					<h3><?php echo esc_html__('Video Tutorial', ICS_LANG_CODE); ?></h3>
					<iframe type="text/html"
							width="80%"
							height="240px"
							src="https://www.youtube.com/embed/v8h2k3vvpdM"
							frameborder="0">
					</iframe>
				</div>
				<div class="server-settings">
					<h3><?php echo esc_html__('Server Settings', ICS_LANG_CODE); ?></h3>
					<ul class="settings-list">
						<?php foreach ($this->serverSettings as $title => $element) { ?>
							<li class="settings-line">
								<div class="settings-title"><?php echo esc_html($title); ?>:</div>
								<span><?php echo esc_html($element['value']); ?></span>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<div class="supsistic-half-side-box" style="padding-left: 20px;">
				<div class="supsystic-overview-news">
					<h3><?php echo esc_html__('News', ICS_LANG_CODE); ?></h3>
					<div class="supsystic-overview-news-content">
						<?php echo esc_html($this->news); ?>
					</div>
					<a href="<?php echo esc_url($this->mainLink); ?>" class="button button-primary button-hero" style="float: right; margin-top: 10px;">
						<i class="fa fa-info-circle"></i>
						<?php echo esc_html__('All news and info', ICS_LANG_CODE); ?>
					</a>
					<div style="clear: both;"></div>
				</div>
				<div class="overview-contact-form">
					<h3><?php echo esc_html__('Contact form', ICS_LANG_CODE); ?></h3>
					<form id="form-settings">
						<table class="contact-form-table">
							<?php foreach ($this->contactFields as $fName => $fData) { ?>
								<?php
									$htmlType = $fData['html'];
									$id = 'contact_form_'. $fName;
									$htmlParams = array('attrs' => 'id="'. $id. '"');
									if (isset($fData['placeholder'])) {
										$htmlParams['placeholder'] = $fData['placeholder'];
									}
									if (isset($fData['options'])) {
										$htmlParams['options'] = $fData['options'];
									}
									if (isset($fData['def'])) {
										$htmlParams['value'] = $fData['def'];
									}
									if (isset($fData['valid']) && in_array('notEmpty', $fData['valid'])) {
										$htmlParams['required'] = true;
									}
								?>
							<tr>
								<th scope="row">
									<label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($fData['label']); ?></label>
								</th>
								<td>
									<?php echo htmlIcs::$htmlType($fName, $htmlParams); ?>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<th scope="row" colspan="2">
									<?php echo htmlIcs::hidden('mod', array('value' => 'supsystic_promo')); ?>
									<?php echo htmlIcs::hidden('action', array('value' => 'sendContact')); ?>
									<button class="button button-primary button-hero" style="float: right;">
										<i class="fa fa-upload"></i>
										<?php echo esc_html__('Send email', ICS_LANG_CODE); ?>
									</button>
									<div style="clear: both;"></div>
								</th>
							</tr>
						</table>
					</form>
					<div id="form-settings-send-msg" style="display: none;">
						<i class="fa fa-envelope-o"></i>
						<?php echo esc_html__('Your email was sent, we will try to respond to your as soon as possible. Thank you for support!', ICS_LANG_CODE); ?>
					</div>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
</section>
