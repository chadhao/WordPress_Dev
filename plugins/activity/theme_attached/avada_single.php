<?php get_header(); ?>

<div id="content" <?php if(is_single($post->ID)){echo 'style="float: right;"';}else{Avada()->layout->add_style('content_style');} ?>>

	<?php if ((Avada()->settings->get('blog_pn_nav') && 'no' != get_post_meta($post->ID, 'pyre_post_pagination', true)) || (!Avada()->settings->get('blog_pn_nav') && 'yes' == get_post_meta($post->ID, 'pyre_post_pagination', true))): ?>
		<div class="single-navigation clearfix">
			<?php previous_post_link('%link', esc_attr__('Previous', 'Avada')); ?>
			<?php next_post_link('%link', esc_attr__('Next', 'Avada')); ?>
		</div>
	<?php endif; ?>

	<?php while (have_posts()) : the_post(); ?>
		<div id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
			<?php $full_image = ''; ?>
			<?php if ('above' == Avada()->settings->get('blog_post_title')) : ?>
				<?php echo avada_render_post_title($post->ID, false, '', '2'); ?>
			<?php elseif ('disabled' == Avada()->settings->get('blog_post_title') && Avada()->settings->get('disable_date_rich_snippet_pages')) : ?>
				<span class="entry-title" style="display: none;"><?php the_title(); ?></span>
			<?php endif; ?>

			<?php if (!post_password_required($post->ID)) : ?>
				<?php if (Avada()->settings->get('featured_images_single')) : ?>
					<?php if (0 < avada_number_of_featured_images() || get_post_meta($post->ID, 'pyre_video', true)) : ?>
						<?php Avada()->images->set_grid_image_meta(array('layout' => strtolower('large'), 'columns' => '1')); ?>
						<div class="fusion-flexslider flexslider fusion-flexslider-loading post-slideshow fusion-post-slideshow">
							<ul class="slides">
								<?php if (get_post_meta($post->ID, 'pyre_video', true)) : ?>
									<li>
										<div class="full-video">
											<?php echo get_post_meta($post->ID, 'pyre_video', true); ?>
										</div>
									</li>
								<?php endif; ?>
								<?php if (has_post_thumbnail() && 'yes' != get_post_meta($post->ID, 'pyre_show_first_featured_image', true)) : ?>
									<?php $attachment_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
									<?php $full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full'); ?>
									<?php $attachment_data = wp_get_attachment_metadata(get_post_thumbnail_id()); ?>
									<li>
										<?php if (Avada()->settings->get('status_lightbox') && Avada()->settings->get('status_lightbox_single')) : ?>
											<a href="<?php echo $full_image[0]; ?>" data-rel="iLightbox[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>" data-title="<?php echo get_post_field('post_title', get_post_thumbnail_id()); ?>" data-caption="<?php echo get_post_field('post_excerpt', get_post_thumbnail_id()); ?>">
												<span class="screen-reader-text"><?php esc_attr_e('View Larger Image', 'Avada'); ?></span>
												<?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
											</a>
										<?php else: ?>
											<?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
										<?php endif; ?>
									</li>
								<?php endif; ?>
								<?php $i = 2; ?>
								<?php while ($i <= Avada()->settings->get('posts_slideshow_number')) : ?>
									<?php $attachment_new_id = kd_mfi_get_featured_image_id('featured-image-'.$i, 'post'); ?>
									<?php if ($attachment_new_id) : ?>
										<?php $attachment_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
										<?php $full_image = wp_get_attachment_image_src($attachment_new_id, 'full'); ?>
										<?php $attachment_data = wp_get_attachment_metadata($attachment_new_id); ?>
										<li>
											<?php if (Avada()->settings->get('status_lightbox') && Avada()->settings->get('status_lightbox_single')) : ?>
												<a href="<?php echo $full_image[0]; ?>" data-rel="iLightbox[gallery<?php the_ID(); ?>]" title="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>" data-title="<?php echo get_post_field('post_title', $attachment_new_id); ?>" data-caption="<?php echo get_post_field('post_excerpt', $attachment_new_id); ?>">
													<?php echo wp_get_attachment_image($attachment_new_id, 'full'); ?>
												</a>
											<?php else: ?>
												<?php echo wp_get_attachment_image($attachment_new_id, 'full'); ?>
											<?php endif; ?>
										</li>
									<?php endif; ?>
									<?php ++$i; ?>
								<?php endwhile; ?>
							</ul>
						</div>
						<?php Avada()->images->set_grid_image_meta(array()); ?>
					<?php endif; ?>
				<?php endif; ?>
			<?php endif; ?>

			<?php if ('below' == Avada()->settings->get('blog_post_title')) : ?>
				<?php echo avada_render_post_title($post->ID, false, '', '2'); ?>
			<?php endif; ?>
			<div class="post-content">
				<?php
					function activity_fee($member, $nonmember) {
						if ($member==0 && $nonmember==0) {
							return '免费';
						}
						if ($member==0 && $nonmember!=0) {
							return '会员免费 / 非会员$' . $nonmember;
						}
						if ($member!=0 && $nonmember==0) {
							return '会员$' . $member . ' / 非会员免费';
						}
						return '会员$' . $member . ' / 非会员$' . $nonmember;
					}
					if ( in_category( get_option('activity_category') ) ) {
						global $wpdb;
						$table_name = $wpdb->prefix.'activity_meta';
						$activity_result = $wpdb->get_row("SELECT * FROM $table_name WHERE post_id = $post->ID");
						$activity_time = new DateTime($activity_result->activity_time);
						$activity_signup_time = new DateTime($activity_result->signup_time);
						$datetime_now = new DateTime(current_time('mysql'));

						echo '<div id="activity_content">';
						if ( !empty( $activity_result->poster ) ) {
							echo '<p style="margin: 0 auto; max-width: 600px; text-align: center;"><img src="' . $activity_result->poster . '"></p>';
						}
						echo '<p><strong>活动时间：</strong>' . $activity_time->format('Y年m月d日 h:i A') . '</p>';
						echo '<p><strong>活动地点：</strong>' . $activity_result->location . '</p>';
						echo '<p><strong>活动人数：</strong>' . ($activity_result->max_capacity==0?'不限人数':$activity_result->max_capacity) . '</p>';
						echo '<p><strong>活动费用：</strong>' . activity_fee($activity_result->member_fee, $activity_result->nonmember_fee) . '</p>';
						echo '<p><strong>报名方式：</strong>' . $activity_result->signup_method . '</p>';
						echo '<p><strong>报名截止时间：</strong>' . $activity_signup_time->format('Y年m月d日 h:i A') . '</p>';
						echo '<p><strong>活动详情：</strong></p>';
						the_content();
				?>
						<div class="fusion-row" style="margin: 0;max-width: 600px;">
						    <h4 style="border-bottom: 1px solid #aaa;">活动报名</h4>
						    <?php
						    if ($datetime_now > $activity_signup_time):
						        echo '<p>该活动线上报名已截止！线下报名以及关于活动的其他问题，请联系活动负责人。</p>';
						    else:
						    ?>
						    <style type="text/css">
						    .activity_signup_form p span input {
						        margin: 0;
						        border: 1px solid #aaa;
						        background: #fff;
						    }
						    .activity_signup_form p span input[type=checkbox] {
						        padding: 0!important;
						        border: 1px solid #aaa;
						        background: #fff;
						        cursor: pointer;
						        height: 16px;
						        width: 16px;
						        text-align: center;
						        vertical-align: middle;
						        -webkit-appearance: none;
						    }
						    .activity_signup_form p span input[type=checkbox]:checked:before {
						        content: "X";
						        font-weight: bold;
						        color: #1e8cbe;
						    }
						    .activity_signup_form p button {
						        cursor: pointer;
						        padding: 10px 20px;
						        font-size: 16px;
						        font-weight: bold;
						        color: #50586b;
						        border-radius: 2px;
						        border: 1px solid #50586b;
						        background: none;
						    }
						    </style>
						    <form class="activity_signup_form" method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
						        <input type="hidden" name="action" value="activity_signup">
						        <input type="hidden" name="frontend" value="1">
						        <input type="hidden" name="is_new" value="1">
						        <input type="hidden" name="post_id" value="<?php echo $post->ID; ?>">
						        <p>
						            姓名<small>（必填）</small><br>
						            <span><input type="text" name="fullname" placeholder="请填写您的姓名" value=""></span>
						        </p>
						        <p>
						            联系电话<small>（必填）</small><br>
						            <span><input type="text" name="phone" placeholder="请填写您的联系方式" value=""></span>
						        </p>
						        <p>
						            E-mail<br>
						            <span><input type="email" name="email" placeholder="请填写您的E-mail" value=""></span>
						        </p>
						        <p>
						            <span><input type="checkbox" name="is_aut_student"></span> 我是AUT在读学生
						        </p>
						        <p>
						            <span><input type="checkbox" name="is_autcsa_member"></span> 我是AUTCSA会员
						        </p>
						        <p><button type="submit">报名</button></p>
						    </form>
						    <?php endif; ?>
						</div>
				<?php
						echo '</div>';
					} else {
						the_content();
					}
				?>
				<?php avada_link_pages(); ?>
			</div>

			<?php if (!post_password_required($post->ID)) : ?>
				<?php echo avada_render_post_metadata('single'); ?>
				<?php avada_render_social_sharing(); ?>
				<?php if ((Avada()->settings->get('author_info') && 'no' != get_post_meta($post->ID, 'pyre_author_info', true)) || (!Avada()->settings->get('author_info') && 'yes' == get_post_meta($post->ID, 'pyre_author_info', true))) : ?>
					<div class="about-author">
						<?php ob_start(); ?>
						<?php the_author_posts_link(); ?>
						<?php $title = sprintf(__('About the Author: %s', 'Avada'), ob_get_clean()); ?>
						<?php echo Avada()->template->title_template($title, '3'); ?>
						<div class="about-author-container">
							<div class="avatar">
								<?php echo get_avatar(get_the_author_meta('email'), '72'); ?>
							</div>
							<div class="description">
								<?php the_author_meta('description'); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php
                 /**
                  * Render Related Posts.
                  */
                 echo avada_render_related_posts(get_post_type());
                 ?>

				<?php if ((Avada()->settings->get('blog_comments') && 'no' != get_post_meta($post->ID, 'pyre_post_comments', true)) || (!Avada()->settings->get('blog_comments') && 'yes' == get_post_meta($post->ID, 'pyre_post_comments', true))) : ?>
					<?php wp_reset_query(); ?>
					<?php comments_template(); ?>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php endwhile; ?>
	<?php wp_reset_query(); ?>
</div>
<?php do_action('avada_after_content'); ?>
<?php get_footer();

// Omit closing PHP tag to avoid "Headers already sent" issues.
