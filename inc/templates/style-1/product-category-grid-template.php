<div class="anant-product-category-grid-wrapper">
	<?php 
	foreach ( $categories_list as $key => $category ) {
		if ($key === 6 ) { break; }  
		if ($category == false || $category == NULL ) { continue; }    ?>
		<?php 
		$cat_thumb_id   = get_term_meta( $category->term_id, 'thumbnail_id', true );
		$cat_thumb_url  = wp_get_attachment_thumb_url( $cat_thumb_id );
		$term_link      = get_term_link( $category, 'product_cat' );
		$category_name  = $category->name;
		$category_count = $category->count;
		if($template_style == 'one'){
		?>
		<div class="ant-product-cate one <?php echo esc_attr($this->product_cat_card_class) ;?>">
				<div class="ant-product-thumb <?php echo esc_attr($this->product_cat_img) ;?>">
					<a class="ant_img" href="<?php echo esc_url($term_link); ?>">
					<?php
					if ( $settings['display_image']  ) {
						$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src( $cat_thumb_id, 'thumbnail_size', $settings );
						if($image_src !== ''){
							echo sprintf( '<img src="%s" title="%s" alt="%s"%s />', esc_attr( $image_src ), esc_attr(get_the_title( $cat_thumb_id )), esc_attr(anant_get_attachment_alt( $cat_thumb_id )), '' );
						}
					}
					?>
					</a>
				</div>
			<div class="ant_title <?php echo esc_attr($this->product_cat_title) ;?>">
			<?php
			if ( $settings['display_title']) { ?>
			<h2 class="title">
				<a href="<?php echo esc_url($term_link); ?>">
					<?php
						echo esc_html($category_name);
					?>
				</a>
			</h2>
			<?php
			}?>
			<?php
			if ($template_style != 'three') {
				if ( $settings['display_category_count'] ) {
					if( $category_count <= 1) {
						echo '<span class="anant-category-count">' . esc_html($category_count) . ' item</span>';
					} else {
						echo '<span class="anant-category-count">' . esc_html($category_count) . ' items</span>';
					} 
				}
			} ?>
			</div>
		</div>
		<?php
		}
	}
	?>
</div>