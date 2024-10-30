jQuery(document).ready(function(){

    jQuery('.icsComparisonSaveBtn').click(function(){
        jQuery('#icsComparisonEditForm').submit();
        return false;
    });

    jQuery('#icsComparisonEditForm').submit(function(e){
        jQuery(this).sendFormIcs({
            btn: jQuery('.icsComparisonSaveBtn')
            ,	onSuccess: function(res) {
            	var currentUrl = window.location.href;
		        if(!res.error && res.data.edit_link && currentUrl !== res.data.edit_link) {
			        toeRedirect( res.data.edit_link );
		        }
		        jQuery('.icsComparisonSaveBtn i').attr('class', 'fa fa-check');
            }
        });
        return false;
    });

    jQuery('#icsComparisonTitleLabel input').on('change', function(){
    	var changed_title = jQuery(this).val();
        jQuery('#icsComparisonEditForm input[name="title"]').val(changed_title);
    });

    jQuery('#icsComparisonIcon li').on('click', function(){
        var elVal = jQuery(this).attr("data-key")
        ,   el = jQuery(this)
        ,   els = el.closest('.icsIcon').find('li');
	    
        el.closest('.icsIcon').parent().find('input').val(elVal);
        els.removeClass('active');
        el.addClass('active');
	    jQuery('.ics-slider-wrapper').attr('data-icon',elVal);

	    //change icon options

        var iconClass = jQuery('input[name="settings[handler][icon_class]"]');
        console.log(iconClass);
        var iconClassVal = iconClass.val();

        if(elVal === 'circle'){
        	console.log(iconClassVal);
            if(iconClassVal.length > 0){
                jQuery('.icsCircleRadius').addClass('icsHidden');
                jQuery('.icsCircleWithIcon').removeClass('icsHidden');
            }else{
                jQuery('.icsCircleRadius').addClass('icsHidden');
                jQuery('.icsCircleWithoutIcon').removeClass('icsHidden');
            }
            jQuery('.icsRectangleSize').addClass('icsHidden');
        }else if(elVal === 'rectangle'){
            console.log(iconClassVal);
            if(iconClassVal > 0){
                jQuery('.icsRectangleSize').addClass('icsHidden');
                jQuery('.icsRectangleWithIcon').removeClass('icsHidden');
            }else{
                jQuery('.icsRectangleSize').addClass('icsHidden');
                jQuery('.icsRectangleWithoutIcon').removeClass('icsHidden');
            }
            jQuery('.icsCircleRadius').addClass('icsHidden');
        }

	    saveOptionsAndReloadPreview();
    });

    jQuery('.icsDisabled :input').attr("disabled", true);
    jQuery('.icsDisabled .wp-color-result').off('click').on('click',function (e) {
        e.preventDefault();
    });
    

    //add point
    jQuery('.icsAddPoint').on('click', function (e) {
    	e.preventDefault();
    	if(jQuery('.icsPointsWrapper .icsMarkerWrapp').not('.icsMarkerWrappEmpty').length){
		    var lastMarkerId = jQuery('.icsPointsWrapper .icsMarkerWrapp').last().attr('data-id')
		    ,   newMarkerId = parseInt(lastMarkerId) + 1
		    ,   newMarker = jQuery('.icsMarkerWrappEmpty').clone()
	        ,   newVal = newMarkerId * 2 + 10;
		    
		    newMarker.removeClass('icsMarkerWrappEmpty')
			    .attr('data-id', newMarkerId)
			    .attr('data-top', newVal)
			    .attr('data-left', newVal);
		    
		    newMarker.find('.icsTitleNumber').html(newMarkerId);
		    newMarker.find('input[name="empty"]')
			    .attr('name', 'settings[point]['+newMarkerId+'][text]');
		    newMarker.find('input[name="top"]')
			    .attr('name', 'settings[point]['+newMarkerId+'][top]')
			    .val(newVal);
		    newMarker.find('input[name="left"]').attr('name', 'settings[point]['+newMarkerId+'][left]')
			    .val(newVal);
		    jQuery('.icsPointsWrapper').append(newMarker);
	    }else{
		    var newMarkerId = '1'
		    ,   newMarker = jQuery('.icsMarkerWrappEmpty').clone()
	        ,   newVal = newMarkerId * 2 + 10;
		    
		    newMarker.removeClass('icsMarkerWrappEmpty')
			    .attr('data-id', newMarkerId)
			    .attr('data-top', newVal)
			    .attr('data-left', newVal);
		    newMarker.find('.icsTitleNumber').html(newMarkerId);
		    newMarker.find('input[name="empty"]')
			    .attr('name', 'settings[point]['+newMarkerId+'][text]');
		    newMarker.find('input[name="top"]')
			    .attr('name', 'settings[point]['+newMarkerId+'][top]')
			    .val(newVal);
		    newMarker.find('input[name="left"]')
			    .attr('name', 'settings[point]['+newMarkerId+'][left]')
			    .val(newVal);
		    jQuery('.icsPointsWrapper').append(newMarker);
	    }
    });
    //remove all points
	jQuery('.icsRemoveAllPoints').on('click', function (e) {
		e.preventDefault();
		jQuery('.icsPointsWrapper .icsMarkerWrapp').remove();
		jQuery('#additionalPrewiew .icsMarker').not('.icsMarkerEmpty').remove();
		jQuery('.icsComparisonSaveBtn').click();
	});
	//remove point
	jQuery('body').on('click', '.removePoint', function(e){
		e.preventDefault();
		var wrapperPoint = jQuery(this).closest('.icsMarkerWrapp')
		,   id = wrapperPoint.attr('data-id')
		,   marker = jQuery("#additionalPrewiew").find("[data-id='" + id + "']");
		wrapperPoint.remove();
		marker.remove();
		jQuery('.icsComparisonSaveBtn').click();
	});
	//select img by clicking on prewiev img
	jQuery('#icsComparisonEditForm').on('click', '.add-single-img', function(){
		jQuery(this).closest('.icsImg').find('.icsSelectImgBut').click();
	});
	//popup edit captions
	function icsPopupInit() {
		var $container = jQuery('<div style="display: none;" title="" /></div>').dialog({
			modal:    true
			,	autoOpen: false
			,	width: 400
			,	height: 300
			,	buttons:  {
				OK: function() {
					$container.find('input').each(function(i,elem) {
						var inputName = jQuery(this).attr('name');
						var inputVal = jQuery(this).val();
						jQuery('#icsComparisonEditForm').find('input[name="'+inputName+'"]').val(inputVal);
						//caption text change in preview
						if(inputName === 'settings[caption][first_img][text]'){
							jQuery('.ics-slider-wrapper').attr('data-cap-first-text',inputVal);
						}
						if(inputName === 'settings[caption][second_img][text]'){
							jQuery('.ics-slider-wrapper').attr('data-cap-second-text',inputVal);
						}
					});
					saveOptionsAndReloadPreview();
					$container.empty();
					$container.dialog('close');
				}
				,	Cancel: function() {
					$container.empty();
					$container.dialog('close');
				}
			}
		});
		jQuery('.icsAddCaption').on('click',function () {
			var wrapper = jQuery(this).closest('.icsImg')
			,   input = wrapper.find('.icsCaptionInput').clone()
			,   bigTitle = input.attr('data-big-title')
			,   inputTitle = input.attr('data-title');
			
			$container.empty();
			$container.append(inputTitle + ': ');
			$container.append(input.attr('type','text'));
			
			$container.dialog( "option", "title", bigTitle );
			$container.dialog('open');
			return false;
		});
	}
	icsPopupInit();
	
	
	jQuery('input[name="settings[handler][background_enable]"]').on('change',function(){
		if(!jQuery(this).closest('.icheckbox_minimal').hasClass('checked')){
			jQuery('.icsBackgroundColor').removeClass('icsHidden');
			jQuery('.ics-slider-wrapper').attr('data-handler-background_enable', '1');
		}else{
			jQuery('.icsBackgroundColor').addClass('icsHidden');
			jQuery('.ics-slider-wrapper').attr('data-handler-background_enable', '0');
		}
		jQuery('.ba-slider').beforeAfter();
	});
	
	
	//save changes after change any input and select on page
	jQuery('#icsComparisonEditForm').on('change', 'input', function () {
		jQuery('.icsComparisonSaveBtn').click();
	});
	jQuery('#icsComparisonEditForm').on('change','select', function () {
		jQuery('.icsComparisonSaveBtn').click();
	});
+
	
	//preview change and show live
	//img change
	jQuery('input[name="settings[slider][images][first][src]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-images-first-src',val);
		if (jQuery( ".ba-slider" ).length) {
			jQuery('.ba-slider').beforeAfter();
		}
	});
	jQuery('input[name="settings[slider][images][second][src]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-images-second-src',val);
		if (jQuery( ".ba-slider" ).length) {
			jQuery('.ba-slider').beforeAfter();
		}
	});
	//caption settings
	jQuery('select[name="settings[caption][font_family]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-font_family',val);
		saveOptionsAndReloadPreview();
	});
	jQuery('input[name="settings[caption][bold]"]').on('change',function(){
		if(!jQuery(this).closest('.icheckbox_minimal').hasClass('checked')){
			jQuery('.ics-slider-wrapper').attr('data-bold','1');
		}else{
			jQuery('.ics-slider-wrapper').attr('data-bold','0');
		}
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[caption][italic]"]').on('change',function(){
		if(!jQuery(this).closest('.icheckbox_minimal').hasClass('checked')){
			jQuery('.ics-slider-wrapper').attr('data-italic','1');
		}else{
			jQuery('.ics-slider-wrapper').attr('data-italic','0');
		}
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[caption][line]"]').on('change',function(){
		if(!jQuery(this).closest('.icheckbox_minimal').hasClass('checked')){
			jQuery('.ics-slider-wrapper').attr('data-line','1');
		}else{
			jQuery('.ics-slider-wrapper').attr('data-line','0');
		}
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('select[name="settings[caption][text_position]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-text-position',val);
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[caption][padding][top]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-caption-padding-top',val);
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[caption][padding][bottom]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-caption-padding-bottom',val);
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[caption][padding][left]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-caption-padding-left',val);
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[caption][padding][right]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-caption-padding-right',val);
		jQuery('.ba-slider').beforeAfter();
	});
	jQuery('input[name="settings[handler][b_depth]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-handler-b_depth',val);
		jQuery('.ba-slider').beforeAfter();
	});

    jQuery('input[name="settings[handler][icon_class]"]').on('change',function(){
        var val = this.value;
        var icon = jQuery('input[name="settings[icon]"]');
        var iconType = icon.val();

		if(iconType === 'circle'){
            if(val.length > 0){
                jQuery('.icsCircleRadius').addClass('icsHidden');
                jQuery('.icsCircleWithIcon').removeClass('icsHidden');
            }else{
                jQuery('.icsCircleRadius').addClass('icsHidden');
                jQuery('.icsCircleWithoutIcon').removeClass('icsHidden');
            }
		}else if(iconType === 'rectangle'){
            if(val.length > 0){
                jQuery('.icsRectangleSize').addClass('icsHidden');
                jQuery('.icsRectangleWithIcon').removeClass('icsHidden');
            }else{
                jQuery('.icsRectangleSize').addClass('icsHidden');
                jQuery('.icsRectangleWithoutIcon').removeClass('icsHidden');
            }
		}
    });

    jQuery('input[name="settings[handler][circle_icon_padding]"]').on('change',function(){
        var val = this.value;
        jQuery('.ics-slider-wrapper').attr('data-handler-circle_icon_padding',val);
        jQuery('.ba-slider').beforeAfter();
    });
    jQuery('input[name="settings[handler][circle_radius]"]').on('change',function(){
        var val = this.value;
        jQuery('.ics-slider-wrapper').attr('data-handler-circle_radius',val);
        jQuery('.ba-slider').beforeAfter();
    });

    jQuery('input[name="settings[handler][rectangle_icon_padding_height]"]').on('change',function(){
        var val = this.value;
        jQuery('.ics-slider-wrapper').attr('data-handler-rectangle_icon_padding_height',val);
        jQuery('.ba-slider').beforeAfter();
    });
    jQuery('input[name="settings[handler][rectangle_icon_padding_width]"]').on('change',function(){
        var val = this.value;
        jQuery('.ics-slider-wrapper').attr('data-handler-rectangle_icon_padding_width',val);
        jQuery('.ba-slider').beforeAfter();
    });

    jQuery('input[name="settings[handler][rectangle_height]"]').on('change',function(){
        var val = this.value;
        jQuery('.ics-slider-wrapper').attr('data-handler-rectangle_height',val);
        jQuery('.ba-slider').beforeAfter();
    });
    jQuery('input[name="settings[handler][rectangle_width]"]').on('change',function(){
        var val = this.value;
        jQuery('.ics-slider-wrapper').attr('data-handler-rectangle_width',val);
        jQuery('.ba-slider').beforeAfter();
    });

	jQuery('input[name="settings[caption][font_size]"]').on('change',function(){
		var val = this.value;
		jQuery('.ics-slider-wrapper').attr('data-font_size',val);
		jQuery('.ba-slider').beforeAfter();
	});

    jQuery('input[name="settings[points][text_background_enables]"]').on('click', function(){
        if(jQuery('input[name="settings[points][text_background_enables]"]').is(':checked')){
            jQuery(this).val('1');
            jQuery('.ics-slider-wrapper').attr('data-points-text_background_enables', '1');
            jQuery('.icsPointBackground').removeClass('icsHidden');
            jQuery('.ba-slider').beforeAfter();
        }else{
            jQuery(this).val('0');
            jQuery('.ics-slider-wrapper').attr('data-points-text_background_enables', '0');
            jQuery('.icsPointBackground').addClass('icsHidden');
            jQuery('.ba-slider').beforeAfter();
        }
    });

    jQuery('input[name="settings[point-enable]"]').on('click', function(){
        if(jQuery('input[name="settings[point-enable]"]').is(':checked')){
            jQuery(this).val('1');
            jQuery('.icsPointsWrapper').removeClass('icsHidden');
            jQuery('.icsMarker').removeClass('icsHidden2');
        }else{
            jQuery(this).val('0');
            jQuery('.icsPointsWrapper').addClass('icsHidden');
            jQuery('.icsMarker').addClass('icsHidden2');
        }
    });
	
	jQuery('select[name="settings[line_position]"]').on('change',function(){
		var el = jQuery(this)
		,   id = el.closest('#icsComparisonEditForm').attr('data-slider-id');
		var data ={
			mod:'comparison',
			action:'loadPreview',
			id: id,
			pl:'ics',
			reqType:"ajax",
		};
		setTimeout(function () {
			jQuery.ajax({
				url: url,
				data: data,
				type: 'POST',
				success: function(res) {
					if(res.length > 50){
						jQuery('#additionalPrewiew').html(res);
					}
				}
			});
		}, 1000);
		
	});


	changeColorSave('icsPointBackground', 'wp-color-result-pb', 'data-points-text_background_color');
	changeColorSave('icsPointsColor', 'wp-color-result-p', 'data-points-color');
	changeColorSave('icsCaptionTextColor', 'wp-color-result', 'data-text_color');
	changeColorSave('icsBorderColor', 'wp-color-result-b', 'data-handler-b_color');
	changeColorSave('icsBackgroundColor', 'wp-color-result-bg', 'data-handler-background_color');
	changeColorSave('icsIconColor', 'wp-color-result-i', 'data-handler-icon_color');
	
	//change color in preview and ajax save
	function changeColorSave(wrappClass, id, dataAttr){
		//change Border color in preview and ajax save
		jQuery('.'+wrappClass+' .wp-color-result').attr('id', id);
		
		var observer = new MutationObserver(styleChangedCallback);
		observer.observe(document.getElementById(id), {
			attributes: true,
			attributeFilter: ['style'],
		});
		var oldIndex = document.getElementById(id).style.backgroundColor;
		function styleChangedCallback(mutations) {
			var newIndex = mutations[0].target.style.backgroundColor;
			if (newIndex !== oldIndex) {
				jQuery('.ics-slider-wrapper').attr(dataAttr, newIndex);
				jQuery('.ba-slider').beforeAfter();
			}
		}
		var $div = jQuery("#" + id);
		var observer = new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				if (mutation.attributeName === "class") {
					jQuery('.icsComparisonSaveBtn').click();
				}
			});
		});
		observer.observe($div[0], {
			attributes: true
		});
		
	}
	
	//popup choose icon
	function icsPopupIconInit() {
		var slider = null;
		var $container = jQuery('<div style="display: none;" title="" /></div>').dialog({
			modal:    true
			,	autoOpen: false
			,	width: 750
			,	buttons:  {
				OK: function() {
					var el = jQuery('#cfsFormFieldIconSettings').addClass('icsHidden');
					jQuery('#icsChooseIcon').append(el);
					$container.empty();
					$container.dialog('close');
					jQuery('#icsChooseIcon').find('input').each(function(i,elem) {
						var inputName = jQuery(this).attr('name');
						var inputVal = jQuery(this).val();
						//change in preview
						if(inputName === 'settings[handler][icon_class]'){
							jQuery('.ics-slider-wrapper').attr('data-handler-icon_class',inputVal);
							jQuery('input[name="settings[handler][icon_class]').trigger('change');
						}
						if(inputName === 'settings[handler][icon_color]'){
							jQuery('.ics-slider-wrapper').attr('data-handler-icon_color',inputVal);
						}
						if(inputName === 'settings[handler][icon_top]'){
							jQuery('.ics-slider-wrapper').attr('data-handler-icon_top',inputVal);
						}
						if(inputName === 'settings[handler][icon_left]'){
							jQuery('.ics-slider-wrapper').attr('data-handler-icon_left',inputVal);
						}
					});
					jQuery('#icsChooseIcon').find('select').each(function(i,elem) {
						var inputName = jQuery(this).attr('name');
						var inputVal = jQuery(this).val();
						//change in preview
						if(inputName === 'settings[handler][icon_size]'){
							jQuery('.ics-slider-wrapper').attr('data-handler-icon_size',inputVal);
						}
					});
					jQuery('.ba-slider').beforeAfter();
				}
				,	Cancel: function() {
					var el = jQuery('#cfsFormFieldIconSettings').addClass('icsHidden');
					jQuery('#icsChooseIcon').append(el);
					$container.empty();
					$container.dialog('close');
					jQuery('.ba-slider').beforeAfter();
				}
			}
			,   close: function( event, ui ) {
				var el = jQuery('#cfsFormFieldIconSettings').addClass('icsHidden');
				jQuery('#icsChooseIcon').append(el);
				$container.empty();
				$container.dialog('close');
				saveOptionsAndReloadPreview();
				jQuery('.ba-slider').beforeAfter();
			}
		});
		function rebuildIconsSlider(filter){
			var $fieldIcons = jQuery('#icsFieldIconsShell');
			var selected = jQuery('#cfsFieldIconSelected').attr('data-value');
			if( slider ) {
				slider.destroySlider();
				slider = null;
				$fieldIcons.html('');
			}
			var icons = cfsGetFaIconsList()
				,	i = 0
				,	$slide = null
				,	slideWidth = 30
				,	fullFieldIconsWidth = $fieldIcons.width();
			if( !fullFieldIconsWidth ) {
				fullFieldIconsWidth = 750;
			}
			var slidesCnt = Math.floor( fullFieldIconsWidth / slideWidth );
			
			for(var iconId in icons) {
				if( filter ) {
					var found = false;
					for(var k in icons[ iconId ]) {
						if(icons[ iconId ][ k ].indexOf( filter ) != -1) {
							found = true;
							break;
						}
					}
					if( !found ) {
						continue;
					}
				}
				if(i >= 4) {
					i = 0;
				}
				if(!i) {
					$slide = jQuery('<li></li>');
				}
				if(selected === iconId){
					$slide.append('<a class="cfsFieldIconBtn active" href="'+ iconId+ '" onclick="_cfsSelectFieldIconClb(this); return false;"><i class="fa fa-'+ iconId+ ' fa-2x"></i></a>');
				}else{
					$slide.append('<a class="cfsFieldIconBtn" href="'+ iconId+ '" onclick="_cfsSelectFieldIconClb(this); return false;"><i class="fa fa-'+ iconId+ ' fa-2x"></i></a>');
				}
				$fieldIcons.append( $slide );
				i++;
			}
			slider = $fieldIcons.bxSlider({
				slideWidth: slideWidth
				,	minSlides: slidesCnt
				,	maxSlides: slidesCnt
				,	slideMargin: 6
			});
			$fieldIcons.closest('.bx-viewport').css('height', '125');
			$fieldIcons.parents('.bx-wrapper').css({
				'float': 'left'
			});
		}
		jQuery('.icsChooseIcon').on('click',function (e) {
			e.preventDefault();
			var bigTitle = 'Choose icons'
			,   wrapper = jQuery('#cfsFormFieldIconSettings');
			$container.empty();
			$container.append(wrapper);
			$container.find('#cfsFormFieldIconSettings').removeClass('icsHidden');
			$container.dialog( "option", "title", bigTitle );
			$container.dialog('open');
			rebuildIconsSlider();
		});
		jQuery('#cfsFieldIconSearchInp').keyup(function(e){
			// DO not overload client with this search procedure
			var searcTimeOut = setTimeout(jQuery.proxy(function(){
				var search = jQuery.trim(jQuery(this).val());
				rebuildIconsSlider(search);
			}, this), 600);
		});
	}
	icsPopupIconInit();
});
function icsSetImgPrev( url, attach, id ) {
	if(url.length){
		jQuery('#'+id).closest('.icsImg').find('.add-single-img').attr('src', url);
	}
}
function cfsGetFaIconsList() {
	return {"glass":["martini","drink","bar","alcohol","liquor","glass"],"music":["note","sound","music"],"search":["magnify","zoom","enlarge","bigger","search"],"envelope-o":["email","support","e-mail","letter","mail","notification","envelope outlined"],"heart":["love","like","favorite","heart"],"star":["award","achievement","night","rating","score","favorite","star"],"star-o":["award","achievement","night","rating","score","favorite","star outlined"],"user":["person","man","head","profile","user"],"film":["movie","film"],"th-large":["blocks","squares","boxes","grid","th-large"],"th":["blocks","squares","boxes","grid","th"],"th-list":["ul","ol","checklist","finished","completed","done","todo","th-list"],"check":["checkmark","done","todo","agree","accept","confirm","tick","ok","check"],"times":["close","exit","x","cross","times"],"search-plus":["magnify","zoom","enlarge","bigger","search plus"],"search-minus":["magnify","minify","zoom","smaller","search minus"],"power-off":["on","power off"],"signal":["graph","bars","signal"],"cog":["settings","cog"],"trash-o":["garbage","delete","remove","trash","hide","trash outlined"],"home":["main","house","home"],"file-o":["new","page","pdf","document","file outlined"],"clock-o":["watch","timer","late","timestamp","clock outlined"],"road":["street","road"],"download":["import","download"],"arrow-circle-o-down":["download","arrow circle outlined down"],"arrow-circle-o-up":["arrow circle outlined up"],"inbox":["inbox"],"play-circle-o":["play circle outlined"],"repeat":["redo","forward","repeat"],"refresh":["reload","sync","refresh"],"list-alt":["ul","ol","checklist","finished","completed","done","todo","list-alt"],"lock":["protect","admin","security","lock"],"flag":["report","notification","notify","flag"],"headphones":["sound","listen","music","audio","headphones"],"volume-off":["audio","mute","sound","music","volume-off"],"volume-down":["audio","lower","quieter","sound","music","volume-down"],"volume-up":["audio","higher","louder","sound","music","volume-up"],"qrcode":["scan","qrcode"],"barcode":["scan","barcode"],"tag":["label","tag"],"tags":["labels","tags"],"book":["read","documentation","book"],"bookmark":["save","bookmark"],"print":["print"],"camera":["photo","picture","record","camera"],"font":["text","font"],"bold":["bold"],"italic":["italics","italic"],"text-height":["text-height"],"text-width":["text-width"],"align-left":["text","align-left"],"align-center":["middle","text","align-center"],"align-right":["text","align-right"],"align-justify":["text","align-justify"],"list":["ul","ol","checklist","finished","completed","done","todo","list"],"outdent":["outdent"],"indent":["indent"],"video-camera":["film","movie","record","video camera"],"picture-o":["picture outlined"],"pencil":["write","edit","update","pencil"],"map-marker":["map","pin","location","coordinates","localize","address","travel","where","place","map-marker"],"adjust":["contrast","adjust"],"tint":["raindrop","waterdrop","drop","droplet","tint"],"pencil-square-o":["write","edit","update","pencil square outlined"],"share-square-o":["social","send","arrow","share square outlined"],"check-square-o":["todo","done","agree","accept","confirm","ok","check square outlined"],"arrows":["move","reorder","resize","arrows"],"step-backward":["rewind","previous","beginning","start","first","step-backward"],"fast-backward":["rewind","previous","beginning","start","first","fast-backward"],"backward":["rewind","previous","backward"],"play":["start","playing","music","sound","play"],"pause":["wait","pause"],"stop":["block","box","square","stop"],"forward":["forward","next","forward"],"fast-forward":["next","end","last","fast-forward"],"step-forward":["next","end","last","step-forward"],"eject":["eject"],"chevron-left":["bracket","previous","back","chevron-left"],"chevron-right":["bracket","next","forward","chevron-right"],"plus-circle":["add","new","create","expand","plus circle"],"minus-circle":["delete","remove","trash","hide","minus circle"],"times-circle":["close","exit","x","times circle"],"check-circle":["todo","done","agree","accept","confirm","ok","check circle"],"question-circle":["help","information","unknown","support","question circle"],"info-circle":["help","information","more","details","info circle"],"crosshairs":["picker","crosshairs"],"times-circle-o":["close","exit","x","times circle outlined"],"check-circle-o":["todo","done","agree","accept","confirm","ok","check circle outlined"],"ban":["delete","remove","trash","hide","block","stop","abort","cancel","ban"],"arrow-left":["previous","back","arrow-left"],"arrow-right":["next","forward","arrow-right"],"arrow-up":["arrow-up"],"arrow-down":["download","arrow-down"],"share":["share"],"expand":["enlarge","bigger","resize","expand"],"compress":["collapse","combine","contract","merge","smaller","compress"],"plus":["add","new","create","expand","plus"],"minus":["hide","minify","delete","remove","trash","hide","collapse","minus"],"asterisk":["details","asterisk"],"exclamation-circle":["warning","error","problem","notification","alert","exclamation circle"],"gift":["present","gift"],"leaf":["eco","nature","plant","leaf"],"fire":["flame","hot","popular","fire"],"eye":["show","visible","views","eye"],"eye-slash":["toggle","show","hide","visible","visiblity","views","eye slash"],"exclamation-triangle":["warning","error","problem","notification","alert","exclamation triangle"],"plane":["travel","trip","location","destination","airplane","fly","mode","plane"],"calendar":["date","time","when","event","calendar"],"random":["sort","shuffle","random"],"comment":["speech","notification","note","chat","bubble","feedback","message","texting","sms","conversation","comment"],"magnet":["magnet"],"chevron-up":["chevron-up"],"chevron-down":["chevron-down"],"retweet":["refresh","reload","share","retweet"],"shopping-cart":["checkout","buy","purchase","payment","shopping-cart"],"folder":["folder"],"folder-open":["folder open"],"arrows-v":["resize","arrows vertical"],"arrows-h":["resize","arrows horizontal"],"bar-chart":["graph","analytics","bar chart"],"twitter-square":["tweet","social network","twitter square"],"facebook-square":["social network","facebook square"],"camera-retro":["photo","picture","record","camera-retro"],"key":["unlock","password","key"],"cogs":["settings","cogs"],"comments":["speech","notification","note","chat","bubble","feedback","message","texting","sms","conversation","comments"],"thumbs-o-up":["like","approve","favorite","agree","hand","thumbs up outlined"],"thumbs-o-down":["dislike","disapprove","disagree","hand","thumbs down outlined"],"star-half":["award","achievement","rating","score","star-half"],"heart-o":["love","like","favorite","heart outlined"],"sign-out":["log out","logout","leave","exit","arrow","sign out"],"linkedin-square":["linkedin square"],"thumb-tack":["marker","pin","location","coordinates","thumb tack"],"external-link":["open","new","external link"],"sign-in":["enter","join","log in","login","sign up","sign in","signin","signup","arrow","sign in"],"trophy":["award","achievement","cup","winner","game","trophy"],"github-square":["octocat","github square"],"upload":["import","upload"],"lemon-o":["food","lemon outlined"],"phone":["call","voice","number","support","earphone","telephone","phone"],"square-o":["block","square","box","square outlined"],"bookmark-o":["save","bookmark outlined"],"phone-square":["call","voice","number","support","telephone","phone square"],"twitter":["tweet","social network","twitter"],"facebook":["social network","facebook"],"github":["octocat","github"],"unlock":["protect","admin","password","lock","unlock"],"credit-card":["money","buy","debit","checkout","purchase","payment","credit-card"],"rss":["blog","rss"],"hdd-o":["harddrive","hard drive","storage","save","hdd"],"bullhorn":["announcement","share","broadcast","louder","megaphone","bullhorn"],"bell":["alert","reminder","notification","bell"],"certificate":["badge","star","certificate"],"hand-o-right":["point","right","next","forward","finger","hand outlined right"],"hand-o-left":["point","left","previous","back","finger","hand outlined left"],"hand-o-up":["point","finger","hand outlined up"],"hand-o-down":["point","finger","hand outlined down"],"arrow-circle-left":["previous","back","arrow circle left"],"arrow-circle-right":["next","forward","arrow circle right"],"arrow-circle-up":["arrow circle up"],"arrow-circle-down":["download","arrow circle down"],"globe":["world","planet","map","place","travel","earth","global","translate","all","language","localize","location","coordinates","country","globe"],"wrench":["settings","fix","update","spanner","wrench"],"tasks":["progress","loading","downloading","downloads","settings","tasks"],"filter":["funnel","options","filter"],"briefcase":["work","business","office","luggage","bag","briefcase"],"arrows-alt":["expand","enlarge","fullscreen","bigger","move","reorder","resize","arrow","arrows alt"],"users":["people","profiles","persons","users"],"link":["chain","link"],"cloud":["save","cloud"],"flask":["science","beaker","experimental","labs","flask"],"scissors":["scissors"],"files-o":["duplicate","clone","copy","files outlined"],"paperclip":["attachment","paperclip"],"floppy-o":["floppy outlined"],"square":["block","box","square"],"bars":["menu","drag","reorder","settings","list","ul","ol","checklist","todo","list","hamburger","bars"],"list-ul":["ul","ol","checklist","todo","list","list-ul"],"list-ol":["ul","ol","checklist","list","todo","list","numbers","list-ol"],"strikethrough":["strikethrough"],"underline":["underline"],"table":["data","excel","spreadsheet","table"],"magic":["wizard","automatic","autocomplete","magic"],"truck":["shipping","truck"],"pinterest":["pinterest"],"pinterest-square":["pinterest square"],"google-plus-square":["social network","google plus square"],"google-plus":["social network","google plus"],"money":["cash","money","buy","checkout","purchase","payment","money"],"caret-down":["more","dropdown","menu","triangle down","arrow","caret down"],"caret-up":["triangle up","arrow","caret up"],"caret-left":["previous","back","triangle left","arrow","caret left"],"caret-right":["next","forward","triangle right","arrow","caret right"],"columns":["split","panes","columns"],"sort":["order","sort"],"sort-desc":["dropdown","more","menu","arrow","sort descending"],"sort-asc":["arrow","sort ascending"],"envelope":["email","e-mail","letter","support","mail","notification","envelope"],"linkedin":["linkedin"],"undo":["back","undo"],"gavel":["judge","lawyer","opinion","gavel"],"tachometer":["speedometer","fast","tachometer"],"comment-o":["speech","notification","note","chat","bubble","feedback","message","texting","sms","conversation","comment-o"],"comments-o":["speech","notification","note","chat","bubble","feedback","message","texting","sms","conversation","comments-o"],"bolt":["lightning","weather","lightning bolt"],"sitemap":["directory","hierarchy","organization","sitemap"],"umbrella":["umbrella"],"clipboard":["copy","clipboard"],"lightbulb-o":["idea","inspiration","lightbulb outlined"],"exchange":["transfer","arrows","arrow","exchange"],"cloud-download":["import","cloud download"],"cloud-upload":["import","cloud upload"],"user-md":["doctor","profile","medical","nurse","user-md"],"stethoscope":["stethoscope"],"suitcase":["trip","luggage","travel","move","baggage","suitcase"],"bell-o":["alert","reminder","notification","bell outlined"],"coffee":["morning","mug","breakfast","tea","drink","cafe","coffee"],"cutlery":["food","restaurant","spoon","knife","dinner","eat","cutlery"],"file-text-o":["new","page","pdf","document","file text outlined"],"building-o":["work","business","apartment","office","company","building outlined"],"hospital-o":["building","hospital outlined"],"ambulance":["vehicle","support","help","ambulance"],"medkit":["first aid","firstaid","help","support","health","medkit"],"fighter-jet":["fly","plane","airplane","quick","fast","travel","fighter-jet"],"beer":["alcohol","stein","drink","mug","bar","liquor","beer"],"h-square":["hospital","hotel","h square"],"plus-square":["add","new","create","expand","plus square"],"angle-double-left":["laquo","quote","previous","back","arrows","angle double left"],"angle-double-right":["raquo","quote","next","forward","arrows","angle double right"],"angle-double-up":["arrows","angle double up"],"angle-double-down":["arrows","angle double down"],"angle-left":["previous","back","arrow","angle-left"],"angle-right":["next","forward","arrow","angle-right"],"angle-up":["arrow","angle-up"],"angle-down":["arrow","angle-down"],"desktop":["monitor","screen","desktop","computer","demo","device","desktop"],"laptop":["demo","computer","device","laptop"],"tablet":["ipad","device","tablet"],"mobile":["cell phone","cellphone","text","call","iphone","number","telephone","mobile phone"],"circle-o":["circle outlined"],"quote-left":["quote-left"],"quote-right":["quote-right"],"spinner":["loading","progress","spinner"],"circle":["dot","notification","circle"],"reply":["reply"],"github-alt":["octocat","github alt"],"folder-o":["folder outlined"],"folder-open-o":["folder open outlined"],"smile-o":["face","emoticon","happy","approve","satisfied","rating","smile outlined"],"frown-o":["face","emoticon","sad","disapprove","rating","frown outlined"],"meh-o":["face","emoticon","rating","neutral","meh outlined"],"gamepad":["controller","gamepad"],"keyboard-o":["type","input","keyboard outlined"],"flag-o":["report","notification","flag outlined"],"flag-checkered":["report","notification","notify","flag-checkered"],"terminal":["command","prompt","code","terminal"],"code":["html","brackets","code"],"reply-all":["reply-all"],"star-half-o":["award","achievement","rating","score","star half outlined"],"location-arrow":["map","coordinates","location","address","place","where","location-arrow"],"crop":["crop"],"code-fork":["git","fork","vcs","svn","github","rebase","version","merge","code-fork"],"chain-broken":["remove","chain broken"],"question":["help","information","unknown","support","question"],"info":["help","information","more","details","info"],"exclamation":["warning","error","problem","notification","notify","alert","exclamation"],"superscript":["exponential","superscript"],"subscript":["subscript"],"eraser":["remove","delete","eraser"],"puzzle-piece":["addon","add-on","section","puzzle piece"],"microphone":["record","voice","sound","microphone"],"microphone-slash":["record","voice","sound","mute","microphone slash"],"shield":["award","achievement","security","winner","shield"],"calendar-o":["date","time","when","event","calendar-o"],"fire-extinguisher":["fire-extinguisher"],"rocket":["app","rocket"],"maxcdn":["maxcdn"],"chevron-circle-left":["previous","back","arrow","chevron circle left"],"chevron-circle-right":["next","forward","arrow","chevron circle right"],"chevron-circle-up":["arrow","chevron circle up"],"chevron-circle-down":["more","dropdown","menu","arrow","chevron circle down"],"html5":["html 5 logo"],"css3":["code","css 3 logo"],"anchor":["link","anchor"],"unlock-alt":["protect","admin","password","lock","unlock alt"],"bullseye":["target","bullseye"],"ellipsis-h":["dots","ellipsis horizontal"],"ellipsis-v":["dots","ellipsis vertical"],"rss-square":["feed","blog","rss square"],"play-circle":["start","playing","play circle"],"ticket":["movie","pass","support","ticket"],"minus-square":["hide","minify","delete","remove","trash","hide","collapse","minus square"],"minus-square-o":["hide","minify","delete","remove","trash","hide","collapse","minus square outlined"],"level-up":["arrow","level up"],"level-down":["arrow","level down"],"check-square":["checkmark","done","todo","agree","accept","confirm","ok","check square"],"pencil-square":["write","edit","update","pencil square"],"external-link-square":["open","new","external link square"],"share-square":["social","send","share square"],"compass":["safari","directory","menu","location","compass"],"caret-square-o-down":["more","dropdown","menu","caret square outlined down"],"caret-square-o-up":["caret square outlined up"],"caret-square-o-right":["next","forward","caret square outlined right"],"eur":["euro (eur)"],"gbp":["gbp"],"usd":["us dollar"],"inr":["indian rupee (inr)"],"jpy":["japanese yen (jpy)"],"rub":["russian ruble (rub)"],"krw":["korean won (krw)"],"btc":["bitcoin (btc)"],"file":["new","page","pdf","document","file"],"file-text":["new","page","pdf","document","file text"],"sort-alpha-asc":["sort alpha ascending"],"sort-alpha-desc":["sort alpha descending"],"sort-amount-asc":["sort amount ascending"],"sort-amount-desc":["sort amount descending"],"sort-numeric-asc":["numbers","sort numeric ascending"],"sort-numeric-desc":["numbers","sort numeric descending"],"thumbs-up":["like","favorite","approve","agree","hand","thumbs-up"],"thumbs-down":["dislike","disapprove","disagree","hand","thumbs-down"],"youtube-square":["video","film","youtube square"],"youtube":["video","film","youtube"],"xing":["xing"],"xing-square":["xing square"],"youtube-play":["start","playing","youtube play"],"dropbox":["dropbox"],"stack-overflow":["stack overflow"],"instagram":["instagram"],"flickr":["flickr"],"adn":["app.net"],"bitbucket":["git","bitbucket"],"bitbucket-square":["git","bitbucket square"],"tumblr":["tumblr"],"tumblr-square":["tumblr square"],"long-arrow-down":["long arrow down"],"long-arrow-up":["long arrow up"],"long-arrow-left":["previous","back","long arrow left"],"long-arrow-right":["long arrow right"],"apple":["osx","food","apple"],"windows":["microsoft","windows"],"android":["robot","android"],"linux":["tux","linux"],"dribbble":["dribbble"],"skype":["skype"],"foursquare":["foursquare"],"trello":["trello"],"female":["woman","user","person","profile","female"],"male":["man","user","person","profile","male"],"gratipay":["heart","like","favorite","love","gratipay (gittip)"],"sun-o":["weather","contrast","lighter","brighten","day","sun outlined"],"moon-o":["night","darker","contrast","moon outlined"],"archive":["box","storage","archive"],"bug":["report","insect","bug"],"vk":["vk"],"weibo":["weibo"],"renren":["renren"],"pagelines":["leaf","leaves","tree","plant","eco","nature","pagelines"],"stack-exchange":["stack exchange"],"arrow-circle-o-right":["next","forward","arrow circle outlined right"],"arrow-circle-o-left":["previous","back","arrow circle outlined left"],"caret-square-o-left":["previous","back","caret square outlined left"],"dot-circle-o":["target","bullseye","notification","dot circle outlined"],"wheelchair":["handicap","person","wheelchair"],"vimeo-square":["vimeo square"],"try":["turkish lira (try)"],"plus-square-o":["add","new","create","expand","plus square outlined"],"space-shuttle":["space shuttle"],"slack":["hashtag","anchor","hash","slack logo"],"envelope-square":["envelope square"],"wordpress":["wordpress logo"],"openid":["openid"],"university":["university"],"graduation-cap":["learning","school","student","graduation cap"],"yahoo":["yahoo logo"],"google":["google logo"],"reddit":["reddit logo"],"reddit-square":["reddit square"],"stumbleupon-circle":["stumbleupon circle"],"stumbleupon":["stumbleupon logo"],"delicious":["delicious logo"],"digg":["digg logo"],"pied-piper-pp":["pied piper pp logo (old)"],"pied-piper-alt":["pied piper alternate logo"],"drupal":["drupal logo"],"joomla":["joomla logo"],"language":["language"],"fax":["fax"],"building":["work","business","apartment","office","company","building"],"child":["child"],"paw":["pet","paw"],"spoon":["spoon"],"cube":["cube"],"cubes":["cubes"],"behance":["behance"],"behance-square":["behance square"],"steam":["steam"],"steam-square":["steam square"],"recycle":["recycle"],"car":["vehicle","car"],"taxi":["vehicle","taxi"],"tree":["tree"],"spotify":["spotify"],"deviantart":["deviantart"],"soundcloud":["soundcloud"],"database":["database"],"file-pdf-o":["pdf file outlined"],"file-word-o":["word file outlined"],"file-excel-o":["excel file outlined"],"file-powerpoint-o":["powerpoint file outlined"],"file-image-o":["image file outlined"],"file-archive-o":["archive file outlined"],"file-audio-o":["audio file outlined"],"file-video-o":["video file outlined"],"file-code-o":["code file outlined"],"vine":["vine"],"codepen":["codepen"],"jsfiddle":["jsfiddle"],"life-ring":["life ring"],"circle-o-notch":["circle outlined notched"],"rebel":["rebel alliance"],"empire":["galactic empire"],"git-square":["git square"],"git":["git"],"hacker-news":["hacker news"],"tencent-weibo":["tencent weibo"],"qq":["qq"],"weixin":["weixin (wechat)"],"paper-plane":["paper plane"],"paper-plane-o":["paper plane outlined"],"history":["history"],"circle-thin":["circle outlined thin"],"header":["heading","header"],"paragraph":["paragraph"],"sliders":["settings","sliders"],"share-alt":["share alt"],"share-alt-square":["share alt square"],"bomb":["bomb"],"futbol-o":["futbol outlined"],"tty":["tty"],"binoculars":["binoculars"],"plug":["power","connect","plug"],"slideshare":["slideshare"],"twitch":["twitch"],"yelp":["yelp"],"newspaper-o":["press","newspaper outlined"],"wifi":["wifi"],"calculator":["calculator"],"paypal":["paypal"],"google-wallet":["google wallet"],"cc-visa":["visa credit card"],"cc-mastercard":["mastercard credit card"],"cc-discover":["discover credit card"],"cc-amex":["amex","american express credit card"],"cc-paypal":["paypal credit card"],"cc-stripe":["stripe credit card"],"bell-slash":["bell slash"],"bell-slash-o":["bell slash outlined"],"trash":["garbage","delete","remove","hide","trash"],"copyright":["copyright"],"at":["at"],"eyedropper":["eyedropper"],"paint-brush":["paint brush"],"birthday-cake":["birthday cake"],"area-chart":["graph","analytics","area chart"],"pie-chart":["graph","analytics","pie chart"],"line-chart":["graph","analytics","line chart"],"lastfm":["last.fm"],"lastfm-square":["last.fm square"],"toggle-off":["toggle off"],"toggle-on":["toggle on"],"bicycle":["vehicle","bike","bicycle"],"bus":["vehicle","bus"],"ioxhost":["ioxhost"],"angellist":["angellist"],"cc":["closed captions"],"ils":["shekel (ils)"],"meanpath":["meanpath"],"buysellads":["buysellads"],"connectdevelop":["connect develop"],"dashcube":["dashcube"],"forumbee":["forumbee"],"leanpub":["leanpub"],"sellsy":["sellsy"],"shirtsinbulk":["shirts in bulk"],"simplybuilt":["simplybuilt"],"skyatlas":["skyatlas"],"cart-plus":["add","shopping","add to shopping cart"],"cart-arrow-down":["shopping","shopping cart arrow down"],"diamond":["gem","gemstone","diamond"],"ship":["boat","sea","ship"],"user-secret":["whisper","spy","incognito","privacy","user secret"],"motorcycle":["vehicle","bike","motorcycle"],"street-view":["map","street view"],"heartbeat":["ekg","heartbeat"],"venus":["female","venus"],"mars":["male","mars"],"mercury":["transgender","mercury"],"transgender":["transgender"],"transgender-alt":["transgender alt"],"venus-double":["venus double"],"mars-double":["mars double"],"venus-mars":["venus mars"],"mars-stroke":["mars stroke"],"mars-stroke-v":["mars stroke vertical"],"mars-stroke-h":["mars stroke horizontal"],"neuter":["neuter"],"genderless":["genderless"],"facebook-official":["facebook official"],"pinterest-p":["pinterest p"],"whatsapp":["what's app"],"server":["server"],"user-plus":["sign up","signup","add user"],"user-times":["remove user"],"bed":["travel","bed"],"viacoin":["viacoin"],"train":["train"],"subway":["subway"],"medium":["medium"],"y-combinator":["y combinator"],"optin-monster":["optin monster"],"opencart":["opencart"],"expeditedssl":["expeditedssl"],"battery-full":["power","battery full"],"battery-three-quarters":["power","battery 3/4 full"],"battery-half":["power","battery 1/2 full"],"battery-quarter":["power","battery 1/4 full"],"battery-empty":["power","battery empty"],"mouse-pointer":["mouse pointer"],"i-cursor":["i beam cursor"],"object-group":["object group"],"object-ungroup":["object ungroup"],"sticky-note":["sticky note"],"sticky-note-o":["sticky note outlined"],"cc-jcb":["jcb credit card"],"cc-diners-club":["diner's club credit card"],"clone":["copy","clone"],"balance-scale":["balance scale"],"hourglass-o":["hourglass outlined"],"hourglass-start":["hourglass start"],"hourglass-half":["hourglass half"],"hourglass-end":["hourglass end"],"hourglass":["hourglass"],"hand-rock-o":["rock (hand)"],"hand-paper-o":["stop","paper (hand)"],"hand-scissors-o":["scissors (hand)"],"hand-lizard-o":["lizard (hand)"],"hand-spock-o":["spock (hand)"],"hand-pointer-o":["hand pointer"],"hand-peace-o":["hand peace"],"trademark":["trademark"],"registered":["registered trademark"],"creative-commons":["creative commons"],"gg":["gg currency"],"gg-circle":["gg currency circle"],"tripadvisor":["tripadvisor"],"odnoklassniki":["odnoklassniki"],"odnoklassniki-square":["odnoklassniki square"],"get-pocket":["get pocket"],"wikipedia-w":["wikipedia w"],"safari":["browser","safari"],"chrome":["browser","chrome"],"firefox":["browser","firefox"],"opera":["opera"],"internet-explorer":["browser","ie","internet-explorer"],"television":["display","computer","monitor","television"],"contao":["contao"],"500px":["500px"],"amazon":["amazon"],"calendar-plus-o":["calendar plus outlined"],"calendar-minus-o":["calendar minus outlined"],"calendar-times-o":["calendar times outlined"],"calendar-check-o":["ok","calendar check outlined"],"industry":["factory","industry"],"map-pin":["map pin"],"map-signs":["map signs"],"map-o":["map outlined"],"map":["map"],"commenting":["speech","notification","note","chat","bubble","feedback","message","texting","sms","conversation","commenting"],"commenting-o":["speech","notification","note","chat","bubble","feedback","message","texting","sms","conversation","commenting outlined"],"houzz":["houzz"],"vimeo":["vimeo"],"black-tie":["font awesome black tie"],"fonticons":["fonticons"],"reddit-alien":["reddit alien"],"edge":["browser","ie","edge browser"],"credit-card-alt":["money","buy","debit","checkout","purchase","payment","credit card","credit card"],"codiepie":["codie pie"],"modx":["modx"],"fort-awesome":["fort awesome"],"usb":["usb"],"product-hunt":["product hunt"],"mixcloud":["mixcloud"],"scribd":["scribd"],"pause-circle":["pause circle"],"pause-circle-o":["pause circle outlined"],"stop-circle":["stop circle"],"stop-circle-o":["stop circle outlined"],"shopping-bag":["shopping bag"],"shopping-basket":["shopping basket"],"hashtag":["hashtag"],"bluetooth":["bluetooth"],"bluetooth-b":["bluetooth"],"percent":["percent"],"gitlab":["gitlab"],"wpbeginner":["wpbeginner"],"wpforms":["wpforms"],"envira":["leaf","envira gallery"],"universal-access":["universal access"],"wheelchair-alt":["handicap","person","wheelchair alt"],"question-circle-o":["question circle outlined"],"blind":["blind"],"audio-description":["audio description"],"volume-control-phone":["telephone","volume control phone"],"braille":["braille"],"assistive-listening-systems":["assistive listening systems"],"american-sign-language-interpreting":["american sign language interpreting"],"deaf":["deaf"],"glide":["glide"],"glide-g":["glide g"],"sign-language":["sign language"],"low-vision":["low vision"],"viadeo":["viadeo"],"viadeo-square":["viadeo square"],"snapchat":["snapchat"],"snapchat-ghost":["snapchat ghost"],"snapchat-square":["snapchat square"],"pied-piper":["pied piper logo"],"first-order":["first order"],"yoast":["yoast"],"themeisle":["themeisle"],"google-plus-official":["google plus official"],"font-awesome":["font awesome"],"handshake-o":["handshake outlined"],"envelope-open":["envelope open"],"envelope-open-o":["envelope open outlined"],"linode":["linode"],"address-book":["address book"],"address-book-o":["address book outlined"],"address-card":["address card"],"address-card-o":["address card outlined"],"user-circle":["user circle"],"user-circle-o":["user circle outlined"],"user-o":["user outlined"],"id-badge":["identification badge"],"id-card":["identification card"],"id-card-o":["identification card outlined"],"quora":["quora"],"free-code-camp":["free code camp"],"telegram":["telegram"],"thermometer-full":["thermometer full"],"thermometer-three-quarters":["thermometer 3/4 full"],"thermometer-half":["thermometer 1/2 full"],"thermometer-quarter":["thermometer 1/4 full"],"thermometer-empty":["thermometer empty"],"shower":["shower"],"bath":["bath"],"podcast":["podcast"],"window-maximize":["window maximize"],"window-minimize":["window minimize"],"window-restore":["window restore"],"window-close":["window close"],"window-close-o":["window close outline"],"bandcamp":["bandcamp"],"grav":["grav"],"etsy":["etsy"],"imdb":["imdb"],"ravelry":["ravelry"],"eercast":["eercast"],"microchip":["microchip"],"snowflake-o":["snowflake outlined"],"superpowers":["superpowers"],"wpexplorer":["wpexplorer"],"meetup":["meetup"]};
}
function _cfsSelectFieldIconClb( btn ) {
	var $btn = jQuery( btn )
		,	isActive = $btn.hasClass('active');
	jQuery('#icsFieldIconsShell a').removeClass('active');
	if( isActive ) {	// Deselect
		jQuery('#cfsFieldIconSelected').html('');
		jQuery('#cfsFieldIconClassInp').val('');
	} else {
		var iconClass = $btn.attr('href');
		$btn.addClass('active');
		jQuery('#cfsFieldIconSelected').html( iconClass );
		jQuery('#cfsFieldIconClassInp').val( iconClass );
	}
}

function saveOptionsAndReloadPreview(){
	jQuery('.ba-slider').beforeAfter();
	jQuery('.icsComparisonSaveBtn').click();
}