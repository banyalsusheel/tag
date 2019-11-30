	<div class="grid-col-1 grid-col-checkout">
	
	<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

		<?php //do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div id="customer_address_details">
			<?php do_action( 'woocommerce_checkout_billing' ); ?>
			<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			
		</div>

		<?php //do_action( 'woocommerce_checkout_after_customer_details' ); ?>

		
	<?php endif; ?>
	</div>
	
	<div class="grid-col-2 grid-col-checkout">
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
		
			
		<div  id="express-one-page-order-payment" class="order-payment">
			<h3 class="border_html" id="order_payment_heading"><?php esc_html_e( 'Payment method', 'cclw' ); ?></h3>
			<?php //do_action( 'woocommerce_checkout_after_order_review' ); ?>
			<?php include_once CCLW_PLUGIN_DIR . '/WooCommerce/checkout/select-payment.php';?>
		</div>
	</div>
	<div class="grid-col-3 grid-col-checkout">
	    <div id="express-one-page-order-review" class="order-review">
			<h3 class="border_html"><?php esc_html_e( 'Order Summary', 'cclw' ); ?></h3>
		<p class="subtitle">Review and confirm your order here</p>
			<div id="order_review" class="woocommerce-checkout-review-order">
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				<?php  //woocommerce_checkout_payment(); ?>
			</div>
		</div>
		
	</div>