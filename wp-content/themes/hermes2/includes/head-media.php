<?php
/**
* Theme stylesheet & javascript registration
*
* @package WordPress
* @subpackage Hermes_theme
* @since Hermes Themes 1.4.4
*/

//Hermes theme style and script 
function hermes_register_script()
{
	global $hermes_opt, $woocommerce;
	$default_font = "'Arial', Helvetica, sans-serif";
	$body_font = (!empty($hermes_opt['bodyfont']['font-family'])) ? $hermes_opt['bodyfont']['font-family'] : $default_font;
	$heading_font = (!empty($hermes_opt['headingfont']['font-family'])) ? $hermes_opt['headingfont']['font-family'] : $default_font;
	$menu_font = (!empty($hermes_opt['menufont']['font-family'])) ? $hermes_opt['menufont']['font-family'] : $default_font;
	$heading_font_weight = (!empty($hermes_opt['headingfont']['font-weight'])) ? $hermes_opt['headingfont']['font-weight'] : '700';
	
	$skins = array(1 => '#ba933e', 2 => '#808f66', 3 => '#6dc5ee', 4 => '#12a170');
	
	if(isset($hermes_opt['use_design_font']) && $hermes_opt['use_design_font']) {
		$body_font = "texgyreadventorregular";
		$menu_font = $heading_font = "texgyreadventorbold";
		$heading_font_weight = 'normal';
	}
	$primary_color = (!empty($hermes_opt['primary_color'])) ? $hermes_opt['primary_color'] : '#ba933e';
	if(isset($_GET['skin']) && !empty($skins[intval($_GET['skin'])])){
		$primary_color = $skins[intval($_GET['skin'])];
	}
	$params = array(
		'heading_font'=> $heading_font,
		'heading_color'=> ((!empty($hermes_opt['headingfont']['color'])) ? $hermes_opt['headingfont']['color'] : '#181818'),
		'heading_font_weight'=> $heading_font_weight,
		'menu_font'=> $menu_font,
		'menu_font_size'=> ((!empty($hermes_opt['menufont']['font-size'])) ? $hermes_opt['menufont']['font-size'] : '14px'),
		'menu_font_weight'=> ((!empty($hermes_opt['menufont']['font-weight'])) ? $hermes_opt['menufont']['font-weight'] : '400'),
		'sub_menu_bg'=> ((!empty($hermes_opt['sub_menu_bg'])) ? $hermes_opt['sub_menu_bg'] : '#2c2c2c'),
		'sub_menu_color'=> ((!empty($hermes_opt['sub_menu_color'])) ? $hermes_opt['sub_menu_color'] : '#cfcfcf'),
		'body_font'=> $body_font,
		'text_color'=> ((!empty($hermes_opt['bodyfont']['color'])) ? $hermes_opt['bodyfont']['color'] : '#333333'),
		'primary_color' => $primary_color,
		'header_bg_color' => ((!empty($hermes_opt['header_background'])) ? $hermes_opt['header_background'] : '#242424'),
		'header_color' => ((!empty($hermes_opt['header_color'])) ? $hermes_opt['header_color'] : '#bbbbbb'),
		'topbar_color' => ((!empty($hermes_opt['topbar_color'])) ? $hermes_opt['topbar_color'] : '#666666'),
		'topbar_hvcolor' => ((!empty($hermes_opt['topbar_hvcolor'])) ? $hermes_opt['topbar_hvcolor'] : '#FFFFFF'),
		'sale_color' => ((!empty($hermes_opt['sale_color'])) ? $hermes_opt['sale_color'] : '#f49835'),
		'saletext_color' => ((!empty($hermes_opt['saletext_color'])) ? $hermes_opt['saletext_color'] : '#f49835'),
		'rate_color' => ((!empty($hermes_opt['rate_color'])) ? $hermes_opt['rate_color'] : '#f49835'),
		'page_width' => (!empty($hermes_opt['box_layout_width'])) ? $hermes_opt['box_layout_width'] . 'px' : '1200px',
		'body_bg_color' => ((!empty($hermes_opt['background_opt']['background-color'])) ? $hermes_opt['background_opt']['background-color'] : '#fff'),
		'popup_bg_color' => ((!empty($hermes_opt['background_popup']['background-color'])) ? $hermes_opt['background_popup']['background-color'] : '#fff'),
		'popup_bg_img' => ((!empty($hermes_opt['background_popup']['background-image'])) ? 'url("' . $hermes_opt['background_popup']['background-image'] . '")' : 'none'),
		'popup_bg_img_repeat' => ((!empty($hermes_opt['background_popup']['background-repeat'])) ? $hermes_opt['background_popup']['background-repeat'] : 'no-repeat'),
		'popup_bg_img_position' => ((!empty($hermes_opt['background_popup']['background-position'])) ? $hermes_opt['background_popup']['background-position'] : 'left top'),
		'popup_bg_img_size' => ((!empty($hermes_opt['background_popup']['background-size'])) ? $hermes_opt['background_popup']['background-size'] : 'auto'),
	);
	if( function_exists('compileLess') ){
		if(isset($_GET['skin']) && !empty($skins[intval($_GET['skin'])])){
			compileLess('theme.less', 'theme_skin_' . intval($_GET['skin']) . '.css', $params);
		}else{
			compileLess('theme.less', 'theme.css', $params);
		}
	}
	wp_enqueue_style( 'design-font', get_template_directory_uri() . '/css/font-texgyreadventor.css' );
	wp_enqueue_style( 'base-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-theme-css', get_template_directory_uri() . '/css/bootstrap-theme.min.css' );
	wp_enqueue_style( 'awesome-css', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'owl-css', get_template_directory_uri() . '/owl-carousel/owl.carousel.css' );
	wp_enqueue_style( 'owl-theme', get_template_directory_uri() . '/owl-carousel/owl.theme.css' );
	wp_enqueue_style( 'owl-transitions', get_template_directory_uri() . '/owl-carousel/owl.transitions.css' );
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/fancybox/jquery.fancybox.css' );
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	if(isset($_GET['skin']) && !empty($skins[$_GET['skin']])){
		if(file_exists( get_template_directory() . '/css/theme_skin_' . intval($_GET['skin']) . '.css' )){
			wp_enqueue_style( 'theme-options', get_template_directory_uri() . '/css/theme_skin_' . intval($_GET['skin']) . '.css' );
		}
	}else{
		if(file_exists( get_template_directory() . '/css/theme.css' )){
			wp_enqueue_style( 'theme-options', get_template_directory_uri() . '/css/theme.css'  );
		}
	}
	// add custom style sheet
	if ( isset($hermes_opt['custom_css']) && $hermes_opt['custom_css']!='') {
		wp_add_inline_style( 'theme-options', $hermes_opt['custom_css'] );
	}
	
	// add add-to-cart-variation js to all other pages without detail. it help quickview work with variable products
	if( class_exists('WooCommerce') && !is_product() ) {
		wp_enqueue_script( 'wc-add-to-cart-variation', $woocommerce->plugin_url() . '/assets/js/frontend/add-to-cart-variation.js', array('jquery'), '', true );
    }
    wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'owl-wow-js', get_template_directory_uri() . '/js/jquery.wow.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'owl-modernizr-js', get_template_directory_uri() . '/js/modernizr.custom.js', array('jquery'), '', true );
    wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/owl-carousel/owl.carousel.js', array('jquery'), '', true );
    wp_enqueue_script( 'auto-grid', get_template_directory_uri() . '/js/autoGrid.min.js', array('jquery'), '', true );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/fancybox/jquery.fancybox.pack.js', array('jquery'), '', true );
    wp_enqueue_script( 'temp-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '', true );
	// add ajaxurl
	$ajaxurl = 'var ajaxurl = "'. esc_js(admin_url('admin-ajax.php')) .'";';
	wp_add_inline_script( 'temp-js', $ajaxurl, 'before' );
	
	// add newletter popup js
	if(isset($hermes_opt['enable_popup']) && $hermes_opt['enable_popup']){
		if (is_front_page() && (!empty($hermes_opt['popup_onload_form']) || !empty($hermes_opt['popup_onload_content']))) {
			$newletter_js = 'jQuery(document).ready(function($){
								if($(\'#popup_onload\').length){
									$(\'#popup_onload\').fadeIn(400);
								}
								$(\'#popup_onload .close-popup, #popup_onload .overlay-bg-popup\').click(function(){
									var not_again = $(this).closest(\'#popup_onload\').find(\'.not-again input[type="checkbox"]\').prop(\'checked\');
									if(not_again){
										var datetime = new Date();
										var exdays = '. ((!empty($hermes_opt['popup_onload_expires'])) ? intval($hermes_opt['popup_onload_expires']) : 7) . ';
										datetime.setTime(datetime.getTime() + (exdays*24*60*60*1000));
										document.cookie = \'no_again=1; expires=\' + datetime.toUTCString();
									}
									$(this).closest(\'#popup_onload\').fadeOut(400);
								});
							});';
			wp_add_inline_script( 'temp-js', $newletter_js );
		}
	}
	
	
	// add remove top cart item
	$remove_cartitem_js = 'jQuery(document).on(\'click\', \'.mini_cart_item .remove\', function(e){
							var product_id = jQuery(this).data("product_id");
							var item_li = jQuery(this).closest(\'li\');
							var a_href = jQuery(this).attr(\'href\');
							jQuery.ajax({
								type: \'POST\',
								dataType: \'json\',
								url: ajaxurl,
								data: \'action=hermes_product_remove&\' + (a_href.split(\'?\')[1] || \'\'), 
								success: function(data){
									if(typeof(data) != \'object\'){
										alert(\'' . esc_html__('Could not remove cart item.', 'hermes') . '\');
										return;
									}
									jQuery(\'.topcart .cart-toggler .qty\').html(data.qty);
									jQuery(\'.topcart .cart-toggler .subtotal\').html(data.subtotal);
									jQuery(\'.topcart_content\').css(\'height\', \'auto\');
									if(data.qtycount > 0){
										jQuery(\'.topcart_content .total .amount\').html(data.subtotal);
									}else{
										jQuery(\'.topcart_content .cart_list\').html(\'<li class="empty">' .  esc_html__('No products in the cart.', 'hermes') .'</li>\');
										jQuery(\'.topcart_content .total\').remove();
										jQuery(\'.topcart_content .buttons\').remove();
									}
									item_li.remove();
								}
							});
							e.preventDefault();
							return false;
						});';
	wp_add_inline_script( 'temp-js', $remove_cartitem_js );
	
	//sticky header
	if(isset($hermes_opt['sticky_header']) && $hermes_opt['sticky_header']){
		$sticky_header_js = '
			jQuery(document).ready(function($){
				$(window).scroll(function() {
					var start = $(".header-container > .top-bar").outerHeight() + 10;
					' . ((is_admin_bar_showing()) ? '$(".header-container > .header").addClass("has_admin");':'') . '
					if ($(this).scrollTop() > start){  
						$(".header-container > .header").addClass("sticky");
					}
					else{
						$(".header-container > .header").removeClass("sticky");
					}
				});
			});';
		wp_add_inline_script( 'temp-js', $sticky_header_js );
	}
}
add_action( 'wp_enqueue_scripts', 'hermes_register_script' );

//Hermes theme gennerate title
function hermes_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() ) return $title;
	
	$title .= get_bloginfo( 'name', 'display' );
	
	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( esc_html__( 'Page %s', 'hermes' ), max( $paged, $page ) );
	
	return $title;
}

add_filter( 'wp_title', 'hermes_wp_title', 10, 2 );

// add favicon to header
add_action( 'wp_head', 'hermes_wp_custom_head', 100);
function hermes_wp_custom_head(){
	global $hermes_opt;
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if(isset($hermes_opt['opt-favicon']) && $hermes_opt['opt-favicon']!="") { 
			if(is_ssl()){
				$hermes_opt['opt-favicon'] = str_replace('http:', 'https:', $hermes_opt['opt-favicon']);
			}
		?>
			<link rel="icon" type="image/png" href="<?php echo esc_url($hermes_opt['opt-favicon']['url']);?>" />
		<?php }
	}
}

// body class for wow scroll script
add_filter('body_class', 'hermes_effect_scroll');

function hermes_effect_scroll($classes){
	$classes[] = 'hermes-animate-scroll';
	return $classes;
}
?>