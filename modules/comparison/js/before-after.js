(function($) {
    function drags(dragElement, resizeElement, container) {
        // Initialize the dragging event on mousedown.
        dragElement.on('mousedown.ba-events touchstart.ba-events', function(e) {

            dragElement.addClass('ba-draggable');
            resizeElement.addClass('ba-resizable');

            // Check if it's a mouse or touch event and pass along the correct value
            var startY = (e.pageY) ? e.pageY : e.originalEvent.touches[0].pageY;

            // Get the initial position
            var dragHeight = dragElement.outerHeight(),
                posY = dragElement.offset().top + dragHeight - startY,
                containerOffset = container.offset().top,
                containerHeight = container.outerHeight();

            // Set limits
            minTop = containerOffset + 10;
            maxTop = containerOffset + containerHeight - dragHeight - 10;

            // Calculate the dragging distance on mousemove.
            dragElement.parents().on("mousemove.ba-events touchmove.ba-events", function(e) {

                // Check if it's a mouse or touch event and pass along the correct value
                var moveY = (e.pageY) ? e.pageY : e.originalEvent.touches[0].pageY;

                topValue = moveY + posY - dragHeight;

                // Prevent going off limits
                if ( topValue < minTop) {
                    topValue = minTop;
                } else if (topValue > maxTop) {
                    topValue = maxTop;
                }

                // Translate the handle's left value to masked divs width.
                widthHeight = (topValue + dragHeight/2 - containerOffset)*100/containerHeight+'%';
                widthHeightCap = (topValue + dragHeight/2 - containerOffset)*100/containerHeight+10+'%';

                // Set the new values for the slider and the handle.
                $('.ba-draggable').css('top', widthHeight);
                $('.ba-resizable').css('height', widthHeight);

                var wrapper = container.closest('.ics-slider-wrapper')
                    ,   captTextPos = wrapper.data('text_position');
                if(captTextPos === 'top'){
                    $('.icsCaptionFirst').css('top', widthHeightCap);
                }
                // Bind mouseup events to stop dragging.
            }).on('mouseup.ba-events touchend.ba-events touchcancel.ba-events', function(){
                dragElement.removeClass('ba-draggable');
                resizeElement.removeClass('ba-resizable');
                // Unbind all events for performance
                $(this).off('.ba-events');
            });
            e.preventDefault();
        });
    }
    function dragsV(dragElement, resizeElement, container) {
        // Initialize the dragging event on mousedown.
        dragElement.on('mousedown.ba-events touchstart.ba-events', function(e) {

            dragElement.addClass('ba-draggable');
            resizeElement.addClass('ba-resizable');

            // Check if it's a mouse or touch event and pass along the correct value
            var startX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;

            // Get the initial position
            var dragWidth = dragElement.outerWidth(),
                posX = dragElement.offset().left + dragWidth - startX,
                containerOffset = container.offset().left,
                containerWidth = container.outerWidth();

            // Set limits
            minLeft = containerOffset + 10;
            maxLeft = containerOffset + containerWidth - dragWidth - 10;

            // Calculate the dragging distance on mousemove.
            dragElement.parents().on("mousemove.ba-events touchmove.ba-events", function(e) {

                // Check if it's a mouse or touch event and pass along the correct value
                var moveX = (e.pageX) ? e.pageX : e.originalEvent.touches[0].pageX;

                leftValue = moveX + posX - dragWidth;

                // Prevent going off limits
                if ( leftValue < minLeft) {
                    leftValue = minLeft;
                } else if (leftValue > maxLeft) {
                    leftValue = maxLeft;
                }

                // Translate the handle's left value to masked divs width.
                widthValue = (leftValue + dragWidth/2 - containerOffset)*100/containerWidth+'%';

                // Set the new values for the slider and the handle.
                $('.ba-draggable').css('left', widthValue);
                $('.ba-resizable').css('width', widthValue);
                // Bind mouseup events to stop dragging.
            }).on('mouseup.ba-events touchend.ba-events touchcancel.ba-events', function(){
                dragElement.removeClass('ba-draggable');
                resizeElement.removeClass('ba-resizable');
                // Unbind all events for performance
                $(this).off('.ba-events');
            });
            e.preventDefault();
        });



    }

    // Define plugin
    $.fn.beforeAfter = function() {
        var cur = this
        ,   wrapper = cur.closest('.ics-slider-wrapper')
        ,   style = wrapper.find('.sliderStyle')
        ,   imgFirst = wrapper.find('.icsFirstImgF')
        ,   imgSecond = wrapper.find('.icsSecondImgF')
        ,   captions = cur.find('.icsCaption')
        ,   icon = cur.find('.separate i')
        ,   separateIcon = wrapper.attr('data-icon')
        ,   handlerBackgroundEnable = wrapper.attr('data-handler-background_enable') ? wrapper.attr('data-handler-background_enable') : '0'
        ,   handlerBorderDepth = wrapper.attr('data-handler-b_depth') ? wrapper.attr('data-handler-b_depth') : '3'
        ,   handlerCircleRadiusIconPadding = wrapper.attr('data-handler-circle_icon_padding') ? wrapper.attr('data-handler-circle_icon_padding') : '13'
        ,   handlerCircleRadius = wrapper.attr('data-handler-circle_radius') ? wrapper.attr('data-handler-circle_radius') : '32'
        ,   handlerRectangleIconPaddingHeight = wrapper.attr('data-handler-rectangle_icon_padding_height') ? wrapper.attr('data-handler-rectangle_icon_padding_height') : '15'
        ,   handlerRectangleIconPaddingWidth = wrapper.attr('data-handler-rectangle_icon_padding_width') ? wrapper.attr('data-handler-rectangle_icon_padding_width') : '15'
        ,   handlerRectangleHeight = wrapper.attr('data-handler-rectangle_height') ? wrapper.attr('data-handler-rectangle_height') : '15'
        ,   handlerRectangleWidth = wrapper.attr('data-handler-rectangle_width') ? wrapper.attr('data-handler-rectangle_width') : '15'
        ,   handlerBorderColor = wrapper.attr('data-handler-b_color') ? wrapper.attr('data-handler-b_color') : '#717171'
        ,   handleBackgroundColor = wrapper.attr('data-handler-background_color')
        ,   handlerIconClass = wrapper.attr('data-handler-icon_class') ? wrapper.attr('data-handler-icon_class') : ''
        ,   handlerIconSize = wrapper.attr('data-handler-icon_size') ? wrapper.attr('data-handler-icon_size') : '2x'
        ,   handlerIconColor = wrapper.attr('data-handler-icon_color') ? wrapper.attr('data-handler-icon_color') : '#a3a3a3'
        ,   pointsBackgroundEnabled = wrapper.attr('data-points-text_background_enables') ? wrapper.attr('data-points-text_background_enables') : '0'
        ,   pointsTextColor = wrapper.attr('data-points-color') ? wrapper.attr('data-points-color') : 'white'
        ,   pointsBackgroundColor = wrapper.attr('data-points-text_background_color') ? wrapper.attr('data-points-text_background_color') : '#00ffff'
        ,   pointsBackgroundCss = ''
        ,   handlerPosition = ''
        ,   handlerClass = ''
        ,   borderCss = ''
        ,   borderRadius = ''
        ,   borderPadding = ''
        ,   rectanglePositionCss = ''
        ,   capFirstText = wrapper.attr('data-cap-first-text')
        ,   capSecondText = wrapper.attr('data-cap-second-text')
        ,   captionSecondV = cur.find('.icsCaptionSecond-v')
        ,   captionFirst = cur.find('.icsCaptionFirst')
        ,   separator = cur.find('.separate')
        ,   separatorPosition = wrapper.attr('data-separator-position') ? wrapper.attr('data-separator-position') : 50
        ,   sliderWidth = wrapper.attr('data-width')
        ,   sliderWidthUnit = wrapper.attr('data-width_unit')
        ,   captFontFamily = wrapper.attr('data-font_family')
        ,   captFontFamilyLoad = ''
        ,   captFontSize = wrapper.attr('data-font_size')
        ,   captTextColor = wrapper.attr('data-text_color')
        ,   captTextBold = wrapper.attr('data-bold')
        ,   captTextItalic = wrapper.attr('data-italic')
        ,   captTextLine = wrapper.attr('data-line')
        ,   captTextPos = wrapper.attr('data-text_position')
        ,   separateLinePos = wrapper.attr('data-line-position')
        ,   captPadTop = wrapper.attr('data-caption-padding-top')
        ,   captPadBot = wrapper.attr('data-caption-padding-bottom')
        ,   captPadLeft = wrapper.attr('data-caption-padding-left')
        ,   captPadRight = wrapper.attr('data-caption-padding-right')
        ,   imgFirstSrc = wrapper.attr('data-images-first-src')
        ,   imgSecondSrc = wrapper.attr('data-images-second-src');
	    
	    cur.css({'maxHeight': ''});
     
	    if(handlerBackgroundEnable !== '1'){
            handleBackgroundColor = '';
        }

        //backgroun for points text
        if(pointsBackgroundEnabled === '1'){
            pointsBackgroundCss = '<style>.ics-slider-wrapper .icsMarkerText:after {' +
                'font-family: sans-serif;' +
                'font-style: normal;' +
                'text-decoration: inherit;' +
                'color: #000;' +
                'padding-right: 0.5em;' +
                'position: absolute;' +
                'top: -3px;' +
                'cursor: pointer;' +
                'content: "x";' +
                'font-weight: bold;' +
                'font-size: 11px;' +
                'pointer-events: all;' +
                '}' +
                '.ics-slider-wrapper .icsMarkerText{' +
                'margin-top: -15px;' +
                'padding: 10px;' +
                'border-radius: 7px;' +
                'color:'+ pointsTextColor +'; ' +
                'background-color:'+ pointsBackgroundColor +'; ' +
                'pointer-events: none;' +
                '}' +
                '</style>';
        }else{
            pointsBackgroundCss = '<style>' +
                '.ics-slider-wrapper .icsMarkerText{' +
                'color:'+ pointsTextColor +'; ' +
                '}' +
                '</style>';
        }

	    if(separateLinePos === "horizontal"){
		    handlerPosition = 'left: 50%;';
		    handlerClass = '.handle';
		    wrapper.find('.separate').css('top', separatorPosition + '%');
		    wrapper.find('.resize').css('height', separatorPosition + '%');
	    }else if(separateLinePos === "vertical"){
		    handlerPosition = 'top: 50%;';
		    handlerClass = '.handle-v';
		    wrapper.find('.separate').css('left', separatorPosition + '%');
		    wrapper.find('.resize-v').css('width', separatorPosition + '%');
	    }
	
	   
	    
	    if(separateIcon === 'circle'){
		    borderRadius =  'border-radius: 50%;';
		    borderPadding = 'padding:'+handlerCircleRadiusIconPadding+'px;';
	    }else if(separateIcon === 'rectangle'){
		    borderRadius =  'border-radius: 0;';
            borderPadding = 'padding:'+handlerRectangleIconPaddingHeight+'px '+handlerRectangleIconPaddingWidth+'px;';
	    }
	    
	    if(handlerIconClass === ''){
		    borderCss = 'background: '+handleBackgroundColor+';' +
			    'border:'+handlerBorderDepth+'px solid '+handlerBorderColor+';' +
			    'border-radius: 50%;';
	    }
	    
	    if(captFontFamily !== ''){
		    captFontFamilyLoad = '<link rel="stylesheet"' +
			    'href="https://fonts.googleapis.com/css?family='+captFontFamily+'">'
		    jQuery('head').append(captFontFamilyLoad);
	    }
	    
	    // circle horizontal / vertical
        var cssHandleCircle = '<style>.ba-slider '+handlerClass+':after {' +
	        'position: absolute;' +
	        handlerPosition +
	        'width: '+handlerCircleRadius*2+'px;' +
	        'height: '+handlerCircleRadius*2+'px;' +
	        'margin: -'+handlerCircleRadius+'px 0 0 -'+handlerCircleRadius+'px;' +
	        'content:"";' +
	        'font-weight:bold;' +
	        'font-size:36px;' +
	        'text-align:center;' +
	        'line-height:'+handlerCircleRadius*2+'px;' +
	         borderCss +
	         borderRadius +
	        'transition:all 0.3s ease;' +
	        '}</style>';

        rectanglePositionCss = 'width: '+handlerRectangleWidth+'px; height: '+handlerRectangleHeight+'px; ' +
            'margin: -'+handlerRectangleHeight/2+'px 0 0 -'+handlerRectangleWidth/2+'px; ';

	    // rectangle horizontal / vertical
	    var cssHandleRectangle = '<style>.ba-slider '+handlerClass+':after {' +
		    'position: absolute;' +
		     handlerPosition +
		     rectanglePositionCss +
		    'content:"";' +
		    'font-weight:bold;' +
		    'font-size:36px;' +
		    'text-align:center;' +
		    'line-height:64px;' +
		     borderCss +
		     borderRadius +
		    'transition:all 0.3s ease;' +
		    '}</style>';
	    
	    // icon horizontal / vertical
	    var cssIcon = '<style>.ba-slider '+handlerClass+' i:before{' +
		    'position: absolute;' +
		    handlerPosition +
		    'z-index: 5001;' +
		    'color: '+handlerIconColor+';' +
		    'left: 50%;' +
		    'top: 50%;' +
		    'transform: translate(-50%, -50%);' +
		    'background: '+handleBackgroundColor+';' +
		    'border:'+handlerBorderDepth+'px solid '+handlerBorderColor+';' +
		     borderRadius +
		     borderPadding +
		    ' }</style>';
	   
	   
	    icon.attr('class', 'fa fa-'+handlerIconClass+' fa-'+handlerIconSize+'');

        if(captions.length > 0){
            if(captPadTop != null){
              captions.css('paddingTop', captPadTop + 'px');
            }
            if(captPadBot != null){
              captions.css('paddingBottom' , captPadBot + 'px');
            }
            if(captPadLeft != null){
              captions.css('paddingLeft' , captPadLeft + 'px');
            }
            if(captPadRight != null){
              captions.css('paddingRight' , captPadRight + 'px');
            }
            if(captFontFamily != null){
              captions.css('fontFamily' , captFontFamily);
            }
            if(captFontSize != null){
              captions.css('fontSize' , captFontSize + 'px');
            }
            if(captTextColor != null){
              captions.css('color' , captTextColor);
            }
            if(captTextBold != null && captTextBold === '1'){
              captions.css('fontWeight' , 'bold');
            }else{
	            captions.css('fontWeight' , '');
            }
            if(captTextItalic != null && captTextItalic === '1'){
              captions.css('fontStyle' , 'italic');
            }else{
	            captions.css('fontStyle' , '');
            }
            if(captTextLine != null && captTextLine === '1'){
              captions.css('textDecoration' , 'underline');
            }else{
	            captions.css('textDecoration' , '');
            }
            if(captTextPos != null){
                if(captTextPos === 'bottom'){
                    captions.css({ bottom: '20px', top: 'unset' });
                }else if(captTextPos === 'top'){
                    captions.css({ top: '20px' });
                    captionFirst.css({ top: '60%' });
                }else{
                    captions.css({ top: '20px' });
                }
            }
        }
        if(imgFirstSrc != null){
	        imgFirst.attr('src', imgFirstSrc);
        }
	    if(imgSecondSrc != null){
		    imgSecond.attr('src', imgSecondSrc);
	    }
	    
	    if(capFirstText != null){
		    wrapper.find('.icsCaptionFirst').text(capFirstText);
		    wrapper.find('.icsCaptionFirst-v').text(capFirstText);
	    }
	    if(capSecondText != null){
		    wrapper.find('.icsCaptionSecond').text(capSecondText);
		    wrapper.find('.icsCaptionSecond-v').text(capSecondText);
	    }
	    
        if(sliderWidth != null && sliderWidth > 0){
	        if(sliderWidthUnit === 'percents'){
	        	if(sliderWidth >= 100){
			        sliderWidth = 100;
		        }
		        sliderWidth = sliderWidth + '%';
	        }else{
		        sliderWidth = sliderWidth + 'px'
	        }
            wrapper.css('width' , sliderWidth);
            wrapper.css({
                "marginTop": "0",
                "marginRight": "auto",
                "marginBottom": "0",
                "marginLeft": "auto"
            });
        }
        // Bind dragging events
	    style.html('');
	    style.prepend(cssIcon);
        if(separateIcon!= null){
        	separator.attr('class', 'separate');
            if(separateIcon === "rectangle" && separateLinePos === "horizontal"){
            	separator.addClass('handle');
	            style.append(cssHandleRectangle);
                drags(cur.find('.handle'), cur.find('.resize'), cur);
            }else if(separateIcon === "rectangle" && separateLinePos === "vertical"){
            	separator.addClass('handle-v');
	            style.append(cssHandleRectangle);
                dragsV(cur.find('.handle-v'), cur.find('.resize-v'), cur);
            }else if(separateIcon === "circle" && separateLinePos === "horizontal"){
            	separator.addClass('handle');
	            style.append(cssHandleCircle);
                drags(cur.find('.handle'), cur.find('.resize'), cur);
            }else if(separateIcon === "circle" && separateLinePos === "vertical"){
            	separator.addClass('handle-v');
	            style.append(cssHandleCircle);
                dragsV(cur.find('.handle-v'), cur.find('.resize-v'), cur);
            }else{
                separator.addClass('handle');
	            style.append(cssHandleCircle);
                drags(cur.find('.handle'), cur.find('.resize'), cur);
            }
        }

        //add points background css
        if(pointsBackgroundEnabled === '1'){
            style.prepend(pointsBackgroundCss);
        }

        // Adjust the slider
        if(cur.width() > 0) {
            var width = cur.width()+'px';
            cur.find('.resize img').css('width', width);
            cur.find('.resize-v img').css('width', width);
        }
        // Update sliders on resize.
        // Because we all do this: i.imgur.com/YkbaV.gif
        $(window).resize(function(){
            if(cur.width() > 0) {
                var width = cur.width()+'px';
                cur.find('.resize img').css('width', width);
                cur.find('.resize-v img').css('width', width);
            }
        });
        
	    var imgFirstHeight = imgFirst.height();
	    var imgSecondHeight = imgSecond.height();

	    if(imgFirstHeight === imgSecondHeight){
		    //
	    }else if(imgFirstHeight > imgSecondHeight){
		    cur.css({'maxHeight': imgSecondHeight});
	    }else if(imgFirstHeight < imgSecondHeight){
		    cur.css({'maxHeight': imgFirstHeight});
	    }

    };
    jQuery('body').on('click', '.icsMarker', function(){
        var marker = jQuery(this)
        ,   id = marker.attr('id')
        ,   top = marker.css('top')
        ,   left = marker.css('left')
        ,   text = marker.attr('data-text')
        ,   markerHint = marker.closest('.icsMarkerPlace').find('.icsMarkerText')
        ,   markerHintId = parseInt(markerHint.attr('data-id'));

	    markerHint.css({top: top});
	    markerHint.css({left: left});
        markerHint.text(text);
        markerHint.attr('data-id', id);

        var markerHintIdNew = parseInt(markerHint.attr('data-id'));
        if(markerHint.hasClass('icsHidden')){
            markerHint.removeClass('icsHidden')
        }else{
            if(markerHintId === markerHintIdNew){
                markerHint.addClass('icsHidden')
            }
        }
    });


    jQuery('body').on('click', '.icsMarkerText', function(e){
        e.preventDefault();
        var markerText = jQuery(this);
        markerText.addClass('icsHidden');
    });


    function icsDraggable(){
        jQuery("#additionalPrewiew .icsMarker").draggable({
            containment: 'parent',
            drag: function(){
                var el = jQuery(this)
                    ,   id = el.attr('id')
                    ,   wrapper = el.closest('.icsMarkerPlace')
                    ,   maxHeight = wrapper.height()
                    ,   maxWidth = wrapper.width()
	                ,   markerText = jQuery('.icsMarkerText');

                var currentTop = parseInt(el.css('top'), 10)
                    ,   currentLeft = parseInt(el.css('left'), 10)
                    ,   percentageTop = (currentTop / maxHeight)*100
                    ,   percentageLeft = (currentLeft / maxWidth)*100;
	            
                markerText.addClass('icsHidden');
                jQuery('input[name="settings[point]['+id+'][top]"]').val(percentageTop);
                jQuery('input[name="settings[point]['+id+'][left]"]').val(percentageLeft);
            }
        });
    }

    //for admin area set markers on prewiev after enter name
    jQuery('.icsPointsWrapper').on('keyup', 'input', function () {
        var el = jQuery(this)
            ,   id = el.closest('.icsMarkerWrapp').data('id')
            ,   text = el.val()
	        ,   top = el.closest('.icsMarkerWrapp').attr('data-top') + '%'
	        ,   left = el.closest('.icsMarkerWrapp').attr('data-left') + '%';
        
        if(jQuery(this).val().length > 0){
            if(jQuery("#" + id).length == 0) {
                var copyEmptyElement = jQuery('.icsMarkerEmpty:first')
                    .clone()
                    .removeClass('icsHidden')
                    .removeClass('icsMarkerEmpty');

                copyEmptyElement.css({top: top})
                    .css({left: left})
                    .attr('data-id', id)
                    .attr('id', id)
                    .attr('data-text', text)
                    .appendTo(".icsMarkerPlace").trigger('drags');
	            jQuery('.icsComparisonSaveBtn').click();
                icsDraggable();
            }else{
	            var marker = jQuery("#additionalPrewiew").find("[data-id='" + id + "']");
	            marker.attr('data-text', text);
            }
            if( parseInt(jQuery('.icsMarkerText').attr('data-id')) === parseInt(id)){
                jQuery('.icsMarkerText').text(jQuery(this).val());
            }
        }else if(jQuery(this).val().length === 0){
            jQuery("#" + id).remove();
            jQuery(".icsMarkerText").addClass('icsHidden');
	        jQuery('.icsComparisonSaveBtn').click();
        }
    });

    if(jQuery('.icsPointsWrapper').length){
        icsDraggable();
    }
/*
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
    */
}(jQuery));

