<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<div class="anant-service-wrapper service_three <?php echo esc_attr($this->service_card_class )?>">
	<div class="inner">
		<div class="content <?php echo esc_attr($this->service_card_inner_class )?>">
			<?php if ( $show_icon === 'yes' ) {
				?>
				<div class="<?php echo esc_attr($this->service_card_icon_class )?>">
					<div class="icon">
					<?php \Elementor\Icons_Manager::render_icon( $card_icon, [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				</div>
			<?php } ?>
			<?php if ( $show_title === 'yes' ) {
				?>
			<div class="heading">
				<h3 class="title <?php echo esc_attr($this->service_card_heading_class )?>"><?php echo esc_html($title )?></h3>
			</div>
			<?php } ?>
			<?php if ( $show_description === 'yes' ) {
				?>
					<p class="text <?php echo esc_attr($this->service_card_description_class )?>"><?php echo esc_html($description )?></p>
				<?php } ?>
			<?php if ( $show_link === 'yes' ) {
					?>
				<div class="<?php echo esc_attr($this->service_card_read_more_class )?>">
					<a
						class="more <?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
						href="<?php echo esc_url($link) ?>"
						<?php echo esc_attr($target); ?>
						<?php echo esc_attr($nofollow); ?>>
						<?php 
							if ($link_button_position === 'before') {
								\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
							}
						?>
						<?php echo esc_html($link_text ); ?>
						<?php 
							if ($link_button_position === 'after') {
								\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
							}
						?>
					</a>
				</div>
			<?php } ?>
		</div>
	</div>
</div>