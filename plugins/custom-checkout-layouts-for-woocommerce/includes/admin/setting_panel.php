<?php 
$prefix = 'cclw_';

			$cclw_panel = new_cmb2_box( array(
			'id'            => $prefix . 'custom_checkout',
			'title'         => __( 'Checkout Layouts', 'cclw' ),
			'object_types' => array( 'options-page' ),
			'option_key'      => 'custom_checkout_settings', 
		     'parent_slug'     => 'woocommerce',
			
			'vertical_tabs' => false, // Set vertical tabs, default false
			'tabs' => array(
				array(
					'id'    => $prefix .'general_settings',
					'title' => 'General Settings',
					'fields' => array(
					    $prefix .'checkout_layouts',
						$prefix . 'overide_checkout',
						$prefix . 'product_search',
						$prefix . 'skip_cart',
						
						
					),
				),
				
				
				array(
					'id'    => $prefix .'color_panel',
					'title' => 'Color Panel',
					'fields' => array(
					    $prefix . 'colorheader',
						$prefix . 'heading_background',
						$prefix . 'heading_border',
						$prefix . 'heading_text_color',						
						$prefix . 'button_color',
						$prefix . 'buttontext_color',
					),
				),
				array(
					'id'    => $prefix .'replace_text',
					'title' => 'Replace Text',
					'fields' => array(
					    $prefix . 'replacetext',
						$prefix . 'addtocart',
						$prefix . 'viewcart',
						$prefix . 'placeorder',
						$prefix . 'continueshop',
											
					),
				),
			) 
			) );

			/*general setting panel*/		
			$cclw_panel->add_field( array(
				'name'             => 'Checkout Page Layouts',
				'desc'             => 'Select diffrent layouts for checkout page.',
				'id'               => $prefix .'checkout_layouts',
				'type'             => 'select',
				'show_option_none' => false,
				'default'          => 'three-column-layout',
				'options'          => array(
					'three-column-layout' => __( '3 Column Layout', 'cmb2' ),
					'two-column-layout'   => __( '2 Column Layout', 'cmb2' ),
				),
			) );
			
			$cclw_panel->add_field( array(
			'name' => __('Overide Default Design','cclw'),
			'desc' => 'Click here to overide the default design from theme',
			'id'            => $prefix .'overide_checkout',
			'type' => 'checkbox',
			) );
            
            $cclw_panel->add_field( array(
			'name' => __('Show Search Bar','cclw'),
			'desc' => 'Search bar to find products by keywords on checkout page',
			'id'            => $prefix .'product_search',
			'type' => 'checkbox',
			) );
			
			$cclw_panel->add_field( array(
			'name'    => 'Skip Cart Page',
			'desc' => 'Recommended "yes". We recommend to skip cart page to shorten the checkout process .',
			'id'      => $prefix .'skip_cart',
			'type'    => 'radio_inline',
			'options' => array(
			'yes' => __( 'Yes', 'cmb2' ),
			'no'   => __( 'No', 'cmb2' ),
			),
			'default' => 'yes',
			) );
 			
			/*color panel*/		
			
			$cclw_panel->add_field( array(
				//'name' => 'Select colors for checkout page to match your theme Color settings ',
				'desc' => "Select colors for checkout page to match your theme's Color settings",
				'type' => 'title',
				'id'   => $prefix . 'colorheader',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Header Background Color', 'cclw' ),
			'desc' => 'Select a background color for headers i.e like "Billing section"',
			'id'            => $prefix . 'heading_background',
			'type'    => 'colorpicker',
	         'default' => '#fafafa',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Header Border Color', 'cclw' ),
			'desc' => 'Select a Border color for headers i.e like "Billing section"',
			'id'            => $prefix . 'heading_border',
			'type'    => 'colorpicker',
	         'default' => '#1e85be',
			) );
			$cclw_panel->add_field( array(
			'name'          => __( 'Header Text Color', 'cclw' ),
			'desc' => 'Select a text color for header content i.e  "Billing section"',
			'id'            => $prefix . 'heading_text_color',
			'type'    => 'colorpicker',
	         'default' => '#000000',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Button Color', 'cclw' ),
			'desc' => 'Select a color for buttons i.e like "Place order or Apply coupon"',
			'id'            => $prefix . 'button_color',
			'type'    => 'colorpicker',
	         'default' => '#1e85be',
			) );
			
			$cclw_panel->add_field( array(
			'name'          => __( 'Button Text Color', 'cclw' ),
			'desc' => 'Select a color for text on buttons',
			'id'            => $prefix . 'buttontext_color',
			'type'    => 'colorpicker',
	         'default' => '#fff',
			) );
			
			/*Replace text*/
			$cclw_panel->add_field( array(
				//'name' => 'Replace Some Common Woocommerce Strings to Desired Names',
				'desc' => 'Replace Some Common Woocommerce text(strings) to Desired Names',
				'type' => 'title',
				'id'   => $prefix . 'replacetext',
			) );	
			
			$cclw_panel->add_field( array(
				'name' => 'Add to cart',
				'desc' => 'Replace "Add to cart" with ....',
				'type' => 'text',
				'id'   => $prefix . 'addtocart',
				'attributes'  => array(
					'placeholder' => 'For Example :- Add to Basket',
					
				),
				
			) );    
            
			$cclw_panel->add_field( array(
				'name' => 'View cart',
				'desc' => 'Replace "View cart" with checkout (recommended) as every cart link is redirected to checkout page',
				'type' => 'text',
				'id'   => $prefix . 'viewcart',
				'default' => 'Checkout',
				
			) );        
           
		   $cclw_panel->add_field( array(
				'name' => 'Place Order',
				'desc' => 'Replace "Place Order" with ....',
				'type' => 'text',
				'id'   => $prefix . 'placeorder',
				'attributes'  => array(
					'placeholder' => 'For example :- Complete payment',
					
				),
			) );        
            
			$cclw_panel->add_field( array(
				'name' => 'Continue Shopping',
				'desc' => 'Repalce "Continue Shopping" with ....',
				'type' => 'text',
				'id'   => $prefix . 'continueshop',
				'attributes'  => array(
					'placeholder' => 'For example :- Explore More',
					
				),
			) );        
            
  			
            
		

			
			
			?>