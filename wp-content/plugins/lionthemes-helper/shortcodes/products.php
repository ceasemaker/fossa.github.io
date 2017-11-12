<?php
function hermes_products_shortcode( $atts ) {
	global $hermes_opt;
	$atts = shortcode_atts( array(
							'number'=> 10,
							'columns'=>'4',
							'rows'=>'1',
							'el_class' => '',
							'type'=>'best_selling',
							'style'=>'grid',
							'showon_effect'=>'non-effect',
							'item_layout'=>'box',
							'title'=>'',
							'widget_style' => '',
							'short_desc' => '',
							'desksmall' => '4',
							'tablet_count' => '3',
							'tabletsmall' => '2',
							'mobile_count' => '1',
							'margin' => '30'
							), $atts, 'specifyproducts' );
	extract($atts);
	switch ($columns) {
		case '5':
			$class_column='col-sm-20 col-xs-6';
			break;
		case '4':
			$class_column='col-sm-3 col-xs-6';
			break;
		case '3':
			$class_column='col-lg-4 col-md-4 col-sm-4 col-xs-6';
			break;
		case '2':
			$class_column='col-lg-6 col-md-6 col-sm-6 col-xs-6';
			break;
		default:
			$class_column='col-lg-12 col-md-12 col-sm-12 col-xs-6';
			break;
	}
	if($type=='') return;

	global $woocommerce;

	$_id = hermes_make_id();
	$_count = 1;
	$show_rating = $is_deals = false;
	if($type=='top_rate') $show_rating=true;
	if($type=='deals') $is_deals=true;
	
	$loop = hermes_woocommerce_query($type,$number);
	$_total = $loop->post_count;
	if ( $loop->have_posts() ) : 
		ob_start();
	?>
		
		<div class="woocommerce<?php echo (($el_class!='')?' '.$el_class:''); ?>">
			<?php if($title){ ?><h3 class="vc_widget_title vc_products_title <?php echo esc_attr($widget_style); ?>"><span><?php echo esc_html($title); ?></span></h3><?php } ?>
			<?php if($short_desc){ ?><div class="short_desc"><?php echo wpautop($short_desc) ?></div><?php } ?>
			<div class="inner-content <?php echo esc_attr($widget_style); ?>">
				<?php wc_get_template( 'product-layout/'.$style.'.php', array( 
							'show_rating' => $show_rating,
							'showon_effect' => $showon_effect,
							'_id'=>$_id,
							'loop'=>$loop,
							'columns_count'=>$columns,
							'class_column' => $class_column,
							'_total'=>$_total,
							'number'=>$number,
							'rows'=>$rows,
							'margin'=>$margin,
							'desksmall'=>$desksmall,
							'tabletsmall'=>$tabletsmall,
							'tablet_count'=>$tablet_count,
							'mobile_count'=>$mobile_count,
							'is_deals' => $is_deals,
							'itemlayout'=> $item_layout,
							 ) ); ?>
			</div>
		</div>
	<?php 
		$content = ob_get_contents();
		ob_end_clean();
		wp_reset_postdata();
		return $content;
	endif; 
}
add_shortcode( 'specifyproducts', 'hermes_products_shortcode' );
?>