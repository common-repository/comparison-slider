<style type="text/css">
	.icsDeactivateDescShell {
		display: none;
		margin-left: 25px;
		margin-top: 5px;
	}
	.icsDeactivateReasonShell {
		display: block;
		margin-bottom: 10px;
	}
	#icsDeactivateWnd input[type="text"],
	#icsDeactivateWnd textarea {
		width: 100%;
	}
	#icsDeactivateWnd h4 {
		line-height: 1.53em;
	}
	#icsDeactivateWnd + .ui-dialog-buttonpane .ui-dialog-buttonset {
		float: none;
	}
	.icsDeactivateSkipDataBtn {
		float: right;
		margin-top: 15px;
		text-decoration: none;
		color: #777 !important;
	}
</style>
<div id="icsDeactivateWnd" style="display: none;" title="<?php echo esc_html__('Your Feedback', ICS_LANG_CODE); ?>">
	<h4><?php printf(__('If you have a moment, please share why you are deactivating %s', ICS_LANG_CODE), ICS_WP_PLUGIN_NAME); ?></h4>
	<form id="icsDeactivateForm">
		<label class="icsDeactivateReasonShell">
			<?php echo htmlIcs::radiobutton('deactivate_reason', array(
				'value' => 'not_working',
			)); ?>
			<?php echo esc_html__('Couldn\'t get the plugin to work', ICS_LANG_CODE); ?>
			<div class="icsDeactivateDescShell">
				<?php printf(__('If you have a question, <a href="%s" target="_blank">contact us</a> and will do our best to help you'), 'https://pareslider.com/contact-us/?utm_source=plugin&utm_medium=deactivated_contact&utm_campaign=popup'); ?>
			</div>
		</label>
		<label class="icsDeactivateReasonShell">
			<?php echo htmlIcs::radiobutton('deactivate_reason', array(
				'value' => 'found_better',
			)); ?>
			<?php echo esc_html__('I found a better plugin', ICS_LANG_CODE); ?>
			<div class="icsDeactivateDescShell">
				<?php echo htmlIcs::text('better_plugin', array(
					'placeholder' => __('If it\'s possible, specify plugin name', ICS_LANG_CODE),
				)); ?>
			</div>
		</label>
		<label class="icsDeactivateReasonShell">
			<?php echo htmlIcs::radiobutton('deactivate_reason', array(
				'value' => 'not_need',
			)); ?>
			<?php echo esc_html__('I no longer need the plugin', ICS_LANG_CODE); ?>
		</label>
		<label class="icsDeactivateReasonShell">
			<?php echo htmlIcs::radiobutton('deactivate_reason', array(
				'value' => 'temporary',
			)); ?>
			<?php echo esc_html__('It\'s a temporary deactivation', ICS_LANG_CODE); ?>
		</label>
		<label class="icsDeactivateReasonShell">
			<?php echo htmlIcs::radiobutton('deactivate_reason', array(
				'value' => 'other',
			)); ?>
			<?php echo esc_html__('Other', ICS_LANG_CODE); ?>
			<div class="icsDeactivateDescShell">
				<?php echo htmlIcs::text('other', array(
					'placeholder' => __('What is the reason?', ICS_LANG_CODE),
				)); ?>
			</div>
		</label>
		<?php echo htmlIcs::hidden('mod', array('value' => 'supsystic_promo')); ?>
		<?php echo htmlIcs::hidden('action', array('value' => 'saveDeactivateData')); ?>
	</form>
	<a href="" class="icsDeactivateSkipDataBtn"><?php echo esc_html__('Skip & Deactivate', ICS_LANG_CODE); ?></a>
</div>
