<?php if( $product_design == 'card') { ?>
	<!-- anant-product-card -->
	<div class="anant-product-item first <?php echo esc_attr($this->product_class) ?>"> 
		<!-- display image -->
			<div class="anant_thumbnail">
				<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="anant_img <?php echo esc_attr($this->product_img) ?>">
					<?php if ($thumbnail_id) {
						$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $thumbnail_size_key, $settings);
						echo sprintf('<img src="%s" title="%s" alt="%s"%s />', esc_attr($image_src), esc_attr(get_the_title($thumbnail_id)), esc_attr(anant_get_attachment_alt($thumbnail_id)), '');
					} ?>					
				</a> 
				<div class="ant-product-buttons <?php echo esc_attr($this->product_icon) ?>">
					<?php if($show_wishlist_button == true){ ?>
						<a class="wishlist-cls" product-id="<?php echo esc_attr($product->get_id()); ?>"><i class="far fa-heart"></i><span class="ant-tooltip">Add To Wishlist</span></a>
					<?php } ?>
					<?php if($show_quickview_button == true){ ?>
						<a  class="quick-cls" ><i class="far fa-eye"></i><span class="ant-tooltip" data-prod-id="<?php echo esc_attr($product->get_id()); ?>">Quick view</span></a>
					<?php } ?>				 
				</div>
				<?php if (in_array($product_id, $on_sales_ids)) { ?>
					<div class="ant-tag <?php echo esc_attr($this->product_tag) ?>">
						<span>Sale</span>
					</div>
				<?php } ?>
			</div>
		<!-- // display image ends -->
		<!-- content begins  -->
		<div class="anant_product_content">
			
			<div class="anant_title">
			<?php 
				$product_cats = get_the_terms( $product->get_id(), 'product_cat' );
				if($display_category){
					if(empty($selected_cats)){
						if ( $product_cats && ! is_wp_error( $product_cats ) ) {
							foreach ( $product_cats as $category ) {
								echo '<a class="ant-category '.esc_attr($this->product_category).'" href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
							}
						}
					}else{	
						if ( $selected_cats && ! is_wp_error( $selected_cats ) ) {
							foreach ( $selected_cats as $category ) {
								// var_dump($product_categories);
								if (in_multi_array($category, $product_cats)) {
									$category = get_term_by( 'name', $category, 'product_cat' );
									echo '<a class="ant-category '.esc_attr($this->product_category).'" href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
								}
							}
						}
					} } ?>
				<?php if ($display_title === 'yes') { ?>
					<h2 class="title <?php echo esc_attr($this->product_title) ?>"><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_title()); ?></a></h2>
				<?php } ?>
			</div>
		<?php	if ($display_price == 'yes') { ?>
				<div class="anant_price <?php echo esc_attr($this->product_price) ?>">
					<?php echo wp_kses_post( $product->get_price_html() ); ?>
				</div>
			<?php }

			if ($display_rating == 'yes') { ?>
			<div class="anant-rating <?php echo esc_attr($this->product_rating) ?>">
				<?php
				if ('no' !== get_option('woocommerce_enable_review_rating')) {
					$rating_count = $product->get_rating_count();
					$review_count = $product->get_review_count();
					$average      = $product->get_average_rating();
					$product_id   = $product->get_id(); 
					$rating = $average;
					$round_next_rating = round($rating);
					$round_prev_rating = floor($rating);?>
				<div class="anant-rating-icons ">
				<?php 
					if(is_numeric( $rating ) && floor( $rating ) != $rating){
						?><div class="anant-star-rating"><?php
						for ($i = 1; $i <= 5; $i++) {
							if( $i <= $round_prev_rating){
								?><i class="fas fa-star"></i><?php
							}else if($i <= $round_next_rating){
								?><i class="fas fa-star-half-alt"></i><?php
							}else{
								?><i class="far fa-star"></i><?php
							}
						}
						?></div><?php
					}elseif($rating == 0 || $rating == '0' ){
						?><div class="anant-star-rating"><?php
						$num_iterations = 5;
						for ($i = 1; $i <= $num_iterations; $i++) {
							?><i class="far fa-star"></i><?php
						}
						?></div><?php
					}else{
						?><div class="anant-star-rating"><?php
						for ($i = 1; $i <= 5; $i++) {
							if( $i <= $round_next_rating){
								?><i class="fas fa-star"></i><?php
							}else{
								?><i class="far fa-star"></i><?php
							}
						}
						?></div><?php
					} ?> 
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		
		<?php
		// content ends
		// btn cart begins
		if ( $show_cart_button ) { ?>
			<div class="anant_cartbtn">
				<div class="anant-add-to-cart <?php echo esc_attr($this->product_btn) ?>">
				<?php 
					echo sprintf(
						'<a href="%s" data-quantity="1" class="%s" %s>%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr(
							implode(
								' ',
								array_filter(
									[
										'button',
										'product_type_' . $product->get_type(),
										$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
										$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
										'anant_add_to_cart_btn',
									]
								)
							)
						),
						wp_kses(
							wc_implode_html_attributes(
								[
									'data-product_id'  => esc_attr( $product->get_id() ),
									'data-product_sku' => esc_attr( $product->get_sku() ),
									'aria-label'       => esc_attr( $product->add_to_cart_description() ),
									'rel'              => 'nofollow',
								]
							),
							[
								'data-product_id'  => true,
								'data-product_sku' => true,
								'aria-label'       => true,
								'rel'              => true,
							]
						),
						esc_html( $product->add_to_cart_text() )
					);
				?>
				</div>
			</div> 
			<?php } ?>
		</div> 
	</div> 
	<!-- /anant-product-card -->
<?php } elseif( $product_design == 'overlay') { ?>
	<!-- anant-product-overlay -->
	<div class="anant-product-item six <?php echo esc_attr($this->product_class) ?>">
		<!-- display image begins -->
			<div class="anant_thumbnail">
				<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" class="anant_img <?php echo esc_attr($this->product_img) ?>">
					<?php if ($thumbnail_id) {
						$image_src = \Elementor\Group_Control_Image_Size::get_attachment_image_src($thumbnail_id, $thumbnail_size_key, $settings);
						echo sprintf('<img src="%s" title="%s" alt="%s"%s />', esc_attr($image_src), esc_attr(get_the_title($thumbnail_id)), esc_attr(anant_get_attachment_alt($thumbnail_id)), '');
					} ?>					
				</a> 
				<div class="ant-product-buttons <?php echo esc_attr($this->product_icon) ?>">
					<?php if($show_wishlist_button == true){ ?>
						<a class="wishlist-cls" product-id="<?php echo esc_attr($product->get_id()); ?>"><i class="far fa-heart"></i><span class="ant-tooltip">Add To Wishlist</span></a>
					<?php } ?>
					<?php if($show_quickview_button == true){ ?>
						<a class="quick-cls" ><i class="far fa-eye"></i><span class="ant-tooltip" data-prod-id="<?php echo esc_attr($product->get_id()); ?>">Quick view</span></a>
					<?php } ?>				 
				</div>
				<?php if (in_array($product_id, $on_sales_ids)) { ?>
					<div class="ant-tag <?php echo esc_attr($this->product_tag) ?>">
						<span>Sale</span>
					</div>
				<?php } ?>
			</div>
		<!-- display image ends -->
		<!-- content begins  -->
		<div class="anant_product_content">

			<div class="anant_title">
			<?php 
				$product_cats = get_the_terms( $product->get_id(), 'product_cat' );
				if($display_category){
					if(empty($selected_cats)){
						if ( $product_cats && ! is_wp_error( $product_cats ) ) {
							foreach ( $product_cats as $category ) {
								echo '<a class="ant-category '.esc_attr($this->product_category).'" href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
							}
						}
					}else{	
						if ( $selected_cats && ! is_wp_error( $selected_cats ) ) {
							foreach ( $selected_cats as $category ) {
								// var_dump($product_categories);
								if (in_multi_array($category, $product_cats)) {
									$category = get_term_by( 'name', $category, 'product_cat' );
									echo '<a class="ant-category '.esc_attr($this->product_category).'" href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . '</a>';
								}
							}
						}
					} } ?>
				<?php if ($display_title === 'yes') { ?>
					<h2 class="title <?php echo esc_attr($this->product_title) ?>"><a href="<?php echo esc_url($product->get_permalink()); ?>"><?php echo esc_html($product->get_title()); ?></a></h2>
				<?php } ?>
			</div>
			<?php 
			if ($display_price == 'yes') { ?>
				<div class="anant_price <?php echo esc_attr($this->product_price) ?>">
					<?php echo wp_kses_post( $product->get_price_html() ); ?>
				</div>
			<?php } 
			if ($display_rating == 'yes') { ?>
			<div class="anant-rating <?php echo esc_attr($this->product_rating) ?>">
				<?php
				if ('no' !== get_option('woocommerce_enable_review_rating')) {
					$rating_count = $product->get_rating_count();
					$review_count = $product->get_review_count();
					$average      = $product->get_average_rating();
					$product_id   = $product->get_id(); 
					$rating = $average;
					$round_next_rating = round($rating);
					$round_prev_rating = floor($rating);?>
				<div class="anant-rating-icons ">
				<?php 
					if(is_numeric( $rating ) && floor( $rating ) != $rating){
						?><div class="anant-star-rating"><?php
						for ($i = 1; $i <= 5; $i++) {
							if( $i <= $round_prev_rating){
								?><i class="fas fa-star"></i><?php
							}else if($i <= $round_next_rating){
								?><i class="fas fa-star-half-alt"></i><?php
							}else{
								?><i class="far fa-star"></i><?php
							}
						}
						?></div><?php
					}elseif($rating == 0 || $rating == '0' ){
						?><div class="anant-star-rating"><?php
						$num_iterations = 5;
						for ($i = 1; $i <= $num_iterations; $i++) {
							?><i class="far fa-star"></i><?php
						}
						?></div><?php
					}else{
						?><div class="anant-star-rating"><?php
						for ($i = 1; $i <= 5; $i++) {
							if( $i <= $round_next_rating){
								?><i class="fas fa-star"></i><?php
							}else{
								?><i class="far fa-star"></i><?php
							}
						}
						?></div><?php
					} ?> 
				</div>
				<?php } ?>
			</div>
			<?php }

			// btn cart begins
		if ( $show_cart_button ) { ?>
		<div class="anant_cartbtn">
			<div class="anant-add-to-cart <?php echo esc_attr($this->product_btn) ?>">
				<?php 
					echo sprintf(
						'<a href="%s" data-quantity="1" class="%s" %s>%s</a>',
						esc_url( $product->add_to_cart_url() ),
						esc_attr(
							implode(
								' ',
								array_filter(
									[
										'button',
										'product_type_' . $product->get_type(),
										$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
										$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
										'anant_add_to_cart_btn',
									]
								)
							)
						),
						wp_kses(
							wc_implode_html_attributes(
								[
									'data-product_id'  => esc_attr( $product->get_id() ),
									'data-product_sku' => esc_attr( $product->get_sku() ),
									'aria-label'       => esc_attr( $product->add_to_cart_description() ),
									'rel'              => 'nofollow',
								]
							),
							[
								'data-product_id'  => true,
								'data-product_sku' => true,
								'aria-label'       => true,
								'rel'              => true,
							]
						),
						esc_html( $product->add_to_cart_text() )
					);
				?>
			</div>
		</div> 
		<?php } ?>
		</div> 
		<!-- content ends  -->
	</div>
	<!--/anant-product-overlay -->
<?php } ?>