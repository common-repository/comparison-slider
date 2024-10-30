var g_icsCurrTour = null
,	g_icsTourOpenedWithTab = false
,	g_icsAdminTourDissmissed = false;
jQuery(document).ready(function(){
	setTimeout(function(){
		if(typeof(icsAdminTourData) !== 'undefined' && icsAdminTourData.tour) {
			jQuery('body').append( icsAdminTourData.html );
			icsAdminTourData._$ = jQuery('#supsystic-admin-tour');
			for(var tourId in icsAdminTourData.tour) {
				if(icsAdminTourData.tour[ tourId ].points) {
					for(var pointId in icsAdminTourData.tour[ tourId ].points) {
						_icsOpenPointer(tourId, pointId);
						break;	// Open only first one
					}
				}
			}
			for(var tourId in icsAdminTourData.tour) {
				if(icsAdminTourData.tour[ tourId ].points) {
					for(var pointId in icsAdminTourData.tour[ tourId ].points) {
						if(icsAdminTourData.tour[ tourId ].points[ pointId ].sub_tab) {
							var subTab = icsAdminTourData.tour[ tourId ].points[ pointId ].sub_tab;
							jQuery('a[href="'+ subTab+ '"]')
								.data('tourId', tourId)
								.data('pointId', pointId);
							var tabChangeEvt = str_replace(subTab, '#', '')+ '_tabSwitch';
							jQuery(document).bind(tabChangeEvt, function(event, selector) {
								if(!g_icsTourOpenedWithTab && !g_icsAdminTourDissmissed) {
									var $clickTab = jQuery('a[href="'+ selector+ '"]');
									_icsOpenPointer($clickTab.data('tourId'), $clickTab.data('pointId'));
								}
							});
						}
					}
				}
			}
		}
	}, 500);
});

function _icsOpenPointerAndPopupTab(tourId, pointId, tab) {
	g_icsTourOpenedWithTab = true;
	jQuery('#icsPopupEditTabs').wpTabs('activate', tab);
	_icsOpenPointer(tourId, pointId);
	g_icsTourOpenedWithTab = false;
}
function _icsOpenPointer(tourId, pointId) {
	var pointer = icsAdminTourData.tour[ tourId ].points[ pointId ];
	var $content = icsAdminTourData._$.find('#supsystic-'+ tourId+ '-'+ pointId);
	if(!jQuery(pointer.target) || !jQuery(pointer.target).size())
		return;
	if(g_icsCurrTour) {
		_icsTourSendNext(g_icsCurrTour._tourId, g_icsCurrTour._pointId);
		g_icsCurrTour.element.pointer('close');
		g_icsCurrTour = null;
	}
	if(pointer.sub_tab && jQuery('#icsPopupEditTabs').wpTabs('getActiveTab') != pointer.sub_tab) {
		return;
	}
	var options = jQuery.extend( pointer.options, {
		content: $content.find('.supsystic-tour-content').html()
	,	pointerClass: 'wp-pointer supsystic-pointer'
	,	close: function() {
			//console.log('closed');
		}
	,	buttons: function(event, t) {
			g_icsCurrTour = t;
			g_icsCurrTour._tourId = tourId;
			g_icsCurrTour._pointId = pointId;
			var $btnsShell = $content.find('.supsystic-tour-btns')
			,	$closeBtn = $btnsShell.find('.close')
			,	$finishBtn = $btnsShell.find('.supsystic-tour-finish-btn');

			if($finishBtn && $finishBtn.size()) {
				$finishBtn.click(function(e){
					e.preventDefault();
					jQuery.sendFormIcs({
						msgElID: 'noMessages'
					,	data: {mod: 'supsystic_promo', action: 'addTourFinish', tourId: tourId, pointId: pointId}
					});
					g_icsCurrTour.element.pointer('close');
				});
			}
			if($closeBtn && $closeBtn.size()) {
				$closeBtn.bind( 'click.pointer', function(e) {
					e.preventDefault();
					jQuery.sendFormIcs({
						msgElID: 'noMessages'
					,	data: {mod: 'supsystic_promo', action: 'closeTour', tourId: tourId, pointId: pointId}
					});
					t.element.pointer('close');
					g_icsAdminTourDissmissed = true;
				});
			}
			return $btnsShell;
		}
	});
	jQuery(pointer.target).pointer( options ).pointer('open');
	var minTop = 10
	,	pointerTop = parseInt(g_icsCurrTour.pointer.css('top'));
	if(!isNaN(pointerTop) && pointerTop < minTop) {
		g_icsCurrTour.pointer.css('top', minTop+ 'px');
	}
}
function _icsTourSendNext(tourId, pointId) {
	jQuery.sendFormIcs({
		msgElID: 'noMessages'
	,	data: {mod: 'supsystic_promo', action: 'addTourStep', tourId: tourId, pointId: pointId}
	});
}