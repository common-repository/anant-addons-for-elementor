<div class="anant-testimonial-wrapper testimonial_one <?php echo esc_attr($this->testimonial_card_class )?>">
	<div class="heading">
		<?php
			if ( $show_title === 'yes' ) {
				?>
					<h3 class="title <?php echo esc_attr($this->testimonial_card_heading_class )?>">
						<?php echo esc_html($title) ?>
					</h3>				
				<?php
				}
			?>
	</div>
	<div class="sub-qute <?php echo esc_attr($this->testimonial_card_inner_class )?>">
		<?php
			if ( $show_icon === 'yes' ) {
				?>
					<div class="<?php echo esc_attr($this->testimonial_card_icon_class )?>">
						<div class="testi-icon">
						<?php \Elementor\Icons_Manager::render_icon( $card_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					</div>
				<?php
				}
				?>
		<?php
			if ( $show_description === 'yes' ) {
				?>
					<p class="discription <?php echo esc_attr($this->testimonial_card_description_class )?>"><?php echo esc_html($description )?></p>
				<?php
				}
			?>
	</div>
		<div class="testi-content <?php echo esc_attr($this->testimonial_card_content_class )?>">
			<?php
			if ( $show_image === 'yes' ) {
				?>
					<div class="testi-img <?php echo esc_attr($this->testimonial_card_image_class )?>">
						<img class="clg" src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($name) ?>">
					</div>
				<?php
				}
			?>
			<div class="testi-heading">
			<?php
			if ( $show_name === 'yes' ) {
				?>
					<h6 class="user-title <?php echo esc_attr($this->testimonial_card_name_class )?>">
						<a href="<?php echo esc_url($link) ?>" <?php echo esc_attr($target) ?> <?php echo esc_attr($nofollow) ?>>
							<?php echo esc_html($name) ?>
						</a>
					</h6>				
				<?php
				}
			?>
			<?php
			if ( $show_designation === 'yes' ) {
				?>
					<p class="details <?php echo esc_attr($this->testimonial_card_designation_class )?>"><?php echo esc_html($designation )?></p>
				<?php
				}
			?>			
			</div>
			<?php
			if ( $show_star === 'yes' ) {
				?>
					<div class="<?php echo esc_attr($this->testimonial_card_icon_class )?>">
						<?php 
							if(is_numeric( $rating ) && floor( $rating ) != $rating){
								?><div class="testi-star"><?php
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
								?><div class="testi-star"><?php
                                $num_iterations = 5;
                                for ($i = 1; $i <= $num_iterations; $i++) {
                                    ?><i class="far fa-star"></i><?php
                                }
								?></div><?php
                            }else{
								?><div class="testi-star"><?php
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
				<?php
				}
			?>
		</div>
</div>