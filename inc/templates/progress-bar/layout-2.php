<div class="<?php echo esc_attr($this->progress_main_class); ?>" prog-suffix="<?php echo esc_attr($counter_suffix); ?>">
	<div class="ant-progress-item two">
		<h2 class="ant-pro-title <?php echo esc_attr($this->progress_title_class)?>"><?php echo esc_html($title) ?></h2>
		<div class="ant-progress <?php echo esc_attr($this->progress_class)?>">
			<div class="ant-progress-bar ant-pro-primary <?php echo esc_attr($this->progress_bar_class)?>" per="<?php echo esc_attr($counter) ?>%"  style="width: <?php echo esc_attr($counter) ?>%">
			<?php
			if ($show_percentage) {
			?>
				<span class="ant-pro-percentage <?php echo esc_attr($this->progress_counter_class)?>"><?php echo esc_html($counter) ?></span>
			<?php
			}
			?>
			</div>
		</div>
	</div>
</div>