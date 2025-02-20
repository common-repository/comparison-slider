<?php
	$title = ICS_WP_PLUGIN_NAME;
?>
<html>
	<head>
		<title><?php echo esc_html__( $title ); ?></title>
	</head>
	<body>
<div style="position: fixed; margin-left: 40%; margin-right: auto; text-align: center; background-color: #fdf5ce; padding: 10px; margin-top: 10%;">
	<div><?php echo esc_html__( $title ); ?></div>
	<?php echo htmlIcs::formStart('deactivatePlugin', array('action' => $this->REQUEST_URI, 'method' => $this->REQUEST_METHOD)); ?>
	<?php
		$formData = array();
		switch ($this->REQUEST_METHOD) {
			case 'GET':
				$formData = $this->GET;
				break;
			case 'POST':
				$formData = $this->POST;
				break;
		}
		foreach ($formData as $key => $val) {
			if (is_array($val)) {
				foreach ($val as $subKey => $subVal) {
					echo htmlIcs::hidden($key . '[' . $subKey . ']', array('value' => $subVal));
				}
			} else {
				echo htmlIcs::hidden($key, array('value' => $val));
			}
		}
	?>
		<table width="100%">
			<tr>
				<td><?php echo esc_html__('Delete Plugin Data (options, setup data, database tables, etc.)', ICS_LANG_CODE); ?>:</td>
				<td><?php echo htmlIcs::radiobuttons('deleteOptions', array('options' => array('No', 'Yes'))); ?></td>
			</tr>
		</table>
	<?php echo htmlIcs::submit('toeGo', array('value' => __('Done', ICS_LANG_CODE))); ?>
	<?php echo htmlIcs::formEnd(); ?>
	</div>
</body>
</html>
