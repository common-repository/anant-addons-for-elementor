<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<div class="anant-team-wrapper team_five <?php echo esc_attr($this->team_card_class) ?>">
	<div class="team-inner <?php echo esc_attr($this->team_card_inner_class) ?>">
		<div class="top-content <?php echo esc_attr($this->team_card_top_content_class) ?>">
			<div class="top_img <?php echo esc_attr($this->team_card_image_class) ?>">
				<?php if ( $show_image === 'yes' ) { ?>
					<img class="img-fluid" src="<?php echo esc_url($image_url) ?>" alt="<?php echo esc_attr($title) ?>">
				<?php } ?>
				<div class="overlay">
					<?php if ( $show_icon === 'yes' ) { ?>
						<div class="<?php echo esc_attr($this->team_card_icon_class) ?>">
							<div class="social-icon">
								<?php if (isset($social_icons_block) && !empty($social_icons_block)) {
										foreach ($social_icons_block as $key => $icon_block){
											if ($key === 4 ) { break; }
											$target = $icon_block['social_icon_link']['is_external'] ? ' target=_blank' : '';
											$nofollow = $icon_block['social_icon_link']['nofollow'] ? ' rel=nofollow' : ''; ?>
											<a href="<?php echo esc_url($icon_block['social_icon_link']['url']) ?>" <?php echo esc_attr($target); ?> <?php echo esc_attr($nofollow); ?>>
												<?php \Elementor\Icons_Manager::render_icon($icon_block['social_icon'], ['aria-hidden' => 'true']); ?>
											</a>
										<?php
										}
									} ?>
							</div>
						</div>
					<?php  }  ?>
				</div>
			</div>
		</div>
		<div class="bottom-content <?php echo esc_attr($this->team_card_bottom_content_class) ?>">
			<div class="heading">
				<?php if ( $show_title === 'yes' ) { ?>
					<h3 class="title <?php echo esc_attr($this->team_card_heading_class) ?>"><?php echo esc_html($title) ?></h3>
				<?php } ?>
			 	<?php if ( $show_designation === 'yes' ) { ?>
					<p class="category <?php echo esc_attr($this->team_card_designation_class) ?>"><?php echo esc_html($designation) ?></p>
				<?php } ?>
			</div> 
		</div>
	</div>
</div>