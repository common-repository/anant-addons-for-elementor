<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<div class="anant-feature-wrapper feature_one <?php echo esc_attr($this->feature_card_class )?>">
	<div class="feature-inner <?php echo esc_attr($this->feature_card_inner_class )?>">
		<?php
		if ( $choose_icon === 'icon' ) {
			?>
				<div class="<?php echo esc_attr($this->feature_card_icon_class )?>">
					<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $card_icon, [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				</div>
			<?php
			}
		elseif ( $choose_icon === 'img' ) {
			?>
				<div class="<?php echo esc_attr($this->feature_card_image_class )?>">
					<div class="image">
					<img src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
					</div>
				</div>
			<?php
			}
		?>
		<div class="content">
			<?php
			if ( $show_title === 'yes' ) {
				?>
				<div class="heading">
					<h3 class="title <?php echo esc_attr($this->feature_card_heading_class )?>">
					<a href="<?php echo esc_url($link) ?>"<?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>> <?php echo esc_html($title )?></a>
				</h3>
				</div>
				<?php
				}
			?>
			<?php
			if ( $show_description === 'yes' ) {
				?>
					<p class="text <?php echo esc_attr($this->feature_card_description_class )?>"><?php echo esc_html($description) ?></p>
				<?php
				}
			?>
		</div>
	</div>
</div>