<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<div class="heading_one <?php echo esc_attr($this->heading_card_class) ?>">
	<?php if($show_heading == 'yes'){ ?>
		<<?php echo esc_attr($heading_html_tag) ?> class="title">
			<a href="<?php echo esc_url($link) ?>" <?php echo esc_attr($target) ?> <?php echo esc_attr($nofollow) ?> >
				<?php echo esc_html($before_title )?>
				<span><?php echo esc_html($title )?></span>
				<?php echo esc_html($after_title )?> 
			</a>
		</<?php echo esc_attr($heading_html_tag) ?>>
	<?php } ?>
	<?php if($show_subtext == 'yes'){ ?>
		<div class="text"><?php echo $subtext; ?></div>
	<?php } ?> 
</div>