<?php
$settings = '';

$sliderKeys = array('width', 'width_unit');
foreach ($sliderKeys as $k) {
	if (isset($this->settings['slider'][$k])) {
		$settings .= "data-$k='" . $this->settings['slider'][$k] . "' ";
	}
}
$captionKeys = array('font_family', 'font_size', 'text_color', 'bold', 'italic', 'line', 'text_position');
foreach ($captionKeys as $k) {
	if (isset($this->settings['caption'][$k])) {
		$settings .= "data-$k='" . $this->settings['caption'][$k] . "' ";
	}
}
$paddingKeys = array('top', 'bottom', 'left', 'right');
foreach ($paddingKeys as $k) {
	if (isset($this->settings['caption']['padding'][$k])) {
		$settings .= "data-caption-padding-$k='" . $this->settings['caption']['padding'][$k] . "' ";
	}
}
$handlerKeys = array(
        'b_depth', 'b_color', 'background_color', 'icon_class', 'icon_size', 'icon_color',
        'background_enable', 'circle_icon_padding', 'circle_radius', 'rectangle_icon_padding_height',
        'rectangle_icon_padding_width', 'rectangle_height', 'rectangle_width'
    );
foreach ($handlerKeys as $k) {
	if (isset($this->settings['handler'][$k])) {
		$settings .= "data-handler-$k='" . $this->settings['handler'][$k] . "' ";
	}
}

$pointsKeys = array(
    'color', 'text_background_enables', 'text_background_color'
);
foreach ($pointsKeys as $k) {
    if (isset($this->settings['points'][$k])) {
        $settings .= "data-points-$k='" . $this->settings['points'][$k] . "' ";
    }
}

if (isset($this->settings['caption']['first_img']['text'])) {
	$capFirstText = $this->settings['caption']['first_img']['text'];
	$settings .= "data-cap-first-text='$capFirstText' ";
}
if (isset($this->settings['caption']['second_img']['text'])) {
	$capSecondText = $this->settings['caption']['second_img']['text'];
	$settings .= "data-cap-second-text='$capSecondText' ";
}
if (isset($this->settings['line_position'])) {
	$linePosition = $this->settings['line_position'];
	$settings .= "data-line-position='$linePosition' ";
}
if (isset($this->settings['icon'])) {
	$icon = $this->settings['icon'];
	$settings .= "data-icon='$icon' ";
}
if (isset($this->settings['slider']['images']['first']['src'])) {
	$imgFirstSrc = $this->settings['slider']['images']['first']['src'];
	$settings .= "data-images-first-src='$imgFirstSrc' ";
}
if (isset($this->settings['slider']['images']['second']['src'])) {
	$imgSecondSrc = $this->settings['slider']['images']['second']['src'];
	$settings .= "data-images-second-src='$imgSecondSrc' ";
}
if (isset($this->settings['point'])) {
    $pointers = $this->settings['point'];
} else {
	$pointers = false;
}
if (isset($this->settings['line_position'])
   && $this->settings['line_position'] === 'vertical') {
	$resize = 'resize-v';
} else {
	$resize = 'resize';
}
if (isset($this->settings['separator-position'])) {
	$separatorPosition = $this->settings['separator-position'];
	$settings .= "data-separator-position='$separatorPosition' ";
}
?>
<div id="ics-slider-wrapper-<?php echo esc_attr($this->viewId); ?>"
     class="ics-slider-wrapper comparison-container"
	<?php echo $settings; ?>>
    <div id="ics-slider-<?php echo esc_attr($this->viewId); ?>" class="icsMarkerPlace" style="position: relative;">
        <?php if (isset($this->settings['slider']['images']['first']['src']) && isset($this->settings['slider']['images']['second']['src'])): ?>
            <div class="ba-slider">
                <?php if ($resize === 'resize'): ?>
                    <img class="icsFirstImgF" src="<?php echo esc_url(isset($this->settings['slider']['images']['first']['src']) ? $this->settings['slider']['images']['first']['src'] : uriIcs::_(ICS_IMG_PATH).'no-img.jpg'); ?>">
                    <div class="icsCaption icsCaptionFirst"><?php echo esc_html(isset($this->settings['caption']['first_img']['text']) ? $this->settings['caption']['first_img']['text'] : ''); ?></div>
                    <div class="resize">
                        <img class="icsSecondImgF" src="<?php echo esc_url(isset($this->settings['slider']['images']['second']['src']) ? $this->settings['slider']['images']['second']['src'] : uriIcs::_(ICS_IMG_PATH).'no-img.jpg'); ?>">
                        <div class="icsCaption icsCaptionSecond"><?php echo esc_html(isset($this->settings['caption']['second_img']['text']) ? $this->settings['caption']['second_img']['text'] : ''); ?></div>
                    </div>
                    <div class="item-point" data-top="100" data-left="100"></div>
                <?php elseif($resize === 'resize-v'):?>
                    <img class="icsSecondImgF" src="<?php echo esc_url(isset($this->settings['slider']['images']['second']['src']) ? $this->settings['slider']['images']['second']['src'] : uriIcs::_(ICS_IMG_PATH).'no-img.jpg'); ?>">
                    <div class="icsCaption icsCaptionSecond-v"><?php echo esc_html(isset($this->settings['caption']['second_img']['text']) ? $this->settings['caption']['second_img']['text'] : ''); ?></div>
                    <div class="resize-v">
                        <img class="icsFirstImgF" src="<?php echo esc_url(isset($this->settings['slider']['images']['first']['src']) ? $this->settings['slider']['images']['first']['src'] : uriIcs::_(ICS_IMG_PATH).'no-img.jpg'); ?>">
                        <div class="icsCaption icsCaptionFirst-v"><?php echo esc_html(isset($this->settings['caption']['first_img']['text']) ? $this->settings['caption']['first_img']['text'] : ''); ?></div>
                    </div>
                    <div class="item-point" data-id="1" data-top="100" data-left="100"></div>
                <?php endif; ?>
                <span class="separate">
	                <i class=""></i>
                </span>
            </div>
            <?php if (is_array($pointers) && !empty($pointers)): ?>
                <?php foreach ($pointers as $key=>$pointer):?>
                    <?php if ( isset($pointer['top']) && $pointer['top'] > 0
                              && isset($pointer['left']) && $pointer['left'] > 0
                              && isset($pointer['text']) && strlen($pointer['text']) > 0):
				        ?>
                        <div id="<?php echo esc_attr($key); ?>"
                             class="icsMarker"
                             data-top="<?php echo esc_attr($pointer['top']); ?>"
                             data-left="<?php echo esc_attr($pointer['left']); ?>"
                             data-id="<?php echo esc_attr($key); ?>"
                             data-text="<?php echo esc_attr($pointer['text']); ?>"
                             style="top: <?php echo esc_attr($pointer['top']); ?>%; left: <?php echo esc_attr($pointer['left']); ?>%;">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
	        <div class="icsMarkerText icsHidden"></div>
	        <div class="icsMarker icsMarkerEmpty icsHidden"></div>
        <?php else: ?>
            <?php echo esc_html__("You have not uploaded any photos.", ICS_LANG_CODE); ?>
        <?php endif; ?>
    </div>
	<div class="sliderStyle"></div>
</div>
<script>
    (function ($) {
	    var id = 'ics-slider-wrapper-<?php echo $this->viewId;?>';
	    $( document ).ready(function() {
		    $('#' + id + ' .ba-slider').beforeAfter();
//		    var i = 0;
//		    var interval = setInterval(function () {
//			    if( $('#' + id + ' .ba-slider').is(':visible') && i < 3 ) {
//				    $('#' + id + ' .ba-slider').beforeAfter();
//				    i++;
//			    }
//		    }, 200);
	    });
    }(jQuery));
</script>