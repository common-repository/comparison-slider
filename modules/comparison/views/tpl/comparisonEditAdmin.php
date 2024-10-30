<?php

$isPro = true;
if ( ! $isPro ) {
	$icsDisabled = 'icsDisabled';
} else {
	$icsDisabled = '';
}
if ( isset( $this->settings['point-enable'] ) && (int) $this->settings['point-enable'] === 1 ) {
	$icsMarkerHidden = '';
} else {
	$icsMarkerHidden = 'icsHidden';
}
if ( isset( $this->settings['points']['text_background_enables'] ) && (int) $this->settings['points']['text_background_enables'] === 1 ) {
	$icsPointBackground = '';
} else {
	$icsPointBackground = 'icsHidden';
}
$id = isset( $this->slider['id'] ) ? $this->slider['id'] : '';

if ( isset( $this->settings['handler']['background_enable'] )
	 && (int) $this->settings['handler']['background_enable'] === 1 ) {
	$icsBackgroundColor = '';
} else {
	$icsBackgroundColor = 'icsHidden';
}

?>
<div id="icsComparisonEditTabs">
	<section>
		<div class="supsystic-item supsystic-panel" style="padding-left: 10px;">
			<div id="containerWrapper">
				<form id="icsComparisonEditForm" data-slider-id="<?php echo esc_attr($id); ?>">
					<div id="settings">
						<div class="col-md-7">
							<div class="col-md-6">
								<div class=" icsFirstImg icsImg">
									<?php
									$imgSrc = ( isset( $this->settings['slider']['images']['first']['src'] )
												&& ! empty( $this->settings['slider']['images']['first']['src'] )
										? $this->settings['slider']['images']['first']['src']
										: uriIcs::_( ICS_IMG_PATH ) . 'no-img.jpg' );
									?>
									<?php
									echo htmlIcs::imgGalleryBtn( 'settings[slider][images][first][src]',
																 array(
																	 'onChange' => 'icsSetImgPrev',
																	 'attrs'    => 'class="button icsSelectImgBut button-sup-small" style="text-align: center;"',
																	 'value'    => ( isset( $this->settings['slider']['images']['first']['src'] ) ? $this->settings['slider']['images']['first']['src'] : '' ),
																 ) );
									?>
									<img class="add-single-img" src="<?php echo esc_url($imgSrc); ?>"/>
									<button class="icsAddCaption button"><?php echo esc_html__( 'Edit caption', ICS_LANG_CODE ); ?></button>
									<?php
									echo htmlIcs::hidden( 'settings[caption][first_img][text]',
														  array(
															  'value' => ( isset( $this->settings['caption']['first_img']['text'] ) ? $this->settings['caption']['first_img']['text'] : '' ),
															  'attrs' => 'data-big-title="Caption" data-title="Edit caption" class="icsCaptionInput"',
														  ) );
									?>
								</div>
							</div>
							<div class="col-md-6 icsLeftImgBorder">
								<div class=" icsSecondImg icsImg">
									<?php
									$imgSrc = ( isset( $this->settings['slider']['images']['second']['src'] )
												&& ! empty( $this->settings['slider']['images']['second']['src'] )
										? $this->settings['slider']['images']['second']['src']
										: uriIcs::_( ICS_IMG_PATH ) . 'no-img.jpg' );
									?>
									<?php
									echo htmlIcs::imgGalleryBtn( 'settings[slider][images][second][src]',
																 array(
																	 'onChange' => 'icsSetImgPrev',
																	 'attrs'    => 'class="button icsSelectImgBut button-sup-small" style="text-align: center;"',
																	 'value'    => ( isset( $this->settings['slider']['images']['second']['src'] ) ? $this->settings['slider']['images']['second']['src'] : '' ),
																 ) );
									?>
									<img class="add-single-img" src="<?php echo esc_url($imgSrc); ?>"/>
									<button class="icsAddCaption button"><?php echo esc_html__( 'Edit caption', ICS_LANG_CODE ); ?></button>
									<?php
									echo htmlIcs::hidden( 'settings[caption][second_img][text]',
														  array(
															  'value' => ( isset( $this->settings['caption']['second_img']['text'] ) ? $this->settings['caption']['second_img']['text'] : '' ),
															  'attrs' => 'data-big-title="Caption" data-title="Edit caption" class="icsCaptionInput"',
														  ) );
									?>
								</div>
							</div>
							<div class="icsShortcodeWrapp col-md-12">
								<div class="icsShortcode">
									<table>
										<tbody>
										<tr>
											<?php
											$id = isset( $this->slider['id'] ) ? $this->slider['id'] : '';
											if ( $id ) {
												echo '<td>' . esc_html__( 'Shortcode', ICS_LANG_CODE ) . ': ' . '</td>';
												echo '<td style="width: 100%">' . htmlIcs::text( 'shortcode',
																								 array(
																									 'value'    => '[' . ICS_SHORTCODE . " id=$id]",
																									 'attrs'    => 'readonly style="width: 100%" onclick="this.setSelectionRange(0, this.value.length);" class=""',
																									 'required' => true,
																								 ) ) . '</td>';
											}
											?>
										</tr>
										</tbody>
									</table>
								</div>
								<div class="icsShortcode">
									<table>
										<tbody>
										<tr>
											<?php
											$id = isset( $this->slider['id'] ) ? $this->slider['id'] : '';
											if ( $id ) {
												echo '<td>' . esc_html__( 'PHPCode', ICS_LANG_CODE ) . ': ' . '</td>';
												echo '<td style="width: 100%">' . htmlIcs::text( 'shortcode',
																								 array(
																									 'value'    => "<?php echo do_shortcode('[" . ICS_SHORTCODE . " id=$id]') ?>",
																									 'attrs'    => 'readonly style="width: 100%" onclick="this.setSelectionRange(0, this.value.length);" class=""',
																									 'required' => true,
																								 ) ) . '</td>';
											}
											?>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-12 icsPreviewTitle">
								<?php echo esc_html__( 'Preview', ICS_LANG_CODE ); ?>
							</div>
							<div class="col-md-12" id="additionalPrewiew">
								<?php
								if ( isset( $this->slider['id'] ) ) {
									echo do_shortcode( '[' . ICS_SHORTCODE . ' id=' . $this->slider['id'] . ']' );
								}
								?>
							</div>
						</div>
						<div class="col-md-5">
							<div class="col-md-12 icsSettingsCol">
								<h3>Slider Settings</h3>
								<table class="form-table">
									<tbody>
									<tr>
										<th style="width: auto"><?php echo esc_html__( 'Width', ICS_LANG_CODE ); ?></th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enter slider width size in pixels or percent.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[slider][width]',
																array(
																	'value' => ( isset( $this->settings['slider']['width'] ) ? $this->settings['slider']['width'] : 100 ),
																	'attrs' => 'style="width: 41px"',
																) )
											?>
											<?php
											echo htmlIcs::selectbox( 'settings[slider][width_unit]',
																	 array(
																		 'options' => array( 'pixels' => 'px', 'percents' => '%' ),
																		 'value'   => ( isset( $this->settings['slider']['width_unit'] ) ? $this->settings['slider']['width_unit'] : 'percents' ),
																		 'attrs'   => 'class="chosen" style="width: 44px"',
																	 ) )
											?>
										</td>
									</tr>
									<tr class="icsPro">
										<th style="width: auto">
											<span class="icsAdminTitle"><?php echo esc_html__( 'Line Position', ICS_LANG_CODE ); ?>:</span>
											<span class="icsAdminTitlePro"><?php echo esc_html__( 'PRO option', ICS_LANG_CODE ); ?></span>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Choose separate line position.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::selectbox( 'settings[line_position]',
																	 array(
																		 'options' => array( 'vertical' => 'vertical', 'horizontal' => 'horizontal' ),
																		 'value'   => ( isset( $this->settings['line_position'] ) ? $this->settings['line_position'] : 'vertical' ),
																		 'attrs'   => 'class="chosen"',
																	 ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Icon', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Choose icon format',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<ul id="icsComparisonIcon" class="icsIcon" style="display: inline;">
												<li class="
												<?php
												if ( isset( $this->settings['icon'] )
													 && ( $this->settings['icon'] === 'rectangle' || empty( $this->settings['icon'] ) ) ) {
													echo 'active';
												}
												?>
												"
													data-key="rectangle">
													<img src="<?php echo esc_url(ICS_MODULES_PATH . '/comparison/img/rectangle.png'); ?>"/>
												</li>
												<li class="
												<?php
												if ( isset( $this->settings['icon'] ) && $this->settings['icon'] === 'circle' ) {
													echo 'active';
												}
												?>
												"
													data-key="circle">
													<img src="<?php echo esc_url(ICS_MODULES_PATH . '/comparison/img/circle.png'); ?>"/>
												</li>
											</ul>
											<?php
											echo htmlIcs::hidden( 'settings[icon]',
																  array(
																	  'value' => ( isset( $this->settings['icon'] ) ? $this->settings['icon'] : 'rectangle' ),
																  ) );
											?>
										</td>
									</tr>
									<?php
									if ( isset( $this->settings['icon'] ) && $this->settings['icon'] === 'circle' ) {
										$rectangleHeightWithIconClass = 'icsRectangleSize icsRectangleWithIcon icsHidden';
										$rectangleWidthWithIconClass  = 'icsRectangleSize icsRectangleWithIcon icsHidden';

										$rectangleHeightWithoutIconClass = 'icsRectangleSize icsRectangleWithoutIcon icsHidden';
										$rectangleWidthWithoutIconClass  = 'icsRectangleSize icsRectangleWithoutIcon icsHidden';

										if ( isset( $this->settings['handler']['icon_class'] ) ? $this->settings['handler']['icon_class'] : '' ) {
											$circleWithIconClass    = 'icsCircleRadius icsCircleWithIcon';
											$circleWithoutIconClass = 'icsCircleRadius icsCircleWithoutIcon icsHidden';
										} else {
											$circleWithIconClass    = 'icsCircleRadius icsCircleWithIcon icsHidden';
											$circleWithoutIconClass = 'icsCircleRadius icsCircleWithoutIcon';
										}
									}
									?>
									<?php
									if ( isset( $this->settings['icon'] ) && $this->settings['icon'] === 'rectangle' ) {
										$circleWithIconClass    = 'icsCircleRadius icsCircleWithIcon icsHidden';
										$circleWithoutIconClass = 'icsCircleRadius icsCircleWithoutIcon icsHidden';

										if ( isset( $this->settings['handler']['icon_class'] ) ? $this->settings['handler']['icon_class'] : '' ) {
											$rectangleHeightWithIconClass = 'icsRectangleSize icsRectangleWithIcon';
											$rectangleWidthWithIconClass  = 'icsRectangleSize icsRectangleWithIcon';

											$rectangleHeightWithoutIconClass = 'icsRectangleSize icsRectangleWithoutIcon icsHidden';
											$rectangleWidthWithoutIconClass  = 'icsRectangleSize icsRectangleWithoutIcon icsHidden';
										} else {
											$rectangleHeightWithIconClass = 'icsRectangleSize icsRectangleWithIcon icsHidden';
											$rectangleWidthWithIconClass  = 'icsRectangleSize icsRectangleWithIcon icsHidden';

											$rectangleHeightWithoutIconClass = 'icsRectangleSize icsRectangleWithoutIcon';
											$rectangleWidthWithoutIconClass  = 'icsRectangleSize icsRectangleWithoutIcon';
										}
									}
									?>
									<tr class="
									<?php
									if ( isset( $circleWithIconClass ) ) {
										echo $circleWithIconClass;
									}
									?>
									">
										<th style="width: auto">
											<?php echo esc_html__( 'Circle radius', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enter padding from icon inside circle.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][circle_icon_padding]',
																array(
																	'value' => ( isset( $this->settings['handler']['circle_icon_padding'] ) ? $this->settings['handler']['circle_icon_padding'] : '13' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'pt', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr class="
									<?php
									if ( isset( $circleWithoutIconClass ) ) {
										echo $circleWithoutIconClass;
									}
									?>
									">
										<th style="width: auto">
											<?php echo esc_html__( 'Circle radius', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Enter circle radius.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][circle_radius]',
																array(
																	'value' => ( isset( $this->settings['handler']['circle_radius'] ) ? $this->settings['handler']['circle_radius'] : '32' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>


									<tr class="
									<?php 
									if ( isset( $rectangleHeightWithIconClass ) ) {
										echo $rectangleHeightWithIconClass;
									} 
									?>
									">
										<th style="width: auto">
											<?php echo esc_html__( 'Rectangle height', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enter top and bottom padding from icon inside rectangle.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][rectangle_icon_padding_height]',
																array(
																	'value' => ( isset( $this->settings['handler']['height'] ) ? $this->settings['handler']['rectangle_icon_padding_height'] : '15' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr class="
									<?php 
									if ( isset( $rectangleWidthWithIconClass ) ) {
										echo $rectangleWidthWithIconClass;
									} 
									?>
									">
										<th style="width: auto">
											<?php echo esc_html__( 'Rectangle width', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enter left and right padding from icon inside rectangle.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][rectangle_icon_padding_width]',
																array(
																	'value' => ( isset( $this->settings['handler']['rectangle_icon_padding_width'] ) ? $this->settings['handler']['rectangle_icon_padding_width'] : '15' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>

									<tr class="
									<?php 
									if ( isset( $rectangleHeightWithoutIconClass ) ) {
										echo $rectangleHeightWithoutIconClass;
									} 
									?>
									">
										<th style="width: auto">
											<?php echo esc_html__( 'Rectangle height', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Enter rectangle height.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][rectangle_height]',
																array(
																	'value' => ( isset( $this->settings['handler']['rectangle_height'] ) ? $this->settings['handler']['rectangle_height'] : '15' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr class="
									<?php 
									if ( isset( $rectangleWidthWithoutIconClass ) ) {
										echo $rectangleWidthWithoutIconClass;
									} 
									?>
									">
										<th style="width: auto">
											<?php echo esc_html__( 'Rectangle width', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Enter rectangle width.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][rectangle_width]',
																array(
																	'value' => ( isset( $this->settings['handler']['rectangle_width'] ) ? $this->settings['handler']['rectangle_width'] : '15' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>


									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Border depth', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Enter border width.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[handler][b_depth]',
																array(
																	'value' => ( isset( $this->settings['handler']['b_depth'] ) ? $this->settings['handler']['b_depth'] : '3' ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr class="icsBorderColor">
										<th style="width: auto">
											<?php echo esc_html__( 'Border color', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Choose border color.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::colorpicker( 'settings[handler][b_color]',
																	   array(
																		   'value' => ( isset( $this->settings['handler']['b_color'] ) ? $this->settings['handler']['b_color'] : '#fcfcfc' ),
																		   'attrs' => 'style="width: 50px"',
																	   ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Add Background color', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enable background for handler.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::checkbox( 'settings[handler][background_enable]',
																	array(
																		'checked' => ( isset( $this->settings['handler']['background_enable'] ) ? (int) $this->settings['handler']['background_enable'] : 0 ),
																	) )
											?>
										</td>
									</tr>
									<tr class="icsBackgroundColor <?php echo esc_attr($icsBackgroundColor); ?>">
										<th style="width: auto">
											<?php echo esc_html__( 'Background color', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Choose background color for handler.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::colorpicker( 'settings[handler][background_color]',
																	   array(
																		   'value' => ( isset( $this->settings['handler']['background_color'] ) ? $this->settings['handler']['background_color'] : '#ffb800' ),
																		   'attrs' => 'style="width: 50px"',
																	   ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Choose icon', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Select icon to display in handler.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<button class="button icsChooseIcon"><?php echo esc_html__( 'Choose icon', ICS_LANG_CODE ); ?></button>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Separator position', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Choose separator line position',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<script>
												function changePreview(event, ui) {
													jQuery('#toeSliderDisplay_settingsseparator-position').html(ui.value);
													jQuery('#toeSliderInput_settingsseparator-position').val(ui.value);
													jQuery('.ics-slider-wrapper').attr('data-separator-position', ui.value);
													jQuery('.ics-slider-wrapper .ba-slider').beforeAfter();

												}
											</script>
											<?php
											echo htmlIcs::slider( 'settings[separator-position]]',
																  array(
																	  'value' => ( isset( $this->settings['separator-position'] ) ? $this->settings['separator-position'] : 50 ),
																	  'min'   => 10,
																	  'max'   => 90,
																	  'slide' => 'changePreview',
																  ) )
											?>
										</td>
									</tr>
									</tbody>
								</table>
								<div id="icsChooseIcon">
									<div id="cfsFormFieldIconSettings" class="cfsTabContent icsHidden">
										<table class="form-table">
											<tr class="cfsFieldParamRow">
												<td colspan="2">
													<?php
													echo htmlIcs::text( 'settings[icon_search]',
																		array(
																			'attrs' => 'placeholder="' . esc_html__( 'Search',
																											 ICS_LANG_CODE ) . '" id="cfsFieldIconSearchInp" class="cfsFieldIconSearchInpClass" ',
																		) )
													?>
													<?php $val = isset( $this->settings['handler']['icon_class'] ) ? $this->settings['handler']['icon_class'] : ''; ?>
													<span id="cfsFieldIconSelected" data-value="<?php echo esc_attr($val); ?>"><?php echo esc_html($val); ?></span>
													<?php
													echo htmlIcs::hidden( 'settings[handler][icon_class]',
																		  array(
																			  'attrs' => 'id="cfsFieldIconClassInp"',
																			  'value' => ( isset( $this->settings['handler']['icon_class'] ) ? $this->settings['handler']['icon_class'] : '' ),
																		  ) )
													?>
													<br/>
													<ul class="icsFieldIconsShellClass" id="icsFieldIconsShell"></ul>
												</td>
											</tr>
											<tr class="cfsFieldParamRow">
												<th>
													<?php echo esc_html__( 'Icon Size', ICS_LANG_CODE ); ?>
												</th>
												<td>
													<?php
													echo htmlIcs::selectbox( 'settings[handler][icon_size]',
																			 array(
																				 'options' => array(
																					 ''   => __( 'Default', ICS_LANG_CODE ),
																					 'lg' => __( '33% increase', ICS_LANG_CODE ),
																					 '2x' => __( '2x', ICS_LANG_CODE ),
																					 '3x' => __( '3x', ICS_LANG_CODE ),
																					 '4x' => __( '4x', ICS_LANG_CODE ),
																					 '5x' => __( '5x', ICS_LANG_CODE ),
																				 ),
																				 'attrs'   => 'class="cfsProOpt"',
																				 'value'   => ( isset( $this->settings['handler']['icon_size'] ) ? $this->settings['handler']['icon_size'] : '' ),
																			 ) )
													?>
												</td>
											</tr>
											<tr class="cfsFieldParamRow icsIconColor">
												<th>
													<?php echo esc_html__( 'Icon Color', ICS_LANG_CODE ); ?>
												</th>
												<td>
													<?php
													echo htmlIcs::colorpicker( 'settings[handler][icon_color]',
																			   array(
																				   'attrs' => 'class="cfsProOpt"',
																				   'value' => ( isset( $this->settings['handler']['icon_color'] ) ? $this->settings['handler']['icon_color'] : '' ),
																			   ) )
													?>
												</td>
											</tr>
										</table>
									</div>
								</div>
							</div>
							<div class="col-md-12 icsSettingsCol">
								<h3>Add Point</h3>
								<table class="form-table">
									<tbody>
									<tr class="icsPointsColor">
										<th>
											<?php echo esc_html__( 'Point text color', ICS_LANG_CODE ); ?>
										</th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Choose points text color',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										</td>
										<td>
											<?php
											echo htmlIcs::colorpicker( 'settings[points][color]',
																	   array(
																		   'attrs' => 'class="cfsProOpt" id="wp-color-result-p"',
																		   'value' => ( isset( $this->settings['points']['color'] ) ? $this->settings['points']['color'] : 'white' ),
																	   ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Enable point text background', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enable this options to set background for points text.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td style="min-width: 187px;">
											<?php
											echo htmlIcs::checkbox( 'settings[points][text_background_enables]',
																	array(
																		'checked' => ( isset( $this->settings['points']['text_background_enables'] ) ? (int) $this->settings['points']['text_background_enables'] : 0 ),
																	) )
											?>
										</td>
									</tr>
									<?php //var_dump($icsPointBackground); ?>
									<tr class="<?php echo esc_attr($icsPointBackground); ?> icsPointBackground">
										<th>
											<?php echo esc_html__( 'Point text background color', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Choose background color for points text.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::colorpicker( 'settings[points][text_background_color]',
																	   array(
																		   'attrs' => 'class="cfsProOpt" id="wp-color-result-pb"',
																		   'value' => ( isset( $this->settings['points']['text_background_color'] ) ? $this->settings['points']['text_background_color'] : 'black' ),
																	   ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Add Point', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Enable this options to set points on img. Enter point name and marker will appear on the map. Then you can drag marker.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td style="min-width: 187px;">
											<?php
											echo htmlIcs::checkbox( 'settings[point-enable]',
																	array(
																		'checked' => ( isset( $this->settings['point-enable'] ) ? (int) $this->settings['point-enable'] : 0 ),
																	) )
											?>
										</td>
									</tr>
									</tbody>
									<tbody class="icsPointsWrapper <?php echo esc_attr($icsMarkerHidden); ?>">
									<tr>
										<td>
											<button class="button icsAddPoint"><?php echo esc_html__( 'Add', ICS_LANG_CODE ); ?></button>
										</td>
										<td></td>
										<td>
											<button class="button icsRemoveAllPoints"><?php echo esc_html__( 'Remove all', ICS_LANG_CODE ); ?></button>
										</td>
									</tr>
									<?php
									$points = isset( $this->settings['point'] ) ? $this->settings['point'] : false;
									if ( is_array( $points ) && ! empty( $points ) ) :
										foreach ( $points as $key => $point ) :
											?>
											<tr class="icsMarkerWrapp <?php echo esc_attr($icsDisabled); ?> " data-id="<?php echo esc_attr($key); ?>">
												<?php
												$value    = ( isset( $this->settings['point'][ $key ]['text'] ) ? $this->settings['point'][ $key ]['text'] : '' );
												$dataTop  = ( isset( $this->settings['point'][ $key ]['top'] ) ? $this->settings['point'][ $key ]['top'] : 10 );
												$dataLeft = ( isset( $this->settings['point'][ $key ]['left'] ) ? $this->settings['point'][ $key ]['left'] : 10 );
												?>
												<td colspan="2">
													<?php
													echo htmlIcs::text( 'settings[point][' . $key . '][text]',
																		array(
																			'value' => $value,
																			'attrs' => 'placeholder="text" data-top="' . $dataTop . '" data-left="' . $dataLeft . '" ',
																		) )
													?>
												</td>
												<td>
													<button class="button removePoint"><?php echo esc_html__( 'Remove', ICS_LANG_CODE ); ?></button>
												</td>
												<?php
												echo htmlIcs::hidden( 'settings[point][' . $key . '][top]',
																	  array(
																		  'value' => $dataTop,
																	  ) )
												?>
												<?php
												echo htmlIcs::hidden( 'settings[point][' . $key . '][left]',
																	  array(
																		  'value' => $dataLeft,
																	  ) )
												?>
											</tr>
										<?php endforeach; ?>
									<?php endif; ?>
									<tr class="icsMarkerWrapp icsMarkerWrappEmpty">
										<td colspan="2">
											<?php
											echo htmlIcs::text( 'empty',
																array(
																	'value' => '',
																	'attrs' => 'placeholder="text"',
																) )
											?>
										</td>
										<td>
											<button class="button removePoint"><?php echo esc_html__( 'Remove', ICS_LANG_CODE ); ?></button>
										</td>
										<?php
										echo htmlIcs::hidden( 'top',
															  array(
																  'value' => '',
															  ) )
										?>
										<?php
										echo htmlIcs::hidden( 'left',
															  array(
																  'value' => '',
															  ) )
										?>
									</tr>
									</tbody>
								</table>

							</div>
							<div class="col-md-12 icsSettingsCol">
								<h3>Caption Settings</h3>
								<table class="form-table">
									<tbody>
									<tr>
										<th style="width: auto"><?php echo esc_html__( 'Font', ICS_LANG_CODE ); ?></th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Choose captions text font.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::fontsList( 'settings[caption][font_family]',
																	 array(
																		 'value' => ( isset( $this->settings['caption']['font_family'] ) ? $this->settings['caption']['font_family'] : 'Open Sans' ),
																		 'attrs' => 'class="chosen"',
																	 ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto"><?php echo esc_html__( 'Font Size', ICS_LANG_CODE ); ?></th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Choose captions font size.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[caption][font_size]',
																array(
																	'value' => ( isset( $this->settings['caption']['font_size'] ) ? $this->settings['caption']['font_size'] : 14 ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr class="icsCaptionTextColor">
										<th style="width: auto"><?php echo esc_html__( 'Text Color', ICS_LANG_CODE ); ?></th>
										<td><i class="fa fa-question supsystic-tooltip" title="
										<?php 
										echo esc_html__( 'Choose captions text color.',
																														ICS_LANG_CODE ); 
										?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::colorpicker( 'settings[caption][text_color]',
																	   array(
																		   'value' => ( isset( $this->settings['caption']['text_color'] ) ? $this->settings['caption']['text_color'] : '#fcfcfc' ),
																		   'attrs' => 'style="width: 50px"',
																	   ) )
											?>
										</td>
									</tr>
									<tr class="icsCaptionTextColor">
										<th style="width: auto"><?php echo esc_html__( 'Font Style', ICS_LANG_CODE ); ?></th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Make captions text bold/italic/line.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<label>
												<?php
												echo htmlIcs::checkbox( 'settings[caption][bold]',
																		array(
																			'checked' => ( isset( $this->settings['caption']['bold'] ) ? (int) $this->settings['caption']['bold'] : 0 ),
																		) )
												?>
												<?php echo esc_html__( 'Bold', ICS_LANG_CODE ); ?>
											</label>
											<label>
												<?php
												echo htmlIcs::checkbox( 'settings[caption][italic]',
																		array(
																			'checked' => ( isset( $this->settings['caption']['italic'] ) ? (int) $this->settings['caption']['italic'] : 0 ),
																		) )
												?>
												<?php echo esc_html__( 'Italic', ICS_LANG_CODE ); ?>
											</label>
											<label>
												<?php
												echo htmlIcs::checkbox( 'settings[caption][line]',
																		array(
																			'checked' => ( isset( $this->settings['caption']['line'] ) ? (int) $this->settings['caption']['line'] : 0 ),
																		) )
												?>
												<?php echo esc_html__( 'Line', ICS_LANG_CODE ); ?>
											</label>
										</td>
									</tr>
									<tr class="icsPro <?php echo esc_attr($icsDisabled); ?>">
										<th style="width: auto">
											<span class="icsAdminTitle"><?php echo esc_html__( 'Position', ICS_LANG_CODE ); ?>:</span>
											<span class="icsAdminTitlePro"><?php echo esc_html__( 'PRO option', ICS_LANG_CODE ); ?></span>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Change captions text position.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::selectbox( 'settings[caption][text_position]',
																	 array(
																		 'options' => array( 'top' => 'top', 'bottom' => 'bottom' ),
																		 'value'   => ( isset( $this->settings['caption']['text_position'] ) ? $this->settings['caption']['text_position'] : 'center' ),
																		 'attrs'   => 'class="chosen"',
																	 ) )
											?>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Padding Top', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Add top padding for caption text.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[caption][padding][top]',
																array(
																	'value' => ( isset( $this->settings['caption']['padding']['top'] ) ? $this->settings['caption']['padding']['top'] : 0 ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Padding Bottom', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Add bottom padding for caption text.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[caption][padding][bottom]',
																array(
																	'value' => ( isset( $this->settings['caption']['padding']['bottom'] ) ? $this->settings['caption']['padding']['bottom'] : 0 ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Padding Left', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Add left padding for caption text.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[caption][padding][left]',
																array(
																	'value' => ( isset( $this->settings['caption']['padding']['left'] ) ? $this->settings['caption']['padding']['left'] : 0 ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									<tr>
										<th style="width: auto">
											<?php echo esc_html__( 'Padding Right', ICS_LANG_CODE ); ?>
										</th>
										<td>
											<i class="fa fa-question supsystic-tooltip" title="
											<?php 
											echo esc_html__( 'Add right padding for caption text.',
																														ICS_LANG_CODE ); 
											?>
																														"></i>
										</td>
										<td>
											<?php
											echo htmlIcs::text( 'settings[caption][padding][right]',
																array(
																	'value' => ( isset( $this->settings['caption']['padding']['right'] ) ? $this->settings['caption']['padding']['right'] : 0 ),
																	'attrs' => 'style="width: 50px"',
																) )
											?>
											<span class="ics-complete-txt"> <?php echo esc_html__( 'px', ICS_LANG_CODE ); ?></span>
										</td>
									</tr>
									</tbody>
								</table>
							</div>
						</div>

					</div>

					<?php if ( isset( $this->slider['title'] ) ) {
						echo htmlIcs::hidden( 'title', array( 'value' => $this->slider['title'] ) );
					} ?>
					<?php echo htmlIcs::hidden( 'mod', array( 'value' => 'comparison' ) ); ?>
					<?php echo htmlIcs::hidden( 'action', array( 'value' => 'updateSettingFromTpl' ) ); ?>
					<?php if ( isset( $this->slider['id'] ) ) {
						echo htmlIcs::hidden( 'id', array( 'value' => $this->slider['id'] ) );
					} ?>
				</form>
				<div style="clear: both;"></div>
			</div>
		</div>
	</section>
</div>
