<?php
/*serch result temmplate*/?>
<?php $layout = 'grid';?>
<ul id="advance_search_products" class="advance_search_products_<?php echo $layout;?>">
				<?php
			 while( $the_query->have_posts() ): $the_query->the_post(); 
			 $product_id[] = get_the_id();
			 ?>
			
		
			<li <?php wc_product_class(); ?>>
			<div class="search_results_block">
				<div class="advance_search_img sec_1">
				<?php woocommerce_template_loop_product_thumbnail();?>
				</div>
				<div class="advance_search_description sec_2">
				<?php woocommerce_template_loop_product_title();
						woocommerce_template_loop_rating();
						woocommerce_template_loop_price();
				?>
				</div>
				
				<div class="advance_search_buy sec_3">
				<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
            </div>			
			</li>
			
		<?php	 endwhile;	 ?>
</ul>
