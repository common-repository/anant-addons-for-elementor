<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<div class="anant-portfolio-wrapper portfolio_two <?php echo esc_attr($this->portfolio_card_class )?>">
	<div class="portfolio-inner <?php echo esc_attr($this->portfolio_card_inner_class )?>"> 
		<div class="port-img <?php echo esc_attr($this->portfolio_card_image_class )?>">
			<img class="img-fluid" src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
			<?php
			if ( $show_icon === 'yes' ) {
				?>
					<div class="port-icon <?php echo esc_attr($this->portfolio_card_icon_class )?>">
					<a href="<?php echo esc_url($image_url) ?>"<?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>> 
						<?php \Elementor\Icons_Manager::render_icon( $card_two_icon, [ 'aria-hidden' => 'true' ] ); ?>
					</a>
					<a href="<?php echo esc_url($link) ?>"<?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>> 
						<?php \Elementor\Icons_Manager::render_icon( $card_icon, [ 'aria-hidden' => 'true' ] ); ?>
					</a>
				</div> 
				<?php
				}
			?>
		</div> 
		<div class="content">
			<div class="tag-line <?php echo esc_attr($this->portfolio_card_content_class )?>">
			<?php
				if ( $show_subtitle === 'yes' ) {
					?>
						<span class="text <?php echo esc_attr($this->portfolio_card_subtitle_class )?>"><?php echo esc_html($subtitle) ?></span>
					<?php
					}
				?>
			<?php
			if ( $show_title === 'yes' ) {
				?>
					<h3 class="title <?php echo esc_attr($this->portfolio_card_heading_class )?>">
						<a href="<?php echo esc_url($link) ?>"<?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>>
							<?php echo esc_html($title) ?>
						</a>
					</h3>				
				<?php
				}
			?>
			</div>
		</div>
	</div>
</div>