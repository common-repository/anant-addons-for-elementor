<div class="ant-cta two <?php echo esc_attr( $this->cta_card_class )?>">
	<div class="ant-cta-overlay <?php echo esc_attr( $this->cta_card_inner_class )?>">
		<div class="ant-content <?php echo esc_attr( $this->cta_card_content_class )?>">
			<div class="ant_title">
			  	<?php
			 	if ( $show_subtitle === 'yes' ) {
					?>
						<h6 class="subtitle <?php echo esc_attr( $this->cta_card_subtitle_class )?>"><?php echo esc_html($subtitle) ?></h6>

					<?php
				}
			  ?>
			  <?php
			 	if ( $show_title === 'yes' ) {
					?>
						<h2 class="title <?php echo esc_attr( $this->cta_card_heading_class )?>"><?php echo esc_html($title )?></h2>
					<?php
				}
			  ?>
			  <?php
			 	if ( $show_description === 'yes' ) {
					?>
						<span class="text <?php echo esc_attr( $this->cta_card_description_class )?>"><?php echo esc_html($description )?></span>
					<?php
				}
			  ?>
			</div>
			<div class="ant-call-button">
			  <?php
			 	if ( $show_link === 'yes' ) {
					?>
					<div class="<?php echo esc_attr( $this->cta_card_read_more_class )?>">
						<a
							class="ant_cta_btn <?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
							href="<?php echo esc_url( $link )?>"
							<?php echo esc_attr($target) ?>
							<?php echo esc_attr($nofollow) ?>>
							<?php 
								if ($link_button_position === 'before') {
									\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
								}
							?>
							<?php echo esc_html($link_text) ?>
							<?php 
								if ($link_button_position === 'after') {
									\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
								}
							?>
						</a>
					</div>
					<?php
				}
				?>
				<?php
			 	if ( $show_two_link === 'yes' ) {
					?>
					<div class="<?php echo esc_attr( $this->cta_card_read_more_two_class )?>">
						<a
							class="ant_cta_btn tran <?php echo $link_two_button_position === 'before' ? 'anant-no-flex': '' ?>"
							href="<?php echo esc_url( $link_two )?>"
							<?php echo esc_attr($target_two) ?>
							<?php echo esc_attr($nofollow_two) ?>>
							<?php 
								if ($link_two_button_position === 'before') {
									\Elementor\Icons_Manager::render_icon( $link_two_button_icon, [ 'aria-hidden' => 'true' ] );
								}
							?>
							<?php echo esc_html($link_two_text) ?>
							<?php 
								if ($link_two_button_position === 'after') {
									\Elementor\Icons_Manager::render_icon( $link_two_button_icon, [ 'aria-hidden' => 'true' ] );
								}
							?>
						</a>
					</div>
					<?php
				}
			  ?>
			  </div>
		</div>
	</div>
</div>