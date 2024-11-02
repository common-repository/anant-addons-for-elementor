<div class="ant-price one<?php if ($primary_box == 'show'){echo ' active';} ?> <?php echo esc_attr($this->price_card_class )?>">
	<?php if ($show_ribbon == 'yes') { ?>
	<div class="ant-price-ribbon <?php echo esc_attr($ribbon_style) ?>">
		<span class="<?php echo esc_attr($this->price_card_ribbon_class) ?>"><?php echo esc_html($ribbon_title) ?></span>
	</div><?php } ?>
	<div class="ant-price-header">
		<div class="ant-price-heading">
		<?php
			if ( $show_title === 'yes' ) {
				?>
					<h6 class="title <?php echo esc_attr($this->price_card_heading_class )?>"><?php echo esc_html($title )?></h6>
				<?php
			}
			?>
		</div>
		<?php			  
		if ( $show_plan === 'yes' ) {
			?>
			<div class="ant-currency <?php echo esc_attr($this->price_card_plan_class )?>">
				<?php if ( $sale_switch === 'show' ) { ?>
				<span class="ant-currency-sale <?php echo esc_attr($this->price_sale )?>">
					<s><span class="ant-currency-sign"><?php echo esc_html($currency_symbol) ?></span><?php echo esc_html($price_sale_amount) ?></s>
				</span>
				<?php } ?>
				<span class="ant-currency-sign <?php echo esc_attr($this->price_sign) ?>"><?php echo esc_html($currency_symbol) ?></span>
				<span class="ant-currency-value <?php echo esc_attr($this->price_value )?>"><?php echo esc_html($price_amount) ?></span>
				<span class="ant-duration <?php echo esc_attr($this->price_duration )?>"><?php echo esc_html($price_per_plan )?></span>
			</div>
			<?php
		}
		?>
		<?php
		if ( $show_icon === 'yes' ){
				?>
					<div class="ant-icon <?php echo esc_attr($this->price_card_icon_class) ?>">
						<div class="icon">
							<?php \Elementor\Icons_Manager::render_icon( $card_icon, [ 'aria-hidden' => 'true' ] ); ?>
						</div>
					</div>
				<?php
		}
		?>
	</div>
	<ul class="ant-price-lists <?php echo esc_attr($this->price_card_inner_class) ?>">
	<?php
	if ( $show_feature === 'yes' ) {
			
		if (isset($features_title_block) && !empty($features_title_block))
		{
			foreach ($features_title_block as $key => $text_block)
			{
				$icon_block = $text_block['features_icon' ];
				$feature_item_active = $text_block['feature_item_active']; 
				$color = $text_block['features_repeater_icon_color']; 
				?>

				<li class="<?php echo esc_attr($this->price_card_feature_class ); if ( $feature_item_active !== 'show' ) echo ' line-th' ; ?>">
					<?php if (($features_icon_position === 'before') &&  ( $show_list_icon === 'show' )) { ?>
						<i class="<?php echo  esc_attr($icon_block['value']) ?>" aria-hidden = "true" style ="color:<?php echo esc_attr($color);?>"></i>
					<?php } ?>

					<a style ="color:<?php echo esc_attr($color);?>;"><?php echo esc_html($text_block['features_title']) ;?></a>
					<?php if (($features_icon_position === 'after') &&  ( $show_list_icon === 'show' )) { ?>
						<i class="<?php echo esc_attr($icon_block['value']) ?>" aria-hidden = "true" style ="color:<?php echo esc_attr($color);?>"></i>
					<?php } ?>
						
				</li>
				<?php
			}
		} 
	
	}
	?>
	</ul>
	<?php
	if ( $show_link === 'yes' ) {
		?>
		<div class="ant-price-footer <?php echo esc_attr($this->price_card_read_more_class )?>">
			<a
				class="ant-price-btn <?php echo $link_button_position === 'before' ? 'anant-no-flex': '' ?>"
				href="<?php echo esc_url( $link )?>"
				<?php echo esc_attr($target) ?>
				<?php echo esc_attr($nofollow) ?>>
				<?php 
					if ($link_button_position === 'before') {
						\Elementor\Icons_Manager::render_icon( $link_button_icon, [ 'aria-hidden' => 'true' ] );
					}
				?>
				<?php echo esc_html( $link_text )?>
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
</div>