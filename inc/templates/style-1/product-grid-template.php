<?php
if ( !$products ) {
	$products = wc_get_products( $args );
}

$first_tab_id = '';

if($swiper_div_tabs && count($swiper_div_tabs) > 0) {
	$first_tab_id = reset($swiper_div_tabs);
}

echo '<div ' . esc_attr($this->get_render_attribute_string( 'wrapper' )) . '>';

	$class = 'anant_product_wrapper anant-product-grid-wrapper '. 'anant-'.$this->get_id(). ' ' . $category_class . ' ';
	if ( $counter === 0  ) {
		$class .= " category-active";
	} else {
		$class .= " category-hide";
	}

	if ( $hide === true ) {
		$class .= ' anant_hide';
	}

	$wishlist_url = get_option('wishlist_template_select');
	$wishlist_url = get_permalink($wishlist_url);
	if($wishlist_url == false || $wishlist_url == 0 ){
		$wishlist_url = home_url();
	}

	if ( $products ) { ?>
		<div class="<?php echo esc_attr($class) ?>" data-first_tab_id="<?php echo esc_attr($first_tab_id) ?>">
			<?php
			foreach ($products as $product) {
				$product_id = $product->get_id();
				$terms = get_the_terms( $product_id , 'product_cat' );
				if ($only_on_sale && !in_array($product_id, $on_sales_ids, true)) {
					continue;
				}

				if ( $only_best_sale && $product->get_total_sales() < $best_sale_count) {
					continue;
				}

				if ( $is_best_rated && $product->get_average_rating() < $best_rated_count ) {
					continue;
				}

				$thumbnail_id = $product->get_image_id();
				?>
					<div class="anant-single-grid-product <?php echo esc_attr('anant-tabs-'.$this->get_id()) ?>
						<?php if ( ! $thumbnail_id ) { echo 'anant-no-grid-product-image';} ?>"
							data-swiper_div_tabs="<?php
							if($swiper_div_tabs && count($swiper_div_tabs) > 0) {
								if ( !empty( $terms ) ) {
									foreach ( $terms as $term ) {
										if ( array_key_exists($term->term_id, $swiper_div_tabs)){
											echo esc_attr($swiper_div_tabs[$term->term_id]);
										}
									}
								}
							}
						?>"
					>
					<?php 
						$template_style = $this->get_settings_for_display()['template_style'];
						$template_path = ANANT_PATH . 'inc/templates/product-items/';

						switch ($template_style) {
							case 'layout_1':
								require $template_path. 'layout-1.php';
								break;
						} 
					?>			
					</div>
				<?php 
			} ?>
			<div class="ant-add-card-massage">
				<div class="inner">
					<div class="massage-text">
						<i class="fas fa-info-circle"></i>
						<h6>This Product Has Been Added To wishlist.</h6>
					</div>
					<a href="<?php echo esc_attr($wishlist_url); ?>" class="to-cart">View Wishlist</a>
				</div>
			</div>  
		</div>
		<?php
	} else {
		// echo "No Products Found!";
	}

echo '</div>';