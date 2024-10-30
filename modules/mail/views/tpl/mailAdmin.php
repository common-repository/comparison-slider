<form id="icsMailTestForm">
	<label>
		<?php echo esc_html('Send test email to'); ?>
		<?php echo htmlIcs::text('test_email', array('value' => $this->testEmail)); ?>
	</label>
	<?php echo htmlIcs::hidden('mod', array('value' => 'mail')); ?>
	<?php echo htmlIcs::hidden('action', array('value' => 'testEmail')); ?>
	<button class="button button-primary">
		<i class="fa fa-paper-plane"></i>
		<?php echo esc_html__('Send test', ICS_LANG_CODE); ?>
	</button><br />
	<i><?php echo esc_html__('This option allows you to check your server mail functionality', ICS_LANG_CODE); ?></i>
</form>
<div id="icsMailTestResShell" style="display: none;">
	<?php echo esc_html__('Did you receive test email?', ICS_LANG_CODE); ?><br />
	<button class="icsMailTestResBtn button button-primary" data-res="1">
		<i class="fa fa-check-square-o"></i>
		<?php echo esc_html__('Yes! It works!', ICS_LANG_CODE); ?>
	</button>
	<button class="icsMailTestResBtn button button-primary" data-res="0">
		<i class="fa fa-exclamation-triangle"></i>
		<?php echo esc_html__('No, I need to contact my hosting provider with mail function issue.', ICS_LANG_CODE); ?>
	</button>
</div>
<div id="icsMailTestResSuccess" style="display: none;">
	<?php echo esc_html__('Great! Mail function was tested and is working fine.', ICS_LANG_CODE); ?>
</div>
<div id="icsMailTestResFail" style="display: none;">
	<?php echo esc_html__('Bad, please contact your hosting provider and ask them to setup mail functionality on your server.', ICS_LANG_CODE); ?>
</div>
<div style="clear: both;"></div>
<form id="icsMailSettingsForm">
	<table class="form-table" style="max-width: 450px;">
		<?php foreach ($this->options as $optKey => $opt) { ?>
			<?php
				$htmlType = isset($opt['html']) ? $opt['html'] : false;
				if (empty($htmlType)) {
					continue;
				}
			?>
			<tr>
				<th scope="row" class="col-w-30perc">
					<?php echo esc_html($opt['label']); ?>
					<?php if (!empty($opt['changed_on'])) { ?>
						<br />
						<span class="description">
							<?php 
							$opt['value'] 
								? printf(__('Turned On %s', ICS_LANG_CODE), dateIcs::_($opt['changed_on']))
								: printf(__('Turned Off %s', ICS_LANG_CODE), dateIcs::_($opt['changed_on']))
							?>
						</span>
					<?php } ?>
				</th>
				<td class="col-w-10perc">
					<i class="fa fa-question supsystic-tooltip" title="<?php echo esc_attr($opt['desc']); ?>"></i>
				</td>
				<td class="col-w-1perc">
					<?php echo htmlIcs::$htmlType('opt_values['. $optKey. ']', array('value' => $opt['value'], 'attrs' => 'data-optkey="'. $optKey. '"')); ?>
				</td>
				<td class="col-w-50perc">
					<div id="icsFormOptDetails_<?php echo esc_attr($optKey); ?>" class="icsOptDetailsShell"></div>
				</td>
			</tr>
		<?php } ?>
	</table>
	<?php echo htmlIcs::hidden('mod', array('value' => 'mail')); ?>
	<?php echo htmlIcs::hidden('action', array('value' => 'saveOptions')); ?>
	<button class="button button-primary">
		<i class="fa fa-fw fa-save"></i>
		<?php echo esc_html('Save', ICS_LANG_CODE); ?>
	</button>
</form>
