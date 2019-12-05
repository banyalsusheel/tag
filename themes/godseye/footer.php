<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

;?> 

	</div><!-- #content -->
		<footer class="site-footer" style="    float: left;    width: 100%;">
			<div class="footer-widgets">
				<div class="container">
					<div class="row">
						<div class="col-sm-4">
							<div class="foot-contact">
								<?php get_template_part('template-parts/footer/footer', 'widgets');?>
							</div><!-- .foot-contact -->
						</div><!-- .col -->
						<div class="col-sm-4">
							<div class="foot-contact">
							<h2 class="widget-title">Twitter Feed</h2>
								<?php echo do_shortcode('[custom-twitter-feeds num=2 exclude="retweeter,actions,linkbox,twitterlink" include="author,date,text,avatar"]')?>	
							</div><!-- .foot-contact -->
						</div><!-- .col -->

						<div class="col-sm-4">
							<div class="foot-contact">
							<h2 class="widget-title">Important Links</h2>
								
								
							<?php if ( has_nav_menu( 'footer-menu' ) ) : ?>
								<?php 
									$defaults = array( 'container' => '', 'menu_class' => 'links', 'menu_id' => 'footer-menu', 'theme_location' => 'footer-menu' );
									wp_nav_menu($defaults); 
								?>
							<?php endif; ?>

							</div><!-- .foot-contact -->
						</div><!-- .col -->


					</div><!-- .row -->
					<div class="text-center">
						<?php get_template_part('template-parts/footer/site', 'info');?>
					</div>
				</div><!-- .container -->
			</div> 
			<!-- .footer-widgets -->

		</footer><!-- .site-footer -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<!-- <script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/js/jquery.js"></script> -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/swiper.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/custom.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<?php wp_footer();?>

</body>
</html>
