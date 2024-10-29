<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<div class="anant-service-wrapper service_two <?php echo esc_attr($this->service_card_class) ?>">
	<div class="inner <?php echo esc_attr($this->service_card_inner_class) ?>">
		<div class="ser-img <?php echo esc_attr($this->service_card_image_class) ?>">
			<?php if ( $show_image === 'yes' ) {
			?>
				<img class="img-fluid" src="<?php echo esc_url($image_url )?>" alt="<?php echo esc_attr($title) ?>">
			<?php } ?>
			<?php if ( $show_icon === 'yes' ) { 
			?>
			<div class="<?php echo esc_attr($this->service_card_icon_class) ?>">
				<div class="icon">
				<?php \Elementor\Icons_Manager::render_icon( $card_icon, [ 'aria-hidden' => 'true' ] ); ?>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="content">
			<?php if ( $show_title === 'yes' ) {
			?>
				<div class="heading">
					<h3 class="title <?php echo esc_attr($this->service_card_heading_class) ?>"><?php echo esc_html($title )?></h3>
				</div>
				<?php } ?>
			<?php if ( $show_link === 'yes' ) {
			?>
				<div class="<?php echo esc_attr($this->service_card_read_more_class) ?>">
					<a
						class="more <?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
						href="<?php echo esc_url($link) ?>"
						<?php echo esc_attr($target); ?>
						<?php echo esc_attr($nofollow); ?>>
						<?php echo esc_html($link_text )?>
					</a>
				</div>
			<?php } ?>
		</div>
    </div>
</div>