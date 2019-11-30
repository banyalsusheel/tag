<div class="two-column-layout-left">
	<div id="customer_address_details">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				
	</div>

	
	
	<div  id="express-one-page-order-payment" class="order-payment">
		<h3 class="border_html" id="order_payment_heading"><?php esc_html_e( 'Payment method', 'cclw' ); ?></h3>
		<?php //do_action( 'woocommerce_checkout_after_order_review' ); ?>
		<?php include_once CCLW_PLUGIN_DIR . '/WooCommerce/checkout/select-payment.php';?>
	</div>
	


</div>
<div class="two-column-layout-right">
    <div class="shipping_section">
	  <?php if(WC()->cart->needs_shipping())
		{
			?>
	    <div class="express-one-page-order-shipping">
				
			<h3 class="border_html"><?php esc_html_e( 'Shipping method', 'cclw' ); ?></h3>
			<div id="cclw_shipping"></div>
		</div>
		<?php
		}	
       	?>
		
	</div>
	<div id="express-one-page-order-review" class="order-review">
				<h3 class="border_html"><?php esc_html_e( 'Order Summary', 'cclw' ); ?></h3>
				<p class="subtitle">
				<?php
					$url = wc_get_cart_url();

					printf('Confirm the last time to your order, You can change it here', 'cclw');
				
				?></p>
				<?php //do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				
				</div>
	</div>
	

</div>