					<?php do_action('avada_after_main_content'); ?>
				</div>  <!-- fusion-row -->

			</div>  <!-- #main -->
			<?php do_action('avada_after_main_container'); ?>

			<?php global $social_icons; ?>

			<?php if (false !== strpos(Avada()->settings->get('footer_special_effects'), 'footer_sticky')) : ?>
				</div>
			<?php endif; ?>

			<?php
            /**
             * Get the correct page ID.
             */
            $c_pageID = Avada::c_pageID();
            ?>

			<?php
            /**
             * Only include the footer.
             */
            ?>
			<?php if (!is_page_template('blank.php')) : ?>
				<?php $footer_parallax_class = ('footer_parallax_effect' == Avada()->settings->get('footer_special_effects')) ? ' fusion-footer-parallax' : ''; ?>

				<div class="fusion-footer<?php echo $footer_parallax_class; ?>">
					<?php
                    /**
                     * Run shortcode to generate footer.
                     */
                    $fw_content = '[fullwidth background_color="#0075b5" background_image="http://www.aphillies.com/wp-content/uploads/2016/07/813.jpg" background_parallax="up" enable_mobile="no" parallax_speed="0.3" background_repeat="no-repeat" background_position="center center" video_url="" video_aspect_ratio="16:9" video_webm="" video_mp4="" video_ogv="" video_preview_image="" overlay_color="" overlay_opacity="0.5" video_mute="yes" video_loop="yes" fade="no" border_size="0px" border_color="" border_style="solid" padding_top="50px" padding_bottom="50px" padding_left="0px" padding_right="0px" hundred_percent="no" equal_height_columns="no" hide_on_mobile="no" menu_anchor="" class="foot_three_column_text" id=""][one_third last="no" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" hover_type="none" link="" border_position="all" border_size="0px" border_color="" border_style="solid" padding="10%" margin_top="" margin_bottom="0px" animation_type="0" animation_direction="down" animation_speed="0.1" animation_offset="" class="bgc_black_10" id=""][content_boxes settings_lvl="parent" layout="icon-with-title" columns="1" icon_align="left" title_size="" title_color="" body_color="" backgroundcolor="" icon_circle="" icon_circle_radius="" iconcolor="" circlecolor="" circlebordercolor="" circlebordersize="" outercirclebordercolor="" outercirclebordersize="" icon_size="" icon_hover_type="none" hover_accent_color="" link_type="" link_area="" link_target="" animation_delay="" animation_offset="" animation_type="0" animation_direction="left" animation_speed="0.1" margin_top="" margin_bottom="0px" class="" id=""][content_box title="联系我们" icon="fa-phone" backgroundcolor="" iconcolor="#ffffff" circlecolor="#6666a4" circlebordercolor="#6666a4" circlebordersize="" outercirclebordercolor="" outercirclebordersize="" iconrotate="" iconspin="no" image="" image_width="35" image_height="35" link="" linktext="" link_target="_self" animation_type="0" animation_direction="down" animation_speed="0.1"]<span style="color: #ffffff;">这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。这里是很多测试文字。</span>[/content_box][/content_boxes][/one_third][one_third last="no" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" hover_type="none" link="" border_position="all" border_size="0px" border_color="" border_style="solid" padding="10%" margin_top="" margin_bottom="0px" animation_type="0" animation_direction="down" animation_speed="0.1" animation_offset="" class="bgc_black_10" id=""][content_boxes settings_lvl="child" layout="icon-with-title" columns="1" icon_align="left" title_size="" title_color="" body_color="" backgroundcolor="" icon_circle="" icon_circle_radius="" iconcolor="" circlecolor="" circlebordercolor="" circlebordersize="" outercirclebordercolor="" outercirclebordersize="" icon_size="" icon_hover_type="none" hover_accent_color="" link_type="" link_area="" link_target="" animation_delay="" animation_offset="" animation_type="0" animation_direction="left" animation_speed="0.1" margin_top="" margin_bottom="0px" class="" id=""][content_box title="Meet Us" icon="fa-comments" backgroundcolor="" iconcolor="#ffffff" circlecolor="#7272b2" circlebordercolor="#7272b2" circlebordersize="" outercirclebordercolor="" outercirclebordersize="" iconrotate="" iconspin="no" image="" image_width="35" image_height="35" link="" linktext="" link_target="_self" animation_type="0" animation_direction="down" animation_speed="0.1"] <span style="color: #ffffff;">Please call one of our specialist or pop into one of our travel shops and meet with an advisor in person. Alternatively, email us any questions and we will reply as quickly as possible. We look forward to being a small part of your next big adventure.</span>[/content_box][/content_boxes][/one_third][one_third last="yes" spacing="yes" center_content="no" hide_on_mobile="no" background_color="" background_image="" background_repeat="no-repeat" background_position="left top" hover_type="none" link="" border_position="all" border_size="0px" border_color="" border_style="solid" padding="10%" margin_top="" margin_bottom="0px" animation_type="0" animation_direction="down" animation_speed="0.1" animation_offset="" class="bgc_black_10" id=""][content_boxes settings_lvl="child" layout="icon-with-title" columns="1" icon_align="left" title_size="" title_color="" body_color="" backgroundcolor="" icon_circle="" icon_circle_radius="" iconcolor="" circlecolor="" circlebordercolor="" circlebordersize="" outercirclebordercolor="" outercirclebordersize="" icon_size="" icon_hover_type="none" hover_accent_color="" link_type="" link_area="" link_target="" animation_delay="" animation_offset="" animation_type="0" animation_direction="left" animation_speed="0.1" margin_top="" margin_bottom="0px" class="" id=""][content_box title="Ask Us" icon="fa-phone" backgroundcolor="" iconcolor="#ffffff" circlecolor="#6666a4" circlebordercolor="#6666a4" circlebordersize="" outercirclebordercolor="" outercirclebordersize="" iconrotate="" iconspin="no" image="" image_width="35" image_height="35" link="" linktext="" link_target="_self" animation_type="0" animation_direction="down" animation_speed="0.1"] <span style="color: #ffffff;">Please call one of our specialist or pop into one of our travel shops and meet with an advisor in person. Alternatively, email us any questions and we will reply as quickly as possible. We look forward to being a small part of your next big adventure.</span>[/content_box][/content_boxes][/one_third][/fullwidth]';
                    echo do_shortcode($fw_content);
                    ?>
					<?php
                    /*
                     * Check if the footer widget area should be displayed.
                     */
                    ?>
					<?php if ((Avada()->settings->get('footer_widgets') && 'no' != get_post_meta($c_pageID, 'pyre_display_footer', true)) || (!Avada()->settings->get('footer_widgets') && 'yes' == get_post_meta($c_pageID, 'pyre_display_footer', true))) : ?>
						<?php $footer_widget_area_center_class = (Avada()->settings->get('footer_widgets_center_content')) ? ' fusion-footer-widget-area-center' : ''; ?>

						<footer class="fusion-footer-widget-area fusion-widget-area<?php echo $footer_widget_area_center_class; ?>">
							<div class="fusion-row">
								<div class="fusion-columns fusion-columns-<?php echo Avada()->settings->get('footer_widgets_columns'); ?> fusion-widget-area">
									<?php
                                    /**
                                     * Check the column width based on the amount of columns chosen in Theme Options.
                                     */
                                    $column_width = ('5' == Avada()->settings->get('footer_widgets_columns')) ? 2 : 12 / Avada()->settings->get('footer_widgets_columns');
                                    ?>

									<?php
                                    /**
                                     * Render as many widget columns as have been chosen in Theme Options.
                                     */
                                    ?>
									<?php for ($i = 1; $i < 7; ++$i) : ?>
										<?php if ($i <= Avada()->settings->get('footer_widgets_columns')) : ?>
											<div class="fusion-column<?php echo ($i == Avada()->settings->get('footer_widgets_columns')) ? ' fusion-column-last' : ''; ?> col-lg-<?php echo $column_width; ?> col-md-<?php echo $column_width; ?> col-sm-<?php echo $column_width; ?>">
												<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('avada-footer-widget-'.$i)) : ?>
													<?php
                                                    /**
                                                     * All is good, dynamic_sidebar() already called the rendering.
                                                     */
                                                    ?>
												<?php endif; ?>
											</div>
										<?php endif; ?>
									<?php endfor; ?>

									<div class="fusion-clearfix"></div>
								</div> <!-- fusion-columns -->
							</div> <!-- fusion-row -->
						</footer> <!-- fusion-footer-widget-area -->
					<?php endif; // end footer wigets check ?>

					<?php
                    /**
                     * Check if the footer copyright area should be displayed.
                     */
                    ?>
					<?php if ((Avada()->settings->get('footer_copyright') && 'no' != get_post_meta($c_pageID, 'pyre_display_copyright', true)) || (!Avada()->settings->get('footer_copyright') && 'yes' == get_post_meta($c_pageID, 'pyre_display_copyright', true))) : ?>
						<?php $footer_copyright_center_class = (Avada()->settings->get('footer_copyright_center_content')) ? ' fusion-footer-copyright-center' : ''; ?>

						<footer id="footer" class="fusion-footer-copyright-area<?php echo $footer_copyright_center_class; ?>">
							<div class="fusion-row">
								<div class="fusion-copyright-content">

									<?php
                                    /**
                                     * avada_footer_copyright_content hook.
                                     *
                                     * @hooked avada_render_footer_copyright_notice - 10 (outputs the HTML for the Theme Options footer copyright text)
                                     * @hooked avada_render_footer_social_icons - 15 (outputs the HTML for the footer social icons)
                                     */
                                    do_action('avada_footer_copyright_content');
                                    ?>

								</div> <!-- fusion-fusion-copyright-content -->
							</div> <!-- fusion-row -->
						</footer> <!-- #footer -->
					<?php endif; // end footer copyright area check ?>
				</div> <!-- fusion-footer -->
			<?php endif; // end is not blank page check ?>
		</div> <!-- wrapper -->

		<?php
        /**
         * Check if boxed side header layout is used; if so close the #boxed-wrapper container.
         */
        ?>
		<?php if ((('Boxed' == Avada()->settings->get('layout') && 'default' == get_post_meta($c_pageID, 'pyre_page_bg_layout', true)) || 'boxed' == get_post_meta($c_pageID, 'pyre_page_bg_layout', true)) && 'Top' != Avada()->settings->get('header_position')) : ?>
			</div> <!-- #boxed-wrapper -->
		<?php endif; ?>

		<a class="fusion-one-page-text-link fusion-page-load-link"></a>

		<!-- W3TC-include-js-head -->

		<?php wp_footer(); ?>

		<?php
        /**
         * Echo the scripts added to the "before </body>" field in Theme Options.
         */
        echo Avada()->settings->get('space_body');
        ?>

		<!--[if lte IE 8]>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/respond.js"></script>
		<![endif]-->
	</body>
</html>
