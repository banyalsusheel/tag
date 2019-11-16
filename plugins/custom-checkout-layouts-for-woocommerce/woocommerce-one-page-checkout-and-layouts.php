<?php
/**
Plugin Name: Woocommerce one page checkout and layouts
Description: This plugin is designed to Combine Cart and Checkout process which gives users a faster checkout experience, with less interruption.
Author: coolcoders
Version: 1.5
License: GPL v2

Text Domain: cclw
*/

if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'CCLW_VERSION', '1.5' );
define('CCLW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define('CCLW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

if( !class_exists( 'CclwCheckout' ) ) 
{
	class CclwCheckout 
	{
		
		function __construct()  
		{
		
		add_action( 'plugins_loaded',array($this,'cclw_verify_woocommerce_installed'));
		if ( file_exists( CCLW_PLUGIN_DIR . '/cmb2/init.php' ) ) {
            require_once CCLW_PLUGIN_DIR . '/cmb2/init.php';
			require_once CCLW_PLUGIN_DIR . '/cmb2-fontawesome-picker.php';
            }
		add_action( 'cmb2_admin_init',array($this,'cclw_custom_checkout_panel')) ;	
		add_action( 'wp_enqueue_scripts',array($this,'cclw_register_plugin_styles'));
		add_filter( 'woocommerce_locate_template',array($this,'cclw_adon_plugin_template'), 1, 3 );
		add_filter ('woocommerce_checkout_cart_item_quantity',array($this,'cclw_add_quantity'), 10, 2 );
		add_action( 'wp_footer',array($this,'cclw_add_js'));
		add_action( 'init',array($this,'cclw_load_ajax'));
		add_filter( 'gettext',array($this,'cclw_text_strings'), 20, 3 );
		add_action( "cmb2_save_field_cclw_overide_checkout",array($this,'cclw_action_cmb2_save_field_field_id'), 10, 3 );
		
		/*redirect to checkout page*/
		add_action( 'template_redirect',array($this,'cclw_redirect_to_checkout_if_cart'));
		add_action('wp_ajax_cclw_product_data_fetch' , array($this,'cclw_product_data_fetch'));
		add_action('wp_ajax_nopriv_cclw_product_data_fetch',array($this,'cclw_product_data_fetch'));
		add_action( 'admin_enqueue_scripts', array( $this, 'cclw_setup_admin_scripts' ) );
     	add_action( 'cmb2_before_form', array( $this, 'cclw_before_form' ), 10, 4 );
		add_filter( 'woocommerce_checkout_fields',array($this,'cclw_customize_billing_details'),9999);
		}
		
		/*Check if woocommerce is installed*/
		function cclw_verify_woocommerce_installed() {
			if ( ! class_exists( 'WooCommerce' )) {
				add_action( 'admin_notices',array($this,'cclw_show_woocommerce_error_message'));
			}
			
		}
    
		function cclw_show_woocommerce_error_message() {
			if ( current_user_can( 'activate_plugins' ) ) {
				$url = 'plugin-install.php?s=woocommerce&tab=search&type=term';
				$title = __( 'WooCommerce', 'woocommerce' );
				echo '<div class="error"><p>' . sprintf( esc_html( __( 'To begin using "%s" , please install the latest version of %s%s%s and add some product.', 'cclw' ) ), 'Custom Checkout Layouts WooCommerce', '<a href="' . esc_url( admin_url( $url ) ) . '" title="' . esc_attr( $title ) . '">', 'WooCommerce', '</a>' ) . '</p></div>';
			}
		}
		
		/*register admin section*/
        function cclw_setup_admin_scripts() {
            wp_register_style( 'cclw-tabs-admin',CCLW_PLUGIN_URL.'asserts/css/tabs.css',array(), CCLW_VERSION);
			
			wp_enqueue_style('cclw-tabs-admin');	
			wp_enqueue_script('cclw_tabs_js',CCLW_PLUGIN_URL.'asserts/js/tabs.js', array('jquery'),CCLW_VERSION, true);		

        }
		function cclw_before_form( $cmb_id, $object_id, $object_type, $cmb ) {
            if( $cmb->prop( 'tabs' ) && is_array( $cmb->prop( 'tabs' ) ) ) : ?>
                <div class="cmb-tabs-wrap cmb-tabs-<?php echo ( ( $cmb->prop( 'vertical_tabs' ) ) ? 'vertical' : 'horizontal' ) ?>">
                    <div class="cmb-tabs">

                        <?php foreach( $cmb->prop( 'tabs' ) as $tab ) :
                            $fields_selector = array();

                            foreach( $tab['fields'] as $tab_field )  :
                                $fields_selector[] = '.' . 'cmb2-id-' . str_replace( '_', '-', sanitize_html_class( $tab_field ) ) . ':not(.cmb2-tab-ignore)';
                            endforeach;

                            $fields_selector = apply_filters( 'cmb2_tabs_tab_fields_selector', $fields_selector, $tab, $cmb_id, $object_id, $object_type, $cmb );
                            $fields_selector = apply_filters( 'cmb2_tabs_tab_' . $tab['id'] . '_fields_selector', $fields_selector, $tab, $cmb_id, $object_id, $object_type, $cmb );
                            ?>

                            <div id="<?php echo $cmb_id . '-tab-' . $tab['id']; ?>" class="cmb-tab" data-fields="<?php echo implode( ', ', $fields_selector ); ?>">

                                <?php if( isset( $tab['icon'] ) && ! empty( $tab['icon'] ) ) :
                                    $tab['icon'] = strpos($tab['icon'], 'dashicons') !== false ? 'dashicons ' . $tab['icon'] : $tab['icon']?>
                                    <span class="cmb-tab-icon"><i class="<?php echo $tab['icon']; ?>"></i></span>
                                <?php endif; ?>

                                <?php if( isset( $tab['title'] ) && ! empty( $tab['title'] ) ) : ?>
                                    <span class="cmb-tab-title"><?php echo $tab['title']; ?></span>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>

                    </div>
            <?php endif;
        }




		/**
		* Register style sheet.
		*/
		function cclw_register_plugin_styles() {
		wp_register_style( 'custom-checkout-css', CCLW_PLUGIN_URL .'asserts/css/custom-checkout.css', array(), CCLW_VERSION );
	
		wp_enqueue_style( 'custom-checkout-css' );
		
 
		}
		/* custom checkout setting page  */
		function cclw_custom_checkout_panel() {

			 require_once CCLW_PLUGIN_DIR . 'includes/admin/setting_panel.php';

		} 

		/*Locate new woocommerce setting folder */
		function cclw_adon_plugin_template( $template, $template_name, $template_path ) {
			 global $woocommerce;
			 $_template = $template;
			 if ( ! $template_path ) 
				$template_path = $woocommerce->template_url;

			 $plugin_path  = untrailingslashit( plugin_dir_path( __FILE__ ) )  . '/WooCommerce/';


			$template = locate_template(
			array(
			  $template_path . $template_name,
			  $template_name
			)
			);

			if( ! $template && file_exists( $plugin_path . $template_name ) )
			$template = $plugin_path . $template_name;

			if ( ! $template )
			$template = $_template;

			return $template;
			}
           /*folder rename if option selected*/
		   function cclw_action_cmb2_save_field_field_id( $updated, $action, $instance ) { 
		
		
		    $checkop = cmb2_get_option( 'custom_checkout_settings', 'cclw_overide_checkout');
			$filename = get_template_directory().'/woocommerce/checkout';
			echo $to_rename  = cmb2_get_option('overide_checkout');
		

			if($checkop != '' && $checkop == 'on')
			{
				$old_name  = $filename;
				$new_name  = $filename.'-test';
				if  (file_exists($filename)) {
				rename( $old_name, $new_name);	
				}
			}
			else
			{
				$folder  = get_template_directory().'/woocommerce/checkout-test';
				$newfolder = get_template_directory().'/woocommerce/checkout';
				if  (file_exists($folder)) {
				rename( $folder, $newfolder);	
				}

			}
		
		}
          /*set product quantity*/ 
		
	   
		    function cclw_add_quantity( $cart_item, $cart_item_key ) {
				   $product_quantity= '';
				   return $product_quantity;
			}
				
		/**add some footer js*/		
		
     	
            function cclw_add_js(){
			?>
			<?php 
			$checkout_setting = get_option( 'custom_checkout_settings' ); 
			?>
            <style>
			:root {
			--main-bg-color: <?php echo $checkout_setting['cclw_heading_background']?>;  
			--main-bor-color: <?php echo $checkout_setting['cclw_heading_border']?>;
			--main-bor-text-color: <?php echo $checkout_setting['cclw_heading_text_color']?>;
			--main-button-color: <?php echo $checkout_setting['cclw_button_color']?>;
			--main-buttontext-color: <?php echo $checkout_setting['cclw_buttontext_color']?>;

			} 
            </style>
			<?php
				
    	    $admin_url = get_admin_url();
			   
            if (  is_checkout() ) {
				
            ?>
                <script type="text/javascript">
									
					jQuery("#ship-to-different-address-checkbox").on("click", function() {
					jQuery( ".woocommerce-shipping-fields h3" ).removeClass( "onclick_border" );
					jQuery( ".woocommerce-shipping-fields h3" ).addClass( "border_html" );
					});

				
				   jQuery("#cclw_search").on("click", function(){
					   
					   jQuery(".cclw_search_meta img.loading_results").show();
                       
                        var data = {
                    		action: 'cclw_product_data_fetch',
                    		keyword: jQuery('#cclw_keyword_search').val()
                    	};
						
						
                    	jQuery.post( '<?php echo $admin_url; ?>' + 'admin-ajax.php', data, function( data )
                		{
							//alert(data);
							jQuery("#cclw_search_results").show();
							jQuery(".cclw_search_meta img.loading_results").hide();
							jQuery('#cclw_search_results .search_result_products').html();
							jQuery('#cclw_search_results .search_result_products').html( data );
							jQuery("#cclw_search_results ul#advance_search_products li").slice(0, 4).show();
							
							
                        });
						
						jQuery("#loadMore").on('click', function (e) {
						e.preventDefault();
						jQuery("#cclw_search_results  ul#advance_search_products li:hidden").slice(0, 4).slideDown();
					    if (jQuery("#cclw_search_results  ul#advance_search_products li:hidden").length == 0) {
							jQuery("#loadMore").fadeOut('slow');
						
						}  
						});  
                   
				   });
				
	
					jQuery("form.checkout #order_review").on("change", "input.qty", function(){
                       
                        var data = {
                    		action: 'cclw_update_order_review',
                    		security: wc_checkout_params.update_order_review_nonce,
                    		post_data: jQuery( 'form.checkout' ).serialize()
                    	};
						
                    	jQuery.post( '<?php echo $admin_url; ?>' + 'admin-ajax.php', data, function( response )
                		{
                            jQuery( 'body' ).trigger( 'update_checkout' );
						});
                    });
					
					jQuery( document.body ).on( 'added_to_cart', function(){
                        jQuery( 'body' ).trigger( 'update_checkout' );
                    });
					
					jQuery( document.body ).on( 'updated_checkout', function(){
						//re-do your jquery
						var my_shipping = jQuery('#cclw_review_shipping').html();
						jQuery('#cclw_shipping').html();
						jQuery('#cclw_shipping').html(my_shipping);
						jQuery('#cclw_review_shipping').hide();
						
						
					});
									
                </script>
             <?php  
             }
        }
		
		
        /*wocommerce billing fields*/
			function cclw_customize_billing_details( $fields ) {
			    //print_r($fields);
				// first name can be changed with woocommerce_default_address_fields as well
				unset( $fields['billing']['billing_company'] );
				
				$fields['billing']['billing_address_1']['label'] = '';
				$fields['billing']['billing_address_1']['label'] = 'Address';
				$fields['billing']['billing_city']['placeholder'] = 'Town / City';
				$fields['billing']['billing_city']['label'] = '';
				$fields['billing']['billing_state']['placeholder'] = 'Select any State / County';
				$fields['billing']['billing_state']['label'] = '';
				$fields['billing']['billing_email']['priority'] = 25;
				$fields['billing']['billing_email']['label'] = '';
				$fields['billing']['billing_email']['placeholder'] = 'Email Address ';
				
				
			 
				return $fields;
			 
			}
		
        /*starts ajax*/
        function cclw_load_ajax() {
        
            if ( !is_user_logged_in() ){
                add_action( 'wp_ajax_nopriv_cclw_update_order_review',array($this,'cclw_update_order_review'));
            } else{
                add_action( 'wp_ajax_cclw_update_order_review',array($this,'cclw_update_order_review'));
            }
        
        }
        
        function cclw_update_order_review() {
             
            $values = array();
            parse_str($_POST['post_data'], $values);
            $cart = $values['cart'];
            foreach ( $cart as $cart_key => $cart_value ){
                WC()->cart->set_quantity( $cart_key, $cart_value['qty'], false );
                WC()->cart->calculate_totals();
                woocommerce_cart_totals();
            }
            exit;
        }
		/*replace add to cart content*/
		function cclw_text_strings( $translated_text, $text, $domain ) {
		$checkout_text = get_option( 'custom_checkout_settings' ); 
		
		if(isset($checkout_text['cclw_addtocart']) && $checkout_text['cclw_addtocart'] !='')
		{
		 $addtocart = $checkout_text['cclw_addtocart'];
		 $translated_text = str_ireplace( 'Add to cart', $addtocart, $translated_text );	
		}
		if(isset($checkout_text['cclw_viewcart']) && $checkout_text['cclw_viewcart'] !='')
		{
		 $viewcart = $checkout_text['cclw_viewcart'];
		 $translated_text = str_ireplace( 'View cart', $viewcart, $translated_text );
		}
		if(isset($checkout_text['cclw_placeorder']) && $checkout_text['cclw_placeorder'] !='')
		{
		 $placeorder = $checkout_text['cclw_placeorder'];
		 $translated_text = str_ireplace( 'Place order', $placeorder, $translated_text );
		}
		if(isset($checkout_text['cclw_continueshop']) && $checkout_text['cclw_continueshop'] !='')
		{
		 $cont_shop = $checkout_text['cclw_continueshop'];
		 $translated_text = str_ireplace( 'Continue shopping', $cont_shop, $translated_text );
		}
		

		
		return $translated_text;
		}
		
		function cclw_redirect_to_checkout_if_cart() {
			global $woocommerce;
			$checkout_setting = get_option( 'custom_checkout_settings' ); 
			if ( is_cart() && WC()->cart->get_cart_contents_count() > 0 && $checkout_setting['cclw_skip_cart'] =='yes')
			{
			
			// Redirect to check out url
			wp_redirect( $woocommerce->cart->get_checkout_url(), '301' );
			exit;
			}
			
		}
		
		
		function cclw_product_data_fetch(){

			$the_query = new WP_Query( array( 'posts_per_page' => -1, 's' => esc_attr( $_POST['keyword'] ), 'post_type' => 'product' ) );
			

			if( $the_query->have_posts() ) 
			{
					
			include_once(dirname( __FILE__ ) .'/includes/front/search_result.php');
						
			wp_reset_postdata();  

			}
			else
			{
			echo "<div class='no_results'>Sorry, No products found for '".$_POST['keyword']."'.Search by other keywords</div>";
			} 
		die();
		}
		
		 public static function cclw_myplugin_deactivate() {
			update_option( 'overide_checkout', 0 );
						
			$filename = get_template_directory().'/woocommerce/checkout-test';
			$new_name  =  get_template_directory().'/woocommerce/checkout';
					if  (file_exists($filename)) {
					rename( $filename, $new_name);	
					}
		}
     
		
	
	}// end of class
}// end of if class
register_deactivation_hook(__FILE__, array('CclwCheckout', 'cclw_myplugin_deactivate'));

$CclwCheckout_obj = new CclwCheckout();   