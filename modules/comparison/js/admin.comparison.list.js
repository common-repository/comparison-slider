jQuery(document).ready(function(){
	// Fallback for case if library was not loaded
	if(!jQuery.fn.jqGrid) {
		return;
	}
	var tblId = 'icsComparisonTbl';
	jQuery('#'+ tblId).jqGrid({
		url: icsTblDataUrl
	,	datatype: 'json'
	,	autowidth: true
	,	shrinkToFit: true
	,	colNames:[toeLangIcs('ID'), toeLangIcs('Title'), toeLangIcs('Shortcode'), toeLangIcs('Rewiew')]
	,	colModel:[
			{name: 'id', index: 'id', searchoptions: {sopt: ['eq']}, width: '50', align: 'center'}
		,	{name: 'title', index: 'title', searchoptions: {sopt: ['eq']}, align: 'center'}
		,	{name: 'shortcode', index: 'shortcode', searchoptions: {sopt: ['eq']}, align: 'center'}
		,	{name: 'action', index: 'rewiew', searchoptions: {sopt: ['eq']}, align: 'center'}
		]
	,	postData: {
			search: {
				text_like: jQuery('#'+ tblId+ 'SearchTxt').val()
			}
		}
	,	rowNum:10
	,	rowList:[10, 20, 30, 1000]
	,	pager: '#'+ tblId+ 'Nav'
	,	sortname: 'id'
	,	viewrecords: true
	,	sortorder: 'desc'
	,	jsonReader: { repeatitems : false, id: '0' }
	,	caption: toeLangIcs('Current PopUp')
	,	height: '100%'
	,	emptyrecords: toeLangIcs('You have no Sliders for now.')
	,	multiselect: true
	,	onSelectRow: function(rowid, e) {
			var tblId = jQuery(this).attr('id')
			,	selectedRowIds = jQuery('#'+ tblId).jqGrid ('getGridParam', 'selarrrow')
			,	totalRows = jQuery('#'+ tblId).getGridParam('reccount')
			,	totalRowsSelected = selectedRowIds.length;
			if(totalRowsSelected) {
				jQuery('#icsComparisonRemoveGroupBtn').removeAttr('disabled');
				if(totalRowsSelected == totalRows) {
					jQuery('#cb_'+ tblId).prop('indeterminate', false);
					jQuery('#cb_'+ tblId).attr('checked', 'checked');
				} else {
					jQuery('#cb_'+ tblId).prop('indeterminate', true);
				}
			} else {
				jQuery('#icsComparisonRemoveGroupBtn').attr('disabled', 'disabled');
				jQuery('#cb_'+ tblId).prop('indeterminate', false);
				jQuery('#cb_'+ tblId).removeAttr('checked');
			}
			icsCheckUpdate(jQuery(this).find('tr:eq('+rowid+')').find('input[type=checkbox].cbox'));
			icsCheckUpdate('#cb_'+ tblId);
		}
	,	gridComplete: function(a, b, c) {
			var tblId = jQuery(this).attr('id');
			jQuery('#icsComparisonRemoveGroupBtn').attr('disabled', 'disabled');
			jQuery('#cb_'+ tblId).prop('indeterminate', false);
			jQuery('#cb_'+ tblId).removeAttr('checked');
			// Custom checkbox manipulation
			icsInitCustomCheckRadio('#'+ jQuery(this).attr('id') );
			icsCheckUpdate('#cb_'+ jQuery(this).attr('id'));
		}
	,	loadComplete: function() {
			var tblId = jQuery(this).attr('id');
			if (this.p.reccount === 0) {
				jQuery(this).hide();
				jQuery('#'+ tblId+ 'EmptyMsg').show();
			} else {
				jQuery(this).show();
				jQuery('#'+ tblId+ 'EmptyMsg').hide();
			}
		}
	});
	jQuery('#'+ tblId+ 'NavShell').append( jQuery('#'+ tblId+ 'Nav') );
	jQuery('#'+ tblId+ 'Nav').find('.ui-pg-selbox').insertAfter( jQuery('#'+ tblId+ 'Nav').find('.ui-paging-info') );
	jQuery('#'+ tblId+ 'Nav').find('.ui-pg-table td:first').remove();
	// Make navigation tabs to be with our additional buttons - in one row
	jQuery('#'+ tblId+ 'Nav_center').prepend( jQuery('#'+ tblId+ 'NavBtnsShell') ).css({
		'width': '80%'
	,	'white-space': 'normal'
	,	'padding-top': '8px'
	});
	jQuery('#'+ tblId+ 'SearchTxt').keyup(function(){
		var searchVal = jQuery.trim( jQuery(this).val() );
		if(searchVal && searchVal != '') {
			icsGridDoListSearch({
				text_like: searchVal
			}, tblId);
		}
	});

	jQuery('#'+ tblId+ 'EmptyMsg').insertAfter(jQuery('#'+ tblId+ '').parent());
	jQuery('#'+ tblId+ '').jqGrid('navGrid', '#'+ tblId+ 'Nav', {edit: false, add: false, del: false});
	jQuery('#cb_'+ tblId+ '').change(function(){
		jQuery(this).attr('checked')
			? jQuery('#icsComparisonRemoveGroupBtn').removeAttr('disabled')
			: jQuery('#icsComparisonRemoveGroupBtn').attr('disabled', 'disabled');
	});
    jQuery('#icsComparisonTbl').off('click' , '.button-prewiew');
	jQuery('#gview_icsComparisonTbl').on('click','.button-prewiew',function(){
		var el = jQuery(this)
			,   id = el.attr('data-id');
		
		var data ={
			mod:'comparison',
			action:'loadPreview',
			id: id,
			pl:'ics',
			reqType:"ajax",
		};
		
		jQuery.ajax({
			url: url,
			data: data,
			type: 'POST',
			success: function(res) {
				if(res.length > 50){
					jQuery('#prewiew').html(res);
					jQuery('html, body').animate({
						scrollTop: jQuery("#prewiew").offset().top
					}, 1000);
				}
			}
		});
	});
	jQuery('#icsComparisonRemoveGroupBtn').click(function(){
		var selectedRowIds = jQuery('#icsComparisonTbl').jqGrid ('getGridParam', 'selarrrow')
		,	listIds = [];
		for(var i in selectedRowIds) {
			var rowData = jQuery('#icsComparisonTbl').jqGrid('getRowData', selectedRowIds[ i ]);
			listIds.push( rowData.id );
		}
		var popupLabel = '';
		if(listIds.length == 1) {	// In table label cell there can be some additional links
			var labelCellData = icsGetGridColDataById(listIds[0], 'label', 'icsComparisonTbl');
			popupLabel = jQuery(labelCellData).text();
		}
		var confirmMsg = listIds.length > 1
			? toeLangIcs('Are you sur want to remove '+ listIds.length+ ' Sliders?')
			: toeLangIcs('Are you sure want to remove "'+ popupLabel+ '" Slider?')
		if(confirm(confirmMsg)) {
			jQuery.sendFormIcs({
				btn: this
			,	data: {mod: 'comparison', action: 'removeGroup', listIds: listIds}
			,	onSuccess: function(res) {
					if(!res.error) {
						jQuery('#icsComparisonTbl').trigger( 'reloadGrid' );
					}
				}
			});
		}
		return false;
	});
	icsInitCustomCheckRadio('#'+ tblId+ '_cb');
	jQuery('#icsComparisonTbl').on('click', '.button-edit', function(e){
		e.preventDefault();
		var button = jQuery(this)
		,	link = button.attr('data-href');
		console.log(link);
		document.location = link;
	});

	jQuery('#icsComparisonTbl').on('click', '.icsEditTitle', function(e){
		e.preventDefault();
		var el = jQuery(this)
		,	wrapper = el.parent()
		,	input = wrapper.find('input');

		el.addClass('icsHidden');
		input.removeClass('icsHidden');
	});

    jQuery('#icsComparisonTbl').on('focusout', '.icsEditLinkInput', function() {
    	var elInput = jQuery(this)
    	,	elVal = elInput.val()
    	,	id = elInput.attr('data-id');

        saveTitleChange(elInput, id, elVal);
    });
    jQuery('#icsComparisonTbl').on('keyup', '.icsEditLinkInput', function(event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            var elInput = jQuery(this)
                ,	elVal = elInput.val()
                ,	id = elInput.attr('data-id');

            saveTitleChange(elInput, id, elVal);
        }
    });

    function saveTitleChange(elInput, id, title){
        var data ={
            mod:'comparison',
            action:'updateSettingFromTpl',
            id: id,
            title: title,
            pl: 'ics',
            reqType: "ajax",
            icsNonce: ICS_DATA2.icsNonce
        };
        jQuery.ajax({
            url: url,
            data: data,
            type: 'POST',
            success: function(res) {
				jQuery('#icsComparisonTbl').trigger( 'reloadGrid' );
               /* var	wrapper = elInput.parent()
				,	link = wrapper.find('a')
				,	linkPencil = '<i class="fa fa-fw fa-pencil"></i>';

                elInput.addClass('icsHidden');
                link.html(title + ' ' + linkPencil);
                link.removeClass('icsHidden');*/
            }
        });
	}


});
