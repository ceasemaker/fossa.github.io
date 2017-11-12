<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Hermes_Themes
 * @since Hermes Themes 1.4.6
 */
?>
<?php 
$hermes_opt = get_option( 'hermes_opt' );
$ft_col_class = '';
?>
	<div class="footer layout5">
		
		<?php if(isset($hermes_opt)) { ?>
		<div class="footer-top">
			<div class="container">
				<div class="row">
					
					<?php if(isset($hermes_opt['about_us']) && $hermes_opt['about_us']!=''){ ?>
						<div class="col-md-4 col-sm-6">
							<div class="widget widget_contact_us">
							
							<?php echo wp_kses($hermes_opt['about_us'], array(
									'a' => array(
								'href' => array(),
								'title' => array()
								),
								'div' => array(
									'class' => array(),
								),
								'img' => array(
									'src' => array(),
									'alt' => array()
								),
								'h3' => array(
									'class' => array(),
								),
								'ul' => array(),
								'li' => array(),
								'i' => array(
									'class' => array()
								),
								'br' => array(),
								'em' => array(),
								'strong' => array(),
								'p' => array(),
								)); ?>
							</div>
						</div>
					<?php } ?>
			
					<?php
					if( !empty($hermes_opt['footer_menu1']) ) {
						$menu1_object = wp_get_nav_menu_object( $hermes_opt['footer_menu1'] );
						$menu1_args = array(
							'menu_class'      => 'nav_menu',
							'menu'         => $hermes_opt['footer_menu1'],
						);
						if (is_object($menu1_object)) {
						?>
						<div class="col-sm-6  col-md-2">
							<div class="widget widget_menu">
								<h3 class="widget-title"><?php echo esc_html($menu1_object->name); ?></h3>
								<?php wp_nav_menu( $menu1_args ); ?>
							</div>
						</div>
					<?php }
					}
					if( !empty($hermes_opt['footer_menu2']) ) {
						$menu2_object = wp_get_nav_menu_object( $hermes_opt['footer_menu2'] );
						$menu2_args = array(
							'menu_class'      => 'nav_menu',
							'menu'         => $hermes_opt['footer_menu2'],
						);
						if (is_object($menu2_object)) {
						?>
						<div class="col-sm-6  col-md-2">
							<div class="widget widget_menu">
								<h3 class="widget-title"><?php echo esc_html($menu2_object->name); ?></h3>
								<?php wp_nav_menu( $menu2_args ); ?>
							</div>
						</div>
						<?php } ?>
					<?php } ?>
					<?php if(!empty($hermes_opt['newsletter_form4'])){ ?>
						<div class="col-sm-6  col-md-4">
							<?php if(!empty($hermes_opt['newletter_title'])){ ?>
								<h3 class="newletter-title"><?php echo esc_html($hermes_opt['newletter_title']); ?></h3>
							<?php } ?>
							
								<div class="newletter-form-wrapper">
								<?php 
									$short_code = (!empty($hermes_opt['use_mailchimp_form'])) ? 'mc4wp_form' : 'wysija_form';
									echo do_shortcode('['. $short_code .' id="'. intval($hermes_opt['newsletter_form']) .'"]'); 
								?>
								</div>
							
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<?php if( !empty($hermes_opt['footer_menu4']) ) {
						$menu4_object = wp_get_nav_menu_object( $hermes_opt['footer_menu4'] );
						$menu4_args = array(
							'menu_class'      => 'nav_menu',
							'menu'         => $hermes_opt['footer_menu4'],
						);
						if (is_object($menu4_object)) {
						?>
						<div class="col-sm-6 col-md-6">
							<div class="widget widget_menu">
								<?php wp_nav_menu( $menu4_args ); ?>
							</div>
						</div>
						<?php } ?>
					<?php } ?>
					<div class="col-sm-6">
						<div class="widget-copyright">
							<?php 
							if( isset($hermes_opt['copyright']) && $hermes_opt['copyright']!='' ) {
								echo wp_kses($hermes_opt['copyright'], array(
									'a' => array(
										'href' => array(),
										'title' => array()
									),
									'br' => array(),
									'em' => array(),
									'strong' => array(),
								));
							} else {
								echo 'Copyright <a href="'.esc_url( home_url( '/' ) ).'">'.get_bloginfo('name').'</a> '.date('Y').'. All Rights Reserved';
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>