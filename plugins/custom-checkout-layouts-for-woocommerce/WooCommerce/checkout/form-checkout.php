<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

//do_action( 'woocommerce_before_checkout_form', $checkout );
woocommerce_checkout_login_form(); 


// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'cclw' ) );
	return;
}

// filter hook for include new pages inside the payment method
?>
<?php 
$searchoption =  cmb2_get_option( 'custom_checkout_settings','cclw_product_search');
$layout = cmb2_get_option( 'custom_checkout_settings','cclw_checkout_layouts');
if($layout == '')
{
$layout = 'three-column-layout';	
}
if($searchoption != '' && $searchoption == 'on')
		{
			$display = 'block';
		}
else
{
	$display = 'none';
}	

?>
<div class="cclw_search_bar" style="display:<?php echo $display;?>">

<h3 style="font-size:14px;color: #555555;">Want To Shop More?</h3>
<div class="cclw_search_meta"><input type="text" name="cclw_keyword_search" id="cclw_keyword_search" placeholder="Search Product Name keywords">
<button name="cclw_search" id="cclw_search" class="button cclw_button">Search</button>
<img class="loading_results" src="<?php echo CCLW_PLUGIN_URL; ?>asserts/images/loading.gif" style="width:24px;height:24px;display:none;">
</div>
<div id="cclw_search_results" style="display:none;">
<div class="search_result_products"></div>
<div id="loadMore" class="cclw_button button" >Load More</div>
</div>

</div>
<?php $get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', wc_get_checkout_url()); ?>


<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">
<div class="express-one-page-checkout-main checkout-<?php echo $layout;?>">
  
  <?php 

  include_once(dirname( __FILE__ ) .'/layouts/'.$layout.'.php');  
  ?>
  
</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
