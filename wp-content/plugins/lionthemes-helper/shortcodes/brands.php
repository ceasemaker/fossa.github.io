<?php
function hermes_brands_shortcode( $atts ) {
	global $hermes_opt;
	$brand_index = 0;
	if(!isset($hermes_opt['brand_logos'])) return;
	$brandfound = count($hermes_opt['brand_logos']);
	
	$atts = shortcode_atts( array(
							'title' => '',
							'widget_style' => '',
							'rows' => '1',
							'colsnumber' => '6',
							'el_class' => '',
							'style'=>'grid',
							'showon_effect'=>'non-effect',
							'desksmall' => '4',
							'tablet_count' => '3',
							'tabletsmall' => '3',
							'mobile_count' => '2',
							'margin' => '30'
							), $atts, 'ourbrands' );
	extract($atts);
	switch ($colsnumber) {
		case '6':
			$class_column='col-sm-2 col-xs-6';
			break;
		case '5':
			$class_column='col-md-20 col-sm-4 col-xs-6';
			break;
		case '4':
			$class_column='col-sm-3 col-xs-6';
			break;
		case '3':
			$class_column='col-sm-4 col-xs-6';
			break;
		case '2':
			$class_column='col-sm-6 col-xs-6';
			break;
		default:
			$class_column='col-sm-12 col-xs-6';
			break;
	}
	if($brandfound <= 0) return;
	ob_start();
	echo '<div class="brand_widget '. esc_attr($el_class) .'">';
	echo ($title) ? '<h3 class="vc_widget_title vc_brands_title '.  esc_attr($widget_style) .'"><span>'. esc_html($title) .'</span></h3>' : '';
	echo '<div class="inner-content '.  esc_attr($widget_style) .'">';
	if($style == 'grid'){
		$wrapdiv = '';
	}else{
		$class_column = '';
		$wrapdiv = '<div data-owl="slide" data-desksmall="'. esc_attr($desksmall) .'" data-tabletsmall="'. esc_attr($tabletsmall) .'" data-mobile="'. esc_attr($mobile_count) .'" data-tablet="'. $tablet_count .'" data-margin="'. esc_attr($margin) .'" data-item-slide="'. esc_attr($colsnumber) .'" data-ow-rtl="false" class="owl-carousel owl-theme brands-slide ' . esc_attr($el_class) . '">';
	}
	if($hermes_opt['brand_logos']) { ?>
			<?php 
				echo $wrapdiv; 
				$duration = 0;
			?>
			<?php foreach($hermes_opt['brand_logos'] as $brand) {
				$duration = $duration + 100;
				if(is_ssl()){
					$brand['image'] = str_replace('http:', 'https:', $brand['image']);
				}
				$brand_index ++;
				?>
				<?php if($style == 'carousel' && $rows > 1){ ?>
					<?php if ( (0 == ( $brand_index - 1 ) % $rows ) || $brand_index == 1) { ?>
						<div class="group">
					<?php } ?>
				<?php } ?>
				<div class="brand_item wow <?php echo $showon_effect; ?> <?php echo esc_attr($class_column); ?>" data-wow-delay="<?php echo esc_attr($duration) ?>ms" data-wow-duration="0.5s">
					<a href="<?php echo esc_url($brand['url']); ?>" title="<?php echo esc_attr($brand['title']); ?>">
						<img src="<?php echo esc_url($brand['image']) ?>" alt="<?php echo esc_attr($brand['title']); ?>" />
					</a>
				</div>
				<?php if($style == 'carousel' && $rows > 1){ ?>
					<?php if ( ( ( 0 == $brand_index % $rows || $brandfound == $brand_index ))  ) { ?>
						</div>
					<?php } ?>
				<?php } ?>
			<?php } ?>
		</div>
	<?php }
	echo '</div>';
	echo '</div>';
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}
add_shortcode( 'ourbrands', 'hermes_brands_shortcode' );
?>