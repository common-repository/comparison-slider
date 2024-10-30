jQuery(document).ready(function(){
	jQuery('#icsMailTestForm').submit(function(){
		jQuery(this).sendFormIcs({
			btn: jQuery(this).find('button:first')
		,	onSuccess: function(res) {
				if(!res.error) {
					jQuery('#icsMailTestForm').slideUp( 300 );
					jQuery('#icsMailTestResShell').slideDown( 300 );
				}
			}
		});
		return false;
	});
	jQuery('.icsMailTestResBtn').click(function(){
		var result = parseInt(jQuery(this).data('res'));
		jQuery.sendFormIcs({
			btn: this
		,	data: {mod: 'mail', action: 'saveMailTestRes', result: result}
		,	onSuccess: function(res) {
				if(!res.error) {
					jQuery('#icsMailTestResShell').slideUp( 300 );
					jQuery('#'+ (result ? 'icsMailTestResSuccess' : 'icsMailTestResFail')).slideDown( 300 );
				}
			}
		});
		return false;
	});
	jQuery('#icsMailSettingsForm').submit(function(){
		jQuery(this).sendFormIcs({
			btn: jQuery(this).find('button:first')
		});
		return false; 
	});
});