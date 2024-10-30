<style type="text/css">
	.icsAdminMainLeftSide {
		width: 56%;
		float: left;
	}
	.icsAdminMainRightSide {
		width: <?php echo (empty($this->optsDisplayOnMainPage) ? 100 : 40)?>%;
		float: left;
		text-align: center;
	}
	#icsMainOccupancy {
		box-shadow: none !important;
	}
</style>
<section>
	<div class="supsystic-item supsystic-panel">
		<div id="containerWrapper">
			<?php echo esc_html__('Main page Go here!!!!', ICS_LANG_CODE); ?>
		</div>
		<div style="clear: both;"></div>
	</div>
</section>