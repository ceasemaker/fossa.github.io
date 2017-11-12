<?php
function hermes_testimonials_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'title'=>'',
		'widget_style' => '',
		'el_class' => '',
		'number' => 10,
		'order' => '',
		'style'=>'carousel',
		'showon_effect'=>'non-effect',
		'columns' => 1,
		'rows' => 1,
		'show_name' => 0,
		'show_date' => 0,
		'excerpt_length' => 0,
		'desksmall' => '4',
		'tablet_count' => '3',
		'tabletsmall' => '2',
		'mobile_count' => '1',
		'margin' => '30'
	), $atts, 'testimonials' ) );

	$_id = hermes_make_id();
	$args = array(
		'post_type' => 'testimonial',
		'posts_per_page' => $number,
		'post_status' => 'publish',
	);
	if($order){
		$args['orderby'] = $order;
	}
$query = new WP_Query($args);
$total = $query->post_count;
?>
<?php if($query->have_posts()){ ob_start(); ?>
	<div class="testimonials <?php echo esc_attr($el_class); ?>">
		<?php if($title){ ?><h3 class="vc_widget_title vc_testimonial_title <?php echo esc_attr($widget_style); ?>"><span><?php echo esc_html($title); ?></span></h3><?php } ?>
		<div class="inner-content <?php echo esc_attr($widget_style); ?>">
			<div <?php echo ($style == 'carousel') ? 'data-dots="false" data-desksmall="'. esc_attr($desksmall) .'" data-tabletsmall="'. esc_attr($tabletsmall) .'" data-mobile="'. esc_attr($mobile_count) .'" data-tablet="'. esc_attr($tablet_count) .'" data-margin="'. esc_attr($margin) .'" data-nav="true" data-owl="slide" data-item-slide="'. esc_attr($columns) .'" data-ow-rtl="false"':'' ?> id="testimonial-<?php echo esc_attr($_id); ?>" class="testimonials-list<?php echo ($style == 'carousel') ? ' owl-carousel owl-theme':'' ?>">
				<?php 
					$i=0; 
					while($query->have_posts()): 
						$query->the_post(); 
						if($rows > 1 && $style == 'carousel'){
							if ( $i % $rows == 0 ){
								echo '<div class="group">';
							}
						}
						$i++; 
					?>
					<!-- Wrapper for slides -->
					<div class="quote wow <?php echo $showon_effect; ?>" data-wow-delay="100ms" data-wow-duration="0.5s">
						<div class="author-avatar">
							<div class="avatar">
								<?php the_post_thumbnail( 'thumbnail' ); ?>
							</div>
							<?php if($show_name && $widget_style != 'border-style'){ ?>
							<p class="author">
								<span><?php the_title(); ?></span>
							</p>
							<?php } ?>
							<?php if($show_date){ ?>
							<span class="date"><i class="fa fa-calendar"></i><?php echo get_the_date( get_option( 'date_format' ), get_the_ID() ); ?></span>
							<?php } ?>
						</div>
						<?php if($show_name && $widget_style == 'border-style'){ ?>
							<div class="author">
								<span><?php the_title(); ?></span>
							</div>
							<?php } ?>
						<blockquote class="testimonials-text">
							<?php 
							if($excerpt_length){
								$excerpt = get_the_content();
								$excerpt = strip_shortcodes($excerpt);
								$excerpt = strip_tags($excerpt);
								if(strlen($excerpt) > intval($excerpt_length)){
									echo substr($excerpt, 0, intval($excerpt_length)) . ' ...';
								}else{
									the_content();
								}
							}else{
								the_content();
							}
							?>
						</blockquote>
					</div>
					<?php
						if($rows > 1 && $style == 'carousel'){
							if (($i % $rows == 0) || $i == $total ) {
								echo '</div>';
							}
						}
					?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
<?php 
	$content = ob_get_contents();
	ob_end_clean();
	wp_reset_postdata();
	return $content;
	}
}
add_shortcode( 'testimonials', 'hermes_testimonials_shortcode' );
?>