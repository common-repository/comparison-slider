<div class="icsPopupOptRow">
	<label>
		<a target="_blank" href="<?php echo esc_url($this->promoLink); ?>" class="sup-promolink-input">
			<?php echo htmlIcs::checkbox('layered_style_promo', array(
				'checked' => 1,
				//'attrs' => 'disabled="disabled"',
			)); ?>
			<?php echo esc_html__('Enable Layered PopUp Style', ICS_LANG_CODE); ?>
		</a>
		<a target="_blank" class="button" style="margin-top: -8px;" href="<?php echo esc_url($this->promoLink); ?>"><?php echo esc_html__('Available in PRO', ICS_LANG_CODE); ?></a>
	</label>
	<div class="description"><?php echo esc_html__('By default all PopUps have modal style: it appears on user screen over the whole site. Layered style allows you to show your PopUp - on selected position: top, bottom, etc. and not over your site - but right near your content.', ICS_LANG_CODE); ?></div>
</div>
<span>
	<div class="icsPopupOptRow">
		<span class="icsOptLabel"><?php echo esc_html__('Select position for your PopUp', ICS_LANG_CODE); ?></span>
		<br style="clear: both;" />
		<div id="icsLayeredSelectPosShell">
			<div class="icsLayeredPosCell" style="width: 30%;" data-pos="top_left"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Top Left', ICS_LANG_CODE); ?></span></div>
			<div class="icsLayeredPosCell" style="width: 40%;" data-pos="top"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Top', ICS_LANG_CODE); ?></span></div>
			<div class="icsLayeredPosCell" style="width: 30%;" data-pos="top_right"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Top Right', ICS_LANG_CODE); ?></span></div>
			<br style="clear: both;"/>
			<div class="icsLayeredPosCell" style="width: 30%;" data-pos="center_left"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Center Left', ICS_LANG_CODE); ?></span></div>
			<div class="icsLayeredPosCell" style="width: 40%;" data-pos="center"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Center', ICS_LANG_CODE); ?></span></div>
			<div class="icsLayeredPosCell" style="width: 30%;" data-pos="center_right"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Center Right', ICS_LANG_CODE); ?></span></div>
			<br style="clear: both;"/>
			<div class="icsLayeredPosCell" style="width: 30%;" data-pos="bottom_left"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Bottom Left', ICS_LANG_CODE); ?></span></div>
			<div class="icsLayeredPosCell" style="width: 40%;" data-pos="bottom"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Bottom', ICS_LANG_CODE); ?></span></div>
			<div class="icsLayeredPosCell" style="width: 30%;" data-pos="bottom_right"><span class="icsLayeredPosCellContent"><?php echo esc_html__('Bottom Right', ICS_LANG_CODE); ?></span></div>
			<br style="clear: both;"/>
		</div>
		<?php echo htmlIcs::hidden('params[tpl][layered_pos]'); ?>
	</div>
</span>
<style type="text/css">
	#icsLayeredSelectPosShell {
		max-width: 560px;
		height: 380px;
	}
	.icsLayeredPosCell {
		float: left;
		cursor: pointer;
		height: 33.33%;
		text-align: center;
		vertical-align: middle;
		line-height: 110px;
	}
	.icsLayeredPosCellContent {
		border: 1px solid #a5b6b2;
		margin: 5px;
		display: block;
		font-weight: bold;
		box-shadow: -3px -3px 6px #a5b6b2 inset;
		color: #739b92;
	}
	.icsLayeredPosCellContent:hover, .icsLayeredPosCell.active .icsLayeredPosCellContent {
		background-color: #e7f5f6; /*rgba(165, 182, 178, 0.3);*/
		color: #00575d;
	}
</style>
<script type="text/javascript">
	jQuery(document).ready(function(){
		var proExplainContent = jQuery('#icsLayeredProExplainWnd').dialog({
			modal:    true
		,	autoOpen: false
		,	width: 460
		,	height: 180
		});
		jQuery('.icsLayeredPosCell').click(function(){
			proExplainContent.dialog('open');
		});
	});
</script>
<!--PRO explanation Wnd-->
<div id="icsLayeredProExplainWnd" style="display: none;" title="<?php echo esc_html__('Improve Free version', ICS_LANG_CODE); ?>">
	<p>
		<?php printf(__('This functionality and more - is available in PRO version. <a class="button button-primary" target="_blank" href="%s">Get it</a> today for 29$', ICS_LANG_CODE), $this->promoLink); ?>
	</p>
</div>
