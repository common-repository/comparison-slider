jQuery(document).ready(function(){
	var $deactivateLnk = jQuery('#the-list tr[data-slug="'+ icsPluginsData.plugSlug+ '"] .row-actions .deactivate a');
	if($deactivateLnk && $deactivateLnk.size()) {
		var $deactivateForm = jQuery('#icsDeactivateForm');
		var $deactivateWnd = jQuery('#icsDeactivateWnd').dialog({
			modal:    true
		,	autoOpen: false
		,	width: 500
		,	height: 390
		,	buttons:  {
				'Submit & Deactivate': function() {
					$deactivateForm.submit();
				}
			}
		});
		var $wndButtonset = $deactivateWnd.parents('.ui-dialog:first')
			.find('.ui-dialog-buttonpane .ui-dialog-buttonset')
		,	$deactivateDlgBtn = $deactivateWnd.find('.icsDeactivateSkipDataBtn')
		,	deactivateUrl = $deactivateLnk.attr('href');
		$deactivateDlgBtn.attr('href', deactivateUrl);
		$wndButtonset.append( $deactivateDlgBtn );
		$deactivateLnk.click(function(){
			$deactivateWnd.dialog('open');
			return false;
		});
		
		$deactivateForm.submit(function(){
			var $btn = $wndButtonset.find('button:first');
			$btn.width( $btn.width() );	// Ha:)
			$btn.showLoaderIcs();
			jQuery(this).sendFormIcs({
				btn: $btn
			,	onSuccess: function(res) {
					toeRedirect( deactivateUrl );
				}
			});
			return false;
		});
		$deactivateForm.find('[name="deactivate_reason"]').change(function(){
			jQuery('.icsDeactivateDescShell').slideUp( g_icsAnimationSpeed );
			if(jQuery(this).prop('checked')) {
				var $descShell = jQuery(this).parents('.icsDeactivateReasonShell:first').find('.icsDeactivateDescShell');
				if($descShell && $descShell.size()) {
					$descShell.slideDown( g_icsAnimationSpeed );
				}
			}
		});
	}
});