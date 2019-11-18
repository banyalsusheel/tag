<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">


	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/swiper.min.css">
	<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'twentyseventeen' ); ?></a>

	<header class="site-header">
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                           <a class="d-block" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img class="d-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo-god.png" alt="logo" width=200 height=44></a>
                        </div><!-- .site-branding -->

						<?php if (has_nav_menu('top')): ?>
							<nav class="site-navigation d-flex justify-content-end align-items-center">
								<?php $defaults = array('container' => 'ul', 'menu_class' => 'd-flex flex-column flex-lg-row justify-content-lg-end align-content-center', 'menu_id' => 'top-menu', 'theme_location' => 'top');
									wp_nav_menu($defaults);
								?>
								<a href="<?php echo get_permalink( 10 )?>" class="btn gradient-bg justify-content-lg-end btn-hide" title="Buy Fastag">Buy Fastag</a>
							</nav>
						<?php endif;?>

                        
						<a href="<?php echo get_permalink( 10 )?>" class="btn gradient-bg justify-content-lg-end d-lg-none btn-absolute" title="Buy Fastag">Buy Fastag</a>
                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div><!-- .hamburger-menu -->
                    </div><!-- .col -->
                </div><!-- .row -->
            </div><!-- .container -->
        </div><!-- .nav-bar -->
	</header><!-- .site-header -->
	
	<!-- Closed in footer -->
	<div class="site-content-contain">
		<div id="content" class="site-content">
